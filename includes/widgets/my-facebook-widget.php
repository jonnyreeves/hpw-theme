<?php
	class My_Facebook_Widget extends WP_Widget {
		public function __construct() {
			parent::__construct('My_Facebook_Widget',  theme_locals("facebook_widget_name"), array( 'description' => theme_locals("facebook_widget_disc")) );
		}
	
		public function widget( $args, $instance ){
			extract($args, EXTR_SKIP);
			$title          = apply_filters('widget_title', empty($instance['title']) ? theme_locals("facebook_title") : $instance['title']);
			$facebook_URL   = apply_filters('widget_facebook_URL', empty($instance['facebook_URL']) ? '' : $instance['facebook_URL']);
			$box_width      = apply_filters('widget_box_width', empty($instance['box_width']) ? '300' : $instance['box_width']);
			$box_height     = apply_filters('widget_box_height', empty($instance['box_height']) ? '500' : $instance['box_height']);
			$display_haeder = apply_filters('widget_display_haeder', empty($instance['display_haeder']) ? 'false' : 'true');
			$display_faces  = apply_filters('widget_display_faces', empty($instance['display_faces']) ? 'false' : 'true');
			$display_stream = apply_filters('widget_display_stream', empty($instance['display_stream']) ? 'false' : 'true');
			$small_header = apply_filters('widget_small_header', empty($instance['small_header']) ? 'false' : 'true');
			$location       = get_bloginfo('language')==""? "en_US" : str_replace('-', '_', get_bloginfo('language'));

			if($facebook_URL!=''){
				echo $before_widget;
				echo $before_title . $title . $after_title; 
				?>
				<div class="facebook_like_box">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $location; ?>/sdk.js#xfbml=1&version=v2.4&appId=290794764313764";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-page" data-href="<?php esc_html_e($facebook_URL); ?>" data-width="<?php echo $box_width; ?>" data-height="<?php echo $box_height; ?>" data-small-header="<?php echo $small_header; ?>" data-adapt-container-width="true" data-hide-cover="<?php echo $display_haeder; ?>" data-show-facepile="<?php echo $display_faces; ?>" data-show-posts="<?php echo $display_stream; ?>"><div class="fb-xfbml-parse-ignore"></div></div></div>
			<?php
				echo $after_widget; 
			}else { 
			echo $before_widget;
			echo $before_title . $title . $after_title;
			echo theme_locals("facebook_error"); 
			echo $after_widget; }
		}
		public function update( $new_instance, $old_instance ){
			$instance                   = $old_instance;
			$instance['title']          = strip_tags($new_instance['title']);
			$instance['facebook_URL']   = $new_instance['facebook_URL'];
			$instance['box_width']      = $new_instance['box_width'];
			$instance['box_height']     = $new_instance['box_height'];
			$instance['color_scheme']   = $new_instance['color_scheme'];
			$instance['display_haeder'] = $new_instance['display_haeder'];
			$instance['display_faces']  = $new_instance['display_faces'];
			$instance['display_stream'] = $new_instance['display_stream'];
			$instance['small_header'] = $new_instance['small_header'];

			return $instance;
		}
		public function form( $instance ){   
			$defaults = array('title' => 'My Facebook Page', 'facebook_URL'=>'', 'box_width' => '300', 'box_height' => '500', 'color_scheme' => 'light', 'display_haeder' => 'on', 'display_faces' => 'on', 'display_stream' => 'on', 'small_header' => 'on', 'display_header' => 'on');
			$instance = wp_parse_args( (array) $instance, $defaults );

			$title          = esc_attr($instance['title']);
			$facebook_URL   = $instance['facebook_URL'];
			$box_width      = $instance['box_width'];
			$box_height     = $instance['box_height'];
			$color_scheme   = $instance['color_scheme'];
			$display_haeder = $instance['display_haeder'];
			$display_faces  = $instance['display_faces'];
			$display_stream = $instance['display_stream'];
			$small_header = $instance['small_header'];

			?>
			<!--title-->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo theme_locals("title"); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>
			<!--facebook_URL-->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('facebook_URL')); ?>"><?php echo theme_locals("facebook_url").':'; ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook_URL')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook_URL')); ?>" type="text" value="<?php echo esc_attr($facebook_URL); ?>" />
				<span style="font-size:11px; color:#999;"><?php echo theme_locals("facebook_desc"); ?></span>
			</p>
			<!--box_width-->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('box_width')); ?>"><?php echo theme_locals("width"); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('box_width')); ?>" name="<?php echo esc_attr($this->get_field_name('box_width')); ?>" type="text" value="<?php echo esc_attr($box_width); ?>" />
			</p>
			<!--box_height-->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('box_height')); ?>"><?php echo theme_locals("height"); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('box_height')); ?>" name="<?php echo esc_attr($this->get_field_name('box_height')); ?>" type="text" value="<?php echo esc_attr($box_height); ?>" />
			</p>
			<!--display_haeder-->
			<p>
				<input class="checkbox" id="<?php echo $this->get_field_id('display_haeder'); ?>" name="<?php echo $this->get_field_name('display_haeder'); ?>" type="checkbox" <?php checked($instance['display_haeder'], 'on' ); ?> /> <label for="<?php echo $this->get_field_id('display_haeder'); ?>"><?php echo theme_locals("display_haeder")."."; ?></label>
			</p>
			<!--display_faces-->
			<p>
				<input class="checkbox" id="<?php echo $this->get_field_id('display_faces'); ?>" name="<?php echo $this->get_field_name('display_faces'); ?>" type="checkbox" <?php checked($instance['display_faces'], 'on' ); ?> /> <label for="<?php echo $this->get_field_id('display_faces'); ?>"><?php echo theme_locals("display_faces")."."; ?></label>
			</p>
			<!--display_stream-->
			<p>
				<input class="checkbox" id="<?php echo $this->get_field_id('display_stream'); ?>" name="<?php echo $this->get_field_name('display_stream'); ?>" type="checkbox" <?php checked($instance['display_stream'], 'on' ); ?> /> <label for="<?php echo $this->get_field_id('display_stream'); ?>"><?php echo theme_locals("display_stream")."."; ?></label>
			</p>
			<!--small_header-->
			<p>
				<input class="checkbox" id="<?php echo $this->get_field_id('small_header'); ?>" name="<?php echo $this->get_field_name('small_header'); ?>" type="checkbox" <?php checked($instance['small_header'], 'on' ); ?> /> <label for="<?php echo $this->get_field_id('small_header'); ?>"><?php echo theme_locals("small_header")."."; ?></label>
			</p>
			<?php
		}
	}
?>