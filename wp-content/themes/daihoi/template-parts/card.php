<article <?php post_class( 'card post-card' ); ?>>
	<a class="thumb" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php if ( has_post_thumbnail() ) the_post_thumbnail( 'medium_large' ); else echo '<span class="thumb-ph">' . daihoi_icon( 'wheel', 56 ) . '</span>'; ?>
	</a>
	<div class="card-body">
		<div class="card-meta"><span>Tin Đại hội</span><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></div>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo esc_html( get_the_excerpt() ); ?></p>
		<a class="card-more" href="<?php the_permalink(); ?>" aria-label="Đọc bài: <?php the_title_attribute(); ?>">Đọc tiếp <?php echo daihoi_icon( 'arrow-right', 16 ); ?></a>
	</div>
</article>
