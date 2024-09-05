<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Motivationalquotes_model extends CI_Model {
	function __construct() 
    {
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1){        
        $sql = "call usp_A_GetMotivationalQuote( '$per_page_record' , '$page_number')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array){    
        $array['Message']   =   getStringClean((isset($array['Message']))?$array['Message']:NULL);
        $array['IsCurrent']        =   (isset($array['IsCurrent']) && $array['IsCurrent'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = 'Admin Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddMotivationalQuote('".
                $array['Message'] . "','" .
                $array['IsCurrent'] . "','" .
                $array['created_by'] ."','". 
                $array['usertype'] ."','". 
                $array['IPAddress']."');";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($array){
        $array['Message']   =   getStringClean((isset($array['Message']))?$array['Message']:NULL);
        $array['IsCurrent']        =   (isset($array['IsCurrent']) && $array['IsCurrent'] == 'on')?ACTIVE:INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();
        
        
        $sql = "call usp_A_EditMotivationalQuote('".
                $array['ID'] . "','" .
                $array['Message'] . "','" .
                $array['IsCurrent'] . "','" .
                $array['created_by'] ."','". 
                $array['usertype'] ."','". 
                $array['IPAddress']."');";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	public function changeStatus($ID,$CStatus){
        $sql = "call usp_A_SetCurrentMotivationalQuote('".
                $ID."','" . $CStatus . "');";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();       
               
    }
	
	public function getByID($ID = null) {
        $query = $this->db->query("call usp_A_GetMotivationalQuoteByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}