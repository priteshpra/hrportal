<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Advertisement_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
		$title=getStringClean(($this->input->post('Title')!='')?$this->input->post('Title'):'');
		$status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetAdvertisement( '$per_page_record' , '$page_number','$title','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_advertisement','AdvertisementID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        //print_r($array);die();
        $array['Title']   =  getStringClean((isset($array['Title']))?$array['Title']:NULL);        
        $array['RedirectURL']   =   getStringClean((isset($array['RedirectURL']))?$array['RedirectURL']:NULL);
        $array['Position']   =   (isset($array['Position']))?$array['Position']:NULL;
        $array['Type_t']   =   getStringClean((isset($array['Type_t']))?$array['Type_t']:NULL);
        $array['ShortDescription']   =   getStringClean((isset($array['ShortDescription']))?$array['ShortDescription']:NULL);
        $array['image']   =   (isset($array['image']))?$array['image']:NULL;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddAdvertisement('".
            $array['Title']."','".
            $array['ShortDescription']."','".
            $array['RedirectURL']."','".
            $array['Type_t']."','".
            $array['image']."','".
            $array['Position']."','".
            $array['created_by']."','".
            $array['Status']."','".
            $array['usertype']."','".
            $array['IPAddress'].
            "')";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($array)
    {
        //print_r($array);die();
        $array['Title']   =  getStringClean((isset($array['Title']))?$array['Title']:NULL);        
        $array['RedirectURL']   =   getStringClean((isset($array['RedirectURL']))?$array['RedirectURL']:NULL);
        $array['Position']   =   (isset($array['Position']))?$array['Position']:NULL;
        $array['Type_t']   =   getStringClean((isset($array['Type_t']))?$array['Type_t']:NULL);
        $array['ShortDescription']   =   getStringClean((isset($array['ShortDescription']))?$array['ShortDescription']:NULL);
        $array['image']   =   (isset($array['image']))?$array['image']:NULL;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		$sql = "call usp_A_EditAdvertisement('" .
                $array['Title']."','".
                $array['ShortDescription']."','".
                $array['RedirectURL']."','".
                $array['Type_t']."','".
                $array['image']."','".
                $array['Position']."','".
                $array['modified_by']."','".
                $array['Status']."','".
                $array['ID']."','".
                $array['usertype']."','".
                $array['IPAddress'].
                "')";
        $query = $this->db->query($sql);
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ssc_advertisement";
        $array['field_name'] = "AdvertisementID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }
	public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];                
        $array['Title']       =  getStringClean($array['Title']);
        $array['table_name'] = "ssc_advertisement";
        $array['field_name'] = "AdvertisementID";
        $sql = "call usp_A_CheckDuplicate('".$array['table_name']."','Title','".$array['Title']."','AdvertisementID','".$array['id']."')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
	public function getByID($ID = null) {
        $query = $this->db->query("call usp_A_GetAdvertisementByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}