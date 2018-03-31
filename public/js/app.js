

// SELECT2 Caller
$('.select2').select2();


//Filter Form Submit Rule
$(document).ready(function($){
   $("#filter_form").submit(function() {
        $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
        return true;
    });
    $("form").find( ":input" ).prop( "disabled", false );
});


// PJAX Form Caller
$(document).on('submit', 'form[data-pjax]', function(event) {
 	$.pjax.submit(event, '#pjax-container')
});


// PJAX Link Caller
$(document).pjax('a[data-pjax]', '#pjax-container')





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