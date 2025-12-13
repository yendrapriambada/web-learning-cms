<?php
	class M_diskusi extends CI_Model{
        
		public function getRecordsTable(){
			$query = $this->db->get('tb_diskusi');
			return $query->result();
		}

        public function getRecordsView(){
			$query = $this->db->get('v_diskusi');
			return $query->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_diskusi',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_diskusi',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_diskusi",$id);
			$this->db->update("tb_diskusi",$data);
		}

		public function tampil_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_diskusi",$id);
			$data = $this->db->get("tb_diskusi")->row();
			return $data;
		}

		public function tampil_view_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_diskusi",$id);
			$data = $this->db->get("v_diskusi")->row();
			return $data;
		}

		public function tampil_view_by_id_pertemuan($id)
		{
			$this->db->select("*");
			$this->db->where("id_pertemuan",$id);
			$data = $this->db->get("v_diskusi");
			return $data->result();
		}

        public function getRecordsViewSrotByCreatedAt(){
			$this->db->order_by('created_at', 'ASC');
			$query = $this->db->get('v_diskusi');
			return $query->result();
		}

		public function tampil_view_by_id_pertemuan_sort($id)
		{
			$this->db->select("*");
			$this->db->where("id_pertemuan",$id);
			$this->db->order_by('created_at', 'ASC');
			$data = $this->db->get("v_diskusi");
			return $data->result();
		}
	}
?>