<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

<!-- content part-->
<section id="content-part">
	
	<!--text bar-->
    <article class="text-bar error404">
    	<div class="container animatedParent animateOnce">
        
            <h1 class=""><span>Page Not Found</span></h1>
        
            <p>The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.</p>
            
            <?php get_search_form(); ?>
            
        </div>
    </article>
    <!--text bar-->
	    
</section>
<!-- content part--> 


<?php get_footer(); ?>