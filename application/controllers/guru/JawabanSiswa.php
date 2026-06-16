<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JawabanSiswa extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}	

        $this->load->model("M_score","", TRUE);
        $this->load->model("M_jawaban_essai","", TRUE);
	}

	public function bulk_edit($no_kelompok = NULL)
	{
		if (!$no_kelompok) { redirect('guru/JawabanSiswa'); }
		$data['no_kelompok'] = $no_kelompok;
		$data['members']     = $this->M_jawaban_essai->getMembersByKelompok($no_kelompok);
		$data['soalList']    = $this->M_jawaban_essai->getByKelompokGroupedBySoal($no_kelompok);
		if (empty($data['soalList'])) {
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'warning');
			$this->session->set_flashdata('alert', 'Kelompok '.$no_kelompok.' belum memiliki data jawaban.');
			redirect('guru/JawabanSiswa');
		}
		$this->load->view('guru/jawaban_essai/v_bulk_edit_jawaban_essai', $data);
	}

	public function do_bulk_edit()
	{
		$no_kelompok = $this->input->post('no_kelompok');
		$id_soal_arr = $this->input->post('id_soal');
		$nilai_arr   = $this->input->post('nilai');
		$feedback_arr= $this->input->post('feedback');

		if (!$no_kelompok || empty($id_soal_arr)) { redirect('guru/JawabanSiswa'); }

		foreach ($id_soal_arr as $i => $id_soal) {
			$nilai    = isset($nilai_arr[$i])    ? $nilai_arr[$i]    : NULL;
			$feedback = isset($feedback_arr[$i]) ? $feedback_arr[$i] : NULL;
			$this->M_jawaban_essai->updateBulkByKelompokAndSoal($no_kelompok, $id_soal, $nilai, $feedback);
		}

		$this->session->set_flashdata('ver', 'FALSE');
		$this->session->set_flashdata('class_alert', 'success');
		$this->session->set_flashdata('alert', 'Nilai kelompok '.$no_kelompok.' berhasil diperbarui.');
		redirect('guru/JawabanSiswa');
	}

	public function index()
	{
		$per_page = 20;
		$page     = max(1, (int) $this->input->get('page'));
		$offset   = ($page - 1) * $per_page;

		$filters = array(
			'nama_lengkap'          => $this->input->get('nama_lengkap'),
			'no_kelompok'           => $this->input->get('no_kelompok'),
			'no_pertemuan'          => $this->input->get('no_pertemuan'),
			'tahapan_pembelajaran'  => $this->input->get('tahapan_pembelajaran'),
			'no_soal'               => $this->input->get('no_soal'),
		);

		$total = $this->M_jawaban_essai->getRecordsCount($filters);
		$data['jawabanEssai']  = $this->M_jawaban_essai->getRecordsPaginated($per_page, $offset, $filters);
		$data['filters']       = $filters;
		$data['total']         = $total;
		$data['per_page']      = $per_page;
		$data['current_page']  = $page;
		$data['total_pages']   = ceil($total / $per_page);

		$data['filter_names']   = $this->M_jawaban_essai->getDistinctValues('nama_lengkap');
		$data['filter_kelompok']= $this->M_jawaban_essai->getDistinctValues('no_kelompok');
		$data['filter_pertemuan']= $this->M_jawaban_essai->getDistinctValues('no_pertemuan');
		$data['filter_tahap']   = $this->M_jawaban_essai->getDistinctValues('tahapan_pembelajaran');
		$data['filter_soal']    = $this->M_jawaban_essai->getDistinctValues('no_soal');
		$data['kelompok_list']  = $this->M_jawaban_essai->getKelompokList();

		$this->load->view('guru/jawaban_essai/v_jawaban_essai', $data);
	}

    public function delete($id)
	{
        $where = array('id_jawaban_essai' => $id );
        $hapus = $this->M_jawaban_essai->hapusdata($where);
        $this->session->set_flashdata('ver', 'FALSE');
        $this->session->set_flashdata('class_alert', 'info');
        $this->session->set_flashdata('alert', 'Data Berhasil di hapus');
        redirect('guru/JawabanSiswa');
	}

    public function form_edit($id)
	{
		$dataById = $this->M_jawaban_essai->tampil_view_by_id($id);
		if (!$dataById) { redirect('guru/JawabanSiswa'); }
		$data['dataById'] = $dataById;
		$this->load->view('guru/jawaban_essai/v_edit_jawaban_essai',$data);
	}

	function do_edit()
	{
		$id = $this->input->post('id_jawaban_essai');
        $data = array(
            'nilai'	        => $this->input->post('nilai'),
            'jawaban_text'	=> $this->input->post('jawaban_text'),
            'feedback'	    => $this->input->post('feedback'),
            'updated_at'    =>date('Y-m-d H:i:s')
        );

        $this->M_jawaban_essai->update($id, $data);
        $this->session->set_flashdata('ver', 'FALSE');
        $this->session->set_flashdata('class_alert', 'info');
        $this->session->set_flashdata('alert', 'Data Berhasil di ubah');
        redirect("guru/JawabanSiswa");
	}
}
