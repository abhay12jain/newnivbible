<?php
/**
 * The template for displaying for Posts
 *
 * Template Name: Free Resources Template
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
	
    <!--freeresources bar-->
    <article class="freeresources-bar">
    	<div class="container">
        
        	<div class="resourceslist">
            
				<?php if( have_rows('free_resources_list') ): ?>
                <?php while( have_rows('free_resources_list') ): the_row(); ?>
                <div class="resource-block <?php the_sub_field('column_size'); ?> border<?php the_sub_field('border_on_bottom'); ?>">
                
                	<?php if(get_sub_field('intro_content')) { ?>
                	<div class="intro">
                    	<?php the_sub_field('intro_content'); ?>
                    </div>
                    <?php } ?>
                
                	<?php if( have_rows('free_resources') ): ?>
                	<div class="resource-bundle d-flex">
						<?php while( have_rows('free_resources') ): the_row(); ?>
                        <div class="resource-item">
                            <figure>
                                <?php 
                                $image = get_sub_field('image');
								$pdflink = get_sub_field('downloadable_file');
								$buttontext = get_sub_field('button_text');
								
                                $size = 'full'; // (thumbnail, medium, large, full or custom size)
                                if( $image ) { ?>
                                	<?php if( $pdflink ) { ?>
                                    <a href="<?php echo $pdflink; ?>" target="_blank"><?php echo wp_get_attachment_image( $image, $size ); ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo wp_get_attachment_image_url( $image, 'full' ); ?>" target="_blank"><?php echo wp_get_attachment_image( $image, $size ); ?></a>
                                    <?php } ?>
                                    
                                <?php } ?>
                            </figure>
                        
                            <div class="infos">
                                
                                <?php if( $pdflink ) { ?>
                                
                                <a href="<?php echo $pdflink; ?>" target="_blank" class="button"><?php if($buttontext) { echo $buttontext; } else { ?>View<?php } ?></a>
                                
                                <?php } else { ?>
                                
                                <a href="<?php echo wp_get_attachment_image_url( $image, 'full' ); ?>"  class="button" target="_blank"><?php if($buttontext) { echo $buttontext; } else { ?>View<?php } ?></a>
                                
                                <?php } ?>
                                
                            </div>
                		</div>
                    	<?php endwhile; ?>
                    </div>    
                	<?php endif; ?>
                    
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            
            </div>
            
        </div>
    </article>
    <!--freeresources bar-->
    
</section>
<!-- content part--> 

<?php get_footer(); ?>