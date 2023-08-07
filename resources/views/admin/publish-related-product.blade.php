  @include('admin.z_header')
  <style>
   .thumb_preview{
     float:left; width:100px; height: 100px; margin: 0px 8px 8px 0px; border: 1px solid #ddd;
   }


   </style>
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
  <form class="" role="search" name="form1" id="form1" action="publish-related-product" method="POST">
 <input type="hidden" name="_token" value="{{ csrf_token() }}">
 @if ($sel_product!='')
  @foreach($sel_product as $key => $value)
   <input type="checkbox" id="sel_pro_{{$value->prod_id}}" name="sel_pro[]" value="{{$value->prod_id}}" checked="checked" style="display:none;">
  @endforeach
   @endif
  </form>
   <?php $k=1;
    ?>
   @if ($sel_product!='')
  @foreach($sel_product as $key => $value)
  <?php if($k==1){
    $dispaly='block';
    $active='active';
  }else{
    $dispaly='none';
    $active='';
  }?>
  <div class="accordion-section">
  <h3 class="accordion-title <?php echo $active;?>">{{$value->pro_title}}</h3>
  <div class="accordion-content" style="display: <?php echo $dispaly;?>;">

  <form name="add_form_{{$value->prod_id}}" id="add_form_{{$value->prod_id}}" action="publish-related-product" method="POST">

   <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <input type="hidden" name="action" value="add">
   <input type="hidden"   name="pro_title"  value="{{$value->pro_title}}">
   <input type="hidden"   name="pro_id"  value="{{$value->prod_id}}">
   <input type="hidden"   name="selected_id"  value="{{$pro_id}}">


  <div class="heading_style_left mb-10"> <span class="title">Product Information</span> </div>
  <div class="row">
  <div class="col-sm-8 col-xs-12">
  <table class="table mb-0">
  <tbody>

  <tr>
  <td>
  <label>Type</label>
  <input type="text" class="input-group-lg full_input" id="" name="pro_type" placeholder="" value="{{$value->type_name}}">

  </td>
  </tr>

  <tr>
  <td>
  <label>Brand</label>
  <input type="text" class="input-group-lg full_input" id="" name="brand" placeholder="" value="{{$value->name}}">

  </td>
  </tr>
  <tr>
  <td>
  <label>Short Description</label>
  <input type="text" class="input-group-lg full_input" id="" name="short_desc" placeholder="" value="{{$value->short_desc}}">

  </td>
  </tr>

  <tr>
  <td>
  <label>Long Description</label>
  <textarea class="input-group-lg full_input" style="height:100px;" id="pro_desc" name="pro_desc">{{$value->pro_desc}}</textarea>

  </td>
  </tr>
  </tbody>
  </table>
  </div>
  <div class="col-sm-4 col-xs-12">
<div id="image_preview" ></div>
  <?php
  if($value->pro_image!=''){?>
 <div class="thumb_preview" ><img class='img-responsive' style='width: 100%; height: 100%;' src="{{URL::to('/')}}/product_images/{{$value->prod_id}}/{{$value->pro_image}}"></div>
<?php }else{?>
          <div class="thumb_preview" id="diffult_img"><img src="{{URL::to('/')}}/default.png" class="img-responsive" /> </div>
<?php }?>
 <?php
  $gallery = DB::table('products_image')
  ->where('pro_id','=', $value->prod_id)->get();
  if(count($gallery)>0)
  {  $k=1;
  foreach($gallery as $key => $img_list){
    if($k!=1){?>
    <div class="thumb_preview" >
 <img class='img-responsive' style='width: 100%; height: 100%;' src="{{URL::to('/')}}/product_images/{{$value->prod_id}}/{{$img_list->image}}"></div>


  <?php }
  $k++;}}?>



</div>





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
  <td><input type="text" class="input-group-lg full_input" id="" name="question_1" placeholder="" value="{{$value->quantity_1}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><input type="text" class="input-group-lg full_input" id="" name="ans_1" placeholder="" value="{{$value->price_1}}">
  </td>
  </tr>
   <?php
   if($value->quantity_2!=''){?>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="question_2" placeholder="" value="{{$value->quantity_2}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><input type="text" class="input-group-lg full_input" id="" name="ans_2" placeholder="" value="{{$value->price_2}}">
  </td>
  </tr>
   <?php }?>

  <?php
   if($value->quantity_3!=''){?>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="question_3" placeholder="" value="{{$value->quantity_3}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><input type="text" class="input-group-lg full_input" id="" name="ans_3" placeholder="" value="{{$value->price_3}}">
  </td>
  </tr>
   <?php }?>
   <?php
   if($value->quantity_4!=''){?>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="question_4" placeholder="" value="{{$value->quantity_4}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><input type="text" class="input-group-lg full_input" id="" name="ans_4" placeholder="" value="{{$value->price_4}}">
  </td>
  </tr>
   <?php }?>

   <?php
   if($value->quantity_5!=''){?>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="question_5" placeholder="" value="{{$value->quantity_5}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><input type="text" class="input-group-lg full_input" id="" name="ans_5" placeholder="" value="{{$value->price_5}}">
  </td>
  </tr>
   <?php }?>


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
  <td><input type="text" class="input-group-lg full_input" id="" name="effects_title_1" placeholder="" value="{{$value->effects_title_1}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="effects_per_1" id="" value="{{$value->effects_per_1}}">
  <span class="input-group-addon">%</span></div>
  </td>
  </tr>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="effects_title_2" placeholder="" value="{{$value->effects_title_2}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="effects_per_2" id="" value="{{$value->effects_per_2}}">
  <span class="input-group-addon">%</span></div>
  </td>
  </tr>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="effects_title_3" placeholder="" value="{{$value->effects_title_3}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="effects_per_3" id="" value="{{$value->effects_per_3}}">
  <span class="input-group-addon">%</span></div>
  </td>
  </tr>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="effects_title_4" placeholder="" value="{{$value->effects_title_4}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="effects_per_4" id="" value="{{$value->effects_per_4}}">
  <span class="input-group-addon">%</span></div>
  </td>
  </tr>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="effects_title_5" placeholder="" value="{{$value->effects_title_5}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="effects_per_5" id="" value="{{$value->effects_per_5}}">
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
  <td><input type="text" class="input-group-lg full_input" id="" name="medical_title_1" placeholder="" value="{{$value->medical_title_1}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="medical_per_1" id="" value="{{$value->medical_per_1}}">
  <span class="input-group-addon">%</span></div>
  </td>
  </tr>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="medical_title_2" placeholder="" value="{{$value->medical_title_2}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="medical_per_2" id="" value="{{$value->medical_per_2}}">
  <span class="input-group-addon">%</span></div>
  </td>
  </tr>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="medical_title_3" placeholder="" value="{{$value->medical_title_3}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="medical_per_3" id="" value="{{$value->medical_per_3}}">
  <span class="input-group-addon">%</span></div>
  </td>
  </tr>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="medical_title_4" placeholder="" value="{{$value->medical_title_4}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="medical_per_4" id="" value="{{$value->medical_per_4}}">
  <span class="input-group-addon">%</span></div>
  </td>
  </tr>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="medical_title_5" placeholder="" value="{{$value->medical_title_5}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="medical_per_5" id="" value="{{$value->medical_per_5}}">
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
  <td><input type="text" class="input-group-lg full_input" id="" name="negative_title_1" placeholder="" value="{{$value->negative_title_1}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="negative_per_1" id="" value="{{$value->negative_per_1}}">
  <span class="input-group-addon">%</span></div>
  </td>
  </tr>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="negative_title_2" placeholder="" value="{{$value->negative_title_2}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="negative_per_2" id="" value="{{$value->negative_per_2}}">
  <span class="input-group-addon">%</span></div>
  </td>
  </tr>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="negative_title_3" placeholder="" value="{{$value->negative_title_3}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="negative_per_3" id="" value="{{$value->negative_per_3}}">
  <span class="input-group-addon">%</span></div>
  </td>
  </tr>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="negative_title_4" placeholder="" value="{{$value->negative_title_4}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="negative_per_4" id="" value="{{$value->negative_per_4}}">
  <span class="input-group-addon">%</span></div>
  </td>
  </tr>
  <tr>
  <td><input type="text" class="input-group-lg full_input" id="" name="negative_title_5" placeholder="" value="{{$value->negative_title_5}}">
  <span id="pro_title_error" style="color: red; display: none;"></span></td>
  <td><div class="input-group">
  <input type="text" class="input-group-lg full_input" onkeyup="" maxlength="4" name="negative_per_5" id="" value="{{$value->negative_per_5}}">
  <span class="input-group-addon">%</span></div>
  </td>
  </tr>

  </tbody>
  </table>
  </div>
  <div class="col-sm-4 col-xs-12 hidden-xs">&nbsp;</div>

  </div>

  <div class="mb-20">
  <button type="submit"  class="btn___green">ADD TO MENU</button> &nbsp;
 <button type="button" onClick="removePro({{$value->id}});" class="btn__white__border" style="width: 271px;">REMOVE FROM SELECTION</button> &nbsp;

<!--  <button type="button" onClick="" class="btn__white__border">CANCEL</button> -->
  </div>
  </form>

  </div>
  </div>

     <?php $k++; ?>
  @endforeach
  @else
  <div style="text-align: left;">  I don't have any records!  </div>
@endif

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

   <script>
   function removePro(id){
    document.getElementById("sel_pro_"+id).checked = false;
    document.form1.submit();
   }


   function addPro(id){
    document.getElementById("add_pro_"+id).checked = false;
     var sub_form='add_form_'+id;
         document.add_form_2.submit();
   }


   </script>
  </body>
  </html>