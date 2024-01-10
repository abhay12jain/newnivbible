<?php
/**
 * The template for displaying for Posts
 *
 * Template Name: Blog Template
 * 
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */

get_header(); ?>

<!-- content part-->
<section id="content-part">

	<!--bloglist bar-->
    <article class="bloglist-bar">
    	<div class="firstbg"></div>
    	<div class="container1">
        
            <div class="featured-blog">
                
                    <?php
                    $args = array(
                        'post_type' => 'post',
						'post_status' => 'publish',
                        'posts_per_page' => 1,
                      );
                    $the_query = new WP_Query($args);
                    // The Loop
                    if ( $the_query->have_posts() ) { ?>
    
                    <?php $i=1; while ( $the_query->have_posts() ) { 
                    $the_query->the_post(); ?>
                    <div class="news-item d-flex">
                        
                        <span class="subtitle mobilesub">New on the Blog</span>
                        
                        <span class="mobilehead"><?php the_title(); ?></span>
                        
                        <figure>
                            <a href="<?php the_permalink(); ?>" class="openlink">
                                <?php the_post_thumbnail('full'); ?>
                            </a>
                        </figure>
                        
                        <div class="infos">
                        
                        	<span class="subtitle">New on the Blog</span>
                            
                            <h1><?php the_title(); ?></h1>
                            
                            <?php the_excerpt(); ?>
                            
                            <a href="<?php the_permalink(); ?>" class="button">Read Article</a>
                        
                        </div>
                        
                    </div>
                    <!--project slide-->
                        
                    <?php $i++; } ?>
                    <?php } else {
                    // no posts found
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
    
                    ?>
                
                </div>
      	</div>
        <article class="bloglist-section">
            <div class="container0">
            <div class="filterbox">
              <div class="filtermid d-flex a-center">
              
                    <ul class="d-flex be-select">
                        <li><a href="#" data-category="" data-id="">All</a></li>
                        <?php 
							$currlink = get_the_permalink(get_the_ID());
                            $categories = get_categories();
                            foreach($categories as $category) {
                                //print_r($category);
                                
                              // echo '<li><a href="#" data-category="'.$category->slug.'">' . $category->name . '</a></li>';
                              echo '<li><a href="'.$currlink.'#'.$category->slug.'" data-name="'.$category->slug.'"  data-id="'.$category->term_id.'">' . $category->name . '</a></li>';
                }
                        ?>
                    </ul>
                    
                    <div class="searchbar">
                        
                            <form method="post">
                
                            <fieldset>
                               <input type="search" id="searchblog" class="searchfield" placeholder="Search Blog">
                               <?php /*?><input type="submit" value="" class="submit" id="submitbtn"><?php */?>
                                 <span class="searchblog-error"></span>   
                            </fieldset>
                
                
                
                        </form>
                    
                    </div>
            
                </div>
            </div>
        
            <div class="newslist d-flex row">
            
           		<div class="load-more-img"></div>
            
            </div>
        </div>
        </article>
    </article>
    <!--bloglist bar-->
	
    <!--bloglist bar-->
    <article class="bloglist-bar">
    	<div class="container1">
            
            <div class="popularposts">
            
            	<div class="titlebg"><h3><?php the_field('popular_posts_title'); ?></h3></div>
                
                <?php
				$featured_posts = get_field('select_popular_posts');
				if( $featured_posts ): ?>
                <div class="newslist d-flex">
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
                </div>    
				<?php endif; ?>
            
            </div>
                    
        </div>
    </article>
    <!--bloglist bar-->
    
    <!--signupblog bar-->
    <div class="animatedParent animateOnce">
        <article class="signupblog-bar news animated fadeInUpShort delay-250" id="signup">
            <div class="container">
                
                <div class="intro">
                	<?php the_field('signup_intro'); ?>
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
						$image = get_field('signup_image');
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

<script type="text/javascript">
jQuery('#header-part #menu li li.categorylink a').click(function(e) {
    //e.preventDefault();
	var hrefval = jQuery(this).attr('href').split('#');
	var actualval = hrefval[1];
	jQuery('.bloglist-bar .filterbox li a[data-name="'+actualval+'"]').trigger('click');
	//alert(hrefval[1]);
});
jQuery(window).on('load',function(e) {
    var hrefval = window.location.href.split('#');
	var actualval = hrefval[1];
	jQuery('.bloglist-bar .filterbox li a[data-name="'+actualval+'"]').trigger('click');
	
});
</script>
<?php get_footer(); ?>