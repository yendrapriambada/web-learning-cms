<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Bulk Edit Nilai Tes Kelompok <?= $no_kelompok?> | Pendidikan IPA Terpadu</title>
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
                <h2>Bulk Edit Nilai Tes — Kelompok <?= htmlspecialchars($no_kelompok)?></h2>
            </div>

            <form method="POST" action="<?= base_url().'guru/TestUnity/do_bulk_edit'?>">
                <input type="hidden" name="no_kelompok" value="<?= htmlspecialchars($no_kelompok)?>">

                <?php
                $current_practice = NULL;
                $i = 0;
                foreach ($grouped as $key => $group):
                    $rep = $group['rep'];

                    if ($rep->practice !== $current_practice):
                        if ($current_practice !== NULL) echo '</div></div></div>';
                        $current_practice = $rep->practice;
                ?>
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header"><h2>Practice: <?= htmlspecialchars($rep->practice)?></h2></div>
                            <div class="body">
                <?php endif; ?>

                            <!-- Pertanyaan card -->
                            <div class="card" style="border:1px solid #e0e0e0; margin-bottom:16px;">
                                <div class="body" style="padding:16px;">
                                    <input type="hidden" name="indikator_soal[<?= $i?>]" value="<?= htmlspecialchars($rep->indikator_soal)?>">
                                    <input type="hidden" name="practice[<?= $i?>]" value="<?= htmlspecialchars($rep->practice)?>">
                                    <input type="hidden" name="pertanyaan[<?= $i?>]" value="<?= htmlspecialchars($rep->pertanyaan)?>">

                                    <p class="text-muted mb-1" style="font-size:12px;">No. <?= htmlspecialchars($rep->pertanyaan)?></p>
                                    <p><?= htmlspecialchars($rep->indikator_soal)?></p>

                                    <?php if (!$rep->jawaban): ?>
                                    <div class="text-danger" style="font-size:12px; margin-bottom:10px;">Belum ada anggota kelompok yang mengerjakan soal ini.</div>
                                    <?php else: ?>
                                    <!-- Preview jawaban -->
                                    <div style="background:#f5f5f5; border-radius:4px; padding:10px; margin-bottom:10px;">
                                        <small class="text-muted">Contoh jawaban:</small>
                                        <p class="mb-0"><?= nl2br(htmlspecialchars($rep->jawaban))?></p>
                                    </div>
                                    <?php endif; ?>

                                    <small class="text-muted">Diterapkan ke <?= $group['jumlah_anggota']?> anggota kelompok</small>

                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nilai <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="nilai[<?= $i?>]" value="<?= $rep->nilai?>" min="0" max="100" required>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Feedback</label>
                                                <textarea class="form-control" name="feedback[<?= $i?>]" rows="2"><?= htmlspecialchars($rep->feedback ?? '')?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php $i++; endforeach; ?>
                <?php if ($current_practice !== NULL) echo '</div></div></div>'; ?>

                <!-- Submit -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success btn-lg waves-effect" onclick="return confirm('Simpan nilai untuk semua anggota Kelompok <?= $no_kelompok?>?')">
                            <i class="material-icons">save</i> Simpan Semua Nilai Kelompok <?= htmlspecialchars($no_kelompok)?>
                        </button>
                        <a href="<?= base_url().'guru/TestUnity'?>" class="btn btn-default btn-lg waves-effect ml-2">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php $this->load->view('guru/layout/javascript')?>
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
</body>
</html>
