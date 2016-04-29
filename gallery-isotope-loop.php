<?php // Isotope Gallery Init ?>
<?php 
	$i=1;
	if ( $wp_query->have_posts() ) while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
	?>
<li class="portfolio_item">
<div class="hider-posts"></div>
<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
	<?php 
		if (has_post_thumbnail() ):
	?>

	<div class="post-thumb clearfix">		
		<?php
		$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', false );
		 ?>			
			<figure class="featured-thumbnail thumbnail large">
				<a class="image-wrap zoomer" title="<?php the_title(); ?>" data-source="<?php echo $img_url[0]; ?>" href="<?php echo $img_url[0]; ?>"><?php the_post_thumbnail( 'gallery-thumb' ); ?>
    <span class="zoom-icon"></span>
				</a>
			</figure>
			<div class="clear"></div>	        		
				
	</div>
	<?php endif; ?>
	<?php if (of_get_option('gallery_title')=='yes' || of_get_option('gallery_category')=='yes' || of_get_option('gallery_description')=='yes') { ?>
	<div class="gallerycaption">
	<?php if (of_get_option('gallery_title')=='yes') { ?>
		<header class="post-header">	
			<h2 class="post-title"><?php the_title(); ?></h2>
	</header>
	<?php } ?>
	<?php if (of_get_option('gallery_category')=='yes') { ?>
	<div class="meta-space">
<span class="post_category">
<i class="icon-cloud-2"></i><?php echo get_the_term_list( $post->ID, 'gallery_categories', '', ', ', '' ); ?>
</span>
	 </div>
	 <?php } ?>
	 <?php if (of_get_option('gallery_description')=='yes') { ?>
	<div class="row-fluid">
	<div class="span12">
	
	<!-- Post Content -->
	<div class="post_content">	
		<?php the_content(''); ?>
		<div class="clear"></div>
	</div>
	<!-- //Post Content -->	
	
	</div>		
	</div>	
	<?php } ?>
	</div>
<?php } ?>	
</article><!--//.post__holder-->
</li>	
<?php $i++; endwhile; ?>