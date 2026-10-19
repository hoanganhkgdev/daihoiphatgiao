<?php get_header();
while ( have_posts() ) : the_post();
	$cats = get_the_category();
	$cat  = $cats ? $cats[0] : null;
	$is_doc = $cat && DAIHOI_DOC_CATEGORY === $cat->slug;
	$list_url = $cat ? get_category_link( $cat ) : home_url( '/' );
	$related = $cat ? new WP_Query( array( 'cat' => $cat->term_id, 'post__not_in' => array( get_the_ID() ), 'posts_per_page' => 5, 'ignore_sticky_posts' => true, 'no_found_rows' => true ) ) : null;
?>
<div class="page-head page-head-cat">
	<div class="wrap">
		<nav class="crumbs" aria-label="Đường dẫn">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a><span aria-hidden="true">/</span>
			<?php if ( $cat ) : ?><a href="<?php echo esc_url( $list_url ); ?>"><?php echo esc_html( $is_doc ? 'Văn kiện Đại hội' : $cat->name ); ?></a><span aria-hidden="true">/</span><?php endif; ?>
			<span>Chi tiết</span>
		</nav>
		<?php if ( $cat ) : ?><p class="label"><?php echo esc_html( $is_doc ? 'Văn kiện Đại hội' : $cat->name ); ?></p><?php endif; ?>
		<h1 class="single-title"><?php the_title(); ?></h1>
		<p class="single-meta">
			<span><?php echo daihoi_icon( 'calendar', 16 ); ?> <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?></time></span>
			<?php if ( $is_doc ) : ?><span><?php echo daihoi_icon( 'file', 16 ); ?> Văn bản chính thức</span><?php endif; ?>
		</p>
	</div>
</div>

<div class="wrap single-wrap">
	<article <?php post_class( 'single-main' ); ?>>
		<?php if ( has_post_thumbnail() ) : ?><figure class="single-cover"><?php the_post_thumbnail( 'large' ); ?></figure><?php endif; ?>
		<div class="entry"><?php the_content(); ?></div>
		<?php the_post_navigation( array(
			'in_same_term' => true,
			'prev_text'    => '<small>← Bài trước</small><span>%title</span>',
			'next_text'    => '<small>Bài sau →</small><span>%title</span>',
		) ); ?>
	</article>

	<aside class="single-side" aria-label="Thông tin thêm">
		<?php if ( $related && $related->have_posts() ) : ?>
			<section class="side-card">
				<h2 class="side-title"><?php echo esc_html( $is_doc ? 'Văn kiện khác' : 'Cùng chuyên mục' ); ?></h2>
				<ul class="side-list">
					<?php while ( $related->have_posts() ) : $related->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?></time></li>
					<?php endwhile; wp_reset_postdata(); ?>
				</ul>
				<a class="text-link" href="<?php echo esc_url( $list_url ); ?>">Xem tất cả <?php echo daihoi_icon( 'arrow-right', 16 ); ?></a>
			</section>
		<?php endif; ?>
		<section class="side-card side-event">
			<span class="side-ico"><?php echo daihoi_icon( 'lotus', 24 ); ?></span>
			<strong>Đại hội đại biểu Phật giáo toàn quốc lần thứ X</strong>
			<p>05 – 07/11/2026<br>Học viện Phật giáo Việt Nam, TP. Hồ Chí Minh</p>
		</section>
	</aside>
</div>
<?php endwhile; get_footer();
