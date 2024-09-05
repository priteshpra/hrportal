<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Country_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
	    $country=getStringClean(($this->input->post('CountryName')!='')?$this->input->post('CountryName'):'');
        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetCountry( '$per_page_record' , '$page_number','$country','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_country','CountryID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        $array['CountryName']   =   (isset($array['CountryName']))?$array['CountryName']:NULL;             
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddCountry('".
            $array['CountryName']."','".
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
        $array['CountryName']   =   (isset($array['CountryName']))?$array['CountryName']:NULL;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $query = $this->db->query("call usp_A_EditCountry('".$array['CountryName']."','".
            $array['modified_by']."','".
            $array['Status']."','".
            $array['ID']."','".
            $array['usertype']."','".
            $array['IPAddress']."')");
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ssc_country";
        $array['field_name'] = "CountryID";
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
        $array['CountryName']       =  $array['CountryName'];
        
        $array['table_name'] = "ssc_country";
        $array['field_name'] = "CountryID";
        $sql = "call usp_A_CheckDuplicate('".$array['table_name']."','CountryName','".$array['CountryName']."','CountryID','".$array['id']."')"; 
        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function getCountryByID($ID = null) {
        $query = $this->db->query("call usp_A_GetCountryByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}