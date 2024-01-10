<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>	
    <!--footer -->
    <div id="footer-part" class="animatedParent animateOnce">
		<div class="container animated fadeIn">
        	
            <div class="footer-top d-flex">
            
                <div class="column1">
                
                    <figure><a href="<?php echo get_option('home'); ?>/" class="logo"><img src="<?php the_field('footer_logo','option'); ?>" alt=""></a></figure>
                    
                    <h4><?php the_field('social_share_heading','option'); ?></h4>
                    
                    <?php if(have_rows('social_icons','option')) :?>
                    <ul class="social d-flex">
                    <?php while(have_rows('social_icons','option')) : the_row();
                        $link = get_sub_field('link');
                         $link_icon = get_sub_field('icon');
                    ?>
                        <li>
                            <a href="<?php echo $link; ?>" target="_blank"><?php echo $link_icon; ?></a>
                        </li>                            
                    <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>
                
                </div>
                
                <div class="column2 menucol">
        			
                    <?php wp_nav_menu(array('theme_location'=>'footer-menu1')) ?>            
                
                </div>
                
                <div class="column2 menucol">
        			
                    <?php wp_nav_menu(array('theme_location'=>'footer-menu2')) ?>            
                
                </div>
                
                <div class="column2 menucol">
        			
                    <?php wp_nav_menu(array('theme_location'=>'footer-menu3')) ?>            
                
                </div>
                
            </div>
                    
        	<div class="footer-bottom">
            
            	<?php the_field('copyright_content','option'); ?>
            	
            </div>
                            
        </div>
		<a href="#wrapper" class="backtotop inlink">Back to Top</a>
    </div>
    <!--footer -->
    
</section>
<!--wrapper -->
    
<?php wp_footer(); ?>
        
</body>
</html>
