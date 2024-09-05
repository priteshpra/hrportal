<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

    function __construct() {

        parent::__construct();
        
        ini_set('upload_max_filesize', '60M');     
        ini_set('max_execution_time', '999');
        ini_set('memory_limit', '128M');
        ini_set('post_max_size', '60M'); 

        $this->load->model('api/master_model', '', TRUE);
        $this->load->helper('global');
        $this->load->helper("phpmailerautoload");
    }

    function index() {
    
        //error_reporting(E_ALL);
        header('Content-type: application/json');
        $data = file_get_contents('php://input');

        if ($data == null) {

            //$data = '{"method":"userSignup","body":{"FirstName":"FirstName","LastName":"LastName","EmailID":"real@gmail.com","CountryCode":"+91","MobileNo":"9876543221","Password":"123456", "NotificationToken":"345gf6gy54y4y456345", "DeviceUID":"123456","DeviceName":"iPhone","OSVersion":"7","DeviceType":"Candidate IOS"}}';
            //$data = '{"method":"userSocialMediaLogin","body":{"FirstName":"Name1","LastName":"Name2","RegistrationID":"7458923490","RegistrationType":"Facebook","EmailID":"_company@gmail.com","CountryCode":"+91","MobileNo":"9876543210","NotificationToken":"345gf6gy54y4y456345","DeviceUID":"123456","DeviceName":"iPhone","OSVersion":"7","DeviceType":"Candidate Android","PhotoURL":"","Gender":"Male"}}';
            //$data = '{"method":"generateOTP","body":{"UserID":"6"}}';
            //$data = '{"method":"checkOTPVerification","body":{"UserID":"6","OTP":"1234"}}';

            //$data = '{"method":"checkLogin","body":{"EmailID":"real@gmail.com","Password":"123456","NotificationToken":"345gf6gy54y4y456345","DeviceUID":"123456","DeviceName":"iPhone","OSVersion":"7","DeviceType":"IOS"}}';
            //$data = '{"method":"changePassword","body":{"UserID":"2","OldPassword":"123456","Password":"123456"}}';
            ////$data = '{"method":"forgotPassword","body":{"EmailID":"real@gmail.com"}}';
            //$data = '{"method":"resetPassword","body":{"EmailID":"shrimali@gmail.com"}}'; //'{"method":"resetPassword","body":{"EmailID":"kunden.saggisoftsolutions@gmail.com","Password":"123456"}}';
            ////$data = '{"method":"deleteAccount","body":{"iUserID":"2"}}';
            //$data = '{"method":"getCountry","body":{}}';
            //$data = '{"method":"getEthnicity","body":{}}';
            //$data = '{"method":"getStates","body":{"CountryID":"3"}}';
            //$data = '{"method":"getCities","body":{"StateID":"12"}}';
            //$data = '{"method":"getArea","body":{"CityID":"12"}}';
            //$data = '{"method":"getCurrency","body":{"CurrencyID":"12"}}';
            //$data = '{"method":"getCategory","body":{}}';
            //$data = '{"method":"getBanner","body":{}}';
            //$data = '{"method":"getConfig","body":{}}';
            //$data = '{"method":"getDepartment","body":{}}';
            //$data = '{"method":"getDesignation","body":{}}';
            //$data = '{"method":"getIndustryType","body":{}}';
            //$data = '{"method":"getQualification","body":{}}';
            //$data = '{"method":"getSkills","body":{}}';
            //$data = '{"method":"getLocation","body":{"CountryID":"1"}}';
            //$data = '{"method":"addJob","body":{"UserID":"19", "JobTitle":"JobTitle", "DetailsOfJob":"1","IndustryTypeID":"1", "DesignationID":"1",  "NatureOfEmployment":"Full Time", "NoOfVacancies":"5", "MinExperience":"1", "MaxExperience":"4", "MinSalary":"4000", "MaxSalary":"8000", "Skills":[{"ID":"1","Name":"skill"},{"ID":"0","Name":"skill2"}],"DesiredJobProfile":"UG","CityID":"Udaipur"}}';//NatureOfEmployment = 'Full Time','Part Time','Contractual'; Experience = in Year
            //$data = '{"method":"getJob", "body":{"PageSize":"12", "CurrentPage":"1", "DesignationID":"1","StartSalary":"4000", "EndSalary":"8000", "StartExperience":"2", "EndExperience":"4", "UserID":"6", "Type":"All"}}';//Type ('All','Apply','Saved','Recommended','NewJobs')
            // // $data = '{"method":"editJob", "body":{"UserID":"6", "JobPostID":"3","JobTitle":"JobTitle", "DetailsOfJob":"1", "IndustryTypeID":"1", "DesignationID":"1",  "NatureOfEmployment":"Full Time", "NoOfVacancies":"5", "MinExperience":"1", "MaxExperience":"4", "MinSalary":"4000", "MaxSalary":"8000", "Skills":[{"ID":"1", "Name":"skill"}, {"ID":"0", "Name":"skill2"}], "DesiredJobProfile":"UG", "CityID":"Udaipur"}}';//NatureOfEmployment = 'Full Time','Part Time','Contractual'; Experience = in Year
            //$data = '{"method":"applyJobByCandidate","body":{"UserID":"17","JobPostID":"3"}}';
            //$data = '{"method":"addCandidateShortlistedByCompnay","body":{"CandidateUserID":"2","UserID":"17","JobPostID":"3"}}';
            //$data = '{"method":"addCandidateInvitedByCompnay","body":{"CandidateUserID":"2","UserID":"17","JobPostID":"3","InterviewScheduledTime":"23:00:00","InterviewScheduledDate":"2017-02-15"}}';
            //$data = '{"method":"hiredCandidateByCompany","body":{"CandidateUserID":"2","UserID":"17","JobPostID":"3"}}';
            //$data = '{"method":"addViewJobByCandidate","body":{"UserID":"6","JobPostID":"3"}}';
            //$data = '{"method":"addSaveJobByCandidate","body":{"UserID":"6","JobPostID":"3","Status":"1"}}';
            //$data = '{"method":"getDashboard","body":{"UserID":"11"}}';    
            //$data = '{"method":"editCompany","body":{"UserID":"4","CompanyName":"saggi","FirstName":"Firstname","LastName":"lastname","Address":"1","CountryID":"1","StateID":"1","CityID":"1","DesignationID":"1","StatusText":"Have a good day.","WebsiteURL":"http://www.example.com","Latitude":"74.47","Longitude":"23.23","MobileNo":"9876543222"}}';
            //$data = '{"method":"editCandidate","body":{"UserID":"6","FirstName":"Firstname","LastName":"lastname","CityName":"Ahmedabad","Address":"1","Pincode":"1","PermenantAddress":"1","Experience":"1","Salary":"1","StatusText":"Have a good day.","BirthYear":"2017","Latitude":"74.47","Longitude":"23.23","MobileNo":"9876543222","Gender":"Male","IsPhysicalChallenged":"1","MaritualStatus":"1","ProfileSummary":"about me","CityName":"about me"}}';
            //$data = '{"method":"getProfileByID","body":{"UserID":"9"}}';
            //$data = '{"method":"getJobByCompany","body":{"PageSize":"10","CurrentPage":"1","UserID":"4","DesignationID":"1","StartSalary":"10000","EndSalary":"10000","SearchType":"All"}}'; //SearchType =All/Active
            //$data = '{"method":"deleteJob","body":{"JobPostID":"3"}}';
            //$data = '{"body":{"Status":1,"UserID":17,"CompanyUserID":19},"method":"followCompany"}';
            //$data = '{"method":"deleteUser","body":{"UserID":"2"}}';
            //$data = '{"method":"companyJobAction","body":{"CompanyJobActionID":"2","UserID":"1","Action":"1","CurrentState":"1"}}';
            //$data = '{"method":"addDevice","body":{"UserID":19,"NotificationToken":"eaPQdx8yhfI:APA91bGkZ5fRDZciTKRuXeK1eW5r02-1WhtBR_KsB19Jh2hLSFKSLQoeu8qNEZCVNEYxVszlR5qTu9HaEoN5n0Hnb60raNSeod2oGZ6BlPgRVR0jhLejUIL7jgeWrX9lpz-EUEbyOecY","DeviceName":"Samsung SM-J210F","OSVersion":"6.0.1","DeviceType":"Company Android","DeviceUID":"123456"}}';
            //$data = '{"method":"getfollower","body":{"PageSize":"10","CurrentPage":"1","UserID":"4"}}';
            //$data = '{"method":"getCandidateList","body":{"PageSize":"10","CurrentPage":"1","UserID":"4","SearchText":"dfd","Type":"All","JobPostID":"0"}}';
            //$data = '{"method":"getCandidateListByCompanyInvited", "body":{"PageSize":"10", "CurrentPage":"1", "UserID":"4", "SearchText":"dfd", "Type":"All"}}';
            //$data = '{"method":"addUserEmployeement","body":{"UserID":"6","DesignationID":"1","OrganizationID":"1","OrganizationOther":"Learning sodiety","IsPresent":"1","StartDate":"2017-10-10","EndDate":"2017-10-10"}}';
            //$data = '{"method":"editOthersCandidate","body":{"UserID":"6","IsPhysicalChallenged":"1","IsWorkPermit":"1","PermenantAddress":"surat gujrat","MaritualStatus":"1","Pincode":"313002","CityName":"Udaipur","Gender":"Male","AgeOfGroup":"1","BirthYear":"2017"}}';
            //$data = '{"method":"editBasicCandidate","body":{"UserID":"4","FirstName":"Name","LastName":"last","StatusText":"Whats up","CityID":"udaipur","IsExperience":"1","MobileNo":"987654005","Experience":"0","Salary":"0"}}';
            //$data = '{"method":"addEditLanguage","body":{"LanguageID":"-1","Language":"Hindi"}}';
            //$data = '{"method":"addEditUserCertificate","body":{"UserCertificateID":"0","UserID":"6","Description":"xyz"}}';
            //$data = '{"method":"addEditUserLanguage","body":{"UserLanguageID":"0","UserID":"6","Language":"xyz","IsRead":"1","IsWrite":"1","IsSpeak":"1"}}';
            //$data = '{"method":"addEditUserQualification","body":{"UserQualificationID":"0","UserID":"6","QualificationID":"0","NewQualification":"123123","YearOfPassing":"2017","University":"RTU","Specialization":"Computer","Grade":"first","Course":"MCA"}}';
            //$data = '{"method":"getCandidateListByApplyJob","body":{"PageSize":"10","CurrentPage":"1","JobPostID":"1","SearchText":"dfd"}}';
            //$data = '{"method":"getCandidateListByInvited","body":{"PageSize":"10","CurrentPage":"1","UserID":"1","SearchText":""}}';
            //$data = '{"method":"getCandidateListByShortlisted","body":{"PageSize":"10","CurrentPage":"1","UserID":"1","SearchText":""}}';
            //$data = '{"method":"getCandidateListByViewJob","body":{"PageSize":"10","CurrentPage":"1","JobPostID":"9","SearchText":"dfd"}}';
            //$data = '{"method":"getCandidateListBySavedJob","body":{"PageSize":"10","CurrentPage":"1","JobPostID":"8","SearchText":"dfd"}}';
            //$data = '{"method":"addEditUserProject", "body":{"UserID":"6","ProjectTitle":"TITLE", "ProjectDescription":"Desc","Client":"1", "StartedFrom":"2017-12-12", "WorkedTill":"2017-12-30", "ProjectSite":"Off Site", "NatureOfEmployement":"Full Time", "TeamSize":"500", "DesignationID":"1", "DesignationDescription":"Lead", "UserProjectID":"1"}}';
            //$data = '{"method":"deleteInformation","body":{"UserID":"6","Type":"Project","Status":"1","ID":"1"}}';
            //$data = '{"method":"addEditUserEmployement","body":{"UserID":"6","DesignationID":"1","OrganizationID":"1","OrganizationOther":"xyz","IsPresent":"1","StartDate":"2017-12-12","EndDate":"2017-12-12","UserEmployementID":"1","Location":"Location","Responsibilities":"Res"}}';
            //$data = '{"method":"addEditUserSkill","body":{"UserID":"6","Skills":[{"UserSkillID":"1","Name":"skill"},{"UserSkillID":"0","Name":"skill2"}]}}';
            //$data = '{"method":"editProfileSummary","body":{"UserID":"6","ProfileSummary":"yquewrtuter dskjgl"}}';
            //$data = '{"method":"addCompanyView","body":{"CompanyUserID":"4","CandidateUserID":"6"}}';
            //$data = '{"method":"getUserProjectByUserID","body":{"UserID":"6"}}';
            //$data = '{"method":"getUserEmployementByUserID","body":{"UserID":"6"}}';
            //$data = '{"method":"editCVHeadline","body":{"UserID":"6","CVHeadLine":"CV"}}';
            //$data = '{"method":"getCVData","body":{"UserID":"11","Type":"Other"}}';
            //$data = '{"method":"getNotification","body":{"PageSize":"12", "CurrentPage":"1","UserID":"6"}}';
            //$data = '{"method":"getMentor","body":{"PageSize":"12", "CurrentPage":"1"}}';
            //$data = '{"method":"getLanguage","body":{}}';
            //$data = '{"method":"getVideos","body":{"PageSize":"12", "CurrentPage":"1","MentorID":"12", "UserID":"1"}}';
            //$data = '{"method":"deleteCV","body":{"UserID":"26"}}';
            //$data = '{"method":"deletePic","body":{"UserID":"26"}}';
            //$data = '{"method":"updateJobStatus","body":{"JobPostID":"11","Status":"InActive"}}';//'New','Open','InActive','Closed'
            //$data = '{"method":"pushNotificationAccess","body":{"UserID":"11","Status":"0"}}';
            //$data = '{"method":"getCompanyByCandidateID","body":{"PageSize":"12", "CurrentPage":"1","UserID":"11"}}';

            //$data = '{"method":"editProfile","body":{"UserID":"55","Gender":"Male","BirthDate":"1988-10-04","AnniversaryDate":"1988-10-04","Address1":"Address One","Address2":"Address Two", "CityName":"Ahmedabad", "Latitude":"73663.21875", "Longitude":"53535.44140625" ,"StateId":"25", "CountryId":"99","PostCode":"380051", "CellPhone":"9812345678", "PhoneNumber":"9812345678", "ModifiedById":"1"}}';
            //$data = '{"method":"registerUser","body":{"CustomerName":"tet test","Password":"password","Email":"testing@test.com","Gender":"Male","Address1":"Address line One","Address2":"Address line two","CountryID":"99","StateID":"5","City":"Ahmedabad","Latitude":"23.251","Longitude":"25.251","vDeviceName":"tset", "vDeviceOS":"sdfasf", "vOSVersion":"dsd", "vDeviceTokenId":"dfadsf", "vRegType":"Facebook", "vRegId":"10206669848015545", "vPicUrl":"default.jpeg", "vFriendReferralCode" : "sdfWQe213" }}';
            //$data = '{"method":"getCandidateInterview","body":{"PageSize":"12", "CurrentPage":"1", "UserID":"17", "Type":"JobPost","Action":"Invited"}}';
            //$data = '{"method":"getReport","body":{"UserID":"12"}}';
            //$data = '{"method":"test","body":{}}';
            
       }
    
        if ($data != '') {
            $data = $this->checkvalidjson($data);
            $method = $data->method;
            $json = $data->body;
        } else {
            // $data3 = $this->input->post();
            // pr($data3);die;
            $method = $this->input->post('method');
            if($method == "addUploadPics"){
                $json = array(
                    'UserID'        => $this->input->post('UserID'),
                    'AccessType'    => $this->input->post('AccessType'), //Candidate,Company,CV
                    // ImageData
                );
            } else {
                $json = array(
                    'UserID' => $this->input->post('UserID'),
                    'UserType' => $this->input->post('UserType'),
                    'PictureType' => $this->input->post('PictureType'),
                );
            }
        }


        switch ($method) {
            case 'userSignup'                   : $res = $this->userSignup($json);                      break;
            case 'userSocialMediaLogin'         : $res = $this->userSocialMediaLogin($json);            break;   
            case 'generateOTP'                  : $res = $this->generateOTP($json);                     break;  
            case 'checkOTPVerification'         : $res = $this->checkOTPVerification($json);            break;
            case 'checkLogin'                   : $res = $this->checkLogin($json);                      break;   
            case 'changePassword'               : $res = $this->changePassword($json);                  break;  
            // case 'forgotPassword'               : $res = $this->forgotPassword($json);                break;
            case 'resetPassword'                : $res = $this->resetPassword($json);                   break;   
            case 'getCountry'                   : $res = $this->getCountry($json);                      break; 
            case 'getEthnicity'                 : $res = $this->getEthnicity($json);                    break; 
            case 'getStates'                    : $res = $this->getStates($json);                       break;   
            case 'getCities'                    : $res = $this->getCities($json);                       break; 
            case 'getArea'                      : $res = $this->getArea($json);                         break; 
            case 'getCurrency'                  : $res = $this->getCurrency($json);                     break;
            case 'getReport'                    : $res = $this->getReport($json);                       break; 
            case 'getCategory'                  : $res = $this->getCategory($json);                     break;
            case 'getBanner'                    : $res = $this->getBanner($json);                       break;  
            case 'getConfig'                    : $res = $this->getConfig($json);                       break;   
            case 'getSalary'                    : $res = $this->getSalary($json);                       break; 
            case 'getDepartment'                : $res = $this->getDepartment($json);                   break;    
            case 'getDesignation'               : $res = $this->getDesignation($json);                  break;     
            case 'getIndustryType'              : $res = $this->getIndustryType($json);                 break;    
            case 'getQualification'             : $res = $this->getQualification($json);                break;   
            case 'getSkills'                    : $res = $this->getSkills($json);                       break;
            case 'getLocation'                  : $res = $this->getLocation($json);                     break;
            case 'addJob'                       : $res = $this->addJob($json);                          break;
            case 'getJob'                       : $res = $this->getJob($json);                          break;
            //case 'editJob'                      : $res = $this->editJob($json);                         break;
            case 'applyJobByCandidate'          : $res = $this->applyJobByCandidate($json);             break;
            case 'addCandidateShortlistedByCompnay'
                                                : $res = $this->addCandidateShortlistedByCompnay($json);break;
            case 'addCandidateInvitedByCompnay' : $res = $this->addCandidateInvitedByCompnay($json);    break;
            case 'hiredCandidateByCompany'      : $res = $this->hiredCandidateByCompany($json);         break;
            case 'addViewJobByCandidate'        : $res = $this->addViewJobByCandidate($json);           break;
            case 'addSaveJobByCandidate'        : $res = $this->addSaveJobByCandidate($json);           break;
            case 'getDashboard'                 : $res = $this->getDashboard($json);                    break;
            case 'editCompany'                  : $res = $this->editCompany($json);                     break;
            case 'editCandidate'                : $res = $this->editCandidate($json);                   break;
            case 'getProfileByID'               : $res = $this->getProfileByID($json);                  break;
            case 'getJobByCompany'              : $res = $this->getJobByCompany($json);                 break;
            case 'deleteJob'                    : $res = $this->deleteJob($json);                       break;
            case 'deleteUser'                   : $res = $this->deleteUser($json);                      break;
            case 'companyJobAction'             : $res = $this->companyJobAction($json);                break;
            case 'followCompany'                : $res = $this->followCompany($json);                   break;
            case 'addDevice'                    : $res = $this->addDevice($json);                       break;
            case 'getfollower'                  : $res = $this->getfollower($json);                     break;
            case 'getCandidateList'             : $res = $this->getCandidateList($json);                break;
            case 'getCandidateListByCompanyInvited'        
                                                : $res = $this->getCandidateListByCompanyInvited($json);break;
            case 'addUserEmployeement'          : $res = $this->addUserEmployeement($json);             break;
            case 'editOthersCandidate'          : $res = $this->editOthersCandidate($json);             break;
            case 'editBasicCandidate'           : $res = $this->editBasicCandidate($json);              break;
            case 'addEditLanguage'              : $res = $this->addEditLanguage($json);                 break;
            case 'addEditUserCertificate'       : $res = $this->addEditUserCertificate($json);          break;
            case 'addEditUserLanguage'          : $res = $this->addEditUserLanguage($json);             break;
            case 'addEditUserQualification'     : $res = $this->addEditUserQualification($json);        break;
            case 'getCandidateListByApplyJob'   : $res = $this->getCandidateListByApplyJob($json);      break;
            case 'getCandidateListByInvited'    : $res = $this->getCandidateListByInvited($json);       break;
            case 'getCandidateListByShortlisted': $res = $this->getCandidateListByShortlisted($json);   break;
            case 'getCandidateListByViewJob'    : $res = $this->getCandidateListByViewJob($json);       break;
            case 'getCandidateListBySavedJob'   : $res = $this->getCandidateListBySavedJob($json);      break;
            case 'addEditUserProject'           : $res = $this->addEditUserProject($json);              break;
            case 'deleteInformation'            : $res = $this->deleteInformation($json);               break;
            case 'addEditUserEmployement'       : $res = $this->addEditUserEmployement($json);          break;
            case 'addEditUserSkill'             : $res = $this->addEditUserSkill($json);                break;
            case 'editProfileSummary'           : $res = $this->editProfileSummary($json);              break;
            case 'addCompanyView'               : $res = $this->addCompanyView($json);                  break;
            case 'getUserProjectByUserID'       : $res = $this->getUserProjectByUserID($json);          break;
            case 'getUserEmployementByUserID'   : $res = $this->getUserEmployementByUserID($json);      break;
            case 'editCVHeadline'               : $res = $this->editCVHeadline($json);                  break;
            case 'getCVData'                    : $res = $this->getCVData($json);                       break;
            case 'getNotification'              : $res = $this->getNotification($json);                 break;
            case 'getMentor'                    : $res = $this->getMentor($json);                       break;
            case 'getLanguage'                  : $res = $this->getLanguage($json);                     break;
            case 'getVideos'                    : $res = $this->getVideos($json);                       break;
            case 'updateJobStatus'              : $res = $this->updateJobStatus($json);                 break;
            case 'getCompanyByCandidateID'      : $res = $this->getCompanyByCandidateID($json);         break;
            case 'pushNotificationAccess'       : $res = $this->pushNotificationAccess($json);          break;
            case 'deleteCV'                     : $res = $this->deleteCV($json);                        break;
            case 'deletePic'                    : $res = $this->deletePic($json);                       break;
            case 'addUploadPics'                : $res = $this->addUploadPics($json);                   break;
            case 'getCandidateInterview'        : $res = $this->getCandidateInterview($json);           break;
            default                 : $res = array('default'=>array('Error'=>400, 'Message'=>'Service not found.')); break;
        }
        echo json_encode($res);exit;
    }

    function checkvalidjson($json) {
        $obj = json_decode(stripslashes($json), TRUE);

        if (is_null($obj)) {
            $response['error'] = 1;
            $response['data'] = "Invalid Json format";
            echo json_encode($response); exit();
        } else {
            $data = json_decode($json);
            return $data;
        }
    }

    function checkSocialLogin($data) {
        try{
            $response = array();
             if (!isset($data->Key) || $data->Key == ''){
                $response['Error'] = 102;
                $response['Message'] = 'Key not found.';
            }else{

            $data->EmailID = (!isset($data->EmailID) || @$data->EmailID=='') ? '' : $data->EmailID;
            $data->MobileNo = (!isset($data->MobileNo) || @$data->MobileNo=='') ? '' : $data->MobileNo;
                $_result = $this->master_model->getQueryResult("call usp_M_CheckSocialLogin('".$data->Key."','".$data->EmailID."','".$data->MobileNo."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'User listed successfully.';
                    $response['data'] = $_result;

                    $response['profile'] = $profile = array();
                    $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$_result[0]->UserID."','".base_url()."')");
                    $profile[0]->CVDate = '';
                    $mno_list = explode('-', $profile[0]->MobileNo);
                    $profile[0]->CountryCode='';
                    if(count($mno_list) >= 2){
                        $profile[0]->CountryCode=$mno_list[0];
                        $profile[0]->MobileNo=$mno_list[1];
                    }
                    if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                            //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                            $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                            if($lastModified == NULL)
                                $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                            $profile[0]->CVDate = date("d M Y",$lastModified);
                    }
                    $response['profile'] = $profile[0];

                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = '105';//($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('checkSocialLogin'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('checkSocialLogin'=>$response);
        }
    }

    function userSignup($data) {
        $response = array();

            //IN `_FirstName` VARCHAR(150), IN `_LastName` VARCHAR(150), IN `_OwnerName` VARCHAR(150), IN `_EmailID` VARCHAR(250), IN `_MobileNo` VARCHAR(13), IN `_DOB` VARCHAR(50), IN `_Gender` ENUM('Male','Female'), IN `_Password` VARCHAR(50), IN `_RegistrationType` ENUM('Regular','Facebook','Google','Linkedin','Twitter'), IN `_RegId` VARCHAR(50), IN `_ProfilePic` VARCHAR(200), IN `_path` VARCHAR(250), IN `_NotificationToken` TEXT, IN `_DeviceType` ENUM('Admin Web','Employee Web','Company Web','Mentor Web','Candidate Web','Admin Android','Employee Android','Company Android','Mentor Android','Candidate Android','Admin IOS','Employee IOS','Company IOS','Mentor IOS','Candidate IOS'), IN `_DeviceUID` VARCHAR(50), IN `_DeviceName` VARCHAR(50), IN `_DeviceOS` VARCHAR(20), IN `_OSVersion` VARCHAR(20), IN `_OTP` INT

        if (!isset($data->FirstName) || $data->FirstName == ''){
            $response['Error'] = 102;
            $response['Message'] = 'First name not found.';
        }else if (!isset($data->LastName) && $data->LastName == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Last name not found';
        }else if (!isset($data->Password) && $data->Password == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Password not found';
        } else if ((!isset($data->EmailID) && $data->EmailID == '') || (!isset($data->MobileNo) && $data->MobileNo == '')) {
            $response['Error'] = 102;
            $response['Message'] = 'Email and mobile not found';
        } else {


                $OTP = generateOTP();
                $add_user = $this->master_model->userSignup($data,$OTP);

                if ((isset($add_user['CandidateID']) && $add_user['CandidateID'] > 0) || (isset($add_user['CompanyID']) && $add_user['CompanyID'] > 0)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Add profile Successfully.';

                    // $profile['IsExperience'] = (@$add_user['IsExperience']) ? $add_user['IsExperience'] : '';
                    // unset($add_user['IsExperience']);
                    // $profile['CompanyName'] = (@$add_user['CompanyName']) ? $add_user['CompanyName'] : '';
                    // unset($add_user['CompanyName']);
                    // $profile['CompanyID'] = (@$add_user['CompanyID']) ? $add_user['CompanyID'] : '';
                    // unset($add_user['CompanyID']);
                    // $profile['FirstName'] = (@$add_user['FirstName']) ? $add_user['FirstName'] : '';
                    // unset($add_user['FirstName']);
                    // $profile['LastName'] = (@$add_user['LastName']) ? $add_user['LastName'] : '';
                    // unset($add_user['LastName']);
                    // $profile['Address'] = (@$add_user['Address']) ? $add_user['Address'] : '';
                    // unset($add_user['Address']);
                    // $profile['CountryID'] = (@$add_user['CountryID']) ? $add_user['CountryID'] : '';
                    // unset($add_user['CountryID']);
                    // $profile['StateID'] = (@$add_user['StateID']) ? $add_user['StateID'] : '';
                    // unset($add_user['StateID']);
                    // $profile['CityID'] = (@$add_user['CityID']) ? $add_user['CityID'] : '';
                    // unset($add_user['CityID']);
                    // $profile['CountryName'] = (@$add_user['CountryName']) ? $add_user['CountryName'] : '';
                    // unset($add_user['CountryName']);
                    // $profile['StateName'] = (@$add_user['StateName']) ? $add_user['StateName'] : '';
                    // unset($add_user['StateName']);
                    // $profile['CityName'] = (@$add_user['CityName']) ? $add_user['CityName'] : '';
                    // unset($add_user['CityName']);
                    // $profile['MobileNo'] = (@$add_user['MobileNo']) ? $add_user['MobileNo'] : '';
                    // unset($add_user['MobileNo']);
                    // $profile['Designation'] = (@$add_user['Designation']) ? $add_user['Designation'] : '';
                    // unset($add_user['Designation']);
                    // $profile['DesignationID'] = (@$add_user['DesignationID']) ? $add_user['DesignationID'] : '';
                    // unset($add_user['DesignationID']);
                    // $profile['StatusText'] = (@$add_user['StatusText']) ? $add_user['StatusText'] : '';
                    // unset($add_user['StatusText']);
                    // $profile['WebsiteURL'] = (@$add_user['WebsiteURL']) ? $add_user['WebsiteURL'] : '';
                    // unset($add_user['WebsiteURL']);
                    // $profile['CandidateID'] = (@$add_user['CandidateID']) ? $add_user['CandidateID'] : '';
                    // unset($add_user['CandidateID']);
                    // $profile['ProfilePic'] = (@$add_user['ProfilePic']) ? $add_user['ProfilePic'] : '';
                    // unset($add_user['ProfilePic']);
                    // $profile['CVPath'] = (@$add_user['CVPath']) ? $add_user['CVPath'] : '';
                    // unset($add_user['CVPath']);
                    // $profile['Pincode'] = (@$add_user['Pincode']) ? $add_user['Pincode'] : '';
                    // unset($add_user['Pincode']);
                    // $profile['PermenantAddress'] = (@$add_user['PermenantAddress']) ? $add_user['PermenantAddress'] : '';
                    // unset($add_user['PermenantAddress']);
                    // $profile['Experience'] = (@$add_user['Experience']) ? $add_user['Experience'] : '';
                    // unset($add_user['Experience']);
                    // $profile['Salary'] = (@$add_user['Salary']) ? $add_user['Salary'] : '';
                    // unset($add_user['Salary']);
                    // $profile['DOB'] = (@$add_user['DOB']) ? $add_user['DOB'] : '';
                    // unset($add_user['DOB']);
                    // $profile['Gender'] = (@$add_user['Gender']) ? $add_user['Gender'] : '';
                    // unset($add_user['Gender']);
                    // $profile['MaritualStatus'] = (@$add_user['MaritualStatus']) ? $add_user['MaritualStatus'] : '';
                    // unset($add_user['MaritualStatus']);
                    // $profile['StatusText'] = (@$add_user['StatusText']) ? $add_user['StatusText'] : '';
                    // unset($add_user['StatusText']);
                    // $profile['ProfileSummary'] = (@$add_user['ProfileSummary']) ? $add_user['ProfileSummary'] : '';
                    // unset($add_user['ProfileSummary']);
                    // // $profile['CertificationDescription'] = (@$add_user['CertificationDescription']) ? $add_user['CertificationDescription'] : '';
                    // // unset($add_user['CertificationDescription']);
                    // $profile['IsPhysicalChallenged'] = (@$add_user['IsPhysicalChallenged']) ? $add_user['IsPhysicalChallenged'] : '';
                    // unset($add_user['IsPhysicalChallenged']);
                    // $profile['OTP'] = (@$add_user['OTP']) ? $add_user['OTP'] : '';
                    // unset($add_user['OTP']);
                    // $profile['Latitude'] = (@$add_user['Latitude']) ? $add_user['Latitude'] : '';
                    // $profile['Longitude'] = (@$add_user['Longitude']) ? $add_user['Longitude'] : '';
                    // $profile['EmailID'] = (@$add_user['EmailID']) ? $add_user['EmailID'] : '';

                    $mno_list = explode('-', $add_user['MobileNo']);
                    $add_user['CountryCode']='';
                    if(count($mno_list) >= 2){
                        $add_user['CountryCode']=$mno_list[0];
                        $add_user['MobileNo']=$mno_list[1];
                    }
                    $response['data'] = $add_user;
                    // $response['profile'] = $profile;
                    $response['profile'] = $profile = array();
                    $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$add_user['UserID']."','".base_url()."')");
                    $profile[0]->CVDate ='';
                    $mno_list = explode('-', $profile[0]->MobileNo);
                    $profile[0]->CountryCode='';
                    if(count($mno_list) >= 2){
                        $profile[0]->CountryCode=$mno_list[0];
                        $profile[0]->MobileNo=$mno_list[1];
                    }

                    if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                            //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                            $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                            if($lastModified == NULL)
                                $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                            $profile[0]->CVDate = date("d M Y",$lastModified);
                    }
                    $response['profile'] = $profile[0];
                    // if(@$data->DeviceType!=''){
                    //     $activity_data = new stdClass();
                    //     $activity_data->MethodName='Api - customerSignup';
                    //     $activity_data->ActivityDescription='has signup';
                    //     $activity_data->UserID=$add_user['UserID'];
                    //     $activity_data->DeviceType=@$data->DeviceType;
                    //     $activity_data->IPAddress=@$data->IPAddress;
                    //     $activity_res = $this->master_model->addActivityLog($activity_data);
                    // }

                    //email otp functionality
                        $otp_email = $this->master_model->get_emailtemplate($id = 5);
                        $array['ToEmailID'] = $profile[0]->EmailID;
                        $array['Subject']  = $otp_email['EmailSubject'].' - '.$OTP;
                        $array['Body'] = $otp_email['Content']; 
                        $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
                        $array['FromName'] = DEFAULT_FROM_NAME;
                        $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
                        $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
                        $array['AltBody'] = '';  
                        $image_path = base_url().DEFAULT_EMAIL_IMAGE.'login-logo.png';  
                        $back_image_path = '';//base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';  
                        $startDate = time();  
                        $exp_date = date('Y-m-d H:i:s', strtotime('+1 day', $startDate));
                        $data1 = array('{WebsiteName}','{logo}','{name}','{otp}','{back_image}','{expiredate}');
                        $datavalue = array(DEFAULT_WEBSITE_TITLE,$image_path, $profile[0]->FirstName, $OTP,$back_image_path,$exp_date);
                        $array['Body'] = str_replace($data1, $datavalue, $array['Body']);
                        //pr($array['Body']);exit();
                        $val = CustomMail($array);
                        if($val == 0){
                            $msg = "";
                        }else{
                            $msg = label('new_otp_sent');
                            //return $msg;
                        }


                } else if (isset($add_user['Message']) && $add_user['Message']!='') {
                    $msg = explode('~',$add_user['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = $add_user;
                    // if(@$add_user['Customer_ID'] > 0 && ($data->DeviceType=='Admin Android' || $data->DeviceType=='Admin IOS' || $data->DeviceType=='Admin Web')){
                    //     $data->UserID = $add_user['Customer_ID'];
                    //     $list_customer = $this->master_model->getCustomersProfileByID($data);

                    //     $response['data'] = $list_customer[0];
                    // }
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Something went wrong.';
                }
        }
        return array('userSignup'=>$response);
    }

    function userSocialMediaLogin($data) {
        $response = array();
        if ((!isset($data->FirstName) || $data->FirstName == '') && (isset($data->DeviceType) && $data->DeviceType!='')  && (isset($data->EmailID) && @$data->EmailID!='')) {
            $response['Error'] = 102;
            $response['Message'] = 'First name not found';
        } else if ((!isset($data->LastName) || $data->LastName == '') && (isset($data->DeviceType) && $data->DeviceType!='')  && (isset($data->EmailID) && @$data->EmailID!='')) {
            $response['Error'] = 102;
            $response['Message'] = 'Last name not found';
        } else if (isset($data->RegistrationType) && $data->RegistrationType == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Registration Type not found';
        } else if (isset($data->RegistrationID) && $data->RegistrationID == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Social login key not found';
        } else {

            $data->EmailID = (!isset($data->EmailID) || @$data->EmailID=='') ? '' : $data->EmailID;
            $data->MobileNo = (!isset($data->MobileNo) || @$data->MobileNo=='') ? '' : $data->MobileNo;
            $data->DeviceType = (!isset($data->DeviceType) || @$data->DeviceType=='') ? '' : $data->DeviceType;
            $data->PhotoURL = (!isset($data->PhotoURL) || @$data->PhotoURL=='') ? '' : $data->PhotoURL;
            $_result = $this->master_model->getQueryResult("call usp_M_CheckSocialLogin('".$data->RegistrationID."','".$data->EmailID."','".$data->MobileNo."')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message) && (!isset($data->DeviceType) || @$data->DeviceType=='') && (!isset($data->EmailID) || @$data->EmailID=='')) {
                $response['Error'] = 200;
                $response['Message'] = 'User listed successfully.';
                $response['data'] = $_result;

                // $response['profile'] = $profile = array();
                // $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$_result[0]->UserID."','".base_url()."')");
                // $profile[0]->CVDate = '';
                // if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                //         //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                //         $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                //         if($lastModified == NULL)
                //             $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                //         $profile[0]->CVDate = date("d M Y",$lastModified);
                // }
                // $response['profile'] = $profile[0];

            }elseif((isset($data->DeviceType) && $data->DeviceType!='')  && (isset($data->EmailID) && @$data->EmailID!='')){

                //$pathMain       = COMPANYLOGO_UPLOAD_PATH;

                $file_name = '';
                if($data->RegistrationType=='Facebook' && $data->PhotoURL!=''){
                    $path_info = pathinfo($data->PhotoURL);
                    $extension = explode('?',@$path_info['extension']);
                    $file_name = (date('YmdHis').'.'.(@$extension[0] ? $extension[0] : 'jpg'));
                }
                if($data->RegistrationType=='LinkedIn' && $data->PhotoURL!=''){
                    $path_info = pathinfo($data->PhotoURL);
                    $file_name = date('YmdHis').'.'.(@$path_info['extension'] ? $path_info['extension'] : 'jpg');
                }
                if($data->RegistrationType=='Twitter' && $data->PhotoURL!=''){
                    $path_info = pathinfo($data->PhotoURL);
                    $file_name = date('YmdHis').'.'.(@$path_info['extension'] ? $path_info['extension'] : 'jpg');
                }
                if($data->RegistrationType=='Pinterest' && $data->PhotoURL!=''){
                    $path_info = pathinfo($data->PhotoURL);
                    $file_name = date('YmdHis').'.'.(@$path_info['extension'] ? $path_info['extension'] : 'jpg');
                }
                // if($data->RegistrationType=='Google' && $data->PhotoURL!=''){
                //     $path_info = pathinfo($data->PhotoURL);
                //     $file_name = date('YmdHis').'.'.$path_info['extension'];
                // }
                if($file_name!='' && $data->PhotoURL!='')
                if($data->DeviceType=='Candidate IOS' || $data->DeviceType=='Candidate Android'){
                    copy($data->PhotoURL, FCPATH.CANDIDATE_UPLOAD_PATH.$file_name);
                    copy($data->PhotoURL, FCPATH.CANDIDATE_THUMB_UPLOAD_PATH.$file_name);
                }elseif($data->DeviceType=='Company IOS' || $data->DeviceType=='Company Android'){
                    copy($data->PhotoURL, FCPATH.COMPANYLOGO_UPLOAD_PATH.$file_name);
                    copy($data->PhotoURL, FCPATH.COMPANYLOGO_THUMB_UPLOAD_PATH.$file_name);
                }
                   
                $data->file_name = $file_name;

                $_result = $this->master_model->userSocialMediaLogin($data);

            }
//             else{
// die('--3--');
//             }


            if (isset($_result['0']->UserID) && $_result['0']->UserID > 0) {
                $response['Error'] = 200;
                $response['Message'] = 'Add profile Successfully.';

                    $mno_list = explode('-', $_result[0]->MobileNo);
                    $_result[0]->CountryCode='';
                    if(count($mno_list) >= 2){
                        $_result[0]->CountryCode=$mno_list[0];
                        $_result[0]->MobileNo=$mno_list[1];
                    }
                $response['data'] = $_result[0];


                $response['profile'] = $profile = array();
                $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$_result[0]->UserID."','".base_url()."')");
                $profile[0]->CVDate = '';
                    $mno_list = explode('-', $profile[0]->MobileNo);
                    $profile[0]->CountryCode='';
                    if(count($mno_list) >= 2){
                        $profile[0]->CountryCode=$mno_list[0];
                        $profile[0]->MobileNo=$mno_list[1];
                    }
                if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                        //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                        $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                        if($lastModified == NULL)
                            $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                        $profile[0]->CVDate = date("d M Y",$lastModified);
                }
                $response['profile'] = $profile[0];

                // if(@$data->DeviceType!=''){
                //     $activity_data = new stdClass();
                //     $activity_data->MethodName='Api - userSocialMediaLogin';
                //     $activity_data->ActivityDescription='has social media login';
                //     $activity_data->UserID=$_result['0']->UserID;
                //     $activity_data->DeviceType=@$data->DeviceType;
                //     $activity_data->IPAddress=@$data->IPAddress;
                //     $activity_res = $this->master_model->addActivityLog($activity_data);
                // }
            } else if (isset($_result['0']->Message)) {
                $msg = explode('~',$_result['0']->Message);
                $response['Error'] = ($msg[1]=='Your account is deleted please contact admin.') ? (($msg[0]) ? $msg[0] : '103') : '105';//($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = $_result;
            } else {
                $response['Error'] = 2;
                $response['Message'] = 'Something went wrong.';
            }
        }
        return array('userSocialMediaLogin'=>$response);
    }

    function checkOTPVerification($data) {
        $response = array();
        if (!isset($data->UserID) || $data->UserID == '') {
            $response[' ']['Error'] = 102;
            $response['checkOTPVerification']['Message'] = 'User Name is not found';
        } else if (isset($data->OTP) && $data->OTP == '') {
            $response['checkOTPVerification']['Error'] = 102;
            $response['checkOTPVerification']['Message'] = 'OTP not found';
        } else {
            
            $update_result = $this->master_model->checkOTPVerification($data);
            if (isset($update_result[0]->Status) && $update_result[0]->Status > 0) {
                $response['checkOTPVerification']['Error'] = 200;
                $response['checkOTPVerification']['Message'] = 'OTP verified successfully.';
                $response['checkOTPVerification']['data'] = $update_result;
            } 
            else if (isset($update_result[0]->Message)) {
                $msg = explode('~',$update_result[0]->Message);
                $response['checkOTPVerification']['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['checkOTPVerification']['Message'] = @$msg[1];
            }
            else
            {
                $response['checkOTPVerification']['Error'] = 104;
                $response['checkOTPVerification']['Message'] = 'Something went wrong.';
            }
        }
        echo json_encode($response);
        exit();
    }

    function generateOTP($data) {
        $response = array();
        if (!isset($data->UserID) || $data->UserID == '') {
            $response['generateOTP']['Error'] = 102;
            $response['generateOTP']['Message'] = 'User Name is not found';
        }  else {
            $OTP = generateOTP();
            $update_result = $this->master_model->generateOTP($data,$OTP);
            /*if (isset($update_result[0]->NewOTP) && $update_result[0]->NewOTP > 0) {
                $response['generateOTP']['Error'] = 0;
                $response['generateOTP']['Message'] = 'OTP regenerated successfully.';
                $response['generateOTP']['data'] = $update_result;
            } 
            else*/ if (isset($update_result[0]->Message)) {
                $msg = explode('~',$update_result[0]->Message);
                $response['generateOTP']['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['generateOTP']['Message'] = $msg[1];
                $response['generateOTP']['OTP'] = @$update_result[0]->OTP;
                $response['generateOTP']['data']['OTP'] = @$update_result[0]->OTP;
                $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$data->UserID."','".base_url()."')");
                        
                    //email otp functionality
                        $otp_email = $this->master_model->get_emailtemplate($id = 5);
                        $array['ToEmailID'] = $profile[0]->EmailID;
                        $array['Subject']  = $otp_email['EmailSubject'].' - '.$OTP;
                        $array['Body'] = $otp_email['Content']; 
                        $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
                        $array['FromName'] = DEFAULT_FROM_NAME;
                        $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
                        $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
                        $array['AltBody'] = '';  
                        $image_path = base_url().DEFAULT_EMAIL_IMAGE.'login-logo.png';  
                        $back_image_path = '';//base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';           
                        $data1 = array('{WebsiteName}','{logo}','{name}','{otp}','{back_image}','{expiredate}');

                        $startDate = time();
                        $exp_date = date('Y-m-d H:i:s', strtotime('+1 day', $startDate));
                        $datavalue = array(DEFAULT_WEBSITE_TITLE,$image_path, $profile[0]->FirstName, $OTP,$back_image_path,  $exp_date);
                        $array['Body'] = str_replace($data1, $datavalue, $array['Body']);
                        //pr($array['Body']);exit();
                        $val = CustomMail($array);
                        if($val == 0){
                            //return label('new_otp_sent');
                        }else{
                            $msg = label('new_otp_sent');
                            //return $msg;
                        }
            }
            else
            {
                $response['generateOTP']['Error'] = 104;
                $response['generateOTP']['Message'] = 'Something went wrong.';
            }
        }
        return $response;
        //echo json_encode($response);exit();
    }

    function checkLogin($data) {
        $response = array();
        if (@$data->EmailID == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Email or mobile not found';
        } else if ($data->Password == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Password not found';
        } else {


        if(!isset($data->NotificationToken)) $data->NotificationToken='';
        if(!isset($data->DeviceUID)) $data->DeviceUID='';
        if(!isset($data->DeviceName)) $data->DeviceName='';
        if(!isset($data->OSVersion)) $data->OSVersion='';
        if(!isset($data->DeviceType)) $data->DeviceType='';

            //echo "call usp_M_CheckLogin('".$data->EmailID."','".fnEncrypt($data->Password)."','".base_url().'assets/uploads/company/'."','".$data->NotificationToken."','".$data->DeviceUID."','".$data->DeviceName."','".$data->OSName."','".$data->DeviceType."')";
            $_result = $this->master_model->getQueryResult("call usp_M_CheckLogin('".$data->EmailID."','".fnEncrypt($data->Password)."','".base_url().'assets/uploads/company/'."','".$data->NotificationToken."','".$data->DeviceUID."','".$data->DeviceName."','".$data->OSVersion."','".$data->DeviceType."')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = 'Login Successful.';

            $add_user = (array) $_result[0];
            
                    

                $response['data'] = $add_user;
                // $response['profile'] = $profile;

                    $response['profile'] = $profile = array();
                    $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$add_user['UserID']."','".base_url()."')");
                    $profile[0]->CVDate ='';
                    
                    $profile[0]->CountryCode='';
                    $profile[0]->MobileNo = (isset($profile[0]->MobileNo) ? $profile[0]->MobileNo : '');
                    if($profile[0]->MobileNo!=''){
                        $mno_list = explode('-', $profile[0]->MobileNo);
                        if(count($mno_list) >= 2){
                            $profile[0]->CountryCode=$mno_list[0];
                            $profile[0]->MobileNo=$mno_list[1];
                        }
                    }
                    if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                            //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                            $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                            if($lastModified == NULL)
                                $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                            $profile[0]->CVDate = date("d M Y",$lastModified);
                    }
                    $response['profile'] = $profile[0];

            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0] && $msg[0]!=0) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();//$_result;
            } else {
                $response['Error'] = 104;
                $response['Message'] = 'Error has been occurred please try again later.';
            }
        }
        return array('checkLogin'=>$response);
    }

    // Change password for all type of user
    function changePassword($data) {
        try{
            $response = array();    
            if (@$data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found.';
            } 
            elseif (@$data->OldPassword == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Old Password not found.';
            }
            elseif (@$data->Password == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Password not found.';
            } else {            
                $_result = $this->master_model->getQueryResult("call usp_M_ChangePassword('".$data->UserID."','".fnEncrypt($data->OldPassword)."','".fnEncrypt($data->Password)."')");

                if (isset($_result[0]->Message)) {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Something went wrong.';
                } 
            }       
            return array('changePassword'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('changePassword'=>$response);
        }
    }

    // Change password for all type of user
    function resetPassword($data) {
        try{
            $response = array();    
            if (@$data->EmailID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Email not found.';
            // }
            // elseif (@$data->Password == '') {
                // $response['Error'] = 102;
                // $response['Message'] = 'Password not found.';
            } else { 
                $Password = generateRandomString();
                @$data->Type = ((isset($data->Type) && $data->Type!='') ? $data->Type : 'Mobile');          
                $_result = $this->master_model->getQueryResult("call usp_M_ResetPassword('".$data->EmailID."','".fnEncrypt($Password)."','".$data->Type."')");

                if (isset($_result[0]->Message)) {
                        $msg = $_result[0]->Message;
                    // Send mail End
                        $otp_email = $this->master_model->get_emailtemplate($id = 6);
                        $array['ToEmailID'] = $data->EmailID;
                        $array['Subject']  = $otp_email['EmailSubject'];
                        $array['Body'] = $otp_email['Content']; 
                        $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
                        $array['FromName'] = DEFAULT_FROM_NAME;
                        $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
                        $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
                        $array['AltBody'] = '';

                        $image_path = base_url().DEFAULT_EMAIL_IMAGE.'login-logo.png';  
                        $back_image_path = '';//base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';           
                        $data = array('{WebsiteName}','{logo}','{name}','{password}','{back_image}');
                        $datavalue = array(DEFAULT_WEBSITE_TITLE,$image_path,@$data->EmailID,$Password,$back_image_path);
                        $array['Body'] = str_replace($data, $datavalue, $array['Body']);
                        //pr($array['Body']);exit();
                        $val = CustomMail($array);
                        if($val == 0){
                            //return label('new_otp_sent');
                        }else{
                            $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['Message'] = $msg[1];
                        }
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Something went wrong.';
                } 
            }       
            return array('resetPassword'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('resetPassword'=>$response);
        }
    }

    // Forgot password for all type of user
    function forgotPassword($data) {
        try{
            $response = array();
            if (@$data->EmailID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Email or mobile not found';
            } 
            else 
            {                    
               
                $random_string = str_replace('=','',base64_encode(date('dHs')));
                $data->random_string = $random_string;
                $forgot_password_result = $this->master_model->getQueryResult("call usp_M_ForgotPassword('".$data->EmailID."')");
    
                if (isset($forgot_password_result['UserID']) && $forgot_password_result['UserID'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = 'New password has send to your registered email id.';
                    $response['data'] = $forgot_password_result;

                    /* It is remaining ::
                    $email_details = $this->email_template_model->getEmailTemplateDetailsByEmailTemplateTitle('reset_password_email');
                    $search_array = array('##RESET_PASSWORD_LINK##');                
                    $replace_array = array($data->reset_password_link);
                    $body = str_replace($search_array, $replace_array, $email_details['Content']);
                    sendEmail($data->email_id), $email_details->EmailSubject,$body);*/
                }
                elseif (isset($forgot_password_result['UserID']) && $forgot_password_result['UserID'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = 'New password has send to your registered email id.';
                    $response['data'] = $forgot_password_result;
                    $response['password_data'] = $data;
                    /* It is remaining ::
                    $email_details = $this->email_template_model->getEmailTemplateDetailsByEmailTemplateTitle('reset_password_email');
                    $search_array = array('##RESET_PASSWORD_LINK##');                
                    $replace_array = array($data->reset_password_link);
                    $body = str_replace($search_array, $replace_array, $email_details['Content']);
                    sendEmail($data->email_id), $email_details->EmailSubject,$body);*/
                }
                elseif (isset($forgot_password_result['Message'])) {
                    $msg = explode('~',$forgot_password_result['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    //$response['employeeForgotPassword']['data'] = $forgot_password_result;
                } 
                else
                {
                    $response['Error'] = 104;
                    $response['Message'] = 'Something went wrong.';
                }
            }
            return array('forgotPassword'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('forgotPassword'=>$response);
        }
    }

    function getCountry($data) {
        try{
            $response = array();
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetCountry()");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Country listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            return array('getCountry'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCountry'=>$response);
        }
    }

    function getEthnicity($data) {
        try{
            $response = array();
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetEthnicity()");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $result_data = array();
                    foreach ($_result as $val) {
                        if(empty($result_data[$val->EthnicityID]) && $val->ParentID==0)
                            $result_data[$val->EthnicityID] = (array)$val;
                        elseif($val->ParentID!=0)
                            $result_data[$val->ParentID]['Ethnicity'][] = $val; 
                    }
                    $_result = array();
                    foreach ($result_data as $_val) {
                        $_result[] = $_val;
                    }
                    $response['Error'] = 200;
                    $response['Message'] = 'Ethnicity listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            return array('getEthnicity'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getEthnicity'=>$response);
        }
    }

    function getStates($data) {
        try{
            $response = array();
                
            if (@$data->CountryID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Country not found';
            } else { 
                $_result = $this->master_model->getQueryResult("call usp_M_GetState('".$data->CountryID."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'State listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getStates'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getStates'=>$response);
        }
    }

    function getCities($data) {
        try{
            $response = array();
                
            if (@$data->StateID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'State not found';
            } else { 
                $_result = $this->master_model->getQueryResult("call usp_M_GetCity('".$data->StateID."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Cities listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getCities'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCities'=>$response);
        }
    }

    function getArea($data) {
        try{
            $response = array();
                
            if (@$data->CityID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'City not found';
            } else { 
                $_result = $this->master_model->getQueryResult("call usp_M_GetArea('".$data->CityID."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Area listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getArea'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getArea'=>$response);
        }
    }

    function getCurrency($data) {
        try{
            $response = array();
                
            if (@$data->CurrencyID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Currency not found';
            } else { 
                $_result = $this->master_model->getQueryResult("call usp_M_GetCurrency('".$data->CurrencyID."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Currency listed successfully.';
                    $response['data'] = $_result['0'];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getCurrency'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCurrency'=>$response);
        }
    }

    function getReport($data) {
        try{
            $response = array();
                
            if (@$data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            } else { 
                $_result = $this->master_model->getQueryResult("call usp_M_GetReport('".$data->UserID."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Report listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getReport'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getReport'=>$response);
        }
    }

    function getCategory($data) {
        try{
            $response = array();
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetCategory('".base_url()."assets/uploads/category/')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Category listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }

            return array('getCategory'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCategory'=>$response);
        }
    }

    function getBanner($data) {
        try{
            $response = array();
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetBanner('".base_url()."assets/uploads/banner/','".base_url()."assets/uploads/banner/mobile/')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Banner listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }

            return array('getBanner'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getBanner'=>$response);
        }
    }

    function getConfig($data) {
        try{
            $response = array();
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetConfig()");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Get config successfully.';
                    $response['data'] = $_result[0];
                    
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }

            return array('getConfig'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getConfig'=>$response);
        }
    }

    function getSalary($data) {
        try{
            $response = array();
                
                foreach (unserialize(SALARY_FORM) as $key => $value) {
                    $list = explode('~', $value);
                    if(!empty($list))
                    $salary[] =array('Title'=>@$list[0],'Min'=>@$list[1],'Max'=>@$list[2]);
                }

                if (isset($salary) && !empty($salary)) {
                    $response['Error'] = '200';
                    $response['Message'] = 'Get salary successfully.';
                    $response['data'] = $salary;
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Salary range not found.';
                }

            return array('getSalary'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getSalary'=>$response);
        }
    }

    function getDepartment($data) {
        try{
            $response = array();
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetDepartment()");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Department listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }

            return array('getDepartment'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getDepartment'=>$response);
        }
    }

    function getDesignation($data) {
        try{
            $response = array();
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetDesignation()");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Designation listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }

            return array('getDesignation'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getDesignation'=>$response);
        }
    }

    function getIndustryType($data) {
        try{
            $response = array();
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetIndustryType()");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Industry type listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }

            return array('getIndustryType'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getIndustryType'=>$response);
        }
    }

    function getQualification($data) {
        try{
            $response = array();
                
                $_result = $this->master_model->getQueryResult("call usp_M_Qualification()");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Qualification listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }

            return array('getQualification'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getQualification'=>$response);
        }
    }

    function getSkills($data) {
        try{
            $response = array();
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetSkills()");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Skill listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }

            return array('getSkills'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getSkills'=>$response);
        }
    }

    function getLocation($data) {
        try{
            $response = array();
                
            // if (@$data->CountryID == '') {
            //     $response['Error'] = 102;
            //     $response['Message'] = 'Country not found';
            // } else { 
                if (@$data->CountryID == '') { @$data->CountryID = 230; }
                $_result = $this->master_model->getQueryResult("call usp_M_GetLocation('".$data->CountryID."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
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
                    $_result = array();
                    foreach ($list as $value) {
                        $_result[] = $value;
                    }

                    $response['Error'] = 200;
                    $response['Message'] = 'Location listed successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            // }
            return array('getLocation'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getLocation'=>$response);
        }
    }

    function addJob($data) {
        try{
        $response = array();

        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        }else if (!isset($data->JobTitle) && $data->JobTitle == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Job title not found';
        }else if (!isset($data->DetailsOfJob) && $data->DetailsOfJob == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Job detail not found';
        } else if (!isset($data->IndustryType) && $data->IndustryType == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Industry type not found';
        } else if (!isset($data->Designation) && $data->Designation == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Designation not found';
        // } else if (!isset($data->DepartmentID) && $data->DepartmentID == '') {
        //     $response['Error'] = 102;
        //     $response['Message'] = 'Department not found';
        } else if (!isset($data->NatureOfEmployment) && $data->NatureOfEmployment == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Nature of employment not found';
        } else if (!isset($data->NoOfVacancies) && $data->NoOfVacancies == '') {
            $response['Error'] = 102;
            $response['Message'] = 'No of vacancies not found';
        } else if (!isset($data->MinExperience) && $data->MinExperience == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Min experience not found';
        } else if (!isset($data->MaxExperience) && $data->MaxExperience == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Max experience not found';
        } else {

                $data->DepartmentID = (!isset($data->DepartmentID)) ? '0' : $data->DepartmentID;
                $data->MinSalary = (!isset($data->MinSalary)) ? '0' : $data->MinSalary;
                $data->MaxSalary = (!isset($data->MaxSalary)) ? '0' : $data->MaxSalary;
                $data->DesiredJobProfile = (!isset($data->DesiredJobProfile)) ? '' : $data->DesiredJobProfile;
                $data->CityID = (!isset($data->CityID)) ? '' : $data->CityID;

                $IndustryType_data = $this->master_model->getQueryResult("call usp_M_AddGetIndustryType('".$data->IndustryType."','".$data->UserID."')");
                $Designation_data = $this->master_model->getQueryResult("call usp_M_AddGetDesignation('".$data->Designation."','".$data->UserID."')");

                $data->IndustryTypeID =$IndustryType_data[0]->ID;
                $data->DesignationID =$Designation_data[0]->ID;

                if (isset($data->JobPostID) && $data->JobPostID > 0){
                    $_result = $this->master_model->editJob($data);
                    if(isset($_result['Skills']))
                    $_result['Skills'] = (json_decode($_result['Skills'], true));
                }else{
                    $_result = $this->master_model->addJob($data);
                }
                

                    
                if (isset($_result['JobPostID']) && $_result['JobPostID'] > 0) {

                    $jobremove = $this->master_model->getQueryResult("call usp_M_DelelteJobSkills('".$_result['JobPostID']."')");

                    foreach ($data->Skills as $k => $val) {

                        if((!isset($val->ID) || $val->ID=='' || $val->ID=='0') && $val->Name!=''){
                            $val->ID=0;
                            $job_skill[] = $this->master_model->getQueryResult("call usp_M_AddSkillForJob('".$_result['JobPostID']."','".$val->Name."','".$val->ID."','".$data->UserID."')");
                        }elseif(isset($val->ID) && $val->ID > 0){
                            $job_skill[] = $this->master_model->getQueryResult("call usp_M_AddSkillForJob('".$_result['JobPostID']."','','".$val->ID."','".$data->UserID."')");
                        }

                    }

                    $job_data = $this->master_model->getQueryResult("call usp_M_GetJobByID('".$_result['JobPostID']."','".base_url()."','".$data->UserID."')");
                    
                    $job_data[0]->Skills = (json_decode($job_data[0]->Skills, true));

                    $response['Error'] = 200;
                    if (isset($data->JobPostID) && $data->JobPostID > 0){
                        $response['Message'] = 'Edit job successfully.';
                    }else{
                        $response['Message'] = 'Add job Successfully.';

                        $notifiUser = $this->master_model->getQueryResult("call usp_M_GetCandidateIDByJobPostID('".$_result['JobPostID']."')");
                        
                        if(isset($notifiUser) && !empty($notifiUser) && !isset($notifiUser['0']->Message)) {
                        foreach ($notifiUser as $u_val) {
                            
                            $addNotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('".$u_val->UserID."','".$notifiUser['0']->Description."','".$data->UserID."','".$_result['JobPostID']."','JobPost','0')");

                            $device = $this->master_model->getInlineQuery("SELECT DeviceTokenID FROM ssc_deviceinfo WHERE UserID = '".$u_val->UserID."'");
                            foreach ($device as $k => $val) {
                                if(@$val->DeviceTokenID!='' && @$notifiUser['0']->Description!=''){

    /* SQL
                    SET @Description = ( SELECT Fn_A_GetMessage(@ActionType) as aa);
                    IF(IFNULL(@Description,'') != '') THEN
                    SET @notify = (SELECT Fn_A_AddNotification(_UserID,@Description,_UserID,_ID,@ActionType,'0'));
    */
                                    //$job_data = array();
                                    $pushNotificationArr = array('device_id'=>$val->DeviceTokenID,
                                            'message'=>$notifiUser['0']->Description,
                                            'title'=>DEFAULT_WEBSITE_TITLE,
                                            'detail'=>array('UserID'=>$data->UserID,
                                                            'VideoID'=>'',
                                                            'CompanyID'=>'',
                                                            'JobPostID'=>$_result['JobPostID'],
                                                            'ActionType'=>'JobPost',
                                                            'Detail'=>$job_data[0]
                                                )
                                        );
                                    $res = sendPushNotification($pushNotificationArr);       
                                }
                            }
                        }
                        }

                    }

                    $response['data'] = $job_data[0];//$_result;

                } else if (isset($_result['Message']) && $_result['Message']!='') {
                    $msg = explode('~',$_result['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Something went wrong.';
                }
        }
        return array('addJob'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addJob'=>$response);
        }
    }

    function getJob($data) {
        try{
            $response = array();
            
                $_result = $this->master_model->getJob($data);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Job listed successfully.';
                    //$list = array();
                    foreach ($_result as $k => $val) {
                        $_result[$k]->Skills = (json_decode($_result[$k]->Skills, true));
                        //if(empty($_result[$k]->Skills)){ $_result[$k]->Skills = array(); }
                        $mno_list = array();
                        $mno_list = explode('-', $_result[$k]->MobileNo);
                        $_result[$k]->CountryCode='';
                        if(count($mno_list) >= 2){
                            $_result[$k]->CountryCode=$mno_list[0];
                            $_result[$k]->MobileNo=$mno_list[1];
                        }
                    }


                    $response['data'] = $_result;
                    $response['advertisement'] = $this->getAdvertisement();
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            
            return array('getJob'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getJob'=>$response);
        }
    }

    // function editJob($data) {
    //     try{
    //     $response = array();

    //     if (!isset($data->JobPostID) || $data->JobPostID == ''){
    //         $response['Error'] = 102;
    //         $response['Message'] = 'Job not found.';
    //     }else if (!isset($data->UserID) && $data->UserID == '') {
    //         $response['Error'] = 102;
    //         $response['Message'] = 'User not found';
    //     }else if (!isset($data->JobTitle) && $data->JobTitle == '') {
    //         $response['Error'] = 102;
    //         $response['Message'] = 'Job title not found';
    //     }else if (!isset($data->DetailsOfJob) && $data->DetailsOfJob == '') {
    //         $response['Error'] = 102;
    //         $response['Message'] = 'Job detail not found';
    //     } else if (!isset($data->IndustryTypeID) && $data->IndustryTypeID == '') {
    //         $response['Error'] = 102;
    //         $response['Message'] = 'Industry type not found';
    //     } else if (!isset($data->DesignationID) && $data->DesignationID == '') {
    //         $response['Error'] = 102;
    //         $response['Message'] = 'Designation not found';
    //     // } else if (!isset($data->DepartmentID) && $data->DepartmentID == '') {
    //     //     $response['Error'] = 102;
    //     //     $response['Message'] = 'Department not found';
    //     } else if (!isset($data->NatureOfEmployment) && $data->NatureOfEmployment == '') {
    //         $response['Error'] = 102;
    //         $response['Message'] = 'Nature of employment not found';
    //     } else if (!isset($data->NoOfVacancies) && $data->NoOfVacancies == '') {
    //         $response['Error'] = 102;
    //         $response['Message'] = 'No of vacancies not found';
    //     } else if (!isset($data->MinExperience) && $data->MinExperience == '') {
    //         $response['Error'] = 102;
    //         $response['Message'] = 'Min experience not found';
    //     } else if (!isset($data->MaxExperience) && $data->MaxExperience == '') {
    //         $response['Error'] = 102;
    //         $response['Message'] = 'Max experience not found';
    //     } else {

    //             $data->DepartmentID = (!isset($data->DepartmentID)) ? '0' : $data->DepartmentID;
    //             $data->MinSalary = (!isset($data->MinSalary)) ? '0' : $data->MinSalary;
    //             $data->MaxSalary = (!isset($data->MaxSalary)) ? '0' : $data->MaxSalary;
    //             $data->DesiredJobProfile = (!isset($data->DesiredJobProfile)) ? '' : $data->DesiredJobProfile;
    //             $data->CityID = (!isset($data->CityID)) ? '' : $data->CityID;

    //             $_result = $this->master_model->editJob($data);

    //             if (isset($_result['JobPostID']) && $_result['JobPostID'] > 0) {
    //                 $response['Error'] = 200;
    //                 $response['Message'] = 'Edit job successfully.';
    //                 $jobremove = $this->master_model->getQueryResult("call usp_M_DelelteJobSkills('".$_result['JobPostID']."')");
    //                 foreach ($data->Skills as $k => $val) {

    //                     if(isset($val->ID) && $val->ID!='' && $val->ID==0){
    //                         $job_skill[] = $this->master_model->getQueryResult("call usp_M_AddSkillForJob('".$_result['JobPostID']."','".$val->Name."','".$val->ID."','".$data->UserID."')");
    //                     }elseif(isset($val->ID) && $val->ID > 0){
    //                         $job_skill[] = $this->master_model->getQueryResult("call usp_M_AddSkillForJob('".$_result['JobPostID']."','','".$val->ID."','".$data->UserID."')");
    //                     }

    //                 }
    //                 $response['data'] = $_result;

    //             } else if (isset($_result['Message']) && $_result['Message']!='') {
    //                 $msg = explode('~',$_result['Message']);
    //                 $response['Error'] = ($msg[0]) ? $msg[0] : '103';
    //                 $response['Message'] = $msg[1];
    //                 $response['data'] = array();
    //             } else {
    //                 $response['Error'] = 104;
    //                 $response['Message'] = 'Something went wrong.';
    //             }
    //     }
    //     return array('editJob'=>$response);
    //     } catch(Exception $e){
    //         $response['Error'] = 104;
    //         $response['Message'] = 'Something went wrong.';
    //         return array('editJob'=>$response);
    //     }
    // }

    function applyJobByCandidate($data) {
        try{
            $response = array();
            
            if (!isset($data->JobPostID) || $data->JobPostID == ''){
                $response['Error'] = 102;
                $response['Message'] = 'Job not found.';
            }else if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else {   

                $list = explode(',', $data->JobPostID);
                foreach ($list as $k => $val) {
                    if($val!='' && $val > 0){
                        $resp_success = $this->master_model->getQueryResult("call usp_M_ApplyJob('".$val."','".$data->UserID."')");

                        if (isset($resp_success) && !empty($resp_success) && !isset($resp_success['0']->Message)) {
                            $_result[] = $resp_success['0'];


                            $device = $this->master_model->getInlineQuery("SELECT di.DeviceTokenID FROM ssc_deviceinfo di INNER JOIN ssc_companyuser CU ON (CU.UserID = di.UserID AND CU.IsOwner = 1) INNER JOIN ssc_jobpost jp ON jp.UserID=CU.CompanyID WHERE jp.JobPostID = '".$data->JobPostID."'");
                            
                            foreach ($device as $k => $val) {
                                if(@$val->DeviceTokenID!='' && @$resp_success['0']->Description!=''){

                                    /* SQL
                                        SET @Description = ( SELECT Fn_A_GetMessage(@ActionType) as aa);
                                        IF(IFNULL(@Description,'') != '') THEN
                                        SET @notify = (SELECT Fn_A_AddNotification(_UserID,@Description,_UserID,_ID,@ActionType,'0'));
                                    */
                                
                                    //$job_data = array();
                                    $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$data->UserID."','".base_url()."')");
                                    $profile[0]->CVDate ='';
                                        $mno_list = explode('-', $profile[0]->MobileNo);
                                        $profile[0]->CountryCode='';
                                        if(count($mno_list) >= 2){
                                            $profile[0]->CountryCode=$mno_list[0];
                                            $profile[0]->MobileNo=$mno_list[1];
                                        }
                                    if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                                            //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                                            $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                                            if($lastModified == NULL)
                                                $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                                            $profile[0]->CVDate = date("d M Y",$lastModified);
                                    }

                                    $pushNotificationArr = array('device_id'=>$val->DeviceTokenID,
                                            'message'=>$resp_success['0']->Description,
                                            'title'=>DEFAULT_WEBSITE_TITLE,
                                            'detail'=>array('UserID'=>$data->UserID,
                                                            'VideoID'=>'',
                                                            'CompanyID'=>'',
                                                            'JobPostID'=>$data->JobPostID,
                                                            'ActionType'=>'ApplyJob',
                                                            'Detail'=>$profile[0]
                                                )
                                        );
                                    $res = sendPushNotification($pushNotificationArr);       
                                }
                            }

                        }elseif(isset($resp_success['0']->Message) && $resp_success['0']->Message != ""){
                            if(empty($_result))
                            $_result[] = $resp_success['0'];
                        }
                    }
                }

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                    $response['Error'] = 200;
                    $response['Message'] = 'Apply job successfully.';
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('applyJobByCandidate'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('applyJobByCandidate'=>$response);
        }
    }

    /*function addCandidateShortlistedByCompnay($data) {
        try{
            $response = array();
            
            if (!isset($data->CandidateUserID) || $data->CandidateUserID == ''){
                $response['Error'] = 102;
                $response['Message'] = 'Candidate not found.';
            }else if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else {   

                $data->JobPostID = ((!isset($data->JobPostID) || $data->JobPostID=='') ? '-1' : $data->JobPostID);

                $_result = $this->master_model->getQueryResult("call usp_M_AddToShortlisted('".$data->CandidateUserID."','".$data->UserID."','".$data->JobPostID."')");
                        

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                    $response['Error'] = 200;
                    $response['Message'] = 'Shortlisted candidate successfully.';
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('addCandidateShortlistedByCompnay'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addCandidateShortlistedByCompnay'=>$response);
        }
    }*/

    function addCandidateInvitedByCompnay($data) {
        try{
            $response = array();
            
            if (!isset($data->CandidateUserID) || $data->CandidateUserID == ''){
                $response['Error'] = 102;
                $response['Message'] = 'Candidate not found.';
            }else if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else if (!isset($data->InterviewScheduledTime) && $data->InterviewScheduledTime == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Interview scheduled time not found';
            }else if (!isset($data->InterviewScheduledDate) && $data->InterviewScheduledDate == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Interview scheduled date not found';
            }else {   

                if(strlen($data->InterviewScheduledTime) < 8){
                    $data->InterviewScheduledTime = $data->InterviewScheduledTime.':00';
                }
                
                // echo date('Y-m-d H:i:s',strtotime($data->InterviewScheduledDate.' '.$data->InterviewScheduledTime));;
                $data->InterviewScheduled = date('Y-m-d H:i:s',strtotime($data->InterviewScheduledDate.' '.$data->InterviewScheduledTime));
                $data->JobPostID = ((!isset($data->JobPostID) || $data->JobPostID=='') ? '-1' : $data->JobPostID);

                $_result = $this->master_model->getQueryResult("call usp_M_InviteCandidate('".$data->CandidateUserID."','".$data->UserID."','".$data->JobPostID."','".$data->InterviewScheduled."')");


                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                            $device = $this->master_model->getInlineQuery("SELECT di.DeviceTokenID FROM ssc_deviceinfo di WHERE di.UserID= '".$data->CandidateUserID."'");

                            foreach ($device as $k => $val) {
                                if(@$val->DeviceTokenID!='' && @$_result['0']->Description!=''){

                                    /* SQL
                                        SET @Description = ( SELECT Fn_A_GetMessage(@ActionType) as aa);
                                        IF(IFNULL(@Description,'') != '') THEN
                                        SET @notify = (SELECT Fn_A_AddNotification(_UserID,@Description,_UserID,_ID,@ActionType,'0'));
                                    */
                                    if(@$data->JobPostID!='-1' && @$data->JobPostID > 0){
                                        $ActionType = 'Invited';
                                        $job_data = $this->master_model->getQueryResult("call usp_M_GetJobByID('".$data->JobPostID."','".base_url()."','".$data->CandidateUserID."')");
                                        if(!isset($job_data[0]->Skills) && !empty($job_data[0]->Skills)){
                                            $job_data[0]->Skills = (json_decode($job_data[0]->Skills, true));
                                        }else{
                                            $job_data[0]->Skills = [];
                                        }
                                        $Detail = $job_data[0];
                                    }
                                    else{
                                        $ActionType = 'DirectInvited';
                                        //$job_data = array();
                                        $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$data->UserID."','".base_url()."')");
                                        $profile[0]->CVDate ='';
                                        $mno_list = explode('-', $profile[0]->MobileNo);
                                        $profile[0]->CountryCode='';
                                        if(count($mno_list) >= 2){
                                            $profile[0]->CountryCode=$mno_list[0];
                                            $profile[0]->MobileNo=$mno_list[1];
                                        }
                                        $Detail = $profile[0];

                                        // if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                                        //         //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                                        //         $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                                        //         if($lastModified == NULL)
                                        //             $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                                        //         $profile[0]->CVDate = date("d M Y",$lastModified);
                                        // }
                                    }

                                    $pushNotificationArr = array('device_id'=>$val->DeviceTokenID,
                                            'message'=>$_result['0']->Description,
                                            'title'=>DEFAULT_WEBSITE_TITLE,
                                            'detail'=>array('UserID'=>$data->CandidateUserID,
                                                            'VideoID'=>'',
                                                            'CompanyID'=>$data->UserID,
                                                            'JobPostID'=>@$data->JobPostID,
                                                            'ActionType'=>$ActionType,
                                                            'Detail'=>$Detail
                                                )
                                        );
                                    $res = sendPushNotification($pushNotificationArr);       

                                }
                            }
                    $response['Error'] = 200;
                    $response['Message'] = 'Interview scheduled successfully.';
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('addCandidateInvitedByCompnay'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addCandidateInvitedByCompnay'=>$response);
        }
    }

    function hiredCandidateByCompany($data) {
        try{
            $response = array();
            
            if (!isset($data->CandidateUserID) || $data->CandidateUserID == ''){
                $response['Error'] = 102;
                $response['Message'] = 'Candidate not found.';
            }else if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else if (!isset($data->JobPostID) || $data->JobPostID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Job not found';
            }else {   
                
                $data->JobPostID = ((!isset($data->JobPostID) || $data->JobPostID=='') ? '-1' : $data->JobPostID);

                $_result = $this->master_model->getQueryResult("call usp_M_HiredCandidate('".$data->CandidateUserID."','".$data->UserID."','".$data->JobPostID."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                        $device = $this->master_model->getInlineQuery("SELECT di.DeviceTokenID FROM ssc_deviceinfo di WHERE di.UserID= '".$data->CandidateUserID."'");
                        
                        foreach ($device as $k => $val) {
                            if(@$val->DeviceTokenID!='' && @$_result['0']->Description!=''){

                                /* SQL
                                    SET @Description = ( SELECT Fn_A_GetMessage(@ActionType) as aa);
                                    IF(IFNULL(@Description,'') != '') THEN
                                    SET @notify = (SELECT Fn_A_AddNotification(_UserID,@Description,_UserID,_ID,@ActionType,'0'));
                                */
                            
                                //$job_data = array();
                                /*$profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$data->CandidateUserID."','".base_url()."')");
                                $profile[0]->CVDate ='';
                                $mno_list = explode('-', $profile[0]->MobileNo);
                                $profile[0]->CountryCode='';
                                if(count($mno_list) >= 2){
                                    $profile[0]->CountryCode=$mno_list[0];
                                    $profile[0]->MobileNo=$mno_list[1];
                                }

                                if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                                        //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                                        $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                                        if($lastModified == NULL)
                                            $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                                        $profile[0]->CVDate = date("d M Y",$lastModified);
                                }*/
                                $job_data = $this->master_model->getQueryResult("call usp_M_GetJobByID('".$data->JobPostID."','".base_url()."','".$data->CandidateUserID."')");
                                if(!isset($job_data[0]->Skills) && !empty($job_data[0]->Skills)){
                                    $job_data[0]->Skills = (json_decode($job_data[0]->Skills, true));
                                }else{
                                    $job_data[0]->Skills = [];
                                }

                                $pushNotificationArr = array('device_id'=>$val->DeviceTokenID,
                                        'message'=>$_result['0']->Description,
                                        'title'=>DEFAULT_WEBSITE_TITLE,
                                        'detail'=>array('UserID'=>$data->CandidateUserID,
                                                        'VideoID'=>'',
                                                        'CompanyID'=>$data->UserID,
                                                        'JobPostID'=>@$data->JobPostID,
                                                        'ActionType'=>'Hired',
                                                        'Detail'=>$job_data[0]
                                            )
                                    );
                                $res = sendPushNotification($pushNotificationArr);       
                            }
                        }
                    $response['Error'] = 200;
                    $response['Message'] = 'Candidate hired successfully.';
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
        }
        return array('hiredCandidateByCompany'=>$response);
    }

    function addViewJobByCandidate($data) {
        try{
            $response = array();
            
            if (!isset($data->JobPostID) || $data->JobPostID == ''){
                $response['Error'] = 102;
                $response['Message'] = 'Job not found.';
            }else if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else {     
                $_result = $this->master_model->getQueryResult("call usp_M_ViewJob('".$data->JobPostID."','".$data->UserID."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Job viewed successfully.';
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('addViewJobByCandidate'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addViewJobByCandidate'=>$response);
        }
    }

    function addSaveJobByCandidate($data) {
        try{
            $response = array();
            
            if (!isset($data->JobPostID) || $data->JobPostID == ''){
                $response['Error'] = 102;
                $response['Message'] = 'Job not found.';
            }else if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else if (!isset($data->Status) && $data->Status == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Status not found';
            }else {     
                $_result = $this->master_model->getQueryResult("call usp_M_SavedJob('".$data->JobPostID."','".$data->UserID."','".$data->Status."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    if($data->Status == 1){
                        $response['Message'] = 'Job saved successfully.';
                    }else{
                        $response['Message'] = 'Job unsaved successfully.';
                    }
                    
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('addSaveJobByCandidate'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addSaveJobByCandidate'=>$response);
        }
    }

    function getDashboard($data) {
        try{
            $response = array();
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetDashboard('".$data->UserID."')");

                        $_result['0']->Percentage = '';
                        $_result['0']->RemainingAction = '';
                
                if(@$_result['0']->CandidateProfileStepPer!=''){
                    $list = explode('~', $_result['0']->CandidateProfileStepPer);
                    if(!empty($list)){
                        //$response['ProfileStep'] = array('Percentage'=>@$list[0],'RemainingAction'=>@$list[1]);
                        $_result['0']->Percentage = @$list[0];
                        $_result['0']->RemainingAction = @$list[1];
                    }
                }

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Get dashboard successfully.';
                    $response['data'] = $_result[0];
                    $_resultQuote = $this->master_model->getQueryResult("call usp_M_GetCurrentMotivationalQuote()");
                    if (isset($_resultQuote) && !empty($_resultQuote) && @$_resultQuote['0']->MotivationalQuoteID > 0) {
                        $response['Quote'] = $_resultQuote[0];
                    }else{
                        $response['Quote'] = '';
                    }
                    
                    if(@$data->UserID!=''){
                        //$response['profile'] = $profile = array();
                        $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$data->UserID."','".base_url()."')");
                        if(@$profile[0]->UserID>0){
                            $profile[0]->CVDate ='';
                            $mno_list = explode('-', $profile[0]->MobileNo);
                            $profile[0]->CountryCode='';
                            if(count($mno_list) >= 2){
                                $profile[0]->CountryCode=$mno_list[0];
                                $profile[0]->MobileNo=$mno_list[1];
                            }
                            if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                                    //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                                    $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                                    if($lastModified == NULL)
                                        $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                                    $profile[0]->CVDate = date("d M Y",$lastModified);
                            }
                        }else{
                            $profile[0] = array();
                        }
                        //$response['profile'] = $profile[0];

                        $response['profile'] = $profile[0];

                        $_resultReport = $this->master_model->getQueryResult("call usp_M_GetReport('".$data->UserID."')");

                        if (isset($_resultReport) && !empty($_resultReport) && !isset($_resultReport['0']->Message)) {  
                            $_resultReport[0]->ProfileViewed = round($_resultReport[0]->ProfileViewed);
                            $response['report'] = $_resultReport[0];
                        } else{
                            $response['report'] = [];
                        }
                    }else{
                        $response['profile'] = [];
                        $response['report'] = [];
                    }

                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            return array('getDashboard'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getDashboard'=>$response);
        }
    }

    function editCompany($data) {
        try{
        $response = array();

        if (!isset($data->UserID) && $data->UserID == '') {
            $response['Error'] = 102;
            $response['Message'] = 'User not found';
        }else if (!isset($data->FirstName) && $data->FirstName == '') {
            $response['Error'] = 102;
            $response['Message'] = 'First name not found';
        }else if (!isset($data->LastName) && $data->LastName == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Last name not found';
        } else if (!isset($data->CompanyName) && $data->CompanyName == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Company name not found';
        } else if (!isset($data->Address) && $data->Address == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Address not found';
        // } else if (!isset($data->DepartmentID) && $data->DepartmentID == '') {
        //     $response['Error'] = 102;
        //     $response['Message'] = 'Department not found';
        // } else if (!isset($data->CountryID) && $data->CountryID == '') {
        //     $response['Error'] = 102;
        //     $response['Message'] = 'Country not found';
        // } else if (!isset($data->StateID) && $data->StateID == '') {
        //     $response['Error'] = 102;
        //     $response['Message'] = 'State not found';
        } else if (!isset($data->CityID) && $data->CityID == '') {
            $response['Error'] = 102;
            $response['Message'] = 'City not found';
        } else if (!isset($data->Designation) && $data->Designation == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Designation not found';
        } else if (!isset($data->MobileNo) && $data->MobileNo == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Mobile number not found';
        } else {

                $data->StatusText = (!isset($data->StatusText)) ? '' : $data->StatusText;
                $data->WebsiteURL = (!isset($data->WebsiteURL)) ? '' : $data->WebsiteURL;
                $data->Latitude = (!isset($data->Latitude)) ? '' : $data->Latitude;
                $data->Longitude = (!isset($data->Longitude)) ? '' : $data->Longitude;
                $data->CountryID = (!isset($data->CountryID)) ? '-1' : $data->CountryID;
                $data->StateID = (!isset($data->StateID)) ? '-1' : $data->StateID;
                $data->FacebookURL = (!isset($data->FacebookURL)) ? '-1' : $data->FacebookURL;
                $data->LinkedInURL = (!isset($data->LinkedInURL)) ? '-1' : $data->LinkedInURL;


                $Designation_data = $this->master_model->getQueryResult("call usp_M_AddGetDesignation('".$data->Designation."','".$data->UserID."')");
                
                $data->DesignationID =$Designation_data[0]->ID;

                $_result = $this->master_model->editCompany($data);

                if (isset($_result['UserID']) && $_result['UserID'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Edit company successfully.';

                    //$response['profile'] = $profile = array();
                    $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$_result['UserID']."','".base_url()."')");
                    $profile[0]->CVDate ='';
                    $mno_list = explode('-', $profile[0]->MobileNo);
                    $profile[0]->CountryCode='';
                    if(count($mno_list) >= 2){
                        $profile[0]->CountryCode=$mno_list[0];
                        $profile[0]->MobileNo=$mno_list[1];
                    }
                    if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                            //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                            $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                            if($lastModified == NULL)
                                $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                            $profile[0]->CVDate = date("d M Y",$lastModified);
                    }
                    //$response['profile'] = $profile[0];

                    $response['data'] = $profile[0];

                } else if (isset($_result['Message']) && $_result['Message']!='') {
                    $msg = explode('~',$_result['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Something went wrong.';
                }
        }
        return array('editCompany'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('editCompany'=>$response);
        }
    }

    function editCandidate($data) {
        try{
        $response = array();

        if (!isset($data->UserID) && $data->UserID == '') {
            $response['Error'] = 102;
            $response['Message'] = 'User not found';
        }else if (!isset($data->FirstName) && $data->FirstName == '') {
            $response['Error'] = 102;
            $response['Message'] = 'First name not found';
        }else if (!isset($data->LastName) && $data->LastName == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Last name not found';
        } else if (!isset($data->CityName) && $data->CityName == '') {
            $response['Error'] = 102;
            $response['Message'] = 'City not found';
        } else if (!isset($data->Address) && $data->Address == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Address not found';
        // } else if (!isset($data->DepartmentID) && $data->DepartmentID == '') {
        //     $response['Error'] = 102;
        //     $response['Message'] = 'Department not found';
        } else if (!isset($data->Pincode) && $data->Pincode == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Pincode not found';
        // } else if (!isset($data->PermenantAddress) && $data->PermenantAddress == '') {
        //     $response['Error'] = 102;
        //     $response['Message'] = 'Permenant address not found';
        } else if (!isset($data->Experience) && $data->Experience == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Experience not found';
        } else if (!isset($data->Salary) && $data->Salary == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Salary not found';
        } else if (!isset($data->MobileNo) && $data->MobileNo == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Mobile number not found';
        // } else if (!isset($data->DOB) && $data->DOB == '') {
        //     $response['Error'] = 102;
        //     $response['Message'] = 'DOB not found';
        } else if (!isset($data->Gender) && $data->Gender == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Gender not found';
        } else {


                $data->StatusText = (!isset($data->StatusText)) ? '' : $data->StatusText;
                $data->ProfileSummary = (!isset($data->ProfileSummary)) ? '' : $data->ProfileSummary;
                $data->IsPhysicalChallenged = (!isset($data->IsPhysicalChallenged)) ? '0' : $data->IsPhysicalChallenged;
                // $data->MaritualStatus = (!isset($data->MaritualStatus)) ? '0' : $data->MaritualStatus;
                $data->Latitude = (!isset($data->Latitude)) ? '' : $data->Latitude;
                $data->BirthYear = (!isset($data->BirthYear)) ? '' : $data->BirthYear;
                $data->Longitude = (!isset($data->Longitude)) ? '' : $data->Longitude;
                //$data->Gender = (!isset($data->Gender)) ? '' : $data->Gender;

                // $data->DOB = date('Y-m-d',strtotime($data->DOB));

                $_result = $this->master_model->editCandidate($data);

                if (isset($_result['UserID']) && $_result['UserID'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Edit candidate successfully.';

                    $mno_list = explode('-', $_result['MobileNo']);
                    $_result['CountryCode']='';
                    if(count($mno_list) >= 2){
                        $_result['CountryCode']=$mno_list[0];
                        $_result['MobileNo']=$mno_list[1];
                    }

                    $response['data'] = $_result;

                } else if (isset($_result['Message']) && $_result['Message']!='') {
                    $msg = explode('~',$_result['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Something went wrong.';
                }
        }
        return array('editCandidate'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('editCandidate'=>$response);
        }
    }

    function getProfileByID($data) {
        try{
            $response = array();
            
            if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else {     
                $_result = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$data->UserID."','".base_url()."')");
                    $_result[0]->CVDate ='';
                    $mno_list = explode('-', $_result[0]->MobileNo);
                    $_result[0]->CountryCode='';
                    if(count($mno_list) >= 2){
                        $_result[0]->CountryCode=$mno_list[0];
                        $_result[0]->MobileNo=$mno_list[1];
                    }
                    if(isset($_result[0]->CVPath) && $_result[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$_result[0]->CV_New_Name)){
                            //$_result[0]->CVDate = date ("F d Y H:i:s.", filemtime($_result[0]->CVPath));
                            $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$_result[0]->CV_New_Name);
                            if($lastModified == NULL)
                                $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$_result[0]->CV_New_Name));
                            $_result[0]->CVDate = date("d M Y",$lastModified);
                    }

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Get profile successfully.';
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getProfileByID'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getProfileByID'=>$response);
        }
    }

    function getJobByCompany($data) {
        try{
            $response = array();
            
                $_result = $this->master_model->getJobByCompany($data);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Job listed successfully.';
                    //$list = array();
                    foreach ($_result as $k => $val) {
                        $_result[$k]->Skills = (json_decode($_result[$k]->Skills, true));
                        //if(empty($_result[$k]->Skills)){ $_result[$k]->Skills = array(); }
                    }
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            
            return array('getJobByCompany'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getJobByCompany'=>$response);
        }
    }

    function getPage() {
        $response = array();
        $PageID=@$_GET['PageID'];
        $PageName=@$_GET['PageName']; 

            if ($PageID == '' && $PageName == '' ) {
                $response['Error'] = 102;
                $response['Message'] = 'Page not found';
            }else {
                $PageID = ($PageID==0) ? '' : $PageID;

                if((!isset($PageID) && !isset($PageName)) || ($PageID=='' && $PageName=='')){ $PageID = 1; }
                if(!isset($PageName)){ $PageName = ''; }

                $page_result = $this->master_model->getQueryResult("call usp_M_GetCMSPage('".$PageID."','".$PageName."')");
                if (isset($page_result[0]->CMSID) && $page_result[0]->CMSID > 0  && $page_result[0]->Content!='') {
                    echo $page_result[0]->Content; die;
                }   
            }
        echo json_encode($response);
        exit();
    }

    function deleteJob($data) {
        try{
            $response = array();
            
            if (!isset($data->JobPostID) && $data->JobPostID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Job not found';
            }else {     
                $_result = $this->master_model->getQueryResult("call usp_M_DeleteJob('".$data->JobPostID."')");

                if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('deleteJob'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('deleteJob'=>$response);
        }
    }

    function followCompany($data) {
        try{
            $response = array();
            
            if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else if (!isset($data->CompanyUserID) && $data->CompanyUserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Company not found';
            }else if (!isset($data->Status) && $data->Status == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Status not found';
            }else {     
                $_result = $this->master_model->getQueryResult("call usp_M_FollowCompany('".$data->CompanyUserID."','".$data->UserID."','".$data->Status."')");

                if (isset($_result['0']->Message) && $_result['0']->Message != "") {

                    if($data->Status==1){
                        $device = $this->master_model->getInlineQuery("SELECT DeviceTokenID FROM ssc_deviceinfo WHERE UserID = '".$data->CompanyUserID."'");

                        foreach ($device as $k => $val) {
                            if(@$val->DeviceTokenID!='' && @$_result['0']->Description!=''){

/* SQL
                SET @Description = ( SELECT Fn_A_GetMessage(@ActionType) as aa);
                IF(IFNULL(@Description,'') != '') THEN
                SET @notify = (SELECT Fn_A_AddNotification(_UserID,@Description,_UserID,_ID,@ActionType,'0'));
*/
                    $_result1 = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$data->UserID."','".base_url()."')");
                    $_result1[0]->CVDate ='';
                    $mno_list = explode('-', $_result1[0]->MobileNo);
                    $_result1[0]->CountryCode='';
                    if(count($mno_list) >= 2){
                        $_result1[0]->CountryCode=$mno_list[0];
                        $_result1[0]->MobileNo=$mno_list[1];
                    }

                    if(isset($_result1[0]->CVPath) && $_result1[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$_result1[0]->CV_New_Name)){
                            //$_result[0]->CVDate = date ("F d Y H:i:s.", filemtime($_result[0]->CVPath));
                            $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$_result1[0]->CV_New_Name);
                            if($lastModified == NULL)
                                $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$_result1[0]->CV_New_Name));
                            $_result1[0]->CVDate = date("d M Y",$lastModified);
                    }
                                $pushNotificationArr = array('device_id'=>$val->DeviceTokenID,
                                        'message'=>$_result['0']->Description,
                                        'title'=>DEFAULT_WEBSITE_TITLE,
                                        'detail'=>array('UserID'=>$data->UserID,
                                                        'CompanyID'=>$data->CompanyUserID,
                                                        'VideoID'=>'',
                                                        'ActionType'=>'Follow',
                                                        'Detail'=>$_result1[0]
                                            )
                                    );
                                $res = sendPushNotification($pushNotificationArr);       
                            }
                        }
                    }

                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = $_result[0];
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('followCompany'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('followCompany'=>$response);
        }
    }

    function deleteUser($data) {
        try{
            $response = array();
            
            if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Job not found';
            }else {     
                $_result = $this->master_model->getQueryResult("call usp_M_DeleteUser('".$data->UserID."')");

                if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('deleteUser'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('deleteUser'=>$response);
        }
    }

    function companyJobAction($data) {
        try{
            $response = array();
            
            if (!isset($data->CompanyJobActionID) && $data->CompanyJobActionID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Company job action not found';
            }elseif (!isset($data->UserID) || $data->UserID=='' ) {
                $response['Error'] = 102;
                $response['Message'] = 'Status not found';
            }elseif (!isset($data->Action) || $data->Action=='') {
                $response['Error'] = 102;
                $response['Message'] = 'Status not found';
            }elseif (!isset($data->CurrentState) || $data->CurrentState=='') {
                $response['Error'] = 102;
                $response['Message'] = 'Current state not found';
            }else {     
                //Action        =  View,Applied,ShortListed,Invited
                //CurrentState  =  1=View,2=Applied,3=ShortList,4=Interview,5=Accept,6=Decline 
                $data->Reason = (!isset($data->Reason) ? '' : $data->Reason);
                $_result = $this->master_model->getQueryResult("call usp_M_CompanyJobAction('".$data->CompanyJobActionID."','".$data->UserID."','".$data->Action."','".$data->CurrentState."','".base_url()."','".$data->Reason."')");

                if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];

// pr($_result['0']);
// pr($data->Action);

                    if(($data->Action=='Invited' || $data->Action=='Applied') && @$_result['0']->NotifyUserID!=''){

                        if(@$_result['0']->NotifyAction=='Decline' && $_result['0']->UserType=='Candidate'){
                            $_result['0']->NotifyAction='CandidateDecline';
                        }elseif(@$_result['0']->NotifyAction=='Decline' && @$_result['0']->JobPostID > 0){
                            $_result['0']->NotifyAction='JobDecline';
                        }elseif(@$_result['0']->NotifyAction=='Decline' && $_result['0']->UserType=='Company'){
                            $_result['0']->NotifyAction='CompanyDecline';
                        }
                        // $_result['0']->NotifyAction=='RejectApplication'
                        // $_result['0']->NotifyAction=='Hired'

                        if($_result['0']->NotifyAction=='JobDecline' || $_result['0']->NotifyAction=='RejectApplication') {

                            $job_data = $this->master_model->getQueryResult("call usp_M_GetJobByID('".$_result['0']->JobPostID."','".base_url()."','".$data->UserID."')");
                            if(!isset($job_data[0]->Skills) && !empty($job_data[0]->Skills)){
                                $job_data[0]->Skills = (json_decode($job_data[0]->Skills, true));
                            }else{
                                $job_data[0]->Skills = [];
                            }
                            $Detail = $job_data[0];
                        }else{
                            if(
                                ($data->Action=='Invited' && @$data->CurrentState=='5')  
                                || 
                                $_result['0']->NotifyAction=='CompanyDecline'
                                ||
                                $_result['0']->NotifyAction=='CandidateDecline'
                            ){
                                $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$data->UserID."','".base_url()."')");
                            }else{
                                //$job_data = array();
                                $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$_result['0']->NotifyUserID."','".base_url()."')");
                            }
                            $profile[0]->CVDate ='';
                            $mno_list = explode('-', $profile[0]->MobileNo);
                            $profile[0]->CountryCode='';
                            if(count($mno_list) >= 2){
                                $profile[0]->CountryCode=$mno_list[0];
                                $profile[0]->MobileNo=$mno_list[1];
                            }
                            if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                                    //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                                    $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                                    if($lastModified == NULL)
                                        $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                                    $profile[0]->CVDate = date("d M Y",$lastModified);
                            }
                            $profile[0]->ProfileSummary = '';
                            $Detail = $profile[0];
                        }
                        
                        $device = $this->master_model->getInlineQuery("SELECT di.DeviceTokenID FROM ssc_deviceinfo di WHERE UserID = '".$_result['0']->NotifyUserID."'");

                        foreach ($device as $k => $val) {
                            if(@$val->DeviceTokenID!='' && @$_result['0']->Description!='' && @$_result['0']->NotifyUserID!=''){


                                $pushNotificationArr = array('device_id'=>$val->DeviceTokenID,
                                        'message'=>$_result['0']->Description,
                                        'title'=>DEFAULT_WEBSITE_TITLE,
                                        'detail'=>array('UserID'=>$_result['0']->NotifyUserID,
                                                        'VideoID'=>'0',
                                                        'CompanyID'=>'0',
                                                        'JobPostID'=>'0',
                                                        'ActionType'=>$_result['0']->NotifyAction,
                                                        'Detail'=>$Detail
                                            )
                                    );
                                $res = sendPushNotification($pushNotificationArr);       

                            }
                        }
                    }

                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('companyJobAction'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('companyJobAction'=>$response);
        }
    }

    function addDevice($data) {
        try{
        $response = array();

        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        }else if (!isset($data->NotificationToken)||     $data->NotificationToken == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Notification token not found';
        }else if (!isset($data->DeviceType) || $data->DeviceType == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Device type not found';
        }else if (!isset($data->DeviceUID) || $data->DeviceUID == '') {
            $response['Error'] = 102;
            $response['Message'] = 'DeviceUID not found';
        } else {

               
                if(!isset($data->DeviceName)) $data->DeviceName='';
                if(!isset($data->OSVersion)) $data->OSVersion='';

                $_result = $this->master_model->addDevice($data);

                if (isset($_result['device_status']) && $_result['device_status'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Add device Successfully.';
                    $response['data'] = $_result;

                } else if (isset($_result['Message']) && $_result['Message']!='') {
                    $msg = explode('~',$_result['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Something went wrong.';
                }
        }
        return array('addDevice'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addDevice'=>$response);
        }
    }

    function getfollower($data) {
        try{
            $response = array();
            
        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        } else {

                $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                $data->Type = (isset($data->Type) || @$data->Type!='') ? $data->Type : 'Follow';
                
                $_result = $this->master_model->getQueryResult("call usp_M_Getfollower('".$data->PageSize."','".$data->CurrentPage."','".$data->UserID."','".base_url()."','".$data->Type."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'follower listed successfully.';
                    foreach ($_result as $k => $val) {
                        $mno_list = array();
                        $mno_list = explode('-', $_result[$k]->MobileNo);
                        $_result[$k]->CountryCode='';
                        if(count($mno_list) >= 2){
                            $_result[$k]->CountryCode=$mno_list[0];
                            $_result[$k]->MobileNo=$mno_list[1];
                        }
                    }
                        
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getfollower'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getfollower'=>$response);
        }
    }

     function getCandidateList($data) {
        try{
            $response = array();
            
        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        }elseif (@$data->Type != 'All' && @$data->Type != 'HiredDecline' && @$data->Type != 'Decline' && @$data->Type != 'Hired' && (!isset($data->JobPostID) || @$data->JobPostID=='' || @$data->JobPostID=='-1' || @$data->JobPostID=='0')) {
            $response['Error'] = 102;
            $response['Message'] = 'Job not found.';
        } else {

                $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                $data->SearchText = (isset($data->SearchText) || @$data->SearchText!='') ? $data->SearchText : '';
                $data->CityID = (isset($data->CityID) || @$data->CityID!='') ? $data->CityID : '';
                $data->Type = (isset($data->Type) || @$data->Type!='') ? $data->Type : 'All';
                $data->JobPostID = (!isset($data->JobPostID) || @$data->JobPostID=='' || @$data->JobPostID=='-1' || @$data->JobPostID=='0') ?  '-1' : $data->JobPostID ;
                $data->StartSalary = (isset($data->StartSalary) || @$data->StartSalary!='') ? $data->StartSalary : '-1';
                $data->EndSalary = (isset($data->EndSalary) || @$data->EndSalary!='') ? $data->EndSalary : '-1';
                $data->DesignationID = (isset($data->DesignationIDS) || @$data->DesignationIDS!='') ? $data->DesignationIDS : '';
                $data->SortBy = (isset($data->SortBy) || @$data->SortBy!='') ? $data->SortBy : 'Modified';
                $data->SortByOrder = (isset($data->SortByOrder) || @$data->SortByOrder!='') ? $data->SortByOrder : 'DESC';
                $_result = $this->master_model->getQueryResult("call usp_M_GetCandidateList('".
                                            $data->PageSize."','".
                                            $data->CurrentPage."','".
                                            $data->UserID."','".
                                            base_url()."','".
                                            $data->SearchText."','".
                                            $data->Type."','".
                                            $data->JobPostID."','".
                                            $data->StartSalary."','".
                                            $data->EndSalary."','".
                                            $data->DesignationID."','".
                                            $data->SortBy."','".
                                            $data->SortByOrder."','','','')");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Candidate listed successfully.';
                    foreach ($_result as $k => $val) {
                        $mno_list = array();
                        $mno_list = explode('-', $_result[$k]->MobileNo);
                        $_result[$k]->CountryCode='';
                        if(count($mno_list) >= 2){
                            $_result[$k]->CountryCode=$mno_list[0];
                            $_result[$k]->MobileNo=$mno_list[1];
                        }
                    }

                    $response['data'] = $_result;
                    $response['advertisement'] = $this->getAdvertisement();
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getCandidateList'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCandidateList'=>$response);
        }
    }

     function getCandidateListByCompanyInvited($data) {
        try{
            $response = array();
            
        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        }elseif (!isset($data->Type) || (@$data->Type!='Invited' AND @$data->Type!='Accept' AND @$data->Type!='Decline')) {
            $response['Error'] = 102;
            $response['Message'] = 'Type not found.';
        } else {

                $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                $data->SearchText = (isset($data->SearchText) || @$data->SearchText!='') ? $data->SearchText : '';
                $data->CityID = (isset($data->CityID) || @$data->CityID!='') ? $data->CityID : '';
                $data->Type = (isset($data->Type) || @$data->Type!='') ? $data->Type : 'Invited';

                $data->StartSalary = (isset($data->StartSalary) || @$data->StartSalary!='') ? $data->StartSalary : '-1';
                $data->EndSalary = (isset($data->EndSalary) || @$data->EndSalary!='') ? $data->EndSalary : '-1';
                $data->DesignationID = (isset($data->DesignationIDS) || @$data->DesignationIDS!='') ? $data->DesignationIDS : '';
                $data->SortBy = (isset($data->SortBy) || @$data->SortBy!='') ? $data->SortBy : 'InvitedID';
                $data->SortByOrder = (isset($data->SortByOrder) || @$data->SortByOrder!='') ? $data->SortByOrder : 'DESC';
                $_result = $this->master_model->getQueryResult("call usp_M_GetCandidateListByCompanyInvited('".
                                            $data->PageSize."','".
                                            $data->CurrentPage."','".
                                            $data->UserID."','".
                                            base_url()."','".
                                            $data->SearchText."','".
                                            $data->Type."','".
                                            $data->StartSalary."','".
                                            $data->EndSalary."','".
                                            $data->DesignationID."','".
                                            $data->SortBy."','".
                                            $data->SortByOrder."')");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Candidate listed successfully.';
                    foreach ($_result as $k => $val) {
                        $mno_list = array();
                        $mno_list = explode('-', $_result[$k]->MobileNo);
                        $_result[$k]->CountryCode='';
                        if(count($mno_list) >= 2){
                            $_result[$k]->CountryCode=$mno_list[0];
                            $_result[$k]->MobileNo=$mno_list[1];
                        }
                    }

                    $response['data'] = $_result;
                    $response['advertisement'] = $this->getAdvertisement();
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getCandidateListByCompanyInvited'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCandidateListByCompanyInvited'=>$response);
        }
    }

    function addUserEmployeement($data) {
        try{
        $response = array();

        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        }else if (!isset($data->DesignationID) || $data->DesignationID == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Designation not found';
        }else if ((!isset($data->OrganizationID) || $data->OrganizationID == '') && (!isset($data->OrganizationOther) || $data->OrganizationOther == '')) {
            $response['Error'] = 102;
            $response['Message'] = 'Organization not found';
        } else if (!isset($data->StartDate) && $data->StartDate == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Start date not found';
        } else if ((@$data->IsPresent != '1') &&  (!isset($data->EndDate) || $data->EndDate=='')) {
            $response['Error'] = 102;
            $response['Message'] = 'End date not found';
        } else {

                $data->EndDate = (!isset($data->EndDate)) ? '1000-01-01' : $data->EndDate;
                $data->EndDate = date('Y-m-d', strtotime($data->EndDate));
                $data->StartDate = date('Y-m-d', strtotime($data->StartDate));
                $_result = $this->master_model->addUserEmployeement($data);

                if (isset($_result['ID']) && $_result['ID'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Add user employeement Successfully.';
                    $response['data'] = $_result;

                } else if (isset($_result['Message']) && $_result['Message']!='') {
                    $msg = explode('~',$_result['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Something went wrong.';
                }
        }
        return array('addUserEmployeement'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addUserEmployeement'=>$response);
        }
    }

    function editOthersCandidate($data) {
        try{
        $response = array();

        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        // }else if (!isset($data->PermenantAddress) || $data->PermenantAddress == '') {
        //     $response['Error'] = 102;
        //     $response['Message'] = 'Permenant address not found';
        }else if (@$data->Gender == 'Other' && @$data->OtherGender=='') {
            $response['Error'] = 102;
            $response['Message'] = 'Other gender not found';
        } else {

                $data->Address = (!isset($data->Address)) ? '' : $data->Address;
                // $data->MaritualStatus = (!isset($data->MaritualStatus)) ? 'Nan' : $data->MaritualStatus;
                $data->IsPhysicalChallenged = (!isset($data->IsPhysicalChallenged)) ? '0' : $data->IsPhysicalChallenged;
                $data->IsWorkPermit = (!isset($data->IsWorkPermit)) ? '0' : $data->IsWorkPermit;
                $data->Gender = (!isset($data->Gender)) ? 'Male' : $data->Gender;
                $data->OtherGender = (!isset($data->OtherGender)) ? '' : $data->OtherGender;
                $data->AgeOfGroup = (!isset($data->AgeOfGroup)) ? '0' : $data->AgeOfGroup;
                $data->Pincode = (!isset($data->Pincode)) ? '' : $data->Pincode;
                $data->BirthYear = (!isset($data->BirthYear)) ? '' : $data->BirthYear;
                $data->EthnicityID = (!isset($data->EthnicityID)) ? '0' : $data->EthnicityID;
                $data->VisaStatus = (!isset($data->VisaStatus)) ? '' : $data->VisaStatus;
                $data->HaveDrivingLicence = (!isset($data->HaveDrivingLicence)) ? '0' : $data->HaveDrivingLicence;
                $data->IsWillingToRelocate = (!isset($data->IsWillingToRelocate)) ? '0' : $data->IsWillingToRelocate;
                // $data->DOB = (!isset($data->DOB) || $data->DOB=='') ? '1000-01-01' : $data->DOB;
                // $data->DOB = date('Y-m-d',strtotime($data->DOB));
                // $data->PermenantAddress = (!isset($data->PermenantAddress)) ? '' : $data->PermenantAddress;

                $_result = $this->master_model->editOthersCandidate($data);

                if (isset($_result['UserID']) && $_result['UserID'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Edit others info of candidate successfully.';
                    
                    $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$_result['UserID']."','".base_url()."')");
                    $profile[0]->CVDate ='';
                    $mno_list = explode('-', $profile[0]->MobileNo);
                    $profile[0]->CountryCode='';
                    if(count($mno_list) >= 2){
                        $profile[0]->CountryCode=$mno_list[0];
                        $profile[0]->MobileNo=$mno_list[1];
                    }
                    if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                            //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                            $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                            if($lastModified == NULL)
                                $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                            $profile[0]->CVDate = date("d M Y",$lastModified);
                    }
                    $response['data'] = $profile[0];

                } else if (isset($_result['Message']) && $_result['Message']!='') {
                    $msg = explode('~',$_result['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Something went wrong.';
                }
        }
        return array('editOthersCandidate'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('editOthersCandidate'=>$response);
        }
    }

    function editBasicCandidate($data) {
        try{
        $response = array();

        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        }else if (!isset($data->FirstName) || $data->FirstName == '') {
            $response['Error'] = 102;
            $response['Message'] = 'First name not found';
        }else if (!isset($data->LastName) || $data->LastName == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Last name not found';
        // }else if (!isset($data->CityID) || $data->CityID == '') {
        //     $response['Error'] = 102;
        //     $response['Message'] = 'City not found';
        // }else if (!isset($data->IsExperience) || $data->IsExperience == '') {
        //     $response['Error'] = 102;
        //     $response['Message'] = 'Experience status not found';
        // }else if((isset($data->IsExperience) && @$data->IsExperience == 'Experience') && (!isset($data->Experience) || $data->Experience=='')){
        //     $response['Error'] = 102;
        //     $response['Message'] = 'Experience not found';
        // }elseif ((isset($data->IsExperience) && @$data->IsExperience == 'Experience') && (!isset($data->Salary) || $data->Salary=='')) {
        //     $response['Error'] = 102;
        //     $response['Message'] = 'Salary not found';
        }else if (!isset($data->MobileNo) || $data->MobileNo == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Mobile no not found';
        }else if (!isset($data->JobType) || $data->JobType == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Job type not found';
        } else {



                $data->CityID = (!isset($data->CityID) || $data->CityID=='') ? '0' : $data->CityID;

                $data->IsExperience = (!isset($data->IsExperience)) ? '' : $data->IsExperience;
                $data->Experience = (!isset($data->Experience)) ? '0' : $data->Experience;
                $data->Experience = (@$data->IsExperience=='Fresher') ? '0' : $data->Experience;

                //$data->Experience = (!isset($data->Experience)) ? 'Fresher' : $data->Experience;
                $data->Salary = (!isset($data->Salary)) ? '0' : $data->Salary;
                $data->Salary = (@$data->IsExperience=='Fresher') ? '0' : $data->Salary;
                $data->StatusText = (!isset($data->StatusText)) ? '' : $data->StatusText;
                $data->ProfileStatus = (!isset($data->ProfileStatus)) ? '' : $data->ProfileStatus;
                $data->JobType = (!isset($data->JobType)) ? '' : $data->JobType;

                $_result = $this->master_model->editBasicCandidate($data);

                if (isset($_result['UserID']) && $_result['UserID'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Edit basic info of candidate successfully.';

                    $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$_result['UserID']."','".base_url()."')");
                    $profile[0]->CVDate ='';
                    $mno_list = explode('-', $profile[0]->MobileNo);
                    $profile[0]->CountryCode='';
                    if(count($mno_list) >= 2){
                        $profile[0]->CountryCode=$mno_list[0];
                        $profile[0]->MobileNo=$mno_list[1];
                    }
                    if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                            //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                            $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                            if($lastModified == NULL)
                                $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                            $profile[0]->CVDate = date("d M Y",$lastModified);
                    }
                    $response['data'] = $profile[0];//$_result;

                } else if (isset($_result['Message']) && $_result['Message']!='') {
                    $msg = explode('~',$_result['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Something went wrong.';
                }
        }
        return array('editBasicCandidate'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('editBasicCandidate'=>$response);
        }
    }

    function addEditLanguage($data) {
        try{
            $response = array();
            
            if (!isset($data->Language) && $data->Language == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Language not found';
            }else {     

                $data->LanguageID = (!isset($data->LanguageID)) ? '-1' : $data->LanguageID;
                $_result = $this->master_model->getQueryResult("call usp_M_AddEditLanguage('".$data->LanguageID."','".$data->Language."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = ($data->LanguageID=='-1') ? 'Add Language successfully.' : 'Edit Language successfully.';
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('addEditLanguage'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addEditLanguage'=>$response);
        }
    }

    function addEditUserCertificate($data) {
        try{
            $response = array();
            
            if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else if (!isset($data->Description) && $data->Description == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Description not found';
            }else {     

                $data->UserCertificateID = (!isset($data->UserCertificateID)) ? '0' : $data->UserCertificateID;
                $data->CertificateYear = (!isset($data->CertificateYear)) ? '' : $data->CertificateYear;

                $_result = $this->master_model->getQueryResult("call usp_M_AddEditUserCertificate('".$data->UserCertificateID."','".$data->UserID."','".$data->Description."','".$data->CertificateYear."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = ($data->UserCertificateID=='0') ? 'Add certificate successfully.' : 'Edit certificate successfully.';
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('addEditUserCertificate'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addEditUserCertificate'=>$response);
        }
    }

    function addEditUserLanguage($data) {
        try{
            $response = array();
            
            if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else if (!isset($data->Language) && $data->Language == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Language not found';
            }else {     

                $data->UserLanguageID = (!isset($data->UserLanguageID)) ? '0' : $data->UserLanguageID;
                $_result = $this->master_model->getQueryResult("call usp_M_AddEditUserLanguage('".$data->UserID."','".trim($data->Language)."','".$data->Proficiency."','".$data->UserLanguageID."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = ($data->UserLanguageID=='0') ? 'Add language successfully.' : 'Edit language successfully.';
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('addEditUserLanguage'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addEditUserLanguage'=>$response);
        }
    }

    function addEditUserQualification($data) {
        try{
        $response = array();

        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        }else if ((!isset($data->QualificationID) || $data->QualificationID == '') && (!isset($data->NewQualification) || $data->NewQualification == '')) {
            $response['Error'] = 102;
            $response['Message'] = 'Qualification not found';
        }else if (!isset($data->Course) || $data->Course == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Course not found';}
        else if (!isset($data->YearOfPassing) || $data->YearOfPassing == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Qualification not found';
        }else if (!isset($data->Grade) || $data->Grade == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Grade not found';
        }else if (isset($data->Grade) && $data->Grade == 'Other' && @$data->OtherGrade=='') {
            $response['Error'] = 102;
            $response['Message'] = 'Other grade not found';
        } else {

                $data->CityName = (!isset($data->CityName)) ? '' : $data->CityName;
                $data->Grade = (!isset($data->Grade)) ? '' : $data->Grade;
                $data->OtherGrade = (!isset($data->OtherGrade)) ? '' : $data->OtherGrade;
                $data->UserQualificationID = (!isset($data->UserQualificationID)) ? '0' : $data->UserQualificationID;
                $data->NewQualification = (!isset($data->NewQualification)) ? '' : $data->NewQualification;

                $_result = $this->master_model->addEditUserQualification($data);

                if (isset($_result['UserQualificationID']) && $_result['UserQualificationID'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = ($data->UserQualificationID==0) ? 'Add qualification successfully.' : 'Edit qualification successfully.';
                    $response['data'] = $_result;

                } else if (isset($_result['Message']) && $_result['Message']!='') {
                    $msg = explode('~',$_result['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Something went wrong.';
                }
        }
        return array('addEditUserQualification'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addEditUserQualification'=>$response);
        }
    }

    /*function getCandidateListByViewJob($data) {
        try{
            $response = array();
            
        if (!isset($data->JobPostID) || $data->JobPostID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'Job not found.';
        } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                $data->SearchText = (isset($data->SearchText) || @$data->SearchText!='') ? $data->SearchText : '';
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetCandidateListByViewJob('".$data->PageSize."','".$data->CurrentPage."','".$data->JobPostID."','".base_url()."','".$data->SearchText."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Candidate listed successfully.';
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getCandidateListByViewJob'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCandidateListByViewJob'=>$response);
        }
    }*/

    /*function getCandidateListByApplyJob($data) {
        try{
            $response = array();
            
        if (!isset($data->JobPostID) || $data->JobPostID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'Job not found.';
        } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                $data->SearchText = (isset($data->SearchText) || @$data->SearchText!='') ? $data->SearchText : '';
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetCandidateListByApplyJob('".$data->PageSize."','".$data->CurrentPage."','".$data->JobPostID."','".base_url()."','".$data->SearchText."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Candidate listed successfully.';
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getCandidateListByApplyJob'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCandidateListByApplyJob'=>$response);
        }
    }*/

    function getCandidateListByInvited($data) {
        try{
            $response = array();
            
        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                $data->SearchText = (isset($data->SearchText) || @$data->SearchText!='') ? $data->SearchText : '';
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetCandidateListByInvited('".$data->PageSize."','".$data->CurrentPage."','".$data->UserID."','".base_url()."','".$data->SearchText."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Candidate listed successfully.';
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getCandidateListByInvited'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCandidateListByInvited'=>$response);
        }
    }

    /*function getCandidateListByShortlisted($data) {
        try{
            $response = array();
            
        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                $data->SearchText = (isset($data->SearchText) || @$data->SearchText!='') ? $data->SearchText : '';
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetCandidateListByShortlisted('".$data->PageSize."','".$data->CurrentPage."','".$data->UserID."','".base_url()."','".$data->SearchText."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Candidate listed successfully.';
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getCandidateListByShortlisted'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCandidateListByShortlisted'=>$response);
        }
    }*/

    function getCandidateListBySavedJob($data) {
        try{
            $response = array();
            
        if (!isset($data->JobPostID) || $data->JobPostID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'Job not found.';
        } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                $data->SearchText = (isset($data->SearchText) || @$data->SearchText!='') ? $data->SearchText : '';
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetCandidateListBySavedJob('".$data->PageSize."','".$data->CurrentPage."','".$data->JobPostID."','".base_url()."','".$data->SearchText."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Candidate listed successfully.';
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getCandidateListBySavedJob'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCandidateListBySavedJob'=>$response);
        }
        
    }

    function addEditUserProject($data) {
        try{
            $response = array();
            
            if (!isset($data->UserID) && @$data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else if (!isset($data->ProjectTitle) && @$data->ProjectTitle == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Project title not found';
            }else if (!isset($data->Achievements) && @$data->Achievements == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Achievements not found';
            // }else if (!isset($data->Designation) && $data->Designation == '') {
            //     $response['Error'] = 102;
            //     $response['Message'] = 'Designation not found';
            // }else if (!isset($data->StartedFrom) && $data->StartedFrom == '') {
            //     $response['Error'] = 102;
            //     $response['Message'] = 'Started date not found';
            }else {     
                $data->ProjectDescription = (!isset($data->ProjectDescription)) ? '' : $data->ProjectDescription;
                $data->Client = (!isset($data->Client)) ? '' : $data->Client;
                $data->StartedFrom = (!isset($data->StartedFrom) || @$data->StartedFrom == '') ? '1000-01-01' : $data->StartedFrom;
                $data->WorkedTill = (!isset($data->WorkedTill) || @$data->WorkedTill == '') ? '1000-01-01' : $data->WorkedTill;
                $data->ProjectSite = (!isset($data->ProjectSite) || @$data->ProjectSite == '') ? 'Off Site' : $data->ProjectSite;
                $data->NatureOfEmployement = (!isset($data->NatureOfEmployement)) ? 'Full Time' : $data->NatureOfEmployement;
                $data->TeamSize = (!isset($data->TeamSize)) ? '0' : $data->TeamSize;
                $data->DesignationDescription = (!isset($data->DesignationDescription)) ? '' : $data->DesignationDescription;
                $data->UserProjectID = (!isset($data->UserProjectID)) ? '0' : $data->UserProjectID;

                if(isset($data->Designation) && $data->Designation!=''){
                    $Designation_data = $this->master_model->getQueryResult("call usp_M_AddGetDesignation('".$data->Designation."','".$data->UserID."')");
                    $data->DesignationID =$Designation_data[0]->ID;
                }else{
                    $data->DesignationID = 0;
                }
                

                // $_result = $this->master_model->getQueryResult("call usp_M_AddEditUserProject('".$data->UserID."','".$data->ProjectTitle."','".$data->ProjectDescription."','".$data->UserProjectID."')");
                $_result = $this->master_model->addEditUserProject($data);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = ($data->UserProjectID=='0') ? 'Add project successfully.' : 'Edit project successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('addEditUserProject'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addEditUserProject'=>$response);
        }
    }

    function deleteInformation($data) {
        try{
            $response = array();
            
        if (!isset($data->Type) || $data->Type == ''){
            $response['Error'] = 102;
            $response['Message'] = 'Type not found.';
        }elseif (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        }elseif (!isset($data->ID) || $data->ID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'Content id not found.';
        // }elseif (!isset($data->Status)){
            // $response['Error'] = 102;
            // $response['Message'] = 'Status not found.';
        } else {
                $table = '';
                $field = '';
                //$data->UserProjectID = (isset($data->UserProjectID) || $data->UserProjectID!='') ? $data->UserProjectID : -1;
                if($data->Type=='Project'){
                    $table = 'ssc_userproject';
                    $field = 'UserProjectID';
                }elseif($data->Type=='Qualification'){
                    $table = 'ssc_userqualification';
                    $field = 'UserQualificationID';
                }elseif($data->Type=='Employement'){
                    $table = 'ssc_useremployement';
                    $field = 'UserEmployementID';
                }elseif($data->Type=='Certificate'){
                    $table = 'ssc_usercertificate';
                    $field = 'UserCertificateID';
                }elseif($data->Type=='Language'){
                    $table = 'ssc_userlanguage';
                    $field = 'UserLanguageID';
                }
                $data->Status = (isset($data->Status) && ($data->Status=='' || $data->Status=='0')) ? '0' : '1';
                if($table!='' && $field!=''){
                    // $_result = $this->master_model->getQueryResult("call usp_A_ChangeStatus('".$table."','".$field."','".$data->ID."','".$data->Status."','".$data->UserID."')");
                    $_result = $this->master_model->getQueryResult("call usp_M_DeleteField('".$table."','".$field."','".$data->ID."')");
                }else{
                    $_result = '';
                }
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Delete content successfully.';
                    //$response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else if ($table=='' || $field=='') {
                    $response['Error'] =  '102';
                    $response['Message'] = 'Option not available for '.strtolower($data->Type).'.';
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('deleteInformation'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('deleteInformation'=>$response);
        }
    }

    function addEditUserEmployement($data) {
        try{
        $response = array();

        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        }else if (!isset($data->Designation) || $data->Designation == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Designation not found';
        }else if ((!isset($data->OrganizationOther)  || $data->OrganizationOther == '')) {
            $response['Error'] = 102;
            $response['Message'] = 'Organization not found';
        } else if (!isset($data->StartDate) && $data->StartDate == '') {
            $response['Error'] = 102;
            $response['Message'] = 'Start date not found';
        } else if ((@$data->IsPresent != '1') &&  (!isset($data->EndDate) || $data->EndDate=='')) {
            $response['Error'] = 102;
            $response['Message'] = 'End date not found';
        }else if ((!isset($data->Location)  || $data->Location == '')) {
            $response['Error'] = 102;
            $response['Message'] = 'Location not found';
        }else if ((!isset($data->Responsibilities)  || $data->Responsibilities == '')) {
            $response['Error'] = 102;
            $response['Message'] = 'Responsibilities not found';
        } else {

                $data->EndDate = (!isset($data->EndDate) || $data->EndDate=='') ? '1000-01-01' : $data->EndDate;
                $data->EndDate = date('Y-m-d', strtotime($data->EndDate));
                $data->StartDate = date('Y-m-d', strtotime($data->StartDate));
                $data->IsPresent = (!isset($data->IsPresent)) ? '0' : $data->IsPresent;
                $data->OrganizationID = (!isset($data->OrganizationID)) ? '0' : $data->OrganizationID;
                $data->OrganizationOther = (!isset($data->OrganizationOther)) ? '' : $data->OrganizationOther;
                $data->UserEmployementID = (!isset($data->UserEmployementID)) ? '0' : $data->UserEmployementID;

                $Designation_data = $this->master_model->getQueryResult("call usp_M_AddGetDesignation('".$data->Designation."','".$data->UserID."')");
                
                $data->DesignationID =$Designation_data[0]->ID;


                $_result = $this->master_model->addEditUserEmployement($data);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = ($data->UserEmployementID==0) ? 'Add employement successfully.' : 'Edit employement successfully.';
                    $response['data'] = $_result;

                } else if (isset($_result['Message']) && $_result['Message']!='') {
                    $msg = explode('~',$_result['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Something went wrong.';
                }
        }
        return array('addEditUserEmployement'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addEditUserEmployement'=>$response);
        }
    }

    function addEditUserSkill($data) {
        try{
            $response = $job_skill = array();
            
            if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else if (!isset($data->Skills) && !empty($data->Skills)) {
                $response['Error'] = 102;
                $response['Message'] = 'Skills not found';
            }else {     

                $_result = $this->master_model->getInlineQueryNoResult("DELETE FROM `ssc_userskill` WHERE `UserID`=".$data->UserID);
                foreach ($data->Skills as $k => $val) {
                    $val->UserSkillID = (!isset($val->UserSkillID)) ? '0' : $val->UserSkillID;
                    if($val->Name!='')
                    $status_succ = $this->master_model->getQueryResult("call usp_M_AddEditUserSkill('".$data->UserID."','".$val->Name."','".$val->UserSkillID."')");
                    $job_skill[] = $status_succ[0]->ID;
                }
                
                if(!empty($job_skill) && sizeof($job_skill) > 0 ){
                    $_result = implode(',', $job_skill);
                }
                //$_result = $this->master_model->getQueryResult("call usp_M_AddEditUserSkill('".$data->UserID."','".$data->SkillName."','".$data->UserSkillID."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Update skill successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('addEditUserSkill'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addEditUserSkill'=>$response);
        }
    }

    function editProfileSummary($data) {
        try{
            $response = array();
            
            if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            // }else if (!isset($data->ProfileSummary) && $data->ProfileSummary == '') {
            //     $response['Error'] = 102;
            //     $response['Message'] = 'Profile summary not found';
            }else {     
                $data->ProfileSummary = (!isset($data->ProfileSummary) || $data->ProfileSummary == '') ? '' : getStringClean($data->ProfileSummary);
                $_result = $this->master_model->getQueryResult("call usp_M_EditProfileSummary('".$data->UserID."','".$data->ProfileSummary."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Update profile summary successfully.';
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('editProfileSummary'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('editProfileSummary'=>$response);
        }
    }

    function addCompanyView($data) {
        try{
            $response = array();
            
            if (!isset($data->CompanyUserID) && $data->CompanyUserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Company not found';
            }else if (!isset($data->CandidateUserID) && $data->CandidateUserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Candidate not found';
            }else {     

                $_result = $this->master_model->getQueryResult("call usp_M_AddCompanyView('".$data->CompanyUserID."','".$data->CandidateUserID."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'add company view successfully.';
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('addCompanyView'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('addCompanyView'=>$response);
        }
    }

    function getUserProjectByUserID($data) {
        try{
            $response = array();
            
            if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else {     

                $_result = $this->master_model->getQueryResult("call usp_M_GetUserProjectByUserID('".$data->UserID."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Get project successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getUserProjectByUserID'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getUserProjectByUserID'=>$response);
        }
    }

    function getUserEmployementByUserID($data) {
        try{
            $response = array();
            
            if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else {     

                $_result = $this->master_model->getQueryResult("call usp_M_GetUserEmployementByUserID('".$data->UserID."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Get employement successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getUserEmployementByUserID'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getUserEmployementByUserID'=>$response);
        }
    }

    function editCVHeadline($data) {
        try{
            $response = array();
            
            if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            // }else if (!isset($data->CVHeadLine) && $data->CVHeadLine == '') {
            //     $response['Error'] = 102;
            //     $response['Message'] = 'CV head line not found';
            }else {     
                $data->CVHeadLine = (!isset($data->CVHeadLine) || $data->CVHeadLine=='') ? '' : getStringClean($data->CVHeadLine);
                $_result = $this->master_model->getQueryResult("call usp_M_EditCVHeadline('".$data->UserID."','".$data->CVHeadLine."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'update headline successfully.';
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('editCVHeadline'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('editCVHeadline'=>$response);
        }
    }

    function getCVData($data) {
        try{
            $response = array();
            $response['data'] = $response['Qualification'] = $response['Project'] = $response['Language'] = $response['Certificate'] = $response['Employement'] = $response['Skill'] = array();
            
            if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else {     

                $_result['Profile'] = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$data->UserID."','".base_url()."')");

                if (isset($_result['Profile']) && !empty($_result['Profile']) && !isset($_result['Profile']['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Get CV data successfully.';
                    $_result['Profile'][0]->CVDate ='';
                    $mno_list = explode('-', $_result['Profile'][0]->MobileNo);
                    $_result['Profile'][0]->CountryCode='';
                    if(count($mno_list) >= 2){
                        $_result['Profile'][0]->CountryCode=$mno_list[0];
                        $_result['Profile'][0]->MobileNo=$mno_list[1];
                    }

                    if(isset($_result['Profile'][0]->CVPath) && $_result['Profile'][0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$_result['Profile'][0]->CV_New_Name)){
                            //$_result[0]->CVDate = date ("F d Y H:i:s.", filemtime($_result[0]->CVPath));
                            $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$_result['Profile'][0]->CV_New_Name);
                            if($lastModified == NULL)
                                $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$_result['Profile'][0]->CV_New_Name));
                            $_result['Profile'][0]->CVDate = date("d M Y",$lastModified);
                    }
                    $response['data'] = $_result['Profile'][0];

                    if(isset($data->Type) && @$data->Type=='Other'){
                        $response['ProfileSummary'] = $response['data']->ProfileSummary;
                        $response['CVPath'] = $response['data']->CVPath;
                        $response['CVName'] = $response['data']->CVName;
                            
                        $response['CVHeadLine'] = $response['data']->CVHeadLine;

                        $response['OtherDetails'] = array(
                                                    'BirthYear'=>$response['data']->BirthYear,
                                                    'AgeGroupID'=>$response['data']->AgeGroupID,
                                                    'Gender'=>$response['data']->Gender,
                                                    'OtherGender'=>$response['data']->OtherGender,
                                                    'Address'=>$response['data']->Address,
                                                    'Pincode'=>$response['data']->Pincode,
                                                    // 'MaritualStatus'=>$response['data']->MaritualStatus,
                                                    // 'PermenantAddress'=>$response['data']->PermenantAddress,
                                                    'IsPhysicalChallenged'=>$response['data']->IsPhysicalChallenged,
                                                    'IsWorkPermit'=>$response['data']->IsWorkPermit,
                                                    'EthnicityID'=>@$response['data']->EthnicityID,
                                                    'EthnicityName'=>@$response['data']->EthnicityName,
                                                    'VisaStatus'=>@$response['data']->VisaStatus,
                                                    'HaveDrivingLicence'=>@$response['data']->HaveDrivingLicence,
                                                    'IsWillingToRelocate'=>@$response['data']->IsWillingToRelocate
                                                    );
                        $response['data'] = [];
                    } 

                    $response['Qualification'] = $this->master_model->getQueryResult("call usp_M_GetUserQualificationByUserID('".$data->UserID."')");
                    if (empty($response['Qualification']) || isset($response['Qualification']['0']->Message)) {
                        $response['Qualification'] = array();
                    }
                    $response['Project'] = $this->master_model->getQueryResult("call usp_M_GetUserProjectByUserID('".$data->UserID."')");
                    if (empty($response['Project']) || isset($response['Project']['0']->Message)) {
                        $response['Project'] = array();
                    }
                    $response['Language'] = $this->master_model->getQueryResult("call usp_M_GetUserLanguageByUserID('".$data->UserID."')");
                    if (empty($response['Language']) || isset($response['Language']['0']->Message)) {
                        $response['Language'] = array();
                    }
                    $response['Certificate'] = $this->master_model->getQueryResult("call usp_M_GetUserCertificateByUserID('".$data->UserID."')");
                    if (empty($response['Certificate']) || isset($response['Certificate']['0']->Message)) {
                        $response['Certificate'] = array();
                    }
                    $response['Employement'] = $this->master_model->getQueryResult("call usp_M_GetUserEmployementByUserID('".$data->UserID."')");
                    if (empty($response['Employement']) || isset($response['Employement']['0']->Message)) {
                        $response['Employement'] = array();
                    }
                    $response['Skill'] = $this->master_model->getQueryResult("call usp_M_GetUserSkillByUserID('".$data->UserID."')");
                    if (empty($response['Skill']) || isset($response['Skill']['0']->Message)) {
                        $response['Skill'] = array();
                    }

                    $response['ProfileStep'] = $this->master_model->getInlineQuery("SELECT Fn_M_GetCandidateProfileStepPer('".$data->UserID."') as Action");
                    if (empty($response['ProfileStep']['0']) || isset($response['ProfileStep']['0']->Message)) {
                        $response['ProfileStep'] = array();
                    }else{
                        $list = explode('~', $response['ProfileStep']['0']->Action);
                        if(!empty($list)){
                            $response['ProfileStep'] = array('Percentage'=>@$list[0],'RemainingAction'=>@$list[1]);
                        }else{
                            $response['ProfileStep'] = array();
                        }
                    }

                } else if (isset($_result['Profile']['0']->Message) && $_result['Profile']['0']->Message != "") {
                    $msg = explode('~',$_result['Profile']['0']->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getCVData'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCVData'=>$response);
        }
    }

    function getNotification($data) {
        try{
            $response = array();
            
            if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }else {     

                $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetNotification('".$data->PageSize."','".$data->CurrentPage."','".$data->UserID."','".base_url()."')");
                                    

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                
                    foreach ($_result as $k => $val) {

                        //$_result[$k]->JobDetail = [];
                        //$_result[$k]->UserDetail = [];
                        if($val->ActionType=='JobPost' || (@$val->JobPostID > 0 && @$val->UserType=='Candidate')){
                            if($val->ActionType=='JobPost'){
                                $val->JobPostID = $val->TypeID;
                            }
                            $job_data = $this->master_model->getQueryResult("call usp_M_GetJobByID('".$val->JobPostID."','".base_url()."','".$data->UserID."')");
                            if(!isset($job_data[0]->Skills) && !empty($job_data[0]->Skills)){
                                $job_data[0]->Skills = (json_decode($job_data[0]->Skills, true));
                            }else{
                                $job_data[0]->Skills = [];
                            }
                            $_result[$k]->ActionType='Job';
                            // $_result[$k]->JobDetail = $job_data[0];
                            $_result[$k]->Detail = $job_data[0];
                        }elseif($val->ActionType=='ApplyJob' || $val->ActionType=='Follow' || $val->ActionType=='Accept' || $val->ActionType=='DirectInvited' || $val->UserType=='Company' || $val->UserType=='Candidate'){
                             //$j_res = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$val->CreatedBy."','".base_url()."')");
                            if($val->UserType=='Candidate' && $val->CompanyUserID > 0){
                                $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$val->CompanyUserID."','".base_url()."')");
                            }else{
                                $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('".$val->CandidateUserID."','".base_url()."')");
                            }
                            if(!empty($profile[0]->UserID) && $profile[0]->UserID > 0){
                                $profile[0]->CVDate ='';
                                $mno_list = '';
                                if(@$profile[0]->MobileNo!='')
                                $mno_list = explode('-', $profile[0]->MobileNo);

                                if($profile[0]->UserType=='Company'){
                                    $follow_data = $this->master_model->getInlineQuery("SELECT Fn_Get_FollowCompanyByCandidate('".$profile[0]->UserID."','".$data->UserID."') AS Status");
                                    $profile[0]->IsFollow = @$follow_data[0]->Status;
                                }

                                $profile[0]->CountryCode='';
                                if(count($mno_list) >= 2){
                                    $profile[0]->CountryCode=$mno_list[0];
                                    $profile[0]->MobileNo=$mno_list[1];
                                }
                                if(isset($profile[0]->CVPath) && $profile[0]->CVPath!='' && file_exists(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name)){
                                        //$profile[0]->CVDate = date ("F d Y H:i:s.", filemtime($profile[0]->CVPath));
                                        $lastModified = @filemtime(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name);
                                        if($lastModified == NULL)
                                            $lastModified = filemtime(utf8_decode(str_replace('/system','',BASEPATH).CV_UPLOAD_PATH.$profile[0]->CV_New_Name));
                                        $profile[0]->CVDate = date("d M Y",$lastModified);
                                }
                                $_result[$k]->ActionType=$profile[0]->UserType;
                                 // $_result[$k]->UserDetail = $profile[0];
                                $_result[$k]->Detail = $profile[0];
                             }else{
                                // $_result[$k]->UserDetail = new stdClass;
                                $_result[$k]->Detail = new stdClass;
                             }
                             

                        }else{
                            
                                $tempDetail = json_decode($_result[$k]->Detail);
                                $_result[$k]->Detail = array();
                                $_result[$k]->Detail = $tempDetail;
                             
                        }

                        $_result[$k]->CreatedDate = $this->convertDateInString($val->CreatedDate);
                    }

                    $response['Error'] = 200;
                    $response['Message'] = 'Get notification successfully.';
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getNotification'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getNotification'=>$response);
        }
    }

    function convertDateInString($date){
        if($date ==''){
            return $date;
        }else{
             $current = strtotime(date("Y-m-d"));

             $datediff = $current - strtotime($date);
             $difference = ceil($datediff/(60*60*24));

             if($difference==0)
             {
                return 'Today';
             }
             // else if($difference > 1)
             // {
             //    return 'Future Date';
             // }
             // else if($difference > 0)
             // {
             //    return 'Tomarrow';
             // }
             else if($difference == 1)
             {
                return 'Yesterday';
             }
             else if($difference > 1 && $difference < 30)
             {
                return $difference . ' day ago';
             }
             else
             {
                return $date;
             }
        }
    }

    function getMentor($data) {
        try{
            $response = array();
                

                $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetMentor('".$data->PageSize."','".$data->CurrentPage."','".base_url()."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Get mentor successfully.';
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            
            return array('getMentor'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getMentor'=>$response);
        }
    }

    function getLanguage($data) {
        try{
            $response = array();
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetLanguage()");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Get language successfully.';
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            
            return array('getLanguage'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getLanguage'=>$response);
        }
    }

    function getVideos($data) {
        try{
            $response = array();
                
            if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found';
            }elseif (!isset($data->MentorID) && $data->MentorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Mentor not found';
            }else { 

                $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetVideos('".$data->PageSize."','".$data->CurrentPage."','".$data->MentorID."','".$data->UserID."','".base_url()."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Get video successfully.';
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getVideos'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getVideos'=>$response);
        }
    }

    function updateJobStatus($data=array()) {
        try{
            $response = array();

            if (!isset($data->JobPostID) || $data->JobPostID == ''){
                $response['Error'] = 102;
                $response['Message'] = 'Job not found.';//
            } elseif (!isset($data->Status) || $data->Status == ''){
                $response['Error'] = 102;
                $response['Message'] = 'Status not found.';//'New','Open','InActive','Closed'
            } else {
                $_result = $this->master_model->getQueryResult("call usp_M_UpdateJobStatus('".$data->JobPostID."','".$data->Status."')");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Update status successfully.';
                    //$response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('updateJobStatus'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('updateJobStatus'=>$response);
        }
    }

    function pushNotificationAccess($data=array()) {
        try{
            $response = array();

            if (!isset($data->UserID) || $data->UserID == ''){
                $response['Error'] = 102;
                $response['Message'] = 'Job not found.';//
            } elseif (!isset($data->Status) || $data->Status == ''){
                $response['Error'] = 102;
                $response['Message'] = 'Status not found.';//'New','Open','InActive','Closed'
            } else {
                $_result = $this->master_model->getQueryResult("call usp_M_ChangePushNotification('".$data->UserID."','".$data->Status."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Update status successfully.';
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('pushNotificationAccess'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('pushNotificationAccess'=>$response);
        }
    }

    function getAdvertisement(){
        
        $_result = $this->master_model->getQueryResult("call usp_M_GetAdvertisement('". base_url() ."')");
        if(!empty($_result) && !isset($_result[0]->Message)){
            return $_result[0];
        }else{
            return array();
        }
    }

     function getCompanyByCandidateID($data) {
        try{
            $response = array();
            
        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        } else {

                $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                $_result = $this->master_model->getQueryResult("call usp_M_GetCompanyByCandidateID('".
                                            $data->PageSize."','".
                                            $data->CurrentPage."','".
                                            $data->UserID."','".
                                            base_url()."')");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Company listed successfully.';
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getCandidateList'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCandidateList'=>$response);
        }
    }

    function deleteCV($data=array()) {
        try{
            $response = array();

            if (!isset($data->UserID) || $data->UserID == ''){
                $response['Error'] = 102;
                $response['Message'] = 'User not found.';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_M_UpdateDeleteCV('".$data->UserID."','','1','')");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Delete content successfully.';
                    //$response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('deleteCV'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('deleteCV'=>$response);
        }
    }

    function deletePic($data=array()) {
        try{
            $response = array();

            if (!isset($data->UserID) || $data->UserID == ''){
                $response['Error'] = 102;
                $response['Message'] = 'User not found.';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_M_EditProfilePic('".$data->UserID."','')");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    if(@$_result[0]->Type=='Company' && $_result[0]->OldPic!=''){
                        unlink(COMPANYLOGO_UPLOAD_PATH . $_result[0]->OldPic);
                        unlink(COMPANYLOGO_THUMB_UPLOAD_PATH . $_result[0]->OldPic);
                    }elseif(@$_result[0]->Type=='Candidate' && $_result[0]->OldPic!=''){
                        unlink(CANDIDATE_UPLOAD_PATH . $_result[0]->OldPic);
                        unlink(CANDIDATE_THUMB_UPLOAD_PATH . $_result[0]->OldPic);
                    }
                    $response['Error'] = 200;
                    $response['Message'] = 'Delete content successfully.';
                    //$response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('deletePic'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('deletePic'=>$response);
        }
    }

    //----------------------- Upload photos ----------------------
    /*
     *   @params : UserID 
     *   @params : AccessType  0 = Author , 1 = channel
     *
     */
    function addUploadPics($data=array()) {

        $response = $_result = $result = array();
        $AccessType     = $data['AccessType'];
        $UserID         = $data['UserID'];

        if (!isset($UserID) || $UserID == '') {
            $response['Error']      = 102;
            $response['Message']    = 'User not found';
        }elseif ((!isset($AccessType) || $AccessType == '') || ($AccessType != 'Candidate' && $AccessType != 'Company' && $AccessType != 'CV')) {
            $response['Error'] = 102;
            $response['Message'] = 'Access type not found';
        }else { 

            if ($_FILES['ImageData']['error'] == 0) {

                $_FILES['ImageData']['type'] = stripslashes($_FILES['ImageData']['type']);
                // $UserID = $_POST['UserID'];
                if($AccessType=='Candidate'){
                    $pathMain       = CANDIDATE_UPLOAD_PATH;
                    $pathThumb      = CANDIDATE_THUMB_UPLOAD_PATH;
                    $path           = CANDIDATE_UPLOAD_PATH;
                    $max_size       = CANDIDATE_MAX_SIZE;
                    $allowed_types  = CANDIDATE_ALLOWED_TYPES;//PROFILE_PIC_ALLOWED_TYPES;
                }elseif($AccessType=='Company'){
                    $pathMain       = COMPANYLOGO_UPLOAD_PATH;
                    $pathThumb      = COMPANYLOGO_THUMB_UPLOAD_PATH;
                    $path           = COMPANYLOGO_UPLOAD_PATH;
                    $max_size       = COMPANYLOGO_MAX_SIZE;
                    $allowed_types  = COMPANYLOGO_ALLOWED_TYPES;//PROFILE_PIC_ALLOWED_TYPES;
                }elseif($AccessType=='CV'){
                    $pathMain       = CV_UPLOAD_PATH;
                    $path           = CV_UPLOAD_PATH;
                    $pathThumb      = '';
                    $max_size       = CV_MAX_SIZE;
                    $allowed_types  = CV_ALLOWED_TYPES;//PROFILE_PIC_ALLOWED_TYPES;
                }

                $imageNameTime = time();
                $file_name= $imageNameTime . "_" . $data['UserID'];
                //$result = do_upload("ImageData", $pathMain, $filename);
                $CV_real_name = @$_FILES['ImageData']['name'];

                $uploadFile = 'ImageData';
                $result = array();
                $result = do_upload($uploadFile, $allowed_types, $path, $file_name);

// $response['addUploadPics']['data'] = $data;        
// $response['addUploadPics']['image'] = $_FILES['ImageData'];
// $response['addUploadPics']['image_data'] = $result;  
// echo  json_encode($response);exit();
                if(isset($result['error']) && @$result['error']!=''){
                    $result['error'] = str_replace('<p>', '', $result['error']);
                    $result['error'] = str_replace('</p>', '', $result['error']);
                }

                if ($result['status'] == 1) {
                    //$result['CVName'] = $CV_real_name;
                    // RESIZE ORIGINAL IMAGE TO THUMB 150X150
                    $uploadedFileName = $result['upload_data']['file_name'];

                    if($AccessType=='Candidate'){
                        // $this->db->where('AttendeeID', $data['UserID']);
                        // $result = $this->db->update('ssh_attendee', array('ImageURL' => $uploadedFileName));
                        $_result = $this->master_model->getQueryResult("call usp_M_EditProfilePic('".$UserID."','".$uploadedFileName."')");
                        $SourcePath     = CANDIDATE_UPLOAD_PATH . $uploadedFileName;
                        $DesPath        = CANDIDATE_THUMB_UPLOAD_PATH . $uploadedFileName;
                        $max_width      = CANDIDATE_THUMB_MAX_WIDTH;
                        $max_height     = CANDIDATE_THUMB_MAX_HEIGHT;

                        if(@$_result[0]->Type=='Candidate' && @$_result[0]->OldPic!=''){
                            unlink(CANDIDATE_UPLOAD_PATH . $_result[0]->OldPic);
                            unlink(CANDIDATE_THUMB_UPLOAD_PATH . $_result[0]->OldPic);
                        }

                    }elseif($AccessType=='Company'){
                        // $this->db->where('UserID', $data['UserID']);
                        // $result = $this->db->update('ssh_customers', array('PhotoURL' => $uploadedFileName));
                        $_result = $this->master_model->getQueryResult("call usp_M_EditProfilePic('".$UserID."','".$uploadedFileName."')");
                        $SourcePath     = COMPANYLOGO_UPLOAD_PATH . $uploadedFileName;
                        $DesPath        = COMPANYLOGO_THUMB_UPLOAD_PATH . $uploadedFileName;
                        $max_width      = COMPANYLOGO_THUMB_MAX_WIDTH;
                        $max_height     = COMPANYLOGO_THUMB_MAX_HEIGHT;

                        if(@$_result[0]->Type=='Company' && @$_result[0]->OldPic!=''){
                            unlink(COMPANYLOGO_UPLOAD_PATH . $_result[0]->OldPic);
                            unlink(COMPANYLOGO_THUMB_UPLOAD_PATH . $_result[0]->OldPic);
                        }
                    }elseif($AccessType=='CV'){
                        // $this->db->where('UserID', $data['UserID']);
                        // $result = $this->db->update('ssh_customers', array('PhotoURL' => $uploadedFileName));
                        $_result = $this->master_model->getQueryResult("call usp_M_UpdateDeleteCV('".$UserID."','".$uploadedFileName."','0','".$CV_real_name."')");
                    }

                        if($AccessType!='CV'){                            
                           
                            list($w, $h, $type, $attr) = getimagesize($SourcePath);
                            if (!(($w <= $max_width) && ($h <= $max_height))){
                                $ratio = $max_width / $w;
                                $new_w = $max_width;
                                $new_h = $h * $ratio;
                                
                                //if that didn't work
                                if ($new_h > $max_height) {
                                    $ratio = $max_height / $h;
                                    $new_h = $max_height;
                                    $new_w = $w * $ratio;
                                }
                            }else{
                                $new_w = $w;
                                $new_h = $h;
                            }
                            $new_image = imagecreatetruecolor($new_w, $new_h);
                            $type = explode('.', $CV_real_name);
                            // $file_url = $result['upload_data']['full_path']; //str_replace('./', '', base_url().CANDIDATE_UPLOAD_PATH.$uploadedFileName);
                           switch(strtolower($type[1]))
                                {
                                    case 'jpeg':
                                    case 'jpg':
                                    case 'JPG':
                                        $image = imagecreatefromjpeg($SourcePath);
                                        break;
                                    case 'png':
                                    case 'PNG':
                                        $image = imagecreatefrompng($SourcePath);
                                        break;
                                    case 'gif':
                                        $image = imagecreatefromgif($SourcePath);
                                        break;
                                    default:
                                        exit('Unsupported type: '.$SourcePath);
                                }
                            imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
                            // output
                            imagejpeg($new_image, $DesPath, 90);
                        }

                    $response['addUploadPics']['Error'] = 200;
                    $response['addUploadPics']['Message'] = 'Photo uploaded successfully.';

                    $response['addUploadPics']['data'] = $_result;
                    $response['addUploadPics']['image_data'] = $result;
                    if($AccessType=='Candidate'){
                        $response['addUploadPics']['PhotoURL'] = str_replace('./', '', base_url().CANDIDATE_UPLOAD_PATH.$uploadedFileName);
                    }elseif($AccessType=='Company'){
                        $response['addUploadPics']['PhotoURL'] = str_replace('./', '', base_url().COMPANYLOGO_UPLOAD_PATH.$uploadedFileName);
                    }elseif($AccessType=='CV'){
                        $response['addUploadPics']['PhotoURL'] = str_replace('./', '', base_url().CV_UPLOAD_PATH.$uploadedFileName);
                        $response['addUploadPics']['CVDate'] = date('d M Y');
                        $response['addUploadPics']['CVName'] = @$CV_real_name;
                        $response['addUploadPics']['Message'] = 'File uploaded successfully.';
                    }else{
                        $response['addUploadPics']['PhotoURL'] = '';
                        $response['addUploadPics']['Error'] = 102;
                        $response['addUploadPics']['Message'] = 'Error has been occurred please try again later.';
                        $response['addUploadPics']['data'] = $_result;
                        $response['addUploadPics']['image_data'] = $result;
                    }
                } else {
                    $response['addUploadPics']['Error'] = 102;
                    $response['addUploadPics']['Message'] = 'Error has been occurred please try again later.';
                    $response['addUploadPics']['data'] = $_result;
                    $response['addUploadPics']['image_data'] = $result;
                }
            } else {
                $response['addUploadPics']['Error'] = 102;
                $response['addUploadPics']['Message'] = 'Error has been occurred please try again later.';
            }
        }

        return $response;exit();
    } 

    function getCandidateInterview($data) {
        try{
            $response = array();
            
        if (!isset($data->UserID) || $data->UserID == ''){
            $response['Error'] = 102;
            $response['Message'] = 'User not found.';
        } elseif (!isset($data->Type) || $data->Type == ''){
            $response['Error'] = 102;
            $response['Message'] = 'Type not found.';
        } else {

                $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                $data->Type = (isset($data->Type) || @$data->Type!='') ? $data->Type : 'JobPost';
                $data->Action = (isset($data->Action) || @$data->Action!='') ? $data->Action : 'Invited';
                
                $_result = $this->master_model->getQueryResult("call usp_M_GetCandidateInterview('".$data->PageSize."','".$data->CurrentPage."','".$data->UserID."','".$data->Type."','".$data->Action."','".base_url()."')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Your scheduled interview listed successfully.';
                    foreach ($_result as $k => $val) {
                        if($data->Type=='JobPost' || $data->Type!='Company')
                        $_result[$k]->Skills = (json_decode($_result[$k]->Skills, true));
                        $mno_list = array();
                        $mno_list = explode('-', $_result[$k]->MobileNo);
                        $_result[$k]->CountryCode='';
                        if(count($mno_list) >= 2){
                            $_result[$k]->CountryCode=$mno_list[0];
                            $_result[$k]->MobileNo=$mno_list[1];
                        }
                    }
                        
                    $response['data'] = $_result;
                    $response['advertisement'] = $this->getAdvertisement();
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~',$_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getCandidateInterview'=>$response);
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getCandidateInterview'=>$response);
        }
    }


    // -------------- Send Push notification--------------------
    function mobile_notify($VideoId = 1, $UserID = 17, $DeviceTokenID){
        $pushNotificationArr = array('device_id'=>$DeviceTokenID,
                                    'message'=>'Send msg for testing',
                                    'title'=>'CVBuilder',
                                    'detail'=>array('UserID'=>$UserID,
                                                    'VideoID'=>$VideoId,
                                                    'ActionType'=>'Video'
                                        )
                                );
        $res = sendPushNotification($pushNotificationArr);
        print_r($res);die;
    }

}