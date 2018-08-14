/*=========================================================================================
    File Name: wizard-steps.js
    Description: wizard steps page specific js
    ----------------------------------------------------------------------------------------
    Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/



// Validate steps wizard

// Show form
var form = $(".steps-validation").show();

$(".steps-validation").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
            return true;
        }
        // Forbid next action on "Warning" step if the user is to young
    /*    if (newIndex === 3 && Number($("#age-2").val()) < 18)
        {
            return false;
        } */

        if (currentIndex === 1)
        {
        
            var amount = $("#inputAmountAdd").val();
            var gateway = $("#gateway").val();
            var minamo = $("#minamo").val();
            var maxamo = $("#maxamo").val();

            if(!Number(amount) || amount == ""){
                alert('Enter a valid number...!');
                return false;
            }

        /*    if ( amount < minamo || amount > maxamo )
            { 
                alert('Minimum or Maximum amount requirement do not meet!');
                return false;
            } */

            $.ajax({
                type: "GET",
                url: "/fund/deposit/data/"+gateway+"/"+amount,
                success: function (data) {
                
                    if(data.status == 'error'){

                        swal("Error!", data.msg, "error");

                    }
                    else{

                        var result = data;
            
                        var amount_deposit = '$' + result.data.amount;
                        var charges = '$' + result.data.trx_charge;
                        var payable_amount = '$' + result.data.usd_amount;
                        var bcam = result.data.bcam;
                        var trx = result.data.trx;

                        $("#amount_deposit_preview").html(amount_deposit);
                        $("#total_charges_preview").html(charges);
                        $(".total_payable_preview").html(payable_amount);
                        $(".in_btc_preview").html(bcam);
                        $("#trx_preview").val(trx);
                        $("#payment_charges").val(result.data.trx_charge);
                        $("#payable_total_amount").val(result.data.usd_amount);

                    }    
                }
            });

        }
        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex)
        {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {

        $("#form_deposit").submit();
      
    }
});


// Initialize validation
$(".steps-validation").validate({
    ignore: 'input[type=hidden]', // ignore hidden fields
    errorClass: 'danger',
    successClass: 'success',
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function(error, element) {
        error.insertAfter(element);
    },
    rules: {
        email: {
            email: true
        }
    }
});


// Initialize plugins
// ------------------------------

// Date & Time Range
/* $('.datetime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
        format: 'MM/DD/YYYY h:mm A'
    }
}); */