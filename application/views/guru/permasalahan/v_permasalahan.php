<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Data Permasalahan Worksheet | Pendidikan IPA Terpadu</title>
    
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
                    Manajemen Worksheet
                </h2>
            </div>
            <!-- #END# Basic Examples -->
            <!-- Table User Siswa -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Permasalahan Worksheet
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
                            
                            <!-- button create -->
                            <a class="dropdown-item btn btn-primary" href="<?= base_url().'guru/Permasalahan/create/'?>" title="Tambah Data Permasalahan">
                            <i class="material-icons">note_add</i></a>
                            <!-- #END# button create -->
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Pertemuan</th>
                                            <th>Tahapan Pembelajaran</th>
                                            <th>Judul Permasalahan</th>
                                            <th>Deskripsi Permasalahan</th>
                                            <th>Foto Permasalahan</th>
                                            <th>Jumlah Soal</th>
                                            <th>Link Permasalahan (Unity atau Embed Link lainnya)</th>
                                            <th>Created_at</th>
                                            <th>Updated_at</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($data as $d) :?>
                                            <tr>
                                                <td><?= $no?></td>
                                                <td><?= $d->no_pertemuan?></td>
                                                <td><?= $d->tahapan_pembelajaran?></td>
                                                <td><?= $d->judul_permasalahan?></td>
                                                <td><?= $d->deskripsi_permasalahan?></td>
                                                <td>
                                                    <?php if($d->foto != " ") {?>
                                                        <img src="<?= base_url().'assets/soal/'.$d->foto?>" alt="foto soal" srcset="" width="100%">
                                                        <a class="dropdown-item btn btn-danger" onclick="return confirm ('Apakah Anda Yakin Akan Menghapus Foto ini ?')"  href="<?= base_url().'guru/Permasalahan/hapus_foto_permasalahan/'. $d->id_permasalahan?>" title="Hapus Foto Permasalahan">
                                                        Hapus</a>
                                                    <?php } else { echo "-";}?>
                                                </td>
                                                <td><?= $d->jumlah_soal?></td>
                                                <td><?= $d->link_permasalahan?></td>
                                                <td><?= $d->created_at?></td>
                                                <td><?= $d->updated_at?></td>
                                                <td>
                                                    <a class="dropdown-item btn btn-warning" onclick="return confirm ('Apakah Anda Yakin Akan Mengedit Data ini ?')"  href="<?= base_url().'guru/Permasalahan/edit/'. $d->id_permasalahan?>" title="Edit Data Permasalahan">
                                                        <i class="material-icons">edit</i></a>
                                                    <a class="dropdown-item btn btn-danger" onclick="return confirm ('Apakah Anda Yakin Akan Menghapus Data ini ?')"  href="<?= base_url().'guru/Permasalahan/delete/'. $d->id_permasalahan?>" title="Hapus Permanen Data Permasalahan">
                                                        <i class="material-icons">delete_forever</i></a>
                                                </td>
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
