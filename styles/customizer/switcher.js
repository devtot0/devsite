$(window).load(function(){

$("div#customizer").mCustomScrollbar();

$('a#open_switcher').click(function(){

     $(this).css("display", "none");
     $('div#customizer').animate({ 'left': '0px' }, 200, 'linear', function(){
               $('a#close_switcher').show(200);
     });
        
return false;
});

$('a#close_switcher').click(function(){

     $(this).css("display", "none");
     $('div#customizer').animate({ 'left': '-321px' }, 200, 'linear', function(){
               $('a#open_switcher').show(200);
     });
        
return false;
});

//Intro font family
$('#intro_font_family select').change(function(){

     var intro_font = this.options[this.selectedIndex].value;
     $('link#intro_font').attr('href', 'http://fonts.googleapis.com/css?family=' + intro_font);
     var intro_font_style = this.options[this.selectedIndex].label;
     $('div#intro h1').css("font-family", intro_font_style);

});

//Intro font size
$('#intro_font_size select').change(function(){

     var intro_font_size = this.options[this.selectedIndex].value;
     $('div#intro h1').css("font-size", intro_font_size);

});

//Text font family
$('#text_font_family select').change(function(){

     var text_font = this.options[this.selectedIndex].value;
     $('link#text_font').attr('href', 'http://fonts.googleapis.com/css?family=' + text_font);
     var text_font_style = this.options[this.selectedIndex].label;
     $('body, div#intro p').css("font-family", text_font);

});

//Headings font family
$('#headings_font_family select').change(function(){

     var headings_font = this.options[this.selectedIndex].value;
     $('link#headings_font').attr('href', 'http://fonts.googleapis.com/css?family=' + headings_font);
     var headings_font_style = this.options[this.selectedIndex].label;
     $('#text_content h3, div#portfolio_thumbs ul li div.item_info h3, div#service_elements ul li .service_content h3, div#about_content h3, div#contact_form input[type="text"], div#contact_form textarea').css("font-family", headings_font);

});

//Menu background:
$('#menu_background').ColorPicker({

        color: '#000',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#menu_background, div#navigation').css('backgroundColor', '#' + hex);
	}

});

//Menu font color:
$('#menu_font_color').ColorPicker({

        color: '#FFFFFF',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#menu_font_color').css('background', '#' + hex);
                $('div#navigation div ul li a').css('color', '#' + hex);
	}

});

//Menu font family
$('#menu_font_family select').change(function(){

     var menu_font = this.options[this.selectedIndex].value;
     $('link#menu_font').attr('href', 'http://fonts.googleapis.com/css?family=' + menu_font);
     var menu_font_style = this.options[this.selectedIndex].label;
     $('div#navigation div ul li').css("font-family", menu_font);

});

//Menu font size
$('#menu_font_size select').change(function(){

     var menu_font_size = this.options[this.selectedIndex].value;
     $('div#navigation div ul li').css("font-size", menu_font_size);

});

//Home background:
$('#home_background').ColorPicker({

        color: '#FFFFFF',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#home_background, #header ').css('background', '#' + hex);
	}

});

//Home color:
$('#home_color').ColorPicker({

        color: '#000000',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#home_color').css('background', '#' + hex);
                $('div#intro h1, div#intro p, div#intro p strong').css('color', '#' + hex);
	}

});

//Section title font family
$('#section_font_family select').change(function(){

     var section_font = this.options[this.selectedIndex].value;
     $('link#section_font').attr('href', 'http://fonts.googleapis.com/css?family=' + section_font);
     var section_font_style = this.options[this.selectedIndex].label;
     $('.title').css("font-family", section_font_style);

});

//section font size
$('#section_font_size select').change(function(){

     var section_font_size = this.options[this.selectedIndex].value;
     $('.title').css("font-size", section_font_size);

});

//Portfolio background:
$('#portfolio_background').ColorPicker({

        color: '#333333',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#portfolio_background, #portfolio, div#portfolio_thumbs ul li div.item_info').css('background', '#' + hex);
	}

});

//Portfolio background:
$('#portfolio_title_color').ColorPicker({

        color: '#FFFFFF',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#portfolio_title_color').css('background', '#' + hex);
		$('div#portfolio_title h2').css('color', '#' + hex);
	}

});

//Portfolio text color:
$('#portfolio_text_color').ColorPicker({

        color: '#CCCCCC',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#portfolio_text_color').css('background', '#' + hex);
		$('ul#portfolioFilter li a, div#portfolio_thumbs ul li div.item_info p, div#quote').css('color', '#' + hex);
	}

});

//Quote font family:
$('#quote_font_family select').change(function(){

     var quote_font = this.options[this.selectedIndex].value;
     $('link#quote_font').attr('href', 'http://fonts.googleapis.com/css?family=' + quote_font);
     var quote_font_style = this.options[this.selectedIndex].label;
     $('div#quote, div#quote p').css("font-family", quote_font_style);

});

//Quote
$('#quote_font_size select').change(function(){

     var quote_font_size = this.options[this.selectedIndex].value;
     $('div#quote p').css("font-size", quote_font_size);

});

//Services background:
$('#services_background').ColorPicker({

        color: '#FFFFFF',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#services_background, div#services').css('background', '#' + hex);
	}

});

$('#services_title_color').ColorPicker({

        color: '#000000',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#services_title_color').css('background', '#' + hex);
                $('#services_title h2, div#service_elements ul li .service_content h3').css('color', '#' + hex);
	}

});

$('#services_text_color').ColorPicker({

        color: '#666666',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#services_text_color').css('background', '#' + hex);
                $('#services_text_color, div#service_elements ul li .service_content p, div#services_intro, div#service_elements ul li .service_content a.read_more').css('color', '#' + hex);
	}

});

//Icon background:
$('#icon_background').ColorPicker({

        color: '#333333',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#icon_background, div#service_elements ul li .icon').css('background', '#' + hex);
	}

});

//About background
$('#about_background').ColorPicker({

        color: '#333333',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#about_background, div#about').css('background', '#' + hex);
	}

});

//About title color
$('#about_title_color').ColorPicker({

        color: '#FFFFFF',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#about_title_color').css('background', '#' + hex);
		$('div#about_title h2, div#about_content h3').css('color', '#' + hex);
	}

});

//About text color
$('#about_text_color').ColorPicker({

        color: '#CCCCCC',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#about_text_color').css('background', '#' + hex);
		$('div#about').css('color', '#' + hex);
	}

});

//Testimonials
$('#testimonials_background').ColorPicker({

        color: '#000000',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#testimonials_background, div#testimonials_contaier').css('background', '#' + hex);
	}

});

//Testimonials text color
$('#testimonials_text_color').ColorPicker({

        color: '#CCCCCC',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#testimonials_text_color').css('background', '#' + hex);
		$('div.testimonial_content').css('color', '#' + hex);
	}

});

//Contact background
$('#contact_background').ColorPicker({

        color: '#FFFFFF',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#contact_background, div#contact').css('background', '#' + hex);
	}

});

//Contact title color
$('#contact_title_color').ColorPicker({

        color: '#000000',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#contact_title_color').css('background', '#' + hex);
		$('#contact_title h2, div#contact_form input[type="text"], div#contact_form textarea').css('color', '#' + hex);
	}

});

//Contact text color
$('#contact_text_color').ColorPicker({

        color: '#666666',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#contact_text_color').css('background', '#' + hex);
		$('div#contact_info').css('color', '#' + hex);
	}

});

//Contact button background
$('#contact_button_bg').ColorPicker({

        color: '#333333',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
                return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#contact_button_bg, div#contact_form button').css('background', '#' + hex);
	}

});

});