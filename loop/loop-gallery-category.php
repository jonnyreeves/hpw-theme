<?php /* Loop Name: Gallery Category */ ?>
<?php // Theme Options vars
wp_enqueue_script('isotope');
wp_enqueue_script('debouncedresize');
wp_enqueue_script('isotopeinit');
$images_per_page = of_get_option('images_per_page');
$gallery_columns = of_get_option('gallery_columns');

switch ($gallery_columns) {
    case 2:
        $cols = '2cols';
        break;
    case 3:
        $cols = '3cols';
        break;
	case 4:
        $cols = '4cols';
        break;
	case 5:
        $cols = '5cols';
        break;	
}
require_once get_template_directory() . '/gallery-category-loop.php';