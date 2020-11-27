<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends ECOM_Controller {

    /* Login constructor.*/
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('books_admin') == '') {
            redirect('login');
        }
    }

	public function index() {
		$this->session->sess_destroy();
		redirect('login');
	}

}

/* End of file Logout.php */
/* Location: ./application/controllers/Logout.php */