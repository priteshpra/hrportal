<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Video_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
		$VideoTitle=getStringClean(($this->input->post('VideoTitle')!='')?$this->input->post('VideoTitle'):'');
        $UserID=($this->input->post('UserID') != '')?$this->input->post('UserID'):-1;
		$status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetVideo( '$per_page_record' , '$page_number','$VideoTitle','$UserID','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
    
    // Start : to list all contries 
    public function listExcelData($per_page_record = 10, $page_number = 1,$MentorUserrID=-1) 
    {        
        $VideoTitle='';
        $status_search_value=-1;
        
        $sql = "call usp_A_GetVideo( '$per_page_record' , '$page_number','$VideoTitle','$MentorUserrID','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_video','VideoID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {  
        $array['VideoTitle']   =  getStringClean((isset($array['VideoTitle']))?$array['VideoTitle']:NULL);             
		$array['UserID']   =  getStringClean((isset($array['UserID']))?$array['UserID']:NULL);
        $array['image']   =  getStringClean((isset($array['image']))?$array['image']:NULL);
        $array['videourl']   =  getStringClean((isset($array['videourl']))?$array['videourl']:NULL);
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['Flag']        =   (isset($array['Flag']) && $array['Flag'] == 'on')?INACTIVE:ACTIVE;
        $array['Price']   =  (isset($array['Price']))?$array['Price']:0;
        if($array['Flag'] == 0){
            $array['Price'] = 0;
        }
        $array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        $array['Duration']   =  (isset($array['Duration']))?$array['Duration']:0;
        $array['Size']   =  (isset($array['Size']))?$array['Size']:0;
        $array['Description']   =  getStringClean((isset($array['Description']))?$array['Description']:NULL);

		
        $sql = "call usp_A_AddVideo('".
            $array['VideoTitle']."','".
            $array['videourl']."','".
            $array['image']."','".
            $array['UserID']."','".
            $array['Flag']."','".
            $array['Duration']."','".
            $array['Description']."','".
            $array['Price']."','".
            $array['Size']."','".
            $array['created_by']."','".
            $array['Status']."','".
            $array['usertype']."','".
            $array['IPAddress'].
            "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($array){
        $array['VideoTitle']   =  getStringClean((isset($array['VideoTitle']))?$array['VideoTitle']:NULL);             
        $array['UserID']   =  getStringClean((isset($array['UserID']))?$array['UserID']:NULL);
        $array['image']   =  getStringClean((isset($array['image']))?$array['image']:NULL);
        $array['videourl']   =  getStringClean((isset($array['videourl']))?$array['videourl']:NULL);
        $array['Description']   =  getStringClean((isset($array['Description']))?$array['Description']:NULL);
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['Flag']        =   (isset($array['Flag']) && $array['Flag'] == 'on')?INACTIVE:ACTIVE;
        $array['Price']   =  (isset($array['Price']))?$array['Price']:0;
        if($array['Flag'] == 0){
            $array['Price'] = 0;
        }
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
        $array['Duration']   =  (isset($array['Duration']))?$array['Duration']:0;
        $array['Size']   =  (isset($array['Size']))?$array['Size']:0;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
        $sql = "call usp_A_EditVideo('" .
                $array['VideoTitle']."','".
                $array['videourl']."','".
                $array['image']."','".
                $array['UserID']."','".
                $array['Flag']."','".
                $array['Duration']."','".
                $array['Description']."','".
                $array['Price']."','".
                $array['Size']."','".
                $array['modified_by']."','".
                $array['Status']."','".
                $array['ID']."','".
                $array['usertype']."','".
                $array['IPAddress'].
                "')";
        $query = $this->db->query($sql);
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ssc_video";
        $array['field_name'] = "VideoID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }
	public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];                
        $array['VideoTitle']       =  $array['VideoTitle'];     
        $array['table_name'] = "ssc_video";
        $array['field_name'] = "VideoID";
        $sql = "call usp_A_CheckDuplicate('".$array['table_name']."','VideoTitle','".$array['VideoTitle']."','VideoID','".$array['id']."')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
	public function getByID($ID = null) {
        $query = $this->db->query("call usp_A_GetVideoByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}