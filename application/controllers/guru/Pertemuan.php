<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertemuan extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}
			
		$this->load->library('form_validation');
		$this->load->model("M_pertemuan","",TRUE);
		$this->load->model("M_tema_proyek","",TRUE);
	}

	public function index()
	{
		$data['data']=$this->M_pertemuan->getRecordsView();
		$this->load->view('guru/pertemuan/v_pertemuan',$data);
	}

	public function create()
	{
	    $data['temaProyek']=$this->M_tema_proyek->getRecords();
		$this->load->view('guru/pertemuan/v_create_pertemuan',$data);
	}

	public function do_create()
	{
		if($this->validate() != false){

            $this->form_validation->set_error_delimiters();
            $data = array(
					'no_pertemuan'	 	    => $this->input->post('no_pertemuan'),
					'id_tema_proyek'	 	=> $this->input->post('id_tema_proyek'),
                    'judul_pertemuan'	 	=> $this->input->post('judul_pertemuan'),
                    'deskripsi_pertemuan'	=> $this->input->post('deskripsi_pertemuan'),
                    'status'	 	        => $this->input->post('status'),
					'created_at' 	        => date('Y-m-d H:i:s')
			);
            
            $this->M_pertemuan->tambahdata($data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di tambahkan');
            redirect('guru/Pertemuan');
		}else{
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$data['temaProyek']=$this->M_tema_proyek->getRecords();
		    $this->load->view('guru/pertemuan/v_create_pertemuan',$data);
			$this->form_validation->set_message('insert');
		}
	}

	public function delete($id)
	{	
		$cekData = $this->db->get_where('tb_permasalahan', array(//making selection
			'id_pertemuan' => $id
		));

        $cekData1 = $this->db->get_where('tb_alur_pembelajaran', array(//making selection
			'id_pertemuan' => $id
		));

		if ($cekData->num_rows() > 0 || $cekData1->num_rows() > 0) {
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('alert', 'Pertemuan terkait tidak dapat dihapus, karena sedang digunakan pada tabel lainnya');
			redirect('guru/Pertemuan');
		}
		else {
			$where = array('id_pertemuan' => $id );
			$hapus = $this->M_pertemuan->hapusdata($where);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
			$this->session->set_flashdata('alert', 'Data Berhasil di hapus');
			redirect('guru/Pertemuan');
		}
	}

	public function edit($id)
	{
		$data['dataById']=$this->M_pertemuan->tampil_view_by_id($id);
		$data['temaProyek']=$this->M_tema_proyek->getRecords();
		$this->load->view('guru/pertemuan/v_edit_pertemuan',$data);
	}

	function do_edit()
	{
		$id = $this->input->post('id_pertemuan');
		if($this->validate_edit() != false){
			$this->form_validation->set_error_delimiters();
			$data = array(
			    'id_tema_proyek'	 	=> $this->input->post('id_tema_proyek'),
                'judul_pertemuan'	 	=> $this->input->post('judul_pertemuan'),
                'deskripsi_pertemuan'	=> $this->input->post('deskripsi_pertemuan'),
                'status'	 	        => $this->input->post('status'),
				'updated_at'		    =>date('Y-m-d H:i:s')
			);

			$this->M_pertemuan->update($id, $data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di ubah');
			redirect("guru/Pertemuan");
		}
		else {
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$data['dataById']=$this->M_pertemuan->tampil_view_by_id($id);
			$this->load->view('guru/pertemuan/v_edit_pertemuan',$data);
			$this->form_validation->set_message('insert');
		}
	}

	public function validate(){
		$this->form_validation->set_rules('no_pertemuan','Nomor Pertemuan','required|is_unique[tb_pertemuan.no_pertemuan]');
        $this->form_validation->set_rules('judul_pertemuan','Judul Pertemuan','required|max_length[100]');
        $this->form_validation->set_rules('status','Status Keaktifan Pertemuan','required');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}

	public function validate_edit(){
        $this->form_validation->set_rules('judul_pertemuan','Judul Pertemuan','required|max_length[100]');
        $this->form_validation->set_rules('status','Status Keaktifan Pertemuan','required');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}
}
?>