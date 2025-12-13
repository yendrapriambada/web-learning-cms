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

	public function index()
	{
		$data['jawabanEssai'] = $this->M_jawaban_essai->getRecordsView();
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
		$data['dataById']=$this->M_jawaban_essai->tampil_view_by_id($id);
		$this->load->view('guru/jawaban_essai/v_edit_jawaban_essai',$data);
	}

	function do_edit()
	{
		$id = $this->input->post('id_jawaban_essai');
        $data = array(
            'nilai'	        => $this->input->post('nilai'),
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
