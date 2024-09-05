<?php

function PHPMailerAutoload($classname)
{
    //Can't use __DIR__ as it's only in PHP 5.3+
    $filename = APPPATH . 'libraries/' . $classname . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}
function CustomMail($array)
{
    $CI = &get_instance();

    $CI->load->library('email');
    $config['protocol']    = 'mail';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = DEFAULT_ADMIN_EMAIL;
    $config['smtp_pass']    = DEFAULT_ADMIN_EMAIL_PASSWORD;
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html/text
    $config['validation'] = TRUE; // bool whether to validate email or not      
    $CI->email->initialize($config);
    $CI->email->from($array['FromEmailID'], $array['FromName']);
    $CI->email->to($array['ToEmailID']);

    $CI->email->subject($array['Subject']);
    $CI->email->message($array['Body']);
    //print_r($CI->email); exit;
    return $CI->email->send();

    //echo $CI->email->print_debugger();exit;
}

if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
    //SPL autoloading was introduced in PHP 5.1.2
    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
        spl_autoload_register('PHPMailerAutoload', true, true);
    } else {
        spl_autoload_register('PHPMailerAutoload');
    }
} else {
    /**
     * Fall back to traditional autoload for old PHP versions
     * @param string $classname The name of the class to load
     */
    function spl_autoload_register($classname)
    {
        PHPMailerAutoload($classname);
    }
}
