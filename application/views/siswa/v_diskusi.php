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
      <title>Diskusi Pertemuan Ke-<?= $pertemuanById->no_pertemuan?> | Pendidikan IPA Terpadu</title>
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
                              <a class="nav-link" href="<?= base_url().'siswa/Pertemuan/worksheet/'.$pertemuanById->id_pertemuan?>">Lembar Kerja</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link active" href="<?= base_url().'siswa/Diskusi/komentar/'.$pertemuanById->id_pertemuan?>">Diskusi</a>
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
                    if ($dataByPertemuan == NULL) {
                        // Data permasalahan kosong atau null
                        echo "Komentar belum tersedia. <br><br>";
                    } else {
                ?>
                <!-- kondisi permasalahan null atau tidak -->
                <div class="chat-container">
                    <div class="chat-header bg-light">
                        <h5 class="mb-0">Diskusi Perkuliahan Pertemuan Ke-<?= $pertemuanById->no_pertemuan?></h5>
                    </div>
                    <div class="chat-body">
                        <?php $no=1; foreach ($dataByPertemuan as $d) :?>
                            <?php if($d->id_user == $this->session->userdata("id_user")) {?>
                                <div class="chat-message received">
                                    <div class="message-user">
                                        <b>[Anda]</b> <?= $d->nama_lengkap."  (".$d->role_user.")"?>
                                    </div>
                                    <div class="message-content">
                                        <div>
                                            <?= $d->komentar?>
                                        </div>
                                        <br>
                                        <div class="time-right"><?= $d->created_at?></div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="chat-message sent">
                                    <div class="message-user">
                                        <?= $d->nama_lengkap."  (".$d->role_user.")"?>
                                    </div>
                                    <div class="message-content">
                                        <div>
                                            <?= $d->komentar?>
                                        </div>
                                        <br>
                                        <div class="time-left"><?= $d->created_at?></div>
                                    </div>
                                </div>
                            <?php }?>
                        <?php $no++; endforeach; ?>
                    </div>
                    <div class="chat-footer">
                        <p><b>Tambahkan Komentar Baru</b></p>
                        <form id="form_advanced_validation" method="POST" action="<?= base_url().'siswa/Diskusi/do_create_review'?>">
                            <input type="hidden" name="id_pertemuan" value="<?= $pertemuanById->id_pertemuan?>">

                            <!-- Komentar -->
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea class="form-control" id="komentar" name="komentar" required rows="2"></textarea>
                                </div>
                            </div>
                            <?= form_error("komentar",
                                    "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>")?>

                            <!-- Submit button -->
                            <button class="btn btn-info waves-effect" type="submit">Kirim</button>
                        </form>
                    </div>
                </div>
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

      <script>
        const canvas = document.getElementById('paintCanvas');
        const ctx = canvas.getContext('2d');
        let painting = false;

        function startPosition(e) {
            painting = true;
            draw(e);
        }

        function endPosition() {
            painting = false;
            ctx.beginPath();
        }

        function draw(e) {
            if (!painting) return;
            ctx.lineWidth = 5;
            ctx.lineCap = 'round';

            ctx.lineTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
        }

        canvas.addEventListener('mousedown', startPosition);
        canvas.addEventListener('mouseup', endPosition);
        canvas.addEventListener('mousemove', draw);

        function saveDrawing() {
            const imageData = canvas.toDataURL('image/png');
            document.getElementById('ImgJawaban').value = imageData;
        }
    </script>
   </body>
</html>