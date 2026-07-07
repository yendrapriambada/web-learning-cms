<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Kelompok <?= htmlspecialchars($no_kelompok)?> - Jawaban Mahasiswa | Pendidikan IPA Terpadu</title>

    <!-- CSS -->
    <?php $this->load->view('guru/layout/header')?>
    <!-- END CSS -->
    <style>
        .breadcrumb-nav { font-size: 13px; margin-bottom: 16px; }
        .breadcrumb-nav a { color: #3f51b5; text-decoration: none; }
        .breadcrumb-nav a:hover { text-decoration: underline; }
        .pertemuan-block { margin-bottom: 28px; }
        .pertemuan-block h3 { font-size: 16px; font-weight: 700; margin-bottom: 4px; }
        .tahap-label { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: #888; margin: 16px 0 10px 0; border-left: 4px solid #4CAF50; padding-left: 10px; }
        .soal-summary-card { border: 1px solid #e0e0e0; border-radius: 8px; padding: 16px 18px; margin-bottom: 14px; transition: box-shadow .15s; }
        .soal-summary-card:hover { box-shadow: 0 2px 10px rgba(0,0,0,.08); }
        .soal-summary-card .soal-desc { color: #555; font-size: 13px; margin: 4px 0 12px 0; max-height: 3.2em; overflow: hidden; text-overflow: ellipsis; }
        .progress { height: 8px; border-radius: 4px; margin-bottom: 6px; }
        .soal-meta { font-size: 12px; color: #888; }
    </style>

<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left"><div class="circle"></div></div>
                    <div class="circle-clipper right"><div class="circle"></div></div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <div class="overlay"></div>
    <?php $this->load->view('guru/layout/navbar')?>
    <section>
        <?php $this->load->view('guru/layout/left_sidebar')?>
        <?php $this->load->view('guru/layout/right_sidebar')?>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Manajemen Worksheet</h2>
            </div>

            <div class="breadcrumb-nav">
                <a href="<?= base_url().'guru/JawabanMahasiswa'?>">Tampilan Kelompok</a>
                <span class="text-muted"> / </span>
                <span>Kelompok <?= htmlspecialchars($no_kelompok)?></span>
            </div>

            <!-- Info kelompok -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Kelompok <?= htmlspecialchars($no_kelompok)?></h2>
                        </div>
                        <div class="body">
                            <?php if ($this->session->flashdata('ver') == "FALSE") { ?>
                                <div class="alert alert-<?=$this->session->flashdata("class_alert");?>" role="alert">
                                <?= $this->session->flashdata('alert');
                                    $this->session->set_flashdata('ver', 'TRUE');
                                ?>
                                </div>
                            <?php } ?>
                            <div class="d-flex justify-content-between align-items-start flex-wrap">
                                <div>
                                    <div class="mb-1"><b>Anggota Kelompok</b></div>
                                    <ul class="list-inline mb-0">
                                        <?php foreach ($members as $m): ?>
                                        <li class="list-inline-item mb-1"><span class="badge bg-blue"><?= htmlspecialchars($m->nama_lengkap)?></span></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="mt-2">
                                    <a href="<?= base_url().'guru/JawabanSiswa/bulk_edit/'.urlencode($no_kelompok)?>" class="btn btn-success waves-effect">
                                        <i class="material-icons">edit</i> Bulk Edit Kelompok Ini
                                    </a>
                                    <a href="<?= base_url().'guru/JawabanMahasiswa'?>" class="btn btn-default waves-effect">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Soal -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Pilih Soal untuk Melihat Jawaban Tiap Mahasiswa</h2>
                        </div>
                        <div class="body">
                            <?php if (empty($soalList)): ?>
                            <div class="text-center text-muted" style="padding:40px 0;">
                                <i class="material-icons" style="font-size:48px; color:#d0d0d0;">assignment_late</i>
                                <p>Kelompok ini belum memiliki data jawaban worksheet.</p>
                            </div>
                            <?php else: ?>
                            <?php
                                $current_pertemuan = NULL;
                                $current_tahap = NULL;
                                $totalAnggota = count($members);
                                foreach ($soalList as $s):
                                    if ($s->no_pertemuan !== $current_pertemuan):
                                        if ($current_pertemuan !== NULL) echo '</div>';
                                        $current_pertemuan = $s->no_pertemuan;
                                        $current_tahap = NULL;
                            ?>
                            <div class="pertemuan-block">
                                <h3>Pertemuan Ke-<?= $s->no_pertemuan?> &mdash; <?= htmlspecialchars($s->judul_pertemuan)?></h3>
                            <?php endif; ?>

                            <?php if ($s->tahapan_pembelajaran !== $current_tahap):
                                $current_tahap = $s->tahapan_pembelajaran; ?>
                            <div class="tahap-label"><?= htmlspecialchars($s->tahapan_pembelajaran)?></div>
                            <?php endif; ?>

                            <?php
                                $terjawab = (int) $s->jumlah_terjawab;
                                $persen = $totalAnggota > 0 ? round(($terjawab / $totalAnggota) * 100) : 0;
                                $barClass = $persen >= 100 ? 'progress-bar-success' : ($persen > 0 ? 'progress-bar-warning' : 'progress-bar-danger');
                            ?>
                            <a href="<?= base_url().'guru/JawabanMahasiswa/soal/'.urlencode($no_kelompok).'/'.$s->id_soal?>" class="soal-summary-card d-block" style="text-decoration:none; color:inherit;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div style="flex:1;">
                                        <b>Soal <?= $s->no_soal?>.</b>
                                        <div class="soal-desc"><?= htmlspecialchars(mb_strimwidth(strip_tags($s->deksripsi_soal), 0, 160, '...'))?></div>
                                        <div class="progress">
                                            <div class="progress-bar <?= $barClass?>" style="width: <?= $persen?>%"></div>
                                        </div>
                                        <div class="soal-meta"><?= $terjawab?> dari <?= $totalAnggota?> anggota sudah menjawab</div>
                                    </div>
                                    <div class="text-right ml-3" style="min-width:110px;">
                                        <?php if ($s->rata_nilai !== NULL): ?>
                                        <?php
                                            $nilai = round($s->rata_nilai, 1);
                                            $nilaiClass = $nilai >= 80 ? 'text-success' : ($nilai >= 60 ? 'text-warning' : 'text-danger');
                                        ?>
                                        <div class="<?= $nilaiClass?>" style="font-size:20px; font-weight:700;"><?= $nilai?></div>
                                        <div class="text-muted" style="font-size:11px;">rata-rata nilai</div>
                                        <?php else: ?>
                                        <div class="text-muted" style="font-size:12px;">Belum ada nilai</div>
                                        <?php endif; ?>
                                        <i class="material-icons text-muted mt-1">chevron_right</i>
                                    </div>
                                </div>
                            </a>

                            <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php $this->load->view('guru/layout/javascript')?>
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
</body>
</html>
