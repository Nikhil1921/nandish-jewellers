<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Public_controller extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		// return redirect('maintainance');
		$this->load->model('main_model', 'main');
		$this->user_id = $this->session->user_id;
		if ($this->user_id) {
			$this->user = $this->main->get('user', 'u_f_name, u_m_name, u_l_name, u_mobile, u_email, u_address, u_city, u_state, u_postcode, u_pancard', ['u_id' => $this->user_id]);
			$this->cart = $this->main->getCart($this->user_id);
			$this->wishlist = $this->main->getWishlist($this->user_id);
		}else{
			$this->user = [];
			$this->cart = [];
			$this->wishlist = [];
		}
	}

	public function check_pincode($pin)
	{
		require_once APPPATH . 'third_party/DebugSoapClient.php';
		
		$soap = new DebugSoapClient('http://netconnect.bluedart.com/Ver1.10/ShippingAPI/Finder/ServiceFinderQuery.svc?wsdl',
				[
                    'trace' 	   => 1,  
                    'style'		   => SOAP_DOCUMENT,
                    'use'		   => SOAP_LITERAL,
                    'soap_version' => SOAP_1_2
                ]);
				
		$soap->__setLocation("http://netconnect.bluedart.com/Ver1.10/ShippingAPI/Finder/ServiceFinderQuery.svc");

		$soap->sendRequest = true;
		$soap->printRequest = false;
		$soap->formatXML = true;

		$actionHeader = new SoapHeader('http://www.w3.org/2005/08/addressing','Action','http://tempuri.org/IServiceFinderQuery/GetServicesforPincode',true);
		$soap->__setSoapHeaders($actionHeader);

		$params = [
						'pinCode' => $pin,
						'profile' => [
										'Api_type' => 'S',
										'LicenceKey'=>'qmifmqgkpudkoqmmqers3ukj1tjrgqso',
										'LoginID'=>'GDL53336',
										'Version'=>'1.3'
									]
					];

		$result = $soap->__soapCall('GetServicesforPincode', [$params]);
		
		if ($result && $result->GetServicesforPincodeResult->IsError === true) {
			die(json_encode(['error' => true, 'message' => $result->GetServicesforPincodeResult->ErrorMessage]));	
		}else{
			return true;
		}
	}
}