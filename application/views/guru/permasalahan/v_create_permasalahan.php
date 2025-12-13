<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Tambah Data Permasalahan | Pendidikan IPA Terpadu</title>
    
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
                <h2>Tambah Data</h2>
            </div>

            <!-- CKEditor -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Permasalahan
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
                                <form id="form_advanced_validation" method="POST" action="<?= base_url().'guru/Permasalahan/do_create'?>" enctype="multipart/form-data">
                                    <!-- Pertemuan -->
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="id_pertemuan" id="id_pertemuan" required>
                                                <option value="">-- Silahkan Pilih Pertemuan <span class="text-danger">*</span> --</option>
                                                <?php foreach ($pertemuan as $p) { ?>
                                                    <option value="<?= $p->id_pertemuan?>">Pertemuan Ke-<?= $p->no_pertemuan?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Tahapan Pembelajaran -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="tahapan_pembelajaran" name="tahapan_pembelajaran" required/>
                                            <label class="form-label" for="tahapan_pembelajaran">Tahapan Pembelajaran <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="help-info">Tahapan Pembelajaran pada model yang digunakan, misalnya Engineering, Explore, dst.</div>
                                    </div>
                                    <?= form_error("tahapan_pembelajaran",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Judul Permasalahan -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="judul_permasalahan" name="judul_permasalahan"/>
                                            <label class="form-label" for="judul_permasalahan">Judul Permasalahan </label>
                                        </div>
                                        <div class="help-info">Contoh: Work Sheet Identifikasi Masalah</div>
                                    </div>
                                    
                                    <!-- Deskripsi Permasalahan -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="deskripsi_permasalahan">Deskripsi Permasalahan </label>
                                        <textarea id="ckeditor1" name="deskripsi_permasalahan">
                                        </textarea>
                                    </div>

                                    <!-- Foto Permasalahan -->
                                    <div class="form-outline mb-4">
                                        <label for="foto" class="form-label">Upload Foto Permasalahan (jika ada) </label>
                                        <input class="form-control" type="file" id="foto" name="foto"/>
                                        <small>Keterangan:</small>
                                        <ul style="list-style-type:circle;margin-bottom: 20px">
                                            <li><small>Ukuran file maksimal 1 MB</small></li>
                                            <li><small>Tipe file yang diperbolehkan adalah JPEG, JPG, dan PNG</small></li>
                                            <li><small>Maksimal lebar gambar 1024</small></li>
                                        </ul>
                                    </div>

                                    <!-- Jumlah Soal -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="jumlah_soal" name="jumlah_soal" required/>
                                            <label class="form-label" for="jumlah_soal">Jumlah Soal <span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <!-- Link Permasalahan -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="url" class="form-control" id="link_permasalahan" name="link_permasalahan"/>
                                            <label class="form-label" for="link_permasalahan">Link Permasalahan </label>
                                        </div>
                                        <div class="help-info">Link Permasalahan diisi ketika permasalahan membutuhkan penerapan halaman lain seperti Unity, dan lainnya</div>
                                    </div>

                                    <!-- Submit button -->
                                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                                    <a href="<?= base_url().'guru/Permasalahan'?>" class="btn btn-danger waves-effect" type="submit">BATAL</a>
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
