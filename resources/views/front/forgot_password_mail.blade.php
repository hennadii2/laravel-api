
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Trees Pot Shop</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="nileforest">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />



<!-- CSS -->
<link href="http://topshelfmenu.us/public/css/style.css?4" rel="stylesheet" type="text/css" />
<link href="http://topshelfmenu.us/public/css/bootstrap.css?2" rel="stylesheet" type="text/css" />
</head>

<body>
<div style="max-width:600px; margin:0px auto; background-color:#fff;">
<div style="width:140px;  margin:0px auto !important; border-radius: 50%;"><div style="width:130px; height:120px; background-color:#22242d; display:table-cell; vertical-align:middle; text-align:center; overflow:hidden; border-radius:50%; padding:10px;">
<img src="http://topshelfmenu.us/public/images/logo.png" style="max-width:100%;" alt="" /></div></div>
<h2 style="font-weight:600; color:#22aa00; text-align:center; padding-top:0px;">Forgot Password</h2>

<b>Hi {{$user_info->fname}},</b>
<p> Create new password  from topshelfmenu.us site.<br />
  Click below link for change password. </p>
<div style="text-align:center; margin:60px 30px 30px 30px;">
<a style="background-color: #22aa00; border:2px solid #22aa00; text-transform:uppercase; font-size: 16px; font-weight: 600;  color: #fff; padding: 10px 30px; text-decoration:none;" href="{{URL::to('/')}}/{{$user_type}}/reset_pass/{{$user_info->forgot}}">Click Here</a> </div>
<div style="background-color:#F0FFFF; text-align:center; padding:20px; margin-bottom:20px; margin-top:20px;">
<div>Have A Question ?</div>
<div><a href="#" style="margin:3px 5px;">support@treepots.com</a></div>
</div>

</div>


</body>
</html>