  function hideErrorDiv() {
   document.getElementById('errordiv').style.display = "none";

}
 function hideErrorDiv2() {
    document.getElementById('errordiv2').style.display = "none";
   }
function validateStanFrm() {


      var totalInvoice=jQuery('#totalInvoice').val();
      hide_hideerror(totalInvoice);
      var pro_title=jQuery('#pro_title').val();
      var pro_type=jQuery('#pro_type').val();
      var brand=jQuery('#brand').val();



      if(pro_title.trim()==""){
      jQuery('#pro_title_error').show();
      jQuery('#pro_title_error').html("Please enter product title.");
      jQuery('#pro_title').focus();
      return false;
      }
       if(pro_type.trim()==""){
      jQuery('#pro_type_error').show();
      jQuery('#pro_type_error').html("Please select product type.");
      jQuery('#pro_type').focus();
      return false;
      }

      if(brand.trim()==""){
      jQuery('#brand_error').show();
      jQuery('#brand_error').html("Please select product brand.");
      jQuery('#brand').focus();
      return false;
      }
       //Step two
   for (i = 1; i <= totalInvoice; i++) {
            var question= jQuery('#question_'+i).val();
            var ans= jQuery('#ans_'+i).val();
            if(question.trim()==""){
            jQuery('#question_error_'+i).show();
            jQuery('#question_error_'+i).html("Please enter the quantity.");
            jQuery('#question_'+i).focus();
            return false;
            }
            if(ans.trim()==""){
            jQuery('#ans_error_'+i).show();
            jQuery('#ans_error_'+i).html("Please enter price.");
            jQuery('#ans_'+i).focus();
            return false;
            }
          }
 }

   function hide_hideerror(totalInvoice){
      jQuery('#pro_title_error').hide();
      jQuery('#pro_image_error').hide();
      jQuery('#pro_type_error').hide();
      jQuery('#brand_error').hide();
      for(k = 1; k <= totalInvoice; k++) {
      jQuery('#question_error_'+k).hide();
      jQuery('#ans_error_'+k).hide();
      } 
      var nega=5;
      for (var r = 1; r <= nega; r++) {
      jQuery('#negatives_title_error_'+r).hide();
      jQuery('#negatives_per_error_'+r).hide();
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