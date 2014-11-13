<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

// --------------------------------------------------------------------

/**
 * Returns a array value based on DB
 *
 * @access	public
 * @return	array
 */	
function get_menu(){		
	$CI =& get_instance();
	$CI->load->model('product_model');
	return $CI->product_model->get_code("product_cate"," AND parent_id <> -1 " );
}

/* End of file menu_helper.php */
/* Location: ./application/helpers/menu_helper.php */
