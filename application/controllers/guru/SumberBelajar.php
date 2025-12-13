<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SumberBelajar extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}
			
		$this->load->library('form_validation');
		$this->load->model("M_sumber_belajar","",TRUE);
	}

	public function index()
	{
		$data['data']=$this->M_sumber_belajar->getRecords();
		$this->load->view('guru/sumber_belajar/v_sumber_belajar',$data);
	}

	public function create()
	{
		$this->load->view('guru/sumber_belajar/v_create_sumber_belajar');
	}

	public function do_create()
	{
		if($this->validate() != false){
		    
		    // --- UPLOAD THUMBNAIL (WAJIB) ---
			$this->load->library('upload');

			$config_thumb['upload_path']   = FCPATH.'assets/sumber_belajar/thumbnail/';
			$config_thumb['allowed_types'] = 'jpg|jpeg|png';
			$config_thumb['max_size']      = 2048; // KB
			$config_thumb['file_name']     = 'thumb_'.time().'_'.rand(1000,9999);

			$this->upload->initialize($config_thumb);

			if ( ! $this->upload->do_upload('thumbnail')) {
				// Jika upload thumbnail gagal
				$this->session->set_flashdata('ver', 'FALSE');
				$this->session->set_flashdata('class_alert', 'danger');
				$this->session->set_flashdata('error', $this->upload->display_errors());
				$this->load->view('guru/sumber_belajar/v_create_sumber_belajar');
				return;
			} else {
				$thumb_data = $this->upload->data();
				$thumbnail  = $thumb_data['file_name'];
			}
			
			// --- UPLOAD PDF SUMBER BELAJAR (WAJIB) ---
			$config_pdf['upload_path']   = FCPATH.'assets/sumber_belajar/pdf/';
			$config_pdf['allowed_types'] = 'pdf';
			$config_pdf['max_size']      = 5120; // KB
			$config_pdf['file_name']     = 'pdf_'.time().'_'.rand(1000,9999);

			$this->upload->initialize($config_pdf);

			if ( ! $this->upload->do_upload('pdf_sumber_belajar')) {
				// Jika upload PDF gagal, hapus thumbnail yang tadi sudah ter-upload
				if (!empty($thumbnail) && file_exists(FCPATH.'assets/sumber_belajar/thumbnail/'.$thumbnail)) {
					@unlink(FCPATH.'assets/sumber_belajar/thumbnail/'.$thumbnail);
				}

				$this->session->set_flashdata('ver', 'FALSE');
				$this->session->set_flashdata('class_alert', 'danger');
				$this->session->set_flashdata('error', $this->upload->display_errors());
				$this->load->view('guru/sumber_belajar/v_create_sumber_belajar');
				return;
			} else {
				$pdf_data           = $this->upload->data();
				$pdf_sumber_belajar = $pdf_data['file_name'];
			}

            $this->form_validation->set_error_delimiters();
            $data = array(
                    'judul'	 	            => $this->input->post('judul'),
                    'thumbnail'	            => $thumbnail, //upload foto
                    'pdf_sumber_belajar'	=> $pdf_sumber_belajar, //upload file pdf
					'created_at' 	        => date('Y-m-d H:i:s')
			);
            
            $this->M_sumber_belajar->tambahdata($data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di tambahkan');
            redirect('guru/SumberBelajar');
		}else{
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$this->load->view('guru/sumber_belajar/v_create_sumber_belajar');
			$this->form_validation->set_message('insert');
		}
	}

	public function delete($id)
	{
	    // ambil dulu data lama untuk hapus file fisik
		$data_lama = $this->M_sumber_belajar->tampil_by_id($id);
		if ($data_lama) {
			if (!empty($data_lama->thumbnail) && file_exists(FCPATH.'assets/sumber_belajar/thumbnail/'.$data_lama->thumbnail)) {
				@unlink(FCPATH.'assets/sumber_belajar/thumbnail/'.$data_lama->thumbnail);
			}
			if (!empty($data_lama->pdf_sumber_belajar) && file_exists(FCPATH.'assets/sumber_belajar/pdf/'.$data_lama->pdf_sumber_belajar)) {
				@unlink(FCPATH.'assets/sumber_belajar/pdf/'.$data_lama->pdf_sumber_belajar);
			}
		}
		
		$where = array('id_sumber_belajar' => $id );
		$hapus = $this->M_sumber_belajar->hapusdata($where);
		$this->session->set_flashdata('ver', 'FALSE');
		$this->session->set_flashdata('class_alert', 'info');
		$this->session->set_flashdata('alert', 'Data Berhasil di hapus');
		redirect('guru/SumberBelajar');
	}

	public function edit($id)
	{
		$data['dataById']=$this->M_sumber_belajar->tampil_by_id($id);
		$this->load->view('guru/sumber_belajar/v_edit_sumber_belajar',$data);
	}

	function do_edit()
	{
		$id = $this->input->post('id_sumber_belajar');
		
		// ambil data lama
		$data_lama = $this->M_sumber_belajar->tampil_by_id($id);
		if(!$data_lama){
			redirect('guru/SumberBelajar');
		}
		
		if($this->validate() != false){
		    $this->load->library('upload');

			// default: pakai file lama
			$thumbnail          = $data_lama->thumbnail;
			$pdf_sumber_belajar = $data_lama->pdf_sumber_belajar;
			
			// --- JIKA ADA THUMBNAIL BARU YANG DIUPLOAD ---
			if (!empty($_FILES['thumbnail']['name'])) {
				$config_thumb['upload_path']   = FCPATH.'assets/sumber_belajar/thumbnail/';
				$config_thumb['allowed_types'] = 'jpg|jpeg|png';
				$config_thumb['max_size']      = 2048;
				$config_thumb['file_name']     = 'thumb_'.time().'_'.rand(1000,9999);

				$this->upload->initialize($config_thumb);

				if ( ! $this->upload->do_upload('thumbnail')) {
					$this->session->set_flashdata('ver', 'FALSE');
					$this->session->set_flashdata('class_alert', 'danger');
					$this->session->set_flashdata('error', $this->upload->display_errors());

					$data['dataById']=$this->M_sumber_belajar->tampil_by_id($id);
					$this->load->view('guru/sumber_belajar/v_edit_sumber_belajar',$data);
					return;
				} else {
					$thumb_data = $this->upload->data();
					$thumbnail  = $thumb_data['file_name'];

					// hapus file thumbnail lama
					if (!empty($data_lama->thumbnail) && file_exists(FCPATH.'assets/sumber_belajar/thumbnail/'.$data_lama->thumbnail)) {
						@unlink(FCPATH.'assets/sumber_belajar/thumbnail/'.$data_lama->thumbnail);
					}
				}
			}

			// --- JIKA ADA PDF BARU YANG DIUPLOAD ---
			if (!empty($_FILES['pdf_sumber_belajar']['name'])) {
				$config_pdf['upload_path']   = FCPATH.'assets/sumber_belajar/pdf/';
				$config_pdf['allowed_types'] = 'pdf';
				$config_pdf['max_size']      = 5120;
				$config_pdf['file_name']     = 'pdf_'.time().'_'.rand(1000,9999);

				$this->upload->initialize($config_pdf);

				if ( ! $this->upload->do_upload('pdf_sumber_belajar')) {
					$this->session->set_flashdata('ver', 'FALSE');
					$this->session->set_flashdata('class_alert', 'danger');
					$this->session->set_flashdata('error', $this->upload->display_errors());

					$data['dataById']=$this->M_sumber_belajar->tampil_by_id($id);
					$this->load->view('guru/sumber_belajar/v_edit_sumber_belajar',$data);
					return;
				} else {
					$pdf_data           = $this->upload->data();
					$pdf_sumber_belajar = $pdf_data['file_name'];

					// hapus file pdf lama
					if (!empty($data_lama->pdf_sumber_belajar) && file_exists(FCPATH.'assets/sumber_belajar/pdf/'.$data_lama->pdf_sumber_belajar)) {
						@unlink(FCPATH.'assets/sumber_belajar/pdf/'.$data_lama->pdf_sumber_belajar);
					}
				}
			}
			
			$this->form_validation->set_error_delimiters();
			$data = array(
                    'judul'	 	            => $this->input->post('judul'),
                    'thumbnail'	            => $thumbnail, //jika ada foto yang diupload, foto lama di file hapus
                    'pdf_sumber_belajar'	=> $pdf_sumber_belajar, //jika ada file yang diupload, file lama di file hapus
					'updated_at' 	        => date('Y-m-d H:i:s')
			);
			
			$this->M_sumber_belajar->update($id, $data);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di ubah');
			redirect("guru/SumberBelajar");
		}
		else {
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$data['dataById']=$this->M_sumber_belajar->tampil_by_id($id);
	    	$this->load->view('guru/sumber_belajar/v_edit_sumber_belajar',$data);
			$this->form_validation->set_message('insert');
		}
	}

	public function validate(){
        $this->form_validation->set_rules('judul','Judul Sumber Belajar','required|max_length[300]');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}
}
?>