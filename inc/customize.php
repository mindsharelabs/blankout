<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link  http://codex.wordpress.org/Theme_Customization_API
 * @since Blankout 1.0
 */
class Blankout_Customize {
	/**
	 * This hooks into 'customize_register' (available as of WP 3.4) and allows
	 * you to add new sections and controls to the Theme Customize screen.
	 *
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 * javascript. See live_preview() for more.
	 *
	 * @see   add_action('customize_register',$func)
	 *
	 * @param \WP_Customize_Manager $wp_customize
	 *
	 * @link  http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since Blankout 1.0
	 */
	public static function register($wp_customize) {

		//1. Define a new section (if desired) to the Theme Customizer
		$wp_customize->add_section('blankout_options',
			array(
				 'title'       => __('Blankout Options', 'blankout'), //Visible title of section
				 'priority'    => 1, //Determines what order this appears in
				 'description' => __('Allows you to customize some example settings for Blankout.', 'blankout'), //Descriptive tooltip
			)
		);

		//2. Register new settings to the WP database...
		$wp_customize->add_setting('link_textcolor',
			array(
				 'default'   => '#428BCA', //Default setting/value to save
				 'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);
		$wp_customize->add_setting('navbar_background',
			array(
				 'default'   => '#EEE', //Default setting/value to save
				 'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		$wp_customize->add_setting('menu_title', //Give it a SERIALIZED name (so all theme settings can live under one db record)
			array(
				 'default'    => 'true', //Default setting/value to save
				 'capability' => 'edit_theme_options' //Optional. Special permissions for accessing this setting.
			)
		);

		//3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		$wp_customize->add_control(new WP_Customize_Color_Control( //Instantiate the color control class
			$wp_customize, //Pass the $wp_customize object (required)
			'blankout_link_textcolor', //Set a unique ID for the control
			array(
				 'label'    => __('Body Link Color', 'blankout'), //Admin-visible name of the control
				 'section'  => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				 'settings' => 'link_textcolor', //Which setting to load and manipulate (serialized is okay)
				 'priority' => 11, //Determines the order this control appears in for the specified section
			)
		));

		$wp_customize->add_control(new WP_Customize_Color_Control(
			$wp_customize,
			'blankout_navbar_background', //Set a unique ID for the control
			array(
				 'label'    => __('Navbar Background', 'blankout'), //Admin-visible name of the control
				 'section'  => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				 'settings' => 'navbar_background', //Which setting to load and manipulate (serialized is okay)
				 'priority' => 10, //Determines the order this control appears in for the specified section
			)
		));

		$wp_customize->add_control('show_menu_title', array(
														   'settings' => 'menu_title',
														   'label'    => __('Show title in nav bar'),
														   'section'  => 'blankout_options',
														   'type'     => 'checkbox',
													  ));

		//4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
		$wp_customize->get_setting('blogname')->transport = 'postMessage';
		$wp_customize->get_setting('blogdescription')->transport = 'postMessage';
		$wp_customize->get_setting('menu_title')->transport = 'refresh';
		$wp_customize->get_setting('navbar_background')->transport = 'postMessage';
		$wp_customize->get_setting('background_color')->transport = 'postMessage';
	}

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * Used by hook: 'wp_head'
	 *
	 * @see   add_action('wp_head',$func)
	 * @since Blankout 1.0
	 */
	public static function header_output() {
		?>
		<!--Customizer CSS-->
		<style type="text/css">
			<?php if('blankout_options[menu_title]' == TRUE) { ?>
			<?php self::generate_css('.navbar-brand', 'display', 'block'); ?>
			<?php } else { ?>
			<?php self::generate_css('.navbar-brand', 'display', 'none'); ?>
			<?php } ?>
			<?php self::generate_css('body', 'background-color', 'background_color'); ?>
			<?php self::generate_css('a', 'color', 'link_textcolor'); ?>
			<?php self::generate_css('.navbar', 'background-color', 'navbar_background'); ?>
		</style>
		<!--/Customizer CSS-->
	<?php
	}

	/**
	 * This outputs the javascript needed to automate the live settings preview.
	 * Also keep in mind that this function isn't necessary unless your settings
	 * are using 'transport'=>'postMessage' instead of the default 'transport'
	 * => 'refresh'
	 *
	 * Used by hook: 'customize_preview_init'
	 *
	 * @see   add_action('customize_preview_init',$func)
	 * @since Blankout 1.0
	 */
	public static function live_preview() {
		wp_enqueue_script(
			'blankout-themecustomizer', //Give the script an ID
			get_template_directory_uri().'/js/theme-customizer.js',
			array('jquery', 'customize-preview'), //Define dependencies
			'', //Define a version (optional)
			TRUE //Specify whether to put in footer (leave this true)
		);
	}

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @uses  get_theme_mod()
	 *
	 * @param string $selector CSS selector
	 * @param string $style    The name of the CSS *property* to modify
	 * @param string $mod_name The name of the 'theme_mod' option to fetch
	 * @param string $prefix   Optional. Anything that needs to be output before the CSS property
	 * @param string $postfix  Optional. Anything that needs to be output after the CSS property
	 * @param bool   $echo     Optional. Whether to print directly to the page (default: true).
	 *
	 * @return string Returns a single line of CSS with selectors and a property.
	 * @since Blankout 1.0
	 */
	public static function generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = TRUE) {
		$return = '';
		$mod = get_theme_mod($mod_name);
		if(!empty($mod)) {
			$return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix.$mod.$postfix
			);
			if($echo) {
				echo $return;
			}
		}
		return $return;
	}
}

//Setup the Theme Customizer settings and controls...
add_action('customize_register', array('Blankout_Customize', 'register'));

//Output custom CSS to live site
add_action('wp_head', array('Blankout_Customize', 'header_output'));

//Enqueue live preview javascript in Theme Customizer admin screen
add_action('customize_preview_init', array('Blankout_Customize', 'live_preview'));
