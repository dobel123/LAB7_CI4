<?php

namespace AppControllersApi;

use AppModelsArtikelModel;
use CodeIgniterRESTfulResourceController;

class Artikel extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $q = $this->request->getGet('q');
        $sort = $this->request->getGet('sort') ?: 'created_at';
        $order = $this->request->getGet('order') ?: 'DESC';
        $perPage = (int) ($this->request->getGet('perPage') ?: 5);
        $model = new ArtikelModel();
        $query = $model->withKategori();
        if ($q) {
            $query->groupStart()->like('judul', $q)->orLike('isi', $q)->groupEnd();
        }
        return $this->respond([
            'data' => $query->orderBy($sort, $order)->paginate($perPage),
            'pager' => ['currentPage' => $model->pager->getCurrentPage(), 'pageCount' => $model->pager->getPageCount(), 'perPage' => $perPage],
        ]);
    }

    public function show($id = null)
    {
        $artikel = (new ArtikelModel())->withKategori()->where('id', $id)->first();
        return $artikel ? $this->respond($artikel) : $this->failNotFound('Artikel tidak ditemukan.');
    }

    public function create()
    {
        $data = $this->request->getJSON(true) ?: $this->request->getPost();
        $data['slug'] = url_title($data['judul'] ?? 'artikel', '-', true);
        (new ArtikelModel())->insert($data);
        return $this->respondCreated(['message' => 'Artikel berhasil ditambahkan.']);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true) ?: $this->request->getRawInput();
        if (isset($data['judul'])) {
            $data['slug'] = url_title($data['judul'], '-', true);
        }
        (new ArtikelModel())->update($id, $data);
        return $this->respond(['message' => 'Artikel berhasil diubah.']);
    }

    public function delete($id = null)
    {
        (new ArtikelModel())->delete($id);
        return $this->respondDeleted(['message' => 'Artikel berhasil dihapus.']);
    }
}
