<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	function index(){
        $this->session->set_userdata('logged_in', FALSE);
        $this->session->sess_destroy();
        redirect("Login");
    }
}
