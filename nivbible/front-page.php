<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 
get_header(); ?>

<!--content part-->
<section id="content-part">
	
	<!--banner bar-->
	<article class="banner-bar animatedParent animateOnce">
    	
        <?php if(get_field('slider_code')) { ?>
        <div class="sliderbg">
        
        	<?php echo get_field('slider_code'); ?>
        
        </div>
        <?php } else { ?>
    
    	<?php 
			$bannerslider = get_field('banner_images');
			$randumimg = array_rand($bannerslider);
			//print_r($bannerslider);
			$image = $bannerslider[$randumimg]['banner_image'];
			$size = 'full';
			if( $image ) {
				echo '<figure class="bg">'.wp_get_attachment_image( $image, $size ).'</figure>';
			}
			//print_r($randumimg);
			//echo ;
		?>
		<div class="container">
			
            <div class="text">
                <h1><?php the_field('banner_text') ?></h1>
            </div>
            
            <div class="logotext">
            	
                <?php 
				$image = get_field('banner_logo');
				$size = 'full';
				if( $image ) {
					echo wp_get_attachment_image( $image, $size );
				} ?>
                
                <p><?php the_field('banner_logo_text') ?></p>
            
            </div>
            
		</div>
        <?php } ?>
        
	</article>
	<!--banner bar-->
    
    <!--intro bar-->
	<article class="intro-bar">
		<div class="container">
			
            <div class="text">
            
            	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile; endif; ?>
            
            </div>
            
            <?php if( have_rows('intro_buttons') ): ?>
            <ul class="buttonlist d-flex a-center j-center">
            	<?php while( have_rows('intro_buttons') ): the_row(); ?>
                <li>
					<?php 
                    $link = get_sub_field('button');
                    if( $link ): 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </li>
            	<?php endwhile; ?>
            </ul>
        	<?php endif; ?>

		</div>
	</article>
	<!--intro bar-->
	
	<!--findabible bar-->
	<article class="findabible-bar animatedParent animateOnce" style="background-image: url(<?php the_field('left_image'); ?>);">
		<div class="container d-flex a-center j-end animated fadeInUpShort delay-250">
			
            <div class="text">
            
            	<figure>
                	<?php 
						$image = get_field('find_icon');
						$size = 'full';
						if( $image ) {
							echo wp_get_attachment_image( $image, $size );
						}
					?>                	
                </figure>
                
                <?php the_field('find_a_bible_content'); ?>
            	
				<?php 
                $link = get_field('find_a_bible_link');
                if( $link ): 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <div class="buttonbg"><a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
                <?php endif; ?>
			
            </div>
            
		</div>
	</article>
	<!--findabible bar-->
	
	<!--latestblog bar-->
	<article class="latestblog-bar work animatedParent animateOnce">
		<div class="container1 animated fadeInUpShort delay-250">
			
			<div class="intro">
				
				<?php the_field('blog_intro') ?>
		
			</div>
			
			<div class="latestposts d-flex">
			
            	<div class="postleft">
                
					<?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 1,
						'cat' => 3,
                      );
                    $the_query = new WP_Query($args);
                    $count = $the_query->post_count;
    
                    // The Loop
                    if ( $the_query->have_posts() ) { ?>
                    <?php $i=1; while ( $the_query->have_posts() ) { 
                    $the_query->the_post(); 
                    ?>
                    <div class="post-item">
                    
                    	<figure>
                        	<a href="<?php the_permalink(); ?>" class="openlink"><?php the_post_thumbnail('full'); ?></a>
                            <h3>Devotional</h3>
                        </figure>
                        
                        <div class="text d-flex j-end">
                        	<div class="innertext">
                        
                        		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            
                            	<?php the_excerpt(); ?>
                        
                        	</div>
                        </div>
                        
                    </div>
                    <?php $i++; } ?>
                    <?php } else {
                    // no posts found
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
    
                    ?>
                    
                </div>
                
                <div class="postright">
                
					<?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 1,
						'cat' => 2,
                      );
                    $the_query = new WP_Query($args);
                    $count = $the_query->post_count;
    
                    // The Loop
                    if ( $the_query->have_posts() ) { ?>
                    <?php $i=1; while ( $the_query->have_posts() ) { 
                    $the_query->the_post(); 
                    ?>
                    <div class="post-item">
                    
                    	<figure>
                        	<a href="<?php the_permalink(); ?>" class="openlink"><?php the_post_thumbnail('full'); ?></a>
                            <h3>Deeper Study</h3>
                        </figure>
                        
                        <div class="text d-flex j-start">
                        	<div class="innertext">
                        
                        		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            
                            	<?php the_excerpt(); ?>
                        
                        	</div>
                        </div>
                        
                    </div>
                    <?php $i++; } ?>
                    <?php } else {
                    // no posts found
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
    
                    ?>
                    
                </div>    
			
			</div>
			
			<?php 
			$link = get_field('all_articles_button');
			if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
				?>
				<div class="buttonbg"><a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
			<?php endif; ?>

		</div>
	</article>
	<!--podcast bar-->
	
	<!--resources bar-->
	<article class="resources-bar animatedParent animateOnce">
		<div class="container0 animated fadeInUpShort delay-250">
			
			<div class="page-title">
				
				<h2><?php the_field('resource_heading') ?></h2>
		
			</div>
			
			<?php if( have_rows('resources_list') ): ?>
			<div class="resourceslist d-flex">
			
				<?php while( have_rows('resources_list') ): the_row(); 
				$image = get_sub_field('image');
				?>
				<div class="resource-item">

					<figure><?php echo wp_get_attachment_image( $image, 'full' ); ?></figure>
                    
                    <div class="content">
                    	
                        <div class="textmid">
                        
                    		<h4><?php the_sub_field('title') ?></h4>
                        
                        	<p><?php the_sub_field('content') ?></p>
                        
                        </div>
                        
                        <div class="buttonbg1 d-flex a-center j-center">
                        	
                            <?php 
							$link = get_sub_field('button_1');
							if( $link ): 
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php endif; ?>
                            
                            <?php 
							$link = get_sub_field('button_2');
							if( $link ): 
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php endif; ?>
                        
                        </div>
                    
                    </div>

				</div>
				<?php endwhile; ?>
				
			</div>
			<?php endif; ?>
			
			<?php 
			$link = get_field('free_link');
			if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
				?>
				<div class="buttonbg"><a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
			<?php endif; ?>

		</div>
	</article>
	<!--podcast bar-->
	
</section>
<!--content part-->

<?php get_footer(); ?>