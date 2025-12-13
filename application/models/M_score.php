<?php
	class M_score extends CI_Model{
        
		public function getRecordsTable(){
			$query = $this->db->get('tb_score');
			return $query->result();
		}

        public function getRecordsView(){
			$query = $this->db->get('v_score');
			return $query->result();
		}

		public function getRecordsViewWorksheet(){
			$query = $this->db->get('v_nilai_worksheet');
			return $query->result();
		}

		public function getRecordsViewWorksheetTahapan(){
			$query = $this->db->get('v_nilai_worksheet_tahapan');
			return $query->result();
		}

		public function getRecordsViewTotalScore(){
			$query = $this->db->get('v_total_score');
			return $query->result();
		}

		public function getRecordsViewTotalScore2(){
			$query = $this->db->get('v_total_score_2');
			return $query->result();
		}

		public function tambahdata($data){
			$tambah = $this->db->insert('tb_score',$data);
			return $tambah;
		}

		public function hapusdata($where)
		{	
			$hapus = $this->db->delete('tb_score',$where);
			return $hapus;
		}

        function update($id,$data){
			$this->db->where("id_score",$id);
			$this->db->update("tb_score",$data);
		}

		public function tampil_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_score",$id);
			$data = $this->db->get("tb_score")->row();
			return $data;
		}

		public function tampil_view_by_id($id)
		{
			$this->db->select("*");
			$this->db->where("id_user",$id);
			$data = $this->db->get("v_score");
			return $data->result();
		}
	}
?>