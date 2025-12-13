<?php
	class UbahKataSandi extends CI_Controller{
        public function __construct(){
            parent::__construct();

            if (!$this->session->userdata('logged_in')) {
                redirect('./Login');
            }

            $this->load->model("M_pertemuan","",TRUE);
            $this->load->model('M_user',"",TRUE);
        }

		function index(){
            $data['pertemuan'] = $this->M_pertemuan->getRecordsView();
			$this->load->view('siswa/v_ubah_password',$data);
		}

		function do_edit()
		{
            $password_lama = $this->input->post('password_lama');
			$password = $this->input->post('password');
			$konfimasiPassword = $this->input->post('konfirmasi_password');
			$idUser = $this->input->post('id_user');

			$cekUser = $this->db->get_where('tb_user', array(//making selection
				'id_user' => $idUser
			));
	

			if ($cekUser->num_rows() > 0) {
                $dataUser = $cekUser->row();
				if ($dataUser->password == md5($password_lama)) {
                    if ($password != $konfimasiPassword) {
                        $this->session->set_flashdata('ver', 'FALSE');
                        $this->session->set_flashdata('class_alert', 'danger');
                        $this->session->set_flashdata('error', 'Password dan Konfirmasi Password Berbeda');
                        redirect("siswa/UbahKataSandi");
                    } else {
                        if($this->validate() != false) {
                            $this->form_validation->set_error_delimiters();
                            $data = array(
                                'password'      => md5($password),
                                'updated_at'	=> date('Y-m-d H:i:s')
                            );
                            $this->M_user->update($username, $data);
                            $this->session->set_flashdata('ver', 'FALSE');
                            $this->session->set_flashdata('class_alert', 'info');
                            $this->session->set_flashdata('alert', 'Password Berhasil di Ubah');
                            $this->session->sess_destroy();
                            redirect("Login");
                        }
                        else{
                            $this->session->set_flashdata('ver', 'FALSE');
                            $this->session->set_flashdata('class_alert', 'danger');
                            $this->session->set_flashdata('error', 'Validasition Form Error');
                            $data['pertemuan'] = $this->M_pertemuan->getRecordsView();
                            $this->load->view('siswa/v_ubah_password',$data);
                            $this->form_validation->set_message('insert');
                        }
                    }
                }
                else 
                {
                    $this->session->set_flashdata('ver', 'FALSE');
                    $this->session->set_flashdata('class_alert', 'danger');
                    $this->session->set_flashdata('error', 'Password lama yang anda masukan tidak sesuai');
                    redirect("siswa/UbahKataSandi");
                }
			}
			else 
			{
				$this->session->set_flashdata('ver', 'FALSE');
                $this->session->set_flashdata('class_alert', 'danger');
				$this->session->set_flashdata('error', 'Pengguna tidak ditemukan');
				redirect("siswa/UbahPassword");
			}
				
		}

        function validate(){
            $this->form_validation->set_rules('password_lama','Password Lama','required|max_length[20]');
            $this->form_validation->set_rules('password','Password Baru','required|max_length[20]');
            $this->form_validation->set_rules('konfirmasi_password','Konfirmasi Password Baru','required|max_length[20]|matches[password]');
            if($this->form_validation->run()){
                return true;
            }else{
                return false;
            }
        }
	}
?>