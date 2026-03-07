<?php
namespace App\Controllers;

class Page extends BaseController
{
   public function about()
{
    return view('about', [
        'title' => 'Halaman About',
        'content' => 'Ini adalah halaman about yang menjelaskan tentang isi halaman ini.'
    ]);
}

    public function faqs()
    {
        echo "Ini Halaman FAQ";
    }

    public function tos()
    {
        echo "Ini halaman Terms of Service";
    }

    public function artikel()
{
    return view('artikel', [
        'title' => 'Halaman Artikel',
        'content' => 'Ini adalah halaman artikel yang berisi daftar tulisan.'
    ]);
}

public function contact()
{
    return view('contact', [
        'title' => 'Halaman Kontak',
        'content' => 'Anda bisa menghubungi kami melalui email: upbmaya@gmail.com'
    ]);
}
}

