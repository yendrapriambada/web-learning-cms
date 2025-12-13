<?php
	class M_role_user extends CI_Model{
        
		public function getRecords(){
			$query = $this->db->get('tb_role_user');
			return $query->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_role_user',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_role_user',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_role_user",$id);
			$this->db->update("tb_role_user",$data);
		}

		public function tampil_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_role_user",$id);
			$data = $this->db->get("tb_role_user")->row();
			return $data;
		}
	}
?>