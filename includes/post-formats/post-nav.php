<?php 
$pagination_type = of_get_option('pagination_type');
if(function_exists('hs_pagination') && $pagination_type=='pagnum') : ?>
  <?php hs_pagination($wp_query->max_num_pages); ?>
<?php endif; ?>
<?php
global $wp_query;  
if ( $wp_query->max_num_pages > 1 && $pagination_type=='paglink' ) : ?>
    <ul class="paging">
      <li style="float:left;">
        <?php next_posts_link(theme_locals("older")) ?>
      </li><!--.older-->
      <li style="float:right;">
        <?php previous_posts_link(theme_locals("newer")) ?>
      </li><!--.newer-->
	  <li class="clear"></li>
    </ul><!--.oldernewer-->

  <?php endif; ?>

<!-- Posts navigation -->