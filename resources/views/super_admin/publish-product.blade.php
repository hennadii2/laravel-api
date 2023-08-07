@include('admin.z_header')
</head>

<body>
<!-- Site Wraper -->
<div class="wrapper">
<!-- Header -->
@include('admin.z_top')
<!-- End Header -->

<div class="clearfix"></div>
<section class="main__container">
<div class="row">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div style="background-color:#fff; padding-top:30px;" class="box__shadow">
<div class="heading_style"> <span class="title" style="font-size:26px !important;">Selected Products</span> </div>

<div style=" padding:20px;">
<section style="padding-bottom:40px;">
<div class="container">
<div class="row">
<div class="col-md-12">

<div class="tree-top-content">
<div class="accordion">
<div class="accordion-section">
<h3 class="accordion-title">Blueberry Bubblegum </h3>
<div class="accordion-content">

<form>
<div class="heading_style_left mb-10"> <span class="title">Product Information</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table mb-0">
<tbody>

<tr>
  <td>
  <label>Type</label>
  <input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Flower">

  </td>
</tr>

<tr>
  <td>
   <label>Brand</label>
  <input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Blueberry">

  </td>
</tr>
 <tr>
  <td>
  <label>Short Description</label>
   <input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Created Feelings: Blue Dream hits you with a great full-bodied testing flavor.">

  </td>
</tr>

<tr>
  <td>
   <label>Long Description</label>
  <textarea class="input-group-lg full_input" style="height:100px;" id="pro_desc" name="pro_desc" placeholder="">Created Feelings: Blue Dream hits you with a great full-bodied flavor. Followed by a Euphoric, uplifting and focused high. Blue Dream is great for creativity, a favorite amongst artists.</textarea>

  </td>
</tr>
</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12"><img src="{{URL::to('/')}}/admin/images/products/1.jpg" class="img-responsive" /></div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Price Information</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Quantity</th>
  <th>Price</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="10">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="100">
  </td>

</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="15">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="150">
  </td>

</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Effects</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Relaxed">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Happy">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Euphoric">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Uplifted">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Sleepy">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Medical</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Stress">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Pain">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Depression">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Insomnia">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Lack of Appetite">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Negatives</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Dry Mouth">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Dry Eyes">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Dizzy">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Anxious">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Paranoid">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>

<div class="mb-20">
<button type="submit" class="btn___green">ADD TO MENU</button> &nbsp;
<button type="button" onClick="" class="btn__white__border">DELETE</button> &nbsp;
<button type="button" onClick="" class="btn__white__border">CANCEL</button>
</div>
</form>

</div>
</div>

<div class="accordion-section">
<h3 class="accordion-title">Product Title One </h3>
<div class="accordion-content">
<form>
<div class="heading_style_left mb-10"> <span class="title">Product Information</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table mb-0">
<tbody>

<tr>
  <td>
  <label>Type</label>
  <input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Flower">

  </td>
</tr>

<tr>
  <td>
   <label>Brand</label>
  <input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Blueberry">

  </td>
</tr>
 <tr>
  <td>
  <label>Short Description</label>
   <input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Created Feelings: Blue Dream hits you with a great full-bodied testing flavor.">

  </td>
</tr>

<tr>
  <td>
   <label>Long Description</label>
  <textarea class="input-group-lg full_input" style="height:100px;" id="pro_desc" name="pro_desc" placeholder="">Created Feelings: Blue Dream hits you with a great full-bodied flavor. Followed by a Euphoric, uplifting and focused high. Blue Dream is great for creativity, a favorite amongst artists.</textarea>

  </td>
</tr>
</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12"><img src="{{URL::to('/')}}/admin/images/products/1.jpg" class="img-responsive" /></div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Price Information</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Quantity</th>
  <th>Price</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="10">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="100">
  </td>

</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="15">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="150">
  </td>

</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Effects</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Relaxed">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Happy">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Euphoric">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Uplifted">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Sleepy">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Medical</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Stress">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Pain">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Depression">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Insomnia">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Lack of Appetite">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Negatives</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Dry Mouth">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Dry Eyes">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Dizzy">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Anxious">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Paranoid">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>

<div class="mb-20">
<button type="submit" class="btn___green">ADD TO MENU</button> &nbsp;
<button type="button" onClick="" class="btn__white__border">DELETE</button> &nbsp;
<button type="button" onClick="" class="btn__white__border">CANCEL</button>
</div>
</form>
</div>
</div>
<div class="accordion-section">
<h3 class="accordion-title">Product Title Two</h3>
<div class="accordion-content">
<form>
<div class="heading_style_left mb-10"> <span class="title">Product Information</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table mb-0">
<tbody>

<tr>
  <td>
  <label>Type</label>
  <input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Flower">

  </td>
</tr>

<tr>
  <td>
   <label>Brand</label>
  <input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Blueberry">

  </td>
</tr>
 <tr>
  <td>
  <label>Short Description</label>
   <input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Created Feelings: Blue Dream hits you with a great full-bodied testing flavor.">

  </td>
</tr>

<tr>
  <td>
   <label>Long Description</label>
  <textarea class="input-group-lg full_input" style="height:100px;" id="pro_desc" name="pro_desc" placeholder="">Created Feelings: Blue Dream hits you with a great full-bodied flavor. Followed by a Euphoric, uplifting and focused high. Blue Dream is great for creativity, a favorite amongst artists.</textarea>

  </td>
</tr>
</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12"><img src="{{URL::to('/')}}/admin/images/products/1.jpg" class="img-responsive" /></div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Price Information</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Quantity</th>
  <th>Price</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="10">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="100">
  </td>

</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="15">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="150">
  </td>

</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Effects</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Relaxed">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Happy">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Euphoric">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Uplifted">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Sleepy">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Medical</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Stress">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Pain">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Depression">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Insomnia">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Lack of Appetite">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Negatives</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Dry Mouth">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Dry Eyes">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Dizzy">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Anxious">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Paranoid">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>

<div class="mb-20">
<button type="submit" class="btn___green">ADD TO MENU</button> &nbsp;
<button type="button" onClick="" class="btn__white__border">DELETE</button> &nbsp;
<button type="button" onClick="" class="btn__white__border">CANCEL</button>
</div>
</form>
</div>
</div>
<div class="accordion-section">
<h3 class="accordion-title">Product Title Three </h3>
<div class="accordion-content">
<form>
<div class="heading_style_left mb-10"> <span class="title">Product Information</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table mb-0">
<tbody>

<tr>
  <td>
  <label>Type</label>
  <input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Flower">

  </td>
</tr>

<tr>
  <td>
   <label>Brand</label>
  <input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Blueberry">

  </td>
</tr>
 <tr>
  <td>
  <label>Short Description</label>
   <input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Created Feelings: Blue Dream hits you with a great full-bodied testing flavor.">

  </td>
</tr>

<tr>
  <td>
   <label>Long Description</label>
  <textarea class="input-group-lg full_input" style="height:100px;" id="pro_desc" name="pro_desc" placeholder="">Created Feelings: Blue Dream hits you with a great full-bodied flavor. Followed by a Euphoric, uplifting and focused high. Blue Dream is great for creativity, a favorite amongst artists.</textarea>

  </td>
</tr>
</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12"><img src="{{URL::to('/')}}/admin/images/products/1.jpg" class="img-responsive" /></div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Price Information</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Quantity</th>
  <th>Price</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="10">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="100">
  </td>

</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="15">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="150">
  </td>

</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Effects</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Relaxed">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Happy">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Euphoric">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Uplifted">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Sleepy">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Medical</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Stress">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Pain">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Depression">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Insomnia">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Lack of Appetite">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>
<div class="heading_style_left mb-10"> <span class="title">Negatives</span> </div>
<div class="row">
<div class="col-sm-8 col-xs-12">
<table class="table table-bordered table-padding">
<tbody>
<tr>
  <th style="width:50%;">Name</th>
  <th>Percentage</th>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Dry Mouth">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
<tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Dry Eyes">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Dizzy">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Anxious">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>
 <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="pro_title" placeholder="" value="Paranoid">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
<input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="" id="" value="10">
<span class="input-group-addon">%</span></div>
  </td>
</tr>

</tbody>
</table>
</div>
<div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

</div>


<div class="mb-20">
<button type="submit" class="btn___green">ADD TO MENU</button> &nbsp;
<button type="button" onClick="" class="btn__white__border">DELETE</button> &nbsp;
<button type="button" onClick="" class="btn__white__border">CANCEL</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>
</section>
</div>

</div>
</div>

</div>
</section>
</div>
<!-- Site Wraper End -->

 @include('admin.z_footer')
<link href="{{URL::to('/')}}/admin/css/custom__dashboard.css" rel="stylesheet" type="text/css" />
<script src="{{URL::to('/')}}/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
<style>
.tree-top-content p{margin-top:0px;}
.heading_style_left .title{ font-size:18px !important; color: #22aa00 !important;  }
.table-padding tr td, .table-padding tr th{ padding:15px !important;  }
label{ margin-top:0px !important;}
h3.accordion-title{font-size:22px !important;}
</style>

</body>
</html>