<?= $this->include('template/admin_header'); ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title mb-0 fw-semibold text-dark"><?= $title; ?></h5>
                </div>
                <div class="card-body">
                    
                    <form action="" method="post">
                        <?= csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-medium">Judul Artikel</label>
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul artikel" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_kategori" class="form-label fw-medium">Kategori Artikel</label>
                            <div class="input-group">
                                <select name="id_kategori" id="id_kategori" class="form-select" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php foreach ($kategori as $k): ?>
                                        <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                                    + Kelola Kategori
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="isi" class="form-label fw-medium">Isi Artikel</label>
                            <textarea name="isi" id="isi" rows="8" class="form-control" placeholder="Tuliskan isi konten artikel di sini..."></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/artikel'); ?>" class="btn btn-light border">Kembali</a>
                            <button type="submit" class="btn btn-primary px-4">Simpan Artikel</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahKategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalKategoriLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalKategoriLabel">Manajemen Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form action="<?= base_url('admin/artikel/add_kategori_cepat'); ?>" method="post" class="mb-4">
                    <?= csrf_field(); ?>
                    <label for="nama_kategori" class="form-label fw-semibold small">Tambah Kategori Baru</label>
                    <div class="input-group">
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="Nama kategori baru..." required>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

                <hr>

                <label class="form-label fw-semibold small mb-2">Daftar Kategori Saat Ini</label>
                <div style="max-height: 200px; overflow-y: auto;" class="border rounded p-2 bg-light">
                    <table class="table table-sm table-hover align-middle mb-0">
                        <tbody>
                            <?php if (count($kategori) > 0): ?>
                                <?php foreach ($kategori as $k): ?>
                                    <tr>
                                        <td class="ps-2 text-dark"><?= $k['nama_kategori']; ?></td>
                                        <td class="text-end pe-2" width="80">
                                            <a href="<?= base_url('admin/artikel/delete_kategori/' . $k['id_kategori']); ?>" 
                                               class="btn btn-sm btn-outline-danger py-0 px-2" 
                                               onclick="return confirm('Hapus kategori ini? Artikel dengan kategori ini akan berubah menjadi Umum.');"
                                               style="font-size: 11px;">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center text-muted small py-2">Belum ada kategori.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->include('template/admin_footer'); ?>