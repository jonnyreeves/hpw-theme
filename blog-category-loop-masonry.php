<?php // Theme Options vars
	$layout_mode = of_get_option('layout_mode');
?>

<ul id="portfolio-grid" class="filterable-portfolio thumbnails portfolio-<?php echo $cols; ?>" data-cols="<?php echo $cols; ?>">
	<?php get_template_part('blog-isotope-loop'); ?>
</ul>

<?php 

	get_template_part('includes/post-formats/post-nav');
	
?>