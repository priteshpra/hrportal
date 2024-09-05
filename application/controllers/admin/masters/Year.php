<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Year extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/year_model');
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",73)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
    }

    public function index($per_page_record = 10, $page_number = 1) {
        try {
            $data = $array = array();
            $this->load->view('admin/includes/header');
            $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
            $this->load->view('admin/masters/year/list', $array);
            $data['page_level_js'] = $this->load->view('admin/masters/year/list_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
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
        $result['year'] = $this->year_model->listYear($per_page_record, $page_number);
        if (empty($result['year']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['year'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);

        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/year/ajax_listing_year', $result, TRUE);
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
                $this->form_validation->set_rules('Year', 'Year', 'trim|required');
                $this->form_validation->set_rules('YearDuration', 'YearDuration', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $res = $this->year_model->insertYear($this->input->post());
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/year');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/year/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/year/add');
                }
            }

            $this->load->view('admin/includes/header');
            $data = array();
            $data['page'] = 'add';
            $data['loading_button'] = getLoadingButton();
            $this->load->view('admin/masters/year/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/year/add_edit_js', NULL, TRUE);
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

    public function edit($year_id = NULL) {
        try {
            if(@$this->cur_module->is_insert == 0)
                        show_404();
            $data = $res = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('Year', 'Year', 'trim|required');
                $this->form_validation->set_rules('YearDuration', 'YearDuration', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $year_array = $this->input->post();
                    $year_array['year_id'] = $year_id;
                    $res = $this->year_model->updateYear($year_array);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/year');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/year/edit/' . $year_id);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/year/edit/' . $year_id);
                }
            }
            $this->load->view('admin/includes/header');
            $data['page'] = 'edit/' . $year_id;
            $data['year'] = $this->year_model->getyearDetailsByID($year_id);
            if(empty($data['year'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/year/');
            }
            $data['loading_button'] = getLoadingButton();
            $this->load->view('admin/masters/year/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/year/add_edit_js', NULL, TRUE);
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

    function changeStatus() {
        try {
             if($this->cur_module->is_status == 0){
                echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
                die;
            }
            if ($this->input->post()) {
                $res = $this->year_model->changeStatus($this->input->post());
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
        $year_result['year'] = $this->year_model->listyear(-1, 1);

        /*  pr($year_result['year']);
          die(); */
        $dataResult['result'] = array();

        if (!empty($year_result['year'])) {
            $dataResult['result'] = $year_result['year'];
        }
        $fields = array("SrNo", "year" , "YearDuration"); //Header Define
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
        if (!empty($year_result['year'])) {
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

        $filename = 'Year.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
