<?php 

$config = array(

	'add_user' => array(
						array(
							'field'	=>	'name',
							'label'	=>	'Name',
							'rules'	=>	'required|trim|regex_match[/^[a-z|A-Z ]+$/]',
							'errors'=>	array('regex_match'=>'Only characters and spaces are allowed')
						),
						array(
							'field'	=>	'email',
							'label'	=>	'Email',
							'rules'	=>	'required|valid_email'
						),
						array(
							'field'	=>	'mobile',
							'label'	=>	'Mobile',
							'rules'	=>	'required|numeric|exact_length[10]'
						),
						array(
							'field'	=>	'gender',
							'label'	=>	'Gender',
							'rules'	=>	'required'
						),
						array(
							'field'	=>	'password',
							'label'	=>	'Password',
							'rules'	=>	'required'
						),
						array(
							'field'	=>	'address',
							'label'	=>	'Address',
							'rules'	=>	'required'
						)
				 ),
		'update_user' => array(
						array(
							'field'	=>	'name',
							'label'	=>	'Name',
							'rules'	=>	'required|trim|regex_match[/^[a-z|A-Z ]+$/]',
							'errors'=>	array('regex_match'=>'Only characters and spaces are allowed')
						),
						array(
							'field'	=>	'email',
							'label'	=>	'Email',
							'rules'	=>	'required|valid_email'
						),
						array(
							'field'	=>	'mobile',
							'label'	=>	'Mobile',
							'rules'	=>	'required|numeric|exact_length[10]'
						),
						array(
							'field'	=>	'gender',
							'label'	=>	'Gender',
							'rules'	=>	'required'
						),
				 ),
	'add_master_category' => array(
						array(
							'field'	=>	'category_name',
							'label'	=>	'Master category',
							'rules'	=>	'required|trim|alpha_numeric_spaces',
							// 'errors'=>	array('regex_match'=>'Only characters and spaces are allowed')
						)
				 ),
	'add_sub_category' => array(
						array(
							'field'	=>	'master_category_id',
							'label'	=>	'Master category',
							'rules'	=>	'required'
						),
						array(
							'field'	=>	'category_name',
							'label'	=>	'Sub category',
							'rules'	=>	'required|trim|alpha_numeric_spaces',
							// 'errors'=>	array('regex_match'=>'Only characters and spaces are allowed')
						)
				 ),
	'add_brand' => array(
						array(
							'field'	=>	'brand_name',
							'label'	=>	'Brand name',
							'rules'	=>	'required|trim|alpha_numeric_spaces',
							// 'errors'=>	array('regex_match'=>'Only characters and spaces are allowed')
						)
				 ),
	'add_product' => array(
						array(
							'field'	=>	'master_category_id',
							'label'	=>	'Master category',
							'rules'	=>	'required|trim|numeric',
						),
						array(
							'field'	=>	'sub_category_id',
							'label'	=>	'Sub category',
							'rules'	=>	'trim|numeric',
						),
						array(
							'field'	=>	'brand_id',
							'label'	=>	'Brand',
							'rules'	=>	'trim|numeric',
						),
						array(
							'field'	=>	'name',
							'label'	=>	'Name',
							'rules'	=>	'required|trim|regex_match[/^[a-z|A-Z|0-9 -]+$/]',
							'errors'=>	array('regex_match'=>'Only characters and spaces are allowed')
						),
						array(
							'field'	=>	'units',
							'label'	=>	'Units',
							'rules'	=>	'required|trim|alpha',
						),
						array(
							'field'	=>	'description',
							'label'	=>	'Description',
							'rules'	=>	'trim',
						),
						array(
							'field'	=>	'specification',
							'label'	=>	'Specification',
							'rules'	=>	'trim',
						)
				 ),
	'change_status' => array(
						array(
							'field'	=>	'type',
							'label'	=>	'Type',
							'rules'	=>	'required|trim|regex_match[/^[a-z|A-Z|0-9_]+$/]',
							'errors'=>	array('regex_match'=>'Only characters and spaces are allowed')
						),
						array(
							'field'	=>	'id',
							'label'	=>	'Id',
							'rules'	=>	'required|trim|valid_base64',
							'errors'=>	array('valid_base64'=>'Invalid %s')
						)
				 ),
	'product_price' => array(
						array(
							'field'	=>	'pr_cost_id',
							'label'	=>	'Product',
							'rules'	=>	'trim|alpha_numeric'
						),
						array(
							'field'	=>	'pro_id',
							'label'	=>	'Product',
							'rules'	=>	'required|trim|alpha_numeric'
						),
						array(
							'field'	=>	'type',
							'label'	=>	'Type',
							'rules'	=>	'required|trim|alpha|in_list[insert,update]'
						),
						array(
							'field'	=>	'product_mrp',
							'label'	=>	'Mrp price',
							'rules'	=>	'required|trim|regex_match[/^\d+(\.\d{1,2})?$/]',
							'errors'=>	array('regex_match'=>'Amount should be numeric or  decimal number like 153.00 or 153')
						),
						array(
							'field'	=>	'website_cost',
							'label'	=>	'Website cost',
							'rules'	=>	'required|trim|regex_match[/^\d+(\.\d{1,2})?$/]',
							'errors'=>	array('regex_match'=>'Amount should be numeric or  decimal number like 153.00 or 153')
						),
						array(
							'field'	=>	'product_discount',
							'label'	=>	'Discount price',
							'rules'	=>	'trim|regex_match[/^\d+(\.\d{1,2})?$/]',
							'errors'=>	array('regex_match'=>'Amount should be numeric or  decimal number like 153.00 or 153')
						)
				 ),
	'add_vendor' => array(
						array(
							'field'	=>	'name',
							'label'	=>	'Name',
							'rules'	=>	'required|trim|regex_match[/^[a-z|A-Z ]+$/]',
							'errors'=>	array('regex_match'=>'Only characters and spaces are allowed')
						),
						array(
							'field'	=>	'email',
							'label'	=>	'Email',
							'rules'	=>	'valid_email'
						),
						array(
							'field'	=>	'mobile',
							'label'	=>	'Mobile',
							'rules'	=>	'required|numeric|exact_length[10]'
						),
						array(
							'field'	=>	'gender',
							'label'	=>	'Gender',
							'rules'	=>	'required'
						),
						array(
							'field'	=>	'alternative_number',
							'label'	=>	'Alternative number',
							'rules'	=>	'numeric|exact_length[10]'
						),
						array(
							'field'	=>	'aadhaar_no',
							'label'	=>	'Aadhaar No.',
							'rules'	=>	'required|numeric|exact_length[12]'
						),
						array(
							'field'	=>	'company_name',
							'label'	=>	'Company name',
							'rules'	=>	'required|alpha_numeric_spaces'
						),
						array(
							'field'	=>	'company_reg_number',
							'label'	=>	'Company Registration No.',
							'rules'	=>	'alpha_numeric'
						),
						array(
							'field'	=>	'gst_number',
							'label'	=>	'GST No.',
							'rules'	=>	'alpha_numeric|exact_length[15]'
						),
						array(
							'field'	=>	'business_type',
							'label'	=>	'Busniess type.',
							'rules'	=>	'required|alpha_numeric_spaces'
						),
						array(
							'field'	=>	'office_address',
							'label'	=>	'Office address.',
							'rules'	=>	'required|regex_match[/^[0-9a-zA-Z\s,\/-]+$/]',
							'errors'=>	array('regex_match'=>'Invalid address format')
						),
						array(
							'field'	=>	'office_pincode',
							'label'	=>	'Office pincode.',
							'rules'	=>	'required|numeric|exact_length[6]'
						)
				 ),
	'banner_image' => array(
						array(
							'field'	=>	'title',
							'label'	=>	'Title',
							'rules'	=>	'required|trim|regex_match[/^[a-z|A-Z0-9 ]+$/]',
							'errors'=>	array('regex_match'=>'Only characters and spaces are allowed')
						),
						array(
							'field'	=>	'type',
							'label'	=>	'Type',
							'rules'	=>	'required|trim|in_list[banner]',
						)
				)

);

?>