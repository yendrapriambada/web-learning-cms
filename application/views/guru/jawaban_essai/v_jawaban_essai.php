<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Data Jawaban Worksheet | Pendidikan IPA Terpadu</title>
    
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
                    Manajemen Worksheet
                </h2>
            </div>
            <!-- #END# Basic Examples -->
            <!-- Table User Siswa -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Jawaban Worksheet Mahasiswa/i
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
                            <!-- <a class="dropdown-item btn btn-primary" href="<?= base_url().'guru/Pengguna/create/'?>" title="Tambah Data Pengguna">
                            <i class="material-icons">person_add</i></a> -->
                            <!-- #END# button create -->
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Mahasiswa</th>
                                            <th class="text-center">No. Kelompok</th>
                                            <th class="text-center">Angkatan</th>
                                            <th class="text-center">Pertemuan</th>
                                            <th class="text-center">Tahap Pembelajaran</th>
                                            <th class="text-center">Nomor Soal</th>
                                            <th class="text-center">Jawaban</th>
                                            <th class="text-center">Nilai</th>
                                            <th class="text-center">Feedback</th>
                                            <th class="text-center">Tanggal Pengiriman</th>
                                            <th class="text-center">Lihat Detail</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php $no=1; foreach ($jawabanEssai as $JE) : 
                                                $SoalEssaiByPermasalahan = $this->db->get_where('v_permasalahan', ['id_permasalahan' => $JE->id_permasalahan])->row();
                                            ?>
                                            <tr>
                                                <td class="text-center align-top"><?= $no?></td>
                                                <td class="align-top"><?= $JE->nama_lengkap?></td>
                                                <td class="align-top"><?= $JE->no_kelompok?></td>
                                                <td class="align-top"><?= $JE->angkatan?></td>
                                                <td class="align-top">Pertemuan Ke-<?= $SoalEssaiByPermasalahan->no_pertemuan?></td>
                                                <td class="align-top"><?= $SoalEssaiByPermasalahan->tahapan_pembelajaran?></td>
                                                <td class="text-center align-top"><?= $JE->no_soal?></td>
                                                <td class="text-center align-top">
                                                    <p><?= $JE->jawaban_text?></p>
                                                    <?php if ($JE->jawaban_gambar  != NULL) { ?>
                                                        <img class="rounded" src="<?= base_url().'assets/jawaban_gambar/'.$JE->jawaban_gambar ?>" width="90%" alt="" srcset="">
                                                        <?= base_url().'assets/jawaban_gambar/'.$JE->jawaban_gambar ?>
                                                    <?php } ?>
                                                    <?php if ($JE->jawaban_file != NULL) { ?>
                                                        <a href="<?= base_url().'assets/jawaban_file/'.$JE->jawaban_file ?>" class="download-button" target="_blank"><?= base_url().'assets/jawaban_file/'.$JE->jawaban_file ?></a>
                                                    <?php } ?>
                                                    
                                                </td>
                                                <td class="align-top"><?= $JE->nilai?></td>
                                                <td class="align-top"><?= $JE->feedback?></td>
                                                <td class="align-top"><?= $JE->created_at?></td>
                                                <td class="text-center align-top">
                                                    <a href="#"
                                                        id="lookDetail"
                                                        data-toggle="modal" 
                                                        data-target="#jawabanEssai<?=$JE->id_jawaban_essai?>"
                                                        class="btn btn-success"
                                                        title="Lihat Detail Data Pengguna">
                                                        <i class="material-icons">remove_red_eye</i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="dropdown-item btn btn-warning" onclick="return confirm ('Apakah Anda Yakin Akan Mengedit Data ini ?')"  href="<?= base_url().'guru/JawabanSiswa/form_edit/'. $JE->id_jawaban_essai?>" title="Edit Data">
                                                        <i class="material-icons">edit</i></a>
                                                    <a class="dropdown-item btn btn-danger" onclick="return confirm ('Apakah Anda Yakin Akan Menghapus Data ini ?')"  href="<?= base_url().'guru/JawabanSiswa/delete/'. $JE->id_jawaban_essai?>" title="Hapus Permanen">
                                                        <i class="material-icons">delete_forever</i></a>
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
                                                            <!-- <a href="<?= base_url().'assets/jawaban_file/'.$JE->jawaban_file ?>" class="download-button" download="Jawaban Dokumen_<?= $this->session->userdata('nama_lengkap')?>">Lihat Dokumen: <?= $JE->jawaban_file?></a> -->
                                                            <a href="<?= base_url().'assets/jawaban_file/'.$JE->jawaban_file ?>" class="download-button" target="_blank">Lihat Dokumen: <?= $JE->jawaban_file ?></a>
                                                        <?php } ?>
                                                        <hr>
                                                        <h4><b>Feedback Dosen</b></h4>
                                                        <p><?= $JE->feedback?></p>
                                                        <hr>
                                                        <h4><b>Tanggal Pengeditan</b></h4>
                                                        <p><?= $JE->updated_at?></p>
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
