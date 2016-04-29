<?php /* Static Name: Not found */ ?>
<div>
    <?php echo '<h1>' . __('Sorry!', HS_CURRENT_THEME) . '</h1>'; ?>
    <?php echo '<h2>' . __('Page Not Found', HS_CURRENT_THEME) . '</h2>'; ?>
</div>

<?php echo '<h4>' . __('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', HS_CURRENT_THEME) . '</h4>'; ?>
<?php echo '<p>' . __('Please try using our search box below to look for information on the internet.', HS_CURRENT_THEME) . '</p>'; ?>

<?php get_search_form(); /* outputs the default Wordpress search form */ ?>