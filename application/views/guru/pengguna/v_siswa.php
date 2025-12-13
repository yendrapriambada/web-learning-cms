<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Data Mahasiswa/i | Pendidikan IPA Terpadu</title>
    
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
                    Manajemen Pengguna
                </h2>
            </div>
            <!-- #END# Basic Examples -->
            <!-- Table User Siswa -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Mahasiswa/i
                            </h2>
                        </div>
                        <div class="body">
                            <?php if ($this->session->flashdata('ver') == "FALSE") { ?>
                                <div class="alert alert-<?=$this->session->flashdata("class_alert");?>" role="alert">
                                <?= $this->session->flashdata('alert'); 
                                    $this->session->set_flashdata('ver', 'TRUE');
                                ?>
                                </div>
                            <?php } ?>

                            <!-- button create -->
                            <a class="dropdown-item btn btn-primary" href="<?= base_url().'guru/Pengguna/create/'?>" title="Tambah Data Pengguna">
                            <i class="material-icons">person_add</i></a>
                            <a onclick="return confirm ('Apakah Anda Yakin Akan Menghapus Seluruh data Mahasiswa? Jika anda menghapus seluruh data mahasiswa, maka seluruh data terkait dengan mahasiswa tersebut dapat terhapus')" class="dropdown-item btn btn-danger" href="<?= base_url().'guru/Pengguna/dropMhs/'?>" title="Hapus Permanen Seluruh Data Mahasiswa">
                            <i class="material-icons">delete_forever</i>Hapus Seluruh Data Mahasiswa</a>
                            <!-- #END# button create -->
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>No. Kelompok</th>
                                            <th>Angkatan</th>
                                            <th>Universitas</th>
                                            <th>Email</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Username</th>
                                            <th>Detail</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($data as $d) :
                                            ?>
                                            <tr>
                                                <td><?= $no?></td>
                                                <td><?= $d->nama_lengkap?></td>
                                                <td><?= $d->no_kelompok?></td>
                                                <td><?= $d->angkatan?></td>
                                                <td><?= $d->sekolah?></td>
                                                <td><?= $d->email?></td>
                                                <td><?= $d->tanggal_lahir?></td>
                                                <td><?= $d->jenis_kelamin?></td>
                                                <td><?= $d->username?></td>
                                                <td class="text-center">
                                                    <a href="#"
                                                        id="lookDetail"
                                                        data-nama_lengkap='<?=$d->nama_lengkap?>'
                                                        data-username='<?=$d->username?>'
                                                        data-toggle="modal" 
                                                        data-target="#akun_login<?=$d->id_user?>"
                                                        class="btn btn-success"
                                                        title="Lihat Detail Data Pengguna">
                                                        <i class="material-icons">remove_red_eye</i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="dropdown-item btn btn-warning" onclick="return confirm ('Apakah Anda Yakin Akan Mengedit Data ini ?')"  href="<?= base_url().'guru/Pengguna/form_edit/'. $d->id_user?>" title="Edit Data Pengguna">
                                                        <i class="material-icons">edit</i></a>
                                                    <a class="dropdown-item btn btn-danger" onclick="return confirm ('Apakah Anda Yakin Akan Menghapus Data ini ?')"  href="<?= base_url().'guru/Pengguna/delete/'. $d->id_user?>" title="Hapus Permanen Data Pengguna">
                                                        <i class="material-icons">delete_forever</i></a>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                                <div id="akun_login<?=$d->id_user?>" class='modal fade' h-index="-1" role='dialog' aria-hidden='true' data-backdrop='false'>
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="akun_login">Detail Profil Mahasiswa/i</h5>
                                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mb-3">
                                                                <div class="text-center">
                                                                    <img class="rounded mt-0 " src="<?= base_url().'assets/uploads/'.$d->foto_profil ?>" width="40%" alt="" srcset="">
                                                                    <p><a onclick="return confirm ('Apakah Anda Yakin Akan Mengedit Foto Profil?')"  href="<?= base_url().'guru/Pengguna/edit_profil/'. $d->id_user?>"> Edit Foto Profil </a></p>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <b>Nama</b>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    :<?= $d->nama_lengkap?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <b>No. Kelompok</b>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    :<?= $d->no_kelompok?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <b>Angkatan</b>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    :
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <b>Nama Universitas</b>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    :<?= $d->sekolah?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <b>Jenis Kelamin</b>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    :<?= $d->jenis_kelamin?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <b>Tanggal Lahir</b>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    :<?= $d->tanggal_lahir?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <b>Email</b>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    :<?= $d->email?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <b>Username</b>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    :<?= $d->username?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <b>Dibuat pada tanggal</b>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    :<?= $d->created_at?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <b>Diubah pada tanggal</b>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    :<?= $d->updated_at?>
                                                                </div>
                                                            </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $(document).on('click','#lookDetail', function () {
                var nama_lengkap = $(this).data('nama_lengkap');
                var username = $(this).data('username');
                $('#nama_lengkap').text(nama_lengkap);
                $("#username").text(username);
            })
        });
	</script>

    <!-- JS -->
    <?php $this->load->view('guru/layout/javascript')?>
    <!-- JS -->

    <!-- Custom Js -->
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
    <script src="<?= base_url();?>assets_guru/js/pages/tables/jquery-datatable.js"></script>
</body>

</html>
