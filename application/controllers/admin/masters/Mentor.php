<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mentor extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",22)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
        $this->load->model('admin/mentor_model');
    }

    public function index() {
		$res = $data = array();
		$this->load->view('admin/includes/header');
		$res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		$res['cities'] = getCityCombobox();
		$this->load->view('admin/masters/mentor/list', $res);
		$data['page_level_js'] = $this->load->view('admin/masters/mentor/list_js', NULL, TRUE);
		$data['footer']['add_link'] = $this->config->item('base_url') . 'admin/masters/mentor/add';
		$data['footer']['listing_page'] = 'yes';
		$this->load->view('admin/includes/footer', $data);
		unset($res, $data);
		
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['mentor'] = $this->mentor_model->listData($per_page_record, $page_number);
        if (empty($result['mentor']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['mentor'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/mentor/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="9" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
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
                $this->form_validation->set_rules('BriefBio', 'BriefBio', 'trim|required');
                $this->form_validation->set_rules('EmailID', 'EmailID', 'trim|required');
                $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
             
                if ($this->form_validation->run() == TRUE) {
                    $url = site_url("admin/masters/mentor/add");
                    $config = array("max_width" => MENTOR_MAX_WIDTH,
                        "max_height" => MENTOR_MAX_HEIGHT,
                        'max_size' => MENTOR_MAX_SIZE,
                        'path' => MENTOR_UPLOAD_PATH,
                        'allowed_types' => MENTOR_ALLOWED_TYPES,
                        'tpath' => MENTOR_THUMB_UPLOAD_PATH,
                        'twidth' => MENTOR_THUMB_MAX_WIDTH,
                        'theight' => MENTOR_THUMB_MAX_HEIGHT
                    );
                    
                    $data = $this->input->post();
                    $data['image'] = FileUploadURL("userfile", "editProfilePicture", $config, '', $url);

                    $res = $this->mentor_model->insert($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/mentor');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );

                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/mentor/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/mentor/add');
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'add';
            $data['loading_button'] = getLoadingButton();
			$data['Designation'] = getDesignationCombobox();
            $this->load->view('admin/masters/mentor/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/mentor/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $array);
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
            if(@$this->cur_module->is_edit == 0)
                        show_404();
            $data = $res = array();

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
                $this->form_validation->set_rules('BriefBio', 'BriefBio', 'trim|required');
                
                if ($this->form_validation->run() == TRUE) {
                     $url = site_url("admin/masters/mentor/edit/".$ID);
                    $config = array("max_width" =>  MENTOR_MAX_WIDTH,
                        "max_height" => MENTOR_MAX_HEIGHT,
                        'max_size' => MENTOR_MAX_SIZE,
                        'path' => MENTOR_UPLOAD_PATH,
                        'allowed_types' => MENTOR_ALLOWED_TYPES,
                        'tpath' => MENTOR_THUMB_UPLOAD_PATH,
                        'twidth' => MENTOR_THUMB_MAX_WIDTH,
                        'theight' => MENTOR_THUMB_MAX_HEIGHT
                    );
                    $data = $this->input->post();
                    $data['image'] = FileUploadURL("userfile", "editProfilePicture", $config, '', $url);
                    //print_r($data['image']);die();    
                    $data['ID'] = $ID;
                    $res = $this->mentor_model->update($data);
                    //print_r($res);die();
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/mentor');
                    } else {

                        $UserType = $this->session->userdata('UserType');
                        $UserType =  $UserType. " Web";
                        if($UserType==" Web"){
                            $UserType = 'Admin Web';
                        }
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $UserType,
                            "User_Agent" => getUserAgent()
                        );
                        //pr($error_array);die('123');
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/mentor/edit/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/mentor/edit/' . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'edit/' . $ID;
            $data['mentor'] = $this->mentor_model->getByID($ID);
            if(empty($data['mentor'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/mentor/');
            }
            $data['loading_button'] = getLoadingButton();
			$data['Designation'] = getDesignationCombobox($data['mentor']->DesignationID);

            $this->load->view('admin/masters/mentor/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/mentor/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
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
    function changeStatus() {
        try {
            if($this->cur_module->is_status == 0){
                echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
                die;
            }
            if ($this->input->post()) {
                $res = $this->mentor_model->changeStatus($this->input->post());
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
                "Type" => $this->session->user_data['UserType'] . " Web",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function details($ID = 0){

        $data = array();
        $_POST['CandidateID'] = $data['ID'] = $ID;
        $data['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $data['details'] = $data['mentor'] = $this->mentor_model->getByID($ID);
        $data['user'] = getUserCombobox($ID,'Mentor',label('msg_lbl_select_mentor'));

        //$data['cities'] = getCityCombobox(@$data['details']->CityID);
        //$data['designation'] = getDesignationCombobox();
        
        $data['page_level_js'] = $this->load->view('admin/masters/mentor/details_js', $data, TRUE);
        // $data['page_level_js'] = $this->load->view('admin/masters/video/list_js', $data, TRUE);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/masters/mentor/details',$data);
        $this->load->view('admin/includes/footer',$data);
        unset($data);
    }

    public function ajax_subscription_listing($per_page_record = 10, $page_number = 1, $ID = 0) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $ID = $this->input->post('UserID');
        $SearchText = $this->input->post('SearchText');
        $result['video'] = $this->mentor_model->subscriptionData($per_page_record, $page_number,$ID,$SearchText);
        
        if (empty($result['video']) || isset($result['video'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['video'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/mentor/ajax_listing_subscribe_video', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="9" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
    }

    public function export_to_excel() {
        
        if($this->cur_module->is_export == 0)
                        show_404();
        //load our new PHPExcel library
        $this->load->library('excel');
        $res['mentor'] = $this->mentor_model->listData(-1, 1);

        $dataResult['result'] = array();
        if (!empty($res['mentor'])) {
            $dataResult['result'] = $res['mentor'];
        }
        $fields = array("SrNo", "FirstName","LastName","StatusText","BriefBio", "EmailID", "MobileNo"); 
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
        if (!empty($res['mentor'])) {
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
        $filename = 'Mentor.xls'; 
        //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); 
        //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); 
        //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
        //readfile("mentor.xls");
}
}
