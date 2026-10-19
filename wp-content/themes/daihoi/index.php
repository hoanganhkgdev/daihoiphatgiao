<?php get_header(); ?>
<div class="page-head"><div class="wrap">
	<h1><?php
		if ( is_search() ) printf( 'Kết quả cho “%s”', esc_html( get_search_query() ) );
		elseif ( is_archive() ) the_archive_title();
		else echo 'Tin tức';
	?></h1>
</div></div>
<div class="wrap section">
	<?php if ( have_posts() ) : ?>
		<div class="cards news">
			<?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/card' ); endwhile; ?>
		</div>
		<?php the_posts_pagination( array( 'prev_text' => daihoi_icon( 'arrow-left', 18 ), 'next_text' => daihoi_icon( 'arrow-right', 18 ), 'screen_reader_text' => 'Phân trang' ) ); ?>
	<?php else : ?>
		<p class="empty">Không có nội dung phù hợp.</p><?php get_search_form(); ?>
	<?php endif; ?>
</div>
<?php get_footer();
