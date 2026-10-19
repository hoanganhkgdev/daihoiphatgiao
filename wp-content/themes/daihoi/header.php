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

<div class="topbar">
	<div class="wrap"><span>Giáo Hội Phật Giáo Việt Nam</span><span class="topbar-date">Đại hội X · 05–07/11/2026 · TP. Hồ Chí Minh</span></div>
</div>

<header class="site-header" id="top">
	<div class="wrap header-inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
				<img class="brand-logo" src="<?php echo esc_url( get_theme_file_uri( 'assets/logo.png' ) ); ?>" alt="Giáo Hội Phật Giáo Việt Nam" width="52" height="52">
			<?php endif; ?>
			<span class="brand-text"><strong><?php bloginfo( 'name' ); ?></strong><small><?php bloginfo( 'description' ); ?></small></span>
		</a>
		<button class="nav-toggle" aria-expanded="false" aria-controls="primary-nav" aria-label="Mở menu"><span></span><span></span><span></span></button>
		<nav class="primary-nav" id="primary-nav" aria-label="Menu chính">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu', 'fallback_cb' => function () {
				echo '<ul class="menu"><li><a class="nav-link" href="' . esc_url( home_url( '/' ) ) . '">Trang chủ</a></li></ul>';
			} ) ); ?>
		</nav>
	</div>
</header>
<main id="main">
