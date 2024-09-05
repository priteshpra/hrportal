<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jobpost_model extends CI_Model {
	function __construct() 
    {
        parent::__construct();
    }

    public function getCompanyByID($ID = null) {
        $query = $this->db->query("call usp_A_GetCompanyByID('$ID')");
        $query->next_result();
        return $query->row();
    }

    function listCompanyByJobs($data) 
    { 
        $ID = ($this->session->userdata['UserID'] != '')?$this->session->userdata['UserID']:-1;
        $DesignationID=($this->input->post('DesignationID') != '')?$this->input->post('DesignationID'):'';
        $StartSalary=($this->input->post('StartSalary') != '')?$this->input->post('StartSalary'):-1;
        $EndSalary=($this->input->post('EndSalary') != '')?$this->input->post('EndSalary'):-1;
        $JobStatus=($this->input->post('JobStatus') != '')?$this->input->post('JobStatus'):'All';
        $sql = "call usp_M_GetJobByCompany('". 
            $data['per_page_record'] . "','". 
            $data['page_number'] . "','". 
            $ID ."','".
            base_url() ."','".
            $DesignationID ."','".
            $StartSalary ."','".
            $EndSalary ."','".
            $JobStatus .
            "')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function insert($array)
    {    
        //print_r($array);
        $array['JobTitle']   =  getStringClean((isset($array['JobTitle']))?$array['JobTitle']:NULL); 
        $array['CompanyID']   = ($this->session->userdata['CompanyID'] != '')?$this->session->userdata['CompanyID']:0;
        $array['UserID']   =  getStringClean((isset($array['UserID']))?$array['UserID']:0);
        $array['IndustryTypeID']   =  getStringClean((isset($array['IndustryTypeID']))?$array['IndustryTypeID']:0);
        $array['CityID']   =  getStringClean((isset($array['CityID']))?$array['CityID']:0);
        $array['DesignationID']   =  getStringClean((isset($array['DesignationID']))?$array['DesignationID']:0); 
        

        $array['MinExperienceYear']   =  getStringClean((isset($array['MinExperienceYear']))?$array['MinExperienceYear']:0); 
        $array['MaxExperienceYear']   =  getStringClean((isset($array['MaxExperienceYear']))?$array['MaxExperienceYear']:0); 
        $array['MinExperienceMonth']   =  getStringClean((isset($array['MinExperienceMonth']))?$array['MinExperienceMonth']:0); 
        $array['MaxExperienceMonth']   =  getStringClean((isset($array['MaxExperienceMonth']))?$array['MaxExperienceMonth']:0); 

        $array['MinExperience']   =  (($array['MinExperienceYear']*12)+$array['MinExperienceMonth']); 
        $array['MaxExperience']   =  (($array['MaxExperienceYear']*12)+$array['MaxExperienceMonth']); 

        $array['MinSalary']   =  getStringClean((isset($array['MinSalary']))?$array['MinSalary']:0); 
        $array['MaxSalary']   =  getStringClean((isset($array['MaxSalary']))?$array['MaxSalary']:0);
        $array['NoOfVacancies']   =  getStringClean((isset($array['NoOfVacancies']))?$array['NoOfVacancies']:0);
        $array['NatureOfEmployment']   =  getStringClean((isset($array['NatureOfEmployment']))?$array['NatureOfEmployment']:NULL); 
        $array['DetailsOfProject']   =  getStringClean((isset($array['DetailsOfProject']))?$array['DetailsOfProject']:NULL);     
        $array['DesiredCandidateProfile']   =  getStringClean((isset($array['DesiredCandidateProfile']))?$array['DesiredCandidateProfile']:NULL);             
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        
        
        $sql = "call usp_A_AddJobpost('".
            $array['CompanyID']."','".
            "-1" . "','".
            $array['JobTitle']."','".
            $array['IndustryTypeID']."','".
            $array['DesignationID']."','".
            $array['DetailsOfProject']."','".
            $array['NatureOfEmployment']."','".
            $array['MinExperience']."','".
            $array['MaxExperience']."','".
            $array['MinSalary']."','".
            $array['MaxSalary']."','".
            $array['NoOfVacancies']."','".
            $array['created_by']."','".
            $array['Status']."','".
            $array['usertype']."','".
            $array['IPAddress']."','".
            $array['CityID']."','".
            $array['DesiredCandidateProfile']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row(); 
    }

    public function update($array)
    {
        //print_r($array);die();
        $array['JobTitle']   =  getStringClean((isset($array['JobTitle']))?$array['JobTitle']:NULL); 
        $array['UserID']   = ($this->session->userdata['CompanyID'] != '')?$this->session->userdata['CompanyID']:0;
        $array['IndustryTypeID']   =  getStringClean((isset($array['IndustryTypeID']))?$array['IndustryTypeID']:0);             
        $array['DesignationID']   =  getStringClean((isset($array['DesignationID']))?$array['DesignationID']:0); 
        $array['CityID']   =  getStringClean((isset($array['CityID']))?$array['CityID']:0);
        
        $array['MinExperienceYear']   =  getStringClean((isset($array['MinExperienceYear']))?$array['MinExperienceYear']:0); 
        $array['MaxExperienceYear']   =  getStringClean((isset($array['MaxExperienceYear']))?$array['MaxExperienceYear']:0); 
        $array['MinExperienceMonth']   =  getStringClean((isset($array['MinExperienceMonth']))?$array['MinExperienceMonth']:0); 
        $array['MaxExperienceMonth']   =  getStringClean((isset($array['MaxExperienceMonth']))?$array['MaxExperienceMonth']:0); 

        $array['MinExperience']   =  (($array['MinExperienceYear']*12)+$array['MinExperienceMonth']); 
        $array['MaxExperience']   =  (($array['MaxExperienceYear']*12)+$array['MaxExperienceMonth']); 

        $array['MinSalary']   =  getStringClean((isset($array['MinSalary']))?$array['MinSalary']:0); 
        $array['MaxSalary']   =  getStringClean((isset($array['MaxSalary']))?$array['MaxSalary']:0);
        $array['NoOfVacancies']   =  getStringClean((isset($array['NoOfVacancies']))?$array['NoOfVacancies']:0);
        $array['NatureOfEmployment']   =  getStringClean((isset($array['NatureOfEmployment']))?$array['NatureOfEmployment']:NULL); 
        $array['DetailsOfProject']   =  getStringClean((isset($array['DetailsOfProject']))?$array['DetailsOfProject']:NULL);   
        $array['DesiredCandidateProfile']   =  getStringClean((isset($array['DesiredCandidateProfile']))?$array['DesiredCandidateProfile']:NULL);          
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
        $array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        
        $sql = "call usp_A_EditJobpost('" .
                $array['UserID']."','".
                $array['JobTitle']."','".
                $array['IndustryTypeID']."','".
                $array['DesignationID']."','".
                $array['DetailsOfProject']."','".
                $array['NatureOfEmployment']."','".
                $array['MinExperience']."','".
                $array['MaxExperience']."','".
                $array['MinSalary']."','".
                $array['MaxSalary']."','".
                $array['NoOfVacancies']."','".
                $array['modified_by']."','".
                $array['Status']."','".
                $array['ID']."','".
                $array['usertype']."','".
                $array['IPAddress']."','".
                $array['CityID']."','".
                $array['DesiredCandidateProfile']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getByID($ID = null) {
        $query = $this->db->query("call usp_A_GetJobpostByID('$ID')");
        $query->next_result();
        return $query->row();
    }

    public function addSkill($SkillArray,$JobPostID){
        $UserID = $this->session->userdata['UserID'];
        foreach ($SkillArray as $value) {
            $sql = "call usp_M_AddSkillForJob('".
                          $JobPostID ."','','" .  
                          $value ."','" .  
                          $UserID ."');";
            $query = $this->db->query($sql);
            $query->next_result();
        }
        return 1;
    }

    public function DeleteSkills($ID){
        $Table_Name = "ssc_jobskill";
        $FieldName = "JobPostID";
        $sql = "call usp_M_DeleteField('".
                    $Table_Name ."','" .  
                    $FieldName ."','" .  
                    $ID . "'".
                    ");";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();   
    }

    public function checkDuplicateDouble($array)
    {
        $array['id']    =   $array['id'];     
        $array['UserID'] = $this->session->userdata['CompanyID']; 
        $array['JobTitle'] = $array['JobTitle'];     
        $array['table_name'] = "ssc_jobpost";
        $array['field_name'] = "JobPostID";
        $sql = "call usp_A_CheckDuplicateDouble('".$array['table_name']."','JobTitle','".$array['JobTitle']."','UserID','".$array['UserID']."','JobPostID','".$array['id']."')"; 
        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
}
