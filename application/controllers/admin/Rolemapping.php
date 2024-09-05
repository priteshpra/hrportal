<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rolemapping extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/rolemapping_model');
        $this->load->helper('common_helper');
        $this->load->model('admin/role_model');
    }

    public function index($ID = 0) {
        $this->RoleID = $ID;
        $data = array();
        $_POST['RoleID'] = $data['ID'] = $ID;
        $data['details'] = $this->role_model->getCustomerByRoleID($ID);
        $data['roles_data'] = $this->role_model->getRoleByID($ID);
        $data['role_data'] = $data['roles_data']['role'];
        $data['page_level_js'] = $this->load->view('admin/role/details_js', $data, TRUE);
        $data['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        $this->load->view('admin/includes/header');
        $this->load->view('admin/role/details',$data);
        $this->load->view('admin/includes/footer',$data);
        unset($data);
    }

    public function ajax_roles($per_page_record = 10, $page_number = 1) {
        $result = array();
        $RoleID = (@$this->input->post('RoleName'))?$this->input->post('RoleName'):-1;
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['rolemapping'] = $this->role_model->listRoleMapping($per_page_record, $page_number,$RoleID);
        
        if (empty($result['rolemapping']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['rolemapping'][0]->rowcount;
        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);


        $ajax_listing = $this->load->view('admin/role/ajax_listing_rolemapping', $result, TRUE);
        if ($result['total_records'] != 0)
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        else
            echo json_encode(array('a' => '<tr><td colspan="7" style="text-align: center;">No Records Found.</td></tr>', 'b' => ''));
    }

    public function add($id = 0) {
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $res = $this->rolemapping_model->insertRoles($this->input->post());
            //print_r($res);die();
            if (@$res->ID) {
                redirect($this->config->item('base_url') . 'admin/rolemapping');
            } else {
                $error_array = array(
                    "error_message" => $res->Message,
                    "method_name" => $res->Method,
                    "Type" => $this->session->user_data['UserType'] . " Web",
                    "User_Agent" => getUserAgent()
                );
                $this->common_model->insertAdminError($error_array);
                $this->session->set_flashdata('posterror', label('please_try_again'));
                redirect($this->config->item('base_url') . 'admin/rolemapping/add');
            }
        }
        $roleid = 0;
        $result['page'] = "add";
        if ($id > 0) {
            $res = $this->rolemapping_model->getRoleMappingByID($id);
            $roleid = $res->RoleID;
            $result['page'] = "add/$id";
        }
        $result['loading_button'] = getLoadingButton();
        $result['employee'] = getUserCombobox($id);
        $result['roles'] = getAllRolesForCombobox($roleid);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/rolemapping/add_edit', $result);
        $data['page_level_js'] = $this->load->view('admin/rolemapping/add_edit_js', $result, TRUE);
        $this->load->view('admin/includes/footer', $data);
    }

    public function export_to_excel() {
        //load our new PHPExcel library
        $this->load->library('excel');
        $album_result['roles'] = $this->rolemapping_model->listRoleMapping(-1, 1);
        $dataResult['result'] = array();
        if (!empty($album_result['roles'])) {
            $dataResult['result'] = $album_result['roles'];
        }
        $fields = array("SrNo", "FirstName", "RoleName"); //Header Define
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
        if (!empty($album_result['roles'])) {
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
        $filename = 'Roles.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
