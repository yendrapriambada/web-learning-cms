<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Bulk Edit Kelompok <?= $no_kelompok?> | Pendidikan IPA Terpadu</title>
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
        .pertemuan-card { margin-bottom: 24px; }
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
                <h2>Bulk Edit Nilai Worksheet — Kelompok <?= htmlspecialchars($no_kelompok)?></h2>
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
                            <p class="text-muted mb-0">Jawaban, nilai, dan feedback yang diisi akan diterapkan ke semua anggota kelompok di atas.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form bulk edit -->
            <form method="POST" action="<?= base_url().'guru/JawabanSiswa/do_bulk_edit'?>" enctype="multipart/form-data">
                <input type="hidden" name="no_kelompok" value="<?= htmlspecialchars($no_kelompok)?>">

                <?php
                $current_pertemuan = NULL;
                $current_tahap     = NULL;
                $i = 0;
                foreach ($soalList as $s):
                    // Open new pertemuan card
                    if ($s->no_pertemuan !== $current_pertemuan):
                        // Close previous pertemuan card (4 divs: .body .card .col-lg-12 .row)
                        if ($current_pertemuan !== NULL) echo '</div></div></div></div>';
                        $current_pertemuan = $s->no_pertemuan;
                        $current_tahap     = NULL;
                ?>
                <div class="row clearfix pertemuan-card">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header"><h2>Pertemuan Ke-<?= $s->no_pertemuan?> &mdash; <?= htmlspecialchars($s->judul_pertemuan)?></h2></div>
                            <div class="body">
                <?php endif; // end pertemuan ?>

                <?php if ($s->tahapan_pembelajaran !== $current_tahap):
                    $current_tahap = $s->tahapan_pembelajaran; ?>
                                <h4 class="mt-3 mb-3" style="border-left:4px solid #4CAF50; padding-left:10px; font-size:15px;"><?= htmlspecialchars($s->tahapan_pembelajaran)?></h4>
                <?php endif; ?>

                                <!-- Soal card -->
                                <div class="soal-card">
                                    <div class="soal-body">
                                        <input type="hidden" name="id_soal[<?= $i?>]" value="<?= $s->id_soal?>">

                                        <p class="mb-2"><b>Soal <?= $s->no_soal?>.</b> <?= htmlspecialchars($s->deksripsi_soal)?></p>

                                        <!-- Jawaban (editable) -->
                                        <div class="form-group mb-3">
                                            <div class="section-label">Jawaban Kelompok</div>
                                            <textarea class="form-control input-field" name="jawaban_text[<?= $i?>]" rows="4"><?= htmlspecialchars($s->jawaban_text ?? '')?></textarea>
                                        </div>

                                        <!-- Jawaban Gambar (editable) -->
                                        <div class="form-group mb-3">
                                            <div class="section-label">Jawaban Gambar (Canvas)</div>
                                            <?php if ($s->jawaban_gambar): ?>
                                            <img src="<?= base_url().'assets/jawaban_gambar/'.$s->jawaban_gambar?>" style="max-width:300px; border-radius:4px; margin-bottom:8px; display:block;" alt="">
                                            <?php endif; ?>
                                            <input type="file" class="form-control-file" name="jawaban_gambar[<?= $i?>]" accept=".jpg,.jpeg,.png">
                                            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar. Maks 2MB (JPG/PNG).</small>
                                        </div>

                                        <!-- Jawaban File (editable) -->
                                        <div class="form-group mb-3">
                                            <div class="section-label">Jawaban File (PPT/PDF/DOC)</div>
                                            <?php if ($s->jawaban_file): ?>
                                            <p class="mb-1"><a href="<?= base_url().'assets/jawaban_file/'.$s->jawaban_file?>" target="_blank">Lihat Dokumen: <?= htmlspecialchars($s->jawaban_file)?></a></p>
                                            <?php endif; ?>
                                            <input type="file" class="form-control-file" name="jawaban_file[<?= $i?>]" accept=".ppt,.pptx,.pdf,.docx,.doc">
                                            <small class="text-muted">Kosongkan jika tidak ingin mengganti file. Maks 2MB (PPT/PPTX/PDF/DOCX/DOC).</small>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-0">
                                                    <div class="section-label">Nilai <span class="text-danger">*</span></div>
                                                    <input type="number" class="form-control input-field" name="nilai[<?= $i?>]" value="<?= $s->nilai?>" min="0" max="100" required>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group mb-0">
                                                    <div class="section-label">Feedback Dosen</div>
                                                    <textarea class="form-control input-field" name="feedback[<?= $i?>]" rows="3"><?= htmlspecialchars($s->feedback ?? '')?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php $i++; endforeach; ?>
                <?php if ($current_pertemuan !== NULL) echo '</div></div></div></div>'; // close last pertemuan card ?>

                <!-- Submit -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success btn-lg waves-effect" onclick="return confirm('Simpan jawaban dan nilai untuk semua anggota Kelompok <?= htmlspecialchars($no_kelompok)?>?')">
                            <i class="material-icons">save</i> Simpan Semua — Kelompok <?= htmlspecialchars($no_kelompok)?>
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
