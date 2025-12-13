<?php
	class M_tema_proyek extends CI_Model{
        
		public function getRecords(){
			$query = $this->db->get('tb_tema_proyek');
			return $query->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_tema_proyek',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_tema_proyek',$where);
			return $hapus;
		}

        public function update($id,$data){
			$this->db->where("id_tema_proyek",$id);
			$this->db->update("tb_tema_proyek",$data);
		}

		public function tampil_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_tema_proyek",$id);
			$data = $this->db->get("tb_tema_proyek")->row();
			return $data;
		}
	}
?>