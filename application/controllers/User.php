<?php defined('BASEPATH') OR exit('No direct script access allowed');
// use Paykun\Checkout\Payment;
use Razorpay\Api\Api;

class User extends Public_controller  {

    public function __construct()
	{
		parent::__construct();
		$this->config->load('sms');
		if (!$this->user_id) 
            return redirect('');
	}

	private $table = 'user';

	public function my_account()
	{
		$data['name'] = 'my_account';
		$data['title'] = 'my account';
		$data['breadcrumb'] = 'my account';
		$data['orders'] = $this->main->getall('orders', 'o_id, o_date, o_time, o_status, o_total, o_return', ['o_u_id' => $this->user_id]);
        
		return $this->template->load('template', 'my_account', $data);
	}

	public function invoice($id)
	{
		$data['name'] = 'invoice';
		$data['title'] = 'invoice';
		$data['data'] = $this->main->get('orders', 'o_invoice, o_address, o_city, o_state, o_country, o_pancard, o_details, o_id, o_date, o_time, o_status, o_total', ['o_id' => d_id($id)]);
        
		return $this->load->view('invoice', $data);
	}

	public function update_profile()
	{
		check_ajax();
		if ($this->main->check($this->table, ['u_id != ' => $this->user_id, 'u_mobile' => $this->input->post('mobile')], 'u_id'))
			die(json_encode(['error' => true, 'message' => "Mobile already registered."]));
		
		if ($this->main->check($this->table, ['u_id != ' => $this->user_id, 'u_email' => $this->input->post('email')], 'u_id'))
			die(json_encode(['error' => true, 'message' => "Email already registered."]));

		$post = [
					'u_f_name' 	=> $this->input->post('fname'),
					'u_m_name' 	=> $this->input->post('mname'),
					'u_l_name' 	=> $this->input->post('lname'),
					'u_email'  	=> $this->input->post('email'),
					'u_mobile' 	=> $this->input->post('mobile'),
					'u_address' => $this->input->post('address')
				];

		$this->input->post('password') ? $post['u_password'] = my_crypt($this->input->post('password')) : '';
		
		if ($this->main->update(['u_id' => $this->user_id], $post, $this->table))
			$response = ['error' => false, 'message' => "Profile updated."];
		else
			$response = ['error' => true, 'message' => "Profile not updated."];

		die(json_encode($response));
	}

	public function cancel()
	{
		check_ajax();
		
		if ($this->main->update(['o_id' => d_id($this->input->post('order_id'))], ['o_status' => 3], 'orders'))
			$response = ['error' => false, 'message' => "Order cancel success."];
		else
			$response = ['error' => true, 'message' => "Order cancel not success."];

		die(json_encode($response));
	}

	public function return()
	{
		check_ajax();
		
		if ($this->main->update(['o_id' => d_id($this->input->post('order_id'))], ['o_return' => 1], 'orders'))
			$response = ['error' => false, 'message' => "Order return success."];
		else
			$response = ['error' => true, 'message' => "Order return not success."];

		die(json_encode($response));
	}

	public function wishlist()
	{
		$data['name'] = 'wishlist';
		$data['title'] = 'wishlist';
		$data['breadcrumb'] = 'wishlist';
        
		return $this->template->load('template', 'wishlist', $data);
	}

	public function cart()
	{
		$data['name'] = 'cart';
		$data['title'] = 'cart';
		$data['breadcrumb'] = 'cart';
        
		return $this->template->load('template', 'cart', $data);
	}

	public function checkout()
	{
		if(!$this->cart) return redirect('');
		
		$data['name'] = 'checkout';
		$data['title'] = 'checkout';
		$data['breadcrumb'] = ["<a href='".front_url("cart")."'>Cart</a>", 'checkout'];
        
		return $this->template->load('template', 'checkout', $data);
	}

	public function update_cart()
	{
		check_ajax();
		
		$p_id = d_id($this->input->post('p_id'));
		$cart_id = d_id($this->input->post('cart_id'));
		$cart = $this->main->get('cart', 'ca_id, ca_pro_id', ['ca_id' => $cart_id]);
		if ($cart):
			$qty = $this->input->post('qty') ? $this->input->post('qty') : 1;
			$p_id = $cart['ca_pro_id'];
			$cart = (object) $this->main->get('product', 'p_qty_avail, p_name', ['p_id' => $p_id]);

			if ($cart):
				if ($cart->p_qty_avail >= $qty):
					if ($this->main->update(['ca_id' => $cart_id], ['ca_qty' => $qty], 'cart'))
						$response = ['error' => false, 'message' => "Cart updated."];
					else
						$response = ['error' => true, 'message' => "Cart not updated."];
				else:
					$response = ['error' => true, 'message' => "Only $cart->p_qty_avail $cart->p_name available."];
				endif;
			else:
				$response = ['error' => true, 'message' => "Jewellery not available."];
			endif;
		else:
			$response = ['error' => true, 'message' => "Jewellery not in cart list."];
		endif;

		die(json_encode($response));
	}

	public function cart_delete()
	{
		check_ajax();
		
		if ($this->main->delete('cart', ['ca_id' => d_id($this->input->post('cart_id'))]))
			$response = ['error' => false, 'message' => "Jewellery removed from cart."];
		else
			$response = ['error' => true, 'message' => "Jewellery not removed from cart."];

		die(json_encode($response));
	}

	public function wish_delete()
	{
		check_ajax();
		
		if ($this->main->delete('wish', ['w_id' => d_id($this->input->post('cart_id'))]))
			$response = ['error' => false, 'message' => "Jewellery removed from wishlist."];
		else
			$response = ['error' => true, 'message' => "Jewellery not removed from wishlist."];

		die(json_encode($response));
	}

	public function check_code()
	{
		check_ajax();
		
		if ($this->input->post('coupen_code')) {
			$check = $this->main->get('code', 'co_par, co_id', ['co_code' => $this->input->post('coupen_code'), 'co_status' => 0]);
			
			if (!$check) {
				$response = ['error' => true, 'message' => 'Invalid coupen code.'];
			}else{
				$this->session->set_userdata('coupen_id', $check['co_id']);
				$this->session->set_userdata('discount', $check['co_par']);
				$this->session->set_userdata('coupen_code', $this->input->post('coupen_code'));
				$response = ['error' => false, 'message' => 'Coupen code applied.', 'redirect' => front_url('checkout')];
			}
		}else{
			$response = ['error' => true, 'message' => 'Enter coupen code.'];
		}

		die(json_encode($response));
	}

	public function checkout_post()
	{
		if (!$this->input->is_ajax_request()) die;

		$post = [
			'u_address'  => $this->input->post('address'),
			'u_city' 	 => $this->input->post('city'),
			'u_state' 	 => $this->input->post('state'),
			'u_postcode' => $this->input->post('pin'),
			'u_pancard'  => $this->input->post('pancard') ? $this->input->post('pancard') : 'NA'
		];

		$ship = $total = 0;

		foreach ($this->cart as $cart) {
			$makec = $cart['p_l_char'];
			if ($this->session->coupen_id):
			$makec = $makec * (100 - $this->session->discount) / 100;
			endif;
			$ship += round($cart['p_shipping'] * 1.03);
			$total += round(($cart[$cart['p_carat']] * $cart['p_gram'] + $cart['p_other'] + $makec) * $cart['ca_qty'] * 1.03);
		}
		
		// $total = 1000;
		$update = $this->main->update(['u_id' => $this->user_id], $post, $this->table);

		// razorpay payment gateway start
		$name = $this->user['u_f_name'].' '.$this->user['u_m_name'].' '.$this->user['u_l_name'];
		$response = $update ? ['error' => false, 'message' => ($total + $ship), 'name' => $name, 'mobile' => $this->user['u_mobile'], 'email' => $this->user['u_email']] 
							: ['error' => true, 'message' => "NOT OK"];
		die(json_encode($response));
		
		// razorpay payment gateway end

		// paykun payment gateway start
		/* $paykun = new Payment($this->config->item('merchant_id'), $this->config->item('access_token'), $this->config->item('api_key'), PAYMENT);
		$this->load->helper('string');

        // Initializing Order
        $paykun->initOrder(random_string('numeric', 16), $this->user['u_f_name'].' '.$this->user['u_m_name'].' '.$this->user['u_l_name'], $total + $ship, front_url('payment'), front_url('payment'), 'INR');
        // Add Customer
        $paykun->addCustomer($this->user['u_f_name'].' '.$this->user['u_m_name'].' '.$this->user['u_l_name'], $this->user['u_email'], $this->user['u_mobile']);
         
        // Add Shipping address
        $paykun->addShippingAddress('India', $post['u_state'], $post['u_city'], $post['u_postcode'], $post['u_address']);
         
        // Add Billing Address
        $paykun->addBillingAddress('India', $post['u_state'], $post['u_city'], $post['u_postcode'], $post['u_address']);
        $paykun->setCustomFields(array('udf_1' => $this->input->post('note') ? $this->input->post('note').'-' : 'NA-'));
        
        echo $paykun->submit(); */
		// paykun payment gateway end
	}

	public function save_order()
	{
		if (!$this->input->is_ajax_request()) die;

		$payment_id = $this->input->post('payment_id');
		$api = new Api($this->config->item('api_key'), $this->config->item('api_secret'));
		$response = $api->payment->fetch($payment_id);
		
		if (!empty($response) && $response->status == 'authorized') {
			if(!$this->main->check('orders', ['o_payment' => $payment_id], 'o_payment')):
				$total = 0;
				foreach ($this->cart as $k => $v):
					$details[$k]['prod_id'] = $v['ca_pro_id'];
					$details[$k]['qty'] = $v['ca_qty'];
					$details[$k]['price'] = round($v[$v['p_carat']] * $v['p_gram']);
					$details[$k]['size'] = ($v['ca_size']) ? $v['ca_size'] : 'NA';
					$details[$k]['shipping'] = round($v['p_shipping'] * 1.03);
					$makec = $v['p_l_char'];
					if (isset($this->session->coupen_id)):
						$makec = $makec * (100 - $this->session->discount) / 100;
					endif;
					$makec = round($makec);
					$details[$k]['other'] = $v['p_other'];
					$details[$k]['making'] = $makec;
					$details[$k]['total'] = round(($v[$v['p_carat']] * $v['p_gram'] + $v['p_other'] + $makec) * $v['ca_qty'] * 1.03);
					$details[$k]['pre'] = $v['p_pre'];
					$total += round(($v[$v['p_carat']] * $v['p_gram'] + $v['p_other'] + $makec) * $v['ca_qty'] * 1.03);
					$total += round($v['p_shipping'] * 1.03);
				endforeach;
				$order = [
					'o_details' => json_encode($details),
					'o_u_id' 	=> $this->user_id,
					'o_total'	=> $total,
					'o_date'	=> date('d-m-Y', $response->created_at),
					'o_time'	=> date('h:i:s A', $response->created_at),
					'o_address'	=> $this->user['u_address'],
					'o_city'	=> $this->user['u_city'],
					'o_state'	=> $this->user['u_state'],
					'o_country'	=> "India",
					'o_pin'		=> $this->user['u_postcode'],
					'o_note'	=> $this->input->post('note'),
					'o_status'	=> 0,
					'o_invoice'	=> 'NAD'.rand(1000,9999),
					'o_return'	=> 0,
					'o_payment'	=> $payment_id,
					'o_pancard' => $this->user['u_pancard']
				];
				$status = $this->main->saveOrder($order, $this->cart, $this->user['u_mobile']);
				$response = $status ? ['error' => false, 'message' => "Order saved success.", 'redirect' => "payment-status/$payment_id"] : ['error' => true, 'message' => "Something going wrong. Try again."];
			else:
				$response = ['error' => false, 'message' => "Order saved success."];
			endif;
		}else
			$response = ['error' => true, 'message' => "Something going wrong. Try againss."];
		
		die(json_encode($response));
	}

	public function payment_status($pay_id)
	{
		$api = new Api($this->config->item('api_key'), $this->config->item('api_secret'));
		$response = $api->payment->fetch($pay_id);
		
		if ($response) {
			$data['name'] = 'payment';
			$data['title'] = 'payment details';
			$data['breadcrumb'] = 'payment details';
			$data['data'] = $response;
			
			return $this->template->load('template', 'razor_pay', $data);
		}else{
			return $this->error_404();
		}
	}
	/* public function payment()
	{
		$payment_id = $this->input->get('payment-id');
		$paykun = new Payment($this->config->item('merchant_id'), $this->config->item('access_token'), $this->config->item('api_key'), PAYMENT);
		$response = $paykun->getTransactionInfo($payment_id);
		
		if(is_array($response) && !empty($response) && $response['status'] && $response['data']['transaction']['status'] == "Success"):
			if(!$this->main->check('orders', ['o_payment' => $payment_id], 'o_payment')):
				$total = 0;
				foreach ($this->cart as $k => $v):
					$details[$k]['prod_id'] = $v['ca_pro_id'];
					$details[$k]['qty'] = $v['ca_qty'];
					$details[$k]['price'] = round($v[$v['p_carat']] * $v['p_gram']);
					$details[$k]['size'] = ($v['ca_size']) ? $v['ca_size'] : 'NA';
					$details[$k]['shipping'] = round($v['p_shipping'] * 1.03);
					$makec = $v['p_l_char'];
					if (isset($this->session->coupen_id)):
						$makec = $makec * (100 - $this->session->discount) / 100;
					endif;
					$makec = round($makec);
					$details[$k]['other'] = $v['p_other'];
					$details[$k]['making'] = $makec;
					$details[$k]['total'] = round(($v[$v['p_carat']] * $v['p_gram'] + $v['p_other'] + $makec) * $v['ca_qty'] * 1.03);
					$details[$k]['pre'] = $v['p_pre'];
					$total += round(($v[$v['p_carat']] * $v['p_gram'] + $v['p_other'] + $makec) * $v['ca_qty'] * 1.03);
					$total += round($v['p_shipping'] * 1.03);
				endforeach;
				$post = $response['data']['transaction'];
				$order = [
					'o_details' => json_encode($details),
					'o_u_id' 	=> $this->user_id,
					'o_total'	=> $total,
					'o_date'	=> date('d-m-Y', $post['date']),
					'o_time'	=> date('h:i:s A', $post['date']),
					'o_address'	=> $this->user['u_address'],
					'o_city'	=> $this->user['u_city'],
					'o_state'	=> $this->user['u_state'],
					'o_country'	=> "India",
					'o_pin'		=> $this->user['u_postcode'],
					'o_note'	=> $post['custom_field_1'],
					'o_status'	=> 0,
					'o_invoice'	=> 'NAD'.rand(1000,9999),
					'o_return'	=> 0,
					'o_payment'	=> $payment_id,
					'o_pancard' => $this->user['u_pancard']
				];
				$this->main->saveOrder($order, $this->cart, $this->user['u_mobile']);
			endif;
		endif;
		if ($response) {
			$data['name'] = 'payment';
			$data['title'] = 'payment details';
			$data['breadcrumb'] = 'payment details';
			$data['data'] = $response;
			
			return $this->template->load('template', 'payment', $data);
		}else{
			return $this->error_404();
		}
	} */

	public function logout()
	{
		session_destroy();
		return redirect('login-register');
	}
}