<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends ECOM_Controller {

	function __construct() {
        parent::__construct();
        if (empty($this->session->userdata('ecom_admin_session'))) {
            redirect('login');
        }
    }

	public function index() {
		
	}

	public function add() {
		try {
			$data = array();
			$data['page_title'] 	= 'Add Vendor';
			$mastercategory 		= $this->fetchMasterCategoryList();
			$data['mastercatlist']  = $mastercategory;
			$page["layout_content"] = $this->load->view('pages/vendors/add', $data, true);
			$page["script_files"] 	= $this->load->view('scripts/vendors/vendor', $data, true);
			$this->load->view('layouts/masterlayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	private function fetchMasterCategoryList() {

		$url = API_URL.'products/masterCategories'; // api call
		$data = array('category' => 'master');
		$result = $this->http_post($url,$data);
		if (!empty($result['status'])) {
			return $result['list'];
		} 
		return false;
	}

	public function store() {
		try {
			$postData = $this->input->post();
			if (!empty($postData)) {

				$mastercategory = $this->fetchMasterCategoryList();
				$data 			= $this->validatePostData($postData);
				$data['mastercatlist']  = $mastercategory;
				if (empty($data)) {
					throw new Exception("Invalid data", 500);
				} else {

					$_POST = $data;
					if (!$this->form_validation->run('add_vendor')) {
						$this->session->set_flashdata('error_msg', validation_errors());
						$page["layout_content"] = $this->load->view('pages/vendors/add',$data, true);
						$this->load->view('layouts/masterlayout', $page);
					} else {
						// check files
						$extensionErr = 0;
						if(!empty($_FILES['user_image']['name'])) {
							
							$allowed = array('jpg','jpeg','png');
							$ext = pathinfo($_FILES['user_image']['name'], PATHINFO_EXTENSION);
							if (!in_array($ext, $allowed)) {
								$extensionErr++;
							} else {
								$data['user_image'] = new \CurlFile($_FILES['user_image']['tmp_name'], mime_content_type($_FILES['user_image']['tmp_name']), $_FILES['user_image']['name']);
							}

						} else {
							$this->session->set_flashdata('error_msg', 'User Image is required');
							$page["layout_content"] = $this->load->view('pages/vendors/add',$data, true);
							$this->load->view('layouts/masterlayout', $page);
						}

						if(!empty($_FILES['aadhaar_image']['name'])) {
							
							$allowed = array('jpg','jpeg','png');
							$ext = pathinfo($_FILES['aadhaar_image']['name'], PATHINFO_EXTENSION);
							if (!in_array($ext, $allowed)) {
								$extensionErr++;
							} else {
								$data['aadhaar_image'] = new \CurlFile($_FILES['aadhaar_image']['tmp_name'], mime_content_type($_FILES['aadhaar_image']['tmp_name']), $_FILES['aadhaar_image']['name']);
							}

						} else {
							$this->session->set_flashdata('error_msg', 'Aadhaar Image is required');
							$page["layout_content"] = $this->load->view('pages/vendors/add',$data, true);
							$this->load->view('layouts/masterlayout', $page);
						}

						if(!empty($_FILES['pancard_image']['name'])) {
							
							$allowed = array('jpg','jpeg','png');
							$ext = pathinfo($_FILES['pancard_image']['name'], PATHINFO_EXTENSION);
							if (!in_array($ext, $allowed)) {
								$extensionErr++;
							} else {
								$data['pancard_image'] = new \CurlFile($_FILES['pancard_image']['tmp_name'], mime_content_type($_FILES['pancard_image']['tmp_name']), $_FILES['pancard_image']['name']);
							}

						} else {
							$this->session->set_flashdata('error_msg', 'Pancard Image is required');
							$page["layout_content"] = $this->load->view('pages/vendors/add',$data, true);
							$this->load->view('layouts/masterlayout', $page);
						}

						if ($extensionErr>0) {
							$this->session->set_flashdata('error_msg', 'png,jpg and jpeg extensions are only allowed');
							$page["layout_content"] = $this->load->view('pages/vendors/add',$data, true);
							$this->load->view('layouts/masterlayout', $page);
						}
						unset($data['mastercatlist']);

						$url = API_URL.'vendor/register'; // api call
						$result = $this->http_post_images($url,$data);
						if (!empty($result['status'])) {
							$this->session->set_flashdata('success_msg', 'Vendor added successfully');
							redirect('vendor/add');
						} else {
							$this->session->set_flashdata('error_msg', $result['message']);
							$page["layout_content"] = $this->load->view('pages/vendors/add',$data, true);
							$this->load->view('layouts/masterlayout', $page);
						}
					}
				}
			}
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

}

/* End of file Vendor.php */
/* Location: ./application/controllers/Vendor.php */