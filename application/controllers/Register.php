<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct(){
		parent::__construct();
			
		$this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
		$this->load->model("M_user","",TRUE);
        $this->load->model("M_role_user","",TRUE);
        $this->load->model("M_pertemuan","",TRUE);
	}

	public function index()
	{
        $data['roleUser'] = $this->M_role_user->getRecords();
        $data['pertemuan'] = $this->M_pertemuan->getRecordsView();
		$this->load->view('v_register',$data);
	}

	public function do_input()
	{
        $password = $this->input->post('password');
        $konfirmasiPassword = $this->input->post('konfirmasi_password');

        // Periksa apakah konfirmasiPassword tidak null dan bukan string kosong
        if (!empty($konfirmasiPassword)) {
            $md5KP = md5($konfirmasiPassword);
        } else {
            $md5KP = null;
            log_message('error', 'Konfirmasi password untuk md5() kosong atau null.');
            // Anda mungkin ingin mengatur pesan kesalahan atau mengarahkan ulang pengguna
            // Redirect atau set error message
            redirect('Register');
        }
        
        $roleUser = $this->input->post('id_role_user');

        $inputKodeDosen = $this->input->post('kode_dosen');
        $kodeDosen = "IPATerpaduDosen_0808";

        $config['upload_path']          = './assets/uploads/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 2000;
        $config['max_width']            = 2024;
        $config['encrypt_name']         = TRUE; // Untuk menghindari duplikasi nama file

		$image=" ";

		if($this->validate() != false) {

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('foto_profil')){
				// If the upload fails
				$this->session->set_flashdata('ver', 'FALSE');
				$this->session->set_flashdata('class_alert', 'danger');
				$this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('Register');
			}else{
				$data_upload_files = $this->upload->data();
				$image = $data_upload_files['file_name'];
			}

            if($roleUser == "2") {
                if ($inputKodeDosen == $kodeDosen) {
                    $data = array(
                        'id_role_user'	 	=> $roleUser,
                        'nama_lengkap'      => $this->input->post('nama_lengkap'),
                        'sekolah'         	=> $this->input->post('sekolah'),
                        'email'             => $this->input->post('email'),
                        'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
                        'jenis_kelamin'     => $this->input->post('jenis_kelamin'),
                        'angkatan'          => $this->input->post('angkatan'),
                        'foto_profil'       => $image,
                        'username'          => $this->input->post('username'),
                        'password'          => $md5KP,
                        'created_at' 	    => date('Y-m-d H:i:s')
                    );
                    $this->M_user->tambahdata($data);
                    $this->session->set_flashdata('ver', 'FALSE');
                    $this->session->set_flashdata('class_alert', 'info');
                    $this->session->set_flashdata('error', 'Data Berhasil di tambahkan');
                    redirect('Login');
                }
                else {
                    $this->session->set_flashdata('ver', 'FALSE');
                    $this->session->set_flashdata('class_alert', 'danger');
                    $this->session->set_flashdata('error', 'Kode Dosen yang anda masukan keliru, harap hubungi admin untuk mendapatkan kode yang benar jika anda akan membuat akun baru sebagai dosen');
                    redirect('Register');
                }
                
            }
            else {
                $this->form_validation->set_error_delimiters();
                $data = array(
                    'id_role_user'	 	=> $roleUser,
                    'nama_lengkap'      => $this->input->post('nama_lengkap'),
                    'sekolah'         	=> $this->input->post('sekolah'),
                    'email'             => $this->input->post('email'),
                    'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
                    'jenis_kelamin'     => $this->input->post('jenis_kelamin'),
                    'angkatan'          => $this->input->post('angkatan'),
                    'foto_profil'       => $image,
                    'username'          => $this->input->post('username'),
                    'password'          => $md5KP,
                    'created_at' 	    => date('Y-m-d H:i:s')
                );
                $this->M_user->tambahdata($data);
                $this->session->set_flashdata('ver', 'FALSE');
                $this->session->set_flashdata('class_alert', 'info');
                $this->session->set_flashdata('error', 'Data Berhasil di tambahkan');
                redirect('Login');
            }
		}else{
			$this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$data['roleUser'] = $this->M_role_user->getRecords();
			$this->load->view('v_register',$data);
            $this->form_validation->set_message('insert');
            
		}
	}

	public function validate(){
		$this->form_validation->set_rules('nama_lengkap','Nama pengguna','required|max_length[255]');
        $this->form_validation->set_rules('sekolah','Sekolah','max_length[255]');
        $this->form_validation->set_rules('angkatan','Angkatan','required|max_length[10]');
        $this->form_validation->set_rules('email','Email','required|max_length[255]|valid_email|is_unique[tb_user.email]');
        $this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required');
        $this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required');
        $this->form_validation->set_rules('username','Username','required|max_length[50]|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('konfirmasi_password','Konfirmasi Password','required|max_length[20]|matches[password]');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}
}
?>