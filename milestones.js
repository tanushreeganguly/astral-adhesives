$(document).ready(function(){
    //console.log('asdasdasd');

    TweenMax.set('.path_ind',{width:0});
    TweenMax.set('.ms-container',{opacity:0, x:40});
    var tl = new TimelineLite();
    tl.add('startPoint')
      .staggerTo('.path_ind',0.5, {width:'100%', ease: Sine.easeIn}, 0.3)
      .staggerTo('.ms-container',0.8, {opacity:0.8,x:0, ease: Sine.easeOut}, 0.6, 'startPoint+=0.2');

    
});