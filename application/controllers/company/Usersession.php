<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usersession extends Company_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('company/user_session_model');
    }

    public function companylogin(){    
        $this->load->view('company/usersession/login_form');        
    }

    
    public function postLogin(){
        $data = array();
        $data = $this->user_session_model->checkLogin($this->input->post());

        if(sizeof($data) > 0 && !empty($data)){ 
            $this->session->set_userdata($data[0]);
            $this->session->set_userdata('language', 'english');
        }
        if(count($data) > 0 && !empty($data) && !isset($data['0']['Message'])){ 
            redirect($this->config->item('base_url').'company-dashboard/');
        }else{
            $message = explode('~',$data['0']['Message']);
            $this->session->set_flashdata('posterror',$message[1]);
            redirect($this->config->item('base_url').'company-login');
        }
    }
    public function myProfile($ID = NULL){

        $data = $res =  array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
            $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
            $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                 $url = site_url("company/masters/company/myProfile".$ID);
                    $config = array("max_width" =>  COMPANYLOGO_MAX_WIDTH,
                        "max_height" => COMPANYLOGO_MAX_HEIGHT,
                        'max_size' => COMPANYLOGO_MAX_SIZE,
                        'path' => COMPANYLOGO_UPLOAD_PATH,
                        'allowed_types' => COMPANYLOGO_ALLOWED_TYPES,
                        'tpath' => COMPANYLOGO_THUMB_UPLOAD_PATH,
                        'twidth' => COMPANYLOGO_THUMB_MAX_WIDTH,
                        'theight' => COMPANYLOGO_THUMB_MAX_HEIGHT
                    );
                    $data = $this->input->post();
                    $data['image'] = FileUploadURL("userfile", "editProfilePicture", $config, '', $url);
                    //print_r($data['image']);die();
                    
                    $data['ID'] = $ID;
                $res = $this->user_session_model->editProfile($data);
                if (@$res['UserID']) {
                    $this->session->set_userdata($res);
                    $this->session->set_userdata('language', 'english');
                    $this->session->set_flashdata('postsuccess',label('profile_update_successful'));
                    redirect($this->config->item('base_url') . 'company-dashboard/');
                } else {
                    $this->session->set_flashdata('posterror',label('please_try_again'));
                    redirect($this->config->item('base_url') . 'company-profile');
                }
            }else{
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'company-profile');
            }
        }

        $data['profile'] = $this->user_session_model->currentUserProfileData();
        $data['loading_button'] = getLoadingButton();
        $data['designation'] = getDesignationCombobox($data['profile']->DesignationID);
        $data['country'] = getCountryStateComboBox($data['profile']->CountryID);
        $data['state'] = getStateBasedCombobox($data['profile']->StateID,@$data['profile']->CountryID);  
        $data['city'] = GetCityBasedState($data['profile']->CityID,@$data['profile']->StateID);
        $this->load->view('company/includes/header');
        $this->load->view('company/usersession/my_profile',$data);
        $res['page_level_js'] = $this->load->view('company/usersession/my_profile_js', NULL, TRUE);
        $res['footer']['listing_page'] = 'no';
        $this->load->view('company/includes/footer', $res);
        unset($data,$res);
    }

    public function CheckMobile(){
        if($this->input->post()){
            $res = $this->user_session_model->CheckMobile();
            if($res->contactcount > 0){
                echo label('cellphone_already_exists');exit();
            }else{
                echo 1; exit;
            }
        }
    }
    public function changePassword(){
        $data = array(); 
        $this->load->view('company/includes/header');
        $this->load->view('company/usersession/change_password');
        $data['page_level_js'] = $this->load->view('company/usersession/change_password_js', NULL, TRUE);
        $data['footer']['listing_page'] = 'no';
        $this->load->view('company/includes/footer', $data);
        unset($data);
    }
    public function postChangePassword(){
        $resu = $this->user_session_model->checkIfCurrentPasswordMatches($this->input->post('current_password'));
        //print_r($resu);die();
        if(@$resu->cnt == 0 && !isset($resu->cnt)){
            $this->session->set_flashdata('posterror', label('old_password_does_not_match'));
            redirect($this->config->item('base_url').'company-change-password');
        }
        $res = $this->user_session_model->changePassword($this->input->post('new_password'),$this->input->post('current_password'));
        $msg = explode('~',$res['Message']);
        if($msg[0] == 200){
            $this->session->set_flashdata('postsuccess', $msg[1]);
        }else{
            $this->session->set_flashdata('posterror', $msg[1]);
        }
        redirect($this->config->item('base_url').'company-dashboard/');
    }
    public function forgotPassword(){
        $data = array(); 
        $this->load->view('company/usersession/forgot_password_form');
        unset($data);
        
    }
    public function resetpassword(){
        $data = array(); 
        $this->load->view('company/usersession/forgot_password_form');
        unset($data);
    }
    
    public function postResetPassword(){
            $random_string = time();
            $data = array();
            $data['EmailID'] = trim($this->input->post('email_id'));
            $data['NewPassword'] = $random_string;
            $res = $this->user_session_model->setForgotPasswordLink($data);
            $email_details = '<div><center><div>Your New Password is : ##NEW_PASSWORD##</div></center></div>';            
            $array['ToEmailID'] = $this->input->post('email_id');
            $array['Subject']  = 'Forgot Password';
            $array['Body'] = $email_details; 
            $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
            $array['FromName'] = DEFAULT_FROM_NAME;
            $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
            $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
            $array['AltBody'] = '';  
            $search_array = array('##NEW_PASSWORD##');                
            $replace_array = array($data['NewPassword']);
            $array['Body'] = str_replace($search_array, $replace_array, $array['Body']);
            CustomMail($array);          
            $this->session->set_flashdata('postsuccess', 'New Password reset is sent to your registered email id.');
            redirect($this->config->item('base_url').'admin-reset-password');
        
    }
    
    public function Logout(){
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) 
        {
            $this->session->unset_userdata($key);
        }
        $this->session->sess_destroy();
        redirect($this->config->item('base_url').'company-login');
    }
    
    public function checkIfEmailIDIsRegistered(){
        $res = $this->user_session_model->checkIfEmailIDIsRegistered($this->input->post('email_id'));
        echo $res;exit;
    }
    
    public function checkIfCurrentPasswordMatches(){
        $res = $this->user_session_model->checkIfCurrentPasswordMatches($this->input->post('current_password'));
        echo @$res->cnt;exit;
    }


    public function changeStatus() {

        if($this->cur_module->is_status == 0){
            echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
            die;
        }
         try {
            if ($this->input->post()) {
                $res = $this->employeedetails_model->changeStatus($this->input->post());
                if($res){
                    $message = ($this->input->post('status') == 1)?label('status_active'):label('status_inactive');    
                    echo json_encode(array('result' => 'success','message'=>$message));
                }else{
                    echo json_encode(array('result' => 'error',label('please_try_again')));
                }
            }
        } catch (Exception $e) {
            echo json_encode(array('result' => 'error','message'=>$e->getMessage()));
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
}