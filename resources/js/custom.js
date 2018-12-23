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
