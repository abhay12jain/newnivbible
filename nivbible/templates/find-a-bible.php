<?php
/**
 * The template for displaying for Posts
 *
 * Template Name: Find A Bible Template
 * 
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */

get_header(); ?>

<!-- content part-->
<section id="content-part">

	<?php if(get_field('slider_code')) { ?>
	<!--mainbanner bar-->
    <article class="mainbanner-bar resheight" <?php /*?>style="background-image: url(<?php the_post_thumbnail_url(); ?>);"<?php */?>>
    	<div class="container">
        
        	<?php echo get_field('slider_code'); ?>
        
        </div>
    </article>
    <!--mainbanner bar-->
    <?php } else if(get_field('banner_image'))  {  ?>
    <!--mainbanner bar-->
    <article class="mainbanner-bar resheight" style="background-image: url(<?php echo get_field('banner_image'); ?>);">
    	<div class="container">
        
        </div>
    </article>
    <!--mainbanner bar-->
    <?php } else { ?>
    <!--mainbanner bar-->
    <article class="mainbanner-bar resheight" style="background-image: url(<?php echo get_field('default_banner_image','option'); ?>);">
    	<div class="container">
        
        </div>
    </article>
    <!--mainbanner bar-->
    <?php } ?>
	
    <!--introblog bar-->
    <article class="introblog-bar fourcol findabible">
    	<div class="container1">
        
        	<div class="container">
            	
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile; endif; ?>
            
            </div>
            
            <div class="featured-posts d-flex">
            
				<?php if( have_rows('bible_list') ): ?>
                <?php while( have_rows('bible_list') ): the_row(); ?>
                        <div class="blog-item">
                            <figure>
                                <?php 
								$link = get_sub_field('button');
								if( $link ): 
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
								$image = get_sub_field('image');
								$size = 'full'; // (thumbnail, medium, large, full or custom size)
								if( $image ) { ?>
									<a href="<?php echo esc_url( $link_url ); ?>" target="_blank"><?php echo wp_get_attachment_image( $image, $size ); ?></a>
								<?php } ?>
                                <?php endif; ?>
                            </figure>
                            
                            <div class="infos">
                                
                                <h4><?php the_sub_field('title'); ?></h4>
                                
                                <p><?php the_sub_field('intro'); ?></p>
                                
                                <?php 
								$link = get_sub_field('button');
								if( $link ): 
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
									?>
									<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="_blank"><?php echo esc_html( $link_title ); ?></a>
								<?php endif; ?>
                                
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            
            </div>
            
        </div>
    </article>
    <!--introblog bar-->
    
</section>
<!-- content part--> 

<?php get_footer(); ?>