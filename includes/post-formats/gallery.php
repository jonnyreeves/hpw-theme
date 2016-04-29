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
	$hercules_gallery_type = get_post_meta(get_the_ID(), 'tz_gallery_format', true);
	$hercules_targetheight = get_post_meta(get_the_ID(), 'tz_gallery_targetheight', true);
	$hercules_gallery_margins = get_post_meta(get_the_ID(), 'tz_gallery_margins', true);
	$hercules_gallery_captions = get_post_meta(get_the_ID(), 'tz_gallery_captions', true);
	$hercules_gallery_randomize = get_post_meta(get_the_ID(), 'tz_gallery_randomize', true);
	$hercules_random = hs_gener_random(10);
	?>

	<div class="post-thumb clearfix">
	<?php if ($hercules_gallery_type=='slideshow') { 
	global $hercules_add_owl;
    $hercules_add_owl = true; ?>
	<script type="text/javascript">
		jQuery(window).load(function() {
jQuery("#owl-demo_<?php echo $hercules_random ?>").owlCarousel({
    autoPlay : 5000,
    stopOnHover : true,
    navigation:false,
	//items : 2,
    paginationSpeed : 5000,
    goToFirstSpeed : 2000,
    singleItem : true,
    autoHeight : true,
    transitionStyle:"fade"					
			});
		});
	</script>
		<!-- Slider -->
			<div id="owl-demo_<?php echo $hercules_random ?>" class="owl-carousel">
								
					<?php 

						$hercules_attachments = get_children(array('post_parent' => get_the_ID(), 'orderby' => 'menu_order ID', 'order' => 'asc', 'numberposts' => -1, 'post_type' => 'attachment', 'post_mime_type' => 'image' ));
					
						if ($hercules_attachments) :					
						foreach ($hercules_attachments as $attachment) :
					?>
					<div class="featured-thumbnail thumbnail large"><?php echo wp_get_attachment_image($attachment->ID, 'slideshow-post'); ?></div>
					
					<?php 
						endforeach;
						endif;
					?>
			</div>
			<!-- /Slider -->		
		<?php } ?>
		
		<!-- Grid -->
		<?php if ($hercules_gallery_type=='grid') {
		global $hercules_add_collageplus;
    $hercules_add_collageplus = true;
		?>
		<script type="text/javascript">
	jQuery(document).ready(function () {
			jQuery(".justifiedgall_<?php echo $hercules_random ?>").justifiedGallery({
				rowHeight: <?php if( ! empty( $hercules_targetheight ) ) {echo $hercules_targetheight;}else{echo '400';} ?>,
				fixedHeight: false,
				lastRow: 'justify',
				captions : <?php if( ! empty( $hercules_gallery_captions ) ) {echo $hercules_gallery_captions;}else{echo 'true';} ?>,
				margins: <?php if( ! empty( $hercules_gallery_margins ) ) {echo $hercules_gallery_margins;}else{echo '10';} ?>,
				randomize: <?php if( ! empty( $hercules_gallery_randomize ) ) {echo $hercules_gallery_randomize;}else{echo 'false';} ?> 
			});  });

    </script>
					<div class="zoom-gallery justifiedgall_<?php echo $hercules_random ?>" style="margin: 0px 0px 1.5em;">
					<div class="spinner"><span></span><span></span><span></span></div>			
					<?php 

						$hercules_attachments = get_children(array('post_parent' => get_the_ID(), 'orderby' => 'menu_order ID', 'order' => 'asc', 'numberposts' => -1, 'post_type' => 'attachment', 'post_mime_type' => 'image' ));
					
						if ($hercules_attachments) :					
						foreach ($hercules_attachments as $attachment) :
							$attachment_url = wp_get_attachment_image_src( $attachment->ID, 'full' );
							
			$caption = apply_filters('the_title', $attachment->post_excerpt);
					?>
					<a class="zoomer" title="<?php echo apply_filters('the_title', $attachment->post_excerpt); ?>" data-source="<?php echo $attachment_url[0]; ?>" href="<?php echo $attachment_url[0]; ?>"><?php echo wp_get_attachment_image($attachment->ID, 'full'); ?></a>
					
					<?php 
						endforeach;
						endif;
					?>
			</div>

		<?php } ?>
		<!-- /Grid -->
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
	</div>	</div>	
	
</div>
<?php get_template_part( 'includes/post-formats/share-buttons' ); ?>
</article><!--//.post__holder-->