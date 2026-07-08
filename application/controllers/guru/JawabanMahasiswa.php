<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tampilan alternatif "per Kelompok" untuk data Jawaban Mahasiswa/i:
 * Kelompok (index) -> Soal (soal) -> Jawaban tiap siswa (detail).
 * Tabel lama tetap ada di guru/JawabanSiswa; halaman ini hanya cara pandang lain
 * atas data yang sama.
 */
class JawabanMahasiswa extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('./Login');
		}
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}

		$this->load->model('M_jawaban_mahasiswa', '', TRUE);
	}

	public function index()
	{
		$filters = array(
			'angkatan' => $this->input->get('angkatan'),
		);

		$data['filters']         = $filters;
		$data['cards']           = $this->M_jawaban_mahasiswa->getKelompokCards($filters);
		$data['filter_angkatan'] = $this->M_jawaban_mahasiswa->getDistinctAngkatan();

		$this->load->view('guru/jawaban_mahasiswa/v_kelompok_cards', $data);
	}

	public function soal($no_kelompok = NULL)
	{
		if (!$no_kelompok) { redirect('guru/JawabanMahasiswa'); }

		$hasil = $this->M_jawaban_mahasiswa->getSoalListByKelompok($no_kelompok);

		if (empty($hasil['members'])) {
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'warning');
			$this->session->set_flashdata('alert', 'Kelompok '.$no_kelompok.' tidak ditemukan.');
			redirect('guru/JawabanMahasiswa');
		}

		$data['no_kelompok'] = $no_kelompok;
		$data['members']     = $hasil['members'];
		$data['soalList']    = $hasil['soal'];

		$this->load->view('guru/jawaban_mahasiswa/v_soal_list', $data);
	}

	public function detail($no_kelompok = NULL, $id_soal = NULL)
	{
		if (!$no_kelompok || !$id_soal) { redirect('guru/JawabanMahasiswa'); }

		$hasil = $this->M_jawaban_mahasiswa->getJawabanPerSiswa($no_kelompok, $id_soal);
		if (!$hasil) { redirect('guru/JawabanMahasiswa/soal/'.$no_kelompok); }

		$data['no_kelompok'] = $no_kelompok;
		$data['id_soal']     = $id_soal;
		$data['soal']        = $hasil['soal'];
		$data['siswaList']   = $hasil['siswa'];

		$this->load->view('guru/jawaban_mahasiswa/v_detail_siswa', $data);
	}

	public function hapus($id, $no_kelompok, $id_soal)
	{
		$this->M_jawaban_mahasiswa->hapusJawaban($id);
		$this->session->set_flashdata('ver', 'FALSE');
		$this->session->set_flashdata('class_alert', 'info');
		$this->session->set_flashdata('alert', 'Jawaban siswa berhasil dihapus.');
		redirect('guru/JawabanMahasiswa/detail/'.$no_kelompok.'/'.$id_soal);
	}

	/**
	 * Bulk edit: satu jawaban/nilai/feedback diterapkan ke SEMUA anggota kelompok
	 * untuk satu soal ini saja (bukan per siswa).
	 */
	public function bulk_soal($no_kelompok = NULL, $id_soal = NULL)
	{
		if (!$no_kelompok || !$id_soal) { redirect('guru/JawabanMahasiswa'); }

		$hasil = $this->M_jawaban_mahasiswa->getJawabanPerSiswa($no_kelompok, $id_soal);
		if (!$hasil) { redirect('guru/JawabanMahasiswa/soal/'.$no_kelompok); }

		$sample = NULL;
		foreach ($hasil['siswa'] as $sw) {
			if ($sw['jawaban_text'] || $sw['nilai'] !== NULL) { $sample = $sw; break; }
		}

		$data['no_kelompok']    = $no_kelompok;
		$data['id_soal']        = $id_soal;
		$data['soal']           = $hasil['soal'];
		$data['jumlah_anggota'] = count($hasil['siswa']);
		$data['sample']         = $sample;

		$this->load->view('guru/jawaban_mahasiswa/v_bulk_edit_soal', $data);
	}

	public function do_bulk_soal()
	{
		$no_kelompok = $this->input->post('no_kelompok');
		$id_soal     = $this->input->post('id_soal');
		if (!$no_kelompok || !$id_soal) { redirect('guru/JawabanMahasiswa'); }

		$nilai    = $this->input->post('nilai') !== '' ? $this->input->post('nilai') : NULL;
		$feedback = $this->input->post('feedback');
		$jawaban  = $this->input->post('jawaban_text');

		$jawaban_gambar = $this->_uploadSingleFile('jawaban_gambar', [
			'upload_path'   => './assets/jawaban_gambar/',
			'allowed_types' => 'jpeg|jpg|png',
			'max_size'      => 2048,
			'encrypt_name'  => TRUE,
		]);
		$jawaban_file = $this->_uploadSingleFile('jawaban_file', [
			'upload_path'   => './assets/jawaban_file/',
			'allowed_types' => 'ppt|pptx|pdf|docx|doc',
			'max_size'      => 2048,
			'encrypt_name'  => TRUE,
		]);

		$data = array(
			'nilai'      => $nilai,
			'feedback'   => $feedback,
			'updated_at' => date('Y-m-d H:i:s'),
		);
		if ($jawaban !== NULL && $jawaban !== '') $data['jawaban_text']   = $jawaban;
		if ($jawaban_gambar !== NULL)             $data['jawaban_gambar'] = $jawaban_gambar;
		if ($jawaban_file !== NULL)               $data['jawaban_file']   = $jawaban_file;

		$this->M_jawaban_mahasiswa->bulkUpdateSoalForKelompok($no_kelompok, $id_soal, $data);

		$this->session->set_flashdata('ver', 'FALSE');
		$this->session->set_flashdata('class_alert', 'success');
		$this->session->set_flashdata('alert', 'Jawaban & nilai soal ini berhasil diterapkan ke semua anggota kelompok '.$no_kelompok.'.');
		redirect('guru/JawabanMahasiswa/detail/'.$no_kelompok.'/'.$id_soal);
	}

	private function _uploadSingleFile($field, $config)
	{
		if (empty($_FILES[$field]['name'])) { return NULL; }

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload($field)) {
			$data = $this->upload->data();
			return $data['file_name'];
		}

		$this->session->set_flashdata('ver', 'FALSE');
		$this->session->set_flashdata('class_alert', 'danger');
		$this->session->set_flashdata('error', 'Error upload '.$field.': '.$this->upload->display_errors());
		return NULL;
	}
}
