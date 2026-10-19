<?php get_header(); while ( have_posts() ) : the_post(); ?>
<div class="page-head"><div class="wrap"><h1><?php the_title(); ?></h1></div></div>
<div class="wrap section"><article class="entry"><?php the_content(); ?></article></div>
<?php endwhile; get_footer();
