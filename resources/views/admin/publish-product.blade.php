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
        @if (Session::has('success'))
  <div class="alert alert-success" id='errordiv'>{{ Session::get('success') }}
  <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >x</span></div>
  @endif
  <div style=" padding:20px;">
  <section style="padding-bottom:40px;">
  <div class="container">
  <div class="row">
  <div class="col-md-12">

  <div class="tree-top-content">
  <div class="accordion">
  <form class="" role="search" name="form1" id="form1" action="publish-product" method="POST">
 <input type="hidden" name="_token" value="{{ csrf_token() }}">
 @if ($sel_product!='')
  @foreach($sel_product as $key => $value)
   <input type="checkbox" id="sel_pro_{{$value->id}}" name="sel_pro[]" value="{{$value->id}}" checked="checked" style="display:none;">
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

  <form name="add_form_{{$value->id}}" id="add_form_{{$value->id}}" action="publish-product" method="POST">

   <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <input type="hidden" name="action" value="add">
   <input type="hidden"   name="pro_title"  value="{{$value->pro_title}}">
   <input type="hidden"   name="pro_id"  value="{{$value->id}}">
   <input type="hidden"   name="selected_id"  value="{{$pro_id}}">


  <div class="heading_style_left mb-10"> <span class="title">Product Information</span> </div>
  <div class="row">
  <div class="col-sm-8 col-xs-12">
  <table class="table mb-0">
  <tbody>


  <input type="hidden"  name="pro_type" placeholder="" value="{{$value->type_name}}">


  <?php
  if($value->sub_cat!=''){
  $sub_cat = DB::table('admin_type')->where('type_id', '=', $value->sub_cat)->first();?>

  <input type="hidden"  id="" name="sub_cat" placeholder="" value="{{$sub_cat->type_name}}">

  <?php }?>

  <input type="hidden" class="input-group-lg full_input" id="" name="brand" placeholder="" value="{{$value->name}}">


  <tr>
  <td>
  <label>Short Description</label>
  <input type="text" class="input-group-lg full_input" id="" name="short_desc" placeholder="" value="{{$value->short_description}}">

  </td>
  </tr>

  <tr>
  <td>
  <label>Long Description</label>
  <textarea class="input-group-lg full_input" style="height:100px;" id="pro_desc" name="pro_desc">{{$value->long_description}}</textarea>

  </td>
  </tr>
  </tbody>
  </table>
  </div>
   <div class="col-sm-4 col-xs-12">
   <div class="thumb_preview">
   <?php if($value->image!=''){?>
  <input type="hidden" name="image_path" value="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image}}">
  <img src="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image}}" class="img-responsive" />
  <?php }else{?>

       <img src="{{URL::to('/')}}/default.png" class="img-responsive" />
  <?php }?> </div>
    <?php if($value->image_2!=''){?>
  <div class="thumb_preview">
  <input type="hidden" name="image_path_2" value="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_2}}">
  <img src="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_2}}" class="img-responsive" />  </div>
   <?php }?>


   <?php if($value->image_3!=''){?>
  <div class="thumb_preview">
  <input type="hidden" name="image_path_3" value="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_3}}">
  <img src="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_3}}" class="img-responsive" />  </div>
   <?php }?>

    <?php if($value->image_4!=''){?>
  <div class="thumb_preview">
  <input type="hidden" name="image_path_4" value="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_4}}">
  <img src="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_4}}" class="img-responsive" />  </div>
   <?php }?>

    <?php if($value->image_5!=''){?>
  <div class="thumb_preview">
  <input type="hidden" name="image_path_5" value="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_5}}">
  <img src="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_5}}" class="img-responsive" />  </div>
   <?php }?>

    <?php if($value->image_6!=''){?>
  <div class="thumb_preview">
  <input type="hidden" name="image_path_6" value="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_6}}">
  <img src="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_6}}" class="img-responsive" />  </div>
   <?php }?>

    <?php if($value->image_7!=''){?>
  <div class="thumb_preview">
  <input type="hidden" name="image_path_7" value="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_7}}">
  <img src="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_7}}" class="img-responsive" />  </div>
   <?php }?>

    <?php if($value->image_8!=''){?>
  <div class="thumb_preview">
  <input type="hidden" name="image_path_8" value="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_8}}">
  <img src="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_8}}" class="img-responsive" />  </div>
   <?php }?>

    <?php if($value->image_9!=''){?>
  <div class="thumb_preview">
  <input type="hidden" name="image_path_9" value="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_9}}">
  <img src="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_9}}" class="img-responsive" />  </div>
   <?php }?>

    <?php if($value->image_10!=''){?>
  <div class="thumb_preview">
  <input type="hidden" name="image_path_10" value="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_10}}">
  <img src="{{URL::to('/')}}/admin_product_image/{{$value->id}}/{{$value->image_10}}" class="img-responsive" />  </div>
   <?php }?>

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