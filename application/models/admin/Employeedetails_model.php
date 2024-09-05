<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employeedetails_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) 
    {        
        $FirstName = getStringClean(($this->input->post('FirstName')!='')?$this->input->post('FirstName'):'');
        $EmailID = getStringClean(($this->input->post('EmailID')!='')?$this->input->post('EmailID'):'');
        $MobileNo = getStringClean(($this->input->post('MobileNo')!='')?$this->input->post('MobileNo'):'');
        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
      
        $sql = "call usp_A_GetEmployees( '$per_page_record' , '$page_number','$FirstName','$EmailID','$MobileNo','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_leaverequest','LeaverequestID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {   //print_r($array);die();
        
        $array['FirstName']   =  getStringClean((isset($array['FirstName']))?$array['FirstName']:NULL); 
        $array['LastName']   =  getStringClean((isset($array['LastName']))?$array['LastName']:NULL); 
        $array['Password']   =  fnEncrypt($this->input->post('Password'), $this->config->item('sSecretKey'));            
        $array['EmailID']   =  getStringClean((isset($array['EmailID']))?$array['EmailID']:NULL); 
        $array['MobileNo']   =  getStringClean((isset($array['MobileNo']))?$array['MobileNo']:NULL); 
        $array['Address']   =  getStringClean((isset($array['Address']))?$array['Address']:NULL); 
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddEmployee('".
            $array['FirstName']."','".
            $array['LastName']."','".
            $array['EmailID']."','".
            $array['Password']."','".
            $array['Address']."','".
            $array['MobileNo']."','".
            $array['created_by']."','".
            $array['Status']."','".
            $array['usertype']."','".
            $array['IPAddress']."')";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($array)
     {   //print_r($array);die();
        $array['UserID']   =   (isset($array['UserID']))?$array['UserID']:0;             
        $array['FirstName']   =  getStringClean((isset($array['FirstName']))?$array['FirstName']:NULL); 
        $array['LastName']   =  getStringClean((isset($array['LastName']))?$array['LastName']:NULL); 
        $array['MobileNo']   =  getStringClean((isset($array['MobileNo']))?$array['MobileNo']:NULL); 
        $array['Address']   =  getStringClean((isset($array['Address']))?$array['Address']:NULL); 
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $query = $this->db->query("call usp_A_EditEmployee('".
            $array['FirstName']."','".
            $array['LastName']."','".
            $array['Address']."','".
            $array['MobileNo']."','".
            $array['ID']."','".
            $array['modified_by']."','".
            $array['Status']."','".
            $array['usertype']."','".
            $array['IPAddress']."')");
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ssc_admindetails";
        $array['field_name'] = "UserID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }
    
    public function getemployeedetailsByID($ID = null) {
        $query = $this->db->query("call usp_A_GetEmployeedetailsByID('$ID')");
        $query->next_result();
        return $query->row();
    }
	
}