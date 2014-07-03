<?php //mapi_mobile_header('class', true, false); ?>
<!DOCTYPE HTML>
<!--[if lt IE 7]>
<html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]>
<html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]>
<html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]>
<html <?php language_attributes(); ?> class="no-js"><![endif]-->
<head>
	<!--
	oooooooooo.  oooo                        oooo                                  .
	`888'   `Y8b `888                        `888                                .o8
	 888     888  888   .oooo.   ooo. .oo.    888  oooo   .ooooo.  oooo  oooo  .o888oo
	 888oooo888'  888  `P  )88b  `888P"Y88b   888 .8P'   d88' `88b `888  `888    888
	 888    `88b  888   .oP"888   888   888   888888.    888   888  888   888    888
	 888    .88P  888  d8(  888   888   888   888 `88b.  888   888  888   888    888 .
	o888bood8P'  o888o `Y888""8o o888o o888o o888o o888o `Y8bod8P'  `V88V"V8P'   "888"
	//
	// This project is built on the Blankout starter theme, by Mindshare Studios Inc - http://mind.sh/are/ and http://mindsharelabs.com/
	//
	-->
	<meta charset="<?php bloginfo('charset'); ?>" />
	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
	<?php blankout_copyright(); ?>
	<!--[if IE]>
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="HandheldFriendly" content="True" />
	<meta name="MobileOptimized" content="320" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<?php if(function_exists('mapi_get_favicon_url') && mapi_get_favicon_url() != NULL) : ?>
		<link rel="shortcut icon" href="<?php echo mapi_get_favicon_url(); ?>" />
	<?php else : ?>
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.png" />
	<?php endif; ?>
	<link rel="alternate" type="application/rss+xml" href="<?php echo get_feed_link(); ?>" title="<?php echo esc_html(get_bloginfo('name')); ?> latest updates" />

	<?php if(function_exists('mapi_is_true') && mapi_is_true(get_option('default_comment_status'))) : ?>
		<link rel="alternate" type="application/rss+xml" href="<?php echo get_post_comments_feed_link(); ?>" title="<?php echo esc_html(get_bloginfo('name')); ?> recent comments" />
	<?php endif; ?>

	<?php if(function_exists('mapi_is_true') && mapi_is_true(get_option('default_ping_status'))) : ?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php endif; ?>

	<?php wp_head(); ?>
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,700,600,800,300" rel="stylesheet" type="text/css" />
	<?php blankout_enable_nav_hover(); ?>
</head>
<body <?php body_class(); ?>>
<a id="top"></a>

<div class="container">
	<header class="header" role="banner">
		<nav class="navbar navbar-default">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only"><?php _e('Toggle navigation', 'blankout'); ?></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
				<?php if(get_theme_mod('menu_title')) : ?>
					<a class="navbar-brand" id="logo" title="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
				<?php endif; ?>
			</div>
			<div class="collapse navbar-collapse">
				<?php
				if(has_nav_menu('main-nav')) {
					wp_nav_menu(
						array(
							'container'       => ' ',
							'container_class' => 'nav',
							'fallback_cb'     => 'wp_page_menu',
							'menu'            => 'main-nav',
							'menu_class'      => 'nav navbar-nav',
							'theme_location'  => 'main-nav',
							'depth'           => '2',
							'walker'          => new Blankout_Menu_Walker()
						)
					);
				} ?>
			</div>
		</nav>
	</header>
</div>
