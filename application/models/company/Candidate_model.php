<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Candidate_model extends CI_Model 
{
    function __construct(){
        parent::__construct();
    }

    public function listData($PageSize = 10, $CurrentPage = 1)
    {
        $array = array();
        $array['PageSize'] = $PageSize;
        $array['CurrentPage'] = $CurrentPage;
        $array['UserID'] = $this->session->userdata['UserID'];
        $array['Path'] = site_url();
        $array['Skills'] = ($this->input->post('Skills') != "")?$this->input->post('Skills'):'';
        $array['Type'] = ($this->input->post('Type') != "")?$this->input->post('Type'):'All';
        $array['InterviewType'] = ($this->input->post('InterviewType') != "")?$this->input->post('InterviewType'):'';
        $array['JobPostID'] = ($this->input->post('JobPostID') != "")?$this->input->post('JobPostID'):-1;
        $Salary = ($this->input->post('Salary')!="")?$this->input->post('Salary'):"-1~-1";
        $Ex_Salary = explode('~', $Salary);
        $array['StartSalary'] = isset($Ex_Salary[0])?$Ex_Salary[0]: -1;
        $array['EndSalary'] = isset($Ex_Salary[1])?$Ex_Salary[1]: -1;
        $array['Designation'] = ($this->input->post('DesignationID') != "")?implode(',',$this->input->post('DesignationID')):'';
        $array['SortBy'] = ($this->input->post('SortBy') != "")?$this->input->post('SortBy'):'Name';
        $array['SortByOrder'] = ($this->input->post('SortByOrder') != "")?$this->input->post('SortByOrder'):'ASC';

        if($array['Type'] == "DirectInvited"){
            $sql = "call usp_M_GetCandidateListByCompanyInvited( '".
                $array['PageSize'] . "','" .
                $array['CurrentPage'] . "','" .
                $array['UserID'] . "','" .
                $array['Path'] . "','" .
                $array['Skills'] . "','" .
                $array['InterviewType'] . "','" .
                $array['StartSalary'] . "','" .
                $array['EndSalary'] . "','" .
                $array['Designation'] . "','" .
                $array['SortBy'] . "','" .
                $array['SortByOrder'] . "')";
        }else{

            $sql = "call usp_M_GetCandidateList( '".
                $array['PageSize'] . "','" .
                $array['CurrentPage'] . "','" .
                $array['UserID'] . "','" .
                $array['Path'] . "','" .
                $array['Skills'] . "','" .
                $array['Type'] . "','" .
                $array['JobPostID'] . "','" .
                $array['StartSalary'] . "','" .
                $array['EndSalary'] . "','" .
                $array['Designation'] . "','" .
                $array['SortBy'] . "','" .
                $array['SortByOrder'] . "')";
        }

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    public function getCandidateByID($ID = null) {
        $query = $this->db->query("call usp_A_GetCandidateByID('$ID')");
        $query->next_result();
        return $query->row();
    }
    public function listSkill($per_page_record = 10, $page_number = 1){
        $UserID = $this->input->post('UserID');
        $sql = "call usp_A_GetUserSkillByUserID('$per_page_record','$page_number','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listEmployment($per_page_record = 10, $page_number = 1){
        $UserID = $this->input->post('UserID');
        
        $sql = "call usp_A_GetUserEmployementByUserID('$per_page_record','$page_number','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listProject($per_page_record = 10, $page_number = 1){
        $UserID = $this->input->post('UserID');
        
        $sql = "call usp_A_GetUserProjectByUserID('$per_page_record','$page_number','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listCertificate($per_page_record = 10, $page_number = 1){
        $UserID = $this->input->post('UserID');
        $sql = "call usp_A_GetUserCertificateByUserID('$per_page_record','$page_number','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listLanguage($per_page_record = 10, $page_number = 1){
        $UserID = $this->input->post('UserID');
        $sql = "call usp_A_GetUserLanguageByUserID('$per_page_record','$page_number','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listQualification($per_page_record = 10, $page_number = 1){
        $UserID = $this->input->post('UserID');
        
        $sql = "call usp_A_GetUserQualificationByUserID('$per_page_record','$page_number','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

}