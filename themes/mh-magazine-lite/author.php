<?php get_header(); ?>
<div class="mh-wrapper clearfix">
	<section class="mh-content <?php mh_content_class(); ?>">
		<?php mh_before_page_content(); ?>
		<?php mh_author_box(); ?>
		<?php mh_loop_content(); ?>
	</section>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>