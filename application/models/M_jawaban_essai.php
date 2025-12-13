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