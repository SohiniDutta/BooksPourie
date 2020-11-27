<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productmodel extends CI_Model {

	public function insert($table, $post_data=array()){
		$this->db->insert($table,$post_data);
		$insertId = $this->db->insert_id();
		return $insertId;
	}

    /*	Simple select Query with condition */
    public function getDetails($table_name = '', $fields = '', $conditions = '', $limit = null, $offset = 0) {
    	if (empty($table_name) || empty($fields) || empty($conditions)) {
    		return;
    	}
    	$fields = preg_replace('/\s+/', '', $fields);
    	$fetchContent = $table_name.'.'.str_replace(',',",$table_name.",$fields);

    	$this->db->select($fetchContent);
    	$this->db->from($table_name);
    	$this->db->where($conditions);
        if (!is_null($limit)) {
            $this->db->limit($limit,$offset);
        }
    	$sql = $this->db->get();
    	$result = $sql->result_array();
    	return $result;
    }

    /*	Update Record 	*/
    public function update($table_name, $data = array(), $condition = array()) {
    	$this->db->trans_start(); # Starting Transaction
    		$this->db->where($condition);
        	$this->db->update($table_name, $data);
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE) {
		    # Something went wrong.
		    $this->db->trans_rollback();
		    return FALSE;
		} 
		else {
		    # Everything is Perfect. 
		    # Committing data to the database.
		    $this->db->trans_commit();
		    return TRUE;
		}
    }

    /* Change status for Admin */
    public function changeStatus($table, $data) {
        $sql = "UPDATE `".$table."` SET `status` =  ( CASE WHEN `status` = 'A' THEN 'I' ELSE 'A' END ) WHERE `id` = ?";
        $query = $this->db->query($sql, array(base64_decode($data['id'])));
        return $query;
    }

	public function getAllMasterCatDetails($limit = 10, $offset = 0, $search='') {
		$this->db->select("SQL_CALC_FOUND_ROWS mast_cat.category_name, mast_cat.image, DATE_FORMAT(mast_cat.created_at,'%d-%m-%Y') AS `created_at`, mast_cat.status AS `status`,mast_cat.id",FALSE);
		$this->db->from('master_category mast_cat');
		$this->db->where('mast_cat.status !=', 'D');
		if (!empty($search)) {
			$this->db->like('mast_cat.category_name', $search, 'after');
		}
		$this->db->order_by('mast_cat.id','DESC');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();

		$countQuery = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		$data['total_count'] = $countQuery->row()->Count;
		$data['fetch_count'] = $query->num_rows();
		$data['fetch_data'] = $query->result_array();
		return $data;
	}

	public function getAllSubCatDetails($limit = 10, $offset = 0, $search='') {
		$this->db->select("SQL_CALC_FOUND_ROWS mast_sub_cat.`category_name`, mast_cat.category_name AS `master_category`, mast_sub_cat.id, mast_sub_cat.master_category_id, DATE_FORMAT(mast_sub_cat.created_at,'%d-%m-%Y') AS `created_at`,mast_sub_cat.status",FALSE);
		$this->db->from('master_subcategory mast_sub_cat');
		$this->db->join('master_category mast_cat','mast_cat.id = mast_sub_cat.master_category_id','left');
		$this->db->where(array('mast_sub_cat.status !='=>'D','mast_cat.status !='=>'D'));
		if (!empty($search)) {
			$this->db->like('mast_sub_cat.category_name', $search, 'after');
		}
		$this->db->order_by('mast_sub_cat.id','DESC');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();

		$countQuery = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		$data['total_count'] = $countQuery->row()->Count;
		$data['fetch_count'] = $query->num_rows();
		$data['fetch_data'] = $query->result_array();
		return $data;
	}

	public function getMasterCatName($tablename,$condition=array()) {
		$this->db->select("$tablename.*");
		$this->db->from($tablename);
		if (!empty($condition)) {
			$this->db->where($condition);
		}
		$query=$this->db->get();
		$result=$query->result_array();
		return $result;
	}


}

/* End of file Productmodel.php */
/* Location: ./application/models/Productmodel.php */