/* LOADER */
$(window).on('load', function() { // makes sure the whole site is loaded
    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('body').delay(350).css({'overflow':'visible'});
})
/* END LOADER */

/* SLIDER PRO */
$( '#product-slider' ).sliderPro({
    width: 800,
    height: 600,
    orientation: 'vertical',
    thumbnailsPosition: 'right',
    buttons: false,
    breakpoints: {
        800: {
            thumbnailsPosition: 'bottom',
            thumbnailWidth: 250,
            thumbnailHeight: 250
        },
        500: {
            orientation: 'vertical',
            thumbnailsPosition: 'bottom',
            thumbnailWidth: 100,
            thumbnailHeight: 100
        }
    }
});
/* END SLIDER PRO */
$( '#category-slider' ).sliderPro({
    width: 800,
    height: 600,
    orientation: 'horizontal',
    thumbnailsPosition: 'bottom',
    buttons: true,
    breakpoints: {
        800: {
            thumbnailsPosition: 'bottom',
            thumbnailWidth: 250,
            thumbnailHeight: 250
        },
        500: {
            orientation: 'vertical',
            thumbnailsPosition: 'bottom',
            thumbnailWidth: 100,
            thumbnailHeight: 100
        }
    }
});

/* QUANTITY AJAX */

$('.quantity-input').change(function(){
    var value=$(this).val();
    var url = $(this).attr('data-url');
    $.ajax({
        type : 'get',
        dataType: 'json',
        url  : url,
        data : {
            'value':value,
        },
        beforeSend:function() {
            $('body').css('cursor', 'progress');
        },
        success:function(data) {
            $('#totalPrice').text('DO ZAPŁATY: ' + Math.round(data.totalPrice * 100) / 100 + " zł");
            $('#totalQty').text(data.totalQty);
            $('#product' + data.id + data.size).text(Math.round(data.price * 100) / 100 + " zł" );
            $('#quantity' + data.id + data.size).val(data.qty);
            $('.ajaxMessage').fadeIn('normal', function(){
                $('.ajaxMessage').delay(1000).fadeOut();
            });
            $('body').css('cursor', 'default');
        },
        error:function(data) {
            console.log(data.error);
        }
    });
});

/* END QUANTITY AJAX */

$("[data-target='#shopping-cart-right-full']").click(function() {
    var selector = $(this).data("target");
    $(selector).toggleClass('in');
});