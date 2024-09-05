<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admindashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/user_session_model');
        $this->load->model('admin/config_model');
        $this->load->library('session');
    }

    public function index() {
        $data = array();
        $data['dashboard'] = $this->user_session_model->getDashboard();//getDashboard
        $data['config'] = $this->config_model->getConfig();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/admindasboard/index', $data);
        $data['page_level_js'] = $this->load->view('admin/admindasboard/index_js',$data, TRUE);
        $this->load->view('admin/includes/footer', $data);
    }

}
