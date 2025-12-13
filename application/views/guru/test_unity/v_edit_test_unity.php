<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit Data Tes Unity | Pendidikan IPA Terpadu</title>
    
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
                               Penilaian Tes Unity
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
                                <form id="form_advanced_validation" method="POST" action="<?= base_url().'guru/TestUnity/do_edit'?>">
                                    <!-- Id Jawaban Essai-->
                                    <input type="hidden" name="id_test_unity" value="<?= $dataById->id_test_unity?>">

                                    <!-- Soal -->
                                    <div class="form-group form-float">
                                        <label class="form-label mb-3" for="pertanyaan">Pertanyaan</label><br><br>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" disabled style="border: 1px grey solid; padding: 20px"><?= $dataById->pertanyaan?></textarea>
                                    </div>

                                    <!-- Jawaban -->
                                    <div class="form-group form-float">
                                        <label class="form-label mb-3" for="jawaban">Jawaban Mahasiswa</label><br><br>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" disabled style="border: 1px grey solid; padding: 20px"><?= $dataById->jawaban?></textarea>
                                    </div>

                                    
                                    <!-- Nilai -->
                                    <div class="form-group form-float">
                                        <label class="form-label mb-3" for="nilai">Masukan Nilai</label><br><br>
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="nilai" name="nilai" required/>
                                            <label class="form-label" for="nilai">Nilai <span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <!-- Feedback -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="feedback">Feedback</label>
                                        <textarea id="ckeditor1" name="feedback"></textarea>
                                    </div>

                                    <!-- Submit button -->
                                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                                    <a href="<?= base_url().'guru/TestUnity'?>" class="btn btn-danger waves-effect" type="submit">BATAL</a>
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
        CKEDITOR.replace('ckeditor2');
        CKEDITOR.replace('ckeditor3');
    </script>
</body>

</html>
