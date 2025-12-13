<?php
	class M_soal_essai extends CI_Model{
        
		public function getRecordsTable(){
			$query = $this->db->get('tb_soal_essai');
			return $query->result();
		}

        public function getRecordsView(){
			$query = $this->db->get('v_soal_essai');
			return $query->result();
		}

		public function getRecordsViewSrotByNo(){
			$this->db->order_by('no_soal', 'ASC');
			$query = $this->db->get('v_soal_essai');
			return $query->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_soal_essai',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_soal_essai',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_soal_essai",$id);
			$this->db->update("tb_soal_essai",$data);
		}

		public function tampil_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_soal_essai",$id);
			$data = $this->db->get("tb_soal_essai")->row();
			return $data;
		}

		public function tampil_view_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_soal_essai",$id);
			$data = $this->db->get("v_soal_essai")->row();
			return $data;
		}

		public function tampil_by_id_permasalahan($id)
		{
			$this->db->select("*");
			$this->db->where("id_permasalahan",$id);
			$data = $this->db->get("tb_soal_essai");
			return $data->result();
		}
		
		public function tampil_view_by_id_permasalahan($id)
		{
			$this->db->select("*");
			$this->db->where("id_permasalahan",$id);
			$data = $this->db->get("v_soal_essai");
			return $data->result();
		}

		public function tampil_view_by_id_pertemuan($id)
		{
			$this->db->select("*");
			$this->db->where("id_pertemuan",$id);
			$data = $this->db->get("v_soal_essai");
			return $data->result();
		}
	}
?>