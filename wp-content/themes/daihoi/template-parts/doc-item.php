<?php
// Một dòng trong danh sách văn kiện (không có ảnh đại diện).
global $wp_query;
$per = max( 1, (int) $wp_query->get( 'posts_per_page' ) );
$no  = ( max( 1, (int) get_query_var( 'paged' ) ) - 1 ) * $per + $wp_query->current_post + 1;
?>
<li <?php post_class( 'doc-row' ); ?>>
	<span class="doc-no"><?php echo esc_html( str_pad( $no, 2, '0', STR_PAD_LEFT ) ); ?></span>
	<span class="doc-icon"><?php echo daihoi_icon( 'file', 22 ); ?></span>
	<div class="doc-main">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php if ( has_excerpt() ) : ?><p><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
	</div>
	<time class="doc-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?></time>
	<a class="doc-open" href="<?php the_permalink(); ?>" aria-label="Xem văn kiện: <?php the_title_attribute(); ?>">Xem <?php echo daihoi_icon( 'arrow-right', 16 ); ?></a>
</li>
