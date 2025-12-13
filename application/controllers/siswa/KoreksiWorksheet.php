<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KoreksiWorksheet extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
            redirect('./Login');
        }

		$this->load->model("M_pertemuan","",TRUE);
		$this->load->model("M_permasalahan","",TRUE);
        $this->load->model("M_user","",TRUE);
		$this->load->model("M_jawaban_essai","",TRUE);
        $this->load->model("M_soal_essai","",TRUE);
	}

	public function index()
	{
        $data['pertemuan'] = $this->M_pertemuan->getRecordsView();

        // --------------------------------------------------------------------
        // Catatan Nama Form [jenis_form][id_soal_essai]
        // textarea dan input   = jawaban[id_soal_essai]
        // canva                = canvajawaban[id_soal_essai]
        // file                 = filejawaban[id_soal_essai]
        // --------------------------------------------------------------------
		
        $idPertemuan    = $this->input->post('id_pertemuan');
        $idPermasalahan = $this->input->post('id_permasalahan');
        $idUser         = $this->input->post('id_user');
        $idSoalEssai    = $this->input->post('id_soal_essai');

        $dataSoalByIdPertemuan = $this->M_soal_essai->tampil_view_by_id_pertemuan($idPertemuan);
        $dataSoalByIdPermasalahan = $this->M_soal_essai->tampil_view_by_id_permasalahan($idPermasalahan);
        
        // Cek apakah ada jawaban yang sudah di-submit oleh mahasiswa dalam permasalahan ini
        $valid_by_permasalahan = $this->db->get_where('v_jawaban_essai', array(//making selection
            'id_user' => $idUser,
            'id_permasalahan' => $idPermasalahan
        ));
        
        if($valid_by_permasalahan->num_rows() > 0) {
            // Jika sudah ada jawaban, mahasiswa tidak bisa submit ulang
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'warning');
            $this->session->set_flashdata('alert', 'Anda telah mengisi tugas pada permasalahan ini. Silahkan lihat hasil dan feedback dosen pada fitur Nilai');
            redirect('siswa/Pertemuan/worksheet/' . $idPertemuan);
        } else {
            // jika belum ada jawaban, lakukan proses insert
            foreach ($dataSoalByIdPermasalahan as $dsip) {
                $jawabanText    = "jawaban".$dsip->id_soal_essai;
                $jawabanFile    = "filejawaban".$dsip->id_soal_essai;
                $jawabanGambar  = "canvajawaban".$dsip->id_soal_essai;
                
                $dataInput = array(
                    'id_user'	 	    => $idUser,
                    'id_soal'           => $dsip->id_soal_essai,
                    'jawaban_text'	    => $this->input->post($jawabanText),
                    'created_at' 	    => date('Y-m-d H:i:s')
                );

                // Cek Gambar
                $config_image['upload_path']          = './assets/jawaban_gambar/';
                $config_image['allowed_types']        = 'jpeg|jpg|png';
                $config_image['max_size']             = 2000;
                $config_image['max_width']            = 2048;
                $config_image['encrypt_name']         = TRUE; // Untuk menghindari duplikasi nama file

                if (!empty($_FILES[$jawabanGambar]['name'])) {
                    $this->load->library('upload', $config_image);
                    $this->upload->initialize($config_image);
            
                    if ($this->upload->do_upload($jawabanGambar)) {
                        $data_upload_files = $this->upload->data();
                        $dataInput['jawaban_gambar'] = $data_upload_files['file_name'];
                    } else {
                        $this->session->set_flashdata('ver', 'FALSE');
                        $this->session->set_flashdata('class_alert', 'danger');
                        $this->session->set_flashdata('alert', "Error upload gambar: " . $this->upload->display_errors());
                        redirect('siswa/Pertemuan/worksheet/' . $idPertemuan);
                    }
                }

                // --------------

                // Cek File
                $config_ppt['upload_path']          = './assets/jawaban_file/';
                $config_ppt['allowed_types']        = 'ppt|pptx|pdf|docx|doc'; 
                $config_ppt['max_size']             = 10240;
                $config_ppt['encrypt_name']         = TRUE; // Untuk menghindari duplikasi nama file
                
                if (!empty($_FILES[$jawabanFile]['name'])) {
                    $this->load->library('upload', $config_ppt);
                    $this->upload->initialize($config_ppt);
            
                    if (!$this->upload->do_upload($jawabanFile)) {
                        // If the upload fails
                        $this->session->set_flashdata('ver', 'FALSE');
                        $this->session->set_flashdata('class_alert', 'danger');
                        $this->session->set_flashdata('alert', "Error upload file".$this->upload->display_errors());
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('siswa/Pertemuan/worksheet/'.$idPertemuan);
                    } else {
                        $data_upload_files = $this->upload->data();
                        $dataInput['jawaban_file'] = $data_upload_files['file_name'];
                    }
                }
                // ---------------
                // Simpan ke database
                $this->M_jawaban_essai->tambahdata($dataInput);
            }
            
            //set flash message berhasil
            $this->session->set_flashdata('ver', 'FALSE');
            $this->session->set_flashdata('class_alert', 'info');
            $this->session->set_flashdata('alert', 'File Jawaban anda berhasil di kirim, silahkan akses fitur nilai untuk memantau nilai dan feedback akan tugas anda');
            redirect('siswa/Pertemuan/worksheet/'.$idPertemuan);
        
        } 
	}
}
