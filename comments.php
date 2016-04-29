<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
  	<?php echo '<p class="nocomments">' . __('This post is password protected. Enter the password to view comments.', HS_CURRENT_THEME ) . '</p>'; ?>
	<?php
		return;
	}
?>
<!-- BEGIN Comments -->	
	<?php if ( have_comments() ) : ?>
	<div id="comments" class="comment-holder">
		<h5 class="comments-h"><?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), HS_CURRENT_THEME ),
				number_format_i18n( get_comments_number() ), '' );?></h5>
		<div class="pagination">
		  <?php paginate_comments_links('prev_text=Prev&next_text=Next'); ?> 
		</div>
		<ul class="commentlist">
<?php wp_list_comments('type=comment&callback=hercules_comment'); ?>
</ul>
		<div class="pagination">
		  <?php paginate_comments_links('prev_text=Prev&next_text=Next'); ?> 
		</div>
	</div>
	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
			<!-- If comments are open, but there are no comments. -->
	   <?php echo '<p class="nocomments">' . __('No Comments Yet.', HS_CURRENT_THEME ) . '</p>'; ?>
		<?php else : // comments are closed ?>
			<!-- If comments are closed. -->
	   <?php // echo '<p class="nocomments">' . __('Comments are closed.', HS_CURRENT_THEME ) . '</p>'; ?>

		<?php endif; ?>
	
	<?php endif; ?>
	

	<?php $hercules_comments_args = array(
        // change the title of send button 
        'label_submit'=> __( 'Post Comment',HS_CURRENT_THEME),
        // change the title of the reply section
        'title_reply'=> __( 'Leave a Reply',HS_CURRENT_THEME),
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_after' => '',
        // redefine your own textarea (the comment body)
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', HS_CURRENT_THEME ) . '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
);

comment_form($hercules_comments_args); ?>
