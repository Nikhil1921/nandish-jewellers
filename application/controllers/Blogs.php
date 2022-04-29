<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends Public_controller  {

	public function blogs_list($cat='', $subcat='', $inner='', $sub_inner='')
	{
		$this->load->library('pagination');
		
		$data['name'] = 'blogs';
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
		$data['breadcrumb_shop'] = [];
		
		if ($cat){
			$url .= "/$cat";
			$where['c_name'] = str_replace('-', ' ', $cat);
			array_push($data['breadcrumb_shop'], "<a href='".make_slug($cat)."'>".str_replace('-', ' ', $cat)."</a>");
		}

		if ($subcat){
			$url .= "/$subcat";
			$where['sc_name'] = str_replace('-', ' ', $subcat);
			array_push($data['breadcrumb_shop'], "<a href='".make_slug($cat."/".$subcat)."'>".str_replace('-', ' ', $subcat)."</a>");
		}

		if ($inner){
			$url .= "/$inner";
			$where['i_name'] = str_replace('-', ' ', $inner);
			array_push($data['breadcrumb_shop'], "<a href='".make_slug($cat."/".$subcat."/".$inner)."'>".str_replace('-', ' ', $inner)."</a>");
			$inn_id = $this->main->check('innercategory', ['i_name' => str_replace('-', ' ', $inner)], 'i_id');
			if($inn_id) $data['banners'] = $this->main->getall('banner', 'b_image', ['b_cat_id' => $inn_id], 'b_id DESC');
		}
		
		if ($sub_inner){
			$url .= "/$sub_inner";
			$where['si_name'] = str_replace('-', ' ', $sub_inner);
			array_push($data['breadcrumb_shop'], "<a href='".make_slug($cat."/".$subcat."/".$inner."/".$sub_inner)."'>".str_replace('-', ' ', $sub_inner)."</a>");
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
		
		if ($data['prods']) {
			$url = "";
			if ($cat){
				$url .= "$cat/";
				$sub_inners = ['sc_c_id' => $data['prods'][0]['p_cat']];
				$data['sub_inns'] = $this->main->getall('subcategory', 'CONCAT("'."$url".'", sc_name) AS si_url, sc_name si_name', $sub_inners, 'sc_id ASC');
			}

			if ($subcat) {
				$url .= "$subcat/";
				$sub_inners = [
					'i_cat_id' => $data['prods'][0]['p_cat'],
					'i_sub_id' => $data['prods'][0]['p_subcat'],
				];

				$data['sub_inns'] = $this->main->getall('innercategory', 'CONCAT("'."$url".'", i_name) AS si_url, i_name si_name', $sub_inners, 'i_id ASC');
			}
			
			if ($inner) {
				$url .= "$inner/";
				$sub_inners = [
					'si_cat_id' => $data['prods'][0]['p_cat'],
					'si_subcat_id' => $data['prods'][0]['p_subcat'],
					'si_innercat_id' => $data['prods'][0]['p_innercat'],
				];

				$data['sub_inns'] = $this->main->getall('sub_innercategory', 'CONCAT("'."$url".'", si_name) AS si_url, si_name', $sub_inners, 'si_id DESC');
			}
			
			$data['seo'] = [
					'title' => $data['prods'][0]['seo_title'],
					'desc' => $data['prods'][0]['seo_description'],
					'url' => current_url(),
					'image' => base_url('admin/admin/image/logo.png'),
					'keywords' => $data['prods'][0]['seo_keywords']
				];
		}
		
		return $this->template->load('template', 'blogs_list', $data);
	}
}