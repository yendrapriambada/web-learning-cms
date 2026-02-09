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
      <title>Buku Panduan Wesbite - Mahasiswa| Pendidikan IPA Terpadu</title>
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
         <div class="banner_section layout_padding d-flex align-items-center justify-content-center">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="banner_taital_main text-center ">
                                 <h1 class="banner_taital" style="font-size: clamp(32px, 6vw, 80px);">Pendidikan IPA Terpadu</h1>
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


      <!-- Buku Panduan -->
      <div class="projects_section layout_padding" id="ModulMateri">
        <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="projects_taital">Buku Panduan Penggunaan</h1>
               </div>
            </div>
         </div>
         <div class="projects_section_2 layout_padding">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <iframe src="https://drive.google.com/file/d/1giFi4p6oAMd1-qiTyonErr2kmKEcgbjP/preview" style="width:100%; height:650px;" frameborder="0" autoplay control></iframe>
                    </div>
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