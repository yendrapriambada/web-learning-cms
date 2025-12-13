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
      <title>Pertemuan Ke-<?= $pertemuanById->no_pertemuan?> | Pendidikan IPA Terpadu</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      
      <!-- CSS -->
      <?php $this->load->view('siswa/layout/header')?>
      <!-- /CSS -->

      <!-- CSS -->
      <style>
      .form-control:focus {
         border-color: blue;
         box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 0, 255, 0.6);
      }
      .form-control {
         background-color: #EEEEEE; /* Warna abu-abu terang */
      }
      </style>
      <!-- CSS -->

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
                  <h1 class="projects_taital">Pertemuan Ke-<?= $pertemuanById->no_pertemuan?></h1>
                  <div class="nav-tabs-navigation">
                     <div class="nav-tabs-wrapper">
                        <ul class="nav " data-tabs="tabs">
                           <li class="nav-item">
                              <a class="nav-link active" href="<?= base_url().'siswa/Pertemuan/worksheet/'.$pertemuanById->id_pertemuan?>">Lembar Kerja</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="<?= base_url().'siswa/Diskusi/komentar/'.$pertemuanById->id_pertemuan?>">Diskusi</a>
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
                <!-- kondisi permasalahan null atau tidak -->
                <?php          
                    if ($permasalahan == NULL) {
                        // Data permasalahan kosong atau null
                        echo "Data permasalahan belum tersedia.";
                    } else {
                ?>
                <!-- kondisi permasalahan null atau tidak -->
                 <?php foreach ($permasalahan as $p) { ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="font-weight-bold mt-2"><?= $p->tahapan_pembelajaran?></h3>
                        </div>
                        <div class="card-body">

                           <?php if ($this->session->flashdata('ver') == "FALSE") { ?>
                              <div class="alert alert-<?=$this->session->flashdata("class_alert");?> role="alert">
                                 <?= $this->session->flashdata('alert'); 
                                    $this->session->set_flashdata('ver', 'TRUE');
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
                           
                           <div class="alert alert-info" role="alert">
                              Kode Pengerjaan Worksheet dan Akses Quiz anda adalah <b> <?= $this->session->userdata('id_user')?> </b>
                           </div>

                           <div class="card-title">
                              <p><?= $p->judul_permasalahan?></p>
                           </div>
                           <div class="card-text text-justify">
                              <?= $p->deskripsi_permasalahan?>
                           </div>
                           <?php if ($p->foto != NULL && $p->foto != " " && $p->foto != "") {?>
                              <img src="<?= base_url().'assets/soal/'.$p->foto?>" alt="foto soal" srcset="">
                           <?php } ?>
                           <?php if ($p->link_permasalahan != NULL) {?>
                              <div class="embed-responsive embed-responsive-16by9 mb-3">
                                 <iframe class="embed-responsive-item" src="<?= $p->link_permasalahan?>" allowfullscreen></iframe>
                              </div>
                           <?php } ?>

                           <?php if($p->jumlah_soal > 0) {?>
                           <!-- Form Isian -->
                           <form id="form_advanced_validation" method="POST" action="<?= base_url().'siswa/KoreksiWorksheet'?>" enctype="multipart/form-data">
                              <!-- alert -->
                              <div class="alert alert-primary mb-3 mt-3" role="alert">
                                    <b>Perhatikan!</b>
                                    <li>Ketika halaman di <i>refresh</i> atau dimuat ulang maka jawaban akan terhapus</li>
                                    <li>Pastikan anda sudah yakin dengan jawaban anda, jawaban yang sudah tersubmit tidak dapat diganti</b></li>
                                    <li>Pastikan seluruh jawaban terisi dan file upload berhasil seluruhnya, ditandai dengan tidak munculnya peringatan berwarna merah</li>
                                    <li>Jika muncul peringatan warna merah, maka kirim ulang jawaban sampai benar-benar berhasil</li>
                                    <b>Harap simpan jawaban ketika sudah selesai dan yakin!</b>
                              </div>
                              <!-- kondisi soal null atau tidak -->
                              <?php          
                                 if ($soal == NULL) {
                                       // Data soal kosong atau null
                                       echo "<br>Data Soal belum tersedia.<br>";
                                 } else {
                              ?>
                              <?php foreach ($soal as $s) {
                                 if ($s->id_permasalahan == $p->id_permasalahan) {?>
                                 <!-- kondisi soal null atau tidak -->
                                 <?php          
                                    if ($s == NULL) {
                                          // Data soal kosong atau null
                                          echo "<br>Data Soal belum tersedia.<br>";
                                    } else {
                                 ?>

                                 <input type="text" name="id_pertemuan" id="id_pertemuan" value="<?= $pertemuanById->id_pertemuan?>" hidden>
                                 <input type="text" name="id_permasalahan" id="id_permasalahan" value="<?= $s->id_permasalahan?>" hidden>
                                 <input type="text" name="id_soal_essai" id="id_soal_essai" value="<?= $s->id_soal_essai?>" hidden>
                                 <input type="text" name="id_user" id="id_user" value="<?= $this->session->userdata('id_user')?>" hidden>

                                    <!-- Soal Isian -->
                                    <table class="table table-borderless">
                                       <tr>
                                          <td style="white-space: nowrap;width: 1%;">
                                             <?= $s->no_soal?>.
                                          </td>
                                          <td>
                                             <?= $s->deksripsi_soal?><span class="text-danger">*</span>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td colspan="2">
                                             <!-- input text -->
                                             <?php if($s->tipe_jawaban == '1') {?>
                                                <div class="form-group">
                                                   <div class="form-line">
                                                      <input type="text" class="form-control" id="jawaban<?=$s->id_soal_essai?>" name="jawaban<?=$s->id_soal_essai?>" style="border-box; border: 2px solid #ccc" required/>
                                                   </div>
                                                </div>
                                             <?php } ?>

                                             <!-- textarea -->
                                             <?php if($s->tipe_jawaban == '2') {?>
                                                <div class="form-group">
                                                   <div class="form-line">
                                                      <textarea class="form-control" name="jawaban<?=$s->id_soal_essai?>" id="jawaban<?=$s->id_soal_essai?>" rows="4" width="100" style="border-box; border: 2px solid #ccc" required></textarea>
                                                   </div>
                                                </div>
                                             <?php } ?>

                                             <!-- file -->
                                             <?php if($s->tipe_jawaban == '3') {?>
                                                <div class="form-group">
                                                   <div class="form-line">
                                                      <label>Pilih file anda</label>
                                                      <input type="file" class="form-control-file" id="filejawaban<?=$s->id_soal_essai?>" name="filejawaban<?=$s->id_soal_essai?>" required>
                                                   </div>
                                                </div>
                                                <ul class="text-danger" style="list-style-type:circle;margin-bottom: 20px">
                                                   <li>Ukuran file maksimal 10 MB</li>
                                                   <li>Tipe file yang diperbolehkan adalah file powerpoint dengan format .ppt | .pptx | .pdf | .docx | .doc</li>
                                                </ul>
                                             <?php } ?>

                                             <!-- canva -->
                                             <?php if($s->tipe_jawaban == '4') {?>
                                                <section class="tools-board">
                                                   <table class="table table-responsive table-borderless">
                                                      <tr class="options">
                                                         <td class="option tool" id="pencil">
                                                               <i class="fas fa-pencil" id="icon"></i>
                                                               <span>Pencil</span>
                                                         </td>
                                                         <td class="option active tool" id="brush">
                                                               <i class="fas fa-brush" id="icon"></i>
                                                               <span>Brush</span>
                                                         </td>
                                                         <td class="option tool" id="eraser">
                                                               <i class="fas fa-eraser" id="icon"></i>
                                                               <span>Eraser</span>
                                                         </td>
                                                         <td class="option">
                                                               <input type="range" id="size-slider" min="1" 
                                                                     max="30" value="5">
                                                         </td>
                                                      </tr>
                                                      <tr class="options">
                                                         <td class="option tool" id="rectangle">
                                                               <i class="fa-solid fa-dice-one"></i>
                                                               <span>Rectangle</span>
                                                         </td>
                                                         <td class="option tool" id="circle">
                                                               <i class="fa-regular fa-circle"></i>
                                                               <span>Circle</span>
                                                         </td>
                                                         <td class="option tool" id="triangle">
                                                               <i class="fa-solid fa-mountain"></i>
                                                               <span>Triangle</span>
                                                         </td>
                                                         <td class="option tool" id="square">
                                                               <i class="far fa-square"></i>
                                                               <span>Square</span>
                                                         </td>
                                                         <td class="option tool" id="hexagon">
                                                               <i class="fa-solid fa-cube"></i>
                                                               <span>Hexagon</span>
                                                         </td>
                                                         <td class="option tool" id="pentagon">
                                                               <i class="fa-solid fa-dice-d6"></i>
                                                               <span>Pentagon</span>
                                                         </td>
                                                         <td class="option tool" id="line">
                                                               <i class="fa-solid fa-grip-lines"></i>
                                                               <span>Line</span>
                                                         </td>
                                                         <td class="option tool" id="arrow">
                                                               <i class="fa-solid fa-arrow-up"></i>
                                                               <span>Arrow</span>
                                                         </td>
                                                         <td class="option">
                                                               <input type="checkbox" id="fill-color">
                                                               <label for="fill-color"> Fill Color</label>
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td>
                                                            <label for="" class="title">Colors</label>
                                                         </td>
                                                         <td colspan="7">
                                                            <div class="row colors">
                                                               <ul class="options">
                                                                  <li class="option"></li>
                                                                  <li class="option selected"></li>
                                                                  <li class="option"></li>
                                                                  <li class="option"></li>
                                                                  <li class="option">
                                                                     <input type="color" value="#00FF00" name="" id="color-picker">
                                                                  </li>
                                                               </ul>
                                                            </div>
                                                         </td>
                                                      </tr>
                                                   </table>
                                             </section>
                                             <section class="drawing-board">
                                                   <div class="row buttons">
                                                      <a class="btn mb-3 ml-3 clear-canvas">Clear Canvas</a>
                                                      <a class="btn mb-3 ml-3 save-img">Save As Image</a>
                                                   </div>
                                                <canvas></canvas>
                                             </section>
                                             <br><br>
                                             <div class="form-group">
                                                <div class="form-line">
                                                   <label>Upload hasil gambar anda pada link di bawah ini</label>
                                                   <input type="file" class="form-control-file" id="canvajawaban<?=$s->id_soal_essai?>" name="canvajawaban<?=$s->id_soal_essai?>" required>
                                                </div>
                                             </div>
                                             <ul class="text-danger" style="list-style-type:circle;margin-bottom: 20px">
                                                <li>Ukuran file maksimal 1 MB</li>
                                                <li>Tipe file yang diperbolehkan adalah JPEG, JPG, dan PNG</li>
                                                <li>Maksimal lebar gambar 2048px</li>
                                             </ul>
                                             <?php } ?>
                                          </td>
                                       </tr>
                                    </table>
                                    <!-- END Soal Isian -->
                              <?php } } } }?>
                              <!-- Submit button -->
                              <button class="btn btn-primary waves-effect mb-3 mt-3 mr-2 float-right" type="submit">Simpan Jawaban</button>
                           </form>
                           <!-- END Form Isian -->
                            <?php }?>
                        </div>
                    </div>
                 <?php }?>
                <!-- Penutup else kondisi permasalahan null atau tidak -->
                <?php } ?>
                <!-- Penutup else kondisi permasalahan null atau tidak -->
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