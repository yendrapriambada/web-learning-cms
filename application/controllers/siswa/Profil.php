<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
			
		$this->load->library('form_validation');
		$this->load->model("M_pertemuan","",TRUE);
		$this->load->model("M_user","",TRUE);
	}

	public function index()
	{
		$data['pertemuan'] = $this->M_pertemuan->getRecordsView();
		$data['data']=$this->M_user->tampil_view_by_id($this->session->userdata('id_user'));
		$this->load->view('siswa/profil/v_profil',$data);
	}

	public function form_edit($id)
	{
		$data['pertemuan'] = $this->M_pertemuan->getRecordsView();
		$data['dataById']=$this->M_user->tampil_view_by_id($id);
		$this->load->view('siswa/profil/v_edit_profil',$data);
	}

	function do_edit()
	{
		$id = $this->input->post('id_user');
		if($this->validateEdit() != false) {
                $this->form_validation->set_error_delimiters();
                $data = array(
					'nama_lengkap'      => $this->input->post('nama_lengkap'),
					'sekolah'         	=> $this->input->post('sekolah'),
					'angkatan'         	=> $this->input->post('angkatan'),
					'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
					'jenis_kelamin'     => $this->input->post('jenis_kelamin'),
					'no_kelompok'       => $this->input->post('no_kelompok'),
					'updated_at'		=> date('Y-m-d H:i:s')
			    );
                $this->M_user->update($id, $data);
				$this->session->set_flashdata('ver', 'FALSE');
				$this->session->set_flashdata('class_alert', 'info');
				$this->session->set_flashdata('alert', 'Data Berhasil di ubah');
				redirect('siswa/Profil');
		}else{
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validasition Form Error');
			$data['pertemuan'] = $this->M_pertemuan->getRecordsView();
			$data['dataById']=$this->M_user->tampil_view_by_id($id);
    		$this->load->view('siswa/profil/v_edit_profil',$data);
            $this->form_validation->set_message('insert');
		}
	}

	public function edit_foto_profil($id)
	{
		$data['pertemuan'] = $this->M_pertemuan->getRecordsView();
		$data['dataById']=$this->M_user->tampil_view_by_id($id);
		$this->load->view('siswa/profil/v_edit_foto_profil',$data);
	}

	function do_edit_foto_profil()
	{
		
		// Ambil data dari form input
		$idUser = $this->input->post('id_user');
	
		// Konfigurasi upload file
		$config['upload_path']          = './assets/uploads/';
		$config['allowed_types']        = 'jpeg|jpg|png';
		$config['max_size']             = 1000;
		$config['max_width']            = 1024;
		$config['encrypt_name']         = TRUE; // Untuk menghindari duplikasi nama file
	
		$this->upload->initialize($config);
	
		$image = "";
	
		if (!$this->upload->do_upload('foto_profil')) {
			// Jika upload gagal
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'danger');
			$this->session->set_flashdata('error', $this->upload->display_errors());
			$data['pertemuan'] = $this->M_pertemuan->getRecordsView();
            $data['dataById']=$this->M_user->tampil_view_by_id($idUser);
			$this->load->view('siswa/profil/v_edit_foto_profil',$data);
		} else {
			// Jika upload berhasil
			$data_upload_files = $this->upload->data();
			$image = $data_upload_files['file_name'];
	
			// Update data user di database
			$data = array(
				'foto_profil' => $image
			);
	
			$this->db->where('id_user', $idUser);
			if ($this->db->update('tb_user', $data)) {
				$this->session->set_flashdata('ver', 'FALSE');
				$this->session->set_flashdata('class_alert', 'success');
				$this->session->set_flashdata('alert', 'Data Foto Profil Berhasil di ubah');
			} else {
				$this->session->set_flashdata('ver', 'FALSE');
				$this->session->set_flashdata('class_alert', 'danger');
				$this->session->set_flashdata('alert', 'Gagal memperbarui foto profil');
			}
			redirect('siswa/Profil');
		}
	}

	public function validateEdit(){
		$this->form_validation->set_rules('nama_lengkap','Nama pengguna','required|max_length[255]');
		$this->form_validation->set_rules('angkatan','Angkatan','required|max_length[10]');
        $this->form_validation->set_rules('sekolah','Sekolah','max_length[255]');
        $this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required');
        $this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required');
        $this->form_validation->set_rules('no_kelompok', 'No Kelompok', 'numeric|max_length[3]');
        
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}
}
?>