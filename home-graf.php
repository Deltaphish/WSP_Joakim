<!DOCTYPE html>
<head>
	<meta charset="utf-8"/>
	<title>Plot</title>
	<script src="https://code.jquery.com/jquery-3.3.0.js"integrity="sha256-TFWSuDJt6kS+huV+vVlyV1jM3dwGdeNWqezhTxXB/X8=" crossorigin="anonymous"></script>
</head>

<body>
	<canvas id="canvas" width="600" height="600"></canvas>
	<script>
		var max = 0, min = 99999999;
		var first = 999999999, last = 0;
		var dateLog,weightLog;
		var canvas = document.getElementById('canvas');
		var ctx = canvas.getContext('2d');

		var widthPadding = -30;
		var heightPadding = -40;
		var width = canvas.width+widthPadding;
		var height = canvas.height+heightPadding;
		$.ajax({
			url:"getData.php?user=john",
			dataType:"json"}
		).done(function(msg){
			ctx.strokeStyle = "black";
			weightLog = msg.map(x => x[0]);
			dateLog = msg.map(x => Date.parse(x[1])/100000);
			var sum=0;
			dateLog.forEach(function(i){
				first = i<first?i:first;
				last = i>last?i:last;
			});
			ctx.strokeText(new Date(first*100000).toDateString(),50,height-heightPadding-10);
			ctx.strokeText(new Date(first*100000).toDateString(),width-100,height-heightPadding-10);
			dateLog.forEach(x => sum += x-first);

			weightLog.forEach(function(i){
				max = i>max?i:max;
				min = i<min?i:min;
			});

			for(var i = 0;i <= 10;i++){
				ctx.strokeStyle = "lightgrey";
				ctx.fillRect(-widthPadding,(height-(height/10)*i),width,2);
				ctx.strokeStyle = "black";
				ctx.strokeText(Math.floor((Number(min) + (max-min)*i/10)),0,(height+9-(height/10)*i));
			}

			ctx.beginPath();
			ctx.moveTo(-widthPadding,height-height/(max-min)*(weightLog[0]-min));
			var x_spacing = 0;
			for(var i = 1; i != msg.length;i++){
				x_spacing = -widthPadding + width/(last-first)*(dateLog[i]-first);
				ctx.lineTo(x_spacing,height-height/(max-min)*(weightLog[i]-min));
			}
			ctx.lineWidth = 3;
			ctx.lineCap = "square";
			ctx.strokeStyle = "orange";
			ctx.stroke()
		});
	</script>
</body>
