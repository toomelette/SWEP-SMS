

// LOADER
$('#loader')
    .hide() 
    .ajaxStart(function() {
        $(this).show();
    })
    .ajaxStop(function() {
        $(this).hide();
    })
;



// SELECT2 Caller
$('.select2').select2();



// Filter Form Submit Rule
$(document).ready(function($){
   $("#filter_form").submit(function() {
        $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
        return true;
    });
    $("form").find( ":input" ).prop( "disabled", false );
});



// WYSIHTML5
$(function () {
    CKEDITOR.replace('editor');
})



// Price Format
$(document).ready(function() {
    $("#priceformat").priceFormat({
        prefix: "",
        thousandsSeparator: ",",
        clearOnEmpty: true,
        allowNegative: true
    });
});




// PJAX Form Caller
$(document).on('submit', 'form[data-pjax]', function(event) {
 	$.pjax.submit(event, '#pjax-container');
});



// PJAX Link Caller
$(document).pjax('a[data-pjax]', '#pjax-container');





// PJAX INITIALIZATIONS
$(document).on('ready pjax:success', function() {
    
    //Filter Form Submit Rule
	$(document).ready(function($){
       $("#filter_form").submit(function() {
            $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
            return true;
        });
        $("form").find( ":input" ).prop( "disabled", false );
    });

});