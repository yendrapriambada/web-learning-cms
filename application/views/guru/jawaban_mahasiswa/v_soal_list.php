<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Kelompok <?= htmlspecialchars($no_kelompok)?> — Daftar Soal | Pendidikan IPA Terpadu</title>

    <!-- CSS -->
    <?php $this->load->view('guru/layout/header')?>
    <!-- END CSS -->
    <style>
        .breadcrumb-nav { font-size: 13px; color: #888; margin-bottom: 6px; }
        .breadcrumb-nav a { color: #3F51B5; }
        .member-badges .badge { margin: 0 4px 4px 0; font-size: 12px; }

        .pertemuan-block { margin-bottom: 22px; }
        .pertemuan-block .pertemuan-title {
            font-size: 15px; font-weight: 700; margin: 0 0 10px;
            padding-left: 10px; border-left: 4px solid #3F51B5;
        }
        .tahap-title {
            font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px;
            color: #888; margin: 14px 0 8px;
        }

        .soal-row {
            display: flex; align-items: center; justify-content: space-between; gap: 14px;
            background: #fff; border: 1px solid #eee; border-radius: 8px;
            padding: 14px 16px; margin-bottom: 8px;
            text-decoration: none; color: inherit;
            transition: box-shadow .15s ease, border-color .15s ease;
        }
        .soal-row:hover { box-shadow: 0 3px 10px rgba(0,0,0,.08); border-color: #c5cae9; text-decoration: none; color: inherit; }
        .soal-row .soal-text { flex: 1; min-width: 0; }
        .soal-row .soal-text .soal-no { font-weight: 700; margin-right: 4px; }
        .soal-row .soal-text .soal-desc { color: #555; font-size: 13px; display: block; margin-top: 2px; }
        .soal-row .soal-chips { display: flex; gap: 6px; flex-shrink: 0; flex-wrap: wrap; justify-content: flex-end; }
        .chip { font-size: 11px; padding: 4px 10px; border-radius: 12px; font-weight: 600; white-space: nowrap; }
        .chip-menjawab { background: #e8f5e9; color: #2e7d32; }
        .chip-dinilai  { background: #e3f2fd; color: #1565c0; }
        .chip-nilai    { background: #fff3e0; color: #ef6c00; }
        .soal-row .arrow { color: #bbb; }
        .soal-row:hover .arrow { color: #3F51B5; }
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
                    <a href="<?= base_url().'guru/JawabanMahasiswa'?>">Jawaban Mahasiswa/i</a> &raquo; Kelompok <?= htmlspecialchars($no_kelompok)?>
                </div>
                <h2>Kelompok <?= htmlspecialchars($no_kelompok)?> — Daftar Soal</h2>
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

                            <a href="<?= base_url().'guru/JawabanMahasiswa'?>" class="btn btn-default waves-effect m-b-20">
                                <i class="material-icons" style="vertical-align:middle;">arrow_back</i> Kembali ke Daftar Kelompok
                            </a>

                            <div class="member-badges">
                                <?php foreach ($members as $m): ?>
                                <span class="badge bg-blue"><?= htmlspecialchars($m->nama_lengkap)?></span>
                                <?php endforeach; ?>
                            </div>
                            <p class="text-muted m-t-10 m-b-0">Klik salah satu soal di bawah untuk melihat dan menilai jawaban masing-masing anggota secara individual.</p>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (empty($soalList)): ?>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card"><div class="body text-center text-muted" style="padding:40px;">
                        Kelompok ini belum pernah mengirim jawaban worksheet apa pun.
                    </div></div>
                </div>
            </div>
            <?php endif; ?>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <?php
                                $curPertemuan = NULL; $curTahap = NULL;
                                foreach ($soalList as $s):
                                    if ($s['no_pertemuan'] !== $curPertemuan):
                                        if ($curPertemuan !== NULL) echo '</div>'; // tutup pertemuan-block sebelumnya
                                        $curPertemuan = $s['no_pertemuan']; $curTahap = NULL;
                            ?>
                            <div class="pertemuan-block">
                                <div class="pertemuan-title">Pertemuan Ke-<?= $s['no_pertemuan']?> &mdash; <?= htmlspecialchars($s['judul_pertemuan'])?></div>
                            <?php endif; ?>

                            <?php if ($s['tahapan_pembelajaran'] !== $curTahap): $curTahap = $s['tahapan_pembelajaran']; ?>
                                <div class="tahap-title"><?= htmlspecialchars($s['tahapan_pembelajaran'])?></div>
                            <?php endif; ?>

                            <a class="soal-row" href="<?= base_url().'guru/JawabanMahasiswa/detail/'.urlencode($no_kelompok).'/'.$s['id_soal']?>">
                                <div class="soal-text">
                                    <span class="soal-no">Soal <?= $s['no_soal']?>.</span>
                                    <span class="soal-desc"><?= htmlspecialchars(mb_strimwidth($s['deksripsi_soal'], 0, 140, '…'))?></span>
                                </div>
                                <div class="soal-chips">
                                    <span class="chip chip-menjawab">Menjawab: <?= $s['jumlah_menjawab']?>/<?= $s['total_anggota']?></span>
                                    <span class="chip chip-dinilai">Dinilai: <?= $s['jumlah_dinilai']?>/<?= $s['total_anggota']?></span>
                                    <?php if ($s['rata_nilai'] !== null): ?>
                                    <span class="chip chip-nilai">Rata: <?= $s['rata_nilai']?></span>
                                    <?php endif; ?>
                                </div>
                                <i class="material-icons arrow">arrow_forward</i>
                            </a>

                            <?php endforeach; ?>
                            <?php if ($curPertemuan !== NULL) echo '</div>'; // tutup pertemuan-block terakhir ?>
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
