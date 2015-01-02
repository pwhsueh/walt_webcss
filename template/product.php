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
		<script type="text/javascript">
				$(document).ready(function(){
					$('.bxslider').bxSlider({
						mode: 'fade',
			  			pagerCustom: '#bx-pager'
					});
			});
		</script>
		<!--新增的scriptjqzoom-->
		<script type="text/javascript">
        $(document).ready(function() {
         
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

                  //...MORE OPTIONS  
               };
				 
               $('.jqzoom1').jqzoom(options); 

        });
</script>
		
		<div id="productbanner">
			<ul class="bxslider">
			<!---jqzoom-->
			  <li><a href="http://placehold.it/500x500&text=bigB" class="jqzoom1" title="MYTITLE"><img src="http://placehold.it/500x500&text=bigB" width="500" height="500"  /></a></li>
			  <!--新增的jqzoom-->
			  <li><img src="http://placehold.it/500x500&text=bigB" /></li>
			  <li><img src="http://placehold.it/500x500&text=bigC" /></li>
			  <li><img src="http://placehold.it/500x500&text=bigD" /></li>
			  <li><img src="http://placehold.it/500x500&text=bigE" /></li>

			</ul>
		</div>
		<div class="pager-holder">
			<div id="bx-pager">
			  <a data-slide-index="0" href=""><img src="http://placehold.it/100x100&text=smallA1" /></a>
			  <a data-slide-index="1" href=""><img src="http://placehold.it/100x100&text=smallB2" /></a>
			  <a data-slide-index="2" href=""><img src="http://placehold.it/100x100&text=smallC3" /></a>
			  <a data-slide-index="3" href=""><img src="http://placehold.it/100x100&text=smallD4" /></a>
			  <a data-slide-index="4" href=""><img src="http://placehold.it/100x100&text=smallCE5" /></a>

			</div>
		</div>
		<div id="clear"></div>
		<div id="product">
			<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=35&amp;appId=212312848898911" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>
			<h2>商品名稱標題</h2>
			<div class="product_text">雪白滑嫩的魚肉脂肪勻稱結實而少刺，細緻的肉質入口即化，口感綿密，是最受歡迎的白肉魚！
				使用延繩海釣的捕撈方式，捕撈後立即在船上人工處理，急速冷凍鎖住美味，鮮度有別於一般流刺網或拖網式捕撈，完整保留捕撈瞬間的口感和極致鮮度！
			</div>
			<div class="product_price">
			<p class="sprice"><s>原價：NT$200</s></p>
			<p class="price">會員價：NT$20</p>
			<p class="sprice">現省：180</p>
			數量
			<select class="form-control">
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select>
			</div>
			<div id="clear"></div>
		</div>

		<a href="#"><div id="buyit"></div></a>
		<ul class="nav nav-tabs" role="tablist" style="margin-left:40px; width:620px; margin-top:40px;">
			  <li class="active"><a>商品說明</a></li>
			  <li ><a>商品規格</a></li>
			  <li ><a>購買須知</a></li>
		</ul>
		<div class="product_content">
		<img src="import/sample1.png">
		<h4>全球最創意稀奇的燈</h4>
			<p>吸光台燈 這個「吸光台燈」其實就是太陽能台燈。將底部朝上就像一盆植物，將它放置在太陽下自動會存儲電能，照射時間的長短對使用的時間也有影響。反過來它就是一個LED 台燈，將白天存儲的電能晚上就能使用了。
			而且它完全防水，比較適合陽台、野營、划船以及在客廳或孩子的房間等</p>
		<img src="import/sample2.png">
		</div>
	</div>
</div>
</boby>
</head>
</html>