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
	<?php $url =  get_post_meta(get_the_ID(), 'tz_link_url', true); ?>

	<?php 
		
if (has_post_thumbnail() ):
$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
endif; ?>	
<?php if (has_post_thumbnail() && $url ): ?>
			<div class="link-image clearfix">
			<a target="_blank" href="<?php echo $url; ?>" title="<?php echo theme_locals('permalink_to');?> <?php echo $url; ?>">
		<div class="image-link">	
	<div class="image-background" style="background: url('<?php if (has_post_thumbnail() ): echo $img_url; endif; ?>') no-repeat scroll 0% 0% transparent; width: 100%; height: 100%;"></div>
	</div>
	<p><span class="responsive wtext">
       <?php echo $url; ?>
    </span></p>
	</a>
	</div>
	<?php endif; ?>
		<div class="row-fluid">
	<div class="span12">
	<!-- Post Content -->
	<div class="post_content">	
		<?php the_content(''); ?>
		<?php wp_link_pages('before=<div class="pagelink">&after=</div>'); ?>
		<div class="clear"></div>
	</div>
	<!-- //Post Content -->	
	</div>		
	</div>
<?php get_template_part( 'includes/post-formats/share-buttons' ); ?>
</article><!--//.post-holder-->