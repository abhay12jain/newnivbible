jQuery(".bloglist-bar .filterbox .searchbar input.searchfield").keypress(function (e) {
		 if (e.which == 13) {
        var searchval = jQuery('#searchblog').val();
		if(searchval==''|| searchval==null){
			jQuery('.searchblog-error').text('Please enter value').show();
			 setTimeout(function(){
			jQuery('.searchblog-error').hide();
			}, 3000);
			return false;
		}
		//alert(searchval);
       Searchblog(1, searchval);
         return false;
		 }
       }); 
          function Searchblog(page,searchval){
            
            var loader_html = "<div id='loading'></div>";
            
        jQuery.ajax({
                    type: "POST",
                    url: blogsearch.ajaxUrl,
                    data:{searchval:searchval,page:page,action:'searchblog'},
                    cache:false,
                    beforeSend: function() {
                      
                     jQuery(".load-more-img").html(loader_html);
                             
                     },
                    success: function(msg)
                        {
                            
                            var res = jQuery.parseJSON(msg);
                             let sanitizedCode = sanitizeHtml_1(res.html);
                          jQuery(".row").html(sanitizedCode+'<div class="pagination">'+res.pagination_html+'</div>').show();
                         
						 },

                   complete: function() {
                        jQuery('#loading').hide();
                        jQuery('.row .pagination li.active').on('click',function(){
                            var page = jQuery(this).attr('p');
                            var searchval = jQuery(this).attr('datasearch');
                            jQuery(this).addClass('curent');
                            Searchblog(page,searchval);
                            });
                  }

                });
        }	   
    
function sanitizeHtml_1(html) {
  var doc = new DOMParser().parseFromString(html, 'text/html');
  var sanitizedHtml = DOMPurify.sanitize(doc.body.innerHTML);
  return sanitizedHtml;
}