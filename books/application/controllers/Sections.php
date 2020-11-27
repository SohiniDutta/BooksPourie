<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sections extends ECOM_Controller {

	public function __construct() {
		parent::__construct();
		//Do your magic here
	}

	public function banner() {
		try {
			$data['page_title'] 			= 'Banner List';
			$data['banner_details']			= $this->bannerList_ajax();
			$page["script_files"] 			= $this->load->view('scripts/sections/sectionlist', $data, true);
			$page["layout_content"] 		= $this->load->view('pages/sections/banner/list', $data, true);
	        $this->load->view('layouts/datatablelayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/*	Master category ajax list	*/
	public function bannerList_ajax() {
		$response = array();
		try {
			$data = $this->input->post();
			$limit  = (!empty($data['length'])?$data['length']:10);
			$offset = (!empty($data['start'])?$data['start']:0);
			$search = !empty($data['search']['value'])? $data['search']['value'] : '';

			$url 	= API_URL.'sections/details';

			$data 	= array(
				'limit'		=>	$limit,
				'offset' 	=>  $offset,
				'search'	=>	$search,
				'type'		=>	'banner'
			);

			$result	= $this->http_post($url, $data);	
			if (!empty($result['status'])) {
				$response['recordsTotal'] 	 = !empty($result['total_count'])?$result['total_count']:0;
				$response['recordsFiltered'] = !empty($result['total_count'])?$result['total_count']:0;
				$response['data'] 			 = !empty($result['fetch_data'])?$result['fetch_data']:array();
				$response['image_path'] 	 = !empty($result['image_path'])?$result['image_path']:'';
				return $response;
			} else {

				$response['draw']				= 1;
				$response['recordsTotal']		= 0;
				$response['recordsFiltered']	= 0;
				$response['data'] 				= array();
				return $response;
			}
		} catch (Exception $e) {
			return $response;
		}
	}

	/* add banner */
	public function addBanner() {
		try {

			$submit = $this->input->post();
			if (!empty($submit)) {

				$allowed = array('jpeg', 'png', 'jpg');
				if (empty($_FILES['image']['name'])) {
					$this->session->set_flashdata('error_msg', 'File is required');
					redirect('sections/add-banner','refresh');
				}
				
				$data 	=	$this->validatePostData($submit);
				if (empty($data)) {
					throw new Exception('Invalid data', 422);
				}

				$this->form_validation->set_data($data);
				if (!$this->form_validation->run('banner_image')) {
					$data['page_title'] = 'Add Banner';
					$page["layout_content"] = $this->load->view('pages/sections/banner/add', $data, true);
			        $this->load->view('layouts/masterlayout', $page);
			        return;
				} else {
					$filename = $_FILES['image']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					if (!in_array($ext, $allowed)) {
					    $this->session->set_flashdata('error_msg', 'Only jpg, jpeg, png are allowed');
					    redirect('sections/add-banner','refresh');
					}

					$tmpfile = $_FILES['image']['tmp_name'];
			        $filename = basename($_FILES['image']['name']);
			        $insertdata['image'] = curl_file_create($tmpfile, $_FILES['image']['type'], 
			            	$filename);
			        $insertdata['type'] = $data['type'];
			        $insertdata['title'] = $data['title'];
			        $insertdata['description'] = !empty($data['description'])?$data['description']:null;

			        $url = API_URL.'sections/add-banner'; // api call
			        $result = $this->http_post_images($url,$insertdata);
					if (!empty($result['status'])) {
						$this->session->set_flashdata('success_msg', 'Banner added successfully');
						redirect('sections/banner');
					} else {
						$this->session->set_flashdata('error_msg', 'Failed to add banner');
						redirect('sections/add-banner');
					}
				}		
			}
			$data['page_title'] = 'Add Banner';
			$page["layout_content"] = $this->load->view('pages/sections/banner/add', $data, true);
	        $this->load->view('layouts/masterlayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/* edit banner */
	public function editBanner($id) {

		try {
			if (empty($id)) {
				redirect('sections/banner','refresh');
			}
			$submit = $this->input->post();
			if (!empty($submit)) {

				$this->form_validation->set_data($submit);
				if (!$this->form_validation->run('banner_image')) {
					$fields = array('id'=>$id);
					$url = API_URL.'sections/getDetails'; // api call
			        $result = $this->http_post($url,$fields);
					if (!empty($result['status']) && !empty($result['details'])) {
						$data['details'] = $result['details'];
					} else {
						$this->session->set_flashdata('error_msg', 'Something went wrong');
						redirect('sections/banner');
					}
					$data['page_title'] = 'Edit Banner';
					$page["layout_content"] = $this->load->view('pages/sections/banner/edit', $data, true);
			        $this->load->view('layouts/masterlayout', $page);
			        return;
				} else {
					$updateData = array();
					if (!empty($_FILES['image']['name'])) {
						$allowed = array('jpeg', 'png', 'jpg');
						$filename = $_FILES['image']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if (!in_array($ext, $allowed)) {
						    $this->session->set_flashdata('error_msg', 'Only jpg, jpeg, png are allowed');
						    redirect('sections/add-banner','refresh');
						}

						$tmpfile = $_FILES['image']['tmp_name'];
				        $filename = basename($_FILES['image']['name']);
				        $updateData['image'] = curl_file_create($tmpfile, $_FILES['image']['type'], 
				            	$filename);
			        }
					
			        $updateData['type'] = $submit['type'];
			        $updateData['title'] = $submit['title'];
			        $updateData['description'] = !empty($submit['description'])?$submit['description']:null;
			        $updateData['id'] = $id;
			        $url = API_URL.'sections/update'; // api call
			        $result = $this->http_post_images($url,$updateData);
					if (!empty($result['status'])) {
						$this->session->set_flashdata('success_msg', $result['message']);
						redirect('sections/banner');
					} else {
						$this->session->set_flashdata('error_msg', $result['message']);
						redirect('sections/edit-banner/'.$id);
					}
				}
					
			}

			$fields = array('id'=>$id);
			$url = API_URL.'sections/getDetails'; // api call
	        $result = $this->http_post($url,$fields);
			if (!empty($result['status']) && !empty($result['details'])) {
				$data['details'] = $result['details'];
			} else {
				$this->session->set_flashdata('error_msg', 'Something went wrong');
				redirect('sections/banner');
			}
			$data['page_title'] = 'Edit Banner';
			$page["layout_content"] = $this->load->view('pages/sections/banner/edit', $data, true);
	        $this->load->view('layouts/masterlayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}  
    }

	/*	Delete Section with type	*/
	public function delete() {
		try {
			$submit = $this->input->post();
			if (!empty($submit)) {
				$url = API_URL.'sections/delete'; // api call
		        $result = $this->http_post($url,$submit);
				if (!empty($result['status'])) {
					$this->session->set_flashdata('success_msg', 'Banner deleted successfully');
					echo json_encode(array('status'=>true)); die;
				} else {
					$this->session->set_flashdata('error_msg', 'Failed to delete banner');
					echo json_encode(array('status'=>false)); die;
				}
			}
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

}

/* End of file Sections.php */
/* Location: ./application/controllers/Sections.php */