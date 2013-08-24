/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */(function(e){wp.customize("blogname",function(t){t.bind(function(t){e("#logo").html(t)})});wp.customize("background_color",function(t){t.bind(function(t){e("body").css("background-color",t)})});wp.customize("link_textcolor",function(t){t.bind(function(t){e("#main a").css("color",t)})});wp.customize("navbar_background",function(t){t.bind(function(t){e(".navbar").css("background-color",t)})})})(jQuery);