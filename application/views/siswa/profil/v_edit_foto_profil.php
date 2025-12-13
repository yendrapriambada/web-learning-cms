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
      <title>Edit Foto Profil | Pendidikan IPA Terpadu</title>
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
                  <h2 class="projects_taital">Edit Foto Profil</h2>
               </div>
            </div>
         </div>
         <div class="projects_section_2 layout_padding">
            <div class="container">
               <div class="pets_section">
                <!-- FORM Edit Profil -->
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
                        <p>Keterangan:</p>
                        <ul style="list-style-type:circle;margin-bottom: 20px">
                            <li>Ukuran file maksimal 1 MB</li>
                            <li>Tipe file yang diperbolehkan adalah JPEG, JPG, dan PNG</li>
                            <li>Maksimal lebar gambar 1024</li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form id="form_advanced_validation" method="POST" action="<?= base_url().'siswa/Profil/do_edit_foto_profil'?>" enctype="multipart/form-data">
                            <!-- ID USer -->
                            <input type="hidden" name="id_user" value="<?= $dataById->id_user?>">

                            <!-- Foto Profil Input -->
                            <div class="form-outline mb-4">
                                <label for="foto_profil" class="form-label">Upload Foto Profil Baru <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="foto_profil" name="foto_profil" required/>
                            </div>

                            <div class="form-outline">
                                <!-- Submit button -->
                                <button class="btn btn-primary" type="submit">SUBMIT</button>
                                <!-- Batal button -->
                                <a href="<?= base_url().'siswa/Profil'?>" class="btn btn-danger" type="submit">BATAL</a>
                            </div>
                        </form>
                    </div>
                 </div>
                <!-- END FORM Edit Profil -->
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