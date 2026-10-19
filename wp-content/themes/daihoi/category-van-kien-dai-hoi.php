<?php get_header();
$total = (int) $wp_query->found_posts;
?>
<div class="page-head page-head-cat">
	<div class="wrap">
		<nav class="crumbs" aria-label="Đường dẫn"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a><span aria-hidden="true">/</span><span>Văn kiện Đại hội</span></nav>
		<p class="label">Đại hội đại biểu Phật giáo toàn quốc lần thứ X</p>
		<h1>Văn kiện Đại hội</h1>
		<?php if ( $total ) : ?><p class="page-sub"><?php echo (int) $total; ?> văn kiện · mới nhất ở trên cùng</p><?php endif; ?>
	</div>
</div>
<div class="wrap doc-wrap">
	<?php if ( have_posts() ) : ?>
		<ol class="doc-list">
			<?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/doc-item' ); endwhile; ?>
		</ol>
		<?php the_posts_pagination( array( 'prev_text' => daihoi_icon( 'arrow-left', 18 ), 'next_text' => daihoi_icon( 'arrow-right', 18 ), 'screen_reader_text' => 'Phân trang' ) ); ?>
	<?php else : ?>
		<p class="empty">Văn kiện Đại hội sẽ được cập nhật tại đây.</p>
	<?php endif; ?>
	<p class="doc-back"><a class="text-link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo daihoi_icon( 'arrow-left', 18 ); ?> Về trang chủ</a></p>
</div>
<?php get_footer();
