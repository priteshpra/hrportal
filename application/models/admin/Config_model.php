<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Config_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getConfig()
    {
        $query = $this->db->query("call usp_A_GetConfig()");
        $query->next_result();
        return $query->result();
    }


    public function insertUpdateConfig($config_array)
    {

        $config_array['CrashEmail'] = (isset($config_array['CrashEmail'])) ? $config_array['CrashEmail'] : NULL;

        $config_array['SupportEmail'] = (isset($config_array['SupportEmail'])) ? $config_array['SupportEmail'] : NULL;
        $config_array['TimeZone'] = (isset($config_array['TimeZone'])) ? $config_array['TimeZone'] : NULL;
        $config_array['AppVersionAndroid'] = (isset($config_array['AppVersionAndroid'])) ? $config_array['AppVersionAndroid'] : 0;
        $config_array['AppVersionIOS'] = (isset($config_array['AppVersionIOS'])) ? $config_array['AppVersionIOS'] : 0;
        $config_array['CoolingPeriod'] = (isset($config_array['CoolingPeriod'])) ? $config_array['CoolingPeriod'] : 0;
        $config_array['CVPrice'] = (isset($config_array['CVPrice'])) ? $config_array['CVPrice'] : 0;
        $config_array['CurrencyCode'] = (isset($config_array['CurrencyCode'])) ? $config_array['CurrencyCode'] : '';
        $config_array['usertype'] = $this->session->userdata['UserType'] . ' Web';
        $config_array['IPAddress'] = GetIP();
        if ($config_array['config_id'] == 0) {
            $config_array['created_by'] = (isset($config_array['created_by'])) ? $config_array['created_by'] : 0;
            $config_array['created_by'] = $this->session->userdata['UserID'];
            $config_array['modified_by'] = '0';
        }
        //For updating records
        else {
            $config_array['modified_by'] = (isset($config_array['modified_by'])) ? $config_array['modified_by'] : 0;
            $config_array['modified_by'] = $this->session->userdata['UserID'];
            $config_array['created_by'] = '0';
        }
        $query = "call usp_A_AddEditConfig('" .
            $config_array['CrashEmail'] . "','" .
            $config_array['SupportEmail'] . "','" .
            $config_array['TimeZone'] . "','" .
            $config_array['AppVersionAndroid'] . "','" .
            $config_array['AppVersionIOS'] . "','" .
            $config_array['usertype'] . "','" .
            $config_array['IPAddress'] . "','" .
            $config_array['created_by'] . "','" .
            $config_array['config_id'] . "','" .
            $config_array['modified_by'] . "','" .
            $config_array['CurrencyCode'] . "','" .
            $config_array['CoolingPeriod'] . "','" .
            $config_array['CVPrice'] . "','')";
        return $this->db->query($query);
    }
}
