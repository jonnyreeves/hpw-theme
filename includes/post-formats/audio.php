<?php
global $hercules_add_swfobject;
$hercules_add_swfobject = true;
global $hercules_add_playlist;
$hercules_add_playlist = true;
global $hercules_add_jplayer;
$hercules_add_jplayer = true;

// get audio attribute
$embed = get_post_meta(get_the_ID(), 'tz_audio_embed', true);
		$hercules_audio_title = get_post_meta(get_the_ID(), 'tz_audio_title', true);
		$hercules_audio_artist = get_post_meta(get_the_ID(), 'tz_audio_artist', true);		
		$hercules_audio_format = get_post_meta(get_the_ID(), 'tz_audio_format', true);
		$hercules_audio_url = get_post_meta(get_the_ID(), 'tz_audio_url', true);
		$hercules_file = $hercules_audio_url;
		
?>
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
<div class="audio-wraper" style="position:relative;">
<?php
			if ($embed != '') {
			
				echo stripslashes(htmlspecialchars_decode($embed));

			} else if($hercules_file !='') { ?>
	<div class="audio-wrap">
		<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#jquery_jplayer_<?php the_ID(); ?>").jPlayer({
		ready: function () {
			jQuery(this).jPlayer("setMedia", {
			title:"<?php echo $hercules_audio_title; ?>",
			artist:"<?php echo $hercules_audio_artist; ?>",
			free:true,
			<?php echo $hercules_audio_format; ?>: "<?php echo stripslashes(htmlspecialchars_decode($hercules_file)); ?>"
		});
		},
swfPath: "<?php echo get_template_directory_uri(); ?>/flash",
		supplied: "mp3, wav, ogg, all",
		cssSelectorAncestor: "#jp_container_<?php the_ID(); ?>",
solution: "flash, html",
		smoothPlayBar: true,
		keyEnabled: true
		
});
});
		</script>
		
		<!-- BEGIN audio -->
		<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer"></div>
		<div id="jp_container_<?php the_ID(); ?>" class="jp-audio">
			<div class="jp-type-single">
				<div class="jp-gui">
					<div class="jp-interface">
						<div class="jp-progress">
							<div class="jp-seek-bar">
								<div class="jp-play-bar"></div>
							</div>
						</div>
						<div class="jp-current-time"></div>
						<div class="jp-title"><?php echo $hercules_audio_artist; ?> : <?php echo $hercules_audio_title; ?></div>
						
						<div class="jp-controls-holder">
							<ul class="jp-controls">
								<li><a href="javascript:;" class="jp-play" tabindex="1" title="Play"><span>Play</span></a></li>
								<li><a href="javascript:;" class="jp-pause" tabindex="1" title="Pause"><span>Pause</span></a></li>
							</ul>
							<div class="jp-volume-bar">
								<div class="jp-volume-bar-value"></div>
							</div>
							
						</div>
					</div>
					<div class="jp-no-solution">
						<span>Update Required. </span>To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
					</div>
				</div>
			</div>
		</div>
		<!-- END audio -->
	</div>
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
	<?php }else{} ?>
	</div>
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
	<!--// Post Content -->
	<?php endif; ?>
	</div></div>
<?php get_template_part( 'includes/post-formats/share-buttons' ); ?>
</article><!--//.post__holder-->