<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom404 extends CI_Controller {

	public function __construct() {
        parent::__construct();
    }

	public function index() {
		$data = array();
		$this->load->view('errors/404_error',$data, FALSE);
	}

}

/* End of file Custom404.php */
/* Location: ./application/controllers/Custom404.php */