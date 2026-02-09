<!-- header section start -->
<div class="header_section_menu">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo">
                <img src="<?= base_url().'assets/logo/white with type.png'?>" alt="" srcset="" width="100px">
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
                $segment = $this->uri->segment(1);
                if (is_null($segment)) {
                    $segment = '';
                }

                $segment2 = $this->uri->segment(2);
                if (is_null($segment2)) {
                    $segment2 = '';
                }
            ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    
                    
                    
                    <!-- Beranda -->
                    <li class="nav-item">
                    <a href="<?= base_url()."Beranda"?>" class="nav-link-d btn btn-menu-custom btn-block mr-3
                    <?php 
                        if(strtolower($segment) == "beranda" || $segment == "")
                            {
                                echo " active"; 
                            }
                    ?>
                    ">Beranda</a>
                    </li>
                    
                    <?php if($this->session->userdata('id_user') != NULL) { ?>
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="nav-link-d btn btn-menu-custom btn-block dropdown-toggle mr-3" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Orientasi Perkuliahan
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                    <a class="dropdown-item" href="<?= base_url().'siswa/PengenalanMataKuliah#mk'?>">Pengenalan Matakuliah</a>
                                    <a class="dropdown-item" href="<?= base_url().'siswa/PengenalanMataKuliah#web'?>">Pengenalan Web-based Worksheet</a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                    
                    <!-- Pertemuan / Proyek -->
                    <li class="nav-item">
                    <?php if($this->session->userdata('id_user') != NULL 
                             && $this->session->userdata('id_role_user') != 2 
                             && $pertemuan != NULL) { ?>
                    
                        <?php
                            // Kelompokkan pertemuan per tema
                            $temaGrouped = [];
                            foreach ($pertemuan as $p) {
                                if ($p->status != '1') continue;
                                $key = $p->id_tema_proyek;
                                $namaTema = $p->tema_proyek;
                    
                                if (!isset($temaGrouped[$key])) {
                                    $temaGrouped[$key] = [
                                        'tema_proyek' => $namaTema,
                                        'items'       => []
                                    ];
                                }
                                $temaGrouped[$key]['items'][] = $p;
                            }
                        ?>
                    
                        <div class="dropdown">
                            <button class="nav-link-d btn btn-menu-custom btn-block dropdown-toggle mr-3 
                                    <?php if(strtolower($segment2) == 'pertemuan') echo 'active'; ?>" 
                                    type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                                Project Pathway
                            </button>
                    
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    
                                <?php foreach ($temaGrouped as $tema): ?>
                                    <div class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">
                                            <?= $tema['tema_proyek']; ?>
                                        </a>
                                        <div class="dropdown-menu">
                                        <?php foreach ($tema['items'] as $p): ?>
                                            <a class="dropdown-item" href="<?= base_url('siswa/Pertemuan/worksheet/'.$p->id_pertemuan); ?>">
                                                <?= $p->judul_pertemuan; ?>
                                            </a>
                                        <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                    
                            </div>
                        </div>
                    
                    <?php }?>
                    
                    </li>
                    
                    
                    <?php if($this->session->userdata('id_user') != NULL) { ?>
                        <li class="nav-item">
                        <a href="<?= base_url()."siswa/SumberBelajar"?>" class="nav-link-d btn btn-menu-custom btn-block mr-3
                        <?php 
                            if(strtolower($segment2) == "sumberbelajar")
                                {
                                    echo " active"; 
                                }
                        ?>
                        ">Sumber Belajar</a>
                        </li>
                    <?php } ?>

                    <?php if($this->session->userdata('id_user') != NULL) { ?>
                        <li class="nav-item">
                        <a href="<?= base_url()."siswa/Nilai"?>" class="nav-link-d btn btn-outline-light btn-block mr-3
                        <?php 
                            if(strtolower($segment2) == "nilai")
                                {
                                    echo " active"; 
                                }
                        ?>
                        ">Penilaian</a>
                        </li>
                    <?php } ?>

                    < <!-- Panduan -->
                    <li class="nav-item">
                    <a href="<?= base_url()."siswa/Panduan"?>" class="nav-link-d btn btn-outline-light btn-block mr-3
                    <?php 
                        if(strtolower($segment2) == "panduan")
                            {
                                echo " active"; 
                            }
                    ?>
                    ">Panduan Worksheet</a>
                    </li>
                    
                    <!-- Nilai -->
                    <li class="nav-item">
                    <a href="<?= base_url()."siswa/Nilai"?>" class="nav-link-d btn btn-outline-light btn-block mr-3
                    <?php 
                        if(strtolower($segment2) == "nilai")
                            {
                                echo " active"; 
                            }
                    ?>
                    ">Nilai</a>
                    </li>

                    <!-- Profil -->
                    <li class="nav-item">
                    <?php if($this->session->userdata('id_user') != NULL && $this->session->userdata('id_role_user') != 2) { ?>
                            <div class="dropdown">
                                <button class="nav-link-d btn btn-menu-custom btn-block dropdown-toggle mr-3" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user mr-2" aria-hidden="true"></i> ⁠Profil Mahasiswa
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <a class="dropdown-item" href="<?= base_url().'siswa/Profil'?>"><i class="fa fa-user mr-2" aria-hidden="true"></i> Profil</a>
                                <?php if($this->session->userdata('flag_type_account') !== 'google') { ?>
                                <a class="dropdown-item" href="<?= base_url().'siswa/UbahKataSandi'?>"><i class="fa fa-pencil mr-2" aria-hidden="true"></i> Ganti Kata Sandi</a>
                                <?php } ?>
                                <a class="dropdown-item" href="<?= base_url().'Logout'?>"><i class="fa fa-sign-out mr-2" aria-hidden="true"></i> Log Out</a>
                                </div>
                            </div>
                    <?php } ?>
                    </li>


                    <!-- Login -->
                    <li class="nav-item" <?php if($this->session->userdata('id_user') != NULL) { echo "style='display:none'";}?>>
                    <a href="<?= base_url()."Login"?>" class="nav-link-d btn btn-outline-light btn-block mr-3
                    <?php 
                        if(strtolower($segment) == "login")
                            {
                                echo " active"; 
                            }
                    ?>
                    ">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- header section end -->
