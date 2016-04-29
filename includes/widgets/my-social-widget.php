<?php
// =============================== My Social Networks Widget ====================================== //
class My_SocialNetworksWidget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'social_networks_widget', 'description' => __('Link to your social networks.', HS_CURRENT_THEME));
		parent::__construct('social_networks', __('hercules - Social Networks', HS_CURRENT_THEME), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		
		$networks['Twitter']['link'] = $instance['twitter'];
		$networks['Facebook']['link'] = $instance['facebook'];
		$networks['Flickr']['link'] = $instance['flickr'];
		$networks['Rss']['link'] = $instance['rss'];
		$networks['Linkedin']['link'] = $instance['linkedin'];
		$networks['Instagram']['link'] = $instance['instagram'];
		$networks['Youtube']['link'] = $instance['youtube'];
		$networks['Aim']['link'] = $instance['aim'];
		$networks['Dribbble']['link'] = $instance['dribbble'];
		$networks['Deviantart']['link'] = $instance['deviantart'];
		$networks['Gplus']['link'] = $instance['gplus'];
		$networks['Pinterest']['link'] = $instance['pinterest'];
		$networks['Vimeo']['link'] = $instance['vimeo'];
		$networks['Goodreads']['link'] = $instance['goodreads'];
		$networks['Bloglovin']['link'] = $instance['bloglovin'];
		$networks['Tumblr']['link'] = $instance['tumblr'];
		$networks['Vkontakte']['link'] = $instance['vkontakte'];
		$networks['Mail']['link'] = $instance['mail'];
		
		$networks['Twitter']['label'] = $instance['twitter_label'];
		$networks['Facebook']['label'] = $instance['facebook_label'];
		$networks['Flickr']['label'] = $instance['flickr_label'];
		$networks['Rss']['label'] = $instance['rss_label'];
		$networks['Linkedin']['label'] = $instance['linkedin_label'];
		$networks['Instagram']['label'] = $instance['instagram_label'];
		$networks['Youtube']['label'] = $instance['youtube_label'];
		$networks['Aim']['label'] = $instance['aim_label'];
        $networks['Dribbble']['label'] = $instance['dribbble_label'];
		$networks['Deviantart']['label'] = $instance['deviantart_label'];
		$networks['Gplus']['label'] = $instance['gplus_label'];
		$networks['Pinterest']['label'] = $instance['pinterest_label'];
		$networks['Vimeo']['label'] = $instance['vimeo_label'];
		$networks['Goodreads']['label'] = $instance['goodreads_label'];
		$networks['Bloglovin']['label'] = $instance['bloglovin_label'];
		$networks['Tumblr']['label'] = $instance['tumblr_label'];
		$networks['Vkontakte']['label'] = $instance['vkontakte_label'];
		$networks['Mail']['label'] = $instance['mail_label'];
		
		$display = $instance['display'];
		

		echo $before_widget;
		if ( $title )
    		echo $before_title . $title . $after_title;
		?>
			<!-- BEGIN SOCIAL NETWORKS -->
			<?php if ($display == "both" or $display =="labels") {
				$addClass = "social__list";
			} elseif ($display == "icons") { 
				//$addClass = "social__row clearfix";
				$addClass = "social__list";
			} ?>
			
			<div class="social <?php echo $addClass ?> unstyled">
				
			<?php foreach(array("Facebook", "Twitter", "Flickr", "Linkedin", "Dribbble", "Deviantart", "Pinterest", "Vimeo", "Gplus", "Instagram", "Aim", "Youtube", "Rss", "Goodreads", "Bloglovin", "Tumblr", "Vkontakte", "Mail") as $network) : ?>
	    		<?php if (!empty($networks[$network]['link'])) : ?>
				
					<?php if ($display == "both") { ?>
						<a target="_blank" class="icon-<?php echo strtolower($network);?> icon-2x social_link social_link__<?php echo strtolower($network); ?>" data-rel="tooltip" data-original-title="<?php echo strtolower($network); ?>" href="<?php echo $networks[$network]['link']; ?>">
							<span class="social_label"><?php if (($networks[$network]['label'])!=="") { echo $networks[$network]['label']; } else { echo $network; } ?></span>
							</a>
						<?php } ?>
					<?php if ($display == "icons") { ?>
						<a target="_blank" class="icon-<?php echo strtolower($network);?> icon-2x social_link social_link__<?php echo strtolower($network); ?>" data-rel="tooltip" data-original-title="<?php echo strtolower($network); ?>" href="<?php echo $networks[$network]['link']; ?>">
							</a>
						<?php } ?>
										<?php if ($display == "labels") { ?>
						<a target="_blank" class="social_link social_link__<?php echo strtolower($network); ?>" data-rel="tooltip" data-original-title="<?php echo strtolower($network); ?>" href="<?php echo $networks[$network]['link']; ?>">
							<span class="social_label_only"><?php if (($networks[$network]['label'])!=="") { echo $networks[$network]['label']; } else { echo $network; } ?></span>
							</a>
						<?php } ?>
				
				<?php endif; ?>
			<?php endforeach; ?>
		      
   		</div>
   		<!-- END SOCIAL NETWORKS -->
      
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['twitter'] = $new_instance['twitter'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['flickr'] = $new_instance['flickr'];
		$instance['rss'] = $new_instance['rss'];
		$instance['linkedin'] = $new_instance['linkedin'];
		$instance['instagram'] = $new_instance['instagram'];
		$instance['youtube'] = $new_instance['youtube'];
		$instance['aim'] = $new_instance['aim'];
		$instance['dribbble'] = $new_instance['dribbble'];
		$instance['deviantart'] = $new_instance['deviantart'];
		$instance['gplus'] = $new_instance['gplus'];
		$instance['pinterest'] = $new_instance['pinterest'];
		$instance['vimeo'] = $new_instance['vimeo'];
		$instance['goodreads'] = $new_instance['goodreads'];
		$instance['bloglovin'] = $new_instance['bloglovin'];
		$instance['tumblr'] = $new_instance['tumblr'];
		$instance['vkontakte'] = $new_instance['vkontakte'];
		$instance['mail'] = $new_instance['mail'];
		
		$instance['twitter_label'] = $new_instance['twitter_label'];
		$instance['facebook_label'] = $new_instance['facebook_label'];
		$instance['flickr_label'] = $new_instance['flickr_label'];
		$instance['rss_label'] = $new_instance['rss_label'];
		$instance['linkedin_label'] = $new_instance['linkedin_label'];
		$instance['instagram_label'] = $new_instance['instagram_label'];
		$instance['youtube_label'] = $new_instance['youtube_label'];
		$instance['aim_label'] = $new_instance['aim_label'];
		$instance['dribbble_label'] = $new_instance['dribbble_label'];
		$instance['deviantart_label'] = $new_instance['deviantart_label'];
		$instance['gplus_label'] = $new_instance['gplus_label'];
		$instance['pinterest_label'] = $new_instance['pinterest_label'];
		$instance['vimeo_label'] = $new_instance['vimeo_label'];
		$instance['goodreads_label'] = $new_instance['goodreads_label'];
        $instance['bloglovin_label'] = $new_instance['bloglovin_label'];
		$instance['tumblr_label'] = $new_instance['tumblr_label'];
		$instance['vkontakte_label'] = $new_instance['vkontakte_label'];
		$instance['mail_label'] = $new_instance['mail_label'];
		
		$instance['display'] = $new_instance['display'];

		return $instance;
	}

	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'twitter' => '', 'twitter_label' => '', 'facebook' => '', 'facebook_label' => '', 'flickr' => '', 'flickr_label' => '', 'rss' => '', 'rss_label' => '', 'feed_label' => '', 'linkedin' => '', 'linkedin_label' => '', 'aim' => '', 'aim_label' => '', 'goodreads' => '', 'goodreads_label' => '', 'bloglovin' => '', 'bloglovin_label' => '', 'tumblr' => '', 'tumblr_label' => '', 'vkontakte' => '', 'vkontakte_label' => '', 'mail' => '', 'mail_label' => '', 'dribbble' => '', 'dribbble_label' => '', 'pinterest' => '', 'pinterest_label' => '', 'vimeo' => '', 'vimeo_label' => '', 'deviantart' => '', 'deviantart_label' => '', 'gplus' => '', 'gplus_label' => '', 'instagram' => '', 'instagram_label' => '', 'youtube' => '', 'youtube_label' => '', 'display' => 'icons', 'text' => '');
		$instance = wp_parse_args( (array) $instance, $defaults );
			
		$twitter = $instance['twitter'];		
		$facebook = $instance['facebook'];
		$flickr = $instance['flickr'];		
		$rss = $instance['rss'];
		$linkedin = $instance['linkedin'];	
		$instagram = $instance['instagram'];
		$youtube = $instance['youtube'];
		$aim = $instance['aim'];
		$dribbble = $instance['dribbble'];
		$deviantart = $instance['deviantart'];
		$gplus = $instance['gplus'];
		$pinterest = $instance['pinterest'];
		$vimeo = $instance['vimeo'];
		$goodreads = $instance['goodreads'];
		$bloglovin = $instance['bloglovin'];
		$tumblr = $instance['tumblr'];
		$vkontakte = $instance['vkontakte'];
		$mail = $instance['mail'];
		
		$twitter_label = $instance['twitter_label'];
		$facebook_label = $instance['facebook_label'];
		$flickr_label = $instance['flickr_label'];
		$rss_label = $instance['rss_label'];
		$linkedin_label = $instance['linkedin_label'];
		$instagram_label = $instance['instagram_label'];
		$youtube_label = $instance['youtube_label'];
		$aim_label = $instance['aim_label'];
		$dribbble_label = $instance['dribbble_label'];
		$deviantart_label = $instance['deviantart_label'];
		$gplus_label = $instance['gplus_label'];
		$pinterest_label = $instance['pinterest_label'];
		$vimeo_label = $instance['vimeo_label'];
	    $goodreads_label = $instance['goodreads_label'];
        $bloglovin_label = $instance['bloglovin_label'];
		$tumblr_label = $instance['tumblr_label'];
		$vkontakte_label = $instance['vkontakte_label'];
		$mail_label = $instance['mail_label'];
		
		$display = $instance['display'];		
		$title = strip_tags($instance['title']);
		$text = format_to_edit($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
    
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Facebook', HS_CURRENT_THEME); ?>:</legend>
			
			<p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" /></p>
			
			<p><label for="<?php echo $this->get_field_id('facebook_label'); ?>"><?php _e('Facebook label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook_label'); ?>" name="<?php echo $this->get_field_name('facebook_label'); ?>" type="text" value="<?php echo esc_attr($facebook_label); ?>" /></p>
		</fieldset>	
		
        <fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Twitter', HS_CURRENT_THEME); ?>:</legend>	
		<p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('twitter_label'); ?>"><?php _e('Twitter label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter_label'); ?>" name="<?php echo $this->get_field_name('twitter_label'); ?>" type="text" value="<?php echo esc_attr($twitter_label); ?>" /></p>
        </fieldset>	
		
        <fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Flickr', HS_CURRENT_THEME); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo esc_attr($flickr); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('flickr_label'); ?>"><?php _e('Flickr label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickr_label'); ?>" name="<?php echo $this->get_field_name('flickr_label'); ?>" type="text" value="<?php echo esc_attr($flickr_label); ?>" /></p>
        </fieldset>	
		
       
    
    <fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Linkedin', HS_CURRENT_THEME); ?>:</legend>
    <p><label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('linkedin_label'); ?>"><?php _e('Linkedin label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkedin_label'); ?>" name="<?php echo $this->get_field_name('linkedin_label'); ?>" type="text" value="<?php echo esc_attr($linkedin_label); ?>" /></p>
        </fieldset>	
    
    <fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Instagram', HS_CURRENT_THEME); ?>:</legend>
    <p><label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo esc_attr($instagram); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('instagram_label'); ?>"><?php _e('Instagram label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('instagram_label'); ?>" name="<?php echo $this->get_field_name('instagram_label'); ?>" type="text" value="<?php echo esc_attr($instagram_label); ?>" /></p>
        </fieldset>	
    
    <fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Youtube', HS_CURRENT_THEME); ?>:</legend>
    <p><label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('Youtube URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo esc_attr($youtube); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('youtube_label'); ?>"><?php _e('Youtube label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('youtube_label'); ?>" name="<?php echo $this->get_field_name('youtube_label'); ?>" type="text" value="<?php echo esc_attr($youtube_label); ?>" /></p>
        </fieldset>	
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Aim', HS_CURRENT_THEME); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('aim'); ?>"><?php _e('Aim URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('aim'); ?>" name="<?php echo $this->get_field_name('aim'); ?>" type="text" value="<?php echo esc_attr($aim); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('aim_label'); ?>"><?php _e('Aim label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('aim_label'); ?>" name="<?php echo $this->get_field_name('aim_label'); ?>" type="text" value="<?php echo esc_attr($aim_label); ?>" /></p>
        </fieldset>	
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Dribbble', HS_CURRENT_THEME); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('dribbble'); ?>"><?php _e('Dribbble URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('dribbble'); ?>" name="<?php echo $this->get_field_name('dribbble'); ?>" type="text" value="<?php echo esc_attr($dribbble); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('dribbble_label'); ?>"><?php _e('Dribbble label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('dribbble_label'); ?>" name="<?php echo $this->get_field_name('dribbble_label'); ?>" type="text" value="<?php echo esc_attr($dribbble_label); ?>" /></p>
        </fieldset>	
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Deviantart', HS_CURRENT_THEME); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('deviantart'); ?>"><?php _e('Deviantart URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('deviantart'); ?>" name="<?php echo $this->get_field_name('deviantart'); ?>" type="text" value="<?php echo esc_attr($deviantart); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('deviantart_label'); ?>"><?php _e('Deviantart label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('deviantart_label'); ?>" name="<?php echo $this->get_field_name('deviantart_label'); ?>" type="text" value="<?php echo esc_attr($deviantart_label); ?>" /></p>
        </fieldset>	
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Gplus', HS_CURRENT_THEME); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('gplus'); ?>"><?php _e('Gplus URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('gplus'); ?>" name="<?php echo $this->get_field_name('gplus'); ?>" type="text" value="<?php echo esc_attr($gplus); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('gplus_label'); ?>"><?php _e('Gplus label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('gplus_label'); ?>" name="<?php echo $this->get_field_name('gplus_label'); ?>" type="text" value="<?php echo esc_attr($gplus_label); ?>" /></p>
        </fieldset>	
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Pinterest', HS_CURRENT_THEME); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('pinterest_label'); ?>"><?php _e('Pinterest label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('pinterest_label'); ?>" name="<?php echo $this->get_field_name('pinterest_label'); ?>" type="text" value="<?php echo esc_attr($pinterest_label); ?>" /></p>
        </fieldset>
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Vimeo', HS_CURRENT_THEME); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php echo esc_attr($vimeo); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('vimeo_label'); ?>"><?php _e('Vimeo label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('vimeo_label'); ?>" name="<?php echo $this->get_field_name('vimeo_label'); ?>" type="text" value="<?php echo esc_attr($vimeo_label); ?>" /></p>
        </fieldset>
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Bloglovin', HS_CURRENT_THEME); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('bloglovin'); ?>"><?php _e('Bloglovin URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('bloglovin'); ?>" name="<?php echo $this->get_field_name('bloglovin'); ?>" type="text" value="<?php echo esc_attr($bloglovin); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('bloglovin_label'); ?>"><?php _e('Bloglovin label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('bloglovin_label'); ?>" name="<?php echo $this->get_field_name('bloglovin_label'); ?>" type="text" value="<?php echo esc_attr($bloglovin_label); ?>" /></p>
        </fieldset>
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Tumblr', HS_CURRENT_THEME); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php _e('Tumblr URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" name="<?php echo $this->get_field_name('tumblr'); ?>" type="text" value="<?php echo esc_attr($tumblr); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('tumblr_label'); ?>"><?php _e('Tumblr label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('tumblr_label'); ?>" name="<?php echo $this->get_field_name('tumblr_label'); ?>" type="text" value="<?php echo esc_attr($tumblr_label); ?>" /></p>
        </fieldset>
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Vkontakte', HS_CURRENT_THEME); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('vkontakte'); ?>"><?php _e('Vkontakte URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('vkontakte'); ?>" name="<?php echo $this->get_field_name('vkontakte'); ?>" type="text" value="<?php echo esc_attr($vkontakte); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('vkontakte_label'); ?>"><?php _e('Vkontakte label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('vkontakte_label'); ?>" name="<?php echo $this->get_field_name('vkontakte_label'); ?>" type="text" value="<?php echo esc_attr($vkontakte_label); ?>" /></p>
        </fieldset>
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Goodreads', HS_CURRENT_THEME); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('goodreads'); ?>"><?php _e('Goodreads URL:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('goodreads'); ?>" name="<?php echo $this->get_field_name('goodreads'); ?>" type="text" value="<?php echo esc_attr($goodreads); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('goodreads_label'); ?>"><?php _e('Goodreads label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('goodreads_label'); ?>" name="<?php echo $this->get_field_name('goodreads_label'); ?>" type="text" value="<?php echo esc_attr($goodreads_label); ?>" /></p>
        </fieldset>
		
				 <fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('E-mail', HS_CURRENT_THEME); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('mail'); ?>"><?php _e('E-mail:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('mail'); ?>" name="<?php echo $this->get_field_name('mail'); ?>" type="text" value="<?php echo esc_attr($mail); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('mail_label'); ?>"><?php _e('E-mail label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('mail_label'); ?>" name="<?php echo $this->get_field_name('mail_label'); ?>" type="text" value="<?php echo esc_attr($mail_label); ?>" /></p>
        </fieldset>	

		 <fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('RSS feed', HS_CURRENT_THEME); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS feed:', HS_CURRENT_THEME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo esc_attr($rss); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('rss_label'); ?>"><?php _e('RSS label:', HS_CURRENT_THEME); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('rss_label'); ?>" name="<?php echo $this->get_field_name('rss_label'); ?>" type="text" value="<?php echo esc_attr($rss_label); ?>" /></p>
        </fieldset>	

		<p>Display:</p>
		<label for="<?php echo $this->get_field_id('icons'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="icons" id="<?php echo $this->get_field_id('icons'); ?>" <?php checked($display, "icons"); ?>></input>  Icons</label>
		<label for="<?php echo $this->get_field_id('labels'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="labels" id="<?php echo $this->get_field_id('labels'); ?>" <?php checked($display, "labels"); ?>></input> Labels</label>
		<label for="<?php echo $this->get_field_id('both'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="both" id="<?php echo $this->get_field_id('both'); ?>" <?php checked($display, "both"); ?>></input> Both</label>

    
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("My_SocialNetworksWidget");'));
?>