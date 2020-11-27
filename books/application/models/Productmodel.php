<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productmodel extends CI_Model {

	public function insert($table, $post_data=array()){
		$this->db->insert($table,$post_data);
		$insertId = $this->db->insert_id();
		return $insertId;
	}

	public function getAllcatDetails($limit = 10, $offset = 0, $search='') {
		
		$this->db->select("SQL_CALC_FOUND_ROWS catN.category_name, catN.created_at, IF(catN.status = 'A','Active','Inactive') AS `status`,catN.id",FALSE);
		$this->db->from('kk_books_category catN');
		$this->db->where('catN.status !=', 'D');
		if (!empty($search)) {
			$this->db->like('catN.category_name', $search, 'after');
		}
		$this->db->order_by('catN.id','DESC');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();

		$countQuery = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		$data['total_count'] = $countQuery->row()->Count;
		$data['fetch_count'] = $query->num_rows();
		$data['fetch_data'] = $query->result_array();
		return $data;
	}



}

/* End of file Productmodel.php */
/* Location: ./application/models/Productmodel.php */