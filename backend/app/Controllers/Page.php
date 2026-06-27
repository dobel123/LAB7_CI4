<?php

namespace AppControllers;

class Page extends BaseController
{
    public function index()
    {
        return view('pages/home', ['title' => 'Home', 'content' => 'Selamat datang di aplikasi praktikum Lab 7 Web.']);
    }

    public function about()
    {
        return view('pages/about', ['title' => 'About', 'content' => 'Aplikasi ini dibuat untuk memenuhi praktikum Pemrograman Web 2.']);
    }

    public function contact()
    {
        return view('pages/contact', ['title' => 'Contact', 'content' => 'Hubungi administrator melalui email kampus.']);
    }
}
