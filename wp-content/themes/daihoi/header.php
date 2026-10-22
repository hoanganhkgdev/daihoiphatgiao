<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">Bỏ qua đến nội dung</a>

<div class="event-strip" id="top">
	<div class="wrap event-strip-inner">
		<span><?php echo daihoi_icon( 'lotus', 15 ); ?> Giáo Hội Phật Giáo Việt Nam</span>
		<span class="event-strip-meta"><b>Đại hội lần thứ X</b><i></i> 05–07.11.2026 <i></i> TP. Hồ Chí Minh</span>
	</div>
</div>

<header class="site-header">
	<div class="wrap header-inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img class="brand-logo" src="<?php echo esc_url( get_theme_file_uri( 'assets/logo-x.png' ) . '?v=' . filemtime( get_theme_file_path( 'assets/logo-x.png' ) ) ); ?>" alt="Đại Hội Phật Giáo – Giáo Hội Phật Giáo Việt Nam" width="839" height="723">
		</a>
		<button class="nav-toggle" aria-expanded="false" aria-controls="primary-nav" aria-label="Mở menu"><span></span><span></span><span></span></button>
		<nav class="primary-nav" id="primary-nav" aria-label="Menu chính">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu', 'fallback_cb' => function () {
				echo '<ul class="menu"><li><a class="nav-link" href="' . esc_url( home_url( '/' ) ) . '">Trang chủ</a></li><li><a class="nav-link" href="' . esc_url( daihoi_category_url( DAIHOI_DOC_CATEGORY ) ) . '">Văn kiện</a></li><li><a class="nav-link" href="' . esc_url( DAIHOI_NEWS_URL ) . '" target="_blank" rel="noopener noreferrer">Tin tức</a></li></ul>';
			} ) ); ?>
		</nav>
		<a class="header-date" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span>05–07</span><small>11 · 2026</small></a>
	</div>
</header>
<main id="main">
