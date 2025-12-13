<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Tambah Data Pengguna | Pendidikan IPA Terpadu</title>

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
                    Tambah Data
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
                            <div class="alert alert-warning mt-4 mb-4" role="alert">
                                Perhatian, <b>Email</b> dan <b>Username</b> yang sudah didaftarkan tidak dapat di Ubah atau di Edit kembali!
                            </div>
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
                                <form id="form_advanced_validation" method="POST" action="<?= base_url().'guru/Pengguna/do_input'?>" enctype="multipart/form-data">
                                    <!-- Role User input -->
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="id_role_user" id="id_role_user"required>
                                                <option value="">-- Silahkan Pilih Peran Pengguna --</option>
                                                <?php foreach ($roleUser as $ru) { ?>
                                                    <option value="<?= $ru->id_role_user?>"><?= $ru->role_user?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Foto Profil Input -->
                                    <div class="form-outline mb-4">
                                        <label for="foto_profil" class="form-label">Upload Foto Profil <span class="text-danger">*</span></label>
                                        <input class="form-control" type="file" id="foto_profil" name="foto_profil" required/>
                                        <small>Keterangan:</small>
                                        <ul style="list-style-type:circle;margin-bottom: 20px">
                                            <li><small>Ukuran file maksimal 1 MB</small></li>
                                            <li><small>Tipe file yang diperbolehkan adalah JPEG, JPG, dan PNG</small></li>
                                            <li><small>Maksimal lebar gambar 1024</small></li>
                                        </ul>
                                    </div>
                                    
                                    <!-- Nama Lengkap -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required/>
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
                                            <input type="text" class="form-control" id="angkatan" name="angkatan" required/>
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
                                            <input type="text" class="form-control" id="sekolah" name="sekolah" required/>
                                            <label class="form-label" for="sekolah">Nama Sekolah/Institusi/Universitas <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <?= form_error("sekolah",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- Email -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" class="form-control" id="email" name="email" required/>
                                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <?= form_error("email",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                        
                                    <!-- Tanggal Lahir -->
                                    <div class="form-group form-float">
                                        <label class="form-label" for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <div class="form-line">
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
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
                                        <input type="radio" class="with-gap" name="jenis_kelamin" id="laki-laki" value="L" required>
                                        <label for="laki-laki">Laki-Laki</label>
                                        
                                        <input type="radio" class="with-gap" name="jenis_kelamin" id="perempuan" value="P" required>
                                        <label for="perempuan" class="m-l-80">Perempuan</label>
                                    </div>
                                    <?= form_error("jenis_kelamin",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    <!-- No. Kelompok -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="no_kelompok" name="no_kelompok"/>
                                            <label class="form-label" for="no_kelompok">No. Kelompok <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <?= form_error("no_kelompok",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>

                                    <!-- Username -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="username"name="username" min="3" max="16" required>
                                            <label class="form-label" for="username">Username <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="help-info">Min. Panjang Username: 3, Max. Panjang Username: 16</div>
                                    </div>
                                    <?= form_error("username",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- Password -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" id="password" min="8" name="password" required>
                                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="help-info">Min. Panjang Password: 8</div>
                                    </div>
                                    <?= form_error("pasword",
                                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>")?>
                                    
                                    <!-- Konfirmasi Password -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" id="konfirmasi_password" min="8" name="konfirmasi_password" required>
                                            <label class="form-label" for="konfirmasi_password">Konfirmasi Password <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="help-info">Min. Panjang Konfirmasi Password: 8</div>
                                    </div>
                                    <?= form_error("konfirmasi_password",
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
