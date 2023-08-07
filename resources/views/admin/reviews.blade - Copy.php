  @include('admin.z_header')
  <?php
  $pro_type='';
  $brand_type='';

  if(!empty($_GET['pro_type'])){
  $pro_type=$_GET['pro_type'];
  }
  if(!empty($_GET['pro_brand'])){
  $brand_type=$_GET['pro_brand'];
  }
  ?>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#start_date" ).datepicker();
    $( "#end_date" ).datepicker();

  } );
  </script>

  </head>

  <body>
  <!-- Site Wraper -->
  <div class="wrapper">
  <!-- Header -->
  @include('admin.z_top')
  <!-- End Header -->

  <div class="clearfix"></div>
  <section class="main__container">
  @if (Session::has('success_send'))
  <div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert"></button>Mail has been send successfully.</div>
  @endif

  <div class="row page__main__heading" style=" padding:10px;">
  <div class="col-sm-12 col-sx-12">
  Reviews Listing
  </div>

  </div>
  <div  class="box__shadow"  style="background-color:#fff; padding:40px;">
  <div class="row">

  <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
  <div>
  <form role="form" id="search" name="search" action="report" method="post"  >
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="row">
  <div class="col-xs-9 col-sm-6 p_lr_5"> <div class="btn-group m-b-10">
  <h5>Filter By <span class="semi-bold">Date Range</span></h5>
  <div class="input-daterange input-group" id="datepicker-range">
  <input type="text" class="form-control" name="start"    id="start_date" />
  <span class="input-group-addon">to</span>
  <input type="text" class="form-control" name="end" id="end_date"  />

  </div>

  </div>
  </div>
      <input type="hidden" name="page" id="page" value="" />
      <input type="hidden" name="download_csv" id="download_csv" value="0" />
    <div class="col-xs-3 col-sm-12 p_lr_5 text-right">
    <h5 class="visible-xs">&nbsp;</h5>
        <button type="button"  onClick="viewReport();" class="btn btn-success btn-cons">VIEW</button>


    </div>

  </div>



  </form>

<style>
.p_lr_5{ padding-left:5px !important; padding-right:5px !important; margin-bottom:5px !important;}
</style>
  </div>
  <div>
  <table class="table mb-0">
  <tbody>
  <tr>
  <th class="th__head">Date</th>
  <th class="th__head">Total Revenue</th>
  <th class="th__head">Average Order size</th>
  <th class="th__head">Total Customers</th>
  </tr>







  </tbody>
  </table>

  </div>
  </div>
  <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
  <div class="chart-wrapper">
<div class="pt-sd pr-md pb-md pl-md">

      </div>
      </div>
      </div>
 <!-- <img src="{{URL::to('/')}}/admin/images/report/b4.png" style="margin-top:30px;" />-->
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
  }
  </style>

  <script src="{{URL::to('/')}}/admin/js/extra/manageReport.js?2"></script>

  </body>
  </html>