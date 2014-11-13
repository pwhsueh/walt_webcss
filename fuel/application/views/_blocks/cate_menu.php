<?php 
		 $pro_cate_result = get_menu();
 ?>
<ul >	
	<?php if (isset($pro_cate_result)): ?>
		<?php foreach ($pro_cate_result as $key => $value): ?>
			<li ><a href="<?php echo site_url()."category/$value->id" ?>"><?php echo $value->code_name ?></a></li>
		<?php endforeach ?>
	<?php endif ?> 
</ul>