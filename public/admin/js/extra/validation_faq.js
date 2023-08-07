
function validateFaqFrm() {
      var totalInvoice=jQuery('#totalInvoice').val();

      hide_hideerror(totalInvoice);
   for (i = 1; i <= totalInvoice; i++) {
            var question= jQuery('#question_'+i).val();
            var ans= jQuery('#ans_'+i).val();

            if(question.trim()==""){
            jQuery('#question_error_'+i).show();
            jQuery('#question_error_'+i).html("Please enter the question.");
            jQuery('#question_'+i).focus();
            return false;
            }
            if(ans.trim()==""){
            jQuery('#ans_error_'+i).show();
            jQuery('#ans_error_'+i).html("Please enter answer.");
            jQuery('#ans_'+i).focus();
            return false;
            }
          }


 }

   function hide_hideerror(totalInvoice){
      for(k = 1; k <= totalInvoice; k++) {
      jQuery('#question_error_'+k).hide();
      jQuery('#ans_error_'+k).hide();
      }
       

  }

  function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }