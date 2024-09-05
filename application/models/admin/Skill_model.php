<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Skill_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
	   $Skill=getStringClean(($this->input->post('SkillName')!='')?$this->input->post('SkillName'):'');
        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetSkill( '$per_page_record' , '$page_number','$Skill','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_Skill','SkillID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        $array['SkillName']   =   (isset($array['SkillName']))?$array['SkillName']:NULL;             
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddSkill('".$array['SkillName']."','".$array['created_by']."','".$array['Status']."','".$array['usertype']."','".$array['IPAddress']."')";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($array)
    {
        $array['SkillName']   =   (isset($array['SkillName']))?$array['SkillName']:NULL;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $query = $this->db->query("call usp_A_EditSkill('".$array['SkillName']."','".$array['modified_by']."','".$array['Status']."','".$array['ID']."','".$array['usertype']."','".$array['IPAddress']."')");
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ssc_skill";
        $array['field_name'] = "SkillID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }
	public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];                
        $array['SkillName']       =  $array['SkillName'];     
        $array['table_name'] = "ssc_skill";
        $array['field_name'] = "SkillID";
        $sql = "call usp_A_CheckDuplicate('".$array['table_name']."','SkillName','".$array['SkillName']."','SkillID','".$array['id']."')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
	public function getSkillByID($ID = null) {
        $query = $this->db->query("call usp_A_GetSkillByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}