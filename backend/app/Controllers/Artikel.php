<?php

namespace AppControllers;

use AppModelsArtikelModel;
use AppModelsKategoriModel;

class Artikel extends BaseController
{
    public function index()
    {
        $artikel = (new ArtikelModel())->withKategori()->where('status', 1)->orderBy('created_at', 'DESC')->findAll();
        return view('artikel/index', ['title' => 'Daftar Artikel', 'artikel' => $artikel]);
    }

    public function detail($slug)
    {
        $artikel = (new ArtikelModel())->withKategori()->where('slug', $slug)->where('status', 1)->first();
        if (!$artikel) {
            throw CodeIgniterExceptionsPageNotFoundException::forPageNotFound();
        }
        return view('artikel/detail', ['title' => $artikel['judul'], 'artikel' => $artikel]);
    }

    public function kategori($slug)
    {
        $kategori = (new KategoriModel())->where('slug_kategori', $slug)->first();
        if (!$kategori) {
            throw CodeIgniterExceptionsPageNotFoundException::forPageNotFound();
        }
        $artikel = (new ArtikelModel())->withKategori()->where('artikel.id_kategori', $kategori['id_kategori'])->where('status', 1)->findAll();
        return view('artikel/index', ['title' => 'Kategori: ' . $kategori['nama_kategori'], 'artikel' => $artikel]);
    }

    public function admin_index()
    {
        $keyword = $this->request->getGet('q');
        $sort = $this->request->getGet('sort') ?: 'created_at';
        $order = $this->request->getGet('order') ?: 'DESC';
        $model = new ArtikelModel();
        $query = $model->withKategori();
        if ($keyword) {
            $query->groupStart()->like('judul', $keyword)->orLike('isi', $keyword)->groupEnd();
        }
        return view('artikel/admin_index', [
            'title' => 'Admin Artikel',
            'artikel' => $query->orderBy($sort, $order)->paginate(5, 'artikel'),
            'pager' => $model->pager,
            'q' => $keyword,
            'sort' => $sort,
            'order' => $order,
        ]);
    }

    public function add()
    {
        if ($this->request->getMethod() === 'post') {
            $this->saveArtikel();
            return redirect()->to('/admin/artikel');
        }
        return view('artikel/form', ['title' => 'Tambah Artikel', 'artikel' => null, 'kategori' => (new KategoriModel())->findAll()]);
    }

    public function edit($id)
    {
        $model = new ArtikelModel();
        $artikel = $model->find($id);
        if (!$artikel) {
            throw CodeIgniterExceptionsPageNotFoundException::forPageNotFound();
        }
        if ($this->request->getMethod() === 'post') {
            $this->saveArtikel($id, $artikel['gambar'] ?? null);
            return redirect()->to('/admin/artikel');
        }
        return view('artikel/form', ['title' => 'Ubah Artikel', 'artikel' => $artikel, 'kategori' => (new KategoriModel())->findAll()]);
    }

    public function delete($id)
    {
        (new ArtikelModel())->delete($id);
        return redirect()->to('/admin/artikel');
    }

    private function saveArtikel($id = null, $currentImage = null)
    {
        $judul = $this->request->getPost('judul');
        $gambar = $currentImage ?: 'default.jpg';
        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $gambar = $file->getRandomName();
            $file->move(ROOTPATH . 'public/gambar', $gambar);
        }
        $payload = [
            'judul' => $judul,
            'isi' => $this->request->getPost('isi'),
            'status' => (int) $this->request->getPost('status'),
            'slug' => url_title($judul, '-', true),
            'gambar' => $gambar,
            'id_kategori' => $this->request->getPost('id_kategori'),
        ];
        $model = new ArtikelModel();
        $id ? $model->update($id, $payload) : $model->insert($payload);
    }
}
