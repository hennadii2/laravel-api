
//for pagination
    function changePagination(pageNo){
    document.getElementById("page").value=pageNo;
    filterJobDetails();
    }

    function viewReport(){
        document.getElementById('download_csv').value=0;
        filterReport();
    }
    function doenloadCSV(){
        document.getElementById('download_csv').value=1;
        filterReport();
    }

    function filterReport(){
    var search='';
    var giveQ='?';
    var prepa=$("#prepage").val();
    var page=$("#page").val();
    var remove='&page=';
    var pro_type=$("#pro_type").val();
    var pro_brand=$("#pro_brand").val();
    var start_date=$("#start_date").val();
    var end_date=$("#end_date").val();
    var download_csv=$("#download_csv").val();
    var user_path='report';

    if(typeof prepa!="undefined" && prepa!=""){
    search=search+prepa;
    }
    if(typeof page!="undefined" && page!=''){
    search=search+"&";
    search=search+"page="+page+"";
    }
    if(typeof pro_type!="undefined" && pro_type!=''){
    search=search+"&";
    search=search+"pro_type="+pro_type+"";
    }

    if(typeof pro_brand!="undefined" && pro_brand!=''){
    search=search+"&";
    search=search+"pro_brand="+pro_brand+"";
    }
    if(typeof start_date!="undefined" && start_date!=''){
    search=search+"&";
    search=search+"start_date="+start_date+"";
    }

     if(typeof end_date!="undefined" && end_date!=''){
    search=search+"&";
    search=search+"end_date="+end_date+"";
    }

      if(typeof download_csv!="undefined" && download_csv!=''){
    search=search+"&";
    search=search+"download_csv="+download_csv+"";
    }
 // alert(search);
    if(search!=''){
    var resultval=giveQ+""+search;
    resultval = resultval.replace("?&",'?');
    resultval=removeLastPlus(resultval);
    }else{
    resultval='';
    }
    var baseUrlPath=getbaseUrlPath();
    window.location.href=baseUrlPath+user_path+resultval;
    }
  function replaceAll(find, replace, str) {
  return str.replace(new RegExp(find, 'g'), replace);
  }
  function removeLastPlus(str) {
  if (str.slice(-1) == '&') {
  return str.slice(0, -1);
  }
  return str;
  }