<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Data Nilai Simulasi | Pendidikan IPA Terpadu</title>
    
    <!-- CSS -->
    <?php $this->load->view('guru/layout/header')?>
    <!-- END CSS -->

</head>

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
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <?php $this->load->view('guru/layout/navbar')?>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <?php $this->load->view('guru/layout/left_sidebar')?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <?php $this->load->view('guru/layout/right_sidebar')?>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Manajemen Nilai
                </h2>
            </div>
            <!-- #END# Basic Examples -->
            <!-- Table User Siswa -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Nilai Simulasi Mahasiswa
                            </h2>
                        </div>
                        <div class="body">
                            <?php if ($this->session->flashdata('ver') == "FALSE") { ?>
                                <div class="alert alert-<?=$this->session->flashdata("class_alert");?>" role="alert">
                                <?= $this->session->flashdata('alert'); 
                                    $this->session->set_flashdata('ver', 'TRUE');
                                ?>
                                </div>
                            <?php } ?>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Nama Lengkap</th>
                                            <th class="text-center">No. Kelompok</th>
                                            <th class="text-center">Jenis_Kelamin</th>
                                            <th class="text-center">Institusi/Sekolah/Perguruan Tinggi</th>
                                            <th class="text-center">Score Pretest</th>
                                            <th class="text-center">Score Posttest</th>
                                            <th class="text-center">Score Simulasi Engineering</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($score as $s) :?>
                                            <tr>
                                                <td class="text-center align-top"><?= $no?></td>
                                                <td class="align-top"><?= $s->username?></td>
                                                <td class="align-top"><?= $s->nama_lengkap?></td>
                                                <td class="align-top"><?= $s->no_kelompok?></td>
                                                <td class="text-center align-top"><?= $s->jenis_kelamin?></td>
                                                <td class="align-top"><?= $s->sekolah?></td>
                                                <td class="text-center align-top"><?= $s->score_pretest?></td>
                                                <td class="text-center align-top"><?= $s->score_posttest?></td>
                                                <td class="text-center align-top"><?= $s->score_pertemuan?></td>
                                            </tr>
                                        <?php $no++; endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

    <!-- JS -->
    <?php $this->load->view('guru/layout/javascript')?>
    <!-- JS -->

    <!-- Custom Js -->
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
    <script src="<?= base_url();?>assets_guru/js/pages/tables/jquery-datatable.js"></script>
</body>

</html>
