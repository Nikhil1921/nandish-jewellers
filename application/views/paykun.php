<?php 
require_once "vendor/autoload.php";
use Paykun\Checkout\Payment;
/*creds for sandbox : nandish.jewellers@gmail.com pass - O0PTJwaV*/
$paykun = new Payment('638730950659186', '78CF6023896CCAFC4970B4F85567E8E0', '6690D5E74A29145ED7B9302F1C912DAF', false);
/*end sandbox*/

/*creds for live : nandish.jewellers@gmail.com pass - Nandish@12345*/
// $paykun = new Payment('027005431694377', 'E67088A8936CD7F9B6FE0156CE0DFFD4', '6FAB93660DFE1052B2BB3949B1389923', true);
/*end live*/