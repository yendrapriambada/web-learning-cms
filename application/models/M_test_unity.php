<?php
	class M_test_unity extends CI_Model{

		public function getRecordsTable(){
			$query = $this->db->get('tb_test_unity');
			return $query->result();
		}

        public function getRecordsView(){
			$query = $this->db->get('v_test_unity');
			return $query->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_test_unity',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{
			$hapus = $this->db->delete('tb_test_unity',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_test_unity",$id);
			$this->db->update("tb_test_unity",$data);
		}

		public function tampil_view_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_test_unity",$id);
			$data = $this->db->get("v_test_unity")->row();
			return $data;
		}

		public function getKelompokList() {
			$this->db->select('u.no_kelompok');
			$this->db->distinct();
			$this->db->from('tb_test_unity tu');
			$this->db->join('tb_user u', 'tu.id_user = u.id_user');
			$this->db->where('u.no_kelompok IS NOT NULL');
			$this->db->order_by('u.no_kelompok', 'ASC');
			return $this->db->get()->result();
		}

		public function getMembersByKelompok($no_kelompok) {
			$this->db->select('id_user, nama_lengkap');
			$this->db->where('no_kelompok', $no_kelompok);
			$this->db->where('id_role_user', 1);
			$this->db->order_by('nama_lengkap', 'ASC');
			return $this->db->get('tb_user')->result();
		}

		public function getDistinctAngkatan() {
			$this->db->select('angkatan');
			$this->db->distinct();
			$this->db->where('id_role_user', 1);
			$this->db->where('angkatan IS NOT NULL');
			$this->db->order_by('angkatan', 'DESC');
			return $this->db->get('tb_user')->result();
		}

		/**
		 * Nilai unik sebuah kolom di v_test_unity, untuk mengisi dropdown filter
		 * (Nama Mahasiswa, No. Kelompok, Angkatan, Jenis Kelamin) di tabel Penilaian Tes.
		 */
		public function getDistinctValues($column) {
			$this->db->select($column);
			$this->db->distinct();
			$this->db->where("$column IS NOT NULL");
			$this->db->where("$column !=", '');
			$this->db->order_by($column, 'ASC');
			return $this->db->get('v_test_unity')->result();
		}

		/**
		 * Data dari integrasi Unity pihak luar ternyata tidak konsisten: ada
		 * varian typo ("acheiving" vs "achieving") dan sebagian baris punya
		 * kolom `practice` yang memuat gabungan 3 kolom dipisah tab (bug pada
		 * pengiriman data). Tanpa normalisasi ini, satu kategori practice yang
		 * sama terpecah jadi beberapa grup terpisah dan urutannya jadi acak.
		 * Dipakai di SELECT/GROUP BY/WHERE supaya soal yang sebenarnya sama
		 * selalu ketemu di satu grup, apa pun varian mentah di database.
		 */
		private function _practiceExpr($column = 'practice') {
			return "TRIM(REPLACE(SUBSTRING_INDEX(REPLACE($column, '\\r', ''), '\\t', 1), 'acheiving', 'achieving'))";
		}

		public static function normalizePractice($raw) {
			$val = str_replace("\r", '', (string) $raw);
			$parts = explode("\t", $val);
			$val = str_ireplace('acheiving', 'achieving', $parts[0]);
			return trim($val);
		}

		private function _wherePracticeEquals($practice) {
			$this->db->where($this->_practiceExpr() . ' = ' . $this->db->escape($practice), NULL, FALSE);
		}

		/**
		 * Nilai test_type dinormalisasi jadi string non-NULL supaya aman dipakai
		 * sebagai bagian kunci array PHP (pretest/posttest/_unknown) dan sebagai
		 * bagian WHERE (test_type IS NULL vs test_type = 'x').
		 */
		private static function _normalizeTestType($raw) {
			return ($raw === NULL || $raw === '') ? '_unknown' : $raw;
		}

		private function _whereTestTypeEquals($test_type) {
			if ($test_type === '_unknown' || $test_type === NULL || $test_type === '') {
				$this->db->where('test_type IS NULL');
			} else {
				$this->db->where('test_type', $test_type);
			}
		}

		/**
		 * Soal (practice + pertanyaan + test_type) yang pernah disentuh oleh SIAPA
		 * PUN anggota kelompok ini. Tidak ada tabel master soal untuk tes ini (soal
		 * & jawaban jadi satu baris di tb_test_unity), jadi "seluruh soal milik
		 * kelompok" didekati dari gabungan soal yang sudah pernah dikerjakan
		 * anggotanya. Practice dinormalisasi & pertanyaan diurutkan numerik agar
		 * tampilan per practice tidak terpecah/acak akibat data mentah yang tidak
		 * rapi. test_type WAJIB ikut jadi bagian identitas soal -- practice+nomor
		 * yang sama dipakai ulang untuk pretest & posttest dengan indikator_soal
		 * (studi kasus) yang berbeda, jadi kalau tidak dipisah, jawaban pretest &
		 * posttest akan tercampur jadi satu baris/grup yang sama.
		 */
		private function _getSoalKeysByKelompok($memberIds) {
			if (empty($memberIds)) return array();
			$expr = $this->_practiceExpr();
			// CI3's group_by()/order_by() naively explode() on ',' (tidak sadar tanda kurung),
			// jadi ekspresi SQL ber-argumen banyak wajib di-alias dulu di SELECT lalu
			// GROUP BY/ORDER BY memakai nama alias-nya saja, bukan ekspresi mentahnya.
			// Alias TIDAK BOLEH bernama "practice" -- MySQL/MariaDB ternyata mengutamakan
			// kolom asli `practice` di GROUP BY/ORDER BY saat alias & nama kolom bertabrakan,
			// sehingga normalisasi jadi tidak berefek (baris "acheiving"/typo tetap terpisah).
			$this->db->select("$expr AS practice_norm, CAST(pertanyaan AS UNSIGNED) AS pertanyaan_num, pertanyaan, test_type, MIN(indikator_soal) AS indikator_soal", FALSE);
			$this->db->where_in('id_user', $memberIds);
			$this->db->group_by('practice_norm');
			$this->db->group_by('pertanyaan');
			$this->db->group_by('test_type');
			$this->db->order_by('practice_norm', 'ASC');
			$this->db->order_by('pertanyaan_num', 'ASC');
			$this->db->order_by('pertanyaan', 'ASC');
			// pretest dulu baru posttest baru yang belum ditandai, per nomor soal yang sama
			$this->db->order_by("FIELD(test_type, 'pretest', 'posttest')", NULL, FALSE);
			$rows = $this->db->get('tb_test_unity')->result();
			foreach ($rows as $r) {
				$r->practice = $r->practice_norm;
				$r->test_type = self::_normalizeTestType($r->test_type);
			}
			return $rows;
		}

		/**
		 * Semua baris (nyata + placeholder) untuk kelompok ini: setiap anggota
		 * dipasangkan dengan SETIAP soal (practice+pertanyaan+test_type) yang
		 * pernah disentuh kelompoknya, supaya anggota yang belum mengerjakan soal
		 * tsb tetap muncul (bisa dinilai manual lewat bulk edit), bukan cuma baris
		 * yang sudah ada jawabannya.
		 */
		public function getByKelompok($no_kelompok) {
			$members = $this->getMembersByKelompok($no_kelompok);
			if (empty($members)) return array();
			$memberIds = array_map(function($m) { return (int) $m->id_user; }, $members);

			$soalKeys = $this->_getSoalKeysByKelompok($memberIds);
			if (empty($soalKeys)) return array();

			$this->db->select('id_test_unity, id_user, indikator_soal, practice, pertanyaan, test_type, jawaban, nilai, feedback');
			$this->db->where_in('id_user', $memberIds);
			$existing = $this->db->get('tb_test_unity')->result();

			$byKey = array();
			foreach ($existing as $row) {
				$normPractice = self::normalizePractice($row->practice);
				$normTestType = self::_normalizeTestType($row->test_type);
				$byKey[$normPractice . "\x1f" . $row->pertanyaan . "\x1f" . $normTestType . "\x1f" . $row->id_user] = $row;
			}

			$rows = array();
			foreach ($soalKeys as $sk) {
				foreach ($members as $m) {
					$lookupKey = $sk->practice . "\x1f" . $sk->pertanyaan . "\x1f" . $sk->test_type . "\x1f" . $m->id_user;
					if (isset($byKey[$lookupKey])) {
						$r = $byKey[$lookupKey];
					} else {
						$r = (object) array(
							'id_test_unity'  => NULL,
							'id_user'        => $m->id_user,
							'indikator_soal' => $sk->indikator_soal,
							'jawaban'        => NULL,
							'nilai'          => NULL,
							'feedback'       => NULL,
						);
					}
					// Selalu pakai practice/test_type yang sudah dinormalisasi, apa pun
					// sumbernya, supaya grouping di controller (md5 practice|pertanyaan|test_type)
					// konsisten.
					$r->practice     = $sk->practice;
					$r->pertanyaan   = $sk->pertanyaan;
					$r->test_type    = $sk->test_type;
					$r->nama_lengkap = $m->nama_lengkap;
					$r->no_kelompok  = $no_kelompok;
					$rows[] = $r;
				}
			}

			return $rows;
		}

		/**
		 * Terapkan satu nilai/feedback (dan opsional jawaban) ke SEMUA anggota
		 * kelompok untuk satu soal (practice+pertanyaan+test_type). Anggota yang
		 * sudah punya baris -> update. Anggota yang belum -> insert baru, supaya
		 * soal yang belum pernah dikerjakan siapa pun tetap bisa dinilai manual.
		 * Pencocokan baris lama pakai practice yang dinormalisasi supaya varian
		 * mentah (typo/rusak) tetap ketemu & ikut terupdate.
		 */
		public function updateOrInsertForGroup($no_kelompok, $indikator_soal, $practice, $pertanyaan, $test_type, $data) {
			$members = $this->getMembersByKelompok($no_kelompok);
			if (empty($members)) return;
			$ids = array_map(function($m) { return $m->id_user; }, $members);
			$test_type = self::_normalizeTestType($test_type);

			$this->db->select('id_user');
			$this->db->where_in('id_user', $ids);
			$this->_wherePracticeEquals($practice);
			$this->db->where('pertanyaan', $pertanyaan);
			$this->_whereTestTypeEquals($test_type);
			$existingIds = array_map(function($r) { return $r->id_user; }, $this->db->get('tb_test_unity')->result());

			if (!empty($existingIds)) {
				$this->db->where_in('id_user', $existingIds);
				$this->_wherePracticeEquals($practice);
				$this->db->where('pertanyaan', $pertanyaan);
				$this->_whereTestTypeEquals($test_type);
				$this->db->update('tb_test_unity', $data);
			}

			$missingIds = array_diff($ids, $existingIds);
			foreach ($missingIds as $uid) {
				$this->db->insert('tb_test_unity', array_merge($data, [
					'id_user'        => $uid,
					'indikator_soal' => $indikator_soal,
					'practice'       => $practice,
					'pertanyaan'     => $pertanyaan,
					'test_type'      => $test_type === '_unknown' ? NULL : $test_type,
				]));
			}
		}

		/**
		 * Ubah test_type SEMUA baris kelompok ini untuk satu soal (practice+
		 * pertanyaan) sekaligus -- dipakai tombol "Tandai Pretest/Posttest" di
		 * daftar soal & bulk edit, supaya baris "Belum Ditandai" (atau salah
		 * tandai) bisa dikoreksi tanpa buka form edit satu-satu per siswa.
		 */
		public function retagTestType($no_kelompok, $practice, $pertanyaan, $old_test_type, $new_test_type) {
			$members = $this->getMembersByKelompok($no_kelompok);
			if (empty($members)) return;
			$ids = array_map(function($m) { return $m->id_user; }, $members);

			$this->db->where_in('id_user', $ids);
			$this->_wherePracticeEquals($practice);
			$this->db->where('pertanyaan', $pertanyaan);
			$this->_whereTestTypeEquals(self::_normalizeTestType($old_test_type));
			$this->db->update('tb_test_unity', array('test_type' => $new_test_type));
		}

		/**
		 * Ringkasan kartu per kelompok untuk halaman "Penilaian Tes per Kelompok".
		 */
		public function getKelompokCards($filters = array()) {
			$angkatan    = !empty($filters['angkatan'])    ? $filters['angkatan']    : NULL;
			$no_kelompok = !empty($filters['no_kelompok']) ? $filters['no_kelompok'] : NULL;

			$this->db->select('id_user, no_kelompok, nama_lengkap, angkatan');
			$this->db->where('id_role_user', 1);
			$this->db->where('no_kelompok IS NOT NULL');
			$this->db->where('no_kelompok !=', '');
			if ($angkatan)    $this->db->where('angkatan', $angkatan);
			if ($no_kelompok) $this->db->like('no_kelompok', $no_kelompok);
			$this->db->order_by('no_kelompok, nama_lengkap');
			$members = $this->db->get('tb_user')->result();

			if (empty($members)) return array();

			$groups = array();
			foreach ($members as $m) {
				if (!isset($groups[$m->no_kelompok])) {
					$groups[$m->no_kelompok] = array(
						'no_kelompok' => $m->no_kelompok,
						'angkatan'    => $m->angkatan,
						'members'     => array(),
						'member_ids'  => array(),
					);
				}
				$groups[$m->no_kelompok]['members'][] = $m->nama_lengkap;
				$groups[$m->no_kelompok]['member_ids'][] = (int) $m->id_user;
			}

			$allMemberIds = array();
			foreach ($groups as $g) { $allMemberIds = array_merge($allMemberIds, $g['member_ids']); }

			$this->db->select('id_user, practice, pertanyaan, test_type, jawaban, nilai');
			$this->db->where_in('id_user', $allMemberIds);
			$answerRows = $this->db->get('tb_test_unity')->result();

			$userIdToKelompok = array();
			foreach ($groups as $k => $g) {
				foreach ($g['member_ids'] as $uid) { $userIdToKelompok[$uid] = $k; }
			}

			$soalPerKelompok = array(); // [kelompok] => set of practice|pertanyaan|test_type
			$terisiPerKelompok = array();
			$dinilaiPerKelompok = array();
			$nilaiAgg = array();

			foreach ($answerRows as $a) {
				$k = isset($userIdToKelompok[$a->id_user]) ? $userIdToKelompok[$a->id_user] : NULL;
				if ($k === NULL) continue;
				$key = self::normalizePractice($a->practice) . "\x1f" . $a->pertanyaan . "\x1f" . self::_normalizeTestType($a->test_type);
				$soalPerKelompok[$k][$key] = TRUE;

				$isFilled = ($a->jawaban !== NULL && $a->jawaban !== '');
				if ($isFilled) $terisiPerKelompok[$k][$key] = TRUE;

				if ($a->nilai !== NULL) {
					$dinilaiPerKelompok[$k][$key] = TRUE;
					if (!isset($nilaiAgg[$k])) $nilaiAgg[$k] = array('sum' => 0, 'count' => 0);
					$nilaiAgg[$k]['sum'] += (float) $a->nilai;
					$nilaiAgg[$k]['count']++;
				}
			}

			$result = array();
			foreach ($groups as $k => $g) {
				$totalSoal = isset($soalPerKelompok[$k]) ? count($soalPerKelompok[$k]) : 0;
				$terisi    = isset($terisiPerKelompok[$k]) ? count($terisiPerKelompok[$k]) : 0;
				$dinilai   = isset($dinilaiPerKelompok[$k]) ? count($dinilaiPerKelompok[$k]) : 0;
				$nilaiCount = isset($nilaiAgg[$k]) ? $nilaiAgg[$k]['count'] : 0;
				$nilaiSum   = isset($nilaiAgg[$k]) ? $nilaiAgg[$k]['sum']   : 0;

				$result[] = array(
					'no_kelompok'    => $k,
					'angkatan'       => $g['angkatan'],
					'members'        => $g['members'],
					'jumlah_anggota' => count($g['members']),
					'total_soal'     => $totalSoal,
					'terisi'         => $terisi,
					'dinilai'        => $dinilai,
					'rata_nilai'     => $nilaiCount ? round($nilaiSum / $nilaiCount, 1) : NULL,
				);
			}

			usort($result, function($a, $b) { return strnatcmp($a['no_kelompok'], $b['no_kelompok']); });

			return $result;
		}

		/**
		 * Ringkasan kartu per kelompok untuk kelompok, tapi DI-SCOPE ke satu
		 * test_type saja (dipakai halaman "Per Jenis Tes" setelah memilih
		 * pretest/posttest). Baris dengan test_type lain tidak ikut dihitung.
		 */
		public function getKelompokCardsByTestType($test_type, $filters = array()) {
			$test_type = self::_normalizeTestType($test_type);
			$cards = $this->getKelompokCards($filters);
			if (empty($cards)) return array();

			$kelompokKeys = array_column($cards, 'no_kelompok');
			$this->db->select('u.no_kelompok, tu.practice, tu.pertanyaan, tu.jawaban, tu.nilai');
			$this->db->from('tb_test_unity tu');
			$this->db->join('tb_user u', 'u.id_user = tu.id_user');
			$this->db->where_in('u.no_kelompok', $kelompokKeys);
			$this->_whereTestTypeEquals($test_type);
			$answerRows = $this->db->get()->result();

			$soalPerKelompok = array();
			$terisiPerKelompok = array();
			$dinilaiPerKelompok = array();
			$nilaiAgg = array();
			foreach ($answerRows as $a) {
				$k = $a->no_kelompok;
				$key = self::normalizePractice($a->practice) . "\x1f" . $a->pertanyaan;
				$soalPerKelompok[$k][$key] = TRUE;
				if ($a->jawaban !== NULL && $a->jawaban !== '') $terisiPerKelompok[$k][$key] = TRUE;
				if ($a->nilai !== NULL) {
					$dinilaiPerKelompok[$k][$key] = TRUE;
					if (!isset($nilaiAgg[$k])) $nilaiAgg[$k] = array('sum' => 0, 'count' => 0);
					$nilaiAgg[$k]['sum'] += (float) $a->nilai;
					$nilaiAgg[$k]['count']++;
				}
			}

			$result = array();
			foreach ($cards as $c) {
				$k = $c['no_kelompok'];
				$totalSoal = isset($soalPerKelompok[$k]) ? count($soalPerKelompok[$k]) : 0;
				if ($totalSoal === 0) continue; // kelompok ini belum sentuh test_type ini sama sekali
				$nilaiCount = isset($nilaiAgg[$k]) ? $nilaiAgg[$k]['count'] : 0;
				$nilaiSum   = isset($nilaiAgg[$k]) ? $nilaiAgg[$k]['sum']   : 0;
				$result[] = array(
					'no_kelompok'    => $k,
					'angkatan'       => $c['angkatan'],
					'members'        => $c['members'],
					'jumlah_anggota' => $c['jumlah_anggota'],
					'total_soal'     => $totalSoal,
					'terisi'         => isset($terisiPerKelompok[$k]) ? count($terisiPerKelompok[$k]) : 0,
					'dinilai'        => isset($dinilaiPerKelompok[$k]) ? count($dinilaiPerKelompok[$k]) : 0,
					'rata_nilai'     => $nilaiCount ? round($nilaiSum / $nilaiCount, 1) : NULL,
				);
			}

			return $result;
		}

		/**
		 * Ringkasan agregat per jenis tes (pretest/posttest) untuk halaman landing
		 * "Per Jenis Tes": berapa kelompok/siswa terlibat, berapa soal sudah
		 * dinilai, dan rata-rata nilai keseluruhan.
		 */
		public function getTestTypeSummary($filters = array()) {
			$angkatan = !empty($filters['angkatan']) ? $filters['angkatan'] : NULL;

			$this->db->select('id_user, no_kelompok');
			$this->db->where('id_role_user', 1);
			$this->db->where('no_kelompok IS NOT NULL');
			$this->db->where('no_kelompok !=', '');
			if ($angkatan) $this->db->where('angkatan', $angkatan);
			$members = $this->db->get('tb_user')->result();
			if (empty($members)) {
				return array(
					'pretest'  => array('jumlah_kelompok' => 0, 'jumlah_siswa' => 0, 'total_soal' => 0, 'dinilai' => 0, 'rata_nilai' => NULL),
					'posttest' => array('jumlah_kelompok' => 0, 'jumlah_siswa' => 0, 'total_soal' => 0, 'dinilai' => 0, 'rata_nilai' => NULL),
				);
			}
			$memberIds = array_map(function($m) { return (int) $m->id_user; }, $members);
			$userToKelompok = array();
			foreach ($members as $m) { $userToKelompok[$m->id_user] = $m->no_kelompok; }

			$this->db->select('id_user, practice, pertanyaan, test_type, jawaban, nilai');
			$this->db->where_in('id_user', $memberIds);
			$this->db->where('test_type IS NOT NULL');
			$rows = $this->db->get('tb_test_unity')->result();

			$agg = array(
				'pretest'  => array('kelompok' => array(), 'siswa' => array(), 'soal' => array(), 'dinilai' => 0, 'sum' => 0, 'count' => 0),
				'posttest' => array('kelompok' => array(), 'siswa' => array(), 'soal' => array(), 'dinilai' => 0, 'sum' => 0, 'count' => 0),
			);
			foreach ($rows as $r) {
				if (!isset($agg[$r->test_type])) continue;
				$k = isset($userToKelompok[$r->id_user]) ? $userToKelompok[$r->id_user] : NULL;
				if ($k === NULL) continue;
				$agg[$r->test_type]['kelompok'][$k] = TRUE;
				$agg[$r->test_type]['siswa'][$r->id_user] = TRUE;
				$agg[$r->test_type]['soal'][self::normalizePractice($r->practice) . "\x1f" . $r->pertanyaan] = TRUE;
				if ($r->nilai !== NULL) {
					$agg[$r->test_type]['dinilai']++;
					$agg[$r->test_type]['sum'] += (float) $r->nilai;
					$agg[$r->test_type]['count']++;
				}
			}

			$result = array();
			foreach (array('pretest', 'posttest') as $tt) {
				$result[$tt] = array(
					'jumlah_kelompok' => count($agg[$tt]['kelompok']),
					'jumlah_siswa'    => count($agg[$tt]['siswa']),
					'total_soal'      => count($agg[$tt]['soal']),
					'dinilai'         => $agg[$tt]['dinilai'],
					'rata_nilai'      => $agg[$tt]['count'] ? round($agg[$tt]['sum'] / $agg[$tt]['count'], 1) : NULL,
				);
			}
			return $result;
		}

		/**
		 * Perbandingan rata-rata nilai Pretest vs Posttest per kelompok, untuk
		 * tabel rekap di halaman landing "Per Jenis Tes" -- supaya dosen bisa
		 * lihat progres belajar tanpa harus buka satu-satu kelompok.
		 */
		public function getKelompokComparison($filters = array()) {
			$angkatan = !empty($filters['angkatan']) ? $filters['angkatan'] : NULL;

			$this->db->select('id_user, no_kelompok, angkatan');
			$this->db->where('id_role_user', 1);
			$this->db->where('no_kelompok IS NOT NULL');
			$this->db->where('no_kelompok !=', '');
			if ($angkatan) $this->db->where('angkatan', $angkatan);
			$members = $this->db->get('tb_user')->result();
			if (empty($members)) return array();

			$userToKelompok = array();
			$kelompokAngkatan = array();
			foreach ($members as $m) {
				$userToKelompok[$m->id_user] = $m->no_kelompok;
				$kelompokAngkatan[$m->no_kelompok] = $m->angkatan;
			}
			$memberIds = array_keys($userToKelompok);

			$this->db->select('id_user, test_type, nilai');
			$this->db->where_in('id_user', $memberIds);
			$this->db->where('test_type IS NOT NULL');
			$this->db->where('nilai IS NOT NULL');
			$rows = $this->db->get('tb_test_unity')->result();

			$agg = array(); // [kelompok][test_type] = ['sum'=>x,'count'=>y]
			foreach ($rows as $r) {
				$k = isset($userToKelompok[$r->id_user]) ? $userToKelompok[$r->id_user] : NULL;
				if ($k === NULL) continue;
				if (!isset($agg[$k][$r->test_type])) $agg[$k][$r->test_type] = array('sum' => 0, 'count' => 0);
				$agg[$k][$r->test_type]['sum']   += (float) $r->nilai;
				$agg[$k][$r->test_type]['count']++;
			}

			$result = array();
			foreach ($agg as $k => $byType) {
				$ratePre  = isset($byType['pretest'])  && $byType['pretest']['count']  ? round($byType['pretest']['sum']  / $byType['pretest']['count'],  1) : NULL;
				$ratePost = isset($byType['posttest']) && $byType['posttest']['count'] ? round($byType['posttest']['sum'] / $byType['posttest']['count'], 1) : NULL;
				$result[] = array(
					'no_kelompok'   => $k,
					'angkatan'      => isset($kelompokAngkatan[$k]) ? $kelompokAngkatan[$k] : NULL,
					'rata_pretest'  => $ratePre,
					'rata_posttest' => $ratePost,
					'delta'         => ($ratePre !== NULL && $ratePost !== NULL) ? round($ratePost - $ratePre, 1) : NULL,
				);
			}

			usort($result, function($a, $b) { return strnatcmp($a['no_kelompok'], $b['no_kelompok']); });

			return $result;
		}

		/**
		 * Daftar soal (dikelompokkan per practice, dipisah pretest/posttest) untuk
		 * satu kelompok, lengkap dengan status "berapa anggota sudah menjawab /
		 * sudah dinilai".
		 */
		public function getSoalListByKelompok($no_kelompok) {
			$members = $this->getMembersByKelompok($no_kelompok);
			if (empty($members)) return array('members' => array(), 'soal' => array());
			$memberIds = array_map(function($m) { return (int) $m->id_user; }, $members);

			$soalKeys = $this->_getSoalKeysByKelompok($memberIds);
			if (empty($soalKeys)) return array('members' => $members, 'soal' => array());

			$this->db->select('id_user, practice, pertanyaan, test_type, jawaban, nilai');
			$this->db->where_in('id_user', $memberIds);
			$answerRows = $this->db->get('tb_test_unity')->result();

			$agg = array(); // [practice|pertanyaan|test_type] = ['menjawab'=>[uid=>true],'dinilai'=>[uid=>true],'sum'=>x,'count'=>y]
			foreach ($answerRows as $a) {
				$key = self::normalizePractice($a->practice) . "\x1f" . $a->pertanyaan . "\x1f" . self::_normalizeTestType($a->test_type);
				if (!isset($agg[$key])) $agg[$key] = array('menjawab' => array(), 'dinilai' => array(), 'sum' => 0, 'count' => 0);
				if ($a->jawaban !== NULL && $a->jawaban !== '') $agg[$key]['menjawab'][$a->id_user] = TRUE;
				if ($a->nilai !== NULL) {
					$agg[$key]['dinilai'][$a->id_user] = TRUE;
					$agg[$key]['sum']   += (float) $a->nilai;
					$agg[$key]['count']++;
				}
			}

			$totalAnggota = count($members);
			$soal = array();
			foreach ($soalKeys as $sk) {
				$key = $sk->practice . "\x1f" . $sk->pertanyaan . "\x1f" . $sk->test_type;
				$a = isset($agg[$key]) ? $agg[$key] : array('menjawab' => array(), 'dinilai' => array(), 'sum' => 0, 'count' => 0);
				$soal[] = array(
					'soal_key'        => self::encodeSoalKey($sk->practice, $sk->pertanyaan, $sk->test_type),
					'indikator_soal'  => $sk->indikator_soal,
					'practice'        => $sk->practice,
					'pertanyaan'      => $sk->pertanyaan,
					'test_type'       => $sk->test_type,
					'jumlah_menjawab' => count($a['menjawab']),
					'jumlah_dinilai'  => count($a['dinilai']),
					'total_anggota'   => $totalAnggota,
					'rata_nilai'      => $a['count'] ? round($a['sum'] / $a['count'], 1) : NULL,
				);
			}

			return array('members' => $members, 'soal' => $soal);
		}

		/**
		 * Semua practice unik (sudah dinormalisasi) untuk dropdown filter.
		 */
		public function getDistinctPractice() {
			$expr = $this->_practiceExpr();
			// Alias sengaja bukan "practice" -- lihat catatan di _getSoalKeysByKelompok().
			$this->db->select("DISTINCT $expr AS practice_norm", FALSE);
			$this->db->order_by('practice_norm', 'ASC');
			$rows = $this->db->get('tb_test_unity')->result();
			foreach ($rows as $r) { $r->practice = $r->practice_norm; }
			return $rows;
		}

		/**
		 * Detail soal (practice+pertanyaan+test_type) + jawaban tiap siswa kelompok
		 * untuk soal itu. Practice dicocokkan lewat normalisasi supaya varian
		 * mentah tetap ketemu.
		 */
		public function getJawabanPerSiswa($no_kelompok, $practice, $pertanyaan, $test_type) {
			$members = $this->getMembersByKelompok($no_kelompok);
			if (empty($members)) return NULL;
			$memberIds = array_map(function($m) { return (int) $m->id_user; }, $members);
			$test_type = self::_normalizeTestType($test_type);

			$this->db->select('id_test_unity, id_user, indikator_soal, jawaban, nilai, feedback');
			$this->db->where_in('id_user', $memberIds);
			$this->_wherePracticeEquals($practice);
			$this->db->where('pertanyaan', $pertanyaan);
			$this->_whereTestTypeEquals($test_type);
			$rows = $this->db->get('tb_test_unity')->result();
			if (empty($rows)) return NULL;

			$indikator_soal = $rows[0]->indikator_soal;
			$byUser = array();
			foreach ($rows as $r) { $byUser[$r->id_user] = $r; }

			$siswa = array();
			foreach ($members as $m) {
				$r = isset($byUser[$m->id_user]) ? $byUser[$m->id_user] : NULL;
				$siswa[] = array(
					'id_user'        => $m->id_user,
					'nama_lengkap'   => $m->nama_lengkap,
					'id_test_unity'  => $r ? $r->id_test_unity : NULL,
					'jawaban'        => $r ? $r->jawaban  : NULL,
					'nilai'          => $r ? $r->nilai    : NULL,
					'feedback'       => $r ? $r->feedback : NULL,
				);
			}

			return array(
				'indikator_soal' => $indikator_soal,
				'practice'       => $practice,
				'pertanyaan'     => $pertanyaan,
				'test_type'      => $test_type,
				'siswa'          => $siswa,
			);
		}

		public static function encodeSoalKey($practice, $pertanyaan, $test_type = NULL) {
			$json = json_encode(array($practice, $pertanyaan, self::_normalizeTestType($test_type)));
			return rtrim(strtr(base64_encode($json), '+/', '-_'), '=');
		}

		public static function decodeSoalKey($key) {
			$b64 = strtr($key, '-_', '+/');
			$b64 .= str_repeat('=', (4 - strlen($b64) % 4) % 4);
			$json = base64_decode($b64);
			$arr  = $json !== FALSE ? json_decode($json, TRUE) : NULL;
			if (!is_array($arr) || count($arr) < 2) return NULL;
			return array(
				'practice'   => $arr[0],
				'pertanyaan' => $arr[1],
				'test_type'  => isset($arr[2]) ? $arr[2] : '_unknown',
			);
		}

		public function hapusJawaban($id) {
			$this->db->where('id_test_unity', $id);
			$this->db->delete('tb_test_unity');
		}

		/**
		 * Filter & sort untuk tabel Data Tes Mahasiswa (v_test_unity).
		 */
		public function getRecordsPaginated($limit, $offset, $filters = array(), $sort = 'nama_lengkap', $dir = 'ASC') {
			$this->_applyFilters($filters);
			$this->_applySort($sort, $dir);
			$this->db->limit($limit, $offset);
			return $this->db->get('v_test_unity')->result();
		}

		public function getRecordsCount($filters = array()) {
			$this->_applyFilters($filters);
			return $this->db->count_all_results('v_test_unity');
		}

		private function _applyFilters($filters) {
			if (!empty($filters['nama_lengkap']))  $this->db->where('nama_lengkap', $filters['nama_lengkap']);
			if (!empty($filters['no_kelompok']))   $this->db->where('no_kelompok', $filters['no_kelompok']);
			if (!empty($filters['angkatan']))      $this->db->where('angkatan', $filters['angkatan']);
			if (!empty($filters['jenis_kelamin'])) $this->db->where('jenis_kelamin', $filters['jenis_kelamin']);
			if (!empty($filters['practice']))      $this->_wherePracticeEquals($filters['practice']);
			if (!empty($filters['test_type']))     $this->_whereTestTypeEquals($filters['test_type']);
			if (!empty($filters['status'])) {
				if ($filters['status'] === 'dinilai')        $this->db->where('nilai IS NOT NULL');
				else if ($filters['status'] === 'belum_dinilai') $this->db->where('nilai IS NULL');
			}
		}

		private function _applySort($sort, $dir) {
			$allowed = array(
				'nama_lengkap', 'no_kelompok', 'angkatan', 'jenis_kelamin', 'practice', 'test_type', 'nilai',
			);
			if (!in_array($sort, $allowed)) $sort = 'nama_lengkap';
			$dir = strtoupper($dir) === 'DESC' ? 'DESC' : 'ASC';
			if ($sort === 'practice') {
				// order_by()/group_by() CI3 tidak sadar tanda kurung saat explode(','), jadi
				// ekspresi ber-koma wajib di-alias dulu di SELECT, baru ORDER BY pakai alias-nya.
				$this->db->select('*, ' . $this->_practiceExpr() . ' AS practice_sort', FALSE);
				$this->db->order_by('practice_sort', $dir);
			} else {
				$this->db->order_by($sort, $dir);
			}
		}
	}
?>
