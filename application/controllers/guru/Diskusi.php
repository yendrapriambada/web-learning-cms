<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskusi extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}	
			
		$this->load->library('form_validation');
        $this->load->model("M_user","",TRUE);
		$this->load->model("M_pertemuan","",TRUE);
        $this->load->model("M_diskusi","",TRUE);
	}

	public function index()
	{
		$data['data']=$this->M_diskusi->getRecordsView();
		$this->load->view('guru/diskusi/v_diskusi',$data);
	}

    public function review_diskusi()
	{
		$data['pertemuan'] = $this->M_pertemuan->getRecords();
		$this->load->view('guru/diskusi/v_pilih_review_diskusi',$data);
	}

    public function view_diskusi($idPertemuan)
	{
		$data['dataByPertemuan']=$this->M_diskusi->tampil_view_by_id_pertemuan_sort($idPertemuan);
        $data['pertemuan']=$this->M_pertemuan->tampil_by_id($idPertemuan);
		$this->load->view('guru/diskusi/v_review_diskusi',$data);
	}

    public function do_pilih_review_diskusi()
	{
        $idPertemuan=$this->input->post('id_pertemuan');
		redirect('guru/Diskusi/view_diskusi/'.$idPertemuan);
	}

	public function create()
	{
		$data['pertemuan'] = $this->M_pertemuan->getRecords();
		$this->load->view('guru/diskusi/v_create_diskusi',$data);
	}

	public function do_create()
	{
		if($this->validate() != false){

            $this->form_validation->set_error_delimiters();
            $data = array(
					'id_user'	 	  => $this->session->userdata('id_user'),
                    'id_pertemuan'	  => $this->input->post('id_pertemuan'),
                    'komentar'	      => $this->input->post('komentar'),
					'created_at' 	  => date('Y-m-d H:i:s')
			);
            
            $this->M_diskusi->tambahdata($data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di tambahkan');
            redirect('guru/Diskusi');
		}else{
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$this->load->view('guru/diskusi/v_create_diskusi',);
			$this->form_validation->set_message('insert');
		}
	}

    public function do_create_review()
	{
		if($this->validate() != false){
            $idPertemuan = $this->input->post('id_pertemuan');
            $this->form_validation->set_error_delimiters();
            $data = array(
					'id_user'	 	  => $this->session->userdata('id_user'),
                    'id_pertemuan'	  => $idPertemuan,
                    'komentar'	      => $this->input->post('komentar'),
					'created_at' 	  => date('Y-m-d H:i:s')
			);
            
            $this->M_diskusi->tambahdata($data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di tambahkan');
            redirect('guru/Diskusi/view_diskusi/'.$idPertemuan);
		}else{
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			redirect('guru/Diskusi/view_diskusi/'.$idPertemuan);
			$this->form_validation->set_message('insert');
		}
	}

	public function delete($id)
	{
        $where = array('id_diskusi' => $id );
        $hapus = $this->M_diskusi->hapusdata($where);
        $this->session->set_flashdata('ver', 'FALSE');
        $this->session->set_flashdata('class_alert', 'info');
        $this->session->set_flashdata('alert', 'Data Berhasil di hapus');
        redirect('guru/Diskusi');
	}

	public function edit($id)
	{
		$data['dataById']=$this->M_diskusi->tampil_view_by_id($id);
        $data['pertemuan'] = $this->M_pertemuan->getRecords();
		$this->load->view('guru/diskusi/v_edit_diskusi',$data);
	}

	function do_edit()
	{
		$id = $this->input->post('id_diskusi');
		if($this->validate() != false){
			$this->form_validation->set_error_delimiters();
			$data = array(
                'id_pertemuan'	  => $this->input->post('id_pertemuan'),
                'komentar'	      => $this->input->post('komentar'),
				'updated_at'      =>date('Y-m-d H:i:s')
			);

			$this->M_diskusi->update($id, $data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di ubah');
			redirect("guru/Diskusi");
		}
		else {
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$data['dataById']=$this->M_diskusi->tampil_view_by_id($id);
            $data['pertemuan'] = $this->M_pertemuan->getRecords();
			$this->load->view('guru/diskusi/v_edit_diskusi',$data);
			$this->form_validation->set_message('insert');
		}
	}

	public function validate(){
        $this->form_validation->set_rules('id_pertemuan','ID Pertemuan','required');
        $this->form_validation->set_rules('komentar','Komentar','required');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}
}
?>