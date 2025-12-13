<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit Data Pertemuan | Pendidikan IPA Terpadu</title>
    
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
                <h2>Edit Data</h2>
            </div>

            <!-- CKEditor -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Pertemuan
                            </h2>
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
                                <form id="form_advanced_validation" method="POST" action="<?= base_url().'guru/Pertemuan/do_edit'?>">
                                    <!-- Id Pertemuan -->
                                    <input type="hidden" name="id_pertemuan" value="<?= $dataById->id_pertemuan?>">

                                    <!-- Nomor Pertemuan -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="no_pertemuan" name="no_pertemuan" value="<?= $dataById->no_pertemuan?>" required disabled/>
                                            <label class="form-label" for="no_pertemuan">Nomor Pertemuan<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="help-info">Nomor Pertemuan tidak dapat di edit</div>
                                    </div>
                                    
                                    <!-- Tema Proyek -->
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label class="form-label" for="id_tema_proyek">Tema Proyek<span class="text-danger">*</span></label>
                                            <br>
                                            <select class="form-control" name="id_tema_proyek" id="id_tema_proyek" required>
                                                <option value="<?= $dataById->id_tema_proyek?>"><?= $dataById->tema_proyek?></option>
                                                <?php foreach ($temaProyek as $ru) { ?>
                                                    <option value="<?= $ru->id_tema_proyek?>"><?= $ru->tema_proyek?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Judul Pertemuan -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="judul_pertemuan" name="judul_pertemuan" value="<?= $dataById->judul_pertemuan?>" required/>
                                            <label class="form-label" for="judul_pertemuan">Judul Pertemuan<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="help-info">Contoh: pertemuan ke-1, pertemuan ke-2, dst.,</div>
                                    </div>
                                    <?= form_error("judul_pertemuan",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- Deksripsi Pertemuan -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="deskripsi_pertemuan">Deksripsi Pertemuan</label>
                                        <textarea id="ckeditor" name="deskripsi_pertemuan">
                                            <?= $dataById->deskripsi_pertemuan?>
                                        </textarea>
                                    </div>
                                    
                                    <!-- Status -->
                                    <div class="form-group">
                                        <label class="m-b-20">Status Pertemuan<span class="text-danger">*</span></label>
                                        <br>
                                        <input type="radio" class="with-gap" name="status" id="tidak-aktif" value="0" <?php if($dataById->status == "0") { echo "checked";}?> required>
                                        <label for="tidak-aktif">Tidak Aktif</label>
                                        
                                        <input type="radio" class="with-gap" name="status" id="aktif" value="1" <?php if($dataById->status == "1") { echo "checked";}?> required>
                                        <label for="aktif" class="m-l-80">Aktif</label>
                                    </div>
                                    <?= form_error("status",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Submit button -->
                                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                                    <a href="<?= base_url().'guru/Pertemuan'?>" class="btn btn-danger waves-effect" type="submit">BATAL</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CKEditor -->
        </div>
    </section>

    <!-- JS -->
    <?php $this->load->view('guru/layout/javascript')?>
    <!-- JS -->

    <!-- Custom Js -->
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
    <script src="<?= base_url();?>assets_guru/js/pages/forms/editors.js"></script>
    <script src="<?= base_url();?>assets_guru/js/pages/forms/basic-form-elements.js"></script>
    <script src="<?= base_url();?>assets_guru/js/pages/forms/form-validation.js"></script>
</body>

</html>
