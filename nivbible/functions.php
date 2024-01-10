<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
$content_width = 450;

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_image_size( 'thumb1', 332, 332, true );

function new_excerpt_length($length) {
    return 35;
}
add_filter('excerpt_length', 'new_excerpt_length');

// Changing excerpt more
function new_excerpt_more($more) {
global $post;
return '... <a href="'.get_permalink(get_the_ID()).'">Continue Reading</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 1);

function my_jquery_enqueue() {
	
   //wp_enqueue_script( 'fancyboxjs', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array( 'jquery' ), date('Y-m-d'), true );
   
   wp_enqueue_script( 'sliderjs', get_template_directory_uri() . '/js/slick.js', array( 'jquery' ), date('Y-m-d'), true );
   
   wp_enqueue_script( 'animationsjs', get_template_directory_uri() . '/js/css3-animate-it.js', array( 'jquery' ), date('Y-m-d'), true );
   
   wp_enqueue_script( 'Custom Js', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), date('Y-m-d'), true );
   
   wp_enqueue_script( 'AjaxFilter Js', get_template_directory_uri() . '/js/filter.js', array( 'jquery' ), date('Y-m-d'), true );
	
   wp_enqueue_style( 'fontface', get_template_directory_uri()."/fonts/stylesheet.css", array(), date('Y-m-d'), 'screen' );
   
   //wp_enqueue_style( 'fancyboxCSS', get_template_directory_uri()."/css/jquery.fancybox.min.css", array(), date('Y-m-d'), 'screen' );
   
   wp_enqueue_style( 'slidercss', get_template_directory_uri()."/css/slick.css", array(), date('Y-m-d'), 'screen' );
   
   wp_enqueue_style( 'AnimationCSS', get_template_directory_uri()."/css/animations.css", array(), date('Y-m-d'), 'screen' );
   
   wp_enqueue_style( 'responsiveCSS', get_template_directory_uri()."/css/responsive.css", array(), date('Y-m-d'), 'screen' );
   
   wp_enqueue_script( 'blog-filter-js', get_template_directory_uri() . '/js/blog-filter.js', array( 'jquery' ), date('Y-m-d'), true );
   wp_enqueue_script( 'blog-search-js', get_template_directory_uri() . '/js/blog-search.js', array( 'jquery' ), date('Y-m-d'), true );
   wp_enqueue_script( 'purifyjs', get_template_directory_uri() . '/js/purify.min.js', array( 'jquery' ), date('Y-m-d'), true );	   
   wp_enqueue_script('jquery');
   
   wp_localize_script('blog-filter-js', 'blogfilter', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('blogfilter_nonce'),
    ));
    wp_localize_script('blog-search-js', 'blogsearch', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('blogseach_nonce'),
    ));	
	
}


if ( function_exists('register_sidebar') ) {

	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'id' => 'blog_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

}


/* Adding page in Theme Option 
/*-----------------------------------------------------------------------------------*/  
if( function_exists('acf_add_options_page') ) {	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


if ( function_exists('register_sidebar') ) {
	
}

/** Menus */
add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu') );
	register_nav_menu( 'footer-menu1', __( 'Footer Menu 1') );
	register_nav_menu( 'footer-menu2', __( 'Footer Menu 2') );
	register_nav_menu( 'footer-menu3', __( 'Footer Menu 3') );
}

/*function SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}

if( !is_admin() ){
add_filter('pre_get_posts','SearchFilter');
}*/

// Our custom post type function
function create_posttype() {

	register_post_type( 'products',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Products' ),
				'singular_name' => __( 'Product' )
			),
			'public' => true,
			'has_archive' => false,
			'exclude_from_search' => true, 
			'rewrite' => array('slug' => 'products'),
			'supports' => array( 'title','editor', 'thumbnail'),
			'menu_icon'   => 'dashicons-products',
		)
	);
	
	register_post_type( 'bible-comparison',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Bible Scripture Comparison' ),
				'singular_name' => __( 'Scripture Comparison' )
			),
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'bible-comparison'),
			'supports' => array( 'title','editor', 'thumbnail'),
			'menu_icon'   => 'dashicons-media-document',
		)
	);
	
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

// Custom Taxonomies
/*add_action( 'init', 'create_portfolios_tax' );
function create_portfolios_tax() {
	register_taxonomy(
		'portfolios-category',
		'portfolios',
		array(
			'label' => __( 'Work Category' ),
			'rewrite' => array( 'slug' => 'work-cat' ),
			'hierarchical' => true,
		)
	);
}*/


//Page Slug Body Class
function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
$classes[] = $post->post_type . '-' . $post->post_name;
}
return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

/*Admin Logo*/
function my_custom_login_logo() {
  echo '<style type="text/css">
	body { background: #003c71 url('.get_bloginfo( 'stylesheet_directory' ).'/images/everyPage_texture.jpg) top center no-repeat !important; background-size: cover !important; }
	#backtoblog { display: none !important; }
   h1 a { background-image:url('.get_bloginfo( 'stylesheet_directory' ).'/images/logo.png)!important; background-size: 100% !important; }
   #login { width: 350px !important; }
   .login label, .login form .forgetmenot label { font-size: 15px !important; }
   .login h1 a {background-size: cover;  width: 281px !important; height: 98px; background-position:center; display:block}
   #acf-col-main .subsubsub.icl_subsubsub{clear:inherit!important}
   .login form{ border-radius: 10px; -webkit-border-radius: 10px; border:0px;  background: #1798db !important; border: 2px solid #fff !important; } 
   .login label, .login #backtoblog a, .login #nav a { color:#fff !important} 
   .login #nav a { color:#fff !important} 
   .login #backtoblog a, .login #nav a{}
   .wp-core-ui .button-primary {text-shadow:none!important; border:none!important; color:#1798db!important; background: #fff !important; border: 2px solid #fff !important; line-height: inherit !important; box-shadow: none !important; -webkit-box-shadow: none !important; }
	.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover{background:#fff !important; border-color: #fff !important; color: #1798db !important;}
	}
  </style>';
}
add_action('login_head', 'my_custom_login_logo');

add_filter('use_block_editor_for_post', '__return_false', 10);

add_action( 'wp_ajax_search_api_nirv', 'search_api_nirv' );
add_action( 'wp_ajax_nopriv_search_api_nirv', 'search_api_nirv' );
function search_api_nirv(){
	
if($_GET['qs_version']=="NIRV"){
	$search_tag="NIRV";
}elseif($_GET['qs_version']=="NIV"){
$search_tag="NIV";
}else{
$search_tag="NVI";
}

if($_GET['keyword']==""){
	echo 'No record found';
}else{
		$bibsearchkey = sanitize_text_field($_GET['keyword']);
		//$bibsearchkey = @preg_replace( '/\s+/', ' ', $bibsea);
		if(preg_match('/\s+/', $bibsearchkey )) 			
		{
			$bibsearchkey = @preg_replace( '/\s+/', ' ', $bibsearchkey);
		} 
		if(preg_match('/[.]+\s/', $bibsearchkey ))
		{
			$bibsearchkey = @preg_replace( '/[.]+\s/', '.', $bibsearchkey);
		}
		if(preg_match('/[\s]+./', $bibsearchkey ))
		{
			$bibsearchkey = @preg_replace( '/\s+[.]/', '.', $bibsearchkey);	
		}	
		$bibsearch = $bibsearchkey;        
	    $feed = file_get_contents("https://api.biblegateway.com/2/request_access_token?username=hcpdigitalops&password=6I3paT2rkAWgGvMJ");	
		
		$obj = json_decode($feed);
		//print_r($obj);
		
		if($_GET['qs_version']=="NIRV"){		
		$feed2 = file_get_contents("https://api.biblegateway.com/3/bible/".$bibsearch."/NIRV?access_token=".$obj->{'access_token'}."");		
		}
		elseif($_GET['qs_version']=="NIV"){	
       //echo "https://api.biblegateway.com/3/bible/".$bibsearch."/NVI?access_token=".$obj->{'access_token'}."";   
      	//echo $feed6 = file_get_contents("https://api.biblegateway.com/3/bible/".$bibsearch."/NVI?access_token=".$obj->{'access_token'}."");
       	
		$feed2 = file_get_contents("https://api.biblegateway.com/3/bible/".$bibsearch."/NIV?access_token=".$obj->{'access_token'}."");
	
		}
		else{$feed2 = file_get_contents("https://api.biblegateway.com/3/bible/".$bibsearch."/NVI?access_token=".$obj->{'access_token'}."");	     
		}
		
		$obj2 = json_decode($feed2);
		
		//print_r($obj2);
		//die();
		
		/*$obj3 = json_decode($feed3);
		
		if(!($obj3->keyword_result)){?>
		<div class="search_tag"><span class="searc" id="testing"><?php echo sanitize_text_field($_GET['keyword']);?></span> | <span class="head_search"><?php echo sanitize_text_field($search_tag);?></span> </div>
		<?php }
	if($obj3->keyword_result){
			//echo '$$$'; print_r($obj2->keyword_result->data[0]->suggested);
		foreach($obj3->keyword_result->data[0]->suggested as $suggested){
				if(!($_GET['keyword']=='love')){
				//if(!($suggested->title=='Genesis 1')){
				 echo '<div class="suggestion">';
				 echo $title = '<h2>'.$suggested->title.'</h2>';
				 echo $content = $suggested->content;
				 echo '</div>';
				}
				}
				
		foreach($obj3->keyword_result->data[0] as $aa){
			
			
			
			foreach($aa as $bb){
				//print_r($bb->book_display);
				$chapter= $bb->chapter;
				$verse= $bb->verse;
				$combine = $chapter.':'.$verse;
				$content = $bb->content;
				if($content){
				if(!($bb->book_display == '1 Corinthians')){
					
				
				
			}
				}
			}
				
			
			
			}
		}else{
		
		foreach($obj3->passage_result->data[0] as $aa){
			foreach($aa as $bb){
				$chapter= $bb->chapter;
				$verse= $bb->verse;
				$combine = $chapter.':'.$verse;
				$content = $bb->content;
				echo $content;
				}
				
			
			
			}
			}*/
		
foreach($obj2->data[0] as $boj){
		if($_GET['qs_version']=='NIRV'){
			      $content = $boj[0]->content;
				 
			     $oDom = new DOMDocument();
				 
$oDom->encoding = 'utf-8';

	
//$oDom->loadHTML( utf8_decode( $sString ) );
		//$oDom->loadHTML(utf8_decode($content));
			
			$oDom->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$content);
			
			$i=0;
			foreach($oDom->getElementsByTagName('a') as $anchor) {
				
				$id='tab-'.$i;
				$class = $id.' popupbox';
				$link = $anchor->getAttribute('href');
				$classname=$anchor->getAttribute('class');
				if($classname=='bibleref'){
                   //$link = '#popup';
					$link = 'javascript:void(0)';
					$anchor->setAttribute('href', $link);
					$anchor->setAttribute('id', $id);
					
					$a = $oDom->getElementsByTagName("a")->item($i);
					//$a->parentNode->setAttribute('class','sssss');
					$div = $oDom->createElement("div", "");
					$div->setAttribute('class', $class);
	                $a->parentNode->appendChild($div);
					
				 }
				
				$i++;}
			
			echo $oDom->saveHTML();
		}
		else{
			echo $content = $boj[0]->content;
		}
			
 $footnotes = $boj[0]->footnotes;
	if(!empty($footnotes)){?>
            <h3>Footnotes</h3>
			<?php foreach($footnotes as $footnote){
				echo $footnote;
				
				}
		 
			}
}
			}
				exit;
		//print_r($obj2[0]->data); exit;
		if(!empty($obj2[0]->data))
		{
			if((!empty($obj2[0]->data[0]->{'content'})) && (empty($obj2[0]->data[0]->{'osis'})))
			{
			  //  $osiskey = @str_replace(" ",".",$obj2[0]->data[0]->{'osis'});	
			  for($re=0;$re<count($obj2[0]->data); $re++)
			  {
			 	 $serres =  $obj2[0]->data[$re]->{'content'};	
				 $serresbuk =  $obj2[0]->data[$re]->{'book_display'};	
				 $serreschap =  $obj2[0]->data[$re]->{'chapter'};	
				 $serresverse =  $obj2[0]->data[$re]->{'verse'};
				 
				 $fincont[] = "<h6>".$serresbuk." ".$serreschap.":".$serresverse."</h6><br/>".$serres;		
				 	 
			  }
			  
			    $osiskey = @str_replace(" ",".",$bibsearch);	
				$osiskeyfin = @str_replace(":",".",$osiskey);				
				//echo $obj2[0]->data[0]->{'content'}."[osis]".$osiskeyfin;		
				
				$searchres = @implode("<br/>",$fincont);
								
				echo sanitize_text_field($searchres.$osiskeyfin);				
				
			} else if((!empty($obj2[0]->data[0]->{'content'})) && (!empty($obj2[0]->data[0]->{'osis'})))
			{
				$osiskey ="";// @str_replace(" ",".",$obj2[0]->data[0]->{'osis'});	
				$osiskeyfin = @str_replace(":",".",$osiskey);				
				//echo $obj2[0]->data[0]->{'content'}."[osis]".$osiskeyfin;	
				echo $obj2[0]->data[0]->{'content'};
			}
			else { echo 'No record found'; }
			
		}
			else {
				echo 'No record found';
		}
		
	?>
<div class="hads">
            <h5><?php echo $search_tag;?></h5>
         </div><?php 
 wp_die();
}
/*------------------------------*/
add_action( 'wp_ajax_search_api_nirv1', 'search_api_nirv1' );
add_action( 'wp_ajax_nopriv_search_api_nirv1', 'search_api_nirv1' );
function search_api_nirv1(){
if($_GET['qs_version']=="NIRV"){
	$search_tag="NIRV";
}elseif($_GET['qs_version']=="NIV"){
$search_tag="NIV";
}else{
$search_tag="King James Version (KJV)";
}

if($_GET['keyword1']==""){
	echo 'No record found';
}else{
      $bibsearchkey = sanitize_text_field($_GET['keyword1']);
		//$bibsearchkey = @preg_replace( '/\s+/', ' ', $bibsea);
		if(preg_match('/\s+/', $bibsearchkey )) 			
		{
			$bibsearchkey = @preg_replace( '/\s+/', ' ', $bibsearchkey);
		} 
		if(preg_match('/[.]+\s/', $bibsearchkey ))
		{
			$bibsearchkey = @preg_replace( '/[.]+\s/', '.', $bibsearchkey);
		}
		if(preg_match('/[\s]+./', $bibsearchkey ))
		{
			$bibsearchkey = @preg_replace( '/\s+[.]/', '.', $bibsearchkey);	
		}	
		$bibsearch = $bibsearchkey;
		$feed = file_get_contents("https://api.biblegateway.com/2/request_access_token?username=hcpdigitalops&password=6I3paT2rkAWgGvMJ");
		$obj = json_decode($feed);
		if($_GET['qs_version']=="NIRV"){
		//$feed2 = file_get_contents("https://api.biblegateway.com/3/bible/".$bibsearch."/NIRV?access_token=f8b11d8b0c030d8195901eb214ab2cc1d90abf84a457922f68af729d17417c05");
		$feed2 = file_get_contents("https://api.biblegateway.com/3/bible/".$bibsearch."/NIRV?access_token=".$obj->{'access_token'}."");
		}elseif($_GET['qs_version']=="NIV"){
		$feed2 = file_get_contents("https://api.biblegateway.com/3/bible/".$bibsearch."/NIV?access_token=".$obj->{'access_token'}."");
		
		}
		//elseif($_GET['qs_version']=="NIV"){
		//$feed2 = file_get_contents("https://api.biblegateway.com/3/bible/".$bibsearch."/NIV?access_token=".$obj->{'access_token'}."");
		
		//}
		
		else{$feed2 = file_get_contents("https://api.biblegateway.com/3/bible/".$bibsearch."/kjv?access_token=d5f73a50622c44fc5c415c2c2885ca09d300ba127950ae1966a847660422fc44");}
		
		$obj2 = json_decode($feed2);
		
		//print_r($obj2);
		//die();
		
		
	if($obj3->keyword_result){
			//echo '$$$'; print_r($obj2->keyword_result->data[0]->suggested);
		foreach($obj3->keyword_result->data[0]->suggested as $suggested){
				if(!($_GET['keyword1']=='love')){
				//if(!($suggested->title=='Genesis 1')){
				 echo '<div class="suggestion">';
				 echo $title = '<h2>'.$suggested->title.'</h2>';
				 echo $content = $suggested->content;
				 echo '</div>';
				}
				}
				
		foreach($obj3->keyword_result->data[0] as $aa){
			
			
			
			foreach($aa as $bb){
				//print_r($bb->book_display);
				$chapter= $bb->chapter;
				$verse= $bb->verse;
				$combine = $chapter.':'.$verse;
				$content = $bb->content;
				if($content){
				if(!($bb->book_display == '1 Corinthians')){
					
				//echo '<a target="_blank" href="https://www.biblegateway.com/passage/?search='.$bb->book_display.' '.$chapter.'%3A'.$verse.'&version=NIV">'.$bb->book_display.' '.$combine.'</a>'. $content;
				//echo '<div class="list"><strong class="number">'.$bb->book_display.' '.$combine.'</strong><div class="right">'. $content.'</div></div>';
				
			}
				}
			}
				
			
			
			}
		}else{
		//print_r($obj2->passage_result->data[0]);	
		foreach($obj3->passage_result->data[0] as $aa){
			foreach($aa as $bb){
				$chapter= $bb->chapter;
				$verse= $bb->verse;
				$combine = $chapter.':'.$verse;
				$content = $bb->content;
				echo $content;
				}
				
			
			
			}
			}
		
foreach($obj2->data[0] as $boj){
		
			     echo $content = $boj[0]->content;
		 $footnotes = $boj[0]->footnotes;
			if(!empty($footnotes)){?>
            <h3>Footnotes</h3>
			<?php foreach($footnotes as $footnote){
				echo $footnote;
				
				
				}
		 // print_r($boj[0]); 
			}
}
			}
				exit;
		//print_r($obj2[0]->data); exit;
		if(!empty($obj2[0]->data))
		{
			if((!empty($obj2[0]->data[0]->{'content'})) && (empty($obj2[0]->data[0]->{'osis'})))
			{
			  //  $osiskey = @str_replace(" ",".",$obj2[0]->data[0]->{'osis'});	
			  for($re=0;$re<count($obj2[0]->data); $re++)
			  {
			 	 $serres =  $obj2[0]->data[$re]->{'content'};	
				 $serresbuk =  $obj2[0]->data[$re]->{'book_display'};	
				 $serreschap =  $obj2[0]->data[$re]->{'chapter'};	
				 $serresverse =  $obj2[0]->data[$re]->{'verse'};
				 
				 $fincont[] = "<h6>".$serresbuk." ".$serreschap.":".$serresverse."</h6><br/>".$serres;		
				 	 
			  }
			  
			    $osiskey = @str_replace(" ",".",$bibsearch);	
				$osiskeyfin = @str_replace(":",".",$osiskey);				
				//echo $obj2[0]->data[0]->{'content'}."[osis]".$osiskeyfin;		
				
				$searchres = @implode("<br/>",$fincont);
								
				echo sanitize_text_field($searchres.$osiskeyfin);				
				
			} else if((!empty($obj2[0]->data[0]->{'content'})) && (!empty($obj2[0]->data[0]->{'osis'})))
			{
				$osiskey ="";// @str_replace(" ",".",$obj2[0]->data[0]->{'osis'});	
				$osiskeyfin = @str_replace(":",".",$osiskey);				
				//echo $obj2[0]->data[0]->{'content'}."[osis]".$osiskeyfin;	
				echo $obj2[0]->data[0]->{'content'};
			}
			else { echo 'No record found'; }
			
		}
			else {
				echo 'No record found';
		}
		
	?>
<?php 
 wp_die();
}

/* Include Filter Php */
include_once "filter.php";
require_once('ajax-files/ajax-blog.php');
require_once('ajax-files/ajax-blog-search.php');