<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<!-- content part-->
<section id="content-part">
	
    <!--searchresult-bar-->
    <article class="searchresult-bar">
    	<div class="container">
        
        	<h2><?php _e('Search Results'); ?> for: <strong>"<?php echo esc_html( get_search_query( false ) ); ?>"</strong></h2>
        	
            <div class="blogpost">
            
                <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                <div class="search-item" id="post-<?php the_ID(); ?>">            
            
                    <h3 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
    				<div class="entry">
            
                        <p><?php echo get_the_excerpt(); ?></p>
            
                    </div>
    
                </div>
                <?php endwhile; ?>
    
                <?php if(function_exists('wp_paginate')) {
					wp_paginate();
				} ?>
    
                <?php else : ?>
    
                <h2 class="center"><?php _e('Not Found', 'kubrick'); ?></h2>
            
                <p class="center"><?php _e('Sorry, but you are looking for something that isn&#8217;t here.', 'kubrick'); ?></p>
            
                <?php get_search_form(); ?>
            
                <?php endif; ?>
            
            </div>
        
        </div>    	
    </article>
    <!--searchresult-bar-->

</section>
<!-- content part--> 

<?php get_footer(); ?>