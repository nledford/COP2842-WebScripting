<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Assignment 2 | Nathaniel Ledford</title>

<style type="text/css">
	img {
		max-width: 250px;
		max-height: 250px;
		width: 100%;
		height: 100%;
	}
</style>

</head>

<body>

	<?php
		$mutemath = array("mutemath1","mutemath2","mutemath3");
		$length = sizeof($mutemath);
		
		for ($i = 0; $i < $length; $i++){
			echo("<img src='".$mutemath[$i].".jpeg'>");
		}
	?>
    
    <hr>
    
	<?php
		for($i=1; $i<=10; $i++){
			for($a=1; $a<=10; $a++){
				$b = $a * $i;
				
				if ($b < 10 && $b < 100){
					print(" &nbsp;$b&nbsp;&nbsp;");
				} 
				else if ( $b >= 100){
					print(" $b");
				} else {
					print(" &nbsp;$b");
				}
			}
			print("<br>");
		}
	?>

</body>
</html>