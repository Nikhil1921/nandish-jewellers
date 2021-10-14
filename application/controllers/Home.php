<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_controller  {

	public function index()
	{
		if($this->input->get('search'))
			return $this->product_list();
		$data['name'] = 'home';
		$data['title'] = 'home';
		$data['banners'] = $this->main->getall('banner', 'b_image', ['b_cat_id' => 0], 'b_id DESC');
		$data['testimonials'] = $this->main->getall('testimonial', 't_image, t_name, t_detail', []);
		$data['new_prods'] = $this->main->getNewProds();
		// $data['innerCats'] = $this->main->getInners();
		
		$data['cats'] = array_map(function($arr){
					return (object) [
							'c_id' => $arr->c_id,
							'c_name' => $arr->c_name,
							'best' => $this->main->getBestProds($arr->c_id),
							'sub_cats' => array_map(function($arr){
								return (object) [
									'sc_id' => $arr->sc_id,
									'sc_name' => $arr->sc_name,
									'inner_cats' => (object) $this->main->getall('innercategory', 'i_id, i_name, i_image, i_show', ['i_sub_id' => $arr->sc_id])
								];
							}, $this->main->getall('subcategory', 'sc_id, sc_name', ['sc_c_id' => $arr->c_id]))
						];
				}, $this->main->getall('category', 'c_id, c_name', []));
		
        return $this->template->load('template', 'home', $data);
	}
	
	public function about_us()
	{
		$data['name'] = 'about_us';
		$data['title'] = 'about us';
		$data['breadcrumb'] = true;
        
		return $this->template->load('template', 'about_us', $data);
	}
	
	public function contact_us()
	{
		$data['name'] = 'contact_us';
		$data['title'] = 'contact us';
		$data['breadcrumb'] = true;
        
		return $this->template->load('template', 'contact_us', $data);
	}
	
	public function privacy()
	{
		$data['name'] = 'privacy';
		$data['title'] = 'privacy policy';
		$data['breadcrumb'] = true;
		$data['data'] = $this->main->get('page', 'details', ['p_page' => 'privacy']);
        
		return $this->template->load('template', 'page', $data);
	}
	
	public function terms()
	{
		$data['name'] = 'terms';
		$data['title'] = 'Terms & Conditions';
		$data['breadcrumb'] = true;
		$data['data'] = $this->main->get('page', 'details', ['p_page' => 'terms']);
        
		return $this->template->load('template', 'page', $data);
	}
	
	public function refund()
	{
		$data['name'] = 'refund';
		$data['title'] = 'Exchange, Returns & Refunds';
		$data['breadcrumb'] = true;
		$data['data'] = $this->main->get('page', 'details', ['p_page' => 'refund']);
        
		return $this->template->load('template', 'page', $data);
	}
	
	public function product_list($cat='', $subcat='', $inner='')
	{
		$this->load->library('pagination');
		
		$data['name'] = 'shop';
		
		$data['cats'] = array_map(function($arr){
					return (object) [
							'c_id' => $arr->c_id,
							'c_name' => $arr->c_name,
							'sub_cats' => array_map(function($arr){
								return (object) [
									'sc_id' => $arr->sc_id,
									'sc_name' => $arr->sc_name,
									'inner_cats' => (object) $this->main->getall('innercategory', 'i_id, i_name, i_image, i_show', ['i_sub_id' => $arr->sc_id])
								];
							}, $this->main->getall('subcategory', 'sc_id, sc_name', ['sc_c_id' => $arr->c_id]))
						];
				}, $this->main->getall('category', 'c_id, c_name', []));
				
		$url = base_url();
		$where = ['p_qty_avail >' => 0];
		
		if ($cat){
			$url .= "/$cat";
			$where['c_name'] = str_replace('-', ' ', $cat);
		}

		if ($subcat){
			$url .= "/$subcat";
			$where['sc_name'] = str_replace('-', ' ', $subcat);
		}

		if ($inner){
			$url .= "/$inner";
			$where['i_name'] = str_replace('-', ' ', $inner);
			$inn_id = $this->main->check('innercategory', ['i_name' => str_replace('-', ' ', $inner)], 'i_id');
			if($inn_id) $data['banners'] = $this->main->getall('banner', 'b_image', ['b_cat_id' => $inn_id], 'b_id DESC');
		}

		foreach ($this->input->get() as $k => $get) {
			if ($k == 'per_page') continue;
			$url .= array_key_first($this->input->get()) == $k ? "?" : "&";
			$url .= "$k=$get";
		}
		
		$config = [
			'base_url' => $url,
			'total_rows' => $this->main->products_all_count($where),
			'per_page' => 12,
			'enable_query_strings' => true,
			'page_query_string' => true,
			'use_page_numbers' => true,
			'full_tag_open' => '<ul class="pagination-box">',
			'full_tag_close' => '</ul>',
			'first_link' => 'First',
			'last_link' => 'Last',
			'first_tag_open' => '<li>',
			'first_tag_close' => '</li>',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'next_link' => '<i class="pe-7s-angle-right"></i>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'prev_link' => '<i class="pe-7s-angle-left"></i>',
			'cur_tag_open' => '<li class="active"><a href="javascript:void(0)">',
			'cur_tag_close' => '</a></li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>'
		];

		$this->pagination->initialize($config);
		$offset = $this->input->get('per_page') ? ($this->input->get('per_page') - 1) * $config['per_page'] : 0;
		$data['prods'] = $this->main->products_list($where, $offset, $config['per_page']);
		$data['total'] = $config['total_rows'];
		$data['from'] = $offset + 1;
		$data['to'] = $offset + $config['per_page'] <= $config['total_rows'] ? $offset + $config['per_page'] : $config['total_rows'];
		$data['title'] = $data['prods'] && $data['prods'][0]['seo_title'] ? $data['prods'][0]['seo_title'] : 'shop';
		
		return $this->template->load('template', 'product_list', $data);
	}
	
	public function product($cat, $subcat, $inner, $prod)
	{
		$prod = explode('-', $prod);
		$prod = end($prod);
		$data['name'] = 'product';
		$data['breadcrumb'] = true;
		$data['data'] = $this->main->prod(d_id($prod));
		
		if ($data['data']){
			$img = explode(',', $data['data']['p_image']);
			$data['seo'] = [
				'title' => $data['data']['seo_title'],
				'desc' => $data['data']['seo_description'],
				'image' => base_url('admin/image/product/'.reset($img)),
				'url' => current_url(),
				'keywords' => $data['data']['seo_keywords']
			];
		}

		$data['related'] = $this->main->getRelatedProds(str_replace('-', ' ', $inner), d_id($prod));
		
		$data['title'] = ["<a href='".make_slug($cat."/".$subcat."/".$inner)."'>".str_replace('-', ' ', $inner)."</a>", 'Jewellery Details'];
		return $this->template->load('template', 'prod', $data);
	}
	
	public function prod_info()
	{
		check_ajax();
        $data['data'] = $this->main->prod(d_id($this->input->get('p_id')));
		return $this->load->view('prod_info', $data);
	}
	
	public function login()
	{
		if ($this->session->user_id)
            return redirect('my-account');
		$data['name'] = 'login';
		$data['title'] = 'login OR Register';
		$data['breadcrumb'] = true;
        
		return $this->template->load('template', 'login', $data);
	}

	public function login_post()
	{
		check_ajax();
		$this->form_validation->set_rules('mobile', 'Mobile', 'required|exact_length[10]|is_natural', [
                'required' => "%s is Required",
                'exact_length' => "%s is invalid",
				'is_unique' => "%s already in use",
                'is_natural' => "%s is invalid"
            ]);
		$this->form_validation->set_rules('password', 'Password', 'required|max_length[200]', [
                'required' => "%s is Required",
                'max_length' => "Max 200 characters allowed for %s",
            ]);
		if ($this->form_validation->run() == FALSE)
			$response = [
				'message' => str_replace("*", "", strip_tags(validation_errors())),
				'error' => true
			];
		else{
			$post = [
					'u_mobile'   => $this->input->post('mobile'),
					'u_password' => my_crypt($this->input->post('password'))
				];
				
			if ($u_id = $this->main->check("user", $post, 'u_id')){
				$this->session->set_userdata('user_id', $u_id);
				$response = [
					'message' => "Login successfull.",
					'redirect' => front_url('my-account'),
					'error' => false
				];
			}
			else
				$response = [
					'message' => "Login not successfull. Try again.",
					'error' => true
				];
		}
		
		die(json_encode($response));
	}
	
	public function signup()
	{
		check_ajax();

		$this->form_validation->set_rules($this->signup);
		
		if ($this->form_validation->run() == FALSE)
			$response = [
				'message' => str_replace("*", "", strip_tags(validation_errors())),
				'error' => true
			];
		else{
			$post = [
					'u_f_name'   => $this->input->post('fname'),
					'u_m_name'   => $this->input->post('mname'),
					'u_l_name'   => $this->input->post('lname'),
					'u_email'    => $this->input->post('email'),
					'u_mobile'   => $this->session->verified,
					'u_password' => my_crypt($this->input->post('password'))
				];
				
			if ($u_id = $this->main->add($post, "user")){
				$this->session->set_userdata('user_id', $u_id);
				$sms = $this->config->item('Singup_SMS');
				send_sms($post['u_mobile'], $sms, $this->config->item('Singup_TEMPLATE'));
				send_email($post['u_email'], $sms, "Signup successfull");

				$response = [
					'message' => "Signup successfull.",
					'redirect' => front_url('my-account'),
					'error' => false
				];
			}
			else
				$response = [
					'message' => "Signup not successfull. Try again.",
					'error' => true
				];
		}
		
		die(json_encode($response));
	}

	public function add_cart()
	{
		check_ajax();
		if(!$this->user_id) die(json_encode(['error' => true, 'message' => "Please login first"]));
		
		$qty = $this->input->post('qty') ? $this->input->post('qty') : 1;
		$p_id = d_id($this->input->post('p_id'));
		$page =  $this->input->post('page');

		$pro_data = $this->main->get('product', 'p_qty_avail, p_name, p_size, p_pre', ['p_id' => $p_id]);
		if ($pro_data):
			$pro_data = (object) $pro_data;
			if ($pro_data->p_qty_avail >= $qty):
				$ca_size = $this->input->post('ca_size') ? $this->input->post('ca_size') : $pro_data->p_size;
				$ca_pre_order = $pro_data->p_pre;
				// $ca_pre_order = (isset($this->input->post('ca_size')) && $this->input->post('ca_size')) ? 1 : 0;
				$cart = $this->main->get('cart', '*', ['ca_u_id' => $this->user_id, 'ca_pro_id' => $p_id]);
				if($cart):
					$response = ['error' => true, 'message' => "This Jewellery Is Alredy In Cart."];
				else:
					$post = [
						'ca_u_id' => $this->user_id,
						'ca_pro_id' => $p_id,
						'ca_qty' => $qty,
						'ca_size' => $ca_size,
						'ca_pre_order' => $ca_pre_order
					];
					
					if ($this->main->add($post, 'cart'))
						$response = ['error' => false, 'message' => "Add to cart successful."];
					else
						$response = ['error' => true, 'message' => "Error while adding to cart."];
				endif;
			else:
				$response = ['error' => true, 'message' => "Only $pro_data->p_qty_avail $pro_data->p_name available."];
			endif;
		else:
			$response = ['error' => true, 'message' => "Jewellery not available."];
		endif;

		die(json_encode($response));
	}

	public function add_wishlist()
	{
		check_ajax();
		if(!$this->user_id) die(json_encode(['error' => true, 'message' => "Please login first"]));

		$p_id = d_id($this->input->post('p_id'));
		$cart = $this->main->get('wish', '*', ['w_u_id' => $this->user_id, 'w_p_id' => $p_id]);
		if($cart)
		{
			$response = ['error' => true, 'message' => "This Jewellery Is Alredy In Wishlist."];
		}
		else
		{
			$post = [
				'w_u_id' => $this->user_id,
				'w_p_id' => $p_id
			];
			
			if ($this->main->add($post, 'wish'))
				$response = ['error' => false, 'message' => "Add Wish List Successfully."];
			else
				$response = ['error' => true, 'message' => "Add Wish List Not successfully."];
		}

		die(json_encode($response));
	}

	public function otp()
	{
		check_ajax();
		
		if ($this->input->post('action') === 'check_otp') {
			$this->form_validation->set_rules('otp', 'OTP', 'required|exact_length[6]|is_natural', [
                'required' => "%s is Required",
                'exact_length' => "%s is invalid",
                'is_natural' => "%s is invalid"
            ]);
			if ($this->form_validation->run() == FALSE){
				$response = [
					'message' => str_replace("*", "", strip_tags(validation_errors())),
					'error' => true
				];
			}else{
				$post = [
							'mobile' 	 => $this->session->mobile_check,
							'otp'    	 => $this->input->post('otp'),
							'expiry <= ' => date('Y-m-d H:i:s', strtotime('+5 minutes'))
						];
				
				if ($this->main->check('otp_check', $post, 'mobile') && $this->main->delete('otp_check', $post)) {
					$this->session->set_tempdata('verified', $post['mobile'], 60 * 5);
					$response = ['error' => false, 'message' => "OTP check successfully.", 'redirect' => front_url('login-register')];
				}
				else
					$response = ['error' => true, 'message' => "Invalid OTP. Try again"];
			}
		}else{
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|exact_length[10]|is_natural|is_unique[user.u_mobile]', [
                'required' => "%s is Required",
                'exact_length' => "%s is invalid",
				'is_unique' => "%s already in use",
                'is_natural' => "%s is invalid"
            ]);

			if ($this->form_validation->run() == FALSE)
				$response = [
					'message' => str_replace("*", "", strip_tags(validation_errors())),
					'error' => true
				];
			else{
				$post = [
						'mobile' => $this->input->post('mobile'),
						'otp'    => rand(100000, 999999),
						'expiry' => date('Y-m-d H:i:s', strtotime('+5 minutes'))
					];

				$id = $this->main->check('otp_check', ['mobile' => $post['mobile']], 'mobile') ? 
					$this->main->update(['mobile' => $post['mobile']], $post, 'otp_check') : 
					$this->main->add($post, 'otp_check');
				
				if ($id){
					$this->config->load('sms');

					$sms = str_ireplace('{#var#}', $post['otp'], $this->config->item('OTP_SMS'));
					send_sms($post['mobile'], $sms, $this->config->item('OTP_TEMPLATE'));
					
					$this->session->set_tempdata('mobile_check', $post['mobile'], 60 * 5);
					$response = ['error' => false, 'message' => "OTP sent successfully.", 'redirect' => front_url('login-register')];
				}
				else
					$response = ['error' => true, 'message' => "OTP not sent. Try again"];
			}
		}

		die(json_encode($response));
	}

	public function forgot_password()
	{
		if (! $this->input->is_ajax_request()){
			$data['name'] = 'forgot_password';
			$data['title'] = 'forgot password';
			$data['breadcrumb'] = true;
	
			return $this->template->load('template', 'forgot_password', $data);
		}else{
			if ($this->input->post('action') === 'check_otp') {
				$this->form_validation->set_rules('otp', 'OTP', 'required|exact_length[6]|is_natural', [
					'required' => "%s is Required",
					'exact_length' => "%s is invalid",
					'is_natural' => "%s is invalid"
				]);
				if ($this->form_validation->run() == FALSE)
					$response = [
						'message' => str_replace("*", "", strip_tags(validation_errors())),
						'error' => true
					];
				else{
					$post = [
							'mobile' 	 => $this->session->mobile_forgot,
							'otp'    	 => $this->input->post('otp'),
							'expiry <= ' => date('Y-m-d H:i:s', strtotime('+5 minutes'))
						];
				
					if ($this->main->check('otp_check', $post, 'mobile') && $this->main->delete('otp_check', $post)) {
						$this->session->set_tempdata('changePassword', $post['mobile'], 60 * 5);
						$response = ['error' => false, 'message' => "OTP check successfully.", 'redirect' => front_url('forgot-password')];
					}
					else
						$response = ['error' => true, 'message' => "Invalid OTP. Try again"];
				}
			}else{
				$this->form_validation->set_rules('mobile', 'Mobile', 'required|exact_length[10]|is_natural', [
					'required' => "%s is Required",
					'exact_length' => "%s is invalid",
					'is_natural' => "%s is invalid"
				]);
	
				if ($this->form_validation->run() == FALSE)
					$response = [
						'message' => str_replace("*", "", strip_tags(validation_errors())),
						'error' => true
					];
				else{
					if(!$this->main->check('user', ['u_mobile' => $this->input->post('mobile')], 'u_id')) 
						die(json_encode(['error' => true, 'message' => "Mobile not registered."]));
	
					$post = [
							'mobile' => $this->input->post('mobile'),
							'otp'    => rand(100000, 999999),
							'expiry' => date('Y-m-d H:i:s', strtotime('+5 minutes'))
						];
	
					$id = $this->main->check('otp_check', ['mobile' => $post['mobile']], 'mobile') ? 
						$this->main->update(['mobile' => $post['mobile']], $post, 'otp_check') : 
						$this->main->add($post, 'otp_check');
					
					if ($id){
						$this->config->load('sms');
	
						$sms = str_ireplace('{#var#}', $post['otp'], $this->config->item('OTP_SMS'));
						send_sms($post['mobile'], $sms, $this->config->item('OTP_TEMPLATE'));
						
						$this->session->set_tempdata('mobile_forgot', $post['mobile'], 60 * 5);
						$response = ['error' => false, 'message' => "OTP sent successfully.", 'redirect' => front_url('forgot-password')];
					}
					else
						$response = ['error' => true, 'message' => "OTP not sent. Try again"];
				}
			}
			
			die(json_encode($response));
		}
	}

	public function change_password()
	{
		check_ajax();

		$this->form_validation->set_rules('password', 'Password', 'required|max_length[200]', [
					'required' => "%s is Required",
                	'max_length' => "Max 200 characters allowed for %s",
				]);
		
		if ($this->form_validation->run() == FALSE)
			$response = [
				'message' => str_replace("*", "", strip_tags(validation_errors())),
				'error' => true
			];
		else{
			$post = [ 'u_password' => my_crypt($this->input->post('password')) ];
				
			if ($this->main->update(['u_mobile' => $this->session->changePassword], $post, "user")){
				session_destroy();
				$response = [
					'message' => "Password changed.",
					'redirect' => front_url('login-register'),
					'error' => false
				];
			}
			else
				$response = [
					'message' => "Password not changed. Try again.",
					'error' => true
				];
		}
		
		die(json_encode($response));
	}

	public function sitemap()
	{
		$data['items'] = array_map(function($arr){
					return (object) [
							'c_name' => $arr->c_name,
							'sub_cats' => array_map(function($arr){
								return (object) [
									'sc_name' => $arr->sc_name,
									'inner_cats' => array_map(function($arr){
										$limit = $this->main->products_all_count(['p_innercat' => $arr->i_id]);
										return (object) [
											'i_name' => $arr->i_name,
											'prods' => $this->main->getall('product', 'p_id, p_name', ['p_innercat' => $arr->i_id])
										];
									}, $this->main->getall('innercategory', 'i_id, i_name', ['i_sub_id' => $arr->sc_id]))
								];
							}, $this->main->getall('subcategory', 'sc_id, sc_name', ['sc_c_id' => $arr->c_id]))
						];
				}, $this->main->getall('category', 'c_id, c_name', []));
		
        return $this->load->view('sitemap', $data);
	}

	protected $signup = [
		[
            'field' => 'fname',
            'label' => 'First Name',
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => "%s is Required",
                'max_length' => "Max 255 characters allowed for %s"
            ]
        ],
		[
            'field' => 'mname',
            'label' => 'Middle Name',
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => "%s is Required",
                'max_length' => "Max 255 characters allowed for %s"
            ]
        ],
		[
            'field' => 'lname',
            'label' => 'Last Name',
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => "%s is Required",
                'max_length' => "Max 255 characters allowed for %s"
            ]
        ],
		[
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|max_length[255]|valid_email|is_unique[user.u_email]',
            'errors' => [
                'required' => "%s is Required",
                'max_length' => "Max 255 characters allowed for %s",
                'is_unique' => "%s already in use",
                'valid_email' => "%s is invalid"
            ]
        ],
		/* [
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|exact_length[10]|is_natural|is_unique[user.u_mobile]',
            'errors' => [
                'required' => "%s is Required",
                'exact_length' => "%s is invalid",
				'is_unique' => "%s already in use",
                'is_natural' => "%s is invalid"
            ]
        ], */
		[
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|max_length[200]',
            'errors' => [
                'required' => "%s is Required",
                'max_length' => "Max 200 characters allowed for %s",
            ]
        ]
	];
}