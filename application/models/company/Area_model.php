<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Area_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
		$area=getStringClean(($this->input->post('AreaName')!='')?$this->input->post('AreaName'):'');
        $city=($this->input->post('CityID') != '')?$this->input->post('CityID'):-1;
		$status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetArea( '$per_page_record' , '$page_number','$area','$city','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_area','AreaID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        $array['AreaName']   =  getStringClean((isset($array['AreaName']))?$array['AreaName']:NULL);             
		$array['CityID']   =   (isset($array['CityID']))?$array['CityID']:0;             
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddArea('".
            $array['AreaName']."','".
            $array['CityID']."','".
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

        $array['AreaName']   =   getStringClean((isset($array['AreaName']))?$array['AreaName']:NULL);             
		$array['CityID']   =   (isset($array['CityID']))?$array['CityID']:0;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		$sql = "call usp_A_EditArea('" .
                $array['AreaName']."','".
                $array['CityID']."','".
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
        
        $array['table_name'] = "ssc_area";
        $array['field_name'] = "AreaID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }
	public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];                
        $array['AreaName']       =  $array['AreaName'];     
        $array['table_name'] = "ssc_area";
        $array['field_name'] = "AreaID";
        $sql = "call usp_A_CheckDuplicate('".$array['table_name']."','AreaName','".$array['AreaName']."','AreaID','".$array['id']."')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
	public function getByID($ID = null) {
        $query = $this->db->query("call usp_A_GetAreaByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}