<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit Data Soal Essai | Pendidikan IPA Terpadu</title>
    
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
                                Soal Essai
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
                                <form id="form_advanced_validation" method="POST" action="<?= base_url().'guru/SoalEssai/do_edit'?>">
                                    <!-- Id Soal Essai -->
                                    <input type="hidden" name="id_soal_essai" value="<?= $dataById->id_soal_essai?>">
                                
                                    <!-- Permasalahan -->
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label class="form-label" for="id_permasalahan">Permasalahan <span class="text-danger">*</span></label>
                                            <br>
                                            <select class="form-control" name="id_permasalahan" id="id_permasalahan" required>
                                                <option value="<?= $dataById->id_permasalahan?>">Pertemuan Ke-<?= $dataById->no_pertemuan?> : <?= $dataById->tahapan_pembelajaran?> || <?= $dataById->judul_permasalahan?> </option>
                                                <?php foreach ($permasalahan as $p) { ?>
                                                    <option value="<?= $p->id_permasalahan?>">Pertemuan Ke-<?= $p->no_pertemuan?> : <?= $p->tahapan_pembelajaran?> || <?=$p->judul_permasalahan?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Nomor Soal -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="no_soal" name="no_soal" value="<?= $dataById->no_soal?>" required/>
                                            <label class="form-label" for="no_soal">Nomor Soal <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <?= form_error("no_soal",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Deskripsi Soal -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label class="form-label" for="deksripsi_soal">Deskripsi Soal <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="deksripsi_soal" name="deksripsi_soal" required rows="4"><?= $dataById->deksripsi_soal?></textarea>
                                        </div>
                                    </div>
                                    <?= form_error("deksripsi_soal",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Tipe Jawaban -->
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label class="form-label" for="tipe_jawaban">Tipe Jawaban <span class="text-danger">*</span></label>
                                            <br>
                                            <select class="form-control" name="tipe_jawaban" id="tipe_jawaban" required>
                                                <option value="<?= $dataById->tipe_jawaban?>"><?= $dataById->type_form?></option>
                                                <?php foreach ($type_form as $p) { ?>
                                                    <option value="<?= $p->id_type_form?>"><?= $p->type_form?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Submit button -->
                                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                                    <a href="<?= base_url().'guru/SoalEssai'?>" class="btn btn-danger waves-effect" type="submit">BATAL</a>
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
