<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jobpost extends Company_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('company/jobpost_model');
        $this->load->model('company/candidate_model');
        $this->load->model('company/city_model');
        $this->load->model('company/state_model');
        $this->load->model('admin/config_model');
    }

    public function index() {

        $ID = $this->session->userdata['CompanyID'];
        $data = array();
        $data['details'] = $this->jobpost_model->getCompanyByID($ID);
        $data['config'] = $this->config_model->getConfig();
        $data['designation'] = getDesignationCombobox(0,0,1);
        $this->load->view('company/includes/header');
        $this->load->view('company/jobpost/details', $data);
        $data['page_level_js'] = $this->load->view('company/jobpost/details_js',$data, TRUE);
        $this->load->view('company/includes/footer', $data);
    }
    public function ajax_jobpost($per_page_record=10,$page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $Type = $this->input->post('JobStatus');
        if($Type =="All"){
            $result['href'] = 'all_job';
        }else if($Type =="Active"){ 
            $result['href'] = 'job_status';
        }else if($Type =="RecentlyApplied"){
            $result['href'] = 'all_recent';
        }
        $result['alljobs'] = $this->jobpost_model->listCompanyByJobs($result); 
        if(isset($result['alljobs'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['alljobs'][0]->rowcount;
        
        $pagination = $this->load->view('company/includes/ajax_list_pagination',$result,TRUE);
        $ajax_listing = $this->load->view('company/jobpost/ajax_listing_alljobs', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="12" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }
    public function details($ID = 0){
        $this->UserID = $ID;
        $data = array();
        $_POST['UserID'] = $data['ID'] = $ID; 
        $data['config'] = $this->config_model->getConfig();
        $data['Salary'] = GetSalary();
        $data['Designation'] = getDesignationCombobox(0,1,1);
        $data['details'] = $this->jobpost_model->getByID($ID);
        $data['Reason'] = GetReason();
        $data['page_level_js'] = $this->load->view('company/jobpost/jobdetails_js', $data, TRUE);
        $this->load->view('company/includes/header');
        $this->load->view('company/jobpost/jobdetails',$data);
        $this->load->view('company/includes/footer',$data);
        unset($data);
    }
    public function ajax_jobtabs($per_page_record=10,$page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['JobStatus'] = $this->input->post('JobStatus');
        $result['allcandidate'] = $this->candidate_model->listData($per_page_record,$page_number);
        if(isset($result['allcandidate'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['allcandidate'][0]->rowcount;
        
        $pagination = $this->load->view('company/includes/ajax_list_pagination',$result,TRUE);
        $ajax_listing = $this->load->view('company/jobpost/ajax_listing_job',$result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="14" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'b'=>''));
    }
    public function add() {
        try {
            $data = $array = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('JobTitle', 'JobTitle', 'trim|required');
                $this->form_validation->set_rules('NatureOfEmployment', 'NatureOfEmployment', 'trim|required');
                $this->form_validation->set_rules('MinSalary', 'MinSalary', 'trim|required');
                $this->form_validation->set_rules('MinSalary', 'MinSalary', 'trim|required');
                $this->form_validation->set_rules('NoOfVacancies', 'NoOfVacancies', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $res = $this->jobpost_model->insert($data);
                    // pr($res); die();
                    if (@$res->ID) {
                        $this->jobpost_model->addSkill($this->input->post('SkillID'),$res->ID);
                        redirect($this->config->item('base_url') . 'company/jobpost');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'company/jobpost/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'company/jobpost/add');
                }
            }
            $this->load->view('company/includes/header');
            $data['page_name'] = 'add';
            $data['loading_button'] = getLoadingButton();
            $data['config'] = $this->config_model->getConfig();
            $data['industrytype'] = getIndustrytypeCombobox();    
            $data['designation'] = getDesignationCombobox();    
            $data['department'] = getDepartmentCombobox();    
            $data['skills'] = getSkillCombobox();
            $data['country'] = getCountryStateComboBox();
            $data['state'] = getStateBasedCombobox(0,-1);
            $data['cities'] = GetCityBasedState(0,-1);
            $data['NatureOfEmployment'] = GetNatureOfEmployment();
            $data['DesiredCandidateProfile'] = GetDesiredCandidateProfile();

            $this->load->view('company/jobpost/add_edit', $data);
            $array['page_level_js'] = $this->load->view('company/jobpost/add_edit_js', NULL, TRUE);
            $this->load->view('company/includes/footer', $array);
            unset($data,$array);
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => $this->session->user_data['UserType'] . " Web",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function edit($ID = NULL) {
       
        try {
            $data = $res = array();

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('JobTitle', 'JobTitle', 'trim|required');
                $this->form_validation->set_rules('NatureOfEmployment', 'NatureOfEmployment', 'trim|required');
                $this->form_validation->set_rules('MinSalary', 'MinSalary', 'trim|required');
                $this->form_validation->set_rules('MaxSalary', 'MaxSalary', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = $ID;
                    $res = $this->jobpost_model->update($data);
                    if (@$res->ID) {
                        $this->jobpost_model->DeleteSkills($res->ID);
                        $this->jobpost_model->addSkill($this->input->post('SkillID'),$res->ID);
                        redirect($this->config->item('base_url') . 'company/jobpost');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'company/jobpost/edit/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'company/jobpost/edit/' . $ID);
                }
            }

            $this->load->view('company/includes/header');
            $data['page_name'] = 'edit/' . $ID;
            $data['jobpost'] = $this->jobpost_model->getByID($ID);
            if(empty($data['jobpost'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'company/jobpost/');
            }
            $data['loading_button'] = getLoadingButton();
            $data['industrytype'] = getIndustrytypeCombobox(@$data['jobpost']->IndustryTypeID);    
            $data['designation'] = getDesignationCombobox(@$data['jobpost']->DesignationID);    
            $data['department'] = getDepartmentCombobox(@$data['jobpost']->DepartmentID);
            $skillsarr = explode(',',@$data['jobpost']->Skills);
            $data['skills'] = getSkillCombobox($skillsarr);
            $data['config'] = $this->config_model->getConfig();
            $state_id = $this->city_model->getCityByID(@$data['jobpost']->CityID);
            $country_id = $this->state_model->getStateByID(@$state_id->StateID);
            $data['country'] = getCountryStateComboBox(@$country_id->CountryID);
            $data['state'] = getStateBasedCombobox(@$state_id->StateID,@$country_id->CountryID);  
            $data['cities'] = GetCityBasedState($data['jobpost']->CityID,@$state_id->StateID);
            $data['NatureOfEmployment'] = GetNatureOfEmployment($data['jobpost']->NatureOfEmployment);
            $data['DesiredCandidateProfile'] = GetDesiredCandidateProfile($data['jobpost']->DesiredJobProfile);
            
            $this->load->view('company/jobpost/add_edit', $data);
            $res['page_level_js'] = $this->load->view('company/jobpost/add_edit_js', NULL, TRUE);
            $this->load->view('company/includes/footer', $res);
            unset($data,$res);
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => $this->session->user_data['UserType'] . " Web",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function checkDuplicateDouble() {
        try {
            if ($this->input->post()) {
               $res = $this->jobpost_model->checkDuplicateDouble($this->input->post());
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
                "Type" => "Company Web",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

}
