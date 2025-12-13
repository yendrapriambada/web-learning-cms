<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit Data Mata Kuliah | Pendidikan IPA Terpadu</title>
    
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
                                Mata Kuliah
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
                                <form id="form_advanced_validation" method="POST" action="<?= base_url().'guru/MataKuliah/do_edit'?>">
                                    <!-- Id Mata Kuliah -->
                                    <input type="hidden" name="id_mata_kuliah" value="<?= $dataById->id_mata_kuliah?>">

                                    <!-- Program Studi -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="program_studi" name="program_studi" value="<?= $dataById->program_studi?>" required/>
                                            <label class="form-label" for="program_studi">Program Studi <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <?= form_error("program_studi",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- Nama Mata Kuliah -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="nama_mata_kuliah" name="nama_mata_kuliah" value="<?= $dataById->nama_mata_kuliah?>" required/>
                                            <label class="form-label" for="nama_mata_kuliah">Nama Mata Kuliah <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <?= form_error("nama_mata_kuliah",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- Kode Mata Kuliah -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="kode_mata_kuliah" name="kode_mata_kuliah" value="<?= $dataById->kode_mata_kuliah?>" required/>
                                            <label class="form-label" for="kode_mata_kuliah">Kode Mata Kuliah <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <?= form_error("kode_mata_kuliah",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Bobot SKS -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="bobot_sks" name="bobot_sks" value="<?= $dataById->bobot_sks?>" required/>
                                            <label class="form-label" for="bobot_sks">Bobot SKS <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <?= form_error("bobot_sks",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- jenjang -->
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="jenjang" id="jenjang" required>
                                                <option value="<?= $dataById->jenjang?>"><?= $dataById->jenjang?></option>
                                                <option value="D1">D1</option>
                                                <option value="D2">D2</option>
                                                <option value="D3">D3</option>
                                                <option value="D4">D4</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?= form_error("jenjang",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- semester -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="semester" name="semester" value="<?= $dataById->semester?>" required/>
                                            <label class="form-label" for="semester">Semester <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <?= form_error("semester",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- Status -->
                                    <div class="form-group">
                                        <label class="m-b-20">Status Mata Kuliah <span class="text-danger">*</span></label>
                                        <br>
                                        <input type="radio" class="with-gap" name="status" id="wajib" value="wajib" <?php if($dataById->status == "wajib") {echo "checked";}?> required>
                                        <label for="wajib">Wajib</label>
                                        
                                        <input type="radio" class="with-gap" name="status" id="pilihan" value="pilihan" <?php if($dataById->status == "pilihan") {echo "checked";}?> required>
                                        <label for="pilihan" class="m-l-80">Pilihan</label>
                                    </div>
                                    <?= form_error("status",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- Link RPS -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="url" class="form-control" id="link_rps" name="link_rps" value="<?= $dataById->link_rps?>"/>
                                            <label class="form-label" for="link_rps">Link RPS (Jika Ada)</label>
                                        </div>
                                        <div class="help-info">URL Link Drive</div>
                                    </div>

                                    <!-- Link Modul -->
                                    <div class="form-group form-float">
                                        <br>
                                        <span class="text-danger">(*) Pastikan format link modul sesuai dengan contoh berikut: https://drive.google.com/file/d/10N3I6E7-pwh2rQUnjxSMsQjTIW3QzGnk/preview</span>
                                        <br>
                                        <br>
                                        <div class="form-line">
                                            <input type="url" class="form-control" id="link_modul" name="link_modul"  value="<?= $dataById->link_modul?>"/>
                                            <label class="form-label" for="link_modul">Link Modul Materi (*)</label>
                                        </div>
                                        <div class="help-info">URL Link Drive: Pastikan Format Link Berakhiran Preview contoh https://drive.google.com/file/d/10N3I6E7-pwh2rQUnjxSMsQjTIW3QzGnk/preview</div>
                                    </div>
                                    
                                    <!-- Deksripsi Mata Kuliah -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="deskripsi_mata_kuliah">Deskripsi Mata Kuliah</label>
                                        <textarea id="ckeditor1" name="deskripsi_mata_kuliah">
                                            <?= $dataById->deskripsi_mata_kuliah?>
                                        </textarea>
                                    </div>

                                    <!-- CPL Mata Kuliah -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="cpl">Capaian Pembelajaran Lulusan (CPL)</label>
                                        <textarea id="ckeditor2" name="cpl">
                                            <?= $dataById->cpl?>
                                        </textarea>
                                    </div>

                                    <!-- CPMK Mata Kuliah -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="cpmk">Capaian Pembelajaran Mata Kuliah (CPMK)</label>
                                        <textarea id="ckeditor3" name="cpmk">
                                            <?= $dataById->cpmk?>
                                        </textarea>
                                    </div>

                                    <!-- Submit button -->
                                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                                    <a href="<?= base_url().'guru/MataKuliah'?>" class="btn btn-danger waves-effect" type="submit">BATAL</a>
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
