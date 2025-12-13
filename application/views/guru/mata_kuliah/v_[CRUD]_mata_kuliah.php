<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Data Identitas Mata Kuliah | Pendidikan IPA Terpadu</title>
    
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
                    Manajemen Perkualiahan
                </h2>
            </div>
            <!-- #END# Basic Examples -->
            <!-- Table User Siswa -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Mata Kuliah
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
                            <a class="dropdown-item btn btn-primary" href="<?= base_url().'guru/MataKuliah/create/'?>" title="Tambah Data Pertemuan">
                            <i class="material-icons">add_to_queue</i></a>
                            <!-- #END# button create -->
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Program Studi</th>
                                            <th>Kode Mata Kuliah</th>
                                            <th>Nama Mata Kuliah</th>
                                            <th>Bobot SKS</th>
                                            <th>Jenjang</th>
                                            <th>Semester</th>
                                            <th>Status (wajib/pilihan)</th>
                                            <th>Link RPS</th>
                                            <th>Detail</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $d) :
                                            $no=1;?>
                                            <tr>
                                                <td><?= $no?></td>
                                                <td><?= $d->program_studi?></td>
                                                <td><?= $d->kode_mata_kuliah?></td>
                                                <td><?= $d->nama_mata_kuliah?></td>
                                                <td><?= $d->bobot_sks?></td>
                                                <td><?= $d->jenjang?></td>
                                                <td><?= $d->semester?></td>
                                                <td><?= $d->status?></td>
                                                <td>
                                                    <!-- <?php if($d->link_rps != NULL) { ?>
                                                        <a href="<?= $d->link_rps?>" class="btn btn-primary"> RPS</a>
                                                    <?php } ?> -->
                                                    <a href="<?=$d->link_rps?>" target="_blank"><?= $d->link_rps?></a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#"
                                                        id="lookDetail"
                                                        data-toggle="modal" 
                                                        data-target="#mataKuliah<?=$d->id_mata_kuliah?>"
                                                        class="btn btn-success"
                                                        title="Lihat Detail Data Mata Kuliah">
                                                        <i class="material-icons">remove_red_eye</i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="dropdown-item btn btn-warning" onclick="return confirm ('Apakah Anda Yakin Akan Mengedit Data ini ?')"  href="<?= base_url().'guru/MataKuliah/edit/'. $d->id_mata_kuliah?>" title="Edit Data Pertemuan">
                                                        <i class="material-icons">edit</i></a>
                                                    <a class="dropdown-item btn btn-danger" onclick="return confirm ('Apakah Anda Yakin Akan Menghapus Data ini ?')"  href="<?= base_url().'guru/MataKuliah/delete/'. $d->id_mata_kuliah?>" title="Hapus Permanen Data Pertemuan">
                                                        <i class="material-icons">delete_forever</i></a>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div id="mataKuliah<?=$d->id_mata_kuliah?>" class='modal fade' h-index="-1" role='dialog' aria-hidden='true' data-backdrop='false'>
                                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="akun_login">Detail Identitas Mata Kuliah</h5>
                                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <!-- Program Studi -->
                                                                <div class="form-group form-float">
                                                                    <label>Program Studi </label>
                                                                    <input class="form-control" value="<?= $d->program_studi?>" disabled/>
                                                                </div>
                                                                
                                                                <!-- Nama Mata Kuliah -->
                                                                <div class="form-group form-float">
                                                                    <label>Nama Mata Kuliah </label>
                                                                    <input class="form-control" value="<?= $d->nama_mata_kuliah?>" disabled/>
                                                                </div>
                                                                
                                                                <!-- Kode Mata Kuliah -->
                                                                <div class="form-group form-float">
                                                                    <label>Kode Mata Kuliah </label>
                                                                    <input class="form-control" value="<?= $d->kode_mata_kuliah?>" disabled/>
                                                                </div>

                                                                <!-- Bobot SKS -->
                                                                <div class="form-group form-float">
                                                                    <label>SKS </label>
                                                                    <input class="form-control" value="<?= $d->bobot_sks?> SKS" disabled/>
                                                                </div>
                                                                
                                                                <!-- jenjang -->
                                                                <div class="form-group form-float">
                                                                    <label>Jenjang </label>
                                                                    <input class="form-control" value="<?= $d->jenjang?>" disabled/>
                                                                </div>
                                                                
                                                                <!-- semester -->
                                                                <div class="form-group form-float">
                                                                    <label>Semester</label>
                                                                    <input class="form-control" value="<?= $d->semester?>" disabled/>
                                                                </div>
                                                                
                                                                <!-- Status -->
                                                                <div class="form-group form-float">
                                                                    <label>Status Mata Kuliah </label>
                                                                    <input class="form-control" value="<?= $d->status?>" disabled/>
                                                                </div>
                                                                
                                                                <!-- Deskripsi Mata Kuliah -->
                                                                <div class="form-group form-float">
                                                                    <label>Deskripsi Mata Kuliah </label>
                                                                    <?= $d->deskripsi_mata_kuliah?>"
                                                                </div>

                                                                <!-- CPL Mata Kuliah -->
                                                                <div class="form-group form-float">
                                                                    <label>Capaian Pembelajaran Lulusan (CPL)</label>
                                                                    <?= $d->cpl?>
                                                                </div>

                                                                <!-- CPMK Mata Kuliah -->
                                                                <div class="form-group form-float">
                                                                    <label>Capaian Pembelajaran Mata Kuliah (CPMK)</label>
                                                                    <?= $d->cpmk?>
                                                                </div>

                                                                <!-- Link RPS -->
                                                                 <div class="form-group">
                                                                    <label>RPS</label>
                                                                    <br>
                                                                    <a href="<?=$d->link_rps?>" target="_blank"><?= $d->link_rps?></a>
                                                                 </div>

                                                                <!-- Created at -->
                                                                <div class="form-group form-float">
                                                                    <label>Dibuat pada tanggal</label>
                                                                    <input class="form-control" value="<?= $d->created_at?>" disabled/>
                                                                </div>

                                                                <!-- Updated at-->
                                                                <div class="form-group form-float">
                                                                    <label>Diubah pada tanggal</label>
                                                                    <input class="form-control" value="<?= $d->updated_at?>" disabled/>
                                                                </div>
                                                                
                                                            </form>
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
