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
      <title>Lupa Password || Pendidikan IPA Terpadu</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">

      <!-- CSS -->
      <?php $this->load->view('siswa/layout/header')?>
      <style>
         @media only screen and (max-width: 800px) {
            .login {
               width: 80%;
            }
         }
         @media only screen and (min-width: 800px) and (max-width: 1200px){
            .login {
               width: 60%;
            }
         }
         @media only screen and (min-width: 1200px) {
            .login {
               width: 40%;
            }
         }
      </style>
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
            <div class="card mx-auto d-block login">
               <div class="card-body">
                  <!-- <h1 class="text-center mb-3 mt-3">Pendidikan IPA Terpadu Logo</h1> -->
                  <img src="<?= base_url().'assets/logo/logo with type - alt 1.png'?>" alt="" srcset="" width="70%" class="mx-auto d-block">
                  <h2 class="card-title mt-3">Ubah Password!</h2>

                  <?php if ($this->session->flashdata('logged_in') == "0") { ?>
                     <div class="alert alert-<?=$this->session->flashdata("class_alert");?> role="alert">
                        <?= $this->session->flashdata('error'); 
                           $this->session->set_flashdata('logged_in', '1');
                        ?>
                     </div>
                  <?php } ?>

                  <?php if ($this->session->flashdata('ver') == "FALSE") { ?>
                     <div class="alert alert-<?=$this->session->flashdata("class_alert");?> role="alert">
                        <?= $this->session->flashdata('error'); 
                           $this->session->set_flashdata('ver', 'TRUE');
                        ?>
                     </div>
                  <?php } ?>

                    <h5> Anda akan merubah password akun lama pada UPI Health Edu Forge</h5>
                    <h6 class="font-weight-light">Masukan email dan username anda untuk melanjutkan</h6>

                  <!-- form login -->
                  <?= form_open('Login/do_forgot_password');?>
                     <!-- Username input -->
                     <div class="form-outline mb-4">
                        <label class="form-label" for="username">Username <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" id="username" name="username" required/>
                        <?= form_error('username')?>
                     </div>

                     <!-- Email input -->
                     <div class="form-outline mb-4">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" id="email" name="email" required/>
                        <?= form_error('email')?>
                     </div>

                     <!-- Password input -->
                     <div data-mdb-input-init class="form-outline mb-4">
                     <label class="form-label" for="password">Password Baru<span class="text-danger">*</span> </label>
                        <input type="password" id="password" name="password" class="form-control" />
                        <?= form_error('password')?>
                     </div>

                     <!-- Konfirmasi Password input -->
                     <div data-mdb-input-init class="form-outline mb-4">
                     <label class="form-label" for="konfirmasi_password">Konfirmasi Password Baru<span class="text-danger">*</span> </label>
                        <input type="password" id="konfirmasi_password" name="konfirmasi_password" class="form-control" />
                        <?= form_error('konfirmasi_password')?>
                     </div>

                     <!-- Submit button -->
                     <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Masuk</button>

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
   </body>
</html>