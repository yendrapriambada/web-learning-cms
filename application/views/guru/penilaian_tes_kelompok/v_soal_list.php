<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Kelompok <?= htmlspecialchars($no_kelompok)?> — Daftar Soal Tes | Pendidikan IPA Terpadu</title>

    <!-- CSS -->
    <?php $this->load->view('guru/layout/header')?>
    <!-- END CSS -->
    <style>
        .breadcrumb-nav { font-size: 13px; color: #888; margin-bottom: 6px; }
        .breadcrumb-nav a { color: #3F51B5; }
        .member-badges .badge { margin: 0 4px 4px 0; font-size: 12px; }

        .practice-block { margin-bottom: 22px; }
        .practice-block .practice-title {
            font-size: 15px; font-weight: 700; margin: 0 0 10px;
            padding-left: 10px; border-left: 4px solid #3F51B5;
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
        .soal-row .soal-text .soal-desc { color: #444; font-size: 13px; }
        .soal-row .soal-chips { display: flex; gap: 6px; flex-shrink: 0; flex-wrap: wrap; justify-content: flex-end; }
        .chip { font-size: 11px; padding: 4px 10px; border-radius: 12px; font-weight: 600; white-space: nowrap; }
        .chip-menjawab { background: #e8f5e9; color: #2e7d32; }
        .chip-dinilai  { background: #e3f2fd; color: #1565c0; }
        .chip-nilai    { background: #fff3e0; color: #ef6c00; }
        .chip-pretest  { background: #e3f2fd; color: #1565c0; }
        .chip-posttest { background: #fff3e0; color: #ef6c00; }
        .chip-unknown  { background: #f5f5f5; color: #999; }
        .soal-row .arrow { color: #bbb; }
        .soal-row:hover .arrow { color: #3F51B5; }

        .soal-row-container { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
        .soal-row-container .soal-row { margin-bottom: 0; flex: 1; }
        .retag-form select { font-size: 11px; padding: 4px 8px; border-radius: 6px; border: 1px solid #ddd; }
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
                    <a href="<?= base_url().'guru/PenilaianTesKelompok'?>">Penilaian Tes</a> &raquo; Kelompok <?= htmlspecialchars($no_kelompok)?>
                </div>
                <h2>Kelompok <?= htmlspecialchars($no_kelompok)?> — Daftar Soal Tes</h2>
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

                            <a href="<?= base_url().'guru/PenilaianTesKelompok'?>" class="btn btn-default waves-effect m-b-20">
                                <i class="material-icons" style="vertical-align:middle;">arrow_back</i> Kembali ke Daftar Kelompok
                            </a>

                            <div class="member-badges">
                                <?php foreach ($members as $m): ?>
                                <span class="badge bg-blue"><?= htmlspecialchars($m->nama_lengkap)?></span>
                                <?php endforeach; ?>
                            </div>
                            <p class="text-muted m-t-10 m-b-0">Klik salah satu soal di bawah untuk melihat dan menilai jawaban masing-masing anggota secara individual.</p>

                            <form method="GET" action="<?= base_url().'guru/PenilaianTesKelompok/soal/'.urlencode($no_kelompok)?>" class="row m-t-15" style="align-items:flex-end;">
                                <div class="col-md-4">
                                    <label>Practice</label>
                                    <select name="practice" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua Practice</option>
                                        <?php foreach ($practice_list as $p): ?>
                                        <option value="<?= htmlspecialchars($p)?>" <?= $filters['practice']==$p?'selected':''?>><?= htmlspecialchars($p)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Jenis Tes</label>
                                    <select name="test_type" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <option value="pretest" <?= $filters['test_type']=='pretest'?'selected':''?>>Pretest</option>
                                        <option value="posttest" <?= $filters['test_type']=='posttest'?'selected':''?>>Posttest</option>
                                        <option value="_unknown" <?= $filters['test_type']=='_unknown'?'selected':''?>>Belum Ditandai</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Status Dinilai</label>
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <option value="dinilai" <?= $filters['status']=='dinilai'?'selected':''?>>Sudah Dinilai Semua</option>
                                        <option value="belum_dinilai" <?= $filters['status']=='belum_dinilai'?'selected':''?>>Ada yang Belum Dinilai</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a href="<?= base_url().'guru/PenilaianTesKelompok/soal/'.urlencode($no_kelompok)?>" class="btn btn-default waves-effect">Reset Filter</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (empty($soalList)): ?>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card"><div class="body text-center text-muted" style="padding:40px;">
                        <?= (!empty($filters['practice']) || !empty($filters['test_type']) || !empty($filters['status'])) ? 'Tidak ada soal yang cocok dengan filter ini.' : 'Kelompok ini belum pernah mengerjakan soal tes apa pun.'?>
                    </div></div>
                </div>
            </div>
            <?php endif; ?>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <?php
                                $curPractice = NULL;
                                foreach ($soalList as $s):
                                    if ($s['practice'] !== $curPractice):
                                        if ($curPractice !== NULL) echo '</div>'; // tutup practice-block sebelumnya
                                        $curPractice = $s['practice'];
                            ?>
                            <div class="practice-block">
                                <div class="practice-title">Practice: <?= htmlspecialchars($s['practice'])?></div>
                            <?php endif; ?>

                            <div class="soal-row-container">
                            <a class="soal-row" href="<?= base_url().'guru/PenilaianTesKelompok/detail/'.urlencode($no_kelompok).'/'.$s['soal_key']?>">
                                <div class="soal-text">
                                    <span class="soal-no">No. <?= htmlspecialchars($s['pertanyaan'])?>.</span>
                                    <span class="soal-desc"><?= htmlspecialchars(mb_strimwidth($s['indikator_soal'], 0, 140, '…'))?></span>
                                </div>
                                <div class="soal-chips">
                                    <?php if ($s['test_type'] === 'pretest'): ?>
                                    <span class="chip chip-pretest">Pretest</span>
                                    <?php elseif ($s['test_type'] === 'posttest'): ?>
                                    <span class="chip chip-posttest">Posttest</span>
                                    <?php else: ?>
                                    <span class="chip chip-unknown">Belum Ditandai</span>
                                    <?php endif; ?>
                                    <span class="chip chip-menjawab">Menjawab: <?= $s['jumlah_menjawab']?>/<?= $s['total_anggota']?></span>
                                    <span class="chip chip-dinilai">Dinilai: <?= $s['jumlah_dinilai']?>/<?= $s['total_anggota']?></span>
                                    <?php if ($s['rata_nilai'] !== null): ?>
                                    <span class="chip chip-nilai">Rata: <?= $s['rata_nilai']?></span>
                                    <?php endif; ?>
                                </div>
                                <i class="material-icons arrow">arrow_forward</i>
                            </a>
                            <form method="POST" action="<?= base_url().'guru/PenilaianTesKelompok/retag/'.urlencode($no_kelompok)?>" class="retag-form">
                                <input type="hidden" name="practice" value="<?= htmlspecialchars($s['practice'])?>">
                                <input type="hidden" name="pertanyaan" value="<?= htmlspecialchars($s['pertanyaan'])?>">
                                <input type="hidden" name="old_test_type" value="<?= $s['test_type'] === '_unknown' ? '' : htmlspecialchars($s['test_type'])?>">
                                <select name="new_test_type" title="Tandai ulang jenis tes" onchange="if(this.value && confirm('Tandai ulang Soal No. <?= htmlspecialchars(addslashes($s['pertanyaan']))?> ini sebagai '+this.value+'?')){ this.form.submit(); } else { this.value=''; }">
                                    <option value="">Tandai ulang…</option>
                                    <option value="pretest">→ Pretest</option>
                                    <option value="posttest">→ Posttest</option>
                                </select>
                            </form>
                            </div>

                            <?php endforeach; ?>
                            <?php if ($curPractice !== NULL) echo '</div>'; // tutup practice-block terakhir ?>
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
