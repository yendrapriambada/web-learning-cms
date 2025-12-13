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
      <title>Pengenalan Mata Kuliah - Modul Materi | Pendidikan IPA Terpadu</title>
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
      <div class="header_section">
         <!-- banner section start -->
         <div class="banner_section layout_padding">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="banner_taital_main text-center ">
                                 <h1 class="banner_taital">Pendidikan IPA Terpadu</h1>
                                 <p class="banner_text">PENGEMBANGAN PERKULIAHAN IPA TERPADU BERBASIS 6E STEM LEARNING BERBANTUKAN WEB BASED WORKSHEET UNTUK MEMBANGUN LITERASI TEKNOLOGI DAN REKAYASA </p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        <!-- banner section end -->
      </div>
      <!-- header section end -->
      <!-- Pengantar Mata Kuliah -->
      <div class="projects_section layout_padding" id="ModulMateri">
        <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="projects_taital">Pengantar Mata Kuliah</h1>
                  <div class="nav-tabs-navigation">
                     <div class="nav-tabs-wrapper">
                        <ul class="nav " data-tabs="tabs">
                           <li class="nav-item">
                              <a class="nav-link" href="<?= base_url().'siswa/PengenalanMataKuliah#RPS'?>">RPS</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link active" href="<?= base_url().'siswa/PengenalanMataKuliah/view_modul#ModulMateri'?>">Modul Materi</a>
                           </li>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="projects_section_2 layout_padding">
            <div class="container">
               <div class="pets_section">
                  <!-- View Modul Materi -->
                  <?php foreach ($matkul as $mk) { ?>
                     <div class="card mt-3">
                        <div class="card-body">
                            <iframe src="<?= $mk->link_modul?>" style="width:100%; height:650px;" frameborder="0" autoplay control></iframe>
                        </div>
                     </div>
                  <?php }?>
                  <!-- View Modul Materi -->
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