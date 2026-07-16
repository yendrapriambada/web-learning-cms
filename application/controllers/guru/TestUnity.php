<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestUnity extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}	

        $this->load->model("M_test_unity","", TRUE);
	}

	public function bulk_edit($no_kelompok = NULL)
	{
		if (!$no_kelompok) { redirect('guru/TestUnity'); }
		// Termasuk soal yang belum dikerjakan sebagian/semua anggota (baris placeholder),
		// supaya dosen tetap bisa menilai manual lewat bulk edit.
		$rows = $this->M_test_unity->getByKelompok($no_kelompok);
		if (empty($rows)) {
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'warning');
			$this->session->set_flashdata('alert', 'Kelompok '.$no_kelompok.' belum memiliki data tes.');
			redirect('guru/TestUnity');
		}
		// Group by practice+pertanyaan+test_type sehingga semua anggota berbagi satu
		// input nilai+feedback -- test_type WAJIB ikut jadi kunci karena practice+nomor
		// yang sama dipakai ulang untuk pretest & posttest (soal beda, studi kasus beda).
		$grouped = [];
		foreach ($rows as $r) {
			$key = md5($r->practice . '|' . $r->pertanyaan . '|' . $r->test_type);
			if (!isset($grouped[$key])) {
				$grouped[$key] = ['rep' => $r, 'jumlah_anggota' => 0];
			}
			$grouped[$key]['jumlah_anggota']++;
		}
		$data['no_kelompok'] = $no_kelompok;
		$data['grouped']     = $grouped;
		$this->load->view('guru/test_unity/v_bulk_edit_test_unity', $data);
	}

	public function do_bulk_edit()
	{
		$no_kelompok      = $this->input->post('no_kelompok');
		$indikator_arr    = $this->input->post('indikator_soal');
		$practice_arr     = $this->input->post('practice');
		$pertanyaan_arr   = $this->input->post('pertanyaan');
		$test_type_arr    = $this->input->post('test_type');
		$nilai_arr        = $this->input->post('nilai');
		$feedback_arr     = $this->input->post('feedback');

		if (!$no_kelompok || empty($practice_arr)) { redirect('guru/TestUnity'); }

		foreach ($practice_arr as $i => $practice) {
			$data = array(
				'nilai'    => isset($nilai_arr[$i])    ? $nilai_arr[$i]    : NULL,
				'feedback' => isset($feedback_arr[$i]) ? $feedback_arr[$i] : NULL,
			);
			$this->M_test_unity->updateOrInsertForGroup(
				$no_kelompok,
				isset($indikator_arr[$i]) ? $indikator_arr[$i] : NULL,
				$practice,
				isset($pertanyaan_arr[$i]) ? $pertanyaan_arr[$i] : NULL,
				isset($test_type_arr[$i]) ? $test_type_arr[$i] : NULL,
				$data
			);
		}

		$this->session->set_flashdata('ver', 'FALSE');
		$this->session->set_flashdata('class_alert', 'success');
		$this->session->set_flashdata('alert', 'Nilai kelompok '.$no_kelompok.' berhasil diperbarui.');
		redirect('guru/TestUnity');
	}

	/**
	 * Tandai ulang test_type semua baris kelompok untuk satu soal sekaligus
	 * (dipakai tombol "Tandai Pretest/Posttest" di halaman bulk edit).
	 */
	public function retag()
	{
		$no_kelompok    = $this->input->post('no_kelompok');
		$practice       = $this->input->post('practice');
		$pertanyaan     = $this->input->post('pertanyaan');
		$old_test_type  = $this->input->post('old_test_type');
		$new_test_type  = $this->input->post('new_test_type');

		if ($no_kelompok && $practice !== NULL && $pertanyaan !== NULL && in_array($new_test_type, array('pretest', 'posttest'))) {
			$this->M_test_unity->retagTestType($no_kelompok, $practice, $pertanyaan, $old_test_type, $new_test_type);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'success');
			$this->session->set_flashdata('alert', 'Soal No. '.$pertanyaan.' berhasil ditandai sebagai '.ucfirst($new_test_type).'.');
		}

		redirect('guru/TestUnity/bulk_edit/'.$no_kelompok);
	}

	public function index()
	{
		$per_page = 20;
		$page     = max(1, (int) $this->input->get('page'));
		$offset   = ($page - 1) * $per_page;

		$filters = array(
			'nama_lengkap'  => $this->input->get('nama_lengkap'),
			'no_kelompok'   => $this->input->get('no_kelompok'),
			'angkatan'      => $this->input->get('angkatan'),
			'jenis_kelamin' => $this->input->get('jenis_kelamin'),
			'practice'      => $this->input->get('practice'),
			'test_type'     => $this->input->get('test_type'),
			'status'        => $this->input->get('status'),
		);

		$sort = $this->input->get('sort') ?: 'nama_lengkap';
		$dir  = strtoupper($this->input->get('dir')) === 'DESC' ? 'DESC' : 'ASC';

		$total = $this->M_test_unity->getRecordsCount($filters);
		$data['testUnity']     = $this->M_test_unity->getRecordsPaginated($per_page, $offset, $filters, $sort, $dir);
		$data['filters']       = $filters;
		$data['sort']          = $sort;
		$data['dir']           = $dir;
		$data['total']         = $total;
		$data['per_page']      = $per_page;
		$data['current_page']  = $page;
		$data['total_pages']   = ceil($total / $per_page);

		$data['filter_names']    = $this->M_test_unity->getDistinctValues('nama_lengkap');
		$data['filter_kelompok'] = $this->M_test_unity->getDistinctValues('no_kelompok');
		$data['filter_angkatan'] = $this->M_test_unity->getDistinctValues('angkatan');
		$data['filter_gender']   = $this->M_test_unity->getDistinctValues('jenis_kelamin');
		$data['filter_practice'] = $this->M_test_unity->getDistinctPractice();
		$data['kelompok_list']   = $this->M_test_unity->getKelompokList();

		$this->load->view('guru/test_unity/v_test_unity', $data);
	}

    public function delete($id)
	{
        $where = array('id_test_unity' => $id );
        $hapus = $this->M_test_unity->hapusdata($where);
        $this->session->set_flashdata('ver', 'FALSE');
        $this->session->set_flashdata('class_alert', 'info');
        $this->session->set_flashdata('alert', 'Data Berhasil di hapus');
        redirect('guru/TestUnity');
	}

    public function form_edit($id)
	{
		$data['dataById']=$this->M_test_unity->tampil_view_by_id($id);
		$this->load->view('guru/test_unity/v_edit_test_unity',$data);
	}

	function do_edit()
	{
		$id = $this->input->post('id_test_unity');
        $test_type = $this->input->post('test_type');
        $data = array(
            'nilai'	        => $this->input->post('nilai'),
			'jawaban'		=> $this->input->post('jawaban'),
            'feedback'	    => $this->input->post('feedback'),
            'test_type'     => $test_type !== '' ? $test_type : NULL,
        );

        $this->M_test_unity->update($id, $data);
        $this->session->set_flashdata('ver', 'FALSE');
        $this->session->set_flashdata('class_alert', 'info');
        $this->session->set_flashdata('alert', 'Data Berhasil di ubah');
        redirect("guru/TestUnity");
	}
}
