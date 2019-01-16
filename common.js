var isMobile = new Object();
isMobile.Android = function () { return navigator.userAgent.match(/Android/i); }
isMobile.BlackBerry = function () { return navigator.userAgent.match(/BlackBerry/i); }
isMobile.iOS = function () { return navigator.userAgent.match(/iPhone|iPad|iPod/i); }
isMobile.iPad = function () { return navigator.userAgent.match(/iPad/i); }
isMobile.Opera = function () { return navigator.userAgent.match(/Opera Mini/i); }
isMobile.Windows = function () { return navigator.userAgent.match(/IEMobile/i); }
isMobile.Firefox = function () { return navigator.userAgent.match(/Firefox/ig); }
isMobile.InternetExplorer = function () { return navigator.userAgent.match(/MSIE/ig); }
isMobile.Opera = function () { return navigator.userAgent.match(/Opera/ig); }
isMobile.Safari = function () { return navigator.userAgent.match(/Safari/ig); }

isMobile.Edge = function () { return null }
if (document.documentMode || /Edge/.test(navigator.userAgent)) {
	isMobile.Edge = function () { return true }
}

isMobile.any = function () { return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows()); }
if (isMobile.any() && isMobile.iPad() == null) {
	//return;
}

$(document).ready(function () {
	var winWidth = $(window).innerWidth();
	var headerHT = $('header').innerHeight();
	var headerTopHT = $('.hd_top').innerHeight();
	var resHeaderHT = $('.hd_bottom').innerHeight();
	var topOfGrayStrip;

	$('.slimmenu').slimmenu({
		resizeWidth: '1157',
		collapserTitle: '',
		animSpeed: 'medium',
		indentChildren: true,
		childrenIndenter: '&raquo;'
	});

	if (winWidth < 1157) {
		var topHeader = $('.hd_top').remove();
		$(topHeader).insertAfter('ul.slimmenu.collapsed > li:last-child');
		TweenMax.set('.hd_top', { display: 'block' });

		var resSearch = $('.search').remove();
		$('.res_top').append(resSearch);

		$('#nav-icon1').click(function(){
			if($('#nav-icon1').hasClass('open')){
				$(this).removeClass('open');
				closeMobileMenu();
			}else{				
				$(this).addClass('open');
				TweenMax.to('nav', 0.5, {left: 0, ease: Sine.easeInOut });
				TweenMax.set('.menuOverlay',{'display':'block'},'lable');
				TweenMax.set('body',{'overflow':'hidden'},'lable');
			}
		});

		$('.menuOverlay').bind('click', function(){
			$('#nav-icon1').removeClass('open');
			closeMobileMenu();
		});
		$('.mobileMenuClose').bind('click', function(){
			$('#nav-icon1').removeClass('open');
			closeMobileMenu();
		});

		function closeMobileMenu(){
			TweenMax.to('nav', 0.5, {left: '-100%', ease: Sine.easeInOut} ,'lable');
			TweenMax.set('.menuOverlay',{'display':'none'},'lable');
			TweenMax.set('body',{'overflow':'auto'});
		}

		/*$( "html" ).on( "swiperight", swiperightHandler );
		function swiperightHandler( event ){
			TweenMax.to('nav', 0.5, {left: 0, ease: Sine.easeInOut });
		}
		$( "html" ).on( "swipeleft", swipeleftHandler );
		function swipeleftHandler( event ){
			TweenMax.to('nav', 0.5, {left:'-100%', ease: Sine.easeInOut });
			$('#nav-icon1').removeClass('open');
		}*/
	}

	TweenMax.set('#search_con', { opacity: 0, top: '-50%' });
	$('.search').bind('click', function () {
		TweenMax.to('#search_con', 0.8, { opacity: 1, top: 0, ease: Sine.easeInOut });
	});

	$('.closeSearch').bind('click', function () {
		TweenMax.to('#search_con', 0.8, { opacity: 0, top: '-50%', ease: Sine.easeInOut });
	});


	$('.footerClose').bind('click', function () {
		if ($(this).hasClass('open')) {
			$('.footerClose').removeClass('open');
			$('.footer').slideDown(500);
			$("html, body").animate({ scrollTop: ($('.footer').offset().top - 70) }, { duration: 1200, easing: 'easeInOutCubic' });
			TweenMax.to('.arrow', 0.5, { rotation: 180, ease: Sine.easeInOut });
			$('.ft_close').empty();
			$('.ft_close').text('Close');
		} else {
			$('.footerClose').addClass('open');
			$('.footer').slideUp(500);
			TweenMax.to('.arrow', 0.5, { rotation: 0, ease: Sine.easeInOut });
			$('.ft_close').empty();
			$('.ft_close').text('Open');
		}
	});

	function setWrapperFromHeader() {
		if (winWidth > 1157) {
			TweenMax.set('.gutter', { paddingTop: headerHT + 'px' });
		} else {
			TweenMax.set('.gutter', { paddingTop: resHeaderHT + 'px' });
		}
	}

	setTimeout(function () {
		setWrapperFromHeader();
	}, 100);

	$(window).scroll(function () {
		if (winWidth > 1157) {
			topOfGrayStrip = 60;
			if ($(this).scrollTop() > 100) {
				TweenMax.to('header',0.1, { top: (-headerTopHT - 5) + 'px', ease: Sine.easeInOut });
				TweenMax.to('.logo',0.1,{width:'150px', marginTop:'-10px',ease:Sine.easeInOut});
			} else {
				TweenMax.to('.logo',0.1,{width:'210px',marginTop:'-35px',ease:Sine.easeInOut});
				TweenMax.to('header', 0.1, { top: '0px', ease: Sine.easeInOut });
			}
		} else {
			topOfGrayStrip = 50;
		}


		if ($(this).scrollTop() > 100) {
			TweenMax.to('.product_graystrip', 0.1, { position: 'fixed', left: '0px;', top: topOfGrayStrip + 'px', ease: Sine.easeInOut });
		} else {
			TweenMax.to('.product_graystrip', 0.1, { position: 'relative', left: '0', top: 0, ease: Sine.easeInOut });
		}

	});

	function onWindowResize() {
		setWrapperFromHeader();
	}

	$(window).resize(onWindowResize);

	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	function menuRolloverImgChange(){
		var menuListArr = $('.sub_nav_list').find('li');
		var menuImgArr = $('.sub_img_ref').find('img');
		console.log(menuImgArr.length);
		menuImgArr.css({'display':'none'});
		$(menuImgArr[0]).css({'display':'block'});
		function changeImages(i){
			var currList = $(menuListArr[i]);
			currList.mouseenter(function(){
				console.log('asdasdsad');
				menuImgArr.css({'display':'none'});
				$(menuImgArr[i]).fadeIn(300);
			});
		}

		menuListArr.mouseleave(function(){
			menuImgArr.css({'display':'none'});
			$(menuImgArr[0]).css({'display':'block'});
		});

		for(var i=0; i<menuListArr.length; i++){
			changeImages(i);
		}
	}
	menuRolloverImgChange();


});

// There are instances in which Firefox doesn’t cache pages. Below are some common programmatic reasons that a page is not cached: the page uses an unload or beforeunload handler;
$(window).unload(function () {
	if (window.TweenMax) {
		TweenMax.killAll();
	}
});