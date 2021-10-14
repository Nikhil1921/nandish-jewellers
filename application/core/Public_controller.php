<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Public_controller extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
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
}