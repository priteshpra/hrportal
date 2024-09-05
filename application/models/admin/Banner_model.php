<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
		$BannerTitle=getStringClean(($this->input->post('BannerTitle')!='')?$this->input->post('BannerTitle'):'');
		$SubTitle=getStringClean(($this->input->post('SubTitle')!='')?$this->input->post('SubTitle'):'');
        $Type=($this->input->post('Type') != '' && $this->input->post('Type') != '-1')?$this->input->post('Type'):'';
		$status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetBanner( '$per_page_record' , '$page_number','$BannerTitle','$SubTitle','$Type','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_banner','BannerID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        $array['BannerTitle']   =   getStringClean((isset($array['BannerTitle']))?$array['BannerTitle']:NULL);             
		$array['SubTitle']    = getStringClean((isset($array['SubTitle'])) ? $array['SubTitle'] : NULL);
		$array['Sequence'] = (isset($array['Sequence'])) ? $array['Sequence'] : 0;
        $array['IsCreative'] = (isset($array['IsCreative']) && $array['IsCreative'] == 'on') ? ACTIVE : INACTIVE;
		$array['image'] = getStringClean((isset($array['image'])) ? $array['image'] : NULL);
		$array['mobileimage'] = getStringClean((isset($array['mobileimage'])) ? $array['mobileimage'] : NULL);
		$array['Type']        =   getStringClean((isset($array['Type']))? $array['Type']:NULL);
		$array['RedirectURL'] = getStringClean((isset($array['RedirectURL'])) ? $array['RedirectURL'] : NULL);
		$array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddBanner('".
				$array['BannerTitle']."','".
				$array['SubTitle']."','".
				$array['Sequence']."','".
				$array['IsCreative']."','".
				$array['image']."','".
				$array['mobileimage']."','".
				$array['Type']."','".
				$array['RedirectURL']."','".
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
        //pr($array);exit;
		$array['BannerTitle']   =   getStringClean((isset($array['BannerTitle']))?$array['BannerTitle']:NULL);             
		$array['SubTitle']    = getStringClean((isset($array['SubTitle'])) ? $array['SubTitle'] : NULL);
		$array['Sequence'] = (isset($array['Sequence'])) ? $array['Sequence'] : 0;
        $array['IsCreative'] = (isset($array['IsCreative']) && $array['IsCreative'] == 'on') ? ACTIVE : INACTIVE;
		$array['image'] = getStringClean((isset($array['image'])) ? $array['image'] : NULL);
		$array['mobileimage'] = getStringClean((isset($array['mobileimage'])) ? $array['mobileimage'] : NULL);
		$array['Type']        =   getStringClean((isset($array['Type']))? $array['Type']:NULL);
		$array['RedirectURL'] = getStringClean((isset($array['RedirectURL'])) ? $array['RedirectURL'] : NULL);
		$array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_EditBanner('".
		$array['BannerTitle']."','".$array['SubTitle']."','".$array['Sequence']."','".$array['IsCreative']."','".$array['image']."','".$array['mobileimage']."','".$array['Type']."','".$array['RedirectURL']."','".$array['modified_by']."','".$array['Status']."','".$array['ID']."','".$array['usertype']."','".$array['IPAddress']."')";
		$query = $this->db->query($sql);
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ssc_banner";
        $array['field_name'] = "BannerID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }
	
	public function getBannerByID($ID = null) {
        $query = $this->db->query("call usp_A_GetBannerByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}