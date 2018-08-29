jQuery(document).ready(function($) {

    $('.headerMiddle__pointsLink, .advants__btnLink').magnificPopup({
        type:'inline',
        removalDelay: 500,
        mainClass: 'mfp-fade popup_inline',
        showCloseBtn: true,
        closeMarkup: '<div class="mfp-close">&times;</div>',
        closeBtnInside: true,
        closeOnContentClick: false,
        closeOnBgClick: true,
        alignTop: false,
        fixedContentPos: true,
        callbacks: {
            open: function() {
                var headerHeight = $('.header__top').innerHeight();
                $('.mfp-content').css({
                    'marginTop': headerHeight,
                });
            },
            close: function() {

            },
            beforeOpen: function() {
                var $triggerEl = $(this.st.el),
                    newClass = 'pointsPopup';
                this.st.mainClass = this.st.mainClass + ' ' + newClass;
            }
        }
    });

    $('.headerTop__cartTotalLink').magnificPopup({
        type:'inline',
        removalDelay: 500,
        mainClass: 'mfp-fade popup_inline',
        showCloseBtn: true,
        closeMarkup: '<div class="mfp-close">&times;</div>',
        closeBtnInside: true,
        closeOnContentClick: false,
        closeOnBgClick: true,
        alignTop: false,
        fixedContentPos: true,
        callbacks: {
            open: function() {
                var headerHeight = $('.header__top').innerHeight();
                $('.mfp-content').css({
                    'marginTop': headerHeight,
                });

                setHeightFormPopup();
                $('button[name="update_cart"]').attr('disabled', false);

            },
            close: function() {

            },
            beforeOpen: function() {
                var $triggerEl = $(this.st.el),
                    newClass = 'cart__popup';
                this.st.mainClass = this.st.mainClass + ' ' + newClass;
            }
        }
    });


    niceScrollInitFormPopup();


    $('.headerMiddle__infoFeedback').magnificPopup({
        type:'inline',
        removalDelay: 500,
        mainClass: 'mfp-fade popup_inline',
        showCloseBtn: true,
        closeMarkup: '<div class="mfp-close">&times;</div>',
        closeBtnInside: true,
        closeOnContentClick: false,
        closeOnBgClick: true,
        alignTop: false,
        fixedContentPos: true,
        callbacks: {
            open: function() {
                var headerHeight = $('.header__top').innerHeight();
                $('.mfp-content').css({
                    'marginTop': headerHeight,
                });
            },
            close: function() {

            },
            beforeOpen: function() {
                var $triggerEl = $(this.st.el),
                    newClass = 'feedbackPopup';
                this.st.mainClass = this.st.mainClass + ' ' + newClass;
            }
        }
    });

    $('.headerTop__searchLink').magnificPopup({
        type:'inline',
        removalDelay: 500,
        mainClass: 'mfp-fade popup_inline',
        showCloseBtn: true,
        // closeMarkup: '<div class="mfp-close"><span class="search-close-icon">&times;</span><span class="search-close-text"> Закрыть</span></div>',
        closeMarkup: '<div class="mfp-close">Закрыть</div>',
        closeBtnInside: true,
        closeOnContentClick: false,
        closeOnBgClick: true,
        alignTop: false,
        fixedContentPos: true,
        callbacks: {
            open: function() {
                
            },
            close: function() {

            },
            beforeOpen: function() {
                var $triggerEl = $(this.st.el),
                    newClass = 'searchPopup';
                this.st.mainClass = this.st.mainClass + ' ' + newClass;
            }
        }
    });

    $('.headerMiddle__humburger').magnificPopup({
        type:'inline',
        removalDelay: 500,
        mainClass: 'mfp-fade popup_inline',
        showCloseBtn: true,
        // closeMarkup: '<div class="mfp-close"><span class="search-close-icon">&times;</span><span class="search-close-text"> Закрыть</span></div>',
        closeMarkup: '<div class="mfp-close">&times;</div>',
        closeBtnInside: true,
        closeOnContentClick: false,
        closeOnBgClick: true,
        alignTop: false,
        fixedContentPos: true,
        callbacks: {
            open: function() {
                var headerHeight = $('.header__top').innerHeight();
                $('.mfp-content').css({
                    'marginTop': headerHeight,
                });
            },
            close: function() {

            },
            beforeOpen: function() {
                var $triggerEl = $(this.st.el),
                    newClass = 'mainMenuPopup';
                this.st.mainClass = this.st.mainClass + ' ' + newClass;
            }
        }
    });

    $('.products__categoryMenuBtn').magnificPopup({
        type:'inline',
        removalDelay: 500,
        mainClass: 'mfp-fade popup_inline',
        showCloseBtn: true,
        // closeMarkup: '<div class="mfp-close"><span class="search-close-icon">&times;</span><span class="search-close-text"> Закрыть</span></div>',
        closeMarkup: '<div class="mfp-close">&times;</div>',
        closeBtnInside: true,
        closeOnContentClick: false,
        closeOnBgClick: true,
        alignTop: false,
        fixedContentPos: true,
        callbacks: {
            open: function() {
                var headerHeight = $('.header__top').innerHeight();
                $('.mfp-content').css({
                    'marginTop': headerHeight,
                });
            },
            close: function() {

            },
            beforeOpen: function() {
                var $triggerEl = $(this.st.el),
                    newClass = 'productsCategoryList__menu';
                this.st.mainClass = this.st.mainClass + ' ' + newClass;
            }
        }
    });

    $('.sliderMain__list').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        // asNavFor: '',
        dots: true,
        arrows: true,
        centerMode: true,
        focusOnSelect: true,
        autoplay: false,
        centerPadding: 0,
    });

    (function(){
        function slickSliderInit($elem){
            $elem.slick({
                // slidesToShow: 4,
                slidesToScroll: 1,
                dots: false,
                arrows: true,
                prevArrow:'<div type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button" style="display: block;"></div>',
                nextArrow:'<div type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next" role="button" style="display: block;"></div>',
                centerMode: true,
                focusOnSelect: false,
                autoplay: false,
                centerPadding: 0,
                swipe: false,
                responsive: [
                    {
                        breakpoint: 2400,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                ],
            }).removeClass('no_slider');
        }

        $('.recommended__categoryWrapper').each(function(index, elem){
            var childQty = $(elem).find('.good__item').length,
                windowWidth = $(window).width();

            if ( (childQty > 4 && windowWidth > 1199) ) {
                slickSliderInit($(elem));
            } else if ( childQty > 3 && windowWidth <= 1199 ) {
                slickSliderInit($(elem));
            } else if ( childQty > 2 && windowWidth <= 991 ) {
                slickSliderInit($(elem));
            } else if ( childQty > 1 && windowWidth <= 500 ) {
                slickSliderInit($(elem));
            } else {
                $(elem).addClass('no_slider');
            }

        });

    })();

    /* -------------- Slick Slider on content-single-product.php ------------------- */
    $('.good__gallerySlider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav',
        autoplay: false
    });
    $('.good__gallerySliderNav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.good__gallerySlider',
        dots: false,
        centerMode: false,
        focusOnSelect: true,
        vertical: true,

    });
    /* -------------- Slick Slider on content-single-product.php END --------------- */



    $('.good__gallerySlider .slick-track').each(function() {
        $(this).magnificPopup({
            type:'image',
            removalDelay: 500,
            mainClass: 'mfp-fade popup_inline',
            showCloseBtn: true,
            // closeMarkup: '<div class="mfp-close"><span class="search-close-icon">&times;</span><span class="search-close-text"> Закрыть</span></div>',
            closeMarkup: '<div class="mfp-close">&times;</div>',
            closeBtnInside: true,
            closeOnContentClick: false,
            closeOnBgClick: true,
            alignTop: false,
            fixedContentPos: true,
            callbacks: {
                open: function() {
                    var headerHeight = $('.header__top').innerHeight();
                    $('.mfp-content').css({
                        'marginTop': headerHeight,
                    });

                    var mp = $.magnificPopup.instance,
                        t = $(mp.currItem.el[0]);

                    if ( t.data('type') === 'video' ) {
                        if ( !$(this.wrap[0]).find('img.mfp-img').hasClass('has__video') ) {
                            var $imgVideo = $(this.wrap[0]).find('img.mfp-img'),
                                $dataVideo = $(this.currItem.el).attr('href');
                            $imgVideo.addClass('has__video').attr('data-video', $dataVideo);
                            $imgVideo.parent('figure').addClass('wrap__hasVideo');
                            if ( !$imgVideo.parent('figure').find('.hasVideo__play').length ) {
                                $imgVideo.parent('figure').append('<div class="hasVideo__play"></div>');
                            }
                        }
                    }
                },
                close: function() {

                },
                beforeOpen: function() {
                    var $triggerEl = $(this.st.el),
                        newClass = 'productsSingle__gallery';
                    this.st.mainClass = this.st.mainClass + ' ' + newClass;

                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                },
                elementParse: function(item) {
                    item.src = item.el.find('img').attr('src');

                },
                markupParse: function(template, values, item) {

                },
                change: function(){
                    var mp = $.magnificPopup.instance,
                        t = $(mp.currItem.el[0]);

                    if ( !$(this.content[0]).find('img.mfp-img').hasClass('has__video') ) {
                        $(this.content[0]).find('img.mfp-img').parent('figure').find('iframe').remove();
                    }

                    if ( t.data('type') === 'video' ) {
                        if ( !$(this.content[0]).find('img.mfp-img').hasClass('has__video') ) {
                            var $imgVideo = $(this.content[0]).find('img.mfp-img'),
                                $dataVideo = $(this.currItem.el).attr('href');

                            $imgVideo.addClass('has__video').attr('data-video', $dataVideo);
                            $imgVideo.parent('figure').addClass('wrap__hasVideo');
                            if ( !$imgVideo.parent('figure').find('.hasVideo__play').length ) {
                                $imgVideo.parent('figure').append('<div class="hasVideo__play"></div>');
                            }

                        }
                    } else {
                        $(this.content[0]).find('img.mfp-img').parent('figure').removeClass('wrap__hasVideo');
                        $(this.content[0]).find('img.mfp-img').parent('figure').find('.hasVideo__play').remove();
                    }
                }
            },
            gallery: {
                enabled:true,
                navigateByImgClick: false,
            },
            delegate: '.good__gallerySliderItem',
        });
    });


    /* movietiphome__slider */
    $('.movietiphome__slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        centerMode: false,
        focusOnSelect: true,

    });

    $('.movietiphome__slider .slick-track').each(function() {
        $(this).magnificPopup({
            type:'image',
            removalDelay: 500,
            mainClass: 'mfp-fade popup_inline',
            showCloseBtn: true,
            closeMarkup: '<div class="mfp-close">&times;</div>',
            closeBtnInside: true,
            closeOnContentClick: false,
            closeOnBgClick: true,
            alignTop: false,
            fixedContentPos: true,
            titleSrc: function(item) {
              return item.el.attr('title');
            },
            callbacks: {
                open: function() {
                    var headerHeight = $('.header__top').innerHeight();
                    $('.mfp-content').css({
                        'marginTop': headerHeight,
                    });

                    var mp = $.magnificPopup.instance,
                        t = $(mp.currItem.el[0]);

                    var $imgVideo = $(this.wrap[0]).find('img.mfp-img'),
                        $dataVideo = $(this.currItem.el).attr('href');
                    $imgVideo.addClass('has__video').attr('data-video', $dataVideo);

                    $imgVideo.parent('figure').append('<div class="movietiphome__play"></div>');
                },
                close: function() {

                },
                beforeOpen: function() {
                    var $triggerEl = $(this.st.el),
                        newClass = 'movietiphome__gallery';
                    this.st.mainClass = this.st.mainClass + ' ' + newClass;

                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                },
                elementParse: function(item) {
                    item.src = item.el.find('img').attr('src');

                },
                markupParse: function(template, values, item) {

                },
                change: function(){
                    var mp = $.magnificPopup.instance,
                        t = $(mp.currItem.el[0]);

                    var $imgVideo = $(this.wrap[0]).find('img.mfp-img'),
                        $dataVideo = $(this.currItem.el).attr('href');
                    $imgVideo.addClass('has__video').attr('data-video', $dataVideo);
                }
            },
            gallery: {
                enabled:false,
                navigateByImgClick: false,
            },
            delegate: '.movietiphome__link',
        });
    });
    /* movietiphome__slider End */


    /* попап на странице Видеосоветов */
    $('.videotip__items').each(function() {
        $(this).magnificPopup({
            type:'image',
            removalDelay: 500,
            mainClass: 'mfp-fade popup_inline',
            showCloseBtn: true,
            closeMarkup: '<div class="mfp-close">&times;</div>',
            closeBtnInside: true,
            closeOnContentClick: false,
            closeOnBgClick: true,
            alignTop: false,
            fixedContentPos: true,
            titleSrc: function(item) {
                return item.el.parent('.videotip__itemInner').attr('title');
            },
            callbacks: {
                open: function() {
                    var headerHeight = $('.header__top').innerHeight();
                    $('.mfp-content').css({
                        'marginTop': headerHeight,
                    });

                    var mp = $.magnificPopup.instance,
                        t = $(mp.currItem.el[0]);

                    var $imgVideo = $(this.wrap[0]).find('img.mfp-img'),
                        $dataVideo = $(this.currItem.el).attr('href');
                    
                    $imgVideo.addClass('has__video').attr('data-video', $dataVideo);

                    $imgVideo.parent('figure').append('<div class="movietiphome__play"></div>');
                },
                close: function() {

                },
                beforeOpen: function() {
                    var $triggerEl = $(this.st.el),
                        newClass = 'movietiphome__gallery';
                    this.st.mainClass = this.st.mainClass + ' ' + newClass;

                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                },
                elementParse: function(item) {
                    item.src = item.el.find('img').attr('src');
                },
                markupParse: function(template, values, item) {

                },
                change: function(){
                    var mp = $.magnificPopup.instance,
                        t = $(mp.currItem.el[0]);

                    var $imgVideo = $(this.wrap[0]).find('img.mfp-img'),
                        $dataVideo = $(this.currItem.el).attr('href');
                    $imgVideo.addClass('has__video').attr('data-video', $dataVideo);
                }
            },
            gallery: {
                enabled:false,
                navigateByImgClick: false,
            },
            delegate: '.videotip__itemInner',
        });
    });
    /* попап на странице Видеосоветов End */


    /* попап на странице Одного Видеосовета */
    $('.movietiphome_single__inner').each(function() {
        $(this).magnificPopup({
            type:'image',
            removalDelay: 500,
            mainClass: 'mfp-fade popup_inline',
            showCloseBtn: true,
            closeMarkup: '<div class="mfp-close">&times;</div>',
            closeBtnInside: true,
            closeOnContentClick: false,
            closeOnBgClick: true,
            alignTop: false,
            fixedContentPos: true,
            callbacks: {
                open: function() {
                    var headerHeight = $('.header__top').innerHeight();
                    $('.mfp-content').css({
                        'marginTop': headerHeight,
                    });

                    var mp = $.magnificPopup.instance,
                        t = $(mp.currItem.el[0]);

                    var $imgVideo = $(this.wrap[0]).find('img.mfp-img'),
                        $dataVideo = $(this.currItem.el).parent('.movietiphome_single__link').attr('href');
                    
                    $imgVideo.addClass('has__video').attr('data-video', $dataVideo);

                    $imgVideo.parent('figure').append('<div class="movietiphome__play"></div>');
                },
                close: function() {

                },
                beforeOpen: function() {
                    var $triggerEl = $(this.st.el),
                        newClass = 'movietiphome__gallery';
                    this.st.mainClass = this.st.mainClass + ' ' + newClass;

                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                },
                elementParse: function(item) {
                    item.src = item.el.parent('.movietiphome_single__link').find('img').attr('src');
                },
                markupParse: function(template, values, item) {
                    values.title = item.el.parent('.movietiphome_single__link').attr('title');
                },
                change: function(){
                    var mp = $.magnificPopup.instance,
                        t = $(mp.currItem.el[0]);

                    var $imgVideo = $(this.wrap[0]).find('img.mfp-img'),
                        $dataVideo = $(this.currItem.el).attr('href');
                    $imgVideo.addClass('has__video').attr('data-video', $dataVideo);
                }
            },
            gallery: {
                enabled:false,
                navigateByImgClick: false,
            },
            delegate: '.movietiphome_single__play',
        });
    });
    /* попап на странице Одного Видеосовета End */


    /* Слайдер на главной Посмотреть отзывы */
    (function(){
        function slickSliderInit($elem){
            $elem.slick({
                // slidesToShow: 4,
                slidesToScroll: 1,
                dots: false,
                arrows: true,
                prevArrow:'<div type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button" style="display: block;"></div>',
                nextArrow:'<div type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next" role="button" style="display: block;"></div>',
                centerMode: true,
                focusOnSelect: false,
                autoplay: false,
                centerPadding: 0,
                swipe: false,
                responsive: [
                    {
                        breakpoint: 2400,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                ],
            }).removeClass('no_slider');
        }

        $('.feedbackhome__slider').each(function(index, elem){
            var childQty = $(elem).find('.usersfeedback__item').length,
                windowWidth = $(window).width();

            if ( (childQty > 4 && windowWidth > 1199) ) {
                slickSliderInit($(elem));
            } else if ( childQty > 3 && windowWidth <= 1199 ) {
                slickSliderInit($(elem));
            } else if ( childQty > 2 && windowWidth <= 991 ) {
                slickSliderInit($(elem));
            } else if ( childQty > 1 && windowWidth <= 600 ) {
                slickSliderInit($(elem));
            } else {
                $(elem).addClass('no_slider');
            }

        });

    })();
    /* Слайдер на главной Посмотреть отзывы End */


    /* попап Видеоотзыва */
    $('.usersfeedback__videolink').magnificPopup({
        type: 'iframe',
        gallery: {enabled:false},
        iframe: {
            markup: '<div class="mfp-iframe-scaler">' +
            '<div class="mfp-close"></div>' +
            '<iframe width="854" height="480" class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
            '</div>' +
            '<div class="mfp-bottom-bar">' +
            '<div class="mfp-title username"></div>' +
            '<div class="mfp-subtitle usermessage"></div>' +
            '</div>',
            patterns: {
                youtube: {
                    index: 'youtube.com/',
                    id: function(url) {
                        var m = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
                        if ( !m || !m[1] ) return null;
                        return m[1];
                    },
                    src: '//www.youtube.com/embed/%id%?autoplay=1'
                }
            },
            srcAction: 'iframe_src',
        },
        callbacks: {
            open: function() {
                var headerHeight = $('.header__top').innerHeight();
                $('.mfp-content').css({
                    'marginTop': headerHeight,
                });

                var userName = $(this.st.el).closest('.usersfeedback__item').find('.usersfeedback__name').html(),
                    userMessage = $(this.st.el).data('title');

                $('.mfp-title.username').html(userName);
                $('.mfp-subtitle.usermessage').html(userMessage);
            },
            close: function() {

            },
            beforeOpen: function() {
                var $triggerEl = $(this.st.el),
                    newClass = 'feedback__movie__popup';
                
                this.st.mainClass = this.st.mainClass + ' ' + newClass;

                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
            },
            elementParse: function(item) {},
            markupParse: function(template, values, item) {},
            change: function(){}
        },
    });




    /*$('.button').magnificPopup({
        type: 'iframe',
        iframe: {
            markup: '<div class="mfp-iframe-scaler">'+
            '<div class="mfp-close"></div>'+
            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
            '</div>',
            patterns: {
                youtube: {
                    index: 'youtube.com/',
                    id: 'v=',
                    src: '//www.youtube.com/embed/%id%?autoplay=1'
                }
            },
            srcAction: 'iframe_src',
        }
    });*/
    /* попап Видеоотзыва End */



    /*$('.good__gallerySlider .slick-track').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled:true
            }
        });
    });*/




});

