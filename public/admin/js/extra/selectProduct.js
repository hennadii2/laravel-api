

/*function CheckedAll(){
if (document.getElementById('ChkAll').checked) {
for(i=0; i<document.getElementsByTagName('input').length;i++){
document.getElementsByTagName('input')[i].checked = true;
}
}
else {
for(i=0; i<document.getElementsByTagName('input').length;i++){
document.getElementsByTagName('input')[i].checked = false;
}
}
}*/
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


function filterByText(){
document.getElementById('sort_by').value=sortBy;
filterProDetails();
}

function filterByText(){
var serch_q=jQuery('#search_text').val();
if(serch_q.trim()==""){
document.getElementById('search_text').style.borderColor='#e52213';
return false;
}else{
document.getElementById("search_q").value=serch_q;
filterProDetails();
}

}

function filterProDetails(){
var search='';
var giveQ='?';
var prepa=$("#prepage").val();
var page=$("#page").val();
var remove='&page=';
var pro_type=$("#pro_type").val();
var brand_type=$("#brand_type").val();
var search_q=$("#search_q").val();
var k=0;
var checkboxes = document.getElementsByName("preSel[]");
var selPro = [];
for (var i= 0; i<checkboxes.length;i++)
{

selPro.push(checkboxes[i].value);
k++;

}


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

if(typeof search_q!="undefined" && search_q!=''){
search=search+"&";
search=search+"search_key="+search_q+"";
}



if(k > 0){
if(typeof selPro!="undefined" && selPro!=''){
search=search+"&";
search=search+"selPro="+selPro+"";
}
}

if(document.getElementById("checkall").checked == true){
var checkType='all';
}else{
var checkType='none';
}

if(typeof search_q!="checkType" && checkType!=''){
search=search+"&";
search=search+"checkType="+checkType+"";
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
window.location.href=baseUrlPath +'select-product'+resultval;
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