<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends Front_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('facebook');
        $this->load->library('googleplus');
        $this->load->model('front/author_model', '', TRUE);
        $this->load->model('front/story_model', '', TRUE);

        $this->config->load('instagram');
        $this->instagram_data['insta_client_id'] = $this->config->item('insta_client_id');
        $this->instagram_data['insta_client_secret'] = $this->config->item('insta_client_secret');
        $this->instagram_data['insta_redirect_uri'] = $this->config->item('insta_redirect_uri');

        $this->config->load('linkedin');
        $this->linkedin_data['consumer_key'] = $this->config->item('linkedin_access');
        $this->linkedin_data['consumer_secret'] = $this->config->item('linkedin_secret');
        $this->linkedin_data['callback_url'] =  $this->config->item('linkedin_callback_url');//base_url() . 'front/login/callbacklinkedin';
    }
        
    public function index(){
        //print_r($this->session->userdata("user_data"));

        $this->load->library('user_agent');  // load user agent library
        // save the redirect_back data from referral url (where user first was prior to login)
        $this->session->set_userdata('redirect_back', $this->agent->referrer() ); 

        // Facebook
        $data['login_url'] = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('front/login/fblogin'),
            'scope' => 'email',
        ));

        // Google+
        $data['authUrl'] = $this->googleplus->client->createAuthUrl();


        //instagram
        $data['instagram'] = "https://api.instagram.com/oauth/authorize/?client_id=".$this->instagram_data['insta_client_id']."&redirect_uri=".$this->instagram_data['insta_redirect_uri']."&response_type=code&scope=basic"; // redirect user to oauth page
 

        //Linkedin
        $data['linkedin_link'] = '';
        /*$this->load->library('linkedin', $this->linkedin_data);
        $token = $this->linkedin->getRequestToken();
        $oauth_data = array(
            'oauth_request_token' => @$token['oauth_token'],
            'oauth_request_token_secret' => @$token['oauth_token_secret']
        );
        $this->session->set_userdata($oauth_data);
        $data['linkedin_link'] = $this->linkedin->generateAuthorizeUrl();*/

        $data['linkedin_link'] = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=".$this->linkedin_data['consumer_key']."&redirect_uri=".urlencode($this->linkedin_data['callback_url'])."&state=987654321&scope=r_basicprofile";
      
         $this->load->view('front/include/header', $data);
         //$this->load->view('includes/menu');
         $this->load->view('front/login', $data);
         $this->load->view('front/include/footer', $data);
    }

    public function logout(){
            @$this->session->unset_userdata('insta_user_info');
            @$this->session->unset_userdata('user_data');
            @$this->session->unset_userdata('redirect_back');
        if($this->input->is_ajax_request()){
            /*redirect set here for test and view profile page*/
            redirect(base_url()."home", 'refresh');
        }else{
            redirect(base_url()."home", 'refresh');
        }
    }

    /*private function reset_session() {
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('access_token_secret');
        $this->session->unset_userdata('request_token');
        $this->session->unset_userdata('request_token_secret');
        $this->session->unset_userdata('twitter_user_id');
        $this->session->unset_userdata('twitter_screen_name');
    }*/

    public function ajax_login() {
        $this->session->set_userdata('eventtype', 'login');
        $this->session->set_userdata('usertype', 'User');
        $data['user_profile'] = '';

        $user = $this->facebook->getUser();
        $data['login_url'] = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('front/login/fblogin'),
          
            'scope' => 'email',
        ));
                  
        $request_token = $this->connection->getRequestToken($this->config->item("base_url") . 'front/login/callback');
        //echo "Status code"; print_r($this->connection->http_code);
        if ($this->connection->http_code == 200) {
            $this->session->set_userdata('request_token', $request_token['oauth_token']);
            $this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);
            $data['url'] = $this->connection->getAuthorizeURL($request_token);
        } else {
                $data['url'] = '';
        }

        $data['authUrl'] = $this->googleplus->client->createAuthUrl();

        if ($this->input->is_ajax_request()) {
            $this->load->view("front/ajax_login", $data);
        } else {
            show_error("Access Denied");
        }
    }

    
    public function login(){ 
        if($this->input->post()){
            //if($this->input->is_ajax_request()){

            $username  = $this->input->post('username');
            $password  = $this->input->post('password');  
            $login     = $this->author_model->checkLogin($username, fnEncrypt($password, $this->config->item('sSecretKey')));

            if(isset($login['Message']) && $login['Message'] !=""){ 
                redirect('author-login?'.'err=author', 'refresh'); die; //echo "User Not Found"; exit;
            }
            //pr($login,true);
            
            $this->session->set_userdata('user_data', $login);
            /*redirect set here for test and view profile page*/
            if( $this->session->userdata('redirect_back') ) {
                $redirect_url = $this->session->userdata('redirect_back');  // grab value and put into a temp variable so we unset the session value
                $this->session->unset_userdata('redirect_back');
                redirect( $redirect_url ); die;
            }else{
                redirect('author-profile/'.$login['author_url'], 'refresh'); die;
            }
        }else{
            echo 'Email and Password not correct.'; exit;
        }
     }

    
     public function signup(){ 

        $username   = $this->input->post('username');
        $firstname  = $this->input->post('firstname');  
        $lastname   = $this->input->post('lastname');
        $cellphone  = $this->input->post('cellphone');
        $password   = $this->input->post('password'); 
        $signup     = $this->author_model->AuthorSignUp($username, $firstname, $lastname, $cellphone, fnEncrypt($password, $this->config->item('sSecretKey')));

        if(isset($signup['Message']) && $signup['Message'] !=""){  
            echo $signup['Message'];//"Something went wrong, Please try again.";
            exit;
        }
        //pr($signup,true);

        $this->session->set_userdata('user_data', $signup);

        /*redirect set here for test and view profile page*/
        $redirect_back = @$this->session->userdata('redirect_back');
        if($redirect_back!=NULL && $redirect_back!='') {
                $redirect_url = $this->session->userdata('redirect_back');  // grab value and put into a temp variable so we unset the session value
                //$this->session->unset_userdata('redirect_back');
                redirect( $redirect_url ); redirect( 'home' );  die;
            }else{
                redirect(base_url()."author-profile/".$signup['author_url'], 'refresh'); redirect( 'home' ); die;
            }
        /*echo 'SignUp Successful';
        exit;*/
     }

    public function googlelogin() {
   
        $data['url'] = '';
        $this->load->library('googleplus');
        if (isset($_GET['code'])) {
            $this->googleplus->client->authenticate();
            $this->session->set_userdata('token', $this->googleplus->client->getAccessToken());
        }
        if ($this->session->userdata('token')) {

            $this->googleplus->client->setAccessToken($this->session->userdata('token'));
        }
        if ($this->googleplus->client->getAccessToken()) {
            $users = $this->googleplus->oauth2->userinfo->get();
            //pr($users);exit();
            $name = explode(' ',$users['name']);

            $path_info = pathinfo($users['picture']);
            $file_name=date('YmdHis').'.'.$path_info['extension'];
            copy($users['picture'], FCPATH.'assets/uploads/author/profile/'.$file_name);


            $signup     = $this->author_model->AuthorSocialSignUp($users['email'], $name['0'], $name['1'], 'Google', $users['id'], $file_name);
            //pr($signup);exit(); 

            if(isset($signup['Message']) && $signup['Message'] !=""){  
                echo $signup['Message'];//"Something went wrong, Please try again.";
                exit;
            }

            $this->session->set_userdata('user_data', $signup);

            /*redirect set here for test and view profile page*/
            if( $this->session->userdata('redirect_back') ) {
                $redirect_url = $this->session->userdata('redirect_back');  // grab value and put into a temp variable so we unset the session value
                $this->session->unset_userdata('redirect_back');
                redirect( $redirect_url ); die;
            }else{
                redirect(base_url()."author-profile/".$signup['author_url'], 'refresh'); die;
            }

        } else {

            $data['authUrl'] = $this->googleplus->client->createAuthUrl();
            $this->load->view("front/home", $data);
        }
    }

    public function fblogin() {
        
        $this->load->library('facebook');
        $user = $this->facebook->getUser();

        if ($user) {

            $data['user_profile'] = $this->facebook->api('/me', array('fields' => 'id,email,first_name,last_name'));
            $fbid       = $data['user_profile']['id'];
            $email      = $data['user_profile']['email'];
            $first_name = $data['user_profile']['first_name'];
            $last_name  = $data['user_profile']['last_name'];
            $picUrl   = 'http://graph.facebook.com/'.$fbid.'/picture?type=large';

            $content = file_get_contents("http://graph.facebook.com/$fbid/picture?width=350&height=500&redirect=false");
            $picUrl = json_decode($content, true);
            $picUrl = $picUrl["data"]["url"];

            $path_info = pathinfo($picUrl);//pathinfo($picUrl);
            $extension = explode('?',$path_info['extension']);
            $file_name=date('YmdHis').'.'.$extension[0];
            copy($picUrl, FCPATH.'assets/uploads/author/profile/'.$file_name);

            $signup = $this->author_model->AuthorSocialSignUp($email, $first_name, $last_name, 'Facebook', $fbid ,$file_name);
                     
            if(isset($signup['Message']) && $signup['Message'] !=""){  
                echo $signup['Message'];//"Something went wrong, Please try again.";
                exit;
            }

            $this->session->set_userdata('user_data', $signup);

            /*redirect set here for test and view profile page*/
            if( $this->session->userdata('redirect_back') ) {
                $redirect_url = $this->session->userdata('redirect_back');  // grab value and put into a temp variable so we unset the session value
                $this->session->unset_userdata('redirect_back');
                redirect( $redirect_url ); die;
            }else{
                redirect(base_url()."author-profile/".$signup['author_url'], 'refresh'); die;
            } 
 
        } else{
            redirect("front/home","register");
        }
       
    }

    public function callback() {

        if ($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token')) {

            $this->reset_session();
            if ($this->session->userdata('eventtype') == 'register') {
                redirect("#!/home/signup", 'refresh');
            } else {
                redirect($this->config->item("base_url") . 'front/login');
            }
        } else {

            $access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));

            if ($this->connection->http_code == 200) {
                $this->session->set_userdata('access_token', $access_token['oauth_token']);
                $this->session->set_userdata('access_token_secret', $access_token['oauth_token_secret']);
                $this->session->set_userdata('twitter_user_id', $access_token['user_id']);
                $this->session->set_userdata('twitter_screen_name', $access_token['screen_name']);

                $this->session->unset_userdata('request_token');
                $this->session->unset_userdata('request_token_secret');
                $user = $this->connection->get('account/verify_credentials');
                if ($user) {

                    if ($this->session->userdata('eventtype') == 'register') {
                        $twitid = $user->id;
                        $name = $user->screen_name;
                        $this->session->set_userdata('first_name', $name);
                        $this->session->unset_userdata('access_token');
                        $this->session->unset_userdata('access_token_secret');
                        redirect("front/login", 'refresh');
                    } else {

                        $twitid = $user->id;
                        $name = $user->screen_name;
                       
                       
                        $usertype = $this->session->userdata('usertype');
                        // $already = $this->login_model->get_twitter_details($twitid);
                        $already = $this->login_model->check_mail($twitid);
                        //  print_r($already); die;
                        // Code for Redirection to Sign up page.
                        if($already) {
                        $id = $already['id'];
                        $email = $already['email'];
                        
                        $imageurl = $user->profile_image_url; 
                        if ($imageurl) {
                        $imgname = 'image' . $twitid . '.jpg';
                        $img = '/var/www/html/uploads/profiles/image' . $twitid . '.jpg'; 
                        file_put_contents($img, file_get_contents($imageurl));
                        } 
                        else {
                        $imgname = '';
                        }
                        //$id = $this->login_model->twitter_login($twitid, $name, $usertype,$imgname);
                        $id = $this->login_model->twitter_login_update($twitid, $email,$usertype, $imgname);
                        //echo $id; exit;
                        } 
                        else {
                            redirect("front/login", 'register');
                        }
                        
                        $userData = $this->login_model->get_details("userdetails", array('UserID' => $id, 'Status' => '1'));
                        $userLoginCheck = $this->login_model->get_details("usertype", array('UserId' => $id));

                        if (isset($userData) && !empty($userData)) {
                            $records['LoginId'] = $userData['UserID'];
                            $records['LoginFullName'] = ucwords($userData['FirstName']);
                            $records['LoginName'] = ucwords($userData['FirstName']);
                            $records['LoginEmail'] = $userData['Email'];
                            $records['LoginStatus'] = $userData['Status'];
                            $records['LoginType'] = $userLoginCheck['UserType'];
                            // $this->session->set_userdata('LoginInfo', $records);
                            $userData = array(
                                'Id' => $userData['UserID'],
                                'Name' => ucwords($userData['FirstName']),
                                'LoginType' => $userLoginCheck['UserType']
                            );
                            //echo "User type"; print_r($userData);
                            $this->session->unset_userdata('access_token');
                            $this->session->unset_userdata('access_token_secret');
                            $this->session->set_flashdata('error', 'This email address has been used by other User. Please try with differnt Email address.');
                            redirect('front/home', 'refresh');
                        }
                    }
                }
            } else {
                redirect("front/login", 'refresh');
            }
        }
    }

    public function forgotpassword(){ 

        // Facebook
        $data['login_url'] = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('front/login/fblogin'),
            'scope' => 'email',
        ));

        // Google+
        $data['authUrl'] = $this->googleplus->client->createAuthUrl();
      

        if($this->input->is_ajax_request()){
            $random_string = time();
            $reset_password_data = array();
            $reset_password_data['reset_password_link'] = $random_string;
            $reset_password_data['email_id_to_match'] = trim($this->input->post('username'));
            $reset_password_data['random_string'] = $random_string;
            $forgotpassword = $this->author_model->forgotPassword($reset_password_data);
            
           /* $email_details = '<div><center><div>'.$this->input->post('email_id').'<br>##RESET_PASSWORD_LINK##</div></center></div>';
            $search_array = array('##RESET_PASSWORD_LINK##');                
            $replace_array = array($reset_password_data['reset_password_link']);
            $body = str_replace($search_array, $replace_array, $email_details['Content']);*/
            
            if(isset($forgotpassword['Message']) && $forgotpassword['Message'] != ""){  
                echo $forgotpassword['Message'];//"Something went wrong, Please try again.";
                exit;
            }
            echo 'Password Send Successfully'; exit;
        }

         $this->load->view('front/include/header', $data);
         $this->load->view('front/forgotpassword', $data);
         $this->load->view('front/include/footer', $data);
     }

    /*function linkedin()
    {
        $this->load->library('linkedin', $this->data);
        $token = $this->linkedin->get_request_token();
        $oauth_data = array(
            'oauth_request_token' => $token['oauth_token'],
            'oauth_request_token_secret' => $token['oauth_token_secret']
        );
        $this->session->set_userdata($oauth_data);
        $request_link = $this->linkedin->get_authorize_URL($token);

        //header("Location: " . $request_link);
    }*/
    
    /* Get Access tokens */
    function callbacklinkedin() {
            
            //pr($_REQUEST['code']);
            $code = $_REQUEST['code'];

            $data = array("grant_type" => "authorization_code", 
                  "code" => $code,
                  "redirect_uri" => ($this->linkedin_data['callback_url']),
                  "client_id" => $this->linkedin_data['consumer_key'],
                  "client_secret" => $this->linkedin_data['consumer_secret'],
                  "scope"=>"r_emailaddress"//r_fullprofile%20r_emailaddress%20w_share
              );

            $url2 = "https://www.linkedin.com/oauth/v2/accessToken";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_URL, $url2);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);

            $result_array = json_decode($result, true);

            //print_r($result_array); die;

            

            $this->access_token = $result_array['access_token'];
            $url_profile = 'https://api.linkedin.com/v1/people/~?format=json&' . http_build_query(array(
                        'oauth2_access_token' => $this->access_token,
            ));
            $user = json_decode(file_get_contents($url_profile), true);

            $url_email = 'https://api.linkedin.com/v1/people/~/email-address?format=json&' . http_build_query(array(
                        'oauth2_access_token' => $this->access_token,
            ));
            @$user_email = json_decode(file_get_contents(@$url_email), true);

            $args = array();
            parse_str(parse_url($user['siteStandardProfileRequest']['url'], PHP_URL_QUERY), $args);
            $user_id = $args['id'];
            /*$user_data  = array(
                'linkedin_id'   => $user['id'],
                'id'            => $user_id,
                'first_name'    => $user['firstName'],
                'last_name'     => $user['lastName'],
                'name'          => $user['firstName'] . ' ' . $user['lastName'],
                'description'   => $user['headline'],
                'email'         => $user_email,
                'urls'          =>  array(
                                        'LinkedIn' => $user['siteStandardProfileRequest']['url']
                                    ),
            );*/

            $lid       = $user['id'];
            $email      = @$user_email;
            $first_name = $user['firstName'];
            $last_name  = $user['lastName'];
            
            $file_name='';

            $signup = $this->author_model->AuthorSocialSignUp($email, $first_name, $last_name, 'Linkedin', $lid ,$file_name);
                     
            if(isset($signup['Message']) && $signup['Message'] !=""){  
                echo $signup['Message'];//"Something went wrong, Please try again.";
                exit;
            }

            $this->session->set_userdata('user_data', $signup);

            /*redirect set here for test and view profile page*/
            if( $this->session->userdata('redirect_back') ) {
                $redirect_url = $this->session->userdata('redirect_back');  // grab value and put into a temp variable so we unset the session value
                $this->session->unset_userdata('redirect_back');
                redirect( $redirect_url ); die;
            }else{
                redirect(base_url()."author-profile/".$signup['author_url'], 'refresh'); die;
            } 

    }

    /* Post a Status update to linkedin */
    /* function post()
    {
        $auth_data = $this->session->userdata('auth');

        $title = "Trying out a Codeignier Linkedin Library";
        $comment = "Trying out a Codeignier Linkedin Library created by Murrion Software. Get the code on Github.com";
        $target_url = "https://github.com/MurrionSoftware/codeigniter-linkedin-library";
        $image_url = ""; // optional 

        $this->load->library('linkedin', $this->data);

        $status_response = $this->linkedin->share($comment, $title, $target_url, $image_url, unserialize($auth_data['linked_in']));

        if ($status_response == '201')
        {
            echo "Linkedin Comment posted successfully";
        }
        else
        {
            print_r($status_response);
        }
    }*/

    function instagram_callback() {

        //session_start();
        //$this->session->set_userdata('insta_user_info');
        //if( isset($this->session->set_userdata('insta_user_info'))){ // if user is logged in
        //    header("location: index.php"); // redirect user to index page
        //    return false;
        //}

        $code = $_GET['code'];
     
        // Get User Access Token 
     
        $method = 1; // method = 1, because we want POST method
     
        $url = "https://api.instagram.com/oauth/access_token";
     
        $header = 0; // header = 0, because we do not have header
     
        $data = array(
            "client_id" => $this->instagram_data['insta_client_id'],
            "client_secret" => $this->instagram_data['insta_client_secret'],
            "redirect_uri" => $this->instagram_data['insta_redirect_uri'],
            "grant_type" => "authorization_code",
            "code" => $code
        );
     
        $json = 1; // json = 1, because we want JSON response
     
        $get_access_token = $this->instagram_HTTP($method, $url, $header, $data, $json);
     
        $access_token = $get_access_token['access_token'];
     
        $get = file_get_contents("https://api.instagram.com/v1/users/self/?access_token=$access_token");
    
        $json = json_decode($get, true);
    
        //$this->session->set_userdata('insta_user_info', $json); // save user info in session
        
        //$user_info = $this->session->set_userdata('insta_user_info'); // get user info array
        if( isset($json) && !empty($json['data'])){ // if user is logged in
            /*$user_info = $this->session->set_userdata('insta_user_info'); // get user info array
            $full_name = $user_info['data']['full_name']; // get full name
            $username = $user_info['data']['username']; // get username
            $bio = $user_info['data']['bio']; // get bio
            $ID = $user_info['data']['id']; // get user id
            $website = $user_info['data']['website']; // get user website
            $media_count = $user_info['data']['counts']['media']; // get media count
            $followers_count = $user_info['data']['counts']['followed_by']; // get followers
            $following_count = $user_info['data']['counts']['follows']; // get following
            $profile_picture = $user_info['data']['profile_picture']; // get profile picture
            echo $insta_resp = '<h2>Welcome <?php echo $full_name; ?>!</h2>
                <p>Your username: <?php echo $username; ?></p>
                <p>Your bio: <?php echo $bio; ?></p>
                <p>Your website: <a href="<?php echo $website; ?>"><?php echo $website; ?></a></p>
                <p>Media count: <?php echo $media_count; ?></p>
                <p>Followers count: <?php echo $followers_count; ?></p>
                <p>Following count: <?php echo $following_count; ?></p>
                <p>Your ID: <?php echo $ID; ?></p>
                <p><img src="<?php echo $profile_picture; ?>"></p>
                <p><a href="logout.php">Logout?</a></p>';*/
            $iid       = $json['data']['id'];
            $email      = '';
            $name_list = explode(' ', $json['data']['full_name']);
            $first_name = ($name_list[0]) ? $name_list[0] : $json['data']['full_name'];
            $last_name  = @$name_list[1];
            
            $file_name='';
            $path_info = pathinfo($json['data']['profile_picture']);
            $file_name=date('YmdHis').'.'.$path_info['extension'];
            copy($json['data']['profile_picture'], FCPATH.'assets/uploads/author/profile/'.$file_name);

            $signup = $this->author_model->AuthorSocialSignUp($email, $first_name, $last_name, 'Instagram', $iid ,$file_name);
                     
            if(isset($signup['Message']) && $signup['Message'] !=""){  
                echo $signup['Message'];//"Something went wrong, Please try again.";
                exit;
            }

            $this->session->set_userdata('user_data', $signup);

            /*redirect set here for test and view profile page*/
            if( $this->session->userdata('redirect_back') ) {
                $redirect_url = $this->session->userdata('redirect_back');  // grab value and put into a temp variable so we unset the session value
                $this->session->unset_userdata('redirect_back');
                redirect( $redirect_url ); die;
            }else{
                redirect(base_url()."author-profile/".$signup['author_url'], 'refresh'); die;
            }
        } else{ // if user is not logged in
            redirect('author-login?'.'err=author', 'refresh'); die;
        }

        redirect('author-login?'.'err=author', 'refresh'); die; // redirect user to index page
    }

    function instagram_HTTP($method, $url, $header, $data, $json){
      if( $method == 1 ){
        $method_type = 1; // 1 = POST
      }else{
        $method_type = 0; // 0 = GET
      }
       
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($curl, CURLOPT_HEADER, 0);
       
      if( $header !== 0 ){
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
      }
       
      curl_setopt($curl, CURLOPT_POST, $method_type);
       
      if( $data !== 0 ){
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      }
       
      $response = curl_exec($curl);
       
      if( $json == 0 ){
        $json = $response;
      }else{
        $json = json_decode($response, true);
      }
       
      curl_close($curl);
       
      return $json;
    }
}
?>