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
		$rows = $this->M_test_unity->getByKelompok($no_kelompok);
		if (empty($rows)) {
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'warning');
			$this->session->set_flashdata('alert', 'Kelompok '.$no_kelompok.' belum memiliki data tes unity.');
			redirect('guru/TestUnity');
		}
		// Group by pertanyaan text so all members share one nilai+feedback input
		$grouped = [];
		foreach ($rows as $r) {
			$key = md5($r->practice . '|' . $r->pertanyaan);
			if (!isset($grouped[$key])) {
				$grouped[$key] = ['rep' => $r, 'ids' => []];
			}
			$grouped[$key]['ids'][] = $r->id_test_unity;
		}
		$data['no_kelompok'] = $no_kelompok;
		$data['grouped']     = $grouped;
		$this->load->view('guru/test_unity/v_bulk_edit_test_unity', $data);
	}

	public function do_bulk_edit()
	{
		$no_kelompok  = $this->input->post('no_kelompok');
		$ids_arr      = $this->input->post('ids');     // ids[i] = "1,2,3"
		$nilai_arr    = $this->input->post('nilai');
		$feedback_arr = $this->input->post('feedback');

		if (!$no_kelompok || empty($ids_arr)) { redirect('guru/TestUnity'); }

		foreach ($ids_arr as $i => $ids_str) {
			$ids      = array_filter(array_map('intval', explode(',', $ids_str)));
			$nilai    = isset($nilai_arr[$i])    ? $nilai_arr[$i]    : NULL;
			$feedback = isset($feedback_arr[$i]) ? $feedback_arr[$i] : NULL;
			$this->M_test_unity->updateBulkByIds($ids, $nilai, $feedback);
		}

		$this->session->set_flashdata('ver', 'FALSE');
		$this->session->set_flashdata('class_alert', 'success');
		$this->session->set_flashdata('alert', 'Nilai kelompok '.$no_kelompok.' berhasil diperbarui.');
		redirect('guru/TestUnity');
	}

	public function index()
	{
		$data['testUnity']     = $this->M_test_unity->getRecordsView();
		$data['kelompok_list'] = $this->M_test_unity->getKelompokList();
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
        $data = array(
            'nilai'	        => $this->input->post('nilai'),
			'jawaban'		=> $this->input->post('jawaban'),
            'feedback'	    => $this->input->post('feedback')
        );

        $this->M_test_unity->update($id, $data);
        $this->session->set_flashdata('ver', 'FALSE');
        $this->session->set_flashdata('class_alert', 'info');
        $this->session->set_flashdata('alert', 'Data Berhasil di ubah');
        redirect("guru/TestUnity");
	}
}
