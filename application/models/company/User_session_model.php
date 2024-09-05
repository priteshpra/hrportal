<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_session_model extends CI_Model 
{
    function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('common_helper');
    }

    public function checkLogin($login_data_array){
      $sql = "call usp_A_CheckLogin('".
                    $login_data_array['email'] . "','".
                    fnEncrypt($this->input->post('password'), $this->config->item('sSecretKey'))."','". $this->WebType."')";

        $query = $this->db->query($sql);
        $query->next_result($sql);        
        $user_data = $query->result_array();
        return $user_data;
    }
    
    public function editProfile($data){  
        $data['UserID'] = $this->session->userdata['UserID'];
        $data['CompanyName'] = getStringClean((isset($data['CompanyName'])) ? $data['CompanyName'] : NULL);
        $data['FirstName'] = getStringClean((isset($data['FirstName'])) ? $data['FirstName'] : NULL);
        $data['LastName'] = getStringClean((isset($data['LastName'])) ? $data['LastName'] : NULL);
        $data['Address'] = getStringClean((isset($data['Address'])) ? $data['Address'] : '');
        $data['CountryID'] = getStringClean((isset($data['CountryID'])) ? $data['CountryID'] : 0);
        $data['StateID'] = getStringClean((isset($data['StateID'])) ? $data['StateID'] : 0);
        $data['CityID'] = getStringClean((isset($data['CityID'])) ? $data['CityID'] : 0);
        $data['DesignationID'] = getStringClean((isset($data['DesignationID'])) ? $data['DesignationID'] : 0);
        $data['StatusText'] = getStringClean((isset($data['StatusText'])) ? $data['StatusText'] : '');
        $data['WebsiteURL'] = getStringClean((isset($data['WebsiteURL'])) ? $data['WebsiteURL'] : '');
        $data['Latitude'] = getStringClean((isset($data['Latitude'])) ? $data['Latitude'] : '');
        $data['Longitude'] = getStringClean((isset($data['Longitude'])) ? $data['Longitude'] : '');
        $data['MobileNo'] = getStringClean((isset($data['MobileNo'])) ? $data['MobileNo'] : NULL);
        $data['FacebookURL'] = getStringClean((isset($data['FacebookURL'])) ? $data['FacebookURL'] : '');
        $data['LinkedinURL'] = getStringClean((isset($data['LinkedinURL'])) ? $data['LinkedinURL'] : '');
        $data['CompanyLogo'] = getStringClean((isset($data['image'])) ? $data['image'] : '');
        $sqlpic = "CALL usp_M_EditProfilePic('".
                    $data['UserID']."','".
                    $data['CompanyLogo']."');";
        $sql = "CALL usp_M_EditCompany('" . 
                $data['UserID'] . "','" . 
                $data['CompanyName'] . "','" .
                $data['FirstName'] . "','" . 
                $data['LastName'] . "','" . 
                $data['Address'] . "','" . 
                $data['CountryID'] . "','" . 
                $data['StateID'] . "','" . 
                $data['CityID'] . "','" . 
                $data['DesignationID'] . "','" . 
                $data['StatusText'] . "','" . 
                $data['WebsiteURL'] . "','" . 
                $data['Latitude'] . "','" . 
                $data['Longitude'] . "','" . 
                $data['MobileNo'] . "','" . 
                $data['FacebookURL'] . "','" . 
                $data['LinkedinURL'] . "')";
        $query = $this->db->query($sql);
        $query->next_result(); 
        $query1 = $this->db->query($sqlpic);
        $query1->next_result(); 
        return $query->row_array();
    }
    public function checkIfCurrentPasswordMatches() {
        $data = array();
        $data['Password'] = fnEncrypt($this->input->post('current_password'), $this->config->item('sSecretKey'));
        $sql = "call usp_A_CheckCurrentPassword('" . 
                $this->session->userdata['UserID'] . "','" . 
                $data['Password'] . "')";
        $query = $this->db->query($sql);
        $query->next_result(); 
        return $query->row();
    }
    public function checkIfEmailIDIsRegistered($email_id = null) {
        $user_type = array();
        $query = $this->db->query("call usp_A_CheckUserExist('".$email_id."')");
        $query->next_result();
        $user_array = $query->row_array();
        if(@$user_array['ID'] == 1 && @$user_array['UserType'] == "Company"){
            return 1;
        }else{
            return 0;
        }
    }
    public function changePassword($new_password = null,$old_pass) {
        $data['ID'] = $this->session->userdata['UserID'];       
        $data['UserID'] = $this->session->userdata['UserID'];
        $data['Password'] = fnEncrypt($new_password, $this->config->item('sSecretKey'));
        $data['CPassword'] = fnEncrypt($old_pass, $this->config->item('sSecretKey'));
        $sql = "call usp_M_ChangePassword('" . 
                $data['ID'] . "','" .
                $data['CPassword'] . "','" . 
                $data['Password'] . "')";
        $query = $this->db->query($sql);
        $query->next_result(); 
        return $query->row_array();
    }
    public function currentUserProfileData(){
        $query = $this->db->query("call usp_A_GetAdminByID('".$this->session->userdata['UserID']."')");      
        $query->next_result();          
        return $query->row();
    }
    function getUserComboBox(){
        $query = $this->db->query("call usp_A_GetUser_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    public function CheckMobile(){
        $contact = $this->input->post('MobileNo');
        $id = $this->session->userdata['UserID'];
        $query = $this->db->query("call usp_A_CheckEmailMobileExist('','".$contact."','".$id."')");
        $query->next_result();
        return $query->row();
    }
    public function setResetPassword($data){
        $query = $this->db->query("call usp_M_ResetPassword('".
                            $data['EmailID']."','".
                            fnEncrypt($data['NewPassword'], $this->config->item('sSecretKey')).
                            "','Web')");
        $query->next_result();
        return 1;
    }
    
    public function findUserByForgotPasswordLink($random_string = null){
        $user_type = array();
        $user_type = getUserType();
     
        $query = $this->db->query("call usp_A_GetUserByForgotPasswordLink('".$random_string."','".$user_type['types']['Admin']."')");
        
        $query->next_result();
        $user_array = $query->row_array();
        return $user_array;
    }
    
    public function resetPassword($reset_password_data) {
        $user_type = array();
        $user_type = getUserType();
       
        $this->db->query("call usp_A_ResetUserPassword('".$reset_password_data['user_id']."','".fnEncrypt($reset_password_data['new_password'], $this->config->item('sSecretKey'))."','".$user_type['types']['Admin']."')");
        return 1;
    }
    
    public function getDashboard(){
        $user_type = array();
        $ID = $this->session->userdata['UserID'];
        $query = $this->db->query("call usp_M_GetDashboard($ID)");
        
        $query->next_result();
        $user_array = $query->row_array();
        return $user_array;
    }
    public function ListNotification($data)
    {
       $user_id = '89';
       // $user_id = $this->session->userdata['UserID'];
       $sql = "CALL usp_M_GetNotification('". 
            $data['per_page_record'] . "','". 
            $data['page_number'] . "','". 
            $user_id .
            "')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();

    }

    
}