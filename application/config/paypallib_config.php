<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------
// Paypal IPN Class
// ------------------------------------------------------------------------

// Use PayPal on Sandbox or Live
$config['sandbox'] = FALSE; // FALSE for live environment

// PayPal Business Email ID
$config['business'] = 'admin@cajigo.com';//'dipika.saggisoftsolutions@gmail.com';//'kunden.saggisoftsolutions-facilitator@gmail.com';

// If (and where) to log ipn to file
$config['paypal_lib_ipn_log_file'] = BASEPATH . 'logs/paypal_ipn.log';
$config['paypal_lib_ipn_log'] = TRUE;
$config['paypal_lib_currency_code'] = 'GBP';

// Where are the buttons located at 
$config['paypal_lib_button_path'] = 'buttons';



?>
