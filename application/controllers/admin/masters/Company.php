<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",24)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (empty($this->cur_module)) {
            show_404();
        }
        $this->load->model('admin/company_model');
        $this->load->model('admin/jobpost_model');
        $this->load->model('admin/config_model');
    }

    public function index()
    {
        $res = $data = array();
        $this->load->view('admin/includes/header');
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $res['cities'] = getCityCombobox();
        $res['designation'] = getDesignationCombobox();
        $this->load->view('admin/masters/company/list', $res);
        $data['page_level_js'] = $this->load->view('admin/masters/company/list_js', NULL, TRUE);
        $data['footer']['add_link'] = $this->config->item('base_url') . 'admin/masters/company/add';
        $data['footer']['listing_page'] = 'yes';
        $this->load->view('admin/includes/footer', $data);
        unset($res, $data);
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1)
    {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['company'] = $this->company_model->listData($per_page_record, $page_number);
        if (empty($result['company']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['company'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/company/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="10" style="text-align: center;">' . label('no_records_found') . ' </td></tr>', 'b' => ''));
    }

    public function ajax_employee($per_page_record = 10, $page_number = 1)
    {
        //print_r($this->input->post());die();
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['employee'] = $this->company_model->listEmployee($per_page_record, $page_number, $this->input->post('CompanyID'));

        if (empty($result['employee']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['employee'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/company/ajax_listing_employee', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="10" style="text-align: center;">' . label('no_records_found') . ' </td></tr>', 'b' => ''));
    }




    public function ajax_alljobs($per_page_record = 10, $page_number = 1)
    {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $Type = $this->input->post('JobStatus');
        if ($Type == "All") {
            $result['href'] = 'all_job';
        } else if ($Type == "Active") {
            $result['href'] = 'job_status';
        } else if ($Type == "RecentlyApplied") {
            $result['href'] = 'all_recent';
        }
        $result['alljobs'] = $this->company_model->listCompanyByAllJobs($this->input->post('CompanyID'), $per_page_record, $page_number, $this->input->post('JobStatus'));
        if (isset($result['alljobs'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['alljobs'][0]->rowcount;

        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);

        $ajax_listing = $this->load->view('admin/masters/company/ajax_listing_alljobs', $result, TRUE);
        if ($result['total_records'] != 0)
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        else
            echo json_encode(array('a' => '<tr><td colspan="14" style="text-align: center;">No Records Found.</td></tr>', 'b' => ''));
    }

    public function ajax_directinvite($per_page_record = 10, $page_number = 1)
    {

        $result = array();
        $result['per_page_record'] = $result['PageSize'] = $per_page_record;
        $result['page_number'] = $result['CurrentPage'] = $page_number;
        $result['UserID'] = $this->input->post('UserID');
        $result['allinvite'] = $this->company_model->ListCandidateByCompanyInvited($result);
        // print_r($result['allinvite']); die;
        if (isset($result['allinvite'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['allinvite'][0]->rowcount;

        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
        $ajax_listing = $this->load->view('admin/masters/company/ajax_listing_candidates', $result, TRUE);
        if ($result['total_records'] != 0)
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        else
            echo json_encode(array('a' => '<tr><td colspan="12" style="text-align: center;">No Records Found.</td></tr>', 'b' => ''));
    }

    public function ajax_hired($per_page_record = 10, $page_number = 1, $type = null)
    {

        $result = array();
        $result['per_page_record'] = $result['PageSize'] = $per_page_record;
        $result['page_number'] = $result['CurrentPage'] = $page_number;
        $result['Type'] = $type;
        $result['UserID'] = $this->input->post('UserID');
        $result['allinvite'] = $this->company_model->ListCandidate($result);
        // print_r($result['allinvite']); die;
        if (isset($result['allinvite'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['allinvite'][0]->rowcount;

        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
        $ajax_listing = $this->load->view('admin/masters/company/ajax_listing_candidates', $result, TRUE);
        if ($result['total_records'] != 0)
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        else
            echo json_encode(array('a' => '<tr><td colspan="12" style="text-align: center;">No Records Found.</td></tr>', 'b' => ''));
    }


    public function ajax_jobdetails($per_page_record = 10, $page_number = 1, $JobPostType = "View")
    {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['allcandidate'] = $this->company_model->listCandidateList($this->input->post('ID'), $per_page_record, $page_number, $this->input->post('JobPostType'));

        if (isset($result['allcandidate'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['allcandidate'][0]->rowcount;

        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
        $ajax_listing = $this->load->view('admin/masters/company/ajax_listing_job', $result, TRUE);
        if ($result['total_records'] != 0)
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        else
            echo json_encode(array('a' => '<tr><td colspan="14" style="text-align: center;">No Records Found.</td></tr>', 'b' => ''));
    }
    public function add()
    {
        try {
            if (@$this->cur_module->is_insert == 0)
                show_404();
            $data = $array = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('CompanyName', 'CompanyName', 'trim|required');
                $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
                $this->form_validation->set_rules('Latitude', 'Latitude', 'trim|required');
                $this->form_validation->set_rules('Longitude', 'Longitude', 'trim|required');
                if ($this->form_validation->run() == TRUE) {

                    $url = site_url("admin/masters/company/add");
                    $config = array(
                        "max_width" => COMPANYLOGO_MAX_WIDTH,
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
                    $res = $this->company_model->insert($data);
                    //print_r($res);die();
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/company');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/company/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/company/add');
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'add';
            $data['loading_button'] = getLoadingButton();
            $data['designation'] = getDesignationCombobox();
            $data['country'] = getCountryStateComboBox();
            $data['state'] = getStateBasedCombobox(0, -1);
            $data['cities'] = GetCityBasedState(0, -1);
            $this->load->view('admin/masters/company/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/company/add_edit_js', $data, TRUE);
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

                $this->form_validation->set_rules('StatusText', 'StatusText', 'trim|required');
                $this->form_validation->set_rules('Latitude', 'Latitude', 'trim|required');
                $this->form_validation->set_rules('Longitude', 'Longitude', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $url = site_url("admin/masters/company/edit/" . $ID);
                    $config = array(
                        "max_width" =>  COMPANYLOGO_MAX_WIDTH,
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
                    $res = $this->company_model->update($data);
                    //print_r($res);die();
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/company');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()

                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/company/edit/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/company/edit/' . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'edit/' . $ID;
            $data['company'] = $this->company_model->getByID($ID);
            //print_r($data['company']);die();
            if (empty($data['company'])) {
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/company/');
            }
            $data['loading_button'] = getLoadingButton();
            $data['designation'] = getDesignationCombobox(@$data['company']->DesignationID);
            $data['country'] = getCountryStateComboBox(@$data['company']->CountryID);
            $data['state'] = getStateBasedCombobox(@$data['company']->StateID, @$data['company']->CountryID);
            $data['cities'] = GetCityBasedState($data['company']->CityID, @$data['company']->StateID);
            $this->load->view('admin/masters/company/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/company/add_edit_js', $data, TRUE);
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

    public function addemployee($ID = 0)
    {
        try {
            if (@$this->cur_module->is_insert == 0 || $ID == 0)
                show_404();
            $data = $array = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
                $this->form_validation->set_rules('EmailID', 'EmailID', 'trim|required');
                if ($this->form_validation->run() == TRUE) {

                    $this->CompanyID = $ID;
                    $data = array();
                    $_POST['CompanyID'] = $data['CompanyID'] = $ID;
                    //print_r($data);die();
                    $data = $this->input->post();
                    $res = $this->company_model->insertemployee($data);

                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/company/details/' . $ID . '#all_employee');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/company/addemployee');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/company/addemployee');
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'addemployee/' . $ID;
            $data['CompanyID'] = $ID;
            $data['AddFlag'] = 1;
            $data['validation_check'] = '1';
            $data['loading_button'] = getLoadingButton();
            $data['designation'] = getDesignationCombobox();
            $this->load->view('admin/masters/company/add_edit_employee', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/company/add_edit_employee_js', $data, TRUE);
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

    public function editemployee($ID = NULL)
    {

        try {
            if (@$this->cur_module->is_edit == 0)
                show_404();
            $data = $res = array();

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');


                if ($this->form_validation->run() == TRUE) {

                    $data = $this->input->post();

                    $data['ID'] = $ID;
                    $res = $this->company_model->updateemployee($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/company/details/' . $data['CompanyID'] . '#all_employee');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()

                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/company/editemployee/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/company/editemployee/' . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'editemployee/' . $ID;
            $data['validation_check'] = '0';
            $data['employee'] = $this->company_model->getEmployeeByID($ID);
            if (empty($data['employee'])) {
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/company/');
            }
            $data['CompanyID'] = $data['employee']->CompanyID;
            $data['loading_button'] = getLoadingButton();
            $data['designation'] = getDesignationCombobox(@$data['employee']->DesignationID);
            $this->load->view('admin/masters/company/add_edit_employee', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/company/add_edit_employee_js', $data, TRUE);
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

        $this->CompanyID = $ID;
        $data = array();
        $_POST['CompanyID'] = $data['ID'] = $ID;

        $data['details'] = $this->company_model->getByID($ID);
        $data['config'] = $this->config_model->getConfig();
        $data['page_level_js'] = $this->load->view('admin/masters/company/details_js', $data, TRUE);
        $data['designation'] = getDesignationCombobox();
        $data['Salary'] = GetSalary();
        $data['Location'] = GetLocation(1);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/masters/company/details', $data);
        $this->load->view('admin/includes/footer', $data);
        unset($data);
    }
    public function job($ID = 0, $Type = null, $red = "all_job")
    {

        $this->JobID = $ID;
        $this->Type = $Type;
        $data = array();
        $_POST['JobID'] = $data['ID'] = $ID;
        $_POST['Type'] = $data['Type'] = $Type;
        $data['job'] = $this->jobpost_model->getByID($ID);
        $data['DivType'] = $data['Type'] . "_job";
        $data['redirect'] = $red;
        $this->load->view('admin/includes/header');
        $this->load->view('admin/masters/company/job', $data);
        $data['page_level_js'] = $this->load->view('admin/masters/company/job_js', $data, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($data);
    }
    public function emailmobileexist()
    {

        $email_id = $this->input->post('email');
        $contact_no = $this->input->post('contact_no');
        $id = $this->input->post('id');
        $exists = $this->company_model->email_exists($email_id, $contact_no, $id);
        if ($exists->emailcount > 0) {
            echo label('email_already_exists');
            exit();
        }
        if ($exists->contactcount > 0) {
            echo label('cellphone_already_exists');
            exit();
        } else {
            echo "1";
            exit();
        }
    }
    function changeStatus()
    {
        try {
            if ($this->cur_module->is_status == 0) {
                echo json_encode(array('result' => 'error', 'message' => label('not_eligible_for_change')));
                die;
            }
            if ($this->input->post()) {
                $res = $this->company_model->changeStatus($this->input->post());
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
    public function changepassword()
    {
        if ($this->input->post() && $this->input->is_ajax_request()) {
            $password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');
            // print_r($confirm_password);die();
            if ($password == $confirm_password) {
                $res = $this->company_model->changePassword();
                if ($res) {
                    echo json_encode(array('Status' => 'Success', 'Message' => label('profile_update_successful')));
                } else {
                    echo json_encode(array('Status' => 'Error', 'Message' => label('please_try_again')));
                }
            } else {
                echo json_encode(array('Status' => 'Error', 'Message' => label('password_not_updated')));
            }
        } else {
            show_404();
        }
    }
    public function export_to_excel()
    {

        if ($this->cur_module->is_export == 0)
            show_404();
        //load our new PHPExcel library
        $this->load->library('excel');
        $res['company'] = $this->company_model->listData(-1, 1);

        $dataResult['result'] = array();
        if (!empty($res['company'])) {
            $dataResult['result'] = $res['company'];
        }
        $fields = array("SrNo", "CompanyName", "FirstName", "EmailID", "Address", "CountryName", "StateName", "CityName", "Designation", "StatusText", "WebsiteURL", "CompanyLogo", "Latitude", "Longitude");
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
        if (!empty($res['company'])) {
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
        $filename = 'Company.xls';
        //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel');
        //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
        //readfile("company.xls");
    }
}
