<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authmodel extends CI_Model {

	public function checkLogin($data) {
		$status = false;
		$result = $this->db->get_where('admin_login',array('email'=>$data['email']))->result_array();
		if (!empty($result)) {
			$checkPassword = password_verify($data['password'], $result[0]['password']);
            if($checkPassword == false){
                return $status;
            } else {
            	return $result[0];
            }
		}
	}

}

/* End of file Authmodel.php */
/* Location: ./application/models/Authmodel.php */