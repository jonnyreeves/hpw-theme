<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
<?php formaticons(); ?>
	<header class="post-header">	
		<?php if(!is_singular()) : ?>
			<h2 class="post-title entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo theme_locals('permalink_to');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<?php else :?>
			<h2 class="post-title entry-title"><?php the_title(); ?></h2>
		<?php endif; ?>
	</header>
<?php $post_meta = of_get_option('post_meta');
     if ($post_meta=='true' || $post_meta=='') {
	 get_template_part('includes/post-formats/post-meta'); 
	 } ?>
	<?php 
if(of_get_option('featured_images') =='featured3') {
}else{
if(!is_singular() && of_get_option('featured_images') =='featured2' || !is_singular() && of_get_option('featured_images') =='featured1') { 
?>
	<?php 
		if (has_post_thumbnail() ):
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( '9999','9999' ), false, '' );
	?>

	<div class="post-thumb clearfix">				
			
				<figure class="featured-thumbnail thumbnail large">
				<div class="hider-page"></div>
				<a class="image-wrap image-popup-no-margins" href="<?php echo $src[0]; ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail( 'standard-large' ); ?>
                <span class="zoom-icon"></span>				
				</a>
				</figure>

			<div class="clear"></div>	        
	</div>
	<?php endif; ?>
<?php } ?>
<?php if(is_singular() && of_get_option('featured_images') =='featured1') { ?>
	<?php 
		if (has_post_thumbnail() ):
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( '9999','9999' ), false, '' );
	?>

	<div class="post-thumb clearfix">				
			
				<figure class="featured-thumbnail thumbnail large">
				<div class="hider-page"></div>
				<a class="image-wrap image-popup-no-margins" href="<?php echo $src[0]; ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail( 'standard-large' ); ?>
                <span class="zoom-icon"></span>				
				</a>
				</figure>

			<div class="clear"></div>	        
	</div>
	<?php endif; 
 } 
}
?>
	<div class="row-fluid">
	<div class="span12">

		<?php 
	$full_content = of_get_option('full_content');
	if(!is_singular() && $full_content!='true') : ?>				
	<!-- Post Content -->
	<div class="post_content">
		<?php $post_excerpt = of_get_option('post_excerpt');
$blog_excerpt = of_get_option('blog_excerpt_count');		?>
		<?php if ($post_excerpt=='true') { ?>		
			<div class="excerpt">			
			<?php 
				$content = get_the_content();
			if (has_excerpt()) {
				the_excerpt();
			} else {
				echo limit_text($content,$blog_excerpt);
			} ?>			
			</div>
		<?php } else if ($post_excerpt=='') {
				 the_content('<div class="readmore-button">'.theme_locals("continue_reading").'</div>');
		 wp_link_pages('before=<div class="pagelink">&after=</div>'); ?>
		<div class="clear"></div>
		<?php } ?>
				<?php $readmore_button = of_get_option('readmore_button');
if ($readmore_button=='yes') { ?>
				<div class="readmore-button">
		<a href="<?php the_permalink() ?>" class=""><?php echo theme_locals("continue_reading"); ?></a>
</div>	
		<div class="clear"></div>
		<?php } ?>
	</div>
				
	<?php else :?>	
	<!-- Post Content -->
	<div class="post_content">	
		<?php the_content('<div class="readmore-button">'.theme_locals("continue_reading").'</div>'); ?>
		<?php wp_link_pages('before=<div class="pagelink">&after=</div>'); ?>
		<div class="clear"></div>
	</div>
	<!-- //Post Content -->	
	<?php endif; ?>
	</div>		
	</div>	
<?php get_template_part( 'includes/post-formats/share-buttons' ); ?>
</article><!--//.post__holder-->