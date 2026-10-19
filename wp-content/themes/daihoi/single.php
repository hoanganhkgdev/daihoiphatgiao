<?php get_header(); while ( have_posts() ) : the_post(); ?>
<div class="page-head"><div class="wrap">
	<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
	<h1><?php the_title(); ?></h1>
</div></div>
<div class="wrap section"><article class="entry">
	<?php if ( has_post_thumbnail() ) the_post_thumbnail( 'large', array( 'class' => 'entry-cover' ) ); ?>
	<?php the_content(); ?>
	<?php the_post_navigation(); ?>
</article></div>
<?php endwhile; get_footer();
