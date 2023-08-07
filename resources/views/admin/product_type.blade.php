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
<div class="page-breadcrumb mb-30"> <a href="{{URL::to('/')}}/admin/index">Setting</a>/<span>Product Categories</span> </div>
<div class="row page__main__heading m-t-0">
<div class="col-sm-12 col-sx-12"> Product Categories </div>
</div>
@if (Session::has('brand_success'))
  <div class="alert alert-{{ Session::get('success_btn') }}" id='errordiv'>{{ Session::get('brand_success') }} <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >x</span></div>
  @endif
<div class="row">
<div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 mb-20">
<div class="box__shadow box____pad">
<table class="table mb-0">
<tbody>
<tr>

<th class="th__head">CATEGORIES NAME</th>
<th class="th__head">ACTION</th>
</tr>
@foreach($brand as $key => $value)
<tr>
<td>{{$value->type_name}} </td>
<td><a href="{{URL::to('/')}}/admin/product_type/{{$value->type_id}}" class="tt_green_text"><i class="fa fa-pencil"></i> Edit</a> |
<a href="{{URL::to('/')}}/admin/type_delete/{{$value->type_id}}" class="tt_green_text red_text"><i class="fa fa-trash"></i> Delete</a></td>
</tr>
@endforeach

</tbody>
</table>
</div>
</div>
<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
<div class="box__shadow box____pad">
<div class="">

 @if (empty($edit_id))
<h4 class="mt-10 mb-15"><b>Add Product Categories</b></h4>
<form class="" method="POST" role="form" id="form-profile" enctype="multipart/form-data" action="addProductType">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">
<div class="col-md-11">
<div class="mb-20">
<input type="text" name="brand_name" required class="input-group-lg full_input">
</div>
<div class="mt-20 text-right">
<button type="submit" class="btn___green">ADD CATEGORIES</button>
</div>
</div>
</div>
</form>
 @endif

 <?php
 if(!empty($edit_id->type_name)) {
   $brand_name=$edit_id->type_name;
   $brand_id=$edit_id->type_id;
 }else{
   $brand_name='';
   $brand_id='';
 }
 ?>
 @if (!empty($edit_id))
<h4 class="mt-10 mb-15"><b>Edit PRODUCT TYPE</b></h4>
<form class="" method="POST" role="form" id="form-profile" enctype="multipart/form-data" action="updateType">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">
<div class="col-md-11">
<div class="mb-20">
<input type="text" name="brand_name" value="<?php echo $brand_name;?>" required class="input-group-lg full_input">
<input type="hidden" name="edit_id" value="<?php echo $brand_id;?>">
</div>
<div class="mt-20 text-right">
<button type="submit" class="btn___green">EDIT TYPE</button>
</div>
</div>
</div>
</form>
 @endif
</div>
</div>
</div>
</div>
</section>
</div>
<!-- Site Wraper End -->

@include('admin.z_footer')
<link href="{{URL::to('/')}}/admin/css/custom__dashboard.css" rel="stylesheet" type="text/css" />
<style>
.table>tbody>tr>td{ padding:15px 0px 13px 0px !important; color:#808080 !important; font-weight:400;}
th.th__head {
font-family: 'proximanova_regular';
font-weight: bold;
color: #222222 !important;
padding-top:0px !important;
}
.m-t-0{margin-top:0px !important;}
.box____pad{background-color:#fff; padding:40px;}
a.red_text, a.red_text:hover{ color:#F00 !important;}
</style>
</body>
</html>