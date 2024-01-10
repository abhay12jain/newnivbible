<?php
/**
 * The template for displaying for Posts
 *
 * Template Name: Endorsements Template
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
	
    <!--endorsements bar-->
    <article class="endorsements-bar">
    	<div class="page-title animatedParent animateOnce">
            	
            <h1 class="animated fadeIn">Endorsements</h1>
            
        </div>
        <div class="subpages">
        	
            <?php
			$mainid = get_the_ID();
			$args = array(
				'post_type'      => 'page',
				'posts_per_page' => -1,
				'post_parent'    => 223,
				'order'          => 'ASC',
				'orderby'        => 'menu_order'
			 );
			
			
			$parent = new WP_Query( $args );
			
			if ( $parent->have_posts() ) : ?>
			<ul class="d-flex">
				<?php while ( $parent->have_posts() ) : $parent->the_post(); 
				$currid = get_the_ID();
				?>
					<li class="<?php if($mainid == $currid) { echo "activemenu"; } ?>">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</li>
			
				<?php endwhile; ?>
			</ul>
			<?php endif; wp_reset_postdata(); ?>
        
        </div>
        	
		<?php if( have_rows('endorsements_list') ): ?>
        <div class="endorsments-list">
            
            <?php while( have_rows('endorsements_list') ): the_row(); ?>
            <div class="endorsments-item">
            	<div class="container">
            
					<?php 
                    $videoid = get_sub_field('main_video_id');
                    $image = get_sub_field('main_image');
					$pdffile = get_sub_field('downloadable_pdf');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
					$attachment_image = wp_get_attachment_url($image);
                    if( $image ) {
                        echo '<figure><a href="'.$pdffile.'" target="_blank" download>'.wp_get_attachment_image( $image, $size ).'</a></figure>';
                    } else if($videoid) {  ?>
                    
                    <div class="youtubevid">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $videoid; ?>?si=SMCGjALSn6F6zEV7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <?php } ?>
                    
                    <div class="text">
                    
                    	<h4><?php the_sub_field('title'); ?></h4>
                    
                    	<?php the_sub_field('contents'); ?>
                	</div>
                    
            	</div>
            </div>
            <?php endwhile; ?>

        </div>
        <?php endif; ?>
            
    </article>
    <!--endorsements bar-->
        
</section>
<!-- content part--> 

<?php get_footer(); ?>