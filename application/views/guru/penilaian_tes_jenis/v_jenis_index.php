<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Penilaian Tes — Per Jenis Tes | Pendidikan IPA Terpadu</title>

    <!-- CSS -->
    <?php $this->load->view('guru/layout/header')?>
    <!-- END CSS -->
    <style>
        .view-toggle .btn { border-radius: 20px; padding: 6px 18px; font-size: 13px; }
        .view-toggle .btn.active { background: #3F51B5; color: #fff; }

        .filter-row { display: flex; align-items: center; flex-wrap: wrap; gap: 12px; }
        .filter-row-end { margin-left: auto; display: flex; justify-content: flex-end; }

        .jenis-grid { display: flex; flex-wrap: wrap; margin: 0 -10px; }
        .jenis-col { padding: 0 10px; width: 50%; margin-bottom: 20px; }
        @media (max-width: 700px) { .jenis-col { width: 100%; } }

        .jenis-tile {
            display: block;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e7e7e7;
            border-left: 5px solid #bdbdbd;
            padding: 22px;
            height: 100%;
            box-shadow: 0 1px 3px rgba(0,0,0,.05);
            transition: transform .15s ease, box-shadow .15s ease;
            text-decoration: none;
            color: inherit;
        }
        .jenis-tile:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0,0,0,.12);
            text-decoration: none;
            color: inherit;
        }
        .jenis-tile.pretest  { border-left-color: #1565c0; }
        .jenis-tile.posttest { border-left-color: #ef6c00; }

        .jenis-tile .j-title { font-size: 22px; font-weight: 700; margin: 0 0 4px; }
        .jenis-tile.pretest  .j-title { color: #1565c0; }
        .jenis-tile.posttest .j-title { color: #ef6c00; }
        .jenis-tile .j-sub { font-size: 12px; color: #888; margin-bottom: 16px; }

        .j-stats { display: flex; flex-wrap: wrap; gap: 18px; margin-bottom: 16px; }
        .j-stat-num { font-size: 24px; font-weight: 700; }
        .j-stat-label { font-size: 11px; color: #999; text-transform: uppercase; }

        .j-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 4px; padding-top: 12px; border-top: 1px dashed #eee; }
        .j-nilai { font-size: 20px; font-weight: 700; color: #3F51B5; }
        .j-nilai-label { font-size: 10px; color: #999; text-transform: uppercase; }
        .j-arrow { color: #bbb; }
        .jenis-tile:hover .j-arrow { color: #3F51B5; }

        .empty-state { text-align: center; padding: 50px 10px; color: #888; }

        .delta-up   { color: #2e7d32; font-weight: 700; }
        .delta-down { color: #c62828; font-weight: 700; }
        .delta-flat { color: #999; font-weight: 700; }
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
                <h2>Penilaian Tes</h2>
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
                                <div class="view-toggle btn-group" role="group">
                                    <a href="<?= base_url().'guru/TestUnity'?>" class="btn btn-default">Tampilan Tabel</a>
                                    <a href="<?= base_url().'guru/PenilaianTesKelompok'?>" class="btn btn-default">Tampilan Kelompok</a>
                                    <a href="<?= base_url().'guru/PenilaianTesJenis'?>" class="btn active">Tampilan Jenis Tes</a>
                                </div>
                                <form method="GET" action="<?= base_url().'guru/PenilaianTesJenis'?>" class="filter-row-end" style="gap:8px;">
                                    <select name="angkatan" class="form-control" style="width:220px;" onchange="this.form.submit()">
                                        <option value="">Semua Angkatan</option>
                                        <?php foreach ($filter_angkatan as $f): ?>
                                        <option value="<?= htmlspecialchars($f->angkatan)?>" <?= $filters['angkatan']==$f->angkatan?'selected':''?>>Angkatan <?= htmlspecialchars($f->angkatan)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <a href="<?= base_url().'guru/PenilaianTesJenis'?>" class="btn btn-default waves-effect">Reset</a>
                                </form>
                            </div>

                            <p class="text-muted m-t-15 m-b-0">
                                Pilih Pretest atau Posttest untuk melihat &amp; menilai kelompok berdasarkan jenis tesnya, atau lihat rekap perbandingan rata-rata nilai di bawah.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jenis-grid">
                <div class="jenis-col">
                    <a class="jenis-tile pretest" href="<?= base_url().'guru/PenilaianTesJenis/kelompok/pretest'?>">
                        <p class="j-title">Pretest</p>
                        <div class="j-sub">Tes sebelum pembelajaran</div>
                        <div class="j-stats">
                            <div>
                                <div class="j-stat-num"><?= $summary['pretest']['jumlah_kelompok']?></div>
                                <div class="j-stat-label">Kelompok</div>
                            </div>
                            <div>
                                <div class="j-stat-num"><?= $summary['pretest']['jumlah_siswa']?></div>
                                <div class="j-stat-label">Siswa</div>
                            </div>
                            <div>
                                <div class="j-stat-num"><?= $summary['pretest']['dinilai']?>/<?= $summary['pretest']['total_soal']?></div>
                                <div class="j-stat-label">Dinilai</div>
                            </div>
                        </div>
                        <div class="j-footer">
                            <div>
                                <div class="j-nilai"><?= $summary['pretest']['rata_nilai'] !== null ? $summary['pretest']['rata_nilai'] : '-'?></div>
                                <div class="j-nilai-label">Rata-rata Nilai</div>
                            </div>
                            <i class="material-icons j-arrow">arrow_forward</i>
                        </div>
                    </a>
                </div>
                <div class="jenis-col">
                    <a class="jenis-tile posttest" href="<?= base_url().'guru/PenilaianTesJenis/kelompok/posttest'?>">
                        <p class="j-title">Posttest</p>
                        <div class="j-sub">Tes setelah pembelajaran</div>
                        <div class="j-stats">
                            <div>
                                <div class="j-stat-num"><?= $summary['posttest']['jumlah_kelompok']?></div>
                                <div class="j-stat-label">Kelompok</div>
                            </div>
                            <div>
                                <div class="j-stat-num"><?= $summary['posttest']['jumlah_siswa']?></div>
                                <div class="j-stat-label">Siswa</div>
                            </div>
                            <div>
                                <div class="j-stat-num"><?= $summary['posttest']['dinilai']?>/<?= $summary['posttest']['total_soal']?></div>
                                <div class="j-stat-label">Dinilai</div>
                            </div>
                        </div>
                        <div class="j-footer">
                            <div>
                                <div class="j-nilai"><?= $summary['posttest']['rata_nilai'] !== null ? $summary['posttest']['rata_nilai'] : '-'?></div>
                                <div class="j-nilai-label">Rata-rata Nilai</div>
                            </div>
                            <i class="material-icons j-arrow">arrow_forward</i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header"><h2>Perbandingan Rata-rata Nilai Pretest vs Posttest per Kelompok</h2></div>
                        <div class="body">
                            <?php if (empty($comparison)): ?>
                            <div class="empty-state">
                                <i class="material-icons" style="font-size:48px;">bar_chart</i>
                                <p class="m-t-10 m-b-0">Belum ada nilai pretest/posttest yang bisa dibandingkan.</p>
                            </div>
                            <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Kelompok</th>
                                            <th>Angkatan</th>
                                            <th>Rata Pretest</th>
                                            <th>Rata Posttest</th>
                                            <th>Selisih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($comparison as $c): ?>
                                        <tr>
                                            <td><b>Kelompok <?= htmlspecialchars($c['no_kelompok'])?></b></td>
                                            <td><?= $c['angkatan'] ? htmlspecialchars($c['angkatan']) : '-'?></td>
                                            <td><?= $c['rata_pretest']  !== null ? $c['rata_pretest']  : '-'?></td>
                                            <td><?= $c['rata_posttest'] !== null ? $c['rata_posttest'] : '-'?></td>
                                            <td>
                                                <?php if ($c['delta'] === null): ?>
                                                -
                                                <?php elseif ($c['delta'] > 0): ?>
                                                <span class="delta-up"><i class="material-icons" style="font-size:14px;vertical-align:middle;">arrow_upward</i> +<?= $c['delta']?></span>
                                                <?php elseif ($c['delta'] < 0): ?>
                                                <span class="delta-down"><i class="material-icons" style="font-size:14px;vertical-align:middle;">arrow_downward</i> <?= $c['delta']?></span>
                                                <?php else: ?>
                                                <span class="delta-flat">0</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endif; ?>
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
