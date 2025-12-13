<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('M_user',"",TRUE);
		$this->load->model("M_pertemuan","",TRUE);
	}

	public function index()
	{
		$data['pertemuan'] = $this->M_pertemuan->getRecordsView();
		$this->load->view('v_login', $data);
	}

	function setSession($data)
	{
		$dataById=$this->M_user->tampil_view_by_id($data->id_user);
		$this->session->set_userdata('username', $dataById->username);
		$this->session->set_userdata('password', $dataById->password);
		$this->session->set_userdata('id_user', $dataById->id_user);
		$this->session->set_userdata('id_role_user', $dataById->id_role_user);
		$this->session->set_userdata('nama_lengkap', $dataById->nama_lengkap);
		$this->session->set_userdata('tanggal_lahir', $dataById->tanggal_lahir);
		$this->session->set_userdata('sekolah', $dataById->sekolah);
		$this->session->set_userdata('jenis_kelamin', $dataById->jenis_kelamin);
		$this->session->set_userdata('email', $dataById->email);
		$this->session->set_userdata('foto_profil', $dataById->foto_profil);
		$this->session->set_userdata('role_user', $dataById->role_user);
		$this->session->set_userdata('angkatan', $dataById->angkatan);

		$this->session->set_userdata('logged_in', TRUE);

		switch ($data->id_role_user) {
			case '1': //Siswa
						redirect('siswa/PengenalanMataKuliah');
						break;
			case '2': //Guru
						redirect('guru/Beranda');
						break;
		}
	}

	function proseslogin(){

		$this->form_validation->set_rules('username','Username','required|max_length[50]');
		$this->form_validation->set_rules('password','Password','required|max_length[20]');
		$password = $this->input->post('password');
		$username = $this->input->post('username');

		if($this->form_validation->run() == FALSE){
			$this->form_validation->set_message('insert');
			$data['pertemuan'] = $this->M_pertemuan->getRecordsView();
			$this->load->view("v_login");
		}else{
			$valid_user = $this->db->get_where('tb_user', array(
				'username' => $username
			));

			if($valid_user->num_rows() > 0)
			{
				$data = $valid_user->row();
				if ($data->password == md5($password)) {
					$this->setSession($data);
				} else {
					$this->session->set_flashdata('logged_in', '0');
					$this->session->set_flashdata('class_alert', 'danger');
					$this->session->set_flashdata('error', 'Password yang anda masukan keliru');
					redirect('Login');
				}
			} else {
				$valid_user = $this->db->get_where('tb_user', array(
					'email' => $username
				));

				if($valid_user->num_rows() > 0)
				{
					$data = $valid_user->row();
					if ($data->password == md5($password)) {
						$this->setSession($data);
					} else {
						$this->session->set_flashdata('logged_in', '0');
						$this->session->set_flashdata('class_alert', 'danger');
						$this->session->set_flashdata('error', 'Password yang anda masukan keliru');
						redirect('Login');
					}
				} else {
					$this->session->set_flashdata('logged_in', '0');
					$this->session->set_flashdata('class_alert', 'danger');
					$this->session->set_flashdata('error', 'Username atau Email Tidak di temukan');
					redirect('Login');
				}
			}

		}
	}

	public function forgot_password()
	{
		$data['pertemuan'] = $this->M_pertemuan->getRecordsView();
		$this->load->view('v_lupa_password',$data);
	}

	function do_forgot_password()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$konfirmasiPassword = $this->input->post('konfirmasi_password');
		$username = $this->input->post('username');

		$cekUsername = $this->db->get_where('tb_user', array(//making selection
			'username' => $username
		));


		if ($cekUsername->num_rows() > 0) {
			$dataUser = $cekUsername->row();
			if ($dataUser->email == $email) {
				if ($password != $konfirmasiPassword) {
					$this->session->set_flashdata('ver', 'FALSE');
					$this->session->set_flashdata('class_alert', 'danger');
					$this->session->set_flashdata('error', 'Password dan Konfirmasi Password Berbeda');
					redirect("Login/forgot_password");
				} else {
					$data = array(
						'password'      => md5($konfirmasiPassword),
						'updated_at'	=> date('Y-m-d H:i:s')
					);
					$this->M_user->update($dataUser->id_user, $data);
					$this->session->set_flashdata('ver', 'FALSE');
					$this->session->set_flashdata('class_alert', 'info');
					$this->session->set_flashdata('error', 'Password Berhasil di Ubah');
					redirect("Login");
				}
			}
			else 
			{
				$this->session->set_flashdata('ver', 'FALSE');
				$this->session->set_flashdata('class_alert', 'danger');
				$this->session->set_flashdata('error', 'Email tidak terdaftar pada username terkait');
				redirect("Login/forgot_password");
			}
		}
		else 
		{
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'danger');
			$this->session->set_flashdata('error', 'Username tidak ditemukan');
			redirect("Login/forgot_password");
		}
			
	}

	public function validate(){
        $this->form_validation->set_rules('email','Email','required|max_length[255]|valid_email');
        $this->form_validation->set_rules('username','Username','required|max_length[50]');
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('konfirmasi_password','Konfirmasi Password','required|max_length[18]');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}
}
