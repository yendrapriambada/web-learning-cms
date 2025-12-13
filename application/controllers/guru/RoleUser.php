<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleUser extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}
			
		$this->load->library('form_validation');
		$this->load->model("M_role_user","",TRUE);
	}

	public function index()
	{
		$data['data']=$this->M_role_user->getRecords();
		$this->load->view('guru/role_user/v_role_user',$data);
	}

	public function create()
	{
		$this->load->view('guru/role_user/v_create_role_user');
	}

	public function do_create()
	{
		if($this->validate() != false){

            $this->form_validation->set_error_delimiters();
            $data = array(
					'role_user'	 	=> $this->input->post('role_user'),
					'created_at' 	=> date('Y-m-d H:i:s')
			);
            
            $this->M_role_user->tambahdata($data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di tambahkan');
            redirect('guru/RoleUser');
		}else{
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$this->load->view('guru/role_user/v_create_role_user',$data);
			$this->form_validation->set_message('insert');
		}
	}

	public function validate(){
		$this->form_validation->set_rules('role_user','Role User','required|max_length[255]');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}

	public function delete($id)
	{	
		$cekData = $this->db->get_where('tb_user', array(//making selection
			'id_role_user' => $id
		));

		if ($cekData->num_rows() > 0) {
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('alert', 'Role User terkait tidak dapat dihapus, karena sedang digunakan pada tabel lainnya');
			redirect('guru/RoleUser');
		}
		else {
			$where = array('id_role_user' => $id );
			$hapus = $this->M_role_user->hapusdata($where);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
			$this->session->set_flashdata('alert', 'Data Berhasil di hapus');
			redirect('guru/RoleUser');
		}
	}

	public function edit($id)
	{
		$data['dataById']=$this->M_role_user->tampil_by_id($id);
		$this->load->view('guru/role_user/v_edit_role_user',$data);
	}

	function do_edit()
	{
		$id = $this->input->post('id_role_user');
		if($this->validate() != false){
			$this->form_validation->set_error_delimiters();
			$data = array(
				'role_user'			=>$this->input->post('role_user'),
				'updated_at'		=>date('Y-m-d H:i:s')
			);

			$this->M_role_user->update($id, $data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di ubah');
			redirect("guru/RoleUser");
		}
		else {
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$data['dataById']=$this->M_role_user->tampil_by_id($id);
			$this->load->view('guru/role_user/v_edit_role_user',$data);
			$this->form_validation->set_message('insert');
		}
	}
}
?>