<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Diskusi Pertemuan | Pendidikan IPA Terpadu</title>
    
    <!-- CSS -->
    <?php $this->load->view('guru/layout/header')?>
    <!-- END CSS -->
</head>

<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <?php $this->load->view('guru/layout/navbar')?>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <?php $this->load->view('guru/layout/left_sidebar')?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <?php $this->load->view('guru/layout/right_sidebar')?>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Manajemen Diskusi Perkuliahan
                </h2>
            </div>
            <!-- #END# Basic Examples -->
            <!-- Table User Siswa -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Review Diskusi Perkuliahan
                            </h2>
                        </div>
                        <div class="body m-l-30 m-r-30">
                            <?php if ($this->session->flashdata('ver') == "FALSE") { ?>
                                <div class="alert alert-<?=$this->session->flashdata("class_alert");?>" role="alert">
                                <?= $this->session->flashdata('alert'); 
                                    $this->session->set_flashdata('ver', 'TRUE');
                                ?>
                                </div>
                            <?php } ?>
                            
                            <!-- kondisi data null atau tidak -->
                            <?php          
                                if ($dataByPertemuan == NULL) {
                                    // Data permasalahan kosong atau null
                                    echo "Komentar belum tersedia. <br><br>";
                                } else {
                            ?>
                            <!-- kondisi permasalahan null atau tidak -->

                            <a href="<?= base_url().'guru/Diskusi/review_diskusi'?>" class="btn btn-danger" type="submit">Kembali</a>
                            <br><br>
                            <div class="card">
                                <div class="chat-container">
                                    <div class="chat-header bg-light">
                                        <h5 class="mb-0">Diskusi Perkuliahan Pertemuan Ke-<?= $pertemuan->no_pertemuan?></h5>
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
                                        <form id="form_advanced_validation" method="POST" action="<?= base_url().'guru/Diskusi/do_create_review'?>">
                                            <input type="hidden" name="id_pertemuan" value="<?= $pertemuan->id_pertemuan?>">

                                            <!-- Nama Pemberi Komentar -->
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label>Nama Pemberi Komentar <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="id_user" id="id_user" required>
                                                        <?php foreach ($users as $u) { ?>
                                                            <option value="<?= $u->id_user?>"><?= $u->nama_lengkap?> (<?= $u->role_user?>)</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?= form_error("id_user",
                                                    "<div class='alert alert-danger alert-dismissible' role='alert'>", 
                                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>")?>

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
                            </div>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

    <!-- JS -->
    <?php $this->load->view('guru/layout/javascript')?>
    <!-- JS -->

    <!-- Custom Js -->
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
    <script src="<?= base_url();?>assets_guru/js/pages/tables/jquery-datatable.js"></script>
    <script>
        $(function(){});
    </script>

</body>

</html>
