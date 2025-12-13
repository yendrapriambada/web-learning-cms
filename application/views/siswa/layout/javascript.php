
<script src="<?= base_url();?>assets_siswa/js/jquery.min.js"></script>
<script src="<?= base_url();?>assets_siswa/js/popper.min.js"></script>
<script src="<?= base_url();?>assets_siswa/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url();?>assets_siswa/js/jquery-3.0.0.min.js"></script>
<script src="<?= base_url();?>assets_siswa/js/plugin.js"></script>

<!-- Datatable -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

<script>
$(document).ready(function() {
    $('.dropdown-submenu > a.dropdown-toggle').on("click", function(e) {

        // Tutup submenu lain
        $('.dropdown-submenu .dropdown-menu.show').removeClass('show');

        // Toggle submenu ini
        $(this).next('.dropdown-menu').toggleClass('show');

        // Agar menu tidak tertutup otomatis
        e.stopPropagation();
        e.preventDefault();
    });

    // Tutup semua submenu ketika dropdown utama ditutup
    $('.dropdown').on('hidden.bs.dropdown', function () {
        $('.dropdown-menu.show').removeClass('show');
    });
});
</script>