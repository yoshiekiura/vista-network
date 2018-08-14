/*=========================================================================================
    File Name: wizard-steps.js
    Description: wizard steps page specific js
    ----------------------------------------------------------------------------------------
    Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


var form = $(".withdraw_preview_validation").show();

$(".withdraw_preview_validation").steps({
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

        if (currentIndex === 1)
        {
        
            var amount = $("#withdraw_amount").val();
            var gateway = $("#withdraw_gateway").val();
            var minamo = $("#min_amo").val();
            var maxamo = $("#max_amo").val();
            var info = $("#withdraw_info").val();

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
                url: "/fund/withdraw/data/"+gateway+"/"+amount,
                success: function (data) {
                
                    if(data.status == 'error'){

                        swal("Error!", data.msg, "error");

                    }
                    else{
                        
                        var result = data;
            
                        var amount_withdraw = '$' + result.data.amount;
                        var charges = '$' + result.data.charge;
                        var total_withdraw = '$' + result.data.total;
                        
                        $("#amount_withdraw_preview").html(amount_withdraw);
                        $("#total_withdraw_charges_preview").html(charges);
                        $(".total_withdraw_preview").html(total_withdraw);
                        $("#withdraw_charges").val(result.data.charge);
                        $("#withdraw_total_amount").val(result.data.total);

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
      
        $("#withdraw_form_money").submit();
      
    }
});

// Initialize validation
$(".withdraw_preview_validation").validate({
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