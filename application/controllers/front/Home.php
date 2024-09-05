<?php
/**
 * Created by PhpStorm.
 * User: mtaneja
 * Company: Karma Solutions LLC / info@karmasolutionz.com
 * Date: 6/8/16
 * Time: 2:48 PM
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends Front_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('facebook');
        $this->load->library('googleplus');
         $this->load->model('front/story_model');

    }

    public function index()
    {
        $data['user_session'] = $this->session->userdata("user_data");

        // Facebook
        $data['login_url'] = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('front/login/fblogin'),
            'scope' => 'email',
        ));

        // Google+
        $data['authUrl'] = $this->googleplus->client->createAuthUrl();
      


        $data['title'] = 'The Revolver Lifestyle | Making "IT" Happen';
        $this->load->view("front/include/header", $data);
        $this->load->view("front/home", $data);
        $this->load->view("front/include/inner_footer", $data);
    }

    public function view($page = 'home')
    {

        if (!file_exists(APPPATH . '/views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('front/templates/header', $data);
        $this->load->view('front/pages/' . $page, $data);
        $this->load->view('front/templates/footer', $data);

    }

}