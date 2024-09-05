<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employeedetails_model extends CI_Model 
{
    function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('common_helper');
    }

public function Employee_listData($per_page_record = 10, $page_number = 1)
    {
        $search_text = getStringClean(($this->input->post('search_text')!='')?$this->input->post('search_text'):'');
       
        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        $ID = $this->session->userdata['CompanyID'];
        $sql = "call usp_A_GetCompanyUser( '$per_page_record' , '$page_number','$search_text','$ID','$status_search_value',0)";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_companyuser','CompanyUserID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {   //print_r($array);die();
        $array['ID'] = $this->session->userdata['CompanyID'];
        $array['FirstName']   =  getStringClean((isset($array['FirstName']))?$array['FirstName']:NULL); 
        $array['LastName']   =  getStringClean((isset($array['LastName']))?$array['LastName']:NULL); 
        $array['EmailID']   =  getStringClean((isset($array['EmailID']))?$array['EmailID']:NULL); 
        $array['Password']   =  fnEncrypt($this->input->post('Password'), $this->config->item('sSecretKey'));
        $array['MobileNo']   =  getStringClean((isset($array['MobileNo']))?$array['MobileNo']:NULL); 
        $array['DesignationID']   =  getStringClean((isset($array['DesignationID']))?$array['DesignationID']:0); 
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddCompanyUser('".
            $array['ID']."','".
            $array['FirstName']."','".
            $array['LastName']."','".
            $array['EmailID']."','".
            $array['Password']."','".
            $array['MobileNo']."','".
            $array['DesignationID']."','".
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
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		$array['MobileNo']   =  getStringClean((isset($array['MobileNo']))?$array['MobileNo']:NULL); 
        $array['DesignationID']   =  getStringClean((isset($array['DesignationID']))?$array['DesignationID']:0); 
		
		
        $query = $this->db->query("call usp_A_EditCompanyUser('".
            $array['FirstName']."','".
            $array['LastName']."','".
            $array['modified_by']."','".
            $array['Status']."','".
            $array['UserID']."','".
            $array['usertype']."','".
            $array['IPAddress']."','".
            $array['MobileNo']."','".
            $array['DesignationID']."')");
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ssc_companyuser";
        $array['field_name'] = "UserID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }
    
    public function getemployeedetailsByID($ID = null) {
        $query = $this->db->query("call usp_A_GetCompanyUserDetailsByID('$ID')");
        $query->next_result();
        return $query->row();
    }

    function email_exists($email,$contact,$id){
        //print_r("call usp_A_CheckEmailMobileExist('".$email."','".$contact."','".$id."')");die();
        $query = $this->db->query("call usp_A_CheckEmailMobileExist('".$email."','".$contact."','".$id."')");
        //$query->next_result();
        return $query->row();
    }

}