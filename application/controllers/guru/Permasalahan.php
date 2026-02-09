<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permasalahan extends CI_Controller {
    public $session;
    public $upload;
    public $form_validation;
    public $input;
    public $db;
    public $M_permasalahan;
    public $M_pertemuan;
    public $load;
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}	
			
		$this->load->library('form_validation');
        $this->load->model("M_permasalahan","",TRUE);
		$this->load->model("M_pertemuan","",TRUE);
	}

	public function index()
	{
		$data['data']=$this->M_permasalahan->getRecordsView();
		$this->load->view('guru/permasalahan/v_permasalahan',$data);
	}

	public function create()
	{
		$data['pertemuan'] = $this->M_pertemuan->getRecords();
		$this->load->view('guru/permasalahan/v_create_permasalahan',$data);
	}

	public function do_create()
	{
        $config['upload_path']          = './assets/soal/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 2000;
        $config['max_width']            = 1024;
		$config['encrypt_name']         = TRUE; // Untuk menghindari duplikasi nama file

		$image=" ";

		if($this->validate() != false) {
            if (!empty($_FILES['foto']['name'])) {
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
        
                if (!$this->upload->do_upload('foto')) {
                    // If the upload fails
                    $this->session->set_flashdata('ver', 'FALSE');
                    $this->session->set_flashdata('class_alert', 'danger');
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('guru/Permasalahan/create');
                } else {
                    $data_upload_files = $this->upload->data();
                    $image = $data_upload_files['file_name'];
                }
            } else {
                // No file uploaded
                $image=" ";
            }

            $this->form_validation->set_error_delimiters();
            $data = array(
                'id_pertemuan'      		=> $this->input->post('id_pertemuan'),
                'tahapan_pembelajaran'      => $this->input->post('tahapan_pembelajaran'),
                'judul_permasalahan'        => $this->input->post('judul_permasalahan'),
                'deskripsi_permasalahan'    => $this->input->post('deskripsi_permasalahan'),
                'foto'    	                => $image,
                'jumlah_soal'               => $this->input->post('jumlah_soal'),
                'link_permasalahan'         => $this->input->post('link_permasalahan'),
                'created_at' 	    		=> date('Y-m-d H:i:s')
            );
            $this->M_permasalahan->tambahdata($data);
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di tambahkan');
			redirect('guru/Permasalahan');

		}else{
			$this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$data['pertemuan'] = $this->M_pertemuan->getRecords();
		    $this->load->view('guru/permasalahan/v_create_permasalahan',$data);
            $this->form_validation->set_message('insert');
            
		}
	}

	public function delete($id)
	{
        $cekData1 = $this->db->get_where('tb_soal_essai', array(
			'id_permasalahan' => $id
		));

        if ($cekData1->num_rows() > 0) {
			$this->session->set_flashdata('ver', 'FALSE');
			$this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('alert', 'Permasalahan Pengguna terkait tidak dapat dihapus, karena sedang digunakan pada tabel lainnya');
			redirect('guru/Permasalahan');
		}
		else {
            $where = array('id_permasalahan' => $id );
            $hapus = $this->M_permasalahan->hapusdata($where);
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di hapus');
            redirect('guru/Permasalahan');
        }
	}

	public function edit($id)
	{
		$data['pertemuan'] = $this->M_pertemuan->getRecords();
		$data['dataById']=$this->M_permasalahan->tampil_view_by_id($id);
		$this->load->view('guru/permasalahan/v_edit_permasalahan',$data);
	}

	function do_edit()
	{
        $id = $this->input->post('id_permasalahan');

        $config['upload_path']          = './assets/soal/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 2000;
        $config['max_width']            = 1024;
		$config['encrypt_name']         = TRUE; // Untuk menghindari duplikasi nama file

		$image=" ";

		if($this->validate() != false) {
            $this->form_validation->set_error_delimiters();
            if (!empty($_FILES['foto']['name'])) {
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
        
                if (!$this->upload->do_upload('foto')) {
                    // If the upload fails
                    $this->session->set_flashdata('ver', 'FALSE');
                    $this->session->set_flashdata('class_alert', 'danger');
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('guru/Permasalahan/create');
                } else {
                    $data_upload_files = $this->upload->data();
                    $image = $data_upload_files['file_name'];
                }
                
                $data = array(
                    'id_pertemuan'      		=> $this->input->post('id_pertemuan'),
                    'tahapan_pembelajaran'      => $this->input->post('tahapan_pembelajaran'),
                    'judul_permasalahan'        => $this->input->post('judul_permasalahan'),
                    'deskripsi_permasalahan'    => $this->input->post('deskripsi_permasalahan'),
                    'foto'    	                => $image,
                    'jumlah_soal'               => $this->input->post('jumlah_soal'),
                    'link_permasalahan'         => $this->input->post('link_permasalahan'),
                    'updated_at' 	    		=> date('Y-m-d H:i:s')
                );
            } else {
                // No file uploaded
                $data = array(
                    'id_pertemuan'      		=> $this->input->post('id_pertemuan'),
                    'tahapan_pembelajaran'      => $this->input->post('tahapan_pembelajaran'),
                    'judul_permasalahan'        => $this->input->post('judul_permasalahan'),
                    'deskripsi_permasalahan'    => $this->input->post('deskripsi_permasalahan'),
                    'jumlah_soal'               => $this->input->post('jumlah_soal'),
                    'link_permasalahan'         => $this->input->post('link_permasalahan'),
                    'updated_at' 	    		=> date('Y-m-d H:i:s')
                );
            }
            $this->M_permasalahan->update($id, $data);
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di ubah');
            redirect('guru/Permasalahan');
		}else{
			$this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$data['pertemuan'] = $this->M_pertemuan->getRecords();
			$data['dataById']=$this->M_permasalahan->tampil_view_by_id($id);
			$this->load->view('guru/permasalahan/v_edit_permasalahan',$data);
            $this->form_validation->set_message('insert');
		}
	}

	public function validate(){
		$this->form_validation->set_rules('id_pertemuan','Pertemuan','required');
		$this->form_validation->set_rules('tahapan_pembelajaran','Tahapan Pembelajaran','required');
        $this->form_validation->set_rules('jumlah_soal','Jumlah Soal','required');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}

    function hapus_foto_permasalahan($id)
	{
	
        // Update data permasalahan di database
        $data = array(
            'foto' => " "
        );
        $this->M_permasalahan->update($id, $data);
		redirect('guru/Permasalahan');
	}
}
?>
