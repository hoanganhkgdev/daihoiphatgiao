</main>
<footer class="site-footer">
	<div class="footer-callout">
		<div class="wrap footer-callout-inner">
			<div class="callout-heading">
				<span class="callout-ico"><?php echo daihoi_icon( 'lotus', 32 ); ?></span>
				<div class="callout-text">
					<small>Phương châm hành động</small>
					<h2>Bốn giá trị dẫn đường cho <em>Đại hội lần thứ X</em></h2>
				</div>
				<a class="callout-top" href="#top"><span>Về đầu trang</span><i><?php echo daihoi_icon( 'arrow-up', 18 ); ?></i></a>
			</div>
			<ol class="callout-words">
				<li><span>01</span><div><strong>Kỷ cương</strong><small>Nền tảng tổ chức</small></div></li>
				<li><span>02</span><div><strong>Đổi mới</strong><small>Tinh thần phát triển</small></div></li>
				<li><span>03</span><div><strong>Hiệu lực</strong><small>Thực thi đồng bộ</small></div></li>
				<li><span>04</span><div><strong>Hiệu quả</strong><small>Phụng sự thiết thực</small></div></li>
			</ol>
		</div>
	</div>
	<div class="wrap footer-grid">
		<div class="footer-about">
			<a class="footer-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( get_theme_file_uri( 'assets/logo-dai-hoi-x-horizontal.png' ) . '?v=' . filemtime( get_theme_file_path( 'assets/logo-dai-hoi-x-horizontal.png' ) ) ); ?>" alt="Đại hội Phật giáo toàn quốc lần thứ X, nhiệm kỳ 2026 – 2031" width="2172" height="724" loading="lazy">
			</a>
			<p class="footer-eyebrow"><i></i>Trang thông tin chính thức</p>
			<p class="footer-description">Đại hội đại biểu Phật giáo toàn quốc lần thứ X, nhiệm kỳ 2026 – 2031.</p>
			<div class="footer-tags"><span><?php echo daihoi_icon( 'calendar', 15 ); ?>05 – 07.11.2026</span><span><?php echo daihoi_icon( 'pin', 15 ); ?>TP. Hồ Chí Minh</span></div>
		</div>

		<div class="footer-col">
			<h3 class="footer-title"><span>01</span>Thông tin Đại hội</h3>
			<ul class="footer-info">
				<li><span class="fi"><?php echo daihoi_icon( 'calendar', 22 ); ?></span><div><small>Thời gian</small>Ngày 05 – 07/11/2026</div></li>
				<li><span class="fi"><?php echo daihoi_icon( 'pin', 22 ); ?></span><div><small>Địa điểm</small>Học viện Phật giáo Việt Nam, TP. HCM</div></li>
			</ul>
		</div>

		<div class="footer-col footer-links">
			<h3 class="footer-title"><span>02</span>Liên kết nhanh</h3>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'footer-menu',
					'fallback_cb'    => false,
				)
			);
			?>
		</div>
	</div>

	<div class="copyright">
		<div class="wrap copyright-inner">
			<span class="copyright-brand">© <?php echo esc_html( date( 'Y' ) ); ?> Giáo Hội Phật Giáo Việt Nam <i></i> Bảo lưu mọi quyền.</span>
			<span class="blessing"><?php echo daihoi_icon( 'lotus', 16 ); ?> Nam mô Bổn Sư Thích Ca Mâu Ni Phật</span>
		</div>
	</div>
	<div class="footer-flag" aria-hidden="true"></div>
</footer>
<a class="to-top" href="#top" aria-label="Về đầu trang"><?php echo daihoi_icon( 'arrow-up', 20 ); ?></a>
<?php wp_footer(); ?>
</body>
</html>
