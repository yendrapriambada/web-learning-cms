<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit Data Alur Perkualiahan | Pendidikan IPA Terpadu</title>
    
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
                                Alur Perkuliahan
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
                                <form id="form_advanced_validation" method="POST" action="<?= base_url().'guru/AlurPerkuliahan/do_edit'?>">
                                    <!-- Id Alur Pembelajaran -->
                                     <input type="hidden" name="id_alur_pembelajaran" value="<?= $dataById->id_alur_pembelajaran?>">

                                    <!-- Mata Kuliah -->
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="id_mata_kuliah" id="id_mata_kuliah"required>
                                                <option value="<?= $dataById->id_mata_kuliah?>"><?= $dataById->nama_mata_kuliah?></option>
                                                <?php foreach ($matkul as $mk) { ?>
                                                    <option value="<?= $mk->id_mata_kuliah?>"><?= $mk->nama_mata_kuliah?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Pertemuan -->
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="id_pertemuan" id="id_pertemuan"required>
                                                <option value="<?= $dataById->id_pertemuan?>"><?= $dataById->judul_pertemuan?></option>
                                                <?php foreach ($pertemuan as $p) { ?>
                                                    <option value="<?= $p->id_pertemuan?>"><?= $p->judul_pertemuan?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Indikator Pembelajaran -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="indikator_pembelajaran">Indikator Pembelajaran <span class="text-danger">*</span></label>
                                        <textarea id="ckeditor1" name="indikator_pembelajaran" required>
                                            <?= $dataById->indikator_pembelajaran?>
                                        </textarea>
                                    </div>
                                    <?= form_error("indikator_pembelajaran",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Bahan Kajian -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="bahan_kajian">Bahan Kajian (Topik) <span class="text-danger">*</span></label>
                                        <textarea id="ckeditor2" name="bahan_kajian" required>
                                            <?= $dataById->bahan_kajian?>
                                        </textarea>
                                    </div>
                                    <?= form_error("bahan_kajian",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Aktivitas Perkuliahan -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="aktivitas_perkuliahan">Aktivitas Perkuliahan <span class="text-danger">*</span></label>
                                        <textarea id="ckeditor3" name="aktivitas_perkuliahan" required>
                                            <?= $dataById->aktivitas_perkuliahan?>
                                        </textarea>
                                    </div>
                                    <?= form_error("aktivitas_perkuliahan",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- Pengalaman Belajar -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="pengalaman_belajar">Pengalaman Belajar Mahasiswa <span class="text-danger">*</span></label>
                                        <textarea id="ckeditor4" name="pengalaman_belajar" required>
                                            <?= $dataById->pengalaman_belajar?>
                                        </textarea>
                                    </div>
                                    <?= form_error("pengalaman_belajar",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Kebutuhan Pembelajaran -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="kebutuhan_pembelajaran">Kebutuhan Pembelajaran <span class="text-danger">*</span></label>
                                        <textarea id="ckeditor5" name="kebutuhan_pembelajaran" required>
                                            <?= $dataById->kebutuhan_pembelajaran?>
                                        </textarea>
                                    </div>
                                    <?= form_error("kebutuhan_pembelajaran",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Alokasi Waktu -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="alokasi_waktu" name="alokasi_waktu" value="<?= $dataById->alokasi_waktu?>" required/>
                                            <label class="form-label" for="alokasi_waktu">Alokasi Waktu (Menit) <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <?= form_error("alokasi_waktu",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Deskripsi Tugas -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="deskripsi_tugas">Deskripsi Tugas <span class="text-danger">*</span></label>
                                        <textarea id="ckeditor6" name="deskripsi_tugas" required>
                                            <?= $dataById->deskripsi_tugas?>
                                        </textarea>
                                    </div>
                                    <?= form_error("deskripsi_tugas",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Submit button -->
                                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                                    <a href="<?= base_url().'guru/AlurPembelajaran'?>" class="btn btn-danger waves-effect" type="submit">BATAL</a>
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
        CKEDITOR.replace('ckeditor4');
        CKEDITOR.replace('ckeditor5');
        CKEDITOR.replace('ckeditor6');
    </script>
</body>

</html>
