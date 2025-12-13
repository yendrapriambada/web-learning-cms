<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlurPerkuliahan extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }
		if ($this->session->userdata('id_role_user') != '2') {
			redirect('./Login');
		}	
			
		$this->load->library('form_validation');
		$this->load->model("M_alur_pembelajaran","",TRUE);
        $this->load->model("M_mata_kuliah","",TRUE);
		$this->load->model("M_pertemuan","",TRUE);
	}

	public function index()
	{
		$data['data']=$this->M_alur_pembelajaran->getRecordsView();
		$this->load->view('guru/alur_perkuliahan/v_alur_perkuliahan',$data);
	}

	public function create()
	{
		$data['matkul'] = $this->M_mata_kuliah->getRecords();
		$data['pertemuan'] = $this->M_pertemuan->getRecords();
		$this->load->view('guru/alur_perkuliahan/v_create_alur_perkuliahan',$data);
	}

	public function do_create()
	{
		if($this->validate() != false) {

            $this->form_validation->set_error_delimiters();
            $data = array(
                'id_mata_kuliah'	 		=> $this->input->post('id_mata_kuliah'),
                'id_pertemuan'      		=> $this->input->post('id_pertemuan'),
                'indikator_pembelajaran'    => $this->input->post('indikator_pembelajaran'),
                'bahan_kajian'             	=> $this->input->post('bahan_kajian'),
                'aktivitas_perkuliahan'     => $this->input->post('aktivitas_perkuliahan'),
                'pengalaman_belajar'    	=> $this->input->post('pengalaman_belajar'),
                'kebutuhan_pembelajaran'    => $this->input->post('kebutuhan_pembelajaran'),
                'alokasi_waktu'          	=> $this->input->post('alokasi_waktu'),
				'deskripsi_tugas'          	=> $this->input->post('deskripsi_tugas'),
                'created_at' 	    		=> date('Y-m-d H:i:s')
            );
            $this->M_alur_pembelajaran->tambahdata($data);
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'Data Berhasil di tambahkan');
			redirect('guru/AlurPerkuliahan');

		}else{
			$this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$data['matkul'] = $this->M_mata_kuliah->getRecords();
			$data['pertemuan'] = $this->M_pertemuan->getRecords();
		    $this->load->view('guru/alur_perkuliahan/v_create_alur_perkuliahan',$data);
            $this->form_validation->set_message('insert');
            
		}
	}

	public function delete($id)
	{
		$where = array('id_alur_pembelajaran' => $id );
		$hapus = $this->M_alur_pembelajaran->hapusdata($where);
		$this->session->set_flashdata('ver', 'FALSE');
		$this->session->set_flashdata('class_alert', 'info');
		$this->session->set_flashdata('alert', 'Data Berhasil di hapus');
		redirect('guru/AlurPerkuliahan');
	}

	public function edit($id)
	{
		$data['matkul'] = $this->M_mata_kuliah->getRecords();
		$data['pertemuan'] = $this->M_pertemuan->getRecords();
		$data['dataById']=$this->M_alur_pembelajaran->tampil_view_by_id($id);
		$this->load->view('guru/alur_perkuliahan/v_edit_alur_perkuliahan',$data);
	}

	function do_edit()
	{
		$id = $this->input->post('id_alur_pembelajaran');
		if($this->validate() != false) {
                $this->form_validation->set_error_delimiters();
                $data = array(
					'id_mata_kuliah'	 		=> $this->input->post('id_mata_kuliah'),
					'id_pertemuan'      		=> $this->input->post('id_pertemuan'),
					'indikator_pembelajaran'    => $this->input->post('indikator_pembelajaran'),
					'bahan_kajian'             	=> $this->input->post('bahan_kajian'),
					'aktivitas_perkuliahan'     => $this->input->post('aktivitas_perkuliahan'),
					'pengalaman_belajar'    	=> $this->input->post('pengalaman_belajar'),
					'kebutuhan_pembelajaran'    => $this->input->post('kebutuhan_pembelajaran'),
					'alokasi_waktu'          	=> $this->input->post('alokasi_waktu'),
					'deskripsi_tugas'          	=> $this->input->post('deskripsi_tugas'),
					'updated_at'				=> date('Y-m-d H:i:s')
			    );
                $this->M_alur_pembelajaran->update($id, $data);
				$this->session->set_flashdata('ver', 'FALSE');
				$this->session->set_flashdata('class_alert', 'info');
				$this->session->set_flashdata('alert', 'Data Berhasil di ubah');
				redirect('guru/AlurPerkuliahan');
		}else{
			$this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'danger');
            $this->session->set_flashdata('error', 'Validation Form Input Error');
			$data['matkul'] = $this->M_mata_kuliah->getRecords();
			$data['pertemuan'] = $this->M_pertemuan->getRecords();
			$data['dataById']=$this->M_alur_pembelajaran->tampil_view_by_id($id);
			$this->load->view('guru/alur_perkuliahan/v_edit_alur_perkuliahan',$data);
            $this->form_validation->set_message('insert');
		}
	}

	public function validate(){
		$this->form_validation->set_rules('indikator_pembelajaran','Indikator Pembelajaran','required');
		$this->form_validation->set_rules('aktivitas_perkuliahan','Aktivitas Perkuliahan','required');
		$this->form_validation->set_rules('pengalaman_belajar','Aktivitas Perkuliahan','required');
		$this->form_validation->set_rules('kebutuhan_pembelajaran','Aktivitas Perkuliahan','required');
		$this->form_validation->set_rules('deskripsi_tugas','Aktivitas Perkuliahan','required');
		$this->form_validation->set_rules('bahan_kajian','Aktivitas Perkuliahan','required');
		if($this->form_validation->run()){
			return true;
		}else{
			return false;
		}
	}
}
?>