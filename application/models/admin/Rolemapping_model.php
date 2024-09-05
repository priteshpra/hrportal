<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rolemapping_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function insertRoles($array) {
       //print_r($array);die();
        $array['UserID'] = isset($array['UserID']) ? $array['UserID'] : NULL;
        $array['RoleID'] = isset($array['RoleID']) ? $array['RoleID'] : NULL;
        $array['created_by'] = $this->session->userdata['UserID'];
        $usertype = $this->session->userdata['UserType'] . ' Web';
        $IPAddress = GetIP();
        $sql = "CALL usp_A_AddRoletoAdmin('".$array['UserID']."','" . $array['RoleID'] . "','" . $array['created_by'] . "','".$usertype."','".$IPAddress. "');";
        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function listRoleMapping($per_page_record = 10, $page_number = 1) {
        
        $Name = getStringClean(($this->input->post('Name') != '') ? $this->input->post('Name') : '');
        $RoleName = getStringClean(($this->input->post('RoleName') != '') ? $this->input->post('RoleName') : '');
        $sql = "call usp_A_GetEmployeeRoles($per_page_record,$page_number,'$Name','$RoleName')";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getRoleMappingByID($id = null) {
        $query = $this->db->query("CALL usp_A_GetRoleMappingByID($id)");
        $query->next_result();
        return $query->row();
    }
    function getUser() {
        $query = $this->db->query("call usp_A_GetUser_ComboBox()");
        $query->next_result();
        return $query->result();
    }

}
