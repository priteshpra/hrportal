<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Video extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",23)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
        $this->load->model('admin/video_model');
        $this->load->model('admin/config_model');
    }

    public function index() {
		$res = $data = array();
		$this->load->view('admin/includes/header');
		$res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $res['user'] = getUserCombobox(0,'Mentor',label('msg_lbl_select_mentor'));
		$this->load->view('admin/masters/video/list', $res);
		$data['page_level_js'] = $this->load->view('admin/masters/video/list_js', NULL, TRUE);
		$data['footer']['add_link'] = $this->config->item('base_url') . 'admin/masters/video/add';
		$data['footer']['listing_page'] = 'yes';
		$this->load->view('admin/includes/footer', $data);
		unset($res, $data);
		
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['video'] = $this->video_model->listData($per_page_record, $page_number);
        if (empty($result['video']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['video'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/video/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="7" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
    }

    public function add($MentorUserrID = 0) {
        try {
            if(@$this->cur_module->is_insert == 0)
                        show_404();
            $data = $array = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('VideoTitle', 'VideoTitle', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $config1 = array("max_width" => VIDEOURL_MAX_WIDTH,
                        "max_height" => VIDEOURL_MAX_HEIGHT,
                        'max_size' => VIDEOURL_MAX_SIZE,
                        'path' => VIDEOURL_UPLOAD_PATH,
                        'allowed_types' => VIDEOURL_ALLOWED_TYPES,
                        'tpath' => VIDEOURL_THUMB_UPLOAD_PATH,
                        'twidth' => VIDEOURL_THUMB_MAX_WIDTH,
                        'theight' => VIDEOURL_THUMB_MAX_HEIGHT
                    );
                    $T_new = date("YmdHis");
                    $data['videourl'] = FileUploadURL("userfile1", "editVideoURL", $config1, $T_new, '');
                    $data['image'] = $T_new . ".jpg";
                    $VideoURL = str_replace('/system','',BASEPATH) . VIDEOURL_UPLOAD_PATH . $data['videourl'];
                    $thumbnail = str_replace('/system','',BASEPATH) . VIDEOURL_THUMB_UPLOAD_PATH. $data['image'];
                    if(!file_exists(str_replace('/system','',BASEPATH) . VIDEOURL_UPLOAD_PATH . $data['videourl'])){
                        $VideoURL = str_replace(array('\\','/system'),array('/',''),BASEPATH) . VIDEOURL_UPLOAD_PATH . $data['videourl'];
                        $thumbnail = str_replace(array('\\','/system'),array('/',''),BASEPATH) . VIDEOURL_THUMB_UPLOAD_PATH. $data['image'];
                    }
                    
                    shell_exec("ffmpeg -i $VideoURL -deinterlace -an -ss 1 -t 00:00:05 -r 1 -y -vcodec mjpeg -f mjpeg $thumbnail 2>&1");
                    $res = exec("ffprobe -i $VideoURL -show_entries format=duration -v quiet -of csv='p=0'");
                    $data['Duration'] =  intval($res);
                    $data['Size'] = number_format($_FILES['userfile1']['size']/1000000,2);
                    $res = $this->video_model->insert($data);
                    //print_r($res);die();
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/mentor/details/'.$MentorUserrID.'#video_listing_page');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/video/add/'.$MentorUserrID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/video/add/'.$MentorUserrID);
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'add/'.$MentorUserrID;
            $data['MentorUserrID'] = $MentorUserrID;
            $data['loading_button'] = getLoadingButton();
            $data['config'] = $this->config_model->getConfig();
			$data['user'] = getUserCombobox($MentorUserrID,'Mentor',label('msg_lbl_select_mentor'));	
            $this->load->view('admin/masters/video/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/video/add_edit_js', NULL, TRUE);
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

    public function edit($ID = NULL,$MentorUserrID = 0) {
       
        try {
            if(@$this->cur_module->is_edit == 0)
                        show_404();
            $data = $res = array();

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('VideoTitle', 'VideoTitle', 'trim|required');
				
                if ($this->form_validation->run() ==     TRUE) {
                     $url = site_url("admin/masters/video/edit/".$ID);
                     $config1 = array("max_width" => VIDEOURL_MAX_WIDTH,
                        "max_height" => VIDEOURL_MAX_HEIGHT,
                        'max_size' => VIDEOURL_MAX_SIZE,
                        'path' => VIDEOURL_UPLOAD_PATH,
                        'allowed_types' => VIDEOURL_ALLOWED_TYPES,
                        'tpath' => VIDEOURL_THUMB_UPLOAD_PATH,
                        'twidth' => VIDEOURL_THUMB_MAX_WIDTH,
                        'theight' => VIDEOURL_THUMB_MAX_HEIGHT
                    );
                    $T_new = date("YmdHis");
                    $data = $this->input->post();
                    $data['videourl'] = FileUploadURL("userfile1", "editVideoURL", $config1, $T_new, '');
                    $data['image'] = $T_new . ".jpg";
                    $VideoURL = str_replace('/system','',BASEPATH) . VIDEOURL_UPLOAD_PATH . $data['videourl'];
                    $thumbnail = str_replace('/system','',BASEPATH) . VIDEOURL_THUMB_UPLOAD_PATH. $data['image'];
                    if(!file_exists(str_replace('/system','',BASEPATH) . VIDEOURL_UPLOAD_PATH . $data['videourl'])){
                        $VideoURL = str_replace(array('\\','/system'),array('/',''),BASEPATH) . VIDEOURL_UPLOAD_PATH . $data['videourl'];
                        $thumbnail = str_replace(array('\\','/system'),array('/',''),BASEPATH) . VIDEOURL_THUMB_UPLOAD_PATH. $data['image'];
                    }
                    
                    shell_exec("ffmpeg -i $VideoURL -deinterlace -an -ss 1 -t 00:00:05 -r 1 -y -vcodec mjpeg -f mjpeg $thumbnail 2>&1");
                    $res = exec("ffprobe -i $VideoURL -show_entries format=duration -v quiet -of csv='p=0'");
                    $data['Duration'] =  intval($res);
                    $data['Size'] = number_format($_FILES['userfile1']['size']/1000000,2);
                    $data['ID'] = $ID;
                    $res = $this->video_model->update($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/mentor/details/'.$MentorUserrID.'#video_listing_page');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
						
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/video/edit/' . $ID.'/'.$MentorUserrID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/video/edit/' . $ID.'/'.$MentorUserrID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'edit/' . $ID.'/'.$MentorUserrID;
            $data['video'] = $this->video_model->getByID($ID);
            if(empty($data['video'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/masters/mentor/details/'.$MentorUserrID.'#video_listing_page');
            }
            $data['loading_button'] = getLoadingButton();
            //$data['user'] = getUserCombobox(@$data['video']->UserID,'Mentor',label('msg_lbl_select_mentor'));  
            $data['user'] = getUserCombobox($MentorUserrID,'Mentor',label('msg_lbl_select_mentor')); 
            $this->load->view('admin/masters/video/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/video/add_edit_js', NULL, TRUE);
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
                $res = $this->video_model->changeStatus($this->input->post());
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

    public function export_to_excel($MentorUserrID = 0) {
        
        if($this->cur_module->is_export == 0)
                        show_404();
        //load our new PHPExcel library
        $this->load->library('excel');
        $res['video'] = $this->video_model->listExcelData(-1, 1,$MentorUserrID);

        $dataResult['result'] = array();
        if (!empty($res['video'])) {
            $dataResult['result'] = $res['video'];
        }
        $fields = array("SrNo","VideoTitle","VideoURL","Duration","Price","Size","Description"); 
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
        if (!empty($res['video'])) {
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
        $filename = 'Video.xls'; 
        //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); 
        //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); 
        //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
        //readfile("video.xls");
}
}
