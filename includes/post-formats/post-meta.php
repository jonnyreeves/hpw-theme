<?php $post_meta = of_get_option('post_meta'); ?>
<?php if ($post_meta=='true' || $post_meta=='') { 
$post_ID = get_the_ID();
$blog_author_name = of_get_option('blog_author_name');
$post_author = of_get_option('post_author');
$date_format = of_get_option('date_format');
?>
	<!-- Post Meta -->
	<div class="meta-space">
		<?php		
		if ($post_author=='yes' || $post_author=='') { ?>
		<span class="vcard author"><span><?php echo $blog_author_name; ?> <i class="fn"><?php the_author_posts_link() ?></i></span></span>
		<?php } ?>
		<?php if (of_get_option('post_date')=="yes") { ?>
	<span class="post-date date updated"><i class="icon-calendar-2"></i> <?php if ($date_format) { the_time($date_format); }else{the_time('d M Y');} ?></span>
	<?php } ?>
		<?php if(of_get_option('post_comment') != 'no'){ ?>
		<span><i class="icon-comment-2"></i> <?php comments_popup_link(theme_locals('no_comments'), theme_locals('comment'), '%'.theme_locals('comments'), theme_locals('comments_link'), theme_locals('comments_closed')); ?></span>
		<?php } ?>
		<?php if(of_get_option('post_category') != 'no'){ ?>
		<span class="post_category"><i class="icon-cloud-2"></i><?php the_category(', ') ?></span>
		<?php } ?>
				<?php if(of_get_option('post_tag') != 'no'){ ?>
									<span><i class="icon-tag-2"></i>
									<?php 
										if(get_the_tags()){
											the_tags('', ', ');
										} else {
											echo theme_locals('has_not_tags');
										}
									 ?>
								</span>
								<?php
							} ?>
		<?php if(of_get_option('post_permalink') != 'no'){ ?>
		<span class="post_permalink"><i class="icon-attach-2"></i><a href="<?php the_permalink(); ?>" title="<?php echo theme_locals('permalink_to');?> <?php the_title(); ?>"><?php echo theme_locals('permalink_to'); ?></a></span>
		<?php } ?>
		
	<?php if( function_exists('zilla_likes') ) { echo '<span>';  zilla_likes(); echo '</span>'; } ?>
	</div>
	<!--// Post Meta -->
<?php } ?>