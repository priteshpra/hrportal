<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
		$CategoryName=getStringClean(($this->input->post('CategoryName')!='')?$this->input->post('CategoryName'):'');
        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetCategory( '$per_page_record' , '$page_number','$CategoryName','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_category','CategoryID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    { 
        $array['CategoryName']   =   (isset($array['CategoryName']))?$array['CategoryName']:NULL;             
		$array['Description'] = (isset($array['Description'])) ? addslashes($array['Description']) : NULL;
		$array['image'] = getStringClean((isset($array['image'])) ? $array['image'] : NULL);
		$array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddCategory('".
            $array['CategoryName']."','".
            $array['Description']."','".
            $array['image']."','".
            $array['created_by']."','".
            $array['Status']."','".
            $array['usertype']."','".
            $array['IPAddress']."')";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($array)
    {
        $array['CategoryName']   =   (isset($array['CategoryName']))?$array['CategoryName']:NULL;             
		$array['Description'] = (isset($array['Description'])) ? addslashes($array['Description']) : NULL;
        $array['image'] = getStringClean((isset($array['image'])) ? $array['image'] : NULL);
		$array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $query = $this->db->query("call usp_A_EditCategory('".$array['CategoryName']."','".$array['Description']."','".$array['image']."','".$array['modified_by']."','".$array['Status']."','".$array['ID']."','".$array['usertype']."','".$array['IPAddress']."')");
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ssc_category";
        $array['field_name'] = "CategoryID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }
	
	public function getCategoryByID($ID = null) {
        $query = $this->db->query("call usp_A_GetCategoryByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}