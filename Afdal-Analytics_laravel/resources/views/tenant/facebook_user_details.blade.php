<!-- User logged in successfully. -->
<?php 
$token = Session::get('facebook_token');
$name = Session::get('facebookname');
$email = Session::get('email');
$id = Session::get('facebook_id');
$avatar = Session::get('facebook_avatar');
?>
<b>User Details</b> :->
<br/>
Email : {{$email}}
<br/>
Facebook Name : {{$name}}
<br/>
Facebook Id : {{$id}}
<br/>
Email : {{$email}}
<br/>
Profile Image : <img src="{{$avatar}}"> 

<br/><br/><br/><br/>
<a href="{{url('facebookpagedetails')}}">Get Pages</a>
<br/>

