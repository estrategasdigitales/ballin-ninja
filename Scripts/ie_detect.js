$(document).ready(function($) {
    if ($.browser.msie){
        if ($.browser.version<=7.0){
        	$("body").empty()
        	$("body").load("http://www.dec-uia.com/otono_2011/Scripts/ie_detect/update_browser.html")
        	//$("body").text("Pruebal")
        }
    }
});