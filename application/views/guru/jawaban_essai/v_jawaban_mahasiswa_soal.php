<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Soal <?= $soal->no_soal?> - Kelompok <?= htmlspecialchars($no_kelompok)?> | Pendidikan IPA Terpadu</title>

    <!-- CSS -->
    <?php $this->load->view('guru/layout/header')?>
    <!-- END CSS -->
    <style>
        .breadcrumb-nav { font-size: 13px; margin-bottom: 16px; }
        .breadcrumb-nav a { color: #3f51b5; text-decoration: none; }
        .breadcrumb-nav a:hover { text-decoration: underline; }
        .siswa-card { border: 1px solid #e0e0e0; border-radius: 8px; height: 100%; display: flex; flex-direction: column; }
        .siswa-card .sc-header { padding: 14px 18px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; }
        .siswa-card .sc-header h5 { margin: 0; font-size: 15px; font-weight: 700; }
        .siswa-card .sc-body { padding: 16px 18px; flex: 1; }
        .siswa-card .sc-footer { padding: 10px 18px; border-top: 1px solid #f0f0f0; text-align: right; }
        .section-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: #888; margin-bottom: 4px; }
        .jawaban-box { background: #f5f5f5; border-radius: 4px; padding: 10px 14px; margin-bottom: 12px; font-size: 13px; color: #444; white-space: pre-wrap; }
        .belum-jawab { text-align: center; color: #9e9e9e; padding: 20px 0; }
        .belum-jawab .material-icons { font-size: 36px; color: #d0d0d0; }
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
                <a href="<?= base_url().'guru/JawabanMahasiswa/detail/'.urlencode($no_kelompok)?>">Kelompok <?= htmlspecialchars($no_kelompok)?></a>
                <span class="text-muted"> / </span>
                <span>Soal <?= $soal->no_soal?></span>
            </div>

            <!-- Soal -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Pertemuan Ke-<?= $soal->no_pertemuan?> &mdash; <?= htmlspecialchars($soal->tahapan_pembelajaran)?></h2>
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
                                    <p class="mb-1"><b>Soal <?= $soal->no_soal?>.</b> <?= htmlspecialchars($soal->deksripsi_soal)?></p>
                                </div>
                                <div>
                                    <a href="<?= base_url().'guru/JawabanSiswa/bulk_edit/'.urlencode($no_kelompok)?>" class="btn btn-success waves-effect">
                                        <i class="material-icons">edit</i> Bulk Edit Kelompok Ini
                                    </a>
                                    <a href="<?= base_url().'guru/JawabanMahasiswa/detail/'.urlencode($no_kelompok)?>" class="btn btn-default waves-effect">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jawaban per mahasiswa -->
            <div class="row clearfix">
                <?php foreach ($jawabanList as $j): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="siswa-card">
                        <div class="sc-header">
                            <h5><?= htmlspecialchars($j->nama_lengkap)?></h5>
                            <?php if ($j->id_jawaban_essai && $j->nilai !== NULL): ?>
                            <?php $nilaiClass = $j->nilai >= 80 ? 'bg-green' : ($j->nilai >= 60 ? 'bg-orange' : 'bg-red'); ?>
                            <span class="badge <?= $nilaiClass?>">Nilai: <?= $j->nilai?></span>
                            <?php endif; ?>
                        </div>
                        <div class="sc-body">
                            <?php if (!$j->id_jawaban_essai): ?>
                            <div class="belum-jawab">
                                <i class="material-icons">hourglass_empty</i>
                                <p class="mb-0">Belum menjawab soal ini.</p>
                            </div>
                            <?php else: ?>
                            <div class="section-label">Jawaban</div>
                            <div class="jawaban-box"><?= htmlspecialchars($j->jawaban_text) ?: '-'?></div>

                            <?php if ($j->jawaban_gambar): ?>
                            <div class="section-label">Jawaban Gambar</div>
                            <a href="<?= base_url().'assets/jawaban_gambar/'.$j->jawaban_gambar?>" target="_blank">
                                <img src="<?= base_url().'assets/jawaban_gambar/'.$j->jawaban_gambar?>" style="max-width:100%; border-radius:4px; margin-bottom:12px;" alt="">
                            </a>
                            <?php endif; ?>

                            <?php if ($j->jawaban_file): ?>
                            <div class="section-label">Jawaban File</div>
                            <p class="mb-2"><a href="<?= base_url().'assets/jawaban_file/'.$j->jawaban_file?>" target="_blank">Lihat Dokumen: <?= htmlspecialchars($j->jawaban_file)?></a></p>
                            <?php endif; ?>

                            <div class="section-label">Feedback Dosen</div>
                            <p class="mb-2"><?= $j->feedback ? htmlspecialchars($j->feedback) : '<span class="text-muted">Belum ada feedback</span>'?></p>

                            <p class="text-muted mb-0" style="font-size:11px;">Diperbarui: <?= $j->updated_at ? date('d M Y H:i', strtotime($j->updated_at)) : '-'?></p>
                            <?php endif; ?>
                        </div>
                        <?php if ($j->id_jawaban_essai): ?>
                        <div class="sc-footer">
                            <a href="<?= base_url().'guru/JawabanSiswa/form_edit/'.$j->id_jawaban_essai?>" class="btn btn-warning btn-sm waves-effect" onclick="return confirm('Apakah Anda Yakin Akan Mengedit Data ini ?')">
                                <i class="material-icons">edit</i> Edit
                            </a>
                            <a href="<?= base_url().'guru/JawabanSiswa/delete/'.$j->id_jawaban_essai?>" class="btn btn-danger btn-sm waves-effect" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                                <i class="material-icons">delete_forever</i> Hapus
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php $this->load->view('guru/layout/javascript')?>
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
</body>
</html>
