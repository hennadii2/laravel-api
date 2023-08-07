@include('admin.z_header')
<link href="{{URL::to('/')}}/admin/css/jquery-ui.css?5" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/admin/css/smooth-products.css?2" rel="stylesheet" />

<script>
function preview_images()
{
  $('#image_preview').html("");
 var total_file=document.getElementById("files-input-upload").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<div style='width: 50px; height: 50px; margin:0px 7px 7px 0px; display: inline-block;'><img class='img-responsive' style='width: 50px; height: 50px; display: inline-block;' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
 }
}
</script>
</head>

<body>
<!-- Site Wraper -->
<div class="wrapper">
<!-- Header -->
@include('admin.z_top')
<!-- End Header -->

<div class="clearfix"></div>

<!-- Shop Item Detail Section -->
<section class="main__container">
<div class="">
<div class="page-breadcrumb"> <a href="{{URL::to('/')}}/admin/index">Home</a>/<span>Checkout</span> </div>
 <form role="form" id="form-stander" name="standardType" onSubmit="return validateStanFrm();" action="productSave" method="POST" enctype="multipart/form-data">
  <input type="hidden" value="0" id="save_status" name="save_status" />
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row page__main__heading">
<div class="col-sm-6 col-sx-12">
<div>Add Your Product</div>
</div>
<div class="col-sm-6 col-sx-12">
<div class="text-right">
<button  class="btn__white__border" type="button" id="saveDarf"><img src="{{URL::to('/')}}/admin/images/icon/draft.png" style="margin-right:5px; margin-top:-2px;" />Save as Draft</button>
<!--&nbsp;<a href="#" class="btn___green"><img src="{{URL::to('/')}}/admin/images/icon/publish.png" style="margin-right:5px; margin-top:-2px;" />Publish</a>           -->
</div>
</div>
</div>
@if (Session::has('success'))
  <div class="alert alert-success" id='errordiv'>{{ Session::get('success') }}
  @if(!empty(Session::get('Product_id')))
  <a href="{{URL::to('/')}}/{{ Session::get('member_name') }}/product-details/{{ Session::get('Product id') }}" target="_blank" style="font-weight:600; background-color: #fff; font-size: 14px;  color:#22aa00;  padding: 4px 10px;">View Product</a>
  @else
  <a href="{{URL::to('/')}}/admin/saved-products" target="_blank" style="font-weight:600; background-color: #fff; font-size: 14px;  color:#22aa00;  padding: 4px 10px;">View Product</a>
  @endif
  <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >×</span></div>
  @endif
<div style="background-color:#fff;">
<div class="row mt-30">
<div class="col-md-12">
<div class="tree-top-content">
<!-- Tab -->
<div class="tabs">
<ul>
<li  id="tab_1"><a href="javascript:void();" class="disabled"   >Step 1 <span>- Add</span><br/>
Product Info</a></li>
<li  id="tab_2"><a href="javascript:void();" class="disabled">Step 2 <span>- Add</span><br/>
Price</a></li>
<li  id="tab_3"><a href="javascript:void();" class="disabled" >Step 3 <span>- Add</span><br/>
Medical Effects</a></li>
</ul>
<style>
   .tabs ul li{  outline:none !important;}
            a.disabled {
   pointer-events: none;
   cursor: default;
   outline:none !important;
}
            </style>
<div class="ui-tab-content">
<div id="tab1" class="tab-pane ui-tabs-panel">
<div class="row">
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="left__content">
<div class="tt_green_text">Add your product info</div>
<div class="tt_description_title">How it works?</div>
<p class="tt___content"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In viverra sed ex a scelerisque. Curabitur sit amet purus fringilla, consectetur libero id, imperdiet turpis. Duis pellentesque enim sit amet arcu feugiat efficitur. Curabitur suscipit nulla tincidunt, efficitur erat quis, iaculis eros. Nam eu ex lacinia, rutrum elit et, dignissim justo. Nullam dapibus maximus nisi, quis congue quam venenatis et. </p>
</div>
</div>
<div class="col-md-8 col-sm-6 col-xs-12">
<div class="form__right__box">
<div class="form____title">Product Info</div>

<div class="row">
<div class="col-md-11">
<div class="mb-20">
<label>Product Title <span class="text-danger">*</span> </label>
<input type="text" class="input-group-lg full_input" id="pro_title" name="pro_title"  placeholder="Product Title *" >
<span id="pro_title_error" style="color: red; display: none;"></span>
</div>
<div class="mb-20">
<label>Product Categories <span class="text-danger">*</span> </label>
<select name="pro_type" id="pro_type" class="cart_quantity  full_input" style="max-width: 588px; !important;" >
<option value="">Product Categories *</option>
@foreach($type as $key => $value)
<option value="{{$value->type_id}}" >{{$value->type_name}}</option>
@endforeach
</select>
<span id="pro_type_error" style="color: red; display: none;"></span>
 </div>

 <div class="mb-20">
 <label>Select Brand <span class="text-danger">*</span> </label>
<select name="brand" id="brand" class="cart_quantity  full_input" style="max-width: 588px; !important;" >
<option value="">Select Brand *</option>
@foreach($brand as $key => $value)
<option value="{{$value->brand_id}}" >{{$value->name}}</option>
@endforeach
</select>
<span id="brand_error" style="color: red; display: none;"></span>
 </div>


<div class="mb-20">
<label>Product Short Description <span class="text-danger">*</span> </label>
<input type="text" class="input-group-lg full_input" id="short_desc" name="short_desc" placeholder="Product Short Description" >
<span id="short_desc_error" style="color: red; display: none;"></span>
</div>
<div class="mb-20">
<label>Product Long Description<span class="text-danger">*</span> </label>
<textarea class="input-group-lg full_input" style="height:180px;" id="pro_desc" name="pro_desc" placeholder="Product Long Description">
</textarea>
<span id="pro_desc_error" style="color: red; display: none;"></span>
</div>
<!--<div class="row mb-20">
<div class="col-sm-5 col-xs-12  mt-15"><b>Product Price</b></div>
<div class="col-sm-7 col-xs-12">
<div class="input-group"> <span class="input-group-addon">$</span>
<input type="text" class="input-group-lg" onkeyup="if(!isNum(this.value)) this.value='';" maxlength="10" id="pro_price" name="pro_price" style="width:99%;" placeholder="">

</div>
<span id="pro_price_error" style="color: red; display: none;"></span>
</div>
</div>-->
<div class="row mb-20">
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
<div class="row" id="image_preview"></div>
<!--<input  type="file" class="form-control" name="images[]" placeholder="address" multiple>  -->
<div class="mt-20 text-right">
<button  class="btn__white__border" disabled="disabled">Previous</button> &nbsp;
<button type="button" onClick="validateStanFrm('1');" class="btn___green">Next</button>

</div>
</div>
</div>

</div>
</div>
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
<div id="tab2" class="tab-pane ui-tabs-panel" style="display: none;">
<div class="row">
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="left__content">
<div class="tt_green_text">Add price</div>
<div class="tt_description_title">How it works?</div>
<p class="tt___content"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In viverra sed ex a scelerisque. Curabitur sit amet purus fringilla, consectetur libero id, imperdiet turpis. Duis pellentesque enim sit amet arcu feugiat efficitur. Curabitur suscipit nulla tincidunt, efficitur erat quis, iaculis eros. Nam eu ex lacinia, rutrum elit et, dignissim justo. Nullam dapibus maximus nisi, quis congue quam venenatis et. </p>
</div>
</div>
<div class="col-md-8 col-sm-6 col-xs-12">
<div class="form__right__box">
<div class="form____title">Price</div>

<div class="row">
<div class="col-md-11">
<div class="input_fields_wrap">
<div class="row">
<div class="col-sm-6 col-xs-12">
        <div class="mb-20">
        <label>Add the Quantity <span class="text-danger">*</span> </label>
        <input type="text" class="input-group-lg full_input"  name="question_1" id="question_1" placeholder="Add the Quantity" >
        <span id="question_error_1" style="color: red; display: none;"></span>
        </div></div>
<div class="col-sm-6 col-xs-12">
          <div class="mb-20">
           <label>Add the Price <span class="text-danger">*</span> </label>
        <input type="number" class="input-group-lg full_input" name="ans_1" id="ans_1" placeholder="Add the Price" >
        <span id="ans_error_1" style="color: red; display: none;"></span>
        </div></div>
</div>
        
        
</div>

<div class="clearfix"></div>
<div class="mb-20 text-right">
<button  class="add_field_button tt_green_text"><i class="fa fa-plus"></i> Add more</button>
</div>
   <input type="hidden" id="totalInvoice" name="totalInvoice" value="1" />

<div class="mt-20 text-right">
<button type="button" onClick="openTab('tab1','tab_1','next_1','previous_1');" class="btn__white__border">Previous</button> &nbsp;
<!--<button type="button" onclick="openTab('tab3','tab_3','next_4','previous_3');" class="btn___green">Next</button> -->
<button type="button"  onclick="validateStanFrm('2');"  class="btn___green">Next</button>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

<div id="tab3" class="tab-pane ui-tabs-panel" style="display: none;">
<div class="row">
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="left__content">
<div class="tt_green_text">Add medical data</div>
<div class="tt_description_title">How it works?</div>
<p class="tt___content"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In viverra sed ex a scelerisque. Curabitur sit amet purus fringilla, consectetur libero id, imperdiet turpis. Duis pellentesque enim sit amet arcu feugiat efficitur. Curabitur suscipit nulla tincidunt, efficitur erat quis, iaculis eros. Nam eu ex lacinia, rutrum elit et, dignissim justo. Nullam dapibus maximus nisi, quis congue quam venenatis et. </p>
</div>
</div>
<div class="col-md-8 col-sm-6 col-xs-12">
<div class="form__right__box">


<div class="row">
<div class="col-md-11">
<div class="form____title mb-10">Effects</div>
<div class="mb-30">
<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="effects_title_1" id="effects_title_1" value="Relaxed"  >
<span id="effects_title_error_1" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="effects_per_1" id="effects_per_1"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="effects_per_error_1" style="color: red; display: none;"></span>
</div>
</div>


<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="effects_title_2" id="effects_title_2" value="Happy"  >
<span id="effects_title_error_2" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="effects_per_2" id="effects_per_2"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="effects_per_error_2" style="color: red; display: none;"></span>
</div>
</div>

<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="effects_title_3" id="effects_title_3" value="Euphoric"  >
<span id="effects_title_error_3" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="effects_per_3" id="effects_per_3"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="effects_per_error_3" style="color: red; display: none;"></span>
</div>
</div>

<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="effects_title_4" id="effects_title_4" value="Uplifted"  >
<span id="effects_title_error_4" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="effects_per_4" id="effects_per_4"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="effects_per_error_4" style="color: red; display: none;"></span>
</div>
</div>

<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="effects_title_5" id="effects_title_5" value="Sleepy"  >
<span id="effects_title_error_5" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="effects_per_5" id="effects_per_5"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="effects_per_error_5" style="color: red; display: none;"></span>
</div>
</div>
</div>
<div class="form____title mb-10">Medical</div>
<div class="mb-30">
<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="medical_title_1" id="medical_title_1" value="Stress"  >
<span id="medical_title_error_1" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="medical_per_1" id="medical_per_1"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="medical_per_error_1" style="color: red; display: none;"></span>
</div>
</div>


<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="medical_title_2" id="medical_title_2" value="Pain"  >
<span id="medical_title_error_2" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="medical_per_2" id="medical_per_2"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="medical_per_error_2" style="color: red; display: none;"></span>
</div>
</div>

<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="medical_title_3" id="medical_title_3" value="Depression"  >
<span id="medical_title_error_3" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="medical_per_3" id="medical_per_3"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="medical_per_error_3" style="color: red; display: none;"></span>
</div>
</div>

<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="medical_title_4" id="medical_title_4" value="Insomnia"  >
<span id="medical_title_error_4" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="medical_per_4" id="medical_per_4"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="medical_per_error_4" style="color: red; display: none;"></span>
</div>
</div>

<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="medical_title_5" id="medical_title_5" value="Lack of Appetite"  >
<span id="medical_title_error_5" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="medical_per_5" id="medical_per_5"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="medical_per_error_5" style="color: red; display: none;"></span>
</div>
</div>
</div>
<div class="form____title mb-10">Negatives</div>
<div class="mb-30">
<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="negatives_title_1" id="negatives_title_1" value="Dry Mouth"  >
<span id="negatives_title_error_1" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="negatives_per_1" id="negatives_per_1"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="negatives_per_error_1" style="color: red; display: none;"></span>
</div>
</div>


<div class="row">
<div class="col-sm-7 col-xs-12">
<input type="text" class="input-group-lg full_input mb-5" name="negatives_title_2" id="negatives_title_2" value="Dry Eyes"  >
<span id="negatives_title_error_2" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="negatives_per_2" id="negatives_per_2"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="negatives_per_error_2" style="color: red; display: none;"></span>
</div>
</div>

<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="negatives_title_3" id="negatives_title_3" value="Dizzy"  >
<span id="negatives_title_error_3" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="negatives_per_3" id="negatives_per_3"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="negatives_per_error_3" style="color: red; display: none;"></span>
</div>
</div>

<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="negatives_title_4" id="negatives_title_4" value="Anxious"  >
<span id="negatives_title_error_4" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="negatives_per_4" id="negatives_per_4"  placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="negatives_per_error_4" style="color: red; display: none;"></span>
</div>
</div>

<div class="row">
<div class="col-sm-7 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" name="negatives_title_5" id="negatives_title_5" value="Paranoid"  >
<span id="negatives_title_error_5" style="color: red; display: none;"></span></div>
<div class="col-sm-5 col-xs-12">
<div class="input-group">
<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="negatives_per_5" id="negatives_per_5"   placeholder="Percentage">
<span class="input-group-addon">%</span>
</div>
<span id="negatives_per_error_5" style="color: red; display: none;"></span>
</div>
</div>
</div>



<div class="mt-20 text-right">
<button type="button" onClick="openTab('tab2','tab_2','next_3','previous_2');" class="btn__white__border">Previous</button> &nbsp;
<button type="submit" class="btn___green">Publish</button>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
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

@include('admin.z_footer')
<script src="{{URL::to('/')}}/admin/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/mediaelement-and-player.min.js"></script>
<script src="{{URL::to('/')}}/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/extra/validation_product.js?123"></script>

  <script type="text/javascript">

$(document).ready(function() {
    var max_fields      = 15; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
           document.getElementById('totalInvoice').value=x;
            $(wrapper).append('<div class="mb-20" style="clear:both;"><hr style="border-top: 1px solid #59d028;"><div class="row"><div class="col-sm-6 col-xs-12"><div class="mb-20"><input type="text" class="input-group-lg full_input" placeholder="Add the Quantity" name="question_'+x+'" id="question_'+x+'"><span id="question_error_'+x+'" style="color: red; display: none;"></span></div></div><div class="col-sm-6 col-xs-12"><div class="mb-20"><input type="number" class="input-group-lg full_input" placeholder="Add the Price" name="ans_'+x+'" id="ans_'+x+'"><span id="ans_error_'+x+'" style="color: red; display: none;"></span></div></div></div><div class="m-b-20" style="clear:both;"></div><a style="text-align: right;float: right;" href="#" class="remove_field tt_green_text"><i class="fa fa-minus" aria-hidden="true"></i> REMOVE</a></div><div class="clearfix" style="clear:both;margin-bottom: 18px;"></div>'); //add input box

        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove(); x--;
         document.getElementById('totalInvoice').value=x;

    })
});
</script>

<script>
 // document.getElementById("next_2").style.display = "block";
function openTab(cityName,activeTab,nextId,pre) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tab-pane");
  for (i = 0; i < tabcontent.length; i++) {
  tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("ui-state-default ui-corner-top ui-tabs-active ui-state-active");
  for (i = 0; i < tablinks.length; i++) {
  tablinks[i].className = tablinks[i].className.replace("ui-state-default ui-corner-top ui-tabs-active ui-state-active", "ui-state-default ui-corner-top");
  }
  //For next
  document.getElementById(cityName).style.display = "block";

  var d = document.getElementById(activeTab);
  d.className += "ui-state-default ui-corner-top ui-tabs-active ui-state-active"; //for active
}


     //Save as draft
      $(document).ready(function($){
      var form1 =  $("#form-stander");
      $("#saveDarf").click(function(){

      document.getElementById('save_status').value=1;
      document.getElementById("form-stander").setAttribute( "onsubmit", "" );
      var pro_title=jQuery('#pro_title').val();
      var pro_type=jQuery('#pro_type').val();
      var brand=jQuery('#brand').val();
       jQuery('#pro_title_error').hide();
       jQuery('#pro_type_error').hide();
       jQuery('#brand_error').hide();
      if(pro_title.trim()=="" || pro_type.trim()=="" || brand.trim()==""){
      openTab('tab1','tab_1','next_2','previous_1');
      }

      if(pro_title.trim()==""){
      jQuery('#pro_title_error').show();
      jQuery('#pro_title_error').html("Please enter product title.");
      jQuery('#pro_title').focus();
      return false;
      }

      if(pro_type.trim()==""){
      jQuery('#pro_type_error').show();
      jQuery('#pro_type_error').html("Please select categorie.");
      jQuery('#pro_type').focus();
      return false;
      }

      if(brand.trim()==""){
      jQuery('#brand_error').show();
      jQuery('#brand_error').html("Please select product brand.");
      jQuery('#brand').focus();
      return false;
      }


    else{ form1.submit();
    }
    // form1.submit();
    });


    });
</script>

<style>
.ui-corner-bottom{
  padding: 0px !important;

}
.tt_green_text  {
  background: none !important ;
}
select.cart_quantity {
    height: 54px;
}

</style>
</body>
</html>