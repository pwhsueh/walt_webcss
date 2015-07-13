  <!--WIS CODE-->
<!-- Google Tag Manager -->

<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WC2NLQ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WC2NLQ');</script>
<!-- End Google Tag Manager -->
<!--WIS CODE--> 

<img src="<?php echo site_url() ?>templates/import/banner_1.png"> 
<br><br>

<br><br>
<div id="orders">
  <ul class="nav nav-tabs" role="tablist" style="margin:20px 0px;">
    <li class="active"><a href="#">訂單查詢</a></li>
    <li><a href="<?php echo site_url()."member/edit" ?>">會員資料編輯</a></li>
    
  </ul>
  <table width="100" class="table table-striped">
    <tr bgcolor="#696969" >
      <th scope="col">訂單編號</th>
      <th scope="col">下單日期</th>
      <th scope="col">商品名稱</th>
      <th scope="col">總價</th>
      <th scope="col">訂單狀態</th>
      <th scope="col">出貨狀態</th>
      <th scope="col">匯款回報</th>
    </tr>
    <?php $temp_order_id=""; ?>
    <?php if (isset($order_result) && sizeof($order_result) > 0 ): ?>
    <?php foreach ($order_result as $key => $value): ?>
    <?php 
           $date = explode(" ", $value->order_time); 
           $date2 = $date[0];  
    ?>
    <tr>
      <td><?php echo $value->order_id ?></td>
      <td><?php echo $date2 ?></td>
      <td><?php echo $value->pro_name ?></td>
      <td><?php echo $value->total_amount ?></td> 
      <td>
        <?php if ($value->order_status == "order_status_0002"): ?>
          已確認
        <?php else: ?>
          未確認
        <?php endif ?> 
      </td>
      <td>
        <?php if ($value->order_ship_status == "ship_status_0002"): ?>
          已出貨
        <? else: ?>
          未出貨
        <?php endif ?>  
      </td>
      <td>    
        <?php if ($value->pay_way == 'A'): ?>
          貨到付款
        <?php else: ?>
           <?php if (!isset($value->account) || $value->account == ''): ?>
          
          <?php if ($temp_order_id != $value->order_id): ?>
            <?php $temp_order_id = $value->order_id; ?>
            <a href="<?php echo site_url()."orders/report/".$value->order_id ?>">匯款回報</a>
            <?php else: ?>

            <?php endif ?>
          <?php else: ?>
            已回報匯款
          <?php endif ?>
        <?php endif ?>  
      </td>
    </tr>
    <?php endforeach ?>
  <?php else: ?>
    <tr>
      <td colspan="7">目前無訂單資料</td>
    </tr>
  <?php endif ?>
    
  </table>
  <center>
    <ul class="pagination"> 
        <?php echo $pagination?>   
    </ul>
 </center>
</div>

 