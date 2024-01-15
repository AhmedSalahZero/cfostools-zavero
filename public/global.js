$('.only-numeric-allowed').on('change',function(e){

    if(! isNumber($(this).val()))
    {
        let lang = $('body').data('lang');
        title = "Oops..." ;
        message = "Only Numeric Value Allowed" ;
        if(lang === 'ar'){
            title = 'Ø®Ø·Ø£'  ;
            message = "Ù…Ø³Ù…ÙˆØ­ ÙÙ‚Ø· Ø¨Ø§Ù„Ø§Ø±Ù‚Ø§Ù…"
        }


        Swal.fire({
            icon: "warning",
            title: title,
            text: message,
        })

        $(this).val(0);
    }

});

$(document).on('change','.only-percentage-allowed-between-minus-plus-hundred',function(e){
    if($(this).hasClass('only-percentage-allowed-between-minus-plus-hundred') && ! isPercentageNumberBetweenMinusPlusHundred($(this).val()))
    {
        let lang = $('body').data('lang');
        title = "Oops..." ;
        message = "Please Enter Valid Percentage" ;
        if(lang === 'ar'){
            title = 'Ø®Ø·Ø£'  ;
            message = "Ø¨Ø±Ø¬Ø§Ø¡ Ø§Ø¯Ø®Ø§Ù„ Ù†Ø³Ø¨Ù‡ ØµØ­ÙŠØ­Ù‡"
        }
        Swal.fire({
            icon: "warning",
            title: title,
            text: message ,
        })

        $(this).val(0);

    }

});

$(document).on('change','.only-percentage-allowed',function(e){
    if($(this).hasClass('only-percentage-allowed') && ! isPercentageNumber($(this).val()))
    {
        let lang = $('body').data('lang');
        title = "Oops..." ;
        message = "Please Enter Valid Percentage" ;
        if(lang === 'ar'){
            title = 'Ø®Ø·Ø£'  ;
            message = "Ø¨Ø±Ø¬Ø§Ø¡ Ø§Ø¯Ø®Ø§Ù„ Ù†Ø³Ø¨Ù‡ ØµØ­ÙŠØ­Ù‡"
        }
        Swal.fire({
            icon: "warning",
            title: title,
            text: message ,
        })

        $(this).val(0);

    }

});

$(document).on('change','.only-greater-than-zero-allowed',function(){
    if(! isGreaterThanZero($(this).val()) && $(this).val())
    {
        let currentLang = $('body').data('lang');

        let trans = {
            "The Value Must Be Greater Than Zero":{
                "en":"The Value Must Be Greater Than Zero",
                "ar":"ÙŠØ¬Ø¨ Ø§Ù† ØªÙƒÙˆÙ† Ø§Ù„Ù‚ÙŠÙ…Ù‡ Ø§ÙƒØ¨Ø± Ù…Ù† Ø§Ù„ØµÙØ±"
            },
            "Oops...":{
                "en":'Oops...',
                "ar":"Ø®Ø·Ø£"
            }
        };
        Swal.fire({
            icon: "warning",
            title: trans['Oops...'][currentLang],
            text: trans['The Value Must Be Greater Than Zero'][currentLang],
        })
        $(this).val(1);

    }
});

$(document).on('change','.only-greater-than-or-equal-zero-allowed',function(){
	let val = number_unformat($(this).val()) ;
    if(! isGreaterThanOrEqualZero(val) && val  != '')
    {
        let currentLang = $('body').data('lang');

         Swal.fire({
            icon: "warning",
            title: {
                "en":"Oops...",
                "ar":""
            }[currentLang],
            text: {
                "en":"The Value Must Be Greater Than Zero",
                "ar":""
            }[currentLang],
        })
        $(this).val(0);
    }
});
  function roundHalf(num) {
    return Math.round(num*2)/2;
}
function isNumber(number )
{
    return !isNaN(parseFloat(number)) && isFinite(number) ;
}

function isPercentageNumber(number )
{
    return !isNaN(parseFloat(number)) && isFinite(number) && number <= 100 && number>=0 ;
}

function isPercentageNumberBetweenMinusPlusHundred(number )
{
    return !isNaN(parseFloat(number)) && isFinite(number) && number <= 100 && number>=-100 ;
}


function isGreaterThanZero(number )
{

    return !isNaN(parseFloat(number)) && isFinite(number) && number > 0 ;
}

function isGreaterThanOrEqualZero(number )
{
    return  !isNaN(parseFloat(number)) && isFinite(number) && number >= 0 && number!='';
}

function getCurrentLang()
{
    return $('body').data('lang') ;

}
function number_format(number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
