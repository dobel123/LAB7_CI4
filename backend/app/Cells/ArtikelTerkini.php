<?php

namespace AppCells;

use AppModelsArtikelModel;

class ArtikelTerkini
{
    public function render($kategori_id = null)
    {
        $query = (new ArtikelModel())->where('status', 1)->orderBy('created_at', 'DESC')->limit(5);
        if ($kategori_id) {
            $query->where('id_kategori', $kategori_id);
        }
        return view('components/artikel_terkini', ['artikel' => $query->findAll()]);
    }
}
