# LAPORAN PRAKTIKUM PEMROGRAMAN WEB 2
## Praktikum 1: PHP Framework (CodeIgniter 4)

**Nama** : Maya Enjelina  
**NIM** : 312410378  
**Kelas** : I243B  
**Repository** : Lab7Web

---

### 1. Persiapan dan Instalasi
Sebelum memulai, saya melakukan instalasi framework CodeIgniter 4. Berdasarkan instruksi:
* **Download CodeIgniter 4**: Melalui website resmi codeigniter.com.
* **Ekstrak File**: Hasil download diekstrak ke folder: `C:\xampp\htdocs\lab11_php_ci\ci4`.
* **Aktivasi Ekstensi**: Mengaktifkan `intl`, `mbstring`, dan `openssl` pada file `php.ini`.
    ![Screenshot XAMPP](./ci4/assets/xampp.png)
    ![Screenshot php.ini](./ci4/assets/phpini.png)
 
### 2. Menjalankan Server
Untuk menjalankan aplikasi, saya menggunakan PHP Development Server bawaan CodeIgniter dengan mengetikkan perintah berikut pada terminal/command prompt:
php spark serve
Aplikasi kemudian dapat diakses melalui browser dengan alamat http://localhost:8080.
    ![Screenshot terminal](./ci4/assets/terminal.png)

### 3. Membuat Controller
Saya membuat sebuah Controller baru bernama Page.php di folder app/Controllers/. Controller ini berfungsi untuk menangani permintaan halaman statis seperti About, Contact, Faqs, dan Tos.
    ![Screenshot page](./ci4/assets/page.png)

Halaman About
    ![Screenshot halAbout](./ci4/assets/halAbout.png)

Halaman TOS
    ![Screenshot halTos](./ci4/assets/halTos.png)

### 4. Konfigurasi Routing
Agar alamat URL lebih rapi, saya melakukan konfigurasi pada file app/Config/Routes.php. Saya mendaftarkan rute khusus agar halaman dapat diakses tanpa harus menuliskan nama controller di URL.
    ![Screenshot routes](./ci4/assets/routes.png)
### 5. Membuat Layout (Header dan Footer)
Untuk menerapkan konsep reusable code, saya membagi tampilan menjadi tiga bagian utama:

1. **Header**: Berisi tag pembuka HTML, navigasi, dan pemanggilan CSS.
2. **Footer**: Berisi sidebar dan tag penutup HTML.
3. **Content**: Isi konten spesifik tiap halaman.
Saya membuat folder template di dalam app/Views/ dan membuat file header.php serta footer.php di dalamnya.
Code header.php
    ![Screenshot header](./ci4/assets/header.png)

Code footer.php
    ![Screenshot footer](./ci4/assets/footer.png)

### 6. Menambahkan CSS
Agar tampilan sesuai dengan gambar pada modul, saya menambahkan file style.css di folder public/. CSS ini menggunakan teknik float untuk membagi area menjadi bagian main (konten) dan sidebar.
    ![Screenshot css](./ci4/assets/css.png)
 
### 7. Hasil Akhir (Halaman About)
Saya memperbarui method pada Controller dan file View about.php agar menggunakan fungsi include untuk memanggil header dan footer.

![Screenshot output](./ci4/assets/output.png)

---

### 8. Penyelesaian Tugas (Menambah Menu Artikel dan Kontak)
Sesuai dengan instruksi pada bagian "Pertanyaan dan Tugas", saya telah melengkapi navigasi website dengan menambahkan halaman Artikel dan Kontak.

**Langkah yang dilakukan:**
1. **Update Controller**: Menambahkan method `artikel()` dan `contact()`.
2. **Membuat View**: Membuat file `artikel.php` dan `contact.php` di folder `app/Views/`.
3. **Navigasi Aktif**: Mengatur link pada `header.php` agar semua menu dapat diakses.

![Screenshot Hasil Artikel](./ci4/assets/artikel.png)

![Screenshot Hasil Kontak](./ci4/assets/contact.png)

---

### 9. Kesimpulan
Pada praktikum ini, saya telah berhasil melakukan instalasi CodeIgniter 4, memahami konsep Routing dan Controller, serta mengimplementasikan teknik *Layouting* menggunakan fungsi `include`.
 
------------------------------------------------------------------------------------------------

 ## Praktikum 2 : Framework lanjutan (CRUD)

Pada praktikum ini, saya melanjutkan pengembangan aplikasi web portal berita dengan menambahkan fitur CRUD (*Create, Read, Update, Delete*) pada menu Admin.

### **1. Membuat Database dan Tabel**
Langkah pertama adalah membuat database `lab_ci4` dan tabel `artikel` menggunakan MySQL.

![Screenshot Tabel Artikel](./ci4/assets/gambar_praktikum2/Database.png)

### **2. Mengatur Konfigurasi Database**
Mengubah file `.env` atau `app/Config/Database.php` untuk menghubungkan aplikasi ke database MySQL. Pada praktikum ini saya menggunakan konfigurasi pada file .env.

![Screenshot konfigurasi](./ci4/assets/gambar_praktikum2/konfigurasi.png)

### **3. Menambahkan Data di Database**
Menambahkan beberapa data ke database agar muncul di aplikasi web

![Screenshot konfigurasi](./ci4/assets/gambar_praktikum2/tambahdata_database.png)

Sehingga akan tampil datanya seperti ini

![Screenshot konfigurasi](./ci4/assets/gambar_praktikum2/hasil1.png)

### **4. Membuat Tampilan Detail Artikel**
Tampilan pada saat judul berita di klik maka akan diarahkan ke halaman yang berbeda.
Artikel pertama

![Screenshot konfigurasi](./ci4/assets/gambar_praktikum2/artikel1.png)

Artikel kedua

![Screenshot konfigurasi](./ci4/assets/gambar_praktikum2/artikel2.png)

### **5. Membuat Menu Admin**
Membuat menu admin untuk mengelola data artikel. Langkah-langkahnya meliputi:
* **Controller**: Menambahkan method `admin_index()`.
* **View**: Membuat file `admin_index.php` dan template `admin_header.php` serta `admin_footer.php`.
* **Routing**: Mengatur grup rute untuk admin di `app/Config/Routes.php`.

![Screenshot Menu Admin](./ci4/assets/gambar_praktikum2/menu_admin.png)

### **6. Fitur Tambah Data (Create)**
Membuat fitur Tambah data agar data dapat di tambah dengan mudah. Langkah langkah meliputi :
* **Controller**: Menambahkan method `add()`.
* **View**: Membuat file `form_add.php`.

![Screenshot Menu Admin](./ci4/assets/gambar_praktikum2/tambah_artikel.png)

Hasil tambah data

![Screenshot Menu Admin](./ci4/assets/gambar_praktikum2/hasil_tambahdata.png)

### **7. Fitur Ubah Data (Update)**
Membuat fitur ubah data agar data dapat di ubah dengan mudah. Langkah langkah meliputi :
* **Controller**: Menambahkan method `edit()`.
* **View**: Membuat file `form_edit.php`.

![Screenshot Menu Admin](./ci4/assets/gambar_praktikum2/ubah_data.png)

Hasilnya "Artikel petama" menjadi "Artikel first"

![Screenshot Menu Admin](./ci4/assets/gambar_praktikum2/ubah_data2.png)

### **8. Fitur Hapus Data (Delete)**
Membuat fitur ubah data agar data dapat di ubah dengan mudah. Langkah langkah meliputi :
* **Controller**: Menambahkan method `delete()`.

![Screenshot Menu Admin](./ci4/assets/gambar_praktikum2/ubah_data2.png)

----------------------------------------------------------------

 ## Praktikum 3 : View Layout dan View Cell

Praktikum kali ini bertujuan untuk memberikan pemahaman mendalam mengenai konsep **View Layout** pada framework CodeIgniter 4, di mana fokus utamanya adalah menciptakan sistem template tampilan yang efisien dan terstruktur. Melalui penerapan View Layout, mahasiswa diharapkan mampu menggunakan template tampilan untuk membangun kerangka website yang terpusat. Selain itu, praktikum ini juga mencakup pemahaman dan implementasi **View Cell** sebagai solusi untuk memanggil komponen antarmuka pengguna (UI) secara mandiri. Dengan menggunakan View Cell, komponen dapat bersifat modular, artinya komponen tersebut memiliki logika datanya sendiri dan dapat digunakan kembali pada berbagai halaman tanpa harus bergantung pada Controller utama.

---

## Langkah-langkah Praktikum

### 1. Membuat Layout Utama
Saya membuat file template induk di `app/Views/layout/main.php`. File ini berfungsi sebagai kerangka utama yang mencakup header, navigasi, dan footer.
* **Fitur Utama:** Menggunakan `<?= $this->renderSection('content') ?>` agar halaman lain bisa mengisi konten di dalam template ini secara dinamis.

### 2. Implementasi View Layout pada Halaman Home
Saya memodifikasi halaman utama dengan membuat file `app/Views/home.php`. Halaman ini menggunakan fungsi `extend` untuk memanggil layout utama sehingga memiliki tampilan yang konsisten dengan template induk.

### 3. Membuat View Cell (Komponen Modular)
Saya mengimplementasikan View Cell untuk menampilkan daftar "Artikel Terkini". Komponen ini bekerja secara modular, di mana datanya diambil langsung melalui class `ArtikelTerkini` di folder `app/Cells/`.

### 4. Konfigurasi Database
Untuk mendukung fitur pengurutan pada View Cell, saya menambahkan kolom tanggal pada tabel artikel di MySQL dan juga saya menambahkan beberapa artikel baru:

```sql
ALTER TABLE artikel ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP;
```
### Analisis & Evaluasi (Pertanyaan Modul)
### Apa manfaat utama dari penggunaan View Layout dalam pengembangan aplikasi?
* Efisiensi Kode: Kita tidak perlu menuliskan kode header, navigasi, dan footer yang sama di setiap file View.
* Kemudahan Pemeliharaan: Jika ingin mengubah tampilan menu atau footer, kita cukup mengubah satu file layout saja, dan seluruh halaman akan otomatis terupdate.
* Konsistensi Desain: Menjamin seluruh halaman aplikasi memiliki struktur dan tampilan yang seragam/konsisten.

### Apa perbedaan antara View Cell dan View biasa?
* View Biasa: Digunakan untuk menampilkan konten utama halaman. Datanya harus dikirimkan secara manual oleh Controller menggunakan fungsi return view().

* View Cell: Digunakan untuk membuat komponen UI yang modular (seperti sidebar atau widget). View Cell memiliki logika (Class) sendiri sehingga bisa memanggil datanya sendiri dari database tanpa harus bergantung pada Controller halaman tersebut.

----------------------------------------------------------------

 ## Praktikum 4 : Framework Lanjutan (Modul Login)

 Pada praktikum ini, kita belajar untuk membangun Sistem Otentikasi Pengguna (Login System) yang berfungsi sebagai pintu keamanan utama bagi aplikasi web. Sistem ini dirancang untuk memverifikasi identitas setiap pengguna yang ingin mengakses area terbatas (seperti halaman admin) melalui validasi Email dan Password.

 ---
 ### Langkah - Langkah Praktikum 
 ### 1. Membuat Database
 Langkah awal adalah menyiapkan tabel user pada database MySQL untuk menyimpan data login.

![Screenshot database tabel](./ci4/assets/gambar_praktikum4/Database.png)

### 2. Membuat Model User
Membuat file UserModel.php di direktori app/Models untuk menangani interaksi data dengan tabel user.
* File: app/Models/UserModel.php
* Keterangan: Mendefinisikan properti $allowedFields agar field username, useremail, dan userpassword dapat diisi melalui aplikasi.

### 3. Membuat Controller User
Membuat controller untuk menangani logika tampilan daftar user, proses login, dan logout.
* File: app/Controllers/User.php
* Method Utama:
index(): Menampilkan daftar user.
login(): Memvalidasi email dan password menggunakan password_verify.
logout(): Menghancurkan session user dan mengarahkan kembali ke halaman login.

### 4. Membuat View Login
Membuat antarmuka halaman login bagi pengguna.
* File: app/Views/user/login.php
* Keterangan: Menggunakan form dengan metode post yang mengirimkan data ke method login() di controller. Terdapat pengecekan flashdata untuk menampilkan pesan kesalahan jika login gagal.

### 5. Menambahkan file Css
Agar tampilan form login tidak hanya fungsional tetapi juga memiliki antarmuka yang menarik (User Interface), saya menambahkan kode CSS pada file style.css.
* Sebelum CSS

![Screenshot hasil](./ci4/assets/gambar_praktikum4/hasil.png)

* Setelah CSS
![Screenshot Output Akhir](./ci4/assets/gambar_praktikum4/Output.png)

### 6. Membuat Database Seeder
Menambahkan data dummy ke database untuk keperluan uji coba.
**Langkah:**
* Jalankan perintah php spark make:seeder UserSeeder melalui terminal/CLI.
* Isi file app/Database/Seeds/UserSeeder.php dengan data admin (password di-hash menggunakan password_hash).
* Jalankan php spark db:seed UserSeeder untuk memasukkan data ke tabel.
![Screenshot seeder](./ci4/assets/gambar_praktikum4/database_Seeder.png)

### 7. Menambahkan Auth Filter
Membuat filter untuk membatasi akses halaman admin hanya untuk pengguna yang sudah login.
* File Filter: app/Filters/Auth.php (Berisi logika pengecekan session logged_in).
* Konfigurasi Filter: Daftarkan alias 'auth' pada file app/Config/Filters.php di dalam array $aliases.

### 8. Konfigurasi Routing
Mengatur rute aplikasi agar grup halaman admin diproteksi oleh filter auth.
* File: app/Config/Routes.php

Contoh Kode:

PHP
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    // rute admin lainnya...
});

### 9. Uji Coba Akses
Akses URL http://localhost:8080/admin/artikel.

Sistem secara otomatis akan mengalihkan (redirect) ke halaman login karena filter mendeteksi user belum terautentikasi.
Masukkan email dan password yang telah dibuat melalui seeder untuk masuk ke dashboard admin.
Apabila yang kita masukan Password atau Email salah maka akan muncul seperti ini

![Screenshot Pwsalah](./ci4/assets/gambar_praktikum4/Pwsalah.png)

Apabila Password dan Email benar maka akan langsung di arahkan ke halaman web

![Screenshot Pw Benar](./ci4/assets/gambar_praktikum4/Pwbenar.png)

------------------------------------------------------------------------
### Praktikum 5: Pagination dan Pencarian (Lab7Web)

Halaman ini menjelaskan langkah-langkah implementasi sistem navigasi (Pagination) dan fitur pencarian data pada aplikasi Admin Portal Berita menggunakan Framework CodeIgniter 4.

### Langkah-langkah Praktikum

### 1. Membuat Pagination

Pagination digunakan untuk memecah tampilan data yang banyak menjadi beberapa halaman agar lebih rapi dan ringan saat dimuat.

Modifikasi Controller Artikel: Buka file app/Controllers/Artikel.php. Pada method admin_index, ubah cara pengambilan data menggunakan fungsi paginate().

'artikel' => $model->paginate(10), // data dibatasi 10 record per halaman
'pager' => $model->pager,


Modifikasi View: Buka file app/Views/artikel/admin_index.php, kemudian tambahkan kode berikut di bawah tabel data untuk menampilkan navigasi halaman.

<?= $pager->links(); ?>


### 2. Membuat Fitur Pencarian

Fitur pencarian berfungsi untuk memfilter atau mencari data artikel tertentu berdasarkan judul.

Update Controller: Menambahkan variabel $q untuk menangkap input kata kunci dari form pencarian. Gunakan fungsi like() sebelum memanggil pagination.

$q = $this->request->getVar('q') ?? '';
$data['artikel'] = $model->like('judul', $q)->paginate(10);
$data['q'] = $q;


Update View (Form Search): Menambahkan form pencarian dengan method="get" di atas tabel pada file admin_index.php.

<form method="get" class="form-search">
    <input type="text" name="q" value="<?= $q; ?>" placeholder="Cari data">
    <input type="submit" value="Cari" class="btn btn-primary">
</form>


Update Pager: Memperbarui kode pagination agar hasil pencarian tetap terjaga saat berpindah halaman.

<?= $pager->only(['q'])->links(); ?>


### Hasil Akhir (Uji Coba)

Sistem telah berhasil diuji dengan hasil sebagai berikut:

Pagination: Daftar artikel berhasil terbagi menjadi beberapa halaman (10 data per halaman).

Pencarian: Data berhasil difilter sesuai dengan kata kunci yang dimasukkan pada kolom pencarian tanpa merusak sistem navigasi halaman.
![Screenshot hasil](./ci4/assets/gambar_praktikum5/hasil_praktikum5.png)


------------------------------------------------------------------------
### Praktikum 6: Relasi Table dan Query Builder

### Langkah-langkah Praktikum
### 1. Membuat Tabel Kategori
![Screenshot tabel](./ci4/assets/gambar_praktikum6/tabel_kategori.png)

### 2. Membuat Model Kategori
 Buat file model baru di `app/Models` dengan nama `KategoriModel.php`:

### 3. Memodifikasi beberapa file
* Modifikasi `ArtikelModel.php` untuk mendefinisikan relasi dengan `KategoriModel`:
* Modifikasi `Artikel.php` untuk menggunakan model baru dan menampilkan data relasi:
* Memodifikasi View
Buka folder view/artikel sesuaikan masing-masing view.
index.php

### 4. Testing
**1. Menampilkan daftar artikel dengan nama kategori.**
![Screenshot tabel](./ci4/assets/gambar_praktikum6/tampilan artikel dan nama kategori.png)

**2. Menambah artikel baru dengan memilih kategori**
![Screenshot tabel](./ci4/assets/gambar_praktikum6/memilih_kategori.png)

**3. Mengedit artikel dan mengubah kategorinya.**
![Screenshot tabel](./ci4\assets\gambar_praktikum6\edit_kategori.png)

**4. Menghapus artikel.**
Kita memilih untuk menghapus "artikel 5" 
![Screenshot tabel](./ci4/assets/gambar_praktikum6/hapus_artikel.png)

Hasil artikel 5 sudah terhapus
![Screenshot tabel](./ci4\assets\gambar_praktikum6\hasil_hapus.png)

--------------------------------------------------------------------------
### Laporan Praktikum Modul 7 - Upload File Gambar

## 1. Tujuan
Mengimplementasikan fitur upload file gambar pada form tambah artikel di framework CodeIgniter 4.

---

## 2. Langkah Praktikum dan Penjelasan Kode

### Langkah 1: Membuat Folder Penyimpanan
Membuat folder fisik bernama `gambar` di dalam direktori `public/` (yaitu `public/gambar/`) untuk menampung file asli yang diunggah.

### Langkah 2: Controller (app/Controllers/Artikel.php)
Mengubah fungsi `add()` untuk menangkap file gambar, memindahkannya ke folder public, dan menyimpan nama filenya ke database.

```php
public function add()
{
    $validation = \Config\Services::validation();
    $validation->setRules(['judul' => 'required']);
    $isDataValid = $validation->withRequest($this->request)->run();

    if ($isDataValid) {
        $file = $this->request->getFile('gambar'); // Ambil file
        $file->move(ROOTPATH . 'public/gambar');     // Pindahkan file

        $artikel = new ArtikelModel();
        $artikel->insert([
            'judul'       => $this->request->getPost('judul'),
            'isi'         => $this->request->getPost('isi'),
            'slug'        => url_title($this->request->getPost('judul')),
            'id_kategori' => $this->request->getPost('id_kategori'), // Relasi Modul 6
            'gambar'      => $file->getName(),                       // Nama File Modul 7
        ]);
        return redirect('admin/artikel');
    }
}
```
### Langkah 3: View Form (app/Views/artikel/form_add.php)
Menambahkan atribut enctype="multipart/form-data" pada tag form agar mendukung upload data biner, serta menambahkan komponen input file Bootstrap.

```HTML
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="gambar" class="form-label">Upload Gambar Artikel</label>
        <input type="file" name="gambar" id="gambar" class="form-control" required>
    </div>
    </form>
    ```

### Hasil 
![Screenshot hasil praktikum](./ci4/assets/hasil_praktikum7.png)
```

-------------------------------------
## Praktikum 8: AJAX

### 1. Penjelasan

* **Persiapan Library jQuery**: Mendownload file `jquery-3.6.0.min.js` dan menempatkannya ke dalam direktori project pada folder `public/assets/js/`.Library ini digunakan untuk mempermudah penulisan sintaks AJAX.
* **Membuat AJAX Controller**: Membuat file controller baru bernama `AjaxController.php` di dalam folder `app/Controllers/`.Controller ini berfungsi untuk memuat halaman utama, mengambil data artikel dari model dalam bentuk JSON, serta menangani proses penghapusan data.
* **Konfigurasi Routing**: Mendaftarkan URL routing baru pada file `app/Config/Routes.php` agar request dari JavaScript/jQuery dapat mengenali target URL di controller.
* **Membuat View AJAX**: Membuat file view di `app/Views/ajax/index.php`. Di dalam file ini, script jQuery ditulis untuk mengambil data secara otomatis saat halaman dimuat dan menangani aksi hapus data tanpa reload halaman.

### 2. Langkah Praktikum

#### A. Controller (`app/Controllers/AjaxController.php`)
```php
<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ArtikelModel;

class AjaxController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Artikel AJAX'
        ];
        return view('ajax/index', $data);
    }

    public function getData()
    {
        $model = new ArtikelModel();
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }

    public function delete($id)
    {
        $model = new ArtikelModel();
        $model->delete($id);
        
        $response = [
            'status' => 'OK',
            'message' => 'Artikel berhasil dihapus'
        ];
        return $this->response->setJSON($response);
    }
}
```
#### B. Routing (`app/config/routers.php`)
```php
$routes->get('ajax', 'AjaxController::index');
$routes->get('ajax/getData', 'AjaxController::getData');
$routes->delete('ajax/delete/(:num)', 'AjaxController::delete/$1');
```

#### C. View (App/View/ajax/index.php)
```php
<?= $this->include('template/header'); ?>
<div class="container" style="margin-top: 20px;">
    <h1>Data Artikel (AJAX)</h1>
    
    <table class="table-data" id="artikelTable" border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
<script>
$(document).ready(function() {
    function showLoadingMessage() {
        $('#artikelTable tbody').html('<tr><td colspan="4" style="text-align:center;">Loading data...</td></tr>');
    }
    function loadData() {
        showLoadingMessage();
        $.ajax({
            url: "<?= base_url('ajax/getData') ?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                var tableBody = "";
                if(data.length === 0) {
                    tableBody = '<tr><td colspan="4" style="text-align:center;">Tidak ada data artikel.</td></tr>';
                } else {
                    for (var i = 0; i < data.length; i++) {
                        var row = data[i];
                        tableBody += '<tr>';
                        tableBody += '<td>' + row.id + '</td>';
                        tableBody += '<td>' + row.judul + '</td>';
                        tableBody += '<td><span class="status">Active</span></td>';
                        tableBody += '<td>';
                        tableBody += '<a href="<?= base_url('artikel/edit/') ?>' + row.id + '" class="btn btn-primary" style="margin-right:5px;">Edit</a>';
                        tableBody += '<a href="#" class="btn btn-danger btn-delete" data-id="' + row.id + '">Delete</a>';
                        tableBody += '</td>';
                        tableBody += '</tr>';
                    }
                }
                $('#artikelTable tbody').html(tableBody);
            }
        });
    }
    loadData();
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
            $.ajax({
                url: "<?= base_url('ajax/delete/') ?>" + id,
                method: "DELETE",
                dataType: "json",
                success: function(response) {
                    if(response.status === 'OK') {
                        alert(response.message);
                        loadData();
                    }
                }
            });
        }
    });
});
</script>
<?= $this->include('template/footer'); ?>
```
### 3. Hasil Praktikum & Screenshot

* **Menampilkan Data Artikel via AJAX**: Halaman sukses memuat data dari database secara dinamis menggunakan AJAX request tanpa interupsi reload halaman.
  
  ![Halaman Utama AJAX](/ci4/assets/gambar_praktikum8/tampilan.png)

* **Konfirmasi Hapus Data**: Ketika tombol delete diklik, sistem memunculkan pop-up konfirmasi terlebih dahulu.
  
  ![Konfirmasi Hapus](/ci4/assets/gambar_praktikum8/konfirmasi_hapus.png)

* **Berhasil Hapus Tanpa Reload**: Setelah dikonfirmasi, data terhapus dari database dan baris tabel hilang secara instan(Table Artikel kesekian).
  
  ![Setelah Hapus Data](/ci4/assets/gambar_praktikum8/hasil.png)