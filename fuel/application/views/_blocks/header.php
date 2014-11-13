
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="keywords" content="<?php echo fuel_var('meta_keywords')?>" />
<meta name="description" content="<?php echo fuel_var('meta_description')?>" />
<meta property="og:title" content="<?php echo fuel_var('og_title')?>"/>
<meta property="og:image" content="<?php echo fuel_var('og_image')?>"/>
<meta property="og:site_name" content="<?php echo fuel_var('page_title')?>"/>
<meta property="og:description" content="<?php echo fuel_var('og_desc')?>"/>
<!--page style-->
<link href="<?=site_url()?>templates/css/css.css" rel="stylesheet" type="text/css" />
 <!-- Bootstrap -->
<link href="<?=site_url()?>templates/css/bootstrap.min.css" rel="stylesheet">
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- jQuery library (served from Google) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="<?=site_url()?>templates/js/jquery.bxslider.js"></script>
<!-- bxSlider CSS file -->
<link href="<?=site_url()?>templates/css/jquery.bxslider.css" rel="stylesheet" />
<script src="<?=site_url()?>templates/js/bootstrap.min.js"></script>

<?php if (!empty($is_blog)) : ?>
<title><?php echo $CI->fuel_blog->page_title($page_title, ' : ', 'right')?></title>
<?php else : ?>
<title>Walt - 華特燈飾&nbsp;<?php echo fuel_var('page_title', '')?></title>
<?php endif ?>
</head>
<boby>
<div id="holder">
    