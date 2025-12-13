-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 28, 2024 at 07:29 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ipa_terpadu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_alur_pembelajaran`
--

CREATE TABLE `tb_alur_pembelajaran` (
  `id_alur_pembelajaran` int(11) NOT NULL,
  `id_mata_kuliah` int(11) NOT NULL,
  `id_pertemuan` int(11) NOT NULL,
  `indikator_pembelajaran` text DEFAULT NULL,
  `bahan_kajian` text DEFAULT NULL,
  `aktivitas_perkuliahan` text DEFAULT NULL,
  `pengalaman_belajar` text DEFAULT NULL,
  `kebutuhan_pembelajaran` text DEFAULT NULL,
  `alokasi_waktu` varchar(255) DEFAULT NULL,
  `deskripsi_tugas` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_alur_pembelajaran`
--

INSERT INTO `tb_alur_pembelajaran` (`id_alur_pembelajaran`, `id_mata_kuliah`, `id_pertemuan`, `indikator_pembelajaran`, `bahan_kajian`, `aktivitas_perkuliahan`, `pengalaman_belajar`, `kebutuhan_pembelajaran`, `alokasi_waktu`, `deskripsi_tugas`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '<p><strong>Pretest</strong></p>\r\n', '<p><strong>Pretest</strong></p>\r\n', '<p><strong>Pretest</strong></p>\r\n', '<p><strong>Pretest</strong></p>\r\n', '<p><strong>Pretest</strong></p>\r\n', '-', '<p><strong>Pretest</strong></p>\r\n', '2024-06-28 07:42:42', '2024-06-28 08:26:40'),
(2, 1, 2, '<ul>\r\n	<li>Mahasiswa mampu mendeskripsikan konsep IPA terpadu berdasarkan isu, fakta yang merupakan tantangan global, nasional dan lokal</li>\r\n	<li>Mahasiswa mampu mengartikulasikan pemahaman awal dan motivasi untuk mempelajari lebih lanjut tentang isu-isu yang disajikan.</li>\r\n	<li>Mahasiswa memiliki kepedulian dan menyadari pentingnya masalah ketahanan pangan dalam masyarakat berdasarkan informasi yang disajikan.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Konsep IPA Terpadu</li>\r\n	<li>Issu tentang permasalahan lokal, nasional, global.</li>\r\n	<li>Masalah ketahanan pangan tema sistem irigasi pertanian.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Mahasiswa menyaksikan tampilan fenaomena sains dari video tentang ketahanan pangan.</li>\r\n	<li>Mahasiswa berpartisipasi dalam sesi diskusi kelompok untuk mengidentifikasi tantangan utama dalam ketahanan pangan di tingkat lokal atau global.</li>\r\n	<li>Mahasiswa diminta untuk mencatat ide-ide dan masalah yang di identifikasi dan berbagi pemikiran mereka dengan kelas.</li>\r\n</ul>\r\n', '<p><strong>ENGAGE</strong></p>\r\n\r\n<p>Define the problem.</p>\r\n\r\n<ul>\r\n	<li>Mahasiswa&nbsp; berlatih menemukan&nbsp; konsep&nbsp; keterpaduan&nbsp; berdasarkan&nbsp; issu dan&nbsp; fakta&nbsp; yang merupakan tantangan global, nasional dan lokal pada buku ajar&nbsp; IPA terpadu tema Sistem Irigasi Pertanian</li>\r\n	<li>Mahasiswa&nbsp; berlatih mengidentifikasi&nbsp; issu tentang&nbsp; permasalahan&nbsp; lokal, nasional&nbsp; dan&nbsp; global&nbsp; untuk menantang&nbsp; mahasiswa berpikir&nbsp; (mengapa? dan&nbsp; bagaimana?)&nbsp; sesuai dengan&nbsp; vidio&nbsp; yang ditampilkan.</li>\r\n	<li>Mahasiswa&nbsp; berlatih mengidentifikasi&nbsp; masalah ketahanan pangan&nbsp; tema&nbsp; sistem irigasi pertanian (mengapa? dan bagaimana?) sesuai&nbsp; dengan&nbsp; link&nbsp; vidio yang ditampilkan melalui WBW identifikasi&nbsp; masalah&nbsp; &amp; informasi pendukung</li>\r\n</ul>\r\n', '<p>Stimulus berupa wacana/artikel/video</p>\r\n', '2 x 50 Menit', '<p>Penilaian hasil kerja mahasiswa dalam membuat laporan di WBW yang memuat:</p>\r\n\r\n<ol>\r\n	<li>Ringkasan fenomena.</li>\r\n	<li>Identifikasi masalah.</li>\r\n	<li>Pertanyaan reflektif.</li>\r\n	<li>Revelansi dengan konteks</li>\r\n</ol>\r\n', '2024-06-28 07:54:00', '2024-06-28 08:27:19'),
(4, 1, 2, '<ul>\r\n	<li>Mahasiswa dapat melakukan pencarian literatur dan studi tentang sistem irigasi pertanian.</li>\r\n	<li>Mengeksplorasi masalah tema sistem irigasi pertanian di lingkungan sekitar</li>\r\n	<li>Mahasiswa dapat berdiskusi dengan rekan-rekan mereka untuk berbagi temuan mereka dari riset awal.</li>\r\n	<li>Mahasiswa dapat menganalisis data dan informasi yang mereka kumpulkan untuk mengidentifikasi permasalahan terkait ketahanan pangan dan pangan berkelanjutan.</li>\r\n	<li>Mahasiswa mampu berpikir kritis dalam mengeksplorasi konsep-konsep IPA terpadu dan menerapkan pengetahuan yang diperoleh dalam situasi yang berbeda.</li>\r\n</ul>\r\n', '<p>Permasalahan sistem irigasi &nbsp;pertanian lokal dalam mengatasi tantangan ketahanan pangan.</p>\r\n', '<ul>\r\n	<li>Mahasiswa melakukan kunjungan lapangan ke pertanian lokal untuk mengamati praktik-praktik pertanian dan berpartisipasi dalam sesi tanya jawab dengan petani.</li>\r\n	<li>Mahasiswa mengumpulkan data dan informasi tentang sistem irigasi pertanian dan tantangan yang dihadapi.</li>\r\n</ul>\r\n', '<p><strong>EXPLORE</strong></p>\r\n\r\n<p>Plan possible solutions.</p>\r\n\r\n<ul>\r\n	<li>Mahasiwa melakukan eksplorasi tentang permasalahan sistem irigasi pertanian yang telah ada.</li>\r\n	<li>Mahasiswa mencari sumber referensi terkait topik yang disajikan.</li>\r\n	<li>Mahasiswa mengajukan solusi terkait permasalahan yang dikemukakan.</li>\r\n</ul>\r\n', '<p>Akses ke fasilitas lapangan seperti pertanian lokal untuk mengamati praktik-praktik pertanian secara langsung.</p>\r\n', '2 x 50 Menit', '<p>Penilaian hasil kerja dalam membuat laporan dan informasi pendukung yang memuat:</p>\r\n\r\n<ol>\r\n	<li>Ringkasan Rencana.</li>\r\n	<li>Rincian Solusi.</li>\r\n	<li>Pertimbangan lain.</li>\r\n</ol>\r\n', '2024-06-28 08:08:46', '2024-06-28 08:27:00'),
(5, 1, 3, '<ul>\r\n	<li>Mahasiswa dapat mempelajari konsep sistem irigasi.</li>\r\n	<li>Mahasiswa dapat mempelajari konsep Tekanan Air, Hambatan Aliran (hukum Hagen-Poiseuille), Kebutuhan Air Tanaman, konsep Sumber daya alam dan Energi (terbarukan).</li>\r\n	<li>Mahasiswa&nbsp; melakukan analisis&nbsp; tentang&nbsp; produk tema&nbsp; sistem irigasi&nbsp; yang&nbsp; akan dikerjakan.</li>\r\n	<li>Mengemukakan berbagai macam&nbsp; solusi&nbsp; yang mungkin&nbsp; terkait&nbsp; dengan permasalahan.</li>\r\n</ul>\r\n', '<p>konsep sistem irigasi Tekanan Air, Hambatan Aliran (hukum Hagen-Poiseuille), Kebutuhan Air Tanaman, konsep Sumber daya alam dan Energi (terbarukan).</p>\r\n', '<ul>\r\n	<li>Mahasiswa mempresentasikan hasil Studi lapangan tentang konsep-konsep pertanian berkelanjutan, prinsip-prinsip keberlanjutan dalam pertanian, dan teknologi pertanian inovatif.</li>\r\n	<li>Mengajukan pertanyaan yang mendorong mahasiswa untuk memikirkan faktor-faktor seperti biaya, efektivitas, dan kelayakan implementasi.</li>\r\n	<li>Berdiskusi bersama mahasiswa tentang kelebihan dan kekurangan dari setiap solusi yang mereka pilih.</li>\r\n	<li>Memberikan tinjauan pendekatan ilmiah dalam memahami permasalahan ini dari sudut pandang Pendidikan IPA Terpadu dan STEM</li>\r\n</ul>\r\n', '<p><strong>EXPLAIN</strong></p>\r\n\r\n<p>Choose the possible solution</p>\r\n\r\n<ul>\r\n	<li>Mahasiswa&nbsp; berlatih&nbsp; mencari informasi&nbsp; pendukung tentang&nbsp; produk&nbsp; tema&nbsp; sistem irigasi pertanian berdasarkan&nbsp; WBS.</li>\r\n	<li>Mahasiswa diminta untuk memilih satu solusi yang menurut mereka paling memungkinkan</li>\r\n	<li>Mahasiswa berlatih mempresentasikan hasil pemikiran mereka di balik pemilihan solusi tersebut</li>\r\n	<li>Mahasiswa berpartisipasi dalam diskusi kelas untuk memperdalam konsep dan untuk pemahaman lebih lanjut.</li>\r\n</ul>\r\n', '<p>Materi pembelajaran yang berkualitas, seperti buku teks, artikel ilmiah, dan sumber daya multimedia yang menjelaskan konsep-konsep agroekologi, keberlanjutan, dan teknologi pertanian.</p>\r\n', '2 x 50 Menit', '<p>Penilaian hasil kerja terhadap solusi yang dipilih dalam bentuk laporan rencana rancangan produk yang memuat:</p>\r\n\r\n<ol>\r\n	<li>Penjelasan pilihan solusi.</li>\r\n	<li>Analisis kelebihan solusi.</li>\r\n	<li>Pertimbangan solusi alternatif.</li>\r\n	<li>Kesimpulan</li>\r\n</ol>\r\n', '2024-06-28 08:10:21', NULL),
(6, 1, 5, '<ul>\r\n	<li>Mengerjakan&nbsp; proyek sesuai dengan rancangan yang telah dibuat.</li>\r\n	<li>Melakukan&nbsp; Uji&nbsp; Coba produk.</li>\r\n	<li>Melakukan&nbsp; perbaikan terhadap&nbsp; proyek&nbsp; apabila tidak&nbsp; sesuai&nbsp; dengan harapan.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Rencana solusi masalah sistem irigasi yang sesui.</li>\r\n	<li>Mengerjakan&nbsp; proyek sesuai dengan rancangan.</li>\r\n	<li>Uji coba produk dan Perbaikan terhadap produk yang&nbsp; sesuai harapan.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Mahasiswa membentuk kelompok dan merancang prototipe dalam konteks sistem irigasi.</li>\r\n	<li>Mahasiswa diminta untuk membuat diagram atau sketsa yang menjelaskan bagaimana solusi tersebut akan diimplementasikan.</li>\r\n	<li>Mahasiswa melakukan simulasi atau percobaan praktis yang meniru kondisi di lapangan untuk menguji rencana solusi.</li>\r\n	<li>Mahasiswa diminta untuk mencatat hasil pengujian dan mengidentifikasi area yang perlu perbaikan.</li>\r\n	<li>Berdiskusi terkait hasil pengujian dengan mahasiswa dan mengaajukan pertanyaan reflektif untuk membantu mereka mengevaluasi kembali rencana solusi mereka.</li>\r\n	<li>Mahasiswa memperbaiki dan mengembangkan rencana mereka berdasarkan pembelajaran dari pengujian.</li>\r\n</ul>\r\n', '<p><strong>ENGINEER</strong></p>\r\n\r\n<p>Design, test, redesign.</p>\r\n\r\n<ul>\r\n	<li>Mahasiswa berlatih membuat dan mengembangkan produk berdasarkan desain pada WBS rancangan produk dan prosedur yang telah dibuat</li>\r\n	<li>Mahasiswa berlatih memperbaiki produk berdasarkan WBW uji coba dan revisi produk</li>\r\n	<li>Mahasiswa berlatih melakukan perbaikan terhadap prototype apabila tidak sesuai dengan harapan.</li>\r\n	<li>Mahasiswa melakukan uji coba ke 2 terhadap prototype.</li>\r\n</ul>\r\n', '<p>Akses ke fasilitas laboratorium atau <em>workshop</em> yang dilengkapi dengan peralatan teknologi pertanian, seperti sensor tanah, perangkat lunak pemantauan tanaman, dan peralatan percobaan hidroponik.</p>\r\n', '2 x 50 Menit', '<ul>\r\n	<li>Penilaian hasil kerja prosedur pembuatan produk.</li>\r\n	<li>Penilaian hasil uji coba dan revisi produk</li>\r\n	<li>Penilaian Produk</li>\r\n</ul>\r\n', '2024-06-28 08:11:56', NULL),
(7, 1, 6, '<ul>\r\n	<li>Mahasiswa dapat merefleksikan pengalaman yang mereka peroleh untuk menyajikan inovasi/ kebaharuan dari prototype yang telah dikembangkan</li>\r\n	<li>Mahasiswa memiliki kemampuan untuk melakukan penelitian lanjutan dan memperdalam pemahaman mereka tentang topik tersebut.</li>\r\n</ul>\r\n', '<p>Artikel ilmiah, buku, atau sumber lainnya yang bisa dijadikan referensi.</p>\r\n', '<ul>\r\n	<li>Memberikan tugas kepada mahasiswa untuk mengeksplorasi inovasi/ kebaharuan pada prototype yang telah di buat.</li>\r\n	<li>Mahasiswa mempresentasikan inovasi/kebaharuan yang ditemukan di kelas.</li>\r\n</ul>\r\n', '<p><strong>ENRICH</strong></p>\r\n\r\n<p>Communicate</p>\r\n\r\n<ul>\r\n	<li>Mahasiswa menyajikan inovasi/ kebaharuan yang dapat di tambahkan pada prototype yang telah di buat.</li>\r\n	<li>Mahasiswa mempresentasikan prototipe dan hasil penelitian mereka menggunakan berbagai media.</li>\r\n</ul>\r\n', '<p>Inovasi terbaru dalam ketahanan pangan.</p>\r\n', '2 x 50 Menit', '<p>Penilaian hasil kerja presentasi atau demonstrasi yang memuat:</p>\r\n\r\n<ol>\r\n	<li>Rancangan inovasi/kebaharuan yang di kembangkan.</li>\r\n	<li>Deskripsi rancangan.</li>\r\n	<li>Temuan dan Kesimpulan</li>\r\n</ol>\r\n', '2024-06-28 08:15:21', NULL),
(8, 1, 6, '<ul>\r\n	<li>Mahasiswa dapat mengumpulkan dan menganalisis data dari pengujian prototipe solusi untuk mengevaluasi kinerjanya.</li>\r\n	<li>Mahasiswa memiliki kemampuan untuk mengevaluasi keberhasilan solusi yang mereka rancang dan mengidentifikasi area yang perlu diperbaiki atau ditingkatkan.</li>\r\n</ul>\r\n', '<p>Rubrik penilaian untuk proyek rekayasa, pertanyaan refleksi untuk jurnal pribadi, atau studi kasus evaluasi tentang efektivitas solusi teknologi dalam meningkatkan ketahanan pangan.</p>\r\n', '<ul>\r\n	<li>Guru memberikan tugas dan pertanyaan untuk memantau kemampuan siswa dalam menerapkan konsep dan memahami hasilnya.</li>\r\n	<li>Menggunakan rubrik penilaian yang jelas yang mencakup kemampuan mahasiswa dalam merancang solusi, pemahaman mereka tentang konsep rekayasa dan teknologi, dan kemampuan mereka untuk berkomunikasi dan berkolaborasi.</li>\r\n	<li>Memberikan umpan balik yang konstruktif kepada mahasiswa untuk membantu mereka memperbaiki pemahaman dan keterampilan mereka dalam literasi teknologi dan rekayasa.</li>\r\n</ul>\r\n', '<p><strong>Evaluate</strong></p>\r\n\r\n<p>Mahasiswa mempresentasikan prototipe dan hasil penelitian mereka menggunakan berbagai media.</p>\r\n', '<p>Rubrik penilaian yang jelas dan konsisten untuk menilai kualitas prototype, presentasi mahasiswa.</p>\r\n', '2 x 50 Menit', '<p>Penilaian hasil kerja dalam bentuk laporan akhir yang memuat:</p>\r\n\r\n<ol>\r\n	<li>Refleksi pribadi: Jelaskan proses evaluasi diri Anda dan apa yang di pelajari dari pengalaman ini.</li>\r\n	<li>Diskusi: Jika ada, jelaskan diskusi yang di miliki dengan dosen atau anggota kelompok tentang hasil solusi dan saran untuk perbaikan di masa depan.</li>\r\n	<li>Pelajaran dan Kesimpulan: Bagikan pelajaran utama yang di ambil dari proses ini dan kesimpulan akhir tentang solusi yang dirancang dan uji.</li>\r\n</ol>\r\n', '2024-06-28 08:16:37', NULL),
(9, 1, 7, '<p><strong>Posttest</strong></p>\r\n', '<p><strong>Posttest</strong></p>\r\n', '<p><strong>Posttest</strong></p>\r\n', '<p><strong>Posttest</strong></p>\r\n', '<p><strong>Posttest</strong></p>\r\n', '-', '<p><strong>Posttest</strong></p>\r\n', '2024-06-28 08:17:05', NULL),
(10, 1, 8, '<ul>\r\n	<li>Mahasiswa mampu mengajukan pertanyaan yang relevan dan mendalam untuk memperluas pemahaman mereka tentang topik tersebut.</li>\r\n	<li>Mahasiswa memiliki kemampuan untuk mengevaluasi informasi yang disajikan dan menyadari pentingnya masalah makanan borak dalam masyarakat.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Presentasi statistik konsumsi makanan borak dan dampaknya terhadap kesehatan masyarakat.</li>\r\n	<li>Studi kasus tentang dampak sosial dan lingkungan dari produksi dan konsumsi makanan borak.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Mahasiswa menyaksikan tampilan fenaomena saians berupa video singkat atau wacana tentang &quot;Makanan Borak: Perdebatan dan Tantangan dalam Ilmu Pangan dan Kesehatan Masyarakat&quot;.</li>\r\n	<li>Mengajukan pertanyaan terbuka kepada mahasiswa untuk memancing diskusi, misalnya: Apa saja dampak keracunan borak pada tubuh manusia, dan bagaimana cara mengidentifikasinya?.</li>\r\n	<li>Berdiskusi bagaimana teknologi dan rekayasa dapat membantu dalam mencegah dan menangani masalah makanan borak.</li>\r\n</ul>\r\n', '<p><strong>ENGAGE</strong></p>\r\n\r\n<p>Define the problem</p>\r\n\r\n<ul>\r\n	<li>Mahasiswa berpartisipasi dalam diskusi kelompok untuk berbagi pengetahuan dan pengalaman awal mengenai permasalahan makanan borak.</li>\r\n	<li>Mahasiswa mencatat pertanyaan atau area yang perlu dicari tahu lebih lanjut.</li>\r\n</ul>\r\n', '<p>Stimulus berupa wacana, artikel atau video pembelajaran</p>\r\n', '2 x 50 Menit', '<p>Penilaian hasil kerja mahasiswa dalam membuat laporan yang memuat:</p>\r\n\r\n<ol>\r\n	<li>Ringkasan fenomena.</li>\r\n	<li>Identifikasi masalah.</li>\r\n	<li>Pertanyaan reflektif.</li>\r\n	<li>Revelansi dengan konteks</li>\r\n</ol>\r\n', '2024-06-28 08:18:25', NULL),
(11, 1, 8, '<ul>\r\n	<li>Mahasiswa dapat melakukan pencarian literatur dan studi tentang kandungan nutrisi makanan borak dan dampaknya terhadap kesehatan.</li>\r\n	<li>Mahasiswa dapat berdiskusi dengan rekan-rekan mereka untuk berbagi temuan mereka dari riset awal.</li>\r\n	<li>Mahasiswa dapat menganalisis data dan informasi yang mereka kumpulkan untuk mengidentifikasi tren dan pola konsumsi makanan borak.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Risalah ilmiah tentang kandungan nutrisi dan bahaya kesehatan yang terkait dengan makanan borak.</li>\r\n	<li>Data survei tentang preferensi makanan borak dan pola konsumsi di kalangan mahasiswa atau populasi setempat.</li>\r\n	<li>Studi literatur tentang inisiatif global atau lokal untuk mengurangi konsumsi makanan borak dan meningkatkan kesadaran gizi.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Mahasiswa melakukan studi lapangan dan berpartisipasi dalam sesi tanya jawab dengan pedagang atau peneliti.</li>\r\n	<li>Mahasiswa mengumpulkan data dan informasi tentang permasalahan makanan borak dihadapi.</li>\r\n</ul>\r\n', '<p><strong>EXPLORE</strong></p>\r\n\r\n<p>Plan possible solutions</p>\r\n\r\n<ul>\r\n	<li>Mahasiwa melakukan eksplorasi tentang kontaminasi makanan borak dan teknologi pendeteksi yang telah ada.</li>\r\n	<li>Mahasiswa melakukan studi literatur untuk memahami konsep dasar mekanan borak, teori yang terkait, dan temuan-temuan penelitian terkini dalam bidang tersebut.</li>\r\n	<li>Mahasiswa mengajukan solusi terkait permasalahan yang dikemukakan</li>\r\n</ul>\r\n', '<p>Melakukan kunjungan lapangan ke tempat-tempat di mana mekanan borak menjadi perhatian utama, seperti pabrik-pabrik kimia atau laboratorium penelitian, untuk mendapatkan pemahaman praktis tentang aplikasi konsep yang dipelajari.</p>\r\n', '2 x 50 Menit', '<p>Penilaian hasil kerja dalam membuat laporan dan informasi pendukung yang memuat:</p>\r\n\r\n<ol>\r\n	<li>Ringkasan Rencana.</li>\r\n	<li>Rincian Solusi.</li>\r\n	<li>Analisa kelebihan dan kekurangan.</li>\r\n	<li>Pertimbangan lain.</li>\r\n</ol>\r\n', '2024-06-28 08:19:56', '2024-06-28 08:27:38'),
(12, 1, 9, '<ul>\r\n	<li>Mahasiswa dapat menggabungkan informasi dari berbagai sumber untuk memberikan penjelasan yang komprehensif tentang efek jangka panjang konsumsi makanan borak terhadap kesehatan.</li>\r\n	<li>Mahasiswa memiliki kemampuan untuk menyampaikan penjelasan mereka dengan jelas dan persuasif kepada audiens.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Artikel ilmiah tentang efek jangka panjang konsumsi makanan borak terhadap kesehatan jantung, obesitas, dan penyakit lainnya.</li>\r\n	<li>Infografik tentang siklus hidup makanan borak, dari produksi hingga pembuangan, dan dampaknya terhadap lingkungan.</li>\r\n	<li>Memberikan tinjauan pendekatan ilmiah dalam memahami permasalahan ini dari sudut pandang Pendidikan IPA Terpadu dan STEM.</li>\r\n	<li>Video dokumenter yang menjelaskan proses pembuatan makanan borak dan potensi bahaya bahan tambahan makanan yang digunakan.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Mahasiswa mempresentasikan hasil Studi lapangan tentang permasalahan makanan borak.</li>\r\n	<li>Mengajukan pertanyaan yang mendorong mahasiswa untuk memikirkan faktor-faktor seperti biaya, efektivitas, dan kelayakan implementasi.</li>\r\n	<li>Mahasiswa diminta untuk membuat diagram atau sketsa yang menjelaskan bagaimana solusi tersebut akan diimplementasikan.</li>\r\n	<li>Berdiskusi bersama mahasiswa tentang kelebihan dan kekurangan dari setiap solusi yang mereka rancang.</li>\r\n	<li>Memberikan tinjauan pendekatan ilmiah dalam memahami permasalahan ini dari sudut pandang Pendidikan IPA Terpadu dan STEM</li>\r\n</ul>\r\n', '<p><strong>EXPLAIN</strong></p>\r\n\r\n<p>Choose the possible solution</p>\r\n\r\n<ul>\r\n	<li>Mahasiswa mengajukan pertanyaan untuk pemahaman lebih lanjut.</li>\r\n	<li>Mahasiswa berpartisipasi dalam diskusi kelas untuk memperdalam konsep.</li>\r\n</ul>\r\n', '<p>Materi pembelajaran yang berkualitas, seperti buku teks, artikel ilmiah, dan sumber daya multimedia yang menjelaskan konsep-konsep makanan borak.</p>\r\n', '2 x 50 Menit', '<p>Penilaian hasil kerja terhadap solusi yang dipilih dalam bentuk laporan rencana rancangan proyek yang memuat:</p>\r\n\r\n<ol>\r\n	<li>Penjelasan pilihan solusi.</li>\r\n	<li>Analisis kelebihan solusi.</li>\r\n	<li>Pertimbangan solusi alternatif.</li>\r\n	<li>Kesimpulan</li>\r\n</ol>\r\n', '2024-06-28 08:21:27', NULL),
(13, 1, 10, '<ul>\r\n	<li>Mahasiswa dapat berpikir kreatif dalam merancang solusi inovatif untuk mengurangi konsumsi makanan borak atau menciptakan alternatif yang lebih sehat.</li>\r\n	<li>Mahasiswa memiliki kemampuan untuk menerapkan konsep ilmiah dan teknis dalam merancang solusi yang efektif untuk masalah makanan borak.</li>\r\n	<li>Mahasiswa dapat bekerja sama dalam tim untuk merancang prototipe solusi dan berbagi ide-ide untuk meningkatkan desainnya.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Studi kasus tentang penggunaan teknologi baru dalam produksi makanan yang lebih sehat dan ramah lingkungan.</li>\r\n	<li>Jurnal penelitian tentang pengembangan bahan baku makanan alternatif yang lebih sehat dan berkelanjutan.</li>\r\n	<li>Presentasi proyek dari kelompok-kelompok yang telah berhasil merancang prototipe produk makanan sehat dengan menggunakan pendekatan teknik.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Mahasiswa merancang rencana operasional yang mencakup langkah-langkah konkret untuk menerapkan solusi yang telah dipilih.</li>\r\n	<li>Mahasiswa melakukan simulasi atau percobaan praktis yang meniru kondisi di lapangan untuk menguji rencana solusi.</li>\r\n	<li>Mahasiswa diminta untuk mencatat hasil pengujian dan mengidentifikasi area yang perlu perbaikan.</li>\r\n	<li>Berdiskusi terkait hasil pengujian dengan mahasiswa dan mengaajukan pertanyaan reflektif untuk membantu mereka mengevaluasi kembali rencana solusi mereka.</li>\r\n	<li>Mahasiswa memperbaiki dan mengembangkan rencana mereka berdasarkan pembelajaran dari pengujian.</li>\r\n</ul>\r\n', '<p><strong>ENGINEER</strong></p>\r\n\r\n<p>Design, test, redesign.</p>\r\n\r\n<ul>\r\n	<li>Mahasiswa membentuk kelompok dan merancang prototipe teknologi pendeteksi makanan borak.</li>\r\n	<li>Mahasiswa mengidentifikasi komponen kunci dan cara kerja.</li>\r\n	<li>Mahasiswa melakukan uji coba 1 prototipe dan merefleksikan perbaikan yang dapat dilakukan.</li>\r\n	<li>Mahasiswa melakukan perbaikan terhadap prototipe apabila tidak sesuai dengan harapan.</li>\r\n	<li>Mahasiswa melakukan uji coba 2 prototipe.</li>\r\n</ul>\r\n', '<p>Akses ke fasilitas laboratorium atau <em>workshop</em> yang dilengkapi dengan peralatan teknologi dan peralatan percobaan.</p>\r\n', '2 x 50 Menit', '<ul>\r\n	<li>Penilaian hasil kerja prosedur pembuatan produk.</li>\r\n	<li>Penilaian hasil uji coba dan revisi produk</li>\r\n	<li>Penilaian Produk</li>\r\n</ul>\r\n', '2024-06-28 08:22:53', NULL),
(14, 1, 11, '<ul>\r\n	<li>Mahasiswa dapat merefleksikan pengalaman yang mereka peroleh untuk menyajikan inovasi/ kebaharuan dari prototype yang telah dikembangkan</li>\r\n	<li>Mahasiswa memiliki kemampuan untuk melakukan penelitian lanjutan dan memperdalam pemahaman mereka tentang topik tersebut.</li>\r\n</ul>\r\n', '<p>Artikel ilmiah, buku, atau sumber lainnya yang bisa dijadikan referensi.</p>\r\n', '<ul>\r\n	<li>Memberikan tugas kepada mahasiswa untuk mengeksplorasi inovasi/ kebaharuan pada prototype yang telah di buat.</li>\r\n	<li>Mahasiswa mempresentasikan inovasi/kebaharuan yang ditemukan di kelas.</li>\r\n</ul>\r\n', '<p><strong>ENRICH</strong></p>\r\n\r\n<p>Communicate</p>\r\n\r\n<ul>\r\n	<li>Mahasiswa menyajikan inovasi/ kebaharuan yang dapat di tambahkan pada prototype yang telah di buat.</li>\r\n	<li>Mahasiswa mempresentasikan prototipe dan hasil penelitian mereka menggunakan berbagai media.</li>\r\n</ul>\r\n', '<p>Inovasi terbaru dalam ketahanan pangan.</p>\r\n', '2 x 50 Menit', '<p>Penilaian hasil kerja presentasi atau demonstrasi yang memuat:</p>\r\n\r\n<ol>\r\n	<li>Rancangan inovasi/kebaharuan yang di kembangkan.</li>\r\n	<li>Deskripsi rancangan.</li>\r\n	<li>Temuan dan Kesimpulan</li>\r\n</ol>\r\n', '2024-06-28 08:24:00', NULL),
(15, 1, 11, '<ul>\r\n	<li>Mahasiswa dapat mengumpulkan dan menganalisis data dari pengujian prototipe solusi untuk mengevaluasi kinerjanya.</li>\r\n	<li>Mahasiswa memiliki kemampuan untuk mengevaluasi keberhasilan solusi yang mereka rancang dan mengidentifikasi area yang perlu diperbaiki atau ditingkatkan.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Laporan hasil uji coba produk makanan sehat yang telah dirancang oleh mahasiswa, termasuk data pengukuran kesadaran konsumen dan dampaknya terhadap perilaku konsumsi makanan.</li>\r\n	<li>Hasil survei kepuasan pengguna terhadap produk makanan alternatif yang telah dirancang, termasuk umpan balik tentang rasa, harga, dan ketersediaan.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Menggunakan rubrik penilaian yang jelas yang mencakup kemampuan mahasiswa dalam merancang solusi, pemahaman mereka tentang konsep rekayasa dan teknologi, dan kemampuan mereka untuk berkomunikasi dan berkolaborasi.</li>\r\n	<li>Memberikan umpan balik yang konstruktif kepada mahasiswa untuk membantu mereka memperbaiki pemahaman dan keterampilan mereka dalam literasi teknologi dan rekayasa.</li>\r\n</ul>\r\n', '<p><strong>Evaluate</strong></p>\r\n\r\n<p>Communicate</p>\r\n\r\n<p>Mahasiswa mempresentasikan prototipe dan hasil penelitian mereka menggunakan berbagai media</p>\r\n', '<p>Rubrik penilaian yang jelas dan konsisten untuk menilai kualitas proyek rekayasa, presentasi, dan karya tulis mahasiswa.</p>\r\n', '2 x 50 Menit', '<p>Penilaian hasil kerja dalam bentuk laporan akhir yang memuat:</p>\r\n\r\n<ol>\r\n	<li>Refleksi pribadi: Jelaskan proses evaluasi diri Anda dan apa yang di pelajari dari pengalaman ini.</li>\r\n	<li>Diskusi: Jika ada, jelaskan diskusi yang di miliki dengan dosen atau anggota kelompok tentang hasil solusi dan saran untuk perbaikan di masa depan.</li>\r\n	<li>Pelajaran dan Kesimpulan: Bagikan pelajaran utama yang di ambil dari proses ini dan kesimpulan akhir tentang solusi yang dirancang dan uji.</li>\r\n</ol>\r\n', '2024-06-28 08:25:42', NULL),
(16, 1, 12, '<p><strong>Posttes</strong></p>\r\n', '<p><strong>Posttes</strong></p>\r\n', '<p><strong>Posttes</strong></p>\r\n', '<p><strong>Posttes</strong></p>\r\n', '<p><strong>Posttes</strong></p>\r\n', '-', '<p><strong>Posttes</strong></p>\r\n', '2024-06-28 08:26:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_diskusi`
--

CREATE TABLE `tb_diskusi` (
  `id_diskusi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pertemuan` int(11) NOT NULL,
  `komentar` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_diskusi`
--

INSERT INTO `tb_diskusi` (`id_diskusi`, `id_user`, `id_pertemuan`, `komentar`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 'Seperti mati lampu ya sayang, sperti mati lampu....', '2024-07-18 10:06:03', NULL),
(3, 2, 2, 'Sampai kapan kau gantung cerita cintaku, memberi harapan', '2024-07-18 10:06:19', '2024-07-18 10:15:20'),
(4, 2, 1, 'Seperti mati lampu ya sayang, sperti mati lampu. cintaku padamu ya sayang', '2024-07-18 10:09:22', NULL),
(5, 2, 1, 'iya nanti kami kesana', '2024-07-18 11:29:02', NULL),
(6, 7, 1, 'siap ibu kami kerjakan dan berikan penjelasan', '2024-07-18 11:49:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban_essai`
--

CREATE TABLE `tb_jawaban_essai` (
  `id_jawaban_essai` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jawaban_text` text DEFAULT NULL,
  `jawaban_file` text DEFAULT NULL,
  `jawaban_gambar` text DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jawaban_essai`
--

INSERT INTO `tb_jawaban_essai` (`id_jawaban_essai`, `id_soal`, `id_user`, `jawaban_text`, `jawaban_file`, `jawaban_gambar`, `nilai`, `feedback`, `created_at`, `updated_at`) VALUES
(2, 32, 7, '', NULL, NULL, 0, '<p>Isi jawabannya</p>\r\n', '2024-07-28 10:11:22', '2024-07-28 12:12:53'),
(3, 33, 7, '', NULL, NULL, NULL, NULL, '2024-07-28 10:11:22', NULL),
(4, 35, 7, '', NULL, NULL, NULL, NULL, '2024-07-28 10:11:22', NULL),
(5, 36, 7, '', NULL, NULL, NULL, NULL, '2024-07-28 10:11:22', NULL),
(6, 34, 7, NULL, '8fb7994882c32cd00b6b7ddc8e027a2c.pptx', NULL, NULL, NULL, '2024-07-28 10:11:22', NULL),
(7, 30, 7, NULL, NULL, 'da288676baab4e69a7a55a32738c3fe0.png', 100, '<p>Keren sangat kreatif</p>\r\n', '2024-07-28 10:10:50', '2024-07-28 12:14:42'),
(8, 11, 7, 'dua dua', NULL, NULL, NULL, NULL, '2024-07-28 10:16:34', NULL),
(9, 12, 7, 'dua dua', NULL, NULL, NULL, NULL, '2024-07-28 10:16:34', NULL),
(10, 13, 7, 'dua dua', NULL, NULL, NULL, NULL, '2024-07-28 10:16:34', NULL),
(11, 14, 7, 'Sebelum merancang dan membuat proyek buatlah hipotesis penyelidikanmu pada kolom di bawah ini, berdasarkan informasi yang telah kamu peroleh sebelumnya. Tujuannya agar penyelidikan yang kamu lakukan menjadi terarah, memeriksa fakta dan hubungan variabel serta membimbing penelitianmu dalam pengujian dan penyesuaian fakta.', NULL, NULL, NULL, NULL, '2024-07-28 10:16:34', NULL),
(12, 15, 7, 'Periksa Isi $_FILES:\r\nMenambahkan print_r($_FILES) untuk melihat detail file yang diunggah dan memastikan bahwa file tersebut diterima oleh server.\r\n\r\nPeriksa Pesan Error Pengunggahan:\r\nTambahkan print_r($this->upload->display_errors()) untuk melihat pesan error dari proses pengunggahan.', NULL, NULL, 30, '<p>Yang betul</p>\r\n', '2024-07-28 10:16:34', '2024-07-28 12:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_landing_page`
--

CREATE TABLE `tb_landing_page` (
  `id_landing_page` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` varchar(500) DEFAULT NULL,
  `link_page` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mata_kuliah`
--

CREATE TABLE `tb_mata_kuliah` (
  `id_mata_kuliah` int(11) NOT NULL,
  `nama_mata_kuliah` varchar(255) NOT NULL,
  `kode_mata_kuliah` varchar(20) NOT NULL,
  `program_studi` varchar(255) NOT NULL,
  `bobot_sks` int(11) NOT NULL,
  `jenjang` varchar(10) NOT NULL,
  `semester` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `deskripsi_mata_kuliah` text NOT NULL,
  `cpl` text DEFAULT NULL,
  `cpmk` text DEFAULT NULL,
  `link_rps` text DEFAULT NULL,
  `link_modul` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_mata_kuliah`
--

INSERT INTO `tb_mata_kuliah` (`id_mata_kuliah`, `nama_mata_kuliah`, `kode_mata_kuliah`, `program_studi`, `bobot_sks`, `jenjang`, `semester`, `status`, `deskripsi_mata_kuliah`, `cpl`, `cpmk`, `link_rps`, `link_modul`, `created_at`, `updated_at`) VALUES
(1, 'Pendidikan IPA Terpadu', '0603221', 'Pendidikan IPA', 1, 'S1', 2, 'wajib', '<p>Mata kuliah ini mencakup berbagai konsep dan topik yang berkaitan dengan integrasi ilmu-ilmu ains dalam konteks Pendidikan seperti konsep dasar sains, integrasi konsep bidang ilmu, teknologi dalam pembelajaran IPA yang dilaksanakan secara tematik. Kompetensi yang dibekalkan pada mata kuliah ini yaitu untuk mengembangkan keterampilan integrasi ilmu-ilmu sains, berpikir kritis, berpikir kreatif, kolaborasi, komunikasi, dan literasi teknologi dan rekayasa serta memecahkan &nbsp;masalah yang ada di sekitar serta keterampilan pengambilan keputusan engan mempertimbangkan tantangan local, nasional, dan global, serta pembentukan sikap kemampuan kesadaran, kepedulian dan tanggung jawab terhadap pencapaian hasil kerja kelompok dan melakukan evaluasi terhadap penyelesaian pekerjaan yang ditugaskan. Selain itu, materi pokok perkuliahan berisikan tema ketahanan pangan. Mata kuliah ini bersifat integrative dan untuk tema pelaksanaan pembelajaran berbasis proyek. Proses pembelajaran menggunakan model 6E STEM Learning. Penilaian dilakukan melalui penilaian partisipasi, kinerja, penugasan, dan laporan hasil kegiatan baik ecara tertulis maupun dalam bentuk produk.</p>\r\n', '<ul>\r\n	<li>Menunjukkan sikap bertanggungjawab atas pekerjaan di bidang keahliannya secara mandiri (S8)</li>\r\n	<li>Menguasai memanfaatkan IPTEKS dalam bidang keahliannya dan mampu beradaptasi terhadap situasi yang dihadapi dalam penyelesaian masalah, konsep teoritis pemecahan masalah dalam pembelajaran IPA membangun literasi Sains, STEM, dan multiliterasi berdasarkan masalah yang ada dilingkungan sekitar dalam rangka mewujudkan pendidikan untuk pembangunan berkelanjutan (ESD) (P1).</li>\r\n	<li>Mampu merencanakan, dan melaksanakan pembelajaran IPA kurikuler, kokurikuler dan ekstra kurikuler dengan memanfaatkan berbagai sumber belajar, media pembelajaran berbasis IPTEKS, dan potensi lingkungan setempat, untuk menghasilkan pembelajaran aktif, inovatif, kreatif dan menyenangkan sesuai standar proses dan mutu yang dapat membangun literasi sains, STEM, dan multi literasi dalam rangka mewujudkan pendidikan untuk pembangunan berkelanjutan (KK1)</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Menguasai konsep keterpaduan dengan pendekatan STEM untuk mendukung pelaksanaan pembelajaran IPA Terpadu/terintegrasi. (P)</li>\r\n	<li>Memahami hubungan antara ilmu sains, teknologi, rekayasa, dan matematika dalam konteks permasalahan makanan borak, ketahanan pangan serta dapat mengembangkan solusi untuk masalah tersebut (P).</li>\r\n	<li>Mengembangkan pembelajaran IPA terpadu dengan pendekatan STEM dari berbagai sumber dan malului pemanfaatan teknologi untuk mendukung pelaksanaan pembelajaran IPA Terpadu/terintegrasi.(KK)</li>\r\n	<li>Memiliki literasi Teknologi dan rekayasa dalam rangka menyelesaikan permasalahan yang ada disekitarnya (KK)</li>\r\n	<li>Memiliki kemampuan memecahkan masalah yang ada disekitar secara integratif (KK)</li>\r\n	<li>Memiliki kemampuan kesadaran, kepedulian dan tanggung jawab terhadap pencapaian hasil kerja kelompok dan melakukan evaluasi terhadap penyelesaian pekerjaan yang di tugaskan (S)</li>\r\n</ul>\r\n', 'https://drive.google.com/file/d/1ouphit_sW-P3JVszxljH5KN9yxTnhKur/view', 'https://drive.google.com/file/d/10N3I6E7-pwh2rQUnjxSMsQjTIW3QzGnk/preview', '2024-06-27 17:53:59', '2024-07-03 05:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `tb_permasalahan`
--

CREATE TABLE `tb_permasalahan` (
  `id_permasalahan` int(11) NOT NULL,
  `id_pertemuan` int(11) NOT NULL,
  `tahapan_pembelajaran` varchar(50) DEFAULT NULL,
  `judul_permasalahan` varchar(500) DEFAULT NULL,
  `deskripsi_permasalahan` text NOT NULL,
  `foto` text DEFAULT NULL,
  `jumlah_soal` int(11) NOT NULL,
  `link_permasalahan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_permasalahan`
--

INSERT INTO `tb_permasalahan` (`id_permasalahan`, `id_pertemuan`, `tahapan_pembelajaran`, `judul_permasalahan`, `deskripsi_permasalahan`, `foto`, `jumlah_soal`, `link_permasalahan`, `created_at`, `updated_at`) VALUES
(4, 1, 'Engage', 'Work Sheet Identifikasi Masalah', '<p><strong>FAKTA LAPANGAN</strong>:</p>\r\n\r\n<p>Bacalah artikel berikut dengan teliti!</p>\r\n\r\n<p>Dalam dunia yang terus berkembang ini, ketahanan pangan telah menjadi salah satu isu yang paling kritis dan mendesak. Ketahanan pangan bukan hanya sekedar tentang memastikan bahwa setiap orang memiliki akses terhadap makanan yang cukup, melainkan juga tentang memastikan bahwa makanan tersebut berkualitas, aman, dan berkelanjutan dalam jangka panjang. Banyak faktor yang dapat mempengaruhi ketahanan pangan, di antaranya dapat dipengaruhi oleh faktor produksi seperti lahan, air, dan teknologi pertanian.</p>\r\n\r\n<p>Masalah penyediaan pangan di Provinsi Riau dimasa mendatang cukup serius, karena tingginya pertumbuhan penduduk, kemiskinan, adanya degradasi lingkungan, kurs nilai rupiah, kekeringan dan alih fungsi lahan yang akan berdampak terhadap produksi berbagai komoditas pertanian tanaman pangan khususnya beras, dipihak lain ketersediaan pangan akan ditentukan oleh produksi pangan di daerah ini.&nbsp; Data menunjukkan defisit pangan utama Beras yang semakin membesar, dimana saat ini telah mencapai angka 294.288 Ton atau 47,6%, dibanding tahun lalu deficit Beras 273.145 Ton atau 44,6%. Ini disebabkan masih rendahnya produksi padi akibat, terjadinya kerusakan infra struktur pengairan yaitu 52 % di Daerah Irigasi (DI) dan 49% di Daerah Rawa (DR). Kemudian berlangsungnya terus alih fungsi lahan dan 3 tahun terakhir ini telah mencapai 17.000 Ha.</p>\r\n\r\n<p>Kabupaten Kampar, Provinsi Riau sebagai salah satu daerah alur sungai merupakan wilayah yang potensial untuk budi daya ikan air tawar dan mengairi lahan pertanian masyarakat. Permasalahannya adalah tidak semua kolam dan lahan pertanian masyarakat posisinya berada di bawah aliran sungai, banyak juga kolam dan lahan pertanian yang memiliki posisi lebih tinggi dibandingkan dengan posisi aliran sungai. Sejauh ini masyarakat memanfaatkan pompa diesel untuk mengalirkan air ke kolam dan lahan pertanian mereka, tentunya menambah biaya dan kurang ramah lingkungan. Seharusnya dengan memanfaatkan potensi alam (aliran sungai) dapat meminimalisasi biaya dan lebih ramah lingkungan.</p>\r\n\r\n<p>Optimalisasi pemanfaatan sumber daya alam bukanlah hal yang mudah. Banyak kendala yang terjadi di lapangan terkait dengan pemanfaatannya. Dari aspek teknologi, sumber daya air yang berfungsi mengambil dan menaikkan air dari sungai ke lahan pertanian dan kolam yang diketahui oleh masyarakat berjalan stagnan. Pompa diesel atau modifikasi mesin motor sebagai alat penyedot air merupakan alat yang sudah banyak diketahui masyarakat.&nbsp; Proses pengambilan atau penyedotan air yang dilakukan untuk mengairi persawahan dan kolam juga mengeluarkan biaya yang tidak sedikit. Teknologi sumber daya air yang mayoritas berwujud pompa bukan merupakan suatu yang baru. Hanya saja, dalam penggunaannya dapat meminimalisasi biaya atau dapat memanfaatkan potensi alam sekitar.</p>\r\n\r\n<p>Gambar (b) merupakan cara yang biasa dilakukan oleh masyarakat untuk mengalirkan air ke lahan pertanian dan kolam ikan mereka dengan menggunakan pompa diesel berbahan bakar fosil dan minyak bumi.</p>\r\n\r\n<p>Setelah membaca artikel, temukan akar masalah dari artikel tersebut, kamu dapat memulai dengan menjawab pertanyaan berikut disertai dengan fakta (pengetahuan dan data) pendukung!</p>\r\n', 'eb06cbfc8ce1a23d19fe7c0338bb36f9.png', 4, '', '2024-07-03 13:51:31', '2024-07-03 13:58:47'),
(6, 1, 'Explore', 'Work Sheet Pengumpulan Informasi Pendukung', '<p>Lakukanlah explorasi lapangan di daerahmu masing-masing terkait dengan proses pengairan air ke lahan pertanian masyarakat! Dan amati juga potensi yang ada di daerahmu sebagai informasi awal untuk mengatasi permasalahan yang kamu temukan nantinya. Kamu dapat melakukan wawancara, observasi dan studi dokumentasi untuk menemukan akar masalahnya.</p>\r\n', ' ', 4, '', '2024-07-03 14:03:26', NULL),
(7, 2, 'Explain', '', '<p><em>Sekilas info:</em></p>\r\n\r\n<p>Terdapat beberapa cara yang dapat dilakukan untuk mengalirkan air yang berada pada posisi rendah ke posisi yang lebih tinggi dengan biaya yang murah dan ramah lingkungan yaitu dengan membuat pompa air bebas energi listrik dan kincir air. Selain itu untuk mendistribusikan air ke lahan pertanian dapat dilakukan dengan metode tetes.</p>\r\n', ' ', 5, '', '2024-07-09 06:52:12', NULL),
(8, 3, 'Engineering', 'Worksheet Rancangan Proyek', '<p>Pada Worksheet Rancangan Proyek ini, kamu diminta membuat rancangan solusi untuk mengatasi masalah pada Worksheet sebelumnya, berupa gambar desain proyek (alat untuk mengalirkan air dari posisi rendah ke posisi yang lebih tinggi) serta (sistem distribusi air) yang kamu pilih. Buatlah gambar desain protipe dan metode yang telah kamu pilih tersebut sebagus mungkin dengan detail penjelasannya dan <strong>jelaskan inovasi</strong> apa yang kamu lakukan pada prototipe itu serta biaya yang dibutuhkan untuk membuat prototipe yang kamu pilih pada kolom di bawah ini!</p>\r\n', ' ', 3, 'https://www.youtube.com/embed/zpOULjyy-n8?rel=0', '2024-07-09 07:06:22', NULL),
(9, 3, 'Engineering', 'Worksheet Prosedur Pembuatan Proyek', '<p>Pada Worksheet Prosedur Pembuatan Proyek ini, kamu diminta untuk membuat prosedur pembuatan produk. Susunlah alat dan siapkan bahan-bahan yang digunakan. Lakukan pembuatan prototype untuk mengalirkan air dari posisi rendah ke posisi yang lebih tinggi yang bebas energi listrik dan bahan bakar sesuai dengan rencana solusi yang sudah dibuat pada work sheet sebelumnya.</p>\r\n', ' ', 4, '', '2024-07-09 07:08:22', NULL),
(10, 3, 'Engineering', 'WorkSheet Uji Coba & Redisain', '<p>Pada Worksheet Uji Coba dan Redisain ini, kamu diminta untuk melakukan uji coba terkait proyek yang kamu kerjakan. Jika terdapat kendala atau dirasa masih ada yang perlu diperbaiki, maka lakukan proses EDP lagi untuk menemukan kendalanya dimana dan lakukan redisain terhadap proyek yang dikerjakan. Tuliskan atau deskripsikan uji coba yang kamu lakukan, lalu lakukan redisain terhadap produk (solusi) yang kamu buat dengan menuliskan apa saja yang kamu perbaiki.</p>\r\n', ' ', 7, '', '2024-07-09 07:10:44', NULL),
(11, 5, 'Enrich', '', '<p>Jika anda diberi waktu lebih untuk menyelesaikan prototype, inovasi apa yang akan anda tambahkan pada prototype tersebut.</p>\r\n', ' ', 5, '', '2024-07-09 07:13:45', '2024-07-27 13:51:02'),
(12, 6, 'Evaluate', '', '', ' ', 1, '', '2024-07-09 07:14:06', NULL),
(13, 8, 'Engage', 'Work Sheet Identifikasi Masalah', '<p>Bacalah artikel berikut dengan teliti!</p>\r\n\r\n<p>Di dunia yang semakin sadar akan kesehatan dan pola makan yang seimbang, semakin banyak orang yang mulai mempertimbangkan kualitas bahan makanan yang mereka konsumsi. Salah satu perhatian utama adalah penggunaan bahan tambahan seperti borak dalam makanan. Berbagai penelitian telah mengaitkan konsumsi borak dengan risiko kesehatan yang serius, dari gangguan pencernaan hingga masalah hormonal.</p>\r\n\r\n<p>Dalam kehidupan sehari-hari, kita sering kali dihadapkan pada berbagai pilihan makanan yang tersedia di pasar, supermarket, restoran, dan bahkan di rumah sendiri. Namun, kebanyakan dari kita tidak memiliki pengetahuan atau alat yang diperlukan untuk secara akurat mendeteksi keberadaan borak dalam makanan yang kita konsumsi. Sebagai hasilnya, kita sering kali tidak menyadari risiko yang terkait dengan makanan yang kita beli atau santap setiap hari.</p>\r\n\r\n<p>Salah satu kesulitan utama dalam mendeteksi makanan borak adalah bahwa borak tidak selalu terlihat, tercium, atau dirasakan oleh indera manusia. Ini membuatnya sulit untuk mengetahui apakah suatu makanan mengandung borak hanya dengan melihat atau menciumnya. Kebanyakan borak tidak memberikan perubahan warna, rasa, atau aroma yang jelas pada makanan, sehingga sulit untuk mengidentifikasi keberadaannya secara visual atau sensoris.</p>\r\n\r\n<p>Di tengah kemajuan teknologi yang pesat, banyak masyarakat tidak menyadari bahwa ada teknologi yang mudah digunakan untuk mendeteksi keberadaan borak dalam makanan. Sebagian besar orang mungkin tidak mengetahui bahwa ada sensor dan perangkat yang tersedia untuk memeriksa kandungan borak dalam makanan secara cepat dan akurat. Sensor optik portabel yang dapat digunakan untuk mendeteksi borak dalam makanan. Sensor ini biasanya berupa perangkat kecil yang dapat dipindahkan dan mudah dibawa ke mana-mana. Cara kerjanya adalah dengan menempatkan sensor di atas atau dekat dengan sampel makanan, kemudian perangkat akan mengukur cahaya yang dipantulkan dari sampel tersebut. Berdasarkan pola cahaya yang diterima, sensor dapat memberikan informasi tentang konsentrasi borak dalam makanan.</p>\r\n\r\n<p>Setelah membaca artikel, temukan akar masalah dari artikel tersebut, kamu dapat memulai dengan <strong>menjawab pertanyaan</strong> berikut disertai dengan <strong>fakta</strong> (pengetahuan dan data) <strong>pendukung</strong>!</p>\r\n', '44126c6f5c4c061101ea207f560d5776.png', 4, '', '2024-07-27 13:28:02', NULL),
(14, 8, 'Explore', 'Work Sheet Pengumpulan Informasi Pendukung', '<p><strong>Deskripsi Permasalahan</strong>:</p>\r\n\r\n<p>Lakukanlah explorasi lapangan di daerahmu masing-masing terkait dengan proses pengairan air ke lahan pertanian masyarakat! Dan amati juga potensi yang ada di daerahmu sebagai informasi awal untuk mengatasi permasalahan yang kamu temukan nantinya. Kamu dapat melakukan wawancara, observasi dan studi dokumentasi untuk menemukan akar masalahnya.</p>\r\n', ' ', 4, '', '2024-07-27 13:36:36', NULL),
(15, 9, 'Explain', '', '<p><em>Sekilas info:</em></p>\r\n\r\n<p>Terdapat beberapa cara untuk mendeteksi makanan yang mengandung borak. Salah satunya menggunakan teknologi sensor pintar, sensor cahaya (optik) atau sensor warna yang terhubung ke perangkat pintar juga dapat digunakan untuk mendeteksi borak dalam makanan. Sensor ini dapat memberikan pembacaan langsung tentang konsentrasi borak dalam sampel makanan.</p>\r\n', ' ', 5, '', '2024-07-27 13:38:47', NULL),
(16, 10, 'Engineering', 'Worksheet Rancangan Proyek', '<p>Pada Worksheet Rancangan Proyek ini, kamu diminta membuat rancangan solusi untuk mengatasi masalah pada Worksheet sebelumnya, berupa gambar desain proyek (alat untuk mengalirkan air dari posisi rendah ke posisi yang lebih tinggi) serta (sistem distribusi air) yang kamu pilih. Buatlah gambar desain protipe dan metode yang telah kamu pilih tersebut sebagus mungkin dengan detail penjelasannya dan <strong>jelaskan inovasi</strong> apa yang kamu lakukan pada prototipe itu serta biaya yang dibutuhkan untuk membuat prototipe yang kamu pilih pada kolom di bawah ini!</p>\r\n', ' ', 3, '', '2024-07-27 13:41:22', NULL),
(17, 10, 'Engineering', 'Worksheet Prosedur Pembuatan Proyek', '<p>Pada Worksheet Prosedur Pembuatan Proyek ini, kamu diminta untuk membuat prosedur pembuatan produk. Susunlah alat dan siapkan bahan-bahan yang digunakan. Lakukan pembuatan prototype untuk untuk mendeteksi makanan yang mengandung borak sesuai dengan rencana solusi yang sudah dibuat pada work sheet sebelumnya.</p>\r\n', ' ', 4, '', '2024-07-27 13:43:02', NULL),
(18, 10, 'Engineering', 'WorkSheet Uji Coba & Redisain', '<p>Pada Worksheet Uji Coba dan Redisain ini, kamu diminta untuk melakukan uji coba terkait proyek yang kamu kerjakan. Jika terdapat kendala atau dirasa masih ada yang perlu diperbaiki, maka lakukan proses EDP lagi untuk menemukan kendalanya dimana dan lakukan redisain terhadap proyek yang dikerjakan. Tuliskan atau deskripsikan uji coba yang kamu lakukan, lalu lakukan redisain terhadap produk (solusi) yang kamu buat dengan menuliskan apa saja yang kamu perbaiki.</p>\r\n', ' ', 7, '', '2024-07-27 13:45:23', NULL),
(19, 11, 'Enrich', '', '<p>Jika anda diberi waktu lebih untuk menyelesaikan prototype, inovasi apa yang akan anda tambahkan pada prototype tersebut.</p>\r\n', ' ', 5, '', '2024-07-27 13:48:57', NULL),
(20, 12, 'Evaluate', '', '', ' ', 1, '', '2024-07-27 13:51:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pertemuan`
--

CREATE TABLE `tb_pertemuan` (
  `id_pertemuan` int(11) NOT NULL,
  `no_pertemuan` int(11) NOT NULL,
  `judul_pertemuan` varchar(100) NOT NULL,
  `deskripsi_pertemuan` text DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pertemuan`
--

INSERT INTO `tb_pertemuan` (`id_pertemuan`, `no_pertemuan`, `judul_pertemuan`, `deskripsi_pertemuan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pertemuan Ke-1', 'Tujuan Proyek: Mengatasi permasalahan Sistem Irigasi', '1', '2024-06-27 14:58:53', '2024-06-28 07:54:30'),
(2, 2, 'Pertemuan Ke-2', NULL, '1', '2024-06-27 14:58:55', NULL),
(3, 3, 'Pertemuan Ke-3', NULL, '1', '2024-06-27 14:58:58', NULL),
(5, 4, 'Pertemuan Ke-4', '', '1', '2024-06-28 07:55:09', NULL),
(6, 5, 'Pertemuan Ke-5', '', '1', '2024-06-28 07:55:21', NULL),
(7, 6, 'Pertemuan Ke-6', '', '0', '2024-06-28 07:55:36', NULL),
(8, 7, 'Pertemuan Ke-7', '', '1', '2024-06-28 07:56:08', NULL),
(9, 8, 'Pertemuan Ke-8', '', '0', '2024-06-28 07:56:16', NULL),
(10, 9, 'Pertemuan Ke-9', '', '0', '2024-06-28 07:56:26', NULL),
(11, 10, 'Pertemuan Ke-10', '', '0', '2024-06-28 07:56:33', NULL),
(12, 11, 'Pertemuan Ke-11', '', '0', '2024-06-28 07:56:41', NULL),
(13, 12, 'Pertemuan Ke-12', '', '0', '2024-06-28 07:58:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_role_user`
--

CREATE TABLE `tb_role_user` (
  `id_role_user` int(11) NOT NULL,
  `role_user` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_role_user`
--

INSERT INTO `tb_role_user` (`id_role_user`, `role_user`, `created_at`, `updated_at`) VALUES
(1, 'Siswa', '2024-06-21 07:38:52', NULL),
(2, 'Guru', '2024-06-21 07:38:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_score`
--

CREATE TABLE `tb_score` (
  `id_score` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `score_pretest` int(11) DEFAULT NULL,
  `score_posttest` int(11) DEFAULT NULL,
  `score_pertemuan` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal_essai`
--

CREATE TABLE `tb_soal_essai` (
  `id_soal_essai` int(11) NOT NULL,
  `id_permasalahan` int(11) NOT NULL,
  `no_soal` int(11) NOT NULL,
  `deksripsi_soal` text NOT NULL,
  `tipe_jawaban` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_soal_essai`
--

INSERT INTO `tb_soal_essai` (`id_soal_essai`, `id_permasalahan`, `no_soal`, `deksripsi_soal`, `tipe_jawaban`, `created_at`, `updated_at`) VALUES
(2, 4, 1, 'Apa yang menjadi masalah utama pada artikel yang kamu baca?', 2, '2024-07-03 14:38:01', NULL),
(4, 4, 2, 'Mengapa hal tersebut masalah pada gambar (a), (b) terjadi?', 2, '2024-07-03 14:47:08', NULL),
(5, 4, 3, 'Bagaimana cara mengatasi permasalahan pada artikel menurutmu?', 2, '2024-07-03 14:47:27', NULL),
(6, 4, 4, 'Tuliskan pengetahuan dan data pendukung yang mendasari jawabanmu di atas pada kolom di bawah ini (disertakan link sumber rujukannya)', 2, '2024-07-03 14:47:51', NULL),
(7, 6, 1, 'Berdasarkan hasil wawancara, observasi dan studi dokumentasi, apa masalah inti yang perlu untuk kamu selidiki? (Nyatakan dalam bentuk pertanyaan)', 2, '2024-07-03 14:48:10', NULL),
(8, 6, 2, 'Apa saja bukti-bukti yang menguatkan bahwa pertanyaan tersebut memang menjadi masalah di daerahmu?', 2, '2024-07-03 14:48:26', NULL),
(9, 6, 3, 'Apa yang menjadi penyebab permasalahan tersebut?', 2, '2024-07-03 14:48:42', NULL),
(10, 6, 4, 'Apa saja dampak yang muncul akibat permasalahan tersebut?', 2, '2024-07-03 14:48:59', NULL),
(11, 7, 1, 'Carilah informasi lebih lanjut mengenai kedua alat dan sistem tersebut! Kamu dapat memulai dengan membuat pertanyaan dan menjawab pertanyaan pada kolom-kolom di bawah ini terkait dengan alat yang dibutuhkan untuk mengalirkan air dari tempat rendah ke tempat yang lebih tinggi tanpa energi listrik dan bahan bakar, jenis-jenis metode pengaliran air tanpa energi listrik dan bahan bakar, karakteristik setiap jenis metode pengaliran air tanpa energi listrik dan bahan bakar, faktor yang menyebabkan alat-alat tersebut efektif digunakan, dan biaya pembuatan untuk tiap jenisnya.', 2, '2024-07-09 06:53:09', NULL),
(12, 7, 2, 'Dari beberapa prototipe yang kamu ketahui, jenis manakah yang terbaik menurutmu? Berikan alasanmu dengan mempertimbangkan aspek ekonomi dan lingkungan!', 2, '2024-07-09 06:53:24', NULL),
(13, 7, 3, 'Dari beberapa metode distibusi air yang kamu ketahui, jenis manakah yang terbaik menurutmu? Berikan alasanmu dengan mempertimbangkan aspek ekonomi dan lingkungan!', 2, '2024-07-09 06:53:58', NULL),
(14, 7, 4, 'Buatlah pertanyaan tambahan beserta jawabannya untuk mendapatkan informasi lebih tentang alat tersebut. Tuliskan pertanyaan dan jawabanmu dalam kolom berikut!', 2, '2024-07-09 07:03:08', NULL),
(15, 7, 5, 'Sebelum merancang dan membuat proyek buatlah hipotesis penyelidikanmu pada kolom di bawah ini, berdasarkan informasi yang telah kamu peroleh sebelumnya. Tujuannya agar penyelidikan yang kamu lakukan menjadi terarah, memeriksa fakta dan hubungan variabel serta membimbing penelitianmu dalam pengujian dan penyesuaian fakta.', 2, '2024-07-09 07:04:08', '2024-07-09 07:05:06'),
(16, 8, 1, 'Keterangan / Penjelasan bagian-bagian produk:', 2, '2024-07-09 07:06:54', NULL),
(17, 8, 2, 'Inovasi', 2, '2024-07-09 07:07:13', NULL),
(18, 8, 3, 'Biaya yang dibutuhkan:', 2, '2024-07-09 07:07:31', NULL),
(19, 9, 1, 'Nama alat', 2, '2024-07-09 07:09:15', NULL),
(20, 9, 2, 'Tujuan', 2, '2024-07-09 07:09:29', NULL),
(21, 9, 3, 'Alat dan Bahan', 2, '2024-07-09 07:09:44', NULL),
(22, 9, 4, 'Buatlah langkah-langkah pembuatan proyek', 2, '2024-07-09 07:10:02', NULL),
(23, 10, 1, '[Uji Coba 1] Bagaimana cara menguji efektivitas prototipe/produk yang kamu buat?', 2, '2024-07-09 07:11:11', NULL),
(24, 10, 2, '[Uji Coba 1] Lakukan uji coba efektivitas produk sesuai dengan cara pengujian yang telah kamu susun! Sajikan hasil uji coba 1 yang telah kamu peroleh!', 2, '2024-07-09 07:11:30', NULL),
(25, 10, 3, '[Uji Coba 1] Evaluasi hasil dari uji coba 1 yang telah dilakukan! Adakah hal-hal yang perlu ditingkatkan dari desain produk yang diujicobakan tersebut? Jelaskan!', 2, '2024-07-09 07:11:50', NULL),
(26, 10, 4, '[Redisain] Berdasarkan hasil uji coba 1, Jelaskanlah perubahan apa yang akan kamu lakukan dari rancangan awal produkmu?', 2, '2024-07-09 07:12:07', NULL),
(27, 10, 5, '[Redisain] Bagaimana bentuk rancangan akhir produkmu? & Buatlah rancangan akhir tersebut!', 2, '2024-07-09 07:12:23', NULL),
(28, 10, 6, '[Uji Coba 2] Lakukan uji coba 2 dengan langkah yang sama dengan uji coba 1 untuk melihat efektivitas produk akhir yang kamu buat!', 2, '2024-07-09 07:12:41', NULL),
(29, 10, 7, '[Uji Coba 2] Berdasarkan hasil uji coba 2, apakah kesimpulanmu?', 2, '2024-07-09 07:12:57', NULL),
(30, 11, 1, 'Gambar Desain produk', 4, '2024-07-09 07:14:39', NULL),
(31, 11, 2, 'Keterangan / Penjelasan bagian-bagian produk:', 2, '2024-07-09 07:14:55', NULL),
(32, 11, 3, 'Inovasi', 2, '2024-07-09 07:15:09', NULL),
(33, 11, 4, 'Biaya yang dibutuhkan', 2, '2024-07-09 07:15:24', NULL),
(34, 11, 5, 'Silahkan persiapkan bahan presentasi terkait inovasi/ kebaruan yang diperbaiki atau ditambahkan dari prototype yang telah di buat. Silahkan upload file PPT yang digunakan untuk presentasi.', 3, '2024-07-09 07:15:43', NULL),
(35, 11, 6, '[Uji Coba 2] Lakukan uji coba 2 dengan langkah yang sama dengan uji coba 1 untuk melihat efektivitas produk akhir yang kamu buat!', 2, '2024-07-09 07:16:20', NULL),
(36, 11, 7, '[Uji Coba 2] Berdasarkan hasil uji coba 2, apakah kesimpulanmu?', 2, '2024-07-09 07:16:38', NULL),
(37, 12, 1, 'Silahkan beri tanggapan terhadap terhadap prototype yang telah dibuat', 2, '2024-07-09 07:16:58', NULL),
(38, 13, 1, 'Apa yang menjadi masalah utama pada artikel yang kamu baca?', 2, '2024-07-27 13:34:16', NULL),
(39, 13, 2, 'Mengapa hal tersebut masalah pada gambar tersebut?', 2, '2024-07-27 13:34:36', NULL),
(40, 13, 3, 'Bagaimana cara mengatasi permasalahan pada artikel menurutmu?', 2, '2024-07-27 13:34:56', NULL),
(41, 13, 4, 'Tuliskan pengetahuan dan data pendukung yang mendasari jawabanmu di atas pada kolom di bawah ini (disertakan link sumber rujukannya)', 2, '2024-07-27 13:35:55', NULL),
(42, 14, 1, 'Berdasarkan hasil wawancara, observasi dan studi dokumentasi, apa masalah inti yang perlu untuk kamu selidiki? (Nyatakan dalam bentuk pertanyaan)', 2, '2024-07-27 13:37:04', NULL),
(43, 14, 2, 'Apa saja bukti-bukti yang menguatkan bahwa pertanyaan tersebut memang menjadi masalah di daerahmu?', 2, '2024-07-27 13:37:23', NULL),
(44, 14, 3, 'Apa yang menjadi penyebab permasalahan tersebut?', 2, '2024-07-27 13:37:39', NULL),
(45, 14, 4, 'Apa saja dampak yang muncul akibat permasalahan tersebut?', 2, '2024-07-27 13:37:55', NULL),
(46, 15, 1, 'Informasi Pendukung!.\r\nCarilah informasi lebih lanjut mengenai teknologi tersebut! Kamu dapat memulai dengan membuat pertanyaan dan menjawab pertanyaan pada kolom-kolom di bawah ini terkait dengan alat yang dibutuhkan untuk mendeteksi makanan yang mengandung borak, karakteristik setiap jenis alat, faktor yang menyebabkan alat-alat tersebut efektif digunakan, dan biaya pembuatan untuk tiap jenisnya.\r\n', 2, '2024-07-27 13:39:16', NULL),
(47, 15, 2, 'Dari beberapa prototipe yang kamu ketahui, jenis manakah yang terbaik menurutmu? Berikan alasanmu dengan mempertimbangkan aspek ekonomi dan lingkungan!', 2, '2024-07-27 13:39:37', NULL),
(48, 15, 3, 'Dari beberapa pendeteksi makanan mengandung borak yang kamu ketahui, jenis manakah yang terbaik menurutmu? Berikan alasanmu dengan mempertimbangkan aspek ekonomi dan lingkungan!', 2, '2024-07-27 13:39:57', NULL),
(49, 15, 4, 'Buatlah pertanyaan tambahan beserta jawabannya untuk mendapatkan informasi lebih tentang alat tersebut. Tuliskan pertanyaan dan jawabanmu dalam kolom berikut!', 2, '2024-07-27 13:40:12', NULL),
(50, 15, 5, 'Sebelum merancang dan membuat proyek buatlah hipotesis penyelidikanmu pada kolom di bawah ini, berdasarkan informasi yang telah kamu peroleh sebelumnya. Tujuannya agar penyelidikan yang kamu lakukan menjadi terarah, memeriksa fakta dan hubungan variabel serta membimbing penelitianmu dalam pengujian dan penyesuaian fakta.', 2, '2024-07-27 13:40:26', NULL),
(51, 16, 1, 'Keterangan / Penjelasan bagian-bagian produk:', 2, '2024-07-27 13:41:44', NULL),
(52, 16, 2, 'Inovasi', 2, '2024-07-27 13:42:07', NULL),
(53, 16, 3, 'Biaya yang dibutuhkan', 2, '2024-07-27 13:42:26', NULL),
(54, 17, 1, 'Nama alat', 1, '2024-07-27 13:43:22', '2024-07-27 13:43:41'),
(55, 17, 2, 'Tujuan', 2, '2024-07-27 13:44:10', NULL),
(56, 17, 3, 'Alat dan Bahan', 2, '2024-07-27 13:44:24', NULL),
(57, 17, 4, 'Buatlah langkah-langkah pembuatan proyek', 2, '2024-07-27 13:44:46', NULL),
(58, 18, 1, '[Uji Coba 1] Bagaimana cara menguji efektivitas prototipe/produk yang kamu buat?', 2, '2024-07-27 13:45:49', NULL),
(59, 18, 2, '[Uji Coba 1] Lakukan uji coba efektivitas produk sesuai dengan cara pengujian yang telah kamu susun! Sajikan hasil uji coba 1 yang telah kamu peroleh!', 2, '2024-07-27 13:46:10', NULL),
(60, 18, 3, '[Uji Coba 1] Evaluasi hasil dari uji coba 1 yang telah dilakukan! Adakah hal-hal yang perlu ditingkatkan dari desain produk yang diujicobakan tersebut? Jelaskan!', 2, '2024-07-27 13:46:29', NULL),
(61, 18, 4, '[Redisain] Berdasarkan hasil uji coba 1, Jelaskanlah perubahan apa yang akan kamu lakukan dari rancangan awal produkmu?', 2, '2024-07-27 13:46:46', NULL),
(62, 18, 5, '[Redisain] Bagaimana bentuk rancangan akhir produkmu? & Buatlah rancangan akhir tersebut!', 2, '2024-07-27 13:47:06', NULL),
(63, 18, 6, '[Uji Coba 2] Lakukan uji coba 2 dengan langkah yang sama dengan uji coba 1 untuk melihat efektivitas produk akhir yang kamu buat!', 2, '2024-07-27 13:47:28', NULL),
(64, 18, 7, '[Uji Coba 2] Berdasarkan hasil uji coba 2, apakah kesimpulanmu?', 2, '2024-07-27 13:47:53', NULL),
(65, 19, 1, 'Gambar Disain Produk', 4, '2024-07-27 13:49:25', NULL),
(66, 19, 2, 'Keterangan / Penjelasan bagian-bagian produk:', 2, '2024-07-27 13:49:38', NULL),
(67, 19, 3, 'Inovasi', 2, '2024-07-27 13:49:52', NULL),
(68, 19, 4, 'Biaya yang dibutuhkan', 2, '2024-07-27 13:50:06', NULL),
(69, 19, 5, 'Silahkan persiapkan bahan presentasi terkait inovasi/ kebaruan yang diperbaiki atau ditambahkan dari prototype yang telah di buat. Silahkan upload file PPT yang digunakan untuk presentasi.', 3, '2024-07-27 13:50:28', NULL),
(70, 20, 1, 'Silahkan beri tanggapan terhadap terhadap prototype yang telah dibuat', 2, '2024-07-27 13:52:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_type_form`
--

CREATE TABLE `tb_type_form` (
  `id_type_form` int(11) NOT NULL,
  `type_form` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_type_form`
--

INSERT INTO `tb_type_form` (`id_type_form`, `type_form`, `created_at`, `updated_at`) VALUES
(1, 'input text (isian singkat)', '2024-07-03 12:47:44', NULL),
(2, 'textarea (isian panjang)', '2024-07-03 12:47:46', NULL),
(3, 'file', '2024-07-03 12:47:49', NULL),
(4, 'canva (menggambar)', '2024-07-03 12:48:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `id_role_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `sekolah` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `id_role_user`, `nama_lengkap`, `sekolah`, `email`, `tanggal_lahir`, `jenis_kelamin`, `foto_profil`, `username`, `password`, `created_at`, `updated_at`) VALUES
(2, 2, 'Dwi Fitria Al Husaeni', 'Universitas Pendidikan Indonesia', 'dwi99@gmail.com', '2000-12-14', 'P', 'e13033a66a4f54093beb305c25cfe684.jpg', 'guru', '77e69c137812518e359196bb2f5e9bb9', '2024-06-22 13:00:08', '2024-07-03 07:17:09'),
(3, 1, 'Sarah Wijayanto', 'UPI', 'wijayanto_sarah23@upi.edu', '1998-02-11', 'P', '6dd69b7f05a483b00ff15e13c8ef669f.jpg', 'sarah', '9e9d7a08e048e9d604b79460b54969c3', '2024-06-27 08:33:21', NULL),
(4, 1, 'Wijayanto', 'Universitas Pendidikan Indonesia', 'wijj12@upi.edu', '1997-11-12', 'L', 'gedung_pasca.png', 'wij', '5adafa127fd9a2d7894c88f39352d02d', '2024-06-27 08:43:56', '2024-06-27 09:36:29'),
(7, 1, 'Dwi Fitria Al Husaeni', 'Universitas Pendidikan Indonesia', 'dwidd@gmail.com', '2000-12-12', 'P', 'a2340a66e8fa6f91723b7b7d22090124.jpg', 'dwi', '7aa2602c588c05a93baf10128861aeb9', '2024-06-27 09:09:26', '2024-07-03 07:03:00'),
(8, 2, 'Yadi Subekti', 'UPI', 'yadiS76@gmail.com', '1986-11-12', 'L', '0eb99d44a4c951084be8c740845acded.jpg', 'yadi', 'e60838b9f0c0ed98a486f231a4df9c4a', '2024-06-27 11:50:48', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_alur_pembelajaran`
-- (See below for the actual view)
--
CREATE TABLE `v_alur_pembelajaran` (
`judul_pertemuan` varchar(100)
,`no_pertemuan` int(11)
,`deskripsi_pertemuan` text
,`status_pertemuan` char(1)
,`id_alur_pembelajaran` int(11)
,`id_mata_kuliah` int(11)
,`id_pertemuan` int(11)
,`indikator_pembelajaran` text
,`bahan_kajian` text
,`aktivitas_perkuliahan` text
,`pengalaman_belajar` text
,`kebutuhan_pembelajaran` text
,`alokasi_waktu` varchar(255)
,`deskripsi_tugas` text
,`created_at` datetime
,`updated_at` datetime
,`kode_mata_kuliah` varchar(20)
,`nama_mata_kuliah` varchar(255)
,`program_studi` varchar(255)
,`bobot_sks` int(11)
,`cpl` text
,`cpmk` text
,`deskripsi_mata_kuliah` text
,`jenjang` varchar(10)
,`link_rps` text
,`semester` int(11)
,`status_mata_kuliah` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_diskusi`
-- (See below for the actual view)
--
CREATE TABLE `v_diskusi` (
`id_diskusi` int(11)
,`id_user` int(11)
,`id_pertemuan` int(11)
,`komentar` text
,`created_at` datetime
,`updated_at` datetime
,`judul_pertemuan` varchar(100)
,`no_pertemuan` int(11)
,`deskripsi_pertemuan` text
,`status` char(1)
,`email` varchar(150)
,`foto_profil` varchar(255)
,`id_role_user` int(11)
,`jenis_kelamin` char(1)
,`nama_lengkap` varchar(255)
,`password` varchar(255)
,`sekolah` varchar(255)
,`tanggal_lahir` varchar(255)
,`role_user` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jawaban_essai`
-- (See below for the actual view)
--
CREATE TABLE `v_jawaban_essai` (
`id_jawaban_essai` int(11)
,`id_soal` int(11)
,`id_user` int(11)
,`jawaban_text` text
,`jawaban_file` text
,`jawaban_gambar` text
,`nilai` int(11)
,`feedback` text
,`created_at` datetime
,`updated_at` datetime
,`deksripsi_soal` text
,`id_permasalahan` int(11)
,`no_soal` int(11)
,`id_soal_essai` int(11)
,`tipe_jawaban` int(11)
,`email` varchar(150)
,`foto_profil` varchar(255)
,`id_role_user` int(11)
,`jenis_kelamin` char(1)
,`nama_lengkap` varchar(255)
,`password` varchar(255)
,`sekolah` varchar(255)
,`tanggal_lahir` varchar(255)
,`username` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_permasalahan`
-- (See below for the actual view)
--
CREATE TABLE `v_permasalahan` (
`id_permasalahan` int(11)
,`id_pertemuan` int(11)
,`tahapan_pembelajaran` varchar(50)
,`judul_permasalahan` varchar(500)
,`deskripsi_permasalahan` text
,`foto` text
,`jumlah_soal` int(11)
,`link_permasalahan` text
,`created_at` datetime
,`updated_at` datetime
,`judul_pertemuan` varchar(100)
,`no_pertemuan` int(11)
,`status` char(1)
,`deskripsi_pertemuan` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_score`
-- (See below for the actual view)
--
CREATE TABLE `v_score` (
`id_score` int(11)
,`id_user` int(11)
,`score_pretest` int(11)
,`score_posttest` int(11)
,`score_pertemuan` int(11)
,`created_at` date
,`updated_at` date
,`email` varchar(150)
,`foto_profil` varchar(255)
,`id_role_user` int(11)
,`jenis_kelamin` char(1)
,`nama_lengkap` varchar(255)
,`password` varchar(255)
,`sekolah` varchar(255)
,`tanggal_lahir` varchar(255)
,`username` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_soal_essai`
-- (See below for the actual view)
--
CREATE TABLE `v_soal_essai` (
`id_soal_essai` int(11)
,`id_permasalahan` int(11)
,`no_soal` int(11)
,`deksripsi_soal` text
,`tipe_jawaban` int(11)
,`created_at` datetime
,`updated_at` datetime
,`type_form` varchar(100)
,`deskripsi_permasalahan` text
,`foto` text
,`id_pertemuan` int(11)
,`judul_permasalahan` varchar(500)
,`jumlah_soal` int(11)
,`link_permasalahan` text
,`tahapan_pembelajaran` varchar(50)
,`deskripsi_pertemuan` text
,`judul_pertemuan` varchar(100)
,`no_pertemuan` int(11)
,`status` char(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_user`
-- (See below for the actual view)
--
CREATE TABLE `v_user` (
`id_user` int(11)
,`id_role_user` int(11)
,`role_user` varchar(10)
,`nama_lengkap` varchar(255)
,`sekolah` varchar(255)
,`email` varchar(150)
,`jenis_kelamin` char(1)
,`tanggal_lahir` varchar(255)
,`foto_profil` varchar(255)
,`username` varchar(50)
,`password` varchar(255)
,`created_at` datetime
,`updated_at` datetime
);

-- --------------------------------------------------------

--
-- Structure for view `v_alur_pembelajaran`
--
DROP TABLE IF EXISTS `v_alur_pembelajaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_alur_pembelajaran`  AS SELECT `tb_pertemuan`.`judul_pertemuan` AS `judul_pertemuan`, `tb_pertemuan`.`no_pertemuan` AS `no_pertemuan`, `tb_pertemuan`.`deskripsi_pertemuan` AS `deskripsi_pertemuan`, `tb_pertemuan`.`status` AS `status_pertemuan`, `tb_alur_pembelajaran`.`id_alur_pembelajaran` AS `id_alur_pembelajaran`, `tb_alur_pembelajaran`.`id_mata_kuliah` AS `id_mata_kuliah`, `tb_alur_pembelajaran`.`id_pertemuan` AS `id_pertemuan`, `tb_alur_pembelajaran`.`indikator_pembelajaran` AS `indikator_pembelajaran`, `tb_alur_pembelajaran`.`bahan_kajian` AS `bahan_kajian`, `tb_alur_pembelajaran`.`aktivitas_perkuliahan` AS `aktivitas_perkuliahan`, `tb_alur_pembelajaran`.`pengalaman_belajar` AS `pengalaman_belajar`, `tb_alur_pembelajaran`.`kebutuhan_pembelajaran` AS `kebutuhan_pembelajaran`, `tb_alur_pembelajaran`.`alokasi_waktu` AS `alokasi_waktu`, `tb_alur_pembelajaran`.`deskripsi_tugas` AS `deskripsi_tugas`, `tb_alur_pembelajaran`.`created_at` AS `created_at`, `tb_alur_pembelajaran`.`updated_at` AS `updated_at`, `tb_mata_kuliah`.`kode_mata_kuliah` AS `kode_mata_kuliah`, `tb_mata_kuliah`.`nama_mata_kuliah` AS `nama_mata_kuliah`, `tb_mata_kuliah`.`program_studi` AS `program_studi`, `tb_mata_kuliah`.`bobot_sks` AS `bobot_sks`, `tb_mata_kuliah`.`cpl` AS `cpl`, `tb_mata_kuliah`.`cpmk` AS `cpmk`, `tb_mata_kuliah`.`deskripsi_mata_kuliah` AS `deskripsi_mata_kuliah`, `tb_mata_kuliah`.`jenjang` AS `jenjang`, `tb_mata_kuliah`.`link_rps` AS `link_rps`, `tb_mata_kuliah`.`semester` AS `semester`, `tb_mata_kuliah`.`status` AS `status_mata_kuliah` FROM ((`tb_pertemuan` join `tb_alur_pembelajaran` on(`tb_pertemuan`.`id_pertemuan` = `tb_alur_pembelajaran`.`id_pertemuan`)) join `tb_mata_kuliah` on(`tb_alur_pembelajaran`.`id_mata_kuliah` = `tb_mata_kuliah`.`id_mata_kuliah`))  ;

-- --------------------------------------------------------

--
-- Structure for view `v_diskusi`
--
DROP TABLE IF EXISTS `v_diskusi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_diskusi`  AS SELECT `tb_diskusi`.`id_diskusi` AS `id_diskusi`, `tb_diskusi`.`id_user` AS `id_user`, `tb_diskusi`.`id_pertemuan` AS `id_pertemuan`, `tb_diskusi`.`komentar` AS `komentar`, `tb_diskusi`.`created_at` AS `created_at`, `tb_diskusi`.`updated_at` AS `updated_at`, `tb_pertemuan`.`judul_pertemuan` AS `judul_pertemuan`, `tb_pertemuan`.`no_pertemuan` AS `no_pertemuan`, `tb_pertemuan`.`deskripsi_pertemuan` AS `deskripsi_pertemuan`, `tb_pertemuan`.`status` AS `status`, `tb_user`.`email` AS `email`, `tb_user`.`foto_profil` AS `foto_profil`, `tb_user`.`id_role_user` AS `id_role_user`, `tb_user`.`jenis_kelamin` AS `jenis_kelamin`, `tb_user`.`nama_lengkap` AS `nama_lengkap`, `tb_user`.`password` AS `password`, `tb_user`.`sekolah` AS `sekolah`, `tb_user`.`tanggal_lahir` AS `tanggal_lahir`, `tb_role_user`.`role_user` AS `role_user` FROM (((`tb_diskusi` join `tb_pertemuan` on(`tb_diskusi`.`id_pertemuan` = `tb_pertemuan`.`id_pertemuan`)) join `tb_user` on(`tb_diskusi`.`id_user` = `tb_user`.`id_user`)) join `tb_role_user` on(`tb_role_user`.`id_role_user` = `tb_user`.`id_role_user`))  ;

-- --------------------------------------------------------

--
-- Structure for view `v_jawaban_essai`
--
DROP TABLE IF EXISTS `v_jawaban_essai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jawaban_essai`  AS SELECT `tb_jawaban_essai`.`id_jawaban_essai` AS `id_jawaban_essai`, `tb_jawaban_essai`.`id_soal` AS `id_soal`, `tb_jawaban_essai`.`id_user` AS `id_user`, `tb_jawaban_essai`.`jawaban_text` AS `jawaban_text`, `tb_jawaban_essai`.`jawaban_file` AS `jawaban_file`, `tb_jawaban_essai`.`jawaban_gambar` AS `jawaban_gambar`, `tb_jawaban_essai`.`nilai` AS `nilai`, `tb_jawaban_essai`.`feedback` AS `feedback`, `tb_jawaban_essai`.`created_at` AS `created_at`, `tb_jawaban_essai`.`updated_at` AS `updated_at`, `tb_soal_essai`.`deksripsi_soal` AS `deksripsi_soal`, `tb_soal_essai`.`id_permasalahan` AS `id_permasalahan`, `tb_soal_essai`.`no_soal` AS `no_soal`, `tb_soal_essai`.`id_soal_essai` AS `id_soal_essai`, `tb_soal_essai`.`tipe_jawaban` AS `tipe_jawaban`, `tb_user`.`email` AS `email`, `tb_user`.`foto_profil` AS `foto_profil`, `tb_user`.`id_role_user` AS `id_role_user`, `tb_user`.`jenis_kelamin` AS `jenis_kelamin`, `tb_user`.`nama_lengkap` AS `nama_lengkap`, `tb_user`.`password` AS `password`, `tb_user`.`sekolah` AS `sekolah`, `tb_user`.`tanggal_lahir` AS `tanggal_lahir`, `tb_user`.`username` AS `username` FROM ((`tb_jawaban_essai` join `tb_soal_essai` on(`tb_jawaban_essai`.`id_soal` = `tb_soal_essai`.`id_soal_essai`)) join `tb_user` on(`tb_jawaban_essai`.`id_user` = `tb_user`.`id_user`))  ;

-- --------------------------------------------------------

--
-- Structure for view `v_permasalahan`
--
DROP TABLE IF EXISTS `v_permasalahan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_permasalahan`  AS SELECT `tb_permasalahan`.`id_permasalahan` AS `id_permasalahan`, `tb_permasalahan`.`id_pertemuan` AS `id_pertemuan`, `tb_permasalahan`.`tahapan_pembelajaran` AS `tahapan_pembelajaran`, `tb_permasalahan`.`judul_permasalahan` AS `judul_permasalahan`, `tb_permasalahan`.`deskripsi_permasalahan` AS `deskripsi_permasalahan`, `tb_permasalahan`.`foto` AS `foto`, `tb_permasalahan`.`jumlah_soal` AS `jumlah_soal`, `tb_permasalahan`.`link_permasalahan` AS `link_permasalahan`, `tb_permasalahan`.`created_at` AS `created_at`, `tb_permasalahan`.`updated_at` AS `updated_at`, `tb_pertemuan`.`judul_pertemuan` AS `judul_pertemuan`, `tb_pertemuan`.`no_pertemuan` AS `no_pertemuan`, `tb_pertemuan`.`status` AS `status`, `tb_pertemuan`.`deskripsi_pertemuan` AS `deskripsi_pertemuan` FROM (`tb_permasalahan` join `tb_pertemuan` on(`tb_permasalahan`.`id_pertemuan` = `tb_pertemuan`.`id_pertemuan`))  ;

-- --------------------------------------------------------

--
-- Structure for view `v_score`
--
DROP TABLE IF EXISTS `v_score`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_score`  AS SELECT `tb_score`.`id_score` AS `id_score`, `tb_score`.`id_user` AS `id_user`, `tb_score`.`score_pretest` AS `score_pretest`, `tb_score`.`score_posttest` AS `score_posttest`, `tb_score`.`score_pertemuan` AS `score_pertemuan`, `tb_score`.`created_at` AS `created_at`, `tb_score`.`updated_at` AS `updated_at`, `tb_user`.`email` AS `email`, `tb_user`.`foto_profil` AS `foto_profil`, `tb_user`.`id_role_user` AS `id_role_user`, `tb_user`.`jenis_kelamin` AS `jenis_kelamin`, `tb_user`.`nama_lengkap` AS `nama_lengkap`, `tb_user`.`password` AS `password`, `tb_user`.`sekolah` AS `sekolah`, `tb_user`.`tanggal_lahir` AS `tanggal_lahir`, `tb_user`.`username` AS `username` FROM (`tb_score` join `tb_user` on(`tb_score`.`id_user` = `tb_user`.`id_user`))  ;

-- --------------------------------------------------------

--
-- Structure for view `v_soal_essai`
--
DROP TABLE IF EXISTS `v_soal_essai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_soal_essai`  AS SELECT `tb_soal_essai`.`id_soal_essai` AS `id_soal_essai`, `tb_soal_essai`.`id_permasalahan` AS `id_permasalahan`, `tb_soal_essai`.`no_soal` AS `no_soal`, `tb_soal_essai`.`deksripsi_soal` AS `deksripsi_soal`, `tb_soal_essai`.`tipe_jawaban` AS `tipe_jawaban`, `tb_soal_essai`.`created_at` AS `created_at`, `tb_soal_essai`.`updated_at` AS `updated_at`, `tb_type_form`.`type_form` AS `type_form`, `tb_permasalahan`.`deskripsi_permasalahan` AS `deskripsi_permasalahan`, `tb_permasalahan`.`foto` AS `foto`, `tb_permasalahan`.`id_pertemuan` AS `id_pertemuan`, `tb_permasalahan`.`judul_permasalahan` AS `judul_permasalahan`, `tb_permasalahan`.`jumlah_soal` AS `jumlah_soal`, `tb_permasalahan`.`link_permasalahan` AS `link_permasalahan`, `tb_permasalahan`.`tahapan_pembelajaran` AS `tahapan_pembelajaran`, `tb_pertemuan`.`deskripsi_pertemuan` AS `deskripsi_pertemuan`, `tb_pertemuan`.`judul_pertemuan` AS `judul_pertemuan`, `tb_pertemuan`.`no_pertemuan` AS `no_pertemuan`, `tb_pertemuan`.`status` AS `status` FROM (((`tb_soal_essai` join `tb_type_form` on(`tb_soal_essai`.`tipe_jawaban` = `tb_type_form`.`id_type_form`)) join `tb_permasalahan` on(`tb_soal_essai`.`id_permasalahan` = `tb_permasalahan`.`id_permasalahan`)) join `tb_pertemuan` on(`tb_permasalahan`.`id_pertemuan` = `tb_pertemuan`.`id_pertemuan`))  ;

-- --------------------------------------------------------

--
-- Structure for view `v_user`
--
DROP TABLE IF EXISTS `v_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_user`  AS SELECT `tb_user`.`id_user` AS `id_user`, `tb_user`.`id_role_user` AS `id_role_user`, `tb_role_user`.`role_user` AS `role_user`, `tb_user`.`nama_lengkap` AS `nama_lengkap`, `tb_user`.`sekolah` AS `sekolah`, `tb_user`.`email` AS `email`, `tb_user`.`jenis_kelamin` AS `jenis_kelamin`, `tb_user`.`tanggal_lahir` AS `tanggal_lahir`, `tb_user`.`foto_profil` AS `foto_profil`, `tb_user`.`username` AS `username`, `tb_user`.`password` AS `password`, `tb_user`.`created_at` AS `created_at`, `tb_user`.`updated_at` AS `updated_at` FROM (`tb_user` join `tb_role_user` on(`tb_user`.`id_role_user` = `tb_role_user`.`id_role_user`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alur_pembelajaran`
--
ALTER TABLE `tb_alur_pembelajaran`
  ADD PRIMARY KEY (`id_alur_pembelajaran`),
  ADD KEY `FK_tb_alur_pembelajaran` (`id_pertemuan`),
  ADD KEY `FK_tb_alur_pembelajaran2` (`id_mata_kuliah`);

--
-- Indexes for table `tb_diskusi`
--
ALTER TABLE `tb_diskusi`
  ADD PRIMARY KEY (`id_diskusi`),
  ADD KEY `FK_tb_diskusi` (`id_user`),
  ADD KEY `FK_tb_diskusi2` (`id_pertemuan`);

--
-- Indexes for table `tb_jawaban_essai`
--
ALTER TABLE `tb_jawaban_essai`
  ADD PRIMARY KEY (`id_jawaban_essai`),
  ADD KEY `FK_tb_jawaban_essai` (`id_soal`),
  ADD KEY `FK_tb_jawaban_essai2` (`id_user`);

--
-- Indexes for table `tb_landing_page`
--
ALTER TABLE `tb_landing_page`
  ADD PRIMARY KEY (`id_landing_page`);

--
-- Indexes for table `tb_mata_kuliah`
--
ALTER TABLE `tb_mata_kuliah`
  ADD PRIMARY KEY (`id_mata_kuliah`);

--
-- Indexes for table `tb_permasalahan`
--
ALTER TABLE `tb_permasalahan`
  ADD PRIMARY KEY (`id_permasalahan`),
  ADD KEY `FK_tb_permasalahan` (`id_pertemuan`);

--
-- Indexes for table `tb_pertemuan`
--
ALTER TABLE `tb_pertemuan`
  ADD PRIMARY KEY (`id_pertemuan`);

--
-- Indexes for table `tb_role_user`
--
ALTER TABLE `tb_role_user`
  ADD PRIMARY KEY (`id_role_user`);

--
-- Indexes for table `tb_score`
--
ALTER TABLE `tb_score`
  ADD PRIMARY KEY (`id_score`),
  ADD KEY `FK_tb_score` (`id_user`);

--
-- Indexes for table `tb_soal_essai`
--
ALTER TABLE `tb_soal_essai`
  ADD PRIMARY KEY (`id_soal_essai`),
  ADD KEY `FK_tb_soal_essai` (`id_permasalahan`),
  ADD KEY `FK_tb_soal_essai2` (`tipe_jawaban`);

--
-- Indexes for table `tb_type_form`
--
ALTER TABLE `tb_type_form`
  ADD PRIMARY KEY (`id_type_form`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `FK_tb_user` (`id_role_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alur_pembelajaran`
--
ALTER TABLE `tb_alur_pembelajaran`
  MODIFY `id_alur_pembelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_diskusi`
--
ALTER TABLE `tb_diskusi`
  MODIFY `id_diskusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_jawaban_essai`
--
ALTER TABLE `tb_jawaban_essai`
  MODIFY `id_jawaban_essai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_landing_page`
--
ALTER TABLE `tb_landing_page`
  MODIFY `id_landing_page` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_mata_kuliah`
--
ALTER TABLE `tb_mata_kuliah`
  MODIFY `id_mata_kuliah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_permasalahan`
--
ALTER TABLE `tb_permasalahan`
  MODIFY `id_permasalahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_pertemuan`
--
ALTER TABLE `tb_pertemuan`
  MODIFY `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_role_user`
--
ALTER TABLE `tb_role_user`
  MODIFY `id_role_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_score`
--
ALTER TABLE `tb_score`
  MODIFY `id_score` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_soal_essai`
--
ALTER TABLE `tb_soal_essai`
  MODIFY `id_soal_essai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tb_type_form`
--
ALTER TABLE `tb_type_form`
  MODIFY `id_type_form` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_alur_pembelajaran`
--
ALTER TABLE `tb_alur_pembelajaran`
  ADD CONSTRAINT `FK_tb_alur_pembelajaran` FOREIGN KEY (`id_pertemuan`) REFERENCES `tb_pertemuan` (`id_pertemuan`),
  ADD CONSTRAINT `FK_tb_alur_pembelajaran2` FOREIGN KEY (`id_mata_kuliah`) REFERENCES `tb_mata_kuliah` (`id_mata_kuliah`);

--
-- Constraints for table `tb_diskusi`
--
ALTER TABLE `tb_diskusi`
  ADD CONSTRAINT `FK_tb_diskusi` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `FK_tb_diskusi2` FOREIGN KEY (`id_pertemuan`) REFERENCES `tb_pertemuan` (`id_pertemuan`);

--
-- Constraints for table `tb_jawaban_essai`
--
ALTER TABLE `tb_jawaban_essai`
  ADD CONSTRAINT `FK_tb_jawaban_essai` FOREIGN KEY (`id_soal`) REFERENCES `tb_soal_essai` (`id_soal_essai`),
  ADD CONSTRAINT `FK_tb_jawaban_essai2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_permasalahan`
--
ALTER TABLE `tb_permasalahan`
  ADD CONSTRAINT `FK_tb_permasalahan` FOREIGN KEY (`id_pertemuan`) REFERENCES `tb_pertemuan` (`id_pertemuan`);

--
-- Constraints for table `tb_score`
--
ALTER TABLE `tb_score`
  ADD CONSTRAINT `FK_tb_score` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_soal_essai`
--
ALTER TABLE `tb_soal_essai`
  ADD CONSTRAINT `FK_tb_soal_essai` FOREIGN KEY (`id_permasalahan`) REFERENCES `tb_permasalahan` (`id_permasalahan`),
  ADD CONSTRAINT `FK_tb_soal_essai2` FOREIGN KEY (`tipe_jawaban`) REFERENCES `tb_type_form` (`id_type_form`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `FK_tb_user` FOREIGN KEY (`id_role_user`) REFERENCES `tb_role_user` (`id_role_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
