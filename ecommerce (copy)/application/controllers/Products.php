<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends ECOM_Controller {


	/* Products constructor */
    public function __construct() {
        parent::__construct();
        if (empty($this->session->userdata('ecom_admin_session'))) {
            redirect('login');
        }
    }

	/* Master Category list	*/
	public function masterCategory() {
		try {
			$data['page_title'] 			= 'Master Category List';
			$userFormat 					= $this->masterCategoryList();
			$data['columns']				= $userFormat['master_cat_column'];
			$data['mast_pro_dept_list']		= $userFormat['master_cat_data'];
			$page["script_files"] 			= $this->load->view('scripts/products/productlist', $data, true);
			$page["layout_content"] = $this->load->view('pages/products/mastercategory/list', $data, true);
	        $this->load->view('layouts/datatablelayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/*	master category datatable structure	*/
	private function masterCategoryList() {
		$retData['master_cat_column'] = array("Name", "Created On", "Status", "Action");
        $retData['master_cat_data'] = "[
        	{ 'data' : 'name' },
        	{ 'data' : 'created_at' },
        	{
        		'render' : function (data, type, row, meta) {
        			if(row.status == '1') {
        				return '<span class=\"badge badge-success\">Active</span>';
        			} else {
        				return '<span class=\"badge badge-warning\">Inactive</span>';
        			}
        		}
        	},
        	{ 'defaultContent' : '<div class=\"dropdown\"><a class=\"btn btn-secondary dropdown-toggle btn-sm\" href=\"#\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"><i class=\"fs-14 fa fa-bars\"></i></a><ul class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"about-us\"><li style=\"text-align: center;\"><a class=\"dropdown-item edit_info\" href=\"javascript:void(0)\" data-toggle=\"modal\" style=\"color: blue;\"><i class=\"fa fa-edit\" style=\"margin-right: 3px;\" aria-hidden=\"true\"></i>Edit</a></li><li style=\"text-align: center;\"><a class=\"dropdown-item change_status\" href=\"javascript:void(0)\" data-toggle=\"modal\" style=\"color: grey;\"><i class=\"fa fa-toggle-on\" style=\"margin-right: 3px;\" aria-hidden=\"true\"></i>Change Status</a></li></ul></div>'
        	}
    	]";
        return $retData;
	}

	/*	Master category ajax list	*/
	public function getMasterCategoryList_ajax() {
		$response = array();
		try {
			$data = $this->input->post();
			$limit  = (!empty($data['length'])?$data['length']:10);
			$offset = (!empty($data['start'])?$data['start']:0);
			$search = !empty($data['search']['value'])? $data['search']['value'] : '';

			$url 	= API_URL.'products/master-category-list';

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

	/*	Add Master Category */
	public function addMasterCategory() {
		try {
			$postData	=	$this->input->post();
			if (!empty($postData)) {
				$data 	=	$this->validatePostData($postData);
				if (empty($data)) {
					throw new Exception("Invalid data", 422);
				}
				$this->form_validation->set_data($data);
				if (!$this->form_validation->run('add_master_category')) {
					$data['page_title'] = 'Add Master Product Category';
					$page["layout_content"] = $this->load->view('pages/products/mastercategory/add',$data,true);
			        $this->load->view('layouts/masterlayout', $page);
				} else {

					$url = API_URL.'products/store-master-category'; // api call
					$data = array('category_name' => $data['category_name']);
					$result = $this->http_post($url,$data);

					if (!empty($result['status'])) {
						$this->session->set_flashdata('success_msg', 'Master Category added successfully');
						redirect('products/master-category');
					} else {
						$this->session->set_flashdata('error_msg', $result['message']);
						$page["layout_content"] = $this->load->view('pages/products/mastercategory/add','', true);
				        $this->load->view('layouts/masterlayout', $page);
					}
				}
			} else {
				$data['page_title'] = 'Add Master Product Category';
				$page["layout_content"] = $this->load->view('pages/products/mastercategory/add', $data, true);
		        $this->load->view('layouts/masterlayout', $page);
			}
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/*	Edit Master Catefory */
	public function editMasterCategory($id) {
		try {
			if(empty($id)) {
				redirect('products/master-category');
			}
			if (!empty($this->input->post())) {
				$this->form_validation->set_data($this->input->post());
				if (!$this->form_validation->run('add_master_category')) {
					$data['page_title'] = 'Edit Master Product Category';
					$page["layout_content"] = $this->load->view('pages/products/mastercategory/add',$data,true);
			        $this->load->view('layouts/masterlayout', $page);
				} else {

					$url = API_URL.'products/update-master-category'; // api call
					$data = array('category_name' => $this->input->post('category_name'),'id'=>base64_decode($id));
					$result = $this->http_post($url,$data);

					if (!empty($result['status'])) {
						$this->session->set_flashdata('success_msg', 'Master Category updated successfully');
						redirect('products/master-category');
					} else {
						$this->session->set_flashdata('error_msg', $result['message']);
						$page["layout_content"] = $this->load->view('pages/products/mastercategory/edit','', true);
				        $this->load->view('layouts/masterlayout', $page);
					}
				}
			}

			$url = API_URL.'products/get-details'; // api call
			$data = array('id' => base64_decode($id), 'type' => 'mastercategory');
			$result = $this->http_post($url,$data);
			if (!empty($result['status'])) {
				$data['details'] = $result['details'];
			} else {
				redirect('products/master-category');
			}
			$data['page_title'] = 'Edit Master Product Category';
			$page["layout_content"] = $this->load->view('pages/products/mastercategory/edit', $data, true);
	        $this->load->view('layouts/masterlayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/* Sub Category list */
	public function subCategory() {
		try {

			$data['page_title'] 		= 'Sub Category List';
			$userFormat 				= $this->subCategoryList();
			$data['columns']			= $userFormat['sub_cat_column'];
			$data['sub_cat_list']		= $userFormat['sub_cat_data'];
			$page["script_files"] 		= $this->load->view('scripts/products/productlist', $data, true);
			$page["layout_content"] 	= $this->load->view('pages/products/subcategory/list', $data, true);
	        $this->load->view('layouts/datatablelayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/* sub category datatable structure */
	private function subCategoryList() {
		$retData['sub_cat_column'] = array("Name", "Created On", "Status", "Action");
        $retData['sub_cat_data'] = "[
        	{ 'data' : 'name' },
        	{ 'data' : 'created_at' },
        	{
        		'render' : function (data, type, row, meta) {
        			if(row.status == '1') {
        				return '<span class=\"badge badge-success\">Active</span>';
        			} else {
        				return '<span class=\"badge badge-warning\">Inactive</span>';
        			}
        		}
        	},
        	{ 'defaultContent' : '<div class=\"dropdown\"><a class=\"btn btn-secondary dropdown-toggle btn-sm\" href=\"#\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"><i class=\"fs-14 fa fa-bars\"></i></a><ul class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"about-us\"><li style=\"text-align: center;\"><a class=\"dropdown-item edit_info\" href=\"javascript:void(0)\" data-toggle=\"modal\" style=\"color: blue;\"><i class=\"fa fa-edit\" style=\"margin-right: 3px;\" aria-hidden=\"true\"></i>Edit</a></li><li style=\"text-align: center;\"><a class=\"dropdown-item change_status\" href=\"javascript:void(0)\" data-toggle=\"modal\" style=\"color: grey;\"><i class=\"fa fa-toggle-on\" style=\"margin-right: 3px;\" aria-hidden=\"true\"></i>Change Status</a></li></ul></div>'
        	}
    	]";
        return $retData;
	}

	/*	Sub category ajax list	*/
	public function getSubCategoryList_ajax() {		
		$response = array();
		try {
			$data = $this->input->post();
			$limit  = (!empty($data['length'])?$data['length']:10);
			$offset = (!empty($data['start'])?$data['start']:0);
			$search = !empty($data['search']['value'])? $data['search']['value'] : '';

			$url 	= API_URL.'products/sub-category-list';
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

	/* Add Sub Category */
	public function addSubCategory() {
		try {
			// fetch master category
			$mastercategory = $this->fetchMasterCategoryList();

			$postData	=	$this->input->post();
			if (!empty($postData)) {
				$data 	=	$this->validatePostData($postData);
				if (empty($data)) {
					throw new Exception("Invalid data", 422);
				}
				$this->form_validation->set_data($data);
				if ($this->form_validation->run('add_sub_category') === FALSE) {

					$data['page_title'] 	= 'Add Sub Category';
					$data['mastercatlist']  = $mastercategory;
					$page["layout_content"] = $this->load->view('pages/products/subcategory/add',$data,true);
			        $this->load->view('layouts/masterlayout', $page);
				} else {

					$url = API_URL.'products/store-sub-category'; // api call
					$result = $this->http_post($url,$data);
					if (!empty($result['status'])) {
						$this->session->set_flashdata('success_msg', 'Sub category added successfully');
						redirect('products/sub-category');
					} else {
						$error = $this->apiResponseMsg($result['message']);
						$this->session->set_flashdata('error_msg', $error);
						$data['mastercatlist']  = $mastercategory;
						$page["layout_content"] = $this->load->view('pages/products/subcategory/add',$data, true);
				        $this->load->view('layouts/masterlayout', $page);
					}
				}
			} else {
				$data['page_title'] 	= 'Add Sub Category';
				$data['mastercatlist']  = $mastercategory;
				$page["layout_content"] = $this->load->view('pages/products/subcategory/add', $data, true);
		        $this->load->view('layouts/masterlayout', $page);
			}
		} catch (Exception $e) {
			$this->exceptionResult('products/add-sub-category',$e->getMessage(),$e->getCode());
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

	private function brandList() {

		$url = API_URL.'products/allBrandList'; // api call
		$data = array('category' => 'brand');
		$result = $this->http_post($url,$data);
		if (!empty($result['status'])) {
			return $result['list'];
		} 
		return false;
	}

	/* Edit Sub Category */
	public function editSubCategory($id) {
		try {
			if(empty($id)) {
				redirect('products/sub-category');
			}

			$url = API_URL.'products/get-details'; // api call
			$data = array('id' => base64_decode($id), 'type' => 'subcategory');
			$result = $this->http_post($url,$data);
			if (!empty($result['status'])) {
				// fetch master category
				$mastercategory 		= $this->fetchMasterCategoryList();
				$data['mastercatlist']  = $mastercategory;
				$data['details'] 		= $result['details'];
			} else {
				redirect('products/sub-category');
			}

			if (!empty($this->input->post())) {
				$editData = $this->input->post();
				$this->form_validation->set_data($editData);
				if ($this->form_validation->run('add_sub_category') === FALSE) {
					$data['page_title'] 	= 'Add Sub Category';
					$data['mastercatlist']  = $mastercategory;
					$page["layout_content"] = $this->load->view('pages/products/subcategory/edit',$data,true);
			        $this->load->view('layouts/masterlayout', $page);
				} else {
					$editData['id'] = $id;
					$url = API_URL.'products/update-sub-category'; // api call
					$result = $this->http_post($url,$editData);
					if (!empty($result['status'])) {
						$this->session->set_flashdata('success_msg', 'Sub category updated successfully');
						redirect('products/sub-category');
					} else {
						$error = $this->apiResponseMsg($result['message']);
						$this->session->set_flashdata('error_msg', $error);
						$data['mastercatlist']  = $mastercategory;
						$page["layout_content"] = $this->load->view('pages/products/subcategory/edit',$data, true);
				        $this->load->view('layouts/masterlayout', $page);
					}
				}
			}

			
			$data['page_title'] = 'Edit Master Product Category';
			$page["layout_content"] = $this->load->view('pages/products/subcategory/edit', $data, true);
	        $this->load->view('layouts/masterlayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/* Brand list */
	public function brand() {
		try {
			$data['page_title'] 			= 'Brands';
			$userFormat 					= $this->masterBrandList();
			$data['columns']				= $userFormat['master_brand_column'];
			$data['mast_brand_data']		= $userFormat['master_brand_data'];
			$page["script_files"] 			= $this->load->view('scripts/products/productlist', $data, true);
			$page["layout_content"] = $this->load->view('pages/products/brand/list', $data, true);
	        $this->load->view('layouts/datatablelayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/* master category datatable structure	*/
	private function masterBrandList() {
		$retData['master_brand_column'] = array("Name", "Created On", "Status", "Action");
        $retData['master_brand_data'] = "[
        	{ 'data' : 'name' },
        	{ 'data' : 'created_at' },
        	{
        		'render' : function (data, type, row, meta) {
        			if(row.status == '1') {
        				return '<span class=\"badge badge-success\">Active</span>';
        			} else {
        				return '<span class=\"badge badge-warning\">Inactive</span>';
        			}
        		}
        	},
        	{ 'defaultContent' : '<div class=\"dropdown\"><a class=\"btn btn-secondary dropdown-toggle btn-sm\" href=\"#\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"><i class=\"fs-14 fa fa-bars\"></i></a><ul class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"about-us\"><li style=\"text-align: center;\"><a class=\"dropdown-item edit_info\" href=\"javascript:void(0)\" data-toggle=\"modal\" style=\"color: blue;\"><i class=\"fa fa-edit\" style=\"margin-right: 3px;\" aria-hidden=\"true\"></i>Edit</a></li><li style=\"text-align: center;\"><a class=\"dropdown-item change_status\" href=\"javascript:void(0)\" data-toggle=\"modal\" style=\"color: grey;\"><i class=\"fa fa-toggle-on\" style=\"margin-right: 3px;\" aria-hidden=\"true\"></i>Change Status</a></li></ul></div>'
        	}
    	]";
        return $retData;
	}

	/* Master category ajax list */
	public function getBrandList_ajax() {
		$response = array();
		try {
			$data   = $this->input->post();
			$limit  = (!empty($data['length'])?$data['length']:10);
			$offset = (!empty($data['start'])?$data['start']:0);
			$search = !empty($data['search']['value'])? $data['search']['value'] : '';

			$url 	= API_URL.'products/brand-list';

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

	/* Add brand */
	public function addBrand() {
		try {
			$postData	=	$this->input->post();
			if (!empty($postData)) {
				$data 	=	$this->validatePostData($postData);
				if (empty($data)) {
					throw new Exception("Invalid data", 422);
				}
				$this->form_validation->set_data($data);
				if (!$this->form_validation->run('add_brand')) {
					$data['page_title'] = 'Add Brand';
					$page["layout_content"] = $this->load->view('pages/products/brand/add',$data,true);
			        $this->load->view('layouts/masterlayout', $page);
				} else {

					$url = API_URL.'products/store-brand'; // api call
					$data = array('brand_name' => $data['brand_name']);
					$result = $this->http_post($url,$data);

					if (!empty($result['status'])) {
						$this->session->set_flashdata('success_msg', 'Brand added successfully');
						redirect('products/add-brand');
					} else {
						$this->session->set_flashdata('error_msg', $result['message']);
						$page["layout_content"] = $this->load->view('pages/products/brand/add','', true);
				        $this->load->view('layouts/masterlayout', $page);
					}
				}
			} else {
				$data['page_title'] = 'Add Brand';
				$page["layout_content"] = $this->load->view('pages/products/brand/add', $data, true);
		        $this->load->view('layouts/masterlayout', $page);
			}
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/* Edit brand */
	public function editBrand($id) {
		try {
			if(empty($id)) {
				redirect('products/brand');
			}

			$url = API_URL.'products/get-details'; // api call
			$data = array('id' => base64_decode($id), 'type' => 'brand');
			$result = $this->http_post($url,$data);

			if (!empty($result['status'])) {
				$data['details'] 		= $result['details'];
			} else {
				redirect('products/brand');
			}

			if(!empty($this->input->post())) {
				$editData = $this->input->post();
				$this->form_validation->set_data($editData);
				if (!$this->form_validation->run('add_brand')) {
					$data['page_title'] = 'Update Brand';
					$page["layout_content"] = $this->load->view('pages/products/brand/edit',$data,true);
			        $this->load->view('layouts/masterlayout', $page);
				} else {

					$url = API_URL.'products/update-brand'; // api call
					$editData['id'] = $id;
					$result = $this->http_post($url,$editData);

					if (!empty($result['status'])) {
						$this->session->set_flashdata('success_msg', 'Brand updated successfully');
						redirect('products/brand');
					} else {
						$this->session->set_flashdata('error_msg', $result['message']);
						$page["layout_content"] = $this->load->view('pages/products/brand/edit',$data, true);
				        $this->load->view('layouts/masterlayout', $page);
					}
				}
			}
			$data['page_title'] = 'Update Brand';
			$page["layout_content"] = $this->load->view('pages/products/brand/edit', $data, true);
	        $this->load->view('layouts/masterlayout', $page);

		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

    /* products list */
	public function list() {
		try {
			$data['page_title'] 			= 'Products';
			$userFormat 					= $this->productList();

			$data['columns']				= $userFormat['products_column'];
			$data['products_data']			= $userFormat['products_data'];
			$page["script_files"] 			= $this->load->view('scripts/products/productlist', $data, true);
			$page["layout_content"] = $this->load->view('pages/products/list', $data, true);
	        $this->load->view('layouts/datatablelayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/*	products structure	*/
	private function productList() {
		$retData['products_column'] = array("Name", "Master Category", "Units", "Status", "Action");
        $retData['products_data'] = "[
        	{ 'data' : 'name' },
        	{ 'data' : 'category_name' },
        	{ 'data' : 'units' },
        	{
        		'render' : function (data, type, row, meta) {
        			if(row.status == '1') {
        				return '<span class=\"badge badge-success\">Active</span>';
        			} else {
        				return '<span class=\"badge badge-warning\">Inactive</span>';
        			}
        		}
        	},
        	{ 'defaultContent' : '<div class=\"dropdown\"><a class=\"btn btn-secondary dropdown-toggle btn-sm\" href=\"#\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"><i class=\"fs-14 fa fa-bars\"></i></a><ul class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"about-us\"><li style=\"text-align: center;\"><a class=\"dropdown-item edit_info\" href=\"javascript:void(0)\" data-toggle=\"modal\" style=\"color: blue;\"><i class=\"fa fa-edit\" style=\"margin-right: 3px;\" aria-hidden=\"true\"></i>Edit</a></li><li style=\"text-align: center;\"><a class=\"dropdown-item price_info\" href=\"javascript:void(0)\" data-toggle=\"modal\" style=\"color: black;\"><i class=\"fa fa-dollar\" style=\"margin-right: 3px;\" aria-hidden=\"true\"></i>Price</a></li><li style=\"text-align: center;\"><a class=\"dropdown-item delete_product\" href=\"javascript:void(0)\" data-toggle=\"modal\" style=\"color: red;\">Delete</a></li><li style=\"text-align: center;\"><a class=\"dropdown-item change_status\" href=\"javascript:void(0)\" data-toggle=\"modal\" style=\"color: grey;\"><i class=\"fa fa-toggle-on\" style=\"margin-right: 3px;\" aria-hidden=\"true\"></i>Change Status</a></li></ul></div>'
        	}
    	]";
        return $retData;
	}

	/*	Products ajax list	*/
	public function getproductList_ajax() {
		$response = array();
		try {
			$data = $this->input->post();
			$limit  = (!empty($data['length'])?$data['length']:10);
			$offset = (!empty($data['start'])?$data['start']:0);
			$search = !empty($data['search']['value'])? $data['search']['value'] : '';

			$url 	= API_URL.'products/list';

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

	/*	Add Product */
	public function add() {
		try {
			// fetch master category
			$mastercategory = $this->fetchMasterCategoryList();
			$brandList = $this->brandList();

			$data	=	$this->input->post();
			if (!empty($data)) {
				$this->form_validation->set_data($data);
				if (!$this->form_validation->run('add_product')) {
					$data['page_title'] 	= 'Add Product';
					$data['brandlist']  	= $brandList;
			        $data['mastercatlist']  = $mastercategory;
					$page["script_files"] 	= $this->load->view('scripts/products/productlist',$data, true);
					$page["layout_content"] = $this->load->view('pages/products/add',$data, true);
			        $this->load->view('layouts/masterlayout', $page);

				} else {
					if (!empty($_FILES['image']['name'])) {
						$tmpfile = $_FILES['image']['tmp_name'];
				        $filename = basename($_FILES['image']['name']);
				        $data['file'] = curl_file_create($tmpfile, $_FILES['image']['type'], 
				            	$filename);
					}	
					
					$url = API_URL.'products/store'; // api call
					$result = $this->http_post_images($url,$data);
					if (!empty($result['status'])) {
						$this->session->set_flashdata('success_msg', 'Product added successfully');
						redirect('products/add');
					} else {
						$this->session->set_flashdata('error_msg', $result['message']);
						$data['mastercatlist']  = $mastercategory;
						$data['brandlist']  	= $brandList;
						$page["script_files"] 	= $this->load->view('scripts/products/productlist',$data, true);
						$page["layout_content"] = $this->load->view('pages/products/add',$data, true);
				        $this->load->view('layouts/masterlayout', $page);
					}
				}
			} else {
				$data['mastercatlist']  = $mastercategory;
				$data['brandlist']  	= $brandList;
				$data['page_title'] 	= 'Add Product';
				$page["script_files"] 	= $this->load->view('scripts/products/productlist','', true);
				$page["layout_content"] = $this->load->view('pages/products/add', $data, true);
		        $this->load->view('layouts/masterlayout', $page);
			}
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/*	Edit Product */
	public function edit($product_id) {
		try {
			$mastercategory = $this->fetchMasterCategoryList();
			$brandList 		= $this->brandList();
			
			$url 	= API_URL.'products/item?id='.$product_id; // api call
			$result = $this->http_get($url);
			if (!empty($result['status'])) {

				if (!empty($result['status'])) {

					if (!empty($result['details']['master_category_id'])) {
						$url1 = API_URL.'products/get-subcategories-from-master'; // api call
						$data1 = array('id'=>$result['details']['master_category_id']);
						$result1 = $this->http_post($url1,$data1);
						if (!empty($result1['status'])) {
							$data['subcategories'] = $result1['list'];
						}
					}
				}
				$data['item_details'] =!empty($result['details'])?$result['details']:array();
			} else {
				redirect('products/list');
			}
			$data['mastercatlist']  = $mastercategory;
			$data['brandlist']  	= $brandList;
			$data['page_title'] 	= 'Edit Product';
			$page["script_files"] 	= $this->load->view('scripts/products/productlist','', true);
			$page["layout_content"] = $this->load->view('pages/products/edit',$data,true);
	        $this->load->view('layouts/masterlayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/* Update Product  */
	public function update($product_id) {
		try {
			$data	=	$this->input->post();
			if (!empty($data) || !empty($product_id)) {
				$this->form_validation->set_data($data);
				if (!$this->form_validation->run('add_product')) {

			        $this->session->set_flashdata('error_msg', validation_errors());
			        redirect('products/edit/'.$product_id);

				} else {
					if (!empty($_FILES['image']['name'])) {
						$tmpfile = $_FILES['image']['tmp_name'];
				        $filename = basename($_FILES['image']['name']);
				        $data['file'] = curl_file_create($tmpfile, $_FILES['image']['type'],$filename);
					}
					$data['product_id'] = $product_id;
					$url = API_URL.'products/update'; // api call
					$result = $this->http_post_images($url,$data);
					if (!empty($result['status'])) {
						$this->session->set_flashdata('success_msg', 'Product updated successfully');
						redirect('products/list');
					} else {
						$this->session->set_flashdata('error_msg', $result['message']);
						redirect('products/edit/'.$product_id);
					}
				}
			} else {
				$this->session->set_flashdata('error_msg', 'Something went wrong. please try again later');
				redirect('products/list');
			}
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/* Cost link */
	public function price($product_id) {
		try {
			if (empty($product_id)) {
				redirect('products/list');
			}
			$url = API_URL.'products/item?id='.$product_id; // api call
			$result = $this->http_get($url);
			if (!empty($result['status'])) {
				$data['pro_details'] = $result['details'];
			} else {
				$this->session->set_flashdata('error_msg', $result['message']);
				redirect('products/list');
			}
			$data['page_title'] 	= 'Product Price';
			$page["layout_content"] = $this->load->view('pages/products/price', $data, true);
	        $this->load->view('layouts/masterlayout', $page);
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}	
	}

	/*	Store product price */
	public function addprice($product_id) {
		try {
			if (empty($product_id)) {
				redirect('products/list');
			}
			$postData	=	$this->input->post();
			if (!empty($postData)) {
				$data 	=	$this->validatePostData($postData);
				if (empty($data)) {
					throw new Exception("Invalid data", 422);
				}
				$this->form_validation->set_data($data);
				if (!$this->form_validation->run('product_price')) {

					$this->session->set_flashdata('error_msg', validation_errors());
					$url = API_URL.'products/item?id='.$product_id; // api call
					$result = $this->http_get($url);
					if (!empty($result['status'])) {
						$data['pro_details'] = $result['details'];
					} else {
						$this->session->set_flashdata('error_msg', $result['message']);
						redirect('products/list');
					}
					$data['page_title'] 	= 'Product Price';
					$page["layout_content"] = $this->load->view('pages/products/price', $data, true);
			        $this->load->view('layouts/masterlayout', $page);

				} else {
					$url 					= API_URL.'products/addprice'; // api call
					$result 				= $this->http_post($url,$data);
					if (!empty($result['status'])) {
						$this->session->set_flashdata('success_msg', $result['message']);
						redirect('products/list');
					} else {
						$this->session->set_flashdata('error_msg', $result['message']);
						redirect('products/price/'.$product_id);
					}
				}
			} 
		} catch (Exception $e) {
			$this->load->view('errors/500_error');
		}
	}

	/*	Get sub categories against a master categories */
	public function getSubCategoriesFromMaster_ajax() {
		$data = $this->input->post();
		if (!empty($data)) {
			$this->form_validation->set_data($data);
			$this->form_validation->set_rules('id', 'Master Category', 'trim|required');
			if (!$this->form_validation->run()) {
				echo json_encode(array('status'=>FALSE, 'message'=>validation_errors())); die; 
			} else {
				$url = API_URL.'products/get-subcategories-from-master'; // api call
				$data = array('id'=>$data['id']);
				$result = $this->http_post($url,$data);
				if (!empty($result['status'])) {
					echo json_encode(array('status'=>TRUE, 'data'=>$result['list'])); die;
				} else {
					echo json_encode(array('status'=>FALSE, 'message'=>'Failed to sub categories')); die;
				}
			}
		} else {
			echo json_encode(array('status'=>FALSE, 'message'=>'Invalid data')); die;
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
				$url = API_URL.'products/change-status'; // api call
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

	/*	Delete product */
	public function deleteProduct() {
		$data = $this->input->post();
		if (!empty($data)) {
			$this->form_validation->set_data($data);
			if (!$this->form_validation->run('change_status')) {
				echo json_encode(array('status'=>FALSE, 'message'=>validation_errors())); die; 
			} else {
				$url = API_URL.'products/delete'; // api call
				$data = array('type' => $data['type'], 'id'=>base64_decode($data['id']));
				$result = $this->http_post($url,$data);
				if (!empty($result['status'])) {
					echo json_encode(array('status'=>TRUE, 'message'=>$result['message'])); die;
				} else {
					echo json_encode(array('status'=>FALSE, 'message'=>'Failed to delete product')); die;
				}
			}
		} else {
			echo json_encode(array('status'=>FALSE, 'message'=>'Invalid data')); die;
		}
	}

	/* file validation */
	private function fileValidation($file,$filename, $type) {
		$imageAllowedTypes = array('jpg','png','jpeg');
		$result = '';
		switch ($type) {
			case 'image':
				if (empty($file[$filename]['name'])) {
					$result = 'Image field is required';
				}
				if (!empty($file[$filename]['name'])) {
					$ext = $ext = pathinfo($file[$filename]['name'], PATHINFO_EXTENSION);
					if(!in_array($ext, $imageAllowedTypes)) {
						$result = 'Invalid image format';
					}
				}
				break;
			
			default:
				# code...
				break;
		}
		return $result;
	}
}

/* End of file Products.php */
/* Location: ./application/controllers/Products.php */
