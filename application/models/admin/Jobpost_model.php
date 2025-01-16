<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jobpost_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1)
    {
        $Skills = getStringClean(($this->input->post('Skills') != '') ? implode(',', $this->input->post('Skills')) : '');
        $Salary = $this->input->post('Salary');
        $Type = ($this->input->post('Type') != '') ? $this->input->post('Type') : 'All';
        $StartSalary = -1;
        $EndSalary = -1;
        if ($Salary != "") {
            $Ex_Salary = explode('~', $Salary);
            $StartSalary = isset($Ex_Salary[0]) ? $Ex_Salary[0] : -1;
            $EndSalary = isset($Ex_Salary[1]) ? $Ex_Salary[1] : -1;
        }
        $SortBy = ($this->input->post('SortBy') != '') ? $this->input->post('SortBy') : 'Name';
        $SortByOrder = ($this->input->post('SortByOrder') != '') ? $this->input->post('SortByOrder') : 'ASC';
        $Location = ($this->input->post('Location') != '') ? implode(',', $this->input->post('Location')) : '';
        $DesignationID = ($this->input->post('DesignationID') != '') ? implode(',', $this->input->post('DesignationID')) : '';
        $MaxExperience = $MinExperience = $UserID = -1;

        $sql = "call usp_M_GetJob( '" .
            $per_page_record . "' , '" .
            $page_number . "' , '" .
            $DesignationID . "' , '" .
            $StartSalary . "' , '" .
            $EndSalary . "' , '" .
            $MinExperience . "' , '" .
            $MaxExperience . "' , '" .
            site_url() . "' , '" .
            $UserID . "' , '" .
            $Type . "' , '" .
            $SortBy . "' , '" .
            $SortByOrder . "' , '" .
            $Location . "' , '" .
            $Skills . "' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    function CandidateList($ID, $per_page_record = 10, $page_number = 1, $JobPostType = 'View')
    {

        $salary = explode('~', $this->input->post('salary'));
        $id = ($this->input->post('UserID') != '') ? $this->input->post('UserID') : -1;
        $path = site_url();
        $skill = getStringClean(($this->input->post('Skills') != '') ? $this->input->post('Skills') : '');
        $jobstatus = getStringClean(($this->input->post('JobStatus') != '') ? $this->input->post('JobStatus') : '');
        $jobpostid = getStringClean(($this->input->post('ID') != '') ? $this->input->post('ID') : '');
        $startsalary = getStringClean((@$salary[0] != '') ? @$salary[0] : -1);
        $endsalary = getStringClean((@$salary[1] != '') ? @$salary[1] : -1);
        $designation = getStringClean(($this->input->post('DesignationID') != '') ? $this->input->post('DesignationID')[0] : '');
        $sortby = getStringClean(($this->input->post('sortby') != '') ? $this->input->post('sortby') : 'Salary');
        $sortbyorder = getStringClean(($this->input->post('sortbyorder') != '') ? $this->input->post('sortbyorder') : 'ASC');
        // print_r($designation);
        // die;
        $sql = "call usp_A_GetCandidateList('$per_page_record','$page_number','$id','$path','$skill','$jobstatus','$jobpostid','$startsalary','$endsalary','$designation','$sortby','$sortbyorder')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    /* function listCandidateApplied($ID,$per_page_record = 10, $page_number = 1) 
    {   //print_r($this->input->post());die();
        $Path = site_url();
        $ID=($this->input->post('ID') != '')?$this->input->post('ID'):-1;
        $Path=site_url();
        $FirstName = getStringClean(($this->input->post('FirstName')!='')?$this->input->post('FirstName'):'');
        $sql = "call usp_M_GetCandidateListByApplyJob('$per_page_record','$page_number','$ID','$Path','$FirstName')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }*/
    public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_jobpost','JobPostID')");
        $query->next_result();
        return $query->result();
    }

    public function insert($array)
    {
        //print_r($array);
        $array['JobTitle']   =  getStringClean((isset($array['JobTitle'])) ? $array['JobTitle'] : NULL);
        $array['UserID']   =  getStringClean((isset($array['CompanyID'])) ? $array['CompanyID'] : 0);
        $array['CompanyID']   =  getStringClean((isset($array['CompanyID'])) ? $array['CompanyID'] : 0);
        $array['IndustryTypeID']   =  getStringClean((isset($array['IndustryTypeID'])) ? $array['IndustryTypeID'] : 0);
        $array['CityID']   =  getStringClean((isset($array['CityID'])) ? $array['CityID'] : 0);
        $array['DesignationID']   =  getStringClean((isset($array['DesignationID'])) ? $array['DesignationID'] : 0);


        $array['MinExperienceYear']   =  getStringClean((isset($array['MinExperienceYear'])) ? $array['MinExperienceYear'] : 0);
        $array['MaxExperienceYear']   =  getStringClean((isset($array['MaxExperienceYear'])) ? $array['MaxExperienceYear'] : 0);
        $array['MinExperienceMonth']   =  getStringClean((isset($array['MinExperienceMonth'])) ? $array['MinExperienceMonth'] : 0);
        $array['MaxExperienceMonth']   =  getStringClean((isset($array['MaxExperienceMonth'])) ? $array['MaxExperienceMonth'] : 0);

        $array['MinExperience']   =  (($array['MinExperienceYear'] * 12) + $array['MinExperienceMonth']);
        $array['MaxExperience']   =  (($array['MaxExperienceYear'] * 12) + $array['MaxExperienceMonth']);

        $array['MinSalary']   =  getStringClean((isset($array['MinSalary'])) ? $array['MinSalary'] : 0);
        $array['MaxSalary']   =  getStringClean((isset($array['MaxSalary'])) ? $array['MaxSalary'] : 0);
        $array['NoOfVacancies']   =  getStringClean((isset($array['NoOfVacancies'])) ? $array['NoOfVacancies'] : 0);
        $array['NatureOfEmployment']   =  getStringClean((isset($array['NatureOfEmployment'])) ? $array['NatureOfEmployment'] : NULL);
        $array['DetailsOfProject']   =  getStringClean((isset($array['DetailsOfProject'])) ? $array['DetailsOfProject'] : NULL);
        $array['DesiredCandidateProfile']   =  getStringClean((isset($array['DesiredCandidateProfile'])) ? $array['DesiredCandidateProfile'] : NULL);
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();


        $sql = "call usp_A_AddJobpost('" .
            $array['UserID'] . "','" .
            "-1" . "','" .
            $array['JobTitle'] . "','" .
            $array['IndustryTypeID'] . "','" .
            $array['DesignationID'] . "','" .
            $array['DetailsOfProject'] . "','" .
            $array['NatureOfEmployment'] . "','" .
            $array['MinExperience'] . "','" .
            $array['MaxExperience'] . "','" .
            $array['MinSalary'] . "','" .
            $array['MaxSalary'] . "','" .
            $array['NoOfVacancies'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "','" .
            $array['CityID'] . "','" .
            $array['DesiredCandidateProfile'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function update($array)
    {
        //print_r($array);die();
        $array['JobTitle']   =  getStringClean((isset($array['JobTitle'])) ? $array['JobTitle'] : NULL);
        $array['UserID']   =  getStringClean((isset($array['CompanyID'])) ? $array['CompanyID'] : 0);
        $array['IndustryTypeID']   =  getStringClean((isset($array['IndustryTypeID'])) ? $array['IndustryTypeID'] : 0);
        $array['DesignationID']   =  getStringClean((isset($array['DesignationID'])) ? $array['DesignationID'] : 0);
        $array['CityID']   =  getStringClean((isset($array['CityID'])) ? $array['CityID'] : 0);

        $array['MinExperienceYear']   =  getStringClean((isset($array['MinExperienceYear'])) ? $array['MinExperienceYear'] : 0);
        $array['MaxExperienceYear']   =  getStringClean((isset($array['MaxExperienceYear'])) ? $array['MaxExperienceYear'] : 0);
        $array['MinExperienceMonth']   =  getStringClean((isset($array['MinExperienceMonth'])) ? $array['MinExperienceMonth'] : 0);
        $array['MaxExperienceMonth']   =  getStringClean((isset($array['MaxExperienceMonth'])) ? $array['MaxExperienceMonth'] : 0);

        $array['MinExperience']   =  (($array['MinExperienceYear'] * 12) + $array['MinExperienceMonth']);
        $array['MaxExperience']   =  (($array['MaxExperienceYear'] * 12) + $array['MaxExperienceMonth']);

        $array['MinSalary']   =  getStringClean((isset($array['MinSalary'])) ? $array['MinSalary'] : 0);
        $array['MaxSalary']   =  getStringClean((isset($array['MaxSalary'])) ? $array['MaxSalary'] : 0);
        $array['NoOfVacancies']   =  getStringClean((isset($array['NoOfVacancies'])) ? $array['NoOfVacancies'] : 0);
        $array['NatureOfEmployment']   =  getStringClean((isset($array['NatureOfEmployment'])) ? $array['NatureOfEmployment'] : NULL);
        $array['DetailsOfProject']   =  getStringClean((isset($array['DetailsOfProject'])) ? $array['DetailsOfProject'] : NULL);
        $array['DesiredCandidateProfile']   =  getStringClean((isset($array['DesiredCandidateProfile'])) ? $array['DesiredCandidateProfile'] : NULL);
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ID']   =   (isset($array['ID'])) ? $array['ID'] : NULL;
        $array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_EditJobpost('" .
            $array['UserID'] . "','" .
            $array['JobTitle'] . "','" .
            $array['IndustryTypeID'] . "','" .
            $array['DesignationID'] . "','" .
            $array['DetailsOfProject'] . "','" .
            $array['NatureOfEmployment'] . "','" .
            $array['MinExperience'] . "','" .
            $array['MaxExperience'] . "','" .
            $array['MinSalary'] . "','" .
            $array['MaxSalary'] . "','" .
            $array['NoOfVacancies'] . "','" .
            $array['modified_by'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "','" .
            $array['CityID'] . "','" .
            $array['DesiredCandidateProfile'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id'])) ? $array['id'] : 0;
        $array['status']        =   (isset($array['status'])) ? $array['status'] : 0;

        $array['table_name'] = "ssc_jobpost";
        $array['field_name'] = "JobPostID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }

    public function checkDuplicateJob($array)
    {
        $array['id']    =   $array['id'];
        $array['UserID']    =   $array['UserID'];
        $array['JobTitle']       =  $array['JobTitle'];
        // $array['table_name'] = "ssc_jobpost";
        // $array['field_name'] = "JobPostID";
        $sql = "SELECT COUNT(JobPostID) as Count FROM ssc_jobpost WHERE JobTitle = '" . $array['JobTitle'] . "' AND JobPostID != '" . $array['id'] . "'  AND UserID = '" . $array['UserID'] . "' AND (JobStatus='New' OR JobStatus='Open' OR JobStatus='InActive')";
        $query = $this->db->query($sql);
        //$query->next_result();

        return $query->row();
    }

    public function checkDuplicate($array)
    {
        $array['id'] = $array['id'];
        $array['JobTitle']       =  $array['JobTitle'];
        $array['table_name'] = "ssc_jobpost";
        $array['field_name'] = "JobPostID";
        $sql = "call usp_A_CheckDuplicate('" . $array['table_name'] . "','JobTitle','" . $array['JobTitle'] . "','JobPostID','" . $array['id'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();

        return $query->row();
    }

    public function getByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetJobpostByID('$ID')");
        $query->next_result();
        return $query->row();
    }
    public function addSkill($SkillArray, $JobPostID)
    {
        $UserID = $this->session->userdata['UserID'];
        foreach ($SkillArray as $value) {
            $sql = "call usp_M_AddSkillForJob('" .
                $JobPostID . "','','" .
                $value . "','" .
                $UserID . "');";
            $query = $this->db->query($sql);
            $query->next_result();
        }
        return 1;
    }
    public function DeleteSkills($ID)
    {
        $Table_Name = "ssc_jobskill";
        $FieldName = "JobPostID";
        $sql = "call usp_M_DeleteField('" .
            $Table_Name . "','" .
            $FieldName . "','" .
            $ID . "'" .
            ");";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function checkDuplicateDouble($array)
    {
        $array['id']    =   $array['id'];
        $array['UserID'] = $array['UserID'];
        $array['JobTitle'] = $array['JobTitle'];
        $array['table_name'] = "ssc_jobpost";
        $array['field_name'] = "JobPostID";
        $sql = "call usp_A_CheckDuplicateDouble('" . $array['table_name'] . "','JobTitle','" . $array['JobTitle'] . "','UserID','" . $array['UserID'] . "','JobPostID','" . $array['id'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
}
