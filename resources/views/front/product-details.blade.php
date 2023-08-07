@include('front.z_header')

<link href="{{URL::to('/')}}/css/colorbox.css" rel="stylesheet" />
<link href="{{URL::to('/')}}/css/jquery-ui.css?5" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/css/smooth-products.css" rel="stylesheet" />

<!-- zoom effect css-->
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/zoom/css/jquery.simpleLens.css">
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/zoom/css/jquery.simpleGallery.css">
<!-- zoom effect css-->
</head>

<body>
@include('front.z_right_menu')

<!-- Site Wraper -->
<div class="wrapper">

<!-- Header -->
@include('front.z_top')
<!-- End Header -->

<!-- CONTENT --------------------------------------------------------------------------------->
<!-- Intro Section -->
<section class="main_banner text-left border__bottom">
<div class="container">
<div class="row">
<div class="page-breadcrumb"> <a href="{{URL::to('/')}}/{{$user_name}}">Home</a>/<span>{{$product_data->pro_title}}</span> </div>
</div>
</div>
<div class="clearfix"></div>
</section>

<!-- End Intro Section -->

<!-- Shop Item Detail Section -->
<section id="shop-item" class="ptb ptb-sm-80" style="padding-bottom:20px !important;">
<div class="container">
<div class="row">
<!-- Shop Item -->
<div class="col-md-6 mb-sm-60">

<article>
<div class="simpleLens-gallery-container" id="demo-1">
<div class="simpleLens-container" style="width: 100%;">
<div class="simpleLens-big-image-container">
<?php
if($product_data->pro_image!=''){?>
<a class="simpleLens-lens-image" data-lens-image="{{URL::to('/')}}/product_images/{{$product_data->prod_id}}/{{$product_data->pro_image}}">
<img src="{{URL::to('/')}}/product_images/{{$product_data->prod_id}}/{{$product_data->pro_image}}" class="simpleLens-big-image">
</a>
<?php }else{?>
  <a class="simpleLens-lens-image" >
<img src="{{URL::to('/')}}/default.png" class="simpleLens-big-image">
</a>
<?php } ?>
</div>
</div>

<div class="simpleLens-thumbnails-container">
@if (count($product_image) > 0)
@foreach($product_image as $key => $value)
<a href="#" class="simpleLens-thumbnail-wrapper"
data-lens-image="{{URL::to('/')}}/product_images/{{$value->pro_id}}/{{$value->image}}"
data-big-image="{{URL::to('/')}}/product_images/{{$value->pro_id}}/{{$value->image}}">
<img src="{{URL::to('/')}}/product_images/{{$value->pro_id}}/{{$value->image}}">
</a>

@endforeach
@endif

</div>
</div>
</article>


</div>
<!-- End Shop Item -->

<!-- Shop info -->
<div class="col-md-6">
<div class="shop-detail-info" style="background-image:none !important;">
<h4>{{$product_data->pro_title}}</h4>
<div class="cate__name">{{$product_data->name}}</div>
<div class="shop-item-price"><span>Starting at</span>$<span id="price_new_price" style="font-size: 16px; color:#22aa00; !important;">{{number_format($product_data->pro_price,2)}}</span></div>
<hr />
<p>{{$product_data->short_desc}}</p>
<div> <a href="#popup_how_it_work" class="green_text">How it Works?</a><?php //echo $member_how_it_work;?> </div>
<form id="form-login"  role="form" method="POST" action="addCardItem">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="pro_id" id="pro_id" value="{{$product_data->prod_id}}" />
<input type="hidden" name="user_name" id="user_name" value="{{$user_name}}" />
<input type="hidden" name="pro_price" id="pro_price" value="{{number_format($product_data->pro_price,2)}}" />
<div class="mtb-30"> <span class="bold__text" >Choose an Option (gms)</span> <span>
<select class="cart_quantity" id="pro_qty" name="pro_qty">
<!--<option value="">Choose an Option (gms) </option> -->
@if (count($product_qty) > 0)
@foreach($product_qty as $key => $value)
<option value="{{$value->qty_id}}">{{$value->qty}}</option>
@endforeach
@endif

</select>
</span> </div>
<div class="mt-45">
<button type="submit" class="checkout_btn" style="padding-top:15px; padding-bottom:15px;"> Add to Bag</button>
</div>
</form>

<div class="share__media__box"> <span class="bold__text" style="float:left; margin-top:3px;">Share to Social Media</span>
<div class="social_icon_footer"><div class="sharethis-inline-share-buttons"></div>
</div>
<div class="clearfix"></div>
</div>
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5a5365f001c7d200133483c5&product=inline-share-buttons"></script><div id="cover__text">{{$bussiness_name}}</div>
</div>
</div>
<!-- End Shop info -->
<div class="clearfix"></div>
</div>
 @if ($product_data->pro_desc!='')
<div class="row mt-60">
<div class="col-md-12">
<div class="heading_style"> <span class="title">Description</span> </div>
<div class="tree-top-content">
<p>{{$product_data->pro_desc}}</p>
</div>
</div>
</div>
@endif 
</div>
</section>
<!-- End Shop Item Section -->
@if (count($effects) > 0 )
<section style="background-color:#f4f4f4; padding-top:60px; padding-bottom:40px;">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="heading_style"> <span class="title bg_f4f4f4">Strain Attributes</span> </div>
<div class="tree-top-content">
<div class="tabs">
<ul style="text-align: center; max-width: 300px; margin: 0px auto;">
@if (count($effects) > 0)
<li><a href="#tabs-2">Effects</a></li>
@endif

</ul>
<div class="ui-tab-content">
<div id="tabs-2">
<ul id="skill">
@if (count($effects) > 0)
@foreach($effects as $key => $effects_value)
<li><span class="expand skills__bar" style="width:{{$effects_value->percentage}}%;">{{$effects_value->name}}</span></li>
@endforeach
@endif
</ul>
</div>


</div>
</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>

<style type="text/css">

#skill {
list-style:none;
padding:0px;

}
#skill li {
margin-bottom:10px;
background:#dbdbdb;
color:#fff;
height:40px;
border-radius:0px 25px 25px 0px;
overflow:hidden;

}



.expand {
height:40px;
padding:10px 20px;
line-height:20px;
margin:0;
background:#22aa00;
position:absolute;
border-radius:0px 25px 25px 0px;
overflow:hidden;
}
.ui-tabs .ui-tabs-nav li.ui-tabs-active {background-color:transparent !important;}
.skills__bar {  -moz-animation:html5 2s ease-out;       -webkit-animation:skills__bar 2s ease-out;       }

@-moz-keyframes skills__bar       { 0%  { width:0px;}   }

@-webkit-keyframes skills__bar       { 0%  { width:0px;}   }

</style>
</section>
@endif
<section style="padding-top:60px; padding-bottom:40px;">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="heading_style"> <span class="title ">Faq's</span> </div>
<div class="tree-top-content">
<div class="accordion">
@if (count($product_faq) > 0)
@foreach($product_faq as $key => $value)
<div class="accordion-section">
<h3 class="accordion-title">{{$value->question}}</h3>
<div class="accordion-content">
<p>{{$value->answer}}</p>
</div>
</div>
@endforeach
@endif
</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>
</section>

<section style="background-color:#f4f4f4; padding-top:60px; padding-bottom:40px;">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="heading_style"> <span class="title bg_f4f4f4">Reviews</span> </div>
<div class="tree-top-content">
<div class="reviews__listing">
@if (count($rating_data) > 0)
<ul>

@foreach($rating_data as $key => $value)
<?php
$get_order=DB::table('orders')->where('orderid', '=', $value->order_id)->first();
$get_cus=DB::table('customer')->where('cus_id', '=', $get_order->user_id)->first();

?>
<li>
<div>
<div class="row">
<div class="col-sm-8">
<div class="comment-avatar">
<?php
if($get_cus->image!=''){?>
<img src="{{URL::to('/')}}/member_img/<?php echo $get_cus->image;?>" class="img-circle" />
<?php }else{?>
<img src="{{URL::to('/')}}/admin/images/pro-avatar.png" class="img-circle" />
<?php }?>
</div>
<div class="author__box"> <span class="name"><?php echo ucfirst($get_cus->fname);?> <?php echo ucfirst($get_cus->lname);?></span>
<?php if($value->rating_star==5){?>
<span class="star-rat">
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star select"></i></a>
</span>
<?php }?>

<?php if($value->rating_star==4){?>
<span class="star-rat">
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star "></i></a>
</span>
<?php }?>


<?php if($value->rating_star==3){?>
<span class="star-rat">
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star "></i></a>
<a><i class="fa fa-star "></i></a>
</span>
<?php }?>

<?php if($value->rating_star==2){?>
<span class="star-rat">
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star "></i></a>
<a><i class="fa fa-star "></i></a>
<a><i class="fa fa-star "></i></a>
</span>
<?php }?>

<?php if($value->rating_star==1){?>
<span class="star-rat">
<a><i class="fa fa-star select"></i></a>
<a><i class="fa fa-star "></i></a>
<a><i class="fa fa-star "></i></a>
<a><i class="fa fa-star "></i></a>
<a><i class="fa fa-star "></i></a>
</span>
<?php }?>
</div>
</div>
<div class="col-sm-4">
<div class="comments__date"><?php echo date('M d, Y', strtotime($value->rating_date));?></div>
</div>
</div>
<p><?php echo nl2br($value->rating_comment);?> </p>
<div class="row" style="display:none;">
<div class="col-xs-9"> <a href="#" class="green_text" style="margin-right:50px;">Respond</a> <a href="#" class="green_text">Share</a> </div>
<div class="col-xs-3">
<div class="comment_counter"><i class="fa fa-comment-o"></i><span>2</span></div>
</div>
</div>
</div>
</li>
@endforeach
</ul>

@else
<p>
No one has rated this product yet.
</p>
@endif
</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>
</section>

<!-- how it work popup -->
<div id="popup_how_it_work" class="overlay_how_it_work">
<div class="popup_how_it_work">
<h4>How it Works?</h4> <a class="close" href="#">×</a>


<p> <?php echo $how_it_work;?></p>



</div>
</div>
<style>

.overlay_how_it_work {
position: fixed;
top: 0;
bottom: 0;
left: 0;
right: 0;
background: rgba(0, 0, 0, 0.7);
transition: opacity 500ms;
visibility: hidden;
opacity: 0;
z-index:1100;
}
.overlay_how_it_work:target {
visibility: visible;
opacity: 1;
}

.popup_how_it_work {
margin: 50px auto;
padding: 20px;
background: #fff;
border-radius: 5px;
width: 35%;
position: relative;
transition: all 5s ease-in-out;
}

.popup_how_it_work h4 {
margin-top: 7px;
color: #333;
font-weight:600;
border-bottom:1px solid #eeeeee;
padding-bottom:12px;

}
.popup_how_it_work .close {
position: absolute;
top: 18px;
right: 30px;
transition: all 200ms;
font-size: 30px;
font-weight: bold;
text-decoration: none;
color: #333;
}
.popup_how_it_work .close:hover {
color: #22aa00;
}
.popup_how_it_work .content {
max-height: 30%;
overflow: auto;
}

#cover__text{font-size:80px; line-height:80px; font-weight:bolder; font-family: 'proxima_nova_rgbold'; letter-spacing:5px; position:absolute; top:80px; z-index:-1; color:#f4f4f4;}
@media screen and (max-width: 700px){
.popup_how_it_work{
width: 70%;
}
#cover__text{font-size:50px; line-height:55px; letter-spacing:2px; top:95px;}
}

</style>
<!-- how it work popup -->

<div class="clearfix"></div>
@include('front.z_bottom')
</div>



<!-- Site Wraper End -->

@include('front.z_footer')
<script src="{{URL::to('/')}}/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/js/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/js/mediaelement-and-player.min.js"></script>
<script src="{{URL::to('/')}}/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#pro_qty").change(function(){
$search = $(this).val();
var user_name=$('#user_name').val();
var pro_price=$('#pro_price').val();
jQuery('#price_new_price').html("<img src='{{ URL::to('/') }}/images/loader.gif'/>");
if($search!=''){

$.ajax({
type: 'get',
url: '{{ URL::to('/') }}/'+user_name+'/search',
data: {'search': $search},
success: function(data){
$('#price_new_price').html(data);
}
});

}else{
$('#price_new_price').html(pro_price);
}
});
});

</script>  <!-- zoom effect-->
<script type="text/javascript" src="{{URL::to('/')}}/zoom/src/jquery.simpleGallery.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/zoom/src/jquery.simpleLens.js"></script>

<script>
$(document).ready(function(){
$('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({

});

$('#demo-1 .simpleLens-big-image').simpleLens({

});
});
// loadItem();

</script>
<!-- zoom effect-->
</body>
</html>