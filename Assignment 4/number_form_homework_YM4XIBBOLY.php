<!doctype html>
<html>
<head>
<title>Number Form</title>

</head>
<body>
<?php
	$DisplayForm = TRUE;
	$number1 = $number2 = "";
	
	if (isset($_POST['submit'])) {
		
		 $number1 = validate($_POST['number1']);
		 $number2 = validate($_POST['number2']);
		 
		 if (is_numeric($number1) and is_numeric($number2)) {
			  $DisplayForm = FALSE;
		 } else {
			  echo "<p>You need to enter a numeric 
				   value.</p>\n";
			  $DisplayForm = TRUE;
		 }
	}
	
	function validate($num){
		$number = stripslashes($num);
		$number = htmlspecialchars($num);
		$number = strip_tags($num);
		$number = trim($num);
		return $number;
	}
	
	if ($DisplayForm) {
?>
    <form name="NumberForm" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    	<p>Please enter two numbers:</p>
    	<div>
        	<input type="text" name="number1" id="number1" size="10" maxlength="10" 
                   placeholder="2" value="<?php echo $number1?>"> and
            <input type="text" name="number2" id="number2" size="10" maxlength="10" 
            	   placeholder="4" value="<?php echo $number2 ?>">
        </div>
        
        <div>
        	<input type="submit" name="submit" value="Submit">
        </div>
    </form>
<?php
	}
	else {
		 echo "<p>Here are your results.</p>\n";
		 echo "<p>$number1 + $number2 is " . ($number1 + $number2) . "</p>";
		 echo "<p>$number1 - $number2 is " . ($number1 - $number2) . "</p>";
		 echo "<p>$number1 / $number2 is " . ($number1 / $number2) . "</p>";
		 echo "<p>$number1 * $number2 is " . ($number1 * $number2) . "</p>";
		 echo "<p><a href=\"number_form_homework.php\">Try 
			  again?</a></p>\n";
	}
?>
</body>
</html>
<?php
echo "<mm:dwdrfml documentRoot=" . __FILE__ .">";$included_files = get_included_files();foreach ($included_files as $filename) { echo "<mm:IncludeFile path=" . $filename . " />"; } echo "</mm:dwdrfml>";
?>