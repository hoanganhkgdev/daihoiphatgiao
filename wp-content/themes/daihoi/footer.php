</main>
<footer class="site-footer">
	<div class="footer-cta">
		<div class="wrap footer-cta-inner">
			<div>
				<p class="eyebrow">Đại hội đại biểu Phật giáo toàn quốc lần thứ X</p>
				<p class="footer-cta-title">Kỷ cương – Đổi mới – Hiệu lực – Hiệu quả</p>
			</div>
			<a class="btn btn-primary" href="<?php echo esc_url( home_url( '/#tin-tuc' ) ); ?>">Xem tin tức Đại hội</a>
		</div>
	</div>

	<div class="wrap footer-grid">
		<div class="footer-about">
			<a class="footer-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( get_theme_file_uri( 'assets/logo.png' ) ); ?>" alt="Giáo Hội Phật Giáo Việt Nam" width="64" height="64" loading="lazy">
				<span><strong><?php bloginfo( 'name' ); ?></strong><small><?php bloginfo( 'description' ); ?></small></span>
			</a>
			<p>Trang thông tin Đại hội đại biểu Phật giáo toàn quốc lần thứ X, nhiệm kỳ 2026 – 2031.</p>
		</div>

		<div>
			<h3 class="footer-title">Thông tin Đại hội</h3>
			<ul class="footer-info">
				<li><span class="fi"><?php echo daihoi_icon( 'calendar', 20 ); ?></span><div><b>Thời gian:</b> Ngày 05 – 07/11/2026</div></li>
				<li><span class="fi"><?php echo daihoi_icon( 'pin', 20 ); ?></span><div><b>Địa điểm:</b> Học viện Phật giáo Việt Nam, TP. Hồ Chí Minh</div></li>
			</ul>
		</div>
	</div>

	<div class="copyright">
		<div class="wrap copyright-inner">
			<span>© <?php echo esc_html( date( 'Y' ) ); ?> Giáo Hội Phật Giáo Việt Nam.</span>
			<span class="blessing"><?php echo daihoi_icon( 'lotus', 16 ); ?> Nam mô Bổn Sư Thích Ca Mâu Ni Phật</span>
		</div>
	</div>
</footer>
<a class="to-top" href="#top" aria-label="Về đầu trang"><?php echo daihoi_icon( 'arrow-up', 20 ); ?></a>
<?php wp_footer(); ?>
</body>
</html>
