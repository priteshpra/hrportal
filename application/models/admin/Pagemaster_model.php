<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pagemaster_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listData($per_page_record = 10, $page_number = 1) {
        $PageName = getStringClean(($this->input->post('PageName') != '') ? $this->input->post('PageName') : '');
		$status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
        $sql = "call usp_A_GetPagemaster( '$per_page_record' , '$page_number','$PageName','$status_search_value' )";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getRecordCount() {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_pagemaster','PageID')");
        $query->next_result();
        return $query->result();
    }

    function insert($array) {
        $aray['PageName'] = getStringClean((isset($array['PageName'])) ? $array['PageName'] : NULL);
		$array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		$sql = "call usp_A_AddPagemaster('" .
                $array['PageName'] . "','" .
				$array['created_by'] . "','" .
                $array['Status'] . "','".
				$array['usertype']."','".
				$array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getDataByID($ID = null) {
        $query = $this->db->query("call usp_A_GetPagemasterByID('$ID')");
        $query->next_result();
        return $query->row();
    }

    public function update($array) {
        $aray['PageName'] = getStringClean((isset($array['PageName'])) ? $array['PageName'] : NULL);
		$array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		$query = $this->db->query("call usp_A_EditPagemaster('" .
                $array['PageName'] . "','" .
				$array['modified_by'] . "','" .
                $array['Status'] . "','" .
                $array['ID'] . "','".
				$array['usertype']."','".
				$array['IPAddress']."')");
        $query->next_result();
        return $query->row();
    }
    public function changeStatus($array){
        $array['id']            =   getStringClean((isset($array['id']))?$array['id']:NULL);                
        $array['status']        =   getStringClean((isset($array['status']))?$array['status']:NULL);   
        $array['table_name'] = "ssc_pagemaster";
        $array['field_name'] = "PageID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
        //return $this->db->query("select @a AS xyz")->result();        
    } 
	public function getPageMasterByID($ID = null) {
        $query = $this->db->query("call usp_A_GetPageMasterByID('$ID')");
        $query->next_result();
        return $query->row();
    }	
}
