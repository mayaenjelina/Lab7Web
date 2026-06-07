<?= $this->include('template/admin_header'); ?>

<div class="container-fluid mt-4">
    <div class="mb-4 pb-2 border-bottom">
        <h2><?= $title; ?></h2>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="m-0 fw-bold text-primary">Kelola Artikel</h6>
                </div>
                <div class="card-body">
                    
                    <form id="search-form" class="row g-2 mb-4">
                        <div class="col-sm-4">
                            <input type="text" name="q" id="search-box" value="<?= $q; ?>" placeholder="Cari judul artikel..." class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <select name="kategori_id" id="category-filter" class="form-select">
                                <option value="">-- Semua Kategori --</option>
                                <?php foreach ($kategori as $k): ?>
                                    <option value="<?= $k['id_kategori']; ?>" <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>>
                                        <?= $k['nama_kategori']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select name="sort" id="sort-filter" class="form-select">
                                <option value="terbaru" <?= (isset($sort) && $sort == 'terbaru') ? 'selected' : ''; ?>>-- Urutkan: Terbaru --</option>
                                <option value="judul_asc" <?= (isset($sort) && $sort == 'judul_asc') ? 'selected' : ''; ?>>Judul (A - Z)</option>
                                <option value="judul_desc" <?= (isset($sort) && $sort == 'judul_desc') ? 'selected' : ''; ?>>Judul (Z - A)</option>
                            </select>
                        </div>
                        <div class="col-sm-2 d-grid">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>

                    <div class="table-responsive" id="article-container">
                    </div>

                    <div class="pagination-wrapper mt-4" id="pagination-container">
                    </div>

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
    .pagination-wrapper li.active a, .pagination-wrapper li.active span {
        background-color: #0d6efd !important;
        color: white !important;
        border-color: #0d6efd !important;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const articleContainer = $('#article-container');
    const paginationContainer = $('#pagination-container');
    const searchForm = $('#search-form');
    const searchBox = $('#search-box');
    const categoryFilter = $('#category-filter');
    const sortFilter = $('#sort-filter');

    // Fungsi fetch data via AJAX
    const fetchData = (url) => {
        // TUGAS MANDIRI 3: Indikator loading berupa spinner
        articleContainer.html(`
            <div class="text-center py-5 text-muted">
                <div class="spinner-border text-primary mb-2" role="status"></div>
                <div>Sedang mengambil data dari server...</div>
            </div>
        `);
        
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(data) {
                renderArticles(data.artikel, data.pager.currentPage);
                renderPagination(data.pager, data.q, data.kategori_id, data.sort);
            },
            error: function(xhr, status, error) {
                articleContainer.html(`
                    <div class="text-center py-5 text-danger">
                        Gagal memuat data dari server. Pastikan controller sudah benar.
                    </div>
                `);
            }
        });
    };

    // Fungsi Render Tabel memakai format Bootstrap 5
    const renderArticles = (articles, currentPage) => {
        let html = '<table class="table table-hover table-bordered align-middle mb-0">';
        html += `<thead class="table-light">
                    <tr>
                        <th width="60" class="text-center">No</th>
                        <th>Informasi Artikel</th>
                        <th width="150">Kategori</th>
                        <th width="90" class="text-center">Status</th>
                        <th width="130" class="text-center">Aksi</th>
                    </tr>
                </thead><tbody>`;

        if (articles.length > 0) {
            let no = (currentPage - 1) * 10 + 1; 

            articles.forEach(row => {
                let badgeStatus = row.status == 1 ? 'bg-success' : 'bg-secondary';
                let textStatus = row.status == 1 ? 'Aktif' : 'Draft';
                let kategori = row.nama_kategori ? row.nama_kategori : 'Umum';

                html += `
                <tr>
                    <td class="text-center text-muted">${no++}</td>
                    <td>
                        <div class="fw-bold text-dark mb-1">${row.judul}</div>
                        <div class="text-muted small text-truncate" style="max-width: 450px;">
                            ${row.isi.replace(/(<([^>]+)>)/gi, "")}
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border px-2 py-1.5">${kategori}</span>
                    </td>
                    <td class="text-center">
                        <span class="badge ${badgeStatus}">${textStatus}</span>
                    </td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-outline-primary" href="/admin/artikel/edit/${row.id}">Ubah</a>
                            <a class="btn btn-outline-danger" onclick="return confirm('Yakin menghapus data?');" href="/admin/artikel/delete/${row.id}">Hapus</a>
                        </div>
                    </td>
                </tr>`;
            });
        } else {
            html += '<tr><td colspan="5" class="text-center py-4 text-muted">Tidak ada artikel ditemukan.</td></tr>';
        }

        html += '</tbody></table>';
        articleContainer.html(html);
    };

    // Fungsi Render Pagination
    const renderPagination = (pager, q, kategori_id, sort) => {
        let html = '<ul class="pagination justify-content-center">';
        
        if (pager && pager.links) {
            pager.links.forEach(link => {
                let url = link.url ? `${link.url}&q=${q}&kategori_id=${kategori_id}&sort=${sort}` : '#';
                
                html += `
                <li class="page-item ${link.active ? 'active' : ''}">
                    <a class="page-link ajax-page" href="${url}">${link.title}</a>
                </li>`;
            });
        }
        
        html += '</ul>';
        paginationContainer.html(html);
    };

    // Event saat form submit
    searchForm.on('submit', function(e) {
        e.preventDefault();
        fetchData(`/admin/artikel?q=${searchBox.val()}&kategori_id=${categoryFilter.val()}&sort=${sortFilter.val()}`);
    });

    // Otomatis cari saat dropdown Kategori diubah
    categoryFilter.on('change', function() {
        searchForm.trigger('submit');
    });

    // Otomatis cari saat dropdown urutan Sorting diubah
    sortFilter.on('change', function() {
        searchForm.trigger('submit');
    });

    // Deteksi klik pagination secara AJAX
    $(document).on('click', '.ajax-page', function(e) {
        e.preventDefault();
        let targetUrl = $(this).attr('href');
        if (targetUrl !== '#') fetchData(targetUrl);
    });

    // Jalankan load data pertama kali otomatis
    fetchData('/admin/artikel');
});
</script>

<?= $this->include('template/admin_footer'); ?>