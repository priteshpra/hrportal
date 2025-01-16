<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jobpost extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",29)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (empty($this->cur_module)) {
            show_404();
        }
        $this->load->model('admin/jobpost_model');
        $this->load->model('admin/config_model');
        $this->load->model('admin/city_model');
        $this->load->model('admin/state_model');
    }

    public function index()
    {
        $res = $data = array();
        $this->load->view('admin/includes/header');
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $res['user'] = getUserCombobox();
        $res['config'] = $this->config_model->getConfig();
        $res['Salary'] = GetSalary();
        $res['Designation'] = getDesignationCombobox(0, 1);
        $res['Location'] = GetLocation();
        $this->load->view('admin/masters/jobpost/list', $res);
        $data['page_level_js'] = $this->load->view('admin/masters/jobpost/list_js', NULL, TRUE);
        $data['footer']['add_link'] = $this->config->item('base_url') . 'admin/masters/jobpost/add';
        $data['footer']['listing_page'] = 'yes';
        $this->load->view('admin/includes/footer', $data);
        unset($res, $data);
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1)
    {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['jobpost'] = $this->jobpost_model->listData($per_page_record, $page_number);
        if (isset($result['jobpost'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['jobpost'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/jobpost/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="20" style="text-align: center;">' . label('no_records_found') . ' </td></tr>', 'b' => ''));
    }
    public function ajax_jobtabs($per_page_record = 10, $page_number = 1, $JobPostType = "View")
    {
        $result = array();
        $result['type'] = $JobPostType;
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['allcandidate'] = $this->jobpost_model->CandidateList($this->input->post('ID'), $per_page_record, $page_number, $this->input->post('JobPostType'));
        if (isset($result['allcandidate'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['allcandidate'][0]->rowcount;

        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
        $ajax_listing = $this->load->view('admin/masters/jobpost/ajax_listing_job', $result, TRUE);
        if ($result['total_records'] != 0)
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        else
            echo json_encode(array('a' => '<tr><td colspan="14" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'b' => ''));
    }
    /*public function ajax_jobtabs($per_page_record=10,$page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['allcandidate'] = $this->jobpost_model->listCandidateList($this->input->post('ID'),$per_page_record,$page_number);
        if(isset($result['allcandidate'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['allcandidate'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $ajax_listing = $this->load->view('admin/masters/jobpost/ajax_listing_job', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="12" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }*/
    /*public function ajax_jobapplied($per_page_record=10,$page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['allapplied'] = $this->jobpost_model->listCandidateApplied($this->input->post('ID'),$per_page_record,$page_number);
        if(isset($result['allapplied'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['allapplied'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $ajax_listing = $this->load->view('admin/masters/jobpost/ajax_listing_alljobs', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="12" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }*/
    public function CheckDuplicateJob()
    {
        try {
            if ($this->input->post()) {
                $res = $this->jobpost_model->CheckDuplicateJob($this->input->post());
                //print_r($res);die();
                if (@$res->Count == 0)
                    echo json_encode(array('result' => 'Success', 'count' => $res->Count));
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

    public function add()
    {
        try {
            if (@$this->cur_module->is_insert == 0)
                show_404();
            $data = $array = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('JobTitle', 'JobTitle', 'trim|required');
                // $this->form_validation->set_rules('MinExperience', 'MinExperience', 'trim|required');
                // $this->form_validation->set_rules('MaxExperience', 'MaxExperience', 'trim|required');
                $this->form_validation->set_rules('NatureOfEmployment', 'NatureOfEmployment', 'trim|required');
                $this->form_validation->set_rules('MinSalary', 'MinSalary', 'trim|required');
                $this->form_validation->set_rules('MinSalary', 'MinSalary', 'trim|required');
                $this->form_validation->set_rules('NoOfVacancies', 'NoOfVacancies', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $res = $this->jobpost_model->insert($data);
                    // print_r($res);die();
                    if (@$res->ID) {
                        $this->jobpost_model->addSkill($this->input->post('SkillID'), $res->ID);
                        redirect($this->config->item('base_url') . 'admin/masters/jobpost');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/jobpost/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/jobpost/add');
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'add';
            $data['loading_button'] = getLoadingButton();
            $data['config'] = $this->config_model->getConfig();
            $data['user'] = getCompanyCombobox();
            $data['industrytype'] = getIndustrytypeCombobox();
            $data['designation'] = getDesignationCombobox();
            $data['department'] = getDepartmentCombobox();
            $data['skills'] = getSkillCombobox();
            $data['country'] = getCountryStateComboBox();
            $data['state'] = getStateBasedCombobox(0, -1);
            $data['cities'] = GetCityBasedState(0, -1);
            $data['NatureOfEmployment'] = GetNatureOfEmployment();
            $data['DesiredCandidateProfile'] = GetDesiredCandidateProfile();

            $this->load->view('admin/masters/jobpost/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/jobpost/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data, $array);
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

    public function edit($ID = NULL)
    {

        try {
            if (@$this->cur_module->is_edit == 0)
                show_404();
            $data = $res = array();

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('JobTitle', 'JobTitle', 'trim|required');
                // $this->form_validation->set_rules('MinExperience', 'MinExperience', 'trim|required');
                // $this->form_validation->set_rules('MaxExperience', 'MaxExperience', 'trim|required');
                $this->form_validation->set_rules('NatureOfEmployment', 'NatureOfEmployment', 'trim|required');
                $this->form_validation->set_rules('MinSalary', 'MinSalary', 'trim|required');
                $this->form_validation->set_rules('MaxSalary', 'MaxSalary', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();

                    $data['ID'] = $ID;
                    $res = $this->jobpost_model->update($data);
                    if (@$res->ID) {
                        $this->jobpost_model->DeleteSkills($res->ID);
                        $this->jobpost_model->addSkill($this->input->post('SkillID'), $res->ID);
                        redirect($this->config->item('base_url') . 'admin/masters/jobpost');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()

                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/jobpost/edit/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/jobpost/edit/' . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'edit/' . $ID;
            $data['jobpost'] = $this->jobpost_model->getByID($ID);
            if (empty($data['jobpost'])) {
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/jobpost/');
            }
            $data['loading_button'] = getLoadingButton();

            $data['user'] = getCompanyCombobox(@$data['jobpost']->UserID);

            $data['industrytype'] = getIndustrytypeCombobox(@$data['jobpost']->IndustryTypeID);
            $data['designation'] = getDesignationCombobox(@$data['jobpost']->DesignationID);
            $data['department'] = getDepartmentCombobox(@$data['jobpost']->DepartmentID);
            $skillsarr = explode(',', @$data['jobpost']->Skills);
            $data['skills'] = getSkillCombobox($skillsarr);
            $data['config'] = $this->config_model->getConfig();
            $state_id = $this->city_model->getCityByID(@$data['jobpost']->CityID);
            $country_id = $this->state_model->getStateByID(@$state_id->StateID);
            //print_r($country_id);die(); 
            $data['country'] = getCountryStateComboBox(@$country_id->CountryID);
            $data['state'] = getStateBasedCombobox(@$state_id->StateID, @$country_id->CountryID);
            $data['cities'] = GetCityBasedState($data['jobpost']->CityID, @$state_id->StateID);
            $data['NatureOfEmployment'] = GetNatureOfEmployment($data['jobpost']->NatureOfEmployment);
            $data['DesiredCandidateProfile'] = GetDesiredCandidateProfile($data['jobpost']->DesiredJobProfile);

            $this->load->view('admin/masters/jobpost/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/jobpost/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data, $res);
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
    public function details($ID = 0)
    {

        $this->UserID = $ID;
        $data = array();
        $_POST['UserID'] = $data['ID'] = $ID;
        $data['config'] = $this->config_model->getConfig();
        $data['Salary'] = GetSalary();
        $data['Designation'] = getDesignationCombobox(0, 1);
        $data['details'] = $this->jobpost_model->getByID($ID);
        $data['page_level_js'] = $this->load->view('admin/masters/jobpost/details_js', $data, TRUE);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/masters/jobpost/details', $data);
        $this->load->view('admin/includes/footer', $data);
        unset($data);
    }

    function changeStatus()
    {
        try {
            if ($this->cur_module->is_status == 0) {
                echo json_encode(array('result' => 'error', 'message' => label('not_eligible_for_change')));
                die;
            }
            if ($this->input->post()) {
                $res = $this->jobpost_model->changeStatus($this->input->post());
                if ($res) {
                    $message = ($this->input->post('status') == 1) ? label('status_active') : label('status_inactive');
                    echo json_encode(array('result' => 'success', 'message' => $message));
                } else {
                    echo json_encode(array('result' => 'error', label('please_try_again')));
                }
            }
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

    public function checkDuplicateDouble()
    {
        try {
            if ($this->input->post()) {
                $res = $this->jobpost_model->checkDuplicateDouble($this->input->post());
                //print_r($res);die();
                if (@$res->Count == 0)
                    echo json_encode(array('result' => 'Success', 'count' => $res->Count));
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

    public function export_to_excel()
    {

        if ($this->cur_module->is_export == 0)
            show_404();
        //load our new PHPExcel library
        $this->load->library('excel');
        $res['jobpost'] = $this->jobpost_model->listData(-1, 1);

        $dataResult['result'] = array();
        if (!empty($res['jobpost'])) {
            $dataResult['result'] = $res['jobpost'];
        }
        $fields = array("SrNo", "JobTitle", "CompanyName", "IndustryType", "Designation", "NatureOfEmployment", "MinExperience", "MaxExperience", "MinSalary", "MaxSalary");
        //Header Define
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
        if (!empty($res['jobpost'])) {
            foreach ($dataResult['result'] as $rr => $data) {
                $col = 0;
                foreach ($fields as $field) {

                    if ($field == 'SrNo')
                        $data->$field = $SerialNo;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    $col++;
                }
                $row++;
                $SerialNo++;
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $filename = 'Jobpost.xls';
        //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel');
        //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
        //readfile("jobpost.xls");
    }

    public function shortlist()
    {
        echo 15;
        die;
        $data['config'] = $this->config_model->getConfig();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/masters/shortlist/add_edit', $data);
        $this->load->view('admin/includes/footer', $data);
    }
}
