<?php

/***** Register Widgets *****/

function register_mh_widgets() {
	register_widget('mh_affiliate_widget');
	register_widget('mh_custom_posts_widget');
	register_widget('mh_facebook_widget');
	register_widget('mh_slider_hp_widget');
}
add_action('widgets_init', 'register_mh_widgets');

/***** Affiliate Widget *****/

class mh_affiliate_widget extends WP_Widget {
    function mh_affiliate_widget() {
        $widget_ops = array('classname' => 'mh_affiliate', 'description' => __('MH Affiliate Widget to earn money by promoting WordPress themes by MH Themes.', 'mh-magazine-lite'));
        $this->WP_Widget('mh_affiliate', __('MH Affiliate Widget', 'mh-magazine-lite'), $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $mh_username = empty($instance['mh_username']) ? 'MHthemes' : $instance['mh_username'];
        $mh_ads = isset($instance['mh_ads']) ? $instance['mh_ads'] : '300x250';

        echo $before_widget;

        if (!empty($title)) { echo $before_title . $title . $after_title; } ?>
       	<a href="https://creativemarket.com/MHthemes/?u=<?php echo esc_attr($mh_username); ?>" target="_blank" title="Premium Magazine WordPress Themes by MH Themes" rel="nofollow"><img src="<?php echo get_template_directory_uri() . '/images/ads/mh_magazine_' . $mh_ads . '.png' ?>" alt="MH Magazine WordPress Theme" /></a> <?php

        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['mh_username'] = sanitize_text_field($new_instance['mh_username']);
        $instance['mh_ads'] = strip_tags($new_instance['mh_ads']);
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => 'WordPress Magazine Theme', 'mh_username' => '', 'mh_ads' => '300x250');
        $instance = wp_parse_args((array) $instance, $defaults); ?>

        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'mh-magazine-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <p>
	    	<label for="<?php echo $this->get_field_id('mh_username'); ?>">Creative Market Username:</label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['mh_username']); ?>" name="<?php echo $this->get_field_name('mh_username'); ?>" id="<?php echo $this->get_field_id('mh_username'); ?>" />
	    </p>
        <p>
	    	<label for="<?php echo $this->get_field_id('mh_ads'); ?>"><?php _e('Banner size:', 'mh-magazine-lite'); ?></label>
			<select id="<?php echo $this->get_field_id('mh_ads'); ?>" name="<?php echo $this->get_field_name('mh_ads'); ?>" type="text">
				<option value="125x125" <?php if ($instance['mh_ads'] == "125x125") { echo "selected='selected'"; } ?>>125x125</option>
				<option value="250x250" <?php if ($instance['mh_ads'] == "250x250") { echo "selected='selected'"; } ?>>250x250</option>
				<option value="300x250" <?php if ($instance['mh_ads'] == "300x250") { echo "selected='selected'"; } ?>>300x250</option>
				<option value="468x60" <?php if ($instance['mh_ads'] == "468x60") { echo "selected='selected'"; } ?>>468x60</option>
				<option value="728x90" <?php if ($instance['mh_ads'] == "728x90") { echo "selected='selected'"; } ?>>728x90</option>
			</select>
        </p>
        <p><?php echo __('With this widget you can earn money by promoting WordPress themes by MH Themes. If you do not have a Creative Market Username yet, please visit our', 'mh-magazine-lite') . ' <a href="http://www.mhthemes.com/affiliates/" target="_blank">' . __('infopage for affiliates', 'mh-magazine-lite'). '</a>'; ?>.</p> <?php
    }
}

/***** Custom Posts Widget (Lite) *****/

class mh_custom_posts_widget extends WP_Widget {
    function mh_custom_posts_widget() {
        $widget_ops = array('classname' => 'mh_custom_posts', 'description' => __('Custom Posts Widget to display posts based on categories or tags.', 'mh-magazine-lite'));
        $this->WP_Widget('mh_custom_posts', __('MH Custom Posts (Lite)', 'mh-magazine-lite'), $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $category = isset($instance['category']) ? $instance['category'] : '';
        $tags = empty($instance['tags']) ? '' : $instance['tags'];
        $postcount = empty($instance['postcount']) ? '5' : $instance['postcount'];
        $offset = empty($instance['offset']) ? '' : $instance['offset'];
        $sticky = isset($instance['sticky']) ? $instance['sticky'] : 0;

        if ($category) {
        	$cat_url = get_category_link($category);
	        $before_title = $before_title . '<a href="' . esc_url($cat_url) . '" class="widget-title-link">';
	        $after_title = '</a>' . $after_title;
        }

        echo $before_widget;
        if (!empty( $title)) { echo $before_title . esc_attr($title) . $after_title; } ?>
        <ul class="cp-widget clearfix"> <?php
		$args = array('posts_per_page' => $postcount, 'offset' => $offset, 'cat' => $category, 'tag' => $tags, 'ignore_sticky_posts' => $sticky);
		$counter = 1;
		$widget_loop = new WP_Query($args);
		while ($widget_loop->have_posts()) : $widget_loop->the_post(); ?>
			<li class="cp-wrap cp-small clearfix">
				<div class="cp-thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php if (has_post_thumbnail()) { the_post_thumbnail('cp_small'); } else { echo '<img src="' . get_template_directory_uri() . '/images/noimage-cp_small.png' . '" alt="No Picture" />'; } ?></a></div>
				<div class="cp-data">
					<p class="cp-widget-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
					<p class="meta"><?php $post_date = get_the_date(); echo $post_date; echo ' // '; comments_number(__('0 Comments', 'mh-magazine-lite'), __('1 Comment', 'mh-magazine-lite'), __('% Comments', 'mh-magazine-lite')); ?></p>
				</div>
			</li><?php
		endwhile;
		wp_reset_postdata(); ?>
        </ul><?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['category'] = absint($new_instance['category']);
        $instance['postcount'] = absint($new_instance['postcount']);
        $instance['offset'] = absint($new_instance['offset']);
        $instance['tags'] = sanitize_text_field($new_instance['tags']);
        $instance['sticky'] = isset($new_instance['sticky']) ? strip_tags($new_instance['sticky']) : '';
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => '', 'category' => '', 'tags' => '', 'postcount' => '5', 'offset' => '0', 'sticky' => 0);
        $instance = wp_parse_args((array) $instance, $defaults); ?>

        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'mh-magazine-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select a Category:', 'mh-magazine-lite'); ?></label>
			<select id="<?php echo $this->get_field_id('category'); ?>" class="widefat" name="<?php echo $this->get_field_name('category'); ?>">
				<option value="0" <?php if (!$instance['category']) echo 'selected="selected"'; ?>><?php _e('All', 'mh-magazine-lite'); ?></option>
				<?php
				$categories = get_categories(array('type' => 'post'));
				foreach($categories as $cat) {
					echo '<option value="' . $cat->cat_ID . '"';
					if ($cat->cat_ID == $instance['category']) { echo ' selected="selected"'; }
					echo '>' . $cat->cat_name . ' (' . $cat->category_count . ')';
					echo '</option>';
				}
				?>
			</select>
		</p>
		<p>
        	<label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Filter Posts by Tags (e.g. lifestyle):', 'mh-magazine-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['tags']); ?>" name="<?php echo $this->get_field_name('tags'); ?>" id="<?php echo $this->get_field_id('tags'); ?>" />
	    </p>
        <p>
        	<label for="<?php echo $this->get_field_id('postcount'); ?>"><?php _e('Show:', 'mh-magazine-lite'); ?></label>
			<input type="text" size="2" value="<?php echo esc_attr($instance['postcount']); ?>" name="<?php echo $this->get_field_name('postcount'); ?>" id="<?php echo $this->get_field_id('postcount'); ?>" /> <?php _e('Posts', 'mh-magazine-lite'); ?>
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e('Skip:', 'mh-magazine-lite'); ?></label>
			<input type="text" size="2" value="<?php echo esc_attr($instance['offset']); ?>" name="<?php echo $this->get_field_name('offset'); ?>" id="<?php echo $this->get_field_id('offset'); ?>" /> <?php _e('Posts', 'mh-magazine-lite'); ?>
	    </p>
        <p>
      		<input id="<?php echo $this->get_field_id('sticky'); ?>" name="<?php echo $this->get_field_name('sticky'); ?>" type="checkbox" value="1" <?php checked('1', $instance['sticky']); ?>/>
	  		<label for="<?php echo $this->get_field_id('sticky'); ?>"><?php _e('Ignore Sticky Posts', 'mh-magazine-lite'); ?></label>
    	</p>
    	<p>
    		<strong>Info:</strong> <?php _e('This is the Lite Version of this widget with only basic features. If you need more features and options, you can upgrade to the premium version of this theme.', 'mh-magazine-lite'); ?>
    	</p><?php
    }
}

/***** Facebook Likebox Widget *****/

class mh_facebook_widget extends WP_Widget {
    function mh_facebook_widget() {
        $widget_ops = array('classname' => 'mh_facebook', 'description' => __('Widget to display a Facebook likebox in your sidebar.', 'mh-magazine-lite'));
        $this->WP_Widget('mh_facebook', __('MH Facebook Likebox', 'mh-magazine-lite'), $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $facebook_url = isset($instance['facebook_url']) ? $instance['facebook_url'] : 'https://www.facebook.com/MHthemes';
        $width = isset($instance['width']) ? $instance['width'] : '300';
        $height = isset($instance['height']) ? $instance['height'] : '240';
        $faces = !isset($instance['faces']) || $instance['faces'] == 1 ? 'true' : 'false';
        $stream = isset($instance['stream']) && $instance['stream'] == 1 ? 'true' : 'false';
        $header = isset($instance['header']) && $instance['header'] == 1 ? 'true' : 'false';
        $border = isset($instance['border']) && $instance['border'] == 1 ? 'true' : 'false';

        echo $before_widget;
        if (!empty( $title)) { echo $before_title . $title . $after_title; }
        if ($facebook_url) {
			echo '<div class="fb-like-box" data-href="' . esc_url($facebook_url) . '" data-width="' . esc_attr($width) . '" data-height="' . esc_attr($height) . '" data-show-faces="' . esc_attr($faces) . '" data-show-border="' . esc_attr($border) . '" data-stream="' . esc_attr($stream) . '" data-header="' . esc_attr($header) . '"></div>'. "\n";
		}
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['facebook_url'] = esc_url_raw($new_instance['facebook_url']);
        $instance['width'] = absint($new_instance['width']);
        $instance['height'] = absint($new_instance['height']);
        $instance['faces'] = isset($new_instance['faces']) ? strip_tags($new_instance['faces']) : '';
        $instance['stream'] = isset($new_instance['stream']) ? strip_tags($new_instance['stream']) : '';
        $instance['header'] = isset($new_instance['header']) ? strip_tags($new_instance['header']) : '';
        $instance['border'] = isset($new_instance['border']) ? strip_tags($new_instance['border']) : '';
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => __('Connect with us on Facebook', 'mh-magazine-lite'), 'facebook_url' => 'https://www.facebook.com/MHthemes', 'width' => '300', 'height' => '240', 'faces' => true, 'stream' => false, 'header' => false, 'border' => false);
        $instance = wp_parse_args((array) $instance, $defaults); ?>

        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'mh-magazine-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <p>
	   		<label for="<?php echo $this->get_field_id('facebook_url'); ?>"><?php _e('Facebook Page URL:', 'mh-magazine-lite'); ?></label>
	   		<input class="widefat" type="text" value="<?php echo esc_url($instance['facebook_url']); ?>" name="<?php echo $this->get_field_name('facebook_url'); ?>" id="<?php echo $this->get_field_id('facebook_url'); ?>" />
	    </p>
        <p>
	    	<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:', 'mh-magazine-lite'); ?></label>
			<input type="text" size="2" value="<?php echo esc_attr($instance['width']); ?>" name="<?php echo $this->get_field_name('width'); ?>" id="<?php echo $this->get_field_id('width'); ?>" /> px
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:', 'mh-magazine-lite'); ?></label>
			<input type="text" size="2" value="<?php echo esc_attr($instance['height']); ?>" name="<?php echo $this->get_field_name('height'); ?>" id="<?php echo $this->get_field_id('height'); ?>" /> px
	    </p>
	    <p>
      		<input id="<?php echo $this->get_field_id('faces'); ?>" name="<?php echo $this->get_field_name('faces'); ?>" type="checkbox" value="1" <?php checked('1', $instance['faces']); ?>/>
	  		<label for="<?php echo $this->get_field_id('faces'); ?>"><?php _e('Show Faces', 'mh-magazine-lite'); ?></label>
    	</p>
    	<p>
      		<input id="<?php echo $this->get_field_id('stream'); ?>" name="<?php echo $this->get_field_name('stream'); ?>" type="checkbox" value="1" <?php checked('1', $instance['stream']); ?>/>
	  		<label for="<?php echo $this->get_field_id('stream'); ?>"><?php _e('Show Stream', 'mh-magazine-lite'); ?></label>
    	</p>
    	<p>
      		<input id="<?php echo $this->get_field_id('header'); ?>" name="<?php echo $this->get_field_name('header'); ?>" type="checkbox" value="1" <?php checked('1', $instance['header']); ?>/>
	  		<label for="<?php echo $this->get_field_id('header'); ?>"><?php _e('Show Header', 'mh-magazine-lite'); ?></label>
    	</p>
	    <p>
      		<input id="<?php echo $this->get_field_id('border'); ?>" name="<?php echo $this->get_field_name('border'); ?>" type="checkbox" value="1" <?php checked('1', $instance['border']); ?>/>
	  		<label for="<?php echo $this->get_field_id('border'); ?>"><?php _e('Show Border', 'mh-magazine-lite'); ?></label>
    	</p><?php
    }
}

/***** Slider Widget (Lite) *****/

class mh_slider_hp_widget extends WP_Widget {
    function mh_slider_hp_widget() {
        $widget_ops = array('classname' => 'mh_slider_hp', 'description' => __('Slider widget for use on homepage template.', 'mh-magazine-lite'));
        $this->WP_Widget('mh_slider_hp', __('MH Slider Widget (Lite)', 'mh-magazine-lite'), $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $category = isset($instance['category']) ? $instance['category'] : '';
        $tags = empty($instance['tags']) ? '' : $instance['tags'];
        $postcount = empty($instance['postcount']) ? '5' : $instance['postcount'];
        $offset = empty($instance['offset']) ? '' : $instance['offset'];
        $sticky = isset($instance['sticky']) ? $instance['sticky'] : 0;

        echo $before_widget; ?>
        <section id="slider" class="flexslider">
			<ul class="slides"><?php
			$args = array('posts_per_page' => $postcount, 'cat' => $category, 'tag' => $tags, 'offset' => $offset, 'ignore_sticky_posts' => $sticky);
			$slider = new WP_query($args);
			while ($slider->have_posts()) : $slider->the_post(); ?>
				<li>
				<article class="slide-wrap">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php
						if (has_post_thumbnail()) {
							the_post_thumbnail('content');
						} else {
							echo '<img src="' . get_template_directory_uri() . '/images/noimage_620x264.png' . '" alt="No Picture" />';
						} ?>
					</a>
					<div class="slide-caption">
						<div class="slide-data">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h2 class="slide-title"><?php the_title(); ?></h2></a>
						</div>
					</div>
				</article>
				</li><?php
			endwhile; wp_reset_postdata(); ?>
			</ul>
		</section><?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['category'] = absint($new_instance['category']);
        $instance['tags'] = sanitize_text_field($new_instance['tags']);
        $instance['postcount'] = absint($new_instance['postcount']);
        $instance['offset'] = absint($new_instance['offset']);
        $instance['sticky'] = isset($new_instance['sticky']) ? strip_tags($new_instance['sticky']) : '';
        return $instance;
    }
    function form($instance) {
        $defaults = array('category' => '', 'tags' => '', 'postcount' => '5', 'offset' => '0', 'sticky' => 0);
        $instance = wp_parse_args((array) $instance, $defaults); ?>

	    <p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select a Category:', 'mh-magazine-lite'); ?></label>
			<select id="<?php echo $this->get_field_id('category'); ?>" class="widefat" name="<?php echo $this->get_field_name('category'); ?>">
				<option value="0" <?php if (!$instance['category']) echo 'selected="selected"'; ?>><?php _e('All', 'mh-magazine-lite'); ?></option>
				<?php
				$categories = get_categories(array('type' => 'post'));
				foreach($categories as $cat) {
					echo '<option value="' . $cat->cat_ID . '"';
					if ($cat->cat_ID == $instance['category']) { echo ' selected="selected"'; }
					echo '>' . $cat->cat_name . ' (' . $cat->category_count . ')';
					echo '</option>';
				}
				?>
			</select>
		</p>
		<p>
        	<label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Filter Posts by Tags (e.g. lifestyle):', 'mh-magazine-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['tags']); ?>" name="<?php echo $this->get_field_name('tags'); ?>" id="<?php echo $this->get_field_id('tags'); ?>" />
	    </p>
		<p>
        	<label for="<?php echo $this->get_field_id('postcount'); ?>"><?php _e('Show:', 'mh-magazine-lite'); ?></label>
			<input type="text" size="2" value="<?php echo esc_attr($instance['postcount']); ?>" name="<?php echo $this->get_field_name('postcount'); ?>" id="<?php echo $this->get_field_id('postcount'); ?>" /> <?php _e('Posts', 'mh-magazine-lite'); ?>
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e('Skip:', 'mh-magazine-lite'); ?></label>
			<input type="text" size="2" value="<?php echo esc_attr($instance['offset']); ?>" name="<?php echo $this->get_field_name('offset'); ?>" id="<?php echo $this->get_field_id('offset'); ?>" /> <?php _e('Posts', 'mh-magazine-lite'); ?>
	    </p>
        <p>
      		<input id="<?php echo $this->get_field_id('sticky'); ?>" name="<?php echo $this->get_field_name('sticky'); ?>" type="checkbox" value="1" <?php checked('1', $instance['sticky']); ?>/>
	  		<label for="<?php echo $this->get_field_id('sticky'); ?>"><?php _e('Ignore Sticky Posts', 'mh-magazine-lite'); ?></label>
    	</p>
    	<p>
    		<strong>Info:</strong> <?php _e('This is the Lite Version of this widget with only basic features. If you need more features and options, you can upgrade to the premium version of this theme.', 'mh-magazine-lite'); ?>
    	</p><?php
    }
}

?>