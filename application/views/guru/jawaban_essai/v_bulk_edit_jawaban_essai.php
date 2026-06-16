<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Bulk Edit Kelompok <?= $no_kelompok?> | Pendidikan IPA Terpadu</title>
    <?php $this->load->view('guru/layout/header')?>
</head>
<body class="theme-indigo">
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
    <div class="overlay"></div>
    <?php $this->load->view('guru/layout/navbar')?>
    <section>
        <?php $this->load->view('guru/layout/left_sidebar')?>
        <?php $this->load->view('guru/layout/right_sidebar')?>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Bulk Edit Nilai Worksheet — Kelompok <?= htmlspecialchars($no_kelompok)?></h2>
            </div>

            <!-- Anggota kelompok -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header"><h2>Anggota Kelompok <?= htmlspecialchars($no_kelompok)?></h2></div>
                        <div class="body">
                            <?php if (!empty($members)): ?>
                            <ul class="list-inline">
                                <?php foreach ($members as $m): ?>
                                <li class="list-inline-item"><span class="badge bg-blue"><?= htmlspecialchars($m->nama_lengkap)?></span></li>
                                <?php endforeach; ?>
                            </ul>
                            <p class="text-muted">Nilai dan feedback yang diisi akan diterapkan ke semua anggota kelompok di atas.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form bulk edit -->
            <form method="POST" action="<?= base_url().'guru/JawabanSiswa/do_bulk_edit'?>">
                <input type="hidden" name="no_kelompok" value="<?= htmlspecialchars($no_kelompok)?>">

                <?php
                $current_pertemuan = NULL;
                $current_tahap     = NULL;
                $i = 0;
                foreach ($soalList as $s):
                    if ($s->no_pertemuan !== $current_pertemuan):
                        if ($current_pertemuan !== NULL) echo '</div></div></div>'; // close card body/card
                        $current_pertemuan = $s->no_pertemuan;
                        $current_tahap     = NULL;
                ?>
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header"><h2>Pertemuan Ke-<?= $s->no_pertemuan?> &mdash; <?= htmlspecialchars($s->judul_pertemuan)?></h2></div>
                            <div class="body">
                <?php endif; ?>

                <?php if ($s->tahapan_pembelajaran !== $current_tahap):
                    $current_tahap = $s->tahapan_pembelajaran; ?>
                            <h4 class="mt-3 mb-2" style="border-left:4px solid #4CAF50; padding-left:10px;"><?= htmlspecialchars($s->tahapan_pembelajaran)?></h4>
                <?php endif; ?>

                            <!-- Soal card -->
                            <div class="card" style="border:1px solid #e0e0e0; margin-bottom:16px;">
                                <div class="body" style="padding:16px;">
                                    <input type="hidden" name="id_soal[<?= $i?>]" value="<?= $s->id_soal?>">

                                    <p><b>Soal <?= $s->no_soal?>.</b> <?= htmlspecialchars($s->deksripsi_soal)?></p>

                                    <!-- Preview jawaban -->
                                    <?php if ($s->jawaban_text): ?>
                                    <div class="well well-sm" style="background:#f5f5f5; border-radius:4px; padding:10px; margin-bottom:10px;">
                                        <small class="text-muted">Contoh jawaban:</small>
                                        <p class="mb-0"><?= nl2br(htmlspecialchars($s->jawaban_text))?></p>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($s->jawaban_gambar): ?>
                                    <img src="<?= base_url().'assets/jawaban_gambar/'.$s->jawaban_gambar?>" style="max-width:300px; border-radius:4px; margin-bottom:10px;" alt="">
                                    <?php endif; ?>
                                    <?php if ($s->jawaban_file): ?>
                                    <p><a href="<?= base_url().'assets/jawaban_file/'.$s->jawaban_file?>" target="_blank">Lihat Dokumen: <?= $s->jawaban_file?></a></p>
                                    <?php endif; ?>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nilai <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="nilai[<?= $i?>]" value="<?= $s->nilai?>" min="0" max="100" required>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Feedback</label>
                                                <textarea class="form-control" name="feedback[<?= $i?>]" rows="2"><?= htmlspecialchars($s->feedback ?? '')?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php $i++; endforeach; ?>
                <?php if ($current_pertemuan !== NULL) echo '</div></div></div>'; ?>

                <!-- Submit -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success btn-lg waves-effect" onclick="return confirm('Simpan nilai untuk semua anggota Kelompok <?= $no_kelompok?>?')">
                            <i class="material-icons">save</i> Simpan Semua Nilai Kelompok <?= htmlspecialchars($no_kelompok)?>
                        </button>
                        <a href="<?= base_url().'guru/JawabanSiswa'?>" class="btn btn-default btn-lg waves-effect ml-2">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php $this->load->view('guru/layout/javascript')?>
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
</body>
</html>
