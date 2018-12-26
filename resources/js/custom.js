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

/* TPAY */

/**
 * JavaScript groups selection
 *
 * @author Tpay.com
 * @version 1.0
 *
 */
var tr_groups = Array();
tr_groups[0] = ['103','Karta płatnicza','53','https://secure.tpay.com/_/g/103.png?3','53'];
tr_groups[1] = ['113','Alior Bank SA','9,64,60,29','https://secure.tpay.com/_/g/113.png?3','9'];
tr_groups[2] = ['102','Bank Pekao SA','4,47,55,64,60,29','https://secure.tpay.com/_/g/102.png?3','4'];
tr_groups[3] = ['108','PKO Bank Polski','21,64,29','https://secure.tpay.com/_/g/108.png?3','21'];
tr_groups[4] = ['110','Inteligo','14,64,29','https://secure.tpay.com/_/g/110.png?3','14'];
tr_groups[5] = ['150','BLIK','64,29','https://secure.tpay.com/_/g/150.png?3','64'];
tr_groups[6] = ['160','mBank','18,64,60,29','https://secure.tpay.com/_/g/160.png?3','18'];
tr_groups[7] = ['111','ING Bank Śląski SA','13,64,29','https://secure.tpay.com/_/g/111.png?3','13'];
tr_groups[8] = ['114','Bank Millennium SA','2,48,64,60,29','https://secure.tpay.com/_/g/114.png?3','2'];
tr_groups[9] = ['115','Bank Zachodni WBK SA','6,64,60,29','https://secure.tpay.com/_/g/115.png?3','6'];
tr_groups[10] = ['131','Eurobank','32,29','https://secure.tpay.com/_/g/131.png?3','32'];
tr_groups[11] = ['132','Citibank Handlowy SA','7,29','https://secure.tpay.com/_/g/132.png?3','7'];
tr_groups[12] = ['116','Credit Agricole Polska SA','17,64,29','https://secure.tpay.com/_/g/116.png?3','17'];
tr_groups[13] = ['119','Getin Bank SA','12,64,60,29','https://secure.tpay.com/_/g/119.png?3','12'];
tr_groups[14] = ['112','T-Mobile Usługi Bankowe','52,64,29','https://secure.tpay.com/_/g/112.png?3','52'];
tr_groups[15] = ['124','Bank Pocztowy SA','5,29','https://secure.tpay.com/_/g/124.png?3','5'];
tr_groups[16] = ['125','Bank Ochrony Środowiska SA','3,29','https://secure.tpay.com/_/g/125.png?3','3'];
tr_groups[17] = ['128','Idea Bank','62,29','https://secure.tpay.com/_/g/128.png?3','62'];
tr_groups[18] = ['135','Banki Spółdzielcze','28,42,56,63,29','https://secure.tpay.com/_/g/135.png?3','63'];
tr_groups[19] = ['133','Bank Gospodarki Żywnościowej SA','1,64,29','https://secure.tpay.com/_/g/133.png?3','1'];
tr_groups[20] = ['159','Neo Bank','24,29','https://secure.tpay.com/_/g/159.png?3','24'];
tr_groups[21] = ['139','Raiffeisen Bank Polska SA','22,64,29','https://secure.tpay.com/_/g/139.png?3','22'];
tr_groups[22] = ['134','Deutsche Bank PBC SA','8,29','https://secure.tpay.com/_/g/134.png?3','8'];
tr_groups[23] = ['130','Nest Bank','26,29','https://secure.tpay.com/_/g/130.png?3','26'];
tr_groups[24] = ['145','Plus Bank SA','15,60,29','https://secure.tpay.com/_/g/145.png?3','15'];
tr_groups[25] = ['140','Toyota Bank','23,29','https://secure.tpay.com/_/g/140.png?3','23'];
tr_groups[26] = ['137','Volkswagen Bank','27,29','https://secure.tpay.com/_/g/137.png?3','27'];
tr_groups[27] = ['166','Google Pay','68','https://secure.tpay.com/_/g/166.png?3','68'];
tr_groups[28] = ['104','MasterPass','57','https://secure.tpay.com/_/g/104.png?3','57'];
tr_groups[29] = ['106','PayPal','31','https://secure.tpay.com/_/g/106.png?3','31'];
tr_groups[30] = ['109','Alior Raty','49','https://secure.tpay.com/_/g/109.png?3','49'];
tr_groups[31] = ['148','Euro Payment','50','https://secure.tpay.com/_/g/148.png?3','50'];
tr_groups[32] = ['157','Druczek płatności / Przelew z innego banku','29','https://secure.tpay.com/_/g/157.png?3','29'];
tr_groups[33] = ['163','Visa Checkout','65','https://secure.tpay.com/_/g/163.png?3','65'];

    function ShowChannels()
    {
        var str='<div id="channels">';
        for(var i=0;i<tr_groups.length;i++)
        {
            var id = 'bank'+tr_groups[i][0];
            var width_style = '';
            var idi = 'i_'+id;
            if(tr_groups[i][0] == 40) width_style = 'width:270px'; else width_style = '';
            str +='<div class="tpay_bank" id="'+id+'" onclick=\'document.getElementById("'+idi+'").checked=true; document.getElementById("tpay_group").value = id.replace("bank", "");\' style="background-position:center;background-image:url('+tr_groups[i][3]+');'+width_style+'">';
            str +='<input id="'+idi+'" type="radio" value="'+tr_groups[i][0]+'" name="grupa" '; if (i==0) str +='checked="checked"  />'; else str += ' />';
            str += '<p class="label">'+
                '<label for="'+idi+'">'+tr_groups[i][1]+'</label>'+
                '</p>'+
                '</div>';
        }
        str+="</div>";
        document.getElementById('tpay_content').innerHTML=str;
    }

window.onload = ShowChannels;

/* END TPAY */

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
            if(data.qty > 0 && data.totalQty > 0) {
                $('#totalPrice').text('DO ZAPŁATY: ' + Math.round(data.totalPrice * 100) / 100 + " zł");
                $('#totalQty').text(data.totalQty);
                $('#price' + data.id + data.size).text(Math.round(data.price * 100) / 100 + " zł");
                $('.ajaxMessage').fadeIn('normal', function () {
                    $('.ajaxMessage').delay(1000).fadeOut();
                });
            }
            else {
                $('#totalPrice').text("? zł");
                $('#totalQty').text("?");
                $('#price' + data.id + data.size).text("? zł");
                $('#quantity' + data.id + data.size).val(0);
                $('.ajaxMessage').fadeIn('normal', function () {
                    $('.ajaxMessage').delay(1000).fadeOut();
                });
            }
            $('body').css('cursor', 'default');
        },
        error:function(data) {
            console.log(data.error);
        }
    });
});

/* END QUANTITY AJAX */