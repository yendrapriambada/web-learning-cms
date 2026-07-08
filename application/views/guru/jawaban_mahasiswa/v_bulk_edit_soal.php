<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Bulk Edit Soal <?= $soal->no_soal?> — Kelompok <?= htmlspecialchars($no_kelompok)?> | Pendidikan IPA Terpadu</title>

    <!-- CSS -->
    <?php $this->load->view('guru/layout/header')?>
    <!-- END CSS -->
    <style>
        .breadcrumb-nav { font-size: 13px; color: #888; margin-bottom: 6px; }
        .breadcrumb-nav a { color: #3F51B5; }

        .soal-banner {
            background: #eef1fb; border-radius: 8px; padding: 16px 18px; margin-bottom: 20px;
        }
        .soal-banner .meta { font-size: 12px; color: #777; margin-bottom: 6px; text-transform: uppercase; letter-spacing: .5px; }
        .soal-banner .desc { font-size: 15px; color: #333; margin: 0; }

        .warn-banner {
            background: #fff3e0; border: 1px solid #ffe0b2; border-radius: 8px;
            padding: 12px 16px; margin-bottom: 20px; font-size: 13px; color: #8a5a00;
        }

        .input-field { background: #fffde7 !important; border: 2px solid #f9a825 !important; border-radius: 4px; }
        .input-field:focus { border-color: #e65100 !important; box-shadow: 0 0 0 2px rgba(230,81,0,.2) !important; }
        .section-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: #888; margin-bottom: 4px; }
    </style>


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
                <div class="breadcrumb-nav">
                    <a href="<?= base_url().'guru/JawabanMahasiswa'?>">Jawaban Mahasiswa/i</a> &raquo;
                    <a href="<?= base_url().'guru/JawabanMahasiswa/soal/'.urlencode($no_kelompok)?>">Kelompok <?= htmlspecialchars($no_kelompok)?></a> &raquo;
                    <a href="<?= base_url().'guru/JawabanMahasiswa/detail/'.urlencode($no_kelompok).'/'.$id_soal?>">Soal <?= $soal->no_soal?></a> &raquo;
                    Bulk Edit
                </div>
                <h2>Bulk Edit Soal <?= $soal->no_soal?> — Kelompok <?= htmlspecialchars($no_kelompok)?></h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <?php if ($this->session->flashdata('ver') == "FALSE") { ?>
                                <div class="alert alert-<?=$this->session->flashdata("class_alert");?>" role="alert">
                                <?= $this->session->flashdata('alert');
                                    $this->session->set_flashdata('ver', 'TRUE');
                                ?>
                                </div>
                            <?php } ?>

                            <a href="<?= base_url().'guru/JawabanMahasiswa/detail/'.urlencode($no_kelompok).'/'.$id_soal?>" class="btn btn-default waves-effect m-b-20">
                                <i class="material-icons" style="vertical-align:middle;">arrow_back</i> Kembali ke Daftar Jawaban Siswa
                            </a>

                            <div class="soal-banner">
                                <div class="meta">
                                    Pertemuan Ke-<?= $soal->no_pertemuan?> — <?= htmlspecialchars($soal->judul_pertemuan)?> &nbsp;|&nbsp; <?= htmlspecialchars($soal->tahapan_pembelajaran)?>
                                </div>
                                <p class="desc"><b>Soal <?= $soal->no_soal?>.</b> <?= htmlspecialchars($soal->deksripsi_soal)?></p>
                            </div>

                            <div class="warn-banner">
                                <i class="material-icons" style="vertical-align:middle;font-size:18px;">info</i>
                                Apa pun yang Anda isi di bawah akan diterapkan ke <b>semua <?= $jumlah_anggota?> anggota kelompok <?= htmlspecialchars($no_kelompok)?></b> untuk soal ini, menggantikan jawaban/nilai/feedback masing-masing siswa sebelumnya.
                                Kosongkan kolom Jawaban / Gambar / File jika tidak ingin mengubah jawaban siswa dan hanya ingin mengisi nilai &amp; feedback.
                            </div>

                            <form method="POST" action="<?= base_url().'guru/JawabanMahasiswa/do_bulk_soal'?>" enctype="multipart/form-data">
                                <input type="hidden" name="no_kelompok" value="<?= htmlspecialchars($no_kelompok)?>">
                                <input type="hidden" name="id_soal" value="<?= $id_soal?>">

                                <div class="form-group m-b-20">
                                    <div class="section-label">Jawaban (opsional — kosongkan jika tidak ingin mengubah)</div>
                                    <textarea class="form-control input-field" name="jawaban_text" rows="4"><?= $sample ? htmlspecialchars($sample['jawaban_text'] ?? '') : ''?></textarea>
                                </div>

                                <div class="row m-b-15">
                                    <div class="col-md-6">
                                        <div class="section-label">Jawaban Gambar (Canvas)</div>
                                        <?php if ($sample && $sample['jawaban_gambar']): ?>
                                        <img src="<?= base_url().'assets/jawaban_gambar/'.$sample['jawaban_gambar']?>" style="max-width:220px; border-radius:4px; margin-bottom:6px; display:block;" alt="">
                                        <?php endif; ?>
                                        <input type="file" class="form-control-file" name="jawaban_gambar" accept=".jpg,.jpeg,.png">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti. Maks 2MB.</small>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="section-label">Jawaban File (PPT/PDF/DOC)</div>
                                        <?php if ($sample && $sample['jawaban_file']): ?>
                                        <p class="m-b-5"><a href="<?= base_url().'assets/jawaban_file/'.$sample['jawaban_file']?>" target="_blank">Lihat Dokumen: <?= htmlspecialchars($sample['jawaban_file'])?></a></p>
                                        <?php endif; ?>
                                        <input type="file" class="form-control-file" name="jawaban_file" accept=".ppt,.pptx,.pdf,.docx,.doc">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti. Maks 2MB.</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="section-label">Nilai <span class="text-danger">*</span></div>
                                        <input type="number" class="form-control input-field" name="nilai" value="<?= $sample['nilai'] ?? ''?>" min="0" max="100" required>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="section-label">Feedback Dosen</div>
                                        <textarea class="form-control input-field" name="feedback" rows="2"><?= $sample ? htmlspecialchars($sample['feedback'] ?? '') : ''?></textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success btn-lg waves-effect m-t-20"
                                        onclick="return confirm('Terapkan jawaban &amp; nilai ini ke semua <?= $jumlah_anggota?> anggota kelompok <?= htmlspecialchars(addslashes($no_kelompok))?> untuk soal ini?')">
                                    <i class="material-icons">save</i> Terapkan ke Semua Anggota
                                </button>
                                <a href="<?= base_url().'guru/JawabanMahasiswa/detail/'.urlencode($no_kelompok).'/'.$id_soal?>" class="btn btn-default btn-lg waves-effect m-l-10 m-t-20">Batal</a>
                            </form>
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
