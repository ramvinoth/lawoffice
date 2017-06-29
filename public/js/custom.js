$(document).ready(function() {
    jQuery("#side-menu li").on("click", function(){
        jQuery("#side-menu li").removeClass('active');
        jQuery(this).addClass('active');
    });   
})

var href = window.location.href.split('/');
var doamin = href[2];
var load = href[3];

if(load == "" || load == "feed"){
    
}

//console.log("sss : "+href[2]);