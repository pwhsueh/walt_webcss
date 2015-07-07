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

目前位置： <a href="<?php echo site_url() ?>">首頁</a> &gt; <?php echo $pro_cate_result->code_name ?>
  <hr>

<!--banner-->
<!-- <div id="banner_title">
<img src="<?php echo site_url() ?>templates/images/banner_title.jpg">
</div>
<div id="category">
<ul> 
 <?php if (isset($pro_cate_result)): ?>
    <?php foreach ($pro_cate_result as $key => $value): ?>
  
      <?php if ($value->id==$pro_cate): ?>
        <li class="set"><?php echo $value->code_name ?></li>
      <?php else: ?>
        <li><a href="<?php echo site_url()."category/".$value->id ?>"><?php echo $value->code_name ?></a></li>
      <?php endif ?>
    <?php endforeach ?>
  <?php endif ?>
</ul>
<div id="clear"></div>
</div> -->

<!--product box-->
<div id="product_box">

<?php
      $i = 0;
      if(isset($pro_results))
      {
        foreach($pro_results as $row)
        {

?> 
<div class="cate_box">
  <img style="height:160px" src="<?php echo $base_url.$row->photo->ga_url?>"></br>
  <span class="title"><?php echo $row->pro_name?></span><br>
  <span class="price">$ <?php echo round($row->pro_group_price*$discount) ?></span><span class="sprice"><s>$<?php echo $row->pro_group_price?></s></span><br>
  <a class="btn btn-default" href="<?php echo $prod_detail_url.$row->pro_id.".php"?>" role="button" style="float:right;">more</a>
  </div>
       
        
<?php
        
        }
      }
?> 

</div>

 
