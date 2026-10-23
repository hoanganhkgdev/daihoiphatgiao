<?php
get_header();

$category       = get_queried_object();
$category_name  = single_cat_title( '', false );
$category_desc  = category_description();
$total_posts    = (int) $wp_query->found_posts;
$current_page   = max( 1, (int) get_query_var( 'paged' ) );
$child_terms    = get_categories(
	array(
		'parent'     => (int) $category->term_id,
		'hide_empty' => true,
	)
);
$ancestors      = array_reverse( get_ancestors( $category->term_id, 'category' ) );
?>

<header class="category-hero">
	<div class="wrap">
		<nav class="category-crumbs" aria-label="Đường dẫn">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
			<?php foreach ( $ancestors as $ancestor_id ) : $ancestor = get_category( $ancestor_id ); ?>
				<?php echo daihoi_icon( 'arrow-right', 13 ); ?>
				<a href="<?php echo esc_url( get_category_link( $ancestor ) ); ?>"><?php echo esc_html( $ancestor->name ); ?></a>
			<?php endforeach; ?>
			<?php echo daihoi_icon( 'arrow-right', 13 ); ?>
			<span><?php echo esc_html( $category_name ); ?></span>
		</nav>

		<div class="category-hero-grid">
			<div class="category-hero-copy">
				<p class="category-kicker"><i></i>Chuyên mục Đại hội</p>
				<h1><?php echo esc_html( $category_name ); ?></h1>
				<?php if ( $category_desc ) : ?>
					<div class="category-description"><?php echo wp_kses_post( $category_desc ); ?></div>
				<?php else : ?>
					<p class="category-description">Tổng hợp các bài viết, nghiên cứu và thông tin chính thức thuộc chuyên mục <?php echo esc_html( $category_name ); ?>.</p>
				<?php endif; ?>
				<div class="category-meta">
					<span><?php echo daihoi_icon( 'file', 16 ); ?> <?php echo esc_html( number_format_i18n( $total_posts ) ); ?> bài viết</span>
					<span><?php echo daihoi_icon( 'calendar', 16 ); ?> Cập nhật mới nhất</span>
				</div>
			</div>
			<div class="category-hero-stat" aria-label="<?php echo esc_attr( $total_posts ); ?> bài viết">
				<span><?php echo daihoi_icon( 'lotus', 30 ); ?></span>
				<strong><?php echo esc_html( number_format_i18n( $total_posts ) ); ?></strong>
				<small>Bài viết<br>chuyên mục</small>
			</div>
		</div>
	</div>
</header>

<div class="category-main" id="category-content">
	<div class="wrap">
		<?php if ( $child_terms ) : ?>
			<nav class="category-children" aria-label="Chuyên mục con">
				<span>Khám phá chủ đề</span>
				<div>
					<?php foreach ( $child_terms as $child ) : ?>
						<a href="<?php echo esc_url( get_category_link( $child ) ); ?>"><?php echo esc_html( $child->name ); ?><small><?php echo esc_html( number_format_i18n( $child->count ) ); ?></small></a>
					<?php endforeach; ?>
				</div>
			</nav>
		<?php endif; ?>

		<div class="category-section-head">
			<div>
				<p><i></i><?php echo 1 === $current_page ? 'Mới cập nhật' : 'Trang ' . esc_html( $current_page ); ?></p>
				<h2>Danh sách bài viết</h2>
			</div>
			<span><?php echo esc_html( number_format_i18n( $total_posts ) ); ?> nội dung</span>
		</div>

		<?php if ( have_posts() ) : ?>
			<div class="category-grid">
				<?php $card_index = 0; while ( have_posts() ) : the_post(); $card_index++; ?>
					<article <?php post_class( 'category-card' . ( 1 === $card_index && 1 === $current_page ? ' category-card-featured' : '' ) ); ?>>
						<a class="category-card-media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'medium_large' ); ?>
							<?php else : ?>
								<span class="category-card-art">
									<img class="category-card-logo" src="<?php echo esc_url( get_theme_file_uri( 'assets/logo-dai-hoi-x-category-gold.png' ) . '?v=' . filemtime( get_theme_file_path( 'assets/logo-dai-hoi-x-category-gold.png' ) ) ); ?>" alt="" width="1121" height="1033" loading="lazy">
									<small><?php echo esc_html( sprintf( '%02d', ( $current_page - 1 ) * (int) get_query_var( 'posts_per_page' ) + $card_index ) ); ?></small>
								</span>
							<?php endif; ?>
						</a>
						<div class="category-card-body">
							<div class="category-card-meta">
								<span><?php echo esc_html( $category_name ); ?></span>
								<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?></time>
							</div>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28, '…' ) ); ?></p>
							<a class="category-card-more" href="<?php the_permalink(); ?>" aria-label="Đọc bài: <?php the_title_attribute(); ?>">Đọc chi tiết <?php echo daihoi_icon( 'arrow-right', 16 ); ?></a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<?php
			the_posts_pagination(
				array(
					'prev_text'          => daihoi_icon( 'arrow-left', 18 ) . '<span>Trang trước</span>',
					'next_text'          => '<span>Trang sau</span>' . daihoi_icon( 'arrow-right', 18 ),
					'screen_reader_text' => 'Phân trang chuyên mục',
				)
			);
			?>
		<?php else : ?>
			<div class="category-empty">
				<span><?php echo daihoi_icon( 'lotus', 36 ); ?></span>
				<h2>Chưa có bài viết</h2>
				<p>Nội dung thuộc chuyên mục này sẽ sớm được cập nhật.</p>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php get_footer();
