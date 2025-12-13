<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Data Identitas Mata Kuliah | Pendidikan IPA Terpadu</title>
    
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
                    Manajemen Perkualiahan
                </h2>
            </div>
            <!-- #END# Basic Examples -->
            <!-- Table User Siswa -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Mata Kuliah
                            </h2>
                        </div>
                        <div class="body m-l-30 m-r-30">
                            <?php if ($this->session->flashdata('ver') == "FALSE") { ?>
                                <div class="alert alert-<?=$this->session->flashdata("class_alert");?>" role="alert">
                                <?= $this->session->flashdata('alert'); 
                                    $this->session->set_flashdata('ver', 'TRUE');
                                ?>
                                </div>
                            <?php } ?>
                            <?php foreach ($data as $d) :?>
                                <form>
                                    <!-- Program Studi -->
                                    <div class="form-group form-float">
                                        <label>Program Studi </label>
                                        <input class="form-control" value="<?= $d->program_studi?>" disabled/>
                                    </div>
                                    
                                    <!-- Nama Mata Kuliah -->
                                    <div class="form-group form-float">
                                        <label>Nama Mata Kuliah </label>
                                        <input class="form-control" value="<?= $d->nama_mata_kuliah?>" disabled/>
                                    </div>
                                    
                                    <!-- Kode Mata Kuliah -->
                                    <div class="form-group form-float">
                                        <label>Kode Mata Kuliah </label>
                                        <input class="form-control" value="<?= $d->kode_mata_kuliah?>" disabled/>
                                    </div>

                                    <!-- Bobot SKS -->
                                    <div class="form-group form-float">
                                        <label>SKS </label>
                                        <input class="form-control" value="<?= $d->bobot_sks?> SKS" disabled/>
                                    </div>
                                    
                                    <!-- jenjang -->
                                    <div class="form-group form-float">
                                        <label>Jenjang </label>
                                        <input class="form-control" value="<?= $d->jenjang?>" disabled/>
                                    </div>
                                    
                                    <!-- semester -->
                                    <div class="form-group form-float">
                                        <label>Semester</label>
                                        <input class="form-control" value="<?= $d->semester?>" disabled/>
                                    </div>
                                    
                                    <!-- Status -->
                                    <div class="form-group form-float">
                                        <label>Status Mata Kuliah </label>
                                        <input class="form-control" value="<?= $d->status?>" disabled/>
                                    </div>
                                    
                                    <!-- Deskripsi Mata Kuliah -->
                                    <div class="form-group form-float">
                                        <label>Deskripsi Mata Kuliah </label>
                                        <?= $d->deskripsi_mata_kuliah?>
                                    </div>

                                    <!-- CPL Mata Kuliah -->
                                    <div class="form-group form-float">
                                        <label>Capaian Pembelajaran Lulusan (CPL)</label>
                                        <?= $d->cpl?>
                                    </div>

                                    <!-- CPMK Mata Kuliah -->
                                    <div class="form-group form-float">
                                        <label>Capaian Pembelajaran Mata Kuliah (CPMK)</label>
                                        <?= $d->cpmk?>
                                    </div>

                                    <!-- Link RPS -->
                                    <div class="form-group">
                                        <label>RPS</label>
                                        <br>
                                        <a href="<?=$d->link_rps?>" target="_blank"><?= $d->link_rps?></a>
                                    </div>

                                    <!-- Link Modul -->
                                    <div class="form-group">
                                        <label>Modul Materi</label>
                                        <br>
                                        <a href="<?=$d->link_modul?>" target="_blank"><?= $d->link_modul?></a>
                                    </div>

                                    <!-- Created at -->
                                    <div class="form-group form-float">
                                        <label>Dibuat pada tanggal</label>
                                        <input class="form-control" value="<?= $d->created_at?>" disabled/>
                                    </div>

                                    <!-- Updated at-->
                                    <div class="form-group form-float">
                                        <label>Diubah pada tanggal</label>
                                        <input class="form-control" value="<?= $d->updated_at?>" disabled/>
                                    </div>

                                    <!-- Edit Form -->
                                    <a class="dropdown-item btn btn-warning" onclick="return confirm ('Apakah Anda Yakin Akan Mengedit Data ini ?')"  href="<?= base_url().'guru/MataKuliah/edit/'. $d->id_mata_kuliah?>" title="Edit Data Pertemuan">
                                    <i class="material-icons">edit</i> Edit Data Mata Kuliah</a>
                                    
                                </form>
                            <?php endforeach; ?>
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
