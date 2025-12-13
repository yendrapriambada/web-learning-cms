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
      <title>Nilai | Pendidikan IPA Terpadu</title>
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
      <!-- Nilai -->
      <div class="projects_section layout_padding" id="RPS">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="projects_taital">Nilai</h1>
                  <div class="nav-tabs-navigation">
                     <div class="nav-tabs-wrapper">
                        <h3><?= $this->session->userdata('nama_lengkap')?></h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="projects_section_2 layout_padding">
            <div class="container">
               <div class="pets_section">
                    <div class="table-responsive mt-5">
                        <!-- View Tabel Score -->
                        <table class="table table-bordered" id="apTable">
                            <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Score Pretest</th>
                                        <th class="text-center">Score Posttest</th>
                                        <th class="text-center">Score Simulasi Pertemuan</th>
                                    </tr>
                            </thead>
                            <tbody>
                                    <?php $no=1; foreach ($score as $d) :
                                    ?>
                                    <tr>
                                        <td class="text-center align-top"><?= $no?></td>
                                        <td class="align-top"><?= $d->score_pretest?></td>
                                        <td class="align-top"><?= $d->score_posttest?></td>
                                        <td class="align-top"><?= $d->score_pertemuan?></td>
                                    </tr>
                                    <?php $no++; endforeach; ?>
                            </tbody>
                        </table>
                        <!-- END View Table Score -->
                    </div>
               </div>
            </div>
            <br><br>
            <div class="container">
                <div class="card">
                <div class="card-body">
                    <h4 class="card-title fw-bold mt-4"><b>Riwayat Jawaban dan Nilai Worksheet</b></h2>
                    <div class="card-text">
                        <!-- Jawaban Worksheet -->
                        <div class="table-responsive mt-5">
                            <!-- View Tabel Score -->
                            <table class="table table-bordered" id="apTable2">
                                <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Pertemuan</th>
                                            <th class="text-center">Tahap Pembelajaran</th>
                                            <th class="text-center">Nomor Soal</th>
                                            <th class="text-center">Nilai</th>
                                            <th class="text-center">Tanggal Pengiriman</th>
                                            <th class="text-center">Tanggal Pengeditan</th>
                                            <th class="text-center">Lihat Detail</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php $no=1; foreach ($jawabanEssai as $JE) : 
                                            $SoalEssaiByPermasalahan = $this->db->get_where('v_permasalahan', ['id_permasalahan' => $JE->id_permasalahan])->row();
                                        ?>
                                        <tr>
                                            <td class="text-center align-top"><?= $no?></td>
                                            <td class="align-top">Pertemuan Ke-<?= $SoalEssaiByPermasalahan->no_pertemuan?></td>
                                            <td class="align-top"><?= $SoalEssaiByPermasalahan->tahapan_pembelajaran?></td>
                                            <td class="text-center align-top"><?= $JE->no_soal?></td>
                                            <td class="align-top"><?= $JE->nilai?></td>
                                            <td class="align-top"><?= $JE->created_at?></td>
                                            <td class="align-top"><?= $JE->updated_at?></td>
                                            <td class="text-center align-top">
                                                <a href="#"
                                                    id="lookDetail"
                                                    data-toggle="modal" 
                                                    data-target="#jawabanEssai<?=$JE->id_jawaban_essai?>"
                                                    class="btn btn-success"
                                                    title="Lihat Detail Data Pengguna">
                                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div id="jawabanEssai<?=$JE->id_jawaban_essai?>" class='modal fade' h-index="-1" role='dialog' aria-hidden='true' data-backdrop='false'>
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="akun_login">Detail Jawaban</h5>
                                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></a>
                                                </div>
                                                <div class="modal-body">
                                                    <h4><b>Soal</b></h4>
                                                    <p><?= $JE->deksripsi_soal?></p>
                                                    <hr>
                                                    <h4><b>Jawaban</b></h4>
                                                    <p><?= $JE->jawaban_text?></p>

                                                    <img class="rounded" src="<?= base_url().'assets/jawaban_gambar/'.$JE->jawaban_gambar ?>" width="90%" alt="" srcset="">
                                                    <?php if ($JE->jawaban_file != NULL) { ?>
                                                        <a href="<?= base_url().'assets/jawaban_file/'.$JE->jawaban_file ?>" class="download-button" download="Jawaban PowerPoint_<?= $this->session->userdata('nama_lengkap')?>.pptx">Download PPT: <?= $JE->jawaban_file?></a>
                                                    <?php } ?>
                                                    <hr>
                                                    <h4><b>Feedback Dosen</b></h4>
                                                    <p><?= $JE->feedback?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /modal -->
                                        <?php $no++; endforeach; ?>
                                </tbody>
                            </table>
                            <!-- Jawaban Worksheet -->
                        </div>
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
         new DataTable('#apTable2', {
            responsive: true,
            "pageLength": 5, // Default number of entries per page
            "lengthMenu": [5, 10, 25, 50, 100] // Options for entries per page
         });
      </script>
   </body>
</html>