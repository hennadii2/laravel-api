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

@if (Session::has('faq_success'))
  <div class="alert alert-{{ Session::get('success_btn') }}" id='errordiv'>{{ Session::get('faq_success') }} <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >x</span></div>
  @endif
<div  class="box__shadow"  style="background-color:#fff; padding:30px;">
<div class="row">
<div class="col-md-4 col-sm-5 col-xs-12">
<div class="left__content">
<div class="tt_green_text">Add your Faq</div>
<div class="tt_description_title" style="font-size:29px;">Frequently asked questions</div>
<p class="tt___content" style="font-size: 16px; line-height: 24px;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In viverra sed ex a scelerisque. Curabitur sit amet purus fringilla, consectetur libero id, imperdiet turpis. Duis pellentesque enim sit amet arcu feugiat efficitur. Curabitur suscipit nulla tincidunt, efficitur erat quis, iaculis eros. Nam eu ex lacinia, rutrum elit et, dignissim justo. Nullam dapibus maximus nisi, quis congue quam venenatis et. </p>
</div>
</div>
<div class="col-md-8 col-sm-7 col-xs-12">
<div class="form__right__box">
       <form role="form" id="form-stander" name="standardType" onSubmit="return validateFaqFrm();" action="faqSave" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="row">
      <div class="col-md-12">
      <?php $i = 1; ?>
      @foreach($faq as $key => $value)
      @if($i==1)
      <div class="{{ $i == 1 ?'input_fields_wrap' : '' }}">
      @endif
      <div class="mb-20">
      <label>Add the Question <span class="text-danger">*</span> </label>
      <input type="text" class="input-group-lg full_input" value="{{$value->question}}"  name="question_{{$i}}" id="question_{{$i}}" placeholder="Add the Question" >
      <span id="question_error_{{$i}}" style="color: red; display: none;"></span>
      </div>
      <div class="mb-20">
       <label>Add the Answer <span class="text-danger">*</span></label>
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
              $(wrapper).append('<div class="mb-20" style="clear:both;"><hr style="border-top: 1px solid #59d028;"> <div class="mb-20"><label>Add the Question <span class="text-danger">*</span></label><input type="text" class="input-group-lg full_input" placeholder="Add the Question" name="question_'+x+'" id="question_'+x+'"><span id="question_error_'+x+'" style="color: red; display: none;"></span></div><div class="mb-20"><label>Add the Answer <span class="text-danger">*</span></label><input type="text" class="input-group-lg full_input" placeholder="Add the Answer" name="ans_'+x+'" id="ans_'+x+'"><span id="ans_error_'+x+'" style="color: red; display: none;"></span></div><div class="m-b-20" style="clear:both;"></div><a style="text-align: right;float: right;" href="#" class="remove_field tt_green_text"><i class="fa fa-minus" aria-hidden="true"></i> REMOVE</a></div><div class="clearfix" style="clear:both;margin-bottom: 18px;"></div>'); //add input box

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