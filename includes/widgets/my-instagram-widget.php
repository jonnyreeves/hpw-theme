<?php
// =============================== My Instagram widget  ======================================
  
class MY_InstagramWidget extends WP_Widget {
function __construct() {
$widget_ops = array(
'classname' => 'instagram',
'description' => __('A widget that displays the latest Instagram images', HS_CURRENT_THEME)
);
parent::__construct( 'instagram-widget', __('hercules - Instagram', HS_CURRENT_THEME), $widget_ops );
}   // Widget Settings


  /** @see WP_Widget::widget */
  function widget($args, $instance) {	
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $userid = apply_filters('userid', $instance['userid']);
    $accessToken = apply_filters('accessToken', $instance['accessToken']);
	$amount = apply_filters('instagram_image_amount', $instance['image_amount']);
	
	
?>
<?php echo $before_widget; 
if ( $title )
echo $before_title . $title . $after_title; ?>
                 

<?php
	
		// Gets our data
		function fetchData($url){
		     $ch = curl_init();
		     curl_setopt($ch, CURLOPT_URL, $url);
		     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		     curl_setopt($ch, CURLOPT_TIMEOUT, 20);
			 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		     $result = curl_exec($ch);
		     curl_close($ch); 
		     return $result;
		}

		// Pulls and parses data.
		$result = fetchData('https://api.instagram.com/v1/users/'.$userid.'/media/recent/?access_token='.$accessToken.'&count='.$amount);
		$result = json_decode($result);
	?>
	<div class="grid_gallery clearfix">
					
						<div class="grid_gallery_inner">
<div id="instagram" class="zoom-instagram">

	<?php if(!empty($result->data)){
	foreach ($result->data as $post){ ?>
		<!-- Renders images. @Options (thumbnail,low_resoulution, high_resolution) -->
		<div class="gallery_item">
		<figure class="featured-thumbnail thumbnail large">
		<div class="hider-page"></div>
		<a data-source="<?php if(!empty($post->user->username)){ echo $post->user->username; } ?>" title="<?php if ( isset($instance['show_caption'])){ if(!empty($post->caption->text)){ echo $post->caption->text; }} ?>" class="thumbnail zoomer" href="<?php echo $post->images->standard_resolution->url ?>"><img src="<?php echo $post->images->thumbnail->url ?>" alt="<?php if ( isset($instance['show_caption'])){ if(!empty($post->caption->text)){ echo $post->caption->text; }} ?>"><div class="zoom-insta"><?php if ( isset($instance['show_caption'])){ if(!empty($post->caption->text)){ echo '<div class="instagram_caption">'.$post->caption->text.'</div>'; }} ?></div></a>
		<?php if ( isset($instance['show_likes'])){ if(!empty($post->likes->count)){ echo '<div class="instagram_likes"><i class="icon-heart-empty"></i> <span class="likes_count">'.$post->likes->count.'</span></div>'; }} ?>  
		</figure>
		</div>
	<?php }
	}else{
	echo "<strong>Configuration error or no pictures...</strong>";			
		} ?>
	<div style="clear:both;"></div>
</div>
</div>
</div>

<?php wp_reset_query(); ?>
								
<?php echo $after_widget; ?>
			 
<?php }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {	
	$instance['show_likes'] = strip_tags($new_instance['show_likes']);
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
      /* Set up some default widget settings. */
      $defaults = array( 'title' => '', 'userid' => '', 'accessToken' => '', 'image_amount' => '', 'show_likes' => '', 'show_caption' => '' );
      $instance = wp_parse_args( (array) $instance, $defaults );	

      $title = esc_attr($instance['title']);
			$userid = esc_attr($instance['userid']);
			$accessToken = esc_attr($instance['accessToken']);
			$amount = esc_attr($instance['image_amount']);
			
			
        ?>
		<p>Generate your Instagram user ID and Instagram access token on: <a target="_blank" href="http://www.pinceladasdaweb.com.br/instagram/access-token/">Instagram access token generator</a> website</p>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', HS_CURRENT_THEME); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

      <p><label for="<?php echo $this->get_field_id('userid'); ?>"><?php _e('Instagram user ID:', HS_CURRENT_THEME); ?> <input class="widefat" id="<?php echo $this->get_field_id('userid'); ?>" name="<?php echo $this->get_field_name('userid'); ?>" type="text" value="<?php echo $userid; ?>" /></label></p>
	  	<p><label for="<?php echo $this->get_field_id('accessToken'); ?>"><?php _e('Instagram access token:', HS_CURRENT_THEME); ?> <input class="widefat" id="<?php echo $this->get_field_id('accessToken'); ?>" name="<?php echo $this->get_field_name('accessToken'); ?>" type="text" value="<?php echo $accessToken; ?>" /></label></p>	
		<p><label for="<?php echo $this->get_field_id('image_amount'); ?>"><?php _e('Images count:', HS_CURRENT_THEME); ?> <input class="widefat" id="<?php echo $this->get_field_id('image_amount'); ?>" name="<?php echo $this->get_field_name('image_amount'); ?>" type="text" value="<?php echo $amount; ?>" /></label></p>	
		  <p>
      <label for="<?php echo $this->get_field_id("show_likes"); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_likes"); ?>" name="<?php echo $this->get_field_name("show_likes"); ?>"<?php checked( (bool) $instance["show_likes"], true ); ?> />
          <?php _e( 'Show Likes', HS_CURRENT_THEME ); ?>
      </label>
  </p>
  <p>
      <label for="<?php echo $this->get_field_id("show_caption"); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_caption"); ?>" name="<?php echo $this->get_field_name("show_caption"); ?>"<?php checked( (bool) $instance["show_caption"], true ); ?> />
          <?php _e( 'Show caption', HS_CURRENT_THEME ); ?>
      </label>
  </p>
			
<?php }

} // class  Widget
?>