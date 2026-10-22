<?php
add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'daihoi' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 240, 'flex-width' => true, 'flex-height' => true ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	register_nav_menus( array(
		'primary' => 'Menu chính',
		'footer'  => 'Menu chân trang',
	) );
} );

add_action( 'wp_enqueue_scripts', function () {
	$ver = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'daihoi-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap&subset=vietnamese', array(), null );
	wp_enqueue_style( 'daihoi', get_template_directory_uri() . '/assets/main.css', array( 'daihoi-fonts' ), filemtime( get_template_directory() . '/assets/main.css' ) );
	wp_enqueue_script( 'daihoi', get_template_directory_uri() . '/assets/main.js', array(), filemtime( get_template_directory() . '/assets/main.js' ), true );
} );

// Ngày diễn ra Đại hội (dùng cho đếm ngược). Đổi bằng filter 'daihoi_event_start' nếu cần.
function daihoi_event_start() {
	return apply_filters( 'daihoi_event_start', '2026-11-05T08:00:00+07:00' );
}

add_filter( 'excerpt_length', fn() => 28 );
add_filter( 'excerpt_more', fn() => '…' );

// Nhãn menu: thêm class cho liên kết
add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
	if ( isset( $args->theme_location ) && 'primary' === $args->theme_location ) {
		$atts['class'] = trim( ( $atts['class'] ?? '' ) . ' nav-link' );
	}
	return $atts;
}, 10, 3 );

// Gỡ bớt thứ không cần
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Favicon: dùng biểu trưng GHPGVN khi chưa đặt Site Icon trong Customizer.
add_action( 'wp_head', 'daihoi_favicon', 1 );
add_action( 'admin_head', 'daihoi_favicon', 1 );
add_action( 'login_head', 'daihoi_favicon', 1 );
function daihoi_favicon() {
	if ( has_site_icon() ) {
		return;
	}
	$u = get_theme_file_uri( 'assets/' );
	echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url( $u . 'icon-32.png' ) . '">' . "\n";
	echo '<link rel="icon" type="image/png" sizes="192x192" href="' . esc_url( $u . 'icon-192.png' ) . '">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url( $u . 'icon-180.png' ) . '">' . "\n";
}

// Icon SVG nội tuyến (nét vẽ, màu theo currentColor).
function daihoi_icon( $name, $size = 24 ) {
	$paths = array(
		'calendar' => '<rect x="3" y="4.5" width="18" height="16.5" rx="2.5"/><path d="M3 9.5h18M8 2.5v4M16 2.5v4"/><path d="M8 14h.01M12 14h.01M16 14h.01M8 17.5h.01M12 17.5h.01"/>',
		'pin'      => '<path d="M12 21.5s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z"/><circle cx="12" cy="9.5" r="2.6"/>',
		'lotus'    => '<path d="M12 4c2.2 2.3 3.2 4.6 3.2 7.2 0 2.7-1.4 4.9-3.2 6.3-1.8-1.4-3.2-3.6-3.2-6.3C8.8 8.6 9.8 6.3 12 4Z"/><path d="M8.6 9.6C5.9 9.9 3.7 11.9 3 15c3.3.2 6-.2 9 3.2"/><path d="M15.4 9.6c2.7.3 4.9 2.3 5.6 5.4-3.3.2-6-.2-9 3.2"/><path d="M5 19.5c2.2.8 4.6 1 7 1s4.8-.2 7-1"/>',
		'wheel'    => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="2.4"/><path d="M12 3v6.6M12 14.4V21M3 12h6.6M14.4 12H21M5.6 5.6l4.7 4.7M13.7 13.7l4.7 4.7M18.4 5.6l-4.7 4.7M10.3 13.7l-4.7 4.7"/>',
		'file'     => '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8l-5-5Z"/><path d="M14 3v5h5M9 13h6M9 17h6"/>',
		'external' => '<path d="M14 4h6v6M20 4l-9 9"/><path d="M18 14v4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4"/>',
		'arrow-up' => '<path d="M12 19V5M5.5 11.5 12 5l6.5 6.5"/>',
		'arrow-down' => '<path d="M12 5v14M5.5 12.5 12 19l6.5-6.5"/>',
		'arrow-left'  => '<path d="M19 12H5M11.5 5.5 5 12l6.5 6.5"/>',
		'arrow-right' => '<path d="M5 12h14M12.5 5.5 19 12l-6.5 6.5"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return '<svg class="icon icon-' . esc_attr( $name ) . '" width="' . (int) $size . '" height="' . (int) $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[ $name ] . '</svg>';
}

// Chuyên mục dùng cho các mục trên trang chủ (theo đường dẫn chuyên mục).
const DAIHOI_DOC_CATEGORY  = 'van-kien-dai-hoi';
const DAIHOI_NEWS_CATEGORY = 'tin-tuc-su-kien';

// Tin tức Đại hội được đăng tại Phật sự Online; các nút "Tin tức" trên site dẫn tới trang này.
const DAIHOI_NEWS_URL = 'https://phatsuonline.vn/tin/dai-hoi-phat-giao-toan-quoc-nk-2026-2031-41';

add_action( 'pre_get_posts', function ( $q ) {
	if ( ! is_admin() && $q->is_main_query() && $q->is_category( DAIHOI_DOC_CATEGORY ) ) {
		$q->set( 'posts_per_page', 12 );
	}
} );

// Đường dẫn tới trang chuyên mục theo slug (về trang chủ nếu chuyên mục chưa có).
function daihoi_category_url( $slug ) {
	if ( DAIHOI_DOC_CATEGORY === $slug ) {
		return home_url( '/muc-luc-van-kien-dai-hoi-dai-bieu-phat-giao-toan-quoc-lan-thu-x/' );
	}
	$cat = get_category_by_slug( $slug );
	return $cat ? get_category_link( $cat ) : home_url( '/' );
}

// Lịch ba ngày Đại hội (mục "Chương trình" trên trang chủ). Cập nhật nội dung thật tại đây hoặc qua filter.
function daihoi_programme_days() {
	return apply_filters( 'daihoi_programme_days', array(
		array(
			'num'   => '01',
			'badge' => 'Chương trình',
			'label' => 'Chương trình & Đại lễ',
			'title' => 'Chương trình Đại hội Đại biểu Phật giáo toàn quốc lần thứ X, nhiệm kỳ 2026 - 2031 & Đại lễ kỷ niệm 45 năm thành lập GHPGVN',
			'desc'  => '',
			'url'   => home_url( '/chuong-trinh-dai-hoi-dai-bieu-phat-giao-toan-quoc-lan-thu-x-nhiem-ky-2026-2031/' ),
			'cta'   => 'Xem chi tiết chương trình',
		),
		array(
			'num'   => '02',
			'badge' => 'Văn kiện',
			'label' => 'Văn kiện Đại hội',
			'title' => 'Văn kiện Đại hội Đại biểu Phật giáo toàn quốc lần thứ X, nhiệm kỳ 2026 – 2031',
			'desc'  => '',
			'url'   => home_url( '/muc-luc-van-kien-dai-hoi-dai-bieu-phat-giao-toan-quoc-lan-thu-x/' ),
			'cta'   => 'Xem mục lục văn kiện',
		),
		array(
			'num'   => '03',
			'badge' => 'Tham luận',
			'label' => 'Tham luận & Kỷ yếu',
			'title' => 'Tham luận Đại hội Đại biểu Phật giáo toàn quốc lần thứ X, nhiệm kỳ 2026 - 2031 & Đại lễ kỷ niệm 45 năm thành lập GHPGVN',
			'desc'  => '',
			'url'   => home_url( '/tham-luan-dai-hoi-dai-bieu-phat-giao-toan-quoc-lan-thu-x-nhiem-ky-2026-2031-dai-le-ky-niem-45-nam-thanh-lap-ghpgvn/' ),
			'cta'   => 'Xem mục lục tham luận',
		),
	) );
}


// Tự động chuyển trình soạn thảo về chế độ Trực quan (Visual / TinyMCE) để dễ chỉnh sửa chữ
add_filter( 'wp_default_editor', function() {
	return 'tinymce';
} );

// Tự động xóa cache LiteSpeed mỗi khi lưu bài viết / trang
add_action( 'save_post', function() {
	if ( ! headers_sent() ) {
		header( 'X-LiteSpeed-Purge: *' );
	}
} );

// Tự động trình bày bảng Chương trình Đại hội (trang ID 33) sang giao diện trang trọng khi hiển thị ngoài trang web
add_filter( 'the_content', function ( $content ) {
	if ( is_admin() || ! is_singular() || get_the_ID() !== 33 ) {
		return $content;
	}
	if ( strpos( $content, '<table' ) === false ) {
		return $content;
	}

	$parts = preg_split( '/(<table\b[^>]*>.*?<\/table>)/is', $content, 2, PREG_SPLIT_DELIM_CAPTURE );
	if ( count( $parts ) < 2 ) {
		return $content;
	}
	$intro_raw = trim( $parts[0] );
	$table_raw = $parts[1];

	// Trích xuất các dòng giới thiệu phía trên bảng
	$intro_lines = array();
	if ( preg_match_all( '/<(?:h[1-6]|p)[^>]*>(.*?)<\/(?:h[1-6]|p)>/is', $intro_raw, $m ) ) {
		foreach ( $m[1] as $line ) {
			$clean = trim( wp_strip_all_tags( $line ) );
			if ( $clean !== '' ) {
				$intro_lines[] = $clean;
			}
		}
	}
	$main_title = $intro_lines[0] ?? 'CHƯƠNG TRÌNH';
	$sub_title  = $intro_lines[1] ?? '';
	$date_text  = $intro_lines[2] ?? 'Từ ngày 05 đến ngày 07 tháng 11 năm 2026';
	$loc_text   = $intro_lines[3] ?? '';
	$loc_text   = trim( $loc_text, "() 	
 " );
	$loc_text   = preg_replace( '/^Địa điểm:\s*/iu', '', $loc_text );

	// Phân tích các dòng <tr> trong bảng
	$days = array();
	$current_day = null;
	$complete_msg = '';
	$sign_text = '';

	if ( preg_match_all( '/<tr\b[^>]*>(.*?)<\/tr>/is', $table_raw, $tr_matches ) ) {
		foreach ( $tr_matches[1] as $tr_inner ) {
			if ( ! preg_match_all( '/<td\b([^>]*)>(.*?)<\/td>/is', $tr_inner, $td_matches, PREG_SET_ORDER ) ) {
				continue;
			}
			$col_count = count( $td_matches );
			$c1_attr = $td_matches[0][1];
			$c1_raw  = $td_matches[0][2];
			$c1_text = trim( html_entity_decode( wp_strip_all_tags( $c1_raw ), ENT_QUOTES, 'UTF-8' ) );
			$c2_raw  = $col_count > 1 ? $td_matches[1][2] : '';
			$c2_text = trim( html_entity_decode( wp_strip_all_tags( $c2_raw ), ENT_QUOTES, 'UTF-8' ) );

			if ( $c1_text === '' && $c2_text === '' ) {
				continue;
			}

			$is_colspan = ( $col_count === 1 ) || ( stripos( $c1_attr, 'colspan' ) !== false );

			if ( $is_colspan ) {
				if ( preg_match( '/(THỨ\s+[^,]+,\s*NGÀY\s*(\d{1,2})\/(\d{1,2})(?:\/\d{4})?)/iu', $c1_text, $dm ) ) {
					if ( $current_day ) {
						$days[] = $current_day;
					}
					$day_num_int = (int) $dm[2];
					if ( 3 === $day_num_int ) {
						$d_label = 'Hoạt động chào mừng trước Đại hội';
					} elseif ( 5 === $day_num_int ) {
						$d_label = 'Ngày Đại hội thứ nhất';
					} elseif ( 6 === $day_num_int ) {
						$d_label = 'Ngày Đại hội thứ hai';
					} elseif ( 7 === $day_num_int ) {
						$d_label = 'Ngày Đại hội thứ ba';
					} else {
						$d_label = 'Ngày ' . ( count( $days ) + 1 );
					}
					$current_day = array(
						'id'    => sprintf( 'ngay-%02d-%02d', $day_num_int, (int) $dm[3] ),
						'num'   => sprintf( '%02d', $day_num_int ),
						'month' => 'Tháng ' . (int) $dm[3],
						'label' => $d_label,
						'title' => $c1_text,
						'items' => array(),
					);
				} else {
					if ( $current_day ) {
						$current_day['items'][] = array(
							'type' => 'session',
							'text' => $c1_text,
						);
					}
				}
				continue;
			}

			// Kiểm tra dòng kết thúc / chữ ký cuối bảng
			if ( $c1_text === '' && ( mb_stripos( $c2_text, 'BAN TỔ CHỨC' ) !== false || mb_stripos( $c2_text, 'kết thúc thành công' ) !== false ) ) {
				if ( mb_stripos( $c2_text, 'kết thúc thành công' ) !== false ) {
					$complete_msg = $c2_text;
				} else {
					$sign_text = $c2_text;
				}
				continue;
			}

			if ( $current_day ) {
				// Tách các dòng gạch đầu dòng trong ô nội dung
				$lines = preg_split( '/\r\n|\r|\n|<br\s*\/?>|<\/p>\s*<p[^>]*>/i', $c2_raw );
				$main_lines = array();
				$bullets = array();
				foreach ( $lines as $ln ) {
					$t = trim( html_entity_decode( wp_strip_all_tags( $ln ), ENT_QUOTES, 'UTF-8' ) );
					if ( $t === '' ) continue;
					if ( preg_match( '/^[–\-]\s*(.+)$/u', $t, $bm ) ) {
						$bullets[] = $bm[1];
					} else {
						$main_lines[] = $t;
					}
				}
				$headline = implode( ' ', $main_lines );
				$is_hl = ! empty( $bullets ) || preg_match( '/(Khai mạc|Đón tiếp|Khai trương|Chương trình Tân nhạc|Hội nghị|Lễ hội hoa đăng|Nhạc kịch cải lương|Âm nhạc đặc sắc|Đạo từ|Thông báo kết quả|Dâng y|Dâng pháp y|Thông qua Dự thảo)/iu', $headline );
				$current_day['items'][] = array(
					'type'     => 'row',
					'time'     => $c1_text,
					'headline' => $headline,
					'bullets'  => $bullets,
					'hl'       => $is_hl,
				);
			}
		}
	}
	if ( $current_day ) {
		$days[] = $current_day;
	}

	if ( empty( $days ) ) {
		return $content;
	}

	ob_start();
	?>
	<div class="prog-doc">
		<div class="prog-intro">
			<div class="prog-intro-badge">Văn bản chính thức</div>
			<h2 class="prog-intro-title"><?php echo esc_html( $main_title ); ?></h2>
			<?php if ( $sub_title ) : ?>
				<p class="prog-intro-sub"><strong><?php echo esc_html( $sub_title ); ?></strong></p>
			<?php endif; ?>
			<div class="prog-meta-grid">
				<div class="prog-meta-item">
					<span class="prog-meta-label">Thời gian tổ chức</span>
					<strong><?php echo esc_html( $date_text ); ?></strong>
				</div>
				<div class="prog-meta-item">
					<span class="prog-meta-label">Địa điểm tổ chức</span>
					<strong><?php echo esc_html( $loc_text ); ?></strong>
				</div>
			</div>
			<nav class="prog-day-nav" aria-label="Chọn ngày">
				<?php foreach ( $days as $idx => $d ) : ?>
					<a href="#<?php echo esc_attr( $d['id'] ); ?>">
						<span><?php echo esc_html( $d['label'] ); ?></span>
						<strong><?php echo esc_html( $d['title'] ); ?></strong>
					</a>
				<?php endforeach; ?>
			</nav>
		</div>

		<?php foreach ( $days as $d ) : ?>
			<section class="prog-day" id="<?php echo esc_attr( $d['id'] ); ?>">
				<header class="prog-day-head">
					<div class="prog-day-badge"><b><?php echo esc_html( $d['num'] ); ?></b><span><?php echo esc_html( $d['month'] ); ?></span></div>
					<div class="prog-day-title">
						<small><?php echo esc_html( $d['label'] ); ?></small>
						<h3><?php echo esc_html( $d['title'] ); ?></h3>
					</div>
				</header>
				<div class="prog-timeline">
					<?php foreach ( $d['items'] as $it ) : ?>
						<?php if ( 'session' === $it['type'] ) : ?>
							<div class="prog-session"><span><?php echo esc_html( $it['text'] ); ?></span></div>
						<?php else : ?>
							<div class="prog-row<?php echo $it['hl'] ? ' prog-row-highlight' : ''; ?>">
								<div class="prog-time">
									<?php if ( $it['time'] !== '' ) : ?>
										<span><?php echo esc_html( $it['time'] ); ?></span>
									<?php else : ?>
										<span class="prog-time-dot">•</span>
									<?php endif; ?>
								</div>
								<div class="prog-desc">
									<?php if ( $it['hl'] ) : ?>
										<strong><?php echo esc_html( $it['headline'] ); ?></strong>
									<?php else : ?>
										<?php echo esc_html( $it['headline'] ); ?>
									<?php endif; ?>
									<?php if ( ! empty( $it['bullets'] ) ) : ?>
										<ul class="prog-sublist">
											<?php foreach ( $it['bullets'] as $b ) : ?>
												<li><?php echo esc_html( $b ); ?></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endforeach; ?>

		<?php if ( $complete_msg || $sign_text ) : ?>
			<footer class="prog-footer">
				<div class="prog-complete"><?php echo esc_html( $complete_msg ?: 'Đại hội kết thúc thành công tốt đẹp.' ); ?></div>
				<div class="prog-sign">
					<span>TM. BAN TỔ CHỨC ĐẠI HỘI</span>
					<strong><?php echo esc_html( $sign_text ?: 'BAN TỔ CHỨC' ); ?></strong>
				</div>
			</footer>
		<?php endif; ?>
	</div>
	<?php
	return ob_get_clean();
}, 20 );


// Tự động trình bày bảng Mục lục Văn kiện Đại hội (trang ID 39) sang giao diện trang trọng ngoài trang web, giữ nguyên bảng thường trong trình sửa bài
add_filter( 'the_content', function ( $content ) {
	if ( is_admin() || ! is_singular() || get_the_ID() !== 39 ) {
		return $content;
	}
	if ( strpos( $content, '<table' ) === false ) {
		return $content;
	}

	$parts = preg_split( '/(<table\b[^>]*>.*?<\/table>)/is', $content, 2, PREG_SPLIT_DELIM_CAPTURE );
	if ( count( $parts ) < 2 ) {
		return $content;
	}
	$intro_raw = trim( $parts[0] );
	$table_raw = $parts[1];

	$intro_lines = array();
	if ( preg_match_all( '/<(?:h[1-6]|p)[^>]*>(.*?)<\/(?:h[1-6]|p)>/is', $intro_raw, $m ) ) {
		foreach ( $m[1] as $line ) {
			$clean = trim( html_entity_decode( wp_strip_all_tags( $line ), ENT_QUOTES, 'UTF-8' ) );
			$clean = trim( $clean, " 	
 Â " );
			if ( $clean !== '' && strpos( $clean, '❖' ) === false ) {
				$intro_lines[] = $clean;
			}
		}
	}
	$main_title = $intro_lines[0] ?? 'VĂN KIỆN ĐẠI HỘI';
	$sub_line1  = $intro_lines[1] ?? 'ĐẠI HỘI ĐẠI BIỂU PHẬT GIÁO TOÀN QUỐC LẦN THỨ X';
	$sub_line2  = $intro_lines[2] ?? 'NHIỆM KỲ 2026 – 2031';

	$items = array();
	if ( preg_match_all( '/<tr\b[^>]*>(.*?)<\/tr>/is', $table_raw, $tr_matches ) ) {
		foreach ( $tr_matches[1] as $tr_inner ) {
			if ( ! preg_match_all( '/<td\b[^>]*>(.*?)<\/td>/is', $tr_inner, $td_matches ) ) {
				continue;
			}
			$cols = $td_matches[1];
			$c1 = isset( $cols[0] ) ? trim( html_entity_decode( wp_strip_all_tags( $cols[0] ), ENT_QUOTES, 'UTF-8' ) ) : '';
			$c2_raw = $cols[1] ?? ( $cols[0] ?? '' );
			$c2 = trim( html_entity_decode( wp_strip_all_tags( $c2_raw ), ENT_QUOTES, 'UTF-8' ) );
			if ( $c2 === '' ) {
				continue;
			}
			$num_val = preg_replace( '/[^0-9]/', '', $c1 );
			$num_str = $num_val !== '' ? sprintf( '%02d', (int) $num_val ) : sprintf( '%02d', count( $items ) + 1 );

			$link = '';
			if ( preg_match( '/<a\b[^>]*href=["\']([^"\']+)["\']/i', $c2_raw, $lm ) ) {
				$link = $lm[1];
			} elseif ( (int) $num_str === 1 && mb_stripos( $c2, 'Chương trình' ) !== false ) {
				$link = home_url( '/chuong-trinh-dai-hoi-dai-bieu-phat-giao-toan-quoc-lan-thu-x-nhiem-ky-2026-2031/' );
			}

			$items[] = array(
				'num'   => $num_str,
				'title' => $c2,
				'url'   => $link,
			);
		}
	}

	if ( empty( $items ) ) {
		return $content;
	}

	ob_start();
	?>
	<div class="prog-doc toc-doc">
		<div class="prog-intro toc-intro">
			<div class="prog-intro-badge">Danh mục tài liệu chính thức</div>
			<h2 class="prog-intro-title"><?php echo esc_html( $main_title ); ?></h2>
			<p class="prog-intro-sub">
				<strong><?php echo esc_html( $sub_line1 ); ?></strong>
				<?php if ( $sub_line2 ) : ?><br><span class="toc-term"><?php echo esc_html( $sub_line2 ); ?></span><?php endif; ?>
			</p>
			<div class="toc-ornament" aria-hidden="true"><span>❖</span><span>❖</span><span>❖</span></div>
		</div>

		<ol class="toc-list">
			<?php foreach ( $items as $it ) : ?>
				<li class="toc-item<?php echo $it['url'] ? ' is-linked' : ''; ?>">
					<?php if ( $it['url'] ) : ?><a class="toc-link" href="<?php echo esc_url( $it['url'] ); ?>"><?php else : ?><div class="toc-link"><?php endif; ?>
						<span class="toc-num"><?php echo esc_html( $it['num'] ); ?></span>
						<span class="toc-icon"><?php echo daihoi_icon( 'file', 22 ); ?></span>
						<span class="toc-text">
							<small>Văn kiện số <?php echo esc_html( $it['num'] ); ?></small>
							<strong><?php echo esc_html( $it['title'] ); ?></strong>
						</span>
						<?php if ( $it['url'] ) : ?>
							<span class="toc-action">Xem chi tiết <?php echo daihoi_icon( 'arrow-right', 16 ); ?></span>
						<?php else : ?>
							<span class="toc-status">Đang cập nhật</span>
						<?php endif; ?>
					<?php if ( $it['url'] ) : ?></a><?php else : ?></div><?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ol>

		<p class="doc-back"><a class="text-link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo daihoi_icon( 'arrow-left', 18 ); ?> Về trang chủ</a></p>
	</div>
	<?php
	return ob_get_clean();
}, 20 );


// Tự động trình bày danh sách Tham luận Đại hội (trang ID 42) và 24 trang bài Tham luận con sang giao diện trang trọng ngoài trang web, giữ nguyên văn bản thường trong trình sửa bài
add_filter( 'the_content', function ( $content ) {
	if ( is_admin() || ! is_singular() ) {
		return $content;
	}
	$post_id = get_the_ID();

	// 1. Trang Mục lục 24 bài Tham luận (ID 42)
	if ( 42 === $post_id ) {
		if ( strpos( $content, '<li' ) === false ) {
			return $content;
		}

		$items = array();
		if ( preg_match_all( '/<li\b[^>]*>(.*?)<\/li>/is', $content, $li_matches ) ) {
			foreach ( $li_matches[1] as $idx => $li_raw ) {
				$link = '';
				if ( preg_match( '/<a\b[^>]*href=["\']([^"\']+)["\']/i', $li_raw, $lm ) ) {
					$link = $lm[1];
				}

				$author = '';
				$title_raw = $li_raw;
				if ( preg_match( '/^(.*?)<(?:em|i)\b[^>]*>(.*?)<\/(?:em|i)>\s*$/is', trim( $li_raw ), $am ) ) {
					$title_raw = $am[1];
					$author    = trim( html_entity_decode( wp_strip_all_tags( $am[2] ), ENT_QUOTES, 'UTF-8' ) );
				}
				$title_text = trim( html_entity_decode( wp_strip_all_tags( $title_raw ), ENT_QUOTES, 'UTF-8' ) );
				$title_text = rtrim( $title_text, ". 	
 –-" );
				$title_text = trim( $title_text );
				if ( $title_text === '' ) {
					continue;
				}

				$items[] = array(
					'num'    => sprintf( '%02d', count( $items ) + 1 ),
					'title'  => $title_text,
					'author' => $author,
					'url'    => $link,
				);
			}
		}

		if ( empty( $items ) ) {
			return $content;
		}

		$total_count = count( $items );
		ob_start();
		?>
		<div class="prog-doc toc-doc papers-doc">
			<div class="prog-intro toc-intro">
				<div class="prog-intro-badge">Kỷ yếu &amp; Nghiên cứu khoa học</div>
				<h2 class="prog-intro-title">MỤC LỤC CÁC BÀI THAM LUẬN</h2>
				<p class="prog-intro-sub">
					<strong>Đại hội Đại biểu Phật giáo toàn quốc lần thứ X, nhiệm kỳ 2026 – 2031</strong><br>
					và Đại lễ kỷ niệm 45 năm thành lập Giáo hội Phật giáo Việt Nam
				</p>
				<div class="papers-stats">
					<span><?php echo (int) $total_count; ?> bài tham luận chuyên đề</span>
				</div>
				<div class="toc-ornament" aria-hidden="true"><span>❖</span><span>❖</span><span>❖</span></div>
			</div>

			<ol class="toc-list papers-list">
				<?php foreach ( $items as $it ) : ?>
					<li class="toc-item paper-item<?php echo $it['url'] ? ' is-linked' : ''; ?>">
						<?php if ( $it['url'] ) : ?><a class="toc-link paper-link" href="<?php echo esc_url( $it['url'] ); ?>"><?php else : ?><div class="toc-link paper-link"><?php endif; ?>
							<span class="toc-num"><?php echo esc_html( $it['num'] ); ?></span>
							<span class="toc-icon"><?php echo daihoi_icon( 'lotus', 22 ); ?></span>
							<span class="toc-text paper-text">
								<small>Tham luận số <?php echo esc_html( $it['num'] ); ?></small>
								<strong><?php echo esc_html( $it['title'] ); ?></strong>
								<?php if ( $it['author'] ) : ?>
									<span class="paper-author"><em>Tác giả:</em> <b><?php echo esc_html( $it['author'] ); ?></b></span>
								<?php endif; ?>
							</span>
							<?php if ( $it['url'] ) : ?>
								<span class="toc-action">Xem tham luận <?php echo daihoi_icon( 'arrow-right', 16 ); ?></span>
							<?php endif; ?>
						<?php if ( $it['url'] ) : ?></a><?php else : ?></div><?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ol>

			<p class="doc-back"><a class="text-link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo daihoi_icon( 'arrow-left', 18 ); ?> Về trang chủ</a></p>
		</div>
		<?php
		return ob_get_clean();
	}

	// 2. Trang nội dung chi tiết từng bài Tham luận (trang con của trang 42)
	$parent_id = wp_get_post_parent_id( $post_id );
	$tl_num    = (int) get_post_meta( $post_id, '_dh_thamluan_num', true );
	if ( 42 === $parent_id || $tl_num > 0 ) {
		$toc_url = get_permalink( 42 );
		$author  = get_post_meta( $post_id, '_dh_thamluan_author', true );
		$num_str = $tl_num > 0 ? sprintf( '%02d', $tl_num ) : '';

		// Bọc bảng trong div cuộn ngang để đẹp trên di động
		$formatted_body = preg_replace( '/(<table\b[^>]*>.*?<\/table>)/is', '<div class="dh-paper-table-wrap">$1</div>', $content );

		// Tìm bài trước / bài sau
		$prev_post = null;
		$next_post = null;
		if ( $tl_num > 0 ) {
			$siblings = get_pages( array(
				'parent'      => 42,
				'sort_column' => 'menu_order',
				'sort_order'  => 'ASC',
			) );
			foreach ( $siblings as $sib ) {
				$snum = (int) get_post_meta( $sib->ID, '_dh_thamluan_num', true );
				if ( $snum === $tl_num - 1 ) {
					$prev_post = $sib;
				} elseif ( $snum === $tl_num + 1 ) {
					$next_post = $sib;
				}
			}
		}

		ob_start();
		?>
		<div class="prog-doc dh-paper-doc">
			<div class="dh-paper-topbar">
				<a class="dh-paper-back" href="<?php echo esc_url( $toc_url ); ?>">
					<?php echo daihoi_icon( 'arrow-left', 16 ); ?> Quay lại Mục lục Tham luận
				</a>
				<?php if ( $num_str ) : ?>
					<span class="dh-paper-badge">Tham luận chuyên đề số <?php echo esc_html( $num_str ); ?></span>
				<?php endif; ?>
			</div>

			<div class="dh-paper-header">
				<div class="dh-paper-kicker">Kỷ yếu Đại hội Phật giáo toàn quốc lần thứ X &amp; Kỷ niệm 45 năm GHPGVN (1981 – 2026)</div>
				<h2 class="dh-paper-title"><?php echo esc_html( get_the_title( $post_id ) ); ?></h2>
				<?php if ( $author ) : ?>
					<div class="dh-paper-author-box">
						<span class="dh-paper-author-icon"><?php echo daihoi_icon( 'lotus', 20 ); ?></span>
						<span><em>Tác giả:</em> <strong><?php echo esc_html( $author ); ?></strong></span>
					</div>
				<?php endif; ?>
			</div>

			<div class="dh-paper-body">
				<?php echo $formatted_body; ?>
			</div>

			<div class="dh-paper-nav">
				<?php if ( $prev_post ) : ?>
					<a class="dh-paper-nav-link dh-paper-nav-prev" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
						<small>← Tham luận số <?php echo esc_html( sprintf( '%02d', $tl_num - 1 ) ); ?></small>
						<strong><?php echo esc_html( wp_trim_words( $prev_post->post_title, 14, '...' ) ); ?></strong>
					</a>
				<?php else : ?>
					<span></span>
				<?php endif; ?>

				<a class="dh-paper-nav-toc" href="<?php echo esc_url( $toc_url ); ?>">
					Mục lục các bài Tham luận
				</a>

				<?php if ( $next_post ) : ?>
					<a class="dh-paper-nav-link dh-paper-nav-next" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
						<small>Tham luận số <?php echo esc_html( sprintf( '%02d', $tl_num + 1 ) ); ?> →</small>
						<strong><?php echo esc_html( wp_trim_words( $next_post->post_title, 14, '...' ) ); ?></strong>
					</a>
				<?php else : ?>
					<span></span>
				<?php endif; ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	return $content;
}, 20 );


// Sửa nút "Về đầu trang" (.callout-top, .to-top, a[href="#top"]) cuộn mượt lên đầu trang
add_action( 'wp_footer', function () {
	?>
	<script>
	(function() {
		document.addEventListener('click', function(e) {
			var btn = e.target.closest('.callout-top, .to-top, a[href="#top"]');
			if (!btn) return;
			e.preventDefault();
			window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
			setTimeout(function() {
				if (window.scrollY > 50) {
					document.documentElement.scrollTop = 0;
					document.body.scrollTop = 0;
				}
			}, 600);
		});
	})();
	</script>
	<?php
}, 99 );


// Đảm bảo mọi nút "Văn Kiện Đại Hội" trên menu đầu trang, chân trang và đường dẫn chuyên mục cũ đều dẫn thẳng vào trang Mục lục Văn kiện Đại hội (ID 39)
add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
	$mucluc_url = home_url( '/muc-luc-van-kien-dai-hoi-dai-bieu-phat-giao-toan-quoc-lan-thu-x/' );
	$href  = $atts['href'] ?? '';
	$title = mb_strtolower( trim( wp_strip_all_tags( $item->title ?? '' ) ), 'UTF-8' );
	if ( strpos( $href, 'van-kien-dai-hoi' ) !== false || strpos( $title, 'văn kiện' ) !== false ) {
		$atts['href'] = $mucluc_url;
	}
	return $atts;
}, 20, 3 );

add_filter( 'wp_nav_menu_objects', function ( $items ) {
	if ( is_singular() && get_the_ID() === 39 ) {
		foreach ( $items as $item ) {
			$title = mb_strtolower( trim( wp_strip_all_tags( $item->title ?? '' ) ), 'UTF-8' );
			if ( strpos( $title, 'văn kiện' ) !== false ) {
				$item->classes[] = 'current-menu-item';
			}
		}
	}
	return $items;
}, 20 );

add_action( 'template_redirect', function () {
	if ( is_category( DAIHOI_DOC_CATEGORY ) ) {
		wp_safe_redirect( home_url( '/muc-luc-van-kien-dai-hoi-dai-bieu-phat-giao-toan-quoc-lan-thu-x/' ), 301 );
		exit;
	}
} );
