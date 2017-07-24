$(document).ready(function() {
    
    var body = $('body');
    var menuTrigger = $('.js-menu-trigger');
    var mainOverlay = $('.js-main-overlay');
    
    menuTrigger.on('click', function(){
        body.addClass('menu-is-active');
    });
    
    mainOverlay.on('click', function(e){
        console.log(e.target);
        body.removeClass('menu-is-active');
    });

    $('.faq-title').click(function(){
        $(this).next().find('.faq-toggle').slideToggle('fast');
        $(this).toggleClass('active');
    });

    var dateFrom = $('input[name="daterange"]').attr('date-from');
    var dateTo = $('input[name="daterange"]').attr('date-to');

    if(dateFrom == ''){
        dateFrom = '08 Aug';
    }

    if(dateTo == ''){
        dateTo = '09 Aug';
    }

    $('input[name="daterange"]').daterangepicker({
        minDate: '04 Aug',
        maxDate: '10 Aug',
        startDate: dateFrom,
        endDate: dateTo,
        locale: {
          format: 'DD MMM'
        }
    });
});

