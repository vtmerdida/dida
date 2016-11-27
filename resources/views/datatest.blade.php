<!DOCTYPE html>
<html>
<head>
	<title>User edit</title>
</head>
<body>
{!!Form::open(['url'=>'/user/test','method'=>'POST'])!!}
	user_tel:{!!Form::text('user_tel')!!}<br/>
	{!!Form::submit('test')!!}
	{!!Form::close()!!}

</body>
</html>
