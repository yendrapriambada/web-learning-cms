<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panduan extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}

		$this->load->model("M_mata_kuliah","",TRUE);
	}

	public function index()
	{
		$this->load->view('guru/v_panduan');
	}
}
