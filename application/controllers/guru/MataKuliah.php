<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MataKuliah extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}
			
		$this->load->library('form_validation');
		$this->load->model("M_mata_kuliah","",TRUE);
	}

	public function index()
	{
		$data['data']=$this->M_mata_kuliah->getRecords();
		$this->load->view('guru/mata_kuliah/v_mata_kuliah',$data);
	}

	public function create()
	{
		$this->load->view('guru/mata_kuliah/v_create_mata_kuliah');
	}

	public function do_create()
	{
		if($this->validate() != false){

            $this->form_validation->set_error_delimiters();
            $data = array(
					'nama_mata_kuliah'	 	    => $this->input->post('nama_mata_kuliah'),
                    'kode_mata_kuliah'	 	    => $this->input->post('kode_mata_kuliah'),
                    'program_studi'	            => $this->input->post('program_studi'),
                    'bobot_sks'	 	            => $this->input->post('bobot_sks'),
                    'jenjang'	 	            => $this->input->post('jenjang'),
                    'semester'	 	            => $this->input->post('semester'),
                    'status'	                => $this->input->post('status'),
                    'deskripsi_mata_kuliah'	 	=> $this->input->post('deskripsi_mata_kuliah'),
                    'cpl'	 	                => $this->input->post('cpl'),
                    'cpmk'	                    => $this->input->post('cpmk'),
                    'link_rps'	 	            => $this->input->post('link_rps'),
					'link_modul'	 	        => $this->input->post('link_modul'),
					'created_at' 	            => date('Y-m-d H:i:s')
			);
            
            $this->M_mata_kuliah->tambahdata($data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di tambahkan');
            redirect('guru/MataKuliah');
		}else{
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$this->load->view('guru/mata_kuliah/v_create_mata_kuliah',);
			$this->form_validation->set_message('insert');
		}
	}

	public function delete($id)
	{	
		$cekData = $this->db->get_where('tb_alur_pembelajaran', array(//making selection
			'id_mata_kuliah' => $id
		));

		if ($cekData->num_rows() > 0) {
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('alert', 'Pertemuan terkait tidak dapat dihapus, karena sedang digunakan pada tabel lainnya');
			redirect('guru/MataKuliah');
		}
		else {
			$where = array('id_mata_kuliah' => $id );
			$hapus = $this->M_mata_kuliah->hapusdata($where);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
			$this->session->set_flashdata('alert', 'Data Berhasil di hapus');
			redirect('guru/MataKuliah');
		}
	}

	public function edit($id)
	{
		$data['dataById']=$this->M_mata_kuliah->tampil_by_id($id);
		$this->load->view('guru/mata_kuliah/v_edit_mata_kuliah',$data);
	}

	function do_edit()
	{
		$id = $this->input->post('id_mata_kuliah');
		if($this->validate() != false){
			$this->form_validation->set_error_delimiters();
			$data = array(
                'nama_mata_kuliah'	 	    => $this->input->post('nama_mata_kuliah'),
                'kode_mata_kuliah'	 	    => $this->input->post('kode_mata_kuliah'),
                'program_studi'	            => $this->input->post('program_studi'),
                'bobot_sks'	 	            => $this->input->post('bobot_sks'),
                'jenjang'	 	            => $this->input->post('jenjang'),
                'semester'	 	            => $this->input->post('semester'),
                'status'	                => $this->input->post('status'),
                'deskripsi_mata_kuliah'	 	=> $this->input->post('deskripsi_mata_kuliah'),
                'cpl'	 	                => $this->input->post('cpl'),
                'cpmk'	                    => $this->input->post('cpmk'),
                'link_rps'	 	            => $this->input->post('link_rps'),
				'link_modul'	 	        => $this->input->post('link_modul'),
				'updated_at'		        =>date('Y-m-d H:i:s')
			);

			$this->M_mata_kuliah->update($id, $data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di ubah');
			redirect("guru/MataKuliah");
		}
		else {
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$data['dataById']=$this->M_mata_kuliah->tampil_by_id($id);
			$this->load->view('guru/mata_kuliah/v_edit_mata_kuliah',$data);
			$this->form_validation->set_message('insert');
		}
	}

	public function validate(){
		$this->form_validation->set_rules('nama_mata_kuliah','Nama Mata Kuliah','required');
        $this->form_validation->set_rules('kode_mata_kuliah','Kode Mata Kuliah','required');
        $this->form_validation->set_rules('program_studi','Program Studi','required');
        $this->form_validation->set_rules('bobot_sks','Bobot SKS Mata Kuliah','required');
        $this->form_validation->set_rules('jenjang','Jenjang Mata Kuliah','required');
        $this->form_validation->set_rules('semester','Semester Mata Kuliah','required');
        $this->form_validation->set_rules('status','Status Mata Kuliah','required');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}
}
?>