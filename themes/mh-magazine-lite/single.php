<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="mh-wrapper clearfix">
	<div class="mh-content <?php mh_content_class(); ?>"><?php
		mh_before_post_content();
		if (is_attachment()) {
			get_template_part('content', 'attachment');
		} else {
			get_template_part('content', get_post_format());
		}
		mh_after_post_content();
		endwhile;
		comments_template();
		endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>