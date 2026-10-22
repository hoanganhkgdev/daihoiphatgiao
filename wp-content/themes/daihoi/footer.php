</main>
<footer class="site-footer">
	<div class="footer-callout">
		<div class="wrap footer-callout-inner">
			<span class="callout-ico"><?php echo daihoi_icon( 'lotus', 34 ); ?></span>
			<div class="callout-text">
				<small>Đại hội đại biểu Phật giáo toàn quốc lần thứ X</small>
				<ul class="callout-words"><li>Kỷ cương</li><li>Đổi mới</li><li>Hiệu lực</li><li>Hiệu quả</li></ul>
			</div>
			<a class="callout-top" href="#top">Về đầu trang <span><?php echo daihoi_icon( 'arrow-up', 18 ); ?></span></a>
		</div>
	</div>
	<div class="wrap footer-grid">
		<div class="footer-about">
			<a class="footer-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( get_theme_file_uri( 'assets/logo-x.png' ) . '?v=' . filemtime( get_theme_file_path( 'assets/logo-x.png' ) ) ); ?>" alt="Đại Hội Phật Giáo – Giáo Hội Phật Giáo Việt Nam" width="839" height="723" loading="lazy">
			</a>
			<p>Trang thông tin Đại hội đại biểu Phật giáo toàn quốc lần thứ X, nhiệm kỳ 2026 – 2031.</p>
			<p class="footer-tags"><span>05 – 07/11/2026</span><span>TP. Hồ Chí Minh</span></p>
		</div>

		<div class="footer-col">
			<h3 class="footer-title">Thông tin Đại hội</h3>
			<ul class="footer-info">
				<li><span class="fi"><?php echo daihoi_icon( 'calendar', 22 ); ?></span><div><small>Thời gian</small>Ngày 05 – 07/11/2026</div></li>
				<li><span class="fi"><?php echo daihoi_icon( 'pin', 22 ); ?></span><div><small>Địa điểm</small>Học viện Phật giáo Việt Nam, TP. Hồ Chí Minh<a class="footer-map" href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo rawurlencode( 'Học viện Phật giáo Việt Nam TP. Hồ Chí Minh' ); ?>" target="_blank" rel="noopener noreferrer">Chỉ đường <?php echo daihoi_icon( 'external', 14 ); ?></a></div></li>
			</ul>
		</div>

		<div class="footer-col">
			<h3 class="footer-title">Liên kết nhanh</h3>
			<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'menu_class' => 'footer-menu', 'fallback_cb' => function () {
				echo '<ul class="footer-menu"><li><a href="' . esc_url( home_url( '/' ) ) . '">Trang chủ</a></li><li><a href="' . esc_url( daihoi_category_url( DAIHOI_DOC_CATEGORY ) ) . '">Văn kiện Đại hội</a></li><li><a href="' . esc_url( DAIHOI_NEWS_URL ) . '" target="_blank" rel="noopener noreferrer">Tin tức &amp; sự kiện</a></li></ul>';
			} ) ); ?>
		</div>
	</div>

	<div class="copyright">
		<div class="wrap copyright-inner">
			<span>© <?php echo esc_html( date( 'Y' ) ); ?> Giáo Hội Phật Giáo Việt Nam. Bảo lưu mọi quyền.</span>
			<span class="blessing"><?php echo daihoi_icon( 'lotus', 16 ); ?> Nam mô Bổn Sư Thích Ca Mâu Ni Phật</span>
		</div>
	</div>
	<div class="footer-flag" aria-hidden="true"></div>
</footer>
<a class="to-top" href="#top" aria-label="Về đầu trang"><?php echo daihoi_icon( 'arrow-up', 20 ); ?></a>
<?php wp_footer(); ?>
</body>
</html>
