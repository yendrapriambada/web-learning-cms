<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit Data Pengguna | Pendidikan IPA Terpadu</title>

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
                                <form id="form_advanced_validation" method="POST" action="<?= base_url().'guru/Pengguna/do_edit'?>" enctype="multipart/form-data">
                                    <!-- Role User input -->
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="id_role_user" id="id_role_user"required>
                                                <option value="<?= $dataById->id_role_user?>"><?= $dataById->role_user?></option>
                                                <?php foreach ($dataRoleUser as $ru) { ?>
                                                    <option value="<?= $ru->id_role_user?>"><?= $ru->role_user?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- ID USer -->
                                    <input type="hidden" name="id_user" value="<?= $dataById->id_user?>">
                                    
                                    <!-- Nama Lengkap -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $dataById->nama_lengkap?>" required/>
                                            <label class="form-label" for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <?= form_error("nama_lengkap",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- Tahun Angkatan -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="angkatan" name="angkatan" value="<?= $dataById->angkatan?>" required/>
                                            <label class="form-label" for="angkatan">Tahun Angkatan <span class="text-danger">*</span></label>
                                            <small class="text-warning">Jika anda dosen Tahun Angkatan cukup inputkan "-"</small>
                                        </div>
                                    </div>
                                    <?= form_error("angkatan",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- Sekolah -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="sekolah" name="sekolah" value="<?= $dataById->sekolah?>" required/>
                                            <label class="form-label" for="sekolah">Nama Sekolah/Institusi/Universitas <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <?= form_error("sekolah",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                        
                                    <!-- Tanggal Lahir -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <div class="form-line">
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $dataById->tanggal_lahir?>" required>
                                        </div>
                                    </div>
                                    <?= form_error("tanggal_lahir",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- Jenis Kelamin -->
                                    <div class="form-group">
                                        <label class="m-b-20">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <br>
                                        <input type="radio" class="with-gap" name="jenis_kelamin" id="laki-laki" value="L" <?php if ($dataById->jenis_kelamin == "L") {echo "checked";}?> required>
                                        <label for="laki-laki">Laki-Laki</label>
                                        
                                        <input type="radio" class="with-gap" name="jenis_kelamin" id="perempuan" value="P" <?php if ($dataById->jenis_kelamin == "P") {echo "checked";}?> required>
                                        <label for="perempuan" class="m-l-80">Perempuan</label>
                                    </div>
                                    <?= form_error("jenis_kelamin",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                            
                                    <!-- No. Kelompok -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="no_kelompok" name="no_kelompok" value="<?= $dataById->no_kelompok?>"/>
                                            <label class="form-label" for="no_kelompok">No. Kelompok </label>
                                            <small class="text-warning">Jika anda dosen, kolom ini tidak perlu di isi.</small>
                                        </div>
                                    </div>
                                    <?= form_error("no_kelompok",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Submit button -->
                                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
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
