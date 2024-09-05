<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model 
{
    function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function insertAdminError($error_array)
    {
        $error_array['error_message'] = getStringClean((isset($error_array['error_message']))?$error_array['error_message']:NULL);
        $error_array['method_name'] = getStringClean((isset($error_array['method_name']))?$error_array['method_name']:NULL);
        $error_array['Type'] = getStringClean((isset($error_array['Type']))?$error_array['Type']:NULL);
		$error_array['User_Agent'] = getStringClean((isset($error_array['User_Agent']))?$error_array['User_Agent']:NULL);

        $error_array['created_by'] = $this->session->userdata['UserID']; 
        
        $error_array['error_message'] = ($error_array['error_message']) ? $error_array['error_message'] : 'Unknown';

		$query = $this->db->query("SELECT Fn_A_AddErrorlog('".
                $error_array['method_name']."','".
                $error_array['error_message']."','".
                $error_array['Type'] ."','" . 
                $error_array['User_Agent'] ."','" .
                GetIP() ."','" .
                $error_array['created_by'].
                "')");
		$query->next_result();
        $query->result();
    }
    function getCountryCombobox(){
        $query = $this->db->query("call usp_A_GetCountry_ComboBox()");
        $query->next_result();
        return $query->result();
    }  
    function getEmployeeCombobox(){
        $query = $this->db->query("call usp_A_GetEmployeedetails_ComboBox()");
        $query->next_result();
        return $query->result();
    }  
    function getLanguageCombobox(){
        $query = $this->db->query("call usp_A_Language_ComboBox()");
        $query->next_result();
        return $query->result();
    } 
    function getQualificationCombobox(){
        $query = $this->db->query("call usp_A_Qualification_ComboBox()");
        $query->next_result();
        return $query->result();
    }  
    function getRolesCombobox(){
        $query = $this->db->query("call usp_A_Roles_ComboBox()");
        $query->next_result();
        return $query->result();
    }  
    /* function getUserCombobox($usertype = ""){
        $query = $this->db->query("call usp_A_GetUser_ComboBox('$usertype')");
        $query->next_result();
        return $query->result();
    }  */
    function getUserCombobox($usertype){
        $query = $this->db->query("call usp_A_GetUser_ComboBox('$usertype')");
        $query->next_result();
        return $query->result();
    }
    function GetState($CountryID = 0){
        $query = $this->db->query("call usp_A_GetState_ComboBox('$CountryID')");
        $query->next_result();
        return $query->result();
    }  
    function getPageCombobox($StateID = 0){
        $query = $this->db->query("call usp_A_pagename_ComboBox()");
		$query->next_result();
        return $query->result();
    }
	function GetOnlyCity(){
        $query = $this->db->query("call usp_A_GetCity_ComboBox()");
		$query->next_result();
        return $query->result();
    }
    function getCompanyCombobox(){
        $query = $this->db->query("call usp_A_GetCompany_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function getDepartmentCombobox(){
        $query = $this->db->query("call usp_A_GetDepartment_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function getIndustrytypeCombobox(){
        $query = $this->db->query("call usp_A_GetIndustrytype_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function getDesignationCombobox(){
        $query = $this->db->query("call usp_A_GetDesignation_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function GetCityBasedState($StateID = 0){
        $query = $this->db->query("call usp_A_GetCityBasedState_ComboBox('$StateID')");
        $query->next_result();
        return $query->result();
    }
    function GetLocationCombobox($Flag = 0,$CountryID = 230){
        $query = $this->db->query("call usp_M_GetLocation('$CountryID')");
        $query->next_result();
        $_result =  $query->result();   
        if($Flag == 1){
            if(isset($_result) && !empty($_result) && !isset($_result['0']->Message)){
                $list = array();
                foreach ($_result as $k => $val) {
                        if(!empty($val)){
                            $cities = array();
                            $cities = array('CityID' => $val->CityID,'CityName' => $val->CityName);
                            unset($_result[$k]->CityID);
                            unset($_result[$k]->CityName);

                            $list[$_result[$k]->StateID] = isset($list[$_result[$k]->StateID]) ? $list[$_result[$k]->StateID] : $_result[$k];
                            $list[$_result[$k]->StateID]->cities[] = $cities;
                        }
                    }
                return $list;
            }
        }
        return $_result;
    }
    function GetEthnicityCombobox(){
        $query = $this->db->query("call usp_A_GetEthnicity_combobox()");
        $query->next_result();
        return $query->result();   
    }
    public function CheckDuplicate($data){
        $data['data_value'] = getStringClean($data['data_value']);
        $sql = "call usp_A_CheckDuplicate ('". 
                $data['table_name'] ."','". 
                $data['field_name'] . "','".
                $data['data_value']."','".
                $data['ufield']."','". 
                $data['ID']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();   
    }
    public function CheckDuplicateDouble($data){
        $sql = "call usp_A_CheckDuplicateDouble ('". 
                $data['table_name'] ."','". 
                $data['field_name'] . "','".
                $data['data_value']."','".
                $data['field_name1'] . "','".
                $data['data_value1']."','".
                $data['ufield']."','". 
                $data['ID']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();   
    }
    public function changeStatus($data) {
        $array['id'] = getStringClean((isset($data['id'])) ? $data['id'] : NULL);
        $array['status'] = getStringClean((isset($data['status'])) ? $data['status'] : NULL);

        $array['table_name'] = $data['table_name'];
        $array['field_name'] = $data['field_name'];
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }  
    function getCountryStateComboBox(){
        $query = $this->db->query("call usp_A_GetCountry_ComboBox()");
        $query->next_result();
        return $query->result();
    }

    public function getParentEthnicity() {
        $query = $this->db->query("call usp_A_GetParentEthnicity()");
        //pr($query);exit();
        $query->next_result();
        //pr($query->result());exit();
        return $query->result();

    }

    function getSkillCombobox(){
        $query = $this->db->query("call usp_A_GetSkill_ComboBox()");
        $query->next_result();
        return $query->result();   
    }
    function getJobPostCombobox($CompanyID){
        $query = $this->db->query("call usp_C_GetJobPost_Combobox('" . $CompanyID . "');");
        $query->next_result();
        return $query->result();
    }
}