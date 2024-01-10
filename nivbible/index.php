<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
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
            	
                <h1><strong>Blog</strong></h1>
                
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