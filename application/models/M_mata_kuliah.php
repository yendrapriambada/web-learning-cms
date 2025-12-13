<?php
	class M_mata_kuliah extends CI_Model{
        
		public function getRecords(){
			$query = $this->db->get('tb_mata_kuliah');
			return $query->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_mata_kuliah',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_mata_kuliah',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_mata_kuliah",$id);
			$this->db->update("tb_mata_kuliah",$data);
		}

		public function tampil_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_mata_kuliah",$id);
			$data = $this->db->get("tb_mata_kuliah")->row();
			return $data;
		}
	}
?>