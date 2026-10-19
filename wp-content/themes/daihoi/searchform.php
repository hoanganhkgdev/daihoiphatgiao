<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Tìm kiếm…" aria-label="Tìm kiếm">
	<button class="btn btn-primary" type="submit">Tìm</button>
</form>
