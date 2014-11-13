  
 <!--    <ul class="bxslider">
      <?php if (isset($ad_results)): ?>
        <?php foreach ($ad_results as $ad_row): ?>
            <li><img style="width:695px;height:244px" src="<?php echo $base_url.$ad_row->ga_url?>" /></li> 
        <?php endforeach ?>
      <?php endif ?>
        
    </ul> -->
    <?php echo fuel_block('bxslider'); ?>
    <?php if (isset($lastest_news)): ?>
        <div id="index_news_title">
            <?php echo $lastest_news->title ?>
        </div>
        <div id="idnex_news_date">
            <?php echo $lastest_news->date ?>
        </div>
        <div id="idnex_news_content">
            <?php echo htmlspecialchars_decode($lastest_news->content); ?>
        </div>
    <?php endif ?>
   
    <div id="index_cate_holder">
      <?php if (isset($pro_cate_result)): ?>
        <?php foreach ($pro_cate_result as $row): ?>
              <div class ="index_cate">
                <a href="<?php echo $prod_detail_url.$row->id?>"><img src="<?php echo $row->img?>"></a>
                <div class ="title"><?php echo $row->code_name?></div>
                <div class ="desc"><?php echo $row->code_value1?></div>
              </div>
        <?php endforeach ?>
      <?php endif ?> 
    </div> 

   <script type="text/javascript">
      $(document).ready(function(){
        $('.bxslider').bxSlider({
        mode: 'fade',
        auto: true,
        preloadImages :'all',

          });

      });
    </script>