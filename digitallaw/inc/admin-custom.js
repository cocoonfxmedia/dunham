/**
 * Functionality specific to Innovation admin panel.
 *
 * Provides helper functions to enhance the admin experience.
 */

 
 
 
jQuery( document ).ready(function() {
	"use strict";
	
	
	
	// Dark Layout: On change event
	jQuery('#layout_type-select').change(function(data){
		if( data.val!=undefined ){
			var tm_val = data.val;
		} else {
			var tm_val = jQuery('#layout_type-select').val();
		}
		tm_layout_type_switcher(tm_val);
	});
	
	
	
	// Redux: Remove extra message
	jQuery('.updated.notice:contains("Redux Framework has an embedded demo")').hide();
	
	
	// Redux: Remove loader on document.ready
	jQuery(".redux-main").css('background','#FCFCFC');
	
	// Redux: Add class for special option
	jQuery( '.redux-container-thememount_one_click_demo_content' ).parent().parent().addClass('thememount-special-toption');
	
	// Disable to un-check the FontAwesome library
	jQuery("#innovation_fonticonlibrary_fontawesome_0").attr("disabled","true");
	jQuery("#innovation_fonticonlibrary_fontawesome_0").prop('checked', true);
	
	// Redux: Adding thumb images for background gradient patterns
	var html = '<div class="thememount-bg-pattern-wrapper"> \
	<ul> \
	<li class="thememount-bg-pattern-1"><a href="#"></a></li> \
	<li class="thememount-bg-pattern-2"><a href="#"></a></li> \
	<li class="thememount-bg-pattern-3"><a href="#"></a></li> \
	<li class="thememount-bg-pattern-4"><a href="#"></a></li> \
	<li class="thememount-bg-pattern-5"><a href="#"></a></li> \
	<li class="thememount-bg-pattern-6"><a href="#"></a></li> \
	<li class="thememount-bg-pattern-7"><a href="#"></a></li> \
	<li class="thememount-bg-pattern-8"><a href="#"></a></li> \
	<li class="thememount-bg-pattern-9"><a href="#"></a></li> \
	<li class="thememount-bg-pattern-10"><a href="#"></a></li> \
	</ul> \
	</div>';
	jQuery("#opt-background-position-select").after(html);
	
	
	
	
	jQuery(".thememount-bg-pattern-wrapper li a").click(function(){
		var Class = jQuery(this).parent().attr('class');
		var number = Class.replace('thememount-bg-pattern-','');
		console.log(number);
		return false;
	});
	
	
	// Remove extra BR tag from sidebar option on pages
	var sliderPosWrapper = jQuery('#_thememount_page_options_sidebarposition_').parent();
	jQuery("br", sliderPosWrapper).remove();
	
	// Set width of sidebar options
	jQuery('#_thememount_page_options_sidebarposition_').parent().attr('id', 'thememount_page_options_sidebarposition_wrapper');
	
	
	
	// Icon dropdown in menu
	if( typeof jQuery.fn.custom_select2 == "function" ){
		jQuery("select.edit-menu-item-icon").custom_select2(); 
	}
	jQuery('a.item-edit').on("click",function(){
		jQuery("select.edit-menu-item-icon").custom_select2(); 
	});
	
	// Skin Color picker
	if( jQuery('.redux-container-digitallaw_skin_color .redux-color').length > 0 ){
		jQuery('.redux-container-digitallaw_skin_color .redux-color').wpColorPicker();
	}
	
	// Page Options
	thememount_pages_slder_options();
	thememount_post_hide_breadcrumb_options('page');
	jQuery('input[name="cuztom[_thememount_page_options_slidertype][]"]:radio').change(function(e) {
		thememount_pages_slder_options();
	});
	jQuery('input[name="cuztom[_thememount_page_options_hidetitlebar]"], select[name="cuztom[_thememount_page_options_titlebar_bg_color]"], select[name="cuztom[_thememount_page_options_titlebar_text_color]"]').change(function(e) {
		thememount_post_hide_breadcrumb_options('page');
		console.log('Hi');
	});
	
	thememount_pages_topbar_bgcolor_options();
	jQuery('select[name="cuztom[_thememount_page_options_topbarbgcolor]"]').change(function(e) {
		thememount_pages_topbar_bgcolor_options();
	});
	
	thememount_pages_topbar_textcolor_options();
	jQuery('select[name="cuztom[_thememount_page_options_topbartextcolor]"]').change(function(e) {
		thememount_pages_topbar_textcolor_options();
	});
	
	
	// Post Options
	thememount_post_hide_breadcrumb_options('post');
	jQuery('input[name="cuztom[_thememount_post_options_hidetitlebar]"], select[name="cuztom[_thememount_post_options_titlebar_bg_color]"], select[name="cuztom[_thememount_post_options_titlebar_text_color]"]').change(function(e) {
		thememount_post_hide_breadcrumb_options('post');
	});
	
	
	// Page Titlebar: Background Image
	jQuery('select[name="cuztom[_thememount_page_options_titlebar_bg_image]"]').change(function(e){
		thememount_breadcrumb_image_option('page');
	});
	jQuery('select[name="cuztom[_thememount_post_options_titlebar_bg_image]"]').change(function(e){
		thememount_breadcrumb_image_option('post');
	});
	
	
	// Post Options - Breadcrumb
	thememount_post_hide_breadcrumb_options('post');
	jQuery('input[name="cuztom[_thememount_post_options_hidetitlebar]"]').change(function(e) {
		thememount_post_hide_breadcrumb_options('post');
	});
	
	// Skin Selector
	if( jQuery('.thememount-skin-color-list').length != 0 ){
		jQuery( '.thememount-skin-color-list a' ).click(function() {
			var color = jQuery(this).css('background-color');
			jQuery('.redux-container-digitallaw_skin_color .redux-color-init').iris('color', color);
			return false;
		});
	}
	
	
	
	// Increase or decrease Header height on click of the Header icons
	
	jQuery('fieldset[data-id="headerstyle"] .redux-image-select img').click(function(){
		var normalHeight  = '300';
		var overlayHeight = '500';
		
		var headerID = jQuery(this).parent().attr('for');
		headerID     = headerID.replace('headerstyle_','');
		
		if( (headerID=='1' || headerID=='2' || headerID=='3' || headerID=='4' || headerID=='8') ){
			jQuery('div[data-id="tbar-height"]').val(normalHeight);
			jQuery('#tbar-height').val(normalHeight);  // Fallback mode
		} else if( (headerID=='5' || headerID=='6' || headerID=='7' || headerID=='9' || headerID=='10' || headerID=='11') ){
			jQuery('div[data-id="tbar-height"]').val(overlayHeight);
			jQuery('#tbar-height').val(overlayHeight);  // Fallback mode
		}
	});

});



/* Dark or White layout switcher based on Layout Type dropdown selection */
function tm_layout_type_switcher(type){
	// WP color pickers
	var tm_color_picker_array       = [
		"skincolor-color",
		"general_font-color",
		"link-color-regular",
		"link-color-hover",
		"h1_heading_font-color",
		"h2_heading_font-color",
		"h3_heading_font-color",
		"h4_heading_font-color",
		"h5_heading_font-color",
		"h6_heading_font-color",
		"heading_font-color",
		"subheading_font-color",
		"widget_font-color",
		"topbarbgcustomcolor-color",
		"menubgcolor-color",
		"mainmenufont-color",
		"stickymainmenufontcolor-color",
		"dropmenu_background-color",
		"headerbgcolor-color",
		"stickyheaderbgcolor-color",
		"content_background-color"
	];
	
	var tm_color_picker_array_white = [
		/* skincolor-color: */ "#9dc02e",
		/* general_font-color: */ "#838383",
		/* link-color-regular: */ "#2d2d2d",
		/* link-color-hover: */ "#9dc02e",
		/* h1_heading_font-color: */ "#2c2c2c",
		/* h2_heading_font-color: */ "#2c2c2c",
		/* h3_heading_font-color: */ "#2c2c2c",
		/* h4_heading_font-color: */ "#2c2c2c",
		/* h5_heading_font-color: */ "#2c2c2c",
		/* h6_heading_font-color: */ "#2c2c2c",
		/* heading_font-color: */ "#2c2c2c",
		/* subheading_font-color: */ "#838383",
		/* widget_font-color: */ "#0c0c0c",
		/* topbarbgcustomcolor-color: */ "#303030",
		/* menubgcolor-color: */ "#f3f3f3",
		/* mainmenufont-color: */ "#222222",
		/* stickymainmenufontcolor-color: */ "#222222",
		/* dropmenu_background-color: */ "#222222",
		/* headerbgcolor-color: */ "#222222",
		/* stickyheaderbgcolor-color: */ "#222222",
		/* content_background-color: */ "#ffffff"
	];
	
	var tm_color_picker_array_dark  = [
		/* skincolor-color: */ "#e5ba5b",
		/* general_font-color: */ "#aaaaaa",
		/* link-color-regular: */ "#ffffff",
		/* link-color-hover: */ "#e5ba5b",
		/* h1_heading_font-color: */ "#ffffff",
		/* h2_heading_font-color: */ "#ffffff",
		/* h3_heading_font-color: */ "#ffffff",
		/* h4_heading_font-color: */ "#ffffff",
		/* h5_heading_font-color: */ "#ffffff",
		/* h6_heading_font-color: */ "#ffffff",
		/* heading_font-color: */ "#ffffff",
		/* subheading_font-color: */ "#e8e8e8",
		/* widget_font-color: */ "#ffffff",
		/* topbarbgcustomcolor-color: */ "#303030",
		/* menubgcolor-color: */ "#1c1c1c",
		/* mainmenufont-color: */ "#ffffff",
		/* stickymainmenufontcolor-color: */ "#ffffff",
		/* dropmenu_background-color: */ "#303030",
		/* headerbgcolor-color: */ "#ff0000",
		/* stickyheaderbgcolor-color: */ "#00ff00",
		/* content_background-color: */ "#222222"
		
	];
	
	
	if( type=='dark' ){ // DARK layout selected
		var tm_color_picker_values = tm_color_picker_array_dark;
	} else {  // WHITE layout selected
		var tm_color_picker_values = tm_color_picker_array_white;
	}
	
	
	
	
	
	jQuery.each(tm_color_picker_array, function( index, value ) {
		
		value = '#' + value;
		var color = tm_color_picker_values[index];
		
			
		if( value=='#headerbgcolor-color' || value=='#stickyheaderbgcolor-color' ){
			
			// Setting spectrum bg color options
			thememount_set_header_bg_colors(false);
	
		} else {
			console.log( value );
			if( value=='#dropmenu_background-color' ){
				console.log( '-- '+ jQuery(value).val() );
			}
			// Iris color picker
			if( jQuery(value).hasClass('wp-color-picker') ){
				jQuery(value).wpColorPicker( 'color', color );
			} else {
				jQuery(value).val( color );
			}
		}
		
		
	});
	
	
	// now changing dropdown
	if( jQuery("#topbarbgcolor-select").css('display')=='none' ){
		jQuery("#topbarbgcolor-select").select2("val", "custom"); //set the value
	} else {
		jQuery("#topbarbgcolor-select").val("custom"); //set the value
	}
	

}




function thememount_set_header_bg_colors( applyOnAll ){
	
	var tm_element_id_array     = [ "headerbgcolor-color", "stickyheaderbgcolor-color" ];
	var tm_white_color_value    = [ /* headerbgcolor-color: */ "#ffffff", /* stickyheaderbgcolor-color */ "#ffffff" ];
	var tm_dark_color_value     = [ /* headerbgcolor-color: */ "#222222", /* stickyheaderbgcolor-color */ "#222222" ];
	var tm_overlay_color_value  = [ /* headerbgcolor-color: */ "rgba(0, 0, 0, 0.2)", /* stickyheaderbgcolor-color */ "#222222" ];
	
	var layout_type = jQuery('#layout_type-select').val();
	var header_style = jQuery( 'input[name="digitallaw_theme_options[headerstyle]"]:checked').val();
	
	
	if( layout_type=='dark' ){ // DARK layout selected
		var tm_color_picker_values = tm_dark_color_value;
	} else {  // WHITE layout selected
		var tm_color_picker_values = tm_white_color_value;
	}
	
	
	
	if( applyOnAll==true ){
		console.log('222');
		
			if( header_style=='4' || header_style=='5' || header_style=='10' || header_style=='13' ){
				console.log('333');
				tm_color_picker_values = tm_overlay_color_value;
			}
			
			jQuery.each(tm_element_id_array, function( index, value ) {
				
				// getting value and id of element
				value = '#' + value;
				var color = tm_color_picker_values[index];
				
				// Convering all color to their specific format
				if( thememount_checkIfRGBA(color) ){
					var color_rgba  = color;
					var color_alpha = thememount_getOpacityFromRGBA( color );
					var color_hex   = thememount_rgbToHex( color );
				} else {
					var color_rgba  = thememount_hexToRgb( color );
					var color_alpha = thememount_getOpacityFromRGBA( thememount_hexToRgb( color ) );
					var color_hex   = color;
				}
				
				var value_sliced = value.slice(0,-6);
				var value_alpha  = value_sliced + '-alpha';
				var value_rgba   = value_sliced + '-rgba';
				
				jQuery('input'+value).val(color_hex);
				jQuery('input'+value_alpha).val( color_alpha );
				jQuery('input'+value_rgba).val( color_rgba );
				
				jQuery(value).data( 'color', color_rgba );
				jQuery(value).data( 'current-color', color_hex );

				
				// Spectrum color picker
				if( jQuery(value).css('display')=='none' ){
					jQuery(value).spectrum("set", color );
				}
				
			});
		
	} else {
		
		if( header_style!='4' && header_style!='5' && header_style!='10' && header_style!='13' ){
			jQuery.each(tm_element_id_array, function( index, value ) {
				/*
				value = '#' + value;
				var color = tm_color_picker_values[index];
			
				// Spectrum color picker
				if( jQuery(value).css('display')=='none' ){
					jQuery(value).spectrum("set", color );
				} else {
					jQuery(value).val( color );
					jQuery(value).data( 'color', thememount_hexToRgb(color) );
					jQuery(value).data( 'current-color', color );
				}
				*/
				
				// getting value and id of element
				value = '#' + value;
				var color = tm_color_picker_values[index];
				
				// Convering all color to their specific format
				if( thememount_checkIfRGBA(color) ){
					var color_rgba  = color;
					var color_alpha = thememount_getOpacityFromRGBA( color );
					var color_hex   = thememount_rgbToHex( color );
				} else {
					var color_rgba  = thememount_hexToRgb( color );
					var color_alpha = thememount_getOpacityFromRGBA( thememount_hexToRgb( color ) );
					var color_hex   = color;
				}
				
				var value_sliced = value.slice(0,-6);
				var value_alpha  = value_sliced + '-alpha';
				var value_rgba   = value_sliced + '-rgba';
				
				jQuery('input'+value).val(color_hex);
				jQuery('input'+value_alpha).val( color_alpha );
				jQuery('input'+value_rgba).val( color_rgba );
				
				jQuery(value).data( 'color', color_rgba );
				jQuery(value).data( 'current-color', color_hex );

				
				// Spectrum color picker
				if( jQuery(value).css('display')=='none' ){
					jQuery(value).spectrum("set", color );
				}
				
			});
		
		}
		
		
	}
	
	
	
	
}




function thememount_checkIfRGBA( color ){
	var starting = color.slice(0,3);
	if( starting == 'rgb' ){
		return true;
	} else {
		return false;
	}
}


function thememount_getOpacityFromRGBA(color_rgba) {
	console.log('color_rgba '+color_rgba);
	var return_data = color_rgba.replace(/^.*,(.+)\)/,'$1');
	return return_data;
}



/* HEX to RGB converter */
function thememount_hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    var return_result = result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
	
	if( return_result != null ){
		console.log('return_result: '+return_result);
		return 'rgba('+ return_result.r +','+ return_result.g +','+ return_result.b +',1)';
	}
	
}


/* RGB to HEX converter */
function thememount_rgbToHex( rgb ) {
	rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
	return (rgb && rgb.length === 4) ? "#" +
	("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
	("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
	("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
}



/* Options show/hide for Post Type: Pages */
function thememount_pages_slder_options(){
	selected = jQuery('input[name="cuztom[_thememount_page_options_slidertype][]"]:checked').val();
		
	// Hide all options by default
	jQuery('select[name="cuztom[_thememount_page_options_revslider_slider]"]').parent().parent().hide();
	jQuery('select[name="cuztom[_thememount_page_options_slidercat]"]').parent().parent().hide();
	jQuery('input[name="cuztom[_thememount_page_options_slidersize][]"]').parent().parent().parent().hide();
	jQuery('textarea[name="cuztom[_thememount_page_options_slideroptions]"]').parent().parent().hide();
	if( selected == 'revslider' ){
		jQuery('select[name="cuztom[_thememount_page_options_revslider_slider]"]').parent().parent().show();
		jQuery('select[name="cuztom[_thememount_page_options_slidercat]"]').parent().parent().hide();
		jQuery('input[name="cuztom[_thememount_page_options_slidersize][]"]').parent().parent().parent().show();
		jQuery('textarea[name="cuztom[_thememount_page_options_slideroptions]"]').parent().parent().hide();
	} else if( selected == 'nivo' || selected == 'flex' ){
		jQuery('select[name="cuztom[_thememount_page_options_revslider_slider]"]').parent().parent().hide();
		jQuery('select[name="cuztom[_thememount_page_options_slidercat]"]').parent().parent().show();
		jQuery('input[name="cuztom[_thememount_page_options_slidersize][]"]').parent().parent().parent().show();
		jQuery('textarea[name="cuztom[_thememount_page_options_slideroptions]"]').parent().parent().show();
	}
}




// Show custom bg color picker only when the pre color dropdown is set to Custom Color
function thememount_pages_topbar_bgcolor_options(){
	jQuery('label[for="_thememount_page_options_topbarbgcustomcolor"]').parent().parent().hide();
	var selected = jQuery('select[name="cuztom[_thememount_page_options_topbarbgcolor]"]').val();
	if( selected == 'custom' ){
		jQuery('label[for="_thememount_page_options_topbarbgcustomcolor"]').parent().parent().show();
	}
}




// Show custom text color picker only when the text color dropdown is set to Custom Color
function thememount_pages_topbar_textcolor_options(){
	jQuery('label[for="_thememount_page_options_topbartextcustomcolor"]').parent().parent().hide();
	var selected = jQuery('select[name="cuztom[_thememount_page_options_topbartextcolor]"]').val();
	if( selected == 'custom' ){
		jQuery('label[for="_thememount_page_options_topbartextcustomcolor"]').parent().parent().show();
	}
}


jQuery(window).load(function(){
	// Showing image upload box on LOAD
	if( jQuery('#cf-post-format-tabs > ul > li > a.current').attr('href')=='#post-format-gallery' ){
		jQuery('#thememount_post_gallery').show();
	} else {
		jQuery('#thememount_post_gallery').hide();
	}
	
	// Showing image uppload box on CLICK
	jQuery('#cf-post-format-tabs > ul > li > a').click(function(){
		if( jQuery(this).attr('href') == '#post-format-gallery' ){
			jQuery('#thememount_post_gallery').show();
		} else {
			jQuery('#thememount_post_gallery').hide();
		}
	});
	
});



/* POST: Hide Breadcrumb options */
function thememount_post_hide_breadcrumb_options( postType ){
	if( postType=='undefined' ){
		postType = 'page';
	}
	
	if( jQuery('input[name="cuztom[_thememount_'+postType+'_options_hidetitlebar]"]').length > 0 ){
		
		optionsArray = [
			'titlebar_view',
			'title',
			'subtitle',
			'hidebreadcrumb',
			'titlebar_bg_color',
			'titlebar_bg_custom_color',
			'titlebar_text_color',
			'titlebar_text_custom_color',
			'titlebar_bg_custom_image'
		];
		
		if( jQuery('input[name="cuztom[_thememount_'+postType+'_options_hidetitlebar]"]').is(':checked') ){
			jQuery.each(optionsArray, function( index, value ) {
				// Hide all
				jQuery('#_thememount_'+postType+'_options_'+value).closest( "tr" ).hide();
			});
			
			
		} else {
			
			jQuery.each(optionsArray, function( index, value ) {
				// Show all
				jQuery('#_thememount_'+postType+'_options_'+value).closest( "tr" ).show();
			});
			
			// Titlebar BG color
			if( jQuery('#_thememount_'+postType+'_options_titlebar_bg_color option:selected').val()=='custom' ){
				jQuery('#_thememount_'+postType+'_options_titlebar_bg_custom_color').closest( "tr" ).show();
			} else {
				jQuery('#_thememount_'+postType+'_options_titlebar_bg_custom_color').closest( "tr" ).hide();
			}
			
			// Titlebar text color
			if( jQuery('#_thememount_'+postType+'_options_titlebar_text_color option:selected').val()=='custom' ){
				jQuery('#_thememount_'+postType+'_options_titlebar_text_custom_color').closest( "tr" ).show();
			} else {
				jQuery('#_thememount_'+postType+'_options_titlebar_text_custom_color').closest( "tr" ).hide();
			}
		}
	}
}


function thememount_breadcrumb_image_option(postType){
	// Custom Background image for Titlebar
	if( jQuery('select[name="cuztom[_thememount_'+postType+'_options_titlebar_bg_image]"]').length > 0 ){
		if( jQuery('select[name="cuztom[_thememount_'+postType+'_options_titlebar_bg_image]"]').val() == 'custom' ){
			jQuery('input[name="cuztom[_thememount_'+postType+'_options_titlebar_bg_image_custom]"]').closest( "tr" ).show();
		} else {
			jQuery('input[name="cuztom[_thememount_'+postType+'_options_titlebar_bg_image_custom]"]').closest( "tr" ).hide();
		}
	}
}





function thememount_headerstyle_click(){
	
	
	// Overlay header click event.. change Header bg color on click
	var headerbg_curr_value 	  = [];
	var stickyheaderbg_curr_value = [];
	var menu_curr_value           = '';
	var sticky_menu_curr_value    = '';
	
	jQuery( '#digitallaw_theme_options-headerstyle li' ).click(function(){
		
		thememount_set_header_bg_colors(true);
		
		/*
		// storing original color
		if( headerbg_curr_value=='' ){
			headerbg_curr_value.push(jQuery("input[id='headerbgcolor-color']:hidden").val());
			headerbg_curr_value.push(jQuery("input[id='headerbgcolor-alpha']:hidden").val());
			headerbg_curr_value.push(jQuery("input[id='headerbgcolor-rgba']:hidden").val());
		}
		if( stickyheaderbg_curr_value=='' ){
			stickyheaderbg_curr_value.push(jQuery("input[id='stickyheaderbgcolor-color']:hidden").val());
			stickyheaderbg_curr_value.push(jQuery("input[id='stickyheaderbgcolor-alpha']:hidden").val());
			stickyheaderbg_curr_value.push(jQuery("input[id='stickyheaderbgcolor-rgba']:hidden").val());
		}
		if( menu_curr_value=='' ){
			
			if(jQuery('#mainmenufont-color').hasClass('wp-color-picker') == true){
				menu_curr_value = jQuery('#mainmenufont-color').iris('color');
			}else{
				menu_curr_value = jQuery('#mainmenufont-color').val();
			}
			
		}
		if( sticky_menu_curr_value=='' ){
			
			if(jQuery('#stickymainmenufontcolor-color').hasClass('wp-color-picker') == true){
				sticky_menu_curr_value = jQuery('#stickymainmenufontcolor-color').iris('color');
			}else{
				sticky_menu_curr_value = jQuery('#stickymainmenufontcolor-color').val();
			}
			
		}
		
		// Now changing headerbgcolor only for selected headers
		if(
			jQuery('label', this).hasClass('headerstyle_5')
			|| jQuery('label', this).hasClass('headerstyle_6')
			|| jQuery('label', this).hasClass('headerstyle_7')
			|| jQuery('label', this).hasClass('headerstyle_9')
		){
			//header bg color
			jQuery("input[id='headerbgcolor-color']:hidden").val('#000000');
			jQuery("input[id='headerbgcolor-alpha']:hidden").val('0.2');
			jQuery("#headerbgcolor-rgba").val('rgba(0,0,0,0.2)' );
			jQuery("#headerbgcolor-color").spectrum("set", 'rgba(0,0,0,0.2)' );
			
			//sticky header bg color
			jQuery("input[id='stickyheaderbgcolor-color']:hidden").val('#222222');
			jQuery("input[id='stickyheaderbgcolor-alpha']:hidden").val('1');
			jQuery("#stickyheaderbgcolor-rgba").val('rgba(34,34,34,1)' );
			jQuery("#stickyheaderbgcolor-color").spectrum("set", 'rgba(34,34,34,1)' );
			
			// main menu font color
			if(jQuery('#mainmenufont-color').hasClass('wp-color-picker') == true){
				jQuery('#mainmenufont-color').iris('color', '#ffffff');
			}else{
				jQuery('#mainmenufont-color').val('#ffffff');
			}
			
			// sticky menu font color
			if(jQuery('#stickymainmenufontcolor-color').hasClass('wp-color-picker') == true){
				jQuery('#stickymainmenufontcolor-color').iris('color', '#ffffff');
			}else{
				jQuery('#stickymainmenufontcolor-color').val('#ffffff');
			}
			
		} else {
			
			// Revert back to original color if non-overlay header is selected
			//header bg color
			if( headerbg_curr_value!='' ){
				jQuery("#headerbgcolor-color").spectrum("set", headerbg_curr_value[2] );
	
				jQuery("input[id='headerbgcolor-color']:hidden").val(headerbg_curr_value[0]);
				jQuery("input[id='headerbgcolor-alpha']:hidden").val(headerbg_curr_value[1]);
				jQuery("input[id='headerbgcolor-rgba']:hidden").val(headerbg_curr_value[2]);
			}
			
			//sticky header bg color
			if( stickyheaderbg_curr_value!='' ){
				jQuery("#stickyheaderbgcolor-color").spectrum("set", stickyheaderbg_curr_value[2] );
				jQuery("input[id='stickyheaderbgcolor-color']:hidden").val(stickyheaderbg_curr_value[0]);
				jQuery("input[id='stickyheaderbgcolor-alpha']:hidden").val(stickyheaderbg_curr_value[1]);
				jQuery("input[id='stickyheaderbgcolor-rgba']:hidden").val(stickyheaderbg_curr_value[2]);
			}
			
			//main menu font color
			if( menu_curr_value!='' ){
				
				if(jQuery('#mainmenufont-color').hasClass('wp-color-picker') == true){
					jQuery('#mainmenufont-color').iris('color', menu_curr_value);
				}else{
					jQuery('#mainmenufont-color').val(menu_curr_value);
				}
			
			}
			
			//sticky menu font color
			if( sticky_menu_curr_value!='' ){
				
				if(jQuery('#stickymainmenufontcolor-color').hasClass('wp-color-picker') == true){
					jQuery('#stickymainmenufontcolor-color').iris('color', sticky_menu_curr_value);
				}else{
					jQuery('#stickymainmenufontcolor-color').val(sticky_menu_curr_value);
				}
			
			}
			
		}
		*/
	});
}





/* ***************************************************************** */
/* ***************  Redux - Preload image click event ************** */

jQuery( document ).ready(function() {
	
	"use strict";
	
	
	
	/* headerstyle click events */
	thememount_headerstyle_click();

	
	
	
	
	
	if( typeof redux != 'undefined' ){
	
		(function( $ ) {
			"use strict";
		
			redux.field_objects = redux.field_objects || {};
			redux.field_objects.image_select = redux.field_objects.image_select || {};

			$( document ).ready(
				function() {
					//redux.field_objects.image_select.init();
				}
			);

			redux.field_objects.image_select.init = function( selector ) {

				if ( !selector ) {
					selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-image_select:visible' );
				}

				$( selector ).each(
					function() {
						var el = $( this );
						var parent = el;
						if ( !el.hasClass( 'redux-field-container' ) ) {
							parent = el.parents( '.redux-field-container:first' );
						}
						if ( parent.is( ":hidden" ) ) { // Skip hidden fields
							return;
						}
						if ( parent.hasClass( 'redux-field-init' ) ) {
							parent.removeClass( 'redux-field-init' );
						} else {
							return;
						}
						// On label click, change the input and class
						//el.find( '.redux-image-select label img, .redux-image-select label .tiles' ).click(
						el.find( '.redux-image-select label' ).click(
							function( e ) {
								var id = $( this ).closest( 'label' ).attr( 'for' );

								$( this ).parents( "fieldset:first" ).find( '.redux-image-select-selected' ).removeClass( 'redux-image-select-selected' ).find( "input[type='radio']" ).attr(
									"checked", false
								);
								$( this ).closest( 'label' ).find( 'input[type="radio"]' ).prop( 'checked' );

								if ( $( this ).closest( 'label' ).hasClass( 'redux-image-select-preset-' + id ) ) { // If they clicked on a preset, import!
									e.preventDefault();

									var presets = $( this ).closest( 'label' ).find( 'input' );
									var data = presets.data( 'presets' );
									var merge = presets.data( 'merge' );

									if( merge !== undefined && merge !== null ) {
										if( $.type( merge ) === 'string' ) {
											merge = merge.split('|');
										}

										$.each(data, function( index, value ) {
											if( ( merge === true || $.inArray( index, merge ) != -1 ) && $.type( redux.options[index] ) === 'object' ) {
												data[index] = $.extend(redux.options[index], data[index]);
											}
										});
									}

									if ( presets !== undefined && presets !== null ) {
										var answer = confirm( redux.args.preset_confirm );

										if ( answer ) {
											el.find( 'label[for="' + id + '"]' ).addClass( 'redux-image-select-selected' ).find( "input[type='radio']" ).attr(
												"checked", true
											);
											window.onbeforeunload = null;
											if ( $( '#import-code-value' ).length === 0 ) {
												$( this ).append( '<textarea id="import-code-value" style="display:none;" name="' + redux.args.opt_name + '[import_code]">' + JSON.stringify( data ) + '</textarea>' );
											} else {
												$( '#import-code-value' ).val( JSON.stringify( data ) );
											}
											if ( $( '#publishing-action #publish' ).length !== 0 ) {
												$( '#publish' ).click();
											} else {
												$( '#redux-import' ).click();
											}
										}
									} else {
									}

									return false;
								} else {
									el.find( 'label[for="' + id + '"]' ).addClass( 'redux-image-select-selected' ).find( "input[type='radio']" ).attr(
										"checked", true
									).trigger('change');

									redux_change( $( this ).closest( 'label' ).find( 'input[type="radio"]' ) );
								}
							}
						);

						// Used to display a full image preview of a tile/pattern
						el.find( '.tiles' ).qtip(
							{
								content: {
									text: function( event, api ) {
										return "<img src='" + $( this ).attr( 'rel' ) + "' style='max-width:150px;' alt='' />";
									},
								},
								style: 'qtip-tipsy',
								position: {
									my: 'top center', // Position my top left...
									at: 'bottom center', // at the bottom right of...
								}
							}
						);
					}
				);

			};
		})( jQuery );
		
	}
	
});
/* ***************************************************************** */