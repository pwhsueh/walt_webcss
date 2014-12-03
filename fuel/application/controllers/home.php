<?php
class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct(); 
		$this->load->model('product_model');
		$this->load->model('core_model');
		$this->load->model('news_front_model');
		$this->load->library('comm');
		$this->load->library('set_meta');
	}

	function home() 
	{
		parent::Controller();	
	}

    private function url_checker(){
    	
		$this_host = $_SERVER['HTTP_HOST']; 

    	if(substr($this_host,0, 4)!='www.')
    	{
    		$p = $_SERVER['REQUEST_URI'];

			if(strlen($p)>1)
			{
				$p = substr($p, 1, strlen($p)-1);
			}else
			{
				$p='';
			}
    		
    		//redirect("http://taste-it.com.tw"); 
    	}
    	else
    	{
    		// redirect("http://taste-it.com.tw"); 
    	}

    }
	
	function index()
	{	
		$this->url_checker();
		$this->set_meta->set_meta_data();
		$this->load->helper('menu');
		// $pro_results = $this->product_model->get_pro_list(" AND (pro_promote='new' or pro_promote='hot') ","" );
		// $ad_results = $this->product_model->get_ad_data();
		$pro_cate_result = get_menu();;
		$lastest_news = $this->news_front_model->get_lastest_news(); 
	 	$img_results = $this->news_front_model->get_list(0, 100, " WHERE type='HOME' ");
		foreach ($pro_cate_result as $key) {
			$pro = $this->product_model->get_top_cate_pro($key->id);
			if (isset($pro)) {
				$key->img = $pro->img;
			}else{
				$key->img = 'http://placehold.it/210x160';
			}
			
		}

		$vars['img_results'] = $img_results;
		$vars['pro_cate_result'] = $pro_cate_result;

		// print_r($pro_cate_result);
		// die;
		// if(isset($pro_results))
		// {
		// 	$vars['pro_results'] = $pro_results;
		// }
		// else
		// {
		// 	$vars['pro_results'] = array();
		// }



		// $vars['ad_results'] = $ad_results;
		// $vars['system_time'] = date('Y/m/d h:y:s');
		// $vars['code_key'] = $code_key;

		// use Fuel_page to render so it will grab all opt-in variables and do any necessary parsing
		$vars['views'] = 'product';
		$vars['lastest_news'] = $lastest_news;
		$vars['prod_detail_url'] = base_url()."category/";
		// $vars['pro_cate_result'] = $pro_cate_result; 
		$vars['base_url'] = base_url();
		$page_init = array('location' => 'product');
		$this->load->module_library(FUEL_FOLDER, 'fuel_page', $page_init);
		$this->fuel_page->add_variables($vars);
		$this->fuel_page->render(FALSE, FALSE); //第二個FALSE為在前台不顯示ADMIN BAR
	}
 
	function login()
	{	
		$this->load->helper('cookie');
		$this->load->library('facebook'); 
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");
		// $all_cate = array();
		$this->load->model('core_model');
		//echo "23";
		$fb_data	= $this->core_model->get_fb_data();
		$vars['fb_data'] = $fb_data;

		//print_r($fb_data);

		// use Fuel_page to render so it will grab all opt-in variables and do any necessary parsing
		
		// $vars['all_cate']	= $all_cate;
		$member_id = isset($user_data['member_id'])?$user_data['member_id']:"";

        //bowen $member_id = 5;
	 

		// print_r($member_id);
		// die;
		$vars['member_id'] = $member_id;	  
		$vars['login_url'] = base_url()."user/login";
		$vars['base_url'] = base_url();
		$vars['views'] = 'login';
		$page_init = array('location' => 'login');
		$this->load->module_library(FUEL_FOLDER, 'fuel_page', $page_init);
		$this->fuel_page->add_variables($vars);
		$this->fuel_page->render(FALSE, FALSE); //第二個FALSE為在前台不顯示ADMIN BAR		
	}

	function category($pro_cate)
	{	
		$this->load->module_library(FUEL_FOLDER, 'fuel_auth');
		$this->load->module_model(MEMBER_FOLDER, 'member_manage_model');

		$this->url_checker();
		$this->set_meta->set_meta_data();
		$pro_results = $this->product_model->get_pro_list(" AND pro_cate='$pro_cate' ","" );
		$ad_results = $this->product_model->get_ad_data();
		$pro_cate_result = $this->product_model->get_code("product_cate"," AND id ='$pro_cate' " );


		$user_data = $this->fuel_auth->valid_user();
		$member_id = isset($user_data['member_id'])?$user_data['member_id']:"";
		$discount = 1;
		if(isset($member_id) && $member_id != "")
		{
			$member_info = $this->member_manage_model->get_member_detail($member_id);
			if (isset($member_info) && sizeof($member_info) > 0 ) {
				 $discount = $member_info[0]->discount;
			}
		} 

		// print_r($pro_results);
		// die;
		if(isset($pro_results))
		{
			$vars['pro_results'] = $pro_results;
		}
		else
		{
			$vars['pro_results'] = array();
		}
		$vars['ad_results'] = $ad_results;
		$vars['system_time'] = date('Y/m/d h:y:s');
		$vars['pro_cate'] = $pro_cate;

		// use Fuel_page to render so it will grab all opt-in variables and do any necessary parsing
		$vars['discount'] = $discount;
		$vars['views'] = 'category';
		$vars['prod_detail_url'] = base_url()."prod/detail/";
		$vars['pro_cate_result'] = $pro_cate_result[0]; 
		$vars['base_url'] = base_url();
		$page_init = array('location' => 'category');
		$this->load->module_library(FUEL_FOLDER, 'fuel_page', $page_init);
		$this->fuel_page->add_variables($vars);
		$this->fuel_page->render(FALSE, FALSE); //第二個FALSE為在前台不顯示ADMIN BAR
	}

	function search($keyword)
	{	

		$this->load->module_library(FUEL_FOLDER, 'fuel_auth');
		$this->load->module_model(MEMBER_FOLDER, 'member_manage_model');
		// $this->url_checker();
		$keyword = urldecode($keyword);
		$this->set_meta->set_meta_data();
		$pro_results = $this->product_model->get_pro_list(" AND pro_name like '%$keyword%' ","" );
		
		if(isset($pro_results))
		{
			$vars['pro_results'] = $pro_results;
		}
		else
		{
			$vars['pro_results'] = array();
		}

		$user_data = $this->fuel_auth->valid_user();
		$member_id = isset($user_data['member_id'])?$user_data['member_id']:"";
		$discount = 1;
		if(isset($member_id) && $member_id != "")
		{
			$member_info = $this->member_manage_model->get_member_detail($member_id);
			if (isset($member_info) && sizeof($member_info) > 0 ) {
				 $discount = $member_info[0]->discount;
			}
		} 


	 	$vars['discount'] = $discount;
		$vars['system_time'] = date('Y/m/d h:y:s');
		$vars['keyword'] = $keyword;
		$vars['views'] = 'search';
		$vars['prod_detail_url'] = base_url()."prod/detail/";
		$vars['base_url'] = base_url();
		$page_init = array('location' => 'search');
		$this->load->module_library(FUEL_FOLDER, 'fuel_page', $page_init);
		$this->fuel_page->add_variables($vars);
		$this->fuel_page->render(FALSE, FALSE); //第二個FALSE為在前台不顯示ADMIN BAR
	}

	function contact()
	{	
		$this->url_checker();
	 	$vars['contact_url'] = base_url().'do_contact';
		$vars['views'] = 'contact'; 
		$vars['base_url'] = base_url();
		$page_init = array('location' => 'contact');
		$this->load->module_library(FUEL_FOLDER, 'fuel_page', $page_init);
		$this->fuel_page->add_variables($vars);
		$this->fuel_page->render(FALSE, FALSE); //第二個FALSE為在前台不顯示ADMIN BAR
	}

	function do_contact()
	{	  
		$name 				= $this->input->get_post("name");
		$email 			    = $this->input->get_post("email");
		$phone 		     	= $this->input->get_post("phone");
		$content 		    = $this->input->get_post("content");  
		$success = $this->core_model->do_contact($name,$email,$phone,$content);

		if ($success) {
			// $result['status'] = 1;
			// $result['msg'] = "送出完成";
			$this->load->library('email'); 

			if(!empty($email))
			{
				  
				
				$msg = "name:$name"."<br/>"
					  ."email:$email"."<br/>"
					  ."phone:$phone"."<br/>"
					  ."content:$content"."<br/>";


				$this->email->from('waltcomt@walt.com.tw');
				$this->email->to('waltcomt@walt.com.tw'); 

				$this->email->subject($name.'-聯絡我們');
				$this->email->message($msg);
				
				$this->email->send();
		 
			}
			$this->comm->plu_redirect(site_url(), 0, "填寫完成");
		}else{
			// $result['status'] = -1;
			// $result['msg'] = "發生異常，請聯絡管理員";
			$this->comm->plu_redirect(site_url()."/contact", 0, "發生異常錯誤。請聯絡管理人員");
		}  
		// echo json_encode($result); 

		die();
	}
	
}