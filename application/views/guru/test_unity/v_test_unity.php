<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Manajemen Tes | Pendidikan IPA Terpadu</title>

    <!-- CSS -->
    <?php $this->load->view('guru/layout/header')?>
    <!-- END CSS -->
    <style>
        .sort-link { color: inherit; text-decoration: none; display: inline-flex; align-items: center; gap: 2px; white-space: nowrap; }
        .sort-link:hover { color: #3f51b5; text-decoration: none; }
        .sort-link .material-icons { font-size: 15px; }
        .sort-link.sort-active { color: #3f51b5; font-weight: 700; }
    </style>

</head>

<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <?php $this->load->view('guru/layout/navbar')?>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <?php $this->load->view('guru/layout/left_sidebar')?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <?php $this->load->view('guru/layout/right_sidebar')?>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Manajemen Tes
                </h2>
            </div>
            <!-- #END# Basic Examples -->
            <!-- Table User Siswa -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Tes Mahasiswa
                            </h2>
                        </div>
                        <div class="body">
                            <?php if ($this->session->flashdata('ver') == "FALSE") { ?>
                                <div class="alert alert-<?=$this->session->flashdata("class_alert");?>" role="alert">
                                <?= $this->session->flashdata('alert');
                                    $this->session->set_flashdata('ver', 'TRUE');
                                ?>
                                </div>
                            <?php } ?>

                            <div class="m-b-20">
                                <a href="<?= base_url().'guru/PenilaianTesKelompok'?>" class="btn btn-default waves-effect">
                                    <i class="material-icons" style="vertical-align:middle;">groups</i> Tampilan per Kelompok
                                </a>
                            </div>

                            <!-- Bulk Edit by Kelompok -->
                            <div class="row mb-3" style="background:#e8f5e9; border-radius:6px; padding:12px 16px; margin:0 0 16px 0;">
                                <div class="col-md-12 mb-1"><b><i class="material-icons" style="vertical-align:middle;font-size:18px;">group</i> Bulk Edit Nilai per Kelompok</b> <small class="text-muted">— input nilai sekali, berlaku untuk semua anggota</small></div>
                                <div class="col-md-4">
                                    <select id="kelompokBulk" class="form-control">
                                        <option value="">-- Pilih No. Kelompok --</option>
                                        <?php foreach ($kelompok_list as $k): ?>
                                        <option value="<?= htmlspecialchars($k->no_kelompok)?>"><?= htmlspecialchars($k->no_kelompok)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success waves-effect" onclick="goToBulkEdit()">
                                        <i class="material-icons">edit</i> Bulk Edit
                                    </button>
                                </div>
                            </div>

                            <!-- Filter -->
                            <form method="GET" action="<?= base_url().'guru/TestUnity'?>" id="filterForm">
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label>Nama Mahasiswa</label>
                                    <select name="nama_lengkap" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <?php foreach ($filter_names as $f): ?>
                                        <option value="<?= htmlspecialchars($f->nama_lengkap)?>" <?= $filters['nama_lengkap']==$f->nama_lengkap?'selected':''?>><?= htmlspecialchars($f->nama_lengkap)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>No. Kelompok</label>
                                    <select name="no_kelompok" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <?php foreach ($filter_kelompok as $f): ?>
                                        <option value="<?= htmlspecialchars($f->no_kelompok)?>" <?= $filters['no_kelompok']==$f->no_kelompok?'selected':''?>><?= htmlspecialchars($f->no_kelompok)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Angkatan</label>
                                    <select name="angkatan" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <?php foreach ($filter_angkatan as $f): ?>
                                        <option value="<?= htmlspecialchars($f->angkatan)?>" <?= $filters['angkatan']==$f->angkatan?'selected':''?>><?= htmlspecialchars($f->angkatan)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <?php foreach ($filter_gender as $f): ?>
                                        <option value="<?= htmlspecialchars($f->jenis_kelamin)?>" <?= $filters['jenis_kelamin']==$f->jenis_kelamin?'selected':''?>><?= htmlspecialchars($f->jenis_kelamin)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Practice</label>
                                    <select name="practice" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <?php foreach ($filter_practice as $f): ?>
                                        <option value="<?= htmlspecialchars($f->practice)?>" <?= $filters['practice']==$f->practice?'selected':''?>><?= htmlspecialchars($f->practice)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Status Nilai</label>
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <option value="dinilai" <?= $filters['status']=='dinilai'?'selected':''?>>Sudah Dinilai</option>
                                        <option value="belum_dinilai" <?= $filters['status']=='belum_dinilai'?'selected':''?>>Belum Dinilai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2">
                                <a href="<?= base_url().'guru/TestUnity'?>" class="btn btn-default waves-effect">Reset Filter</a>
                                <span class="ml-3 text-muted">Menampilkan <?= count($testUnity)?> dari <?= $total?> data</span>
                            </div>
                            </form>
                            <br>
                            <?php
                                $sortBase = base_url().'guru/TestUnity?';
                                if (!function_exists('sortHeaderTestUnity')) {
                                    function sortHeaderTestUnity($label, $col, $sort, $dir, $filters, $sortBase) {
                                        $newDir = ($sort === $col && $dir === 'ASC') ? 'DESC' : 'ASC';
                                        $href = $sortBase.http_build_query(array_merge($filters, ['sort' => $col, 'dir' => $newDir]));
                                        $icon = 'unfold_more';
                                        if ($sort === $col) $icon = $dir === 'ASC' ? 'arrow_upward' : 'arrow_downward';
                                        $active = $sort === $col ? 'sort-active' : '';
                                        return '<a href="'.$href.'" class="sort-link '.$active.'">'.$label.' <i class="material-icons">'.$icon.'</i></a>';
                                    }
                                }
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="testUnityTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center"><?= sortHeaderTestUnity('Nama Lengkap', 'nama_lengkap', $sort, $dir, $filters, $sortBase)?></th>
                                            <th class="text-center"><?= sortHeaderTestUnity('No. Kelompok', 'no_kelompok', $sort, $dir, $filters, $sortBase)?></th>
                                            <th class="text-center"><?= sortHeaderTestUnity('Jenis Kelamin', 'jenis_kelamin', $sort, $dir, $filters, $sortBase)?></th>
                                            <th class="text-center"><?= sortHeaderTestUnity('Angkatan', 'angkatan', $sort, $dir, $filters, $sortBase)?></th>
                                            <th class="text-center"><?= sortHeaderTestUnity('Practice', 'practice', $sort, $dir, $filters, $sortBase)?></th>
                                            <th class="text-center">Indikator Soal</th>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Jawaban</th>
                                            <th class="text-center"><?= sortHeaderTestUnity('Nilai', 'nilai', $sort, $dir, $filters, $sortBase)?></th>
                                            <th class="text-center">Feedback</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($testUnity as $s) :?>
                                            <tr>
                                                <td class="text-center align-top"><?= $no?></td>
                                                <td class="align-top"><?= $s->nama_lengkap?></td>
                                                <td class="align-top"><?= $s->no_kelompok?></td>
                                                <td class="text-center align-top"><?= $s->jenis_kelamin?></td>
                                                <td class="text-center align-top"><?= $s->angkatan?></td>
                                                <td class="align-top"><?= htmlspecialchars(M_test_unity::normalizePractice($s->practice))?></td>
                                                <td class="align-top"><?= $s->indikator_soal?></td>
                                                <td class="text-center align-top"><?= $s->pertanyaan?></td>
                                                <td class="align-top"><?= $s->jawaban?></td>
                                                <td class="align-top"><?= $s->nilai?></td>
                                                <td class="align-top"><?= $s->feedback?></td>
                                                <td>
                                                    <a class="dropdown-item btn btn-warning" onclick="return confirm ('Apakah Anda Yakin Akan Mengedit Data ini ?')"  href="<?= base_url().'guru/TestUnity/form_edit/'. $s->id_test_unity?>" title="Edit Data">
                                                        <i class="material-icons">edit</i></a>
                                                    <a class="dropdown-item btn btn-danger" onclick="return confirm ('Apakah Anda Yakin Akan Menghapus Data ini ?')"  href="<?= base_url().'guru/TestUnity/delete/'. $s->id_test_unity?>" title="Hapus Permanen">
                                                        <i class="material-icons">delete_forever</i></a>
                                                </td>
                                            </tr>
                                        <?php $no++; endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <?php if ($total_pages > 1): ?>
                            <?php
                                $q = array_merge($filters, ['sort' => $sort, 'dir' => $dir]);
                                $base = base_url().'guru/TestUnity?';
                            ?>
                            <nav>
                                <ul class="pagination">
                                    <li class="<?= $current_page <= 1 ? 'disabled' : ''?>">
                                        <a href="<?= $base.http_build_query(array_merge($q, ['page' => $current_page - 1]))?>">&laquo;</a>
                                    </li>
                                    <?php for ($i = max(1, $current_page-2); $i <= min($total_pages, $current_page+2); $i++): ?>
                                    <li class="<?= $i == $current_page ? 'active' : ''?>">
                                        <a href="<?= $base.http_build_query(array_merge($q, ['page' => $i]))?>"><?= $i?></a>
                                    </li>
                                    <?php endfor; ?>
                                    <li class="<?= $current_page >= $total_pages ? 'disabled' : ''?>">
                                        <a href="<?= $base.http_build_query(array_merge($q, ['page' => $current_page + 1]))?>">&raquo;</a>
                                    </li>
                                </ul>
                            </nav>
                            <?php endif; ?>
                            <!-- END Pagination -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

    <!-- JS -->
    <?php $this->load->view('guru/layout/javascript')?>
    <!-- JS -->

    <!-- Custom Js -->
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
    <script>
        function goToBulkEdit() {
            var k = document.getElementById('kelompokBulk').value;
            if (!k) { alert('Pilih nomor kelompok terlebih dahulu'); return; }
            window.location.href = '<?= base_url().'guru/TestUnity/bulk_edit/'?>' + encodeURIComponent(k);
        }
        $(function () {
            $('#testUnityTable').DataTable({
                dom: 'Bt',
                paging: false,
                searching: false,
                info: false,
                ordering: false,
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });
    </script>
</body>

</html>
