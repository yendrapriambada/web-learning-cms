<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertemuan extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }

        $this->load->model("M_permasalahan","", TRUE);
        $this->load->model("M_soal_essai","", TRUE);
		$this->load->model("M_pertemuan","",TRUE);
	}

	public function worksheet($id_pertemuan)
	{
		$data['pertemuan'] = $this->M_pertemuan->getRecordsView();
        $data['pertemuanById'] = $this->M_pertemuan->tampil_by_id($id_pertemuan);
		$data['permasalahan'] = $this->M_permasalahan->tampil_view_by_id_pertemuan($id_pertemuan);
		$data['soal'] = $this->M_soal_essai->getRecordsViewSrotByNo();
		$this->load->view('siswa/v_pertemuan', $data);
	}
}
