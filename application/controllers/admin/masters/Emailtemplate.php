<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emailtemplate extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/emailtemplate_model');
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",10)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
    }

    public function index() {
		$res = $data = array();
		$this->load->view('admin/includes/header');
		$res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		$this->load->view('admin/masters/emailtemplate/list', $res);
		$data['page_level_js'] = $this->load->view('admin/masters/emailtemplate/list_js', NULL, TRUE);
		$data['footer']['add_link'] = $this->config->item('base_url') . 'admin/masters/emailtemplate/add';
		$data['footer']['listing_page'] = 'yes';
		$this->load->view('admin/includes/footer', $data);
		unset($res, $data);
		
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['emailtemplate'] = $this->emailtemplate_model->listData($per_page_record, $page_number);
        if (empty($result['emailtemplate']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['emailtemplate'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/emailtemplate/ajax_listing', $result, TRUE);
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
                $this->form_validation->set_rules('EmailTemplateTitle', 'EmailTemplateTitle', 'trim|required');
				$this->form_validation->set_rules('EmailSubject', 'EmailSubject', 'trim|required');
				$this->form_validation->set_rules('Content', 'Content', 'trim|required');
				
				
                if ($this->form_validation->run() == TRUE) {
                    $res = $this->emailtemplate_model->insert($this->input->post());
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/emailtemplate');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/emailtemplate/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/emailtemplate/add');
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'add';
            $data['loading_button'] = getLoadingButton();
			
            $this->load->view('admin/masters/emailtemplate/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/emailtemplate/add_edit_js', NULL, TRUE);
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
                $this->form_validation->set_rules('EmailTemplateTitle', 'EmailTemplateTitle', 'trim|required');
				$this->form_validation->set_rules('EmailSubject', 'EmailSubject', 'trim|required');
				$this->form_validation->set_rules('Content', 'Content', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = $ID;
                    $res = $this->emailtemplate_model->update($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/emailtemplate');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/emailtemplate/edit/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/emailtemplate/edit/' . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'edit/' . $ID;
            $data['emailtemplate'] = $this->emailtemplate_model->getEmailtemplateByID($ID);
            if(empty($data['emailtemplate'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/emailtemplate/');
            }
            $data['loading_button'] = getLoadingButton();
			$this->load->view('admin/masters/emailtemplate/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/emailtemplate/add_edit_js', NULL, TRUE);
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
                $res = $this->emailtemplate_model->changeStatus($this->input->post());
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
