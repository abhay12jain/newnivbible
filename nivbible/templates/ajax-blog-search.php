<?php 
add_action("wp_ajax_searchblog", "searchblog");
add_action("wp_ajax_nopriv_searchblog", "searchblog");
	
function searchblog(){
	global $post;
	 $page = $_POST['page']; 
	$searchstr = esc_attr($_POST['searchval']);
    //$cat_ID = $_POST['catid'];
    //$catslug=$_POST['currentslug'];
	$cur_page = $page;
	$per_page = 6;
	$previous_btn = true;
	$next_btn = true;
	$first_btn = true;
	$last_btn = true;
	$featured_post='';
	$html1 = "";
   $html2 = "";
   //$catName='Latest News';
if($_POST['page']!=1)
{
	$paged=$_POST['page'];
	$category_id=$_POST['catid'];
	//$per_page = 6;
	
}
else
{
	$paged=1;
    //$per_page = 5;
}
	
if($cat_ID){
		 $category_id=$cat_ID;
		 //$catName=get_cat_name($category_id);
		 
}
else{$category_id='';}
query_posts(array('post_type'=>'post', 's' => $searchstr,'posts_per_page'=>$per_page,'paged'=>$paged));
         if (have_posts()) : while (have_posts()) : the_post();
         //$featured_post = get_post_meta($post->ID,'featured_post',false);
        // $featured_post = get_field('featured_post',$post->ID);
         
      $html.=' <div class="news-item">';
      if($featured_post=='1'){
         	
         	$Img_url=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
            $category_detail=get_the_category($post->ID);
	      
	       if($Img_url[0]) {

	           $html .='<figure><a href="'.get_the_permalink($post->ID).'" class="openlink"><img src="'.$Img_url[0].'" alt="pic"></a></figure>';
	        }  
	        $html.='<div class="infos"><h3>'.get_the_title($post->ID).'</h3> <a href="'.get_the_permalink($post->ID).'" class="button">Read Article</a></div>';
	       

         } 
         else{
         	//$class="col-sm-6";
         	$Img_url=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
            $category_detail=get_the_category($post->ID);
	       
	       if($Img_url[0]) {
	        $html .='<figure><a href="'.get_the_permalink($post->ID).'" class="openlink"><img src="'.$Img_url[0].'" alt="pic"></a></figure>';
	        }  
	        $html.='<div class="infos"><h3>'.get_the_title($post->ID).'</h3> <a href="'.get_the_permalink($post->ID).'" class="button">Read Article</a></div>';
	         
     }
         $html.='</div>' ;   
       
       endwhile; 
       //$html.= $html1."".$html2;
       endif;
        wp_reset_query();
      
       //$html.='</div>';
       // $totalPost = query_posts('cat='.$category_id.'&posts_per_page=-1');
	   $totalPost = query_posts('s='.$searchstr.'&posts_per_page=-1&post_type=post');
	   
       $count = count($totalPost);

         //$count=$count-1;
	  
$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7)
 {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
	$phtml = "";
	if($count > $per_page){
	$phtml.= "<ul>";
	
	//FOR ENABLING THE FIRST BUTTON
	//if ($first_btn && $cur_page > 1) {
		//$phtml .= "<li p='1' class='active'>First</li>";
	//} else if ($first_btn) {
	//	$phtml .= "<li p='1' style='display:none' class='inactive'>First</li>";
	//}
	
	// FOR ENABLING THE PREVIOUS BUTTON
	if ($previous_btn && $cur_page > 1) {
		$pre = $cur_page - 1;
		$phtml .= "<li p='$pre' class='active'> <i class='fa fa-angle-left'></i> </li>";
	} else if ($previous_btn) {
		$phtml .= "<li class='inactive'style='display:none'> < </li>";
	}
	for ($i = $start_loop; $i <= $end_loop; $i++) {
	
		if ($cur_page == $i)
			$phtml .= "<li p='$i'class='active current'datacat='$category_id'>{$i}</li>";
		else
			$phtml .= "<li p='$i' class='active' datacat='$category_id'>{$i}</li>";
	}
	
	// TO ENABLE THE NEXT BUTTON
	if ($next_btn && $cur_page < $no_of_paginations) {
		$nex = $cur_page + 1;
		$phtml.= "<li p='$nex' class='active'> <i class='fa fa-angle-right'></i> </li>";
	} else if ($next_btn) {
		$phtml.= "<li class='inactive' style='display:none'> <i class='fa fa-angle-right'></i> </li>";
	}
	
	// TO ENABLE THE END BUTTON
	//if ($last_btn && $cur_page < $no_of_paginations) {
		//$phtml .= "<li p='$no_of_paginations' class='active'>Last</li>";
	//} 
	//else if ($last_btn) {
		//$phtml .= "<li p='$no_of_paginations' style='display:none' class='inactive'>Last</li>";
	//}
	$phtml .= "</ul>";
}
	
	 echo json_encode(array('html'=>$html,'pagination_html'=>$phtml));
	//if($count > $per_page)
		//echo $html;
	die;


}

