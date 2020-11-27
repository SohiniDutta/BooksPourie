<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends ECOM_Controller {


	/* Users constructor */
    public function __construct() {
        parent::__construct();
        if (empty($this->session->userdata('ecom_admin_session'))) {
            redirect('login');
        }
    }

	/*	Users listing */
	public function index() {
		try {
			$userFormat 			= 	$this->userList();
			$data['columns']		=	$userFormat['user_column'];
			$data['customerData']	=	$userFormat['user_data'];
			$data['page_title'] 	= 	'Users';
			$page["layout_content"] = 	$this->load->view('pages/users/list', $data, true);
			$page["script_files"] 	= 	$this->load->view('scripts/users/userscripts', $data, true);
	        $this->load->view('layouts/datatablelayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	private function userList() {
		$retData['user_column'] = array("Name", "Email", "Mobile No.", "Status", "Action");
        $retData['user_data'] = "[
        	{ 'data' : 'name' },
        	{ 'data' : 'email' },
        	{ 'data' : 'mobile' },
        	{
        		'render' : function (data, type, row, meta) {
        			if(row.status == '1') {
        				return '<span class=\"badge badge-success\">Active</span>';
        			} else {
        				return '<span class=\"badge badge-warning\">Inactive</span>';
        			}
        		}
        	},
        	{ 'defaultContent' : '<div class=\"dropdown\"><a class=\"btn btn-secondary dropdown-toggle\" href=\"#\" role=\"button\" id=\"dropdownMenuLink\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"><i class=\"fs-14 fa fa-bars\"></i></a><ul class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"about-us\"><li style=\"text-align: center;\"><a class=\"dropdown-item edit_info\" href=\"javascript:void(0)\" data-toggle=\"modal\" style=\"color: blue;\"><i class=\"fa fa-edit\" style=\"margin-right: 3px;\" aria-hidden=\"true\"></i>Edit</a></li><li style=\"text-align: center;\"><a class=\"dropdown-item change_status\" href=\"javascript:void(0)\" data-toggle=\"modal\" style=\"color: grey;\"><i class=\"fa fa-toggle-on\" style=\"margin-right: 3px;\" aria-hidden=\"true\"></i>Change Status</a></li></ul></div>'
        	}
    	]";
        return $retData;
	}

	/*	customer list ajax */
	public function getAllUsers_ajax() {
		
		$response = array();
		try {
			$data = $this->input->post();
			$limit  = (!empty($data['length'])?$data['length']:10);
			$offset = (!empty($data['start'])?$data['start']:0);
			$search = !empty($data['search']['value'])? $data['search']['value'] : '';

			$url 	= API_URL.'users/list';

			$data 	= array(
				'limit'		=>	$limit,
				'offset' 	=>  $offset,
				'search'	=>	$search
			);

			$result	= $this->http_post($url, $data);
			if (!empty($result['status'])) {
				$response['recordsTotal'] 	 = !empty($result['total_count'])?$result['total_count']:0;
				$response['recordsFiltered'] = !empty($result['total_count'])?$result['total_count']:0;
				$response['data'] 			 = !empty($result['fetch_data'])?$result['fetch_data']:array();
				echo json_encode($response); die;
			} else {

				$response['draw']				= 1;
				$response['recordsTotal']		= 0;
				$response['recordsFiltered']	= 0;
				$response['data'] 				= array();
				echo json_encode($response); die;
			}
   				
			
		} catch (Exception $e) {
			echo json_encode($response); die;
		}
	}

	/* add user */
	public function add() {
		try {
			$data['page_title'] = 'Add User';
			$page["layout_content"] = $this->load->view('pages/users/add', $data, true);
	        $this->load->view('layouts/masterlayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/* Store user details */
	public function store() {
		try {
			$postData = $this->input->post();
			if (!empty($postData)) {
				$data 	=	$this->validatePostData($postData);
				if (empty($data)) {
					throw new Exception("Invalid data", 500);
				} else {
					$_POST = $data;
					if (!$this->form_validation->run('add_user')) {
						$this->session->set_flashdata('error_msg', validation_errors());
						$page["layout_content"] = $this->load->view('pages/users/add','', true);
				        $this->load->view('layouts/masterlayout', $page);
					} else {
						// check files
						if(isset($_FILES['files']['name'])) {

							$extensionErr = 0;
							$allowed = array('jpg','jpeg','png');
		            		$ext = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
		            		if (!in_array($ext, $allowed)) {
				                $extensionErr++;
				            } else {
				            	$data['files'] = new \CurlFile($_FILES['files']['tmp_name'], mime_content_type($_FILES['files']['tmp_name']), $_FILES['files']['name']);
				            }

						}

						$url = API_URL.'auth/register'; // api call
						$result = $this->http_post_images($url,$data);
						if (!empty($result['status'])) {
							$this->session->set_flashdata('success_msg', 'User added successfully');
							redirect('users');
						} else {
							$this->session->set_flashdata('error_msg', $result['message']);
							$page["layout_content"] = $this->load->view('pages/users/add','', true);
					        $this->load->view('layouts/masterlayout', $page);
						}
					}
				}
			}
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/*	Get user data for edit */
	public function edit($id) {
		try {
			if (empty($id)) {
				redirect('users');
			}
			$url 	= API_URL.'users/info-admin/id/'.base64_decode($id);
			$result	= $this->http_get($url);
			if (!empty($result['status'])) {
				$data['user_info'] = $result['details'];
			} else {
				$this->session->flashdata('error_msg',$result['message']);
				redirect('users');
			}
			$data['page_title'] 	= 'Edit User';
			$page["layout_content"] = $this->load->view('pages/users/update',$data,true);
	        $this->load->view('layouts/masterlayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}		
	}

	/* Update user */
	public function update($id) {
		try {
			if (empty($id)) {
				redirect('users');
			}
			$postData = $this->input->post();
			if (!empty($postData)) {
				$data 	=	$this->validatePostData($postData);
				if (empty($data)) {
					throw new Exception("Invalid data", 500);
				} else {
					$_POST = $data;
					if (!$this->form_validation->run('update_user')) {

						$url 	= API_URL.'users/info-admin/id/'.base64_decode($id);
						$result	= $this->http_get($url);
						if (!empty($result['status'])) {
							$data['user_info'] = $result['details'];
						} else {
							$this->session->flashdata('error_msg',$result['message']);
							redirect('users');
						}
						$page["layout_content"] = $this->load->view('pages/users/update',$data, true);
				        $this->load->view('layouts/masterlayout', $page);
					} else {
						// check files
						if(isset($_FILES['files'])) {
							$extensionErr = 0;
							$allowed = array('jpg','jpeg','png');
		            		$ext = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
		            		if (!in_array($ext, $allowed)) {
				                $extensionErr++;
				            } else {
				            	$data['files'] = new \CurlFile($_FILES['files']['tmp_name'], mime_content_type($_FILES['files']['tmp_name']), $_FILES['files']['name']);
				            }
						}
						$data['user_id'] = base64_decode($id);
						$url 			 = API_URL.'users/update'; // api call
						$result 		 = $this->http_post_images($url,$data);
						if (!empty($result['status'])) {
							$this->session->set_flashdata('success_msg', 'User updated successfully');
							redirect('users');
						} else {
							redirect('users/edit/'.$id);
						}
					}
				}
			}
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}


	/*	Change status */
	public function changeStatus() {
		$data = $this->input->post();
		if (!empty($data)) {
			$this->form_validation->set_data($data);
			if (!$this->form_validation->run('change_status')) {
				echo json_encode(array('status'=>FALSE, 'message'=>validation_errors())); die; 
			} else {
				$url = API_URL.'users/change-status'; // api call
				$data = array('type' => $data['type'], 'id'=>$data['id']);
				$result = $this->http_post($url,$data);
				if (!empty($result['status'])) {
					echo json_encode(array('status'=>TRUE, 'message'=>$result['message'])); die;
				} else {
					echo json_encode(array('status'=>FALSE, 'message'=>'Failed to change status')); die;
				}
			}
		} else {
			echo json_encode(array('status'=>FALSE, 'message'=>'Invalid data')); die;
		}
	}

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */