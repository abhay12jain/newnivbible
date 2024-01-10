<?php
/**
 * The template for displaying for Posts
 *
 * Template Name: FAQs Template
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
    
    <!--faqs bar-->
    <article class="faqs-bar">
    	<div class="container">
                
        	<div class="title animatedParent animateOnce">
            	
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile; endif; ?>
                
            </div>
			
            <?php if( have_rows('faqs_list_intro') ): ?>
			<div class="faqintros faqslist">
                
				<?php while( have_rows('faqs_list_intro') ): the_row(); ?>
                <div class="faqbg">
                
                	<h4><?php the_sub_field('question'); ?></h4>
                    
                    <div class="details">
                    	
                        <?php the_sub_field('answer'); ?>
                    
                    </div>
                    
                </div>
                <?php endwhile; ?>

            </div>
            <?php endif; ?>
                    
        </div>
        <?php if( have_rows('faqs_content') ): ?>
        <div class="faqsbox">
        <?php while( have_rows('faqs_content') ): the_row(); ?>
        <div class="faqitem" style="background-color: <?php the_sub_field('bg_color'); ?>;">
            <div class="container">            
            	
                <h3><?php the_sub_field('faqs_heading'); ?></h3>
                
                <?php while( have_rows('inner_faqs') ): the_row(); ?>
                <div class="faqbg">
                
                    <h4><?php the_sub_field('question'); ?></h4>
                    
                    <div class="details">
                        
                        <?php the_sub_field('answer'); ?>
                    
                    </div>
                    
                </div>
                <?php endwhile; ?>
            
        	</div>
        </div>
        <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </article>
    <!--faqs bar-->
        
</section>
<!-- content part--> 

<?php get_footer(); ?>