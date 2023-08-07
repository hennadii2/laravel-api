@include('front.z_header')
</head>

<body>
@include('front.z_right_menu')

<!-- Site Wraper -->
<div class="wrapper">

<!-- Header -->
@include('front.z_top')
<!-- End Header -->

<!-- CONTENT --------------------------------------------------------------------------------->

<!-- Shop Item Detail Section -->
<section class="ptb ptb-sm-80" style="padding-bottom:20px !important;">
<div class="container" style="max-width:1000px; margin:0px auto;">
<form   role="form" method="POST" action="{{URL::to('/')}}/{{$user_name}}/rating_give">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="order_id" value="{{$order_info->orderid}}">
<input type="hidden" name="user_name" value="{{$user_name}}">
@if (count($order_product) > 0)
   @foreach($order_product as $key => $value)
   <input type="hidden" name="item_id[]" value="{{$value->itemid}}">

<div class="row mt-10">
<div class="col-md-12">
<div class="heading_style_left"> <span class="title">{{$value->prod_title}} </span> </div>
<div class="tree-top-content" style="padding-top:20px;">
<div><b>Product Rating</b></div>
<ul>
<li>
<div class="radio m-0">
<label class="p-0">
<input type="radio" name="p_{{$value->itemid}}" value="5" checked="checked">
<span class="cr"><i class="cr-icon fa fa-check"></i></span><span class="star-rat"> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> </span> <b>Five Star</b></label>
</div>
</li>
<li>
<div class="radio m-0">
<label class="p-0">
<input type="radio" name="p_{{$value->itemid}}" value="4">
<span class="cr"><i class="cr-icon fa fa-check"></i></span><span class="star-rat"> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star"></i> </span> <b>Four Star</b></label>
</div>
</li>
<li>
<div class="radio m-0">
<label class="p-0">
<input type="radio" name="p_{{$value->itemid}}" value="3">
<span class="cr"><i class="cr-icon fa fa-check"></i></span><span class="star-rat"> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </span> <b>Three Star</b></label>
</div>
</li>
<li>
<div class="radio m-0">
<label class="p-0">
<input type="radio" name="p_{{$value->itemid}}" value="2">
<span class="cr"><i class="cr-icon fa fa-check"></i></span><span class="star-rat"> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </span> <b>Two Star</b></label>
</div>
</li>
<li>
<div class="radio m-0">
<label class="p-0">
<input type="radio" name="p_{{$value->itemid}}" value="1">
<span class="cr"><i class="cr-icon fa fa-check"></i></span><span class="star-rat"> <i class="fa fa-star select"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </span> <b>One Star</b></label>
</div>
</li>
</ul>
<div><b>Comments</b></div>
<textarea class="input-group-lg full_input comments__area" name="comment_{{$value->itemid}}" required placeholder="Write..."></textarea>
</div>
</div>
</div>

@endforeach
@endif

<div class="mb-30">
<button type="submit" class="checkout_btn">Submit</button>
</div>
</form>
</div>
</section>
<!-- End Shop Item Section -->

<div class="clearfix"></div>
@include('front.z_bottom')
<style>
.comments__area {height:100px; width:100% !important; margin-top:5px; margin-bottom:10px;}
.radio{margin-bottom:5px !important; margin-top:5px !important;}
.radio b{position:relative; top:-3px; left:10px; color: #22aa00; }

.radio label:after {
content: '';
display: table;
clear: both;

}
.radio label{padding-left:0px !important;}
.radio .cr {
position: relative;
display: inline-block;
border: 1px solid #a9a9a9;
border-radius: .25em;
width: 1.3em;
height: 1.3em;
float: left;
margin-right: .5em;
margin-top:1px;
}

.radio .cr {
border-radius: 50%;
}

.radio .cr .cr-icon {
position: absolute;
font-size: .8em;
line-height: 0;
top: 53%;
left: 14%;
}

.radio .cr .cr-icon {
margin-left: 0.04em;
}

.radio label input[type="radio"] {
display: none;
}

.radio label input[type="radio"] + .cr > .cr-icon {
transform: scale(3) rotateZ(-20deg);
opacity: 0;
transition: all .3s ease-in;
}

.radio label input[type="radio"]:checked + .cr > .cr-icon {
transform: scale(1) rotateZ(0deg);
opacity: 1;
}

.radio label input[type="radio"]:disabled + .cr {
opacity: .5;
}

.radio label {
display:-webkit-inline-box;
}
.tree-top-content ul {margin:0px; padding:0px; list-style:none;}
.tree-top-content ul li{margin:0px; padding:0px; list-style:none; list-style-type:none;}
.star-rat i { font-size: 20px; color: #dddddd;}
.star-rat i.select { color: #ddb529;}
</style>
</div>
<!-- Site Wraper End -->

@include('front.z_footer')
</body>
</html>