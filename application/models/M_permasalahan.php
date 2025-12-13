<?php
	class M_permasalahan extends CI_Model{
        
		public function getRecordsTable(){
			$query = $this->db->get('tb_permasalahan');
			return $query->result();
		}

        public function getRecordsView(){
			$query = $this->db->get('v_permasalahan');
			return $query->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_permasalahan',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_permasalahan',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_permasalahan",$id);
			$this->db->update("tb_permasalahan",$data);
		}

		public function tampil_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_permasalahan",$id);
			$data = $this->db->get("tb_permasalahan")->row();
			return $data;
		}

		public function tampil_view_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_permasalahan",$id);
			$data = $this->db->get("v_permasalahan")->row();
			return $data;
		}

		public function tampil_view_by_id_pertemuan($id)
		{
			$this->db->select("*");
			$this->db->where("id_pertemuan",$id);
			$data = $this->db->get("v_permasalahan");
			return $data->result();
		}
	}
?>