<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends Public_controller  {

	public function blogs_list($cat='', $subcat='', $inner='', $sub_inner='')
	{
		$this->load->library('pagination');
		
		$data['name'] = 'blogs';
		$url = base_url('blogs');
		$where = ['b.is_deleted' => 0];
		$data['breadcrumb_shop'] = [];

		$data['blog_cats'] = array_map(function($arr){
			return (object) [
					'c_id' => $arr->id,
					'c_name' => $arr->c_name,
					'sub_cats' => array_map(function($arr){
						return (object) [
							'sc_id' => $arr->id,
							'sc_name' => $arr->sc_name,
							'inner_cats' => (object) $this->main->getall('blog_inner_category', 'id AS i_id, ic_name', ['s_id' => $arr->id, 'is_deleted' => 0])
						];
					}, $this->main->getall('blog_sub_category', 'id, sc_name', ['c_id' => $arr->id, 'is_deleted' => 0]))
				];
		}, $this->main->getall('blog_category', 'id, c_name', ['is_deleted' => 0]));
		
		if ($cat){
			$url .= "/$cat";
			$where['c_name'] = str_replace('-', ' ', $cat);
			array_push($data['breadcrumb_shop'], "<a href='".make_slug('blogs/'.$cat)."'>".str_replace('-', ' ', $cat)."</a>");
		}

		if ($subcat){
			$url .= "/$subcat";
			$where['sc_name'] = str_replace('-', ' ', $subcat);
			array_push($data['breadcrumb_shop'], "<a href='".make_slug('blogs/'.$cat."/".$subcat)."'>".str_replace('-', ' ', $subcat)."</a>");
		}

		if ($inner){
			$url .= "/$inner";
			$where['ic_name'] = str_replace('-', ' ', $inner);
			array_push($data['breadcrumb_shop'], "<a href='".make_slug('blogs/'.$cat."/".$subcat."/".$inner)."'>".str_replace('-', ' ', $inner)."</a>");
		}
		
		if ($sub_inner){
			$url .= "/$sub_inner";
			$where['si_name'] = str_replace('-', ' ', $sub_inner);
			array_push($data['breadcrumb_shop'], "<a href='".make_slug('blogs/'.$cat."/".$subcat."/".$inner."/".$sub_inner)."'>".str_replace('-', ' ', $sub_inner)."</a>");
		}
		
		foreach ($this->input->get() as $k => $get) {
			if ($k == 'per_page') continue;
			$url .= array_key_first($this->input->get()) == $k ? "?" : "&";
			$url .= "$k=$get";
		}
		
		$config = [
			'base_url' => $url,
			'total_rows' => $this->main->blogs_all_count($where),
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
		$data['blogs'] = $this->main->blogs_list($where, $offset, $config['per_page']);
		$data['total'] = $config['total_rows'];
		$data['from'] = $offset + 1;
		$data['to'] = $offset + $config['per_page'] <= $config['total_rows'] ? $offset + $config['per_page'] : $config['total_rows'];
		$data['title'] = $data['blogs'] && $data['blogs'][0]['seo_title'] ? $data['blogs'][0]['seo_title'] : 'blogs';
		if ($data['blogs']) {
			$url = "blogs/";
			if ($cat){
				$url .= "$cat/";
				$sub_inners = ['c_id' => $data['blogs'][0]['c_id']];
				
				$data['sub_inns'] = $this->main->getall('blog_sub_category', 'CONCAT("'."$url".'", sc_name) AS si_url, sc_name si_name', $sub_inners, 'id ASC');
			}
			
			if ($subcat) {
				$url .= "$subcat/";
				$sub_inners = [
					'c_id' => $data['blogs'][0]['c_id'],
					's_id' => $data['blogs'][0]['sc_id'],
				];
				
				$data['sub_inns'] = $this->main->getall('blog_inner_category', 'CONCAT("'."$url".'", ic_name) AS si_url, ic_name si_name', $sub_inners, 'id ASC');
			}
			
			if ($inner) {
				$url .= "$inner/";
				$sub_inners = [
					'c_id' => $data['blogs'][0]['c_id'],
					's_id' => $data['blogs'][0]['sc_id'],
					'i_id' => $data['blogs'][0]['ic_id'],
				];

				$data['sub_inns'] = $this->main->getall('blog_sub_inner_category', 'CONCAT("'."$url".'", si_name) AS si_url, si_name', $sub_inners, 'id DESC');
			}
			
			$data['seo'] = [
					'title' => $data['blogs'][0]['seo_title'],
					'desc' => $data['blogs'][0]['seo_description'],
					'url' => current_url(),
					'image' => base_url('admin/admin/image/logo.png'),
					'keywords' => $data['blogs'][0]['seo_keywords']
				];
		}
		
		return $this->template->load('template', 'blogs_list', $data);
	}
}