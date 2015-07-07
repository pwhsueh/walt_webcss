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
    <ul class="bxslider">
      <?php if (isset($img_results)): ?>
        <?php foreach ($img_results as $row): ?>
            <li><img style="max-width:730px" src="<?php echo $base_url.'assets/'.$row->img?>" /></li> 
        <?php endforeach ?>
      <?php endif ?>
        
    </ul>
    <?php //echo fuel_block('bxslider'); ?>
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
                <a href="<?php echo $prod_detail_url.$row->id?>"><img style="max-width:210px;max-height:160px" src="<?php echo $row->img?>"></a>
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