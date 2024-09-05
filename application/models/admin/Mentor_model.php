<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mentor_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
		$mentor=getStringClean(($this->input->post('FirstName')!='')?$this->input->post('FirstName'):'');
        $emailId=($this->input->post('emailId') != '')?$this->input->post('emailId'):'';
		$status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetMentor( '$per_page_record' , '$page_number','$mentor','$emailId','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }

    public function subscriptionData($per_page_record = 10, $page_number = 1, $id=0,$SearchText='') 
    {        
        $SearchText=getStringClean(($this->input->post('SearchText')!='')?$this->input->post('SearchText'):'');
        // $emailId=($this->input->post('emailId') != '')?$this->input->post('emailId'):'';
        // $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_M_GetVideosSubscribtion( '$per_page_record' , '$page_number','$id','".base_url()."' ,'$SearchText')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_mentor','UserID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        $array['FirstName']   =  getStringClean((isset($array['FirstName']))?$array['FirstName']:NULL); 
        $array['LastName']   =  getStringClean((isset($array['LastName']))?$array['LastName']:NULL); 
        $array['StatusText']   =  getStringClean((isset($array['StatusText']))?$array['StatusText']:NULL); 
        $array['BriefBio']   =  getStringClean((isset($array['BriefBio']))?$array['BriefBio']:NULL);   
        $array['Password']   =  fnEncrypt($this->input->post('password'), $this->config->item('sSecretKey'));                     
        $array['EmailID']   =  getStringClean((isset($array['EmailID']))?$array['EmailID']:NULL); 
        $array['MobileNo']   =  getStringClean((isset($array['MobileNo']))?$array['MobileNo']:NULL); 
        $array['CompanyName']   =  getStringClean((isset($array['CompanyName']))?$array['CompanyName']:NULL); 
        $array['DesignationID']   =  getStringClean((isset($array['DesignationID']))?$array['DesignationID']:0); 
        $array['FaceboookURL']   =  getStringClean((isset($array['FaceboookURL']))?$array['FaceboookURL']:NULL); 
        $array['TwitterURL']   =  getStringClean((isset($array['TwitterURL']))?$array['TwitterURL']:NULL); 
        $array['LinkedinURL']   =  getStringClean((isset($array['LinkedinURL']))?$array['LinkedinURL']:NULL); 
        $array['PinterestURL']   =  getStringClean((isset($array['PinterestURL']))?$array['PinterestURL']:NULL); 
        $array['image']   =  getStringClean((isset($array['image']))?$array['image']:NULL);              
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddMentor('".
            $array['FirstName']."','".
            $array['LastName']."','".
            $array['StatusText']."','".
            $array['image']."','".
            $array['BriefBio']."','".
            $array['EmailID']."','".
            $array['MobileNo']."','".
            $array['Password']."','".
            $array['CompanyName']."','".
            $array['DesignationID']."','".
            $array['FaceboookURL']."','".
            $array['TwitterURL']."','".
            $array['LinkedinURL']."','".
            $array['PinterestURL']."','".
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
        $array['FirstName']   =  getStringClean((isset($array['FirstName']))?$array['FirstName']:NULL); 
        $array['LastName']   =  getStringClean((isset($array['LastName']))?$array['LastName']:NULL); 
        $array['StatusText']   =  getStringClean((isset($array['StatusText']))?$array['StatusText']:NULL); 
        $array['BriefBio']   =  getStringClean((isset($array['BriefBio']))?$array['BriefBio']:NULL);   
        $array['Password']   =  fnEncrypt($this->input->post('password'), $this->config->item('sSecretKey'));                     
        $array['EmailID']   =  getStringClean((isset($array['EmailID']))?$array['EmailID']:NULL); 
        $array['MobileNo']   =  getStringClean((isset($array['MobileNo']))?$array['MobileNo']:NULL); 
        $array['CompanyName']   =  getStringClean((isset($array['CompanyName']))?$array['CompanyName']:NULL); 
        $array['DesignationID']   =  getStringClean((isset($array['DesignationID']))?$array['DesignationID']:0); 
        $array['FaceboookURL']   =  getStringClean((isset($array['FaceboookURL']))?$array['FaceboookURL']:NULL); 
        $array['TwitterURL']   =  getStringClean((isset($array['TwitterURL']))?$array['TwitterURL']:NULL); 
        $array['LinkedinURL']   =  getStringClean((isset($array['LinkedinURL']))?$array['LinkedinURL']:NULL); 
        $array['PinterestURL']   =  getStringClean((isset($array['PinterestURL']))?$array['PinterestURL']:NULL); 
        $array['image']   =  getStringClean((isset($array['image']))?$array['image']:NULL);              
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['UserID']        = (isset($array['UserID']))?$array['UserID']:NULL;
		$array['modified_by']   = $this->session->userdata['UserID'];
        $array['usertype']      = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress']     = GetIP();
		$sql = "call usp_A_EditMentor('" .
                $array['UserID']."','".
                $array['FirstName']."','".
                $array['LastName']."','".
                $array['StatusText']."','".
                $array['image']."','".
                $array['BriefBio']."','".
                $array['MobileNo']."','".
                $array['CompanyName']."','".
                $array['DesignationID']."','".
                $array['FaceboookURL']."','".
                $array['TwitterURL']."','".
                $array['LinkedinURL']."','".
                $array['PinterestURL']."','".
                $array['modified_by']."','".
                $array['Status']."','".
                $array['usertype']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ssc_mentor";
        $array['field_name'] = "UserID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }
	public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];                
        $array['FirstName']       =  $array['FirstName'];     
        $array['table_name'] = "ssc_mentor";
        $array['field_name'] = "UserID";
        $sql = "call usp_A_CheckDuplicate('".$array['table_name']."','FirstName','".$array['FirstName']."','UserID','".$array['id']."')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
	public function getByID($ID = null) {
        $query = $this->db->query("call usp_A_GetMentorByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}