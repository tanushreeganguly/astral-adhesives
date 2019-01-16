$(document).ready(function () {
    var winWT = $(window).innerWidth();
    var tl_why = new TimelineLite();
    /*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    if (winWT <= 1023) {
        var brandList = $('#top_brands').find('li');
        $(brandList).addClass('item');
        $('#top_brands ul').owlCarousel({
            autoplay: false,
            loop: false,
            items: 3,
            margin: 0,
            stagePadding: 0,
            smartSpeed: 800,
            autoplayTimeout: 5000,
            dots: true,
            navigation: false,
            mouseDrag: true,
            pagination: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                }
            }
        });
    }else{
        loadBanners();
    }

    

    function loadBanners(){
		var preLoadImagesArray = $('.about_con [imgLoad]');
	    var loadedCount = 0;
	    function loadImages(i){
	      var src = $(preLoadImagesArray[i]).attr('src');
	      var newImg = new Image();
	      newImg.onload = function(){
	        loadedCount++;
	        if(loadedCount == preLoadImagesArray.length){
	          desktopAnim();
	        }
	      };
	      newImg.src = src;
	    }
	    for(var i = 0; i < preLoadImagesArray.length; i++){
	      loadImages(i);
	    }
	}


    function desktopAnim(){
		

		var scrollMagicController =  new ScrollMagic.Controller();

		

		tl_why.staggerTo('.banner_why li', 0.6, { height:0, ease:Sine.easeInOut}, 0.1)
			  .staggerTo('.abt_why p', 0.6, {opacity:1, y:0, ease:Sine.easeInOut},0.1)
			  .to('.abt_why .shadow', 0.6, {opacity:0.5, ease:Sine.easeInOut});


	    var scene2 = new ScrollMagic.Scene({
	              triggerElement: ".abt_why",
	              reverse:false
	            })
	            .setTween(tl_why)
	            .addTo(scrollMagicController);
		
	}

});

//Modernizr.csstransforms3d = false;

if (isMobile.any()) {
    $('#top_brands .front_face').css({ 'display': 'none' });
} else if (window.Modernizr && Modernizr.csstransforms3d && Modernizr.preserve3d) {
    document.write('<link href="assets/css/direction-reveal.css" rel="stylesheet" type="text/css">');
    document.write('<script type="text/javascript" src="assets/js/bundle.js"></script>');
} else {
    $('.direction-reveal__overlay').addClass('for_desk');
    $('#top_brands li').each(function () {
        $(this).hover(
            function () {
                TweenMax.to($(this).find('.direction-reveal__overlay'), 0.5, { top: 0, ease: Sine.easeOut }, 'startPoint')
            },
            function () {
                TweenMax.to($(this).find('.direction-reveal__overlay'), 0.5, { top: '100%', ease: Sine.easeOut }, 'startPoint')
            }
        );
    });
}
