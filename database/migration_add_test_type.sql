-- Migration: tandai setiap baris tb_test_unity sebagai pretest atau posttest.
--
-- Cara pakai: jalankan file ini SEKALI lewat phpMyAdmin/cPanel/mysql client
-- terhadap database production. Auto-deploy proyek ini hanya menyalin file
-- lewat FTP dan TIDAK menjalankan migrasi database secara otomatis, jadi file
-- ini harus dijalankan manual terhadap database production.
--
-- Latar belakang: tb_test_unity tidak punya kolom apa pun yang menandai
-- jenis tes (pretest/posttest) atau timestamp submit. Ditemukan bahwa untuk
-- setiap practice+nomor soal yang sama, data historis konsisten memakai DUA
-- studi kasus berbeda di teks indikator_soal: "irigasi" dan "pendeteksi
-- boraks" -- ini dikonfirmasi user sebagai pretest (irigasi) dan posttest
-- (boraks). Baris yang teksnya tidak menyebut studi kasus (generik) di-set
-- NULL ("belum ditandai") dan perlu ditandai manual lewat form edit di admin.
--
-- Backfill ini HANYA jalan sekali di sini berdasarkan kata kunci; setelah
-- migrasi ini, kolom test_type harus diisi langsung oleh integrasi Unity
-- pihak luar saat submit data baru (atau ditandai manual lewat admin).

ALTER TABLE `tb_test_unity`
  ADD COLUMN `test_type` ENUM('pretest', 'posttest') NULL DEFAULT NULL AFTER `pertanyaan`;

UPDATE `tb_test_unity`
SET `test_type` = CASE
    WHEN LOWER(`indikator_soal`) LIKE '%irigasi%' THEN 'pretest'
    WHEN LOWER(`indikator_soal`) LIKE '%borak%' THEN 'posttest'
    ELSE NULL
END;

-- v_test_unity (dipakai halaman Penilaian Tes) join tb_user + tb_test_unity,
-- perlu di-recreate supaya ikut mengekspos kolom test_type yang baru.
-- CREATE OR REPLACE VIEW aman -- tidak mengubah data, hanya definisi view.
CREATE OR REPLACE VIEW `v_test_unity` AS
SELECT
  `tb_user`.`id_user` AS `id_user`,
  `tb_user`.`id_role_user` AS `id_role_user`,
  `tb_user`.`nama_lengkap` AS `nama_lengkap`,
  `tb_user`.`no_kelompok` AS `no_kelompok`,
  `tb_user`.`angkatan` AS `angkatan`,
  `tb_user`.`sekolah` AS `sekolah`,
  `tb_user`.`email` AS `email`,
  `tb_user`.`tanggal_lahir` AS `tanggal_lahir`,
  `tb_user`.`jenis_kelamin` AS `jenis_kelamin`,
  `tb_user`.`foto_profil` AS `foto_profil`,
  `tb_user`.`username` AS `username`,
  `tb_user`.`password` AS `password`,
  `tb_user`.`created_at` AS `created_at`,
  `tb_user`.`updated_at` AS `updated_at`,
  `tb_test_unity`.`id_test_unity` AS `id_test_unity`,
  `tb_test_unity`.`indikator_soal` AS `indikator_soal`,
  `tb_test_unity`.`pertanyaan` AS `pertanyaan`,
  `tb_test_unity`.`test_type` AS `test_type`,
  `tb_test_unity`.`practice` AS `practice`,
  `tb_test_unity`.`jawaban` AS `jawaban`,
  `tb_test_unity`.`nilai` AS `nilai`,
  `tb_test_unity`.`feedback` AS `feedback`
FROM (`tb_user` JOIN `tb_test_unity` ON (`tb_user`.`id_user` = `tb_test_unity`.`id_user`));
