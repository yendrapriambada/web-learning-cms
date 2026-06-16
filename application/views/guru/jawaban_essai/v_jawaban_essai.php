<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Data Jawaban Worksheet | Pendidikan IPA Terpadu</title>
    
    <!-- CSS -->
    <?php $this->load->view('guru/layout/header')?>
    <!-- END CSS -->
    <style>
        .btn-clicked { transform: scale(0.98); box-shadow: inset 0 0 6px rgba(0,0,0,.25); }
    </style>


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
                            
                            <!-- Bulk Edit by Kelompok -->
                            <div class="row mb-3" style="background:#e8f5e9; border-radius:6px; padding:12px 16px; margin:0 0 16px 0;">
                                <div class="col-md-12 mb-1"><b><i class="material-icons" style="vertical-align:middle;font-size:18px;">group</i> Bulk Edit Nilai per Kelompok</b> <small class="text-muted">— input nilai sekali, berlaku untuk semua anggota</small></div>
                                <div class="col-md-4">
                                    <select id="kelompokBulk" class="form-control">
                                        <option value="">-- Pilih No. Kelompok --</option>
                                        <?php foreach ($kelompok_list as $k): ?>
                                        <option value="<?= htmlspecialchars($k->no_kelompok)?>"><?= htmlspecialchars($k->no_kelompok)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success waves-effect" onclick="goToBulkEdit()">
                                        <i class="material-icons">edit</i> Bulk Edit
                                    </button>
                                </div>
                            </div>
                            <br>
                            <form method="GET" action="<?= base_url().'guru/JawabanSiswa'?>" id="filterForm">
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label>Nama Mahasiswa</label>
                                    <select name="nama_lengkap" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <?php foreach ($filter_names as $f): ?>
                                        <option value="<?= htmlspecialchars($f->nama_lengkap)?>" <?= $filters['nama_lengkap']==$f->nama_lengkap?'selected':''?>><?= htmlspecialchars($f->nama_lengkap)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>No. Kelompok</label>
                                    <select name="no_kelompok" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <?php foreach ($filter_kelompok as $f): ?>
                                        <option value="<?= htmlspecialchars($f->no_kelompok)?>" <?= $filters['no_kelompok']==$f->no_kelompok?'selected':''?>><?= htmlspecialchars($f->no_kelompok)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Pertemuan</label>
                                    <select name="no_pertemuan" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <?php foreach ($filter_pertemuan as $f): ?>
                                        <option value="<?= $f->no_pertemuan?>" <?= $filters['no_pertemuan']==$f->no_pertemuan?'selected':''?>>Pertemuan Ke-<?= $f->no_pertemuan?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Tahap Pembelajaran</label>
                                    <select name="tahapan_pembelajaran" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <?php foreach ($filter_tahap as $f): ?>
                                        <option value="<?= htmlspecialchars($f->tahapan_pembelajaran)?>" <?= $filters['tahapan_pembelajaran']==$f->tahapan_pembelajaran?'selected':''?>><?= htmlspecialchars($f->tahapan_pembelajaran)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Nomor Soal</label>
                                    <select name="no_soal" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <?php foreach ($filter_soal as $f): ?>
                                        <option value="<?= $f->no_soal?>" <?= $filters['no_soal']==$f->no_soal?'selected':''?>><?= $f->no_soal?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2">
                                <a href="<?= base_url().'guru/JawabanSiswa'?>" class="btn btn-default waves-effect">Reset Filter</a>
                                <span class="ml-3 text-muted">Menampilkan <?= count($jawabanEssai)?> dari <?= $total?> data</span>
                            </div>
                            </form>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
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
                                            <?php $no=1; foreach ($jawabanEssai as $JE) : ?>
                                            <tr>
                                                <td class="text-center align-top"><?= $no?></td>
                                                <td class="align-top"><?= $JE->nama_lengkap?></td>
                                                <td class="align-top"><?= $JE->no_kelompok?></td>
                                                <td class="align-top"><?= $JE->angkatan?></td>
                                                <td class="align-top">Pertemuan Ke-<?= $JE->no_pertemuan?></td>
                                                <td class="align-top"><?= $JE->tahapan_pembelajaran?></td>
                                                <td class="text-center align-top"><?= $JE->no_soal?></td>
                                                <td class="text-center align-top">
                                                    <p><?= $JE->jawaban_text?></p>
                                                    <?php if ($JE->jawaban_gambar  != NULL) { ?>
                                                        <a href="<?= base_url().'assets/jawaban_gambar/'.$JE->jawaban_gambar ?>" target="_blank"><?= base_url().'assets/jawaban_gambar/'.$JE->jawaban_gambar ?></a>
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

                                                        <?php if ($JE->jawaban_gambar != NULL && $JE->jawaban_gambar != '') { ?>
                                                        <img class="rounded" src="<?= base_url().'assets/jawaban_gambar/'.$JE->jawaban_gambar ?>" width="90%" alt="" srcset="">
                                                        <?php } ?>
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

                            <!-- Pagination -->
                            <?php if ($total_pages > 1): ?>
                            <?php
                                $q = $filters;
                                $base = base_url().'guru/JawabanSiswa?';
                            ?>
                            <nav>
                                <ul class="pagination">
                                    <li class="<?= $current_page <= 1 ? 'disabled' : ''?>">
                                        <a href="<?= $base.http_build_query(array_merge($q, ['page' => $current_page - 1]))?>">&laquo;</a>
                                    </li>
                                    <?php for ($i = max(1, $current_page-2); $i <= min($total_pages, $current_page+2); $i++): ?>
                                    <li class="<?= $i == $current_page ? 'active' : ''?>">
                                        <a href="<?= $base.http_build_query(array_merge($q, ['page' => $i]))?>"><?= $i?></a>
                                    </li>
                                    <?php endfor; ?>
                                    <li class="<?= $current_page >= $total_pages ? 'disabled' : ''?>">
                                        <a href="<?= $base.http_build_query(array_merge($q, ['page' => $current_page + 1]))?>">&raquo;</a>
                                    </li>
                                </ul>
                            </nav>
                            <?php endif; ?>
                            <!-- END Pagination -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Table -->
        </div>
    </section>

    <!-- JS -->
    <?php $this->load->view('guru/layout/javascript')?>
    <script src="<?= base_url();?>assets_guru/js/admin.js"></script>
    <script>
        function goToBulkEdit() {
            var k = document.getElementById('kelompokBulk').value;
            if (!k) { alert('Pilih nomor kelompok terlebih dahulu'); return; }
            window.location.href = '<?= base_url().'guru/JawabanSiswa/bulk_edit/'?>' + encodeURIComponent(k);
        }
    </script>
</body>

</html>
