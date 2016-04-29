<?php /* Loop Name: Loop portfolio 4 */ ?>
<?php // Theme Options vars
wp_enqueue_script('isotope');
wp_enqueue_script('debouncedresize');
wp_enqueue_script('isotopeinit');
$items_count = of_get_option('items_count4');
$cols = '4cols';
$feautered = '';
require_once get_template_directory() . '/blog-loop.php';