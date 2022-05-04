<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Main_model extends Public_model
{
	public function count($table, $select, $where)
	{
		return $this->db->select($select)
						->from($table)
						->where($where)
						->get()
						->num_rows();
	}

	public function getNewProds()
	{
		return $this->db->select('p_id, p_name, sc_name, i_name, c_name, p_gram, p_image, c_price, c_price_22, c_price_18, p_carat, p_l_char, p_other, si_name')
						->from('product p')
						->where(['p_show' => 'New', 'p_qty_avail >' => 0, 'p.is_deleted' => 0])
						->join('category c', 'c.c_id = p.p_cat')
						->join('subcategory sc', 'sc.sc_id = p.p_subcat')
						->join('innercategory ic', 'ic.i_id = p.p_innercat')
						->join('sub_innercategory si', 'si.si_id = p.p_subinner')
						// ->limit(12)
						/* ->order_by('last_update DESC') */
						->order_by('p_sort ASC')
						->get()
						->result();
	}

	public function getInners()
	{
		return $this->db->select('i_id, c_name, sc_name, i_name, i_image, i_show, c_name')
						->from('innercategory ic')
						->join('category c', 'c.c_id = ic.i_cat_id')
						->join('subcategory sc', 'sc.sc_id = ic.i_sub_id')
						->order_by('i_sort ASC')
						->get()
						->result();
	}

	public function getBestProds($p_cat)
	{
		return $this->db->select('p_id, p_name, sc_name, i_name, c_name, p_gram, p_image, c_price, c_price_22, c_price_18, p_carat, p_l_char, p_other, si_name')
						->from('product p')
						->where(['p_show' => 'Best', 'p_qty_avail >' => 0, 'p_cat' => $p_cat])
						->where(['p.is_deleted' => 0])
						->join('category c', 'c.c_id = p.p_cat')
						->join('subcategory sc', 'sc.sc_id = p.p_subcat')
						->join('innercategory ic', 'ic.i_id = p.p_innercat')
						->join('sub_innercategory si', 'si.si_id = p.p_subinner')
						// ->limit(8)
						// ->order_by('last_update DESC')
						->order_by('p_sort ASC')
						->get()
						->result();
	}

	public function getRelatedProds($inner, $p_id)
	{
		return $this->db->select('p_id, p_name, sc_name, i_name, c_name, p_gram, p_image, c_price, c_price_22, c_price_18, p_carat, p_l_char, p_other, si_name')
						->from('product p')
						->where(['p_qty_avail >' => 0, 'i_name' => $inner, 'p_id !=' => $p_id])
						->where(['p.is_deleted' => 0])
						->join('category c', 'c.c_id = p.p_cat')
						->join('subcategory sc', 'sc.sc_id = p.p_subcat')
						->join('innercategory ic', 'ic.i_id = p.p_innercat')
						->join('sub_innercategory si', 'si.si_id = p.p_subinner')
						->limit(15)
						->order_by('p_sort ASC')
						->get()
						->result();
	}

	public function product_list($where)
	{
		$select = ['p_id', 'p_detail', 'p_name', 'sc_name', 'i_name', 'c_name', 'p_gram', 'p_image', 'c_price', 'c_price_22', 'c_price_18', 'p_carat', 'p_l_char', 'p_other', 'p_code', 'p_cat', 'p_subcat', 'p_innercat', 'p_subinner', 'si_name'];
		
		if (isset($where['si_name']))
			array_push($select, 'si.seo_title', 'si.seo_description', 'si.seo_keywords','si.seo_detail');
		elseif (isset($where['i_name']))
			array_push($select, 'ic.seo_title', 'ic.seo_description', 'ic.seo_keywords','ic.seo_detail');
		elseif (isset($where['sc_name']))
			array_push($select, 'sc.seo_title', 'sc.seo_description', 'sc.seo_keywords','sc.seo_detail');
		else
			array_push($select, 'c.seo_title', 'c.seo_description', 'c.seo_keywords','c.seo_detail');
		
		$this->db->select($select)
				 ->from('product p')
				 ->where($where)
				 ->where(['p.is_deleted' => 0]);

		if ($this->input->get('search')){
			$search = str_replace(' ', '-', $this->input->get('search'));
			foreach($select as $s => $item){
				if($s===0)
				{
					$this->db->group_start(); 
					$this->db->like($item, $search);
				}
				else
				{
					$this->db->or_like($item, $search);
				}
				
				if(count($select) - 1 == $s) 
				$this->db->group_end();
			}
		}
		
		return $this->db->join('category c', 'c.c_id = p.p_cat')
						->join('subcategory sc', 'sc.sc_id = p.p_subcat')
						->join('innercategory ic', 'ic.i_id = p.p_innercat')
						->join('sub_innercategory si', 'si.si_id = p.p_subinner', 'left');
	}

	public function blog_list($where)
	{
		$select = ['b.id', 'b.title', 'b.detail', 'b.image', 'b.seo_title', 'b.seo_description', 'b.seo_keywords', 'b.seo_detail', 'c.c_name', 'sc.sc_name', 'ic.ic_name', 'si.si_name', 'b.c_id', 'b.sc_id', 'b.ic_id', 'b.si_id'];
		
		if (isset($where['si_name']))
			array_push($select, 'si.seo_title', 'si.seo_description', 'si.seo_keywords','si.seo_detail');
		elseif (isset($where['ic_name']))
			array_push($select, 'ic.seo_title', 'ic.seo_description', 'ic.seo_keywords','ic.seo_detail');
		elseif (isset($where['sc_name']))
			array_push($select, 'sc.seo_title', 'sc.seo_description', 'sc.seo_keywords','sc.seo_detail');
		else
			array_push($select, 'c.seo_title', 'c.seo_description', 'c.seo_keywords','c.seo_detail');
		
		$this->db->select($select)
				 ->from('blog b')
				 ->where($where)
				 ->where(['b.is_deleted' => 0]);

		if ($this->input->get('search')){
			$search = str_replace(' ', '-', $this->input->get('search'));
			foreach($select as $s => $item){
				if($s===0)
				{
					$this->db->group_start(); 
					$this->db->like($item, $search);
				}
				else
				{
					$this->db->or_like($item, $search);
				}
				
				if(count($select) - 1 == $s) 
				$this->db->group_end();
			}
		}
		
		return $this->db->join('blog_category c', 'c.id = b.c_id', 'left')
						->join('blog_sub_category sc', 'sc.id = b.sc_id', 'left')
						->join('blog_inner_category ic', 'ic.id = b.ic_id', 'left')
						->join('blog_sub_inner_category si', 'si.id = b.si_id', 'left');
	}

	public function products_all_count($where)
	{
		$this->product_list($where);
		return $this->db->get()->num_rows();
	}

	public function blogs_all_count($where)
	{
		$this->blog_list($where);
		return $this->db->get()->num_rows();
	}

	public function blogs_list($where, $offset, $limit)
	{
		$this->blog_list($where);
		$this->db->order_by('b.id DESC');
		
		$this->db->limit($limit, $offset);
		
		return $this->db->get()->result_array();
	}
	
	public function products_list($where, $offset, $limit)
	{
		$this->product_list($where);
		if ($this->input->get('sortby')){
			switch ($this->input->get('sortby')) {
				case 'carat_desc':
                    $this->db->order_by('c_price DESC');
                    $this->db->order_by('c_price_22 DESC');
                    $this->db->order_by('c_price_18 DESC');
					break;
				case 'carat_asc':
					$this->db->order_by('c_price ASC');
                    $this->db->order_by('c_price_22 ASC');
                    $this->db->order_by('c_price_18 ASC');
					break;
				case 'weight_asc':
					$this->db->order_by('p_gram ASC');
					break;
				case 'weight_desc':
					$this->db->order_by('p_gram DESC');
					break;
				case 'name_asc':
					$this->db->order_by('p_name ASC');
					break;
				case 'name_desc':
					$this->db->order_by('p_name DESC');
					break;
				
				default:
					$this->db->order_by('p_id DESC');
					break;
			}
		}else
		    $this->db->order_by('p_sort ASC');
		
		$this->db->limit($limit, $offset);
		
		return $this->db->get()->result_array();
	}

	public function getCart($user)
	{
		return $this->db->select('p_qty_avail, ca_pro_id, p_pre, p_shipping, ca_id, ca_qty, ca_size, ca_pre_order, p_id, p_name, sc_name, i_name, c_name, p_gram, p_image, c_price, c_price_22, c_price_18, p_carat, p_l_char, p_other, si_name')
						->from('product p')
						->where(['p_qty_avail >' => 0, 'ca_u_id' => $user])
						->where(['p.is_deleted' => 0])
						->join('category c', 'c.c_id = p.p_cat')
						->join('subcategory sc', 'sc.sc_id = p.p_subcat')
						->join('innercategory ic', 'ic.i_id = p.p_innercat')
						->join('sub_innercategory si', 'si.si_id = p.p_subinner')
						->join('cart ca', 'ca.ca_pro_id = p.p_id')
						->order_by('p_sort ASC')
						->get()
						->result_array();
	}

	public function getWishlist($user)
	{
		return $this->db->select('w_id, p_id, p_name, sc_name, i_name, si_name, c_name, p_gram, p_image, c_price, c_price_22, c_price_18, p_carat, p_l_char, p_other')
						->from('product p')
						->where(['p_qty_avail >' => 0, 'w_u_id' => $user])
						->where(['p.is_deleted' => 0])
						->join('category c', 'c.c_id = p.p_cat')
						->join('subcategory sc', 'sc.sc_id = p.p_subcat')
						->join('innercategory ic', 'ic.i_id = p.p_innercat')
						->join('sub_innercategory si', 'si.si_id = p.p_subinner')
						->join('wish w', 'w.w_p_id = p.p_id')
						->order_by('p_sort ASC')
						->get()
						->result_array();
	}

	public function prod($prod)
	{
		return $this->db->select('p_id, p_name, c_name, p_gram, p_image, c_price, c_price_22, c_price_18, p_carat, p_l_char, p_other, p_code, p_detail, p_pre, p_size_type, p_sub_detail, p_size, p_g_wei, p_l_wei, p_gram, p_carat, p_make_gram, p_notes, si.seo_title, si.seo_description, si.seo_keywords')
						->from('product p')
						->where(['p_qty_avail >' => 0, 'p_id' => $prod])
						->where(['p.is_deleted' => 0])
						->join('category c', 'c.c_id = p.p_cat')
						/* ->join('subcategory sc', 'sc.sc_id = p.p_subcat') */
						/* ->join('innercategory ic', 'ic.i_id = p.p_innercat') */
						->join('sub_innercategory si', 'si.si_id = p.p_subinner')
						->get()
						->row_array();
	}

	public function saveOrder($order, $cart, $mobile)
	{
		$this->db->trans_start();
		$this->db->insert("orders", $order);
		$this->db->delete("cart", ['ca_u_id' => $order['o_u_id']]);
		
		if ($this->session->coupen_id):
			$this->db->where(['co_id' => $this->session->coupen_id])->update('code', ['co_status'=> 1, 'co_order' => $this->db->insert_id()]);
		endif;
		foreach ($cart as $qty):
			if (!$qty['p_pre']):
				$this->db->where(['p_id' => $qty['p_id']])->update('product', ['p_qty_avail'=> ($qty['p_qty_avail'] - $qty['ca_qty'])]);
			endif;
		endforeach;
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === true) {
			$this->session->unset_userdata('coupen_id');
			$this->session->unset_userdata('discount');
			$sms = $this->config->item('Confirmation_SMS');
			send_sms($mobile, $sms, $this->config->item('Confirmation_TEMPLATE'));
			
			$sms = str_ireplace('{#var#}', $order['o_invoice'], $this->config->item('AdminConfirm_SMS'));
			send_sms($this->config->item('admin_mobile'), $sms, $this->config->item('AdminConfirm_TEMPLATE'));
		}

		return $this->db->trans_status();
	}
}