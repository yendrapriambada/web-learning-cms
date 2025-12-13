<?php
	class M_pertemuan extends CI_Model{
        
		public function getRecords(){
			$query = $this->db->get('tb_pertemuan');
			return $query->result();
		}
		
		public function getRecordsView(){
			$query = $this->db->get('v_pertemuan');
			return $query->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_pertemuan',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_pertemuan',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_pertemuan",$id);
			$this->db->update("tb_pertemuan",$data);
		}

		public function tampil_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_pertemuan",$id);
			$data = $this->db->get("tb_pertemuan")->row();
			return $data;
		}
		
		public function tampil_view_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_pertemuan",$id);
			$data = $this->db->get("v_pertemuan")->row();
			return $data;
		}
	}
?>