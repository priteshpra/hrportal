 <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }
    function GetCountry($Selected = 0){
        getCountryCombobox($Selected);
    }
    function GetState($Selected = 0,$CountryID = 0){
        echo getStateCombobox($Selected,$CountryID);
    }
    function GetCity($Selected = 0,$StateID = 0){
        echo getCityCombobox($Selected,$StateID);
    }
    function GetCountryBasedCombobox($Selected = 0){
        echo getCountryStateComboBox($Selected);
    }
    function GetStateBasedCombobox($Selected = 0,$CountryID = 0){
        echo getStateBasedCombobox($Selected,$CountryID);
    }
    function GetCityBasedCombobox($Selected = 0,$StateID = 0){
        echo GetCityBasedState($Selected,$StateID);
    }
    function GetEthnicityParentCombobox($Selected = 0){
        echo getParentEthnicity($Selected);
    }
}
