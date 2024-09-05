<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Candidate extends Company_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('company/candidate_model');
        $this->load->model('admin/config_model');
    }

    public function index() {
        $res = $data = array();
        $res['config'] = $this->config_model->getConfig();
        $res['Salary'] = GetSalary();
        $res['Location'] = GetLocation(1);
        $res['Reason'] = GetReason();
        $res['Designation'] = getDesignationCombobox(0,1,1);
        $res['JobPost'] = getJobPostCombobox(0,$this->session->userdata['CompanyID']);

        $this->load->view('company/includes/header');
        $this->load->view('company/candidate/list', $res);
        $data['page_level_js'] = $this->load->view('company/candidate/list_js', NULL, TRUE);
        $data['footer']['listing_page'] = 'yes';
        $this->load->view('company/includes/footer', $data);
        unset($res, $data);
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['data_array'] = $this->candidate_model->listData($per_page_record, $page_number);
        // print_r($result['data_array']);die();
        if (empty($result['data_array']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['data_array'][0]->rowcount;

        if ($result['total_records'] != 0) {
            $result['Type'] = $this->input->post('Type');
            $result['InterviewType'] = $this->input->post('InterviewType');
            $pagination = $this->load->view('company/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('company/candidate/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="13" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
        unset($result);
    }

    public function ajax_listing_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['data_array'] = $this->candidate_model->listData($per_page_record, $page_number);
        // print_r($result['data_array']);die();
        if (empty($result['data_array']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['data_array'][0]->rowcount;

        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('company/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('company/candidate/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="13" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
        unset($result);
    }

    public function details($ID = 0){

        $this->CandidateID = $ID;
        $data = array();
        $_POST['CandidateID'] = $data['ID'] = $ID;
        $data['config'] = $this->config_model->getConfig();
        $data['view_modal_popup'] = $this->load->view('company/includes/view_modal_popup', NULL, TRUE);
        $data['details'] = $this->candidate_model->getCandidateByID($ID);
        if(!@$data['details']->CandidateID){
            show_404();
        }
        $data['page_level_js'] = $this->load->view('company/candidate/details_js', $data, TRUE);
        $this->load->view('company/includes/header');
        $this->load->view('company/candidate/details',$data);
        $this->load->view('company/includes/footer',$data);
        unset($data);
    }

    public function ajax_skill($per_page_record=10,$page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['skill'] = $this->candidate_model->listSkill($per_page_record,$page_number);
        if(isset($result['skill'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['skill'][0]->rowcount;
        
        $pagination = $this->load->view('company/includes/ajax_list_pagination',$result,TRUE);
        $result['UserID'] = $this->input->post('UserID');
        $ajax_listing = $this->load->view('company/candidate/ajax_listing_skill', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="9" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_employment($per_page_record=10,$page_number = 1){
        $result = array();

        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['employment'] = $this->candidate_model->listEmployment($per_page_record,$page_number);

        if(isset($result['employment'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['employment'][0]->rowcount;

        $pagination = $this->load->view('company/includes/ajax_list_pagination',$result,TRUE);
        $result['UserID'] = $this->input->post('UserID');
        $ajax_listing = $this->load->view('company/candidate/ajax_listing_employment', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="9" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_project($per_page_record=10,$page_number = 1){
        $result = array();

        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['project'] = $this->candidate_model->listProject($per_page_record,$page_number);
        if(isset($result['project'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['project'][0]->rowcount;
        
        $pagination = $this->load->view('company/includes/ajax_list_pagination',$result,TRUE);
        $result['UserID'] = $this->input->post('UserID');
        $ajax_listing = $this->load->view('company/candidate/ajax_listing_project', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="12" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_certificate($per_page_record=10,$page_number = 1){
        $result = array();

        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['certificate'] = $this->candidate_model->listCertificate($per_page_record,$page_number);
        if(isset($result['certificate'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['certificate'][0]->rowcount;
        
        $pagination = $this->load->view('company/includes/ajax_list_pagination',$result,TRUE);
        $result['UserID'] = $this->input->post('UserID');
        $ajax_listing = $this->load->view('company/candidate/ajax_listing_certificate', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="3" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_language($per_page_record=10,$page_number = 1){
        $result = array();

        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['language'] = $this->candidate_model->listLanguage($per_page_record,$page_number);
        if(isset($result['language'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['language'][0]->rowcount;
        
        $pagination = $this->load->view('company/includes/ajax_list_pagination',$result,TRUE);
        $result['UserID'] = $this->input->post('UserID');
        $ajax_listing = $this->load->view('company/candidate/ajax_listing_language', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="6" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function ajax_qualification($per_page_record=10,$page_number = 1){
        $result = array();

        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['qualification'] = $this->candidate_model->listQualification($per_page_record,$page_number);
        if(isset($result['qualification'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['qualification'][0]->rowcount;
        
        $pagination = $this->load->view('company/includes/ajax_list_pagination',$result,TRUE);
        $result['UserID'] = $this->input->post('UserID');
        $ajax_listing = $this->load->view('company/candidate/ajax_listing_education', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function export_to_excel() {
        if($this->cur_module->is_export == 0)
                        show_404();
        //load our new PHPExcel library
        $array = array();
        $fields = array("SrNo", "FirstName","LastName","EmailID","Address","CityName","Pincode","PermenantAddress", "Experience", "Salary", "DOB", "Gender" ,"IsPhysicalChallenged" ,"IsPhysicalChallenged", "IsExperience"); //Header Define

        $this->load->library('excel');
        $array['data'] = $this->candidate_model->listData(-1, 1);
        $array['result'] = array();
        if (!empty($array['data'])) {
            $array['result'] = $array['data'];
        }
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
        if (!empty($array['data'])) {
            foreach ($array['result'] as $rr => $data) {

                $col = 0;
                foreach ($fields as $field) {

                    if ($field == 'SrNo')
                        $data->$field = $SerialNo;
                    if ($field == 'DOB' && $data->$field!='')
                       //$data->$field = GetDateInFormat(date($data->$field,strtotime($data->$field)),'Y-m-d',DATE_FORMAT);
                        $data->$field = GetDateInFormat($data->$field);
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    $col++;
                }
                $row++;
                $SerialNo++;
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $filename = 'Candidate.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
