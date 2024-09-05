<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Uom_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listData($per_page_record = 10, $page_number = 1) {
        
        $UOM = getStringClean(($this->input->post('UOM') != '') ? $this->input->post('UOM') : '');
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
        $sql = "call usp_A_GetUom( '$per_page_record' , '$page_number','$UOM','$status_search_value' )";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getRecordCount() {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_uom','UOMID')");
        $query->next_result();
        return $query->result();
    }

    function insert($array) {
        $array['UOM'] = getStringClean((isset($array['UOM'])) ? $array['UOM'] : NULL);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
       $sql = "call usp_A_AddUom('" .
                $array['UOM'] . "','" .
                $array['created_by'] . "','" .
                $array['Status'] . "','".
                $array['usertype'] ."','". 
                $array['IPAddress']."');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getUomByID($ID = null) {
        $query = $this->db->query("call usp_A_GetUomByID('$ID')");
        $query->next_result();
        return $query->row();
    }

    public function update($array) {
        $array['UOM'] = getStringClean((isset($array['UOM'])) ? $array['UOM'] : NULL);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        
        $query = $this->db->query("call usp_A_EditUom('" .
                $array['UOM'] . "','" .
                $array['modified_by'] . "','" .
                $array['Status'] . "','" .
                $array['ID'] . "','".
                $array['usertype'] ."','". 
                $array['IPAddress']."');");
        $query->next_result();
        return $query->row();
    }
    public function changeStatus($array){
        $array['id']            =   getStringClean((isset($array['id']))?$array['id']:NULL);                
        $array['status']        =   getStringClean((isset($array['status']))?$array['status']:NULL);
        
        $array['table_name'] = "ssc_uom";
        $array['field_name'] = "UOMID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
        //return $this->db->query("select @a AS xyz")->result();        
    }   
}
