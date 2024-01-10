<?php 
	 /**********************************Resources Page***********************/
   add_action('wp_ajax_nopriv_resources', 'resources');
   add_action('wp_ajax_resources','resources');
   function resources(){
   	 $paged = 1;
	
	if($_POST['categoryslug']){$categoryslug=$_POST['categoryslug'];}

	if($_POST['showposts']){$showposts=$_POST['showposts'];}
	
	if($_POST['datapage']){$paged=$_POST['datapage'];}

   	$args['post_type'] = 'post';
	
   	if($categoryslug){
		$args['category_name'] = $categoryslug;
   	}   
	
	$args['posts_per_page']=$showposts;
	
	if($paged == 1){
		$args['posts_per_page']=4;
	}else{
		$args['posts_per_page']=$showposts;
	}
	
    $args['paged']=$paged;
	
	
   	$posts = query_posts( $args );
	
	//print_r($posts);
	
	global $wp_query; 
	ob_start();
	$output = array();
	 $next_page="no_more_page";
	
	$total_post = 0;
	$termtt = get_term( $termId, 'category' );
	$total_post = $termtt->count;
	 	
	 if(have_posts()){
		 
	 	$max_num_pages=$wp_query->max_num_pages;
		if($paged == 1){
			$paged = 2;
			if($max_num_pages>=$paged){
				$next_page=$paged+1;
			}
		}else{		
			if($max_num_pages>$paged && $max_num_pages!=$paged){
				$next_page=$paged+1;
			}
		}
		
		while(have_posts()):the_post(); global $post; ?>
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
    <?php endwhile; 
	 }else { ?>
		<div class="no-result-found"><i class="fa fa-search" aria-hidden="true"></i> No Results Found</div>
	<?php  } ?>
     <div class="pagination-bg"><?php 
		if(function_exists('wp_paginate')):
			wp_paginate();  
		endif;
	?></div>
    <?php 
		$ob_content = ob_get_contents();
		ob_end_clean();
	  $output['html_content'] = $ob_content;
	  $output['next_page']	  = $next_page;	  
	  $output['total_post'] = $total_post;
	  echo  json_encode($output);
	  wp_die();	
	}
	
	/**********************************Compare Results Filter***********************/
	add_action('wp_ajax_nopriv_comparefilter', 'comparefilter');
   	add_action('wp_ajax_comparefilter','comparefilter');
   function comparefilter(){
   	 $paged = 1;
	
	if($_POST['categoryslug']){
	    $categoryslug= sanitize_text_field($_POST['categoryslug']);
	    
	}

	$args['post_type'] = 'bible-comparison';
	
   	if($categoryslug){
		$args['p'] = $categoryslug;
   	}   
	
	$args['posts_per_page']=$showposts;
	
	$posts = query_posts( $args );
	
	//print_r($posts);
	
	global $wp_query; 
	ob_start();
	$output = array();
	 $next_page="no_more_page";
	
	$total_post = 0;
	$termtt = get_term( $termId, 'category' );
	$total_post = $termtt->count;
	 	
	 if(have_posts()){
		 
	 	$max_num_pages=$wp_query->max_num_pages;
		if($paged == 1){
			$paged = 2;
			if($max_num_pages>=$paged){
				$next_page=$paged+1;
			}
		}else{		
			if($max_num_pages>$paged && $max_num_pages!=$paged){
				$next_page=$paged+1;
			}
		}
		
		while(have_posts()):the_post(); global $post; ?>
        <div class="restulbox">
        
            <h2><?php the_title(); ?></h2>
            
            <div class="contentbg d-flex">
                
                <div class="block">
                    
                    <h3>NIV</h3>
                    
                    <div class="details">
                        
                        <?php the_field('niv_intro'); ?>
                    
                    </div>
                    
                    <div class="mobielcontent">
                                
                        <h3>NIrV</h3>
                        <div class="details">
                            
                            <?php the_field('nirv_intro'); ?>
                        
                        </div>
                    
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
                    
                    <div class="nomobilecontent">
                                
                        <h3>NIrV</h3>
                    
                        <div class="details">
                            
                            <?php the_field('nirv_intro'); ?>
                        
                        </div>
                    
                    </div>
                    
                    <div class="blockmid d-flex">
                    
                        <div class="column">
                        
                            <h4>NASB 1995</h4>
                            
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
    <?php endwhile; 
	 }else { ?>
		<div class="no-result-found"><i class="fa fa-search" aria-hidden="true"></i> No Results Found</div>
	<?php  } ?>
     <div class="pagination-bg"><?php 
		if(function_exists('wp_paginate')):
			wp_paginate();  
		endif;
	?></div>
    <?php 
		$ob_content = ob_get_contents();
		ob_end_clean();
	  $output['html_content'] = $ob_content;
	  $output['next_page']	  = $next_page;	  
	  $output['total_post'] = $total_post;
	  echo  json_encode($output);
	  wp_die();	
	}