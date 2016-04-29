<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
<?php formaticons(); ?>
	<div class="row-fluid">
	<div class="span12">
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
	$full_content = of_get_option('full_content');
	if(!is_singular() && $full_content!='true') : ?>				
	<!-- Post Content -->
	<div class="post_content">
	<?php get_template_part('includes/post-formats/post-thumb'); ?>
		<?php $post_excerpt = of_get_option('post_excerpt');
$blog_excerpt = of_get_option('blog_excerpt_count');		?>
		<?php if ($post_excerpt=='true') { ?>		
			<div class="excerpt">			
			<?php 
				$content = get_the_content();
				$excerpt = get_the_excerpt();
			if (has_excerpt()) {
				the_excerpt();
			} else {
				echo limit_text($content,$blog_excerpt);
			} ?>			
			</div>
		<?php } else if ($post_excerpt=='') {
				the_content('<div class="readmore-button">'.theme_locals("continue_reading").'</div>');
		        //wp_link_pages('before=<div class="pagelink">&after=</div>'); ?>
				<?php $args = array(
    'before'           => '<span style="clear:both; display:block">Pages',
    'after'            => '</span>',
    'nextpagelink'     => __('Next'),
    'previouspagelink' => __('Previous')
); 

wp_link_pages($args);
?> 
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
	<?php get_template_part('includes/post-formats/post-thumb'); ?>
		<?php the_content('<div class="readmore-button">'.theme_locals("continue_reading").'</div>'); ?>
		<?php wp_link_pages('before=<div class="pagelink">&after=</div>'); ?>
		<div class="clear"></div>
	</div>
	<!-- //Post Content -->	
	<?php endif; ?>
	
</div></div>
<?php get_template_part( 'includes/post-formats/share-buttons' ); ?>
</article>