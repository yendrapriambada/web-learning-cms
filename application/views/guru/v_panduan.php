<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Beranda Guru || Pendidikan IPA Terpadu</title>
    
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
                <h2>PANDUAN PENGGUNA</h2>
            </div>

            <!-- Pengantar Mata Kuliah -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>Pendidikan IPA Terpadu</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="text-justify lh-base">
                                <iframe src= "https://drive.google.com/file/d/1-tPUW13i3bjDL2yCCpyGAF-yQk8hz2F0/preview" 
                                        width="100%" 
                                        height="470"
                                        allow="autoplay">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Pengantar Mata Kuliah -->
        </div>
    </section>

<!-- JS -->
 <?php $this->load->view('guru/layout/javascript')?>
<!-- JS -->

<!-- Custom Js -->
<script src="<?= base_url();?>assets_guru/js/admin.js"></script>
<script src="<?= base_url();?>assets_guru/js/pages/index.js"></script>
</body>

</html>
