/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

(function ($) {
    "use strict";
    var HaruPangja = {
        init: function() {
            HaruPangja.base.init();
            HaruPangja.teammember.init();
        }
    };
    
    HaruPangja.base = {
        init: function() {
            HaruPangja.base.bannerCreative();
            HaruPangja.base.shortcodeImagesGallery();
            HaruPangja.base.shortcodeCounter();
            HaruPangja.base.shortcodeProgressBar();
            HaruPangja.base.shortcodeVideo();
            HaruPangja.base.shortcodeAccordion();
            HaruPangja.base.timeline();
            HaruPangja.base.shortcodeTestimonial();
        },
        bannerCreative: function() {
            setTimeout(function(){
                $('.banner-creative-shortcode-wrap').each(function(){
                    var $this = $(this);
                    var $container      = $(this).find('.banner-list'); // parent element of .item
                    var masonry_options = {
                        'gutter' : 0
                    };
                    var $columns = parseInt($this.attr('data-columns'));
                    var $padding = $this.attr('data-padding');

                    $container.isotope({
                        itemSelector : '.banner-item', // .item
                        transitionDuration : '0.4s',
                        masonry : masonry_options,
                        layoutMode : 'packery'
                    });

                    imagesLoaded($this,function(){
                        $container.isotope('layout');
                    });

                    HaruPangja.base.packeryPadding($this, $padding, $columns);

                    $(window).resize(function(){
                        setTimeout(function(){
                            $container.isotope('layout');
                            HaruPangja.base.packeryPadding($this, $padding, $columns);
                        }, 300);
                    });
                });
            }, 300);
        },
        packeryPadding: function(element, $padding, $columns) {
            if( element.hasClass('packery') || element.hasClass('packery_2') && (typeof $padding !== 'undefined') && ($padding != 0) && ($(window).width() > 767) ) { // Use padding
                var banner_wrapper_width = $(element).find('.banner-list').width();
                var padding_total = Number($columns) * Number($padding) * 2; // Column from banner-packery.php file

                var banner_item_height = (banner_wrapper_width - padding_total) / $columns;
                console.log(banner_item_height);

                // Default
                $(element).find('.banner-item.default').each(function() {
                    $(this).css({"height": Number(banner_item_height)});
                    $('img',this).css({"height": Number(banner_item_height)});
                });
                // Small squared

                // Landscape
                $(element).find('.banner-item.landscape').each(function() {
                    $(this).css({"height": banner_item_height});
                    $('img',this).css({"height": banner_item_height});
                });
                // Portrait
                $(element).find('.banner-item.portrait').each(function() {
                    $(this).css({"height": (Number(banner_item_height) + Number($padding)) * 2 });
                    $('img',this).css({"height": (Number(banner_item_height) + Number($padding)) * 2 });
                });
                // Big Squared
                $(element).find('.banner-item.big_squared').each(function() {
                    $(this).css({"height": (Number(banner_item_height) + Number($padding)) * 2 });
                    $('img',this).css({"height": (Number(banner_item_height) + Number($padding)) * 2 });
                });
            }
        },
        shortcodeImagesGallery: function() {
            $('.images-gallery-shortcode-wrap').each(function(){
                var $this = $(this);
                var $columns = parseInt($this.attr('data-columns'));

                // Filter show/hide gallery
                $this.find('.gallery-content').hide();
                // Init first gallery
                $this.find('.gallery-content').first().find('.image-group').slick({
                    slidesToShow: $columns,
                    slidesToScroll: 1,
                    arrows: true,
                    infinite: true,
                    centerMode: false,
                    centerPadding: '0px',
                    variableWidth: false,
                    responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                  ]
                });
                $this.find('.gallery-content').first().show();

                // Filter click
                $this.find('.gallery-filters a').on('click', function(e){
                    e.preventDefault();

                    // Episode active
                    $this.find('.gallery-filters a').removeClass('active');
                    $this.find('.gallery-content').hide();

                    $(this).addClass('active');
                    var current_gallery     = $(this).data('gallery');
                    $this.find('#gallery-' + current_gallery).show();
                    // Init slick when filter
                    $this.find('#gallery-' + current_gallery + ' .image-group:not(.slick-initialized )').each(function(){
                        // Maybe need destroy and re init
                        $(this).slick({
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            arrows: true,
                            infinite: true,
                            centerMode: false,
                            centerPadding: '0px',
                            variableWidth: false,
                            responsive: [
                                {
                                    breakpoint: 991,
                                    settings: {
                                        slidesToShow: 3,
                                        slidesToScroll: 1,
                                    }
                                },
                                {
                                    breakpoint: 767,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1
                                    }
                                }
                            ]
                        });
                    });
                });
            });
        },
        shortcodeCounter: function() {
            $('.counter-shortcode-wrap').each(function(){
                var $this = $(this);

                // Appear
                if (!$(".gr-animated").length) return;

                $(".gr-animated").appear();

                $(document.body).on("appear", ".gr-animated", function () {
                    $(this).addClass("go");
                });

                $(document.body).on("disappear", ".gr-animated", function () {
                    $(this).removeClass("go");
                });

                // Counter
                if (!$(".gr-number-counter").length) return;
                $(".gr-number-counter").appear(); // require jquery-appear

                $('body').on("appear", ".gr-number-counter", function () {
                    var counter = $(this);
                    if (!counter.hasClass("count-complete")) {
                        counter.countTo({
                            speed: 1500,
                            refreshInterval: 100,
                            onComplete: function () {
                                counter.addClass("count-complete");
                            }
                        });
                    }
                });
                
                $('body').on("disappear", ".gr-number-counter", function () {
                    $(this).removeClass("count-complete");
                });
            });
        },
        shortcodeProgressBar: function() {
            $(".progress-bar").each(function() {
                var each_bar_width = $(this).attr('aria-valuenow');
                $(this).width(each_bar_width + '%');
            });
        },
        shortcodeVideo: function() {
            $('.video-popup-link').magnificPopup({
                type: 'iframe',
                iframe: {
                    markup: '<div class="mfp-iframe-scaler">'+
                            '<div class="mfp-close"></div>'+
                            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                            '<div class="mfp-title">Some caption</div>'+
                          '</div>'
                },
                callbacks: {
                    markupParse: function(template, values, item) {
                        values.title = item.el.attr('title');
                    }   
                }
            });
        },
        shortcodeAccordion: function() {
            $(".collapse").each(function(){
                $(this).on('show.bs.collapse', function(){
                    // $(".collapse").removeClass("active");
                    $(this).parents('.panel').addClass("active");
                }).on('hide.bs.collapse', function(){
                    $(this).parents('.panel').removeClass("active");
                });
            });
        },
        timeline: function() {
            $('.timeline-shortcode-wrap.carousel').each(function() {
                var timeline_content    = $(this).find("#timeline-content");
                var timeline_thumb    = $(this).find("#timeline-thumb");

                timeline_content.slick();
                timeline_thumb.slick();            
            });
        },
        shortcodeTestimonial: function() {
            $('.testimonial-shortcode-wrap.slick').each(function() {
                var testimonial_content    = $(this).find(".testimonial-list");

                testimonial_content.slick();
                $(this).find('.slick-prev').on('click', function() {
                    testimonial_content.slick('slickPrev');
                });
                $(this).find('.slick-next').on('click', function() {
                    testimonial_content.slick('slickNext');
                });
            });

            $('.testimonial-shortcode-wrap.slick_2').each(function() {
                var testimonial_content    = $(this).find('.slider-for');
                var testimonial_nav    = $(this).find('.slider-nav');

                testimonial_content.slick();
                testimonial_nav.slick();
            });
        },
    };

    HaruPangja.teammember = {
        init: function() {
            HaruPangja.teammember.shortcodeTeammember();
            HaruPangja.teammember.teammemberLoadMore();
            HaruPangja.teammember.teammemberInfiniteScroll();
        },
        shortcodeTeammember: function() {
            var default_filter = [];
            var array_filter = []; // Push filter to an array to process when don't have filter

            $('.teammember-shortcode-wrap.grid').each(function(index, value) {
                // Process filter each shortcode
                $(this).find('.teammember-filter li').first().find('a').addClass('selected');
                default_filter[index] = $(this).find('.teammember-filter li').first().find('a').attr('data-option-value');

                var self = $(this);
                var $container = $(this).find('.teammember-list'); // parent element of .item
                var $filter = $(this).find('.teammember-filter a');
                var masonry_options = {
                    'gutter': 0
                };

                array_filter[index] = $filter;

                // Add to process members layout style
                var layoutMode = 'fitRows';
                if (($(this).hasClass('masonry'))) {
                    var layoutMode = 'masonry';
                }

                for (var i = 0; i < array_filter.length; i++) {
                    if (array_filter[i].length == 0) {
                        default_filter = '';
                    }
                    $container.isotope({
                        itemSelector: '.team-item', // .item
                        transitionDuration: '0.4s',
                        masonry: masonry_options,
                        layoutMode: layoutMode,
                        filter: default_filter[i]
                    });
                }

                imagesLoaded(self, function() {
                    $container.isotope('layout');
                });

                $(window).resize(function() {
                    $container.isotope('layout');
                });

                $filter.on('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();

                    var $this = $(this);
                    // Don't proceed if already selected
                    if ($this.hasClass('selected')) {
                        return false;
                    }
                    var filters = $this.closest('ul');
                    filters.find('.selected').removeClass('selected');
                    $this.addClass('selected');

                    var options = {
                            layoutMode: layoutMode,
                            transitionDuration: '0.4s',
                            packery: {
                                horizontal: true
                            },
                            masonry: masonry_options
                        },
                        key = filters.attr('data-option-key'),
                        value = $this.attr('data-option-value');
                    value = value === 'false' ? false : value;
                    options[key] = value;

                    $container.isotope(options);
                });
            });
        },
        teammemberLoadMore: function() {
            $('.teammember-shortcode-paging-wrapper .teammember-load-more').off().on('click', function(event) {
                event.preventDefault();

                var $this = $(this).button('loading');
                var link = $(this).attr('data-href');
                var shortcode_wrapper = '.teammember-shortcode-wrap';
                var contentWrapper = '.teammember-shortcode-wrap .teammember-list'; // parent element of .item
                var element = '.team-item'; // .item

                $.get(link, function(data) {
                    var next_href = $('.teammember-load-more', data).attr('data-href');
                    var $newElems = $(element, data).css({
                        opacity: 0
                    });

                    $(contentWrapper).append($newElems);
                    $newElems.imagesLoaded(function() {
                        $newElems.animate({
                            opacity: 1
                        });

                        $(contentWrapper).isotope('appended', $newElems);
                        setTimeout(function() {
                            $(contentWrapper).isotope('layout');
                        }, 400);

                        HaruPangja.teammember.init();
                    });


                    if (typeof(next_href) == 'undefined') {
                        $this.parent().remove();
                    } else {
                        $this.button('reset');
                        $this.attr('data-href', next_href);
                    }

                });
            });
        },
        teammemberInfiniteScroll: function() {
            var shortcode_wrapper = '.teammember-shortcode-wrap.grid';
            var contentWrapper = '.teammember-shortcode-wrap.grid .teammember-list'; // parent element of .item
            $('.teammember-list', shortcode_wrapper).infinitescroll({
                navSelector: "#infinite_scroll_button",
                nextSelector: "#infinite_scroll_button a",
                itemSelector: ".team-item", // .item
                loading: {
                    'selector': '#infinite_scroll_loading',
                    'img': haru_framework_theme_url + '/assets/images/ajax-loader.gif',
                    'msgText': 'Loading...',
                    'finishedMsg': ''
                }
            }, function(newElements, data, url) {
                var $newElems = $(newElements).css({
                    opacity: 0
                });
                $newElems.imagesLoaded(function() {
                    $newElems.animate({
                        opacity: 1
                    });

                    $(contentWrapper).isotope('appended', $newElems);
                    setTimeout(function() {
                        $(contentWrapper).isotope('layout');
                    }, 400);

                    HaruPangja.teammember.init();
                });

            });
        }
    };

    $(document).ready(function() {
        HaruPangja.init();
    });
})(jQuery);