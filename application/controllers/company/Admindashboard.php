<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admindashboard extends Company_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('company/user_session_model');
    }

    public function index() {
        $data = array();
        $data['dashboard'] = $this->user_session_model->getDashboard();//getDashboard
        $this->load->view('company/includes/header');
        $this->load->view('company/dasboard/index', $data);
        $data['page_level_js'] = $this->load->view('company/dasboard/index_js',$data, TRUE);
        $this->load->view('company/includes/footer', $data);
    }

}
