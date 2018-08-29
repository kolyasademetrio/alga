function setHeightFormPopup(){
    var trThHeight = $('#cart__popup table.cart thead tr').height(),
        trTdFirstHeight = $('#cart__popup table.cart tbody tr:first-child').height(),
        trTdSecondHeight = $('#cart__popup table.cart tbody tr:nth-child(2)').height(),
        heightSumm = trThHeight + trTdFirstHeight + trTdSecondHeight;
    $('.cart__popup__tableWrap').height(heightSumm + 1);
}

function niceScrollInitFormPopup(){
    $(".cart__popup__tableWrap").niceScroll({
        scrollspeed: 100,
        mousescrollstep: 55,
        cursorwidth: 4,
        cursorborder: '',
        zindex: 9999,
        cursorcolor: '#b8b8b8',
        cursorborderradius: 0,
        horizrailenabled: true,
        background: '#fafafa',
        autohidemode: false,
        overflowy: false,
        callbacks: {
            open: function() {

            }
        },
    });
}

function addLoaderPopupCart($that){
    if ( $that.closest('#cart__popup').length ) {
        if( !$('#cart__popup').find('.dnk__loader').length ) {
            $('#cart__popup').append('<div class="dnk__loader"></div>');
        }
        if( !$('#cart__popup').find('.dnk__loaderBG').length ) {
            $('#cart__popup').append('<div class="dnk__loaderBG"></div>');
        }

        $('#cart__popup').css({
            'position': 'relative',
        });
    }
}

$(document).on('click', '[name="woocommerce_checkout_place_order"]', function(){
    if( !$(this).closest('form[name="checkout"]').find('.dnk__loader').length ) {
        $(this).closest('form[name="checkout"]').append('<div class="dnk__loader"></div>');
    }
    if( !$(this).closest('form[name="checkout"]').find('.dnk__loaderBG').length ) {
        $(this).closest('form[name="checkout"]').append('<div class="dnk__loaderBG"></div>');
    }

    $(this).closest('form[name="checkout"]').css({
        'position': 'relative',
    });
});

/*$('form[name="checkout"]').on('submit', function(e){
    e.stopImmediatePropagation();
    e.preventDefault();
    return false;
});*/

/* ------------------------>>> +/- <<<------------------------------------------------- */
$(document).on('click', '.button', function(){
    if ( $(this).parent('.quantity').length ) {
        var $button = $(this),
            oldValue = $button.parent().find("input").val();

        if ( $button.hasClass('inc') ) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);

        if ( $button.parents('.cart__popup').length ) {
            $button.parents('.cart__popup').find('button[name="update_cart"]').click();
        }

       /* if ( $button.closest('form[name="checkout"]').length ) {
            $(document.body).trigger("wc_update_cart");
            $(document.body).trigger("update_checkout");
        }*/

        addLoaderPopupCart( $button );
    }
});

$(document).on('click', '.woocommerce-cart-form .remove', function(){
    addLoaderPopupCart( $(this) );
});

function plusMinus(){
    if ( !$(".quantity").find('.button').length ) {
        $(".quantity").append('<div class="inc button">+</div><div class="dec button">-</div>');
    }

    if ( !$(".qty_checkout").find('.button').length ) {
        $(".qty_checkout .quantity").append('<div class="inc button">+</div><div class="dec button">-</div>');
    }

    if ( !$('#cart__popup .quantity').find('.button').length ) {
        $("#cart__popup .quantity").append('<div class="inc button">+</div><div class="dec button">-</div>');
    }
}

$(document).ajaxComplete(function(){
    plusMinus();
});
/* ------------------------>>> +/- End <<<------------------------------------------------- */

jQuery(document).ready(function($){

    plusMinus();

    $(document.body).on("added_to_cart", function( data ) {
        $('.good__item__add__to__cart.added').nextAll().remove();
        $('.good__item__add__to__cart.added').html('Добавлен в корзину');
    });

    $( document.body ).on( 'updated_cart_totals', function(){
        // plusMinus();
        setHeightFormPopup();
        niceScrollInitFormPopup();
        $('button[name="update_cart"]').attr('disabled', false);
    });

    /* ------------------------>>> Прижать футер к низу <<<------------------------------------------------- */
    (function(){
        $(window).load(function(){
            footer();
        });

        $(window).resize(function() {
            footer();
        });

        function footer() {
            var docHeight = $(window).height(),
                footerHeight = $('footer.footer').outerHeight(),
                footerBottom = $('footer.footer').position().top + footerHeight;

            if (footerBottom < docHeight) {
                $('footer.footer').css('margin-top', (docHeight - footerBottom) + 'px');
            }
        }

    })();
    /* ------------------------>>> Прижать футер к низу End <<<--------------------------------------------- */


    /*--------------------------------- функция для якоря -------------------------*/
    $(window).scroll(function(){
        if( $(window).scrollTop() > 100 ) {
            $('.ancor__up').show();
        } else {
            $('.ancor__up').hide();
        }
    });

    function ancor (ancor, goal) {
        $(ancor).on('click', function(e){
            $('html,body').stop().animate({ scrollTop: $(goal).offset().top }, 1000);
            e.preventDefault();
        });
    }

    ancor($('.ancor__up'), $('#header'));
    /*--------------------------------- функция для якоря Конец -------------------------*/


    /* ------------------------>>> выравнивает по ширине пункты верхнего меню и части логотипа в Шапке <<<------------------------------------ */
    (function(){

        if ( $(window).width() >= 992 ) {
            var $headerTop__menuItem = $('.headerTop__menuItem');

            $headerTop__menuItem.each(function(index, elem){
                var elemWidth = $(elem).innerWidth();

                if ( index === 0 && $('.headerMiddle__logoLink').length ) {
                    $('.headerMiddle__logoLink').css({
                        'width': elemWidth
                    });
                } else if ( index === 1 && $('.headerMiddle__logoText').length) {
                    $('.headerMiddle__logoText').css({
                        'width': elemWidth
                    });
                }
            });
        }

    })();
    /* ------------------------>>> выравнивает по ширине пункты верхнего меню и части логотипа в Шапке End <<<------------------------------------ */
    
    
    /* ------------------------>>> задает ширину пустому блоку слева от Маркера в Шапке(равна ширине правого) <<<--------------------------------- */
    (function(){

        if ( $('.headerMiddle__pointsRight').length || $('.headerMiddle__pointsLeft').length ) {
            if ( $(window).width() >= 992 ) {
                var $pointsRight = $('.headerMiddle__pointsRight'),
                    pointsRightWidth = $pointsRight.innerWidth();

                $('.headerMiddle__pointsLeft').css({
                    'width': pointsRightWidth,
                });
            }
        }
    })();
    /* ------------------------>>> задает ширину пустому блоку слева от Маркера в Шапке(равна ширине правого) End <<<------------------------------ */



    /* ------------------------>>> адаптивное Меню <<<--------------------------------- */
    (function(){
        function responsiveMenuMain(){
            if ( $('.headerBottom__menu').length ) {
                if ( $(window).width() <= 767 && !$.magnificPopup.instance.isOpen ) {
                    $('.headerBottom__menu').addClass('mfp-hide');
                } else {
                    $('.headerBottom__menu').removeClass('mfp-hide');
                }
            }
        }

        responsiveMenuMain();

        $(window).resize(function(){
            if ( $.magnificPopup.instance.isOpen && $(window).width() > 767 && $('.mainMenuPopup').length ) {
                $.magnificPopup.instance.close();
            }
            responsiveMenuMain();
        });
    })();
    /* ------------------------>>> адаптивное Меню End <<<------------------------------ */



    /* ------------------------>>> адаптивное Меню категорий на странице Shop <<<--------------------------------- */
    (function(){
        if ( $('.products__categoryList').length ) {
            if ( $(window).width() <= 991 ) {
                $('.products__categoryList').addClass('mfp-hide');
            } else {
                $('.products__categoryList').removeClass('mfp-hide');
            }
        }
    })();
    /* ------------------------>>> адаптивное Меню категорий на странице Shop End <<<------------------------------ */



    /* ------------------------>>> Вкладки с категориями на Главной <<<------------------------------------------------- */
    (function(){
        $('.recommended__categoryItemLink').eq(0).addClass('active');
        $('.recommended__categoryWrapper').eq(0).addClass('active');


        $(document).on('click', '.recommended__categoryItemLink', function(e){
            var this_index = $(this).closest('.recommended__categoryItem').index();

            $('.recommended__categoryItemLink').removeClass('active');
            $(this).addClass('active');
            $('.recommended__categoryWrapper').removeClass('active');
            $('.recommended__categoryWrapper').eq(this_index).addClass('active');

            setTimeout(function(){
                $('.recommended__categoryWrapper').resize();
            }, 1000);

            e.preventDefault();
        });

    })();
    /* ------------------------>>> Вкладки с категориями на Главной End <<<------------------------------------------------- */





    /* ------------------------>>> Подгрузка видео вместо картинки при клике на этой картинке в Карточке товара <<<------------------------------------------------- */
    function gup( name, url ) {
        if (!url) url = location.href;
        name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
        var regexS = "[\\?&]"+name+"=([^&#]*)";
        var regex = new RegExp( regexS );
        var results = regex.exec( url );
        return results == null ? null : results[1];
    }

    $(function() {
        $(document).on('click', '.hasVideo__play', function(e) {
            var $img = $(this).parent('.wrap__hasVideo').find('.mfp-img.has__video'),
                dataVideo = $img.data('video'),
                videoID = gup('v', dataVideo),
                iframe_url = "https://www.youtube.com/embed/" + videoID + "?autoplay=1&autohide=1",
                iframe = '<iframe width="' + $img.width() + '" height="' + $img.height() + '" src="' + iframe_url + '" frameborder="0"></iframe>';

            $img.parent('figure').css({
                'padding': '40px 0'
            }).addClass('clicked');
            $img.before(iframe);
            $('.hasVideo__play').remove();
        });
    });

    (function(){

    		$(document).on('click', '.mfp-content .movietiphome__play', function(){
                var $img = $(this).parent('figure').find('.mfp-img.has__video'),
                    dataVideo = $img.data('video'),
                    videoID = gup('v', dataVideo),
                    iframe_url = "https://www.youtube.com/embed/" + videoID + "?autoplay=1&autohide=1",
                    iframe = '<iframe width="' + $img.width() + '" height="' + $img.height() + '" src="' + iframe_url + '" frameborder="0"></iframe>';
                
               $img.parent('figure').css({
                    'padding': '0'
                }).addClass('clicked');
                $img.before(iframe);

                $('.mfp-content .movietiphome__play').remove();
                $img.next('figcaption').remove();
            });

    })();
    /* ------------------------>>> Подгрузка видео вместо картинки при клике на этой картинке в Карточке товара End <<<------------------------------------------------- */





    /* ------------------------>>> Вкладки для Страницы Checkout Page <<<------------------------------------------------- */
    (function(){

    		if ( $('.woocommerce-billing-fields__field-wrapper').length ) {
                var $fieldWrapper = $('.woocommerce-billing-fields__field-wrapper'),
                $fields = $fieldWrapper.children('p'),
                firstGroupIDs = ['billing_first_name_field', 'billing_phone_field', 'billing_last_name_field', 'billing_email_field'];

                $fieldWrapper.wrap('<div class="checkout__steps"></div>');
                $('.checkout__steps').prepend('<div class="checkout__step first active"></div><div class="checkout__step second"></div>');

                $fields.each(function(index, elem){
                    var $clonedElem = $(elem).clone(),
                        elemID = $(elem).attr('id');

                    if ( $.inArray( elemID, firstGroupIDs ) !== -1 ) {
                        $clonedElem.appendTo('.checkout__step.first');
                    } else {
                        $clonedElem.appendTo('.checkout__step.second');
                    }
                    $(elem).remove();
                });

                var $btn = $('.woocommerce-checkout-payment#payment'),
                    $btnCloned = $('.woocommerce-checkout-payment#payment').clone();

                $('<a href="#" class="button alt">Далее</a>').appendTo('.checkout__step.first');
                $btnCloned.appendTo('.checkout__step.second');
                $btn.remove();
                $fieldWrapper.remove();

                function is_valid_email($elem){
                    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);

                    if ( ! pattern.test( $elem.val()  ) ) {
                        return false;
                    }

                    return true;
                }

                $(document).on('click', '.checkout__step.first a.button', function(e){
                    var $billing_first_name = $(this).closest('.checkout__step').find('input[name="billing_first_name"]'),
                        $billing_phone = $(this).closest('.checkout__step').find('input[name="billing_phone"]'),
                        $billing_last_name = $(this).closest('.checkout__step').find('input[name="billing_last_name"]'),
                        $billing_email = $(this).closest('.checkout__step').find('input[name="billing_email"]'),
                        error = false;

                    if ( !is_valid_email( $billing_email ) ) {
                        error = true;
                    }

                    if( $billing_phone.mask("+38(999)999-99-99").val().length == 0) {
                        error = true;
                        $billing_phone.mask("+38(999)999-99-99");
                        $billing_phone.closest('.form-row').removeClass( 'woocommerce-validated' ).addClass( 'woocommerce-invalid woocommerce-invalid-email' );
                    }

                    if( $billing_first_name.val() === '' ){
                        error = true;
                        $billing_first_name.closest('.form-row').removeClass( 'woocommerce-validated' ).addClass( 'woocommerce-invalid woocommerce-invalid-email' );
                    }

                    if( $billing_last_name.val() === '' ){
                        error = true;
                        $billing_last_name.closest('.form-row').removeClass( 'woocommerce-validated' ).addClass( 'woocommerce-invalid woocommerce-invalid-email' );
                    }

                    if ( !error ) {
                        $(this).closest('.checkout__step').removeClass('active');
                        $(this).closest('.checkout__step').next('.checkout__step').addClass('active');

                        $('.checkout__steps__tabs li span').removeClass('active');
                        $('.checkout__steps__tabs li:nth-child(2) span').addClass('active');

                        $('#shipping_method_select').val( $('input[name="shipping_method[0]"]:checked').val() );
                    }
                    e.preventDefault();
                });

                $(document).on('click', '.checkout__link.first__step', function(e){
                    if ( !$(this).hasClass('active') ) {
                        $(this).closest('.checkout__wrapper').find('.checkout__step.second').removeClass('active');
                        $(this).closest('.checkout__wrapper').find('.checkout__step.first').addClass('active');

                        $('.checkout__link').removeClass('active');
                        $(this).addClass('active');
                    }
                    e.preventDefault();
                });

                var $checkbox = $('#shipping_method input[type=radio]');
                var $select = $('<select id="shipping_method_select"></select>');    // create a select
                var $selectWrpap = '<p class="form-row form-row">' +
                                        '<label for="shipping_method_select" class="">Варианты доставки&nbsp;</label>' +
                                        '<span class="woocommerce-input-wrapper"></span>' +
                                    '</p>';

                $checkbox.each(function(i, checkbox){
                    var val = $checkbox.eq(i).val(),
                        text = $checkbox.eq(i).next('label').text();

                    if ( $checkbox.eq(i).is(":checked") ) {
                        $select.prepend($('<option>').val(val).text(text));
                        $select.val(val);
                    } else {
                        $select.append($('<option>').val(val).text(text));
                    }
                });

                var $shippingMethodClone = $('#shipping_method').clone().addClass('cloned');
                $('#shipping_method').remove();

                $('#shipping_date_field').after($selectWrpap);
                $('label[for="shipping_method_select"]').next('.woocommerce-input-wrapper').append($select);
                $('label[for="shipping_method_select"]').next('.woocommerce-input-wrapper').append($shippingMethodClone);

                $('#shipping_method_select').change(function(){
                    var data= $(this).val();
                    var el = $(this).next('ul').find('input[value="'+data+'"]').click();
                    console.log(el);
                });
            }

        $('input[name="billing_phone"]').mask("+38(999)999-99-99");



    })();
    /* ------------------------>>> Вкладки для Страницы Checkout Page End <<<------------------------------------------------- */


    /* ------------------------>>> Лоадер на Карточке товара по клику на кнопке Добавить в корзину <<<------------------------------------------------- */
    (function(){
        $(document).on('click', '.good__item__add__to__cart', function(){
            var $closestItem = $(this).closest('.good__item'),
                $closestWrap = $closestItem.find('.good__itemContent');

            $closestItem.addClass('dnk__loading');
            $closestWrap.append('<div class="dnk__loader"></div>');
            $closestWrap.append('<div class="dnk__loaderBG"></div>');
        });

        $('body').on('added_to_cart',function(){
            $('.good__item.dnk__loading').find('.dnk__loader').remove();
            $('.good__item.dnk__loading').find('.dnk__loaderBG').remove();
            $('.good__item.dnk__loading').removeClass('dnk__loading');

        });
    })();
    /* ------------------------>>> Лоадер на Карточке товара по клику на кнопке Добавить в корзину End <<<------------------------------------------------- */






    $('button[name="apply_coupon"]').on('click', function( ev ) {
        var code = $( 'input[name="coupon_code"]').val();
        data = {
            action: 'rempty_coupon_page',
            coupon_code: code
        };
        $.post( woocommerce_params.ajax_url, data, function( returned_data ) {
            if( returned_data.result == 'error' ) {
                $('.woocommerce-cart-form__message').html('<p>'+returned_data.message+'</p>');
                $('.woocommerce-cart-form__message').removeClass('success').removeClass('error').addClass('error');
            } else if ( returned_data.result == 'success' ) {
                $('.woocommerce-cart-form__message').html('<p>'+returned_data.message+'</p>');
                $('.woocommerce-cart-form__message').removeClass('success').removeClass('error').addClass('success');
            }
        });
        ev.preventDefault();
    });


});