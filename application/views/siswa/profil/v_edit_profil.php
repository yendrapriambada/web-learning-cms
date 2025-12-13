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
      <title>Edit Profil | Pendidikan IPA Terpadu</title>
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
                  <h2 class="projects_taital">Edit Profil</h2>
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
                    </div>
                    <div class="card-body">
                        <form id="form_advanced_validation" method="POST" action="<?= base_url().'siswa/Profil/do_edit'?>">
                            <!-- ID USer -->
                            <input type="hidden" name="id_user" value="<?= $dataById->id_user?>">

                            <!-- Username -->
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $dataById->username?>" required disabled/>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $dataById->email?>" required disabled/>
                                </div>
                            </div>
                            
                            <!-- Nama Lengkap -->
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $dataById->nama_lengkap?>" required/>
                                </div>
                            </div>
                            <?= form_error("nama_lengkap",
                                    "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>")?>

                            <!-- Tahun Angkatan -->
                            <div class="form-outline mb-4">
                                <label for="angkatan">Tahun Angkatan</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" id="angkatan" placeholder="Tahun Angkatan" name="angkatan" value="<?= $dataById->angkatan?>" required/>
                            </div>
                            <?= form_error("angkatan",
                                    "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>")?>
                            
                            <!-- Sekolah -->
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="sekolah">Nama Sekolah/Institusi/Universitas <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="sekolah" name="sekolah" value="<?= $dataById->sekolah?>" required/>
                                </div>
                            </div>
                            <?= form_error("sekolah",
                                    "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>")?>
                                
                            <!-- Tanggal Lahir -->
                            <div class="form-group form-float">
                                <label class="form-label" for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                <div class="form-line">
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $dataById->tanggal_lahir?>" required>
                                </div>
                            </div>
                            <?= form_error("tanggal_lahir",
                                    "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>")?>
                            
                            <!-- Jenis Kelamin -->
                            <div class="form-group">
                                <label class="m-b-20">Jenis Kelamin <span class="text-danger">*</span></label>
                                <br>
                                <input type="radio" class="with-gap" name="jenis_kelamin" id="laki-laki" value="L" <?php if ($dataById->jenis_kelamin == "L") {echo "checked";}?> required>
                                <label for="laki-laki">Laki-Laki</label>
                                
                                <input type="radio" class="with-gap" name="jenis_kelamin" id="perempuan" value="P" <?php if ($dataById->jenis_kelamin == "P") {echo "checked";}?> required>
                                <label for="perempuan" class="m-l-80">Perempuan</label>
                            </div>
                            <?= form_error("jenis_kelamin",
                                    "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>")?>
                                    
                            <!-- No Kelompok -->
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" for="no_kelompok">No. Kelompok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="no_kelompok" name="no_kelompok" value="<?= $dataById->no_kelompok ?>" required/>
                                </div>
                            </div>
                            <?= form_error("no_kelompok",
                                    "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>")?>


                            <!-- Submit button -->
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            <a href="<?= base_url().'siswa/Profil'?>" class="btn btn-danger waves-effect" type="submit">BATAL</a>
                        </form>
                    </div>
                 </div>
                <!-- END FORM Edit Profil -->
               </div>
            </div>
         </div>
      </div>
      
      <!-- footer section start -->
      <?php $this->load->view('siswa/layout/footer')?>
      <?php $this->load->view('siswa/layout/copyright')?>
      <?php $this->load->view('siswa/layout/javascript')?>
   </body>
</html>
