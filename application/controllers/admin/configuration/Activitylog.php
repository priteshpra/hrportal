<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activitylog extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/activitylog_model');
		$tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",7)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
    }

    public function index($per_page_record = 10, $page_number = 1) {
        $res = $data = array();
		$this->load->view('admin/includes/header');
		$res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		$this->load->view('admin/configuration/activitylog/list', $res);
		$data['page_level_js'] = $this->load->view('admin/configuration/activitylog/list_js', NULL, TRUE);
		$data['footer']['listing_page'] = 'yes';
		$this->load->view('admin/includes/footer', $data);
		unset($res, $data);
		/*try {
            $this->load->view('admin/includes/header');
            $res = array();
            $res['total_records'] = $this->activitylog_model->getRecordCount();
            $res['per_page_record'] = $per_page_record;
            $res['page_number'] = $page_number;
            $res['customer_activity_logs'] = $this->activitylog_model->listCustomerActivityLog($per_page_record, $page_number);
            $this->load->view('admin/configuration/activitylog/list', $res);
            $data = array();
            $data['page_level_js'] = $this->load->view('admin/configuration/activitylog/list_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
            unset($res);
            unset($data);
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
            );
            $this->common_model->insertAdminError($error_array);
        }*/
    }

    public function export_to_excel() {
        if($this->cur_module->is_export == 0)
                        show_404();
        //load our new PHPExcel library
        $this->load->library('excel');
        $data['array'] = $this->activitylog_model->listData(-1, 1);
        
        $dataResult['result'] = array();

        if (!empty($data['array'])) {
            $dataResult['result'] = $data['array'];
        }
       
        $fields = array("SrNo", "MethodName","ActivityDescription", "CreatedDate"); //Header Define
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
        if (!empty($data['array'])) {
            foreach ($dataResult['result'] as $rr => $data) {

                $col = 0;
                foreach ($fields as $field) {

                    if ($field == 'SrNo')
                        $data->$field = $SerialNo;
                    if ($field == 'CreatedDate' && $data->$field!='')
                        $data->$field = GetDateTimeInFormat($data->$field);
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    $col++;
                }
                $row++;
                $SerialNo++;
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $filename = 'Admin Activity Log.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();

        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['customer_activity_logs'] = $this->activitylog_model->listData($per_page_record, $page_number);

        if (empty($result['customer_activity_logs']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['customer_activity_logs'][0]->rowcount;

        //$result['total_records'] = $this->city_model->getRecordCount();
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);

        //print_r($result);exit;
        if ($result['total_records'] != 0) {
            $ajax_listing = $this->load->view('admin/configuration/activitylog/ajax_listing', $result, TRUE);
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="6" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'b' => ''));
    }

    function changeStatus() {
        try {
            if ($this->input->post()) {
                $this->activitylog_model->changeStatus($this->input->post());
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

}
