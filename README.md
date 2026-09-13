# Pendidikan IPA Terpadu — Web LMS

Aplikasi Learning Management System (LMS) berbasis web untuk mata kuliah
Pendidikan IPA Terpadu, dibangun di atas **CodeIgniter 3** (PHP).

Aplikasi memiliki dua portal terpisah:

- **Guru** (`application/controllers/guru/`) — mengelola mata kuliah, pertemuan,
  tema proyek, soal essai, penilaian tes, jawaban mahasiswa, diskusi, dan
  pengguna.
- **Siswa/Mahasiswa** (`application/controllers/siswa/`) — mengikuti
  pertemuan, mengerjakan worksheet, berdiskusi, dan melihat nilai.

Login mendukung autentikasi biasa dan **Google OAuth**.

Dokumen serah terima proyek dan dokumentasi teknis sistem (fitur, sitemap,
alur penggunaan, skema basis data) tersedia dalam format Word di folder
`docs/`:

- [docs/Surat_Serah_Terima_Proyek.docx](docs/Surat_Serah_Terima_Proyek.docx)
- [docs/Dokumentasi_Teknis_As_Built.docx](docs/Dokumentasi_Teknis_As_Built.docx)

## Fitur Utama

### Portal Guru
- **Mata Kuliah & Alur Perkuliahan** — kelola struktur mata kuliah dan urutan
  pertemuan ([MataKuliah.php](application/controllers/guru/MataKuliah.php),
  [AlurPerkuliahan.php](application/controllers/guru/AlurPerkuliahan.php))
- **Pertemuan** — CRUD sesi perkuliahan
  ([Pertemuan.php](application/controllers/guru/Pertemuan.php))
- **Tema Proyek** — kelola tema proyek beserta status aktif/tidak aktif
  ([TemaProyek.php](application/controllers/guru/TemaProyek.php))
- **Soal Essai** — buat dan kelola soal essai/worksheet
  ([SoalEssai.php](application/controllers/guru/SoalEssai.php))
- **Jawaban Siswa & Jawaban Mahasiswa** — koreksi jawaban worksheet, filter per
  kelompok/soal, edit file jawaban
  ([JawabanSiswa.php](application/controllers/guru/JawabanSiswa.php),
  [JawabanMahasiswa.php](application/controllers/guru/JawabanMahasiswa.php))
- **Penilaian Tes** — penilaian pretest/posttest per kelompok dan per jenis tes,
  bulk edit
  ([PenilaianTesKelompok.php](application/controllers/guru/PenilaianTesKelompok.php),
  [PenilaianTesJenis.php](application/controllers/guru/PenilaianTesJenis.php))
- **Nilai** — rekap nilai mahasiswa
  ([Nilai.php](application/controllers/guru/Nilai.php))
- **Diskusi & Permasalahan** — forum diskusi per pertemuan
  ([Diskusi.php](application/controllers/guru/Diskusi.php),
  [Permasalahan.php](application/controllers/guru/Permasalahan.php))
- **Sumber Belajar & Panduan** — materi pendukung
- **Pengguna & Role User** — manajemen akun dan hak akses
  ([Pengguna.php](application/controllers/guru/Pengguna.php),
  [RoleUser.php](application/controllers/guru/RoleUser.php))

### Portal Siswa
- Pengenalan mata kuliah, mengikuti pertemuan, mengerjakan dan mengoreksi
  worksheet, berdiskusi, melihat nilai, mengubah profil/kata sandi.

## Menjalankan Secara Lokal

Lihat langkah lengkap di memori proyek (XAMPP + PHP built-in server, port
`8080`, database `ipar7647_db_ipa_terpadu`). Ringkas:

```bash
/Applications/XAMPP/bin/php -S localhost:8080 -t .
```

Akses di `http://localhost:8080/`, login di `http://localhost:8080/login`.

## Deployment

Aplikasi di-deploy otomatis ke hosting cPanel melalui GitHub Actions setiap
kali ada push ke branch `main` — lihat
[.github/workflows](.github/workflows/) (FTP deploy, mengecualikan folder
`assets*`, `application/cache`, `application/logs`).

## Struktur Direktori Penting

- `application/` — kode aplikasi CodeIgniter (controllers, models, views)
- `assets/`, `assets_guru/`, `assets_siswa/` — aset statis per portal (tidak
  ikut ter-deploy ulang otomatis, dikelola manual di server)
- `database/13_09_2026_ipar7647_db_ipa_terpadu_PRODUCTION.sql` — dump database
  produksi terbaru (di-export langsung dari server, 13 September 2026).
- `database/legacy/` — arsip dump-dump lama dari masa pengembangan (bukan
  referensi untuk kondisi produksi saat ini).
