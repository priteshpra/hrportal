<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) 
    {
        $MessageKey=($this->input->post('MessageKey')!='')?$this->input->post('MessageKey'):''; 
        $Message=($this->input->post('Message')!='')?$this->input->post('Message'):''; 
        $LanguageID=($this->input->post('LanguageID') != '')?$this->input->post('LanguageID'):-1;
        
        $sql = "call usp_A_GetMessage('$per_page_record' , '$page_number','$MessageKey','$Message','$LanguageID')";
        $query = $this->db->query($sql);
        return $query->result();

    }
  

    public function getmessageByID($messageID = NULL)
    {
        $query = $this->db->query("call usp_A_GetMessageDetailsByID('$messageID')");
         $query->next_result();
        return $query->row();
    }
    
    public function update($array) 
    {
        $array['LanguageID'] = getStringClean((isset($array['LanguageID'])) ? $array['LanguageID'] : 0);
        $array['MessageKey'] = getStringClean((isset($array['MessageKey'])) ? $array['MessageKey'] : NULL);
        $array['Message'] = getStringClean((isset($array['Message'])) ? $array['Message'] : NULL);
        $array['modified_by'] = $this->session->userdata['UserID'];
          $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

         $query = $this->db->query("call usp_A_EditMessage('" .
            $array['LanguageID'] . "','" . 
            $array['MessageKey'] . "','" . 
            $array['Message'] . "','" .
            $array['modified_by']."','".
            $array['ID'] . "','".
            $array['usertype']."','".
            $array['IPAddress']."')");
            $query->next_result();
            return $query->row();

    }

    public function changeStatus($array)
    {
        $array['id']            =   getStringClean((isset($array['id']))?$array['id']:0);                
        $array['status']        =   getStringClean((isset($array['status']))?$array['status']:0);
        
        $array['table_name'] = "ssc_message";
        $array['field_name'] = "MessageID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
        //return $this->db->query("select @a AS xyz")->result();        
    }   
}

