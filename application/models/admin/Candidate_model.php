<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Candidate_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1)
    {
        $JobpostID = $CompanyID = -1;
        $Type = "All";
        $Skills = getStringClean(($this->input->post('Skills') != '') ? $this->input->post('Skills') : '');
        $Salary = $this->input->post('Salary');
        $StartSalary = -1;
        $EndSalary = -1;
        if ($Salary != "") {
            $Ex_Salary = explode('~', $Salary);
            $StartSalary = isset($Ex_Salary[0]) ? $Ex_Salary[0] : -1;
            $EndSalary = isset($Ex_Salary[1]) ? $Ex_Salary[1] : -1;
        }
        $SortBy = ($this->input->post('SortBy') != '') ? $this->input->post('SortBy') : 'Name';
        $SortByOrder = ($this->input->post('SortByOrder') != '') ? $this->input->post('SortByOrder') : 'ASC';
        $Location = getStringClean(($this->input->post('Location') != '') ? implode(',', $this->input->post('Location')) : '');
        $DesignationID = ($this->input->post('DesignationID') != '') ? implode(',', $this->input->post('DesignationID')) : '';

        $sql = "call usp_M_GetCandidateList( '" .
            $per_page_record . "' , '" .
            $page_number . "' , '" .
            $CompanyID . "' , '" .
            site_url() . "' , '" .
            $Skills . "' , '" .
            $Type . "' , '" .
            $JobpostID . "' , '" .
            $StartSalary . "' , '" .
            $EndSalary . "' , '" .
            $DesignationID . "' , '" .
            $SortBy . "' , '" .
            $SortByOrder . "','');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    public function listData_sort($per_page_record = 10, $page_number = 1)
    {
        $JobpostID = $CompanyID = -1;
        $Type = "All";
        $Skills = getStringClean(($this->input->post('Skills') != '') ? $this->input->post('Skills') : '');
        $Salary = $this->input->post('Salary');
        $jobSearchText = $this->input->post('jobSearchText');
        $StartSalary = -1;
        $EndSalary = -1;
        if ($Salary != "") {
            $Ex_Salary = explode('~', $Salary);
            $StartSalary = isset($Ex_Salary[0]) ? $Ex_Salary[0] : -1;
            $EndSalary = isset($Ex_Salary[1]) ? $Ex_Salary[1] : -1;
        }
        $SortBy = ($this->input->post('SortBy') != '') ? $this->input->post('SortBy') : 'Name';
        $SortByOrder = ($this->input->post('SortByOrder') != '') ? $this->input->post('SortByOrder') : 'ASC';
        $Location = getStringClean(($this->input->post('Location') != '') ? implode(',', $this->input->post('Location')) : '');
        $DesignationID = ($this->input->post('DesignationID') != '') ? implode(',', $this->input->post('DesignationID')) : '';

        $sql = "call usp_M_GetCandidateListJobShort( '" .
            $per_page_record . "' , '" .
            $page_number . "' , '" .
            $CompanyID . "' , '" .
            site_url() . "' , '" .
            $Skills . "' , '" .
            $Type . "' , '" .
            $JobpostID . "' , '" .
            $StartSalary . "' , '" .
            $EndSalary . "' , '" .
            $DesignationID . "' , '" .
            $SortBy . "' , '" .
            $SortByOrder . "' , '','" .
            $jobSearchText . "'
            );";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    function listCandidateList($UserID, $per_page_record = 10, $page_number = 1, $JobStatus = 'All')
    {
        $Path = site_url();
        $SkillSearch = getStringClean(($this->input->post('SkillSearch') != '') ? $this->input->post('SkillSearch') : -1);
        $MinSalary = ($this->input->post('MinSalary') != '') ? $this->input->post('MinSalary') : -1;
        $MaxSalary = ($this->input->post('MaxSalary') != '') ? $this->input->post('MaxSalary') : -1;
        $JobStatus = ($this->input->post('JobStatus') != '') ? $this->input->post('JobStatus') : 'All';
        $all_job = getStringClean(($this->input->post('all_job') != '') ? $this->input->post('all_job') : '');
        $sql = "call usp_A_GetJobByCompanyForSearch('$per_page_record','$page_number','$UserID','$SkillSearch','$MinSalary','$MaxSalary','$JobStatus','$all_job')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    function changePassword()
    {
        $ID = $this->input->post("UserID");
        $password = fnEncrypt($this->input->post('new_password'), $this->config->item('sSecretKey'));
        $sql = "CALL usp_A_CandidateChangePassword('" . $password . "','" . $ID . "');";
        $query = $this->db->query($sql);
        return $query->row();
    }

    function listAppliedJobs($per_page_record = 10, $page_number = 1)
    {
        $UserID = $this->input->post('UserID');

        $DesignationID = ($this->input->post('DesignationID') != '') ? $this->input->post('DesignationID') : '';
        $MinSalary = ($this->input->post('MinSalary') != '') ? $this->input->post('MinSalary') : -1;
        $MaxSalary = ($this->input->post('MaxSalary') != '') ? $this->input->post('MaxSalary') : -1;

        $path = site_url();
        $sql = "call usp_M_GetJob('$per_page_record','$page_number','$DesignationID','$MinSalary','$MaxSalary','-1','-1','$path','$UserID','Apply','Name','ASC','','')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function listSavedJobs($per_page_record = 10, $page_number = 1)
    {
        $UserID = $this->input->post('UserID');
        $DesignationID = ($this->input->post('DesignationID') != '') ? $this->input->post('DesignationID') : '';
        $MinSalary = ($this->input->post('MinSalary') != '') ? $this->input->post('MinSalary') : -1;
        $MaxSalary = ($this->input->post('MaxSalary') != '') ? $this->input->post('MaxSalary') : -1;

        $path = site_url();
        $sql = "call usp_M_GetJob('$per_page_record','$page_number','$DesignationID','$MinSalary','$MaxSalary','-1','-1','$path','$UserID','Saved','Name','ASC','','')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listFollowing($per_page_record = 10, $page_number = 1)
    {
        $UserID = $this->input->post('UserID');
        $path = site_url();

        $sql = "call usp_M_Getfollower('$per_page_record','$page_number','$UserID','$path','')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    public function listSkill($per_page_record = 10, $page_number = 1)
    {
        $UserID = $this->input->post('UserID');
        $sql = "call usp_A_GetUserSkillByUserID('$per_page_record','$page_number','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listEmployment($per_page_record = 10, $page_number = 1)
    {
        $UserID = $this->input->post('UserID');

        $sql = "call usp_A_GetUserEmployementByUserID('$per_page_record','$page_number','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listProject($per_page_record = 10, $page_number = 1)
    {
        $UserID = $this->input->post('UserID');

        $sql = "call usp_A_GetUserProjectByUserID('$per_page_record','$page_number','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listCertificate($per_page_record = 10, $page_number = 1)
    {
        $UserID = $this->input->post('UserID');
        $sql = "call usp_A_GetUserCertificateByUserID('$per_page_record','$page_number','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    public function listLanguage($per_page_record = 10, $page_number = 1)
    {
        $UserID = $this->input->post('UserID');
        $sql = "call usp_A_GetUserLanguageByUserID('$per_page_record','$page_number','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    public function listQualification($per_page_record = 10, $page_number = 1)
    {
        $UserID = $this->input->post('UserID');

        $sql = "call usp_A_GetUserQualificationByUserID('$per_page_record','$page_number','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    public function listInvited($per_page_record = 10, $page_number = 1)
    {
        $UserID = $this->input->post('UserID');
        $Type = $this->input->post('Type');
        $Action = $this->input->post('Action');
        $sql = "call usp_M_GetCandidateInterview('$per_page_record','$page_number','$UserID','$Type','$Action','." . site_url() . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_candidate','CandidateID')");
        $query->next_result();
        return $query->result();
    }

    public function editBasicDetails($array)
    {
        $userid = isset($array['cUserID']) ? $array['cUserID'] : 0;
        $FirstName   =   getStringClean((isset($array['FirstName'])) ? $array['FirstName'] : NULL);
        $LastName   =   getStringClean((isset($array['LastName'])) ? $array['LastName'] : NULL);
        $StatusText   =   getStringClean((isset($array['StatusText'])) ? $array['StatusText'] : NULL);
        $CityID   =   (isset($array['CityID'])) ? $array['CityID'] : -1;
        $IsExperience = (isset($array['IsExperience'])) ? $array['IsExperience'] : NULL;
        $MobieNo = getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : NULL);
        $path = site_url();
        $Experience   =   getStringClean((isset($array['Experience_id'])) ? $array['Experience_id'] : -1);
        $Salary   =   getStringClean((isset($array['Salary'])) ? $array['Salary'] : -1);

        $query = $this->db->query("call usp_M_EditBasicCandidate('$userid','$FirstName','$LastName','$StatusText','$CityID','$IsExperience','$MobieNo','$path','$Experience','$Salary')");
        $query->next_result();
        return $query->result();
    }

    public function editOtherDetails($array)
    {
        $userid = isset($array['cUserID']) ? $array['cUserID'] : 0;
        $DOB   =   (isset($array['DOB'])) ? date('Y-m-d', strtotime($array['DOB'])) : '0000-00-00';
        $dateOfBirth = $DOB;
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        $age = $diff->format('%y');
        if ($age < 12) {
            $AgeGroupID = 1;
        } elseif ($age >= 12 && $age <= 17) {
            $AgeGroupID = 2;
        } elseif ($age > 17 && $age <= 24) {
            $AgeGroupID = 3;
        } elseif ($age > 24 && $age <= 34) {
            $AgeGroupID = 4;
        } elseif ($age > 34 && $age <= 44) {
            $AgeGroupID = 5;
        } elseif ($age > 45 && $age <= 54) {
            $AgeGroupID = 6;
        } elseif ($age > 54 && $age <= 64) {
            $AgeGroupID = 7;
        } elseif ($age > 64 && $age <= 74) {
            $AgeGroupID = 8;
        } elseif ($age > 75) {
            $AgeGroupID = 9;
        }

        $Gender   =   getStringClean((isset($array['Gender'])) ? $array['Gender'] : NULL);
        $Address   =   getStringClean((isset($array['Address'])) ? $array['Address'] : NULL);
        $Pincode   =   getStringClean((isset($array['Pincode'])) ? $array['Pincode'] : NULL);
        $MaritualStatus   =   getStringClean((isset($array['MaritualStatus'])) ? $array['MaritualStatus'] : '');
        $PermenantAddress   =   getStringClean((isset($array['PermenantAddress'])) ? $array['PermenantAddress'] : NULL);
        $IsPhysicalChallenged   =   (isset($array['IsPhysicalChallenged']) && $array['IsPhysicalChallenged'] == 'on') ? ACTIVE : INACTIVE;
        $IsWorkPermit        =   (isset($array['IsWorkPermit']) && $array['IsWorkPermit'] == 'on') ? ACTIVE : INACTIVE;
        $path = site_url();
        /*echo "call usp_M_EditOthersCandidate('$userid','$DOB','$AgeGroupID','$Gender','$Address','$Pincode','$MaritualStatus','$PermenantAddress','$IsPhysicalChallenged','$IsWorkPermit','$path')";exit;*/
        $query = $this->db->query("call usp_M_EditOthersCandidate('$userid','$DOB','$AgeGroupID','$Gender','$Address','$Pincode','$MaritualStatus','$PermenantAddress','$IsPhysicalChallenged','$IsWorkPermit','$path')");
        $query->next_result();
        return $query->result();
    }
    public function addeditSkill($array)
    {
        //print_r($array);die();
        $array['UserID']   =   (isset($array['UserID'])) ? $array['UserID'] : 0;
        $array['SkillID']   =   (isset($array['SkillID'])) ? $array['SkillID'] : 0;
        //print_r($array['SkillID']);die();
        $array['ID'] = (isset($array['ID'])) ? $array['ID'] : 0;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddEditUserSkill('" .
            $array['UserID'] . "','" .
            $array['SkillID'] . "','" .
            $array['ID'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function addeditEmployment($array)
    {
        //print_r($array);die();
        $array['UserID']   =   (isset($array['cuid'])) ? $array['cuid'] : 0;
        $array['DesignationID']   =   (isset($array['DesignationID'])) ? $array['DesignationID'] : 0;
        $array['OrganizationID'] = (isset($array['OrganizationID'])) ? $array['OrganizationID'] : 0;
        $array['Organization']   =   getStringClean((isset($array['Organization'])) ? $array['Organization'] : NULL);
        $array['IsPresent']   =   (isset($array['IsPresent']) && $array['IsPresent'] == 'on') ? ACTIVE : INACTIVE;
        $array['StartDate']   =   (@$array['StartDate'] != "") ? GetDateInFormat(@$array['StartDate'], DATE_FORMAT, 'Y-m-d') : DEFAULT_DATE;
        $array['EndDate']   =   (@$array['EndDate'] != "") ? GetDateInFormat(@$array['EndDate'], DATE_FORMAT, 'Y-m-d') : DEFAULT_DATE;
        $array['ID'] = (isset($array['ID'])) ? $array['ID'] : 0;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        $array['Location']   =   getStringClean((isset($array['Location'])) ? $array['Location'] : NULL);
        $array['Responsibilities']   =   getStringClean((isset($array['Responsibilities'])) ? $array['Responsibilities'] : NULL);

        $sql = "call usp_A_AddEditUserEmployement('" .
            $array['UserID'] . "','" .
            $array['DesignationID'] . "','" .
            $array['OrganizationID'] . "','" .
            $array['Organization'] . "','" .
            $array['Location'] . "','" .
            $array['IsPresent'] . "','" .
            $array['StartDate'] . "','" .
            $array['EndDate'] . "','" .
            $array['Responsibilities'] . "','" .
            $array['ID'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function addeditProject($array)
    {
        $array['UserID']   =   (isset($array['cuid'])) ? $array['cuid'] : 0;

        $array['ProjectTitle']   =   getStringClean((isset($array['ProjectTitle'])) ? $array['ProjectTitle'] : NULL);
        $array['ProjectDescription']   =   getStringClean((isset($array['ProjectDescription'])) ? $array['ProjectDescription'] : NULL);
        $array['Client']   =   getStringClean((isset($array['Client'])) ? $array['Client'] : NULL);
        $array['Achievements']   =   getStringClean((isset($array['Achievements'])) ? $array['Achievements'] : NULL);
        $array['ProjectSite'] = getStringClean((isset($array['ProjectSite'])) ? $array['ProjectSite'] : 'On Site');
        $array['NatureOfEmployment']   =   getStringClean((isset($array['NatureOfEmployment'])) ? $array['NatureOfEmployment'] : NULL);
        $array['TeamSize']   =   getStringClean((isset($array['TeamSize'])) ? $array['TeamSize'] : 0);

        $array['StartedFrom']   = (@$array['StartedFrom'] != "") ? GetDateInFormat($array['StartedFrom'], DATE_FORMAT, 'Y-m-d') : DEFAULT_DATE;
        $array['WorkedTill']   = (@$array['WorkedTill'] != "") ? GetDateInFormat($array['WorkedTill'], DATE_FORMAT, 'Y-m-d') : DEFAULT_DATE;
        $array['DesignationID'] = (isset($array['DesignationID'])) ? $array['DesignationID'] : 0;
        $array['DesignationDescription'] = getStringClean((isset($array['DesignationDescription'])) ? $array['DesignationDescription'] : NULL);

        $array['ID'] = (isset($array['ID'])) ? $array['ID'] : 0;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();


        $sql = "call usp_A_AddEditUserProject('" .
            $array['UserID'] . "','" .
            $array['ProjectTitle'] . "','" .
            $array['ProjectDescription'] . "','" .
            $array['Client'] . "','" .
            $array['Achievements'] . "','" .
            $array['StartedFrom'] . "','" .
            $array['WorkedTill'] . "','" .
            $array['ProjectSite'] . "','" .
            $array['NatureOfEmployment'] . "','" .
            $array['TeamSize'] . "','" .
            $array['DesignationID'] . "','" .
            $array['DesignationDescription'] . "','" .
            $array['ID'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function addeditCertificate($array)
    {
        $array['UserID']   =   (isset($array['cuid'])) ? $array['cuid'] : 0;

        $array['Description']   =   getStringClean((isset($array['Description'])) ? $array['Description'] : NULL);

        $array['Year']   =   (isset($array['Year'])) ? $array['Year'] : NULL;

        $array['ID'] = (isset($array['ID'])) ? $array['ID'] : 0;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();


        $sql = "call usp_A_AddEditUserCertificate('" .
            $array['UserID'] . "','" .
            $array['Description'] . "','" .
            $array['ID'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "','" .
            $array['Year'] . "');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function addeditLanguage($array)
    {
        //print_r($array);exit();
        $array['UserID']   =   (isset($array['cuid'])) ? $array['cuid'] : 0;

        $array['LanguageID']   =   (isset($array['LanguageID'])) ? $array['LanguageID'] : 0;
        // $array['IsRead']        =   (isset($array['IsRead']) && $array['IsRead'] == 'on')?ACTIVE:INACTIVE;
        // $array['IsWrite']        =   (isset($array['IsWrite']) && $array['IsWrite'] == 'on')?ACTIVE:INACTIVE;
        // $array['IsSpeak']        =   (isset($array['IsSpeak']) && $array['IsSpeak'] == 'on')?ACTIVE:INACTIVE;

        $array['ID'] = (isset($array['ID'])) ? $array['ID'] : 0;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        $array['Proficiency'] = (isset($array['Proficiency']) && $array['Proficiency'] == 'on') ? "Fluent" : "Basic";

        $sql = "call usp_A_AddEditUserLanguage('" .
            $array['UserID'] . "','" .
            $array['LanguageID'] . "','" .
            $array['ID'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "','" .
            $array['Proficiency'] . "');";
        //echo($sql);exit();    
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function addeditQualification($array)
    {
        $array['UserID']   =   (isset($array['cuid'])) ? $array['cuid'] : 0;

        $array['QualificationID']   =   (isset($array['QualificationID'])) ? $array['QualificationID'] : 0;
        $array['NewQualification']        =   getStringClean((isset($array['NewQualification'])) ? $array['NewQualification'] : NULL);
        $array['Year']        =   getStringClean((isset($array['Year'])) ? $array['Year'] : 0);
        $array['University']        =   getStringClean((isset($array['University'])) ? $array['University'] : NULL);
        $array['Grade']        =   (isset($array['Grade'])) ? $array['Grade'] : NULL;
        $array['ID'] = (isset($array['ID'])) ? $array['ID'] : 0;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        $array['OtherGrade']  =  (isset($array['OtherGrade'])) ? $array['OtherGrade'] : NULL;
        $array['Course']  =  (isset($array['Course'])) ? $array['Course'] : NULL;

        $sql = "call usp_A_AddEditUserQualification('" .
            $array['UserID'] . "','" .
            $array['QualificationID'] . "','" .
            $array['NewQualification'] . "','" .
            $array['Year'] . "','" .
            $array['University'] . "','" .
            $array['Grade'] . "','" .
            $array['ID'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "','" .
            $array['OtherGrade'] . "','" .
            $array['Course'] . "');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function insert($array)
    {
        $dbarray = array();
        $dbarray['CVName'] = @$_FILES['cvfile']['name'];
        $dbarray['FirstName']   =   (isset($array['FirstName'])) ? $array['FirstName'] : NULL;
        $dbarray['LastName']   =   (isset($array['LastName'])) ? $array['LastName'] : NULL;
        $dbarray['EmailID']   =   (isset($array['EmailID'])) ? $array['EmailID'] : NULL;
        $array['Password']   =  fnEncrypt($this->input->post('Password'), $this->config->item('sSecretKey'));
        $dbarray['Gender']   =   (isset($array['Gender'])) ? $array['Gender'] : NULL;
        if ($dbarray['Gender'] != OTHER) {
            $dbarray['OtherGender']   = '';
        }
        $dbarray['OtherGender']   =   (isset($array['OtherGender'])) ? $array['OtherGender'] : NULL;
        $dbarray['ProfilePic']   =   (isset($array['image'])) ? $array['image'] : NULL;
        $dbarray['Address']   =   (isset($array['Address'])) ? $array['Address'] : NULL;
        $dbarray['CityID']   =   (isset($array['CityID'])) ? $array['CityID'] : 0;
        $dbarray['Pincode']   =   (isset($array['Pincode'])) ? $array['Pincode'] : NULL;
        $dbarray['StatusText']   =   (isset($array['StatusText'])) ? $array['StatusText'] : NULL;
        $dbarray['ProfileSummary']   =   (isset($array['ProfileSummary'])) ? $array['ProfileSummary'] : NULL;
        $dbarray['ProfileStatus']   =   (isset($array['ProfileStatus'])) ? $array['ProfileStatus'] : NULL;
        $dbarray['IsWillingToRelocate']   =   (isset($array['IsWillingToRelocate'])) ? $array['IsWillingToRelocate'] : 1;
        $dbarray['HaveDrivingLicence']   =   (isset($array['HaveDrivingLicence'])) ? $array['HaveDrivingLicence'] : 1;
        $dbarray['BirthYear']   =  (isset($array['Year'])) ? $array['Year'] : NULL;
        $dbarray['EthnicityID']   =   (isset($array['EthnicityID'])) ? $array['EthnicityID'] : 0;
        $dbarray['JobType'] = (isset($array['JobType'])) ? implode(',', $array['JobType']) : '';
        $array['MobileNo']   =   (isset($array['MobileNo'])) ? $array['MobileNo'] : '';
        $dbarray['CVPath']   =   (isset($array['cv'])) ? $array['cv'] : '';
        $dbarray['IsExperience']   =   (isset($array['IsExperience'])) ? $array['IsExperience'] : 0;
        $array['ExperienceYear']   =  getStringClean((isset($array['ExperienceYear'])) ? $array['ExperienceYear'] : 0);
        $array['ExperienceMonth']   =  getStringClean((isset($array['ExperienceMonth'])) ? $array['ExperienceMonth'] : 0);
        $Salary = str_replace(",", "", $array['Salary']);
        $dbarray['Salary']   =   ($Salary) ? $Salary : 0;
        $Experience   =  (($array['ExperienceYear'] * 12) + $array['ExperienceMonth']);
        $dbarray['Experience']   =   (isset($Experience)) ? $Experience : 0;
        if ($dbarray['IsExperience'] != EXPERIENCE) {
            $dbarray['Salary'] = 0;
            $dbarray['Experience'] = 0;
        }
        $dbarray['IsPhysicalChallenged']   =   (isset($array['IsPhysicalChallenged']) && $array['IsPhysicalChallenged'] == 'on') ? ACTIVE : INACTIVE;
        $dbarray['IsWorkPermit']        =   (isset($array['IsWorkPermit']) && $array['IsWorkPermit'] == 'on') ? ACTIVE : INACTIVE;
        $dbarray['VisaStatus']   =  getStringClean((isset($array['VisaStatus'])) ? $array['VisaStatus'] : '');
        if ($dbarray['IsWorkPermit'] == 0) {
            $dbarray['VisaStatus'] = "";
        }
        $dbarray['IsOTPVerified'] = 1;
        $BirthYear = $dbarray['BirthYear'];
        $today_year = date("Y");
        $diff = (($today_year) - ($BirthYear));
        if ($diff < 12) {
            $dbarray['AgeGroupID'] = 1;
        } elseif ($diff >= 12 && $diff <= 17) {
            $dbarray['AgeGroupID'] = 2;
        } elseif ($diff > 17 && $diff <= 24) {
            $dbarray['AgeGroupID'] = 3;
        } elseif ($diff > 24 && $diff <= 34) {
            $dbarray['AgeGroupID'] = 4;
        } elseif ($diff > 34 && $diff <= 44) {
            $dbarray['AgeGroupID'] = 5;
        } elseif ($diff > 45 && $diff <= 54) {
            $dbarray['AgeGroupID'] = 6;
        } elseif ($diff > 54 && $diff <= 64) {
            $dbarray['AgeGroupID'] = 7;
        } elseif ($diff > 64 && $diff <= 74) {
            $dbarray['AgeGroupID'] = 8;
        } elseif ($diff > 75) {
            $dbarray['AgeGroupID'] = 9;
        }


        $dbarray['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $dbarray['CreatedBy'] = $this->session->userdata['UserID'];
        $dbarray['CreatedDate'] = GetTimeZoneWDateTime();
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        $sql = "SELECT Fn_A_AddUser('" .
            $dbarray['EmailID'] . "','" .
            $array['Password'] . "','" .
            $array['MobileNo'] . "','" .
            "Regular" . "','" .
            "" . "','" .
            "Candidate" . "','" .
            $dbarray['CreatedBy'] . "') AS ID;";
        $query = $this->db->query($sql);
        $res = $query->row();
        if (@$res->ID) {
            $dbarray['UserID'] = @$res->ID;
            $this->db->insert('ssc_candidate', $dbarray);
            $sql = "SELECT 
                        Fn_A_AddActivityLog('" .
                "AddCandidate" . "','" .
                "has added new Candidate" . "','" .
                $array['UserType'] . "','" .
                $array['IPAddress'] . "','" .
                $array['CreatedBy'] . "')";
            $query = $this->db->query($sql);
            return @$res->ID;
        } else {
            return 0;
        }
    }

    public function update($array)
    {

        $dbarray = array();
        $array['UserID'] = $array['ID'];
        $dbarray['CVName'] = @$_FILES['cvfile']['name'];
        $dbarray['FirstName']   =   (isset($array['FirstName'])) ? $array['FirstName'] : NULL;
        $dbarray['LastName']   =   (isset($array['LastName'])) ? $array['LastName'] : NULL;
        $dbarray['Gender']   =   (isset($array['Gender'])) ? $array['Gender'] : NULL;
        $dbarray['OtherGender']   =   (isset($array['OtherGender'])) ? $array['OtherGender'] : NULL;
        if ($dbarray['Gender'] != OTHER) {
            $dbarray['OtherGender']   = '';
        }
        $dbarray['ProfilePic']   =   (isset($array['image'])) ? $array['image'] : NULL;
        $dbarray['Address']   =   (isset($array['Address'])) ? $array['Address'] : NULL;
        $dbarray['CityID']   =   (isset($array['CityID'])) ? $array['CityID'] : 0;
        $dbarray['Pincode']   =   (isset($array['Pincode'])) ? $array['Pincode'] : NULL;
        $dbarray['StatusText']   =   (isset($array['StatusText'])) ? $array['StatusText'] : NULL;
        $dbarray['ProfileSummary']   =   (isset($array['ProfileSummary'])) ? $array['ProfileSummary'] : NULL;
        $dbarray['ProfileStatus']   =   (isset($array['ProfileStatus'])) ? $array['ProfileStatus'] : NULL;
        $dbarray['IsWillingToRelocate']   =   (isset($array['IsWillingToRelocate'])) ? $array['IsWillingToRelocate'] : 1;
        $dbarray['HaveDrivingLicence']   =   (isset($array['HaveDrivingLicence'])) ? $array['HaveDrivingLicence'] : 1;
        $dbarray['BirthYear']   =  (isset($array['Year'])) ? $array['Year'] : NULL;
        $dbarray['EthnicityID']   =   (isset($array['EthnicityID'])) ? $array['EthnicityID'] : 0;
        $dbarray['JobType'] = (isset($array['JobType'])) ? implode(',', $array['JobType']) : '';
        $array['MobileNo']   =   (isset($array['MobileNo'])) ? $array['MobileNo'] : '';
        $dbarray['CVPath']   =   (isset($array['cv'])) ? $array['cv'] : '';
        $dbarray['IsExperience']   =   (isset($array['IsExperience'])) ? $array['IsExperience'] : 0;
        $array['ExperienceYear']   =  getStringClean((isset($array['ExperienceYear'])) ? $array['ExperienceYear'] : 0);
        $array['ExperienceMonth']   =  getStringClean((isset($array['ExperienceMonth'])) ? $array['ExperienceMonth'] : 0);
        $Salary = str_replace(",", "", $array['Salary']);
        $dbarray['Salary']   =   ($Salary) ? $Salary : 0;
        $Experience   =  (($array['ExperienceYear'] * 12) + $array['ExperienceMonth']);
        $dbarray['Experience']   =   (isset($Experience)) ? $Experience : 0;
        if ($dbarray['IsExperience'] != EXPERIENCE) {
            $dbarray['Salary'] = 0;
            $dbarray['Experience'] = 0;
        }
        $dbarray['IsPhysicalChallenged']   =   (isset($array['IsPhysicalChallenged']) && $array['IsPhysicalChallenged'] == 'on') ? ACTIVE : INACTIVE;
        $dbarray['IsWorkPermit']        =   (isset($array['IsWorkPermit']) && $array['IsWorkPermit'] == 'on') ? ACTIVE : INACTIVE;
        $dbarray['VisaStatus']   =  getStringClean((isset($array['VisaStatus'])) ? $array['VisaStatus'] : '');
        if ($dbarray['IsWorkPermit'] == 0) {
            $dbarray['VisaStatus'] = "";
        }
        $dbarray['ModifiedDate'] = GetTimeZoneWDateTime();
        $dbarray['IsOTPVerified'] = 1;
        $BirthYear = $dbarray['BirthYear'];
        $today_year = date("Y");
        $diff = (($today_year) - ($BirthYear));
        if ($diff < 12) {
            $dbarray['AgeGroupID'] = 1;
        } elseif ($diff >= 12 && $diff <= 17) {
            $dbarray['AgeGroupID'] = 2;
        } elseif ($diff > 17 && $diff <= 24) {
            $dbarray['AgeGroupID'] = 3;
        } elseif ($diff > 24 && $diff <= 34) {
            $dbarray['AgeGroupID'] = 4;
        } elseif ($diff > 34 && $diff <= 44) {
            $dbarray['AgeGroupID'] = 5;
        } elseif ($diff > 45 && $diff <= 54) {
            $dbarray['AgeGroupID'] = 6;
        } elseif ($diff > 54 && $diff <= 64) {
            $dbarray['AgeGroupID'] = 7;
        } elseif ($diff > 64 && $diff <= 74) {
            $dbarray['AgeGroupID'] = 8;
        } elseif ($diff > 75) {
            $dbarray['AgeGroupID'] = 9;
        }

        $dbarray['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $dbarray['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        $sql = "SELECT Fn_A_EditUser('" .
            $array['MobileNo'] . "','" .
            $dbarray['ModifiedBy'] . "','" .
            $array['UserID'] . "') AS ID;";
        $query = $this->db->query($sql);
        $res = $query->row();
        if (@$res->ID) {
            $this->db->where('UserID', $array['UserID']);
            $this->db->update('ssc_candidate', $dbarray);
            $sql = "SELECT 
                        Fn_A_AddActivityLog('" .
                "EditCandidate" . "','" .
                "has edited Candidate" . "','" .
                $array['UserType'] . "','" .
                $array['IPAddress'] . "','" .
                $array['CreatedBy'] . "')";
            $query = $this->db->query($sql);
            return 1;
        } else {
            return 0;
        }
    }
    public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id'])) ? $array['id'] : 0;
        $array['status']        =   (isset($array['status'])) ? $array['status'] : 0;
        $array['table_name'] = "ssc_candidate";
        $array['field_name'] = "UserID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }

    public function changeEmploymentStatus($array)
    {
        $array['id']            =   (isset($array['id'])) ? $array['id'] : 0;
        $array['status']        =   (isset($array['status'])) ? $array['status'] : 0;
        if ($array['type'] == 'Skill') {
            $array['table_name'] = "ssc_userskill";
            $array['field_name'] = "UserSkillID";
        }
        if ($array['type'] == 'Employment') {
            $array['table_name'] = "ssc_useremployement";
            $array['field_name'] = "UserEmployementID";
        }
        if ($array['type'] == 'Project') {
            $array['table_name'] = "ssc_userproject";
            $array['field_name'] = "UserProjectID";
        }
        if ($array['type'] == 'Certificate') {
            $array['table_name'] = "ssc_usercertificate";
            $array['field_name'] = "UserCertificateID";
        }
        if ($array['type'] == 'Language') {
            $array['table_name'] = "ssc_userlanguage";
            $array['field_name'] = "UserLanguageID";
        }
        if ($array['type'] == 'Qualification') {
            $array['table_name'] = "ssc_userqualification";
            $array['field_name'] = "UserQualificationID";
        }
        $array['modified_by'] = $this->session->userdata['UserID'];

        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }


    public function getCandidateByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetCandidateByID('$ID')");
        $query->next_result();
        return $query->row();
    }
    public function getSkillByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetUserSkillByID('$ID')");
        $query->next_result();
        return $query->row();
    }
    public function getEmploymentByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetUserEmployementByID('$ID')");
        $query->next_result();
        return $query->row();
    }
    public function getProjectByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetUserProjectByID('$ID')");
        $query->next_result();
        return $query->row();
    }
    public function getCertificateByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetUserCertificateByID('$ID')");
        $query->next_result();
        return $query->row();
    }
    public function getLanguageByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetUserLanguageByID('$ID')");
        $query->next_result();
        return $query->row();
    }
    public function getQualificationByID($ID = NULL)
    {
        $query = $this->db->query("call usp_A_GetUserQualificationByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}
