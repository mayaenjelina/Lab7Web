<?= $this->include('template/header'); ?>

<div class="container" style="margin-top: 20px;">
    <h1>Data Artikel (AJAX)</h1>
    
    <table class="table-data" id="artikelTable" border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            </tbody>
    </table>
</div>

<script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>

<script>
$(document).ready(function() {
    
    // 1. Fungsi menampilkan pesan loading saat mengambil data
    function showLoadingMessage() {
        $('#artikelTable tbody').html('<tr><td colspan="4" style="text-align:center;">Loading data...</td></tr>');
    }

    // 2. Fungsi Utama untuk mengambil data via AJAX
    function loadData() {
        showLoadingMessage();
        
        $.ajax({
            url: "<?= base_url('ajax/getData') ?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                var tableBody = "";
                
                if(data.length === 0) {
                    tableBody = '<tr><td colspan="4" style="text-align:center;">Tidak ada data artikel.</td></tr>';
                } else {
                    // Looping data yang dikirim server
                    for (var i = 0; i < data.length; i++) {
                        var row = data[i];
                        tableBody += '<tr>';
                        tableBody += '<td>' + row.id + '</td>';
                        tableBody += '<td>' + row.judul + '</td>';
                        tableBody += '<td><span class="status">Active</span></td>';
                        tableBody += '<td>';
                        // Tombol Edit
                        tableBody += '<a href="<?= base_url('artikel/edit/') ?>' + row.id + '" class="btn btn-primary" style="margin-right:5px;">Edit</a>';
                        // Tombol Delete dengan data-id artikel
                        tableBody += '<a href="#" class="btn btn-danger btn-delete" data-id="' + row.id + '">Delete</a>';
                        tableBody += '</td>';
                        tableBody += '</tr>';
                    }
                }
                // Masukkan baris baru ke dalam tabel body
                $('#artikelTable tbody').html(tableBody);
            },
            error: function() {
                $('#artikelTable tbody').html('<tr><td colspan="4" style="text-align:center; color:red;">Gagal memuat data dari database.</td></tr>');
            }
        });
    }

    // Jalankan fungsi loadData saat pertama kali halaman dibuka
    loadData();

    // 3. Logika AJAX untuk Hapus Data (Event Trigger)
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        
        var id = $(this).data('id'); // Mengambil ID dari tombol yang diklik
        
        if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
            $.ajax({
                url: "<?= base_url('ajax/delete/') ?>" + id,
                method: "DELETE",
                dataType: "json",
                success: function(response) {
                    if(response.status === 'OK') {
                        alert(response.message);
                        loadData(); // Memanggil kembali loadData untuk memperbarui tabel tanpa reload halaman!
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Gagal menghapus artikel: ' + textStatus + ' - ' + errorThrown);
                }
            });
        }
    });

});
</script>

<?= $this->include('template/footer'); ?>