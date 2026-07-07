<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Jawaban Mahasiswa - Tampilan Kelompok | Pendidikan IPA Terpadu</title>

    <!-- CSS -->
    <?php $this->load->view('guru/layout/header')?>
    <!-- END CSS -->
    <style>
        .view-switch { display: inline-flex; border: 1px solid #e0e0e0; border-radius: 6px; overflow: hidden; margin-bottom: 20px; }
        .view-switch a { padding: 8px 18px; color: #555; text-decoration: none; font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 6px; }
        .view-switch a.active { background: #3f51b5; color: #fff; }
        .view-switch a:not(.active):hover { background: #f5f5f5; }
        .kelompok-card { border: 1px solid #e0e0e0; border-radius: 8px; transition: box-shadow .15s, transform .15s; height: 100%; display: flex; flex-direction: column; }
        .kelompok-card:hover { box-shadow: 0 4px 14px rgba(0,0,0,.1); transform: translateY(-2px); }
        .kelompok-card .kc-header { padding: 16px 18px 10px 18px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; }
        .kelompok-card .kc-header h4 { margin: 0; font-size: 17px; font-weight: 700; }
        .kelompok-card .kc-body { padding: 14px 18px; flex: 1; }
        .kc-stat-row { display: flex; align-items: center; gap: 8px; margin-bottom: 10px; font-size: 13px; color: #555; }
        .kc-stat-row .material-icons { font-size: 18px; color: #9e9e9e; }
        .kc-nilai { font-size: 22px; font-weight: 700; }
        .kc-nilai-empty { font-size: 13px; color: #9e9e9e; font-weight: 400; }
        .kelompok-card .kc-footer { padding: 12px 18px; border-top: 1px solid #f0f0f0; display: flex; gap: 8px; }
        .kelompok-card .kc-footer .btn { flex: 1; margin: 0; }
        .empty-state { text-align: center; padding: 60px 20px; color: #9e9e9e; }
        .empty-state .material-icons { font-size: 56px; color: #d0d0d0; }
    </style>

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
                    Manajemen Worksheet
                </h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <!-- View Switch -->
                    <div class="view-switch">
                        <a href="<?= base_url().'guru/JawabanSiswa'?>"><i class="material-icons">table_chart</i> Tampilan Tabel</a>
                        <a href="<?= base_url().'guru/JawabanMahasiswa'?>" class="active"><i class="material-icons">groups</i> Tampilan Kelompok</a>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Jawaban Worksheet — Per Kelompok
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

                            <p class="text-muted">Pilih kelompok untuk melihat rincian soal dan jawaban tiap anggota. Satu kali input nilai/feedback berlaku untuk seluruh anggota kelompok.</p>

                            <!-- Filter -->
                            <form method="GET" action="<?= base_url().'guru/JawabanMahasiswa'?>" id="filterForm">
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label>Cari No. Kelompok</label>
                                    <input type="text" name="no_kelompok" class="form-control" placeholder="Contoh: 3" value="<?= htmlspecialchars($filters['no_kelompok'] ?? '')?>">
                                </div>
                                <div class="col-md-3">
                                    <label>Angkatan</label>
                                    <select name="angkatan" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <?php foreach ($filter_angkatan as $f): ?>
                                        <option value="<?= htmlspecialchars($f->angkatan)?>" <?= $filters['angkatan']==$f->angkatan?'selected':''?>><?= htmlspecialchars($f->angkatan)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary waves-effect mr-2"><i class="material-icons" style="vertical-align:middle;font-size:18px;">search</i> Cari</button>
                                    <a href="<?= base_url().'guru/JawabanMahasiswa'?>" class="btn btn-default waves-effect">Reset</a>
                                </div>
                            </div>
                            </form>
                            <p class="text-muted mb-3">Menampilkan <?= count($kelompokList)?> kelompok</p>

                            <!-- Kelompok Cards -->
                            <?php if (empty($kelompokList)): ?>
                            <div class="empty-state">
                                <i class="material-icons">groups</i>
                                <p>Belum ada kelompok yang ditemukan.</p>
                            </div>
                            <?php else: ?>
                            <div class="row clearfix">
                                <?php foreach ($kelompokList as $k): ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">
                                    <div class="kelompok-card">
                                        <div class="kc-header">
                                            <h4>Kelompok <?= htmlspecialchars($k->no_kelompok)?></h4>
                                            <?php if (!empty($k->angkatan)): ?>
                                            <span class="badge bg-blue">Angkatan <?= htmlspecialchars($k->angkatan)?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="kc-body">
                                            <div class="kc-stat-row">
                                                <i class="material-icons">group</i>
                                                <span><?= (int) $k->jumlah_anggota?> Anggota</span>
                                            </div>
                                            <div class="kc-stat-row">
                                                <i class="material-icons">assignment_turned_in</i>
                                                <span><?= (int) $k->jumlah_soal_terjawab?> Soal Disentuh</span>
                                            </div>
                                            <div class="kc-stat-row">
                                                <i class="material-icons">schedule</i>
                                                <span><?= $k->last_update ? date('d M Y H:i', strtotime($k->last_update)) : 'Belum ada aktivitas'?></span>
                                            </div>
                                            <hr class="mt-2 mb-2">
                                            <?php if ($k->rata_nilai !== NULL): ?>
                                            <?php
                                                $nilai = round($k->rata_nilai, 1);
                                                $nilaiClass = $nilai >= 80 ? 'text-success' : ($nilai >= 60 ? 'text-warning' : 'text-danger');
                                            ?>
                                            <span class="kc-nilai <?= $nilaiClass?>"><?= $nilai?></span> <span class="text-muted" style="font-size:12px;">rata-rata nilai</span>
                                            <?php else: ?>
                                            <span class="kc-nilai-empty">Belum ada nilai</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="kc-footer">
                                            <a href="<?= base_url().'guru/JawabanMahasiswa/detail/'.urlencode($k->no_kelompok)?>" class="btn btn-primary waves-effect">
                                                <i class="material-icons">visibility</i> Lihat Detail
                                            </a>
                                            <a href="<?= base_url().'guru/JawabanSiswa/bulk_edit/'.urlencode($k->no_kelompok)?>" class="btn btn-default waves-effect" title="Bulk Edit Nilai Kelompok Ini">
                                                <i class="material-icons">edit</i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JS -->
    <?php $this->load->view('guru/layout/javascript')?>
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
</body>

</html>
