<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>				
<?php formaticons(); 
?>
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
		$embed = get_post_meta(get_the_ID(), 'tz_video_embed', true);
		//Check for video format
	    $vimeo = strpos($embed, "vimeo");
	    $youtube = strpos($embed, "youtu");
	?>

	
<?php
			if ($embed != '') {?>
			<div class="video-wrap" style="margin: 0px 0px 1.5em;">
						<?php	if($vimeo !== false){

	        //Get ID from video url
	        $video_id = str_replace( 'http://vimeo.com/', '', $embed );
	        $video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );

	        //Display Vimeo video
	        echo '<iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0" width="1000" height="750" frameborder="0"></iframe>';

	    	} elseif($youtube !== false){

	        //Get ID from video url
	    	$video_id = str_replace( 'http://', '', $embed );
	    	$video_id = str_replace( 'https://', '', $video_id );
	        $video_id = str_replace( 'www.youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtu.be/', '', $video_id );
	        $video_id = str_replace( '&feature=channel', '', $video_id );

	        echo '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="1000" height="750" src="http://www.youtube.com/embed/'.$video_id.'?wmode=opaque" frameborder="0"></iframe>';

	    	} ?>
				</div>
				<?php } else { ?>

	<?php 
		if (has_post_thumbnail() ):
	?>

	<div class="post-thumb clearfix">		
			<figure class="featured-thumbnail thumbnail large">
			<div class="hider-page"></div>
				<?php the_post_thumbnail( 'standard-large' ); ?>
			</figure>
			<div class="clear"></div>
</div>			
		<?php endif; ?>		
	
<?php }
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
	</div>	 </div>       
<?php get_template_part( 'includes/post-formats/share-buttons' ); ?>
</article><!--//.post__holder-->