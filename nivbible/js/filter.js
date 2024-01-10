jQuery(function() {
	
	jQuery('.page-template-blog #header-part #menu li li.blogsublink > a').click(function(e) {
        e.preventDefault();
		var thishref = jQuery(this).attr('href');
		jQuery('.bloglist-bar .filterbox li a[href="'+thishref+'"]').trigger('click');
    });
	
	/*================== Resource Center Filter ==================*/
	jQuery(".bloglist-bar .filterbox li a").on("click", function(e) {
		e.preventDefault();
		
		jQuery('.bloglist-bar .filterbox li a').removeClass('active');
		jQuery(this).addClass('active');
		
		var categoryslug = jQuery(this).attr('data-category');			
		
		var refresh = jQuery(this).attr('href');
		setTimeout(function(){ 
			window.history.pushState({ path: refresh }, '', refresh);
		}, 1000);
						
		jQuery.ajax({
			type: "POST",
			url: AJAX_URL,
			dataType: 'JSON',
			data:{'action': 'resources','categoryslug':categoryslug,'showposts':4,'datapage':1},
			beforeSend: function() {
				jQuery('#oldlist').hide();				
				jQuery('.feed-loader-wrap').show();
			},
			success: function(e) {	
				jQuery('.feed-loader-wrap').hide();	
				jQuery('#newlist').html(e.html_content);				
				/*if(parseInt(e.next_page)>1){
					 jQuery('.alm-load-more-btn').attr('data-page',e.next_page);
					 jQuery('.alm-btn-wrap').show();
				}
				else{
					 jQuery('.alm-btn-wrap').hide();
				}*/
			},
			complete: function(e) {						
			},
			error: function(e) {
				
			}
   		});
			
    });
	
	/*================== Resource Center Page Banner Button Filter ==================*/
	jQuery(".bloglist-bar .pagination-bg .wp-paginate a").on("click", function(e) {
		e.preventDefault();
		var categoryslug = jQuery('.bloglist-bar .filterbox li a.active').attr('data-category');
		if(jQuery('.pagination-bg').hasClass('olding')) {
			var hrefval = jQuery(this).attr('href').split('/')[6];
		} else { 
			var hrefval = jQuery(this).attr('href').split('=')[1];
		}
		alert(hrefval);
						
		jQuery.ajax({
			type: "POST",
			url: AJAX_URL,
			dataType: 'JSON',
			data:{'action': 'resources','categoryslug':categoryslug,'showposts':4,'datapage':1},
			beforeSend: function() {
				jQuery('#oldlist').hide();				
				jQuery('.feed-loader-wrap').show();
			},
			success: function(e) {	
				jQuery('.feed-loader-wrap').hide();	
				jQuery('#newlist').html(e.html_content);				
				/*if(parseInt(e.next_page)>1){
					 jQuery('.alm-load-more-btn').attr('data-page',e.next_page);
					 jQuery('.alm-btn-wrap').show();
				}
				else{
					 jQuery('.alm-btn-wrap').hide();
				}*/
			},
			complete: function(e) {						
			},
			error: function(e) {
				
			}
   		});
			
    });
	
	/*================== Resource Center Clear Button Filter ==================*/
	jQuery('.resource-bar .clear-btn').click(function(e) {
        e.preventDefault();
		
		jQuery('.filter-bar .topic-filter .typeCategory').parent('.topic-filter').find('.togglestyle').html('Type <span></span>');	
		jQuery('.filter-bar .topic-filter .topicCategory').parent('.topic-filter').find('.togglestyle').html('Topic <span></span>');
		
		jQuery('.page-banner-bar .scroll-filter.active').removeClass('active');	
		
		jQuery('.filter-bar .dropdown.topicCategory li a, .filter-bar .dropdown.typeCategory li a').removeClass('active');
		jQuery("#resourceform").trigger("reset");
		
		var exclude = jQuery('.filter-bar .dropdown li a').attr('data-exclude'),
			topiccatslug = jQuery('.filter-bar .dropdown.topicCategory li a.active').attr('data-slug'),
			typecatslug = jQuery('.filter-bar .dropdown.typeCategory li a.active').attr('data-slug'),	
			topictaxonomy = jQuery('.filter-bar .dropdown.topicCategory li a.active').attr('data-taxonomy'),		
			inputvalue = jQuery('#resourceform input[type="text"]').val();			
						
		jQuery.ajax({
			type: "POST",
			url: AJAX_URL,
			dataType: 'JSON',
			data:{'action': 'resource','topiccatslug':topiccatslug,'topictaxonomy':topictaxonomy,'typecatslug':typecatslug,'exclude':exclude,'inputvalue':inputvalue,'showposts':3,'datapage':1},
			beforeSend: function() {
				jQuery('.alm-btn-wrap').hide();
				jQuery('#oldlist').hide();
				jQuery('.feed-loader-wrap').show();
			},
			success: function(e) {	
				jQuery('.feed-loader-wrap').hide();	
				jQuery('#newlist').html(e.html_content);				
				if(parseInt(e.next_page)>1){
					 jQuery('.alm-load-more-btn').attr('data-page',e.next_page);
					 jQuery('.alm-btn-wrap').show();
				}
				else{
					 jQuery('.alm-btn-wrap').hide();
				}
			},
			complete: function(e) {						
			},
			error: function(e) {
				
			}
   		});
		
		jQuery('.resource-bar .clear-btn').hide();	
		
    });
	   
	/*================== Bible Compare Search Filter ==================*/ 
	jQuery('.comparison-bar .selcetdropdown a.selectverse').click(function(e) {
		e.preventDefault();
        jQuery('.comparison-bar .selcetdropdown ul').slideToggle();
    });
	
	jQuery(".comparison-bar .selcetdropdown li a").on("click", function(e) {
		e.preventDefault();
		
		var menutext = jQuery(this).text();
		
		jQuery('.comparison-bar .selcetdropdown ul').slideUp();
		jQuery('.comparison-bar .selcetdropdown a.selectverse').text(menutext);
		
		var categoryslug = jQuery(this).attr('data-id');
						
		jQuery.ajax({
			type: "POST",
			url: AJAX_URL,
			dataType: 'JSON',
			data:{'action': 'comparefilter','categoryslug':categoryslug},
			beforeSend: function() {
				jQuery('#oldresult').hide();
				jQuery('.feed-loader-wrap').show();	
			},
			success: function(e) {		
				jQuery('.feed-loader-wrap').hide();	
				 let sanitizedCode = sanitize_Html(e.html_content);
				jQuery('.comparison-bar .featured-result #newresult').html(sanitizedCode);
			},
			complete: function(e) {						
			},
			error: function(e) {
				
			}
		});
	}) 
	
});
function sanitize_Html(html) {
  var doc = new DOMParser().parseFromString(html, 'text/html');
  var sanitizedHtml = DOMPurify.sanitize(doc.body.innerHTML);
  return sanitizedHtml;
}