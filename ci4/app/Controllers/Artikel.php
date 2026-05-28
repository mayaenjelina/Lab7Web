<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;

class Artikel extends BaseController
{
    public function index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model->getArtikelDenganKategori();
        return view('artikel/index', compact('artikel', 'title'));
    }

    public function admin_index()
    {
        $model = new ArtikelModel();
        
        // Ambil data pencarian dan filter dari URL
        $q = $this->request->getVar('q') ?? '';
        $kategori_id = $this->request->getVar('kategori_id') ?? '';

        // 1. Ambil object Query Builder bawaan dari model artikel
        $builder = $model->builder();

        // 2. Tentukan kolom yang di-select dan lakukan Join tabel kategori
        $builder->select('artikel.*, kategori.nama_kategori');
        $builder->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');

        // 3. Filter Pencarian Judul (Jika ada input cari)
        if (!empty($q)) {
            $builder->like('artikel.judul', $q);
        }

        // 4. Filter Kategori (Jika kategori dipilih)
        if (!empty($kategori_id)) {
            $builder->where('artikel.id_kategori', $kategori_id);
        }

        // 5. Urutkan berdasarkan ID terbesar (Artikel terbaru di paling atas)
        $builder->orderBy('artikel.id', 'DESC');

        // 6. Eksekusi Paginasi langsung menggunakan data builder (Cara paling aman CI4)
        $data['artikel'] = $model->paginate(10, 'default');
        $data['pager'] = $model->pager;

        // Ambil data kategori untuk isi Dropdown Filter Pencarian
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        // Kirim data pendukung ke View
        $data['q'] = $q;
        $data['kategori_id'] = $kategori_id;
        $data['title'] = "Daftar Artikel Admin";

        return view('artikel/admin_index', $data);
    }

  public function add()
    {
        // validasi data.
        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
        
        if ($isDataValid)
        {
            $file = $this->request->getFile('gambar');
            $file->move(ROOTPATH . 'public/gambar');
            
            $artikel = new ArtikelModel();
            $artikel->insert([
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'slug'        => url_title($this->request->getPost('judul')),
                'id_kategori' => $this->request->getPost('id_kategori'), // <-- AMAN! Data Modul 6 dimasukkan kembali
                'gambar'      => $file->getName(),                       // <-- Modul 7 tetap berjalan
            ]);
            
            return redirect('admin/artikel');
        }

        // Ambil data kategori supaya pilihan Dropdown di Form Tambah Artikel tidak kosong/hilang
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();
        $data['title'] = "Tambah Artikel";
        
        return view('artikel/form_add', $data);
    }
    public function add_kategori()
    {
        $kategoriModel = new KategoriModel();

        if ($this->request->is('post') && $this->validate([
            'nama_kategori' => 'required|is_unique[kategori.nama_kategori]'
        ])) {
            $nama = $this->request->getPost('nama_kategori');
            $kategoriModel->insert([
                'nama_kategori' => $nama,
                'slug_kategori' => url_title($nama, '-', true)
            ]);

            return redirect()->to(route_to('admin_artikel'));
        }

        return redirect()->to(route_to('admin_artikel'));
    }

    /**
     * FUNGSI BARU: Tambah Kategori Cepat dari halaman form_add
     * Setelah sukses menyimpan, otomatis redirect balik ke form tambah artikel
     */
    public function add_kategori_cepat()
    {
        $kategoriModel = new KategoriModel();

        if ($this->request->is('post') && $this->validate([
            'nama_kategori' => 'required|is_unique[kategori.nama_kategori]'
        ])) {
            $nama = $this->request->getPost('nama_kategori');
            $kategoriModel->insert([
                'nama_kategori' => $nama,
                'slug_kategori' => url_title($nama, '-', true)
            ]);
        }

        // Kembali ke halaman form tambah artikel
        return redirect()->to(base_url('admin/artikel/add'));
    }

    public function edit($id)
    {
        $model = new ArtikelModel();
        $kategoriModel = new KategoriModel();

        if ($this->request->is('post') && $this->validate([
            'judul' => 'required',
            'id_kategori' => 'required|integer'
        ])) {
            $model->update($id, [
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'slug' => url_title($this->request->getPost('judul'), '-', true),
                'id_kategori' => $this->request->getPost('id_kategori')
            ]);
            
            return redirect()->to(route_to('admin_artikel'));
        }

        $data['artikel'] = $model->find($id);
        $data['kategori'] = $kategoriModel->findAll();
        $data['title'] = "Edit Artikel";

        if (!$data['artikel']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan.');
        }

        return view('artikel/form_edit', $data);
    }

    public function delete($id)
    {
        $model = new ArtikelModel();
        $model->delete($id);
        
        return redirect()->to(route_to('admin_artikel'));
    }

    public function delete_kategori($id)
{
    $kategoriModel = new KategoriModel();
    
    // Hapus data kategori berdasarkan id_kategori yang dikirim
    $kategoriModel->delete($id);

    // Otomatis kembalikan admin ke form tambah artikel agar modalnya segar kembali
    return redirect()->to(base_url('admin/artikel/add'));
}

    public function view($slug)
    {
        $model = new ArtikelModel();
        $data['artikel'] = $model->where('slug', $slug)->first();
        if (empty($data['artikel'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the article.');
        }
        $data['title'] = $data['artikel']['judul'];
        return view('artikel/detail', $data);
    }
}