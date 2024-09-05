<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employeeinouttime_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
 
	   /*$In_time=getStringClean(($this->input->post('In_time')!='')?$this->input->post('In_time'):'');

       $Out_time=getStringClean(($this->input->post('Out_time')!='')?$this->input->post('Out_time'):'');

       $InOutDate=getStringClean(($this->input->post('InOutDate')!='')?$this->input->post('InOutDate'):'0000-00-00');*/

        $EmployeeID=getStringClean(($this->input->post('EmployeeID')!='')?$this->input->post('EmployeeID'):-1);

        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetEmployeeinouttime( '$per_page_record' , '$page_number','$EmployeeID','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_country','EmployeeinouttimeID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        $array['In_time']     = (isset($array['In_time']))    ? $array['In_time']  : NULL;
        $array['Out_time']     = (isset($array['Out_time']))    ? $array['Out_time']  : NULL;
        $array['EmployeeID']        = (isset($array['EmployeeID']))           ? $array['EmployeeID']     : 0;
        $array['InOutDate']   =   (isset($array['InOutDate']))?date('Y-m-d', strtotime($array['InOutDate'])):'0000-00-00';
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddEmployeeinouttime('".
            $array['EmployeeID'] . "','" .
            $array['In_time'] . "','" .  
            $array['Out_time'] . "','" . 
            $array['InOutDate']  . "','" . 
            $array['created_by']."','".
            $array['Status']."','".
            $array['usertype']."','".
            $array['IPAddress']."')";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($array)
    {//print_r($array);exit();
        $array['In_time']     = (isset($array['In_time']))    ? $array['In_time']  : NULL;
        $array['Out_time']     = (isset($array['Out_time']))    ? $array['Out_time']  : NULL;
        $array['EmployeeID']        = (isset($array['EmployeeID']))   ? $array['EmployeeID']     : 0;
        $array['InOutDate']   =   (isset($array['InOutDate']))?date('Y-m-d', strtotime($array['InOutDate'])):'0000-00-00';
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $query = $this->db->query("call usp_A_EditEmployeeinouttime('".
            $array['EmployeeID'] . "','" .
            $array['In_time'] . "','" .  
            $array['Out_time'] . "','" . 
            $array['InOutDate']  . "','" . 
            $array['modified_by']."','".
            $array['Status']."','".
            $array['ID']."','".
            $array['usertype']."','".
            $array['IPAddress']."')");
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:NULL;                
        $array['status']        =   (isset($array['status']))?$array['status']:NULL;
        
        $array['table_name'] = "ssc_employeeinouttime";
        $array['field_name'] = "EmployeeInOutID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }
	
	public function getEmployeeinouttimeByID($ID = null) {
        $query = $this->db->query("call usp_A_GetEmployeeinouttimeByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}