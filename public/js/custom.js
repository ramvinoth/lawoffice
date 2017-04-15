$(document).ready(function() {
    jQuery("#side-menu li").on("click", function(){
        jQuery("#side-menu li").removeClass('active');
        jQuery(this).addClass('active');
    })   
})