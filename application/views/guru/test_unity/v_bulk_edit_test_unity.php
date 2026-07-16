<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Bulk Edit Nilai Tes Kelompok <?= $no_kelompok?> | Pendidikan IPA Terpadu</title>
    <?php $this->load->view('guru/layout/header')?>
    <style>
        .input-field {
            background: #fffde7 !important;
            border: 2px solid #f9a825 !important;
            border-radius: 4px;
        }
        .input-field:focus {
            border-color: #e65100 !important;
            box-shadow: 0 0 0 2px rgba(230,81,0,.2) !important;
        }
        .soal-card {
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            margin-bottom: 20px;
            background: #fff;
        }
        .soal-card .soal-body { padding: 20px; }
        .jawaban-preview {
            background: #f5f5f5;
            border-radius: 4px;
            padding: 10px 14px;
            margin-bottom: 12px;
            font-size: 13px;
            color: #555;
        }
        .section-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #888;
            margin-bottom: 4px;
        }
        .practice-card { margin-bottom: 24px; }
        .badge-pretest { background: #e3f2fd; color: #1565c0; }
        .badge-posttest { background: #fff3e0; color: #ef6c00; }
        .badge-unknown { background: #f5f5f5; color: #999; }
        .retag-link { font-size: 11px; margin-left: 6px; text-decoration: underline; cursor: pointer; font-weight: 400; text-transform: none; letter-spacing: normal; }
    </style>
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

            <!-- Anggota kelompok -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header"><h2>Anggota Kelompok <?= htmlspecialchars($no_kelompok)?></h2></div>
                        <div class="body">
                            <?php if (!empty($members)): ?>
                            <ul class="list-inline mb-1">
                                <?php foreach ($members as $m): ?>
                                <li class="list-inline-item"><span class="badge bg-blue"><?= htmlspecialchars($m->nama_lengkap)?></span></li>
                                <?php endforeach; ?>
                            </ul>
                            <p class="text-muted mb-0">Nilai dan feedback yang diisi akan diterapkan ke semua anggota kelompok di atas.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form bulk edit -->
            <form method="POST" action="<?= base_url().'guru/TestUnity/do_bulk_edit'?>">
                <input type="hidden" name="no_kelompok" value="<?= htmlspecialchars($no_kelompok)?>">

                <?php
                $current_practice = NULL;
                $i = 0;
                foreach ($grouped as $key => $group):
                    $rep = $group['rep'];

                    if ($rep->practice !== $current_practice):
                        if ($current_practice !== NULL) echo '</div></div></div></div>';
                        $current_practice = $rep->practice;
                ?>
                <div class="row clearfix practice-card">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header"><h2>Practice: <?= htmlspecialchars($rep->practice)?></h2></div>
                            <div class="body">
                <?php endif; ?>

                                <!-- Soal card -->
                                <div class="soal-card">
                                    <div class="soal-body">
                                        <input type="hidden" name="indikator_soal[<?= $i?>]" value="<?= htmlspecialchars($rep->indikator_soal)?>">
                                        <input type="hidden" name="practice[<?= $i?>]" value="<?= htmlspecialchars($rep->practice)?>">
                                        <input type="hidden" name="pertanyaan[<?= $i?>]" value="<?= htmlspecialchars($rep->pertanyaan)?>">
                                        <input type="hidden" name="test_type[<?= $i?>]" value="<?= $rep->test_type === '_unknown' ? '' : htmlspecialchars($rep->test_type)?>">

                                        <p class="mb-2">
                                            <b>No. <?= htmlspecialchars($rep->pertanyaan)?>.</b> <?= htmlspecialchars($rep->indikator_soal)?>
                                            <?php if ($rep->test_type === 'pretest'): ?>
                                            <span class="badge badge-pretest">Pretest</span>
                                            <?php elseif ($rep->test_type === 'posttest'): ?>
                                            <span class="badge badge-posttest">Posttest</span>
                                            <?php else: ?>
                                            <span class="badge badge-unknown">Belum Ditandai</span>
                                            <?php endif; ?>
                                            <?php if ($rep->test_type !== 'pretest'): ?>
                                            <a class="retag-link" onclick="retagSoal('<?= htmlspecialchars(addslashes($rep->practice), ENT_QUOTES)?>', '<?= htmlspecialchars(addslashes($rep->pertanyaan), ENT_QUOTES)?>', '<?= $rep->test_type === '_unknown' ? '' : htmlspecialchars(addslashes($rep->test_type), ENT_QUOTES)?>', 'pretest')">→ Pretest</a>
                                            <?php endif; ?>
                                            <?php if ($rep->test_type !== 'posttest'): ?>
                                            <a class="retag-link" onclick="retagSoal('<?= htmlspecialchars(addslashes($rep->practice), ENT_QUOTES)?>', '<?= htmlspecialchars(addslashes($rep->pertanyaan), ENT_QUOTES)?>', '<?= $rep->test_type === '_unknown' ? '' : htmlspecialchars(addslashes($rep->test_type), ENT_QUOTES)?>', 'posttest')">→ Posttest</a>
                                            <?php endif; ?>
                                        </p>

                                        <?php if (!$rep->jawaban): ?>
                                        <div class="jawaban-preview text-danger mb-2">Belum ada anggota kelompok yang mengerjakan soal ini. Isi nilai di bawah untuk menyimpannya.</div>
                                        <?php else: ?>
                                        <div class="jawaban-preview mb-2">
                                            <div class="section-label">Contoh Jawaban</div>
                                            <?= nl2br(htmlspecialchars($rep->jawaban))?>
                                        </div>
                                        <?php endif; ?>

                                        <small class="text-muted">Diterapkan ke <?= $group['jumlah_anggota']?> anggota kelompok</small>

                                        <div class="row mt-2">
                                            <div class="col-md-3">
                                                <div class="form-group mb-0">
                                                    <div class="section-label">Nilai <span class="text-danger">*</span></div>
                                                    <input type="number" class="form-control input-field" name="nilai[<?= $i?>]" value="<?= $rep->nilai?>" min="0" max="100" required>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group mb-0">
                                                    <div class="section-label">Feedback Dosen</div>
                                                    <textarea class="form-control input-field" name="feedback[<?= $i?>]" rows="2"><?= htmlspecialchars($rep->feedback ?? '')?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php $i++; endforeach; ?>
                <?php if ($current_practice !== NULL) echo '</div></div></div></div>'; // close last practice card ?>

                <!-- Submit -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success btn-lg waves-effect" onclick="return confirm('Simpan nilai untuk semua anggota Kelompok <?= htmlspecialchars($no_kelompok)?>?')">
                            <i class="material-icons">save</i> Simpan Semua — Kelompok <?= htmlspecialchars($no_kelompok)?>
                        </button>
                        <a href="<?= base_url().'guru/TestUnity'?>" class="btn btn-default btn-lg waves-effect ml-2">Batal</a>
                    </div>
                </div>
            </form>

            <!-- Form terpisah khusus tandai ulang pretest/posttest (tidak boleh nested
                 di dalam form simpan nilai di atas), diisi & di-submit lewat JS. -->
            <form method="POST" action="<?= base_url().'guru/TestUnity/retag'?>" id="retagForm">
                <input type="hidden" name="no_kelompok" value="<?= htmlspecialchars($no_kelompok)?>">
                <input type="hidden" name="practice" id="retagPractice">
                <input type="hidden" name="pertanyaan" id="retagPertanyaan">
                <input type="hidden" name="old_test_type" id="retagOldType">
                <input type="hidden" name="new_test_type" id="retagNewType">
            </form>
        </div>
    </section>

    <?php $this->load->view('guru/layout/javascript')?>
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
    <script>
        function retagSoal(practice, pertanyaan, oldType, newType) {
            if (!confirm('Tandai ulang Soal No. ' + pertanyaan + ' ini sebagai ' + newType + '?')) { return; }
            document.getElementById('retagPractice').value = practice;
            document.getElementById('retagPertanyaan').value = pertanyaan;
            document.getElementById('retagOldType').value = oldType;
            document.getElementById('retagNewType').value = newType;
            document.getElementById('retagForm').submit();
        }
    </script>
</body>
</html>
