<?php
/**
 * The template for displaying for Posts
 *
 * Template Name: Scripture Search Template
 * 
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */

get_header(); 
//echo phpinfo();?>
<!-- content part-->
<section id="content-part">

	<?php if(get_field('slider_code')) { ?>
	<!--mainbanner bar-->
    <article class="mainbanner-bar search resheight" <?php /*?>style="background-image: url(<?php the_post_thumbnail_url(); ?>);"<?php */?>>
        
        	<?php echo get_field('slider_code'); ?>
        
    </article>
    <!--mainbanner bar-->
    <?php } else if(get_field('banner_image'))  {  ?>
    <!--mainbanner bar-->
    <article class="mainbanner-bar search resheight" style="background-image: url(<?php echo get_field('banner_image'); ?>);">
    	<div class="container">
        	
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        	<?php endwhile; endif; ?>
            
        </div>
    </article>
    <!--mainbanner bar-->
    <?php } else { ?>
    <!--mainbanner bar-->
    <article class="mainbanner-bar search resheight" style="background-image: url(<?php echo get_field('default_banner_image','option'); ?>);">
    	<div class="container">
        	
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        	<?php endwhile; endif; ?>
        
        </div>
    </article>
    <!--mainbanner bar-->
    <?php } ?>
    
    <!--searchfield bar-->
    <article class="searchfield-bar">
    	<div class="container">
         <div class="form_section" >      
            <!--<form class="bibleSearchForms" action="" method="GET">
			<strong style="color: #00477d; font-size: 18px; vertical-align: middle;">NIRV</strong>
			<input id="keyword" name="keyword" type="text" placeholder="Enter verse or passage:" />
			<input id="qs_version" name="ss_version" type="hidden" value="NIV" />
			<input id="searchsubmit" class="kjv" type="submit" value="Search Scripture" /></p>
<div class="powered_by"><a href="https://www.biblegateway.com/" target="_blank" rel="noopener noreferrer">Powered by Bible Gateway</a></div>
</form>-->
<?php if(is_page(1505)) { ?>
<form class="bibleSearchForms" action="" method="GET">
<p class="d-flex"><input id="keyword" name="keyword" type="text" placeholder="Enter keyword, passage, or topic:"><input id="qs_version" name="ss_version" type="hidden" value="NIRV"><input id="searchsubmit" class="kjv" type="submit" value="Search NIrV"></p><div class="powered_by"><a href="https://www.biblegateway.com/" target="_blank" rel="noopener noreferrer">Powered by <strong>Bible Gateway</strong></a></div>
</form>
<?php } else if(is_page(2019)) {  ?>
<form class="bibleSearchForms" action="" method="GET">
<p class="d-flex"><input id="keyword" name="keyword" type="text" placeholder="Enter keyword, passage, or topic:"><input id="qs_version" name="ss_version" type="hidden" value="NVI"><input id="searchsubmit" class="kjv" type="submit" value="Search NVI"></p><div class="powered_by"><a href="https://www.biblegateway.com/" target="_blank" rel="noopener noreferrer">Powered by <strong>Bible Gateway</strong></a></div>
</form>
<?php } else { ?>
<form class="bibleSearchForms" action="" method="GET">
<p class="d-flex"><input id="keyword" name="keyword" type="text" placeholder="Enter keyword, passage, or topic:"><input id="qs_version" name="ss_version" type="hidden" value="NIV"><input id="searchsubmit" class="kjv" type="submit" value="Search NIV"></p><div class="powered_by"><a href="https://www.biblegateway.com/" target="_blank" rel="noopener noreferrer">Powered by <strong>Bible Gateway</strong></a></div>
</form>
<?php } ?>

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
        
</section>
<!-- content part--> 
</div>
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

<?php get_footer(); ?>