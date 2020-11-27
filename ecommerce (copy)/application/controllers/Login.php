<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends ECOM_Controller {

    /* Login constructor.*/
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('ecom_admin_session') != '') {
            redirect('dashboard');
        }
    }

    /* view login page */
	public function index() {
		try {

			$data = array();
			$page['page_title']		= 'Login | Admin';

			$postData = $this->input->post();
			if ($postData) {
				$data 	=	$this->validatePostData($postData);
				if (empty($data)) {
					throw new Exception("Invalid data", 500);
				}
				$this->form_validation->set_data($data);
                $this->form_validation->set_rules('email', 'Email','required|valid_email');
                $this->form_validation->set_rules('password','Password','required|trim');
                if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('error_msg', validation_errors());
					$page["layout_content"] = $this->load->view('pages/login',$data,true);
			        $this->load->view('layouts/loginlayout', $page);
                } else {
                	$url = API_URL.'auth/login'; // api call
					$data = array('email' => $data['email'], 'password' => $data['password'], 'login_type' => 'admin');
					$result = $this->http_post($url,$data);
					if (!empty($result['status'])) {
						$session_data = array('token'=>$result['details']['token'],'name'=>$result['details']['name']);
						$this->session->set_userdata('ecom_admin_session',$session_data);
						redirect('dashboard');
					} else {
						$this->session->set_flashdata('error_msg', $result['message']);
						$page["layout_content"] = $this->load->view('pages/login',$data,true);
			        	$this->load->view('layouts/loginlayout', $page);
					}
                }
			} else {
				$page["layout_content"] = $this->load->view('pages/login', $data, true);
	        	$this->load->view('layouts/loginlayout', $page);
			}
			
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/*	Forgot Password */
	public function forgotPassword() {
		// redirect('Custom404');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */