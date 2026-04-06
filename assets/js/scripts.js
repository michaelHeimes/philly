jQuery(document).ready(function($){
	
	(function () {
	  const popupId = 21384;
	  const cookieName = 'pum-' + popupId;
	  const cookieDays = 30;
	
	  // Helper to set a cookie
	  function setCookie(name, days) {
		const d = new Date();
		d.setTime(d.getTime() + (days*24*60*60*1000));
		const expires = "expires=" + d.toUTCString();
		document.cookie = name + "=true;" + expires + ";path=/";
	  }
	
	  function hardClosePopup() {
		const $popup = jQuery('#pum-' + popupId);
		if (!$popup.length) return;
	
		// Remove popup state classes and hide
		$popup
		  .removeClass('pum-active pum-overlay pum-active-overlay')
		  .css({ display: 'none', opacity: 0 });
	
		// Remove body/html classes
		jQuery('html, body')
		  .removeClass('pum-active pum-overlay pum-active-overlay pum-open pum-open-overlay');
	
		// Set the cookie so it doesn't reopen
		setCookie(cookieName, cookieDays);
	  }
	
	  // Attach to the close button(s)
	  document.addEventListener('click', function (e) {
		if (!e.target.closest('.pum-close, .popmake-close')) return;
		e.preventDefault();
		hardClosePopup();
	  }, true);
	})();
	
	function galleryInit(){
		var ww = document.body.clientWidth;
		var gal1width = jQuery('#container').width() - 64;
	
		if (ww < 800) {
			gal1width = ww;
		}
		jQuery("#gallery1").width(gal1width);
		jQuery(".gallery1Item").width(gal1width);
	}
	
	function adjustHeader(){
		var header1 = jQuery(".header").first();
		var h = header1.height();
		jQuery("body > .container").css({'padding-top' : h + 'px'});
		header1.css({'top' : '0', 'position':'fixed', 'width':'100%'});
	}
	
	jQuery("#activateNav").click(function(e){
		/*$('body').toggleClass('static');*/
		e.preventDefault();
		/*$(window).scrollTop(0);*/
		$('#mainNav').toggleClass("open");
		return false;
	});
	/*NAV*/
	var ww = document.body.clientWidth;
	if (ww < 800) {
		$("#mainNav li.menu-item-has-children:not(.placeholder)").prepend("<div class='tgl2'></div>");
		$("#mainNav li.menu-item-has-children>a").click(function(e) {
			if($(this).parent("li").hasClass("placeholder")){
				e.preventDefault();
				$(this).parent("li").toggleClass('hover');
			} else {
				if($(this).parent("li").hasClass("hover")){
					if ($(e.target).closest(".tgl2").length){
						e.preventDefault();
						$(this).parent("li").toggleClass('hover');
					}
				} else {
					e.preventDefault();
					$(this).parent("li").toggleClass('hover');
				}
			}
		});
		$("#mainNav li>.tgl2").click(function(e) {
			$(this).parent("li").toggleClass('hover');
		});
	} else {
		$("#mainNav li").hover(function() {
			$(this).addClass('hover');
		}, function() {
			$(this).removeClass('hover');
		});
		$("#mainNav li.placeholder>a").click(function(e){
			e.preventDefault();
			return(false);
		});
	}
	/*/NAV*/
	
	adjustHeader();
	
	jQuery('.textZone').waypoint(function(direction) {
		//console.log('waypoint1 '+ this.element.id);
		//console.log(direction);
		if(direction === 'down') {
			jQuery('#'+this.element.id).addClass('active');
		} else {
			jQuery('#'+this.element.id).removeClass('active');
		}
	}, { offset: '80%' });
	
	jQuery('#visualGaleryItem1_caption').addClass("active");
	var gal = jQuery('.visualGalery');
	gal.cycle();
	gal.on( 'cycle-before', function( e, opts, curr, next ) {
		var next_id = jQuery(next).attr('id');
		var curr_id = jQuery(curr).attr('id');
		jQuery('.visualCaption').addClass('inaction');
		setTimeout("jQuery('.visualCaption').removeClass('inaction')", 500);
		jQuery('#'+curr_id+'_caption').removeClass('active');
		jQuery('#'+next_id+'_caption').addClass('active');
	});
	
	if (ww > 800) {
		var $wrapper = $('.featuredContent');
		$wrapper.find('div[data-desktopsort]').sort(function (a, b) {
			return +a.getAttribute('data-desktopsort') - +b.getAttribute('data-desktopsort');
		}).appendTo($wrapper);
	}
	
	jQuery(".visualGaleryPlay").fancybox({
		wrapCSS: 'textpopupstyle',
		padding: 0,
		closeBtn:true,
		type:'iframe',
		autoCenter:true,
		autoResize:true,
		autoHeight:true,
		closeClick:false,
		width:640,
		height:385
	}); //-fancybox
	
});