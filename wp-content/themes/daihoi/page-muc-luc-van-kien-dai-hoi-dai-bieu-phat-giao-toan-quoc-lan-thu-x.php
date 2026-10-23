<?php
get_header();

while ( have_posts() ) :
	the_post();
	$source_content = get_post_field( 'post_content', get_the_ID() );
	$total_docs     = preg_match_all( '/<tr\b[^>]*>/i', $source_content, $matches );
	$total_docs     = $total_docs ? $total_docs : 0;
	?>
	<div class="toc-page">
		<section class="toc-page-hero" aria-labelledby="toc-page-title">
			<div class="wrap">
				<nav class="toc-page-crumbs" aria-label="Đường dẫn">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
					<?php echo daihoi_icon( 'arrow-right', 13 ); ?>
					<span>Văn kiện Đại hội</span>
				</nav>
				<div class="toc-page-hero-grid">
					<div class="toc-page-hero-copy">
						<p class="toc-page-kicker"><i></i>Kho tư liệu chính thức</p>
						<h1 id="toc-page-title">Văn kiện <em>Đại hội</em></h1>
						<p>Hệ thống chương trình, báo cáo, nghị quyết và các văn bản chính thức của Đại hội đại biểu Phật giáo toàn quốc lần thứ X.</p>
						<div class="toc-page-meta">
							<span><?php echo daihoi_icon( 'calendar', 16 ); ?> Nhiệm kỳ 2026 – 2031</span>
							<span><?php echo daihoi_icon( 'wheel', 16 ); ?> Tài liệu chính thức</span>
						</div>
						<a class="toc-page-jump" href="#danh-muc-van-kien">
							<span>Xem danh mục văn kiện</span>
							<?php echo daihoi_icon( 'arrow-down', 16 ); ?>
						</a>
					</div>
					<div class="toc-page-stat" aria-label="<?php echo esc_attr( $total_docs ); ?> văn kiện">
						<span class="toc-page-stat-icon"><?php echo daihoi_icon( 'file', 31 ); ?></span>
						<strong><?php echo esc_html( sprintf( '%02d', $total_docs ) ); ?></strong>
						<small>Văn kiện<br>Đại hội</small>
					</div>
				</div>
			</div>
		</section>

		<section class="toc-page-main" id="danh-muc-van-kien" aria-label="Danh mục văn kiện">
			<div class="wrap">
				<article class="entry toc-page-entry"><?php the_content(); ?></article>
			</div>
		</section>
	</div>
	<?php
endwhile;

get_footer();
