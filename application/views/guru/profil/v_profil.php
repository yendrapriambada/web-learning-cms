<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Profil| Pendidikan IPA Terpadu</title>
    
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
                    Profil
                </h2>
            </div>
            <!-- #END# Basic Examples -->
            <!-- Data Profil -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Diri <?= $this->session->userdata('nama_lengkap')?>
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
                            <table class="table table-borderless">
                                <tr>
                                    <td rowspan="7" width="230" class="text-center m-r-30">
                                        <img class="rounded" src="<?= base_url().'assets/uploads/'.$data->foto_profil ?>" width="90%" alt="" srcset="">
                                        <p><a onclick="return confirm ('Apakah Anda Yakin Akan Mengedit Foto Profil?')"  href="<?= base_url().'guru/Profil/edit_foto_profil/'. $data->id_user?>"> Edit Foto Profil </a></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="110">Nama</th>
                                    <td width="60">:</td>
                                    <td><?= $data->nama_lengkap?></td>
                                </tr>
                                <tr>
                                    <th width="110">Institusi/Sekolah/Universitas</th>
                                    <td width="60">:</td>
                                    <td><?= $data->sekolah?></td>
                                </tr>
                                <tr>
                                    <th width="110">Email</th>
                                    <td width="60">:</td>
                                    <td><?= $data->email?></td>
                                </tr>
                                <tr>
                                    <th width="110">Tanggal Lahir</th>
                                    <td width="60">:</td>
                                    <td><?= $data->tanggal_lahir?></td>
                                </tr>
                                <tr>
                                    <th width="110">Jenis Kelamin</th>
                                    <td width="60">:</td>
                                    <td><?= $data->jenis_kelamin?></td>
                                </tr>
                                <tr>
                                    <th width="110">Username</th>
                                    <td width="60">:</td>
                                    <td><?= $data->username?></td>
                                </tr>
                            </table>
                            <a class="dropdown-item btn btn-warning" onclick="return confirm ('Apakah Anda Yakin Akan Mengedit Data Diri Anda ?')"  href="<?= base_url().'guru/Profil/form_edit/'. $data->id_user?>" title="Edit Data Profil">
                            <i class="material-icons">edit</i> Edit Profil</a>
                        </div>        
                    </div>
                </div>
            </div>
            <!-- #END# Data Profil -->
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
