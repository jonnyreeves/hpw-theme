<?php /* Loop Name: Loop portfolio 3 */ ?>
<?php // Theme Options vars
wp_enqueue_script('isotope');
wp_enqueue_script('debouncedresize');
wp_enqueue_script('isotopeinit');
$items_count = of_get_option('items_count3');
$cols = '3cols';
$feautered = '';
require_once get_template_directory() . '/blog-category-loop-masonry.php';