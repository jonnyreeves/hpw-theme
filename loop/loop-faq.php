<?php /* Loop Name: Loop faq */ ?>
 
<div id="accordion2" class="accordion">
    
<?php
    $i = 1;
    $terms = get_terms("faq_categories");
    $count = count($terms);
    if ($count > 0) {
        foreach ($terms as $term) {
            echo '<h3>' . $term->name . '</h3>';

            $query = new WP_Query(array(
                        'post_type' => 'faq',
                        'posts_per_page' => -1,
                        'orderby' => 'post_date',
                        'order' => 'DESC',
                        'no_found_rows' => 1,
                        'faq_categories' => $term->name
                        )
            );

            while ($query->have_posts()) : $query->the_post();
            ?>
			<div class="accordion-group">
            <div class="accordion-heading">
	<a class="accordion-toggle active" href="#id-<?php echo $i; ?>" data-parent="#accordion2" data-toggle="collapse"><h5>
                <?php the_title(); ?>
            </h5>
    </a>
	</div>
    
            <div id="id-<?php echo $i; ?>" class="accordion-body collapse "><div class="accordion-inner">
                <?php the_content(); ?>
            </div>
	</div>
			
    </div>
            <?php
			$i++;
                endwhile;
            
        }
    }
    wp_reset_query();
?>
    
</div> <!-- .hs_accordion-->
 
 