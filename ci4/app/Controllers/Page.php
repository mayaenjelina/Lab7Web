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

    public function contact()
    {
        echo "Ini halaman Contact";
    }
}

