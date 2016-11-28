<!DOCTYPE html>
<html>
<head>
	<title>User edit</title>
</head>
<body>
{!!Form::open(['url'=>'/user/test','method'=>'POST'])!!}
	userphone:{!!Form::text('userphone')!!}<br/>
	fromname:{!!Form::text('fromname')!!}<br/>
	fromgeog:{!!Form::text('fromgeog')!!}<br/>
	destination:{!!Form::text('destination')!!}<br/>
	destination_positon:{!!Form::text('destination_positon')!!}<br/>
	num:{!!Form::text('num')!!}<br/>
	cartype:{!!Form::text('cartype')!!}<br/>

	{!!Form::submit('test')!!}
	{!!Form::close()!!}

</body>
</html>
