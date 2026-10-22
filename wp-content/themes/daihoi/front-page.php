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
<section class="hero">
	<div class="hero-frame">
		<img class="hero-img" src="<?php echo esc_url( get_theme_file_uri( 'assets/hero-dai-hoi-x-2026.jpg' ) ); ?>" alt="Không gian sân khấu trang trọng hướng tới Đại hội đại biểu Phật giáo toàn quốc lần thứ X" width="1672" height="941" fetchpriority="high" decoding="async">
		<div class="hero-caption">
			<p class="hero-eyebrow"><?php echo daihoi_icon( 'lotus', 18 ); ?> Giáo Hội Phật Giáo Việt Nam</p>
			<h1><small>Đại hội đại biểu Phật giáo toàn quốc</small><strong>Lần thứ X</strong></h1>
			<span class="hero-term">Nhiệm kỳ 2026 – 2031</span>
			<p class="hero-theme"><b>Kỷ cương</b><i></i><b>Đổi mới</b><i></i><b>Hiệu lực</b><i></i><b>Hiệu quả</b></p>
			<div class="hero-actions">
				<a class="hero-btn hero-btn-gold" href="<?php echo esc_url( daihoi_category_url( DAIHOI_DOC_CATEGORY ) ); ?>">Văn kiện Đại hội <?php echo daihoi_icon( 'arrow-right', 18 ); ?></a>
				<a class="hero-btn hero-btn-line" href="<?php echo esc_url( DAIHOI_NEWS_URL ); ?>" target="_blank" rel="noopener noreferrer">Tin tức</a>
			</div>
		</div>
		<div class="hero-corner" aria-hidden="true"><span>X</span><small>2026<br>2031</small></div>
	</div>
</section>

<section class="countdown-wrap" aria-label="Đếm ngược đến ngày khai mạc">
	<div class="wrap">
		<div class="countdown-panel">
			<div class="countdown-title">
				<span class="countdown-badge"><span class="live-dot"></span>Sắp diễn ra</span>
				<h2>Đếm ngược đến ngày khai mạc</h2>
				<p class="countdown-date"><?php echo daihoi_icon( 'calendar', 20 ); ?> <strong>05.11.2026</strong><i></i>Khai mạc Đại hội</p>
			</div>
			<div class="countdown" data-start="<?php echo esc_attr( daihoi_event_start() ); ?>" aria-live="off">
				<div><b data-u="d">00</b><span>Ngày</span></div>
				<div><b data-u="h">00</b><span>Giờ</span></div>
				<div><b data-u="m">00</b><span>Phút</span></div>
				<div><b data-u="s">00</b><span>Giây</span></div>
			</div>
			<div class="event-place"><span class="event-place-ico"><?php echo daihoi_icon( 'pin', 22 ); ?></span><span><small>Địa điểm tổ chức</small>Học viện Phật giáo Việt Nam<br>tại TP. Hồ Chí Minh</span></div>
		</div>
	</div>
</section>

<section class="section schedule" id="chuong-trinh">
	<div class="wrap">
		<header class="schedule-head">
			<div><h2>VĂN KIỆN ĐẠI HỘI</h2></div>
			<a class="text-link" href="<?php echo esc_url( $doc_url ); ?>">Theo dõi văn kiện <?php echo daihoi_icon( 'arrow-right', 18 ); ?></a>
		</header>
		<ol class="schedule-days">
			<?php foreach ( daihoi_programme_days() as $i => $day ) :
				$num   = isset( $day['num'] ) ? $day['num'] : sprintf( '%02d', $i + 1 );
				$badge = isset( $day['badge'] ) ? $day['badge'] : '';
				$url   = ! empty( $day['url'] ) ? $day['url'] : '';
				$cta   = ! empty( $day['cta'] ) ? $day['cta'] : 'Xem chi tiết';
			?>
				<li<?php if ( $url ) : ?> class="has-link"<?php endif; ?>>
					<?php if ( $url ) : ?><a class="schedule-card-link" href="<?php echo esc_url( $url ); ?>"><?php endif; ?>
						<time><b><?php echo esc_html( $num ); ?></b><?php if ( $badge ) : ?><span><?php echo esc_html( $badge ); ?></span><?php endif; ?></time>
						<div class="schedule-body">
							<?php if ( ! empty( $day['label'] ) ) : ?><small><?php echo esc_html( $day['label'] ); ?></small><?php endif; ?>
							<h3><?php echo esc_html( $day['title'] ); ?></h3>
							<?php if ( ! empty( $day['desc'] ) ) : ?><p><?php echo esc_html( $day['desc'] ); ?></p><?php endif; ?>
							<?php if ( $url ) : ?><span class="schedule-cta"><?php echo esc_html( $cta ); ?> <?php echo daihoi_icon( 'arrow-right', 16 ); ?></span><?php endif; ?>
						</div>
					<?php if ( $url ) : ?></a><?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

<section class="entry-section" id="tin-tuc">
	<div class="wrap entry-grid">
		<?php foreach ( $entry_cards as $card ) :
			$ext = ! empty( $card['external'] );
			$bg  = $card['image'] ? get_theme_file_uri( 'assets/hero-dai-hoi-x-2026.jpg' ) : '';
			$term  = $ext ? null : get_category_by_slug( $card['slug'] );
			$count = $term ? (int) $term->count : 0;
		?>
			<a class="entry-card" href="<?php echo esc_url( $card['url'] ); ?>"<?php if ( $ext ) : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?><?php if ( $bg ) : ?> style="--bg:url('<?php echo esc_url( $bg ); ?>')"<?php endif; ?>>
				<span class="entry-ico"><?php echo daihoi_icon( $card['icon'], 26 ); ?></span>
				<span class="entry-text">
					<small><?php echo esc_html( $card['label'] ); ?></small>
					<strong><?php echo esc_html( $card['title'] ); ?></strong>
					<span><?php echo esc_html( $card['desc'] ); ?></span>
				</span>
				<span class="entry-foot"><?php if ( $count ) : ?><em><?php echo (int) $count; ?> bài viết</em><?php elseif ( $ext ) : ?><em>Phật sự Online</em><?php endif; ?><b><?php echo esc_html( $card['cta'] ); ?> <?php echo daihoi_icon( $ext ? 'external' : 'arrow-right', 18 ); ?></b></span>
			</a>
		<?php endforeach; ?>
	</div>
</section>

<?php get_footer();
