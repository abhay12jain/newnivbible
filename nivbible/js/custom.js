jQuery(window).scroll(function() {
if (jQuery(window).width() > 767) {	
if (jQuery(this).scrollTop() > 400){  
    jQuery('#header-part').addClass("sticky");
	jQuery('#wrapper').addClass("stickyhead");
  }
  else{
    jQuery('#header-part').removeClass("sticky");
	jQuery('#wrapper').removeClass("stickyhead");
  }
}
});

jQuery('.comment-box #commentform .wpcomment-rendering-fields input[type=checkbox]').prop('checked', true);

jQuery('#header-part a.menu_trigger').click(function(e) {
    e.preventDefault();
	jQuery('#header-part #menu').slideToggle();
});

jQuery('#header-part a.clsoebtn').click(function(e) {
    e.preventDefault();
	jQuery('#header-part #menu').slideUp();
});

jQuery('#header-part .searchform a.mobilesearch').click(function(e) {
    e.preventDefault();
	jQuery(this).toggleClass('curr1');
	jQuery('#header-part div.searchform').toggleClass('active1');
	jQuery('#header-part .searchform .searchform').toggleClass('active');
});

if (jQuery(window).width() < 1023) {	
jQuery('#header-part #menu ul li.menu-item-has-children > a').click(function(e) {
    e.preventDefault();
	jQuery(this).next().slideToggle();
});

}

jQuery('a.inlink[href*=#]:not([href=#]), .pagelinks a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
        || location.hostname == this.hostname) {

        var target = jQuery(this.hash);
        target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
           if (target.length) {
             jQuery('html,body').animate({
                 scrollTop: target.offset().top - 0
            }, 1000);
            return false;
        }
    }
});

jQuery('.faqs-bar .faqbg h4').click(function(e) {
    e.preventDefault();
	if(jQuery(this).hasClass('active')) { 
		jQuery(this).removeClass('active');
		jQuery(this).next().slideUp();
	} else { 
		jQuery('.faqs-bar .faqbg h4').removeClass('active');
		jQuery('.faqs-bar .faqbg .details').slideUp();
		jQuery(this).addClass('active');
		jQuery(this).next().slideDown();
	}
});

jQuery(window).on('load', function () {
    var hash = window.location.hash;
	//alert(hash);
	setTimeout(function(){ 
		jQuery('html, body').animate({
			scrollTop: jQuery(hash).offset().top - 50
		}, 'slow');
	}, 1000);
});