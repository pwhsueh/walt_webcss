<?php 
		$this->load->helper('menu');
 ?>
<?php $this->load->view('_blocks/header')?>
	
	<!--<div id="main_inner">-->
	
	<!--</div>-->
	 <?php 
           if(isset($this->fuel_auth))
            {
              $session_key = $this->fuel_auth->get_session_namespace();
              $user_data = $this->session->userdata($session_key);
            }
            else if(isset($CI->fuel_auth))
            {
              $session_key = $CI->fuel_auth->get_session_namespace();
              $user_data = $CI->session->userdata($session_key);
            }
            
            $member_id = isset($user_data['member_id'])?$user_data['member_id']:"";
       ?>
<div id="left">
		<a href="<?php echo site_url() ?>"><img src="<?=site_url()?>templates/import/logo.png"></a><br><br><br>
		<p class="menu_title">Menu</p>
			<div id="menu">
			<ul>
				<li><a href="<?=site_url()?>about">關於我們</a></li>
				<li><a href="<?=site_url()?>news">最新消息</a></li>
				<li><a href="<?=site_url()?>cart">購物車</a></li>
				<li><a href="<?=site_url()?>contact">聯絡我們</a></li>
				<li><a href="<?=site_url()?>faq">購買說明</a></li>
				<?php //echo("212121212-".$member_id."-212121212"); ?>
				<?php if (!$member_id): ?>
					<li><a href="<?=site_url()?>login">會員登入</a></li><!--未登入顯示這個-->
					<li><a href="<?=site_url()?>register">加入會員</a></li>
				<?php else: ?>
					<li><a href="<?=site_url()?>orders">訂單查詢</a></li><!--登入後顯示這個-->
					<li><a href="<?php echo site_url()?>/user/logout" id="topmenu_10" title="登出">登出</a></li>
				<?php endif ?>			
			</ul>
			</div>
			<br>
		<p class="menu_title">Search</p>
    	<input type="text" id="txt_search" style="height:20px; width:115px;float:right;">
    	<img src="<?=site_url()?>templates/import/search.png" style="float:right;">
    	<div id="clear"></div>
    	<br>     
		<p class="menu_title">Category</p>
			<div id="Category">
				<?php $this->load->view('_blocks/cate_menu')?>
			</div>
			<br>
		<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fgotowalt&amp;width=190&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=212312848898911" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:190px; height:290px;" allowTransparency="true"></iframe>

	<div id="footer">
		<br>
		<!--online-->

<?php
//首先你要有讀寫檔的許可權
//本程式可以直接運行,第一次報錯,以後就可以
  $online_log = "count.dat"; //儲存人數的檔,
  $timeout = 600;//600秒內沒動作者,認為掉線
  $entries = file($online_log);

  $temp = array();
 
  for ($i=0;$i<count($entries);$i++) {
   $entry = explode(",",trim($entries[$i]));
   if (($entry[0] != getenv('REMOTE_ADDR')) && ($entry[1] > time())) {
    array_push($temp,$entry[0].",".$entry[1]." "); //取出其他流覽者的資訊,並去掉逾時者,儲存進$temp
   }
  }

   array_push($temp,getenv('REMOTE_ADDR').",".(time() + ($timeout))." "); //更新流覽者的時間
  $users_online = count($temp); //計算線上人數

  $entries = implode("",$temp);
  //寫入檔案
  $fp = fopen($online_log,"w");
   flock($fp,LOCK_EX); //flock() 不能在NFS以及其他的一些網路檔系統中標準工作
   fputs($fp,$entries);
   flock($fp,LOCK_UN);
   fclose($fp);

   echo "線上人數：".$users_online;
 ?>
			<br>
			Copyright © <br>
			2015 華特燈飾<br>
			台北市萬華區寶興街162號<br>    
			(02)2309-5195<br> 
	</div>
</div>
<div id="right">
	<?php 
		if(isset($views)){
			$this->load->view($views);
		}
		else
		{
			$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
			if ($_SERVER["SERVER_PORT"] != "80")
			{
			    $pageURL .= substr($_SERVER['SERVER_NAME'], 4).":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			} 
			else 
			{
			    $pageURL .= substr($_SERVER['SERVER_NAME'], 4).$_SERVER["REQUEST_URI"];

			    if(substr($_SERVER['SERVER_NAME'], 0, 4) == "www.")
			    {
			    	redirect($pageURL, 'refresh');
			    }
			}
			echo fuel_var('body', '');
		}
	?>

 
</div>


<script>

	  
   
    $(document).ready(function($) {

  		$('#txt_search').live("keypress", function(e) {
	        if (e.keyCode == 13) {
	        	if ($('#txt_search').val() != '') {
	        		location.href = '<?php echo site_url()."Saerch/" ?>' + encodeURI($('#txt_search').val()) ;
	        	};
	            
	            return false; // prevent the button click from happening
	        }
		});

		$('#txt_search').blur(function(e) {
	        if ($('#txt_search').val() != '') {
        		location.href = '<?php echo site_url()."Saerch/" ?>' + encodeURI($('#txt_search').val()) ;
        	};
		});
    });

 </script>
	
<?php 
	$this->load->view('_blocks/footer');
?>
