<!-- Preloader -->
<section id="preloader">
<div class="loader" id="loader">
<div class="loader-img"></div>
</div>
</section>
<!-- End Preloader -->

<!-- Search Overlay Menu -->

<div class="search-overlay-menu"> <span class="search-overlay-close"><i class="ion ion-ios-close-empty"></i></span>
<form role="search" id="searchform" action="{{URL::to('/')}}/{{$user_name}}" method="get">
<input value="" name="search_key" type="search" placeholder="Search..." />
<button type="submit"><i class="ion ion-ios-search"></i></button>
</form>
</div>
<!-- End Search Overlay Menu -->

<!-- main left menu -->
<section id="pushmenu-left" class="pushmenu__left pushmenu-left side-menu" >
<div class="side_menu_header"> <a id="menu-left-sidebar-close-icon" class="menu-close"><img src="{{URL::to('/')}}/images/icon/close-icon.png" height="20" width="20" /></a>
<div class="head_title">Your Bag</div>
</div>
<div class="tt__left__menu">
<ul>
<li><a href="#"><img src="{{URL::to('/')}}/images/icon/home.png" height="23" width="23" /> Main Site</a></li>
<li><a href="#"><img src="{{URL::to('/')}}/images/icon/about.png" height="23" width="23" /> About</a></li>
<li><a href="#"><img src="{{URL::to('/')}}/images/icon/faq.png" height="23" width="23" /> FAQ</a></li>
<li><a href="#"><img src="{{URL::to('/')}}/images/icon/contact.png" height="23" width="23" /> Contact</a></li>
<?php
 $se=Session::get('customer_id');
if (!empty($se)){?>
<li><a href="{{URL::to('/')}}/customer/index"><img src="{{URL::to('/')}}/images/icon/home.png" height="23" width="23" /> Dashboard</a></li>
<li><a href="{{URL::to('/')}}/customer/logout"><img src="{{URL::to('/')}}/images/icon/logout.png" height="23" width="23" /> Logout</a></li>
<?php }else{ ?>
<li><a href="{{URL::to('/')}}/customer/login"><img src="{{URL::to('/')}}/images/icon/home.png" height="23" width="23" /> Login</a></li>
<?php }?>
</ul>
</div>
</section>
<!--End main left menu -->

<!--cart right Sidemenu -->
<section id="pushmenu-right" class="pushmenu__right pushmenu-right side-menu " >
<div class="side_menu_header"> <a id="menu-sidebar-close-icon" class="menu-close"><img src="{{URL::to('/')}}/images/icon/close-icon.png" height="20" width="20" /></a>
<div class="head_title">Your Bag</div>
</div>
<div class="scrollbar">
<div class="cart_box_inner mb-60">
<form action="checkout.php">
<div class="coun_text">Shopping Cart ( <b><?php echo Cart::count();?> item</b> )</div>

<div class="row" style="margin-bottom:6px;">
<div class="col-sm-8 col-xs-8"><b>Order</b></div>
<div class="col-sm-4 col-xs-4 text-right"><b>Price</b></div>
</div>
<?php foreach(Cart::content() as $row):
$size_id=($row->options->has('size') ? $row->options->size : '');?>
<div class="row" style="margin-bottom:8px;">
<div class="col-sm-8 col-xs-8">
 <?php echo $row->name; ?> </div>
<div class="col-sm-4 col-xs-4 text-right">$<?php echo number_format($row->total,2); ?> </div>
</div>
<?php
$proid=explode('@@@@@',$row->id);
$get_qty=DB::table('products_qty')->where('pro_id', '=', $proid[0])->get();
?>
<div class="mb-30">
<select class="cart_quantity"  style="width:210px !important;" onChange="updateCard('<?php echo $row->rowId; ?>','<?php echo $proid[0];?>','<?php echo $row->id;?>',this.value);">
<!--<option value="">Choose an Option (gms) </option> -->
<?php
foreach($get_qty as $key => $value):?>
<option   value="<?php echo $value->qty_id;?>" <?php if($value->qty_id==$size_id) echo 'selected="selected"'; ?>><?php echo $value->qty;?></option>
<?php endforeach;?>

</select>

<span><a href="javascript:void();" onclick="removeProCard('<?php echo $row->rowId; ?>');" title="Remove Product"><img src="{{URL::to('/')}}/images/remove-icon.png" /></a></span>

</div>
<?php endforeach;?>
<div class="row">
<div class="col-sm-8 col-xs-8"><b>Total Price</b></div>
<div class="col-sm-4 col-xs-4 text-right"><b>$<?php echo Cart::total(); ?></b></div>
</div>
<hr/>
<?php
if(Cart::count()>0){?>
<div class="text-right mb-15">
<a  href="{{URL::to('/')}}/{{$user_name}}/checkout" class="checkout_btn">Checkout</a>
</div>
<?php }?>
</form>
<?php if(Cart::count()>0){?>
<div class="text-right"><a href="{{URL::to('/')}}/{{$user_name}}" class="theme__color" style=""><img src="{{URL::to('/')}}/images/icon/left-arrow.png" style="margin-top:-2px;"/> <b>Continue Shopping</b></a></div>
@if (count($related_product) > 0 && $related_product!='')
<div class="hide_xss">
<div class="heading_2">Related Products</div>
<div class="item_list" style="margin:0px !important;">
<ul>

<?php $ty=1; ?>
   @foreach($related_product as $key => $relvalue)
    <?php
  $UrlNames = str_replace("/","",str_replace(",",",",str_replace("","_",str_replace("-","_",str_replace("&","",str_replace("*","",str_replace("+","",str_replace("=","",str_replace("%","",str_replace("@","",str_replace("$","",str_replace("#","",str_replace("{","",str_replace("}","",str_replace("(","",str_replace(")","",str_replace(">","",str_replace("<","",str_replace(";","",str_replace("'","",str_replace('"',"",str_replace('`',"",str_replace('!',"",str_replace(':',"",str_replace('~',"",trim($relvalue->pro_title))))))))))))))))))))))))));
  $UrlNames = str_replace("?","",$UrlNames);
  $UrlNames = str_replace("^","",$UrlNames);
  $UrlNames = str_replace("%","",$UrlNames);
  $UrlNames = str_replace(" ","",$UrlNames);
  ?>
   <?php if($ty<5){?>
<li style="width:50% !important;">
<div class="item-box">
<!-- Shop item images -->
<div class="shop-item">
<div class="item-img">
<div class="border__btm">
<?php
if($relvalue->pro_image!=''){?>
<img src="{{URL::to('/')}}/product_images/{{$relvalue->prod_id}}/{{$relvalue->pro_image}}" style="height:140px;">
 <?php } else {?>
 <img src="{{URL::to('/')}}/default.png" style="height:140px;">
  <?php } ?>
</div>
<div class="shop-item-info">
<div class="shop-item-name"><a href="{{URL::to('/')}}/{{$user_name}}/product-details/{{$relvalue->prod_id}}/{{$UrlNames}}">{{$relvalue->pro_title}}</a></div>
<div class="shop-item-cate"><span>{{$relvalue->name}}</span></div>
</div>
<div class="item-rate">Starting at <b>${{number_format($relvalue->pro_price,2)}}</b></div>
</div>
<div class="item-mask">
<div class="item-mask-detail">

<div class="item-mask-detail-ele">
<a href="javascript:void();" onclick="addCart('<?php echo $relvalue->prod_id; ?>');" class="details_btn mini_btn" style="margin-bottom:5px;padding: 8px 26px !important;">Add to Bag</a>
<a href="{{URL::to('/')}}/{{$user_name}}/product-details/{{$relvalue->prod_id}}/{{$UrlNames}}" class="details_btn mini_btn">View Details</a>
</div>
</div>
</div>
</div>
<!-- End Shop item images -->
</div>
</li>
<?php }
$ty++; ?>
@endforeach


</ul>
<div class="clearfix"></div>
</div>
</div>
@endif
<?php }?>
</div>
</div>
</section>

<!--End cart right Sidemenu -->