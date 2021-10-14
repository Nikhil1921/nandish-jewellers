<?php defined('BASEPATH') OR exit('No direct script access allowed');


$config = Array(

  'protocol' => 'smtp',

  'smtp_host' => 'mail.nandish.in',

  'smtp_port' => 587,

  'smtp_user' => get_instance()->config->item('email_support'),

  'smtp_pass' => 'Nandish@1234',

  'mailtype' => 'html',

  'charset' => 'iso-8859-1',

  'wordwrap' => TRUE

);