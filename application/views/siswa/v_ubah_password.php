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
      <title>Ubah Kata Sandi | Pendidikan IPA Terpadu</title>
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

      <!-- Pengantar Mata Kuliah -->
      <div class="projects_section layout_padding" id="ModulMateri">
        <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h2 class="projects_taital">Ubah Kata Sandi</h2>
               </div>
            </div>
         </div>
         <div class="projects_section_2 layout_padding">
            <div class="container">
               <div class="pets_section">
                <!-- FORM Ubah Kata Sandi -->
                 <div class="card">
                    <div class="card-header">
                        <?php if ($this->session->flashdata('ver') == "FALSE") { ?>
                            <div class="alert alert-<?=$this->session->flashdata("class_alert");?>" role="alert">
                            <?= $this->session->flashdata('error'); 
                                $this->session->set_flashdata('ver', 'TRUE');
                            ?>
                            </div>
                        <?php } ?>
                        <br>
                        (<span class="text-danger">*</span>) : formulir isian wajib di isi.
                    </div>
                    <div class="card-body">
                        <form id="form_advanced_validation" method="POST" action="<?= base_url().'siswa/UbahKataSandi/do_edit'?>">

                            <!-- ID USer -->
                            <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user')?>">

                            <!-- Password Lama-->
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="password_lama">Password Lama <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_lama" min="8" name="password_lama" required>
                                </div>
                                <div class="help-info">Min. Panjang Password Lama: 8</div>
                            </div>
                            <?= form_error("password_lama",
                                    "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>")?>

                            <!-- Password Baru-->
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="password">Password Baru <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" min="8" name="password" required>
                                </div>
                                <div class="help-info">Min. Panjang Password Baru: 8</div>
                            </div>
                            <?= form_error("pasword",
                                    "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>")?>

                            <!-- Konfirmasi Password Baru-->
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="konfirmasi_password">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="konfirmasi_password" min="8" name="konfirmasi_password" required>
                                </div>
                                <div class="help-info">Min. Panjang Konfirmasi Password Baru: 8</div>
                            </div>
                            <?= form_error("konfirmasi_password",
                                    "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>")?> 

                            <!-- Submit button -->
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            <a href="<?= base_url().'siswa/PengenalanMataKuliah'?>" class="btn btn-danger waves-effect" type="submit">BATAL</a>
                        </form>
                    </div>
                 </div>
                <!-- END FORM Ubah Kata Sandi -->
               </div>
            </div>
         </div>
      </div>
      <!-- Pengantar Mata Kuliah -->
      <!-- footer section start -->
      <?php $this->load->view('siswa/layout/footer')?>
      <!-- footer section end -->
      <!-- copyright section start -->
      <?php $this->load->view('siswa/layout/copyright')?>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <?php $this->load->view('siswa/layout/javascript')?>
   </body>
</html>