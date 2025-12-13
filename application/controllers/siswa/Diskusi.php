<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskusi extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
			
		$this->load->library('form_validation');
        $this->load->model("M_user","",TRUE);
		$this->load->model("M_pertemuan","",TRUE);
        $this->load->model("M_diskusi","",TRUE);
	}

	public function komentar($idPertemuan)
	{
        $data['pertemuan'] = $this->M_pertemuan->getRecordsView();
        $data['pertemuanById']=$this->M_pertemuan->tampil_view_by_id($idPertemuan);
		$data['dataByPertemuan']=$this->M_diskusi->tampil_view_by_id_pertemuan_sort($idPertemuan);
		$this->load->view('siswa/v_diskusi',$data);
	}

    public function do_create_review()
	{
		if($this->validate() != false){
            $idPertemuan = $this->input->post('id_pertemuan');
            $this->form_validation->set_error_delimiters();
            $data = array(
					'id_user'	 	  => $this->session->userdata('id_user'),
                    'id_pertemuan'	  => $idPertemuan,
                    'komentar'	      => $this->input->post('komentar'),
					'created_at' 	  => date('Y-m-d H:i:s')
			);
            
            $this->M_diskusi->tambahdata($data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di tambahkan');
            redirect('siswa/Diskusi/komentar/'.$idPertemuan);
		}else{
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			redirect('siswa/Diskusi/komentar/'.$idPertemuan);
			$this->form_validation->set_message('insert');
		}
	}

	public function validate(){
        $this->form_validation->set_rules('id_pertemuan','ID Pertemuan','required');
        $this->form_validation->set_rules('komentar','Komentar','required');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}
}
?>