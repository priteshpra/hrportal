<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1)
    {
        $company = getStringClean(($this->input->post('CompanyName') != '') ? $this->input->post('CompanyName') : '');
        $designation = ($this->input->post('DesignationID') != '') ? $this->input->post('DesignationID') : -1;
        $phoneno = ($this->input->post('MobileNo') != '') ? $this->input->post('MobileNo') : '';
        $emailid = ($this->input->post('EmailID') != '') ? $this->input->post('EmailID') : '';
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;

        $sql = "call usp_A_GetCompany( '$per_page_record' , '$page_number','$company','$designation','$phoneno','$emailid','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    function changePassword()
    {
        $ID = $this->input->post("CompanyID");
        $password = fnEncrypt($this->input->post('new_password'), $this->config->item('sSecretKey'));
        $sql = "CALL usp_A_CompanyChangePassword('" . $password . "','" . $ID . "');";
        $query = $this->db->query($sql);
        return $query->row();
    }
    function listCompanyByAllJobs($UserID, $per_page_record = 10, $page_number = 1, $JobStatus = 'All')
    {
        // $Path=site_url();
        $DesignationID = ($this->input->post('DesignationID') != '') ? $this->input->post('DesignationID') : -1;
        $MinSalary = ($this->input->post('MinSalary') != '') ? $this->input->post('MinSalary') : -1;
        $MaxSalary = ($this->input->post('MaxSalary') != '') ? $this->input->post('MaxSalary') : -1;
        $JobStatus = ($this->input->post('JobStatus') != '') ? $this->input->post('JobStatus') : 'All';
        $all_job = ($this->input->post('all_job') != '') ? $this->input->post('all_job') : '';
        $sql = "call usp_A_GetJobByCompanyForSearch('$per_page_record','$page_number','$UserID','$DesignationID','$MinSalary','$MaxSalary','$JobStatus','$all_job')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function ListCandidateByCompanyInvited($data)
    {

        $Path = $this->config->base_url();
        $Salary = explode('~', $this->input->post('Salary'));
        $StartSalary = getStringClean((@$Salary[0] != '') ? @$Salary[0] : -1);
        $EndSalary = getStringClean((@$Salary[1] != '') ? @$Salary[1] : -1);
        $SkillSearch = ($this->input->post('Skills') != '') ? $this->input->post('Skills') : '';
        $DesignationIDS = ($this->input->post('DesignationIDS') != '') ? $this->input->post('DesignationIDS') : '';
        $SortBy = 'Name';
        $Type = ($this->input->post('InterviewType') != '') ? $this->input->post('InterviewType') : '';
        $SortByOrder = 'ASC';
        $sql = "CALL usp_M_GetCandidateListByCompanyInvited('" .
            $data['PageSize'] . "','" .
            $data['CurrentPage'] . "','" .
            $data['UserID'] . "','" .
            $Path . "','" .
            $SkillSearch . "','" .
            $Type . "','" .
            $StartSalary . "','" .
            $EndSalary . "','" .
            $DesignationIDS . "','" .
            $SortBy . "','" .
            $SortByOrder .
            "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function ListCandidate($data)
    {

        $UserID = $this->session->userdata('CompanyID');
        $Path = $this->config->base_url();
        $Salary = explode('~', $this->input->post('Salary'));
        $StartSalary = getStringClean((@$Salary[0] != '') ? @$Salary[0] : -1);
        $EndSalary = getStringClean((@$Salary[1] != '') ? @$Salary[1] : -1);
        $SkillSearch = ($this->input->post('Skills') != '') ? $this->input->post('Skills') : '';
        $DesignationIDS = ($this->input->post('DesignationIDS') != '') ? $this->input->post('DesignationIDS') : '';
        $JobPostID = -1;
        $SortBy = 'Name';
        $SortByOrder = 'ASC';
        $sql = "CALL usp_M_GetCandidateList('" .
            $data['PageSize'] . "','" .
            $data['CurrentPage'] . "','" .
            $data['UserID'] . "','" .
            $Path . "','" .
            $SkillSearch . "','" .
            $data['Type'] . "','" .
            $JobPostID . "','" .
            $StartSalary . "','" .
            $EndSalary . "','" .
            $DesignationIDS . "','" .
            $SortBy . "','" .
            $SortByOrder .
            "','')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function listCandidateList($ID, $per_page_record = 10, $page_number = 1, $JobPostType = 'View')
    {
        $Path = site_url();
        $UserID = ($this->input->post('UserID') != '') ? $this->input->post('UserID') : -1;
        $StartSalary = ($this->input->post('StartSalary') != '') ? $this->input->post('StartSalary') : -1;
        $EndSalary = ($this->input->post('EndSalary') != '') ? $this->input->post('EndSalary') : -1;
        $DesignationIDS = ($this->input->post('DesignationIDS') != '') ? $this->input->post('DesignationIDS') : '';
        $SortBy = ($this->input->post('SortBy') != '') ? $this->input->post('SortBy') : 'Name';
        $SortByOrder = ($this->input->post('SortByOrder') != '') ? $this->input->post('SortByOrder') : 'ASC';
        $SkillSearch = ($this->input->post('Skill') != '') ? $this->input->post('Skill') : '';
        $JobPostID = ($this->input->post('ID') != '') ? $this->input->post('ID') : -1;
        $JobPostType = ($this->input->post('JobPostType') != '') ? $this->input->post('JobPostType') : 'View';

        $sql = "call usp_A_GetCandidateList('$per_page_record','$page_number','$UserID','$Path','$SkillSearch','$JobPostType','$JobPostID','$StartSalary','$EndSalary','$DesignationIDS','$SortBy','$SortByOrder')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function listEmployee($per_page_record = 10, $page_number = 1, $CompanyID = null)
    {
        //print_r($this->input->post());die();
        $Searchtext = ($this->input->post('all_job') != '') ? $this->input->post('all_job') : '';
        $CompanyID = ($this->input->post('CompanyID') != '') ? $this->input->post('CompanyID') : -1;
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;

        $sql = "call usp_A_GetCompanyUser('$per_page_record','$page_number','$Searchtext','$CompanyID','$status_search_value','1')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_company','CompanyID')");
        $query->next_result();
        return $query->result();
    }
    public function insert($array)
    {
        //print_r($array);die();
        $array['CompanyName']   =  getStringClean((isset($array['CompanyName'])) ? $array['CompanyName'] : NULL);
        $array['StatusText']   =  getStringClean((isset($array['StatusText'])) ? $array['StatusText'] : NULL);
        $array['FirstName']   =  getStringClean((isset($array['FirstName'])) ? $array['FirstName'] : NULL);
        $array['LastName']   =  getStringClean((isset($array['LastName'])) ? $array['LastName'] : NULL);
        $array['Password']   =  fnEncrypt($this->input->post('password'), $this->config->item('sSecretKey'));
        $array['Address']   =  getStringClean((isset($array['Address'])) ? $array['Address'] : NULL);
        $array['Latitude']   =  getStringClean((isset($array['Latitude'])) ? $array['Latitude'] : NULL);
        $array['Longitude']   =  getStringClean((isset($array['Longitude'])) ? $array['Longitude'] : NULL);
        $array['EmailID']   =  getStringClean((isset($array['EmailID'])) ? $array['EmailID'] : NULL);
        $array['MobileNo']   =  getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : NULL);
        $array['image']   =  getStringClean((isset($array['image'])) ? $array['image'] : NULL);
        $array['CountryID']   =  getStringClean((isset($array['CountryID'])) ? $array['CountryID'] : 0);
        $array['StateID']   =  getStringClean((isset($array['StateID'])) ? $array['StateID'] : 0);
        $array['CityID']   =  getStringClean((isset($array['CityID'])) ? $array['CityID'] : 0);
        $array['DesignationID']   =  getStringClean((isset($array['DesignationID'])) ? $array['DesignationID'] : NULL);
        $array['WebsiteURL']   =  getStringClean((isset($array['WebsiteURL'])) ? $array['WebsiteURL'] : NULL);
        $array['FaceBookURL']   =  getStringClean((isset($array['FaceBookURL'])) ? $array['FaceBookURL'] : NULL);
        $array['LinkedinURL']   =  getStringClean((isset($array['LinkedinURL'])) ? $array['LinkedinURL'] : NULL);
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();


        $sql = "call usp_A_AddCompany('" .
            $array['CompanyName'] . "','" .
            $array['FirstName'] . "','" .
            $array['LastName'] . "','" .
            $array['EmailID'] . "','" .
            $array['Password'] . "','" .
            $array['Address'] . "','" .
            $array['CountryID'] . "','" .
            $array['StateID'] . "','" .
            $array['CityID'] . "','" .
            $array['MobileNo'] . "','" .
            $array['DesignationID'] . "','" .
            $array['StatusText'] . "','" .
            $array['WebsiteURL'] . "','" .
            $array['FaceBookURL'] . "','" .
            $array['LinkedinURL'] . "','" .
            $array['image'] . "','" .
            $array['Latitude'] . "','" .
            $array['Longitude'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] .
            "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function update($array)
    {
        //print_r($array);die();
        $array['CompanyName']   =  getStringClean((isset($array['CompanyName'])) ? $array['CompanyName'] : NULL);
        $array['StatusText']   =  getStringClean((isset($array['StatusText'])) ? $array['StatusText'] : NULL);
        $array['Address']   =  getStringClean((isset($array['Address'])) ? $array['Address'] : NULL);
        $array['Latitude']   =  getStringClean((isset($array['Latitude'])) ? $array['Latitude'] : NULL);
        $array['Longitude']   =  getStringClean((isset($array['Longitude'])) ? $array['Longitude'] : NULL);
        $array['image']   =  getStringClean((isset($array['image'])) ? $array['image'] : NULL);
        $array['CountryID']   =  getStringClean((isset($array['CountryID'])) ? $array['CountryID'] : 0);
        $array['StateID']   =  getStringClean((isset($array['StateID'])) ? $array['StateID'] : 0);
        $array['CityID']   =  getStringClean((isset($array['CityID'])) ? $array['CityID'] : 0);
        $array['DesignationID']   =  getStringClean((isset($array['DesignationID'])) ? $array['DesignationID'] : NULL);
        $array['WebsiteURL']   =  getStringClean((isset($array['WebsiteURL'])) ? $array['WebsiteURL'] : NULL);
        $array['FaceBookURL']   =  getStringClean((isset($array['FaceBookURL'])) ? $array['FaceBookURL'] : NULL);
        $array['LinkedinURL']   =  getStringClean((isset($array['LinkedinURL'])) ? $array['LinkedinURL'] : NULL);
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ID']   =   (isset($array['ID'])) ? $array['ID'] : NULL;
        $array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_EditCompany('" .
            $array['CompanyName'] . "','" .
            $array['Address'] . "','" .
            $array['CountryID'] . "','" .
            $array['StateID'] . "','" .
            $array['CityID'] . "','" .
            $array['DesignationID'] . "','" .
            $array['StatusText'] . "','" .
            $array['WebsiteURL'] . "','" .
            $array['FaceBookURL'] . "','" .
            $array['LinkedinURL'] . "','" .
            $array['image'] . "','" .
            $array['Latitude'] . "','" .
            $array['Longitude'] . "','" .
            $array['modified_by'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        //print_r($query->next_result);die();
        return $query->row();
    }

    public function insertemployee($array)
    {
        //print_r($array);die();
        $array['FirstName']   =  getStringClean((isset($array['FirstName'])) ? $array['FirstName'] : NULL);
        $array['LastName']   =  getStringClean((isset($array['LastName'])) ? $array['LastName'] : NULL);
        $array['EmailID']   =  getStringClean((isset($array['EmailID'])) ? $array['EmailID'] : NULL);
        $array['Password']   =  fnEncrypt($this->input->post('password'), $this->config->item('sSecretKey'));
        $array['MobileNo']   =  getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : NULL);
        $array['CompanyID']   =  getStringClean((isset($array['CompanyID'])) ? $array['CompanyID'] : NULL);
        $array['DesignationID']   =  getStringClean((isset($array['DesignationID'])) ? $array['DesignationID'] : NULL);
        $array['Status']        =   ACTIVE;
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();


        $sql = "call usp_A_AddCompanyUser('" .
            $array['CompanyID'] . "','" .
            $array['FirstName'] . "','" .
            $array['LastName'] . "','" .
            $array['EmailID'] . "','" .
            $array['Password'] . "','" .
            $array['MobileNo'] . "','" .
            $array['DesignationID'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] .
            "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function updateemployee($array)
    {
        //print_r($array);die();
        $array['FirstName']   =  getStringClean((isset($array['FirstName'])) ? $array['FirstName'] : NULL);
        $array['LastName']   =  getStringClean((isset($array['LastName'])) ? $array['LastName'] : NULL);
        $array['EmailID']   =  getStringClean((isset($array['EmailID'])) ? $array['EmailID'] : NULL);
        $array['Password']   =  fnEncrypt($this->input->post('password'), $this->config->item('sSecretKey'));
        $array['MobileNo']   =  getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : NULL);
        $array['CompanyID']   =  getStringClean((isset($array['CompanyID'])) ? $array['CompanyID'] : NULL);
        $array['DesignationID']   =  getStringClean((isset($array['DesignationID'])) ? $array['DesignationID'] : NULL);
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ID']   =   (isset($array['ID'])) ? $array['ID'] : NULL;
        $array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_EditCompanyUser('" .
            $array['FirstName'] . "','" .
            $array['LastName'] . "','" .
            $array['modified_by'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "','" .
            $array['MobileNo'] . "','" .
            $array['DesignationID'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        //print_r($query->next_result);die();
        return $query->row();
    }

    public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id'])) ? $array['id'] : 0;
        $array['status']        =   (isset($array['status'])) ? $array['status'] : 0;

        $array['table_name'] = "ssc_company";
        $array['field_name'] = "ComapnyID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }
    function email_exists($email, $contact, $id)
    {
        //print_r("call usp_A_CheckEmailMobileExist('".$email."','".$contact."','".$id."')");die();
        $query = $this->db->query("call usp_A_CheckEmailMobileExist('" . $email . "','" . $contact . "','" . $id . "')");
        //$query->next_result();
        return $query->row();
    }
    public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];
        $array['CompanyName']       =  $array['CompanyName'];
        $array['table_name'] = "ssc_company";
        $array['field_name'] = "CompanyID";
        $sql = "call usp_A_CheckDuplicate('" . $array['table_name'] . "','CompanyName','" . $array['CompanyName'] . "','CompanyID','" . $array['id'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetCompanyByID('$ID')");
        $query->next_result();
        return $query->row();
    }
    public function getEmployeeByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetCompanyUserDetailsByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}
