<?php
@session_start();
//error_reporting(0);
if($_SERVER['HTTP_HOST']=="localhost")
{
$db=new PDO('mysql:host=localhost;dbname=trees_pot;charset=utf8mb4', 'root', '');
define('BASE_URL_SITE', 'http://localhost/myproject/');
}else{
 $db=new PDO('mysql:host=localhost;dbname=topshelfmenu_trees;charset=utf8mb4', 'topshelfmenu_rehab', 'O*v}west)S)}');
 define('BASE_URL_SITE', 'http://topshelfmenu.us/');
}
include "config/page_name_macro.php";
include "config/tables.php";

function changeDateFormatNew($date){
   $date_format='';
      if($date!='1970-01-01' && $date!='0000-00-00' && $date!='N/A' && $date!=''){
      list($m,$d,$y) = preg_split('/\//', $date);
      $date_format=$y.'-'.$m.'-'.$d;
      }else{
      $date_format='';
      }
      
    return $date_format;
    }
function getDateFormat($date){
  $date_format='N/A';
  if($date!='1970-01-01' && $date!='0000-00-00' && $date!='N/A' && $date!=''){
  $date_format=date('m-d-Y', strtotime($date));
  }else{
  $date_format='N/A';
  }
return $date_format;
}

function getTableIdValue($table,$con,$selectField,$db,$sd=""){
  $value='';

  $q = $db->query("SELECT ".$selectField." from ".$table." ".$con."  ");
  $total=$q->rowCount();
  if($total>0){
  return $q->fetch();
  }else{
  return $value;
  }
}
function msgSuccessFail($type,$msg){
if($type == 'fail'){
$preTable = "<div class='message invalid' id='errordiv'>&nbsp;&nbsp;&nbsp;$msg    <span class='close' onclick=hideErrorDiv()>X</span></div>";
}elseif($type == 'success'){
$preTable = "<div class='message valid' id='errordiv'>&nbsp;&nbsp;&nbsp;$msg  <span class='close' onclick=hideErrorDiv()>X</span></div>";
}
return $preTable;
}
function getSingleValue($table,$con,$selectField,$db){
  $value='';
      $q = $db->query("SELECT ".$selectField." from ".$table." ".$con."  ");
      $total=$q->rowCount();
      if($total>0){
      $f = $q->fetch();
      $res_single = $f[$selectField];
      }else{
      return $value;
      }
}

?>