<!-- User logged in successfully. -->
<?php 
$name = Session::get('twittername');
$nickname = Session::get('nickname');
$id = Session::get('twitter_id');
$avatar = Session::get('avatar');
?>
<b>User Details</b> :->
<br/>
Name : {{$content->name}}
<br/>
Screen Name : {{$content->screen_name}}
<br/>
Twitter_id : {{$content->id_str}}
<br/>
Location : {{$content->location}}
<br/>
Description : {{$content->description}}
<br/>
Followers : {{$content->followers_count}}
<br/>
Following : {{$content->friends_count}}
<br/>
Profile Image : <img src="{{$content->profile_image_url}}"> 

<br/><br/><br/><br/>
<a href="{{url('usertweets',$content->id_str)}}">Get User Tweets</a>
<br/>
<a href="{{url('accountactivity')}}">Account Activity</a>
<br/>
