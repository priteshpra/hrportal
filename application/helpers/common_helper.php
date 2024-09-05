<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('getUserType')) {

    function getUserType() {
        $user_type['types'] = array('Admin' => '1', 'Vendor' => '2', 'Customer' => '3', 'Subscribe' => '4');
        return $user_type;
    }

}
/**
 * Purpose : drop-down box of Country
 * Parameters :
 *      @Selected = (optional) pass this parameter if any country needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getCountryCombobox')) {

    function getCountryCombobox($Selected = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getCountryCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/country_combo_box_only', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of Company
 * Parameters :
 *      @Selected = (optional) pass this parameter if any country needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('getCompanyCombobox')) {

    function getCompanyCombobox($Selected = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getCompanyCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/company_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of Department
 * Parameters :
 *      @Selected = (optional) pass this parameter if any country needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('getDepartmentCombobox')) {

    function getDepartmentCombobox($Selected = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getDepartmentCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/department_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of Designation
 * Parameters :
 *      @Selected = (optional) pass this parameter if any country needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('getDesignationCombobox')) {

    function getDesignationCombobox($Selected = 0,$MultiSelect = 0,$Company = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getDesignationCombobox();
        $data['Selected'] = $Selected;
        $data['MultiSelect'] = $MultiSelect;
        if($Company == 1){
            return $CI->load->view('common_view_files/company/designation_combo_box', $data, TRUE);
        }
        return $CI->load->view('common_view_files/designation_combo_box', $data, TRUE);

    }

}
/**
 * Purpose : drop-down box of IndustryType
 * Parameters :
 *      @Selected = (optional) pass this parameter if any country needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('getIndustrytypeCombobox')) {

    function getIndustrytypeCombobox($Selected = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getIndustrytypeCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/industrytype_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of State
 * Parameters :
 *      @Selected = (optional) pass this parameter if any country needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getStateCombobox')) {

    function getStateCombobox($Selected = 0,$CountryID = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->GetState($CountryID);
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/state_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of State
 * Parameters :
 *      @Selected = (optional) pass this parameter if any country needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getStateBasedCombobox')) {

    function getStateBasedCombobox($Selected = 0,$CountryID = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->GetState($CountryID);
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/state_based_city_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of State
 * Parameters :
 *      @Selected = (optional) pass this parameter if any country needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('GetCityBasedState')) {

    function GetCityBasedState($Selected = 0,$StateID = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->GetCityBasedState($StateID);
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/city_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of Pages
 * Parameters :
 *      @Selected = (optional) pass this parameter if any page needs to be pre-selected
 * Developer : Zalak
 */
if (!function_exists('getPageCombobox')) {

    function getPageCombobox($Selected = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getPageCombobox();
        $data['Selected'] = $Selected;
		return $CI->load->view('common_view_files/pagename_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of City
 * Parameters :
 *      @Selected = (optional) pass this parameter if any country needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getCityCombobox')) {

    function getCityCombobox($Selected = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->GetOnlyCity();
        $data['Selected'] = $Selected;
		return $CI->load->view('common_view_files/city_combo_box', $data, TRUE);
    }

}

if (!function_exists('getUser')) {

    function getUser($selected_admin_id = 0) {

        $CI = & get_instance();
        $CI->load->model('admin/rolemapping_model');
        $data = array();
        $data['admin'] = $CI->rolemapping_model->getUser();
        $data['selected_admin_id'] = $selected_admin_id;
        //pr($data);exit;
        return $CI->load->view('common_view_files/admin_combo_box', $data, TRUE);
    }

}

if (!function_exists('getAllRolesForCombobox')) {

    function getAllRolesForCombobox($selected_role_id = 0) {
        $CI = & get_instance();
        $CI->load->model('admin/role_model');
        $data = array();
        $data['all_roles'] = $CI->role_model->getRoleComboBox();
        $data['selected_role_id'] = $selected_role_id;

        return $CI->load->view('common_view_files/roles_combo_box', $data, TRUE);
    }

}

if (!function_exists('getCountryStateComboBox')) 
{
    function getCountryStateComboBox($selected = 0)
    {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getCountryStateComboBox();
        $data['selected'] = $selected;
        return $CI->load->view('common_view_files/country_combo_box', $data, TRUE);        
    }
}

if (!function_exists('getCountryStateComboBox')) 
{
    function getCountryStateComboBox($selected = 0)
    {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getCountryStateComboBox();
        $data['selected'] = $selected;
        return $CI->load->view('common_view_files/country_combo_box', $data, TRUE);        
    }
}
if (!function_exists('getParentEthnicity')) 
 {
    function getParentEthnicity($selected = 0)
    {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getParentEthnicity();
        $data['selected'] = $selected;
        return $CI->load->view('common_view_files/ethnicity_combo_box', $data, TRUE);        
    }
}   

/**
 * Purpose : drop-down box of Employeeinouttime
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Employeeinouttime needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('getEmployeeCombobox')) {

    function getEmployeeCombobox($Selected = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getEmployeeCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/employeeinouttime_combo_box', $data, TRUE);
    }

}

/**
 * Purpose : drop-down box of User
 * Parameters :
 *      @Selected = (optional) pass this parameter if any User needs to be pre-selected
 * Developer : Gopi
 */
/*if (!function_exists('getUserCombobox')) {

    function getUserCombobox($Selected = 0,$usertype= '') {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getUserCombobox($usertype);
        //pr($data['all_data']);exit;
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/user_combo_box', $data, TRUE);
    }

}*/
/**
 * Purpose : drop-down box of User
 * Parameters :
 *      @Selected = (optional) pass this parameter if any User needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('getUserCombobox')) {

    function getUserCombobox($Selected = 0,$UserType = "All",$Title = "Select User") {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getUserCombobox($UserType);
        $data['Selected'] = $Selected;
        $data['Title'] = $Title;
        return $CI->load->view('common_view_files/user_combo_box', $data, TRUE);
    }

}

/**
 * Purpose : drop-down box of Roles
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Roles needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('getRolesCombobox')) {

    function getRolesCombobox($Selected = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getRolesCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/roles_combo_box', $data, TRUE);
    }

}

/**
 * Purpose : drop-down box of language
 * Parameters :
 *      @Selected = (optional) pass this parameter if any language needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('getLanguageCombobox')) {

    function getLanguageCombobox($Selected = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getLanguageCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/language_combo_box', $data, TRUE);
    }

}

if (!function_exists('getQualificationCombobox')) {

    function getQualificationCombobox($Selected = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getQualificationCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/qualification_combo_box', $data, TRUE);
    }

}


/**
 * Purpose : drop-down box of Skill
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Skill(Array) needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getSkillCombobox')) {

    function getSkillCombobox($Selected = array()) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getSkillCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/skills_combo_box', $data, TRUE);
    }

}

/**
 * Purpose : drop-down box of Skill
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Skill(Array) needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getSkillComboboxSingle')) {

    function getSkillComboboxSingle($Selected = array()) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getSkillCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/skills_combo_box_single', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of Salary
 * Parameters :
 * Developer : Nilay
 */
if (!function_exists('GetSalary')) {

    function GetSalary() {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = unserialize(SALARY_FORM);
        return $CI->load->view('common_view_files/salary_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of Location(Cities)(multi selection)
 * Parameters :
 * Developer : Nilay
 */
if (!function_exists('GetLocation')) {

    function GetLocation($Flag = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->GetLocationCombobox($Flag);
        if($Flag == 1){
            return $CI->load->view('common_view_files/company/location_combo_box', $data, TRUE);
        }
        return $CI->load->view('common_view_files/location_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of Years
 * Parameters : Past no of year
 * Developer : Nilay
 */
if (!function_exists('GetYearList')) {

    function GetYearList($FromYear,$Selected = 0,$Label = "Year Of Passing") {
        $CI = & get_instance();
        $data = array();
        $data['FromYear'] = $FromYear;
        $data['Label'] = $Label;
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/year_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of Job Type
 * Parameters : 
 * Developer : Nilay
 */
if (!function_exists('GetJobTypeList')) {

    function GetJobTypeList($Selected = array()) {
        $CI = & get_instance();
        $data = array();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/jobtype_combo_box', $data, TRUE);
    }

}
if (!function_exists('GetProfileStatus')) {

    function GetProfileStatus($Selected = array()) {
        $CI = & get_instance();
        $data = array();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/profilestatus_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of Ethnicity
 * Parameters : 
 * Developer : Nilay
 */
if (!function_exists('GetEthnicityCombo')) {

    function GetEthnicityCombo($Selected = 0) {
        $CI = & get_instance();
        $data = array();
        $data['Selected'] = $Selected;
        $data['all_data'] = $CI->common_model->GetEthnicityCombobox();
        return $CI->load->view('common_view_files/ethnicity_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of Job Type
 * Parameters : 
 * Developer : Nilay
 */
if (!function_exists('GetVisaStatusList')) {

    function GetVisaStatusList($Selected = '') {
        $CI = & get_instance();
        $data = array();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/visastatus_combo_box', $data, TRUE);
    }

}

if (!function_exists('getGradeCombobox')) {

    function getGradeCombobox($Selected = '') {
        $CI = & get_instance();
        $data = array();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/grade_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of JobPost
 * Parameters : 
 * Developer : Nilay
 */
if (!function_exists('getJobPostCombobox')) {

    function getJobPostCombobox($Selected = 0,$CompanyID = 0) {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getJobPostCombobox($CompanyID);
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/jobpost_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of Salary
 * Parameters :
 * Developer : Nilay
 */
if (!function_exists('GetReason')) {

    function GetReason() {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = unserialize(REJECT_REASON_ARRAY);
        return $CI->load->view('common_view_files/reason_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of Salary
 * Parameters :
 * Developer : Nilay
 */
if (!function_exists('GetNatureOfEmployment')) {

    function GetNatureOfEmployment($Selected = "") {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = unserialize(NATUREOFEMPLOYMENT_ARRAY);
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/natureofemployement_combo_box', $data, TRUE);
    }

}
/**
 * Purpose : drop-down box of Salary
 * Parameters :
 * Developer : Nilay
 */
if (!function_exists('GetDesiredCandidateProfile')) {

    function GetDesiredCandidateProfile($Selected = "") {
        $CI = & get_instance();
        $data = array();
        $data['all_data'] = unserialize(DESIREDCANDIDATEPROFILE_ARRAY);
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/desiredcandidateprofile_combo_box', $data, TRUE);
    }

}