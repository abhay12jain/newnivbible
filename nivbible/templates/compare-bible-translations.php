<?php
/**
 * The template for displaying for Posts
 *
 * Template Name: Compare Bible Template
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
    <article class="mainbanner-bar compare resheight" <?php /*?>style="background-image: url(<?php the_post_thumbnail_url(); ?>);"<?php */?>>
        
		<?php echo get_field('slider_code'); ?>
        
    </article>
    <!--mainbanner bar-->
    <?php } else if(get_field('banner_image'))  {  ?>
    <!--mainbanner bar-->
    <article class="mainbanner-bar compare resheight" style="background-image: url(<?php echo get_field('banner_image'); ?>);">
    	<div class="container">
        	
            <?php the_field('intro_content'); ?>
            
        </div>
    </article>
    <!--mainbanner bar-->
    <?php } else { ?>
    <!--mainbanner bar-->
    <article class="mainbanner-bar compare resheight" style="background-image: url(<?php echo get_field('default_banner_image','option'); ?>);">
    	<div class="container">
        	
            <?php the_field('intro_content'); ?>
        
        </div>
    </article>
    <!--mainbanner bar-->
    <?php } ?>
	
    <!--comparison bar-->
    <article class="comparison-bar">
    	<div class="container">
                
        	<div class="selcetdropdown">
            
            	<a href="#" class="selectverse button">Select a Verse</a>
			
				<?php
				$the_query11 = query_posts(
					array(
						'post_type'=>'bible-comparison',
						'posts_per_page'=>-1,
					)
				);
				// The Loop ?>
                <ul>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                
					<?php $postid = get_the_ID(); ?>
                    <li><a href="#" data-id="<?php echo $postid; ?>"><?php the_title(); ?></a></li>
                    <?php endwhile; ?> 
				<?php endif; ?>
                <?php /* Restore original Post Data */
				wp_reset_postdata();
				wp_reset_query();
				?>
				</ul>
                
			</div>
            
            <div class="featured-result">
            
            	<div id="oldresult">
                	
                    <?php $mainpostid = get_field('featured_post'); 
					//echo $mainpostid; ?>
                    <?php
					$the_query11 = query_posts(
						array(
							'post_type'=>'bible-comparison',
							'p'=>$mainpostid,
						)
					);
					// The Loop ?>
					<?php if (have_posts()) : while (have_posts()) : the_post(); 
					$postid = get_the_ID();
					?>
					<div class="restulbox">                    
                    
                    	<h2><?php the_title(); ?></h2>
                        
                        <div class="contentbg d-flex">
                        	
                            <div class="block">
                            	
                                <h3>NIV</h3>
                                
                                <div class="details">
                                	
                                    <?php the_field('niv_intro'); ?>
                                
                                </div>
                                
                                <div class="mobielcontent">
                                
                                	<h3>NIrV</h3>
                                    <div class="details">
                                        
                                        <?php the_field('nirv_intro'); ?>
                                    
                                    </div>
                                
                                </div>
                                
                                <div class="blockmid d-flex">
                                
                                	<div class="column">
                                    
                                    	<h4>NLT</h4>
                                        
                                        <div class="textmid"><?php the_field('nlt_content'); ?></div>
                                    
                                    </div>
                                    
                                    <div class="column">
                                    
                                    	<h4>CSB</h4>
                                        
                                        <div class="textmid"><?php the_field('csb_content'); ?></div>
                                    
                                    </div>
                                    
                                    <div class="column">
                                    
                                    	<h4>ESV</h4>
                                        
                                        <div class="textmid"><?php the_field('esv_content'); ?></div>
                                    
                                    </div>
                                    
                                </div>
                            
                            </div>
                            
                            <div class="block">
                            	
                                <div class="nomobilecontent">
                                
                                	<h3>NIrV</h3>
                                
                                    <div class="details">
                                        
                                        <?php the_field('nirv_intro'); ?>
                                    
                                    </div>
                                
                                </div>
                                
                                <div class="blockmid d-flex">
                                
                                	<div class="column">
                                    
                                    	<h4>NASB 1995</h4>
                                        
                                        <div class="textmid"><?php the_field('nasb_1998_content'); ?></div>
                                    
                                    </div>
                                    
                                    <div class="column">
                                    
                                    	<h4>NKJV</h4>
                                        
                                        <div class="textmid"><?php the_field('nkjv_content'); ?></div>
                                    
                                    </div>
                                    
                                    <div class="column">
                                    
                                    	<h4>KJV</h4>
                                        
                                        <div class="textmid"><?php the_field('kjv_content'); ?></div>
                                    
                                    </div>
                                    
                                </div>
                            
                            </div>
                        
                        </div>
                        
                    </div>
					<?php endwhile; endif; ?>
					<?php /* Restore original Post Data */
					wp_reset_postdata();
					wp_reset_query();
	
					?>
                    
                
                </div>
                
                <div id="newresult"></div>
            
            </div>
            
            <div class="buttons-box">
            	
                <?php 
				$link = get_field('download_button');
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<div class="buttonbg"><a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
				<?php endif; ?>
                
                <?php 
				$link = get_field('search_bible_button');
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<div class="buttonbg"><a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
				<?php endif; ?>
                
            </div>
            
            <div class="feed-loader-wrap"></div>
                    
        </div>
    </article>
    <!--comparison bar-->
    
    <!--text bar-->
    <article class="text-bar">
    	<div class="container">
            
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
            <?php endwhile; endif; ?>

    	</div>
    </article>
    <!--text bar-->
        
</section>
<!-- content part--> 

<?php get_footer(); ?>