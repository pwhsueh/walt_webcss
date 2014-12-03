
<?php if (isset($news_results)): ?>

	<?php foreach ($news_results as $key => $row): ?>
	<!--roll-->
		<?php 
         $date = explode(" ", $row->date); 
         $date2 = $date[0];
         // echo $date2;

        ?>
<!--news_roll-->
		<img style="max-width:730px" src="<?php echo site_url()."assets/".$row->img ?>">	
		<br>
		<h3><?php echo $row->title ?></h3>
		<p style="color:gray; font-size:14px;"><?php echo $date2 ?></p>
		<p>
			<?php echo htmlspecialchars_decode($row->content) ?>
		</p>
	<hr>
	<?php endforeach ?>
	
<?php endif ?>	 
<center>
	<ul class="pagination">
	      <?php echo $pagination?>
	</ul>
</center>
