<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit Kata Sandi | Pendidikan IPA Terpadu</title>

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
                            <h2>Kata Sandi</h2>
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
                                <form id="form_advanced_validation" method="POST" action="<?= base_url().'guru/UbahKataSandi/do_edit'?>">

                                    <!-- ID USer -->
                                    <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user')?>">
                                    
                                    <!-- Password Lama-->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" id="password_lama" min="8" name="password_lama" required>
                                            <label class="form-label" for="password_lama">Password Lama <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="help-info">Min. Panjang Password Lama: 8</div>
                                    </div>
                                    <?= form_error("password_lama",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Password Baru-->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" id="password" min="8" name="password" required>
                                            <label class="form-label" for="password">Password Baru <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="help-info">Min. Panjang Password Baru: 8</div>
                                    </div>
                                    <?= form_error("pasword",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- Konfirmasi Password Baru-->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" id="konfirmasi_password" min="8" name="konfirmasi_password" required>
                                            <label class="form-label" for="konfirmasi_password">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="help-info">Min. Panjang Konfirmasi Password Baru: 8</div>
                                    </div>
                                    <?= form_error("konfirmasi_password",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?> 

                                    <!-- Submit button -->
                                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                                    <a href="<?= base_url().'guru/Beranda'?>" class="btn btn-danger waves-effect" type="submit">BATAL</a>
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
