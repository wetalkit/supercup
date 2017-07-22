$(document).ready(function() {
    
    var body = $('body');
    var menuTrigger = $('.js-menu-trigger');
    var mainOverlay = $('.js-main-overlay');
    
    menuTrigger.on('click', function(){
      body.addClass('menu-is-active');
    });
    
    mainOverlay.on('click', function(){
      body.removeClass('menu-is-active');
    });

    $('.menu li a').on('click', function(){
      $('body').removeClass('menu-is-active');
    });

    $('.faq-title').click(function(){
        $(this).next().find('.faq-toggle').slideToggle('fast');
        $(this).toggleClass('active');
    });

    $('input[name="daterange"]').daterangepicker({
        minDate: '04/08/2017',
        maxDate: '10/08/2017',
        startDate: '08/08/2017',
        endDate: '09/08/2017',
        locale: {
          format: 'DD/MM/YYYY'
        }
    });
});

