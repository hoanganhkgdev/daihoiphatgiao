<?php get_header();
$up  = content_url( 'uploads/2026/10/' );
$news = new WP_Query( array( 'posts_per_page' => 3, 'ignore_sticky_posts' => true ) );
?>
<section class="hero">
	<img class="hero-img" src="<?php echo esc_url( $up . 'hinh_backdrop_trang_3-1536x867.png' ); ?>" srcset="<?php echo esc_url( $up . 'hinh_backdrop_trang_3-768x433.png' ); ?> 768w, <?php echo esc_url( $up . 'hinh_backdrop_trang_3-1536x867.png' ); ?> 1536w, <?php echo esc_url( $up . 'hinh_backdrop_trang_3-scaled.png' ); ?> 2560w" sizes="100vw" alt="Đại hội đại biểu Phật giáo toàn quốc lần thứ X, nhiệm kỳ 2026-2031" width="1536" height="867" fetchpriority="high">
	<div class="hero-bar">
		<div class="wrap hero-bar-inner">
			<div class="hero-bar-text"><p class="eyebrow">Đại hội khai mạc sau</p><p class="hero-theme">Thời gian: ngày 05 – 07/11/2026<br>Địa điểm: Học viện Phật giáo Việt Nam, TP. Hồ Chí Minh</p></div>
			<div class="countdown" data-start="<?php echo esc_attr( daihoi_event_start() ); ?>" aria-live="off">
				<div><b data-u="d">00</b><span>Ngày</span></div>
				<div><b data-u="h">00</b><span>Giờ</span></div>
				<div><b data-u="m">00</b><span>Phút</span></div>
				<div><b data-u="s">00</b><span>Giây</span></div>
			</div>
			<div class="hero-cta">
				<a class="btn btn-primary" href="#thong-tin">Thông tin Đại hội</a>
				<a class="btn btn-ghost" href="#tin-tuc">Tin tức</a>
			</div>
		</div>
	</div>
</section>

<section class="section" id="thong-tin">
	<div class="wrap">
		<header class="section-head"><p class="eyebrow">Thông tin chung</p><h2>Đại hội trong một cái nhìn</h2></header>
		<div class="cards">
			<article class="card info"><div class="ico" aria-hidden="true"><?php echo daihoi_icon( 'calendar', 30 ); ?></div><h3>Thời gian</h3><p>Từ ngày 05 đến 07 tháng 11 năm 2026</p></article>
			<article class="card info"><div class="ico" aria-hidden="true"><?php echo daihoi_icon( 'pin', 30 ); ?></div><h3>Địa điểm</h3><p>Học viện Phật giáo Việt Nam tại TP. Hồ Chí Minh</p></article>
			<article class="card info"><div class="ico" aria-hidden="true"><?php echo daihoi_icon( 'lotus', 30 ); ?></div><h3>Chủ đề</h3><p>Kỷ cương – Đổi mới – Hiệu lực – Hiệu quả</p></article>
			<article class="card info"><div class="ico" aria-hidden="true"><?php echo daihoi_icon( 'wheel', 30 ); ?></div><h3>Nhiệm kỳ</h3><p>Nhiệm kỳ 2026 – 2031, Đại hội lần thứ X</p></article>
		</div>
	</div>
</section>

<section class="section section-alt" id="tin-tuc">
	<div class="wrap">
		<header class="section-head"><p class="eyebrow">Tin tức &amp; sự kiện</p><h2>Cập nhật mới nhất</h2></header>
		<?php if ( $news->have_posts() ) : ?>
			<div class="cards news">
				<?php while ( $news->have_posts() ) : $news->the_post(); get_template_part( 'template-parts/card' ); endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<p class="empty">Tin tức về Đại hội sẽ được cập nhật tại đây.</p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer();
