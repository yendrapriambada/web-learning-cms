<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tampilan alternatif "per Kelompok" untuk Penilaian Tes:
 * Kelompok (index) -> Soal (soal) -> Jawaban tiap siswa (detail).
 * Tabel lama tetap ada di guru/TestUnity; halaman ini hanya cara pandang lain
 * atas data yang sama, mengikuti pola guru/JawabanMahasiswa.
 */
class PenilaianTesKelompok extends CI_Controller {
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
		$data['cards']           = $this->M_test_unity->getKelompokCards($filters);
		$data['filter_angkatan'] = $this->M_test_unity->getDistinctAngkatan();

		$this->load->view('guru/penilaian_tes_kelompok/v_kelompok_cards', $data);
	}

	public function soal($no_kelompok = NULL)
	{
		if (!$no_kelompok) { redirect('guru/PenilaianTesKelompok'); }

		$hasil = $this->M_test_unity->getSoalListByKelompok($no_kelompok);

		if (empty($hasil['members'])) {
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'warning');
			$this->session->set_flashdata('alert', 'Kelompok '.$no_kelompok.' tidak ditemukan.');
			redirect('guru/PenilaianTesKelompok');
		}

		$data['no_kelompok'] = $no_kelompok;
		$data['members']     = $hasil['members'];
		$data['soalList']    = $hasil['soal'];

		$this->load->view('guru/penilaian_tes_kelompok/v_soal_list', $data);
	}

	public function detail($no_kelompok = NULL, $key = NULL)
	{
		if (!$no_kelompok || !$key) { redirect('guru/PenilaianTesKelompok'); }

		$soalKey = M_test_unity::decodeSoalKey($key);
		if (!$soalKey) { redirect('guru/PenilaianTesKelompok/soal/'.$no_kelompok); }

		$hasil = $this->M_test_unity->getJawabanPerSiswa($no_kelompok, $soalKey['practice'], $soalKey['pertanyaan']);
		if (!$hasil) { redirect('guru/PenilaianTesKelompok/soal/'.$no_kelompok); }

		$data['no_kelompok'] = $no_kelompok;
		$data['soal_key']    = $key;
		$data['soal']        = $hasil;
		$data['siswaList']   = $hasil['siswa'];

		$this->load->view('guru/penilaian_tes_kelompok/v_detail_siswa', $data);
	}

	public function hapus($id, $no_kelompok, $key)
	{
		$this->M_test_unity->hapusJawaban($id);
		$this->session->set_flashdata('ver', 'FALSE');
		$this->session->set_flashdata('class_alert', 'info');
		$this->session->set_flashdata('alert', 'Jawaban siswa berhasil dihapus.');
		redirect('guru/PenilaianTesKelompok/detail/'.$no_kelompok.'/'.$key);
	}

	/**
	 * Bulk edit: satu nilai/feedback diterapkan ke SEMUA anggota kelompok
	 * untuk satu soal ini saja (bukan seluruh tes sekaligus).
	 */
	public function bulk_soal($no_kelompok = NULL, $key = NULL)
	{
		if (!$no_kelompok || !$key) { redirect('guru/PenilaianTesKelompok'); }

		$soalKey = M_test_unity::decodeSoalKey($key);
		if (!$soalKey) { redirect('guru/PenilaianTesKelompok/soal/'.$no_kelompok); }

		$hasil = $this->M_test_unity->getJawabanPerSiswa($no_kelompok, $soalKey['practice'], $soalKey['pertanyaan']);
		if (!$hasil) { redirect('guru/PenilaianTesKelompok/soal/'.$no_kelompok); }

		$sample = NULL;
		foreach ($hasil['siswa'] as $sw) {
			if ($sw['nilai'] !== NULL || $sw['feedback']) { $sample = $sw; break; }
		}

		$data['no_kelompok']    = $no_kelompok;
		$data['soal_key']       = $key;
		$data['soal']           = $hasil;
		$data['jumlah_anggota'] = count($hasil['siswa']);
		$data['sample']         = $sample;

		$this->load->view('guru/penilaian_tes_kelompok/v_bulk_edit_soal', $data);
	}

	public function do_bulk_soal()
	{
		$no_kelompok = $this->input->post('no_kelompok');
		$key         = $this->input->post('soal_key');
		if (!$no_kelompok || !$key) { redirect('guru/PenilaianTesKelompok'); }

		$soalKey = M_test_unity::decodeSoalKey($key);
		if (!$soalKey) { redirect('guru/PenilaianTesKelompok'); }

		$nilai    = $this->input->post('nilai') !== '' ? $this->input->post('nilai') : NULL;
		$feedback = $this->input->post('feedback');
		$indikator_soal = $this->input->post('indikator_soal');

		$this->M_test_unity->updateOrInsertForGroup($no_kelompok, $indikator_soal, $soalKey['practice'], $soalKey['pertanyaan'], array(
			'nilai'    => $nilai,
			'feedback' => $feedback,
		));

		$this->session->set_flashdata('ver', 'FALSE');
		$this->session->set_flashdata('class_alert', 'success');
		$this->session->set_flashdata('alert', 'Nilai soal ini berhasil diterapkan ke semua anggota kelompok '.$no_kelompok.'.');
		redirect('guru/PenilaianTesKelompok/detail/'.$no_kelompok.'/'.$key);
	}
}
