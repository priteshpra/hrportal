<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Currency_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
		$currency=getStringClean(($this->input->post('CurrencyName')!='')?$this->input->post('CurrencyName'):'');
		//$currencyhtml=getStringClean(($this->input->post('CurrencyHtmlCode')!='')?$this->input->post('CurrencyHtmlCode'):'');
        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetCurrency( '$per_page_record' , '$page_number','$currency','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_currency','CurrencyID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        $array['CurrencyName']   =   (isset($array['CurrencyName']))?$array['CurrencyName']:NULL;             
		$array['CurrencyHtmlCode']   =   (isset($array['CurrencyHtmlCode']))?$array['CurrencyHtmlCode']:NULL;             
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddCurrency('".
            $array['CurrencyName']."','".
            $array['CurrencyHtmlCode']."','".
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
        $array['CurrencyName']   =   (isset($array['CurrencyName']))?$array['CurrencyName']:NULL;             
		$array['CurrencyHtmlCode']   =   (isset($array['CurrencyHtmlCode']))?$array['CurrencyHtmlCode']:NULL;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:0;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $query = $this->db->query("call usp_A_EditCurrency('".
            $array['CurrencyName']."','".
            $array['CurrencyHtmlCode']."','".
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
        
        $array['table_name'] = "ssc_currency";
        $array['field_name'] = "CurrencyID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".
            $array['table_name']."','".
            $array['field_name']."','".
            $array['id']."','".
            $array['status']."','".
            $array['modified_by']."');");        
               
    }
	
	public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];                
        $array['CurrencyName']       =  $array['CurrencyName'];
        
		$array['table_name'] = "ssc_currency";
        $array['field_name'] = "CurrencyID";
		$sql = "call usp_A_CheckDuplicate('".$array['table_name']."','CurrencyName','".$array['CurrencyName']."','CurrencyID','".$array['id']."')"; 
		
		/*if(empty($id)){
			$sql = "Select * from ssse_state where StateName='$StateName'";
		}
		else{
			$sql = "Select * from ssse_state where StateName='$StateName' AND StateID!=$id";
		}*/
		$query = $this->db->query($sql);
		$query->next_result();
		return $query->row();
	}
	
	public function getCurrencyByID($ID = null) {
        $query = $this->db->query("call usp_A_GetCurrencyByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}