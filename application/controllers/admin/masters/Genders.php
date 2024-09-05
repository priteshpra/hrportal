<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Genders extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/genders_model');
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",35)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
    }

    public function index() {
        try {
            $data = $array = array();
            $this->load->view('admin/includes/header');
            $data['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
            $this->load->view('admin/masters/genders/list', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/genders/list_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data,$array);
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

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['genders'] = $this->genders_model->listGenders($per_page_record, $page_number);
        if (empty($result['genders']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['genders'][0]->rowcount;
            $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/genders/ajax_listing_gender', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="6" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'b' => ''));
        unset($result);
    }

    public function add() {
        try {
            if(@$this->cur_module->is_insert == 0)
                        show_404();
            $data = $res = array();

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('Gender', 'Gender', 'trim|required');
                $this->form_validation->set_rules('genderValue', 'genderValue', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $res = $this->genders_model->insertGenders($this->input->post());
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/genders');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/genders/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/genders/add');
                }
            }

            $this->load->view('admin/includes/header');
            $data['page'] = 'add';
            $data['loading_button'] = getLoadingButton();
            $this->load->view('admin/masters/genders/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/genders/add_edit_js', NULL, TRUE);
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

    public function edit($genders_id = NULL) {
        try {
            if(@$this->cur_module->is_insert == 0)
                        show_404();
            $data = $res = array();
            if(@$this->cur_module->is_edit == 0)
                        show_404();
            $data = $res = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('Gender', 'Gender', 'trim|required');
                $this->form_validation->set_rules('genderValue', 'genderValue', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['genders_id'] = $genders_id;
                    $res = $this->genders_model->updateGenders($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/genders');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/genders/edit/' . $genders_id);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/genders/edit/' . $genders_id);
                }
            }

            $this->load->view('admin/includes/header');
            $res['page'] = 'edit/' . $genders_id;
            $res['genders'] = $this->genders_model->getgendersDetailsByID($genders_id);       
            $res['loading_button'] = getLoadingButton();
            $this->load->view('admin/masters/genders/add_edit', $res);
            $data['page_level_js'] = $this->load->view('admin/masters/genders/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
            unset($res,$data);
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

    function changeStatus() {
        try {
            if($this->cur_module->is_status == 0){
                echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
                die;
            }
            if ($this->input->post()) {
                $res = $this->genders_model->changeStatus($this->input->post());
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

    public function export_to_excel() {
        //load our new PHPExcel library
        $this->load->library('excel');
        $genders_result['genders'] = $this->genders_model->listgenders(-1, 1);

        /*  pr($genders_result['genders']);
          die(); */
        $dataResult['result'] = array();

        if (!empty($genders_result['genders'])) {
            $dataResult['result'] = $genders_result['genders'];
        }
        $fields = array("SrNo", "gender","genderValue"); //Header Define
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
        if (!empty($genders_result['genders'])) {
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

        $filename = 'Genders.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
