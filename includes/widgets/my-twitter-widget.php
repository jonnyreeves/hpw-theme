<?php
function parseTweet($text) {
	$text = preg_replace('#http://[a-z0-9._/-]+#i', '<a  target="_blank" href="$0">$0</a>', $text); 
	$text = preg_replace('#@([a-z0-9_]+)#i', '@<a  target="_blank" href="http://twitter.com/$1">$1</a>', $text); 
	$text = preg_replace('# \#([a-z0-9_-]+)#i', ' #<a target="_blank" href="http://twitter.com/search?q=%23$1">$1</a>', $text); 
	$text = preg_replace('#https://[a-z0-9._/-]+#i', '<a  target="_blank" href="$0">$0</a>', $text); 
	
	return $text;
}
class MY_TwitterWidget extends WP_widget {
	function __construct() {
$widget_ops = array(
'classname' => 'twitter',
'description' => __('A widget that displays the latest tweets', HS_CURRENT_THEME)
);
parent::__construct( 'twitter-widget', __('hercules - Twitter', HS_CURRENT_THEME), $widget_ops );
}
	
	function widget($args, $data) {
	$title      = apply_filters('widget_title', $data['title'] );
$nbTweets       = $data['nbTweets'];	
$consumer_key       = $data['consumer_key'];
$consumer_secret       = $data['consumer_secret'];
$access_token       = $data['access_token'];
$access_token_secret       = $data['access_token_secret'];
		extract($args);
		
		echo $before_widget;
		if ( $title )
		echo $before_title.$title.$after_title;

		$cache = plugin_dir_path(__FILE__).'cache/twitter.txt';
		if(time() - filemtime($cache) > $data['cachetime']) {
			include_once 'class/twitteroauth.php';
			$connect = new TwitterOAuth($data['consumer_key'],$data['consumer_secret'],$data['access_token'],$data['access_token_secret']);
			$tweets = $connect->get('statuses/user_timeline', array('count' => $data['nbTweets']));
			file_put_contents($cache, serialize($tweets));
		} else {
			$tweets = unserialize(file_get_contents($cache));
		}
		
if ( !$consumer_key || !$consumer_secret || !$access_token || !$access_token_secret ){
echo "No Tweets Available or bad configuration...";
}else{	
if(!empty($tweets)){

// to use with intents
echo '<div class="twitter"><i class="icon-twitter icon-3x"></i>';
global $hercules_add_owl;
    $hercules_add_owl = true;
$random = hs_gener_random(10);
		
echo '<script type="text/javascript">
jQuery(document).ready(function() {

  jQuery("#owl-demo_'.$random.'").owlCarousel({
    autoPlay : 5000,
    stopOnHover : true,
    navigation:false,
    singleItem : true,
    autoHeight : true,
	touchDrag: true,
	scrollPerPage: true
  });

});		
	</script>';	
		
		
echo '<div id="owl-demo_'.$random.'" class="owl-carousel">'; 
		
		foreach($tweets as $tweet) { 
		$text = parseTweet($tweet->text);
		$screen_name = $tweet->user->screen_name;
                $name = $tweet->user->name;
				$retweet = $tweet->id_str;
				$time = date('d M Y',strtotime($tweet->created_at));
			echo '<div>';
echo '<div class="tweet_item">';
echo '<div class="tweet_content">';
echo '<div class="stream-item-header">';
if ($data['fullname'] ) {
echo '<strong class="fullname">' . $name . '</strong>';
}
if ($data['username'] ) {
echo '<a class="account-group" href="http://twitter.com/'.$screen_name.'" target="_blank"><span class="username"> @'.$screen_name. '</span></a>';
}
echo '</div>';

echo '<div class="tweet_txt">' . $text . '</div>';

echo '<div class="clearfix">';
?>
<div class="twitter_intents">
<span><a onClick="window.open('https://twitter.com/intent/tweet?in_reply_to=<?php echo $retweet; ?>','Twitter','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" class="reply-tweet" href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $retweet; ?>">Reply</a></span>

<span><a onClick="window.open('https://twitter.com/intent/retweet?tweet_id=<?php echo $retweet; ?>','Twitter','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" class="retweet" href="https://twitter.com/intent/retweet?tweet_id=<?php echo $retweet; ?>">Retweet</a></span>

<span><a onClick="window.open('https://twitter.com/intent/favorite?tweet_id=<?php echo $retweet; ?>','Twitter','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" class="favorite-tweet" href="https://twitter.com/intent/favorite?tweet_id=<?php echo $retweet; ?>">Favorite</a></span>

</div>
<?php
echo "</div>";

        echo '
        <p class="timestamp">
            <a href="https://twitter.com/'.$screen_name.'/status/'.$retweet.'" target="_blank">
                '.$time.'
            </a>
        </p>';
echo '</div>';
echo '</div>';
echo '</div>';
 } 

echo "</div></div>"; 
} 
} 
		
		echo $after_widget;
	}
	
	function update($new_data, $old_data) {
$data = $old_data;
 
//Strip tags from title and name to remove HTML
$data['title']      = strip_tags( $new_data['title'] );
$data['nbTweets']       = strip_tags( $new_data['nbTweets'] );
$data['fullname']   = strip_tags( $new_data['fullname'] );
$data['username']   = strip_tags( $new_data['username'] );
$data['cachetime']   = strip_tags( $new_data['cachetime'] );
$data['consumer_key']   = strip_tags( $new_data['consumer_key'] );
$data['consumer_secret']   = strip_tags( $new_data['consumer_secret'] );
$data['access_token']   = strip_tags( $new_data['access_token'] );
$data['access_token_secret']   = strip_tags( $new_data['access_token_secret'] );

return $data;
}   // update the widget
function form($data) {
//Set up some default widget settings.
$defaults = array(
'title' => __('Latest Tweets', HS_CURRENT_THEME),
'nbTweets' => '3',
'fullname' => '',
'username' => '',
'cachetime' => '1',
'consumer_key' => '',
'consumer_secret' => '',
'access_token' => '',
'access_token_secret' => ''
);
$data = wp_parse_args( (array) $data, $defaults );
	
	//function form($data) {
		?>
			<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', HS_CURRENT_THEME); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $data['title']; ?>" />
</p>
			<h3 style="margin-bottom: 0;"><?php _e('Widget Settings', HS_CURRENT_THEME); ?></h3>
			<br />
			<p>
<label for="<?php echo $this->get_field_id( 'nbTweets' ); ?>"><?php _e('Number of Tweets:', HS_CURRENT_THEME); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'nbTweets' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'nbTweets' ); ?>" value="<?php echo $data['nbTweets']; ?>" />
</p>
						<p>
<label for="<?php echo $this->get_field_id( 'cachetime' ); ?>"><?php _e('Time of cache : (in second)', HS_CURRENT_THEME); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'cachetime' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'cachetime' ); ?>" value="<?php echo $data['cachetime']; ?>" />
</p>
			<p>
  <label for="<?php echo $this->get_field_id("fullname"); ?>">
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("fullname"); ?>" name="<?php echo $this->get_field_name("fullname"); ?>"<?php checked( (bool) $data["fullname"], true ); ?> />
      <?php _e( 'Show fullname', HS_CURRENT_THEME ); ?>
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id("username"); ?>">
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("username"); ?>" name="<?php echo $this->get_field_name("username"); ?>"<?php checked( (bool) $data["username"], true ); ?> />
      <?php _e( 'Show username', HS_CURRENT_THEME ); ?>
  </label>
</p>
			<h3 style="margin-bottom: 0;"><?php _e('API Settings', HS_CURRENT_THEME); ?></h3>
			<small><?php _e('You need to create an application on <a href="https://apps.twitter.com/" target="_blank">Twitter for Developer</a> to have an access to these information.', HS_CURRENT_THEME); ?></small><br /><br />
						<p>
<label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>"><?php _e('Consumer key :', HS_CURRENT_THEME); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" value="<?php echo $data['consumer_key']; ?>" />
</p>
						<p>
<label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>"><?php _e('Consumer secret :', HS_CURRENT_THEME); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" value="<?php echo $data['consumer_secret']; ?>" />
</p>
						<p>
<label for="<?php echo $this->get_field_id( 'access_token' ); ?>"><?php _e('Access token :', HS_CURRENT_THEME); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'access_token' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'access_token' ); ?>" value="<?php echo $data['access_token']; ?>" />
</p>
						<p>
<label for="<?php echo $this->get_field_id( 'access_token_secret' ); ?>"><?php _e('Access token secret :', HS_CURRENT_THEME); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'access_token_secret' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'access_token_secret' ); ?>" value="<?php echo $data['access_token_secret']; ?>" />
</p>
		<?php
	}
}

?>