<?php
	class M_jawaban_essai extends CI_Model{
        
		public function getRecordsTable(){
			$query = $this->db->get('tb_jawaban_essai');
			return $query->result();
		}

        public function getRecordsView(){
			$query = $this->db->get('v_jawaban_essai');
			return $query->result();
		}

		public function getRecordsPaginated($limit, $offset, $filters = array()) {
			$this->_applyFilters($filters);
			$this->db->limit($limit, $offset);
			return $this->db->get('v_jawaban_essai')->result();
		}

		public function getRecordsCount($filters = array()) {
			$this->_applyFilters($filters);
			return $this->db->count_all_results('v_jawaban_essai');
		}

		public function getDistinctValues($column) {
			$this->db->select($column);
			$this->db->distinct();
			$this->db->order_by($column, 'ASC');
			return $this->db->get('v_jawaban_essai')->result();
		}

		public function getKelompokList() {
			$this->db->select('u.no_kelompok');
			$this->db->distinct();
			$this->db->from('tb_jawaban_essai je');
			$this->db->join('tb_user u', 'je.id_user = u.id_user');
			$this->db->where('u.no_kelompok IS NOT NULL');
			$this->db->order_by('u.no_kelompok', 'ASC');
			return $this->db->get()->result();
		}

		public function getByKelompokGroupedBySoal($no_kelompok) {
			// Cari permasalahan (worksheet) yang sudah pernah disentuh oleh kelompok ini,
			// lalu tampilkan SEMUA soal dari permasalahan tersebut -- termasuk soal yang
			// belum ada jawabannya (misal soal baru ditambahkan setelah siswa submit),
			// supaya dosen tetap bisa input jawaban/nilai manual lewat bulk edit.
			$this->db->select('se.id_permasalahan');
			$this->db->distinct();
			$this->db->from('tb_jawaban_essai je');
			$this->db->join('tb_user u', 'je.id_user = u.id_user');
			$this->db->join('tb_soal_essai se', 'je.id_soal = se.id_soal_essai');
			$this->db->where('u.no_kelompok', $no_kelompok);
			$permasalahanIds = array_map(function($r) { return (int) $r->id_permasalahan; }, $this->db->get()->result());

			if (empty($permasalahanIds)) return array();

			$memberIds = array_map(function($m) { return (int) $m->id_user; }, $this->getMembersByKelompok($no_kelompok));

			$this->db->select('se.id_soal_essai AS id_soal, je.jawaban_text, je.jawaban_gambar, je.jawaban_file, je.nilai, je.feedback, se.no_soal, se.deksripsi_soal, pm.tahapan_pembelajaran, pm.judul_permasalahan, pt.no_pertemuan, pt.judul_pertemuan');
			$this->db->from('tb_soal_essai se');
			$this->db->join('tb_permasalahan pm', 'se.id_permasalahan = pm.id_permasalahan');
			$this->db->join('tb_pertemuan pt', 'pm.id_pertemuan = pt.id_pertemuan');
			if (!empty($memberIds)) {
				$this->db->join('tb_jawaban_essai je', 'je.id_soal = se.id_soal_essai AND je.id_user IN (' . implode(',', $memberIds) . ')', 'left');
			} else {
				$this->db->join('tb_jawaban_essai je', 'je.id_soal = se.id_soal_essai AND 1 = 0', 'left');
			}
			$this->db->where_in('se.id_permasalahan', $permasalahanIds);
			$this->db->group_by('se.id_soal_essai');
			$this->db->order_by('pt.no_pertemuan, pm.tahapan_pembelajaran, se.no_soal', 'ASC');
			return $this->db->get()->result();
		}

		public function getMembersByKelompok($no_kelompok) {
			$this->db->select('id_user, nama_lengkap');
			$this->db->where('no_kelompok', $no_kelompok);
			$this->db->where('id_role_user', 1);
			return $this->db->get('tb_user')->result();
		}

		/**
		 * Ringkasan per kelompok untuk tampilan card: jumlah anggota, jumlah soal
		 * yang sudah tersentuh jawaban, rata-rata nilai, dan aktivitas terakhir.
		 */
		public function getKelompokSummary($filters = array()) {
			$this->db->select("u.no_kelompok, COUNT(DISTINCT u.id_user) AS jumlah_anggota, MAX(u.angkatan) AS angkatan, COUNT(DISTINCT je.id_soal) AS jumlah_soal_terjawab, AVG(je.nilai) AS rata_nilai, MAX(je.updated_at) AS last_update", FALSE);
			$this->db->from('tb_user u');
			$this->db->join('tb_jawaban_essai je', 'je.id_user = u.id_user', 'left');
			$this->db->where('u.id_role_user', 1);
			$this->db->where('u.no_kelompok IS NOT NULL');
			$this->db->where('u.no_kelompok !=', '');
			if (!empty($filters['no_kelompok'])) $this->db->like('u.no_kelompok', $filters['no_kelompok']);
			if (!empty($filters['angkatan']))    $this->db->where('u.angkatan', $filters['angkatan']);
			$this->db->group_by('u.no_kelompok');
			$this->db->order_by('u.no_kelompok', 'ASC');
			return $this->db->get()->result();
		}

		public function getDistinctAngkatanForKelompok() {
			$this->db->select('angkatan');
			$this->db->distinct();
			$this->db->where('id_role_user', 1);
			$this->db->where('no_kelompok IS NOT NULL');
			$this->db->where('no_kelompok !=', '');
			$this->db->order_by('angkatan', 'ASC');
			return $this->db->get('tb_user')->result();
		}

		/**
		 * Daftar soal untuk sebuah kelompok beserta statistik pengerjaan
		 * (berapa anggota sudah menjawab & rata-rata nilai), dipakai untuk
		 * tampilan drill-down kelompok -> soal.
		 */
		public function getSoalSummaryByKelompok($no_kelompok) {
			$this->db->select('se.id_permasalahan');
			$this->db->distinct();
			$this->db->from('tb_jawaban_essai je');
			$this->db->join('tb_user u', 'je.id_user = u.id_user');
			$this->db->join('tb_soal_essai se', 'je.id_soal = se.id_soal_essai');
			$this->db->where('u.no_kelompok', $no_kelompok);
			$permasalahanIds = array_map(function($r) { return (int) $r->id_permasalahan; }, $this->db->get()->result());

			if (empty($permasalahanIds)) return array();

			$memberIds = array_map(function($m) { return (int) $m->id_user; }, $this->getMembersByKelompok($no_kelompok));

			$this->db->select('se.id_soal_essai AS id_soal, se.no_soal, se.deksripsi_soal, pm.tahapan_pembelajaran, pm.judul_permasalahan, pt.no_pertemuan, pt.judul_pertemuan, COUNT(DISTINCT je.id_user) AS jumlah_terjawab, AVG(je.nilai) AS rata_nilai, MAX(je.updated_at) AS last_update', FALSE);
			$this->db->from('tb_soal_essai se');
			$this->db->join('tb_permasalahan pm', 'se.id_permasalahan = pm.id_permasalahan');
			$this->db->join('tb_pertemuan pt', 'pm.id_pertemuan = pt.id_pertemuan');
			if (!empty($memberIds)) {
				$this->db->join('tb_jawaban_essai je', 'je.id_soal = se.id_soal_essai AND je.id_user IN (' . implode(',', $memberIds) . ')', 'left');
			} else {
				$this->db->join('tb_jawaban_essai je', 'je.id_soal = se.id_soal_essai AND 1 = 0', 'left');
			}
			$this->db->where_in('se.id_permasalahan', $permasalahanIds);
			$this->db->group_by('se.id_soal_essai');
			$this->db->order_by('pt.no_pertemuan, pm.tahapan_pembelajaran, se.no_soal', 'ASC');
			return $this->db->get()->result();
		}

		public function getSoalDetail($id_soal) {
			$this->db->select('se.id_soal_essai AS id_soal, se.no_soal, se.deksripsi_soal, pm.tahapan_pembelajaran, pm.judul_permasalahan, pt.no_pertemuan, pt.judul_pertemuan');
			$this->db->from('tb_soal_essai se');
			$this->db->join('tb_permasalahan pm', 'se.id_permasalahan = pm.id_permasalahan');
			$this->db->join('tb_pertemuan pt', 'pm.id_pertemuan = pt.id_pertemuan');
			$this->db->where('se.id_soal_essai', $id_soal);
			return $this->db->get()->row();
		}

		/**
		 * Jawaban tiap anggota kelompok untuk satu soal spesifik (drill-down
		 * kelompok -> soal -> per mahasiswa). Anggota yang belum menjawab tetap
		 * tampil dengan kolom jawaban kosong (LEFT JOIN).
		 */
		public function getJawabanPerSiswaBySoal($no_kelompok, $id_soal) {
			$members = $this->getMembersByKelompok($no_kelompok);
			if (empty($members)) return array();
			$ids = array_map(function($m) { return (int) $m->id_user; }, $members);

			$this->db->select('u.id_user, u.nama_lengkap, je.id_jawaban_essai, je.jawaban_text, je.jawaban_gambar, je.jawaban_file, je.nilai, je.feedback, je.created_at, je.updated_at');
			$this->db->from('tb_user u');
			$this->db->join('tb_jawaban_essai je', 'je.id_user = u.id_user AND je.id_soal = ' . (int) $id_soal, 'left');
			$this->db->where_in('u.id_user', $ids);
			$this->db->order_by('u.nama_lengkap', 'ASC');
			return $this->db->get()->result();
		}

		public function updateBulkByKelompokAndSoal($no_kelompok, $id_soal, $nilai, $feedback, $jawaban_text = NULL, $jawaban_gambar = NULL, $jawaban_file = NULL) {
			$members = $this->getMembersByKelompok($no_kelompok);
			if (empty($members)) return;
			$ids = array_map(function($m) { return $m->id_user; }, $members);

			$data = [
				'nilai'      => $nilai,
				'feedback'   => $feedback,
				'updated_at' => date('Y-m-d H:i:s'),
			];
			if ($jawaban_text !== NULL)   $data['jawaban_text']   = $jawaban_text;
			if ($jawaban_gambar !== NULL) $data['jawaban_gambar'] = $jawaban_gambar;
			if ($jawaban_file !== NULL)   $data['jawaban_file']   = $jawaban_file;

			// Anggota yang sudah punya baris jawaban untuk soal ini -> update.
			// Anggota yang belum (misal soal baru ditambahkan setelah mereka submit) -> insert baru,
			// supaya jawaban/nilai yang diisi dosen lewat bulk edit tetap tersimpan untuk semua anggota.
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

		private function _applyFilters($filters) {
			if (!empty($filters['nama_lengkap']))       $this->db->where('nama_lengkap', $filters['nama_lengkap']);
			if (!empty($filters['no_kelompok']))        $this->db->where('no_kelompok', $filters['no_kelompok']);
			if (!empty($filters['angkatan']))           $this->db->where('angkatan', $filters['angkatan']);
			if (!empty($filters['no_pertemuan']))       $this->db->where('no_pertemuan', $filters['no_pertemuan']);
			if (!empty($filters['tahapan_pembelajaran'])) $this->db->where('tahapan_pembelajaran', $filters['tahapan_pembelajaran']);
			if (!empty($filters['no_soal']))            $this->db->where('no_soal', $filters['no_soal']);
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_jawaban_essai',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_jawaban_essai',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_jawaban_essai",$id);
			$this->db->update("tb_jawaban_essai",$data);
		}

		function updateByIdSoal($id,$data){
			$this->db->where("id_soal",$id);
			$this->db->update("tb_jawaban_essai",$data);
		}

		public function tampil_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_jawaban_essai",$id);
			$data = $this->db->get("tb_jawaban_essai")->row();
			return $data;
		}

		public function tampil_view_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_jawaban_essai",$id);
			$data = $this->db->get("v_jawaban_essai")->row();
			return $data;
		}

		public function tampil_view_by_id_permasalahan($id)
		{
			$this->db->select("*");
			$this->db->where("id_permasalahan",$id);
			$data = $this->db->get("v_jawaban_essai");
			return $data->result();
		}

		public function tampil_view_by_id_user($id)
		{
			$this->db->select("*");
			$this->db->where("id_user",$id);
			$data = $this->db->get("v_jawaban_essai");
			return $data->result();
		}
	}
?>