<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Kelompok <?= htmlspecialchars($no_kelompok)?> — Detail Soal Tes | Pendidikan IPA Terpadu</title>

    <!-- CSS -->
    <?php $this->load->view('guru/layout/header')?>
    <!-- END CSS -->
    <style>
        .breadcrumb-nav { font-size: 13px; color: #888; margin-bottom: 6px; }
        .breadcrumb-nav a { color: #3F51B5; }

        .detail-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; }

        .soal-banner {
            background: #eef1fb; border-radius: 8px; padding: 16px 18px; margin-bottom: 20px;
        }
        .soal-banner .meta { font-size: 12px; color: #777; margin-bottom: 6px; text-transform: uppercase; letter-spacing: .5px; }
        .soal-banner .desc { font-size: 15px; color: #333; margin: 0; }

        .siswa-row {
            display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;
            border: 1px solid #e7e7e7; border-radius: 8px; padding: 14px 16px; margin-bottom: 10px;
        }
        .siswa-row .siswa-main { flex: 1; min-width: 0; }
        .siswa-row .siswa-name { font-weight: 700; font-size: 14px; margin: 0 0 4px; }
        .siswa-row .siswa-jawaban { font-size: 13px; color: #444; margin: 4px 0; white-space: pre-line; }
        .siswa-row .siswa-side { text-align: right; flex-shrink: 0; min-width: 140px; }

        .belum-menjawab { color: #c62828; font-size: 12px; font-weight: 600; }
        .sudah-menjawab { color: #2e7d32; font-size: 12px; font-weight: 600; }
        .nilai-pill {
            display: inline-block; margin-top: 6px; padding: 3px 12px; border-radius: 12px;
            background: #e3f2fd; color: #1565c0; font-weight: 700; font-size: 13px;
        }
        .nilai-pill.empty { background: #f5f5f5; color: #999; font-weight: 400; }
        .feedback-text { font-size: 12px; color: #777; margin-top: 6px; font-style: italic; }
        .btn-hapus-siswa { color: #c62828; text-decoration: none; display: inline-block; margin-top: 8px; }
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
                    <a href="<?= base_url().'guru/PenilaianTesKelompok'?>">Penilaian Tes</a> &raquo;
                    <a href="<?= base_url().'guru/PenilaianTesKelompok/soal/'.urlencode($no_kelompok)?>">Kelompok <?= htmlspecialchars($no_kelompok)?></a> &raquo;
                    Detail Soal
                </div>
                <div class="detail-header">
                    <h2>Jawaban Tiap Siswa — Kelompok <?= htmlspecialchars($no_kelompok)?></h2>
                    <a href="<?= base_url().'guru/PenilaianTesKelompok/bulk_soal/'.urlencode($no_kelompok).'/'.$soal_key?>" class="btn btn-success waves-effect">
                        <i class="material-icons">edit</i> Bulk Edit Soal Ini
                    </a>
                </div>
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

                            <a href="<?= base_url().'guru/PenilaianTesKelompok/soal/'.urlencode($no_kelompok)?>" class="btn btn-default waves-effect m-b-20">
                                <i class="material-icons" style="vertical-align:middle;">arrow_back</i> Kembali ke Daftar Soal
                            </a>

                            <div class="soal-banner">
                                <div class="meta">Practice: <?= htmlspecialchars($soal['practice'])?> &nbsp;|&nbsp; No. <?= htmlspecialchars($soal['pertanyaan'])?></div>
                                <p class="desc"><?= htmlspecialchars($soal['indikator_soal'])?></p>
                            </div>

                            <p class="text-muted m-b-20" style="font-size:13px;">
                                Daftar jawaban tiap siswa untuk soal ini (hanya lihat). Untuk mengubah nilai/feedback sekaligus untuk semua anggota kelompok, gunakan tombol <b>Bulk Edit Soal Ini</b> di atas.
                            </p>

                            <?php foreach ($siswaList as $sw): ?>
                            <div class="siswa-row">
                                <div class="siswa-main">
                                    <p class="siswa-name">
                                        <i class="material-icons" style="vertical-align:middle;font-size:16px;">person</i>
                                        <?= htmlspecialchars($sw['nama_lengkap'])?>
                                    </p>

                                    <?php if ($sw['id_test_unity']): ?>
                                        <span class="sudah-menjawab">Sudah mengerjakan</span>
                                        <?php if ($sw['jawaban']): ?>
                                        <p class="siswa-jawaban"><?= htmlspecialchars($sw['jawaban'])?></p>
                                        <?php endif; ?>
                                        <?php if ($sw['feedback']): ?>
                                        <div class="feedback-text">Feedback: <?= htmlspecialchars($sw['feedback'])?></div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="belum-menjawab">Belum mengerjakan</span>
                                    <?php endif; ?>
                                </div>
                                <div class="siswa-side">
                                    <span class="nilai-pill <?= $sw['nilai'] === null ? 'empty' : ''?>">
                                        <?= $sw['nilai'] !== null ? $sw['nilai'] : 'Belum dinilai'?>
                                    </span>
                                    <?php if ($sw['id_test_unity']): ?>
                                    <br>
                                    <a href="<?= base_url().'guru/PenilaianTesKelompok/hapus/'.$sw['id_test_unity'].'/'.urlencode($no_kelompok).'/'.$soal_key?>"
                                       class="btn-hapus-siswa"
                                       onclick="return confirm('Hapus jawaban <?= htmlspecialchars(addslashes($sw['nama_lengkap']))?> untuk soal ini?')"
                                       title="Hapus jawaban siswa ini">
                                        <i class="material-icons" style="vertical-align:middle;font-size:16px;">delete_forever</i> Hapus
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
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
