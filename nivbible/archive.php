<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

<!-- content part-->
<section id="content-part">

	<!--banner bar-->
    <?php if(has_post_thumbnail()) {  ?>
    <article class="banner-bar innerhero download" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
    <?php } else { ?>
    <article class="banner-bar innerhero download" style="background-image: url(<?php the_field('default_banner_image','option'); ?>);">
    <?php } ?>
        <div class="container">
        	
            <div class="text">
            	
                <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				<?php /* If this is a category archive */ if (is_category()) { ?>
                <h1><?php printf(__('%s', 'kubrick'), single_cat_title('', false)); ?></h1>
                <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                <h1><?php printf(__('Posts Tagged &#8216;%s&#8217;', 'kubrick'), single_tag_title('', false) ); ?></h1>
                <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                <h1><?php printf(_c('Archive for %s|Daily archive page', 'kubrick'), get_the_time(__('F jS, Y', 'kubrick'))); ?></h1>
                <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                <h1><?php printf(_c('Archive for %s|Monthly archive page', 'kubrick'), get_the_time(__('F, Y', 'kubrick'))); ?></h1>
                <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                <h1><?php printf(_c('Archive for %s|Yearly archive page', 'kubrick'), get_the_time(__('Y', 'kubrick'))); ?></h1>
                <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                <h1><?php _e('Author Archive', 'kubrick'); ?></h1>
                <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                <h1><?php _e('Blog Archives', 'kubrick'); ?></h1>
                <?php } ?>
                
            </div>            
                
        </div>    
    </article>
    <!--banner bar-->

	<!--news-bar-->
    <article class="news-bar">
    	<div class="container">
        	
            <div class="rightside"><?php get_sidebar(); ?></div>
            
            <div class="blogpost">
            
                <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">            
            
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('post-thumb'); ?></a>
                    
                    <h3 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
    
                    <small><strong>Posted on</strong> <?php the_time(__('F j, Y')) ?></small>
    
                    <div class="entry">
            
                        <p><?php echo get_the_excerpt(); ?>... <a href="<?php the_permalink() ?>">read more</a></p>
            
                    </div>
    
                </div>
                <?php endwhile; ?>
    
                <?php wp_pagenavi(); ?>
    
                <?php else : ?>
    
                <h2 class="center"><?php _e('Not Found', 'kubrick'); ?></h2>
            
                <p class="center"><?php _e('Sorry, but you are looking for something that isn&#8217;t here.', 'kubrick'); ?></p>
            
                <?php get_search_form(); ?>
            
                <?php endif; ?>
            
            </div>
        
        </div>    	
    </article>
    <!--news-bar-->
    
</section>
<!-- content part--> 

<?php get_footer(); ?>