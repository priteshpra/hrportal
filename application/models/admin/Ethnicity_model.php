<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ethnicity_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
	    $ethnicityname=getStringClean(($this->input->post('EthnicityName')!='')?$this->input->post('EthnicityName'):'');
        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetEthnicity( '$per_page_record' , '$page_number','$ethnicityname','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_ethnicity','EthnicityID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        $array['EthnicityName']   =   (isset($array['EthnicityName']))?$array['EthnicityName']:NULL;
        $array['ParentID'] = (isset($array['ParentID']))?$array['ParentID']:0;           
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddEthnicity('".
            $array['EthnicityName']."','".
            $array['ParentID']."','".
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
        $array['EthnicityName']   =   (isset($array['EthnicityName']))?$array['EthnicityName']:NULL;
        $array['ParentID'] = (isset($array['ParentID']))?$array['ParentID']:0;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['EthnicityID']))?$array['EthnicityID']:NULL;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
        $query = $this->db->query("call usp_A_EditEthnicity('".
            $array['EthnicityName']."','".
            $array['ParentID']."','".
            $array['modified_by']."','".
            $array['Status']."','".
            $array['ID']."','".
            $array['usertype']."','".
            $array['IPAddress']."')");
		$query->next_result();
        //pr($query->result());exit();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ssc_ethnicity";
        $array['field_name'] = "EthnicityID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".
            $array['table_name']."','".
            $array['field_name']."','".
            $array['id']."','".
            $array['status']."','".
            $array['modified_by']."');");        
               
    }

    public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];                
        $array['EthnicityName']       =  $array['EthnicityName'];
        
        $array['table_name'] = "ssc_ethnicity";
        $array['field_name'] = "EthnicityID";
        $sql = "call usp_A_CheckDuplicate('".$array['table_name']."','EthnicityName','".$array['EthnicityName']."','EthnicityID','".$array['id']."')"; 
        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function getEthnicityByID($ID = null) {
        $query = $this->db->query("call usp_A_GetEthnicityByID('$ID')");
        $query->next_result();
        return $query->row();
    }

    
    // public function getParentEthnicityByID($ID = null) {
    //     $query = $this->db->query("call usp_A_GetParentEthnicityByID('$ID')");
    //     $query->next_result();
    //     return $query->row();
    // }
}