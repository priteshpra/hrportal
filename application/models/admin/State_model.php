<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class State_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
		$state=getStringClean(($this->input->post('StateName')!='')?$this->input->post('StateName'):'');
        $country=($this->input->post('CountryID') != '')?$this->input->post('CountryID'):-1;
		$status_search_value=($this->input->post('Status') != '')?$this->input->post('Status'):-1;
        $sql = "call usp_A_GetState( '$per_page_record' , '$page_number','$state','$country','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_state','StateID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        $array['StateName']   =   (isset($array['StateName']))?$array['StateName']:NULL;             
		$array['CountryID']   =   (isset($array['CountryID']))?$array['CountryID']:0;             
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddState('".$array['StateName']."','".$array['CountryID']."','".$array['created_by']."','".$array['Status']."','".$array['usertype']."','".$array['IPAddress']."')";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($array)
    {
        $array['StateName']   =   (isset($array['StateName']))?$array['StateName']:NULL;             
		$array['CountryID']   =   (isset($array['CountryID']))?$array['CountryID']:0;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $query = $this->db->query("call usp_A_EditState('".$array['StateName']."','".$array['CountryID']."','".$array['modified_by']."','".$array['Status']."','".$array['ID']."','".$array['usertype']."','".$array['IPAddress']."')");
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ssc_state";
        $array['field_name'] = "StateID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }
	public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];                
        $array['StateName']       =  $array['StateName'];     
        $array['table_name'] = "ssc_state";
        $array['field_name'] = "StateID";
        $sql = "call usp_A_CheckDuplicate('".$array['table_name']."','StateName','".$array['StateName']."','StateID','".$array['id']."')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
	public function getStateByID($ID = null) {
        $query = $this->db->query("call usp_A_GetStateByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}