<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ArtikelModel;

class Post extends ResourceController
{
    protected $format = 'json';
    protected $modelName = 'App\Models\ArtikelModel';

    public function index()
    {
        $artikel = $this->model->findAll();
        return $this->respond(['artikel' => $artikel]);
    }

    public function show($id = null)
    {
        $artikel = $this->model->find($id);
        if (!$artikel) {
            return $this->failNotFound('Artikel tidak ditemukan');
        }
        return $this->respond($artikel);
    }

    public function create()
    {
        $data = [
            'judul'  => $this->request->getVar('judul'),
            'isi'    => $this->request->getVar('isi'),
            'status' => $this->request->getVar('status'),
        ];
        $this->model->insert($data);
        return $this->respondCreated(['status' => 201, 'messages' => 'Data berhasil ditambahkan']);
    }

    public function update($id = null)
    {
        $data = [
            'judul'  => $this->request->getVar('judul'),
            'isi'    => $this->request->getVar('isi'),
            'status' => $this->request->getVar('status'),
        ];
        $this->model->update($id, $data);
        return $this->respond(['status' => 200, 'messages' => 'Data berhasil diubah']);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        return $this->respondDeleted(['status' => 200, 'messages' => 'Data berhasil dihapus']);
    }
}