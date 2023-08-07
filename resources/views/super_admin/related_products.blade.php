@include('super_admin.z_header')
<link href="{{URL::to('/')}}/admin/css/jquery-ui.css?5" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/admin/css/smooth-products.css?2" rel="stylesheet" />
<script>
function preview_images()
{
  $('#image_preview').html("");
 var total_file=document.getElementById("files-input-upload").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<div style='width: 50px; height: 50px; margin:0px 7px 7px 0px; display: inline-block;'><img class='img-responsive' style='width: 50px; height: 50px; border:1px solid #ddd; display: inline-block;' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
 }
}
</script>
</head>

<body>
<!-- Site Wraper -->
<div class="wrapper">
<!-- Header -->
@include('super_admin.z_top')
<!-- End Header -->

<div class="clearfix"></div>

<!-- Shop Item Detail Section -->
<section class="main__container">
<div class="">
<div class="page-breadcrumb"> <a href="{{URL::to('/')}}/super_admin/index">Home</a>/<span>ADD Related Product</span> </div>

<div class="row page__main__heading">
<div class="col-sm-6 col-sx-12">
<div>Add Your Related Product</div>
</div>

<div class="col-sm-6 col-sx-12">
<div class="text-right">
<!--<button  class="btn__white__border" type="button" id="saveDarf"><img src="{{URL::to('/')}}/admin/images/icon/draft.png" style="margin-right:5px; margin-top:-2px;" />Save as Draft</button>
-->
</div>
</div>
</div>
@if (Session::has('success'))
  <div class="alert alert-success" id='errordiv'>{{ Session::get('success') }} <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >×</span></div>
  @endif



<form role="form" id="form-stander" name="standardType" onsubmit="return validateStanFrm();" action="relatedProductSave" method="POST" enctype="multipart/form-data">
<input type="hidden" value="0" id="save_status" name="save_status" />
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div style="background-color:#fff;">
<div class="row mt-20">
<div class="col-md-12">
<div class="tree-top-content">
<!-- Tab -->
<div>


<div style="background-color:#fff; padding-top:30px;" class="box__shadow">

<div style="padding: 10px 30px 30px 30px;">
<div class="row">

<div class="col-md-9 col-sm-9 col-xs-12">
<div class="mb-20">
<div class="heading_style_left mb-10"> <span class="title">Product Info</span> </div>

<div class="row">
<div class="col-md-12">
<div class="brdr_btm_br">
<label>Product Title <span class="text-danger">*</span> </label>
<input type="text" class="input-group-lg full_input" id="pro_title" name="pro_title"  placeholder="Product Title" >
<span id="pro_title_error" style="color: red; display: none;"></span>
</div>
<div class="brdr_btm_br">
<label>Product Categories <span class="text-danger">*</span> </label>
<select name="pro_type" id="pro_type" class="cart_quantity  full_input" style="max-width: 100%; !important;" >
<option value="">Product Categories *</option>
@foreach($type as $key => $value)
<option value="{{$value->type_id}}" >{{$value->type_name}}</option>
@endforeach
</select>
<span id="pro_type_error" style="color: red; display: none;"></span>
 </div>

 <div class="brdr_btm_br">
<label>Select Brand <span class="text-danger">*</span> </label>
<select name="brand" id="brand" class="cart_quantity  full_input" style="max-width: 100%; !important;" >
<option value="">Select Brand *</option>
@foreach($brand as $key => $value)
<option value="{{$value->brand_id}}" >{{$value->name}}</option>
@endforeach
</select>
<span id="brand_error" style="color: red; display: none;"></span>
 </div>


 <div class="brdr_btm_br">
<label>Product Short Description <span class="text-danger">*</span> </label>
<input type="text" class="input-group-lg full_input" id="short_desc" name="short_desc" placeholder="Product Short Description" >
<span id="short_desc_error" style="color: red; display: none;"></span>
</div>
 <div class="brdr_btm_br">
<label>Product Long Description <span class="text-danger">*</span> </label>
<textarea class="input-group-lg full_input" style="height:180px;" id="pro_desc" name="pro_desc" placeholder="Product Long Description">
</textarea>
<span id="pro_desc_error" style="color: red; display: none;"></span>
</div>
<div class="mb-20">
<div class="row mt-15">
<div class="col-sm-5 col-xs-12 mt-15"><b>Select File to Upload</b></div>
<div class="col-sm-7 col-xs-12">
<div class="input-group">
<input type="file" name="images[]" onchange="preview_images();" multiple id="files-input-upload" style="display:none">
<input type="text"  id="fake-file-input-name"   disabled="disabled" placeholder="Choose File" class="input-group-lg browse___input">
<span class="input-group-btn">
<button id="fake-file-button-browse" type="button" class="btn browse___btn"> Browse </button>
</span>

 </div>
  <span id="pro_image_error" style="color: red; display: none;"></span>
</div>
</div>
</div>
<div id="image_preview"></div>

</div>
</div>

</div>


<div class="mt-20">
<div class="heading_style_left mb-10"> <span class="title">Price</span> </div>


<div class="row">
<div class="col-md-12">
<div class="input_fields_wrap">
<div class="row">
<div class="col-sm-6 col-xs-12">
<div class="mb-20">
<label>Add the Quantity <span class="text-danger">*</span> </label>
        <input type="text" class="input-group-lg full_input"  name="question_1" id="question_1" placeholder="Add the Quantity" >
        <span id="question_error_1" style="color: red; display: none;"></span>
        </div>
</div>
<div class="col-sm-6 col-xs-12">
<div class="mb-20">
<label>Add the Price <span class="text-danger">*</span> </label>
        <input type="number" class="input-group-lg full_input" name="ans_1" id="ans_1" placeholder="Add the Price" >
        <span id="ans_error_1" style="color: red; display: none;"></span>
        </div>
</div>
</div>


</div>

<div class="clearfix"></div>
<div class="mb-20 text-right">
<button  class="add_field_button tt_green_text"><i class="fa fa-plus"></i> Add more</button>
</div>
   <input type="hidden" id="totalInvoice" name="totalInvoice" value="1" />


</div>
</div>

</div>


<div class="mt-20">


<div class="row">
<div class="col-md-12">
<div class="heading_style_left mb-10"> <span class="title">Effects</span> </div>
<div class="mb-30">
<div class="row">
  <div class="col-xs-12">
  <table class="table table-bordered table-padding">
  <tbody>
  <tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
  </tr>
    <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="effects_title_1" id="effects_title_1" value="Relaxed"  >
<span id="effects_title_error_1" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="effects_per_1" id="effects_per_1"  placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="effects_per_error_1" style="color: red; display: none;"></span></td>
  </tr>
   <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="effects_title_2" id="effects_title_2" value="Happy"  >
<span id="effects_title_error_2" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="effects_per_2" id="effects_per_2"  placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="effects_per_error_2" style="color: red; display: none;"></span></td>
  </tr>
   <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="effects_title_3" id="effects_title_3" value="Euphoric"  >
<span id="effects_title_error_3" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="effects_per_3" id="effects_per_3"  placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="effects_per_error_3" style="color: red; display: none;"></span></td>
  </tr>
   <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="effects_title_4" id="effects_title_4" value="Uplifted"  >
<span id="effects_title_error_4" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="effects_per_4" id="effects_per_4"  placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="effects_per_error_4" style="color: red; display: none;"></span></td>
  </tr>
   <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="effects_title_5" id="effects_title_5" value="Sleepy"  >
<span id="effects_title_error_5" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="effects_per_5" id="effects_per_5"  placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="effects_per_error_5" style="color: red; display: none;"></span></td>
  </tr>
  </tbody>
  </table>
  </div>
  </div>




</div>
<div class="heading_style_left mb-10"> <span class="title">Medical</span> </div>
<div class="mb-30">

  <div class="row">
  <div class="col-xs-12">
  <table class="table table-bordered table-padding">
  <tbody>
  <tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
  </tr>
    <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="medical_title_1" id="medical_title_1" value="Stress"  >
<span id="medical_title_error_1" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="medical_per_1" id="medical_per_1"  placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="medical_per_error_1" style="color: red; display: none;"></span></td>
  </tr>
   <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="medical_title_2" id="medical_title_2" value="Pain"  >
<span id="medical_title_error_2" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="medical_per_2" id="medical_per_2"  placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="medical_per_error_2" style="color: red; display: none;"></span></td>
  </tr>
   <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="medical_title_3" id="medical_title_3" value="Depression"  >
<span id="medical_title_error_3" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="medical_per_3" id="medical_per_3"  placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="medical_per_error_3" style="color: red; display: none;"></span></td>
  </tr>
   <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="medical_title_4" id="medical_title_4" value="Insomnia"  >
<span id="medical_title_error_4" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="medical_per_4" id="medical_per_4"  placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="medical_per_error_4" style="color: red; display: none;"></span></td>
  </tr>
   <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="medical_title_5" id="medical_title_5" value="Lack of Appetite"  >
<span id="medical_title_error_5" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="medical_per_5" id="medical_per_5"  placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="medical_per_error_5" style="color: red; display: none;"></span></td>
  </tr>
  </tbody>
  </table>
  </div>
  </div>

</div>

<div class="heading_style_left mb-10"> <span class="title">Negatives</span> </div>
<div class="mb-30">

<div class="row">
  <div class="col-xs-12">
  <table class="table table-bordered table-padding">
  <tbody>
  <tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
  </tr>
    <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="negatives_title_1" id="negatives_title_1" value="Dry Mouth"  >
<span id="negatives_title_error_1" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="negatives_per_1" id="negatives_per_1"  placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="negatives_per_error_1" style="color: red; display: none;"></span></td>
  </tr>
   <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="negatives_title_2" id="negatives_title_2" value="Dry Eyes"  >
<span id="negatives_title_error_2" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="negatives_per_2" id="negatives_per_2"  placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="negatives_per_error_2" style="color: red; display: none;"></span></td>
  </tr>
   <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="negatives_title_3" id="negatives_title_3" value="Dizzy"  >
<span id="negatives_title_error_3" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="negatives_per_3" id="negatives_per_3" placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="negatives_per_error_3" style="color: red; display: none;"></span></td>
  </tr>
   <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="negatives_title_4" id="negatives_title_4" value="Anxious"  >
<span id="negatives_title_error_4" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="negatives_per_4" id="negatives_per_4"   placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="negatives_per_error_4" style="color: red; display: none;"></span></td>
  </tr>
   <tr>
  <td><input type="text" class="input-group-lg full_input mb-5" name="negatives_title_5" id="negatives_title_5" value="Paranoid"  >
<span id="negatives_title_error_5" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="4" name="negatives_per_5" id="negatives_per_5"  placeholder="">
<span class="input-group-addon">%</span>
</div>
<span id="negatives_per_error_5" style="color: red; display: none;"></span></td>
  </tr>
  </tbody>
  </table>
  </div>
  </div>

</div>



<div class="mt-20 text-right">
<button type="submit" class="btn___green">Publish</button>
</div>
</div>
</div>

</div>

</div>

 <div class="col-md-3 col-sm-3 col-xs-12"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
document.getElementById('fake-file-button-browse').addEventListener('click', function() {
document.getElementById('files-input-upload').click();
});

document.getElementById('files-input-upload').addEventListener('change', function() {
document.getElementById('fake-file-input-name').value = this.value;

});
</script>



</div>


</div>
</div>
</div>
</div>
</div>
</form>
 </div>
</section>
<!-- End Shop Item Section -->

<div class="clearfix"></div>
</div>
<!-- Site Wraper End -->

@include('super_admin.z_footer')
<script src="{{URL::to('/')}}/admin/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/mediaelement-and-player.min.js"></script>
<script src="{{URL::to('/')}}/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/super_admin/js/extra/related_product.js?254"></script>


  <script type="text/javascript">


$(document).ready(function() {
    var max_fields      = 5; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
           document.getElementById('totalInvoice').value=x;
            $(wrapper).append('<div class="mb-20" style="clear:both;"><div style="background-color:#59d028; height:1px; margin-bottom:20px;"></div><div class="row"><div class="col-sm-6 col-xs-12"><div class="mb-20"><input type="text" class="input-group-lg full_input" placeholder="Add the Quantity" name="question_'+x+'" id="question_'+x+'"><span id="question_error_'+x+'" style="color: red; display: none;"></span></div></div><div class="col-sm-6 col-xs-12"><div class="mb-20"><input type="number" class="input-group-lg full_input" placeholder="Add the Price" name="ans_'+x+'" id="ans_'+x+'"><span id="ans_error_'+x+'" style="color: red; display: none;"></span></div></div></div><div class="m-b-20" style="clear:both;"></div><a style="text-align: right;float: right;" href="#" class="remove_field tt_green_text"><i class="fa fa-minus" aria-hidden="true"></i> REMOVE</a></div><div class="clearfix" style="clear:both;margin-bottom: 18px;"></div>'); //add input box

        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove(); x--;
         document.getElementById('totalInvoice').value=x;

    })
});
</script>



<style>
.ui-corner-bottom{
  padding: 0px !important;

}
.tt_green_text  {
  background: none !important ;
}
.tt_green_text  {
  background: none !important ;
}
select.cart_quantity {
    height: 54px;
}
    .heading_style_left .title {
    font-size: 18px !important;
    color: #22aa00 !important;
}
.brdr_btm_br{
  border-bottom:1px solid #ddd; margin-bottom: 8px; padding-bottom: 15px;
}

</style>
</body>
</html>