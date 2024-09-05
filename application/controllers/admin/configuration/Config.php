<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Config extends Admin_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/config_model');
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",8)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) || @$this->cur_module->is_edit == 0){
            show_404();
        }
    }
    public  function index()
    {
       try
        {
            if($this->cur_module->is_edit == 0)
                        show_404();
			$this->load->view('admin/includes/header');
            $config_result = array();
            $array = $this->config_model->getConfig();
            if(empty($array)){
                $config_result['page_name'] = "addConfig";
            }else{
                $config_result['config'] = $array[0];
                $config_result['page_name'] = "editConfig/".$config_result['config']->ConfigID;
            }
            $config_result['loading_button'] = getLoadingButton(); 
            $this->load->view('admin/configuration/config/add_edit',$config_result);
            $data['page_level_js'] = $this->load->view('admin/configuration/config/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer',$data);    
            unset($config_result);
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
				"Type" => $this->session->user_data['UserType'] . " Web",
                "User_Agent" => getUserAgent(),
				"IPAddress" => GetIP()
            );
            $this->common_model->insertAdminError($error_array);
        }    
    }
    public function editConfig($config_id = NULL)
    {
        try
        {
            if($this->cur_module->is_edit == 0)
                        show_404();
			
			if ($this->input->post())	
            {
				$this->load->library('form_validation');
            
				$this->form_validation->set_rules('CrashEmail', 'CrashEmail', 'trim|required');
				$this->form_validation->set_rules('SupportEmail', 'SupportEmail', 'trim|required');
				if ($this->form_validation->run() == TRUE) 
				{
					$config_array = $this->input->post();
                    $config_array['config_id'] = $config_id;

                    if ($this->config_model->insertUpdateConfig($config_array)) 
                    {
						$this->session->set_flashdata('postsuccess', 'Record has been saved successfully.');
                        
						redirect($this->config->item('base_url') . 'admin/configuration/config');
                    }
                }
            } 
            else 
            {
                redirect($this->config->item('base_url') . 'admin/configuration/config');
            }
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
				"Type" => $this->session->user_data['UserType'] . " Web",
                "User_Agent" => getUserAgent(),
				"IPAddress" => GetIP()
            );
            $this->common_model->insertAdminError($error_array);
        }    
    }
    public function addConfig()
    {
        try
        {
            if(@$this->cur_module->is_insert == 0)
                        show_404();
			
			if ($this->input->post()) 
            {
				$this->load->library('form_validation');

				$this->form_validation->set_rules('CrashEmail', 'CrashEmail', 'trim|required');
				$this->form_validation->set_rules('SupportEmail', 'SupportEmail', 'trim|required');

				if ($this->form_validation->run() == TRUE) 
				{
					
					$config_array = $this->input->post();
					$config_array['config_id'] = 0;

					if ($this->config_model->insertUpdateConfig($config_array))
					{
						redirect($this->config->item('base_url') . 'admin/configuration/config');
					}
				   
				}
			}			
            else 
            {
                redirect($this->config->item('base_url') . 'admin/configuration/config');
            }
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
            );
            $this->common_model->insertAdminError($error_array);
        }    
    }
    
    
    
}
