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

		public function getByKelompok($no_kelompok) {
			$this->db->select('tu.id_test_unity, tu.id_user, tu.indikator_soal, tu.practice, tu.pertanyaan, tu.jawaban, tu.nilai, tu.feedback, u.nama_lengkap, u.no_kelompok');
			$this->db->from('tb_test_unity tu');
			$this->db->join('tb_user u', 'tu.id_user = u.id_user');
			$this->db->where('u.no_kelompok', $no_kelompok);
			$this->db->order_by('tu.practice, tu.pertanyaan', 'ASC');
			return $this->db->get()->result();
		}

		public function updateBulkByIds($ids, $nilai, $feedback) {
			if (empty($ids)) return;
			$this->db->where_in('id_test_unity', $ids);
			$this->db->update('tb_test_unity', [
				'nilai'    => $nilai,
				'feedback' => $feedback,
			]);
		}
	}
?>