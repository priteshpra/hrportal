<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function insertRoles($array) {
        $array['Name'] = getStringClean(isset($array['Name']) ? $array['Name'] : NULL);
        $array['Description'] = getStringClean(isset($array['Description']) ? $array['Description'] : NULL);
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        $array['created_by'] = $this->session->userdata['UserID'];
        $sql = "CALL usp_A_AddRoles('" . 
            $array['Name'] . "','" . 
            $array['Description'] . "','" . 
            $array['created_by'] . "','".
            $array['usertype']."','".
            $array['IPAddress']."')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        $result = $query->row();
        $roleid = $result->ID;
        $parent_modules = $this->getParentModules();
        $array['query'] = "";
        foreach ($parent_modules as $parent) {
            $sub_modules = $this->getSubModules($parent->ModuleID);
            
            if ($this->input->post("master_" . $parent->ModuleID)) {
                $child_q = "";
                $cnt = $this->input->post("cnt_" . $parent->ModuleID);
                $flag = 0;
                foreach ($sub_modules as $child) {
                    $insert = $edit = $status = $export = 0;
                    $view = 1;
                    //echo $child->ModuleID;exit;
                    if ($this->input->post("m_" . $child->ModuleID)) {
                       if ($this->input->post("insert" . $child->ModuleID)) {
                            $insert = 1;
                        }
                        if ($this->input->post("edit" . $child->ModuleID)) {
                            $edit = 1;
                        }
                        if ($this->input->post("status" . $child->ModuleID)) {
                            $status = 1;
                        }
                        if ($this->input->post("export" . $child->ModuleID)) {
                            $export = 1;
                        }
                        if ($edit == 1 && $status == 1 && $export == 1) {
                            $flag++;
                        }
                        $child_q .= "($roleid,$child->ModuleID,$view,$insert,$edit,$status,$export," . $array['created_by'] . "),";
                    }
                }
                if ($child_q != "") {
                    if ($flag == $cnt) {
                        $flag = 1;
                    } else {
                        $flag = 0;
                    }
                    $child_q = "($roleid,$parent->ModuleID,1,$flag,0,0,0," . $array['created_by'] . ")," . $child_q;
                }
                $array['query'] .= $child_q;
            }
        }
        $usertype = $this->session->userdata['UserType'] . ' Web';
        $IPAddress = GetIP();
        $array['query'] = trim($array['query'], ',');
        $sql = "CALL usp_A_AddRoleMapping('" . $array['query'] . "', " . $array['created_by'] . ",'".$usertype."','".$IPAddress."',$roleid)";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function EditRoles($array) {
        $array['Name'] = getStringClean(isset($array['Name']) ? $array['Name'] : NULL);
        $array['Description'] = getStringClean(isset($array['Description']) ? $array['Description'] : NULL);
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $usertype = $this->session->userdata['UserType'] . ' Web';
        $IPAddress = GetIP();
        $sql = "CALL usp_A_EditRoles('" . $array['Name'] . "','" . $array['Description'] . "','" . $array['ModifiedBy'] . "','1'," . $array['ID'] . ",'".$usertype."','".$IPAddress."');";
        $query = $this->db->query($sql);
        $query->next_result();
        $result = $query->row();
        
        $roleid = $result->ID;
        $parent_modules = $this->getParentModules();
        $array['query'] = "";
        foreach ($parent_modules as $parent) {
            $sub_modules = $this->getSubModules($parent->ModuleID);
            if ($this->input->post("master_" . $parent->ModuleID)) {
                $child_q = "";
                $cnt = $this->input->post("cnt_" . $parent->ModuleID);
                $flag = 0;
                foreach ($sub_modules as $child) {
                    $insert = $edit = $status = $export = 0;
                    $view = 1;
                    if ($this->input->post("m_" . $child->ModuleID)) {
                        if ($this->input->post("insert" . $child->ModuleID)) {
                            $insert = 1;
                        }
                        if ($this->input->post("edit" . $child->ModuleID)) {
                            $edit = 1;
                        }
                        if ($this->input->post("status" . $child->ModuleID)) {
                            $status = 1;
                        }
                        if ($this->input->post("export" . $child->ModuleID)) {
                            $export = 1;
                        }
                        if ($edit == 1 && $status == 1 && $export == 1) {
                            $flag++;
                        }
                        $child_q .= "($roleid,$child->ModuleID,$view,$insert,$edit,$status,$export," . $array['ModifiedBy'] . "),";
                    }
                }
                if ($child_q != "") {
                    if ($flag == $cnt) {
                        $flag = 1;
                    } else {
                        $flag = 0;
                    }
                    $child_q = "($roleid,$parent->ModuleID,1,$flag,0,0,0," . $array['ModifiedBy'] . ")," . $child_q;
                }
                $array['query'] .= $child_q;
            }
        }
        $usertype = $this->session->userdata['UserType'] . ' Web';
        $IPAddress = GetIP();
        $array['query'] = trim($array['query'], ',');
        $query = $this->db->query("CALL usp_A_AddRoleMapping('" . $array['query'] . "', " . $array['ModifiedBy'] . ",'".$usertype."','".$IPAddress."',". $array['ID'] . ")");
        $query->next_result();
        return $query->row();
    }

    function listRole($per_page_record = Null, $page_number = Null) {
        if ($per_page_record == Null) {
            $per_page_record = 10;
        }
        if ($page_number == Null) {
            $page_number = 1;
        }
        $RoleName = getStringClean(($this->input->post('RoleName') != '') ? $this->input->post('RoleName') : '');
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
        $sql = "call usp_A_GetRoles( '$per_page_record' , '$page_number','$RoleName','$status_search_value' )";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function listRoleMapping($per_page_record = 10, $page_number = 1,$rolename = -1) {
        $RoleID = ($rolename != '') ? $rolename : -1;
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
       $sql = "call usp_A_GetRoleListing( '$per_page_record' , '$page_number','$RoleID','$status_search_value' )";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getParentModules($id = -1) {
        $sql = "call usp_A_GetParentModules('$id')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function getSubModules($parent_id = Null) {
        $sql = "call usp_A_GetSubModules('" . $parent_id . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function getChildModules($id = -1) {
        $sql = "call usp_A_GetChildModules('$id')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function changeStatus($array) {
        $array['id'] = getStringClean((isset($array['id'])) ? $array['id'] : NULL);
        $array['status'] = getStringClean((isset($array['status'])) ? $array['status'] : NULL);

        $array['table_name'] = "ssmd_roles";
        $array['field_name'] = "RoleID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }

    public function getRoleByID($id = null) {
        $result['parent_modules'] = $this->getParentModules($id);
        $result['sub_modules'] = $this->getChildModules($id);
        $query = $this->db->query("CALL usp_A_GetRolesByID($id)");
        $query->next_result();
        $result['role'] = $query->row();
        return $result;
    }

    public function getCustomerByRoleID($id = null) {
       $result['parent_modules'] = $this->getParentModules($id);
        $result['sub_modules'] = $this->getChildModules($id);
        $query = $this->db->query("CALL usp_A_GetCustomerByRoleID($id)");
        $query->next_result();
        $result['roledata'] = $query->row();
        return $result;
    }

    public function getRoleComboBox() {
        $query = $this->db->query("call usp_A_GetRole_ComboBox()");
        $query->next_result();
        return $query->result();
    }

}
