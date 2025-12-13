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
          <!-- Pengantar Mata Kuliah -->
          <div class="projects_section layout_padding"  style="padding-bottom: 10px !important">
             <div class="container">
                <div class="row">
                   <div class="col-md-12">
                      <h1 class="projects_taital">Pengenalan Worksheet</h1>
                          <div class="nav-tabs-navigation">
                             <div class="nav-tabs-wrapper">
                                <ul class="nav" id="worksheetTabs">
                                   <li class="nav-item">
                                      <a class="nav-link active tab-link"
                                         href="#Deskripsi"
                                         data-target="#Deskripsi">
                                         Deskripsi
                                      </a>
                                   </li>
                                   <li class="nav-item">
                                      <a class="nav-link tab-link"
                                         href="#RPS"
                                         data-target="#RPS">
                                         RPS
                                      </a>
                                   </li>
                                </ul>
                             </div>
                          </div>
                   </div>
                </div>
             </div>
           </div>
       
        <!-- TAB 1: Deskripsi -->
        <div class="projects_section layout_padding tab-section" id="Deskripsi" style="padding-top: 0px !important">
            <div class="container">
                <div class="pets_section text-justify">
                    <p>
                      Pengembangan Worksheet Pendidikan IPA Terpadu ini dirancang untuk mendukung inovasi pembelajaran pada mata kuliah IPA Terpadu melalui pendekatan 6E STEM Learning (Engage, Explore, Explain, Engineer, Enrich, Evaluate). Model ini memadukan unsur sains, teknologi, rekayasa, dan matematika ke dalam pengalaman belajar yang terstruktur, kontekstual, dan berorientasi pemecahan masalah. Mengacu pada dokumen pengembangan kurikulum dan perangkat ajar, worksheet berbasis web ini menyediakan lingkungan belajar interaktif yang memungkinkan mahasiswa mengakses materi, melakukan eksplorasi, merancang solusi rekayasa sederhana, serta merefleksikan pemahaman mereka secara mandiri maupun kolaboratif.
                    </p>
                    <p>
                      Integrasi teknologi digital dalam bentuk web-based worksheet mendorong terbentuknya literasi teknologi dan rekayasa, dua kompetensi penting dalam pembelajaran abad ke-21. Melalui aktivitas yang mengarahkan mahasiswa untuk menganalisis fenomena IPA, memecahkan masalah autentik, serta mengembangkan produk rekayasa sederhana, perangkat ini membantu memperkuat kemampuan berpikir kritis, kreatif, dan terapan. Dengan demikian, pengembangan worksheet ini menjadi wahana strategis untuk mempersiapkan calon guru IPA yang mampu merancang pembelajaran terpadu, adaptif, dan relevan dengan tuntutan dunia pendidikan modern.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- TAB 2: RPS -->
        <div class="projects_section_2 layout_padding tab-section" id="RPS">
            <div class="container">
                <div class="pets_section">
                    <!-- Identitas Mata Kuliah -->
                    <?php foreach ($matkul as $mk) { ?>
                    <!-- download RPS -->
                    <a href="<?= $mk->link_rps?>" target="_blank"> <i class="fa fa-download mr-2" aria-hidden="true"></i>Download RPS</a>
                     <!-- END download RPS -->

                    <div class="card mb-5 mt-3">
                        <div class="card-body">
                           <!-- Identitas Mata Kuliah -->
                           <h4 class="card-title fw-bold"><b>A. Identitas Mata Kuliah</b></h2>
                           <div class="card-text">
                              <table class="table table-borderless">
                                 <tr>
                                    <th>Program Studi</th>
                                    <td>:</td>
                                    <td><?= $mk->program_studi?><??></td>
                                 </tr>
                                 <tr>
                                    <th>Nama Matakuliah</th>
                                    <td>:</td>
                                    <td><?= $mk->nama_mata_kuliah?><??></td>
                                 </tr>
                                 <tr>
                                    <th>Kode Matakuliah</th>
                                    <td>:</td>
                                    <td><?= $mk->kode_mata_kuliah?><??></td>
                                 </tr>
                                 <tr>
                                    <th>Semester</th>
                                    <td>:</td>
                                    <td><?= $mk->semester?><??></td>
                                 </tr>
                                 <tr>
                                    <th>SKS/Bobot</th>
                                    <td>:</td>
                                    <td><?= $mk->bobot_sks?><??></td>
                                 </tr>
                                 <tr>
                                    <th>Jenjang</th>
                                    <td>:</td>
                                    <td><?= $mk->jenjang?><??></td>
                                 </tr>
                                 <tr>
                                    <th>Status (wajib/pilihan)</th>
                                    <td>:</td>
                                    <td><?= $mk->status?><??></td>
                                 </tr>
                              </table>
                           </div>
                           <!-- CPL dan CPMK -->
                           <h4 class="card-title fw-bold"><b>B.Capaian Pembelajaran </b></h2>
                           <div class="card-text">
                              <table class="table table-borderless text-justify">
                                 <tr>
                                    <th>B.1. Capaian Pembelajaran Lulus (CPL)</th>
                                 </tr>
                                 <tr>
                                    <td><?= $mk->cpl?></td>
                                 </tr>
                                 <tr>
                                    <th>B.2. Capaian Pembelajaran Matakuliah (CPMK)</th>
                                 </tr>
                                 <tr>
                                    <td><?= $mk->cpmk?></td>
                                 </tr>
                              </table>
                           </div>
                           <!-- Deskripsi Mata Kuliah -->
                           <h4 class="card-title fw-bold"><b>C. Deskripsi Mata Kuliah </b></h2>
                           <div class="card-text">
                              <div class="text-justify">
                                 <?= $mk->deskripsi_mata_kuliah?>
                              </div>
                           </div>
                           <!-- END deskripsi -->
                        </div>
                    </div>
                    <?php }?>
                    <!-- END Identitas Mata Kuliah -->
                    <div class="card">
                       <div class="card-body">
                          <h4 class="card-title fw-bold mt-4"><b>D. Alur Pembelajaran</b></h2>
                          <div class="card-text">
                             <!-- Alur Pembelajaran -->
                             <div class="table-responsive mt-5">
                                <table class="table table-bordered" id="apTable">
                                   <thead>
                                         <tr>
                                            <th class="text-center">Tatap Muka Ke-</th>
                                            <th class="text-center">Sub CPMK/Indikator Pembelajaran</th>
                                            <th class="text-center">Bahan Kajian</th>
                                            <th class="text-center">Aktivitas Perkualiahan</th>
                                            <th class="text-center">Pengalaman Belajar Mahasiswa</th>
                                            <th class="text-center">Kebutuhan Pembelajaran</th>
                                            <th class="text-center">ALokasi Waktu</th>
                                            <th class="text-center">Deskripsi Tugas</th>
                                         </tr>
                                   </thead>
                                   <tbody>
                                         <?php $no=1; foreach ($alurPembelajaran as $d) :
                                            ?>
                                            <tr>
                                               <td class="text-center align-top"><?= $d->no_pertemuan?></td>
                                               <td class="align-top"><?= $d->indikator_pembelajaran?></td>
                                               <td class="align-top"><?= $d->bahan_kajian?></td>
                                               <td class="align-top"><?= $d->aktivitas_perkuliahan?></td>
                                               <td class="align-top"><?= $d->pengalaman_belajar?></td>
                                               <td class="align-top"><?= $d->kebutuhan_pembelajaran?></td>
                                               <td class="align-top"><?= $d->alokasi_waktu?></td>
                                               <td class="align-top"><?= $d->deskripsi_tugas?></td>
                                            </tr>
                                         <?php $no++; endforeach; ?>
                                   </tbody>
                                </table>
                             </div>
                             <!-- END Alur Pembelajaran -->
                          </div>
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
      <script>
         new DataTable('#apTable', {
            responsive: true,
            "pageLength": 5, // Default number of entries per page
            "lengthMenu": [5, 10, 25, 50, 100] // Options for entries per page
         });
         
    $(function () {

      function showTab(target) {
         // sembunyikan semua section
         $('.tab-section').hide();
         // tampilkan yang dipilih
         $(target).show();

         // ganti status active di menu
         $('.tab-link').removeClass('active');
         $('.tab-link[data-target="' + target + '"]').addClass('active');
      }

      // klik tab
      $('.tab-link').on('click', function (e) {
             e.preventDefault();
             const target = $(this).data('target');
    
             // update URL hash (opsional)
             if (history.replaceState) {
                history.replaceState(null, null, target);
             } else {
                window.location.hash = target;
             }
    
             showTab(target);
          });
    
          // kondisi awal: cek hash URL
          const hash = window.location.hash;
          if (hash && $(hash).length) {
             showTab(hash);
          } else {
             showTab('#Deskripsi'); // default tab
          }
       });

      </script>
   </body>
</html>