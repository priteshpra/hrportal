<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Candidate extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",31)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
        $this->load->model('admin/candidate_model');
        $this->load->model('admin/config_model');
        $this->load->model('admin/city_model');
        $this->load->model('admin/state_model');
    }

    public function index() {
        $res = $data = array();
        $this->load->view('admin/includes/header');
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $res['Salary'] = GetSalary();
        $res['Designation'] = getDesignationCombobox(0,1);
        //$res['cities'] = getCityCombobox();
        /*$res['country'] = getCountryStateComboBox();
        $res['state'] = getStateBasedCombobox(0,-1);
        $res['cities'] = GetCityBasedState(0,-1);*/
        $res['config'] = $this->config_model->getConfig();
        $this->load->view('admin/masters/candidate/list', $res);
        $data['page_level_js'] = $this->load->view('admin/masters/candidate/list_js', NULL, TRUE);
        $data['footer']['add_link'] = $this->config->item('base_url') . 'admin/masters/candidate/add';
        $data['footer']['listing_page'] = 'yes';
        $this->load->view('admin/includes/footer', $data);
        unset($res, $data);
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['candidate'] = $this->candidate_model->listData($per_page_record, $page_number);
        if (empty($result['candidate']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['candidate'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/candidate/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="13" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
        unset($result);
    }

    public function details($ID = 0){

        $this->CandidateID = $ID;
        $data = array();
        $_POST['CandidateID'] = $data['ID'] = $ID;
        $data['config'] = $this->config_model->getConfig();
        $data['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $data['details'] = $this->candidate_model->getCandidateByID($ID);
        if(!@$data['details']->CandidateID){
            show_404();
        }
        $data['cities'] = getCityCombobox(@$data['details']->CityID);
        $data['designation'] = getDesignationCombobox();
        
        $data['page_level_js'] = $this->load->view('admin/masters/candidate/details_js', $data, TRUE);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/masters/candidate/details',$data);
        $this->load->view('admin/includes/footer',$data);
        unset($data);
    }

    public function downloadcv($filename = ''){
        $file_name = $filename;
        $path_parts = pathinfo(CV_UPLOAD_PATH.$file_name);
        //print_r($path_parts);exit;
        $myfileextension = $path_parts["extension"];    
        switch($myfileextension){
            case 'jpg':
                $mimetype = "image/jpg";
                break;
            case 'jpeg':
                $mimetype = "image/jpeg";
                break;
            case 'gif':
                $mimetype = "image/gif";
                break;
            case 'png':
                $mimetype = "image/png";
                break;
            case "pdf":
                $mimetype = "application/pdf";
                break;
            case "doc":
                $mimetype = "application/msword";
                break;
            case "docx":
                $mimetype = "application/msword";
                break;
            case "xls":
                $mimetype = "application/vnd.ms-excel";
                break;
        }
        header('Content-Description: File Transfer');
        header('Content-Type: '.$mimetype);
        header('Content-Disposition: attachment; filename="'.$CV_UPLOAD_PATH.$file_name.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize(CV_UPLOAD_PATH.$file_name));
        ob_clean();
        flush();
        readfile(CV_UPLOAD_PATH.$file_name);
        exit;
    }

    public function ajax_appliedjobs($per_page_record=10,$page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['alljobs'] = $this->candidate_model->listAppliedJobs($per_page_record,$page_number);
        if(isset($result['alljobs'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['alljobs'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        
        $ajax_listing = $this->load->view('admin/masters/candidate/ajax_listing_alljobs', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="20" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_savedjobs($per_page_record=10,$page_number = 1){
        $result = array();

        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['alljobs'] = $this->candidate_model->listSavedJobs($per_page_record,$page_number);
        if(isset($result['alljobs'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['alljobs'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        
        $ajax_listing = $this->load->view('admin/masters/candidate/ajax_listing_alljobs', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="18" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_followcompanies($per_page_record=10,$page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['following'] = $this->candidate_model->listFollowing($per_page_record,$page_number);
        if(isset($result['following'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['following'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        
        $ajax_listing = $this->load->view('admin/masters/candidate/ajax_listing_followcompany', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="9" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_skill($per_page_record=10,$page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['skill'] = $this->candidate_model->listSkill($per_page_record,$page_number);
        if(isset($result['skill'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['skill'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['UserID'] = $this->input->post('UserID');
        $ajax_listing = $this->load->view('admin/masters/candidate/ajax_listing_skill', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="9" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_employment($per_page_record=10,$page_number = 1){
        $result = array();

        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['employment'] = $this->candidate_model->listEmployment($per_page_record,$page_number);

        if(isset($result['employment'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['employment'][0]->rowcount;

        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['UserID'] = $this->input->post('UserID');
        $ajax_listing = $this->load->view('admin/masters/candidate/ajax_listing_employment', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="9" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_project($per_page_record=10,$page_number = 1){
        $result = array();

        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['project'] = $this->candidate_model->listProject($per_page_record,$page_number);
        if(isset($result['project'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['project'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['UserID'] = $this->input->post('UserID');
        $ajax_listing = $this->load->view('admin/masters/candidate/ajax_listing_project', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="6" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_certificate($per_page_record=10,$page_number = 1){
        $result = array();

        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['certificate'] = $this->candidate_model->listCertificate($per_page_record,$page_number);
        if(isset($result['certificate'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['certificate'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['UserID'] = $this->input->post('UserID');
        $ajax_listing = $this->load->view('admin/masters/candidate/ajax_listing_certificate', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="3" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_language($per_page_record=10,$page_number = 1){
        $result = array();

        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['language'] = $this->candidate_model->listLanguage($per_page_record,$page_number);
        if(isset($result['language'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['language'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['UserID'] = $this->input->post('UserID');
        $ajax_listing = $this->load->view('admin/masters/candidate/ajax_listing_language', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="6" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_qualification($per_page_record=10,$page_number = 1){
        $result = array();

        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['qualification'] = $this->candidate_model->listQualification($per_page_record,$page_number);
        if(isset($result['qualification'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['qualification'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['UserID'] = $this->input->post('UserID');
        $ajax_listing = $this->load->view('admin/masters/candidate/ajax_listing_education', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="9" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_invited($per_page_record=10,$page_number = 1){
        $result = array();
        $Type = $this->input->post('Type');
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['data_array'] = $this->candidate_model->listInvited($per_page_record,$page_number);
        if(isset($result['data_array'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['data_array'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['UserID'] = $this->input->post('UserID');
        if($Type == "JobPost"){
            $ajax_listing = $this->load->view('admin/masters/candidate/ajax_listing_jobpostinterview', $result,TRUE);
        }
        else{
            $ajax_listing = $this->load->view('admin/masters/candidate/ajax_listing_directinterview', $result,TRUE);
        }
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="12" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function addskill($CandidateID = 0) {
        try {
            if(@$this->cur_module->is_insert == 0 || $CandidateID == 0)
                        show_404();

            $data = $array = array();
            if ($this->input->post()) {
                //print_r($this->input->post());die();
                $this->load->library('form_validation');
                $this->form_validation->set_rules('SkillID[]', 'SkillID', 'required');

                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = 0;
                    $res = $this->candidate_model->addeditSkill($data);
                    //print_r($res);die();
                    if (@$res->ID) {
                        
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/details/'.$CandidateID.'#skill');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/addskill/'.$CandidateID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/addskill/'.$CandidateID);
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'addskill';
            $data['loading_button'] = getLoadingButton(); 
            $data['skill'] = getSkillComboboxSingle();
            $data['CandidateID'] = $CandidateID;      
            $this->load->view('admin/masters/candidate/add_editskill', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/candidate/add_editskill_js', $data, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data,$array);
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMonth(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent());
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function editskill($CandidateID = 0, $ID = 0) {
        try {
            if(@$this->cur_module->is_edit == 0 || $CandidateID == 0 || $ID == 0)
                        show_404();
            $data = $res = array();
            $data['ID'] = $ID;
            
            if ($this->input->post()) {
                $this->load->library('form_validation');

                $this->form_validation->set_rules('SkillID', 'SkillID', 'required');
                
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = $ID;
                    $res = $this->candidate_model->addeditSkill($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/details/'.$CandidateID.'#skill');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/editskill/'. $CandidateID . "/" . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/editskill/'. $CandidateID . "/" . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'editskill';
            $data['skilluser'] = $this->candidate_model->getSkillByID($ID);
            $data['skill'] = getSkillComboboxSingle(@$data['skilluser']->SkillID);
            if(empty($data['skilluser'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/candidate/'.$CandidateID);
            }
            $data['loading_button'] = getLoadingButton();
            $data['CandidateID'] = $CandidateID;
            $this->load->view('admin/masters/candidate/add_editskill', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/candidate/add_editskill_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data,$res);
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

    public function addemployment($CandidateID = 0) {
        try {
            if(@$this->cur_module->is_insert == 0 || $CandidateID == 0)
                        show_404();

            $data = $array = array();
            if ($this->input->post()) {

                $this->load->library('form_validation');
                $this->form_validation->set_rules('DesignationID', 'DesignationID', 'required');
                

                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = 0;
                    $res = $this->candidate_model->addeditEmployment($data);
                    //print_r($res);die();
                    if (@$res->ID) {
                        
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/details/'.$CandidateID.'#employment');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/addemployment/'.$CandidateID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/addemployment/'.$CandidateID);
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'addemployment';
            $data['loading_button'] = getLoadingButton(); 
            $data['designation'] = getDesignationCombobox();
            $data['CandidateID'] = $CandidateID;
            $this->load->view('admin/masters/candidate/add_editemployment', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/candidate/add_editemployment_js', $data, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data,$array);
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMonth(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent());
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function editemployment($CandidateID = 0, $ID = 0) {
        try {
            if(@$this->cur_module->is_edit == 0 || $CandidateID == 0 || $ID == 0)
                        show_404();
            $data = $res = array();
            $data['ID'] = $ID;
            
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('DesignationID', 'DesignationID', 'required');
                
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = $ID;
                    $res = $this->candidate_model->addeditEmployment($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/details/'.$CandidateID.'#employment');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/editemployment/'. $CandidateID . "/" . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/editemployment/' . $CandidateID . "/" . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'editemployment';
            $data['employment'] = $this->candidate_model->getEmploymentByID($ID);
            $data['designation'] = getDesignationCombobox(@$data['employment']->DesignationID);
            if(empty($data['employment'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/candidate/'.$CandidateID);
            }
            $data['loading_button'] = getLoadingButton();
            $data['CandidateID'] = $CandidateID;
            $this->load->view('admin/masters/candidate/add_editemployment', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/candidate/add_editemployment_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data,$res);
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

    public function addproject($CandidateID = 0) {
        try {
            if(@$this->cur_module->is_insert == 0 || $CandidateID == 0)
                        show_404();
            $data = $array = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                    $this->form_validation->set_rules('ProjectTitle', 'ProjectTitle', 'required');
                // $this->form_validation->set_rules('DesignationID', 'DesignationID', 'required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = 0;
                    $res = $this->candidate_model->addeditProject($data);
                    if (@$res->ID) {
                        
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/details/'.$CandidateID.'#project');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/addproject/'.$CandidateID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/addproject/'.$CandidateID);
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'addproject';
            $data['loading_button'] = getLoadingButton(); 
            // $data['designation'] = getDesignationCombobox();
            // $data['NatureOfEmployment'] = GetNatureOfEmployment();
            $data['CandidateID'] = $CandidateID;      
            $this->load->view('admin/masters/candidate/add_editproject', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/candidate/add_editproject_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data,$array);
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMonth(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent());
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function editproject($CandidateID = 0, $ID = 0) {
        try {
            if(@$this->cur_module->is_edit == 0 || $CandidateID == 0 || $ID == 0)
                        show_404();
            $data = $res = array();
            $data['ID'] = $ID;
            if ($this->input->post()) {
                $this->load->library('form_validation');
                // $this->form_validation->set_rules('DesignationID', 'DesignationID', 'required');
                    $this->form_validation->set_rules('ProjectTitle', 'ProjectTitle', 'required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = $ID;
                    
                    $res = $this->candidate_model->addeditProject($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/details/'.$CandidateID.'#project');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/editproject/' .$CandidateID ."/".$ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/editproject/' . $CandidateID . "/" . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'editproject';
            $data['project'] = $this->candidate_model->getProjectByID($ID);
            // $data['designation'] = getDesignationCombobox(@$data['project']->DesignationID);
            // $data['NatureOfEmployment'] = GetNatureOfEmployment(@$data['project']->NatureOfEmployment);
            //print_r($data['project']); exit();
            if(empty($data['project'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/candidate/'.$CandidateID);
            }
            $data['loading_button'] = getLoadingButton();
            $data['CandidateID'] = $CandidateID;
            $this->load->view('admin/masters/candidate/add_editproject', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/candidate/add_editproject_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data,$res);
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

    public function addcertificate($CandidateID = 0) {
        try {
            if(@$this->cur_module->is_insert == 0 || $CandidateID == 0)
                        show_404();

            $data = $array = array();
            if ($this->input->post()) {

                $this->load->library('form_validation');
                $this->form_validation->set_rules('Description', 'Description', 'trim|required');
                

                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = 0;
                    $res = $this->candidate_model->addeditCertificate($data);
                    if (@$res->ID) {
                        
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/details/'.$CandidateID.'#certificate');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/addcertificate/'.$CandidateID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/addcertificate/'.$CandidateID);
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'addcertificate';
            $data['loading_button'] = getLoadingButton(); 
            $data['designation'] = getDesignationCombobox();
            $data['CandidateID'] = $CandidateID;     
            $data['Year'] = GetYearList(1900,0,'Year'); 
            $CandidateDetails = $this->candidate_model->getCandidateByID($CandidateID);
            if($CandidateDetails->BirthYear != ""){
                $start  = $CandidateDetails->BirthYear + 10;
                $data['Year'] = GetYearList($start,0,'Year');
            }
            $this->load->view('admin/masters/candidate/add_editcertificate', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/candidate/add_editcertificate_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data,$array);
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMonth(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent());
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function editcertificate($CandidateID = 0, $ID = 0) {
        try {
            if(@$this->cur_module->is_edit == 0 || $CandidateID == 0 || $ID == 0)
                        show_404();
            $data = $res = array();
            $data['ID'] = $ID;
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('Description', 'Description', 'trim|required');
                
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = $ID;
                    
                    $res = $this->candidate_model->addeditCertificate($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/details/'.$CandidateID.'#certificate');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/editcertificate/'. $CandidateID . "/" . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/editcertificate/' . $CandidateID . "/" . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'editcertificate';
            $data['certificate'] = $this->candidate_model->getCertificateByID($ID);
            $data['designation'] = getDesignationCombobox(@$data['certificate']->DesignationID);
            if(empty($data['certificate'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/candidate/'.$CandidateID);
            }
            $data['loading_button'] = getLoadingButton();
            $data['CandidateID'] = $CandidateID;
            $data['Year'] = GetYearList(1900,$data['certificate']->CertificateYear,'Year');
            $CandidateDetails = $this->candidate_model->getCandidateByID($CandidateID);
            if($CandidateDetails->BirthYear != ""){
                $start  = $CandidateDetails->BirthYear + 10;
                $data['Year'] = GetYearList($start,$data['qualification']->CertificateYear,'Year');
            }
            $this->load->view('admin/masters/candidate/add_editcertificate', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/candidate/add_editcertificate_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data,$res);
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

    public function addlanguage($CandidateID = 0) {
        try {
            if(@$this->cur_module->is_insert == 0 || $CandidateID == 0)
                        show_404();

            $data = $array = array();
            if ($this->input->post()) {

                $this->load->library('form_validation');
                $this->form_validation->set_rules('LanguageID', 'LanguageID', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = 0;
                    $res = $this->candidate_model->addeditLanguage($data);
                    if (@$res->ID) {
                        
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/details/'.$CandidateID.'#language');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/addlanguage/'.$CandidateID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/addlanguage/'.$CandidateID);
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'addlanguage';
            $data['loading_button'] = getLoadingButton(); 
            $data['designation'] = getDesignationCombobox();
            $data['CandidateID'] = $CandidateID;
            $data['languageid'] = getLanguageCombobox();      
            $this->load->view('admin/masters/candidate/add_editlanguage', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/candidate/add_editlanguage_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data,$array);
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMonth(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent());
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function editlanguage($CandidateID = 0, $ID = 0) {
        try {
            if(@$this->cur_module->is_edit == 0 || $CandidateID == 0)
                        show_404();
            $data = $res = array();
            $data['ID'] = $ID;
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('LanguageID', 'LanguageID', 'trim|required');
                
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = $ID;
                    
                    $res = $this->candidate_model->addeditLanguage($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/details/'.$CandidateID.'#language');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/editlanguage/' . $CandidateID . "/". $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/editlanguage/' . $CandidateID . "/". $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'editlanguage';
            $data['language'] = $this->candidate_model->getLanguageByID($ID);
            $data['designation'] = getDesignationCombobox(@$data['language']->DesignationID);
            if(empty($data['language'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/candidate/'.$CandidateID);
            }
            $data['loading_button'] = getLoadingButton();
            $data['CandidateID'] = $CandidateID;
            $data['ID'] = $ID;
            $data['languageid'] = getLanguageCombobox(@$data['language']->LanguageID);
            $this->load->view('admin/masters/candidate/add_editlanguage', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/candidate/add_editlanguage_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data,$res);
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

    public function addqualification($CandidateID = 0) {

        try {
            if(@$this->cur_module->is_insert == 0 || $CandidateID == 0)
                        show_404();

            $data = $array = array();
            if ($this->input->post()) {

                $this->load->library('form_validation');
                $this->form_validation->set_rules('QualificationID', 'QualificationID', 'required');
                $this->form_validation->set_rules('Year', 'Year', 'required');
                $this->form_validation->set_rules('University', 'University', 'trim|required');
                $this->form_validation->set_rules('Course', 'Course', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = 0;
                    $res = $this->candidate_model->addeditQualification($data);
                    if (@$res->ID) {
                        
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/details/'.$CandidateID.'#qualification');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/addqualification');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/addqualification');
                }
            }
            $this->load->view('admin/includes/header');
           // pr($data['details']);exit;
            $CandidateDetails = $this->candidate_model->getCandidateByID($CandidateID);
            $data['page_name'] = 'addqualification';
            $data['loading_button'] = getLoadingButton(); 
            $data['designation'] = getDesignationCombobox();
            $data['CandidateID'] = $CandidateID;
            $data['qualificationid'] = getQualificationCombobox();
            $data['grade'] = getGradeCombobox();
            $data['Year'] = GetYearList(1900,0);
            if($CandidateDetails->BirthYear != ""){
                $start  = $CandidateDetails->BirthYear + 10;
                $data['Year'] = GetYearList($start,0);
            }
            $this->load->view('admin/masters/candidate/add_editeducation', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/candidate/add_editeducation_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data,$array);
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMonth(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent());
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function editqualification($CandidateID = 0, $ID = 0) {
        try {
            if(@$this->cur_module->is_edit == 0 || $CandidateID == 0 || $ID == 0)
                        show_404();
            $data = $res = array();
            $data['ID'] = $ID;
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('QualificationID', 'QualificationID', 'required');
                $this->form_validation->set_rules('Year', 'Year', 'required');
                $this->form_validation->set_rules('University', 'University', 'trim|required');
                $this->form_validation->set_rules('Course', 'Course', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = $ID;
                    
                    $res = $this->candidate_model->addeditQualification($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/details/'.$CandidateID.'#qualification');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/editqualification/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/editqualification/' . $ID);
                }
            }
            
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'editqualification';
            $data['qualification'] = $this->candidate_model->getQualificationByID($ID);
            $data['designation'] = getDesignationCombobox(@$data['language']->DesignationID);
            if(empty($data['qualification'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/candidate/'.$CandidateID);
            }
            $data['grade'] = getGradeCombobox(@$data['qualification']->Grade);
            $data['loading_button'] = getLoadingButton();
            $data['CandidateID'] = $CandidateID;
            $data['qualificationid'] = getQualificationCombobox(@$data['qualification']->QualificationID);
            $data['Year'] = GetYearList(1900,$data['qualification']->YearOfPassing);
            $CandidateDetails = $this->candidate_model->getCandidateByID($CandidateID);
            if($CandidateDetails->BirthYear != ""){
                $start  = $CandidateDetails->BirthYear + 10;
                $data['Year'] = GetYearList($start,$data['qualification']->YearOfPassing);
            }
            $this->load->view('admin/masters/candidate/add_editeducation', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/candidate/add_editeducation_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data,$res);
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

    public function editBasicDetails(){
        $data = $this->input->post();
        $res = $this->candidate_model->editBasicDetails($data);
    }

    public function editOtherDetails(){
        $data = $this->input->post();
        $res = $this->candidate_model->editOtherDetails($data);
    }

    public function add() {
        try {
            if(@$this->cur_module->is_insert == 0)
                        show_404();
            $data = $array = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
                $this->form_validation->set_rules('EmailID', 'EmailID', 'trim|required');
                $this->form_validation->set_rules('Password', 'Password', 'trim|required');
                $this->form_validation->set_rules('Gender', 'Gender', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $url = site_url("admin/masters/candidate/add");
                    $config = array('max_width' => CANDIDATE_MAX_WIDTH,
                        'max_height' => CANDIDATE_MAX_HEIGHT,
                        'max_size' => CANDIDATE_MAX_SIZE,
                        'path' => CANDIDATE_UPLOAD_PATH,
                        'allowed_types' => CANDIDATE_ALLOWED_TYPES,
                        'tpath' => CANDIDATE_THUMB_UPLOAD_PATH,
                        'twidth' => CANDIDATE_THUMB_MAX_WIDTH,
                        'theight' => CANDIDATE_THUMB_MAX_HEIGHT
                    );
                    $data = $this->input->post();
                    $data['image'] = FileUploadURL("userfile", "editImageURL", $config, '', $url);
                    $cvurl = site_url("admin/masters/candidate/add");
                    $config1 = array("max_width" => -1,
                        "max_height" => -1,
                        'max_size' => CV_MAX_SIZE,
                        'path' => CV_UPLOAD_PATH,
                        'allowed_types' => CV_ALLOWED_TYPES,
                        'tpath' => -1,
                        'twidth' => -1,
                        'theight' => -1
                    );
                    $data['cv'] = FileUploadURL("cvfile", "editCVPath", $config1, '', $cvurl);
                    $res = $this->candidate_model->insert($data);
                    if ($res == 1) {
                        redirect($this->config->item('base_url') . 'admin/masters/candidate');
                    } else {
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/add');
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'add';
            $data['loading_button'] = getLoadingButton(); 
            $data['JobType'] = GetJobTypeList();
            $data['profilestatus'] = GetProfileStatus();
            $data['Ethnicity'] = GetEthnicityCombo();
            $data['VisaStatus'] = GetVisaStatusList();
            $data['country'] = getCountryStateComboBox();
            $data['state'] = getStateBasedCombobox(0,-1);
            $data['cities'] = GetCityBasedState(0,-1);
            $data['year'] = GetYearList(1900,0,"Birth Year");
            $this->load->view('admin/masters/candidate/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/candidate/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data,$array);
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMonth(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent());
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function edit($ID = 0) {
        try {
            if(@$this->cur_module->is_edit == 0 || $ID == 0)
                        show_404();
            $data = $res = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
                $this->form_validation->set_rules('EmailID', 'EmailID', 'trim|required');
                $this->form_validation->set_rules('Gender', 'Gender', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    
                    $url = site_url("admin/masters/candidate/edit/".$ID);
                    $config = array("max_width" => CANDIDATE_MAX_WIDTH,
                        "max_height" => CANDIDATE_MAX_HEIGHT,
                        'max_size' => CANDIDATE_MAX_SIZE,
                        'path' => CANDIDATE_UPLOAD_PATH,
                        'allowed_types' => CANDIDATE_ALLOWED_TYPES,
                        'tpath' => CANDIDATE_THUMB_UPLOAD_PATH,
                        'twidth' => CANDIDATE_THUMB_MAX_WIDTH,
                        'theight' => CANDIDATE_THUMB_MAX_HEIGHT
                    );
                    $data['ID'] = $ID;
                    $data['image'] = FileUploadURL("userfile", "editImageURL", $config, '', $url);

                    $cvurl = site_url("admin/masters/candidate/edit/".$ID);
                    $config1 = array("max_width" => -1,
                        "max_height" => -1,
                        'max_size' => CV_MAX_SIZE,
                        'path' => CV_UPLOAD_PATH,
                        'allowed_types' => CV_ALLOWED_TYPES,
                        'tpath' => -1,
                        'twidth' => -1,
                        'theight' => -1
                    );

                    $data['cv'] = FileUploadURL("cvfile", "editCVPath", $config1, '', $cvurl);

                    $res = $this->candidate_model->update($data);
                    if ($res == 1) {
                        redirect($this->config->item('base_url') . 'admin/masters/candidate');
                    } else {
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/candidate/edit/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/candidate/edit/' . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'edit/' . $ID;
            $data['candidate'] = $this->candidate_model->getCandidateByID($ID);
            
			if(empty($data['candidate'])){
				$this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/candidate/');
			}
            $data['loading_button'] = getLoadingButton();
            $jobarray = explode(',',$data['candidate']->JobType);
            $data['JobType'] = GetJobTypeList($jobarray);
            $data['profilestatus'] = GetProfileStatus($data['candidate']->ProfileStatus);
            $data['Ethnicity'] = GetEthnicityCombo($data['candidate']->EthnicityID);
            $data['VisaStatus'] = GetVisaStatusList($data['candidate']->VisaStatus);
            $data['country'] = getCountryStateComboBox($data['candidate']->CountryID);
            $data['state'] = getStateBasedCombobox($data['candidate']->StateID,$data['candidate']->CountryID);
            $data['cities'] = GetCityBasedState($data['candidate']->CityID,$data['candidate']->StateID);
            $data['year'] = GetYearList(1900,$data['candidate']->BirthYear,"Birth Year");
            
            $this->load->view('admin/masters/candidate/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/candidate/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data,$res);
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

    public function changeStatus() {
        try {
            if($this->cur_module->is_status == 0){
                echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
                die;
            }
            if ($this->input->post()) {
                $res = $this->candidate_model->changeStatus($this->input->post());
                if($res){
                    $message = ($this->input->post('status') == 1)?label('status_active'):label('status_inactive');    
                    echo json_encode(array('result' => 'success','message'=>$message));
                }else{
                    echo json_encode(array('result' => 'error',label('please_try_again')));
                }
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

    public function changeEmploymentStatus(){
        try {
            if($this->cur_module->is_status == 0){
                echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
                die;
            }
            if ($this->input->post()) {
                $res = $this->candidate_model->changeEmploymentStatus($this->input->post());
                if($res){
                    $message = ($this->input->post('status') == 1)?label('status_active'):label('status_inactive');    
                    echo json_encode(array('result' => 'success','message'=>$message));
                }else{
                    echo json_encode(array('result' => 'error',label('please_try_again')));
                }
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

    public function changepassword(){
        if($this->input->post() && $this->input->is_ajax_request()){
            $password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');
           // print_r($confirm_password);die();
            if($password == $confirm_password){
                $res = $this->candidate_model->changePassword();
                if($res){
                    echo json_encode(array('Status'=>'Success', 'Message'=>label('msg_lbl_change_password')));
                }else{
                    echo json_encode(array('Status'=>'Error', 'Message'=>label('please_try_again')));
                }
            }else{
                echo json_encode(array('Status'=>'Error', 'Message'=>label('password_not_updated')));
            }
        }else{
            show_404();
        }
    }

    public function export_to_excel() {
        if($this->cur_module->is_export == 0)
                        show_404();
        //load our new PHPExcel library
        $array = array();
        $fields = array("SrNo", "FirstName","LastName","EmailID","Address","CityName","Pincode","PermenantAddress", "Experience", "Salary", "DOB", "Gender" ,"IsPhysicalChallenged" ,"IsPhysicalChallenged", "IsExperience"); //Header Define

        $this->load->library('excel');
        $array['data'] = $this->candidate_model->listData(-1, 1);
        $array['result'] = array();
        if (!empty($array['data'])) {
            $array['result'] = $array['data'];
        }
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Export Data');
        $this->excel->setActiveSheetIndex(0);
        //Set Header Style
        $col = 0;
        foreach ($fields as $field) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucwords($field));
            $col++;
        }

        //Set Headers of Excel
        $row = 2;
        $SerialNo = 1;
        if (!empty($array['data'])) {
            foreach ($array['result'] as $rr => $data) {

                $col = 0;
                foreach ($fields as $field) {

                    if ($field == 'SrNo')
                        $data->$field = $SerialNo;
                    if ($field == 'DOB' && $data->$field!='')
                       //$data->$field = GetDateInFormat(date($data->$field,strtotime($data->$field)),'Y-m-d',DATE_FORMAT);
                        $data->$field = GetDateInFormat($data->$field);
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    $col++;
                }
                $row++;
                $SerialNo++;
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $filename = 'Candidate.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
