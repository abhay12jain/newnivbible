<?php
/**
 * The template for displaying for Posts
 *
 * Template Name: Team Template
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
	
    <!--teamcontent bar-->
    <article class="teamcontent-bar">
    	<div class="container">
                
        	<div class="intro">
            	
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile; endif; ?>
                
            </div>
			
			<?php if( have_rows('team_members') ): ?>
			<div class="teamlist">
                
				<?php while( have_rows('team_members') ): the_row(); ?>
                <div class="teammember d-flex">
                
                	<figure>
                    	
						<?php 
                        $image = get_sub_field('image');
                        $size = 'full';
                        if( $image ) {
                        echo wp_get_attachment_image( $image, $size );
                        } ?>
                    
                    </figure>
                    
                    <div class="details">
                    	
                        <h4><?php the_sub_field('title'); ?></h4>
                        
                        <h5><?php the_sub_field('subtitles'); ?></h5>
                        
                        <?php the_sub_field('details'); ?>
                    
                    </div>
                    
                </div>
                <?php endwhile; ?>

            </div>
            <?php endif; ?>
                    
        </div>
    </article>
    <!--teamcontent bar-->
        
</section>
<!-- content part--> 

<?php get_footer(); ?>