/**
 * Javacript for anguli theme
 * v 3.1.0
 * @LoeiFy
 * http://lorem.themex.net
*/

var post_lth = 10,
	anguli = {


	imgload: function(wrap) {
		jQuery(wrap).imagesLoaded()
  			.always( function( instance ) {
				jQuery("#loader").hide();
    		//console.log('all images loaded');
  		/*})
  		.done( function( instance ) {
    		console.log('all images successfully loaded');
  		})
  		.fail( function() {
    		console.log('all images loaded, at least one is broken');
  		})
  		.progress( function( instance, image ) {
    		var result = image.isLoaded ? 'loaded' : 'broken';
    		console.log( 'image is ' + result + ' for ' + image.img.src );*/
  		});
	},

	init: function() {


		if ( jQuery("#primary").length ) {
			anguli.imgload("#wrapper");
		};
		
		if ( jQuery("#feedback").length ) {
			jQuery("#loader").hide();
		};
		
		// search form
		/*jQuery("#s").on('click', function() {
			jQuery(this).animate({width: '107px'}, 300);
		});
		jQuery("#s").on('blur', function() {
			jQuery(this).animate({width: '57px'}, 300);
		});*/

		jQuery("#tog_m").click(function() {
			jQuery(".menu").toggle();
		});

		// index fancybox
		jQuery(".prettyPhoto").fancybox({
			padding: 0,
            helpers : {
            	title : {
                	type : 'over'
            	}
			}
		});

		// cancle preview
		jQuery("#cover_w").click(function() {
			History.back();
		});

		if ( jQuery("#single").length ) {
			anguli.hate_this();
			jQuery("#c_button").click(function() {
				twobisthis('#comment-box', document.location);
				return false;
			});

			anguli.imgload("#s_wrapper");
		};

		anguli.slider();	// index slider

		anguli.slider2();	// single slider

		anguli.mas();	// index masonry

		anguli.add_color();		// pic hover color

		if ( jQuery("#primary").length ) {
			anguli.preview();
		};	// index preview

		anguli.retext();	// remove category text

		anguli.next_page();		// ajax next page

		anguli.pic_masonry();	// single masonry

		anguli.pic_photo();		// single fancybox

	},

	slider: function() {

		//if ( !jQuery.browser.msie ) {

		jQuery(".img_slider").each(function() {

  			var k = parseInt(Math.random()*8000+4000);
  			jQuery(this).responsiveSlides({
  				auto: true, 
  				speed: 1000,           
  				timeout: k,         
  				pager: false,        
  				nav: false,         
  				random: true,      
  				pause: false,     
  				pauseControls: true, 
  				maxwidth: "",       
  				navContainer: "",    
  				manualControls: "",    
  				namespace: "rslides",  
  				before: function(){}, 
  				after: function(){ /*anguli.mas();*/ }  
  			});

  			//anguli.mas();

		});
		
		//};

	},

	retext: function() {
		if ( !jQuery.browser.msie ) {
		jQuery(".category").each(function() {
			if( jQuery(this).data("t") == 0 ) {
				var t = jQuery(this).text();
				t = t.substr(0,t.length - 5);
				jQuery(this).text(t).data('t', 1);
			};
		});
		};
	},

	slider2: function() {

		jQuery(".img_slider2").responsiveSlides({
        	auto: false,
        	nav: true,
        	speed: 500,
			pager: true,
        	maxwidth: 1200
      	});

	},

	pic_masonry: function() {

		jQuery(".img_grid").masonry({
			itemSelector: '.postimgs',
			columnWidth: 296,
			isAnimated: true,
			isFitWidth: true
		});	

	},

	mas: function() {

			var $mas = jQuery("#wrapper");

			/*if ( jQuery.browser.msie && (jQuery.browser.version < "9.0")  ) {
					$mas.masonry({
						itemSelector: '.post',
						columnWidth: 314,
						isAnimated: true,
						isFitWidth: true,
						cornerStampSelector: '.post_first'
					});
			} else {*/

                get_height(callmas);
                function get_height(call) {
					jQuery(".img_slider").each(function() {
						var a = [];
						jQuery(this).find('li').each(function() {
							a.push(jQuery(this).data('imgh'));
						});
						a = Math.min.apply(null, a);
						jQuery(this).css('height', a).parent().css('height', a);
					});
					call();
				};

                function callmas() {
					$mas.masonry({
						itemSelector: '.post',
						columnWidth: 314,
						isAnimated: true,
						isFitWidth: true,
						cornerStampSelector: '.post_first'
					});
				};

			//};

	},

	pic_photo: function() {

            jQuery(".postimgs").attr({rel: "fancybox-button"});
            jQuery("a[rel^='fancybox-button']").fancybox({
                	padding:0,
					//prevEffect		: 'none',
                	//nextEffect		: 'none',
                	closeBtn		: false,
                	helpers		: {
                    	title	: { type : 'inside' },
                    	buttons	: {}
                	}

					//afterLoad : function() {
						//this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
					//}
       		});

			jQuery(".single-standard .s_article a:has(img)").fancybox({
				padding: 0
			});

	},

	add_color: function() {
	
		var color = jQuery(".overlay");
        	color.removeClass("color0");
        	color.removeClass("color1");
        	color.removeClass("color2");
        	color.removeClass("color3");
        	color.removeClass("color4");
        	color.removeClass("color5");
        	color.removeClass("color6");
        	color.each(function() {
            	var x = 6,
            		y = 0,
            		rand = parseInt(Math.random() * (x - y + 1) + y);
					rand = 'color' + rand;
            	jQuery(this).addClass(rand);
        	});

	},

	preview: function(com) {
		var	loc = document.location,
      		siteUrl   = 'http://' + ( loc.hostname || loc.host ) + '/',
			link_a = com ? jQuery(com).find(".more") : jQuery(".more");

		link_a.click(function(e) {

			var link = jQuery(this).attr('href');
			if(link.indexOf('%') > 3 ) {
				return
			} else {
				e.preventDefault();
				History.pushState({}, jQuery(this).attr('title'), link);
				jQuery("#loader").show();
			}

			_timeout = setTimeout(function() {
				jQuery("#link_to").show().attr('href', State.url);
			}, 5000); 

			var bg_class = jQuery(this),
				bg = '';

			if(bg_class.parent().hasClass('h_t')) {bg_class = bg_class.parent().prev().find('.overlay');};

			if(bg_class.hasClass('color0')) { bg = 'color0' };
			if(bg_class.hasClass('color1')) { bg = 'color1' };
			if(bg_class.hasClass('color2')) { bg = 'color2' };
			if(bg_class.hasClass('color3')) { bg = 'color3' };
			if(bg_class.hasClass('color4')) { bg = 'color4' };
			if(bg_class.hasClass('color5')) { bg = 'color5' };
			if(bg_class.hasClass('color6')) { bg = 'color6' };

			var color = jQuery("#cover_w");
        	color.removeClass("color0");
        	color.removeClass("color1");
        	color.removeClass("color2");
        	color.removeClass("color3");
        	color.removeClass("color4");
        	color.removeClass("color5");
        	color.removeClass("color6");
			color.addClass(bg);

		});

  		History.Adapter.bind( window, 'statechange', function() {

			var State = History.getState();

			if ( loc != siteUrl ) {

				var inner_data;

    			jQuery.ajax({ 
	
					type: "GET",		

					url: State.url,
		   
					success: function(data) {
    
        				inner_data = jQuery(data).find('#s_wrapper');

						clearTimeout(_timeout);

						_timeout = undefined;

						jQuery("#link_to").hide();
        
        				jQuery("#cover_w").html(inner_data).parent().show();

						//jQuery("#loader").hide();

						jQuery("#close").show();
						jQuery("#link_post").show();

						
						if (jQuery("#s_wrapper div").hasClass("single-image")) {
							jQuery("#for_img").show();
						};

		    		}
			
				}).done(function() {
					is_overflow();
					anguli.pic_masonry();
					//anguli.pic_photo();
					anguli.slider2();
					anguli.hate_this();
    				tz_likeInit();

					anguli.imgload(inner_data);

					jQuery("#close").on('click', function() { History.back() });
					jQuery("#link_post").on('click', function() { window.location.href = State.url });
					jQuery("#s_wrapper").click(function(e) { e.stopPropagation() });

					if (jQuery("#s_wrapper div").hasClass("single-standard")) {
						jQuery("#s_wrapper").css("max-width", "1000px");
					};


					var gr = [];

					jQuery(".postimgs").each(function() {
						var link = jQuery(this).attr('href');
						gr.push({'href': link});
					});


					jQuery("#for_img").on('click', function() {

						jQuery.fancybox(gr, {
							padding: 0
						});
						return false;
					});


					jQuery(".postimgs").on('click', function(){

						jQuery.fancybox(jQuery(this).attr('href'), {
							padding: 0
						});
						return false;

				   	});

					jQuery(".single-standard .s_article a:has(img)").on('click', function() {
						jQuery.fancybox(jQuery(this).attr('href'), {
							padding: 0
						});
						return false;
					});

					jQuery("#content nav").hide();

					jQuery("#c_button").click(function() {
						twobisthis('#comment-box', State.url);
						return false;
					});

				});

			} else {
				jQuery("#content #wrapper").remove();
				jQuery("#content").hide();
				is_overflow();
			};
  		});

  		function is_overflow() {
	  		if ( jQuery("#content").is(":visible") ) {
		  		jQuery("body").css('overflow', 'hidden');
	  		} else {
		  		jQuery("body").css('overflow', 'auto');
		  		jQuery("#loader").hide();
	  		};
			if (!jQuery("#s_wrapper").text()) {
				jQuery("#content").hide();
		  		jQuery("body").css('overflow', 'auto');
			};
  		};

	},

	next_page: function() {

        jQuery("#pagination a").live("click", function(){

			var result,
				$newElems,
				nextHref;

			var alink = jQuery(this).attr('href');

        	if (post_lth < 69) {
            	jQuery(this).addClass("loading").text("LOADING...");
            	jQuery("#loader").show();

				_timeout2 = setTimeout(function() {
					jQuery("#link_to").show().attr('href', alink);
				}, 5000);

            	jQuery.ajax({

                	type: "GET",
                	url: jQuery(this).attr("href"),
                	success: function(data){

                    	result = jQuery(data).find(".post");
                    	nextHref = jQuery(data).find("#pagination a").attr("href");
                    	jQuery("#wrapper").append(result);
                    	$newElems = result;
                    	jQuery("#wrapper").masonry("appended", $newElems, true);
                    
                    	jQuery("#pagination a").removeClass("loading").text("LOAD MORE");
                    	//jQuery("#loader").hide();
                    	post_lth = post_lth + 10;

						clearTimeout(_timeout2);

						_timeout2 = undefined;
						
						jQuery("#link_to").hide();

                    	if ( nextHref != undefined ) {
                        	jQuery("#pagination a").attr("href", nextHref);
                    	} else {
                        	jQuery("#pagination").hide();
                    	}
                	}
            	}).done(function() {
						anguli.add_color();
						anguli.slider();
						anguli.preview($newElems);
						anguli.mas();
						anguli.retext();

						anguli.imgload($newElems);

                	});
            	return false;
            } else {return};
        });

	},

	hate_this: function() {
		jQuery.getScript('http://static.duoshuo.com/embed.js', function() {});
	}

};

// DUOSHUO
function twobisthis(container,url) {
	var el = document.createElement('div');
    	el.setAttribute('data-url', url);
    	DUOSHUO.EmbedThread(el);
    	jQuery(container).append(el);
		jQuery("#c_button").hide();
};


//TZ_LIKE
function tz_reloadLikes(who) {
	var text = jQuery("#" + who).html();
	var patt= /(\d)+/;
		
	var num = patt.exec(text);
	num[0]++;
	text = text.replace(patt,num[0]);
	jQuery("#" + who).html('<span class="count">' + text + '</span>');
}; //reloadLikes
function tz_likeInit() {
	jQuery(".likeThis").click(function() {
		var classes = jQuery(this).attr("class");
		classes = classes.split(" ");
			
		if(classes[1] == "active") {
			return false;
		}
		var classes = jQuery(this).addClass("active");
		var id = jQuery(this).attr("id");
		id = id.split("like-");
		jQuery.ajax({
			type: "POST",
			url: "index.php",
			data: "likepost=" + id[1],
			success: tz_reloadLikes("like-" + id[1])
		}); 
				
		return false;
	});
};


// ready !	
jQuery(document).ready(function(){

	anguli.init();

    tz_likeInit();
	
});
