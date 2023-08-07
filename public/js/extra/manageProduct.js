
//for pagination
    function changePagination(pageNo){
    document.getElementById("page").value=pageNo;
    filterJobDetails();
    }


    function filterByType(TypeId){
        document.getElementById('pro_type').value=TypeId;
        filterProDetails();
    }

    function filterByTypeAll(){
        document.getElementById('pro_type').value='';
        filterProDetails();
    }
    function filterByBrand(barndId){
        document.getElementById('brand_type').value=barndId;
        filterProDetails();
    }
    function filterBySort(sortBy){
        document.getElementById('sort_by').value=sortBy;
        filterProDetails();
    }

    function filterProDetails(){
    var search='';
    var giveQ='?';
    var prepa=$("#prepage").val();
    var page=$("#page").val();
    var remove='&page=';
    var pro_type=$("#pro_type").val();
    var user_name=$("#user_name").val();
    var brand_type=$("#brand_type").val();
    var sort_by=$("#sort_by").val();

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

    if(typeof brand_type!="undefined" && brand_type!=''){
    search=search+"&";
    search=search+"brand_type="+brand_type+"";
    }
    if(typeof sort_by!="undefined" && sort_by!=''){
    search=search+"&";
    search=search+"sort_by="+sort_by+"";
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
    window.location.href=baseUrlPath+user_name+resultval;
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