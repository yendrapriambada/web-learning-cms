<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tampilan alternatif "per Jenis Tes" untuk Penilaian Tes:
 * Pilih Pretest/Posttest -> Kelompok (di-scope ke jenis tes itu) -> Soal -> Siswa.
 * Halaman soal/detail/bulk edit tetap reuse guru/PenilaianTesKelompok (soal_key
 * sudah membawa test_type), cuma daftar kelompoknya yang di-scope di sini.
 */
class PenilaianTesJenis extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('./Login');
		}
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}

		$this->load->model('M_test_unity', '', TRUE);
	}

	public function index()
	{
		$filters = array(
			'angkatan' => $this->input->get('angkatan'),
		);

		$data['filters']         = $filters;
		$data['summary']         = $this->M_test_unity->getTestTypeSummary($filters);
		$data['comparison']      = $this->M_test_unity->getKelompokComparison($filters);
		$data['filter_angkatan'] = $this->M_test_unity->getDistinctAngkatan();

		$this->load->view('guru/penilaian_tes_jenis/v_jenis_index', $data);
	}

	public function kelompok($test_type = NULL)
	{
		if (!in_array($test_type, array('pretest', 'posttest'))) { redirect('guru/PenilaianTesJenis'); }

		$filters = array(
			'angkatan'    => $this->input->get('angkatan'),
			'no_kelompok' => $this->input->get('no_kelompok'),
		);

		$data['test_type']       = $test_type;
		$data['filters']         = $filters;
		$data['cards']           = $this->M_test_unity->getKelompokCardsByTestType($test_type, $filters);
		$data['filter_angkatan'] = $this->M_test_unity->getDistinctAngkatan();

		$this->load->view('guru/penilaian_tes_jenis/v_jenis_kelompok', $data);
	}
}
