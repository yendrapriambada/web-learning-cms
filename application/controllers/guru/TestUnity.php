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

	public function index()
	{
		$data['testUnity'] = $this->M_test_unity->getRecordsView();
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
            'feedback'	    => $this->input->post('feedback')
        );

        $this->M_test_unity->update($id, $data);
        $this->session->set_flashdata('ver', 'FALSE');
        $this->session->set_flashdata('class_alert', 'info');
        $this->session->set_flashdata('alert', 'Data Berhasil di ubah');
        redirect("guru/TestUnity");
	}
}
