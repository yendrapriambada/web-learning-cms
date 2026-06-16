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
			$this->db->select('je.id_soal, je.jawaban_text, je.jawaban_gambar, je.jawaban_file, je.nilai, je.feedback, se.no_soal, se.deksripsi_soal, pm.tahapan_pembelajaran, pm.judul_permasalahan, pt.no_pertemuan, pt.judul_pertemuan');
			$this->db->from('tb_jawaban_essai je');
			$this->db->join('tb_user u', 'je.id_user = u.id_user');
			$this->db->join('tb_soal_essai se', 'je.id_soal = se.id_soal_essai');
			$this->db->join('tb_permasalahan pm', 'se.id_permasalahan = pm.id_permasalahan');
			$this->db->join('tb_pertemuan pt', 'pm.id_pertemuan = pt.id_pertemuan');
			$this->db->where('u.no_kelompok', $no_kelompok);
			$this->db->group_by('je.id_soal');
			$this->db->order_by('pt.no_pertemuan, pm.tahapan_pembelajaran, se.no_soal', 'ASC');
			return $this->db->get()->result();
		}

		public function getMembersByKelompok($no_kelompok) {
			$this->db->select('id_user, nama_lengkap');
			$this->db->where('no_kelompok', $no_kelompok);
			$this->db->where('id_role_user', 1);
			return $this->db->get('tb_user')->result();
		}

		public function updateBulkByKelompokAndSoal($no_kelompok, $id_soal, $nilai, $feedback) {
			$members = $this->getMembersByKelompok($no_kelompok);
			if (empty($members)) return;
			$ids = array_map(function($m) { return $m->id_user; }, $members);
			$this->db->where_in('id_user', $ids);
			$this->db->where('id_soal', $id_soal);
			$this->db->update('tb_jawaban_essai', [
				'nilai'      => $nilai,
				'feedback'   => $feedback,
				'updated_at' => date('Y-m-d H:i:s'),
			]);
		}

		private function _applyFilters($filters) {
			if (!empty($filters['nama_lengkap']))       $this->db->where('nama_lengkap', $filters['nama_lengkap']);
			if (!empty($filters['no_kelompok']))        $this->db->where('no_kelompok', $filters['no_kelompok']);
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