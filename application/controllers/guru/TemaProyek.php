<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TemaProyek extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}
			
		$this->load->library('form_validation');
		$this->load->model("M_tema_proyek","",TRUE);
	}

	public function index()
	{
		$data['data']=$this->M_tema_proyek->getRecords();
		$this->load->view('guru/tema_proyek/v_tema_proyek',$data);
	}

	public function create()
	{
		$this->load->view('guru/tema_proyek/v_create_tema_proyek');
	}

	public function do_create()
	{
		if($this->validate() != false){

            $this->form_validation->set_error_delimiters();
            $data = array(
					'tema_proyek'	 	=> $this->input->post('tema_proyek'),
                    'status'            => $this->input->post('status'),
					'created_at' 	    => date('Y-m-d H:i:s')
			);
            
            $this->M_tema_proyek->tambahdata($data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di tambahkan');
            redirect('guru/TemaProyek');
		}else{
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$this->load->view('guru/tema_proyek/v_create_tema_proyek',$data);
			$this->form_validation->set_message('insert');
		}
	}

	public function validate(){
		$this->form_validation->set_rules('tema_proyek','Tema Proyek','required|max_length[200]');
        $this->form_validation->set_rules('status','Status','required|in_list[Aktif,Tidak Aktif]');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}

	public function delete($id)
	{	
		$cekData = $this->db->get_where('tb_pertemuan', array(//making selection
			'id_tema_proyek' => $id
		));

		if ($cekData->num_rows() > 0) {
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('alert', 'Tema Proyek terkait tidak dapat dihapus, karena sedang digunakan pada tabel lainnya');
			redirect('guru/TemaProyek');
		}
		else {
			$where = array('id_tema_proyek' => $id );
			$hapus = $this->M_tema_proyek->hapusdata($where);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
			$this->session->set_flashdata('alert', 'Data Berhasil di hapus');
			redirect('guru/TemaProyek');
		}
	}

	public function edit($id)
	{
		$data['dataById']=$this->M_tema_proyek->tampil_by_id($id);
		$this->load->view('guru/tema_proyek/v_edit_tema_proyek',$data);
	}

	function do_edit()
	{
		$id = $this->input->post('id_tema_proyek');
		if($this->validate() != false){
			$this->form_validation->set_error_delimiters();
			$data = array(
				'tema_proyek'		=>$this->input->post('tema_proyek'),
                'status'            =>$this->input->post('status'),
				'updated_at'		=>date('Y-m-d H:i:s')
			);

			$this->M_tema_proyek->update($id, $data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di ubah');
			redirect("guru/TemaProyek");
		}
		else {
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$data['dataById']=$this->M_tema_proyek->tampil_by_id($id);
			$this->load->view('guru/tema_proyek/v_edit_tema_proyek',$data);
			$this->form_validation->set_message('insert');
		}
	}
}
?>
