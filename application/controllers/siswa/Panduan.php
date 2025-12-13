<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panduan extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model("M_score","", TRUE);
        $this->load->model("M_jawaban_essai","", TRUE);
		$this->load->model("M_pertemuan","",TRUE);
	}

	public function index()
	{
        $data['pertemuan'] = $this->M_pertemuan->getRecordsView();
		$data['score'] = $this->M_score->tampil_view_by_id($this->session->userdata('id_user'));
		$data['jawabanEssai'] = $this->M_jawaban_essai->tampil_view_by_id_user($this->session->userdata('id_user'));
		$this->load->view('siswa/v_panduan',$data);
	}
}
