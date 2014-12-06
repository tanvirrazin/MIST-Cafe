$(document).ready(function() {
    $("#intro").css("opacity", 0.99999);

    var logoSwf = "/swf/logo.swf";

    if ($("body#home").length) logoSwf = "/swf/logo_splash.swf";

    $("#logo").flash({
        swf: logoSwf,
        params: {
            menu: "false",
            wmode: "transparent",
            scale: "noscale",
            quality: "high"
        }
    });

    $("#navigation").flash({
        swf: "/swf/nav.swf",
        params: {
            menu: "false",
            wmode: "transparent",
            scale: "noscale",
            quality: "high"
        },
        flashvars: {
            sectionName: $("body").attr("id")
        }
    });

    $("tr", "#highlight").mouseover(function() {
        $(this).addClass("hoverHighlighted");
    }).mouseout(function() {
            $(this).removeClass("hoverHighlighted");
        });

    // sociable
    $("img", "#social").fadeTo(10000, 0.4);

    $("img", "#social").hover(function() {
        $(this).stop().animate({ opacity: 1 }, 1);
    }, function() {
        $(this).stop().animate({ opacity: 0.4 }, 400);
    });
});

/*!
 * http://www.shamasis.net/projects/ga/
 * Refer jquery.ga.debug.js
 * Revision: 13
 */
(function($){$.ga={};$.ga.load=function(uid,callback){jQuery.ajax({type:'GET',url:(document.location.protocol=="https:"?"https://ssl":"http://www")+'.google-analytics.com/ga.js',cache:true,success:function(){if(typeof _gat==undefined){throw"_gat has not been defined";}t=_gat._getTracker(uid);bind();if($.isFunction(callback)){callback(t)}t._trackPageview()},dataType:'script',data:null})};var t;var bind=function(){if(noT()){throw"pageTracker has not been defined";}for(var $1 in t){if($1.charAt(0)!='_')continue;$.ga[$1.substr(1)]=t[$1]}};var noT=function(){return t==undefined}})(jQuery);

$(window).bind("load", function() {
    $.ga.load("UA-590802-1");

    if (!$.browser.msie) {
        window.setTimeout(function() { $('#intro').fadeTo(3000, 0.5); }, 3000);

        $("#intro").hover(function() {
            $(this).stop().fadeTo("fast", 0.99999);
        },function() {
            $(this).stop().fadeTo("fast", 0.5);
        });
    }
});