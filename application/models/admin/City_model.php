<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class City_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
		$city=getStringClean(($this->input->post('CityName')!='')?$this->input->post('CityName'):'');
        $state=($this->input->post('StateID') != '')?$this->input->post('StateID'):-1;
        $country=($this->input->post('CountryID') != '')?$this->input->post('CountryID'):-1;
		$status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetCity( '$per_page_record' , '$page_number','$city','$state','$country','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_cities','CityID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {   
  
        $array['CityName']   =   (isset($array['CityName']))?$array['CityName']:NULL;             
		$array['StateID']   =   (isset($array['StateID']))?$array['StateID']:0;             
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
        $sql = "call usp_A_AddCity('".$array['CityName']."','".$array['StateID']."','".$array['created_by']."','".$array['Status']."','".$array['usertype']."','".$array['IPAddress']."')";     
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($array)
    {
        $array['CityName']   =   (isset($array['CityName']))?$array['CityName']:NULL;             
		$array['StateID']   =   (isset($array['StateID']))?$array['StateID']:0;      
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $query = $this->db->query("call usp_A_EditCity('".$array['CityName']."','".$array['StateID']."','".$array['modified_by']."','".$array['Status']."','".$array['ID']."','".$array['usertype']."','".$array['IPAddress']."')");
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ssc_cities";
        $array['field_name'] = "CityID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }

    public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];                
        $array['CityName']       =  $array['CityName'];
        $array['table_name'] = "ssc_cities";
        $array['field_name'] = "CityID";
        $sql = "call usp_A_CheckDuplicate('".$array['table_name']."','CityName','".$array['CityName']."','CityID','".$array['id']."')"; 
        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function getCityByID($ID = null) {
        $query = $this->db->query("call usp_A_GetCityByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}