<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/page_model');
        $this->load->helper('common_helper');
    }

    public function index($per_page_record = 10, $page_number = 1) {
        try {
            $this->load->view('admin/includes/header');
            $page_result = array();
            $page_result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
            $this->load->view('admin/masters/page/list', $page_result);
            $data = array();
            $data['page_level_js'] = $this->load->view('admin/masters/page/list_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
            unset($page_result);
            unset($data);
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
        $result['page'] = $this->page_model->listPage($per_page_record, $page_number);
        //print_r($result['page']); exit;
        if (empty($result['page']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['page'][0]->rowcount;
        //$result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/page/ajax_listing_page', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="6" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'b' => ''));
    }

    public function add() {
        try {

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('PageName', 'PageName', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $res = $this->page_model->insertPage($this->input->post());
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/page');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/page/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/page/add');
                }
            }

            $this->load->view('admin/includes/header');
            $data = array();
            $data['page_name'] = 'add';
            $data['loading_button'] = getLoadingButton();
            $this->load->view('admin/masters/page/add_edit', $data);
            $data = array();
            $data['page_level_js'] = $this->load->view('admin/masters/page/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
            unset($data);
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

    public function edit($page_id = NULL) {
        try {
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('PageName', 'PageName', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $caregory_array = $this->input->post();
                    $caregory_array['page_id'] = $page_id;
                    $res = $this->page_model->updatePage($caregory_array);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/page');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/page/edit/' . $page_id);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/page/edit/' . $page_id);
                }
            }

            $this->load->view('admin/includes/header');
            $page_result = $data = array();
            $page_result['page_name'] = 'edit/' . $page_id;
            $page_result['page'] = $this->page_model->getPageDetailsByID($page_id);
            $page_result['loading_button'] = getLoadingButton();
            $this->load->view('admin/masters/page/add_edit', $page_result);
            $data['page_level_js'] = $this->load->view('admin/masters/page/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
            unset($page_result, $data);
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
            if ($this->input->post()) {
                $this->page_model->changeStatus($this->input->post());
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
        $page_result['page'] = $this->page_model->listpage(-1, 1);

        /*  pr($page_result['page']);
          die(); */
        $dataResult['result'] = array();

        if (!empty($page_result['page'])) {
            $dataResult['result'] = $page_result['page'];
        }
        $fields = array("SrNo", "PageName"); //Header Define
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
        if (!empty($page_result['page'])) {
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

        $filename = 'page.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
