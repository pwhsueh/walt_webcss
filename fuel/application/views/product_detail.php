 
 <?php 
$price = 0; 
$num = 0;

if (isset($pro_plan_results)) {
  $price = $pro_plan_results->plan_price;
  $num = $pro_plan_results->plan_num - $pro_selled_cnt;
}

?> 
 
<link rel="stylesheet" type="text/css" href="<?php echo site_url() ?>templates/css/jquery.jqzoom.css">
  
 
    <div id="productbanner">
      <ul class="bxslider">
        <?php if (isset($pro_photo_data)): ?>
           <?php foreach ($pro_photo_data as $key => $value): ?>
            <li><a href="<?php echo $base_url.$value->ga_url?>" class="jqzoom1" ><img style="width:500px" src="<?php echo $base_url.$value->ga_url?>" /></a></li>
          <?php endforeach ?>     
        <?php endif ?>
          
      </ul>
    </div>
    <div class="pager-holder">
      <div id="bx-pager"> 
        <?php $i=0; ?>
        <?php if (isset($pro_photo_data)): ?>
          <?php foreach ($pro_photo_data as $key => $value): ?>
            <a data-slide-index="<?php echo $i++; ?>" href=""><img style="width:100px" src="<?php echo $base_url.$value->ga_url?>" /></a> 
          <?php endforeach ?>    
        <?php endif ?>
      
      </div>
    </div>
    <div id="clear"></div>
    <div id="product">
      <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fgotowalt&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=35&amp;appId=212312848898911" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>
      <h2><?php echo $pro_detail_results->pro_name?></h2>
      <div class="product_text">
        <?php echo $pro_detail_results->pro_summary?>
      </div>
      <div class="product_price">
      <p class="sprice"><s>原價：NT$<?php echo $price?></s></p>
      <p class="price">會員價：NT$<?php echo round($price*$discount)?></p>
      <p class="sprice">現省：<?php echo $price - round($price*$discount)?></p>
      數量
      
      <select class="form-control" id="num">
      <?php if ($num > 0): ?>
         <?php for ($i=1;$i<=$num;$i++): ?>
          <option value="<?php echo $i ?>"><?php echo $i ?></option>
        <?php endfor ?>
      <?php else: ?>
        <option value="0">缺貨中</option>
      <?php endif ?>
      </select>
      </div>
      <div id="clear"></div>
    </div>

    <a href="#"><div id="buyit"></div></a>
    <ul class="nav nav-tabs" role="tablist" style="margin-left:40px; width:620px; margin-top:40px;">
        <li class="active"><a href="#pro_desc" role="tab" data-toggle="tab">商品說明</a></li>
        <li ><a href="#pro_format" role="tab" data-toggle="tab">商品規格</a></li>
        <li ><a href="#pro_ship_note" role="tab" data-toggle="tab">購買須知</a></li>
    </ul>
<div class="tab-content">
   <div class="tab-pane active product_content" id="pro_desc">
      　<?php echo htmlspecialchars_decode($pro_detail_results->pro_desc)?>
    </div>
  <div class="tab-pane product_content" id="pro_format">
        <?php echo htmlspecialchars_decode($pro_detail_results->pro_format)?>
  </div>
  <div class="tab-pane product_content" id="pro_ship_note">
        <?php echo htmlspecialchars_decode($pro_detail_results->pro_ship_note)?>
  </div> 
</div>

 
<!-- Js Files -->
<script type='text/javascript' src='<?php echo site_url() ?>templates/js/jquery.jqzoom-core.js'></script> 
<script type="text/javascript">
  $(document).ready(function() {
     $('#buyit').on("click", function (e) {
        var num = $('#num').val();
        if (num > 0) {
            var url = '<?php echo site_url()."addToCart/$pro_detail_results->pro_id/$pro_detail_results->plan_id/"; ?>' + num;
            $.get(url, function(data) {
              /*optional stuff to do after success */
              alert('商品已加入購物車！');
            });
        }else{
            alert('商品缺貨中！');
        }
     });

      $('.bxslider').bxSlider({
            mode: 'fade',
              pagerCustom: '#bx-pager'
          });

      var options = {  
                zoomType: 'innerzoom',  
                lens:true,  
                preloadImages: true,  
                alwaysOn:false,  
                zoomWidth: 300,  
                zoomHeight: 250,  
                xOffset:0,  
                yOffset:0,  
                position:''  ,
                showEffect:'fadein',
                hideEffect:'fadein',
                title: false
                //...MORE OPTIONS  
             };
       
             $('.jqzoom1').jqzoom(options); 
  });
</script>
   

