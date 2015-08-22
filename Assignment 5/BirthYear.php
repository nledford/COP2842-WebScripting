
<html >
<head>
<title>Your Chinese Zodiac Sign</title>

</head>
<body>

<h1>Your Chinese Zodiac Sign Program</h1>
<h2>Author: Nathaniel Ledford</h2>


<?php
function validateInput($data, $fieldName) {
     global $errorCount;
     if (empty($data)) {
          echo "\"$fieldName\" is a required field.<br />\n";
          ++$errorCount;
          $retval = "";
     } else { // Only clean up the input if it isn't empty
          $retval = trim($data);
          $retval = stripslashes($retval);
     }
     return($retval);
}

function displayForm($Year) {
?>

<form action = "BirthYear.php"  method = "post">
<p>Enter Your Birth Year: <input type="text" name="Year" value="<?php echo $Year; ?>" /></p>
<p><input type="reset" value="Clear Form" />&nbsp; &nbsp;<input type="submit" name="Submit" value="Show Me My Sign" /></p>
</form>
<?php
}

function displayResults($Year) {
     $CZIndex = $Year % 12;
	 
	 
	 if ($CZIndex == 4) {
	   echo "<p>You were born under the sign of the Rat.</p>\n";
	   echo "<p><img src='Images/Rat.gif' alt='Rat' title='Rat' /></p>\n";
	 }
	 elseif ($CZIndex == 5) {
        echo "<p>You were born under the sign of the Ox.</p>\n";
     	echo "<p><img src='Images/Ox.gif' alt='Ox' title='Ox' /></p>\n";
	 }
	 elseif ($CZIndex == 6) {
        echo "<p>You were born under the sign of the Tiger.</p>\n";
     	echo "<p><img src='Images/Tiger.gif' alt='Tiger' title='Tiger' /></p>\n";
	 }
	 elseif ($CZIndex == 7) {
     	echo "<p>You were born under the sign of the Rabbit.</p>\n";
     	echo "<p><img src='Images/Rabbit.gif' alt='Rabbit' title='Rabbit' /></p>\n";
	 }
	 elseif ($CZIndex == 8) {
        echo "<p>You were born under the sign of the Dragon.</p>\n";
        echo "<p><img src='Images/Dragon.gif' alt='Dragon' title='Dragon' /></p>\n";
	 }
     elseif ($CZIndex == 9) {
        echo "<p>You were born under the sign of the Snake.</p>\n";
        echo "<p><img src='Images/Snake.gif' alt='Snake' title='Snake' /></p>\n";
	 }
	 elseif ($CZIndex == 10) {
        echo "<p>You were born under the sign of the Horse.</p>\n";
        echo "<p><img src='Images/Horse.gif' alt='Horse' title='Horse' /></p>\n";
	 }
	 elseif ($CZIndex == 11) {
        echo "<p>You were born under the sign of the Goat.</p>\n";
		echo "<p>The year of the Sheep: is one that will be a time for caring, bringing out creative talent, imagination and emotion, whilst remaining, calm, smooth and slow.</p>";
        echo "<p><img src='Images/Goat.gif' alt='Goat' title='Goat' />
        		 <img src='Images/1-goat.jpg' alt='Second Goat' title='Second Goat' style='max-width: 48px;'></p>\n";
	 }
	 elseif ($CZIndex == 0) {
        echo "<p>You were born under the sign of the Monkey.</p>\n";
        echo "<p><img src='Images/Monkey.gif' alt='Monkey' title='Monkey' /></p>\n";
	 }
	 elseif ($CZIndex == 1) {
        echo "<p>You were born under the sign of the Rooster.</p>\n";
        echo "<p><img src='Images/Rooster.gif' alt='Rooster' title='Rooster' /></p>\n";
	 }
	 elseif ($CZIndex == 2){
        echo "<p>You were born under the sign of the Dog.</p>\n";
        echo "<p><img src='Images/Dog.gif' alt='Dog' title='Dog' /></p>\n";
	 } else {
        echo "<p>You were born under the sign of the Pig.</p>\n";
        echo "<p><img src='Images/Pig.gif' alt='Pig' title='Pig' /></p>\n";
     }
	 
     /*switch ($CZIndex) {
          case 0:
               echo "<p>You were born under the sign of the Rat.</p>\n";
               echo "<p><img src='Images/Rat.gif' alt='Rat' title='Rat' /></p>\n";
               break;
          case 1:
               echo "<p>You were born under the sign of the Ox.</p>\n";
               echo "<p><img src='Images/Ox.gif' alt='Ox' title='Ox' /></p>\n";
               break;
          case 2:
               echo "<p>You were born under the sign of the Tiger.</p>\n";
               echo "<p><img src='Images/Tiger.gif' alt='Tiger' title='Tiger' /></p>\n";
               break;
          case 3:
               echo "<p>You were born under the sign of the Rabbit.</p>\n";
               echo "<p><img src='Images/Rabbit.gif' alt='Rabbit' title='Rabbit' /></p>\n";
               break;
          case 4:
               echo "<p>You were born under the sign of the Dragon.</p>\n";
               echo "<p><img src='Images/Dragon.gif' alt='Dragon' title='Dragon' /></p>\n";
               break;
          case 5:
               echo "<p>You were born under the sign of the Snake.</p>\n";
               echo "<p><img src='Images/Snake.gif' alt='Snake' title='Snake' /></p>\n";
               break;
          case 6:
               echo "<p>You were born under the sign of the Horse.</p>\n";
               echo "<p><img src='Images/Horse.gif' alt='Horse' title='Horse' /></p>\n";
               break;
          case 7:
               echo "<p>You were born under the sign of the Goat.</p>\n";
			   echo "<p>The year of the Sheep: is one that will be a time for caring, bringing out creative talent, imagination and emotion, whilst remaining, calm, smooth and slow.</p>";
               echo "<p><img src='Images/Goat.gif' alt='Goat' title='Goat' /></p>\n";
               break;
          case 8:
               echo "<p>You were born under the sign of the Monkey.</p>\n";
               echo "<p><img src='Images/Monkey.gif' alt='Monkey' title='Monkey' /></p>\n";
               break;
          case 9:
               echo "<p>You were born under the sign of the Rooster.</p>\n";
               echo "<p><img src='Images/Rooster.gif' alt='Rooster' title='Rooster' /></p>\n";
               break;
          case 10:
               echo "<p>You were born under the sign of the Dog.</p>\n";
               echo "<p><img src='Images/Dog.gif' alt='Dog' title='Dog' /></p>\n";
               break;
          case 11:
               echo "<p>You were born under the sign of the Pig.</p>\n";
               echo "<p><img src='Images/Pig.gif' alt='Pig' title='Pig' /></p>\n";
               break;
     }*/ 
     
     echo "<p style = 'text-align:center'><a href='BirthYear.php'>Back</a></p>\n";
}

$ShowForm = TRUE;
$errorCount = 0;
$Year = date("Y");
if (isset($_POST['Submit'])) {
     $Year = validateInput($_POST['Year'],"Birth Year");
     if ($errorCount==0)
          $ShowForm = FALSE;
     else
          $ShowForm = TRUE;
}

if ($ShowForm == TRUE) {
     if ($errorCount>0) // if there were errors
          echo "<p>Please re-enter the form information below.</p>\n";
     displayForm($Year);
} 
else {
     displayResults($Year);
}

?>


</body>
</html>

