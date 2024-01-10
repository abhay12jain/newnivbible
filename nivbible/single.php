<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
get_header(); ?>

<!-- content part-->
<section id="content-part">
	
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <!--postdetails bar-->
    <article class="postdetails-bar">
    <div class="firstbg"></div>
        <div class="container animatedParent animateOnce">
			
            <figure class="mainimg"><?php the_post_thumbnail('full'); ?></figure>
            
			<div class="page-title animated fadeInUpShort">
            	
                <h1 class=""><?php the_title(); ?></h1>
                
            </div>
            
            <div class="entry animated fadeInUpShort delay-250">
				
				<div class="contents">
                	<?php the_content(); ?>
				</div>
                				
            </div>
            
            <div class="featured-product">
            
                <?php
				$featured_posts = get_field('select_product');
				if( $featured_posts ): ?>
					<?php foreach( $featured_posts as $post ):                     
                        // Setup this post for WP functions (variable must be named $post).
                        setup_postdata($post); ?>
                        <div class="product-box d-flex">
							<?php $link_button = get_field('link_button')?>
                            <figure>
                                <a href="<?php echo $link_button['url'] ?>" target="<?php echo $link_button['target'] ?>"><?php the_post_thumbnail('full'); ?></a>
                            </figure>
                            
                            <div class="infos">
                                
                                <h4><?php the_title(); ?></h4>
                                
                                <?php the_content(); ?>
                                
                                <a href="<?php echo $link_button['url'] ?>" target="<?php echo $link_button['target'] ?>" class="button">Learn More</a>
                                
                            </div>
                        </div>
                    <?php endforeach; ?>
					<?php 
					// Reset the global post object so that the rest of the page works correctly.
					wp_reset_postdata(); ?>
				<?php endif; ?>
            
            </div>
            
            <?php if(get_field('author_bio')) { ?>
            <div class="authordetails d-flex">
            
            	<figure>
                	<?php 
						$image = get_field('author_image');
						$size = 'full'; // (thumbnail, medium, large, full or custom size)
						if( $image ) {
						echo wp_get_attachment_image( $image, $size );
						} ?>
                </figure>
            
            	<div class="authorbio">
                	
                    <?php the_field('author_bio'); ?>
                
                </div>
            	
            </div>
            <?php } ?>
            
            <div class="navigation d-flex a-center j-center">
            	
                <span class="nav-previous"><?php previous_post_link( '%link', __( '< Previous Article', 'twentyeleven' ) ); ?></span>
                
                <span class="nav-next"><?php next_post_link( '%link', __( 'Next Article >', 'twentyeleven' ) ); ?></span>
            
            </div>
                    
        </div>
    </article>
    <!--postdetails bar-->
    
    <div class="comment-box">
    	<div class="comment-mid">
        	
            <?php comments_template(); ?>
        
        </div>
    </div>
    
   <?php endwhile; endif; ?>
   
   	<!--bloglist bar-->
    <article class="bloglist-bar">
    	<div class="container1">
        
        	<?php /*?><div class="socialsharebuttons d-flex a-center j-center">
            	
                <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>
            
            </div><?php */?>
            
            <div class="popularposts">
            
            	<div class="titlebg"><h3>Related Articles</h3></div>
                
                <?php /*?><div class="newslist d-flex">
						<?php
$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 4, 'post__not_in' => array($post->ID) ) );
if( $related ) foreach( $related as $post ) {
setup_postdata($post); ?>
                           <div class="news-itemlist">
                    	
                            <figure>
                                <a href="<?php the_permalink(); ?>" class="openlink">
                                    <?php the_post_thumbnail('full'); ?>
                                </a>
                            </figure>
                            
                            <div class="infos">
                                
                                <h3><?php the_title(); ?></h3>
                                
                                <a href="<?php the_permalink(); ?>" class="textlink">Read Article</a>
                                
                            </div>
                            
                        </div>
                        <?php }
wp_reset_postdata(); ?>
                </div><?php */?>
                
                <div class="newslist d-flex">
						<?php
$featured_posts = get_field('related_aricles');
if( $featured_posts ): ?>
<?php foreach( $featured_posts as $post ): 

        // Setup this post for WP functions (variable must be named $post).
        setup_postdata($post); ?>
                           <div class="news-itemlist">
                    	
                            <figure>
                                <a href="<?php the_permalink(); ?>" class="openlink">
                                    <?php the_post_thumbnail('full'); ?>
                                </a>
                            </figure>
                            
                            <div class="infos">
                                
                                <h3><?php the_title(); ?></h3>
                                
                                <a href="<?php the_permalink(); ?>" class="textlink">Read Article</a>
                                
                            </div>
                            
                        </div>
                        <?php endforeach; ?>
                        <?php 
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>
<?php endif; ?>
                </div>
            
            </div>
                    
        </div>
    </article>
    <!--bloglist bar-->
    
    <!--signupblog bar-->
    <div class="animatedParent animateOnce">
        <article class="signupblog-bar news animated fadeInUpShort delay-250">
            <div class="container">
                
                <div class="intro">
                	<?php the_field('signup_intro',151); ?>
                </div>
                
                <div class="formimg d-flex">
                
                	<div class="formbg">
                	
                        <form method="post" action="https://profile.harpercollinschristian.com/engage/link.harpercollinschristian.com/s/NIV+Bible+Blog" id="1623080665697">
                        <div class="fieldbg"><label for="email">Email:</label><input type="text" name="email"></div>
                        <div data-sitekey="6LeiGPglAAAAAIdNCPEckCqf59vul5kCLQ__MJ_U" class="g-recaptcha"></div><input type="submit" value="Subscribe" class="button">
                        <input type="hidden" name="vars[OptOutCheck]" value="Check" data-type="string">
                        <input type="hidden" name="vars[CASL_Source_Code]" value="BB0095" data-type="string">
                        <input type="hidden" name="vars[casl_bb0095]" value="date" data-type="string">
                        <input type="hidden" name="vars[niv_interest]" value="Yes" data-type="string">
                        <input type="hidden" name="redirect" value=https://www.thenivbible.com/thankyou-blog/>
                        <input type="hidden" name="recaptcha_key" value="6LeiGPglAAAAAIdNCPEckCqf59vul5kCLQ__MJ_U"></form>
                        <script src="https://www.google.com/recaptcha/api.js" defer="defer" async="async"></script>
    
                        <p class="smalltext">By submitting your email address, you understand that you will receive email communications from HarperCollins Christian Publishing (501 Nelson Place, Nashville, TN 37214 USA) providing information about products and services of HCCP and its affiliates. You may unsubscribe from these email communications at any time. If you have any questions, please review our <a href="http://www.harpercollinschristian.com/privacy/?webSyncID=493f2cde-3ce7-4005-99fc-d47e9b340618&amp;sessionGUID=bb8df190-b9e6-491d-9d5b-2964e3ce0e14" target="_blank" rel="noopener noreferrer">Privacy Policy</a> or email us at <a href="mailto:yourprivacy@harpercollins.com" target="_blank" rel="noopener noreferrer">yourprivacy@harpercollins.com</a>.</p>
                        
                    </div>  
                    
                    <div class="imgright">
                    
                    	<?php 
						$image = get_field('signup_image',151);
						$size = 'full'; // (thumbnail, medium, large, full or custom size)
						if( $image ) {
						echo wp_get_attachment_image( $image, $size );
						} ?>
                    
                    </div>  
                
                </div>
    
            </div>
        </article>
    </div>
	<!--signupblog bar-->
   
</section>
<!-- content part-->
<script>
//window.addEventListener('popstate',detecthistory);
//function detecthistory(){
   // alert('#');
//}

</script>
<?php get_footer(); ?>