<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usersession extends Admin_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('admin/user_session_model');
        $this->load->helper("phpmailerautoload");
    }

    public  function adminlogin(){        
        $this->load->view('admin/usersession/login_form');        
    }

    public function notification(){
        $result = $data = array();
        $this->load->view('admin/includes/header');

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);

        $this->load->view('admin/usersession/notification_detail', $result);
        $data['page_level_js'] = $this->load->view('admin/usersession/notification_detail_js', NULL, TRUE);
        $data['footer']['listing_page'] = 'yes';
        $this->load->view('admin/includes/footer', $data);
        unset($state_result, $data);
    }
    
    public function postLogin(){
        $data = array();
        $user_data = $this->user_session_model->checkLogin($this->input->post());
        if(sizeof($user_data) > 0 && !empty($user_data)){ 
            $this->session->set_userdata($user_data[0]);
            $this->session->set_userdata('language', 'english');
        }
        if(count($user_data) > 0 && !empty($user_data) && !isset($user_data['0']['Message'])){ 
            redirect($this->config->item('base_url').'admin-dashboard/');
        }else{
            $message = explode('~',$user_data['0']['Message']);
            $this->session->set_flashdata('posterror',$message[1]);
            redirect($this->config->item('base_url').'admin-login');
        }
    }
    public function myProfile(){
        $data = $res =  array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
            $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
            $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $res = $this->user_session_model->editProfile($this->input->post());
                //pr($res);die(); 
                $this->session->set_userdata($res);
                $this->session->set_userdata('language', 'english');
                if (@$res['UserID']) {
                    //$this->session->set_flashdata('postsuccess',label('profile_update_successful'));
                    redirect($this->config->item('base_url') . 'admin-dashboard/');
                } else {
                    $this->session->set_flashdata('posterror',label('please_try_again'));
                    redirect($this->config->item('base_url') . 'my-profile');
                }
            }else{
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'my-profile');
            }
        }
        $data['profile'] = $this->user_session_model->currentUserProfileData();
        //pr($data['profile']);die();
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/usersession/my_profile',$data);
        $res['page_level_js'] = $this->load->view('admin/usersession/my_profile_js', NULL, TRUE);
        $res['footer']['listing_page'] = 'no';
        $this->load->view('admin/includes/footer', $res);
        unset($data,$res);
    }
    public function changePassword(){
        $data = array(); 
        $this->load->view('admin/includes/header');
        $this->load->view('admin/usersession/change_password');
        $data['page_level_js'] = $this->load->view('admin/usersession/change_password_js', NULL, TRUE);
        $data['footer']['listing_page'] = 'no';
        $this->load->view('admin/includes/footer', $data);
        unset($data);
    }
    public function postChangePassword(){
        
        $resu = $this->user_session_model->checkIfCurrentPasswordMatches($this->input->post('current_password'));
        
        if(@$resu->cnt == 0 && !isset($resu->cnt)){
            $this->session->set_flashdata('posterror', label('old_password_does_not_match'));
            redirect($this->config->item('base_url').'change-password');
        }
        $res = $this->user_session_model->changePassword($this->input->post('new_password'),$this->input->post('current_password'));
        $msg = explode('~',$res['Message']);
        if($msg[0] == 200){
            $this->session->set_flashdata('postsuccess', $msg[1]);
        }else{
            $this->session->set_flashdata('posterror', $msg[1]);
        }
        redirect($this->config->item('base_url').'change-password');
    }
    public function forgotPassword(){
        $data = array(); 
        $this->load->view('admin/usersession/forgot_password_form');
        unset($data);
        
    }
    public function resetpassword(){
        $data = array(); 
        $this->load->view('admin/usersession/forgot_password_form');
        unset($data);
    }
    
    public function postResetPassword(){
            $random_string = time();
            $data = array();
            $data['EmailID'] = trim($this->input->post('email_id'));
            $data['NewPassword'] = $random_string;
            $res = $this->user_session_model->setResetPassword($data);
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
    
    public function adminLogout(){
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) 
        {
            if($key == "Company"){
                Continue;
            }
            $this->session->unset_userdata($key);
        }
        $this->session->sess_destroy();
        redirect($this->config->item('base_url').'admin-login');
    }
    
    public function checkIfEmailIDIsRegistered(){
        $res = $this->user_session_model->checkIfEmailIDIsRegistered($this->input->post('email_id'));
        echo $res;exit;
    }
    
    public function checkIfCurrentPasswordMatches(){
        $res = $this->user_session_model->checkIfCurrentPasswordMatches($this->input->post('current_password'));
        echo @$res->cnt;exit;
    }

    public function ajax_notification($per_page_record=10,$page_number =1)
    {  
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['notify'] = $this->user_session_model->ListNotification($result); 
        if(isset($result['notify'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['notify'][0]->rowcount;
            
            $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
            $ajax_listing = $this->load->view('admin/usersession/ajax_listing_notification', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
            echo json_encode(array('a'=>'<tr><td colspan="12" style="text-align: center;">No Notifications.</td></tr>', 'b'=>''));
     }
}