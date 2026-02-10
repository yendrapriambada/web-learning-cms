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
      <title>Pengenalan Mata Kuliah | Pendidikan IPA Terpadu</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      
      <!-- CSS -->
      <?php $this->load->view('siswa/layout/header')?>
      <!-- /CSS -->
      
      <style>
        body {
            overflow: hidden;
        }
      </style>

   </head>
   <body>
      <!-- header top section start -->
      <?php $this->load->view('siswa/layout/responsive_navbar')?>
      <!-- header top section start -->

      <!-- header section start -->
      <div class="header_section">
         <!-- banner section start -->
         <div class="banner_section layout_padding d-flex align-items-center justify-content-center" style="height: 80vh;">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
                <div class="container">
                    <div class="row">
                       <div class="col-sm-12">
                          <div class="banner_taital_main text-center" style="valig">
                             <h1 class="banner_taital" style="font-size: clamp(32px, 6vw, 80px);">Worksheet Pendidikan IPA Terpadu</h1>
                             <p class="banner_text">PENGEMBANGAN PERKULIAHAN IPA TERPADU BERBASIS 6E STEM LEARNING BERBANTUKAN WEB BASED WORKSHEET UNTUK MEMBANGUN LITERASI TEKNOLOGI DAN REKAYASA </p>
                              <a href="#" class="btn btn-xl btn-primary" data-toggle="modal" data-target="#deskripsiModal">
                                  Tentang Worksheet 
                              </a>
                          </div>
                       </div>
                    </div>
                </div>
            </div>
         </div>
        <!-- banner section end -->
      </div>
      <!-- header section end -->
      
      <!-- Modal -->
        <div class="modal fade" id="deskripsiModal" tabindex="-1" role="dialog" aria-labelledby="deskripsiModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
        
              <div class="modal-header">
                <h5 class="modal-title" id="deskripsiModalLabel">Deskripsi Worksheet IPA Terpadu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        
              <div class="modal-body" style="text-align: justify;">
                <p>
                  Pengembangan Worksheet Pendidikan IPA Terpadu ini dirancang untuk mendukung inovasi pembelajaran pada mata kuliah IPA Terpadu melalui pendekatan 6E STEM Learning (Engage, Explore, Explain, Engineer, Enrich, Evaluate). Model ini memadukan unsur sains, teknologi, rekayasa, dan matematika ke dalam pengalaman belajar yang terstruktur, kontekstual, dan berorientasi pemecahan masalah. Mengacu pada dokumen pengembangan kurikulum dan perangkat ajar, worksheet berbasis web ini menyediakan lingkungan belajar interaktif yang memungkinkan mahasiswa mengakses materi, melakukan eksplorasi, merancang solusi rekayasa sederhana, serta merefleksikan pemahaman mereka secara mandiri maupun kolaboratif.
                </p>
                <p>
                  Integrasi teknologi digital dalam bentuk web-based worksheet mendorong terbentuknya literasi teknologi dan rekayasa, dua kompetensi penting dalam pembelajaran abad ke-21. Melalui aktivitas yang mengarahkan mahasiswa untuk menganalisis fenomena IPA, memecahkan masalah autentik, serta mengembangkan produk rekayasa sederhana, perangkat ini membantu memperkuat kemampuan berpikir kritis, kreatif, dan terapan. Dengan demikian, pengembangan worksheet ini menjadi wahana strategis untuk mempersiapkan calon guru IPA yang mampu merancang pembelajaran terpadu, adaptif, dan relevan dengan tuntutan dunia pendidikan modern.
                </p>
              </div>
        
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              </div>
        
            </div>
          </div>
        </div>

      <!-- copyright section start -->
      <?php $this->load->view('siswa/layout/copyright')?>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <?php $this->load->view('siswa/layout/javascript')?>
      <script>
         new DataTable('#apTable', {
            responsive: true,
            "pageLength": 5, // Default number of entries per page
            "lengthMenu": [5, 10, 25, 50, 100] // Options for entries per page
         });
      </script>
   </body>
</html>