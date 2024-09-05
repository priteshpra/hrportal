<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_model extends CI_Model 
{
    function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    // Start : Result as per Sp query 
    public function getQueryResult($sql){  
        try{
            $query = $this->db->query($sql);
            $query->next_result();        
            return $query->result();
        }catch(Exection $e){
            return '';
        }
    }
    
    // Start : Result as per Sp query 
    public function getInlineQuery($sql){  
        try{
            $query = $this->db->query($sql);
            return $query->result();
        }catch(Exection $e){
            return '';
        }
    }
    
    // Start : Result as per Sp query 
    public function getInlineQueryNoResult($sql){  
        try{
            $query = $this->db->query($sql);
            return 1; //$query->result();
        }catch(Exection $e){
            return '';
        }
    }

    public function userSignup($data,$OTP='') {
        if($OTP==''){
            $OTP = date('sd');
        }
        //"FirstName":"FirstName","LastName":"LastName","EmailID":"real@gmail.com","MobileNo":"9876543221","Password":"123456", "NotificationToken":"345gf6gy54y4y456345", "DeviceUID":"123456","DeviceName":"iPhone","OSVersion":"7","DeviceType":"Candidate IOS"

        // $data->DOB = (!isset($data->DOB)) ? '' : $data->DOB; 
        // $data->Gender = (!isset($data->Gender)) ? '' : $data->Gender; 
        $data->RegId = (!isset($data->RegId)) ? '' : $data->RegId ; 
        $data->ProfilePic = (!isset($data->ProfilePic)) ? '' : $data->ProfilePic ; 

        //if(!isset($data->Type)) $data->Type='';
        if(!isset($data->NotificationToken)) $data->NotificationToken='';
        if(!isset($data->DeviceUID)) $data->DeviceUID='';
        if(!isset($data->DeviceName)) $data->DeviceName='';
        if(!isset($data->OSVersion)) $data->OSVersion='';
        if(!isset($data->DeviceType)) $data->DeviceType='';

        $data->FirstName = ((isset($data->FirstName )) ? $data->FirstName  : '' );
        $data->LastName = ((isset($data->LastName )) ? $data->LastName  : '' );
        $data->OwnerName = ((isset($data->OwnerName )) ? $data->OwnerName  : '' );
        $data->RegistrationType = 'Regular';

        if(isset($data->CountryCode) && $data->CountryCode!=''){
            $data->MobileNo = $data->CountryCode.'-'.$data->MobileNo;
        }


        $sql = "call usp_M_SignUp('" . $data->FirstName . "','" .  
                                        $data->LastName . "','" .
                                        $data->EmailID . "','" . 
                                        $data->MobileNo . "','" . 
                                        fnEncrypt($data->Password, $this->config->item('sSecretKey')) . "',
                                        'Regular','".
                                        base_url()."', '" . 
                                        $data->NotificationToken . "', '" . 
                                        $data->DeviceType."','".
                                        $data->DeviceUID."','".
                                        $data->DeviceName."','".
                                        $data->OSVersion."','".
                                        $OTP."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function addDevice($data){
        if(!isset($data->Type)){ $data->Type=''; }
            $query = $this->db->query("select Fn_M_AddDevice('" .$data->DeviceName . "','" . $data->DeviceUID . "','" . $data->OSVersion. "','" . $data->NotificationToken . "','" . $data->DeviceType . "','" . $data->UserID. "') as device_status, '".$data->NotificationToken."' as NotificationToken");
            //$query->next_result();
            return $query->row_array();
    }

    public function userSocialMediaLogin($data) {
        
        if(!isset($data->EmailID)) $data->EmailID=''; 
        if(!isset($data->MobileNo)) $data->MobileNo='';
        if(!isset($data->file_name)) $data->file_name='';
        if(!isset($data->NotificationToken)) $data->NotificationToken='';
        if(!isset($data->DeviceUID)) $data->DeviceUID='';
        if(!isset($data->DeviceName)) $data->DeviceName='';
        if(!isset($data->OSVersion)) $data->OSVersion='';
        if(!isset($data->DeviceType)) $data->DeviceType='';


        if(isset($data->CountryCode) && $data->CountryCode!=''){
            $data->MobileNo = $data->CountryCode.'-'.$data->MobileNo;
        }

        $sql = "call usp_M_UserSocialMediaLogin('".$data->FirstName."','". 
                                                        $data->LastName."','". 
                                                        $data->EmailID."','". 
                                                        $data->MobileNo."','" . 
                                                        $data->RegistrationType."','" . 
                                                        $data->RegistrationID."','". 
                                                        base_url()."','". 
                                                        $data->file_name."','" . 
                                                        $data->NotificationToken."','" . 
                                                        $data->DeviceUID."','".
                                                        $data->DeviceName."','".
                                                        $data->OSVersion."','".
                                                        $data->DeviceType."')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    /*public function updateMobileNumberForOTP($data){
        $ref_code = generateOTP();
        if(!isset($data->Email)){ $data->Email = NULL; }
        $query = $this->db->query("call usp_M_UpdateMobileNumberForOTP('".$data->CustomerID."','".$data->MobileNumber."','".$data->RefferCode."','".(($ref_code) ? $ref_code : date('dms'))."','".$data->Email."')");
        $query->next_result();
        return $query->result();
    }*/

    public function checkOTPVerification($data){
        $query = $this->db->query("call usp_M_OTPVerified('".$data->UserID."','".$data->OTP."')");
        $query->next_result();
        return $query->result();
    }

    public function generateOTP($data, $OTP=''){
        if($OTP==''){
            $OTP = date('sd');
        }
        $query = $this->db->query("call usp_M_RegenerateOTP('".$data->UserID."','".$OTP."')");
        $query->next_result();
        return $query->result();
    }

    public function addJob($data) {

        $sql = "call usp_M_AddJob('" . $data->UserID . "','" .  
                                        $data->JobTitle . "','" .
                                        $data->DetailsOfJob . "','" . 
                                        $data->IndustryTypeID . "','" . 
                                        $data->DesignationID . "','".
                                        $data->NatureOfEmployment."','".
                                        $data->NoOfVacancies."','".
                                        $data->MinExperience."','".
                                        $data->MaxExperience."','".
                                        $data->MinSalary."','".
                                        $data->MaxSalary."','".
                                        $data->DesiredJobProfile."','".
                                        $data->CityID."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function editJob($data) {

        $sql = "call usp_M_EditJob('" . $data->JobPostID . "','" .  
                                        $data->JobTitle . "','" .
                                        $data->DetailsOfJob . "','" . 
                                        $data->IndustryTypeID . "','" . 
                                        $data->DesignationID . "','".
                                        $data->NatureOfEmployment."','".
                                        $data->NoOfVacancies."','".
                                        $data->MinExperience."','".
                                        $data->MaxExperience."','".
                                        $data->CityID."','".
                                        $data->MinSalary."','".
                                        $data->MaxSalary."','".
                                        $data->DesiredJobProfile."','".
                                        base_url()."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function getJob($data){

        $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
        $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
        $data->DesignationID = (isset($data->DesignationID) || $data->DesignationID!='') ? $data->DesignationID : '';
        $data->StartSalary = (isset($data->StartSalary) || $data->StartSalary!='') ? $data->StartSalary : -1;
        $data->EndSalary = (isset($data->EndSalary) || $data->EndSalary!='') ? $data->EndSalary : -1;
        $data->StartExperience = (isset($data->StartExperience) || $data->StartExperience!='') ? $data->StartExperience : -1;
        $data->EndExperience = (isset($data->EndExperience) || $data->EndExperience!='') ? $data->EndExperience : -1;
        $data->UserID = (isset($data->UserID) || $data->UserID!='') ? $data->UserID : -1;
        $data->Type = (isset($data->Type) || $data->Type!='') ? $data->Type : 'All';
        $data->SortBy = (isset($data->SortBy) || $data->SortBy!='') ? $data->SortBy : 'Modified';
        $data->SortByOrder = (isset($data->SortByOrder) || $data->SortByOrder!='') ? $data->SortByOrder : 'DESC';
        $data->CityIDS = (!isset($data->CityIDS) || @$data->CityIDS=='') ? '' : $data->CityIDS;
        $data->SkillIDS = (!isset($data->SkillIDS) || @$data->SkillIDS=='') ? '' : $data->SkillIDS;


        $query = $this->db->query("call usp_M_GetJob('".$data->PageSize."','".$data->CurrentPage."','".$data->DesignationID."','".$data->StartSalary."','".$data->EndSalary."','".$data->StartExperience."','".$data->EndExperience."','".base_url()."','".$data->UserID."','".$data->Type."','".$data->SortBy."','".$data->SortByOrder."','".$data->CityIDS."','".$data->SkillIDS."')");
        $query->next_result();
        return $query->result();
    }

    public function getJobByCompany($data){

        $data->PageSize = (!isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
        $data->CurrentPage = (!isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
        $data->UserID = (!isset($data->UserID) || $data->UserID!='') ? $data->UserID : -1;
        $data->DesignationID = (isset($data->DesignationID) || @$data->DesignationID!='') ? $data->DesignationID : '';
        $data->StartSalary = (isset($data->StartSalary) || @$data->StartSalary!='') ? $data->StartSalary : -1;
        $data->EndSalary = (isset($data->EndSalary) || @$data->EndSalary!='') ? $data->EndSalary : -1;
        $data->SearchType = (isset($data->SearchType) || @$data->SearchType!='') ? $data->SearchType : 'All';
        // $data->StartExperience = (!isset($data->StartExperience) || $data->StartExperience!='') ? $data->StartExperience : -1;
        // $data->EndExperience = (!isset($data->EndExperience) || $data->EndExperience!='') ? $data->EndExperience : -1;
        // $data->Type = (!isset($data->Type) || $data->Type!='') ? $data->Type : 'All';

        $query = $this->db->query("call usp_M_GetJobByCompany('".$data->PageSize."','".$data->CurrentPage."','".$data->UserID."','".base_url()."','".$data->DesignationID."','".$data->StartSalary."','".$data->EndSalary."','".$data->SearchType."')");
        $query->next_result();
        return $query->result();
    }

    public function editCompany($data) {

        if(isset($data->CountryCode) && $data->CountryCode!=''){
            $data->MobileNo = $data->CountryCode.'-'.$data->MobileNo;
        }
        $sql = "call usp_M_EditCompany('" . $data->UserID . "','" .  
                                        $data->CompanyName . "','" .
                                        $data->FirstName . "','" . 
                                        $data->LastName . "','" . 
                                        $data->Address . "','".
                                        $data->CountryID."','".
                                        $data->StateID."','".
                                        $data->CityID."','".
                                        $data->DesignationID."','".
                                        $data->StatusText."','".
                                        $data->WebsiteURL."','".
                                        $data->Latitude."','".
                                        $data->Longitude."','".
                                        $data->MobileNo."','".
                                        $data->FacebookURL."','".
                                        $data->LinkedInURL."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function editCandidate($data) {

        if(isset($data->CountryCode) && $data->CountryCode!=''){
            $data->MobileNo = $data->CountryCode.'-'.$data->MobileNo;
        }
        $sql = "call usp_M_EditCandidate('" . $data->UserID . "','" .  
                                        $data->FirstName . "','" . 
                                        $data->LastName . "','" . 
                                        $data->Address . "','".
                                        $data->CityName . "','" .
                                        $data->Latitude."','".
                                        $data->Longitude."','".
                                        $data->Pincode."','".
                                        #$data->PermenantAddress."','".
                                        $data->Experience."','".
                                        $data->Salary."','".
                                        $data->BirthYear."','".
                                        $data->Gender."','".
                                        $data->IsPhysicalChallenged."','".
                                        #$data->MaritualStatus."','".
                                        $data->StatusText."','".
                                        $data->ProfileSummary."','".
                                        base_url()."','".
                                        $data->MobileNo."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function addUserEmployeement($data) {

        $sql = "call usp_M_AddUserEmployeement('" . $data->UserID . "','" .  
                                        $data->DesignationID . "','" .
                                        $data->OrganizationID . "','" . 
                                        $data->OrganizationOther . "','" . 
                                        $data->IsPresent . "','".
                                        $data->StartDate."','".
                                        $data->EndDate."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function editOthersCandidate($data) {

        $sql = "call usp_M_EditOthersCandidate('" . $data->UserID . "','" .  
                                        $data->BirthYear . "','" .
                                        $data->AgeOfGroup . "','" . 
                                        $data->Gender . "','" . 
                                        $data->Address . "','".
                                        $data->Pincode."','".
                                        // $data->MaritualStatus."','".
                                        // $data->PermenantAddress."','".
                                        $data->IsPhysicalChallenged."','".
                                        $data->IsWorkPermit."','".
                                        base_url()."','".
                                        $data->OtherGender."','".
                                        $data->EthnicityID."','".
                                        $data->VisaStatus."','".
                                        $data->HaveDrivingLicence."','".
                                        $data->IsWillingToRelocate."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function editBasicCandidate($data) {

        if(isset($data->CountryCode) && $data->CountryCode!=''){
            $data->MobileNo = $data->CountryCode.'-'.$data->MobileNo;
        }
        $sql = "call usp_M_EditBasicCandidate('" . $data->UserID . "','" .  
                                        $data->FirstName . "','" .
                                        $data->LastName . "','" . 
                                        $data->StatusText . "','" . 
                                        $data->CityID . "','".
                                        $data->IsExperience."','".
                                        $data->MobileNo."','".
                                        base_url()."','".
                                        $data->Experience."','".
                                        $data->Salary."','".
                                        $data->JobType."','".
                                        $data->ProfileStatus."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function addEditUserQualification($data) {

        $sql = "call usp_M_AddEditUserQualification('" . $data->UserQualificationID . "','" .  
                                        $data->UserID . "','" .
                                        $data->QualificationID . "','" . 
                                        $data->NewQualification . "','" . 
                                        $data->Course . "','" . 
                                        $data->YearOfPassing . "','".
                                        $data->University."','".
                                        // $data->Specialization."','".
                                        $data->Grade."','".
                                        $data->OtherGrade."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function addEditUserEmployement($data) {

        $sql = "call usp_M_AddEditUserEmployement('" . $data->UserID . "','" .  
                                        $data->DesignationID . "','" .
                                        $data->OrganizationID . "','" . 
                                        $data->OrganizationOther . "','" . 
                                        $data->Location . "','" . 
                                        $data->Responsibilities . "','" . 
                                        $data->IsPresent . "','".
                                        $data->StartDate."','".
                                        $data->EndDate."','".
                                        $data->UserEmployementID."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function addEditUserProject($data) {

        $sql = "call usp_M_AddEditUserProject('" . $data->UserID . "','" .  
                                        $data->ProjectTitle . "','" .
                                        addslashes($data->ProjectDescription) . "','" . 
                                        addslashes($data->Achievements) . "','" . 
                                        $data->Client . "','" . 
                                        $data->StartedFrom . "','".
                                        $data->WorkedTill."','".
                                        $data->ProjectSite."','".
                                        $data->NatureOfEmployement."','".
                                        $data->TeamSize."','".
                                        $data->DesignationID."','".
                                        addslashes($data->DesignationDescription)."','".
                                        $data->UserProjectID."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    function get_emailtemplate($id){ 
        $sql = "call usp_W_GetEmailTemplateDetailByID('".$id."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row_array();
        
    }

    public function insertTransaction($order_id = '',$user_id = '',$payment_gross = '0',$payment_status = '',$type = '',$txn_id = '',$currency_code = ''){
        if(!empty($_POST)){
            $response = json_encode($_POST);
        }else{
            $response = '';
        }

        $IPAddress=GetIP();

        $query = "call usp_MA_AddPayment('$order_id', 
                                      '$user_id', 
                                      '$payment_gross', 
                                      '$payment_status',
                                      '$type',
                                      '$response',
                                      '$txn_id',
                                      '$currency_code');";
        $query = $this->db->query($query);
        $query->next_result();
        return $query->row();

    }

}