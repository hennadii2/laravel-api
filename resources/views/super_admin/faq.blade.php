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
<div class="page-breadcrumb mb-30"> <a href="{{URL::to('/')}}/admin/index">Account</a>/<span>Faq</span> </div>
<div class="row page__main__heading" style="margin-top:0px !important;">
<div class="col-sm-12 col-sx-12">
Faq
</div>

</div>
@if (Session::has('faq_success'))
  <div class="alert alert-{{ Session::get('success_btn') }}" id='errordiv'>{{ Session::get('faq_success') }} <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >x</span></div>
  @endif
<div  class="box__shadow"  style="background-color:#fff; padding:40px;">
<div>
       <form role="form" id="form-stander" name="standardType" onsubmit="return validateFaqFrm();" action="faqSave" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="row">
      <div class="col-md-11">
      <?php $i = 1; ?>
      @foreach($faq as $key => $value)
      @if($i==1)
      <div class="{{ $i == 1 ?'input_fields_wrap' : '' }}">
      @endif
      <div class="mb-20">
      <input type="text" class="input-group-lg full_input" value="{{$value->question}}"  name="question_{{$i}}" id="question_{{$i}}" placeholder="Add the Question" >
      <span id="question_error_{{$i}}" style="color: red; display: none;"></span>
      </div>
      <div class="mb-20">
      <input type="text" class="input-group-lg full_input" value="{{$value->answer}}" name="ans_{{$i}}" id="ans_{{$i}}" placeholder="Add the Answer" >
      <span id="ans_error_{{$i}}" style="color: red; display: none;"></span>
      </div>
    @if(count($faq)==$i)
    </div>
    @endif
    <?php $i++; ?>
    @endforeach

      <div class="clearfix"></div>
      <div class="mb-20 text-right">
      <button  class="add_field_button tt_green_text"><i class="fa fa-plus"></i> Add more</button>
      </div>
       <input type="hidden" id="totalInvoice" name="totalInvoice" value="{{count($faq)}}" />

      <div class="mt-20 text-right">

      <button type="submit" class="btn___green">SUBMIT</button>
      </div>
      </div>
      </div>
      </form>
</div>
</div>
</section>
</div>
<!-- Site Wraper End -->

@include('admin.z_footer')
<link href="{{URL::to('/')}}/admin/css/custom__dashboard.css" rel="stylesheet" type="text/css" />
<style>
.ui-corner-bottom{
  padding: 0px !important;

}
.tt_green_text  {
  background: none !important ;
}
<style>
.m-t-0{margin-top:0px !important;}


</style>
   <script src="{{URL::to('/')}}/admin/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/mediaelement-and-player.min.js"></script>
<script src="{{URL::to('/')}}/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/extra/validation_faq.js?2562"></script>
  <script type="text/javascript">

$(document).ready(function() {
    var max_fields      = 15; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
           document.getElementById('totalInvoice').value=x;
              $(wrapper).append('<div class="mb-20" style="clear:both;"><hr style="border-top: 1px solid #59d028;"> <div class="mb-20"><input type="text" class="input-group-lg full_input" placeholder="Add the Question" name="question_'+x+'" id="question_'+x+'"><span id="question_error_'+x+'" style="color: red; display: none;"></span></div><div class="mb-20"><input type="text" class="input-group-lg full_input" placeholder="Add the Answer" name="ans_'+x+'" id="ans_'+x+'"><span id="ans_error_'+x+'" style="color: red; display: none;"></span></div><div class="m-b-20" style="clear:both;"></div><a style="text-align: right;float: right;" href="#" class="remove_field tt_green_text"><i class="fa fa-minus" aria-hidden="true"></i> REMOVE</a></div><div class="clearfix" style="clear:both;margin-bottom: 18px;"></div>'); //add input box

        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove(); x--;
         document.getElementById('totalInvoice').value=x;

    })
});
</script>
</body>
</html>