
function validateRegiFrm() {

     hideProerror();
      var pattern = /^[a-zA-Z0-9\-_]+(\.[a-zA-Z0-9\-_]+)*@[a-z0-9]+(\-[a-z0-9]+)*(\.[a-z0-9]+(\-[a-z0-9]+)*)*\.[a-z]{2,4}$/;
      var fname=jQuery('#fname').val();
     var lname=jQuery('#lname').val();
      var email=jQuery('#reg_email').val();
      var company=jQuery('#company').val();
      var reg_website=jQuery('#reg_website').val();
      var password=jQuery('#password').val();
      var reg_phone=jQuery('#reg_phone').val();
      var username=jQuery('#username').val();


      if(fname.trim()==""){
      jQuery('#fname_error').show();
      jQuery('#fname_error').html("Please enter first name.");
      jQuery('#fname').focus();
      return false;
      }
     if(lname.trim()==""){
      jQuery('#lname_error').show();
      jQuery('#lname_error').html("Please enter last name.");
      jQuery('#lname').focus();
      return false;
      }

        if(email.trim()==""){
        jQuery('#reg_email_error').show();
        jQuery('#reg_email_error').html("Please enter email address.");
        jQuery('#reg_email').focus();
        return false;
        }
        if(!(pattern.test(email)))
        {
        jQuery('#reg_email_error').show();
        jQuery('#reg_email_error').html("Please enter valid email address.");
        jQuery('#reg_email').focus();
        return false;
        }
       if(username.trim()==""){
      jQuery('#username_error').show();
      jQuery('#username_error').html("Please enter username.");
      jQuery('#username').focus();
      return false;
      }
     if(password.trim()=="")
    {
    jQuery('#password_error').show();
    jQuery('#password_error').html("Please enter password.");
    jQuery('#password').focus();
    return false;
    }

     if(password.trim()!=""){
     if(password.length<6){
      jQuery('#password_error').show();
      jQuery('#password_error').html("Password must be at least 6 characters long.");
      jQuery('#password').focus();
      return false;
      }
      }

      if(reg_phone.trim()==""){
      jQuery('#reg_phone_error').show();
      jQuery('#reg_phone_error').html("Please enter phone.");
      jQuery('#reg_phone').focus();
      return false;
      }
       if(reg_website.trim()==""){
      jQuery('#reg_website_error').show();
      jQuery('#reg_website_error').html("Please enter website name.");
      jQuery('#reg_website').focus();
      return false;
      }
      if(company.trim()==""){
      jQuery('#company_error').show();
      jQuery('#company_error').html("Please enter company name.");
      jQuery('#company').focus();
      return false;
      } 

 }


 function hideProerror(){
    jQuery('#username_error').hide();
    jQuery('#reg_phone_error').hide();
    jQuery('#reg_website_error').hide();
    jQuery('#fname_error').hide();
    jQuery('#lname_error').hide();
    jQuery('#reg_email_error').hide();
    jQuery('#company_error').hide();
    jQuery('#password_error').hide();

  }