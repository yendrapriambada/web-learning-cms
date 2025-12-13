<?php
	class M_test_unity extends CI_Model{
        
		public function getRecordsTable(){
			$query = $this->db->get('tb_test_unity');
			return $query->result();
		}

        public function getRecordsView(){
			$query = $this->db->get('v_test_unity');
			return $query->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_test_unity',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_test_unity',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_test_unity",$id);
			$this->db->update("tb_test_unity",$data);
		}

		public function tampil_view_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_test_unity",$id);
			$data = $this->db->get("v_test_unity")->row();
			return $data;
		}
	}
?>