<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}	

        $this->load->model("M_score","", TRUE);
		$this->load->model("M_user","", TRUE);
	}

	public function nilai_simulasi()
	{
		$data['score'] = $this->M_score->getRecordsView();
		$this->load->view('guru/nilai/v_nilai_simulasi', $data);
	}

	public function nilai_pertemuan()
	{
		$data['score'] = $this->M_score->getRecordsViewWorksheet();
		$this->load->view('guru/nilai/v_nilai_worksheet', $data);
	}

	public function nilai_tahapan()
	{
		$data['scoreTahapan'] = $this->M_score->getRecordsViewWorksheetTahapan();
		$this->load->view('guru/nilai/v_nilai_worksheet_tahapan', $data);
	}


	public function rekap_nilai()
	{
		$data['score'] = $this->M_score->getRecordsViewTotalScore2();
		$data['user'] = $this->M_user->getRecordsView();
		$this->load->view('guru/nilai/v_total_score', $data);
	}
}
