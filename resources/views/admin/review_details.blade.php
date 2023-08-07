@include('admin.z_header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>




<body>
<!-- Site Wraper -->
<div class="wrapper">
<!-- Header -->
@include('admin.z_top')
<!-- End Header -->

<div class="clearfix"></div>
<section class="main__container">

<div class="box__shadow" style="background-color:#fff; margin-bottom:30px; padding-top: 20px;">
<div class="heading_style" style="text-align: center; "> <span class="title" style="font-size:26px !important;">Rating Details</span> </div>
<div style=" padding:10px 30px 30px 5px;">

 <div class="container" style="max-width:1000px; margin:0px;">
<form   role="form" method="POST" action="{{URL::to('/')}}/admin/rating_approve">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="order_id" value="{{$orderid}}">

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
<input type="radio" name="p_{{$value->itemid}}" value="5" <?php if($value->rating_star=="5") echo "checked";?>>
<span class="cr"><i class="cr-icon fa fa-check"></i></span><span class="star-rat"> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> </span> <b>Five Star</b></label>
</div>
</li>
<li>
<div class="radio m-0">
<label class="p-0">
<input type="radio" name="p_{{$value->itemid}}" value="4" <?php if($value->rating_star=="4") echo "checked";?>>
<span class="cr"><i class="cr-icon fa fa-check"></i></span><span class="star-rat"> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star"></i> </span> <b>Four Star</b></label>
</div>
</li>
<li>
<div class="radio m-0">
<label class="p-0">
<input type="radio" name="p_{{$value->itemid}}" value="3" <?php if($value->rating_star=="3") echo "checked";?>>
<span class="cr"><i class="cr-icon fa fa-check"></i></span><span class="star-rat"> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </span> <b>Three Star</b></label>
</div>
</li>
<li>
<div class="radio m-0">
<label class="p-0">
<input type="radio" name="p_{{$value->itemid}}" value="2" <?php if($value->rating_star=="2") echo "checked";?>>
<span class="cr"><i class="cr-icon fa fa-check"></i></span><span class="star-rat"> <i class="fa fa-star select"></i> <i class="fa fa-star select"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </span> <b>Two Star</b></label>
</div>
</li>
<li>
<div class="radio m-0">
<label class="p-0">
<input type="radio" name="p_{{$value->itemid}}" value="1" <?php if($value->rating_star=="1") echo "checked";?>>
<span class="cr"><i class="cr-icon fa fa-check"></i></span><span class="star-rat"> <i class="fa fa-star select"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </span> <b>One Star</b></label>
</div>
</li>
</ul>
<div><b>Comments</b></div>
<textarea class="input-group-lg full_input comments__area" name="comment_{{$value->itemid}}" required placeholder="Write..."><?php echo $value->rating_comment;?></textarea>
</div>
</div>
</div>

@endforeach
@endif

<div class="mb-30">
<button type="submit" class="checkout_btn">Approve</button>
</div>
</form>
</div>

</div>
</div>





</section>
</div>
<!-- Site Wraper End -->

@include('admin.z_footer')
<link href="{{URL::to('/')}}/admin/css/custom__dashboard.css" rel="stylesheet" type="text/css" />
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




</body>
</html>