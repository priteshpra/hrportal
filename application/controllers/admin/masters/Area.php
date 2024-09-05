<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Area extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",5)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
        $this->load->model('admin/area_model');
    }

    public function index() {
		$res = $data = array();
		$this->load->view('admin/includes/header');
		$res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		$res['cities'] = getCityCombobox();
		$this->load->view('admin/masters/area/list', $res);
		$data['page_level_js'] = $this->load->view('admin/masters/area/list_js', NULL, TRUE);
		$data['footer']['add_link'] = $this->config->item('base_url') . 'admin/masters/area/add';
		$data['footer']['listing_page'] = 'yes';
		$this->load->view('admin/includes/footer', $data);
		unset($res, $data);
		
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['area'] = $this->area_model->listData($per_page_record, $page_number);
        if (empty($result['area']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['area'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/area/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="6" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
    }

    public function add() {
        try {
            if(@$this->cur_module->is_insert == 0)
                        show_404();
            $data = $array = array();

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('AreaName', 'AreaName', 'trim|required');
				
                if ($this->form_validation->run() == TRUE) {
                    $res = $this->area_model->insert($this->input->post());

                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/area');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                       
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/area/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/area/add');
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'add';
            $data['loading_button'] = getLoadingButton();
			$data['country'] = getCountryStateComboBox();
            $data['state'] = getStateBasedCombobox(0,-1);
            $data['cities'] = GetCityBasedState(0,-1);
            $this->load->view('admin/masters/area/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/area/add_edit_js', NULL, TRUE);
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
                $this->form_validation->set_rules('AreaName', 'AreaName', 'trim|required');
				
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = $ID;
                    $res = $this->area_model->update($data);
                    //print_r($res);die();
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/area');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
						
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/area/edit/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/area/edit/' . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'edit/' . $ID;
            $data['area'] = $this->area_model->getByID($ID);
            if(empty($data['area'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/area/');
            }
            $data['loading_button'] = getLoadingButton();
			$data['cities'] = getCityCombobox(@$data['area']->CityID);
            $this->load->view('admin/masters/area/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/area/add_edit_js', NULL, TRUE);
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
                $res = $this->area_model->changeStatus($this->input->post());
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

    public function export_to_excel() {
        
        if($this->cur_module->is_export == 0)
                        show_404();
        //load our new PHPExcel library
        $this->load->library('excel');
        $res['area'] = $this->area_model->listData(-1, 1);

        $dataResult['result'] = array();
        if (!empty($res['area'])) {
            $dataResult['result'] = $res['area'];
        }
        $fields = array("SrNo", "AreaName","CityName"); 
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
        if (!empty($res['area'])) {
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
        $filename = 'Area.xls'; 
        //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); 
        //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); 
        //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
        //readfile("area.xls");
}
}
