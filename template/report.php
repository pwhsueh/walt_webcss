<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<? include "meta.inc.php" ?>
<title>Walt - 華特燈飾</title>
</head>
<boby>
<div id="holder">
	<? include "left.inc.php" ?>
	<div id="right">
		<img src="import/banner_1.png">	
		<br><br>
			<div id="orders" style="line-height:40px;">
	<center>
		<h4>感謝您的訂購</h4>
		<p>非常感謝您的訂購，請您匯款後回報您的資料，我們會馬上幫您處理。</p>
		<p>匯款帳號： XX銀行 812  戶名：鄭亘成   XXXX-XXXX-XXXX-XXXX</p>
			<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
			  
			  <tr>
			    <td>&nbsp;</td>
			    <td align="right">匯款帳號後五碼：</td>
			    <td><input type="text" class="form-control"  ></td>
			  </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td align="right">匯款日期：</td>
			    <td><input type="date" class="form-control" id="time" ></td>
			  </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td align="right">訂單金額：</td>
			    <td>新台幣 <?php echo $order_info-> ?> 元</td>
			  </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td align="right">匯款金額：</td>
			    <td><input type="text" class="form-control"  ></td>
			  </tr>
			  
			  <tr>
			    <td>&nbsp;</td>
			    <td align="right">戶名（選填）：</td>
			    <td><input type="text" class="form-control"  ></td>
			  </tr>
			 </table>
			 <br>

	<button type="button" class="btn btn-primary">回報匯款</button>
	</center>
			</div>


	</div>
</div>
</boby>
</head>
</html>