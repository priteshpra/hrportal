<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MY_Controller Class
 *
 *
 * @package Project Name
 * @subpackage  Controllers
 */
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->form_validation->set_error_delimiters('<div class="form-error">', '</div>');
    }

    
    function changeStatus() {
        if ($this->input->post()) {
            $this->common_model->changeStatus($this->input->post());
        }
    }

}

class LoggedIn extends MY_Controller {

    public function __construct() {
        parent::__construct();
        /* if (is_logged_in() == FALSE) {
          $this->session->set_userdata('return_to', uri_string());
          $this->session->set_flashdata('message', 'You need to log in.');
          redirect('/home');
          } */
    }

}

class Front_Controller extends LoggedIn {

    function __construct() {
        parent::__construct();
        $this->load->library('facebook');
        $this->load->library('googleplus');

        $current_controller = $this->router->fetch_class();
        $current_method = $this->router->fetch_method();

        $without_login_methods = array('login', 'signup', 'googlelogin', 'fblogin', 'callback', 'forgotpassword');
        $with_login_methods = array('editprofile', 'profile', /* 'ajax_listing', */ 'addstory', 'bookmark', '');


        $with_login_controllers = array(/* 'Story','Publication', */'Author');

        //$with_login_controllers = array_map('strtolower', $with_login_controllers);

        $user_session = $this->session->userdata("user_data");

        if (isset($user_session['AuthorID'])) {//if(isset($this->session->userdata['UserID']))
            // Session is registered
            if (in_array($current_method, $without_login_methods)) {
                redirect($this->config->item('base_url') . 'home');
            }
        } else {
            // Session is not registered
            if (in_array($current_method, $with_login_methods) || in_array($current_controller, $with_login_controllers)) {
                redirect($this->config->item('base_url') . 'author-login');
            }
        }
    }
    
}

class Admin_Controller extends LoggedIn {

    function __construct() {
        parent::__construct();
        $current_controller = $this->router->fetch_class();
        $current_method = $this->router->fetch_method();
        $this->module_data = array();
        $this->UserRoleID = NULL;
        $this->WebType = "Admin";
        $without_login_methods = array('adminlogin', 'forgotPassword', 'resetPassword', 'postLogin','postResetPassword','checkIfEmailIDIsRegistered','label');
        //$this->session->set_userdata('language', 'english');
        $with_login_methods = array('adminLogout', 'changePassword', 'myProfile', 'editMyProfile', 'postEditMyProfile','checkIfEmailIDIsRegistered');
        if (isset($this->session->userdata['UserID'])) {
            if(@$this->session->userdata['UserType'] == "Admin" || @$this->session->userdata['UserType'] == "Employee"){
                $UserID = $this->session->userdata['UserID'];
                $this->UserRoleID = $this->session->userdata['RoleID'];
                $query = "CALL usp_A_GetRolesMappingByID('".$this->UserRoleID ."','Web');";
                $res = $this->db->query($query);
                //print_r($res);die();
                $res->next_result();
                $data = $res->result();
                //pr($data);exit;
                foreach ($data as $value) {
                        $this->module_data[] = $value->ModuleID;
                }
                if (in_array($current_method, $without_login_methods)) {
                    redirect($this->config->item('base_url') . 'admin-dashboard');
                }
            }else{
                redirect($this->config->item('base_url') . 'company-dashboard');
            }
        }else{
            if (!in_array($current_method, $without_login_methods)) {
                redirect($this->config->item('base_url') . 'admin-login');
            }
        }
    }

    public function CheckDuplicate() {
        try {
            if ($this->input->post()) {
               $res = $this->common_model->CheckDuplicate($this->input->post());
               //print_r($res);die();
                if(@$res->Count == 0)
                    echo json_encode(array('result' => 'Success','count'=>$res->Count));
                else
                    echo json_encode(array('result' => 'Fail'));
            }
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
    public function CheckDuplicateDouble() {
        try {
            if ($this->input->post()) {
                $res = $this->common_model->CheckDuplicateDouble($this->input->post());

                if(@$res->Count == 0)
                    echo json_encode(array('result' => 'Success','count'=>$res->Count));
                else
                    echo json_encode(array('result' => 'Fail'));
            }
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
    public function multipleChangeStatus() {
        if ($this->input->is_ajax_request() && $this->input->post()) {
                $multiple_id = $this->input->post("ids");
                $table_name = $this->input->post("table_name");
                $field_name = $this->input->post("field_name");
                $new_status = 0;
                $checkbox_ids = explode(",", $multiple_id);

                foreach ($checkbox_ids as $checkbox_id) {

                    $this->common_model->changeStatus();
                    $this->db->query("call cf_A_ChangeStatus('" . $table_name . "','" . $field_name ."','" . $checkbox_id . "','" . $new_status . "','" . $this->session->userdata['AdminID'] . "')");
                }
        }else{
            show_404();
        }
    }
    public function getRecordInfo() {
        $record_id = $this->input->post("id");
        $table_name = $this->input->post("table_name");
        $field_name = $this->input->post("field_name");
        $record_result = array();
        $record_result = getRecordTrack($record_id, $table_name, $field_name);

        $data = "";
        foreach ($record_result as $records) {
            $cd = ($records->CreatedDate!="")?GetDateTimeInFormat($records->CreatedDate):'';
            $md = ($records->ModifiedDate!="")?GetDateTimeInFormat($records->ModifiedDate):'';
            $data .= '<tr><td><i class="mdi-action-perm-identity"></i></td><td><b>Created By</b></td><td>'.$records->CreatedBy.'</td></tr>';
            $data .= '<tr><td><i class="mdi-notification-event-note"></i></td><td><b>Created Date</b></td><td>'.$cd.'</td></tr>';
            $data .= '<tr><td><i class="mdi-action-perm-identity"></i></td><td><b>Modified By</b></td><td>'.$records->ModifiedBy.'</td></tr>';
           $data .= '<tr><td><i class="mdi-notification-event-note"></i></td><td><b>Modified Date</b></td><td>'.$md.'</td></tr>'; 
        }
        echo $data;
    }
}

class Company_Controller extends LoggedIn {
    function __construct() {
        parent::__construct();
        $current_controller = $this->router->fetch_class();
        $current_method = $this->router->fetch_method();
        $this->module_data = array();
        $this->UserRoleID = NULL;
        $this->WebType = "Company";
        $this->current_session = @$this->session->userdata;
        $without_login_methods = array('companylogin', 'forgotPassword', 'resetPassword', 'postLogin','postResetPassword','checkIfEmailIDIsRegistered','label');
        $this->session->set_userdata('language', 'english');
        $with_login_methods = array('Logout', 'changePassword', 'myProfile', 'editMyProfile', 'postEditMyProfile','checkIfEmailIDIsRegistered');
        if (isset($this->current_session['UserID'])) {
            if(@$this->current_session['UserType'] == "Company"){
                $UserID = $this->current_session['UserID'];
                if (in_array($current_method, $without_login_methods)) {
                    redirect($this->config->item('base_url') . 'company-dashboard');
                }
            }else{
                redirect($this->config->item('base_url') . 'admin-dashboard');
            }
        }else{

            if (!in_array($current_method, $without_login_methods)) {
                redirect($this->config->item('base_url') . 'company-login');
            }
        }
    }
    public function CheckDuplicate() {
        try {
            if ($this->input->post()) {
               $res = $this->common_model->CheckDuplicate($this->input->post());
               //print_r($res);die();
                if(@$res->Count == 0)
                    echo json_encode(array('result' => 'Success','count'=>$res->Count));
                else
                    echo json_encode(array('result' => 'Fail'));
            }
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
    public function CheckDuplicateDouble() {
        try {
            if ($this->input->post()) {
                $res = $this->common_model->CheckDuplicateDouble($this->input->post());

                if(@$res->Count == 0)
                    echo json_encode(array('result' => 'Success','count'=>$res->Count));
                else
                    echo json_encode(array('result' => 'Fail'));
            }
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
    public function multipleChangeStatus() {
        if ($this->input->is_ajax_request() && $this->input->post()) {
                $multiple_id = $this->input->post("ids");
                $table_name = $this->input->post("table_name");
                $field_name = $this->input->post("field_name");
                $new_status = 0;
                $checkbox_ids = explode(",", $multiple_id);

                foreach ($checkbox_ids as $checkbox_id) {

                    $this->common_model->changeStatus();
                    $this->db->query("call cf_A_ChangeStatus('" . $table_name . "','" . $field_name ."','" . $checkbox_id . "','" . $new_status . "','" . $this->session->userdata['AdminID'] . "')");
                }
        }else{
            show_404();
        }
    }
    public function getRecordInfo() {
        $record_id = $this->input->post("id");
        $table_name = $this->input->post("table_name");
        $field_name = $this->input->post("field_name");
        $record_result = array();
        $record_result = getRecordTrack($record_id, $table_name, $field_name);

        $data = "";
        foreach ($record_result as $records) {
            $cd = ($records->CreatedDate!="")?GetDateTimeInFormat($records->CreatedDate):'';
            $md = ($records->ModifiedDate!="")?GetDateTimeInFormat($records->ModifiedDate):'';
            $data .= '<tr><td><i class="mdi-action-perm-identity"></i></td><td><b>Created By</b></td><td>'.$records->CreatedBy.'</td></tr>';
            $data .= '<tr><td><i class="mdi-notification-event-note"></i></td><td><b>Created Date</b></td><td>'.$cd.'</td></tr>';
            $data .= '<tr><td><i class="mdi-action-perm-identity"></i></td><td><b>Modified By</b></td><td>'.$records->ModifiedBy.'</td></tr>';
           $data .= '<tr><td><i class="mdi-notification-event-note"></i></td><td><b>Modified Date</b></td><td>'.$md.'</td></tr>'; 
        }
        echo $data;
    }
}

class Mentor_Controller extends LoggedIn {
    function __construct() {
        parent::__construct();
        $current_controller = $this->router->fetch_class();
        $current_method = $this->router->fetch_method();
        $this->module_data = array();
        $this->UserRoleID = NULL;
        $this->WebType = "Mentor";
        $this->mentor_session = @$this->session->userdata['Mentor'];
        $without_login_methods = array('adminlogin', 'forgotPassword', 'resetPassword', 'postLogin','postResetPassword','checkIfEmailIDIsRegistered','label');
        $this->session->set_userdata('language', 'english');
        $with_login_methods = array('adminLogout', 'changePassword', 'myProfile', 'editMyProfile', 'postEditMyProfile','checkIfEmailIDIsRegistered');
        if (isset($this->mentor_session['UserID'])) {
            $UserID = $this->mentor_session['UserID'];
            $this->UserRoleID = $this->mentor_session['RoleID'];
            $query = "CALL usp_A_GetRolesMappingByID('".$this->UserRoleID ."','Web');";
            //print_r($query);die();
            $res = $this->db->query($query);
            $res->next_result();
            $data = $res->result();
            foreach ($data as $value) {
                    if(isset($this->Message)){
                        continue;
                    }
                    $this->module_data[] = @$value->ModuleID;
            }
            if (in_array($current_method, $without_login_methods)) {

                redirect($this->config->item('base_url') . 'mentor-dashboard');
            }
        }else{
            if (!in_array($current_method, $without_login_methods)) {
                redirect($this->config->item('base_url') . 'mentor-login');
            }
        }
    }
    public function CheckDuplicate() {
        try {
            if ($this->input->post()) {
               $res = $this->common_model->CheckDuplicate($this->input->post());
               //print_r($res);die();
                if(@$res->Count == 0)
                    echo json_encode(array('result' => 'Success','count'=>$res->Count));
                else
                    echo json_encode(array('result' => 'Fail'));
            }
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
    public function CheckDuplicateDouble() {
        try {
            if ($this->input->post()) {
                $res = $this->common_model->CheckDuplicateDouble($this->input->post());

                if(@$res->Count == 0)
                    echo json_encode(array('result' => 'Success','count'=>$res->Count));
                else
                    echo json_encode(array('result' => 'Fail'));
            }
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
    public function multipleChangeStatus() {
        if ($this->input->is_ajax_request() && $this->input->post()) {
                $multiple_id = $this->input->post("ids");
                $table_name = $this->input->post("table_name");
                $field_name = $this->input->post("field_name");
                $new_status = 0;
                $checkbox_ids = explode(",", $multiple_id);

                foreach ($checkbox_ids as $checkbox_id) {

                    $this->common_model->changeStatus();
                    $this->db->query("call cf_A_ChangeStatus('" . $table_name . "','" . $field_name ."','" . $checkbox_id . "','" . $new_status . "','" . $this->session->userdata['AdminID'] . "')");
                }
        }else{
            show_404();
        }
    }
    public function getRecordInfo() {
        $record_id = $this->input->post("id");
        $table_name = $this->input->post("table_name");
        $field_name = $this->input->post("field_name");
        $record_result = array();
        $record_result = getRecordTrack($record_id, $table_name, $field_name);

        $data = "";
        foreach ($record_result as $records) {
            $data .= '<tr><td><i class="mdi-action-perm-identity"></i></td><td><b>Created By</b></td><td>'.$records->CreatedBy.'</td></tr>';
            $data .= '<tr><td><i class="mdi-notification-event-note"></i></td><td><b>Created Date</b></td><td>'.$records->CreatedDate.'</td></tr>';
            $data .= '<tr><td><i class="mdi-action-perm-identity"></i></td><td><b>Modified By</b></td><td>'.$records->ModifiedBy.'</td></tr>';
            $data .= '<tr><td><i class="mdi-notification-event-note"></i></td><td><b>Modified Date</b></td><td>'.$records->ModifiedDate.'</td></tr>';
        }
        echo $data;
    }
}