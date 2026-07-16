<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Penilaian Tes — <?= $test_type === 'pretest' ? 'Pretest' : 'Posttest'?> | Pendidikan IPA Terpadu</title>

    <!-- CSS -->
    <?php $this->load->view('guru/layout/header')?>
    <!-- END CSS -->
    <style>
        .breadcrumb-nav { font-size: 13px; color: #888; margin-bottom: 6px; }
        .breadcrumb-nav a { color: #3F51B5; }

        .filter-row { display: flex; align-items: center; flex-wrap: wrap; gap: 12px; }
        .filter-row-end { margin-left: auto; display: flex; justify-content: flex-end; }

        .kelompok-grid { display: flex; flex-wrap: wrap; margin: 0 -10px; }
        .kelompok-col { padding: 0 10px; width: 25%; margin-bottom: 20px; }
        @media (max-width: 1200px) { .kelompok-col { width: 33.33%; } }
        @media (max-width: 900px)  { .kelompok-col { width: 50%; } }
        @media (max-width: 560px)  { .kelompok-col { width: 100%; } }

        .kelompok-tile {
            display: block;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e7e7e7;
            border-left: 5px solid #bdbdbd;
            padding: 18px;
            height: 100%;
            box-shadow: 0 1px 3px rgba(0,0,0,.05);
            transition: transform .15s ease, box-shadow .15s ease;
            text-decoration: none;
            color: inherit;
        }
        .kelompok-tile:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0,0,0,.12);
            text-decoration: none;
            color: inherit;
        }
        .kelompok-tile.status-done   { border-left-color: #4CAF50; }
        .kelompok-tile.status-partial { border-left-color: #FF9800; }
        .kelompok-tile.status-empty  { border-left-color: #bdbdbd; }

        .kelompok-tile .k-title { font-size: 19px; font-weight: 700; margin: 0; }
        .kelompok-tile .k-angkatan { font-size: 11px; color: #888; }
        .kelompok-tile .k-anggota { font-size: 12px; color: #777; margin: 6px 0 14px; }

        .mini-progress-label { font-size: 11px; color: #888; display: flex; justify-content: space-between; margin-bottom: 2px; }
        .mini-progress { height: 7px; border-radius: 5px; background: #eee; margin-bottom: 10px; overflow: hidden; }
        .mini-progress > div { height: 100%; border-radius: 5px; }

        .k-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 12px; padding-top: 10px; border-top: 1px dashed #eee; }
        .k-nilai { font-size: 20px; font-weight: 700; color: #3F51B5; }
        .k-nilai-label { font-size: 10px; color: #999; text-transform: uppercase; }
        .k-arrow { color: #bbb; }
        .kelompok-tile:hover .k-arrow { color: #3F51B5; }

        .empty-state { text-align: center; padding: 50px 10px; color: #888; }

        .badge-pretest { background: #e3f2fd; color: #1565c0; }
        .badge-posttest { background: #fff3e0; color: #ef6c00; }
    </style>


<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
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
                <div class="breadcrumb-nav">
                    <a href="<?= base_url().'guru/PenilaianTesJenis'?>">Penilaian Tes</a> &raquo; <?= $test_type === 'pretest' ? 'Pretest' : 'Posttest'?>
                </div>
                <h2>
                    Kelompok —
                    <?php if ($test_type === 'pretest'): ?>
                    <span class="badge badge-pretest">Pretest</span>
                    <?php else: ?>
                    <span class="badge badge-posttest">Posttest</span>
                    <?php endif; ?>
                </h2>
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

                            <div class="filter-row">
                                <a href="<?= base_url().'guru/PenilaianTesJenis'?>" class="btn btn-default waves-effect">
                                    <i class="material-icons" style="vertical-align:middle;">arrow_back</i> Kembali
                                </a>
                                <form method="GET" action="<?= base_url().'guru/PenilaianTesJenis/kelompok/'.$test_type?>" class="filter-row-end" style="gap:8px;">
                                    <input type="text" name="no_kelompok" class="form-control" style="width:160px;" placeholder="Cari No. Kelompok" value="<?= htmlspecialchars($filters['no_kelompok'] ?? '')?>">
                                    <select name="angkatan" class="form-control" style="width:220px;" onchange="this.form.submit()">
                                        <option value="">Semua Angkatan</option>
                                        <?php foreach ($filter_angkatan as $f): ?>
                                        <option value="<?= htmlspecialchars($f->angkatan)?>" <?= $filters['angkatan']==$f->angkatan?'selected':''?>>Angkatan <?= htmlspecialchars($f->angkatan)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary waves-effect"><i class="material-icons" style="vertical-align:middle;font-size:18px;">search</i> Cari</button>
                                    <a href="<?= base_url().'guru/PenilaianTesJenis/kelompok/'.$test_type?>" class="btn btn-default waves-effect">Reset</a>
                                </form>
                            </div>

                            <p class="text-muted m-t-15 m-b-0">
                                Klik kartu kelompok untuk melihat daftar soal <?= $test_type === 'pretest' ? 'pretest' : 'posttest'?> yang sudah dikerjakan kelompok tersebut.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (empty($cards)): ?>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body empty-state">
                            <i class="material-icons" style="font-size:48px;">groups</i>
                            <p class="m-t-10 m-b-0">Belum ada kelompok yang mengerjakan <?= $test_type === 'pretest' ? 'pretest' : 'posttest'?> dan cocok dengan filter ini.</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="kelompok-grid">
                <?php foreach ($cards as $c): ?>
                <?php
                    $pctTerisi  = $c['total_soal'] > 0 ? round($c['terisi']  / $c['total_soal'] * 100) : 0;
                    $pctDinilai = $c['total_soal'] > 0 ? round($c['dinilai'] / $c['total_soal'] * 100) : 0;
                    if ($c['total_soal'] == 0) $status = 'status-empty';
                    else if ($c['dinilai'] >= $c['total_soal']) $status = 'status-done';
                    else $status = 'status-partial';
                ?>
                <div class="kelompok-col">
                    <a class="kelompok-tile <?= $status?>" href="<?= base_url().'guru/PenilaianTesKelompok/soal/'.urlencode($c['no_kelompok']).'?test_type='.$test_type?>">
                        <p class="k-title">Kelompok <?= htmlspecialchars($c['no_kelompok'])?></p>
                        <div class="k-angkatan"><?= $c['angkatan'] ? 'Angkatan '.htmlspecialchars($c['angkatan']) : '&nbsp;'?></div>
                        <div class="k-anggota" title="<?= htmlspecialchars(implode(', ', $c['members']))?>">
                            <i class="material-icons" style="font-size:14px;vertical-align:middle;">people</i>
                            <?= $c['jumlah_anggota']?> anggota
                        </div>

                        <div class="mini-progress-label"><span>Terisi</span><span><?= $c['terisi']?>/<?= $c['total_soal']?></span></div>
                        <div class="mini-progress"><div style="width:<?= $pctTerisi?>%; background:#4CAF50;"></div></div>

                        <div class="mini-progress-label"><span>Dinilai</span><span><?= $c['dinilai']?>/<?= $c['total_soal']?></span></div>
                        <div class="mini-progress"><div style="width:<?= $pctDinilai?>%; background:#2196F3;"></div></div>

                        <div class="k-footer">
                            <div>
                                <div class="k-nilai"><?= $c['rata_nilai'] !== null ? $c['rata_nilai'] : '-'?></div>
                                <div class="k-nilai-label">Rata-rata Nilai</div>
                            </div>
                            <i class="material-icons k-arrow">arrow_forward</i>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <!-- JS -->
    <?php $this->load->view('guru/layout/javascript')?>
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
</body>

</html>
