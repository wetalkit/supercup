$(document).ready(function() {

    // var $header = $("header"),
    //     $sticky = $header.before($header.clone().addClass("sticky"));

    // $(window).on("scroll", function() {
    //     var fromTop = $(window).scrollTop();
    //     $("body").toggleClass("scroll", (fromTop > 150));
    // });
    
    
    
    var body = $('body');
    var menuTrigger = $('.js-menu-trigger');
    var mainOverlay = $('.js-main-overlay');
	google.maps.event.addDomListener(window, 'load', init_map);

    //RESPONSIVE MENU START
    menuTrigger.on('click', function(){
        body.addClass('menu-is-active');
    });
    
     mainOverlay.on('click', function(){
        body.removeClass('menu-is-active');
    });


    $('.menu li a').on('click', function(){

        $("body").removeClass("menu-is-active");

    });
    //RESPONSIVE MENU END


     // DATE RANGE INITIALIZER
     $('input[name="daterange"]').daterangepicker();


     // FAQ INITIALIZER
     $(".faq-title").click(function(){
        $(this).next().find(".faq-toggle").slideToggle("fast");
        $(this).toggleClass("active ");
    });


    //GOOGLE MAP
      function init_map() {

		var var_location = new google.maps.LatLng(41.9973,21.4280);
 
        var var_mapoptions = {
          center: var_location,
          zoom: 14
        };
 
		var var_marker = new google.maps.Marker({
			position: var_location,
			map: var_map,
			title:"Venice"});
 
        var var_map = new google.maps.Map(document.getElementById("map-container"),
            var_mapoptions);
 
		var_marker.setMap(var_map);	
 
      }
 


      
 
});

