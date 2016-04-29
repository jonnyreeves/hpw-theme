<?php /* Loop Name: Loop portfolio 2 */ ?>
<?php // Theme Options vars
wp_enqueue_script('isotope');
wp_enqueue_script('debouncedresize');
wp_enqueue_script('isotopeinit');
$items_count = of_get_option('items_count2');
$cols = '2cols';
$feautered = '';
require_once get_template_directory() . '/blog-loop.php';