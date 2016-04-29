<?php

/*-----------------------------------------------------------------------------------

	Metaboxes for slideshow

-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Define Metabox Fields
/*-----------------------------------------------------------------------------------*/

$hr_prefix = 'my_';
 
$hercules_meta_box_slideshow = array(
	'id' => 'my-meta-box-slideshow',
	'title' =>  __('Page Options', HS_CURRENT_THEME),
	'page' => 'slideshow',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
    	   'name' => __('Link', HS_CURRENT_THEME),
    	   'desc' => __('Enter link.', HS_CURRENT_THEME),
    	   'id' => $hr_prefix . 'slideshow_link',
    	   'type' => 'text',
    	   'std' => ''
    	)
			
	)
);

add_action('admin_menu', 'my_add_box_slideshow');


/*-----------------------------------------------------------------------------------*/
/*	Add metabox to edit page
/*-----------------------------------------------------------------------------------*/
 
function my_add_box_slideshow() {
	global $hercules_meta_box_slideshow;
	
	add_meta_box($hercules_meta_box_slideshow['id'], $hercules_meta_box_slideshow['title'], 'my_show_box_slideshow', $hercules_meta_box_slideshow['page'], $hercules_meta_box_slideshow['context'], $hercules_meta_box_slideshow['priority']);

}


/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function my_show_box_slideshow() {
	global $hercules_meta_box_slideshow, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__('Please fill additional fields for page. ', HS_CURRENT_THEME).'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="my_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($hercules_meta_box_slideshow['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If textarea		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			
			break;
			
			//If Select	
			case 'select':
			
				echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				echo'<select id="' . $field['id'] . '" name="'.$field['id'].'">';
			
				foreach ($field['options'] as $option) {
					
					echo'<option';
					if ($meta == $option ) { 
						echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				
				} 
				
				echo'</select>';
			
			break; 
			
		}

	}
 
	echo '</table>';
}

 
add_action('save_post', 'my_save_data_slideshow');


/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
 
function my_save_data_slideshow($post_id) {
	global $hercules_meta_box_slideshow;
 
	// verify nonce
	if (!isset($_POST['my_meta_box_nonce']) || !wp_verify_nonce($_POST['my_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($hercules_meta_box_slideshow['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
}