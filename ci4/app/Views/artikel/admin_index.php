<?= $this->include('template/admin_header'); ?>

<div class="container-fluid mt-4">
    <div class="mb-4 pb-2 border-bottom">
        <h2><?= $title; ?></h2>
    </div>

    <div class="row">
        
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom">
                </div>
                <div class="card-body">
                    
                    <form method="get" action="<?= base_url('admin/artikel'); ?>" class="row g-2 mb-4">
                        <div class="col-sm-6">
                            <input type="text" name="q" value="<?= $q; ?>" placeholder="Cari judul artikel..." class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <select name="kategori_id" class="form-select">
                                <option value="">-- Semua Kategori --</option>
                                <?php foreach ($kategori as $k): ?>
                                    <option value="<?= $k['id_kategori']; ?>" <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>>
                                        <?= $k['nama_kategori']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-2 d-grid">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="60" class="text-center">No</th>
                                    <th>Informasi Artikel</th>
                                    <th width="150">Kategori</th>
                                    <th width="90" class="text-center">Status</th>
                                    <th width="130" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($artikel) > 0): ?>
                                    <?php 
                                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                        $no = ($page - 1) * 10 + 1; 
                                    ?>
                                    <?php foreach ($artikel as $row): ?>
                                    <tr>
                                        <td class="text-center text-muted"><?= $no++; ?></td>
                                        <td>
                                            <div class="fw-bold text-dark mb-1"><?= $row['judul']; ?></div>
                                            <div class="text-muted small text-truncate" style="max-width: 320px;">
                                                <?= strip_tags($row['isi']); ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-2 py-1.5">
                                                <?= $row['nama_kategori'] ?? 'Umum'; ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge <?= ($row['status'] == 1) ? 'bg-success' : 'bg-secondary'; ?>">
                                                <?= ($row['status'] == 1) ? 'Aktif' : 'Draft'; ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a class="btn btn-outline-primary" href="<?= base_url('admin/artikel/edit/' . $row['id']); ?>">Ubah</a>
                                                <a class="btn btn-outline-danger" onclick="return confirm('Yakin menghapus data?');" href="<?= base_url('admin/artikel/delete/' . $row['id']); ?>">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">Tidak ada artikel ditemukan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if (isset($pager)): ?>
                        <div class="pagination-wrapper mt-4">
                            <?= $pager->only(['q', 'kategori_id'])->links(); ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .pagination-wrapper ul {
        display: flex !important;
        list-style: none !important;
        padding-left: 0 !important;
        justify-content: center !important;
        margin-bottom: 0;
    }
    .pagination-wrapper li {
        margin: 0 4px !important;
    }
    .pagination-wrapper li a, .pagination-wrapper li span {
        display: block !important;
        padding: 6px 12px !important;
        border: 1px solid #dee2e6 !important;
        color: #0d6efd !important;
        text-decoration: none !important;
        border-radius: 4px !important;
    }
    .pagination-wrapper li.active span {
        background-color: #0d6efd !important;
        color: white !important;
        border-color: #0d6efd !important;
    }
</style>

<?= $this->include('template/admin_footer'); ?>