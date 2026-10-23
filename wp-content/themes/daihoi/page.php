<?php get_header(); while ( have_posts() ) : the_post(); ?>
	<?php if ( 33 === get_the_ID() ) : ?>
		<div class="programme-page">
			<section class="programme-hero" aria-labelledby="programme-page-title">
				<div class="wrap">
					<nav class="programme-crumbs" aria-label="Đường dẫn">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
						<?php echo daihoi_icon( 'arrow-right', 13 ); ?>
						<a href="<?php echo esc_url( daihoi_category_url( DAIHOI_DOC_CATEGORY ) ); ?>">Văn kiện Đại hội</a>
						<?php echo daihoi_icon( 'arrow-right', 13 ); ?>
						<span>Chương trình</span>
					</nav>
					<div class="programme-hero-grid">
						<div class="programme-hero-copy">
							<p class="programme-kicker"><i></i>Lịch trình chính thức</p>
							<h1 id="programme-page-title">Chương trình <em>Đại hội</em></h1>
							<p>Toàn bộ hoạt động chào mừng, Đại lễ kỷ niệm 45 năm thành lập Giáo hội Phật giáo Việt Nam và các phiên làm việc của Đại hội lần thứ X.</p>
							<div class="programme-hero-meta">
								<span><?php echo daihoi_icon( 'calendar', 16 ); ?> 03 – 07.11.2026</span>
								<span><?php echo daihoi_icon( 'pin', 16 ); ?> TP. Hồ Chí Minh</span>
							</div>
							<a class="programme-jump" href="#lich-trinh-chi-tiet"><span>Xem lịch trình chi tiết</span><?php echo daihoi_icon( 'arrow-down', 16 ); ?></a>
						</div>
						<div class="programme-hero-stat" aria-label="4 ngày hoạt động">
							<span class="programme-stat-icon"><?php echo daihoi_icon( 'calendar', 31 ); ?></span>
							<strong>04</strong>
							<small>Ngày<br>hoạt động</small>
						</div>
					</div>
				</div>
			</section>
			<section class="programme-main" id="lich-trinh-chi-tiet" aria-label="Lịch trình chi tiết">
				<div class="wrap"><article class="entry programme-entry"><?php the_content(); ?></article></div>
			</section>
		</div>
	<?php elseif ( 42 === get_the_ID() ) :
		$papers_source = get_post_field( 'post_content', get_the_ID() );
		$paper_total   = preg_match_all( '/class=["\'][^"\']*paper-item\b/i', $papers_source );
		$volume_total  = preg_match_all( '/class=["\'][^"\']*dh-volume-container\b/i', $papers_source );
		?>
		<div class="papers-page">
			<section class="papers-hero" aria-labelledby="papers-page-title">
				<div class="wrap">
					<nav class="papers-crumbs" aria-label="Đường dẫn">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
						<?php echo daihoi_icon( 'arrow-right', 13 ); ?>
						<a href="<?php echo esc_url( daihoi_category_url( DAIHOI_DOC_CATEGORY ) ); ?>">Văn kiện Đại hội</a>
						<?php echo daihoi_icon( 'arrow-right', 13 ); ?>
						<span>Tham luận &amp; Kỷ yếu</span>
					</nav>
					<div class="papers-hero-grid">
						<div class="papers-hero-copy">
							<p class="papers-kicker"><i></i>Kho nghiên cứu Phật học</p>
							<h1 id="papers-page-title">Tham luận <em>&amp; Kỷ yếu</em></h1>
							<p>Tuyển tập nghiên cứu khoa học về lịch sử, văn hóa, giáo dục, hoằng pháp, truyền thông và định hướng phát triển của Giáo hội Phật giáo Việt Nam.</p>
							<div class="papers-hero-meta">
								<span><?php echo daihoi_icon( 'file', 16 ); ?> <?php echo esc_html( $paper_total ); ?> bài tham luận</span>
								<span><?php echo daihoi_icon( 'wheel', 16 ); ?> <?php echo esc_html( $volume_total ); ?> quyển chuyên đề</span>
							</div>
							<a class="papers-jump" href="#danh-muc-tham-luan"><span>Khám phá danh mục</span><?php echo daihoi_icon( 'arrow-down', 16 ); ?></a>
						</div>
						<div class="papers-hero-stat" aria-label="<?php echo esc_attr( $paper_total ); ?> bài tham luận">
							<span class="papers-stat-icon"><?php echo daihoi_icon( 'file', 31 ); ?></span>
							<strong><?php echo esc_html( $paper_total ); ?></strong>
							<small>Bài<br>tham luận</small>
						</div>
					</div>
				</div>
			</section>
			<section class="papers-main" id="danh-muc-tham-luan" aria-label="Danh mục tham luận">
				<div class="wrap"><article class="entry papers-entry"><?php the_content(); ?></article></div>
			</section>
		</div>
	<?php else : ?>
		<div class="page-head"><div class="wrap"><h1><?php the_title(); ?></h1></div></div>
		<div class="wrap section"><article class="entry"><?php the_content(); ?></article></div>
	<?php endif; ?>
<?php endwhile; get_footer();
