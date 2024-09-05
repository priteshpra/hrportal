<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employeedetails extends Company_Controller {

    public function __construct() {
         parent::__construct();
         $this->load->model('company/employeedetails_model');
    }

    public function index() {
        $data = array(); 
        $this->load->view('company/includes/header');
        $data['view_modal_popup'] = $this->load->view('company/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('company/usersession/employee_list',$data);
        $data['page_level_js'] = $this->load->view('company/usersession/employee_list_js', NULL, TRUE);
        $data['footer']['listing_page'] = 'yes';
        $this->load->view('company/includes/footer', $data);
        unset($data);
    }

     public function employee_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['employeedetails'] = $this->employeedetails_model->Employee_listData($per_page_record, $page_number);
        if (empty($result['employeedetails']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['employeedetails'][0]->rowcount;
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('company/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('company/usersession/employee_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="7" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'b' => ''));

    }

    public function add() {
        try {
            
            $data = $res = array();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
            $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
            if ($this->input->post()) {
                if ($this->form_validation->run() == TRUE) {
                    $res = $this->employeedetails_model->insert($this->input->post());
                    
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'company/employeedetails');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Company Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'company/employeedetails/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'company/employeedetails/add');
                }
            } else {
                $this->load->view('admin/includes/header');
                $data['page_name'] = 'add';
                $data['loading_button'] = getLoadingButton();
                $data['designation'] = getDesignationCombobox();
                $this->load->view('company/usersession/add_edit_employee', $data);
                $data = array();
                $data['page_level_js'] = $this->load->view('company/usersession/add_edit_employee_js', NULL, TRUE);
                $this->load->view('admin/includes/footer', $data);
                unset($data,$res);
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

    public function edit($ID = null) {
        try {
            
            $res = $data = array();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
            $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
            if ($this->input->post()) {
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = $ID;
                    $res = $this->employeedetails_model->update($data);
                    //print_r($res);die();
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'company/employeedetails');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Company Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'company/employeedetails/edit/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'company/employeedetails/edit/' . $ID);
                }
            } else {
                $this->load->view('admin/includes/header');
                $res['page_name'] = 'edit/' . $ID;
                $res['employeedetails'] = $this->employeedetails_model->getemployeedetailsByID($ID);
                $res['loading_button'] = getLoadingButton();  
                $res['designation'] = getDesignationCombobox(@$res['employeedetails']->DesignationID);
                $this->load->view('company/usersession/add_edit_employee', $res);
                $data['page_level_js'] = $this->load->view('company/usersession/add_edit_employee_js', NULL, TRUE);
                $this->load->view('admin/includes/footer', $data);
                unset($res, $data);
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

    public function changeStatus() {

        
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
                "Type" => "Company Web",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }


    public function export_to_excel() {
        //load our new PHPExcel library
        $this->load->library('excel');
        $result['employeedetails'] = $this->employeedetails_model->Employee_listData(-1, 1);

        $dataResult['result'] = array();
        if (!empty($result['employeedetails'])) {
            $dataResult['result'] = $result['employeedetails'];
        }
        $fields = array("SrNo","FirstName","LastName","EmailID","Address","MobileNo"); //Header Define
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheetemployeedetails
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow('Export Data');

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
        if (!empty($result['employeedetails'])) {
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

        $filename = 'Employee Details.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

    public function emailmobileexist(){
       
        $email_id = $this->input->post('EmailID');
        $contact_no = $this->input->post('MobileNo');
        $id = $this->input->post('UserID');
        $exists = $this->employeedetails_model->email_exists($email_id,$contact_no,$id); 
        if ($exists->emailcount > 0) {
            echo label('email_already_exists');exit();
        } 
        if($exists->contactcount > 0){
            echo label('cellphone_already_exists');exit();
        }
        else {
            echo "1";exit();
        }
    }


}