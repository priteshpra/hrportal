<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emailtemplate_model extends CI_Model {
    function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    // Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
        $EmailTemplateTitle=getStringClean(($this->input->post('EmailTemplateTitle')!='')?$this->input->post('EmailTemplateTitle'):'');
        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetEmailTemplate( '$per_page_record' , '$page_number','$EmailTemplateTitle','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
    
    public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_emailtemplate','EmailTemplateID')");
        $query->next_result();
        return $query->result();
    }
    
    public function insert($array)
    {    
        $array['EmailTemplateTitle']   =   (isset($array['EmailTemplateTitle']))?$array['EmailTemplateTitle']:NULL; 
        $array['EmailSubject']   =   (isset($array['EmailSubject']))?$array['EmailSubject']:NULL;             
        $array['Content']   =  getStringClean((isset($array['Content']))?$array['Content']:NULL);             
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
            
        $sql = "call usp_A_AddEmailTemplate('".
            $array['EmailTemplateTitle']."','".
            $array['EmailSubject']."','".
            $array['Content']."','".
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
        $array['EmailTemplateTitle']   =   (isset($array['EmailTemplateTitle']))?$array['EmailTemplateTitle']:NULL; 
        $array['EmailSubject']   =   (isset($array['EmailSubject']))?$array['EmailSubject']:NULL;             
        $array['Content']   =   getStringClean((isset($array['Content']))?$array['Content']:NULL);
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
        $array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        
        
        $query = $this->db->query("call usp_A_EditEmailTemplate('".$array['EmailTemplateTitle']."','".
            $array['EmailSubject']."','".
            $array['Content']."','".
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
        
        $array['table_name'] = "ssc_emailtemplate";
        $array['field_name'] = "EmailTemplateID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".
            $array['table_name']."','".
            $array['field_name']."','".
            $array['id']."','".
            $array['status']."','".
            $array['modified_by']."');");        
               
    }
    
    public function getEmailTemplateByID($ID = null) {
        $query = $this->db->query("call usp_A_GetEmailTemplateByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}