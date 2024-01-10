<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
get_header(); ?>

<!-- content part-->
<section id="content-part">
	
	<!--text bar-->
    <article class="text-bar">
    	<div class="container">
            
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
            <?php endwhile; endif; ?>

    	</div>
    </article>
    <!--text bar-->
    
    <?php if(get_field('show_compare_block')) { ?>
    <!--comparison bar-->
    <article class="comparison-bar defaultpage">
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
                	
                    <?php $mainpostid = get_field('featured_post',271); 
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
                            	
                                <h3>NIrV</h3>
                                
                                <div class="details">
                                	
                                    <?php the_field('nirv_intro'); ?>
                                
                                </div>
                                
                                <div class="blockmid d-flex">
                                
                                	<div class="column">
                                    
                                    	<h4>NASB 1998</h4>
                                        
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
                    $link = get_field('comparison_button');
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
    <?php } ?>
    
    <?php if(is_page(1525)) { ?>
   <!--searchfield bar-->
    <article class="searchfield-bar">
    	<div class="container">
         <div class="form_section" >
            <form class="bibleSearchForms" action="" method="GET">
<p class="d-flex"><input id="keyword" name="keyword" type="text" placeholder="Enter keyword, passage, or topic:"><input id="qs_version" name="ss_version" type="hidden" value="NVI"><input id="searchsubmit" class="kjv" type="submit" value="Search NVI"></p><div class="powered_by"><a href="https://www.biblegateway.com/" target="_blank" rel="noopener noreferrer">Powered by <strong>Bible Gateway</strong></a></div>
</form>
		</div>	        
        </div>
    </article>
    <!--searchfield bar-->
    
    <!--results bar-->
    <article class="results-bar">
    	<div class="container">
		<div class="load-more-img" style="display:none"></div>
                <div class="search-item"></div>   
            
			        
        </div>
    </article>
    <!--results bar-->
    <?php } ?>
	    
</section>
<!-- content part--> 
<?php if(is_page(1525)) { ?>
<script>
jQuery(function($){
$('.bibleSearchForms').submit(function(e){
e.preventDefault();
var keyword=$('#keyword').val();
var qs_version=$('#qs_version').val();
var loader_html = "<div id='loading'></div>";
$.ajax({
type:'GET',
url:"<?php echo admin_url('admin-ajax.php')?>",
data:{action:'search_api_nirv',keyword:keyword,qs_version:qs_version},
beforeSend: function() {
        jQuery(".load-more-img").html(loader_html).show();
    },
success:function(data){ 
  //alert(data);
$('.search-item').html(data); 
//$('.loader').fadeOut();
$('.search-item').fadeIn();
},
 complete: function() { 
	  jQuery('.load-more-img').hide();
 }
});
 
});
/* End Bible search */
});
</script>
<script>
jQuery('body').on('click', '.bibleref', function() {
	//alert('@@@');
var keyword1=jQuery(this).attr('data-bibleref');
var divclass =jQuery(this).attr('id');
alert(divclass);
var arr = keyword1.split('-');
var qs_version='NIRV';
jQuery.ajax({
type:'GET',
crossDomain: true,
url:"<?php echo admin_url('admin-ajax.php')?>",
data:{action:'search_api_nirv1',keyword1:keyword1,qs_version:qs_version},
success:function(data){
//alert(data);
jQuery('.'+divclass).html('<div id="popup1" class="overlay"><div class="popup"><a class="popclose" href="javascript:void(0)">×</a><h2>'+arr[0]+'</h2><div class="content">'+data+'</div></div></div>');
       }
});
});
jQuery('body').on('click', '.popclose', function() {
//jQuery('.popup').removeClass('show');
jQuery(this).parent().parent().hide();
});
</script>
<?php } ?>

<script type="text/javascript">
jQuery(".dropdown_menu").each(function() {
  var classes = jQuery(this).attr("class"),
      id      = jQuery(this).attr("id"),
      name    = jQuery(this).attr("name");
	  var triggerel = jQuery(this).find("option:first-child").text();
	  //alert(triggerel);
  var template =  '<div class="' + classes + '">';
      template += '<span class="custom-select-trigger">' + triggerel + '</span>';
      template += '<div class="custom-options">';
      jQuery(this).find("option").each(function() {
        template += '<span class="custom-option ' + jQuery(this).attr("class") + '" data-value="' + jQuery(this).attr("value") + '">' + jQuery(this).html() + '</span>';
      });
  template += '</div></div>';
  
  jQuery(this).wrap('<div class="custom-select-wrapper"></div>');
  jQuery(this).hide();
  jQuery(this).after(template);
});
jQuery(".custom-option:first-of-type").hover(function() {
  jQuery(this).parents(".custom-options").addClass("option-hover");
}, function() {
  jQuery(this).parents(".custom-options").removeClass("option-hover");
});
jQuery(".custom-select-trigger").on("click", function() {
  jQuery('html').one('click',function() {
    jQuery(".dropdown_menu").removeClass("opened");
  });
  jQuery(".dropdown_menu").removeClass("opened");
  jQuery(this).parents(".dropdown_menu").toggleClass("opened");
  event.stopPropagation();
});
jQuery(".custom-option").on("click", function() {
  jQuery(this).parents(".custom-select-wrapper").find("select").val(jQuery(this).data("value"));
  jQuery(this).parents(".custom-options").find(".custom-option").removeClass("selection");
  jQuery(this).addClass("selection");
  jQuery(this).parents(".dropdown_menu").removeClass("opened");
  //jQuery(this).parents(".dropdown_menu").find(".custom-select-trigger").text(jQuery(this).text());
  var datavalue = jQuery(this).attr('data-value');
	if (datavalue.indexOf("http") > -1) {
		//alert(datavalue);
		//window.location.href = datavalue;<br />
		window.open(
		  datavalue,
		  '_blank' // <- This is what makes it open in a new window.
		);
	}
  
});
</script>
<?php get_footer(); ?>
