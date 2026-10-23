<?php get_header();
while ( have_posts() ) : the_post();
	$cats            = get_the_category();
	$cat             = $cats ? $cats[0] : null;
	$is_doc          = $cat && DAIHOI_DOC_CATEGORY === $cat->slug;
	$list_url        = $is_doc ? daihoi_document_url() : ( $cat ? get_category_link( $cat ) : home_url( '/' ) );
	$category_label  = $cat ? ( $is_doc ? 'Văn kiện Đại hội' : $cat->name ) : 'Bài viết Đại hội';
	$content_words   = preg_split( '/\s+/u', trim( wp_strip_all_tags( get_the_content() ) ) );
	$reading_minutes = max( 1, (int) ceil( count( array_filter( $content_words ) ) / 220 ) );
	$related         = $cat ? new WP_Query( array( 'cat' => $cat->term_id, 'post__not_in' => array( get_the_ID() ), 'posts_per_page' => 5, 'ignore_sticky_posts' => true, 'no_found_rows' => true ) ) : null;
?>
<header class="article-hero">
	<div class="wrap">
		<nav class="article-crumbs" aria-label="Đường dẫn">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
			<?php echo daihoi_icon( 'arrow-right', 13 ); ?>
			<a href="<?php echo esc_url( $list_url ); ?>"><?php echo esc_html( $category_label ); ?></a>
			<?php echo daihoi_icon( 'arrow-right', 13 ); ?>
			<span>Chi tiết</span>
		</nav>
		<div class="article-hero-grid">
			<div class="article-hero-copy">
				<p class="article-kicker"><i></i><?php echo esc_html( $category_label ); ?></p>
				<h1 class="single-title"><?php the_title(); ?></h1>
				<div class="single-meta">
					<span><?php echo daihoi_icon( 'calendar', 16 ); ?> <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?></time></span>
					<span><?php echo daihoi_icon( 'file', 16 ); ?> <?php echo esc_html( $reading_minutes ); ?> phút đọc</span>
					<?php if ( $is_doc ) : ?><span><?php echo daihoi_icon( 'wheel', 16 ); ?> Văn bản chính thức</span><?php endif; ?>
				</div>
			</div>
			<div class="article-hero-seal" aria-hidden="true">
				<span><?php echo daihoi_icon( 'lotus', 38 ); ?></span>
				<strong>ĐẠI HỘI</strong>
				<small>Phật giáo toàn quốc<br>lần thứ X</small>
			</div>
		</div>
	</div>
</header>

<div class="wrap single-wrap article-layout">
	<article <?php post_class( 'single-main' ); ?>>
		<?php if ( has_post_thumbnail() ) : ?><figure class="single-cover"><?php the_post_thumbnail( 'large' ); ?></figure><?php endif; ?>
		<div class="article-toolbar">
			<span><i></i>Nội dung chính thức</span>
			<a href="<?php echo esc_url( $list_url ); ?>"><?php echo daihoi_icon( 'arrow-left', 15 ); ?> Quay lại <?php echo esc_html( $category_label ); ?></a>
		</div>
		<div class="entry single-article-entry"><?php the_content(); ?></div>
		<?php the_post_navigation( array(
			'in_same_term' => true,
			'prev_text'    => '<small>← Bài trước</small><span>%title</span>',
			'next_text'    => '<small>Bài sau →</small><span>%title</span>',
		) ); ?>
	</article>

	<aside class="single-side" aria-label="Thông tin thêm">
		<section class="side-card article-outline" hidden>
			<p class="side-eyebrow">Trong bài viết</p>
			<h2 class="side-title">Mục lục nội dung</h2>
			<nav class="article-toc" aria-label="Mục lục bài viết"></nav>
		</section>
		<?php if ( $related && $related->have_posts() ) : ?>
			<section class="side-card related-card">
				<p class="side-eyebrow">Đọc tiếp</p>
				<h2 class="side-title"><?php echo esc_html( $is_doc ? 'Văn kiện khác' : 'Cùng chuyên mục' ); ?></h2>
				<ul class="side-list">
					<?php $related_index = 0; while ( $related->have_posts() ) : $related->the_post(); $related_index++; ?>
						<li><span><?php echo esc_html( sprintf( '%02d', $related_index ) ); ?></span><div><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?></time></div></li>
					<?php endwhile; wp_reset_postdata(); ?>
				</ul>
				<a class="article-all-link" href="<?php echo esc_url( $list_url ); ?>">Xem tất cả <?php echo daihoi_icon( 'arrow-right', 16 ); ?></a>
			</section>
		<?php endif; ?>
		<section class="side-card side-event">
			<span class="side-ico"><?php echo daihoi_icon( 'lotus', 24 ); ?></span>
			<small>Sự kiện trọng đại</small>
			<strong>Đại hội đại biểu Phật giáo toàn quốc lần thứ X</strong>
			<p>05 – 07/11/2026<br>Học viện Phật giáo Việt Nam, TP. Hồ Chí Minh</p>
		</section>
	</aside>
</div>
<?php endwhile; get_footer();
