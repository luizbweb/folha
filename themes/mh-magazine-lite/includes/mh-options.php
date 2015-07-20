<?php

function mh_magazine_lite_customize_register($wp_customize) {

	/***** Register Custom Controls *****/

	class MH_Customize_Header_Control extends WP_Customize_Control {
        public function render_content() { ?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span> <?php
        }
    }

	class MH_Customize_Text_Control extends WP_Customize_Control {
        public function render_content() { ?>
			<span class="textfield"><?php echo esc_html($this->label); ?></span> <?php
        }
    }

    class MH_Customize_Button_Control extends WP_Customize_Control {
        public function render_content() {  ?>
			<p>
				<a href="http://www.mhthemes.com/themes/mh/magazine/" target="_blank" class="button button-secondary"><?php echo esc_html($this->label); ?></a>
			</p> <?php
        }
    }

    /***** Add Panels *****/

	$wp_customize->add_panel('mh_theme_options', array('title' => __('Theme Options', 'mh-magazine-lite'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1,));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_general', array('title' => __('General Options', 'mh-magazine-lite'), 'priority' => 1, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_layout', array('title' => __('Layout Options', 'mh-magazine-lite'), 'priority' => 2, 'panel' => 'mh_theme_options'));
    $wp_customize->add_section('mh_upgrade', array('title' => __('Upgrade to Premium', 'mh-magazine-lite'), 'priority' => 5, 'panel' => 'mh_theme_options'));

    /***** Add Settings *****/

    $wp_customize->add_setting('mh_options[excerpt_length]', array('default' => '125', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_integer'));
    $wp_customize->add_setting('mh_options[excerpt_more]', array('default' => '[...]', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_text'));

    $wp_customize->add_setting('mh_options[sb_position]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_options[author_box]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_checkbox'));
    $wp_customize->add_setting('mh_options[comments_pages]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_checkbox'));
    $wp_customize->add_setting('mh_options[post_nav]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_checkbox'));

	$wp_customize->add_setting('mh_options[premium_version_label]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));
	$wp_customize->add_setting('mh_options[premium_version_text]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));
	$wp_customize->add_setting('mh_options[premium_version_button]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));

    $wp_customize->add_setting('mh_options[full_bg]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_checkbox'));

    /***** Add Controls *****/

    $wp_customize->add_control('excerpt_length', array('label' => __('Custom excerpt length in characters', 'mh-magazine-lite'), 'section' => 'mh_general', 'settings' => 'mh_options[excerpt_length]', 'priority' => 1, 'type' => 'text'));
    $wp_customize->add_control('excerpt_more', array('label' => __('Custom excerpt more text', 'mh-magazine-lite'), 'section' => 'mh_general', 'settings' => 'mh_options[excerpt_more]', 'priority' => 2, 'type' => 'text'));

    $wp_customize->add_control('sb_position', array('label' => __('Position of default sidebar', 'mh-magazine-lite'), 'section' => 'mh_layout', 'settings' => 'mh_options[sb_position]', 'priority' => 1, 'type' => 'select', 'choices' => array('left' => __('Left', 'mh-magazine-lite'), 'right' => __('Right', 'mh-magazine-lite'))));
    $wp_customize->add_control('author_box', array('label' => __('Disable author box on posts/archives', 'mh-magazine-lite'), 'section' => 'mh_layout', 'settings' => 'mh_options[author_box]', 'priority' => 2, 'type' => 'checkbox'));
    $wp_customize->add_control('comments_pages', array('label' => __('Enable comments on pages', 'mh-magazine-lite'), 'section' => 'mh_layout', 'settings' => 'mh_options[comments_pages]', 'priority' => 3, 'type' => 'checkbox'));
    $wp_customize->add_control('post_nav', array('label' => __('Enable post / attachment navigation', 'mh-magazine-lite'), 'section' => 'mh_layout', 'settings' => 'mh_options[post_nav]', 'priority' => 4, 'type' => 'checkbox'));

	$wp_customize->add_control(new MH_Customize_Header_Control($wp_customize, 'premium_version_label', array('label' => __('Do you need more Features?', 'mh-magazine-lite'), 'section' => 'mh_upgrade', 'settings' => 'mh_options[premium_version_label]', 'priority' => 1)));
	$wp_customize->add_control(new MH_Customize_Text_Control($wp_customize, 'premium_version_text', array('label' => __('If you would like to have more awesome features, additional custom widgets and useful options to customize your website, you can upgrade to the premium version of this WordPress theme.', 'mh-magazine-lite'), 'section' => 'mh_upgrade', 'settings' => 'mh_options[premium_version_text]', 'priority' => 2)));
	$wp_customize->add_control(new MH_Customize_Button_Control($wp_customize, 'premium_version_button', array('label' => __('Click here to learn more', 'mh-magazine-lite'), 'section' => 'mh_upgrade', 'settings' => 'mh_options[premium_version_button]', 'priority' => 3)));

	$wp_customize->add_control('full_bg', array('label' => __('Scale background image to full size', 'mh-magazine-lite'), 'section' => 'background_image', 'settings' => 'mh_options[full_bg]', 'priority' => 99, 'type' => 'checkbox'));
}
add_action('customize_register', 'mh_magazine_lite_customize_register');

/***** Data Sanitization *****/

function mh_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_sanitize_integer($input) {
    return strip_tags($input);
}
function mh_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_sanitize_select($input) {
    $valid = array(
        'left' => __('Left', 'mh-magazine-lite'),
        'right' => __('Right', 'mh-magazine-lite')
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_magazine_lite_theme_options')) {
	function mh_magazine_lite_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_options', array()),
			mh_magazine_lite_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('mh_magazine_lite_default_options')) {
	function mh_magazine_lite_default_options() {
		$default_options = array(
			'full_bg' => '',
			'excerpt_length' => '125',
			'excerpt_more' => '[...]',
			'sb_position' => 'right',
			'author_box' => '',
			'comments_pages' => '',
			'post_nav' => '',
			'premium_version_label' => '',
			'premium_version_text' => '',
			'premium_version_button' => ''
		);
		return $default_options;
	}
}

?>