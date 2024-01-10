<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="image/x-icon"/>

<link href="<?php bloginfo('template_url'); ?>/images/favicon.png" rel="apple-touch-icon" sizes="76x76" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 

<script>
	var AJAX_URL='<?php echo admin_url('admin-ajax.php'); ?>';
</script>	

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!--wrapper -->
<section id="wrapper">

	<?php if(get_field('hide_the_nav')) { } else { ?>
    <!--header part-->
    <header id="header-part" class="animatedParent animateOnce">
        <div class="container d-flex a-center space-between">
        
            <div class="logobg">
                <a href="<?php echo get_option('home'); ?>/" class="logo"><img src="<?php the_field('logo','option'); ?>" alt=""></a>
            </div>
        	
            <div class="navmenu d-flex">
            
            	<a href="javascript:void(0)" class="menu-toggle menu_trigger"><span></span> Menu</a>
            
            	<nav id="menu"><a href="#" class="clsoebtn">x</a><?php wp_nav_menu(array('theme_location'=>'primary-menu')) ?></nav>
            
                <div class="searchform">
                
                	<a href="#" class="mobilesearch"></a>
                    
                    <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
                    </form>
                
                </div>
        
        	</div>
                        
        </div>
    </header>
    <!--header part-->
    <?php } ?>