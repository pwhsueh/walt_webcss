 

目前位置： <a href="<?php echo site_url() ?>">首頁</a> &gt; 關鍵字搜尋:<?php echo $keyword ?>
  <hr>


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

 
