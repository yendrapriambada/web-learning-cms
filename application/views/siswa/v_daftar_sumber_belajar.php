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
      <title>Sumber Belajar | Pendidikan IPA Terpadu</title>
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
      
      <!-- Daftar Sumber Belajar -->
      <section class="projects_section layout_padding" id="SumberBelajar">
         <div class="container">
            <div class="row mb-4">
               <div class="col-12 text-center">
                  <h2 class="projects_taital">Sumber Belajar</h2>
                  <p class="banner_text text-dark">
                     Kumpulan sumber belajar dalam bentuk modul, handout, atau bahan bacaan lain
                     yang dapat diakses oleh mahasiswa.
                  </p>
               </div>
            </div>

            <div class="row">
               <?php if (!empty($sumberBelajar)) : ?>
                  <?php foreach ($sumberBelajar as $sb) : ?>
                     <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm">
                           <?php
                              $thumbPath = !empty($sb->thumbnail)
                                 ? base_url('assets/sumber_belajar/thumbnail/'.$sb->thumbnail)
                                 : base_url('assets/img/placeholder_book.png'); // siapkan placeholder jika perlu
                           ?>
                           <img 
                              src="<?= $thumbPath ?>" 
                              class="card-img-top" 
                              alt="Thumbnail Sumber Belajar"
                              style="height: 220px; object-fit: cover;"
                           >

                           <div class="card-body d-flex flex-column">
                              <h5 class="card-title" style="font-size: 16px; font-weight: 600;">
                                 <?= htmlspecialchars($sb->judul, ENT_QUOTES, 'UTF-8') ?>
                              </h5>

                              <?php if (!empty($sb->created_at)) : ?>
                                 <p class="card-text mb-2" style="font-size: 12px; color:#777;">
                                    Dipublikasikan: <?= date('d M Y', strtotime($sb->created_at)) ?>
                                 </p>
                              <?php endif; ?>

                              <div class="mt-auto">
                                 <?php if (!empty($sb->pdf_sumber_belajar)) : ?>
                                    <a href="<?= base_url('assets/sumber_belajar/pdf/'.$sb->pdf_sumber_belajar) ?>" 
                                       target="_blank" 
                                       class="btn btn-primary btn-sm btn-block">
                                       Buka / Download PDF
                                    </a>
                                 <?php else : ?>
                                    <span class="badge badge-secondary">Belum ada file PDF</span>
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php endforeach; ?>
               <?php else : ?>
                  <div class="col-12 text-center">
                     <p>Belum ada sumber belajar yang tersedia.</p>
                  </div>
               <?php endif; ?>
            </div>
         </div>
      </section>
      <!-- Daftar Sumber Belajar end -->
      
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