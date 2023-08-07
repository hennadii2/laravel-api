function hideErrorDiv() {

   document.getElementById('errordiv').style.display = "none";

}



function loadDiv() {

  //document.getElementById("chargeamount").value='hi';

   

  document.getElementById("memberInfo_dependent1PrintCard").checked = false;

  document.getElementById("memberInfo_dependent2PrintCard").checked = false;

  document.getElementById("memberInfo_dependent3PrintCard").checked = false;

  document.getElementById("memberInfo_dependent4PrintCard").checked = false;

  updatememberInfoFee();

var dependents=jQuery('#no_dependents').val();

 jQuery('#first_div').hide();

 jQuery('#second_div').hide();

 jQuery('#third_div').hide();

 jQuery('#four_div').hide();

if(dependents==1){

 jQuery('#first_div').show();

 ///$('#first_div').toggle("slide");

}

if(dependents==2){

 jQuery('#first_div').show();

 jQuery('#second_div').show();

}



if(dependents==3){

 jQuery('#first_div').show();

 jQuery('#second_div').show();

 jQuery('#third_div').show();

}



if(dependents==4){

 jQuery('#first_div').show();

 jQuery('#second_div').show();

 jQuery('#third_div').show();

 jQuery('#four_div').show();

}



if(dependents==0){

 jQuery('#first_div').hide();

 jQuery('#second_div').hide();

 jQuery('#third_div').hide();

 jQuery('#four_div').hide();

}



}

function validateStepTwo() {



     hideStepTwoerror();



      var first_name=jQuery('#first_name').val();
      var last_name=jQuery('#last_name').val();
      var gender=jQuery('#gender').val();
      var dob=jQuery('#dob').val();
      var city=jQuery('#city').val();
      var state=jQuery('#state').val();
      var address=jQuery('#address').val();
      var zipcode=jQuery('#zipcode').val();
        var pattern = /^[a-zA-Z0-9\-_]+(\.[a-zA-Z0-9\-_]+)*@[a-z0-9]+(\-[a-z0-9]+)*(\.[a-z0-9]+(\-[a-z0-9]+)*)*\.[a-z]{2,4}$/;
          var email=jQuery('#email').val();
      if(first_name.trim()==""){
      document.getElementById('first_name').style.borderColor='#e52213';
      jQuery('#first_name').focus();
      return false;

      }

      if(last_name.trim()==""){
      document.getElementById('last_name').style.borderColor='#e52213';
      jQuery('#last_name').focus();
      return false;
      }

      if(gender.trim()==""){
      document.getElementById('gender').style.borderColor='#e52213';
      jQuery('#gender').focus();
      return false;

      }

      if(dob.trim()==""){
      document.getElementById('dob').style.borderColor='#e52213';
      jQuery('#dob').focus();
      return false;
      }



      if(email.trim()==""){
        document.getElementById('email').style.borderColor='#e52213';
      jQuery('#email').focus();
      return false;
      }

    if(!(pattern.test(email)))
    {
      document.getElementById('email').style.borderColor='#e52213';
    jQuery('#email').focus();
    return false;
    }

    if(city.trim()==""){
        document.getElementById('city').style.borderColor='#e52213';
      jQuery('#city').focus();
      return false;
      }
       if(state.trim()==""){
        document.getElementById('state').style.borderColor='#e52213';
      jQuery('#state').focus();
      return false;
      }
      if(address.trim()==""){
        document.getElementById('address').style.borderColor='#e52213';
      jQuery('#address').focus();
      return false;
      }
       if(zipcode.trim()==""){
        document.getElementById('zipcode').style.borderColor='#e52213';
      jQuery('#zipcode').focus();
      return false;
      }

    var no_dependents=jQuery('#no_dependents').val();

      if(no_dependents==1){

              var dep_dob_1=jQuery('#dep_dob_1').val();

              var dep_first_name_1=jQuery('#dep_first_name_1').val();

              var dep_last_name_1=jQuery('#dep_last_name_1').val();



              if(dep_dob_1.trim()==""){

              document.getElementById('dep_dob_1').style.borderColor='#e52213';

              jQuery('#dep_dob_1').focus();

              return false;

              }

              if(dep_first_name_1.trim()==""){

              document.getElementById('dep_first_name_1').style.borderColor='#e52213';

              jQuery('#dep_first_name_1').focus();

              return false;

              }



              if(dep_last_name_1.trim()==""){

              document.getElementById('dep_last_name_1').style.borderColor='#e52213';

              jQuery('#dep_last_name_1').focus();

              return false;

              }

         }



         if(no_dependents==2){

              var dep_dob_1=jQuery('#dep_dob_1').val();

              var dep_first_name_1=jQuery('#dep_first_name_1').val();

              var dep_last_name_1=jQuery('#dep_last_name_1').val();



              var dep_dob_2=jQuery('#dep_dob_2').val();

              var dep_first_name_2=jQuery('#dep_first_name_2').val();

              var dep_last_name_2=jQuery('#dep_last_name_2').val();



              if(dep_dob_1.trim()==""){

              document.getElementById('dep_dob_1').style.borderColor='#e52213';

              jQuery('#dep_dob_1').focus();

              return false;

              }

              if(dep_first_name_1.trim()==""){

              document.getElementById('dep_first_name_1').style.borderColor='#e52213';

              jQuery('#dep_first_name_1').focus();

              return false;

              }



              if(dep_last_name_1.trim()==""){

              document.getElementById('dep_last_name_1').style.borderColor='#e52213';

              jQuery('#dep_last_name_1').focus();

              return false;

              }



              if(dep_dob_2.trim()==""){

              document.getElementById('dep_dob_2').style.borderColor='#e52213';

              jQuery('#dep_dob_2').focus();

              return false;

              }

              if(dep_first_name_2.trim()==""){

              document.getElementById('dep_first_name_2').style.borderColor='#e52213';

              jQuery('#dep_first_name_2').focus();

              return false;

              }



              if(dep_last_name_2.trim()==""){

              document.getElementById('dep_last_name_2').style.borderColor='#e52213';

              jQuery('#dep_last_name_2').focus();

              return false;

              }

         }



         if(no_dependents==3){

              var dep_dob_1=jQuery('#dep_dob_1').val();

              var dep_first_name_1=jQuery('#dep_first_name_1').val();

              var dep_last_name_1=jQuery('#dep_last_name_1').val();



              var dep_dob_2=jQuery('#dep_dob_2').val();

              var dep_first_name_2=jQuery('#dep_first_name_2').val();

              var dep_last_name_2=jQuery('#dep_last_name_2').val();



              var dep_dob_3=jQuery('#dep_dob_3').val();

              var dep_first_name_3=jQuery('#dep_first_name_3').val();

              var dep_last_name_3=jQuery('#dep_last_name_3').val();



              if(dep_dob_1.trim()==""){

              document.getElementById('dep_dob_1').style.borderColor='#e52213';

              jQuery('#dep_dob_1').focus();

              return false;

              }

              if(dep_first_name_1.trim()==""){

              document.getElementById('dep_first_name_1').style.borderColor='#e52213';

              jQuery('#dep_first_name_1').focus();

              return false;

              }



              if(dep_last_name_1.trim()==""){

              document.getElementById('dep_last_name_1').style.borderColor='#e52213';

              jQuery('#dep_last_name_1').focus();

              return false;

              }



              if(dep_dob_2.trim()==""){

              document.getElementById('dep_dob_2').style.borderColor='#e52213';

              jQuery('#dep_dob_2').focus();

              return false;

              }

              if(dep_first_name_2.trim()==""){

              document.getElementById('dep_first_name_2').style.borderColor='#e52213';

              jQuery('#dep_first_name_2').focus();

              return false;

              }



              if(dep_last_name_2.trim()==""){

              document.getElementById('dep_last_name_2').style.borderColor='#e52213';

              jQuery('#dep_last_name_2').focus();

              return false;

              }



              if(dep_dob_3.trim()==""){

              document.getElementById('dep_dob_3').style.borderColor='#e52213';

              jQuery('#dep_dob_3').focus();

              return false;

              }

              if(dep_first_name_3.trim()==""){

              document.getElementById('dep_first_name_3').style.borderColor='#e52213';

              jQuery('#dep_first_name_3').focus();

              return false;

              }



              if(dep_last_name_3.trim()==""){

              document.getElementById('dep_last_name_3').style.borderColor='#e52213';

              jQuery('#dep_last_name_3').focus();

              return false;

              }

         }





         if(no_dependents==4){

              var dep_dob_1=jQuery('#dep_dob_1').val();

              var dep_first_name_1=jQuery('#dep_first_name_1').val();

              var dep_last_name_1=jQuery('#dep_last_name_1').val();



              var dep_dob_2=jQuery('#dep_dob_2').val();

              var dep_first_name_2=jQuery('#dep_first_name_2').val();

              var dep_last_name_2=jQuery('#dep_last_name_2').val();



              var dep_dob_3=jQuery('#dep_dob_3').val();

              var dep_first_name_3=jQuery('#dep_first_name_3').val();

              var dep_last_name_3=jQuery('#dep_last_name_3').val();



              var dep_dob_4=jQuery('#dep_dob_4').val();

              var dep_first_name_4=jQuery('#dep_first_name_4').val();

              var dep_last_name_4=jQuery('#dep_last_name_4').val();



              if(dep_dob_1.trim()==""){

              document.getElementById('dep_dob_1').style.borderColor='#e52213';

              jQuery('#dep_dob_1').focus();

              return false;

              }

              if(dep_first_name_1.trim()==""){

              document.getElementById('dep_first_name_1').style.borderColor='#e52213';

              jQuery('#dep_first_name_1').focus();

              return false;

              }



              if(dep_last_name_1.trim()==""){

              document.getElementById('dep_last_name_1').style.borderColor='#e52213';

              jQuery('#dep_last_name_1').focus();

              return false;

              }



              if(dep_dob_2.trim()==""){

              document.getElementById('dep_dob_2').style.borderColor='#e52213';

              jQuery('#dep_dob_2').focus();

              return false;

              }

              if(dep_first_name_2.trim()==""){

              document.getElementById('dep_first_name_2').style.borderColor='#e52213';

              jQuery('#dep_first_name_2').focus();

              return false;

              }



              if(dep_last_name_2.trim()==""){

              document.getElementById('dep_last_name_2').style.borderColor='#e52213';

              jQuery('#dep_last_name_2').focus();

              return false;

              }



              if(dep_dob_3.trim()==""){

              document.getElementById('dep_dob_3').style.borderColor='#e52213';

              jQuery('#dep_dob_3').focus();

              return false;

              }

              if(dep_first_name_3.trim()==""){

              document.getElementById('dep_first_name_3').style.borderColor='#e52213';

              jQuery('#dep_first_name_3').focus();

              return false;

              }



              if(dep_last_name_3.trim()==""){

              document.getElementById('dep_last_name_3').style.borderColor='#e52213';

              jQuery('#dep_last_name_3').focus();

              return false;

              }



              if(dep_dob_4.trim()==""){

              document.getElementById('dep_dob_4').style.borderColor='#e52213';

              jQuery('#dep_dob_4').focus();

              return false;

              }

              if(dep_first_name_4.trim()==""){

              document.getElementById('dep_first_name_4').style.borderColor='#e52213';

              jQuery('#dep_first_name_4').focus();

              return false;

              }



              if(dep_last_name_4.trim()==""){

              document.getElementById('dep_last_name_4').style.borderColor='#e52213';

              jQuery('#dep_last_name_4').focus();

              return false;

              }

         }





 }





 function hideStepTwoerror(){


    document.getElementById('city').style.borderColor='';
    document.getElementById('state').style.borderColor='';
    document.getElementById('address').style.borderColor='';
    document.getElementById('zipcode').style.borderColor='';
    document.getElementById('email').style.borderColor='';

    document.getElementById('first_name').style.borderColor='';

    document.getElementById('last_name').style.borderColor='';

    document.getElementById('gender').style.borderColor='';

    document.getElementById('dob').style.borderColor='';

    document.getElementById('dep_dob_1').style.borderColor='';

    document.getElementById('dep_first_name_1').style.borderColor='';

    document.getElementById('dep_last_name_1').style.borderColor='';

    document.getElementById('dep_dob_2').style.borderColor='';

    document.getElementById('dep_first_name_2').style.borderColor='';

    document.getElementById('dep_last_name_2').style.borderColor='';

    document.getElementById('dep_dob_3').style.borderColor='';

    document.getElementById('dep_first_name_3').style.borderColor='';

    document.getElementById('dep_last_name_3').style.borderColor='';

    document.getElementById('dep_dob_4').style.borderColor='';

    document.getElementById('dep_first_name_4').style.borderColor='';

    document.getElementById('dep_last_name_4').style.borderColor='';



  }