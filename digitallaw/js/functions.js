/**
 * Functionality specific to DigitalLaw.
 *
 * Provides helper functions to enhance the theme experience.
 */



 
 
 
 
/*!
 * jQuery resize event - v1.1 - 3/14/2010
 * http://benalman.com/projects/jquery-resize-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
!function(t,e,i){"$:nomunge";function n(){r=e[s](function(){h.each(function(){var e=t(this),i=e.width(),n=e.height(),r=t.data(this,d);(i!==r.w||n!==r.h)&&e.trigger(u,[r.w=i,r.h=n])}),n()},a[o])}var r,h=t([]),a=t.resize=t.extend(t.resize,{}),s="setTimeout",u="resize",d=u+"-special-event",o="delay",c="throttleWindow";a[o]=250,a[c]=!0,t.event.special[u]={setup:function(){if(!a[c]&&this[s])return!1;var e=t(this);h=h.add(e),t.data(this,d,{w:e.width(),h:e.height()}),1===h.length&&n()},teardown:function(){if(!a[c]&&this[s])return!1;var e=t(this);h=h.not(e),e.removeData(d),h.length||clearTimeout(r)},add:function(e){function n(t,e,n){var h=jQuery(this),a=jQuery.data(this,d);if(a!==i)a.w=e!==i?e:h.width();else{var a=new Object;a.w=h.width()}r.apply(this,arguments)}if(!a[c]&&this[s])return!1;var r;return t.isFunction(e)?(r=e,n):(r=e.handler,void(e.handler=n))}}}(jQuery,this);










/*------------------------------------------------------------------------------*/
/*  Sticky Header
/*------------------------------------------------------------------------------*/	

	

function digitallaw_sticky(){
	if( jQuery('.masthead-header-stickyOnScroll').length > 0 ){
	
		// Returns width of browser viewport
		var pageWidth = jQuery( window ).width();

		var selector       = jQuery('.masthead-header-stickyOnScroll');
		var selectorParent = 'stickable-header-sticky-wrapper';
		
		if( jQuery('body').hasClass('thememount-header-style-3') || jQuery('body').hasClass('thememount-header-style-6') ){
			selector       = jQuery('#navbar');
			selectorParent = 'navbar-sticky-wrapper';
		}
		
		if( parseInt(pageWidth) > parseInt(tm_breakpoint) ){
			if( jQuery(selector).parent().attr('id')!=selectorParent ){
				
				// admin bar
				var topspac = 0;
				if( jQuery('body').hasClass('admin-bar') ){ topspac = 32; }
				
				jQuery(selector).sticky({topSpacing:topspac});
				jQuery(selector).on('sticky-start', function() { jQuery(".k_flying_searchform_wrapper").addClass('stickyform'); });
				jQuery(selector).on('sticky-end', function() { jQuery(".k_flying_searchform_wrapper").removeClass('stickyform'); });
			} else {
				//console.log('NO NEED TO STICK ==============');
			}
		} else {
			if( jQuery(selector).parent().attr('id')==selectorParent ){
				jQuery(selector).unstick();
			} else {
				//console.log('NO NEED TO UN-STICK -------------------');
			}
		}
	}
}


function digitallaw_setCookie(c_name,value,exdays){
	var now  = new Date();
	var time = now.getTime();
	time    += (3600 * 1000) * 24;
	now.setTime(time);

	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+now.toGMTString() );
	document.cookie=c_name + "=" + c_value;
} // END function digitallaw_setCookie



/*------------------------------------------------------------------------------*/
/* Function to set dynamic height of Testimonial columns
/*------------------------------------------------------------------------------*/
function digitallaw_setHeight(column) {
    var maxHeight = 0;
    //Get all the element with class = col
    column = jQuery(column);
    column.css('height', 'auto');
	
	// Responsive condition: Work only in tablet, desktop and other bigger devices.
	if( jQuery( window ).width() > 479 ){
		
		//Loop all the column
		column.each(function() {       
			//Store the highest value
			if(jQuery(this).height() > maxHeight) {
				maxHeight = jQuery(this).height();
			}
		});
		//Set the height
		column.height(maxHeight);
		
	} // if( jQuery( window ).width() > 479 )
} // END function digitallaw_setHeight
/**************************************************************************/


/*------------------------------------------------------------------------------*/
/* Function to Set Blog Masonry view
/*------------------------------------------------------------------------------*/
function digitallaw_blogmasonry(){
	if( jQuery().isotope ){
		if( jQuery('.digitallaw-masongry-enabled').length > 0 ){
			
			jQuery('.digitallaw-masongry-enabled').masonry();
			jQuery('.digitallaw-masongry-enabled').isotope({
					itemSelector: '.post-box',
					masonry: {},
					sortBy : 'original-order'
			});
		}
	}
}


/*------------------------------------------------------------------------------*/
/* Function to set margin bottom for sticky footer
/*------------------------------------------------------------------------------*/
function digitallaw_stickyFooter(){
	if( jQuery('body').hasClass('thememount-sticky-footer')){
		jQuery('div#main').css( 'marginBottom', jQuery('footer#colophon').height() );
	}
}


/*------------------------------------------------------------------------------*/
/* Function to add class to select box if default option selected
/*------------------------------------------------------------------------------*/
function digitallaw_setEmptySelectBox(element){
	if(jQuery(element).val() == ""){
		jQuery(element).addClass("empty");
	} else {
		jQuery(element).removeClass("empty");
	}
}



function digitallaw_hide_togle_link(){
	if( jQuery('#navbar div.mega-menu-wrap ul.mega-menu').length > 0 ){
		jQuery('h3.menu-toggle').css('display','none');
	}
}





/*------------------------------------------------------------------------------*/
/* Google Map in Header area
/*------------------------------------------------------------------------------*/
function digitallaw_reset_gmap(){
	jQuery('.thememount-fbar-box-w > div > aside').each(function(){
		var mainthis = jQuery(this);
		jQuery( 'iframe[src^="https://www.google.com/maps/"], iframe[src^="http://www.google.com/maps/"]',mainthis ).each(function(){
			if( !jQuery(this).hasClass('thememount-set-gmap') ){
				jQuery(this).attr('src',jQuery(this).attr('src')+'');
				jQuery(this).load(function(){
					jQuery(this).addClass('thememount-set-gmap').animate({opacity: 1 }, 1000 );
				});	

			}
		})
	});
}
function digitallaw_hide_gmap(){
	jQuery('.thememount-fbar-box-w > div > aside').each(function(){
		var mainthis = jQuery(this);
		jQuery( 'iframe[src^="https://www.google.com/maps/"], iframe[src^="http://www.google.com/maps/"]',mainthis ).each(function(){
			if( !jQuery(this).hasClass('thememount-set-gmap') ){
				jQuery(this).css({opacity: 0});
				jQuery(this).css('display', 'block');
			}
		})
	});
}


	
	

function digitalLaw_isotope() {
	var gallery_item = jQuery('.portfolio-wrapper');
	var filterLinks  = jQuery('.portfolio-sortable-list a');
	gallery_item.isotope({
		animationEngine : 'best-available'
	})
	filterLinks.click(function(e){
		var selector = jQuery(this).attr('data-filter');
		gallery_item.isotope({
			filter : selector,
			itemSelector : '.isotope-item'
		});

		filterLinks.removeClass('selected');
		jQuery('#filter-by li').removeClass('current-cat');
		jQuery(this).addClass('selected');
		e.preventDefault();
	});
};
	


	
function digitallaw_setcross(){
	var currentHeight = 0;
    currentHeight = jQuery('.footer1').outerHeight();	
	jQuery('head').append('<style>.footer1 .tm-boxleft:before{opacity:1; border-width : 0 0 ' + currentHeight + 'px 59px}</style>');
}



function digitallaw_set_team_overlay_content(){
	jQuery('.thememount-team-img').each(function(){
		
		var areaHeight      = jQuery(this).outerHeight();
		
		var phonemailHeight = jQuery('.thememount-team-phoneemail',this).outerHeight();
		var descHeight      = jQuery('.thememount-team-short-desc',this).outerHeight();
		var socialHeight    = jQuery('.thememount-team-social-links',this).outerHeight();
		var pad             = 26; // Total padding of top and bottom both
		var totalHeight     = phonemailHeight + descHeight + socialHeight+pad;
		
		// Resetting inline style
		jQuery('.thememount-team-short-desc',this).css("height", "").css("overflow", "");
		
		
		if( totalHeight>areaHeight ){
			var newHeight = areaHeight - (phonemailHeight+socialHeight+pad);
			jQuery('.thememount-team-short-desc',this).height(newHeight)/*.css('overflow','auto')*/.mCustomScrollbar();
		}
	});
}

/******************************/

 
/* One Page Navigation
	   --------------------------------------------------------- */	
	   
jQuery( document ).ready(function($) {
	
	"use strict";
	
	/*------------------------------------------------------------------------------*/
	/* hide responsive menu toggle if Max Mega menu toggle is available
	/*------------------------------------------------------------------------------*/	
	digitallaw_menu_js_code();
	
	
	
	/*------------------------------------------------------------------------------*/
	/* Remove span for input style to work - Hack for Contact Form 7 span wrap
	/*------------------------------------------------------------------------------*/	
	jQuery('.input-effect .wpcf7-form-control').each(function(){
		if( jQuery(this).is('[class*="effect-"]') ) {
			jQuery(this).unwrap();
		}
	});
	jQuery('.input-effect .wpcf7-form-control').focusout(function(){
		if( jQuery(this).val() != "" ){
			jQuery(this).addClass("has-content");
		}else{
			jQuery(this).removeClass("has-content");
		}
	});
	
	
	
	/*------------------------------------------------------------------------------*/
	/* Modification in header search form
	/*------------------------------------------------------------------------------*/
	jQuery('.tm-sresult-form-top .search-field').removeAttr('placeholder');
	
	
	/*------------------------------------------------------------------------------*/
	/* Team Member overlay - setting content height
	/*------------------------------------------------------------------------------*/
	digitallaw_set_team_overlay_content();
	
	
	
	/*------------------------------------------------------------------------------*/
	/* One Page setting
	/*------------------------------------------------------------------------------*/	
	if( jQuery('body').hasClass('thememount-one-page-site') ){
		var sections = jQuery('.wpb_row, #tm-header-slider'),
		nav = jQuery('.mega-menu-wrap, .menu-main-menu-container'),
		nav_height = jQuery('#site-navigation').data('sticky-height')-1;
		jQuery(window).on('scroll', function () {
			if(typeof jQuery(this) != 'undefined'){
				var cur_pos = jQuery(this).scrollTop(); 
				sections.each(function() {
		
					var top = jQuery(this).offset().top - (nav_height+2),
					bottom = top + jQuery(this).outerHeight(); 
		
					if (cur_pos >= top && cur_pos <= bottom) {
		
						if( typeof jQuery(this) != 'undefined' && typeof jQuery(this).attr('id')!='undefined' && jQuery(this).attr('id')!='' ){
							
							var mainThis = jQuery(this);							
							nav.find('a').removeClass('mega-current-menu-item mega-current_page_item current-menu-ancestor current-menu-item current_page_item');						
							jQuery(this).addClass('mega-current-menu-item mega-current_page_item current-menu-ancestor current-menu-item current_page_item');
							var arr = mainThis.attr('id');							
							// Applying active class
							jQuery('#navbar a').parent().removeClass('mega-current-menu-item mega-current_page_item current-menu-ancestor current-menu-item current_page_item');
							nav.find('a').each(function(){
								var menuAttr = jQuery(this).attr('href').split('#')[1];						
								if( menuAttr == arr ){
									jQuery(this).parent().addClass('mega-current-menu-item mega-current_page_item current-menu-ancestor current-menu-item current_page_item');
								}
							})							
						}
					}
				});
			}
	});
	
	nav.find('a').on('click', function () {
	var $el = jQuery(this), 
	id = $el.attr('href');
	var arr=id.split('#')[1];	  
		jQuery('html, body').animate({
			scrollTop: jQuery('#'+ arr).offset().top - nav_height
		  }, 500);  
		  return false;
		});
	}	
		
	/*------------------------------------------------------------------------------*/
	/*  Open Floating bar from top
	/*------------------------------------------------------------------------------*/ 		
	if( jQuery("div.search_field.by_treatment select").length > 0 ){
		digitallaw_setEmptySelectBox(jQuery("div.search_field.by_treatment select"));
		// Country dropdown on change
		jQuery("div.search_field.by_treatment select").change(function () {
			digitallaw_setEmptySelectBox( jQuery(this) );
		});
	}

	var teamSearchBoxIconOpen   = jQuery('.thememount-fbar-position-default .thememount-fbar-btn > a').data('openicon'); // Open Icon
	var teamSearchBoxIconClosed = jQuery('.thememount-fbar-position-default .thememount-fbar-btn > a').data('closeicon'); // Close Icon
	digitallaw_hide_gmap();
	jQuery(".thememount-fbar-position-default .thememount-fbar-btn").click(function(){
		if( jQuery(".thememount-fbar-box-w").css('display')=='none' ){
			jQuery('.thememount-fbar-btn i').removeClass( teamSearchBoxIconOpen ).addClass( teamSearchBoxIconClosed );	
			
			
			jQuery(".thememount-fbar-box-w").slideDown('400', function(){
				digitallaw_reset_gmap();
				jQuery(".thememount-set-gmap").fadeIn(1000);
				jQuery('.thememount-fbar-btn').addClass("thememount-fbar-open");
			});
		} else {
			jQuery('.thememount-fbar-btn i').removeClass( teamSearchBoxIconClosed ).addClass( teamSearchBoxIconOpen );			
			jQuery(".thememount-set-gmap").hide();			
			jQuery(".thememount-fbar-box-w").slideUp();
			jQuery('.thememount-fbar-btn').removeClass( "thememount-fbar-open" );
		}
		return false;
	});		
	
	/*------------------------------------------------------------------------------*/
	/*  Open Floating bar from right
	/*------------------------------------------------------------------------------*/ 
	var teamSearchBoxIconOpenRight   = jQuery('.thememount-fbar-position-right .thememount-fbar-btn > a').data('openicon'); // Open Icon
	var teamSearchBoxIconClosedRight = jQuery('.thememount-fbar-position-right .thememount-fbar-btn > a').data('closeicon'); // Close Icon
	
	jQuery('.thememount-fbar-position-right .thememount-fbar-btn').click(function(){
		var hidden = jQuery('.thememount-fbar-position-right .thememount-fbar-box-w');
		if (hidden.hasClass('visible')){			
			
			//digitallaw_fbar_right_position();
			if (jQuery(window).width() < 479){	
				hidden.animate({"right":"-280px"}, "slow").removeClass('visible');
			}else{
				hidden.animate({"right":"-386px"}, "slow").removeClass('visible');			
			}
			jQuery('.thememount-fbar-btn i').removeClass( teamSearchBoxIconClosedRight ).addClass( teamSearchBoxIconOpenRight );
			
			
		} else {
			hidden.animate({"right":"0px"}, "slow").addClass('visible');
			jQuery('.thememount-fbar-btn i').removeClass( teamSearchBoxIconOpenRight ).addClass( teamSearchBoxIconClosedRight );	
		}
		return false;
    });
	
	
	
	
	
	
	/*------------------------------------------------------------------------------*/
	/* Add plus icon in menu
	/*------------------------------------------------------------------------------*/ 
	
	
	jQuery('#navbar #site-navigation div.mega-menu-wrap .mega-menu-toggle').append("<span></span>");
	
	jQuery('#navbar #site-navigation div.nav-menu > ul > li:has(ul), #site-navigation .mega-menu-wrap > ul > li:has(ul)').append("<span class='righticon'><i class='fa fa-plus-square'></i></span>");
	
	jQuery('#site-navigation .menu-main-menu-container > ul > li.menu-item-language, #site-navigation .mega-menu-wrap > ul > li.menu-item-language').addClass("mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-menu-item-13 mega-align-bottom-left mega-menu-flyout");
	
	
	jQuery('#site-navigation .mega-menu-wrap > ul > li.menu-item-language').addClass("mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-menu-item-13 mega-align-bottom-left mega-menu-flyout");	
	jQuery('#site-navigation .mega-menu-wrap > ul > li.menu-item-language ul').addClass("mega-sub-menu");
	
		
	jQuery('#navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal > li.menu-item-language > a').show();
	jQuery('#site-navigation .mega-menu-wrap > ul > li.menu-item-language').hover(
         function () {			 		 
		   jQuery('#navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-menu-flyout .mega-sub-menu').css("display", "none");	
           jQuery(this).find('ul').show();		   
         }, 
         function () {
           jQuery(this).find('ul').hide();
         }
     );
	
	
	
	jQuery('.menu li.current-menu-item').parents('li.mega-menu-megamenu').addClass('mega-current-menu-ancestor');
	
	if (!jQuery('body').hasClass("tm-header-invert")) {	
		jQuery( ".nav-menu > li:eq(-2), #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal > li.mega-menu-item:eq(-2)" ).addClass( "lastsecond" );
		jQuery( ".nav-menu > li:eq(-1), #navbar #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal > li.mega-menu-item:eq(-1)" ).addClass( "last" );	
	}
	/*------------------------------------------------------------------------------*/
	/* Social icon
	/*------------------------------------------------------------------------------*/ 
		
	jQuery(".thememount-row-fullwidth-true.full-colum-height-widht > .grid_section > .vc_column_container img.vc_single_image-img").each(function() {  
       var imgsrc = jQuery(this).attr("src");
	   jQuery(this).parent().parent().parent().parent().parent('.vc_column_container').css('background-image', 'url(' + imgsrc + ')');       
  	});
	

	
	
	/*------------------------------------------------------------------------------*/
	/* Search form
	/*------------------------------------------------------------------------------*/
	
	
	jQuery( ".search_box a" ).addClass('sclose');	
	
	jQuery( ".search_box a" ).click(function() {
		
		
		if (jQuery('.search_box a').hasClass('sclose')) {
			

			jQuery(this).removeClass('sclose').addClass('open');	
						
			jQuery(".k_flying_searchform_wrapper").slideDown( 400, function() {
				jQuery(".field.searchform-s").focus();				
			});
			
		} else {			
			jQuery(this).removeClass('open').addClass('sclose');			
			jQuery(".k_flying_searchform_wrapper").slideUp( 400, function() {						 		
			});	 
		}
		
	});		
	
	jQuery( ".tm-search-close" ).click(function() {		
			jQuery('.search_box a').removeClass('open').addClass('sclose');			
			jQuery(".k_flying_searchform_wrapper").slideUp( 400, function() {						 		
			});		
	});
		

	 	
	 /*------------------------------------------------------------------------------*/
	 /* Applying prettyPhoto to all images
	 /*------------------------------------------------------------------------------*/
	if( typeof jQuery.fn.prettyPhoto == "function" ){
		
		// Gallery
		jQuery('div.gallery a[href*=".jpg"], div.gallery a[href*=".jpeg"], div.gallery a[href*=".png"], div.gallery a[href*=".gif"]').each(function(){
			if( jQuery(this).attr('target')!='_blank' ){
				jQuery(this).attr('rel','prettyPhoto[wp-gallery]');
			}
		});
		
		// WordPress Gallery
		jQuery('.gallery-item a[href*=".jpg"], .gallery-item a[href*=".jpeg"], .gallery-item a[href*=".png"], .gallery-item a[href*=".gif"]').each(function(){
			if( jQuery(this).attr('target')!='_blank' ){
				jQuery(this).attr('rel','prettyPhoto[coregallery]');
			}
		});
		
		// Normal link
		jQuery('a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]').each(function(){
			if( jQuery(this).attr('target')!='_blank' && !jQuery(this).hasClass('prettyphoto') ){
				var attr = $(this).attr('rel');
				// For some browsers, `attr` is undefined; for others,
				// `attr` is false.  Check for both.
				if (typeof attr !== typeof undefined && attr !== false && attr!='prettyPhoto' ) {
					jQuery(this).attr('data-rel','prettyPhoto');
				}
			}
		});
		
		jQuery('a[rel^="prettyPhoto"]').prettyPhoto();
		jQuery('a.tm_prettyphoto').prettyPhoto();
		
	}
		

	/*------------------------------------------------------------------------------*/
	/* Animation on scroll: Number rotator
	/*------------------------------------------------------------------------------*/
	$("[data-appear-animation]").each(function() {
		var self      = $(this);
		var animation = self.data("appear-animation");
		var delay     = (self.data("appear-animation-delay") ? self.data("appear-animation-delay") : 0);
		
		if( $(window).width() > 959 ) {
			self.html('0');
			self.waypoint(function(direction) {
				if( !self.hasClass('completed') ){
					var from     = self.data('from');
					var to       = self.data('to');
					var interval = self.data('interval');
					self.numinate({
						format: '%counter%',
						from: from,
						to: to,
						runningInterval: 2000,
						stepUnit: interval,
						onComplete: function(elem) {
							self.addClass('completed');
						}
					});
				}
			}, { offset:'85%' });
		} else {
			if( animation == 'animateWidth' ) {
				self.css('width', self.data("width"));
			}
		}
	});

	/*------------------------------------------------------------------------------*/
	/* Scroll to Top
	/*------------------------------------------------------------------------------*/
	jQuery(window).scroll(function() { digitallaw_scroll_to_top(); });
	jQuery(window).resize(function() { digitallaw_scroll_to_top(); });
	jQuery(window).load(function()   { digitallaw_scroll_to_top(); });
	var duration = 500;
	var offset   = 85;
    jQuery("#totop").click(function(event) {
        event.preventDefault();
        jQuery("html, body").animate({scrollTop: 0}, duration);
        return false;
    })
	
	
	function digitallaw_scroll_to_top(){
		if (jQuery(window).scrollTop() > offset) {
            jQuery("#totop").fadeIn(duration);
        } else {
            jQuery("#totop").fadeOut(duration);
        }
	}
	
	
	/*------------------------------------------------------------------------------*/
	/* Set height of boxes inside row-column view of Blog and Portfolio
	/*------------------------------------------------------------------------------*/
	if( jQuery('.thememount-testimonial-box' ).length > 0 ){
		digitallaw_setHeight('.thememount-testimonial-box.col-lg-6.col-sm-6.col-md-6');
		digitallaw_setHeight('.thememount-testimonial-box.col-lg-4.col-sm-6.col-md-4');
		digitallaw_setHeight('.thememount-testimonial-box.col-lg-3.col-sm-6.col-md-3');
	}	
	
	/*------------------------------------------------------------------------------*/
	/* Sticky
	/*------------------------------------------------------------------------------*/
	if( jQuery('.masthead-header-stickyOnScroll').length > 0 ){
		digitallaw_sticky();
	}	

	/*------------------------------------------------------------------------------*/
	/* Return Fasle when # Url
	/*------------------------------------------------------------------------------*/
	$('#site-navigation a[href="#"]').click(function(){return false;});	
	

	
	/*------------------------------------------------------------------------------*/
	/* Welcome bar close button
	/*------------------------------------------------------------------------------*/
	$(".thememount-close-icon").click(function(){
		$("#page").css('padding-top', (parseInt($("#page").css('padding-top')) - parseInt($(".thememount-wbar").height()) ) + 'px' );
		$(".thememount-wbar").slideUp();
		digitallaw_setCookie('kw_hidewbar','1',1);
	});

	/*------------------------------------------------------------------------------*/
	/* Removing BR tag added by shortcode generator
	/*------------------------------------------------------------------------------*/
	var galleryHTML = jQuery(".gallery-size-full br").each(function(){
		jQuery(this).remove();
	});	



	/*------------------------------------------------------------------------------*/
	/* Settting for lightbox content in Blog
	/*------------------------------------------------------------------------------*/
	jQuery("a.thememount-open-gallery").click(function(){
		var href   = jQuery(this).attr('href');
		var id     = href.replace("#thememount-embed-code-", "");
		var currid = window[ 'api_images_' + id ];
		jQuery.prettyPhoto.open( window[ 'api_images_' + id ] , window[ 'api_titles_' + id ] , window[ 'api_desc_' + id ] );
	});
	


	/*------------------------------------------------------------------------------*/
	/* Carousel effect in Blog and Portfolio section
	/*------------------------------------------------------------------------------*/
	if ( jQuery('.thememount-effect-carousel').length > 0 ) {
		jQuery('.thememount-effect-carousel').each(function(){
			
			/* Responsive array for "Owl Carousel 2"
			 * http://owlcarousel.owlgraphic.com/index.html
			 */
			var itemsColumns2 = {
				0:{
					items:1
				},
				479:{
					items:2
				},
				768:{
					items:2
				},
				1200:{
					items:3
				}
			};
			
			if( jQuery(this).hasClass('thememount-carousel-col-one') ){
				
				// One Column
				itemsColumns2 = {
					0:{
						items:1
					},
					479:{
						items:1
					},
					768:{
						items:1
					},
					1200:{
						items:1
					}
				};

			} else if( jQuery(this).hasClass('thememount-carousel-col-two') ){
				
				// Two Column		
				itemsColumns2 = {
					0:{
						items:1
					},
					479:{
						items:2
					},
					768:{
						items:2
					},
					1200:{
						items:2
					}
				};
				
			} else if( jQuery(this).hasClass('thememount-carousel-col-four') ){
				// Four Column
				itemsColumns2 = {
					0:{
						items:1
					},
					479:{
						items:2
					},
					768:{
						items:2
					},
					1200:{
						items:4
					}
				};
				
				
			} else if( jQuery(this).hasClass('thememount-carousel-col-five') ){
				// Four Column
				itemsColumns2 = {
					0:{
						items:1
					},
					479:{
						items:2
					},
					768:{
						items:3
					},
					1200:{
						items:5
					}
				};
				
				
			} else if( jQuery(this).hasClass('thememount-carousel-col-six') ){
				// Four Column
				itemsColumns2 = {
					0:{
						items:1
					},
					479:{
						items:2
					},
					768:{
						items:3
					},
					1200:{
						items:6
					}
				};
				
			} // IF
			
			var owlWrap = jQuery(this);
			
						
			
			// Show/Hide pagination in Owl Carousel
			var paginationOption = false;
			if( jQuery(this).hasClass('thememount-with-pagination') ){
				paginationOption = true;
			}
			
			// checking if the dom element exists
			if (owlWrap.length > 0) {
				// check if plugin is loaded
				if (jQuery().owlCarousel) {
					owlWrap.each(function(){
						var carousel = $(this).find('.thememount-carousel-items-wrapper'),
						navigation   = $(this).find('.thememount-carousel-controls-inner'),
						nextBtn      = navigation.find('a.thememount-carousel-next'),
						prevBtn      = navigation.find('a.thememount-carousel-prev');
						
						/* Options for "Owl Carousel 2"
						 * http://owlcarousel.owlgraphic.com/index.html
						 */
						var rtloption = false;
						if( jQuery('body').hasClass('rtl') ){
							rtloption = true;
						}
						
						
						
						// CAROUSEL OPTIONS
						var val_autoplay        = true;   // default set
						var val_autoplaySpeed   = 800;    // default set
						var val_loop            = false;  // default set
						var val_autoplayTimeout = 4500;   // default set
						var val_animatein       = false;  // default set
						var val_animateout      = false;  // default set
						var val_dots            = false;  // default set
						var val_nav             = false;  // default set
						var val_margin          = 30;     // default set
						var val_pauseonhower    = true;   // default set
						
						if( owlWrap.data('autoplayspeed')!='' ){
							val_autoplaySpeed = jQuery.trim( owlWrap.data('autoplayspeed') );
						}
						if( owlWrap.data('autoplay')=='0' ){
							val_autoplay      = false;
							val_autoplaySpeed = false;
						}
						if( owlWrap.data('loop')=='1' ){
							val_loop = true;
						}
						if( owlWrap.data('autoplaytimeout')!='' ){
							val_autoplayTimeout = jQuery.trim( owlWrap.data('autoplaytimeout') );
						}
						if( owlWrap.data('animatein')!='' && owlWrap.data('animatein')!='none' ){
							val_animatein = jQuery.trim( owlWrap.data('animatein') );
						}
						if( owlWrap.data('animateout')!='' && owlWrap.data('animateout')!='none' ){
							val_animateout = jQuery.trim( owlWrap.data('animateout') );
						}
						if( owlWrap.data('dots')==true ){
							val_dots = true;
						}
						if( owlWrap.data('nav')==true ){
							val_nav = true;
						}
						if( owlWrap.closest('.vc_row').hasClass('vc_row-no-padding') ){
							val_margin = 0;
						}
						if( owlWrap.data('autoplayhoverpause')==false ){
							val_pauseonhower = false;
						}
						
						
						
						jQuery('.thememount-effect-carousel article.portfolio-box').each(function(){
							jQuery(this).removeClass('col-lg-6 col-sm-6 col-md-6 col-xs-12');
						});
						
						

						// Full width
						if( typeof carousel.closest('.main_row').data('vc-full-width') !== "undefined" &&
						    typeof carousel.closest('.main_row').data('vc-stretch-content') !== "undefined" &&
							carousel.closest('.main_row').data('vc-full-width') == true &&
							carousel.closest('.main_row').data('vc-stretch-content') == true &&
							carousel.closest('.main_row').hasClass('vc_row-no-padding')
							
						){
							val_margin = 0;
						}
						// ---- END FULL WIDTH  -----
						
						
						//carousel
						carousel.owlCarousel({
							/* Options for "Owl Carousel 2"
							 * http://owlcarousel.owlgraphic.com/index.html
							 */
							autoplay        : val_autoplay,
							autoplayTimeout : val_autoplayTimeout,
							autoplaySpeed   : val_autoplaySpeed,
							navSpeed        : val_autoplaySpeed,
							dots            : val_dots,
							dotsSpeed       : val_autoplaySpeed,
							//navRewind     : 2000,
							//dotsEach      : 1,
							rtl             : rtloption,
							loop            : val_loop,
							margin          : val_margin,
							nav             : val_nav,
							navText         : [ '<i class="fa fa-angle-double-left"></i>','<i class="fa fa-angle-double-right"></i>' ],
							responsive      : itemsColumns2,
							animateIn       : val_animatein,
							animateOut      : val_animateout,
							autoplayHoverPause : val_pauseonhower,
							baseClass          : "owl-carousel", // base styles
							theme              : "owl-theme" // switch to your own theme
						});

						
						// Custom Navigation Events
						nextBtn.click(function(){
							/* Options for "Owl Carousel 2"
							 * http://owlcarousel.owlgraphic.com/index.html
							 */
							carousel.trigger('next.owl.carousel',[val_autoplaySpeed] );
							return false;
						});
						prevBtn.click(function(){
							/* Options for "Owl Carousel 2"
							 * http://owlcarousel.owlgraphic.com/index.html
							 */
							carousel.trigger('prev.owl.carousel',[val_autoplaySpeed]);
							return false;
						});

						if(val_loop==false){


							carousel.on('changed.owl.carousel', function(event) {
								var newindex = event.item.index + event.page.size;
					
								if( newindex == event.item.count ){
									var totalTimeout = parseInt(val_autoplayTimeout)+parseInt(val_autoplayTimeout);
									setTimeout(function(){
										carousel.trigger('to.owl.carousel', [0,val_autoplaySpeed,val_autoplaySpeed] );
									}, totalTimeout);
									
					
								}
							});

						}
			
					});
				};
			};
		});
	}
	
	/*-----------------------------------------------------------------------------------*/
	/*	Isotope
	/*-----------------------------------------------------------------------------------*/
	var gallery_item = $('.portfolio-wrapper'),
	filterLinks      = $('.portfolio-sortable-list a');



	if( jQuery().isotope ){
		$(window).load(function () {
			digitalLaw_isotope();	
			digitallaw_blogmasonry();		
		});
		$(window).resize(function(){
			digitalLaw_isotope();
		});
	}
	
	/*------------------------------------------------------------------------------*/
	/* Setup Post Likes
	/*------------------------------------------------------------------------------*/
	$('.thememount-portfolio-likes').on('click', function(e){
		e.preventDefault();
		var link = $(this);
		if(link.hasClass('like-active')) return false;
		
		$(this).html('<i class="fa fa-circle-o-notch fa fa-spin"></i>');
		
		var id = $(this).attr('id');

		$.post(ajaxurl, {action: 'thememount-portfolio-likes', likes_id: id}, function(data){
			$( 'i.fa fa-heart-o', link ).removeClass('fa fa-heart-o').addClass('fa fa-heart');
			link.html(data).addClass('like-active');
		});
	});
	
	
	/*------------------------------------------------------------------------------*/
	/* Sticky Footer
	/*------------------------------------------------------------------------------*/
	jQuery('footer#colophon').resize(function(){
		digitallaw_stickyFooter();
	});
	digitallaw_stickyFooter();	
	


	/*------------------------------------------------------------------------------*/
	/* Equal Height Div load
	/*------------------------------------------------------------------------------*/	
	
	
	digitallaw_hide_togle_link();
	
	jQuery( ".thememount-slider-wrapper > div > div:contains('Revolution Slider Error')" ).css( "margin-top", "0" );
	
	/*------------------------------------------------------------------------------*/
	/*  Timeline view
	/*------------------------------------------------------------------------------*/	
	
		$.fn.smTimeline = function( option, value ) {
			jQuery( this ).each( function() {
				var $sm_timeline = jQuery( this );
				
				var is_mobile_view = jQuery( window ).width() < 768;
				$sm_timeline.find( '.timeline-element' ).each( function() {
					var $this = jQuery( this );
					var $timeline_spine = $this.find( '.tm-timeline-spine' );
					if ( is_mobile_view ) {
						$this.addClass( 'wow fadeInUp' );
						$timeline_spine.attr( 'style', '' );
					} else {
						if ( $this.hasClass( 'left-side' ) ) {
							$this.find( '.tm-animation-wrap' ).addClass( 'wow fadeInLeft' );
						} else if ( $this.hasClass( 'right-side' ) ) {
							$this.find( '.tm-animation-wrap' ).addClass( 'wow fadeInRight' );
						}
						
						if ( $this.next().length == 0 ) return;
						var $next = $this.next();
						var $next_tl_spine = $next.find( '.tm-timeline-spine' );
						
						
						
						if ( $next.hasClass( 'tm-date-separator' ) ) {
							$timeline_spine.height( $next.offset().top - $timeline_spine.offset().top - 5 );					
						} else if ( $next_tl_spine.length ) {							
							$timeline_spine.height( $next_tl_spine.offset().top - $timeline_spine.offset().top - 25 );
						} 
					}
				} );
			} );
		}

	
	
	
	
	/*------------------------------------------------------------------------------*/
	/* ROW Equal height : Setting bg image as inline so it will appear in mobile mode
	/*------------------------------------------------------------------------------*/	
	jQuery('.wpb_row').each(function(){

		var thisRow = jQuery(this);		
		if (thisRow.hasClass("tm-equalheightdiv") || thisRow.hasClass("vc_row-o-equal-height")) {		
			jQuery('.wpb_column', thisRow).each(function(){
				var thisColumn = jQuery(this);
				if  (( jQuery(thisColumn).css('background-image') != 'none') && (jQuery(thisColumn).text().trim() == '') ) {
					var bgimage = jQuery(thisColumn).css('background-image').replace('url(','');
					bgimage  = bgimage.replace(')','');					
					jQuery(thisColumn).append('<img src=' + bgimage + ' class="tm-equal-height-image" />');
					jQuery(thisColumn).addClass('tm-emtydiv');
				}
			});
		}
	});
	
	
	/*------------------------------------------------------------------------------*/
	/* Search page 
	/*------------------------------------------------------------------------------*/	
	jQuery('.tm-sresult-form-wrapper .tm-sresults-settings-btn').click(function(){
		jQuery('.tm-sresult-form-wrapper .tm-sresult-form-bottom').slideToggle('400',function(){
			if( jQuery('.tm-sresult-form-wrapper .tm-sresult-form-bottom').is(":hidden") ){
				jQuery('.tm-sresult-form-wrapper .tm-sresults-settings-btn').removeClass('tm-sresult-btn-active');
			} else {
				jQuery('.tm-sresult-form-wrapper .tm-sresults-settings-btn').addClass('tm-sresult-btn-active');
			}
		});
		return false;
	});
	
	// Check if post_type input is available or not
	if(jQuery('.tm-sresult-form-wrapper form.search-form').length > 0 ){
		if( jQuery(".tm-sresult-form-wrapper form.search-form input[name='post_type']").length==0 ){
		
			jQuery('<input>').attr({
				type : 'hidden',
				name : 'post_type'
			}).appendTo('.tm-sresult-form-wrapper form.search-form');
		}
	}
	
	// On change of the CPT dropdown
	jQuery(".tm-sresult-form-wrapper .tm-sresult-cpt-select").change(function(){
		jQuery(".tm-sresult-form-wrapper form.search-form input[name='post_type']").val( jQuery(this).val() );
	});
	
	// Submit the form
	jQuery(".tm-sresult-form-wrapper .tm-sresult-form-sbtbtn").click(function(){
		jQuery(".tm-sresult-form-wrapper form.search-form").submit();
	});
	
	
	
	
	
} ); // END of  document.ready





jQuery(window).load(function(){

	"use strict";	
	
	/*------------------------------------------------------------------------------*/
	/* Adding fancy scrollbar
	/*------------------------------------------------------------------------------*/
	jQuery(".thememount-fbar-position-right .thememount-fbar-box").mCustomScrollbar();
	
	
	
	/*------------------------------------------------------------------------------*/
	/* Team Member overlay - setting content height
	/*------------------------------------------------------------------------------*/
	digitallaw_set_team_overlay_content();
	
	
	
	/*------------------------------------------------------------------------------*/
	/* Footer height get for cross shape 
	/*------------------------------------------------------------------------------*/
	digitallaw_setcross();		
	
	// Timeline view function
	if ( jQuery( '.tm-timeline' ).length > 0 ) {
		jQuery( '.tm-timeline' ).smTimeline();
	}
	
	/*------------------------------------------------------------------------------*/
	/* Woocommerce comparelist pop up h1 tag add class
	/*------------------------------------------------------------------------------*/
	
	jQuery('.compare-list').prev().css("color", "#fff");
	/*------------------------------------------------------------------------------*/
	/* Hide page-loader on load.
	/*------------------------------------------------------------------------------*/
	jQuery('#pageoverlay').fadeOut(500);
	
	
	
	/*------------------------------------------------------------------------------*/
	/* IsoTope
	/*------------------------------------------------------------------------------*/
	var $container = jQuery('.portfolio-wrapper');
	$container.isotope({
		filter: '*',
		animationOptions: {
			duration: 750,
			easing: 'linear',
			queue: false,
		}
	});
	jQuery('nav.portfolio-sortable-list ul li a').click(function(){
		var selector = jQuery(this).attr('data-filter');
		$container.isotope({
			filter: selector,
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false,
			}
		});
		// Selected class
		jQuery('nav.portfolio-sortable-list').find('a.selected').removeClass('selected');
		jQuery(this).addClass('selected'); 
		return false;
	});
	
	
	
	
	/*------------------------------------------------------------------------------*/
	/* Flex Slider
	/*------------------------------------------------------------------------------*/
	if( jQuery('.thememount-blog-media.thememount-slider-wrapper .flexslider').length > 0 ){
		jQuery('.thememount-blog-media.thememount-slider-wrapper .flexslider').flexslider({
			animation   : "slide",
			controlNav  : true,
			directionNav: false,
			start: function(){
				digitallaw_blogmasonry();
				if ( jQuery( '.tm-timeline' ).length > 0 ) { jQuery( '.tm-timeline' ).smTimeline(); console.log('Calling after flex'); }
			}
		});
	}
	/* Depreceated - Now we are adding JS code directly on page below the slider */
	
	


	 
	/*------------------------------------------------------------------------------*/
	/* Enables menu toggle for small screens.
	/*------------------------------------------------------------------------------*/ 
	 
	( function() {
		var nav = jQuery( '#site-navigation' ), button, menu;
		if ( ! nav )
			return;

		button = nav.find( '.menu-toggle' );
		if ( ! button )
			return;

		// Hide button if menu is missing or empty.
		menu = nav.find( '.nav-menu' );
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}

		jQuery( '.menu-toggle' ).on( 'click.digitallaw', function() {
			nav.toggleClass( 'toggled-on' );
		} );
	} )();	
	
	
	
	/*------------------------------------------------------------------------------*/
	/* Responsive Menu
	/*------------------------------------------------------------------------------*/
	jQuery('.righticon').click(function() {
		if(jQuery(this).siblings('.sub-menu, .children, .mega-sub-menu').hasClass('open')){
			jQuery(this).siblings('.sub-menu, .children, .mega-sub-menu').removeClass('open');
			jQuery( 'i', jQuery(this) ).removeClass('fa fa-minus-square').addClass('fa fa-plus-square');
		} else {
			jQuery(this).siblings('.sub-menu, .children, .mega-sub-menu').addClass('open');
			jQuery( 'i', jQuery(this) ).removeClass('fa fa-plus-square').addClass('fa fa-minus-square');
		}
		return false;
 	});
	
	/*------------------------------------------------------------------------------*/
	/*  Testimonial  height load
	/*------------------------------------------------------------------------------*/	

	if( jQuery('.thememount-testimonial-box' ).length > 0 ){
		digitallaw_setHeight('.thememount-testimonial-box.col-lg-4.col-sm-6.col-md-4');
		digitallaw_setHeight('.thememount-testimonial-box.col-lg-6.col-sm-6.col-md-6');
		digitallaw_setHeight('.thememount-testimonial-box.col-lg-3.col-sm-6.col-md-3');
	}
	
	/*------------------------------------------------------------------------------*/
	/* Equal Height Div load
	/*------------------------------------------------------------------------------*/	
	digitallaw_equal_height();
	jQuery(window).resize(function() { digitallaw_equal_height(); });

	
	
	
	/*------------------------------------------------------------------------------*/
	/* Responsive Menu : Open by clicking on the menu text too
	/*------------------------------------------------------------------------------*/
	jQuery('.righticon').each(function() {
		var mainele = this;
		if( jQuery( mainele ).prev().prev().length > 0 ){
			if( jQuery( mainele ).prev().prev().attr('href')=='#' ){
				jQuery( mainele ).prev().prev().click(function(){
					jQuery( mainele ).trigger( "click" );
				});
			}
		}
	});
	
	
	
	/*------------------------------------------------------------------------------*/
	/* Blog masonry view for 2, 3 and 4 columns
	/*------------------------------------------------------------------------------*/
	digitallaw_blogmasonry();
	
	
	
	/*------------------------------------------------------------------------------*/
	/* Hide pre-loader
	/*------------------------------------------------------------------------------*/
	function digitallaw_preloader_fade_out(){ jQuery( '.tm-page-loader-wrapper' ).fadeOut( 1000 ); }
	if ( jQuery( '.tm-page-loader-wrapper' ).length > 0 ) {
		setTimeout(digitallaw_preloader_fade_out, 100);


		
	}
	

}); // END of window.load




jQuery(window).resize(function() {
	
	
	digitallaw_setcross();
	
	
	/*------------------------------------------------------------------------------*/
	/* Team Member overlay - setting content height
	/*------------------------------------------------------------------------------*/
	digitallaw_set_team_overlay_content();
	
	
	/*------------------------------------------------------------------------------*/
	/*  Testimonial  height load
	/*------------------------------------------------------------------------------*/	
	
	if( jQuery('.thememount-testimonial-box' ).length > 0 ){
		digitallaw_setHeight('.thememount-testimonial-box.col-lg-4.col-sm-6.col-md-4');
		digitallaw_setHeight('.thememount-testimonial-box.col-lg-6.col-sm-6.col-md-6');
		digitallaw_setHeight('.thememount-testimonial-box.col-lg-3.col-sm-6.col-md-3');
	}
	
	
	/*------------------------------------------------------------------------------*/
	/*  Timeline view
	/*------------------------------------------------------------------------------*/	
	
	setTimeout(function() {
		jQuery( '.tm-timeline' ).smTimeline();
	}, 100);
	
	
	
	/*------------------------------------------------------------------------------*/
	/* Unstick the sticky
	/*------------------------------------------------------------------------------*/
	digitallaw_sticky();
	
	
	
	/*------------------------------------------------------------------------------*/
	/* Change right position of floating bar
	/*------------------------------------------------------------------------------*/
	digitallaw_fbar_right_position();
	
	
});  // END of window.resize




function digitallaw_fbar_right_position(){
	var ele = jQuery('.thememount-fbar-position-right .thememount-fbar-box-w');
	if (ele.hasClass('visible')){
		ele.css({"right":"0"});
	} else {
		
		if (jQuery(window).width() < 479){
			ele.css({"right":"-280px"});
		}else{
			ele.css({"right":"-386px"});
		}
	}
	
}





/**
 *  Revolution Slider - change menu text color in header when slide color is black/white
 *
 *  make the header content to white color like menu link etc. Basically we will add class in the header wrapper
 *  class: kwayy-make-header-white
 *  class: kwayy-make-header-dark
 */

function digitallaw_change_header_color( currentslide, prevslide, whitelogo, darklogo ){
	
	whitelogo = whitelogo || '' ;
	darklogo  = darklogo || '' ;
	
	
	var originallogo = jQuery('img.thememount-logo-img.standardlogo').attr('src');
	
	
	// Set white color
	if( jQuery(prevslide).hasClass('kwayy-make-header-white') && jQuery(currentslide).hasClass('kwayy-make-header-white') ){
		// don't do anything as white header is already set via prev slide
	} else if( jQuery(currentslide).hasClass('kwayy-make-header-white') ){
		digitallaw_make_header_to_white( whitelogo );
	}
	
	// set dark color
	if( jQuery(prevslide).hasClass('kwayy-make-header-dark') && jQuery(currentslide).hasClass('kwayy-make-header-dark') ){
		// don't do anything as dark header is already set via prev slide
	} else if( jQuery(currentslide).hasClass('kwayy-make-header-dark') ){
		digitallaw_make_header_to_dark( darklogo );
	}
	
	// Remove both colors
	if( jQuery(currentslide).hasClass('kwayy-make-header-white')==false && jQuery(currentslide).hasClass('kwayy-make-header-dark')==false ){
		digitallaw_make_header_to_default( originallogo );
	}
	
}




function digitallaw_make_header_to_white( whitelogo ){
	jQuery('#stickable-header').removeClass('kwayy-header-dark').addClass('kwayy-header-white');
	if( whitelogo!=''){ 
		jQuery('img.thememount-logo-img.standardlogo').attr('src',whitelogo);
	}
}

function digitallaw_make_header_to_dark( darklogo ){
	jQuery('#stickable-header').removeClass('kwayy-header-white').addClass('kwayy-header-dark');
	if( darklogo!=''){
		jQuery('img.thememount-logo-img.standardlogo').attr('src',darklogo);
	}
}

function digitallaw_make_header_to_default( originallogo ){
	
	jQuery('#stickable-header').removeClass('kwayy-header-white').removeClass('kwayy-header-dark');
	if( jQuery('img.thememount-logo-img.standardlogo').attr('src') != originallogo ){
		jQuery('img.thememount-logo-img.standardlogo').attr('src',originallogo);
	}
}




function digitallaw_equal_height(){
	jQuery('[data-equal-height-columns="yes"], .tm-equalheightdiv').each(function() {
		var e = ".wpb_column",
		n = jQuery(this).find(e).first(),
		i = n.parent(),
		t = i.children(e);
		
		t.matchHeight()
	});
}



function digitallaw_menu_js_code(){
	if (document.getElementById('mega-menu-wrap-primary')) {
		var menu_toggle = document.getElementsByClassName('menu-toggle');
		menu_toggle[0].style.display = 'none';
	}
}

/*------------------------------------------------------------------------------*/
/* RTL layout support
/*------------------------------------------------------------------------------*/
function digitallaw_rtl_support(){
if( jQuery('body').hasClass('rtl') ){
	jQuery('.vc_row').each(function() {
		if( jQuery(this).css('left') != '' ){
			var left = jQuery(this).css('left');
			jQuery(this).css('left','');
			jQuery(this).css('right', left);
		}
	});
}
}

function digitallaw_rtl_support_callback(){
	setTimeout(digitallaw_rtl_support, 100);
}

jQuery(window).resize(function() { digitallaw_rtl_support(); });
jQuery(window).load(function() { digitallaw_rtl_support_callback(); });
/*********************************************************************************/

