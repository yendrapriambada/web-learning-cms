<?php
	class M_user extends CI_Model{
        
		public function getRecordsTable(){
			$query = $this->db->get('tb_user');
			return $query->result();
		}

        public function getRecordsView(){
			$query = $this->db->get('v_user');
			return $query->result();
		}

		public function getRecordsViewSiswa(){
			$this->db->select("*");
			$this->db->where("id_role_user",1);
			$data = $this->db->get("v_user");
			return $data->result();
		}

		public function getRecordsViewGuru(){
			$this->db->select("*");
			$this->db->where("id_role_user",2);
			$data = $this->db->get("v_user");
			return $data->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_user',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_user',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_user",$id);
			$this->db->update("tb_user",$data);
		}

		public function tampil_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_user",$id);
			$data = $this->db->get("tb_user")->row();
			return $data;
		}

		public function tampil_view_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_user",$id);
			$data = $this->db->get("v_user")->row();
			return $data;
		}
	}
?>