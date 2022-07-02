<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Green Grapez">
<meta name="keywords" content="HTML,CSS,XML,JavaScript">
<meta name="author" content="Green Grapez">
<meta name="google-site-verification" content="-3fR2s0fAH-tDmr1Fkt1Zn9Zv3qA3tcabWHX8mpCd28" />
<link rel="shortcut icon" href="{{url('/')}}/images/msslogo.png"/>
<title>MS Petroleum</title>
<!-- Bootstrap --> 
<link href="{{url('/')}}/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{url('/')}}/css/font-awesome.min.css" rel="stylesheet">
<!-- bootstrap-progressbar -->
<link href="{{url('/')}}/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
<!-- iCheck -->
<link href="{{url('/')}}/css/green.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="{{url('/')}}/css/custom.min.css" rel="stylesheet">
</head>

<body style="background-color:#3a4652;">
<div> <a class="hiddenanchor" id="signup"></a> <a class="hiddenanchor" id="signin"></a>
  <div class="login_wrapper">
    <div class="animate form login_form text-center">
    <img src="{{url('/')}}/images/msslogo.png" alt="logo">
    <h1 class="text-uppercase text-white">Select Company</h1>
    <ul>
    @if(count($result)>0)
            @foreach($result as $results)
    <li><a href="{{url('/')}}/index/{{$results->company}}/{{$results->username}}" class="btn btn-default">{{$results->company}}</a></li>
    
    @endforeach
            @endif
    </ul>
    </div>
  </div>
</div>
</body>
</html>
