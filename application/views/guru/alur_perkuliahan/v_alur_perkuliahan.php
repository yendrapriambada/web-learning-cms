<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Data Alur Perkualiahan (RPS) | Pendidikan IPA Terpadu</title>
    
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
                                Data Alur Perkualiahan
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
                            <a class="dropdown-item btn btn-primary" href="<?= base_url().'guru/AlurPerkuliahan/create/'?>" title="Tambah Data Alur Perkuliahan">
                            <i class="material-icons">add_to_queue</i></a>
                            <!-- #END# button create -->
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Mata Kuliah</th>
                                            <th>Pertemuan Ke-</th>
                                            <th>Indikator Pembelajaran</th>
                                            <th>Bahan Kajian</th>
                                            <th>Aktivitas Perkualiahan</th>
                                            <th>Pengalaman Belajar</th>
                                            <th>Kebutuhan Pembelajaran</th>
                                            <th>ALokasi Waktu</th>
                                            <th>Deskripsi Tugas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($data as $d) :
                                            ?>
                                            <tr>
                                                <td><?= $no?></td>
                                                <td><?= $d->nama_mata_kuliah?></td>
                                                <td><?= $d->no_pertemuan?></td>
                                                <td><?= $d->indikator_pembelajaran?></td>
                                                <td><?= $d->bahan_kajian?></td>
                                                <td><?= $d->aktivitas_perkuliahan?></td>
                                                <td><?= $d->pengalaman_belajar?></td>
                                                <td><?= $d->kebutuhan_pembelajaran?></td>
                                                <td><?= $d->alokasi_waktu?></td>
                                                <td><?= $d->deskripsi_tugas?></td>
                                                <td>
                                                    <a class="dropdown-item btn btn-warning" onclick="return confirm ('Apakah Anda Yakin Akan Mengedit Data ini ?')"  href="<?= base_url().'guru/AlurPerkuliahan/edit/'. $d->id_alur_pembelajaran?>" title="Edit Data Pertemuan">
                                                        <i class="material-icons">edit</i></a>
                                                    <a class="dropdown-item btn btn-danger" onclick="return confirm ('Apakah Anda Yakin Akan Menghapus Data ini ?')"  href="<?= base_url().'guru/AlurPerkuliahan/delete/'. $d->id_alur_pembelajaran?>" title="Hapus Permanen Data Pertemuan">
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
