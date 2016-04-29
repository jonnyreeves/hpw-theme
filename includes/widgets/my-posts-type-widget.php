<?php
/*
// =============================== My Recent News ======================================*/
class MY_PostsTypeWidget extends WP_Widget {

function __construct() {
		$widget_ops = array('classname' => 'my_posts_type_widget', 'description' => __('Show custom posts', HS_CURRENT_THEME));
		$control_ops = array('width' => 500, 'height' => 350);
	    parent::__construct(false, __('hercules - Recent News', HS_CURRENT_THEME), $widget_ops, $control_ops);
}

/**
 * Displays custom posts widget on blog.
 */
function widget($args, $instance) {
	global $post;
	$post_old = $post; // Save the post object.
	
	extract( $args );
  if (isset($instance['excerpt_length']))
    $limit = apply_filters('widget_title', $instance['excerpt_length']);
  else
    $limit = 0;

	
  $valid_sort_orders = array('date', 'title', 'rand');
  if ( in_array($instance['sort_by'], $valid_sort_orders) ) {
    $sort_by = $instance['sort_by'];
    $sort_order = (bool) $instance['asc_sort_order'] ? 'ASC' : 'DESC';
  } else {
    // by default, display latest first
    $sort_by = 'date';
    $sort_order = 'DESC';
  }
	
	// Get array of post info.
	
	$args = array(
		'showposts' => $instance["num"],
		'category_name' => $instance['posts_category'],
		'post_type' => 'post',
		'orderby' => $sort_by,
		'order' => $sort_order,
		'tax_query' => array(
		 'relation' => 'AND',
			array(
				'taxonomy' => 'post_format',
				
				'terms' => array('post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-audio', 'post-format-video'),
				'operator' => 'NOT IN'
			)
		)
	);
	
  $cat_posts = new WP_Query($args);
	
	echo $before_widget;
	
	// Widget title
	// If title exist.
	if( $instance["title"] ) {
	echo $before_title;
		echo $instance["title"];
	echo $after_title;
    }

	// Posts list
    if($instance['container_class']==""){
	echo "<ul class='post-list unstyled'>\n";
	}else{
    echo "<ul class='post-list unstyled " .$instance['container_class'] ."'>\n";
    }
	
	$limittext = $limit;
	$posts_counter = 0;
	while ( $cat_posts->have_posts() )
	{
		$cat_posts->the_post(); $posts_counter++;
	?>
    <?php if ($instance['posttype'] == "testi") {
      $custom = get_post_custom($post->ID);
      $testiname = $custom["testimonial-name"][0];
      $testiurl = $custom["testimonial-url"][0];
    }

    ?>
		<li class="cat_post_item-<?php echo $posts_counter; ?> clearfix">
					<div class="small">
   <?php if ( $instance['date'] ) : ?>
        <time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time>
      <?php endif; ?>
      <?php if ( $instance['comment_num'] ) : ?>
        | <span class="post-list_comment"><?php comments_number(); ?></span>
      <?php endif; ?>
      </div>
         <div class="post-list_h">
      <?php if ( $instance['show_title'] ) : ?>
			  <h4><a class="post-title" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php if ( $instance['show_title_date'] ) {?>[<?php the_time('m-d-Y'); ?>]<?php }else{?><?php the_title(); ?><?php }?></a></h4>
			<?php endif; ?>
      		<?php 
        if(has_post_thumbnail()) {
          if ($instance["thumb"]) : ?>
          <div style="margin: 12px 0 0 0;">
		  <figure class="featured-thumbnail thumbnail large">
          <?php if ( $instance['thumb_as_link'] ) : ?>
              <a class="image-wrap" href="<?php the_permalink() ?>">
            <?php endif; ?>

              <?php the_post_thumbnail('standard'); ?>

            <?php if ( $instance['thumb_as_link'] ) : ?>
              <span class="zoom-icon"></span></a>
            <?php endif; ?>
			</figure>
          </div>
        <?php endif;
      }		
   ?> 	
        <?php if ( $instance['excerpt'] ) : ?>
		<div class="para">
	       <?php if($limittext=="" || $limittext==0){ ?>
		  <?php if ( $instance['excerpt_as_link'] ) : ?>
                <a href="<?php the_permalink() ?>">
              <?php endif; ?>
           <?php $excerpt = get_the_content();
echo limit_text($excerpt,$limittext); ?>
		  <?php if ( $instance['excerpt_as_link'] ) : ?>
                </a>
              <?php endif; ?>
          <?php }else{ ?>
		  <?php if ( $instance['excerpt_as_link'] ) : ?>
                <a href="<?php the_permalink() ?>">
              <?php endif; ?>
            <?php $excerpt = get_the_content();
echo limit_text($excerpt,$limittext); ?>
		  <?php if ( $instance['excerpt_as_link'] ) : ?>
                </a>
              <?php endif; ?>
          <?php } ?>
		   </div>
        <?php endif; ?>
      </div>
	  
			<?php if ($instance['posttype'] == "testi") { ?>
        <div class="name-testi"><span class="user"><?php echo $testiname; ?></span>, <a href="<?php echo $testiurl; ?>"><?php echo $testiurl; ?></a></div>
      <?php }?>
      <?php if ( $instance['more_link'] ) : ?>
        <a href="<?php the_permalink() ?>" class="<?php if($instance['more_link_class']!="") {echo $instance['more_link_class'];}else{ ?>link<?php } ?>"><?php if($instance['more_link_text']==""){ ?>Read more<?php }else{ ?><?php echo $instance['more_link_text']; ?><?php } ?></a>
      <?php endif; ?>
		</li><!--//.post-list_li -->
    
	<?php } ?>
	<?php echo "</ul>\n"; ?>
	<?php if ( $instance['global_link'] ) : ?>
	  <a href="<?php echo $instance['global_link_href']; ?>" class="btn btn-primary link_show_all"><?php if($instance['global_link_text']==""){ ?>View all<?php }else{ ?><?php echo $instance['global_link_text']; ?><?php } ?></a>
	<?php endif; ?>
	
<?php 	
	echo $after_widget;
	
	$post = $post_old; // Restore the post object.
}

/**
 * Form processing.
 */
function update($new_instance, $old_instance) {
  $instance = $old_instance;
  $instance['asc_sort_order'] = strip_tags($new_instance['asc_sort_order']);
  $instance['thumb'] = strip_tags($new_instance['thumb']);
  $instance['thumb_as_link'] = strip_tags($new_instance['thumb_as_link']);
  $instance['excerpt_length'] = strip_tags($new_instance['excerpt_length']);
  $instance['sort_by'] = strip_tags($new_instance['sort_by']);
  $instance['num'] = strip_tags($new_instance['num']);
  $instance['posttype'] = strip_tags($new_instance['posttype']);
  $instance['title'] = strip_tags($new_instance['title']);
  $instance['container_class'] = strip_tags($new_instance['container_class']);
  $instance['posts_category'] = strip_tags($new_instance['posts_category']);
  $instance['date'] = strip_tags($new_instance['date']);
  $instance['comment_num'] = strip_tags($new_instance['comment_num']);
  $instance['show_title'] = strip_tags($new_instance['show_title']);
  $instance['show_title_date'] = strip_tags($new_instance['show_title_date']);
  $instance['excerpt'] = strip_tags($new_instance['excerpt']);
  $instance['excerpt_as_link'] = strip_tags($new_instance['excerpt_as_link']);
  $instance['more_link'] = strip_tags($new_instance['more_link']);
  $instance['more_link_class'] = strip_tags($new_instance['more_link_class']);
  $instance['more_link_text'] = strip_tags($new_instance['more_link_text']);
  $instance['global_link'] = strip_tags($new_instance['global_link']);
  $instance['global_link_href'] = strip_tags($new_instance['global_link_href']);
  $instance['global_link_text'] = strip_tags($new_instance['global_link_text']);
	return $instance;
}

/**
 * The configuration form.
 */
function form($instance) {
  /* Set up some default widget settings. */
  $defaults = array( 'title' => '', 'posttype' => '', 'num' => '', 'sort_by' => '', 'asc_sort_order' => '', 'comment_num' => '', 'date' => '', 'container_class' => '', 'posts_category' => '', 'show_title' => '', 'show_title_date' => '', 'excerpt' => '', 'excerpt_length' => '', 'excerpt_as_link' => '', 'more_link' => '', 'more_link_text' => '', 'more_link_class' => '', 'thumb' => '', 'thumb_as_link' => '', 'global_link' => '', 'global_link_text' => '', 'global_link_href' => '' );
  $instance = wp_parse_args( (array) $instance, $defaults );

  $sort_by = esc_attr($instance['sort_by']);
?>

  <p>
    <label for="<?php echo $this->get_field_id("title"); ?>">
        <?php _e( 'Title', HS_CURRENT_THEME ); ?>:
        <input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
    </label>
  </p>
  <div style="width:230px; float:left; padding-right:20px; border-right:1px solid #c7c7c7;">

  <p>
      <label for="<?php echo $this->get_field_id("num"); ?>">
          <?php _e('Number of posts to show', HS_CURRENT_THEME); ?>:
          <input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo absint($instance["num"]); ?>" size='4' />
      </label>
</p>

<p>
  <label for="<?php echo $this->get_field_id("sort_by"); ?>">
  <?php _e('Sort by', HS_CURRENT_THEME); ?>:
    <select id="<?php echo $this->get_field_id("sort_by"); ?>" name="<?php echo $this->get_field_name("sort_by"); ?>">
      <?php
        $options = array('date', 'title', 'rand');
            foreach ($options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $sort_by == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
  </label>
</p>
  
<p>
  <label for="<?php echo $this->get_field_id("asc_sort_order"); ?>">
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("asc_sort_order"); ?>" name="<?php echo $this->get_field_name("asc_sort_order"); ?>" value="1" <?php checked( (bool) $instance["asc_sort_order"], true ); ?> />
          <?php _e( 'Reverse sort order (ascending)', HS_CURRENT_THEME ); ?>
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id("comment_num"); ?>">
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("comment_num"); ?>" name="<?php echo $this->get_field_name("comment_num"); ?>"<?php checked( (bool) $instance["comment_num"], true ); ?> />
      <?php _e( 'Show number of comments', HS_CURRENT_THEME ); ?>
  </label>
</p>

<p>
  <label for="<?php echo $this->get_field_id("date"); ?>">
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("date"); ?>" name="<?php echo $this->get_field_name("date"); ?>"<?php checked( (bool) $instance["date"], true ); ?> />
      <?php _e( 'Show meta', HS_CURRENT_THEME ); ?>
  </label>
</p>

<p>
  <label for="<?php echo $this->get_field_id("posts_category"); ?>">
    <?php _e( 'Category', HS_CURRENT_THEME ); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id("posts_category"); ?>" name="<?php echo $this->get_field_name("posts_category"); ?>" type="text" value="<?php echo esc_attr($instance["posts_category"]); ?>" /> <span style="font-size:11px; color:#999;"><?php _e( '(category: enter category slug (NOT name))' ); ?></span>
  </label>
</p>


<p>
  <label for="<?php echo $this->get_field_id("container_class"); ?>">
    <?php _e( 'Container class', HS_CURRENT_THEME ); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id("container_class"); ?>" name="<?php echo $this->get_field_name("container_class"); ?>" type="text" value="<?php echo esc_attr($instance["container_class"]); ?>" /> <span style="font-size:11px; color:#999;"><?php _e( '(default: "featured_custom_posts")' ); ?></span>
  </label>
</p>

  <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php _e('Post title', HS_CURRENT_THEME); ?>:</legend>
  <p>
      <label for="<?php echo $this->get_field_id("show_title"); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_title"); ?>" name="<?php echo $this->get_field_name("show_title"); ?>"<?php checked( (bool) $instance["show_title"], true ); ?> />
          <?php _e( 'Show post title', HS_CURRENT_THEME ); ?>
      </label>
  </p>
  <p>
      <label for="<?php echo $this->get_field_id("show_title_date"); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_title_date"); ?>" name="<?php echo $this->get_field_name("show_title_date"); ?>"<?php checked( (bool) $instance["show_title_date"], true ); ?> />
          <?php _e( 'Date as title <span style="font-size:11px; color:#999;">("[mm-dd-yyyy]")</span>' ); ?>
      </label>
  </p>
  
  </fieldset>

  <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php _e('Excerpt', HS_CURRENT_THEME); ?>:</legend>
  <p>
      <label for="<?php echo $this->get_field_id("excerpt"); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("excerpt"); ?>" name="<?php echo $this->get_field_name("excerpt"); ?>"<?php checked( (bool) $instance["excerpt"], true ); ?> />
          <?php _e( 'Show post excerpt', HS_CURRENT_THEME ); ?>
      </label>
  </p>
  <p>
      <label for="<?php echo $this->get_field_id("excerpt_length"); ?>">
          <?php _e( 'Excerpt length (words):', HS_CURRENT_THEME ); ?>
      </label>
      <input style="text-align: center;" type="text" id="<?php echo $this->get_field_id("excerpt_length"); ?>" name="<?php echo $this->get_field_name("excerpt_length"); ?>" value="<?php echo $instance["excerpt_length"]; ?>" size="3" />
  </p>
  <p>
      <label for="<?php echo $this->get_field_id("excerpt_as_link"); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("excerpt_as_link"); ?>" name="<?php echo $this->get_field_name("excerpt_as_link"); ?>"<?php checked( (bool) $instance["excerpt_as_link"], true ); ?> />
          <?php _e( 'Excerpt as link', HS_CURRENT_THEME ); ?>
      </label>
  </p>
  </fieldset>
</div>
<div style="width:230px; float:left; padding-left:17px;">
  <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php _e('More link', HS_CURRENT_THEME); ?>:</legend>
  <p>
      <label for="<?php echo $this->get_field_id("more_link"); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("more_link"); ?>" name="<?php echo $this->get_field_name("more_link"); ?>"<?php checked( (bool) $instance["more_link"], true ); ?> />
          <?php _e( 'Show "More link"' ); ?>
      </label>
  </p>
  
  <p>
  <label for="<?php echo $this->get_field_id("more_link_text"); ?>">
    <?php _e( 'Link text', HS_CURRENT_THEME ); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id("more_link_text"); ?>" name="<?php echo $this->get_field_name("more_link_text"); ?>" type="text" value="<?php echo esc_attr($instance["more_link_text"]); ?>" /> <span style="font-size:11px; color:#999;"><?php _e( '(default: "Read more")' ); ?></span>
  </label>
  </p>
  <p>
  <label for="<?php echo $this->get_field_id("more_link_class"); ?>">
    <?php _e( 'Link class', HS_CURRENT_THEME ); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id("more_link_class"); ?>" name="<?php echo $this->get_field_name("more_link_class"); ?>" type="text" value="<?php echo esc_attr($instance["more_link_class"]); ?>" /> <span style="font-size:11px; color:#999;"><?php _e( '(default: "link")' ); ?></span>
  </label>
  </p>
  </fieldset>
  <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php _e('Thumbnail', HS_CURRENT_THEME); ?>:</legend>
  <?php if ( function_exists('the_post_thumbnail') && current_theme_supports("post-thumbnails") ) : ?>
  <p>
      <label for="<?php echo $this->get_field_id("thumb"); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("thumb"); ?>" name="<?php echo $this->get_field_name("thumb"); ?>" value="1" <?php checked( (bool) $instance["thumb"], true ); ?> />
          <?php _e( 'Show post thumbnail', HS_CURRENT_THEME ); ?>
      </label>
  </p>
  <p>
      <label for="<?php echo $this->get_field_id("thumb_as_link"); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("thumb_as_link"); ?>" name="<?php echo $this->get_field_name("thumb_as_link"); ?>"<?php checked( (bool) $instance["thumb_as_link"], true ); ?> />
          <?php _e( 'Thumbnail as link', HS_CURRENT_THEME ); ?>
      </label>
  </p>
  </fieldset>
  <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php _e('Link to all posts', HS_CURRENT_THEME); ?>:</legend>
  <p>
      <label for="<?php echo $this->get_field_id("global_link"); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("global_link"); ?>" name="<?php echo $this->get_field_name("global_link"); ?>"<?php checked( (bool) $instance["global_link"], true ); ?> />
          <?php _e( 'Show global link to all posts', HS_CURRENT_THEME ); ?>
      </label>
  </p>
  <p>
  <label for="<?php echo $this->get_field_id("global_link_text"); ?>">
    <?php _e( 'Link text', HS_CURRENT_THEME ); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id("global_link_text"); ?>" name="<?php echo $this->get_field_name("global_link_text"); ?>" type="text" value="<?php echo esc_attr($instance["global_link_text"]); ?>" /> <span style="font-size:11px; color:#999;"><?php _e( '(default: "View all")' ); ?></span>
  </label>
  </p>
  <p>
      <label for="<?php echo $this->get_field_id("global_link_href"); ?>">
          <?php _e( 'Link URL', HS_CURRENT_THEME ); ?>:
          <input class="widefat" id="<?php echo $this->get_field_id("global_link_href"); ?>" name="<?php echo $this->get_field_name("global_link_href"); ?>" type="text" value="<?php echo esc_attr($instance["global_link_href"]); ?>" />
      </label>
  </p>
  </fieldset>
</div>
<div style="clear:both;"></div>



		<?php endif; ?>

<?php

}

}
?>