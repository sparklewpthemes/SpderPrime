jQuery(document).ready(function($) {
  $('.controls#spiderprime-img-container li img').click(function(){
    $('.controls#spiderprime-img-container li').each(function(){
      $(this).find('img').removeClass ('spiderprime-radio-img-selected') ;
    });
    $(this).addClass ('spiderprime-radio-img-selected') ;
  });
});

function spiderprime_media_upload(button_class) {

	jQuery('body').on('click', button_class, function(e) {
		var button_id ='#'+jQuery(this).attr('id');
		var display_field = jQuery(this).parent().children('input:text');
		var _custom_media = true;

		wp.media.editor.send.attachment = function(props, attachment){

			if ( _custom_media  ) {
				if(typeof display_field != 'undefined'){
					switch(props.size){
						case 'full':
							display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
							break;

						default:
							display_field.val(attachment.url);
                            display_field.trigger('change');
					}
				}
				_custom_media = false;
			} else {
				return wp.media.editor.send.attachment( button_id, [props, attachment] );
			}
		}
		wp.media.editor.open(button_class);
		window.send_to_editor = function(html) {

		}
		return false;
	});
}

/********************************************
*** Generate uniq id ***
*********************************************/
function spiderprime_uniqid(prefix, more_entropy) {

  if (typeof prefix === 'undefined') {
    prefix = '';
  }
  var retId;
  var formatSeed = function(seed, reqWidth) {
    seed = parseInt(seed, 10)
      .toString(16); // to hex str
    if (reqWidth < seed.length) { // so long we split
      return seed.slice(seed.length - reqWidth);
    }
    if (reqWidth > seed.length) { // so short we pad
      return Array(1 + (reqWidth - seed.length))
        .join('0') + seed;
    }
    return seed;
  };

  // BEGIN REDUNDANT
  if (!this.php_js) {
    this.php_js = {};
  }
  // END REDUNDANT
  if (!this.php_js.uniqidSeed) { // init seed with big random int
    this.php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
  }
  this.php_js.uniqidSeed++;

  retId = prefix; // start with prefix, add current milliseconds hex string
  retId += formatSeed(parseInt(new Date()
    .getTime() / 1000, 10), 8);
  retId += formatSeed(this.php_js.uniqidSeed, 5); // add seed hex string
  if (more_entropy) {
    // for more entropy we add a float lower to 10
    retId += (Math.random() * 10)
      .toFixed(8)
      .toString();
  }

  return retId;
}


/********************************************
*** General Repeater ***
*********************************************/
function spiderprime_refresh_general_control_values(){
	jQuery(".spiderprime_general_control_repeater").each(function(){
		var values = [];
		var th = jQuery(this);
		th.find(".spiderprime_general_control_repeater_container").each(function(){

			var section_value_page = jQuery(this).find('.spiderprime_homepage_section_page').val();			
			var section_value = jQuery(this).find('.spiderprime_homepage_section_layout').val();
			var section_value_cat = jQuery(this).find('.spiderprime_homepage_section_category').val();
			var bg_image_url = jQuery(this).find(".section_bg_media_url").val();
      var title_text = jQuery(this).find(".spiderprime_title").val();     
      var short_textarea = jQuery(this).find(".spiderprime_short_textarea").val();
      var view_more_text = jQuery(this).find(".spiderprime_view_more_button_text").val();
      var view_more_link = jQuery(this).find(".spiderprime_view_more_button_link").val();
			var id = jQuery(this).find(".spiderprime_box_id").val();
            if(section_value_page !='' || view_more_text !='' || bg_image_url!='' ){
                values.push({
                    "section_value_page" : section_value_page ,
                    "section_value" : section_value ,
                    "section_value_cat" : section_value_cat ,
                    "bg_image_url" : bg_image_url,
                    "title_text" : spiderprime_escapeHtml(title_text),
                    "short_textarea" : spiderprime_escapeHtml(short_textarea),
                    "view_more_text" : spiderprime_escapeHtml(view_more_text),
                    "view_more_link" : view_more_link,
                });
            }

        });
        th.find('.spiderprime_repeater_colector').val(JSON.stringify(values));
        th.find('.spiderprime_repeater_colector').trigger('change');
    });
}



jQuery(document).ready(function(){
    jQuery('#customize-theme-controls').on('click','.spiderprime-customize-control-title',function(){
        jQuery(this).next().slideToggle('medium', function() {
            if (jQuery(this).is(':visible'))
                jQuery(this).css('display','block');
        });
    });

	jQuery("#customize-theme-controls").on('change', '.spiderprime_homepage_section_page',function(){
		spiderprime_refresh_general_control_values();
		return false; 
	});

	jQuery("#customize-theme-controls").on('change', '.spiderprime_homepage_section_layout',function(){
		spiderprime_refresh_general_control_values();
		return false; 
	});

	jQuery("#customize-theme-controls").on('change', '.spiderprime_homepage_section_category',function(){
		spiderprime_refresh_general_control_values();
		return false; 
	});

  spiderprime_media_upload('.custom_media_button_spiderprime');
  jQuery(".section_bg_media_url").live('change',function(){
      spiderprime_refresh_general_control_values();
      return false;
  });	

	jQuery(".spiderprime_general_control_new_field").on("click",function(){
	 
		var th = jQuery(this).parent();
		var id = 'spiderprime_'+spiderprime_uniqid();
		if(typeof th != 'undefined') {
			
            var field = th.find(".spiderprime_general_control_repeater_container:first").clone();
            if(typeof field != 'undefined'){

                field.find(".spiderprime_homepage_section_page").val('');
                field.find(".spiderprime_homepage_section_layout").val('');
                field.find(".spiderprime_homepage_section_category").val('');
                field.find(".section_bg_media_url").val('');
                field.find(".spiderprime_title").val('');
                field.find(".spiderprime_short_textarea").val('');
                field.find(".spiderprime_view_more_button_text").val('');
                field.find(".spiderprime_view_more_button_link").val('');

                th.find(".spiderprime_general_control_repeater_container:first").parent().append(field);
                spiderprime_refresh_general_control_values();
            }
			
		}
		return false;
	 });
	 
	jQuery("#customize-theme-controls").on("click", ".spiderprime_general_control_remove_field",function(){
		if( typeof	jQuery(this).parent() != 'undefined'){
			jQuery(this).parent().parent().remove();
			spiderprime_refresh_general_control_values();
		}
		return false;
	});

  jQuery("#customize-theme-controls").on('keyup', '.spiderprime_title',function(){
     spiderprime_refresh_general_control_values();
  });

  jQuery("#customize-theme-controls").on('keyup', '.spiderprime_short_textarea',function(){
     spiderprime_refresh_general_control_values();
  });

  jQuery("#customize-theme-controls").on('keyup', '.spiderprime_view_more_button_text',function(){
     spiderprime_refresh_general_control_values();
  });

  jQuery("#customize-theme-controls").on('keyup', '.spiderprime_view_more_button_link',function(){
    spiderprime_refresh_general_control_values();
  });

	/*Drag and drop to change icons order*/
	
	jQuery(".spiderprime_general_control_droppable").sortable({
		update: function( event, ui ) {
			spiderprime_refresh_general_control_values();
		}
	});

});

function spiderprime_escapeHtml(string) {
  var spiderprime_entityMap = {
      "&": "&amp;",
      "<": "&lt;",
      ">": "&gt;",
      '"': '&quot;',
      "'": '&#39;',
      "/": '&#x2F;',
    };
  string = String(string).replace(new RegExp('\r?\n','g'), '<br />');
  string = String(string).replace(/\\/g,'&#92;');
  return String(string).replace(/[&<>"'\/]/g, function (s) {
    	return spiderprime_entityMap[s];
  });
  
}