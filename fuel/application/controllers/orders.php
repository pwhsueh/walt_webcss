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
		$this->load->library('email');
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
		$count = $this->core_model->get_order_count($order_id);

		$freight = $this->product_model->get_code_info('Freight','FREIGHT');
		if ($total_amount < $freight->code_value1) {
			$total_amount+=$freight->code_value2 * $count;
		}

		$order_info->total_amount = $total_amount;

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
						$user_mail = $this->core_model->get_user_mail_by_id($member_id);
						$this->send_mail($user_mail);
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

 	function send_mail($email){
 		$managers = $this->core_model->get_manager_mail();
		 
		$subject = "匯款回報通知"; //信件標題 
		 
		$msg_user = "

		<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<title>Untitled Document</title>
		</head>

		<body>
		<p><a href='http://walt.com.tw/'><img src='http://walt.com.tw/templates/import/logo.png' alt='' border='0' /></a>
		</p>
		<p>您好，我們已收到您的匯款回報</p>
		<p>您可以至以下網址登入系統查看您的訂單進度</p>
		<p><a href=''http://walt.com.tw/login' target='_blank'>http://walt.com.tw/login</a></p>
		<p>謝謝您</p>
		<p>**********<br />
		此為系統自動寄出郵件，請勿直接回覆</p>
		<p>2015 華特燈飾<br />
		  台北市萬華區寶興街162號<br />
		(02)2309-5195</p>
		</body>
		</html>


		";

		$msg_manager = "
 
	 
		<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<title>Untitled Document</title>
		</head>

		<body>
		<p><a href='http://walt.com.tw/'><img src='http://walt.com.tw/templates/import/logo.png' alt=' border='0' /></a>
		</p>
		<p>有新的匯款回報。</p>
		<p>您可以至以下網址登入系統查看</p>
		<p><a href='http://walt.com.tw/login' target='_blank'>http://walt.com.tw/fuel/order/lists</a></p>
		<p>謝謝您</p>
		<p>**********<br />
		此為系統自動寄出郵件，請勿直接回覆</p>
		<p>2015 華特燈飾<br />
		  台北市萬華區寶興街162號<br />
		(02)2309-5195</p>
		</body>
		</html>


		";

		if (isset($managers)) {
			foreach ($managers as $row) {
				$email = $row->code_value1; 

				$this->email->from('xuan-1121@hotmail.com', 'walt-華特燈飾');
				$this->email->to($email); 

				$this->email->subject($subject);
				// $this->email->message(fuel_block('contact_content'));
				$this->email->message($msg_manager);

				
				$success = $this->email->send();
			}
		}

		$this->email->from('xuan-1121@hotmail.com', 'walt-華特燈飾');	 
		$this->email->to($email); 
		$this->email->subject($subject); 
		$this->email->message($msg_user);
		
		$success = $this->email->send();
 	}
	
}