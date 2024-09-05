<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ErrorLog extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/errorlog_model');
		$tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",9)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
    }

    public function index($per_page_record = 10, $page_number = 1) {
        $result_error_log = $data = array();
		$this->load->view('admin/includes/header');
		$result_error_log['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		$this->load->view('admin/configuration/errorlog/list', $result_error_log);
		$data['page_level_js'] = $this->load->view('admin/configuration/errorlog/list_js', NULL, TRUE);
		$data['footer']['listing_page'] = 'yes';
		$this->load->view('admin/includes/footer', $data);
		unset($result_error_log, $data);
		/*try {
            $this->load->view('admin/includes/header');
            $result_error_log = $data = array();
            $result_error_log['total_records'] = $this->error_log_model->getRecordCount();
            $result_error_log['per_page_record'] = $per_page_record;
            $result_error_log['page_number'] = $page_number;
            $result_error_log['error_logs'] = $this->error_log_model->listErrorLog($per_page_record, $page_number);
            $this->load->view('admin/configuration/error_log/list', $result_error_log);
            $data['page_level_js'] = $this->load->view('admin/configuration/error_log/list_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
            unset($result_error_log, $data);
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
            );
            $this->common_model->insertAdminError($error_array);
        }*/
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['error_logs'] = $this->errorlog_model->listData($per_page_record, $page_number);
		
        if (empty($result['error_logs']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['error_logs'][0]->rowcount;
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		

        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/configuration/errorlog/ajax_listing', $result, TRUE);
            //print_r($result['error_logs']);die();
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="6" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'b' => ''));
    }

    function changeStatus() {
        try {
            if ($this->input->post()) {
                $this->errorlog_model->changeStatus($this->input->post());
            }
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function export_to_excel() {
        //load our new PHPExcel library
        $this->load->library('excel');
        $error_log_result['error_logs'] = $this->errorlog_model->listData(-1, 1);

        $dataResult['result'] = array();
        if (!empty($error_log_result['error_logs'])) {
            $dataResult['result'] = $error_log_result['error_logs'];
        }
        $fields = array("SrNo", "MethodName", "ErrorDate"); //Header Define
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
        if (!empty($error_log_result['error_logs'])) {
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

        $filename = 'ErrorLog.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
