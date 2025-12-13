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
      <title>Profil | Pendidikan IPA Terpadu</title>
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
                  <h2 class="projects_taital">Profil Pengguna</h2>
               </div>
            </div>
         </div>
         <div class="projects_section_2 layout_padding">
            <div class="container">
               <div class="pets_section">
                <!-- Card Profil -->
                 <div class="card">
                    <div class="card-header">
                        Data Diri <?= $this->session->userdata('nama_lengkap')?>
                    </div>
                    <div class="card-body">
                        <!-- Data Profil -->
                        <?php if ($this->session->flashdata('ver') == "FALSE") { ?>
                            <div class="alert alert-<?=$this->session->flashdata("class_alert");?>" role="alert">
                            <?= $this->session->flashdata('alert'); 
                                $this->session->set_flashdata('ver', 'TRUE');
                            ?>
                            </div>
                        <?php } ?>
                        <table class="table table-responsive table-borderless">
                            <tr>
                                <td rowspan="9" width="230" class="text-center m-r-30">
                                    <img class="rounded" src="<?= base_url().'assets/uploads/'.$data->foto_profil ?>" width="90%" alt="" srcset="">
                                    <p><a class="text-info" onclick="return confirm ('Apakah Anda Yakin Akan Mengedit Foto Profil?')"  href="<?= base_url().'siswa/Profil/edit_foto_profil/'. $data->id_user?>"> Edit Foto Profil </a></p>
                                </td>
                            </tr>
                            <tr>
                                <th width="110">Nama</th>
                                <td width="60">:</td>
                                <td><?= $data->nama_lengkap?></td>
                            </tr>
                            <tr>
                                <th width="110">Angkatan</th>
                                <td width="60">:</td>
                                <td><?= $data->angkatan?></td>
                            </tr>
                            <tr>
                                <th width="110">Institusi/Sekolah/Universitas</th>
                                <td width="60">:</td>
                                <td><?= $data->sekolah?></td>
                            </tr>
                            <tr>
                                <th width="110">Email</th>
                                <td width="60">:</td>
                                <td><?= $data->email?></td>
                            </tr>
                            <tr>
                                <th width="110">Tanggal Lahir</th>
                                <td width="60">:</td>
                                <td><?= $data->tanggal_lahir?></td>
                            </tr>
                            <tr>
                                <th width="110">Jenis Kelamin</th>
                                <td width="60">:</td>
                                <td><?= $data->jenis_kelamin?></td>
                            </tr>
                            <tr>
                                <th width="110">Username</th>
                                <td width="60">:</td>
                                <td><?= $data->username?></td>
                            </tr>
                            <tr>
                                <th width="110">No. Kelompok</th>
                                <td width="60">:</td>
                                <td><?= $data->no_kelompok?></td>
                                <!--<td>1</td>-->
                            </tr>
                        </table>
                        <a class="btn btn-warning" onclick="return confirm ('Apakah Anda Yakin Akan Mengedit Data Diri Anda ?')"  href="<?= base_url().'siswa/Profil/form_edit/'. $data->id_user?>" title="Edit Data Profil">
                        Edit Profil</a>
                        <!-- #END# Data Profil -->
                    </div>
                 </div>
                <!-- END Card Profil -->
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