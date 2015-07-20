<?php $mh_magazine_lite_options = mh_magazine_lite_theme_options(); ?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="mh-wrapper clearfix">
    <div class="mh-content <?php mh_content_class(); ?>">
    	<?php mh_before_page_content(); ?>
        <div <?php post_class(); ?>>
	        <div class="entry clearfix">
	        	<?php dynamic_sidebar('pages-1'); ?>
		        <?php the_content(); ?>
		    </div>
		</div>
		<?php dynamic_sidebar('pages-2'); ?>
		<?php endwhile; ?>
			<?php if (isset($mh_magazine_lite_options['comments_pages']) ? $mh_magazine_lite_options['comments_pages'] : false) : ?>
				<section>
        			<?php comments_template(); ?>
				</section>
			<?php endif; ?>
        <?php endif; ?>
    </div>
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>