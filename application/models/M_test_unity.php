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
		 * Soal (practice + pertanyaan) yang pernah disentuh oleh SIAPA PUN anggota
		 * kelompok ini. Tidak ada tabel master soal untuk tes ini (soal & jawaban
		 * jadi satu baris di tb_test_unity), jadi "seluruh soal milik kelompok"
		 * didekati dari gabungan soal yang sudah pernah dikerjakan anggotanya.
		 * Practice dinormalisasi & pertanyaan diurutkan numerik agar tampilan
		 * per practice tidak terpecah/acak akibat data mentah yang tidak rapi.
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
			$this->db->select("$expr AS practice_norm, CAST(pertanyaan AS UNSIGNED) AS pertanyaan_num, pertanyaan, MIN(indikator_soal) AS indikator_soal", FALSE);
			$this->db->where_in('id_user', $memberIds);
			$this->db->group_by('practice_norm');
			$this->db->group_by('pertanyaan');
			$this->db->order_by('practice_norm', 'ASC');
			$this->db->order_by('pertanyaan_num', 'ASC');
			$this->db->order_by('pertanyaan', 'ASC');
			$rows = $this->db->get('tb_test_unity')->result();
			foreach ($rows as $r) { $r->practice = $r->practice_norm; }
			return $rows;
		}

		/**
		 * Semua baris (nyata + placeholder) untuk kelompok ini: setiap anggota
		 * dipasangkan dengan SETIAP soal yang pernah disentuh kelompoknya, supaya
		 * anggota yang belum mengerjakan soal tsb tetap muncul (bisa dinilai
		 * manual lewat bulk edit), bukan cuma baris yang sudah ada jawabannya.
		 */
		public function getByKelompok($no_kelompok) {
			$members = $this->getMembersByKelompok($no_kelompok);
			if (empty($members)) return array();
			$memberIds = array_map(function($m) { return (int) $m->id_user; }, $members);

			$soalKeys = $this->_getSoalKeysByKelompok($memberIds);
			if (empty($soalKeys)) return array();

			$this->db->select('id_test_unity, id_user, indikator_soal, practice, pertanyaan, jawaban, nilai, feedback');
			$this->db->where_in('id_user', $memberIds);
			$existing = $this->db->get('tb_test_unity')->result();

			$byKey = array();
			foreach ($existing as $row) {
				$normPractice = self::normalizePractice($row->practice);
				$byKey[$normPractice . "\x1f" . $row->pertanyaan . "\x1f" . $row->id_user] = $row;
			}

			$rows = array();
			foreach ($soalKeys as $sk) {
				foreach ($members as $m) {
					$lookupKey = $sk->practice . "\x1f" . $sk->pertanyaan . "\x1f" . $m->id_user;
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
					// Selalu pakai practice yang sudah dinormalisasi, apa pun sumbernya,
					// supaya grouping di controller (md5 practice|pertanyaan) konsisten.
					$r->practice     = $sk->practice;
					$r->pertanyaan   = $sk->pertanyaan;
					$r->nama_lengkap = $m->nama_lengkap;
					$r->no_kelompok  = $no_kelompok;
					$rows[] = $r;
				}
			}

			return $rows;
		}

		/**
		 * Terapkan satu nilai/feedback (dan opsional jawaban) ke SEMUA anggota
		 * kelompok untuk satu soal (practice+pertanyaan). Anggota yang sudah
		 * punya baris -> update. Anggota yang belum -> insert baru, supaya soal
		 * yang belum pernah dikerjakan siapa pun tetap bisa dinilai manual.
		 * Pencocokan baris lama pakai practice yang dinormalisasi supaya varian
		 * mentah (typo/rusak) tetap ketemu & ikut terupdate.
		 */
		public function updateOrInsertForGroup($no_kelompok, $indikator_soal, $practice, $pertanyaan, $data) {
			$members = $this->getMembersByKelompok($no_kelompok);
			if (empty($members)) return;
			$ids = array_map(function($m) { return $m->id_user; }, $members);

			$this->db->select('id_user');
			$this->db->where_in('id_user', $ids);
			$this->_wherePracticeEquals($practice);
			$this->db->where('pertanyaan', $pertanyaan);
			$existingIds = array_map(function($r) { return $r->id_user; }, $this->db->get('tb_test_unity')->result());

			if (!empty($existingIds)) {
				$this->db->where_in('id_user', $existingIds);
				$this->_wherePracticeEquals($practice);
				$this->db->where('pertanyaan', $pertanyaan);
				$this->db->update('tb_test_unity', $data);
			}

			$missingIds = array_diff($ids, $existingIds);
			foreach ($missingIds as $uid) {
				$this->db->insert('tb_test_unity', array_merge($data, [
					'id_user'        => $uid,
					'indikator_soal' => $indikator_soal,
					'practice'       => $practice,
					'pertanyaan'     => $pertanyaan,
				]));
			}
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

			$this->db->select('id_user, practice, pertanyaan, jawaban, nilai');
			$this->db->where_in('id_user', $allMemberIds);
			$answerRows = $this->db->get('tb_test_unity')->result();

			$userIdToKelompok = array();
			foreach ($groups as $k => $g) {
				foreach ($g['member_ids'] as $uid) { $userIdToKelompok[$uid] = $k; }
			}

			$soalPerKelompok = array(); // [kelompok] => set of practice|pertanyaan
			$terisiPerKelompok = array();
			$dinilaiPerKelompok = array();
			$nilaiAgg = array();

			foreach ($answerRows as $a) {
				$k = isset($userIdToKelompok[$a->id_user]) ? $userIdToKelompok[$a->id_user] : NULL;
				if ($k === NULL) continue;
				$key = self::normalizePractice($a->practice) . "\x1f" . $a->pertanyaan;
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
		 * Daftar soal (dikelompokkan per practice) untuk satu kelompok, lengkap
		 * dengan status "berapa anggota sudah menjawab / sudah dinilai".
		 */
		public function getSoalListByKelompok($no_kelompok) {
			$members = $this->getMembersByKelompok($no_kelompok);
			if (empty($members)) return array('members' => array(), 'soal' => array());
			$memberIds = array_map(function($m) { return (int) $m->id_user; }, $members);

			$soalKeys = $this->_getSoalKeysByKelompok($memberIds);
			if (empty($soalKeys)) return array('members' => $members, 'soal' => array());

			$this->db->select('id_user, practice, pertanyaan, jawaban, nilai');
			$this->db->where_in('id_user', $memberIds);
			$answerRows = $this->db->get('tb_test_unity')->result();

			$agg = array(); // [practice|pertanyaan] = ['menjawab'=>[uid=>true],'dinilai'=>[uid=>true],'sum'=>x,'count'=>y]
			foreach ($answerRows as $a) {
				$key = self::normalizePractice($a->practice) . "\x1f" . $a->pertanyaan;
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
				$key = $sk->practice . "\x1f" . $sk->pertanyaan;
				$a = isset($agg[$key]) ? $agg[$key] : array('menjawab' => array(), 'dinilai' => array(), 'sum' => 0, 'count' => 0);
				$soal[] = array(
					'soal_key'        => self::encodeSoalKey($sk->practice, $sk->pertanyaan),
					'indikator_soal'  => $sk->indikator_soal,
					'practice'        => $sk->practice,
					'pertanyaan'      => $sk->pertanyaan,
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
		 * Detail soal (practice+pertanyaan) + jawaban tiap siswa kelompok untuk soal itu.
		 * Practice dicocokkan lewat normalisasi supaya varian mentah tetap ketemu.
		 */
		public function getJawabanPerSiswa($no_kelompok, $practice, $pertanyaan) {
			$members = $this->getMembersByKelompok($no_kelompok);
			if (empty($members)) return NULL;
			$memberIds = array_map(function($m) { return (int) $m->id_user; }, $members);

			$this->db->select('id_test_unity, id_user, indikator_soal, jawaban, nilai, feedback');
			$this->db->where_in('id_user', $memberIds);
			$this->_wherePracticeEquals($practice);
			$this->db->where('pertanyaan', $pertanyaan);
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
				'siswa'          => $siswa,
			);
		}

		public static function encodeSoalKey($practice, $pertanyaan) {
			$json = json_encode(array($practice, $pertanyaan));
			return rtrim(strtr(base64_encode($json), '+/', '-_'), '=');
		}

		public static function decodeSoalKey($key) {
			$b64 = strtr($key, '-_', '+/');
			$b64 .= str_repeat('=', (4 - strlen($b64) % 4) % 4);
			$json = base64_decode($b64);
			$arr  = $json !== FALSE ? json_decode($json, TRUE) : NULL;
			if (!is_array($arr) || count($arr) !== 2) return NULL;
			return array('practice' => $arr[0], 'pertanyaan' => $arr[1]);
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
			if (!empty($filters['status'])) {
				if ($filters['status'] === 'dinilai')        $this->db->where('nilai IS NOT NULL');
				else if ($filters['status'] === 'belum_dinilai') $this->db->where('nilai IS NULL');
			}
		}

		private function _applySort($sort, $dir) {
			$allowed = array(
				'nama_lengkap', 'no_kelompok', 'angkatan', 'jenis_kelamin', 'practice', 'nilai',
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
