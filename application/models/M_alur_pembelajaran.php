<?php
	class M_alur_pembelajaran extends CI_Model{
        
		public function getRecordsTable(){
			$query = $this->db->get('tb_alur_pembelajaran');
			return $query->result();
		}

        public function getRecordsView(){
			$query = $this->db->get('v_alur_pembelajaran');
			return $query->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_alur_pembelajaran',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_alur_pembelajaran',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_alur_pembelajaran",$id);
			$this->db->update("tb_alur_pembelajaran",$data);
		}

		public function tampil_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_alur_pembelajaran",$id);
			$data = $this->db->get("tb_alur_pembelajaran")->row();
			return $data;
		}

		public function tampil_view_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_alur_pembelajaran",$id);
			$data = $this->db->get("v_alur_pembelajaran")->row();
			return $data;
		}

		public function tampil_view_by_id_sorted_by_pertemuan() {
			$this->db->order_by('no_pertemuan', 'ASC');
			$query = $this->db->get('v_alur_pembelajaran');
			return $query->result();
		}
	}
?>