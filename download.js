
var downloadTab = $('.specs_list').find('span');
downloadTab.each(function(){
    $(this).bind('click', function(){
        var currTab = '#dwn_' + $(this).attr('attr');
        $('.dwn_hld').css({ 'display': 'none' });
        $(currTab).fadeIn(300);
        $('.product_graystrip span').removeClass('activeTab');
        $(this).addClass('activeTab');
       // console.log(currTab);
    });
});

var accSpanArr = $('.dwn_cat').find('span');
var accLinksArr = $('.pdf_links');
$(accLinksArr[0]).css({'display':'block'});

function downloadAccordion(i){
    var currAcc = $(accSpanArr[i]);
    currAcc.bind('click', function(){
        var currlinkList = $(accLinksArr[i]);
        if(currAcc.hasClass('openLinks')){
            accLinksArr.slideUp(300);
            accSpanArr.removeClass('openLinks');
        }else{
            accLinksArr.slideUp(300);
            currlinkList.slideDown(300);
            accSpanArr.removeClass('openLinks');
            currAcc.addClass('openLinks');
            //$("html, body").animate({ scrollTop:($(currAcc).offset().top - 50) }, {duration:1200});
        }
    });
}

for(var i=0; i < accSpanArr.length; i++){
    downloadAccordion(i);
}


/*if(currHeading.hasClass('openAdd')){
    corporateAddDet.slideUp(300);
    TweenMax.to(currHeading.find('.arrow'),0.5, {rotation: 0, ease:Sine.easeInOut});
    currHeading.removeClass('openAdd');
}else{
    corporateAddDet.slideUp(300);
    currAddress.slideDown(300);
    corporateAddHead.removeClass('openAdd');
    TweenMax.to('.arrow',0.5, {rotation: 0, ease:Sine.easeInOut});
    TweenMax.to(currHeading.find('.arrow'),0.5, {rotation: -180, ease:Sine.easeInOut});
    currHeading.addClass('openAdd');
    $("html, body").animate({ scrollTop:($(currHeading).offset().top - 220) }, {duration:1200});
}*/