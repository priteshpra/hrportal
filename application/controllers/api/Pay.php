<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pay extends Front_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('paypal_lib');
    $this->load->model('api/master_model');
    $this->load->helper('global');
    $this->load->helper("phpmailerautoload");

    // Load helpers
    $this->load->helper('url');
    // Load PayPal library
    // $this->config->load('paypal');
    // $config = array(
    //   'Sandbox' => $this->config->item('Sandbox'),      // Sandbox / testing mode option.
    //   'APIUsername' => $this->config->item('APIUsername'),  // PayPal API username of the API caller
    //   'APIPassword' => $this->config->item('APIPassword'),  // PayPal API password of the API caller
    //   'APISignature' => $this->config->item('APISignature'),  // PayPal API signature of the API caller
    //   'APISubject' => '',                   // PayPal API subject (email address of 3rd party user that has granted API permission for your app)
    //   'APIVersion' => $this->config->item('APIVersion')   // API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
    // );
    // // Show Errors
    // if($config['Sandbox']){
    //   error_reporting(E_ALL);
    //   ini_set('display_errors', '1');
    // }
    // $this->load->library('paypal/Paypal_pro', $config); 
  }

  public function Paypal($video_id = '', $user_id = '')
  {
    if ($video_id != '' && $user_id != '') {
      //$order_detail = $this->master_model->getvideobyid($video_id);
      $order_detail = $this->master_model->getQueryResult("call usp_M_GetVideoByID('" . $video_id . "')");
      //Set variables for paypal form

      $returnURL = base_url() . 'api/pay/PaypalSuccess/' . $video_id . '/' . $user_id; //payment success url
      $cancelURL = base_url() . 'api/pay/PaypalCancel/' . $video_id . '/' . $user_id; //payment cancel url
      $notifyURL = base_url() . 'api/pay/PaypalIpn'; //ipn url   

      //$data = $this->master_model->getCartDetail();
      $cart_price = '0';
      $Quantity = '1';
      $i = 1;
      $cart_price = $order_detail[0]->Price;
      $logo = base_url() . DEFAULT_EMAIL_IMAGE . 'login-logo.png';

      $add_transaction = $this->master_model->getQueryResult("call usp_M_StartTransaction('" . $video_id . "','" . $user_id . "','" . $cart_price . "')");

      if (!isset($add_transaction[0]->Message) && @$add_transaction[0]->ID > 0) {
        $order_id = $add_transaction[0]->ID;
        $_result = $this->master_model->getQueryResult("call usp_M_GetConfig()");
        $currency = "USD";
        if (isset($_result[0]->CurrencyCode) && $_result[0]->CurrencyCode != '') {
          $currency = $_result[0]->CurrencyCode;
        }
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('custom', $user_id);
        $this->paypal_lib->add_field('item_number',  $order_id);
        $this->paypal_lib->add_field('currency_code', $currency);

        $this->paypal_lib->add_field('item_name', (($order_detail[0]->VideoTitle) ? $order_detail[0]->VideoTitle : 'Unique-HR'));
        $this->paypal_lib->add_field('amount', $cart_price);
        $this->paypal_lib->add_field('quantity', $Quantity);
        $this->paypal_lib->image($logo);

        //if (!$this->input->post())   
        $this->paypal_lib->paypal_auto_form();
        // redirect(base_url('api/pay/paypal/'.$data['order'][0]->OrderID));
      } else {
        echo ($add_transaction[0]->Message ? $add_transaction[0]->Message : 'Order not created yet. Please try again.');
      }
    } else {
      echo 'Video and user info not found.';
    }
  }

  function PaypalSuccess($video_id, $user_id)
  {


    // $this->load->library('user_agent');
    // $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
    // if (strpos($useragent, 'Unique-HR#123456') !== false) {
    //     $data['is_mobile'] = $this->agent->is_mobile();
    // }
    //get the transaction data
    $paypalInfo = $this->input->get();
    // $data['item_number'] = $paypalInfo['item_number']; 
    // $data['txn_id'] = $paypalInfo["tx"];
    // $data['payment_amt'] = $paypalInfo["amt"];
    // $data['currency_code'] = $paypalInfo["cc"];
    // $data['status'] = $paypalInfo["st"];
    //$data['of_id'] = $this->master_model->insertTransaction($this->session->user_data['UserID'],$video_id,'','','','','Success',"Paypal");
    //echo "called";
    //pass the transaction data to view
    //$this->load->view('paypal/success', $data);
    $paypalInfo = $this->input->post();
    if ($paypalInfo) {
      $data['user_id'] = $paypalInfo['custom'];
      $data['order_id'] = $paypalInfo["item_number"];
      $data['txn_id'] = $paypalInfo["txn_id"];
      $data['payment_gross'] = $paypalInfo["payment_gross"];
      $data['currency_code'] = $paypalInfo["mc_currency"];
      $data['payer_email'] = $paypalInfo["payer_email"];
      $data['payment_status'] = $paypalInfo["payment_status"];

      //$data['booking'] = $this->master_model->addBookingformBoookingtemp($data['video_id']);
      $data['video_id'] = $video_id;
      $data['off_id'] = $this->master_model->getQueryResult("call usp_M_GetVideoByID('" . $video_id . "')");
      $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('" . $data['off_id'][0]->UserID . "')");

      /*$device_row = $this->master_model->getInlineQuery("SELECT DeviceTokenID FROM ssc_deviceinfo WHERE UserID = '".$data['off_id'][0]->UserID."'");
                if(!empty($device_row)){
                foreach ($device_row as $device_val) {
                    //print_r($device_val->DeviceTokenID);
                    if(@$device_val->DeviceTokenID){
                        $pushNotificationArr = array('device_id'=>$device_val->DeviceTokenID,
                                                        'message'=>'Subscribr video successfully.',
                                                        'title'=>'Unique-HR',
                                                        'detail'=>array('UserID'=>$data['off_id'][0]->UserID,
                                                                        'VideoID'=>$data['off_id'][0]->VideoID,
                                                            )
                                                    );
                        sendPushNotification($pushNotificationArr);
                    }
                }
                }*/
      if ($data['payment_status'] = "Completed") {
        $data['payment_status'] = "Success";


        //email otp functionality
        $email_template = $this->master_model->get_emailtemplate($id = 7);
        $array['ToEmailID'] = $profile[0]->EmailID;
        $array['Subject']  = $email_template['EmailSubject'] . ' - ' . $OTP;
        $array['Body'] = $email_template['Content'];
        $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
        $array['FromName'] = DEFAULT_FROM_NAME;
        $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
        $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
        $array['AltBody'] = '';
        $image_path = base_url() . DEFAULT_EMAIL_IMAGE . 'login-logo.png';
        $back_image_path = ''; //base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';  
        $startDate = time();
        $exp_date = date('Y-m-d H:i:s', strtotime('+1 day', $startDate));
        $data1 = array('{WebsiteName}', '{logo}', '{name}', '{otp}', '{back_image}', '{expiredate}');
        $datavalue = array(DEFAULT_WEBSITE_TITLE, $image_path, $profile[0]->FirstName, $OTP, $back_image_path, $exp_date);
        $array['Body'] = str_replace($data1, $datavalue, $array['Body']);
        //pr($array['Body']);exit();
        $val = CustomMail($array);
        if ($val == 0) {
          $msg = "";
        } else {
          $msg = label('new_otp_sent');
          //return $msg;
        }
      } else if ($data['payment_status'] = "Pending") {
        $data['payment_status'] = "In Progress";
      } else {
        $data['payment_status'] = "Fail";
      }
      $add_transaction = $this->master_model->getQueryResult("call usp_M_EndTransaction('" . $data['order_id'] . "','" . $data['payment_status'] . "','Paypal','" . json_encode($paypalInfo) . "','" . $data['txn_id'] . "','" . $data['currency_code'] . "')");
      //$data['of_id'] = $this->master_model->insertTransaction($data['user_id'],$data['video_id'],$data['txn_id'],$data['payment_gross'],$data['currency_code'],$data['payer_email'],$data['payment_status'],"Paypal");
    }
    //$this->load->view("front/include/header",@$data);
    $this->load->view("front/paypal/payment_complete", @$data);
    //$this->load->view("front/include/footer",@$data);  
  }

  function PaypalCancel()
  {
    $this->load->view('front/paypal/cancel');
  }

  function PaypalIpn()
  {
    //paypal return transaction details array
    $paypalInfo = $this->input->post();
    $data['user_id'] = $paypalInfo['custom'];
    $data['video_id'] = $paypalInfo["item_number"];
    $data['txn_id'] = $paypalInfo["txn_id"];
    $data['payment_gross'] = $paypalInfo["payment_gross"];
    $data['currency_code'] = $paypalInfo["mc_currency"];
    $data['payer_email'] = $paypalInfo["payer_email"];
    $data['payment_status'] = $paypalInfo["payment_status"];
    $data['of_id'] = $this->master_model->insertTransaction($data['user_id'], $data['video_id'], $data['txn_id'], $data['payment_gross'], $data['currency_code'], $data['payer_email'], $data['payment_status'], "Paypal");
    $paypalURL = $this->paypal_lib->paypal_url;
    $result = $this->paypal_lib->curlPost($paypalURL, $paypalInfo);
    //pr($result); exit;
    //check whether the payment is verified
    if (preg_match("/VERIFIED/i", $result)) {
      //insert the transaction data into the database
      $this->product->insertTransaction($data);
    }
  }



  public function cv($user_id = '', $template = 1)
  {
    if ($user_id != '') {
      $returnURL    = base_url() . 'api/pay/cvsuccess/' . $user_id . '/' . $template; //payment success url
      $cancelURL    = base_url() . 'api/pay/PaypalCancel/' . $user_id . '/' . $template; //payment cancel url
      $notifyURL    = base_url() . 'api/pay/cvipn'; //ipn url   

      $cart_price   = '0';
      $Quantity     = '1';
      $i            = 1;
      $currency     = "USD";
      $logo         = base_url() . DEFAULT_EMAIL_IMAGE . 'login-logo.png';
      $_result      = $this->master_model->getQueryResult("call usp_M_GetConfig()");
      $cart_price   = $_result[0]->CVPrice;
      if (isset($_result[0]->CurrencyCode) && $_result[0]->CurrencyCode != '') {
        $currency   = $_result[0]->CurrencyCode;
      }

      $add_transaction = $this->master_model->insertTransaction('-1', $user_id, $cart_price, 'In Progress', 'Paypal', '', $currency);

      if (isset($add_transaction->Flag_subscribed) && $add_transaction->Flag_subscribed == 1) {
        if ($template == 3) {
          $cv_res = file_get_contents(base_url() . '/api/cvPDF/cv_three/' . $user_id);
        } elseif ($template == 2) {
          $cv_res = file_get_contents(base_url() . '/api/cvPDF/cv_two/' . $user_id);
        } else {
          $cv_res = file_get_contents(base_url() . '/api/cvPDF/index/' . $user_id);
        }
        redirect(base_url('api/pay/cvsuccess/' . $user_id . '/' . $template));
      } else {
        if (!isset($add_transaction->Message) && @$add_transaction->ID > 0) {
          $order_id   = $add_transaction->ID;
          $this->paypal_lib->add_field('return', $returnURL);
          $this->paypal_lib->add_field('cancel_return', $cancelURL);
          $this->paypal_lib->add_field('notify_url', $notifyURL);
          $this->paypal_lib->add_field('custom', $user_id);
          $this->paypal_lib->add_field('item_number',  $order_id);
          $this->paypal_lib->add_field('currency_code', $currency);

          $this->paypal_lib->add_field('item_name', 'Unique-HR CV ' . $template);
          $this->paypal_lib->add_field('amount', $cart_price);
          $this->paypal_lib->add_field('quantity', $Quantity);
          $this->paypal_lib->image($logo);

          //if (!$this->input->post())   
          $this->paypal_lib->paypal_auto_form();
          // redirect(base_url('api/pay/paypal/'.$data['order'][0]->OrderID));
        } else {
          echo ($add_transaction->Message ? $add_transaction->Message : 'Order not created yet. Please try again.');
        }
      }
    } else {
      echo 'Video and user info not found.';
    }
  }

  function cvsuccess($user_id, $template = 1)
  {

    //get the transaction data
    $paypalInfo = $this->input->get();
    //pass the transaction data to view
    //$this->load->view('paypal/success', $data);
    $paypalInfo = $this->input->post();
    if ($paypalInfo) {
      $data['user_id'] = $paypalInfo['custom'];
      $data['order_id'] = $paypalInfo["item_number"];
      $data['txn_id'] = $paypalInfo["txn_id"];
      $data['payment_gross'] = $paypalInfo["payment_gross"];
      $data['currency_code'] = $paypalInfo["mc_currency"];
      $data['payer_email'] = $paypalInfo["payer_email"];
      $data['payment_status'] = $paypalInfo["payment_status"];

      $profile = $this->master_model->getQueryResult("call usp_M_GetProfileByID('" . $user_id . "','" . base_url() . "')");

      /*$device_row = $this->master_model->getInlineQuery("SELECT DeviceTokenID FROM ssc_deviceinfo WHERE UserID = '".$user_id."'");
                if(!empty($device_row)){
                foreach ($device_row as $device_val) {
                    //print_r($device_val->DeviceTokenID);
                    if(@$device_val->DeviceTokenID){
                        $pushNotificationArr = array('device_id'=>$device_val->DeviceTokenID,
                                                        'message'=>'Subscribr video successfully.',
                                                        'title'=>'Unique-HR',
                                                        'detail'=>array('UserID'=>$user_id,
                                                                        'VideoID'=>$data['off_id'][0]->VideoID,
                                                            )
                                                    );
                        sendPushNotification($pushNotificationArr);
                    }
                }
                }*/
      if ($data['payment_status'] = "Completed") {
        $data['payment_status'] = "Success";
        if ($template == 3) {
          $cv_res = file_get_contents(base_url() . '/api/cvPDF/cv_three/' . $user_id);
        } elseif ($template == 2) {
          $cv_res = file_get_contents(base_url() . '/api/cvPDF/cv_two/' . $user_id);
        } else {
          $cv_res = file_get_contents(base_url() . '/api/cvPDF/index/' . $user_id);
        }


        //email otp functionality
        /*$email_template = $this->master_model->get_emailtemplate($id = 7);
                        $array['ToEmailID'] = $profile[0]->EmailID;
                        $array['Subject']  = $email_template['EmailSubject'].' - '.$OTP;
                        $array['Body'] = $email_template['Content']; 
                        $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
                        $array['FromName'] = DEFAULT_FROM_NAME;
                        $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
                        $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
                        $array['AltBody'] = '';  
                        $image_path = base_url().DEFAULT_EMAIL_IMAGE.'login-logo.png';  
                        $back_image_path = '';//base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';  
                        $startDate = time();  
                        $exp_date = date('Y-m-d H:i:s', strtotime('+1 day', $startDate));
                        $data1 = array('{WebsiteName}','{logo}','{name}','{otp}','{back_image}','{expiredate}');
                        $datavalue = array(DEFAULT_WEBSITE_TITLE,$image_path, $profile[0]->FirstName, $OTP,$back_image_path,$exp_date);
                        $array['Body'] = str_replace($data1, $datavalue, $array['Body']);
                        //pr($array['Body']);exit();
                        $val = CustomMail($array);
                        if($val == 0){
                            $msg = "";
                        }else{
                            $msg = label('new_otp_sent');
                            //return $msg;
                        }*/
      } else if ($data['payment_status'] = "Pending") {
        $data['payment_status'] = "In Progress";
      } else {
        $data['payment_status'] = "Fail";
      }

      $add_transaction = $this->master_model->insertTransaction($data['order_id'], $user_id, $data['payment_gross'], $data['payment_status'], 'Paypal', $data['txn_id'], $data['currency_code']);
    }
    //$this->load->view("front/include/header",@$data);
    $this->load->view("front/paypal/payment_complete", @$data);
    //$this->load->view("front/include/footer",@$data);  
  }

  function cvipn()
  {
    //paypal return transaction details array
    $paypalInfo = $this->input->post();
    $data['user_id'] = $paypalInfo['custom'];
    $data['order_id'] = $paypalInfo["item_number"];
    $data['txn_id'] = $paypalInfo["txn_id"];
    $data['payment_gross'] = $paypalInfo["payment_gross"];
    $data['currency_code'] = $paypalInfo["mc_currency"];
    $data['payer_email'] = $paypalInfo["payer_email"];
    $data['payment_status'] = $paypalInfo["payment_status"];
    $data['of_id'] = $this->master_model->insertTransaction($data['order_id'], $data['user_id'], $data['payment_gross'], $data['payment_status'], 'Paypal', $data['txn_id'], $data['currency_code']);

    $paypalURL = $this->paypal_lib->paypal_url;
    $result = $this->paypal_lib->curlPost($paypalURL, $paypalInfo);
    // pr($result); exit;
    // check whether the payment is verified
    // if(preg_match("/VERIFIED/i",$result)){
    //     //insert the transaction data into the database
    //   $this->product->insertTransaction($data);
    // }
  }

  function Credit_Card($video_id = '', $type = "")
  {


    $this->load->library('user_agent');
    $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if (strpos($useragent, 'hairartist#123456') !== false) {
      $data['is_mobile'] = $this->agent->is_mobile();
    }

    $data['video_id'] = $video_id;
    if (($_POST)) {
      $video_id1 = $this->input->post('video_id');
      $card_number = $this->input->post('card_number');
      $expriy_month = $this->input->post('expriy_month');
      $expiry_year = $this->input->post('expiry_year');
      $cvv = $this->input->post('cvv');
      $name_on_card = $this->input->post('name_on_card');

      $order_detail = $data['order_detail'] = $this->master_model->getQueryResult("call usp_M_GetVideoByID('" . $video_id . "')");
      $profile = $this->master_model->getProfileByID($order_detail[0]->UserID);
      //$this->master_model->getbookingtempbyid($video_id1);
      $UserID = $order_detail[0]->UserID;
      $cart_price = '0';
      $Quantity = count($order_detail);
      $i = 1;

      foreach ($order_detail as $value) {
        $cart_price += $value->FinalAmount;
        $Quantity = $Quantity;
        $i++;
      }

      $DPFields = array(
        'paymentaction' => 'Sale',            // How you want to obtain payment.  Authorization indidicates the payment is a basic auth subject to settlement with Auth & Capture.  Sale indicates that this is a final sale for which you are requesting payment.  Default is Sale.
        'ipaddress' => $_SERVER['REMOTE_ADDR'],               // Required.  IP address of the payer's browser.
        'returnfmfdetails' => '1'           // Flag to determine whether you want the results returned by FMF.  1 or 0.  Default is 0.
      );

      $CCDetails = array(
        'creditcardtype' => 'VISA',           // Required. Type of credit card.  Visa, MasterCard, Discover, Amex, Maestro, Solo.  If Maestro or Solo, the currency code must be GBP.  In addition, either start date or issue number must be specified.
        'acct' => $card_number,                // Required.  Credit card number.  No spaces or punctuation.  
        'expdate' => $expriy_month . $expiry_year,              // Required.  Credit card expiration date.  Format is MMYYYY
        'cvv2' => $cvv,                // Requirements determined by your PayPal account settings.  Security digits for credit card.
        'startdate' => '',              // Month and year that Maestro or Solo card was issued.  MMYYYY
        'issuenumber' => ''             // Issue number of Maestro or Solo card.  Two numeric digits max.
      );

      $PayerInfo = array(
        'email' => 'info.developertesting-buyer@gmail.com',                 // Email address of payer.
        'payerid' => '',              // Unique PayPal customer ID for payer.
        'payerstatus' => '',            // Status of payer.  Values are verified or unverified
        'business' => 'Testers, LLC'              // Payer's business name.
      );

      $PayerName = array(
        'salutation' => '',            // Payer's salutation.  20 char max.
        'firstname' => $profile['CustomerName'],              // Payer's first name.  25 char max.
        'middlename' => '',             // Payer's middle name.  25 char max.
        'lastname' => '',              // Payer's last name.  25 char max.
        'suffix' => '',               // Payer's suffix.  12 char max.
      );

      $BillingAddress = array(
        'street' => 'Ahmedabad',            // Required.  First street address.
        'street2' => '',            // Second street address.
        'city' => '',              // Required.  Name of City.
        'state' => '',              // Required. Name of State or Province.
        'countrycode' => 'US',          // Required.  Country code.
        'zip' => '',               // Required.  Postal code of payer.
        'phonenum' => $profile['MobileNo']            // Phone Number of payer.  20 char max.
      );

      $ShippingAddress = array(
        'shiptoname' => 'Ahmedabad',           // Required if shipping is included.  Person's name associated with this address.  32 char max.
        'shiptostreet' => '',          // Required if shipping is included.  First street address.  100 char max.
        'shiptostreet2' => '',          // Second street address.  100 char max.
        'shiptocity' => '',          // Required if shipping is included.  Name of city.  40 char max.
        'shiptostate' => '',          // Required if shipping is included.  Name of state or province.  40 char max.
        'shiptozip' => '',             // Required if shipping is included.  Postal code of shipping address.  20 char max.
        'shiptocountry' => 'US',          // Required if shipping is included.  Country code of shipping address.  2 char max.
        'shiptophonenum' => $profile['MobileNo']          // Phone number for shipping address.  20 char max.
      );

      $PaymentDetails = array(
        'amt' => $cart_price,              // Required.  Total amount of order, including shipping, handling, and tax.  
        'currencycode' => 'USD',          // Required.  Three-letter currency code.  Default is USD.
        'itemamt' => '',             // Required if you include itemized cart details. (L_AMTn, etc.)  Subtotal of items not including S&H, or tax.
        'shippingamt' => '',          // Total shipping costs for the order.  If you specify shippingamt, you must also specify itemamt.
        'shipdiscamt' => '',          // Shipping discount for the order, specified as a negative number.  
        'handlingamt' => '',          // Total handling costs for the order.  If you specify handlingamt, you must also specify itemamt.
        'taxamt' => '',             // Required if you specify itemized cart tax details. Sum of tax for all items on the order.  Total sales tax. 
        'desc' => 'Web Order',              // Description of the order the customer is purchasing.  127 char max.
        'custom' => $UserID,             // Free-form field for your own use.  256 char max.
        'ovideo_id' => $video_id1,
        'invnum' => '',
        'notifyurl' => ''           // URL for receiving Instant Payment Notifications.  This overrides what your profile is set to use.
      );

      $OrderItems = array();


      $Item  = array(
        'l_name' => 'Hairartist',            // Item Name.  127 char max.
        'l_desc' => '',            // Item description.  127 char max.
        'l_amt' => $cart_price,               // Cost of individual item.
        'l_number' => '123',            // Item Number.  127 char max.
        'l_qty' => '',               // Item quantity.  Must be any positive integer.  
        'l_taxamt' => '',             // Item's sales tax amount.
        'l_ebayitemnumber' => '',         // eBay auction number of item.
        'l_ebayitemauctiontxnid' => '',     // eBay transaction ID of purchased item.
        'l_ebayitemorderid' => '',         // eBay order ID for the item.                                     
      );

      array_push($OrderItems, $Item);

      $Secure3D = array(
        'authstatus3d' => '',
        'mpivendor3ds' => '',
        'cavv' => '',
        'eci3ds' => '',
        'xid' => ''
      );

      $PayPalRequestData = array(
        'DPFields' => $DPFields,
        'CCDetails' => $CCDetails,
        'PayerInfo' => $PayerInfo,
        'PayerName' => $PayerName,
        'BillingAddress' => $BillingAddress,
        'ShippingAddress' => $ShippingAddress,
        'PaymentDetails' => $PaymentDetails,
        'OrderItems' => $OrderItems,
        'Secure3D' => $Secure3D,
      );


      $PayPalResult = $this->paypal_pro->DoDirectPayment($PayPalRequestData);
      //pr($_REQUEST); pr($PayPalResult);   exit;
      if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
        $Error = $PayPalResult['ERRORS'][0]['L_LONGMESSAGE'];
        redirect(base_url('api/pay/Credit_Card/' . $video_id1 . '?msg=' . $Error));
        //$this->load->view("front/include/header",$data);
        //$this->load->view("front/appointment/credit_card",$data);
        //$this->load->view("front/include/footer",$data);
      } else {
        //Successful call.  Load view or whatever you need to do here.
        $data = array('PayPalResult' => $PayPalResult);
        $user_id = $PayPalResult["REQUESTDATA"]['CUSTOM'];
        $video_id = $PayPalResult["REQUESTDATA"]['Ovideo_id'];
        $txn_id = $PayPalResult["TRANSACTIONID"];
        $payment_gross = $PayPalResult["AMT"];
        $currency_code = $PayPalResult["CURRENCYCODE"];
        $payer_email = $PayPalResult["REQUESTDATA"]['EMAIL'];
        $payment_status = $PayPalResult["ACK"];
        $type = 'Paypal';
        $data['of_id'] = $this->master_model->insertTransaction($user_id, $video_id, $txn_id, $payment_gross, $currency_code, $payer_email, $payment_status, $type);

        $book_id = $PayPalResult["REQUESTDATA"]['Ovideo_id'];
        $this->master_model->booking_payment_status($book_id);
        //$this->master_model->order_mail($video_id);   
        //$this->load->view("front/include/header",$data);
        $this->load->view("front/paypal/payment_complete", $data);
        //$this->load->view("front/include/footer",$data);
      }
    } else {
      $data['type'] = "";
      //$this->load->view("front/include/header",$data);
      $this->load->view("front/paypal/credit_card", $data);
      //$this->load->view("front/include/footer",$data);
    }
  }

  function order_mail()
  {
    $this->master_model->order_mail('60');
  }
}
