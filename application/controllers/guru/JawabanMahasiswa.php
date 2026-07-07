<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JawabanMahasiswa extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}

        $this->load->model("M_jawaban_essai","", TRUE);
	}

	public function index()
	{
		$filters = array(
			'no_kelompok' => $this->input->get('no_kelompok'),
			'angkatan'    => $this->input->get('angkatan'),
		);

		$data['filters']         = $filters;
		$data['kelompokList']    = $this->M_jawaban_essai->getKelompokSummary($filters);
		$data['filter_angkatan'] = $this->M_jawaban_essai->getDistinctAngkatanForKelompok();

		$this->load->view('guru/jawaban_essai/v_jawaban_mahasiswa_kelompok', $data);
	}

	public function detail($no_kelompok = NULL)
	{
		if (!$no_kelompok) { redirect('guru/JawabanMahasiswa'); }

		$members = $this->M_jawaban_essai->getMembersByKelompok($no_kelompok);
		if (empty($members)) {
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'warning');
			$this->session->set_flashdata('alert', 'Kelompok '.$no_kelompok.' tidak ditemukan atau belum memiliki anggota.');
			redirect('guru/JawabanMahasiswa');
		}

		$data['no_kelompok'] = $no_kelompok;
		$data['members']     = $members;
		$data['soalList']    = $this->M_jawaban_essai->getSoalSummaryByKelompok($no_kelompok);

		$this->load->view('guru/jawaban_essai/v_jawaban_mahasiswa_detail', $data);
	}

	public function soal($no_kelompok = NULL, $id_soal = NULL)
	{
		if (!$no_kelompok || !$id_soal) { redirect('guru/JawabanMahasiswa'); }

		$soal = $this->M_jawaban_essai->getSoalDetail($id_soal);
		if (!$soal) { redirect('guru/JawabanMahasiswa/detail/'.$no_kelompok); }

		$data['no_kelompok'] = $no_kelompok;
		$data['soal']        = $soal;
		$data['jawabanList'] = $this->M_jawaban_essai->getJawabanPerSiswaBySoal($no_kelompok, $id_soal);

		$this->load->view('guru/jawaban_essai/v_jawaban_mahasiswa_soal', $data);
	}
}
