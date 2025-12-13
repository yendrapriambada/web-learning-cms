<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->model("M_pertemuan","",TRUE);
		$this->load->model("M_mata_kuliah","",TRUE);
		$this->load->model("M_alur_pembelajaran","",TRUE);
		
	}

	public function index()
	{
	    $data['pertemuan'] = $this->M_pertemuan->getRecordsView();
		$data['matkul'] = $this->M_mata_kuliah->getRecords();
		$data['alurPembelajaran'] = $this->M_alur_pembelajaran->tampil_view_by_id_sorted_by_pertemuan();
		$this->load->view('v_beranda',$data);
	}
}
