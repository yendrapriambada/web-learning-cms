<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit Sumber Belajar| Pendidikan IPA Terpadu</title>
    
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
                                Sumber Belajar
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
                                <form id="form_advanced_validation" method="POST" action="<?= base_url().'guru/SumberBelajar/do_edit'?>" enctype="multipart/form-data">
                                    <!-- Id Pertemuan -->
                                    <input type="hidden" name="id_sumber_belajar" value="<?= $dataById->id_sumber_belajar?>">

                                    <!-- Judul -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="judul" name="judul" value="<?= $dataById->judul?>"/>
                                            <label class="form-label" for="judul">Judul <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="help-info">Contoh: Work Sheet Identifikasi Masalah</div>
                                    </div>
                                    
                                    <!-- Thumbnail -->
                                    <div class="form-outline mb-4">
                                        <label for="thumbnail" class="form-label">Upload Thumbnail <span class="text-danger">*</span></label>
                                        <input class="form-control" type="file" id="thumbnail" name="thumbnail" accept=".jpg,.jpeg,.png"/>
                                        <small>Keterangan:</small>
                                        <ul style="list-style-type:circle;margin-bottom: 20px">
                                            <li><small>Ukuran file maksimal 2 MB</small></li>
                                            <li><small>Tipe file yang diperbolehkan adalah JPEG, JPG, dan PNG</small></li>
                                            <li><small>Maksimal lebar gambar 1024</small></li>
                                        </ul>
                                        <?php if (!empty($dataById->thumbnail)) { ?>
                                            <img src="<?= base_url('assets/sumber_belajar/thumbnail/'.$dataById->thumbnail) ?>" 
                                                 alt="Thumbnail" 
                                                 style="max-width: 200px; max-height: 200px; border:1px solid #ccc; margin-bottom:10px;">
                                        <?php } else { ?>
                                            <p><i>Tidak ada thumbnail</i></p>
                                        <?php } ?>
                                    </div>

                                    <!-- pdf sumber belajar -->
                                    <div class="form-group form-float">
                                        <label for="pdf_sumber_belajar" class="form-label">Upload PDF Sumber Belajar <span class="text-danger">*</span></label>
                                        <input class="form-control" type="file" id="pdf_sumber_belajar" name="pdf_sumber_belajar" accept=".pdf"/>
                                        <small>Keterangan:</small>
                                        <ul style="list-style-type:circle;margin-bottom: 20px">
                                            <li><small>Ukuran file maksimal 5 MB</small></li>
                                            <li><small>Tipe file yang diperbolehkan adalah PDF</small></li>
                                            <li><small>Maksimal lebar gambar 1024</small></li>
                                        </ul>
                                    </div>

                                    <!-- Submit button -->
                                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                                    <a href="<?= base_url().'guru/SumberBelajar'?>" class="btn btn-danger waves-effect" type="submit">BATAL</a>
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

    <script>
        CKEDITOR.replace('ckeditor1');
    </script>
</body>

</html>
