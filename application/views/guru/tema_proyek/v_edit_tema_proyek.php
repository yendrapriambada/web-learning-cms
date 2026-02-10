<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit Data Tema Proyek | Pendidikan IPA Terpadu</title>

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
                            <h2>Tema Proyek</h2>
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
                                <form id="form_advanced_validation" method="POST" action="<?= base_url().'guru/TemaProyek/do_edit'?>">
                                    <!-- ID Tema Proyek -->
                                    <input type="hidden" name="id_tema_proyek" value="<?=$dataById->id_tema_proyek?>">
                                    
                                    <!-- Tema Proyek -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="tema_proyek" name="tema_proyek" value="<?=$dataById->tema_proyek?>" required/>
                                            <label class="form-label" for="tema_proyek">Tema Proyek <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="help-info">Contoh: Tema 1, Tema 2, Tema 3, dst.</div>
                                    </div>
                                    <?= form_error("tema_proyek",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Status -->
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label class="form-label" for="status">Status<span class="text-danger">*</span></label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="Aktif" <?= ($dataById->status=="Aktif"?"selected":"")?>>Aktif</option>
                                                <option value="Tidak Aktif" <?= ($dataById->status=="Tidak Aktif"?"selected":"")?>>Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?= form_error("status",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Submit button -->
                                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                                    <a href="<?= base_url().'guru/TemaProyek'?>" class="btn btn-danger waves-effect" type="submit">BATAL</a>
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
