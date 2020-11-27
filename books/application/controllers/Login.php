<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    /* Login constructor.*/
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('books_admin') != '') {
            redirect('dashboard');
        }
        $this->load->model('Authmodel');
    }

    /* view login page */
	public function index() {
		try {

			$data = array();
			$page['page_title']		= 'Login | Admin';

			$postData = $this->input->post();
			if ($postData) {
				$data = $postData;
				$this->form_validation->set_data($data);
                $this->form_validation->set_rules('email', 'Email','required|valid_email');
                $this->form_validation->set_rules('password','Password','required|trim');
                if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('error_msg', validation_errors());
					$page["layout_content"] = $this->load->view('pages/login',$data,true);
			        $this->load->view('layouts/loginlayout', $page);
                } else {
					$data = array('email' => $data['email'], 'password' => $data['password']);
					$result = $this->Authmodel->checkLogin($data);
					if (!empty($result['status'])) {
						$session_data = array('name'=>$result['name'],'email'=>$result['email']);
						$this->session->set_userdata('books_admin',$session_data);
						redirect('dashboard');
					} else {
						$this->session->set_flashdata('error_msg', 'Invalid Credentials');
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