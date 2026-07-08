<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model khusus untuk tampilan "per Kelompok" (Kelompok -> Soal -> Jawaban tiap siswa).
 * Dipisah dari M_jawaban_essai supaya tidak tabrakan dengan perubahan yang sedang
 * berjalan di model tersebut. Semua query dibuat flat (bukan N+1 per kelompok/soal).
 */
class M_jawaban_mahasiswa extends CI_Model {

	public function getDistinctAngkatan() {
		$this->db->select('angkatan');
		$this->db->distinct();
		$this->db->where('id_role_user', 1);
		$this->db->where('angkatan IS NOT NULL');
		$this->db->order_by('angkatan', 'DESC');
		return $this->db->get('tb_user')->result();
	}

	public function getMembersByKelompok($no_kelompok) {
		$this->db->select('id_user, nama_lengkap');
		$this->db->where('no_kelompok', $no_kelompok);
		$this->db->where('id_role_user', 1);
		$this->db->order_by('nama_lengkap', 'ASC');
		return $this->db->get('tb_user')->result();
	}

	/**
	 * Ringkasan kartu per kelompok untuk halaman pertama (pilih kelompok).
	 */
	public function getKelompokCards($filters = array()) {
		$angkatan = !empty($filters['angkatan']) ? $filters['angkatan'] : NULL;

		$this->db->select('id_user, no_kelompok, nama_lengkap, angkatan');
		$this->db->where('id_role_user', 1);
		$this->db->where('no_kelompok IS NOT NULL');
		$this->db->where('no_kelompok !=', '');
		if ($angkatan) $this->db->where('angkatan', $angkatan);
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
				);
			}
			$groups[$m->no_kelompok]['members'][] = $m->nama_lengkap;
		}
		$kelompokKeys = array_keys($groups);

		// Worksheet (permasalahan) yang sudah pernah disentuh tiap kelompok
		$this->db->select('u.no_kelompok, se.id_permasalahan');
		$this->db->distinct();
		$this->db->from('tb_jawaban_essai je');
		$this->db->join('tb_user u', 'je.id_user = u.id_user');
		$this->db->join('tb_soal_essai se', 'je.id_soal = se.id_soal_essai');
		$this->db->where_in('u.no_kelompok', $kelompokKeys);
		$touchedRows = $this->db->get()->result();

		$touched = array();
		$allPermasalahanIds = array();
		foreach ($touchedRows as $t) {
			$touched[$t->no_kelompok][] = (int) $t->id_permasalahan;
			$allPermasalahanIds[] = (int) $t->id_permasalahan;
		}
		$allPermasalahanIds = array_unique($allPermasalahanIds);

		$soalByPermasalahan = array();
		if (!empty($allPermasalahanIds)) {
			$this->db->select('id_soal_essai, id_permasalahan');
			$this->db->where_in('id_permasalahan', $allPermasalahanIds);
			$soalRows = $this->db->get('tb_soal_essai')->result();
			foreach ($soalRows as $s) {
				$soalByPermasalahan[$s->id_permasalahan][] = $s->id_soal_essai;
			}
		}

		// Semua jawaban milik anggota kelompok-kelompok tersebut
		$this->db->select('je.id_soal, u.no_kelompok, je.jawaban_text, je.jawaban_gambar, je.jawaban_file, je.nilai, je.created_at, je.updated_at');
		$this->db->from('tb_jawaban_essai je');
		$this->db->join('tb_user u', 'je.id_user = u.id_user');
		$this->db->where_in('u.no_kelompok', $kelompokKeys);
		$jawabanRows = $this->db->get()->result();

		$perKelSoal  = array(); // [kelompok][id_soal] = ['terisi'=>bool,'dinilai'=>bool]
		$nilaiAgg    = array(); // [kelompok] = ['sum'=>x,'count'=>y]
		$lastUpdate  = array(); // [kelompok] = datetime string terbaru

		foreach ($jawabanRows as $j) {
			$k = $j->no_kelompok; $sid = $j->id_soal;
			if (!isset($perKelSoal[$k][$sid])) $perKelSoal[$k][$sid] = array('terisi' => FALSE, 'dinilai' => FALSE);

			$isFilled = ($j->jawaban_text !== NULL && $j->jawaban_text !== '') || $j->jawaban_gambar !== NULL || $j->jawaban_file !== NULL;
			if ($isFilled) $perKelSoal[$k][$sid]['terisi'] = TRUE;

			if ($j->nilai !== NULL) {
				$perKelSoal[$k][$sid]['dinilai'] = TRUE;
				if (!isset($nilaiAgg[$k])) $nilaiAgg[$k] = array('sum' => 0, 'count' => 0);
				$nilaiAgg[$k]['sum']   += (float) $j->nilai;
				$nilaiAgg[$k]['count']++;
			}

			$stamp = $j->updated_at ?: $j->created_at;
			if ($stamp && (!isset($lastUpdate[$k]) || $stamp > $lastUpdate[$k])) $lastUpdate[$k] = $stamp;
		}

		$result = array();
		foreach ($groups as $k => $g) {
			$permasalahanIds = isset($touched[$k]) ? array_unique($touched[$k]) : array();
			$totalSoal = 0; $terisi = 0; $dinilai = 0;

			foreach ($permasalahanIds as $pid) {
				if (empty($soalByPermasalahan[$pid])) continue;
				foreach ($soalByPermasalahan[$pid] as $sid) {
					$totalSoal++;
					if (!empty($perKelSoal[$k][$sid]['terisi']))  $terisi++;
					if (!empty($perKelSoal[$k][$sid]['dinilai'])) $dinilai++;
				}
			}

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
				'last_update'    => isset($lastUpdate[$k]) ? $lastUpdate[$k] : NULL,
			);
		}

		usort($result, function($a, $b) { return strnatcmp($a['no_kelompok'], $b['no_kelompok']); });

		return $result;
	}

	/**
	 * Daftar soal (dikelompokkan per pertemuan & tahap) untuk satu kelompok,
	 * lengkap dengan status "berapa siswa sudah menjawab / sudah dinilai".
	 */
	public function getSoalListByKelompok($no_kelompok) {
		$members = $this->getMembersByKelompok($no_kelompok);
		if (empty($members)) return array('members' => array(), 'soal' => array());
		$memberIds = array_map(function($m) { return (int) $m->id_user; }, $members);

		$this->db->select('se.id_permasalahan');
		$this->db->distinct();
		$this->db->from('tb_jawaban_essai je');
		$this->db->join('tb_soal_essai se', 'je.id_soal = se.id_soal_essai');
		$this->db->where_in('je.id_user', $memberIds);
		$permasalahanIds = array_map(function($r) { return (int) $r->id_permasalahan; }, $this->db->get()->result());

		if (empty($permasalahanIds)) return array('members' => $members, 'soal' => array());

		$this->db->select('se.id_soal_essai, se.no_soal, se.deksripsi_soal, se.id_permasalahan, pm.tahapan_pembelajaran, pm.judul_permasalahan, pt.no_pertemuan, pt.judul_pertemuan');
		$this->db->from('tb_soal_essai se');
		$this->db->join('tb_permasalahan pm', 'se.id_permasalahan = pm.id_permasalahan');
		$this->db->join('tb_pertemuan pt', 'pm.id_pertemuan = pt.id_pertemuan');
		$this->db->where_in('se.id_permasalahan', $permasalahanIds);
		$this->db->order_by('pt.no_pertemuan, pm.tahapan_pembelajaran, se.no_soal', 'ASC');
		$soalRows = $this->db->get()->result();

		$soalIds = array_map(function($s) { return $s->id_soal_essai; }, $soalRows);

		$this->db->select('id_soal, id_user, jawaban_text, jawaban_gambar, jawaban_file, nilai');
		$this->db->where_in('id_user', $memberIds);
		$this->db->where_in('id_soal', $soalIds);
		$jawabanRows = $this->db->get('tb_jawaban_essai')->result();

		$agg = array(); // [id_soal] = ['menjawab'=>[uid=>true], 'dinilai'=>[uid=>true], 'sum'=>x, 'count'=>y]
		foreach ($jawabanRows as $j) {
			if (!isset($agg[$j->id_soal])) $agg[$j->id_soal] = array('menjawab' => array(), 'dinilai' => array(), 'sum' => 0, 'count' => 0);
			$isFilled = ($j->jawaban_text !== NULL && $j->jawaban_text !== '') || $j->jawaban_gambar !== NULL || $j->jawaban_file !== NULL;
			if ($isFilled) $agg[$j->id_soal]['menjawab'][$j->id_user] = TRUE;
			if ($j->nilai !== NULL) {
				$agg[$j->id_soal]['dinilai'][$j->id_user] = TRUE;
				$agg[$j->id_soal]['sum']   += (float) $j->nilai;
				$agg[$j->id_soal]['count']++;
			}
		}

		$totalAnggota = count($members);
		$soal = array();
		foreach ($soalRows as $s) {
			$a = isset($agg[$s->id_soal_essai]) ? $agg[$s->id_soal_essai] : array('menjawab' => array(), 'dinilai' => array(), 'sum' => 0, 'count' => 0);
			$soal[] = array(
				'id_soal'              => $s->id_soal_essai,
				'no_soal'              => $s->no_soal,
				'deksripsi_soal'       => $s->deksripsi_soal,
				'tahapan_pembelajaran' => $s->tahapan_pembelajaran,
				'judul_permasalahan'   => $s->judul_permasalahan,
				'no_pertemuan'         => $s->no_pertemuan,
				'judul_pertemuan'      => $s->judul_pertemuan,
				'jumlah_menjawab'      => count($a['menjawab']),
				'jumlah_dinilai'       => count($a['dinilai']),
				'total_anggota'        => $totalAnggota,
				'rata_nilai'           => $a['count'] ? round($a['sum'] / $a['count'], 1) : NULL,
			);
		}

		return array('members' => $members, 'soal' => $soal);
	}

	/**
	 * Detail soal + jawaban masing-masing siswa dalam satu kelompok untuk satu soal.
	 */
	public function getJawabanPerSiswa($no_kelompok, $id_soal) {
		$this->db->select('se.id_soal_essai, se.no_soal, se.deksripsi_soal, se.tipe_jawaban, pm.tahapan_pembelajaran, pm.judul_permasalahan, pt.no_pertemuan, pt.judul_pertemuan');
		$this->db->from('tb_soal_essai se');
		$this->db->join('tb_permasalahan pm', 'se.id_permasalahan = pm.id_permasalahan');
		$this->db->join('tb_pertemuan pt', 'pm.id_pertemuan = pt.id_pertemuan');
		$this->db->where('se.id_soal_essai', $id_soal);
		$soal = $this->db->get()->row();
		if (!$soal) return NULL;

		$members = $this->getMembersByKelompok($no_kelompok);
		$memberIds = array_map(function($m) { return (int) $m->id_user; }, $members);

		$jawabanByUser = array();
		if (!empty($memberIds)) {
			$this->db->select('id_jawaban_essai, id_user, jawaban_text, jawaban_gambar, jawaban_file, nilai, feedback, created_at, updated_at');
			$this->db->where_in('id_user', $memberIds);
			$this->db->where('id_soal', $id_soal);
			foreach ($this->db->get('tb_jawaban_essai')->result() as $j) {
				$jawabanByUser[$j->id_user] = $j;
			}
		}

		$siswa = array();
		foreach ($members as $m) {
			$j = isset($jawabanByUser[$m->id_user]) ? $jawabanByUser[$m->id_user] : NULL;
			$siswa[] = array(
				'id_user'           => $m->id_user,
				'nama_lengkap'      => $m->nama_lengkap,
				'id_jawaban_essai'  => $j ? $j->id_jawaban_essai : NULL,
				'jawaban_text'      => $j ? $j->jawaban_text     : NULL,
				'jawaban_gambar'    => $j ? $j->jawaban_gambar   : NULL,
				'jawaban_file'      => $j ? $j->jawaban_file     : NULL,
				'nilai'             => $j ? $j->nilai            : NULL,
				'feedback'          => $j ? $j->feedback         : NULL,
				'created_at'        => $j ? $j->created_at       : NULL,
			);
		}

		return array('soal' => $soal, 'siswa' => $siswa);
	}

	/**
	 * Terapkan satu jawaban/nilai/feedback ke SEMUA anggota kelompok untuk satu soal.
	 * Anggota yang sudah punya baris -> update. Anggota yang belum -> insert baru,
	 * supaya nilai yang diisi dosen tetap tersimpan untuk seluruh anggota kelompok.
	 */
	public function bulkUpdateSoalForKelompok($no_kelompok, $id_soal, $data) {
		$members = $this->getMembersByKelompok($no_kelompok);
		if (empty($members)) return;
		$ids = array_map(function($m) { return $m->id_user; }, $members);

		$this->db->select('id_user');
		$this->db->where_in('id_user', $ids);
		$this->db->where('id_soal', $id_soal);
		$existingIds = array_map(function($r) { return $r->id_user; }, $this->db->get('tb_jawaban_essai')->result());

		if (!empty($existingIds)) {
			$this->db->where_in('id_user', $existingIds);
			$this->db->where('id_soal', $id_soal);
			$this->db->update('tb_jawaban_essai', $data);
		}

		$missingIds = array_diff($ids, $existingIds);
		foreach ($missingIds as $uid) {
			$this->db->insert('tb_jawaban_essai', array_merge($data, [
				'id_user'    => $uid,
				'id_soal'    => $id_soal,
				'created_at' => date('Y-m-d H:i:s'),
			]));
		}
	}

	public function hapusJawaban($id) {
		$this->db->where('id_jawaban_essai', $id);
		$this->db->delete('tb_jawaban_essai');
	}
}
