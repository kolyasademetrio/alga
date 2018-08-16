jQuery(document).ready(function($){

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
                footerHeight = $('footer').outerHeight(),
                footerBottom = $('footer').position().top + footerHeight;

            if (footerBottom < docHeight) {
                $('footer').css('margin-top', (docHeight - footerBottom) + 'px');
            }
        }

    })();
    /* ------------------------>>> Прижать футер к низу End <<<--------------------------------------------- */


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
            if ( $.magnificPopup.instance.isOpen && $(window).width() > 767 ) {
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

    $(document.body).on("added_to_cart", function( data ) {
        $('.good__item__add__to__cart.added').nextAll().remove();
        $('.good__item__add__to__cart.added').html('Добавлен в корзину');
    });


    /* ------------------------>>> +/- <<<------------------------------------------------- */
    $(".goodSingle__table .quantity").append('<div class="inc button">+</div><div class="dec button">-</div>');
    $(".product-quantity .quantity").append('<div class="inc button">+</div><div class="dec button">-</div>');

    $(".goodSingle__table .button, .product-quantity .button").on("click", function() {

        var $button = $(this);
        var oldValue = $button.parent().find("input").val();

        if ($button.text() == "+") {
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

    });
    /* ------------------------>>> +/- End <<<------------------------------------------------- */



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
                
                console.log( $img );

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

                $btnCloned.appendTo('.checkout__step.second');
                $btn.remove();
                $fieldWrapper.remove();
            }

    })();
    /* ------------------------>>> Вкладки для Страницы Checkout Page End <<<------------------------------------------------- */








    /*jQuery('#commentform').submit(function(){
        //объединяет всю информацию, полученную от формы, в объект
        var formData = jQuery("#commentform").serialize();

        //теперь мы можем отобразить комментарий
        var comment = jQuery('textarea#comment').val();

        jQuery.ajax({
            type: "POST",
            //это скрипт, который отправляет форму комментариев по адресу:
            url: "/wp-comments-post.php",
            //formData это наш сериализованный объект, содержащий в себе контент
            data: formData,
            success: function(){
                //при успешном выполнении загружаем контент, а также реализуем его постепенное появление:
                jQuery('#respond').prepend('<div class="message"></div>');
                jQuery('#respond .message').html("<div style='border: 1px solid #ccc; padding: 5px 10px'><b>Thank you.</b><span style='font-size: 90%;'><i>Your comment may be pending moderation.</i></span>"+comment+"</div>").hide().fadeIn(2000);
            },
            error: function(){
                //при ошибке, информируем пользователя, что он сделал не так:
            }
        });
        //страница не должна перезагружаться
        return false;
    });*/



    //при успешном выполнении загружаем контент, а также реализуем его постепенное появление:
//создаем блок div, в котором будем находиться сообщение


});