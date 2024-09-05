<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Industrytype_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
		$industrytype=getStringClean(($this->input->post('Industrytype')!='')?$this->input->post('Industrytype'):'');
		$status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
       $sql = "call usp_A_GetIndustrytype( '$per_page_record' , '$page_number','$industrytype','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_industrytype','IndustrytypeID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        $array['Industrytype']   =  getStringClean((isset($array['Industrytype']))?$array['Industrytype']:NULL);             
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddIndustrytype('".
            $array['Industrytype']."','".
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

        $array['Industrytype']   =   getStringClean((isset($array['Industrytype']))?$array['Industrytype']:NULL);             
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		$sql = "call usp_A_EditIndustrytype('" .
                $array['Industrytype']."','".
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
        
        $array['table_name'] = "ssc_industrytype";
        $array['field_name'] = "IndustrytypeID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }
	public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];                
        $array['Industrytype']       =  $array['Industrytype'];     
        $array['table_name'] = "ssc_industrytype";
        $array['field_name'] = "IndustrytypeID";
        $sql = "call usp_A_CheckDuplicate('".$array['table_name']."','Industrytype','".$array['Industrytype']."','IndustrytypeID','".$array['id']."')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
	public function getByID($ID = null) {
        $query = $this->db->query("call usp_A_GetIndustrytypeByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}