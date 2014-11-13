<?php
class Orders extends CI_Controller {
	 
	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('member_model');
		$this->load->model('core_model');
		$this->load->library('pagination');
		$this->load->library('set_page');
		$this->load->library('comm');
	}

	function index($dataStart=0)
	{	 
		$this->load->module_library(FUEL_FOLDER, 'fuel_auth');
		$this->load->module_model(MEMBER_FOLDER, 'member_manage_model');
		$base_url = base_url();
		//bowen 先寫死 $member_id = 5;
		$user_data = $this->fuel_auth->valid_user();
		$member_id = isset($user_data['member_id'])?$user_data['member_id']:"";

		if($member_id == "")
		{
			$this->comm->plu_redirect(site_url(), 0, "發生異常錯誤，請重新登入");
			die;
		}

		$member_info = $this->member_manage_model->get_member_detail($member_id);

		

		$target_url = $base_url.'orders/';
		$total_rows = $this->member_model->get_order_total_rows($member_id);
		$config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 10);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config); 
		$order_result = $this->member_model->order_info($dataStart, $dataLen, $member_id); 
		$vars['member_info'] = $member_info; 
		$vars['pagination'] = $this->pagination->create_links(); 
		$vars['order_result'] = $order_result; 
		$vars['views'] = 'orders'; 
		$vars['base_url'] = base_url();
		$page_init = array('location' => 'orders');
		$this->load->module_library(FUEL_FOLDER, 'fuel_page', $page_init);
		$this->fuel_page->add_variables($vars);
		$this->fuel_page->render(FALSE, FALSE); //第二個FALSE為在前台不顯示ADMIN BAR
	}

	function report($order_id)
	{	 
		$this->load->module_library(FUEL_FOLDER, 'fuel_auth');
		$this->load->module_model(MEMBER_FOLDER, 'member_manage_model');
		$base_url = base_url();
		//bowen 先寫死 $member_id = 5;
		$user_data = $this->fuel_auth->valid_user();
		$member_id = isset($user_data['member_id'])?$user_data['member_id']:"";

		if($member_id == "")
		{
			$this->comm->plu_redirect(site_url(), 0, "發生異常錯誤，請重新登入");
			die;
		}

		$member_info = $this->member_manage_model->get_member_detail($member_id);

		$order_info = $this->core_model->get_order_info($order_id,$member_id);
	
		if(!isset($order_info))
		{
			$this->comm->plu_redirect(site_url(), 0, "找不到訂單資訊");
			die;
		}

		$total_amount = $this->core_model->get_order_total_amount($order_id);
		$order_info->total_amount = round($total_amount * $member_info[0]->discount);

		// $target_url = $base_url.'orders/';
		// $total_rows = $this->member_model->get_order_total_rows($member_id);
		// $config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 10);
		// $dataLen = $config['per_page'];
		// $this->pagination->initialize($config); 
		// $order_result = $this->member_model->order_info($dataStart, $dataLen, $member_id); 
		$vars['report_url'] = $base_url.'do_report';
		$vars['pagination'] = $this->pagination->create_links(); 
		$vars['order_info'] = $order_info; 
		$vars['views'] = 'report'; 
		$vars['base_url'] = base_url();
		$page_init = array('location' => 'report');
		$this->load->module_library(FUEL_FOLDER, 'fuel_page', $page_init);
		$this->fuel_page->add_variables($vars);
		$this->fuel_page->render(FALSE, FALSE); //第二個FALSE為在前台不顯示ADMIN BAR
	}
 
 	function do_report()
 	{
 		$this->load->module_library(FUEL_FOLDER, 'fuel_auth');
		$this->load->module_model(ORDER_FOLDER, 'order_manage_model');
		// $this->load->module_model(PRODUCT_FOLDER, 'product_manage_model');
		$this->load->module_model(MEMBER_FOLDER, 'member_manage_model');

		//if(is_ajax())
		if(true)
		{

			// $key = ALLPAY_KEY;
			// $iv = ALLPAY_IV;
			$user_data = $this->fuel_auth->valid_user();

			$order_id 				= $this->input->get_post("order_id");
			$account 			    = $this->input->get_post("account");
			$account_nm 			= $this->input->get_post("account_nm");
			$mailing_date 		    = $this->input->get_post("mailing_date");
			$mailing_amount 	    = $this->input->get_post("mailing_amount");
		 
			//bowen 先寫死 $member_id = 5; 
			$member_id = isset($user_data['member_id'])?$user_data['member_id']:"";
			 
			if($member_id)
			{
				$order_info = $this->core_model->get_order_info($order_id,$member_id);
	
				if(!isset($order_info))
				{
					$this->comm->plu_redirect(site_url(), 0, "找不到訂單資訊");
					$result['status'] = -1;
					$result['msg'] = "找不到訂單資訊，請聯絡管理員"; 
				}else{
					// $total_amount = $this->core_model->get_order_total_amount($order_id); 
					$success = $this->core_model->order_report($order_id,$member_id,$account,$account_nm,$mailing_date,$mailing_amount);
					if ($success) {
						$result['status'] = 1;
						$result['msg'] = "匯款回報成功";
					}else{
						$result['status'] = -1;
						$result['msg'] = "匯款回報發生異常，請聯絡管理員";
					} 
				} 
			}
			else
			{
				 
				$result['status'] = -1;
				$result['msg'] = "會員帳號發生異常，請聯絡管理員";
				 
			}

 

			echo json_encode($result);
		}
		else
		{
			redirect(site_url(), 'refresh');
		}

		die();
 	}
	
}