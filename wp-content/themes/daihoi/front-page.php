<?php get_header();
$doc_url  = daihoi_category_url( DAIHOI_DOC_CATEGORY );
$doc_cat  = get_category_by_slug( DAIHOI_DOC_CATEGORY );
// Hai thẻ dẫn vào chuyên mục; ảnh nền lấy từ bài mới nhất của chuyên mục.
$entry_cards = array(
	array(
		'slug' => DAIHOI_NEWS_CATEGORY, 'url' => DAIHOI_NEWS_URL, 'external' => true, 'icon' => 'lotus', 'label' => 'Tin tức & sự kiện', 'title' => 'Tin tức Đại hội',
		'desc' => 'Cập nhật diễn biến, hoạt động và thông báo mới nhất từ Ban Tổ chức.', 'cta' => 'Xem tin tức', 'image' => false, 'exclude' => $doc_cat ? array( $doc_cat->term_id ) : array(),
	),
	array(
		'slug' => DAIHOI_DOC_CATEGORY, 'url' => $doc_url, 'external' => false, 'icon' => 'file', 'label' => 'Tài liệu', 'title' => 'Văn kiện Đại hội',
		'desc' => 'Báo cáo, chương trình, quy chế và các văn bản chính thức của Đại hội.', 'cta' => 'Xem văn kiện', 'image' => false, 'exclude' => array(),
	),
);
?>
<section class="hero hero-banner">
	<div class="hero-frame hero-banner-frame">
		<img class="hero-img" src="<?php echo esc_url( get_theme_file_uri( 'assets/hero-dai-hoi-x-banner-v2.png' ) . '?v=' . filemtime( get_theme_file_path( 'assets/hero-dai-hoi-x-banner-v2.png' ) ) ); ?>" alt="Biểu trưng Đại hội Phật giáo toàn quốc lần thứ X bên Học viện Phật giáo Việt Nam tại Thành phố Hồ Chí Minh" width="2172" height="724" fetchpriority="high" decoding="async">
		<h1 class="hero-accessible-title">Đại hội đại biểu Phật giáo toàn quốc lần thứ X, nhiệm kỳ 2026 – 2031</h1>
	</div>
</section>

<section class="countdown-wrap" aria-label="Đếm ngược đến ngày khai mạc">
	<div class="wrap">
		<div class="countdown-panel">
			<div class="countdown-title">
				<span class="countdown-badge"><span class="live-dot"></span>Đại hội lần thứ X</span>
				<p class="countdown-kicker">Chờ đón thời khắc trọng đại</p>
				<h2>Đếm ngược đến <span>ngày khai mạc</span></h2>
				<div class="countdown-date"><?php echo daihoi_icon( 'calendar', 20 ); ?><span><small>Ngày khai mạc</small><strong>05.11.2026</strong></span></div>
			</div>
			<div class="countdown-clock">
				<p class="countdown-clock-label"><i></i><span>Thời gian còn lại</span><i></i></p>
				<div class="countdown" data-start="<?php echo esc_attr( daihoi_event_start() ); ?>" aria-live="off">
					<div><b data-u="d">00</b><span>Ngày</span></div>
					<div><b data-u="h">00</b><span>Giờ</span></div>
					<div><b data-u="m">00</b><span>Phút</span></div>
					<div><b data-u="s">00</b><span>Giây</span></div>
				</div>
			</div>
			<div class="event-place"><span class="event-place-ico"><?php echo daihoi_icon( 'pin', 22 ); ?></span><div class="event-place-copy"><small>Địa điểm tổ chức</small><strong>Học viện Phật giáo Việt Nam</strong><em>TP. Hồ Chí Minh</em></div></div>
		</div>
	</div>
</section>

<section class="section schedule" id="chuong-trinh">
	<div class="wrap">
		<header class="schedule-head">
			<div class="schedule-heading-copy">
				<p class="schedule-kicker"><i></i><span>Kho tư liệu chính thức</span></p>
				<h2>Văn kiện <em>Đại hội</em></h2>
				<p class="schedule-intro">Tra cứu chương trình, văn kiện và các tham luận chính thức của Đại hội đại biểu Phật giáo toàn quốc <span class="text-nowrap">lần thứ X</span>.</p>
			</div>
			<a class="schedule-all" href="<?php echo esc_url( $doc_url ); ?>"><span>Xem toàn bộ văn kiện</span><?php echo daihoi_icon( 'arrow-right', 18 ); ?></a>
		</header>
		<?php
		$document_icons = array( 'calendar', 'file', 'wheel' );
		$document_descs = array(
			'Chương trình làm việc, nghi lễ và các hoạt động trọng tâm trong thời gian diễn ra Đại hội.',
			'Hệ thống báo cáo, nghị quyết và những văn bản chính thức phục vụ Đại hội.',
			'Tổng hợp ý kiến, tham luận chuyên đề và nội dung kỷ yếu của chư Tôn đức, đại biểu.',
		);
		?>
		<ol class="schedule-days">
			<?php foreach ( daihoi_programme_days() as $i => $day ) :
				$num   = isset( $day['num'] ) ? $day['num'] : sprintf( '%02d', $i + 1 );
				$badge = isset( $day['badge'] ) ? $day['badge'] : '';
				$url   = ! empty( $day['url'] ) ? $day['url'] : '';
				$cta   = ! empty( $day['cta'] ) ? $day['cta'] : 'Xem chi tiết';
				$icon  = isset( $document_icons[ $i ] ) ? $document_icons[ $i ] : 'file';
				$desc  = ! empty( $day['desc'] ) ? $day['desc'] : ( isset( $document_descs[ $i ] ) ? $document_descs[ $i ] : '' );
				$title = ! empty( $day['label'] ) ? $day['label'] : $day['title'];
			?>
				<li<?php if ( $url ) : ?> class="has-link"<?php endif; ?>>
					<?php if ( $url ) : ?><a class="schedule-card-link" href="<?php echo esc_url( $url ); ?>" aria-label="<?php echo esc_attr( $day['title'] ); ?>"><?php endif; ?>
						<div class="schedule-card-top">
							<time><b><?php echo esc_html( $num ); ?></b><?php if ( $badge ) : ?><span><?php echo esc_html( $badge ); ?></span><?php endif; ?></time>
							<span class="schedule-card-icon"><?php echo daihoi_icon( $icon, 25 ); ?></span>
						</div>
						<div class="schedule-body">
							<small>Đại hội lần thứ X · 2026–2031</small>
							<h3><?php echo esc_html( $title ); ?></h3>
							<?php if ( $desc ) : ?><p><?php echo esc_html( $desc ); ?></p><?php endif; ?>
							<?php if ( $url ) : ?><span class="schedule-cta"><?php echo esc_html( $cta ); ?> <?php echo daihoi_icon( 'arrow-right', 16 ); ?></span><?php endif; ?>
						</div>
					<?php if ( $url ) : ?></a><?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

<section class="entry-section" id="tin-tuc">
	<div class="wrap">
		<header class="entry-section-head">
			<p class="entry-section-kicker"><i></i><span>Truy cập nhanh</span><i></i></p>
			<h2>Khám phá nội dung <em>Đại hội</em></h2>
		</header>
		<div class="entry-grid">
		<?php foreach ( $entry_cards as $i => $card ) :
			$ext = ! empty( $card['external'] );
			$bg  = $card['image'] ? get_theme_file_uri( 'assets/hero-dai-hoi-x-2026.jpg' ) : '';
			$term  = $ext ? null : get_category_by_slug( $card['slug'] );
			$count = $term ? (int) $term->count : 0;
		?>
			<a class="entry-card <?php echo $ext ? 'entry-card-news' : 'entry-card-docs'; ?>" href="<?php echo esc_url( $card['url'] ); ?>"<?php if ( $ext ) : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?><?php if ( $bg ) : ?> style="--bg:url('<?php echo esc_url( $bg ); ?>')"<?php endif; ?>>
				<span class="entry-card-top">
					<span class="entry-ico"><?php echo daihoi_icon( $card['icon'], 27 ); ?></span>
					<span class="entry-status"><i></i><?php echo esc_html( $ext ? 'Cập nhật liên tục' : 'Tài liệu chính thức' ); ?></span>
					<span class="entry-number" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
				</span>
				<span class="entry-text">
					<small><?php echo esc_html( $card['label'] ); ?></small>
					<strong><?php echo esc_html( $card['title'] ); ?></strong>
					<span><?php echo esc_html( $card['desc'] ); ?></span>
				</span>
				<span class="entry-foot"><em><i></i><?php if ( $count ) : ?><?php echo (int) $count; ?> bài viết<?php elseif ( $ext ) : ?>Nguồn: Phật sự Online<?php else : ?>Đang cập nhật<?php endif; ?></em><b><span><?php echo esc_html( $card['cta'] ); ?></span><i class="entry-arrow"><?php echo daihoi_icon( $ext ? 'external' : 'arrow-right', 17 ); ?></i></b></span>
			</a>
		<?php endforeach; ?>
		</div>
	</div>
</section>

<?php get_footer();
