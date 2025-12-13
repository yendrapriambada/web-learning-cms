<?php
	class M_type_form extends CI_Model{
        
		public function getRecords(){
			$query = $this->db->get('tb_type_form');
			return $query->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_type_form',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_type_form',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_type_form",$id);
			$this->db->update("tb_type_form",$data);
		}

		public function tampil_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_type_form",$id);
			$data = $this->db->get("tb_type_form")->row();
			return $data;
		}
	}
?>