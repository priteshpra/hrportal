<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Leaverequest_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
        $EmployeeID = getStringClean(($this->input->post('EmployeeID')!='')?$this->input->post('EmployeeID'):'-1');
        $UserID = getStringClean(($this->input->post('UserID')!='')?$this->input->post('UserID'):'-1');
        $LeaveStartDate = getStringClean(($this->input->post('LeaveStartDate')!='')?date('Y-m-d', strtotime($this->input->post('LeaveStartDate'))):'0000-00-00');
        $LeaveEndDate = getStringClean(($this->input->post('LeaveEndDate')!='')?date('Y-m-d', strtotime($this->input->post('LeaveEndDate'))):'0000-00-00');
        $TypeOfLeave = getStringClean(($this->input->post('TypeOfLeave')!='')?$this->input->post('TypeOfLeave'):'');
        $LeaveStatus = getStringClean(($this->input->post('LeaveStatus')!='')?$this->input->post('LeaveStatus'):'');
        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
      
        $sql = "call usp_A_GetLeaverequest( '$per_page_record' , '$page_number','$EmployeeID','$UserID','$LeaveStartDate','$LeaveEndDate','$TypeOfLeave','$LeaveStatus','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_leaverequest','LeaverequestID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {   
        //print_r($array);die();
        $array['LeaveEndDateConcat']   =   (isset($array['LeaveEndDate']))?date('Y-m-d', strtotime($array['LeaveEndDate'])):NULL;
        $array['End_time']     = (isset($array['End_time']))    ? $array['End_time']  : NULL;
        $array['LeaveEndDate'] =    $array['LeaveEndDateConcat'].' '.$array['End_time'];

        $array['EmployeeID']   =   (isset($array['EmployeeID']))?$array['EmployeeID']:0;     
        $array['UserID']   =   (isset($array['UserID']))?$array['UserID']:0;             
        $array['LeaveDays']   =   (isset($array['LeaveDays']))?$array['LeaveDays']:NULL;
        $array['TypeOfLeave']   =   (isset($array['TypeOfLeave']))?$array['TypeOfLeave']:NULL;
        if(isset($array['Leave']) && $array['Leave'] == "HalfDay"){
			$array['LeaveHalfs'] = (isset($array['LeaveHalfs']))?$array['LeaveHalfs']:NULL;
		}
		else{//if(isset($array['Leave']) && $array['Leave'] == "FullDay"){
			$array['LeaveHalfs'] = $array['Leave'];
		}
		$array['LeaveStatus']   =   (isset($array['LeaveStatus']))?$array['LeaveStatus']:NULL;
        $array['LeaveReason']   =   (isset($array['LeaveReason']))?$array['LeaveReason']:NULL;  
        $array['LeaveStartDateConcat']   =   (isset($array['LeaveStartDate']))?date('Y-m-d', strtotime($array['LeaveStartDate'])):NULL;  
        $array['In_time']     = (isset($array['In_time']))    ? $array['In_time']  : NULL; 
        $array['LeaveStartDate'] =    $array['LeaveStartDateConcat'].' '.$array['In_time'];
       

        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
	
     $sql = "call usp_A_AddLeaverequest('".
            $array['EmployeeID']."','".
            $array['UserID']."','".
            $array['LeaveStartDate']."','".
            $array['LeaveEndDate']."','".
            $array['LeaveDays']."','".
            $array['LeaveReason']."','".
            $array['TypeOfLeave']."','".	
            $array['LeaveStatus']."','".
			$array['LeaveHalfs']."','".
            $array['created_by']."','".
            $array['Status']."','".
            $array['usertype']."','".
            $array['IPAddress']."')";  
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($array)
    {
         $array['LeaveEndDateConcat']   =   (isset($array['LeaveEndDate']))?date('Y-m-d', strtotime($array['LeaveEndDate'])):NULL;
        $array['End_time']     = (isset($array['End_time']))    ? $array['End_time']  : NULL;
        $array['LeaveEndDate'] =    $array['LeaveEndDateConcat'].' '.$array['End_time'];
         $array['LeaveStartDateConcat']   =   (isset($array['LeaveStartDate']))?date('Y-m-d', strtotime($array['LeaveStartDate'])):NULL;  
        $array['In_time']     = (isset($array['In_time']))    ? $array['In_time']  : NULL; 
        $array['LeaveStartDate'] =    $array['LeaveStartDateConcat'].' '.$array['In_time'];
        $array['EmployeeID']   =   (isset($array['EmployeeID']))?$array['EmployeeID']:0;     
        $array['UserID']   =   (isset($array['UserID']))?$array['UserID']:0;             
        $array['LeaveDays']   =   (isset($array['LeaveDays']))?$array['LeaveDays']:NULL;
        $array['TypeOfLeave']   =   (isset($array['TypeOfLeave']))?$array['TypeOfLeave']:NULL;
        $array['LeaveStatus']   =   (isset($array['LeaveStatus']))?$array['LeaveStatus']:NULL;
         if(isset($array['Leave']) && $array['Leave'] == "HalfDay"){
			$array['LeaveHalfs'] = (isset($array['LeaveHalfs']))?$array['LeaveHalfs']:NULL;
		}
		else{//if(isset($array['Leave']) && $array['Leave'] == "FullDay"){
			$array['LeaveHalfs'] = $array['Leave'];
		}
		
		$array['LeaveReason']   =   (isset($array['LeaveReason']))?$array['LeaveReason']:NULL;  
       
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $query = $this->db->query("call usp_A_EditLeaverequest('".
            $array['EmployeeID']."','".
            $array['UserID']."','".
            $array['LeaveStartDate']."','".
            $array['LeaveEndDate']."','".
            $array['LeaveDays']."','".
            $array['LeaveReason']."','".
            $array['TypeOfLeave']."','".
            $array['LeaveStatus']."','".
			$array['LeaveHalfs']."','".
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
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ssc_leaverequest";
        $array['field_name'] = "LeaverequestID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".
            $array['table_name']."','".
            $array['field_name']."','".
            $array['id']."','".
            $array['status']."','".
            $array['modified_by']."');");        
               
    }
	
	public function getLeaverequestByID($ID = null) {
        $query = $this->db->query("call usp_A_GetLeaverequestByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}