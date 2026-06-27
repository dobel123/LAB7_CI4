<?php

namespace AppModels;

use CodeIgniterModel;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'isi', 'status', 'slug', 'gambar', 'id_kategori', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function withKategori()
    {
        return $this->select('artikel.*, kategori.nama_kategori, kategori.slug_kategori')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');
    }
}
