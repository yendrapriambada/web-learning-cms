<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {
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
        $this->load->model("M_role_user","",TRUE);
		$this->load->model("M_diskusi","",TRUE);
		$this->load->model("M_jawaban_essai","",TRUE);
		$this->load->model("M_test_unity","",TRUE);
	}

	public function index()
	{
		$data['data']=$this->M_user->getRecordsView();
		$this->load->view('guru/pengguna/v_pengguna',$data);
	}

	public function dataSiswa()
	{
		$data['data']=$this->M_user->getRecordsViewSiswa();
		$this->load->view('guru/pengguna/v_siswa',$data);
	}

    public function dataGuru()
	{
		$data['data']=$this->M_user->getRecordsViewGuru();
		$this->load->view('guru/pengguna/v_guru',$data);
	}

	public function create()
	{
		$data['roleUser'] = $this->M_role_user->getRecords();
		$this->load->view('guru/pengguna/v_create_pengguna',$data);
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
            redirect('guru/Pengguna/create');
        }
        
        $roleUser = $this->input->post('id_role_user');

        $config['upload_path']          = './assets/uploads/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 2000;
        $config['max_width']            = 1024;
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
				redirect('guru/Pengguna/create');
			}else{
				$data_upload_files = $this->upload->data();
				$image = $data_upload_files['file_name'];
			}

            $this->form_validation->set_error_delimiters();
            $data = array(
                'id_role_user'	 	=> $roleUser,
                'nama_lengkap'      => $this->input->post('nama_lengkap'),
				'angkatan'      	=> $this->input->post('angkatan'),
                'sekolah'         	=> $this->input->post('sekolah'),
                'email'             => $this->input->post('email'),
                'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
                'jenis_kelamin'     => $this->input->post('jenis_kelamin'),
                'no_kelompok'       => $this->input->post('no_kelompok'),
                'foto_profil'       => $image,
                'username'          => $this->input->post('username'),
                'password'          => $md5KP,
                'created_at' 	    => date('Y-m-d H:i:s')
            );
            $this->M_user->tambahdata($data);
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di tambahkan');
			
			if($roleUser == 1) {
				redirect('guru/Pengguna/dataSiswa');
			} else if ($roleUser == 2) {
				redirect('guru/Pengguna/dataGuru');
			} else {
				redirect('guru/Pengguna');
			}
		}else{
			$this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$data['roleUser'] = $this->M_role_user->getRecords();
			$this->load->view('guru/pengguna/v_create_pengguna',$data);
            $this->form_validation->set_message('insert');
            
		}
	}

	public function delete($id)
	{	
		$cekData1 = $this->db->get_where('tb_diskusi', array(
			'id_user' => $id
		));

		$cekData2 = $this->db->get_where('tb_jawaban_essai', array(
			'id_user' => $id
		));

		$valid_role_user = $this->db->get_where('tb_user', array(
			'id_user' => $id
		));

		$roleUser = NULL;

		// Mengecek apakah data ditemukan
		if ($valid_role_user->num_rows() > 0) {
			// Mengambil baris pertama dari hasil query
			$user_data = $valid_role_user->row_array();
			
			// Mengakses nilai id_role_user
			$roleUser = $user_data['id_role_user'];
		}

		if ($cekData1->num_rows() > 0 || $cekData2->num_rows() > 0) {
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('alert', 'Akun Pengguna terkait tidak dapat dihapus, karena sedang digunakan pada tabel lainnya');
			if($roleUser == 1) {
				redirect('guru/Pengguna/dataSiswa');
			} else if ($roleUser == 2) {
				redirect('guru/Pengguna/dataGuru');
			} else {
				redirect('guru/Pengguna');
			}
		}
		else {
			$where = array('id_user' => $id );
			$hapus = $this->M_user->hapusdata($where);
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
			$this->session->set_flashdata('alert', 'Data Berhasil di hapus');
			if($roleUser == 1) {
				redirect('guru/Pengguna/dataSiswa');
			} else if ($roleUser == 2) {
				redirect('guru/Pengguna/dataGuru');
			} else {
				redirect('guru/Pengguna');
			}
		}
	}

	public function form_edit($id)
	{
		$data['dataById']=$this->M_user->tampil_view_by_id($id);
		$data['dataRoleUser']=$this->M_role_user->getRecords();
		$this->load->view('guru/pengguna/v_edit_pengguna',$data);
	}

	function do_edit()
	{
		$password = $this->input->post('password');
        $konfimasiPassword = $this->input->post('konfirmasi_password');
		$id = $this->input->post('id_user');
		$roleUser = $this->input->post('id_role_user');
		if($this->validateEdit() != false) {
                $this->form_validation->set_error_delimiters();
                $data = array(
					'id_role_user'	 	=> $roleUser,
					'nama_lengkap'      => $this->input->post('nama_lengkap'),
					'angkatan'      	=> $this->input->post('angkatan'),
					'sekolah'         	=> $this->input->post('sekolah'),
					'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
					'jenis_kelamin'     => $this->input->post('jenis_kelamin'),
					'no_kelompok'       => $this->input->post('no_kelompok'),
					'updated_at'		=> date('Y-m-d H:i:s')
			    );
                $this->M_user->update($id, $data);
				$this->session->set_flashdata('ver', 'FALSE');
				$this->session->set_flashdata('class_alert', 'info');
				$this->session->set_flashdata('alert', 'Data Berhasil di ubah');
				if($roleUser == 1) {
					redirect('guru/Pengguna/dataSiswa');
				} else if ($roleUser == 2) {
					redirect('guru/Pengguna/dataGuru');
				} else {
					redirect('guru/Pengguna');
				}
		}else{
			$data['dataById']=$this->M_user->tampil_view_by_id($id);
			$data['dataRoleUser']=$this->M_role_user->getRecords();
			$this->load->view('guru/pengguna/v_edit_pengguna',$data);
            $this->form_validation->set_message('insert');
		}
	}

	public function edit_profil($id)
	{
		$data['dataById']=$this->M_user->tampil_view_by_id($id);
		$this->load->view('guru/pengguna/v_edit_profil_pengguna',$data);
	}

	function do_edit_profil()
	{
		
		// Ambil data dari form input
		$idUser = $this->input->post('id_user');
		$roleUser = $this->input->post('id_role_user');
	
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
			redirect('guru/Pengguna/edit_profil');
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
				$this->session->set_flashdata('alert', 'Data Berhasil di ubah');
			} else {
				$this->session->set_flashdata('ver', 'FALSE');
				$this->session->set_flashdata('class_alert', 'danger');
				$this->session->set_flashdata('alert', 'Gagal memperbarui profil');
			}
		}
		if($roleUser == 1) {
			redirect('guru/Pengguna/dataSiswa');
		} else if ($roleUser == 2) {
			redirect('guru/Pengguna/dataGuru');
		} else {
			redirect('guru/Pengguna');
		}
	}

	public function validate(){
		$this->form_validation->set_rules('nama_lengkap','Nama pengguna','required|max_length[255]');
		$this->form_validation->set_rules('angkatan','Tahun Angkatan','required|max_length[10]');
        $this->form_validation->set_rules('sekolah','Sekolah','max_length[255]');
        $this->form_validation->set_rules('email','Email','required|max_length[255]|valid_email|is_unique[tb_user.email]');
        $this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required');
        $this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required');
        $this->form_validation->set_rules('no_kelompok', 'No Kelompok', 'numeric|max_length[3]');
        $this->form_validation->set_rules('username','Username','required|max_length[50]|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('konfirmasi_password','Konfirmasi Password','required|max_length[20]|matches[password]');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}

	public function validateEdit(){
		$this->form_validation->set_rules('nama_lengkap','Nama pengguna','required|max_length[255]');
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

	public function dropMhs(){
		$roleUser = 1;  // Role untuk mahasiswa
		
		// Cek apakah ada user dengan id_role_user = 1 (mahasiswa)
		$viewDataUserRoleMHS = $this->db->get_where('tb_user', array('id_role_user' => $roleUser));
		
		if ($viewDataUserRoleMHS->num_rows() > 0) {
			$user_data = $viewDataUserRoleMHS->result(); // Ambil seluruh data user dengan role mahasiswa
			
			foreach ($user_data as $dataMhs) {
				$id = $dataMhs->id_user; // Dapatkan id_user dari setiap mahasiswa
				
				// Cek dan hapus data terkait di tb_diskusi
				$cekData1 = $this->db->get_where('tb_diskusi', array('id_user' => $id));
				if ($cekData1->num_rows() > 0) {
					$where = array('id_user' => $id);
					$this->M_diskusi->hapusdata($where);  // Hapus data diskusi berdasarkan id_user
				}
				
				// Cek dan hapus data terkait di tb_jawaban_essai
				$cekData2 = $this->db->get_where('tb_jawaban_essai', array('id_user' => $id));
				if ($cekData2->num_rows() > 0) {
					$where = array('id_user' => $id);
					$this->M_jawaban_essai->hapusdata($where);  // Hapus data jawaban essai berdasarkan id_user
				}

				// Cek dan hapus data terkait di tb_test_unity
				$cekData3 = $this->db->get_where('tb_test_unity', array('id_user' => $id));
				if ($cekData3->num_rows() > 0) {
					$where = array('id_user' => $id);
					$this->M_test_unity->hapusdata($where);  // Hapus data test unity berdasarkan id_user
				}
        	}

        	// Setelah data terkait terhapus, hapus data pengguna dari tabel 'user'
			$where = array('id_role_user' => $roleUser);
			$this->M_user->hapusdata($where);  // Hapus data user dengan role mahasiswa
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'info');
			$this->session->set_flashdata('alert', 'Data mahasiswa berhasil dihapus');
			
		} else {
			$this->session->set_flashdata('ver', 'TRUE');
			$this->session->set_flashdata('class_alert', 'warning');
			$this->session->set_flashdata('alert', 'Tidak ada data mahasiswa yang ditemukan.');
		}
		
		// Redirect ke halaman data siswa
		redirect('guru/Pengguna/dataSiswa');

		}
	}
?>