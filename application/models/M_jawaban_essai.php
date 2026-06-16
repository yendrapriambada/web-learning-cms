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