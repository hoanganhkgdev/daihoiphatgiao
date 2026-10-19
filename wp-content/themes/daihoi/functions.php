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
	wp_enqueue_style( 'daihoi-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&subset=vietnamese&display=swap', array(), null );
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
add_filter( 'nav_menu_link_attributes', function ( $atts ) {
	$atts['class'] = trim( ( $atts['class'] ?? '' ) . ' nav-link' );
	return $atts;
} );

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
		'arrow-up' => '<path d="M12 19V5M5.5 11.5 12 5l6.5 6.5"/>',
		'arrow-left'  => '<path d="M19 12H5M11.5 5.5 5 12l6.5 6.5"/>',
		'arrow-right' => '<path d="M5 12h14M12.5 5.5 19 12l-6.5 6.5"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return '<svg class="icon icon-' . esc_attr( $name ) . '" width="' . (int) $size . '" height="' . (int) $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[ $name ] . '</svg>';
}
