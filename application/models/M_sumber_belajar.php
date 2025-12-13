<?php
	class M_sumber_belajar extends CI_Model{
        
		public function getRecords(){
			$query = $this->db->get('tb_sumber_belajar');
			return $query->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_sumber_belajar',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_sumber_belajar',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_sumber_belajar",$id);
			$this->db->update("tb_sumber_belajar",$data);
		}

		public function tampil_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_sumber_belajar",$id);
			$data = $this->db->get("tb_sumber_belajar")->row();
			return $data;
		}
	}
?>