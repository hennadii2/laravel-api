
//for pagination
function changePagination(pageNo){
document.getElementById("page").value=pageNo;
filterJobDetails();
}
function filterReview(){
var search='';
var giveQ='?';
var prepa=$("#prepage").val();
var page=$("#page").val();
var remove='&page=';
var filter=$("#filter").val();

if(typeof prepa!="undefined" && prepa!=""){
search=search+prepa;
}
if(typeof page!="undefined" && page!=''){
search=search+"&";
search=search+"page="+page+"";
}


if(typeof filter!="undefined" && filter!=''){
search=search+"&";
search=search+"status="+filter+"";
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
// window.location.href=baseUrlPath+'vendors.php'+resultval;
window.location.href=baseUrlPath +'reviews'+resultval;
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