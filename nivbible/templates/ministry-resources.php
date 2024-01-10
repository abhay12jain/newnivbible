<?php
/**
 * The template for displaying for Posts
 *
 * Template Name: Ministry Resources Template
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
        
        	<h1><?php the_title(); ?></h1>
        
        </div>
    </article>
    <!--mainbanner bar-->
    <?php } else { ?>
    <!--mainbanner bar-->
    <article class="mainbanner-bar resheight" style="background-image: url(<?php echo get_field('default_banner_image','option'); ?>);">
    	<div class="container">
        
        	<h1><?php the_title(); ?></h1>
        
        </div>
    </article>
    <!--mainbanner bar-->
    <?php } ?>
	
    <!--introblog bar-->
    <article class="introblog-bar">
    	<div class="container1">
        
        	<?php if(get_field('article_titles')) { ?>
            <div class="container">
        		<h2><?php the_field('article_titles'); ?></h2>
            </div>
            <?php } ?>
            
            <div class="featured-posts d-flex">
            
				<?php
                $featured_posts = get_field('select_blog_posts');
                if( $featured_posts ): ?>
                    <?php foreach( $featured_posts as $post ):                     
                        // Setup this post for WP functions (variable must be named $post).
                        setup_postdata($post); ?>
                        <div class="blog-item">
                            <figure>
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
                            </figure>
                            
                            <div class="infos">
                                
                                <h4><?php the_title(); ?></h4>
                                
                                <a href="<?php the_permalink(); ?>" class="textlink">Read Article</a>
                                
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php 
                    // Reset the global post object so that the rest of the page works correctly.
                    wp_reset_postdata(); ?>
                <?php endif; ?>
            
            </div>
            
            <?php 
			$link = get_field('blog_button');
			if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
				?>
				<div class="buttonbg"><a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
			<?php endif; ?>
                
        </div>
    </article>
    <!--introblog bar-->
    
    <!--introblog bar-->
    <article class="introblog-bar fourcol">
    	<div class="container1">
        
        	<?php if(get_field('ministry_bible_heading')) { ?>
        	<div class="container"><h2><?php the_field('ministry_bible_heading'); ?></h2></div>
            <?php } ?>
            
            <div class="featured-posts d-flex">
            
				<?php if( have_rows('ministry_bible_list') ): ?>
                <?php while( have_rows('ministry_bible_list') ): the_row(); ?>
                        <div class="blog-item">
                            <figure>
                            	 <?php 
								$link = get_sub_field('link');
								if( $link ): 
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
									?>
									<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
								
                                <?php 
								$image = get_sub_field('image');
								$size = 'full'; // (thumbnail, medium, large, full or custom size)
								if( $image ) {
									echo wp_get_attachment_image( $image, $size );
								} ?>
                                
                                </a>
                                
                                <?php else: ?>
                                
                                <?php 
								$image = get_sub_field('image');
								$size = 'full'; // (thumbnail, medium, large, full or custom size)
								if( $image ) {
									echo wp_get_attachment_image( $image, $size );
								} ?>
                                
                                <?php endif; ?>
                            </figure>
                            
                            <div class="infos">
                                
                                <h4><?php the_sub_field('title'); ?></h4>
                                
                                <p><?php the_sub_field('content'); ?> 
                                <?php 
								$link = get_sub_field('link');
								if( $link ): 
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
									?>
									<a class="textlink" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
								<?php endif; ?>
                                </p>
                                
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            
            </div>
            
        </div>
    </article>
    <!--introblog bar-->
    
    <!--introblog bar-->
    <article class="introblog-bar threecol">
    	<div class="container">
        
        	<?php if(get_field('study_resources_intro')) { ?>
        	<div class="intro"><?php the_field('study_resources_intro'); ?></div>
            <?php } ?>
            
        </div>    
        <div class="featured-posts d-flex">
        
            <?php if( have_rows('study_resources_list') ): ?>
            <?php while( have_rows('study_resources_list') ): the_row(); ?>
                    <div class="blog-item">
                        <figure>
                        	
                             <?php 
								$link = get_sub_field('link');
								if( $link ): 
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
									?>
									<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
								
                        
                            <?php 
                            $image = get_sub_field('image');
                            $size = 'full'; // (thumbnail, medium, large, full or custom size)
                            if( $image ) {
                                echo wp_get_attachment_image( $image, $size );
                            } ?>
                            
                            </a>
                            
                            <?php else: ?>
                            <?php 
                            $image = get_sub_field('image');
                            $size = 'full'; // (thumbnail, medium, large, full or custom size)
                            if( $image ) {
                                echo wp_get_attachment_image( $image, $size );
                            } ?>
                            <?php endif; ?>
                        </figure>
                        
                        <div class="infos">
                            
                            <h4><?php the_sub_field('title'); ?></h4>
                            
                            <?php 
								$link = get_sub_field('link');
								if( $link ): 
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
									?>
									<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
								<?php endif; ?>
                            
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        
        </div>
        
        <?php 
        $link = get_field('study_resources_button');
        if( $link ): 
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <div class="buttonbg"><a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
        <?php endif; ?>
            
    </article>
    <!--introblog bar-->
    
    <?php
			$hero = get_field('cta_block');
			if( $hero ): ?>
    <!--encourage bar-->
    <article class="encourage-bar" style="background-image: url(<?php echo esc_attr( $hero['cta_bg'] ); ?>);">
    	<div class="container d-flex j-end">
        	
            <div class="innercontent">
            
                <figure>
                    <?php 
                    $image = $hero['cta_icon'];
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    if( $image ) {
                    echo wp_get_attachment_image( $image, $size );
                    } ?>
                </figure>
                        
				<h3><?php echo esc_attr( $hero['cta_block_heading'] ); ?></h3>
            
				<?php 
                $buttonlist = $hero['cta_links'];
                if($buttonlist): 
                //print_r($buttonlist);
                ?>
                <ul>
                    <?php foreach($buttonlist as $buttons) { ?>
                    <li>
                        <?php 
                        $link = $buttons['button_link'];
                        if( $link ): 
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php endif; ?>
                    </li>
                    <?php } ?>
                </ul>
                <?php endif; ?>
            
        	</div>
            
        </div>
    </article>
    <!--encourage bar-->
    <?php endif; ?>
    
    <?php
	$imgcontent = get_field('image_content_block');
	if( $imgcontent ): ?>
    <!--imgcontent bar-->
    <article class="imgcontent-bar">
    	<div class="container d-flex">
        	
            <figure>
				<?php 
                $image = $imgcontent['block_image'];
                $size = 'full'; // (thumbnail, medium, large, full or custom size)
                if( $image ) {
                echo wp_get_attachment_image( $image, $size );
                } ?>
            </figure>
            
            <div class="text">
                        
				<?php echo $imgcontent['block_content']; ?>
                
                <?php 
				$link = $imgcontent['block_button'];
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
                
            </div>    
            
        </div>
    </article>
    <!--imgcontent bar-->
    <?php endif; ?>
    
</section>
<!-- content part--> 

<?php get_footer(); ?>