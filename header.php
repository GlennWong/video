<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<title><?php wp_title( '|', true, 'right' ); ?> <?php bloginfo('name'); ?></title>

	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Bootstrap core CSS -->
    <link href="<?php echo get_template_directory_uri();?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri();?>/css/bootstrap-theme.css" rel="stylesheet">

    <!--external css-->
    <link href="<?php echo get_template_directory_uri();?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!--Basic css-->
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri();?>/responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri();?>/js/html5shiv.min.js">
    </script>
    <script src="<?php echo get_template_directory_uri();?>/js/respond.min.js">
    </script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a>
        </div>
        <div class="navbar-form navbar-right visible-lg">
            <?php get_search_form();?>
        </div>
                
            <?php
                wp_nav_menu( array(
                'menu'              => 'main-menu',
                'theme_location'    => 'main-menu',
                'depth'             => 3,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => '',
                'menu_class'        => 'nav navbar-nav navbar-right',
                'fallback_cb'       => 'Glen_Nav_Menu::fallback',
                'walker'            => new Glen_Nav_Menu())
            );?>
    </div>
</nav>