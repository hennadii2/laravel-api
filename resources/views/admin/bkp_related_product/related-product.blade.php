@include('admin.z_header')
</head>

 <?php
  $pro_type='';
  $brand_type='';
  $sort_by='';
  $search_key='';
  if(!empty($_GET['pro_type'])){
  $pro_type=$_GET['pro_type'];
  }
  if(!empty($_GET['brand_type'])){
  $brand_type=$_GET['brand_type'];
  }
  if(!empty($_GET['sort_by'])){
  $sort_by=$_GET['sort_by'];
  }

  if(!empty($_GET['search_key'])){
  $search_key=$_GET['search_key'];
  }

  ?>
  <style>
.wrapper > ul#results li {
  margin-bottom: 1px;
  background: #f9f9f9;
  padding: 20px;
  list-style: none;
}
.ajax-loading{
  text-align: center;
}
</style>
<body>
<!-- Site Wraper -->
<div class="wrapper">
<!-- Header -->
@include('admin.z_top')
<!-- End Header -->

<div class="clearfix"></div>
<section class="main__container">
<div class="row">

 <form class="" role="search" name="form1" id="form1" action="publish-related-product" method="POST">
 <input type="hidden" name="_token" value="{{ csrf_token() }}">
 <input type="hidden" name="action" value="notadd">
<input type="hidden" name="page" id="page" value="" />
<input type="hidden" name="pro_type" id="pro_type" value="<?php echo $pro_type;?>" />
<input type="hidden" name="brand_type" id="brand_type" value="<?php echo $brand_type;?>" />
<input type="hidden" name="search_q" id="search_q" value="<?php echo $search_key;?>" />



<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div style="background-color:#fff;" class="box__shadow">


<div class="table__main__title">


<div class="row mb-0">
<div class="col-lg-2 col-md-3 col-sm-12 hidden-xs">
<div style="font-size:18px; font-weight:bold; color:#222222;">Select Product</div>
</div>

<div class="col-lg-10 col-md-9 col-sm-12">
<div class="row">
<div class="col-xs-12 col-sm-3">

<div class="input-group">
<input type="text" class="form-control" placeholder="Search" name="q" id="search_text">
<div class="input-group-btn">
<button class="btn btn-default" onclick="filterByText();" type="button"><i class="fa fa-fw fa-search"></i></button>
</div>
</div>

</div>

<div class="col-xs-6 col-sm-1">

<!--<div class="checkbox m-0" style="margin-top:1px !important;">
<label class="p-0" style="color:#333 !important; margin-top:0px !important;">
<input type="checkbox" class='chk_all' name="chk_all" value="" id='checkall'>
<span class="cr" style=" border-color:#22aa00 !important;">
<i class="cr-icon fa fa-check" style="color:#333 !important;"></i></span>All</label>
</div>-->


</div>
<div class="col-xs-6 col-sm-3 hidden-xs"> <span><img src="images/icon/sort.png" height="16" width="24" style="float:left; padding-top:7px;" /></span> <span>
<select class="qty"  onChange="filterByType(this.value);">
<option value="">By Category</option>
@if (count($product_type) > 0)
@foreach($product_type as $key => $value)
<option value="{{$value->type_id}}" <?php  if (isset($pro_type) && !empty($pro_type)){
  if ($value->type_id ==$pro_type) {echo 'selected="selected"'; }} ?>>{{$value->type_name}}</option>
@endforeach
@endif
</select>
</span> </div>

<div class="col-xs-6 col-sm-3 hidden-xs"> <span><img src="images/icon/brand.png" height="20" width="20" style="float:left; padding-top:5px; " /></span> <span>
<select class="qty" id="sel_brand" onChange="filterByBrand(this.value);">
<option value="">By Brand</option>
  @if (count($product_brand) > 0)
  @foreach($product_brand as $key => $value)
  <option value="{{$value->brand_id}}" <?php  if (isset($brand_type) && !empty($brand_type)){
  if ($value->brand_id ==$brand_type) {echo 'selected="selected"'; }} ?>>{{$value->name}}</option>
  @endforeach
  @endif
</select>
</span> </div>
 <?php
 if($all_related<4){?>
<div class="col-xs-6 col-sm-2 text-right">
<a href="javascript:void();" onclick="nextAction();" class="btn___green" style="padding:8px 25px !important; position:relative; top:-8px;">Next</a>
</div>
<?php }?>
</div>
</div>
<div class="clearfix"></div>
</div>
</div>



  <div class="container-grid m-b-20">
  <div class="row">
  <div class="col-sm-8"><div class="item_list">
  <ul id="selectd_div">

  <?php
  if(!empty($_GET['selPro'])){
  $myArray = explode(',', $_GET['selPro']);
  for($t=0;$t<count($myArray);$t++){
     $pro = DB::table('products')->where('prod_id','=', $myArray[$t])->first();

    $img='';
    if($pro->pro_image==''){
    $img='/default.png';
    }else{
    $img='/product_images/'.$pro->prod_id.'/'.$pro->pro_image;
    }


     ?>

  <li id="select_pro_{{$pro->prod_id}}"><input type="hidden" value="{{$pro->prod_id}}" name="preSel[]">
  <div class="item-box">
  <div class="shop-item">
  <div class="item-img">
  <div class="border__btm" style="height: 150px !important;"> <img src="{{URL::to('/')}}/{{$img}}" /></div>
  <div class="shop-item-info title_pad">
  <div class="shop-item-name"><a href="#"><?php echo $pro->pro_title;?> </a></div>
  </div>
  </div>
  <div class="item-mask">
  <div class="item-mask-detail">
  <div class="item-mask-detail-ele">
  <button class="details_btn add_bag_btn mini_btn" type="button" onclick="removSelectSingle(<?php echo $pro->prod_id;?>);"><i class="fa fa-fw fa-trash-o mr_0"></i> </button>
  </div>
  </div>
  </div>
  </div>
  </div>
  </li>
   <?php }}?>


  </ul>
          <style>
          .mr_0{ margin-right:0px !important;}
    .title_pad{ padding:20px 0px 0px 0px !important;}
          </style>
          <div class="clearfix"></div>
        </div></div>
        </div>
      </div>
  <?php
 if($all_related>4 || $all_related==4){?>
<div class="alert alert-danger" id="errordiv2">You already selectd four product. </div>
<?php }?>
 <div id="error_div"></div>
<div style=" padding:20px;">
<div><?php echo count($product_data);?> <b>result found.</b>    </div>


<!-- Shop Item -->
<div class="row container-grid" style="">
<div class="item_list">
 <ul id="results"><!-- results appear here --></ul>
    <div class="ajax-loading">
    <p><img src="{{URL::to('/')}}/images/loader.gif">Loading More Products</p>
    <!--<img src="{{URL::to('/')}}/images/loader.gif" />--></div>
<div class="clearfix"></div>
</div>
</div>


<!-- End Shop Item -->


</div>

</div>
</div>
</form>
</div>
</section>
</div>
<!-- Site Wraper End -->

@include('admin.z_footer')
<link href="{{URL::to('/')}}/admin/css/custom__dashboard.css?4" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/admin/css/select-product.css?8" rel="stylesheet" type="text/css" />

 <script src="{{URL::to('/')}}/admin/js/extra/relatedProduct.js?2225"></script>
  <script src="{{URL::to('/')}}/admin/js/extra/jquery-1.11.1.min.js"></script>

<script>
var page = 1;
load_more(page);
$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++;
        load_more(page);
    }
});
function load_more(page){
  var brand= $("#brand_type").val();
  var pro_type= $("#pro_type").val();
  var search_q= $("#search_q").val();
  var ta=0;


  var checkPro = [];
  var delTeamList = document.getElementsByName("preSel[]");
  for(var h=0; h < delTeamList.length; h++){
  checkPro.push(delTeamList[h].value);
  ta++;
  }


  $.ajax(
        {
            url: '?page=' + page+'&brand_type='+brand+'&pro_type='+pro_type+'&search_key='+search_q+'&selPro='+checkPro,
            type: "get",
            datatype: "html",
            beforeSend: function()
            {
                $('.ajax-loading').show();
            }
        })
        .done(function(data)
        {
            if(data.length == 0){
                     //notify user if nothing to load
                $('.ajax-loading').html("No more records!");
                return;
            }
            $('.ajax-loading').hide(); //hide loading animation once data is received
            $("#results").append(data); //append data into #results element
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              alert('No response from server');
        });
 }
</script>

   <script type="text/javascript">
$(document).ready(function () {

	// binding the check all box to click event
    $(".chk_all").click(function () {

		var checkAll = $(".chk_all").prop('checked');
		if (checkAll) {
            $(".checkboxes").prop("checked", true);


            var checkboxes = document.getElementsByName("sel_pro[]");
            var arrayVal = [];
            for (var i= 0; i<checkboxes.length;i++)
            {
            if (checkboxes[i].checked === true)
            {
              document.getElementById('shop_item_'+checkboxes[i].value).classList.add('select_product_active');
            arrayVal.push(checkboxes[i].value);
            }
            }


		} else {

			$(".checkboxes").prop("checked", false);
             var checkboxes = document.getElementsByName("sel_pro[]");
            var arrayVal = [];
            for (var i= 0; i<checkboxes.length;i++)
            {
            if (checkboxes[i].checked === true)
            {
              document.getElementById('shop_item_'+checkboxes[i].value).classList.add('select_product_active');

            }else{
                document.getElementById('shop_item_'+checkboxes[i].value).classList.remove('select_product_active');
            }
            }

		}

    });

    // if all checkbox are selected, check the selectall checkbox and vise versa
    $(".checkboxes").click(function(){

        if($(".checkboxes").length == $(".subscheked:checked").length) {
            $(".chk_all").attr("checked", "checked");
        } else {
            $(".chk_all").removeAttr("checked");
        }

         var checkboxes = document.getElementsByName("sel_pro[]");
            var arrayVal = [];
            for (var i= 0; i<checkboxes.length;i++)
            {
            if (checkboxes[i].checked === true)
            {
              document.getElementById('shop_item_'+checkboxes[i].value).classList.add('select_product_active');
            arrayVal.push(checkboxes[i].value);
            }
            }

    });

});

function nextAction(){
      var checkTeam = [];
      var tb=0;
      var delTeamList = document.getElementsByName("sel_pro[]");
      for(var h=0; h < delTeamList.length; h++){
      if(delTeamList[h].checked) {
      tb++;
      }
      }
      if(tb>0){
      document.form1.submit();
      }else{
        document.getElementById("error_div").innerHTML = '<div class="alert alert-danger" id="errordiv">Please select atlest one record for action. <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >x</span></div>';

      }
  }

  function selectSingle(selId){
  if(document.getElementById("sel_id_"+selId).checked == true){
      var delTeamList = document.getElementsByName("preSel[]");
      var tr=delTeamList.length;
      if(tr<4){
  document.getElementById('shop_item_'+selId).classList.add('select_product_active');
  var title=document.getElementById("pro_title_"+selId).innerText;
  var imgs = document.getElementById("pro_image_"+selId).src;
  $("#selectd_div").append('<li id="select_pro_'+selId+'"><input type="hidden" value="'+selId+'" name="preSel[]"> <div class="item-box"> <div class="shop-item">'
   +'<div class="item-img"> <div class="border__btm" style="height: 150px !important;">'
   +' <img src="'+imgs+'" /></div> <div class="shop-item-info title_pad">'
   + '<div class="shop-item-name"><a href="#">'+title+' </a></div> </div> </div>'
   + '<div class="item-mask"> <div class="item-mask-detail"> <div class="item-mask-detail-ele">'
   + '<button class="details_btn add_bag_btn mini_btn" onclick="removSelectSingle('+selId+');" type="button"><i class="fa fa-fw fa-trash-o mr_0"></i>'
   + '</button> </div> </div> </div> </div> </div> </li>');
   }else{
    document.getElementById('sel_id_'+selId).checked = false;
   alert("You already selectd four product.");
   }

  }else{
  document.getElementById('shop_item_'+selId).classList.remove('select_product_active');
   var elem = document.getElementById("select_pro_"+selId);
    return elem.parentNode.removeChild(elem);
  }

}


function removSelectSingle(selId){

   var elem = document.getElementById("select_pro_"+selId);
   elem.parentNode.removeChild(elem);
   document.getElementById('shop_item_'+selId).classList.remove('select_product_active');
   document.getElementById('sel_id_'+selId).checked = false;

}
</script>

<style>
.border__btm {
    height: 218px !important;
    overflow: hidden;
}
</style>
</body>
</html>