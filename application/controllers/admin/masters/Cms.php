<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/cms_model');
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",16)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
    }

    public function index() {
        $array = $data = array();
		$this->load->view('admin/includes/header');
		$array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		$array['pagenames'] = getPageCombobox();
		$this->load->view('admin/masters/cms/list', $array);
		$data['page_level_js'] = $this->load->view('admin/masters/cms/list_js', NULL, TRUE);
		$this->load->view('admin/includes/footer', $data);
		unset($array, $data);
		
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $res = array();
        $res['per_page_record'] = $per_page_record;
        $res['page_number'] = $page_number;
        $res['cms'] = $this->cms_model->listData($per_page_record, $page_number);
       if (empty($res['cms']))
            $res['total_records'] = 0;
        else
            $res['total_records'] = $res['cms'][0]->rowcount;

        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/masters/cms/ajax_listing', $res, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="4" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'b' => ''));
        unset($res);
    }

    public function add() {
        try {
            if(@$this->cur_module->is_insert == 0)
                        show_404();
            $data = $res = array();
			
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('PageID', 'PageID', 'required');
				$this->form_validation->set_rules('Content', 'Content', 'trim|required');
				
				if ($this->form_validation->run() == TRUE) {
                   
				
					$res = $this->cms_model->insert($this->input->post());
                     
					if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/cms');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/cms/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/cms/add');
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'add';
            $data['loading_button'] = getLoadingButton();
			$data['pagenames'] = getPageCombobox();
            $this->load->view('admin/masters/cms/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/cms/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data,$res);
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => $this->session->user_data['UserType'] . " Web",
                "User_Agent" => getUserAgent(),
				"IPAddress" => GetIP()
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
				$this->form_validation->set_rules('PageID', 'PageID', 'required');
				$this->form_validation->set_rules('Content', 'Content', 'trim|required');
				
				if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = $ID;
                    $res = $this->cms_model->update($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/cms');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/cms/edit/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/cms/edit/' . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'edit/' . $ID;
            $data['cms'] = $this->cms_model->getCmsByID($ID);
            if(empty($data['cms'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/cms/');
            }
            $data['loading_button'] = getLoadingButton();
			$data['pagenames'] = getPageCombobox(@$data['cms']->PageID);
            $this->load->view('admin/masters/cms/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/cms/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data,$res);
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => $this->session->user_data['UserType'] . " Web",
                "User_Agent" => getUserAgent(),
				"IPAddress" => GetIP()
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
                $res = $this->cms_model->changeStatus($this->input->post());
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

}
