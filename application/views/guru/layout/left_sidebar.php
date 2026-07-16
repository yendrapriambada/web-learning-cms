<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="<?= base_url().'assets/uploads/'.$this->session->userdata('foto_profil')?>" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $this->session->userdata('nama_lengkap');?></div>
            <div class="email"><?= $this->session->userdata('email')?></div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="<?= base_url().'guru/Profil'?>"><i class="material-icons">person</i>Profil</a></li>
                    <li role="separator" class="divider"></li>
                    <?php if($this->session->userdata('flag_type_account') !== 'google') { ?>
                    <li><a href="<?= base_url().'guru/UbahKataSandi'?>"><i class="material-icons">create</i>Ganti Password</a></li>
                    <?php } ?>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?= base_url().'Logout'?>"><i class="material-icons">input</i>Log Out</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li>
                <a href="<?= base_url().'guru/Beranda'?>">
                    <i class="material-icons">home</i>
                    <span>Beranda</span>
                </a>
            </li>
            <!-- Manajemen pengguna -->
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">assignment_ind</i>
                    <span>Manajemen Pengguna</span>
                </a>
                <ul class="ml-menu">
                    <li> <a href="<?= base_url().'guru/Pengguna'?>">Data Pengguna</a> </li>
                    <li> <a href="<?= base_url().'guru/Pengguna/dataSiswa'?>">Mahasiswa/i</a> </li>
                    <li><a href="<?= base_url().'guru/Pengguna/dataGuru'?>">Dosen</a> </li>
                    <!-- <li><a href="<?= base_url().'guru/RoleUser'?>">Peran Pengguna</a></li> -->
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">book</i>
                    <span>Manajemen Perkuliahan</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?= base_url().'guru/MataKuliah'?>">Identitas Mata Kuliah</a>
                    </li>
                    <li>
                        <a href="<?= base_url().'guru/AlurPerkuliahan'?>">Alur Rencana Perkuliahan</a>
                    </li>
                    <li>
                        <a href="<?= base_url().'guru/TemaProyek'?>">Tema Proyek</a>
                    </li>
                    <li>
                        <a href="<?= base_url().'guru/Pertemuan'?>">Pertemuan/Proyek</a>
                    </li>
                    <li>
                        <a href="<?= base_url().'guru/SumberBelajar'?>">Sumber Belajar</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">assignment</i>
                    <span>Manajemen Worksheet</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?= base_url().'guru/Permasalahan'?>">Permasalahan</a>
                    </li>
                    <li>
                        <a href="<?= base_url().'guru/SoalEssai'?>">Soal</a>
                    </li>
                    <li>
                        <a href="<?= base_url().'guru/JawabanSiswa'?>">Jawaban Mahasiswa/i</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">diamond</i>
                    <span>Manajemen Tes</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?= base_url().'guru/TestUnity'?>">Penilaian Tes</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">insert_chart</i>
                    <span>Manajemen Nilai</span>
                </a>
                <ul class="ml-menu">
                    <!-- <li>
                        <a href="<?= base_url().'guru/Nilai/nilai_simulasi'?>">Rekap Nilai Simulasi</a>
                    </li> -->
                    <li>
                        <a href="<?= base_url().'guru/Nilai/nilai_pertemuan'?>">Rekap Nilai Worksheet per Pertemuan</a>
                    </li>
                    <li>
                        <a href="<?= base_url().'guru/Nilai/nilai_tahapan'?>">Rekap Nilai Worksheet per Tahapan</a>
                    </li>
                    <li>
                        <a href="<?= base_url().'guru/Nilai/rekap_nilai'?>">Rekap Total Nilai Mahasiswa</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">comment</i>
                    <span>Manajemen Diskusi</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?= base_url().'guru/Diskusi'?>">Tabel Diskusi</a>
                    </li>
                    <li>
                        <a href="<?= base_url().'guru/Diskusi/review_diskusi'?>">Review Diskusi</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?= base_url().'guru/Panduan'?>">
                    <i class="material-icons">chrome_reader_mode</i>
                    <span>Panduan Pengguna</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - 1.0.5</a>.
        </div>
    </div>
    <!-- #Footer -->
</aside>
