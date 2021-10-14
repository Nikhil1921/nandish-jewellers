<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('my_crypt'))
{
    function my_crypt($string, $action = 'e' )
    {
        $secret_key = strtolower(str_replace(" ", '_', APP_NAME)).'_key';
	    $secret_iv = strtolower(str_replace(" ", '_', APP_NAME)).'_iv';

	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

	    if( $action == 'e' ) {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }
	    else if( $action == 'd' ){
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }

	    return $output;
    }   
}

if ( ! function_exists('re'))
{
    function re($array='')
    {
        echo "<pre>";
        print_r($array);
        exit;
    }
}

if ( ! function_exists('e_id'))
{
    function e_id($id)
    {
        return $id * 44545;
    }
}

if ( ! function_exists('d_id'))
{
    function d_id($id)
    {
        return $id / 44545;
    }
}

if ( ! function_exists('admin'))
{
    function admin($url='')
    {
        return ADMIN.'/'.$url;
    }
}

if ( ! function_exists('b_asset'))
{
    function b_asset($url='')
    {
        return base_url('assets/back/'.$url);
    }
}

if ( ! function_exists('flashMsg'))
{
    function flashMsg($success, $succmsg, $failmsg, $redirect)
    {
        $CI =& get_instance();
        
        if ($success)
            $CI->session->set_flashdata(['title' => 'Success | ','notify' => 'success', 'message' => $succmsg]);
        else
            $CI->session->set_flashdata(['title' => 'Error ! ', 'notify' => 'danger', 'message' => $failmsg]);
        
        return redirect($redirect);
    }
}

if ( ! function_exists('auth'))
{
    function auth()
    {
        $CI =& get_instance();
        
        return (object) $CI->user;
    }
}

if ( ! function_exists('check_ajax'))
{
    function check_ajax()
    {
        $CI =& get_instance();
        if (!$CI->input->is_ajax_request())
            die;
    }
}

if ( ! function_exists('front_url'))
{
    function front_url($url)
    {
        return base_url("$url.html");
    }
}

if ( ! function_exists('make_slug'))
{
    function make_slug($url)
    {
        $url = trim($url);
        return front_url(strtolower(str_replace(' ', '-', $url)));
    }
}

if ( ! function_exists('send_sms'))
{
    function send_sms($contact, $sms, $template)
    {
        if($_SERVER['HTTP_HOST'] != 'localhost'){
            $from = 'NJWELR';
            $key = '26156BF776CD9A';
    
            $url = "key=".$key."&campaign=12397&routeid=7&type=text&contacts=".$contact."&senderid=".$from."&msg=".urlencode($sms)."&template_id=".$template;
    
            $base_URL = 'http://denseteklearning.com/app/smsapi/index?'.$url;
    
            $curl_handle = curl_init();
            curl_setopt($curl_handle,CURLOPT_URL,$base_URL);
            curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
            curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
            $result = curl_exec($curl_handle);
            curl_close($curl_handle);
            return $result;
        }
    }
}

if ( ! function_exists('send_email'))
{
    function send_email($email, $message, $subject, $file=null)
	{
        if($_SERVER['HTTP_HOST'] != 'localhost'){
            $CI =& get_instance();
            $CI->load->library('email');
            $CI->email->clear(TRUE);
            $CI->email->set_newline("\r\n");
            $CI->email->from($CI->config->item('email_support'), APP_NAME);
            $CI->email->to($email);
            $CI->email->subject($subject);
            $CI->email->message($message);
            if ($file)
                $CI->email->attach($_SERVER['DOCUMENT_ROOT'] . str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]).$file);
            
            $CI->email->send();
        }
	}
}