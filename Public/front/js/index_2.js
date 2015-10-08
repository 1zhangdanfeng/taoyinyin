$(function(){
    var index_logo=$('.index_logo');
    var index_print=$('.index_print');
    var star_logo=$('.star_logo');
    var logo_width=index_print.width()*0.22;
    var start_print=$('.start_print');
    index_logo.width(logo_width);
    index_logo.height(logo_width)
    index_logo.css('bottom',-logo_width*0.62);
    index_print.css('margin-bottom',logo_width*0.84);
    star_logo.width(logo_width);
    star_logo.height(logo_width);
    star_logo.css('top',-logo_width*0.4);
    start_print.height(start_print.width()*0.16);
    $('.star').css('margin-top',logo_width*0.5);
    $('html').css('font-size',$('body').width()*4/270)
});