<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
    <div id="container">
    <header>
        <h1>Admin Portal Berita</h1>
    </header>
    <nav>
        <?php 
            // Cara paling aman di CI4 mendeteksi segmen URL setelah domain utama
            $uri = current_url(true);
            $segment1 = $uri->getSegment(1); // menghasilkan 'admin'
            $segment2 = $uri->getSegment(2); // menghasilkan 'artikel'
            $segment3 = ($uri->getTotalSegments() >= 3) ? $uri->getSegment(3) : ''; // menghasilkan 'add' jika ada
        ?>
        
        <a href="<?= base_url('/admin/artikel');?>" class="<?= ($segment2 == 'artikel' && $segment3 != 'add') ? 'active' : ''; ?>">Dashboard</a>
        
        <a href="<?= base_url('/admin/artikel/add');?>" class="<?= ($segment3 == 'add') ? 'active' : ''; ?>">Tambah Artikel</a>
    </nav>
    <section id="wrapper">
        <section id="main"></section>