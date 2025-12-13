<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit Foto Profil Pengguna | Pendidikan IPA Terpadu</title>

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
                    Edit Data
                </h2>
            </div>
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Pengguna</h2>
                        </div>
                        <div class="body">
                            <?php if ($this->session->flashdata('ver') == "FALSE") { ?>
                                <div class="alert alert-<?=$this->session->flashdata("class_alert");?>" role="alert">
                                <?= $this->session->flashdata('error'); 
                                    $this->session->set_flashdata('ver', 'TRUE');
                                ?>
                                </div>
                            <?php } ?>
                            <br>
                            (<span class="text-danger">*</span>) : formulir isian wajib di isi.
                            <br><br><br>
                            <div class="mt-3">
                                <form id="form_advanced_validation" method="POST" action="<?= base_url().'guru/Pengguna/do_edit_profil'?>" enctype="multipart/form-data">
                                    <!-- Role User input -->
                                    <input type="hidden" name="id_role_user" value="<?= $dataById->id_role_user?>">

                                    <!-- ID USer -->
                                    <input type="hidden" name="id_user" value="<?= $dataById->id_user?>">

                                    <!-- Foto Profil Lama -->
                                    <h4>Foto Profil Lama</h4>
                                    <img class="rounded m-t-10 m-b-20 " src="<?= base_url().'assets/uploads/'.$dataById->foto_profil ?>" width="40%" alt="" srcset="">

                                    <!-- Foto Profil Input -->
                                    <div class="form-outline mb-4">
                                        <label for="foto_profil" class="form-label">Upload Foto Profil Baru <span class="text-danger">*</span></label>
                                        <input class="form-control" type="file" id="foto_profil" name="foto_profil" required/>
                                        <small>Keterangan:</small>
                                        <ul style="list-style-type:circle;margin-bottom: 20px">
                                            <li><small>Ukuran file maksimal 1 MB</small></li>
                                            <li><small>Tipe file yang diperbolehkan adalah JPEG, JPG, dan PNG</small></li>
                                            <li><small>Maksimal lebar gambar 1024</small></li>
                                        </ul>
                                    </div>
                                    
                                    <!-- Submit button -->
                                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>

                                    <!-- Batal button -->
                                    <a href="<?= base_url().'guru/Pengguna'?>" class="btn btn-danger waves-effect" type="submit">BATAL</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>

    <!-- JS -->
    <?php $this->load->view('guru/layout/javascript')?>
    <!-- JS -->

    <!-- Custom Js -->
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
    <script src="<?= base_url();?>assets_guru/js/pages/forms/basic-form-elements.js"></script>
    <script src="<?= base_url();?>assets_guru/js/pages/forms/form-validation.js"></script>
</body>

</html>
