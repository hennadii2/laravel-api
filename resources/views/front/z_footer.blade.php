  <!-- JS -->
  <script>
  function updateCard(rowId,proid,mainId,selId){
  $.ajax({
  type: 'get',
  url: '{{ URL::to('/') }}/ashok1/updateCard',
  data: {'rowId': rowId,'proid':proid,'mainId':mainId,'selId':selId},
  success: function(data) {
  location.reload();
  }
  });
  }


  function addCart(proid){
  $.ajax({
  type: 'get',
  url: '{{ URL::to('/') }}/ashok1/addCard',
  data: {'pro_id':proid},
  success: function(data) {
  location.reload();
  }
  });
  }
  function removeProCard(rowId){
  $.ajax({
  type: 'get',
  url: '{{ URL::to('/') }}/ashok1/removeProCard',
  data: {'rowId': rowId},
  success: function(data) {
  location.reload();
  }
  });
  }
  </script>
  <script src="{{URL::to('/')}}/js/jquery-1.11.2.min.js" type="text/javascript"></script>
  <script src="{{URL::to('/')}}/js/jquery-ui.min.js" type="text/javascript"></script>
  <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
  <script src="{{URL::to('/')}}/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="{{URL::to('/')}}/js/jquery.fitvids.js" type="text/javascript"></script>
  <script src="{{URL::to('/')}}/js/jquery.viewportchecker.js" type="text/javascript"></script>
  <script src="{{URL::to('/')}}/js/sidebar-menu.js" type="text/javascript"></script>
  <script src="{{URL::to('/')}}/js/theme.js" type="text/javascript"></script>
  <script src="{{URL::to('/')}}/js/jquery.colorbox-min.js" type="text/javascript"></script>
  <script src="{{URL::to('/')}}/js/smooth-products.js"></script>
  <script src="{{URL::to('/')}}/js/extra/manageProduct.js?22"></script>
  <script src="{{URL::to('/')}}/js/extra/common.js?222"></script>
  <script type="text/javascript">
  $(window).load(function () {
  $('.sp-wrap').smoothproducts();
  });    </script>
  <script src="{{URL::to('/')}}/js/jquery.stellar.min.js" type="text/javascript"></script>
  <style>
  .add_bag_btn{margin-bottom:5px !important; border-radius:0px !important; padding-left:36px; padding-right:36px;}
  </style>
 <?php
    $users_date = DB::table('users')->where('username', '=', $user_name)->first();
    if(count($users_date)>0){
    $page_contain = DB::table('static_contain')->where('user_id', '=', $users_date->id)->first();
    echo $page_contain->google_analytics;
    echo $page_contain->facebook_pixel;
    }

    ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114997354-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-114997354-1');
</script>

