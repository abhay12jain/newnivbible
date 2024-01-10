jQuery(document).ready(function() {
    jQuery(".be-select li a").on("click", function() {
     jQuery(".be-select li a").removeClass('active');
         jQuery(this).parent().addClass('active').siblings().removeClass('active');
         jQuery(this).addClass('active');
         var catid = jQuery(this).attr("data-id");
        loadData(1, catid);
         return false;
		 
        });
      
        function loadData(page,catid){
            
            var loader_html = "<div id='loading'></div>";
            
        jQuery.ajax({
                    type: "POST",
                    url: blogfilter.ajaxUrl,
                    data:{catid:catid,page:page,action:'showdata'},
                    cache:false,
                    beforeSend: function() {
                      jQuery(".load-more-img").html(loader_html);
                     },
                    success: function(msg)
                        {
                              var res = jQuery.parseJSON(msg);
                              let sanitizedCode = sanitizeHtml(res.html);
                              jQuery(".row").html(sanitizedCode+'<div class="pagination">'+res.pagination_html+'</div>').show();
                          
                             //setTimeout(function(){
                              	//history.pushState(null, null, '?pagenav=1&currentnav='+page);
                             //}, 1000);
                         
                         },

                   complete: function() {
                        jQuery('.load-more-img').hide();
                        jQuery('.row .pagination li.active').on('click',function(){ 
                            var page = jQuery(this).attr('p');
                            var catid = jQuery(this).attr('datacat');
                            jQuery(this).addClass('curent');
                            loadData(page,catid);
                            sessionStorage.setItem('paginationPage', page);
                            });
                           
                  }

                });
        }
     if (performance.navigation.type === 1) {
         jQuery('.be-select li a:first').trigger( "click");
    } else if (performance.navigation.type === 2) {
      var targetPageNumber = sessionStorage.getItem('paginationPage');
     setTimeout(function(){ 
       loadData(targetPageNumber,'');
     }, 2000);
     
}
else{
    jQuery('.be-select li a:first').trigger( "click");
    
}
     
});

function sanitizeHtml(html) {
  var doc = new DOMParser().parseFromString(html, 'text/html');
  var sanitizedHtml = DOMPurify.sanitize(doc.body.innerHTML);
  return sanitizedHtml;
}