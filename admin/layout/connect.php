<?php
date_default_timezone_set('Asia/Kolkata');
$db_user = $_SERVER['HTTP_HOST'] != 'localhost' ? 'nandish' : 'root';
$db_pass = $_SERVER['HTTP_HOST'] != 'localhost' ? 'c?T4mAs*.3+.' : '';
$db = $_SERVER['HTTP_HOST'] != 'localhost' ? 'denseeqq_nandish' : 'nandish';

$connect = mysqli_connect("localhost", $db_user, $db_pass, $db) or die("database is not connected");

function re($array='')
{
	echo "<pre>";
    print_r($array);
    exit;
}

function base_url($url='')
{
	$root = (isset($_SERVER["HTTPS"]) ? "https://" : "http://").$_SERVER["HTTP_HOST"];
	$root .= str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
	$url = str_replace('+', '-', $url);
	return $root.$url;
}

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