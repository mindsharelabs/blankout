<?php //mapi_mobile_header('class', true, false); ?>
<!DOCTYPE HTML>
<!--[if lt IE 7]>
<html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]>
<html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]>
<html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
	<?php blankout_copyright(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="MobileOptimized" content="320" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php echo esc_html(get_bloginfo('name')); ?> latest updates" />

	<?php if(get_option('default_comment_status') == 'open') : ?>
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php echo esc_html(get_bloginfo('name')); ?> recent comments" />
	<?php endif; ?>

	<?php if(get_option('default_ping_status') == 'open') : ?>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php endif; ?>

	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="all" />
	<?php blankout_enable_nav_hover(); ?>
	<script type="text/javascript">document.cookie = 'resolution=' + Math.max(screen.width, screen.height) + ("devicePixelRatio" in window ? "," + devicePixelRatio : ",1") + '; path=/';</script>
</head>
<body <?php body_class(); ?>>
<a id="top"></a>
<div class="container">
	<header class="header" role="banner">
		<nav class="navbar">
			<div class="container">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse-scrollable">
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
			    </button>
				<?php $options = get_theme_mod('blankout_options'); ?>
				<?php if($options["menu_title"]) {?>
					<a class="navbar-brand" id="logo" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
				<?php } ?>
			    <div class="nav-collapse collapse nav-collapse-scrollable">
					<?php blankout_main_nav(); ?>
			    </div>
			</div>
		</nav>
	</header>
</div>
