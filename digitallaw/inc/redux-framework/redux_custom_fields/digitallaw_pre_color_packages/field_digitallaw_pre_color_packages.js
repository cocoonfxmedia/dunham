thememount_pre_color_options = [
	'skincolor','topbarbgcustomcolor','stickymainmenufontcolor', /*'footertext_bgcolor',*/  /* Color Picker (0-2 : 3) */
	'dropmenu_background', /* Background Color (3-3 : 1) */
	'topbarbgcolor', 'footerwidget_color', 'topbartextcolor', /* Dropdown (4-6 : 3) */
	'mainmenufont','dropdownmenufont','megamenu_widget_title', 'general_font', 'h1_heading_font', 'h2_heading_font', 'h3_heading_font', 'h4_heading_font', 'h5_heading_font', 'h6_heading_font', 'heading_font', 'subheading_font', 'widget_font',  /* Font Color (7-19 : 13) */
	'link-color', 'link-color'/*, // link colors (20-21 : 2)
	'footerwidget_bgcolor'*/ /* RGB Color (22-22 : 1) */
];
var thememount_pre_color_list = [];
thememount_pre_color_list[1] = [ // Default
	'9dc02e','f45138','222222', /* Color Picker (3) */
	'222222', /* Background Color (1) */
	'darkgrey', 'white', 'white', /* Dropdown (3) */
	'222222','ffffff','ffffff','838383','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','838383','0c0c0c', /* Font Color (13) */
	'2d2d2d','9dc02e'/*, // Link Color (2)
	'rgba(12, 12, 12, 0.952941)'*/  /* RGB Color (2) */
]; // Default
thememount_pre_color_list[2] = [ // Dark
	'ec4933','f45138','222222', /* Color Picker (3) */
	'222222', /* Background Color (1) */
	'darkgrey', 'white', 'white', /* Dropdown (3) */
	'222222','ffffff','ffffff','838383','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','838383','0c0c0c', /* Font Color (13) */
	'2d2d2d','ec4933'/*, // Link Color (2)
	'rgba(12, 12, 12, 0.952941)'*/  /* RGB Color (2) */
];
thememount_pre_color_list[3]  = [ // Dark Cherry
	'449edd','f45138','222222', /* Color Picker (3) */
	'222222', /* Background Color (1) */
	'darkgrey', 'white', 'white', /* Dropdown (3) */
	'222222','ffffff','ffffff','838383','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','838383','0c0c0c', /* Font Color (13) */
	'2d2d2d','449edd'/*, // Link Color (2)
	'rgba(12, 12, 12, 0.952941)'*/  /* RGB Color (2) */
];
thememount_pre_color_list[4]  = [ // Dark Chololate
	'd5aa6d','f45138','222222', /* Color Picker (3) */
	'222222', /* Background Color (1) */
	'skincolor', 'white', 'white', /* Dropdown (3) */
	'222222','ffffff','ffffff','838383','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','838383','0c0c0c', /* Font Color (13) */
	'2d2d2d','d5aa6d'/*, // Link Color (2)
	'rgba(12, 12, 12, 0.952941)'*/  /* RGB Color (2) */
];
thememount_pre_color_list[5]  = [ // Dark Jeans-Blue
	'f7b71e','f45138','222222', /* Color Picker (3) */
	'222222', /* Background Color (1) */
	'darkgrey', 'white', 'white', /* Dropdown (3) */
	'222222','ffffff','ffffff','838383','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','2c2c2c','838383','0c0c0c', /* Font Color (13) */
	'2d2d2d','f7b71e'/*, // Link Color (2)
	'rgba(12, 12, 12, 0.952941)'*/  /* RGB Color (2) */
];




// Pre load images
jQuery.fn.preload = function() {
	jQuery.each(this,function(index, value){
		jQuery('<img/>')[0].src = value;
	});
}





'skincolor','topbarbgcustomcolor','stickymainmenufontcolor', /*'footertext_bgcolor',*/  /* Color Picker (0-2 : 3) */
'dropmenu_background', /* Background Color (3-3 : 1) */
'topbarbgcolor', 'footerwidget_color', 'topbartextcolor', /* Dropdown (4-6 : 3) */
'mainmenufont','dropdownmenufont','megamenu_widget_title', 'general_font', 'h1_heading_font', 'h2_heading_font', 'h3_heading_font', 'h4_heading_font', 'h5_heading_font', 'h6_heading_font', 'heading_font', 'subheading_font', 'widget_font',  /* Font Color (7-19 : 13) */
'link-color', 'link-color'/*, // link colors (20-21 : 2)
'footerwidget_bgcolor'*/ /* RGB Color (22-22 : 1) */


jQuery( document ).ready(function($) {

	// Tooltip
	jQuery('ul.thememount-pre-color-package-list li a').tooltipster({
		contentAsHTML: true
	});
	
	// Pre-load images
	var imglist = [];
	var i = 0;
	jQuery('ul.thememount-pre-color-package-list li').each(function(){
		imgsrc = jQuery('img', this).attr('src');
		imgsrc = imgsrc.replace('/images/pre','/images/big_pre');
		imglist[i] = imgsrc;
		i++;
	});
	jQuery(imglist).preload();
	
	
	jQuery( '.redux-container-digitallaw_pre_color_packages' ).parent().parent().addClass('thememount-special-toption');


	jQuery( '.thememount-pre-color-packages .thememount-pre-color-package-list a' ).click(function() {
		var num = jQuery(this).data( "num" );
		console.log('CLICK LOOP: '+num);
		curr    = thememount_pre_color_list[num];

		
		for (i=0; i<curr.length; i++){
			id = thememount_pre_color_options[i];
			
			// color: Color Picker
			if( i<=2 ){
				
				// If user don't want to set Skin Color
				if( jQuery('input#changeskincolor').val() == '0' && id=='skincolor' ){continue;}
				
				// Setting other colors
				if( jQuery('#'+id+'-color').css('display') == 'none' ){
					jQuery('#'+id+'-color').iris('color', '#'+curr[i] );
				} else {
					jQuery('#'+id+'-color').val( '#'+curr[i] );
				}
				
				
				
				
				
			// backgound : Background color picker
			} else if( i==3 ){
				if( jQuery('input[name="digitallaw['+id+'][background-color]"]').css('display') == 'none' ){
					jQuery('input[name="digitallaw['+id+'][background-color]"]').iris('color', '#'+curr[i] );
				} else {
					jQuery('input[name="digitallaw['+id+'][background-color]"]').val( '#'+curr[i] );
				}
			
			
			
			// select : Change dropdown
			} else if( i>=4 && i<=6 ){
				if( jQuery('select[name="digitallaw['+id+']"]').css('display') == 'none' ){
					//console.log('111  Called this: '+id + '  -- Value: ' + curr[i] );
					jQuery('select[name="digitallaw['+id+']"]').select2( "val", curr[i] );
				} else {
					//console.log(' 222  Called this: '+id + '  -- Value: ' + curr[i] );
					//console.log( jQuery('select[name="digitallaw['+id+']"]').val() );
					jQuery('select[name="digitallaw['+id+']"]').val( curr[i] );
					//console.log( jQuery('select[name="digitallaw['+id+']"]').val() );
					//console.log( '----------------------------------------------' );
				}
			
			
			
			// font : Font Color Picker
			} else if( i>=7 && i<=19 ){
				if( jQuery('input[name="digitallaw['+id+'][color]"]').css('display') == 'none' ){
					jQuery('input[name="digitallaw['+id+'][color]"]').iris('color', '#'+curr[i] );
				} else {
					jQuery('input[name="digitallaw['+id+'][color]"]').val( '#'+curr[i] );
				}
			
			
			
			
			
			// Link Color
			} else if( i>=20 && i<=21 ){
				
				if( i==20 ){ // Regular
					//console.log( 'Before: '+ jQuery('input[name="digitallaw['+id+'][regular]"]').val() );
					if( jQuery('input[name="digitallaw['+id+'][regular]"]').css('display') == 'none' ){
						jQuery('input[name="digitallaw['+id+'][regular]"]').iris('color', '#'+curr[i] );
					} else {
						jQuery('input[name="digitallaw['+id+'][regular]"]').val( '#'+curr[i] );
					}
					//console.log( 'After: '+ jQuery('input[name="digitallaw['+id+'][regular]"]').val() );
				}
				
				if( i==21 ){ // Hover
					if( jQuery('input[name="digitallaw['+id+'][hover]"]').css('display') == 'none' ){
						jQuery('input[name="digitallaw['+id+'][hover]"]').iris('color', '#'+curr[i] );
					} else {
						jQuery('input[name="digitallaw['+id+'][hover]"]').val( '#'+curr[i] );
					}
				}
			
			
			
			}
		
		
		
		}
		
		
		
		
		
		// "Save Now" message
		if( jQuery('#thememount-pre-color-infobox').css('display') == 'none' ){
			jQuery('#thememount-pre-color-infobox').slideDown();
		} else {
			jQuery('#thememount-pre-color-infobox').slideUp('normal',function(){
				jQuery('#thememount-pre-color-infobox').slideDown();
			});
		}	
		
		
		return false;
		
		
	});
	
	
	// "Also change Skin Color" link
	jQuery( 'a#changeskincolor-link' ).click(function() {
		if( jQuery(this).hasClass('deactive') ){
			jQuery(this).removeClass('deactive');
			jQuery('#changeskincolor').val('1');
		} else {
			jQuery(this).addClass('deactive');
			jQuery('#changeskincolor').val('0');
		}
		return false;
	});
	
});
