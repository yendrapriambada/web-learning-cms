<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Register || Pendidikan IPA Terpadu</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">

      <!-- CSS -->
      <?php $this->load->view('siswa/layout/header')?>
      <!-- /CSS -->
   </head>
   <body>
      <!-- header top section start -->
      <?php $this->load->view('siswa/layout/responsive_navbar')?>
      <!-- header top section start -->

      <!-- header section start -->
      <div class="header_section_login">
         <!-- banner section start -->
         <div class="banner_section_login layout_padding">
            <div class="card mx-auto d-block" style="width: 88%;">
               <div class="card-body">
                  <!-- <h1 class="text-center mb-3 mt-3">Pendidikan IPA Terpadu Logo</h1> -->
                  <img src="<?= base_url().'assets/logo/logo with type - alt 1.png'?>" alt="" srcset="" width="25%" class="mx-auto d-block">
                  <div class="card-title mt-3">
                     <h2 class="mt-3 mb-4">Buat Akun Baru!</h2>
                     <div class="alert alert-success mt-4 mb-4" role="alert">
                        Silahkan isi data diri anda dengan teliti untuk membuat akun baru sebagai Mahasiswa/i atau Dosen pada Website Pendidikan IPA Terpadu!
                     </div>
                     <div class="alert alert-warning mt-4 mb-4" role="alert">
                        Perhatian, <b>Email</b> dan <b>Username</b> yang sudah didaftarkan tidak dapat di Ubah atau di Edit kembali!
                     </div>
                  </div>

                  <?php if ($this->session->flashdata('ver') == "FALSE") { ?>
                     <div class="alert alert-<?=$this->session->flashdata("class_alert");?>" role="alert">
                     <?= $this->session->flashdata('error'); 
                        $this->session->set_flashdata('ver', 'TRUE');
                     ?>
                     </div>
                  <?php } ?>

                  <!-- form login -->
                  <?= form_open_multipart('Register/do_input', ['class'=>'form-horizontal mb-3']);?>
                     (<span class="text-danger">*</span>) : formulir isian wajib di isi.
                     <div class="mb-3"></div>

                     <!-- Role User input -->
                     <div class="mb-4">
                        <label class="form-label" for="id_role_user">Daftar Sebagai <span class="text-danger">*</span> </label>
                        <br>
                        <small class="text-danger mb-3">Pilih jenis pendaftaran anda sebelum melanjutkan proses pendaftaran</small>
                        <select id="selectRole" onChange="update()" class="form-control mt-3" name="id_role_user" required>
                           <?php foreach ($roleUser as $ru) { ?>
                              <option value="<?= $ru->id_role_user?>"><?= $ru->role_user?></option>
                           <?php } ?>
                        </select>
                     </div>

                     <!-- Kode Dosen -->
                     <div class="form-outline mb-4" id="kode_dosen" style="display: none">
                        <label for="nama_lengkap">Kode Dosen</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" name="kode_dosen" id="kode_dosen" placeholder="Masukan Kode Dosen"/>
                     </div>

                     <!-- Foto Profil Input -->
                     <div class="form-outline mb-4">
                        <label for="foto_profil" class="form-label">Upload Foto Profil <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="foto_profil" name="foto_profil" required/>
                        <small>Keterangan:</small>
                        <ul style="list-style-type:circle">
                          <li><small>Ukuran file maksimal 1 MB</small></li>
                          <li><small>Tipe file yang diperbolehkan adalah JPEG, JPG, dan PNG</small></li>
                          <li><small>Maksimal lebar gambar 1024</small></li>
                        </ul>
                     </div>

                     <!-- Nama Lengkap -->
                     <div class="form-outline mb-4">
                        <label for="nama_lengkap">Nama Lengkap</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" name="nama_lengkap" required/>
                      </div>
                      <?= form_error("nama_lengkap",
                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>")?>

                     <!-- Tahun Angkatan -->
                     <div class="form-outline mb-4">
                        <label for="angkatan">Tahun Angkatan</label><span class="text-danger">*</span>
                        <br>
                        <small class="text-warning">Jika anda dosen cukup inputkan "-"</small>
                        <input type="text" class="form-control" id="angkatan" placeholder="Tahun Angkatan" name="angkatan" required/>
                      </div>
                      <?= form_error("angkatan",
                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>")?>
                     
                     
                     <!-- Sekolah -->
                      <div class="form-outline mb-4">
                        <label for="sekolah">Nama Sekolah/Institusi/Universitas</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="sekolah" placeholder="Nama Sekolah/Institusi/Universitas" name="sekolah" required/>
                      </div>
                      <?= form_error("sekolah",
                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>")?>
                     
                     <!-- Email -->
                      <div class="form-outline mb-4">
                        <label for="email">Email</label><span class="text-danger">*</span>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required/>
                      </div>
                      <?= form_error("email",
                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>")?>
                           
                     <!-- Tanggal Lahir -->
                      <div class="form-outline mb-4">
                        <label for="tanggal_lahir">Tanggal Lahir</label><span class="text-danger">*</span>
                        <input type="date" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir" name="tanggal_lahir" required>
                      </div>
                      <?= form_error("tanggal_lahir",
                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>")?>
                     
                     <!-- Jenis Kelamin -->
                      <div class="form-outline mb-4 row">
                        <label class="col-sm-3 col-form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="jenis_kelamin" id="laki-laki" value="L" required> Laki-Laki <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="jenis_kelamin" id="perempuan" value="P" required> Perempuan <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                      <?= form_error("jenis_kelamin",
                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>")?>
                            
                     <!-- No. Kelompok -->
                     <div class="form-outline mb-4">
                        <label for="no_kelompok">No. Kelompok</label>
                        <br>
                        <small class="text-warning">Jika anda dosen, kosongkan kolom.</small>
                        <input type="number" class="form-control" id="no_kelompok" placeholder="No. Kelompok" name="no_kelompok"/>
                      </div>
                      <?= form_error("no_kelompok",
                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>")?>
                     
                     <!-- Username -->
                      <div class="form-outline mb-4">
                        <label for="username">Username</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
                      </div>
                      <?= form_error("username",
                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>")?>
                     
                     <!-- Password -->
                      <div class="form-outline mb-4">
                        <label for="password">Password</label><span class="text-danger">*</span>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                      </div>
                      <?= form_error("paswword",
                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>")?>
                     
                     <!-- Konfirmasi Password -->
                      <div class="form-outline mb-4">
                        <label for="konfirmasi_password">Konfirmasi Password</label><span class="text-danger">*</span>
                        <input type="password" class="form-control" id="konfirmasi_password" placeholder="Konfirmasi Password" name="konfirmasi_password" required>
                      </div>  
                      <?= form_error("konfirmasi_password",
                            "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>")?> 

                     <!-- Submit button -->
                     <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Simpan</button>

                     <!-- Batal button -->
                     <a href="<?= base_url().'Login'?>" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block mb-4">Batal</a>
                     
                  <?= form_close() ?>
                  <!-- form login -->
               </div>
            </div>
         </div>
        <!-- banner section end -->
      </div>
      <!-- header section end -->

      <!-- copyright section start -->
      <?php $this->load->view('siswa/layout/copyright')?>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <?php $this->load->view('siswa/layout/javascript')?>
      <!-- /Javascript files-->

      <script type="text/javascript">
        function update() {
            var roleUser = document.getElementById('selectRole');
            var value = roleUser.options[roleUser.selectedIndex].value;
            console.log(value);

            if (value == "2"){
                document.getElementById('kode_dosen').style.display = "block";
                document.getElementById('kode_guru').required = true;
            } else {
               document.getElementById('kode_dosen').style.display = "none";
               document.getElementById('kode_guru').required = false;
            }
        }
      </script>
   </body>
</html>