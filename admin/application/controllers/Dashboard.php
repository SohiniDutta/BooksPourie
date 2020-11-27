<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends ECOM_Controller {

	/* Dashboard constructor */
    public function __construct() {
        parent::__construct();
        if (empty($this->session->userdata('books_admin'))) {
            redirect('login');
        }
    }

    /* dashboard view */
	public function index() {
		try {
			$data = array();
			$page["layout_content"] = $this->load->view('pages/dashboard/dashboard', $data, true);
	        $this->load->view('layouts/masterlayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */