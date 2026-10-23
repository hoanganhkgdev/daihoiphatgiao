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
			<img class="brand-logo" src="<?php echo esc_url( get_theme_file_uri( 'assets/logo-dai-hoi-x-horizontal.png' ) . '?v=' . filemtime( get_theme_file_path( 'assets/logo-dai-hoi-x-horizontal.png' ) ) ); ?>" alt="Đại hội Phật giáo toàn quốc lần thứ X, nhiệm kỳ 2026 – 2031" width="2172" height="724">
		</a>
		<button class="nav-toggle" aria-expanded="false" aria-controls="primary-nav" aria-label="Mở menu"><span></span><span></span><span></span></button>
		<nav class="primary-nav" id="primary-nav" aria-label="Menu chính">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'menu',
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>
		<button class="mobile-search-toggle" type="button" aria-expanded="false" aria-controls="header-search" aria-label="Mở tìm kiếm">
			<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><circle cx="11" cy="11" r="6.5" fill="none" stroke="currentColor" stroke-width="2"/><path d="m16 16 4 4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
		</button>
		<form class="header-search" id="header-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="header-search-field">Tìm kiếm nội dung</label>
			<input id="header-search-field" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Tìm kiếm…" autocomplete="off">
			<button type="submit" aria-label="Tìm kiếm">
				<svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><circle cx="11" cy="11" r="6.5" fill="none" stroke="currentColor" stroke-width="2"/><path d="m16 16 4 4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
			</button>
		</form>
		<a class="header-date" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span>05–07</span><small>11 · 2026</small></a>
	</div>
</header>
<main id="main">
