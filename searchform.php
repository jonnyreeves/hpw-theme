<div class="search-form">
	<form id="custom-search-form" method="get" action="<?php echo home_url(); ?>" accept-charset="utf-8" class="form-search form-horizontal">
	<div class="input-append">
		<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="search-query" placeholder="Search">
		<button type="submit" value="" id="search-submit" class="btn"><i class="icon-search"></i></button>
		</div>
	</form>
</div>