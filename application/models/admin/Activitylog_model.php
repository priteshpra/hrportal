<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activitylog_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) {
        
		$ActivitylogName = getStringClean(($this->input->post('ActivitylogName') != '') ? $this->input->post('ActivitylogName') : '');
        $ActivityDate = ($this->input->post('ActivityDate') != '')?GetDateInFormat($this->input->post('ActivityDate'),'d/m/Y',DATABASE_DATE_FORMAT):DEFAULT_DATE;
        
       $sql = "call usp_A_GetActivityLog( '$per_page_record' , '$page_number','$ActivitylogName' ,'$ActivityDate')";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getRecordCount() {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_activitylog','ActivityLogID')");
        $query->next_result();
        return $query->result();
    }

    function changeStatus($array) {
        $array['id'] = (getStringClean(isset($array['id'])) ? $array['id'] : NULL);
        $array['status'] = (getStringClean(isset($array['status'])) ? $array['status'] : NULL);

        $array['table_name'] = "ssc_activitylog";
        $array['field_name'] = "ActivityLogID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call cf_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }

}
