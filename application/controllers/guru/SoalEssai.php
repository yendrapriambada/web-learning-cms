<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SoalEssai extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}
			
		$this->load->library('form_validation');
		$this->load->model("M_soal_essai","",TRUE);
        $this->load->model("M_type_form","",TRUE);
        $this->load->model("M_permasalahan","",TRUE);
	}

	public function index()
	{
		$data['data']=$this->M_soal_essai->getRecordsView();
		$this->load->view('guru/soal_essai/v_soal_essai',$data);
	}

	public function create()
	{
        $data['permasalahan']=$this->M_permasalahan->getRecordsView();
        $data['type_form'] = $this->M_type_form->getRecords();
		$this->load->view('guru/soal_essai/v_create_soal_essai', $data);
	}

	public function do_create()
	{
		if($this->validate() != false){

            $this->form_validation->set_error_delimiters();
            $data = array(
                    'id_permasalahan'	=> $this->input->post('id_permasalahan'),
					'no_soal'	 	    => $this->input->post('no_soal'),
                    'tipe_jawaban'	 	=> $this->input->post('tipe_jawaban'),
                    'deksripsi_soal'	=> $this->input->post('deksripsi_soal'),
					'created_at' 	    => date('Y-m-d H:i:s')
			);
            
            $this->M_soal_essai->tambahdata($data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di tambahkan');
            redirect('guru/SoalEssai');
		}else{
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
            $data['permasalahan']=$this->M_permasalahan->getRecordsView();
            $data['type_form'] = $this->M_type_form->getRecords();
			$this->load->view('guru/soal_essai/v_create_soal_essai',$data);
			$this->form_validation->set_message('insert');
		}
	}

	public function delete($id)
	{	
		$cekData = $this->db->get_where('tb_jawaban_essai', array(//making selection
			'id_soal' => $id
		));

		if ($cekData->num_rows() > 0 ) {
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('alert', 'Soal terkait tidak dapat dihapus, karena sedang digunakan pada tabel lainnya');
			redirect('guru/SoalEssai');
		}
		else {
			$where = array('id_soal_essai' => $id );
			$hapus = $this->M_soal_essai->hapusdata($where);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
			$this->session->set_flashdata('alert', 'Data Berhasil di hapus');
			redirect('guru/SoalEssai');
		}
	}

	public function edit($id)
	{
        $data['permasalahan']=$this->M_permasalahan->getRecordsView();
        $data['type_form'] = $this->M_type_form->getRecords();
		$data['dataById']=$this->M_soal_essai->tampil_view_by_id($id);
		$this->load->view('guru/soal_essai/v_edit_soal_essai',$data);
	}

	function do_edit()
	{
		$id = $this->input->post('id_soal_essai');

		if($this->validate() != false){
			$this->form_validation->set_error_delimiters();
			$data = array(
                'id_permasalahan'	=> $this->input->post('id_permasalahan'),
                'no_soal'	 	    => $this->input->post('no_soal'),
                'tipe_jawaban'	 	=> $this->input->post('tipe_jawaban'),
                'deksripsi_soal'	=> $this->input->post('deksripsi_soal'),
				'updated_at'		    =>date('Y-m-d H:i:s')
			);

			$this->M_soal_essai->update($id, $data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di ubah');
			redirect("guru/SoalEssai");
		}
		else {
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
            $data['permasalahan']=$this->M_permasalahan->getRecordsView();
            $data['type_form'] = $this->M_type_form->getRecords();
			$data['dataById']=$this->M_soal_essai->tampil_view_by_id($id);
			$this->load->view('guru/soal_essai/v_edit_soal_essai',$data);
			$this->form_validation->set_message('insert');
		}
	}

	public function validate(){
		$this->form_validation->set_rules('no_soal','Nomor Soal','required');
        $this->form_validation->set_rules('tipe_jawaban','Tipe Jawaban','required');
        $this->form_validation->set_rules('deksripsi_soal','Deskripsi Soal Keaktifan Pertemuan','required');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}
}
?>