<html>
<head>
	<title>Months of Year | Nathaniel Ledford</title>
</head>
<body>
	<?php
	
		//Set up array to contain the months of the year in English
		$monthsOfYear = array("January","February","March","April","May","June","July","August","September","October","November","December");
		
		echo("<h1>Months in English</h1>");
		
		//Use foreach loop to display output
		foreach ($monthsOfYear as $month) {
		     echo "<p>$month</p>";
		}
		
		//Set up array to contain the months of the year in French
		$frenchMonths = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
		
		echo("<h1>Months in French</h1>");
		
		//Use foreach loop to display output
		foreach ($frenchMonths as $month) {
			echo "<p>$month</p>";
		}
		
	?>
</body>
</html>