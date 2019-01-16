$(document).ready(function () {
    var winWidth = $(window).innerWidth();

    /*+++++++++++Scroll To Code++++++++++++*/
    var tabList = $('.product_graystrip').find('span');
    tabList.each(function () {
        $(this).bind('click', function () {
            var scrollPos = $(this).attr('scrollTo');
            //console.log(currId);
            // $("html, body").animate({ scrollTop:($(scrollPos).offset().top - 180) }, {duration:1200});
        });
    });
    /*+++++++++++Scroll To Code++++++++++++*/

    /*Open Specifications On Mobile*/
    $('.res_specs_tl a').bind('click', function () {

        if ($(this).hasClass('open')) {
            $('.specs_list').slideUp(300);
            $(this).removeClass('open');
            TweenMax.to('.res_specs_tl img', 0.5, { rotation: 0, ease: Sine.easeInOut });
        } else {
            $('.specs_list').slideDown(300);
            $(this).addClass('open');
            TweenMax.to('.res_specs_tl img', 0.5, { rotation: 180, ease: Sine.easeInOut });
        }

    });


    /*if(winWidth <= 767){
        $('.specs_list span').bind('click', function(){
            $('.specs_list').slideUp(300);
            $('.res_specs_tl a').removeClass('open');
            TweenMax.to('.res_specs_tl img',0.5, {rotation: 0, ease:Sine.easeInOut});
        });
    }*/

    /*Open Specifications On Mobile*/

    $('.image_link_01').magnificPopup({
	    type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below'
        closeOnBgClick: true,
        gallery: {
            enabled: true, // set to true to enable gallery

            preload: [0, 2], // read about this option in next Lazy-loading section

            navigateByImgClick: true,

            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button

            tPrev: 'Previous (Left arrow key)', // title for left button
            tNext: 'Next (Right arrow key)' // title for right button

        },

        zoom: {
            enabled: true, // By default it's false, so don't forget to enable it

            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function

            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function (openerElement) {
                // openerElement is the element on which popup was initialized, in this case its <a> tag
                // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }

    });

    $('.video_link').magnificPopup({
        type: 'iframe',
        closeOnBgClick: true,
        modal: true,
        gallery: {
            enabled: true
        }
    });



    /*Gallery Images Load*/
    function loadImgs() {
        var imgs = $('.loader_gif');
        function sendToload(i) {
            var img = $(imgs[i]);
            var src = img.attr('orgSrc');
            var imgTag = $('<img class="gal_img"  src="">');
            img.after(imgTag);
            imgTag.load(function () {
                TweenMax.to(imgTag, 0.8, { opacity: 1, ease: Power2.easeOut });
            });
            imgTag.attr('src', src);
        }

        for (var i = 0; i < imgs.length; i++) {
            sendToload(i);
        }

    }
    loadImgs();

    var mediaTab = $('.specs_list').find('span');
    mediaTab.each(function () {
        $(this).bind('click', function () {
            var currTab = '#gallery_' + $(this).attr('attr');
            $('.galleryCon').css({ 'display': 'none' });
            $(currTab).fadeIn(300);
            $('.product_graystrip span').removeClass('activeTab');
            $(this).addClass('activeTab');
        });
    });

});