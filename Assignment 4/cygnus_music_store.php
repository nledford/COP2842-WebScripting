<!doctype html>
<html>
<head>
<title>Music Store</title>
<style type="text/css">
	form, div {
		width: 960px;
		margin: 0 auto;
	}

	div {
		margin: 1em 0;
	}
	
	select {
		width: 10em;
		font-size: 12px;
	}
	
	input, label {
		margin-right: .25em;
	}
	
	label {
		cursor: pointer;
	}
	
	.error {
		color: red;
	}
</style>
</head>
<body>
<?php
	$DisplayForm = TRUE;
	$nameErr = $emailErr = $formatErr = $genresErr = "";
	$name = $email = $format = "";
	$genres = array();
	
	if (isset($_POST['submit'])) {
		
		   if (empty($_POST['name'])) {
			   $nameErr = "Please enter a name.";
		   } 
		   else if (!preg_match("/^[a-zA-Z]+(([\'\,\.\- ][a-zA-Z ])?[a-zA-Z]*)*$/", $_POST['name'])) {
			   $nameErr = "Invalid name entered. Please try again.";
		   } else {
			   $name = validate($_POST['name']);
		   }
		   
		   if (empty($_POST['email'])){
			   $emailErr = "Please enter an email address";
		   } else if (!preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $_POST['email'])) {
			   $emailErr = "Invalid email address entered.  Please try again";
		   } else {
			   $email = validate($_POST['email']);
		   }
		 
		 if (!isset($_POST['format'])){
			 $formatErr = "Please select a format.";
		 } else {
			 $format = $_POST['format'];
		 }
		 
		 if (empty($_POST['genres'])){
			 $genresErr = "Please select one or more genres";
		 } else {
			 $genres = $_POST['genres'];
		 }
		 
		 if(isset($_POST['newsletter'])){
			 $newsletter = $_POST['newsletter'];
		 } else {
			 $newsletter = "No";
		 }
		 
		 if(!empty($name) && !empty($email) && !empty($format) && !empty($genres)){
			 $DisplayForm = false;
		 }
	}
	
	function validate($input){
		$output = stripslashes($input);
		$output = htmlspecialchars($input);
		$output = strip_tags($input);
		$output = trim($input);
		return $output;
	}
	
	if ($DisplayForm) {
?>
    <form name="NumberForm" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" novalidate>
    	<h1>Music Store</h1>
        
        <p>Please fill out the form below to create an account:</p>
        
    	<div>
        	<label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="John Doe" value="<?php echo $name ?>" tabindex="1"><br>
            <span class="error"><?php echo $nameErr ?></span>
        </div>
        
        <div>    
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="example@example.com" value="<?php echo $email ?>" tabindex="2"><br>
            <span class="error"><?php echo $emailErr ?></span>
        </div>
        
        <div>
        	<fieldset>
                Which format do you use to listen to music?<br>
                
                <input type="radio" id="cds" name="format" value="CDs"
                       <?php if (isset($format) && $format == "CDs") echo "checked"; ?> tabindex="3">
                <label for="cds">CDs</label>
                
                <input type="radio" id="digital" name="format" value="Digital"
                       <?php if (isset($format) && $format == "Digital") echo "checked"; ?> tabindex="4">
                <label for="digital">MP3s</label>
                
                <input type="radio" id="vinyl" name="format" value="Vinyl"
                       <?php if (isset($format) && $format == "Vinyl") echo "checked"; ?> tabindex="5">
                <label for="vinyl">Vinyl</label><br>
                
                <span class="error"><?php echo $formatErr ?></span>
            </fieldset>
        </div>
        
        <div>                
        	<p>What are your favorite genres of music? (Ctrl/Cmd + click to make multiple selections)</p>
            
            <select name="genres[]" size="3" multiple>
                <?php
                   
                    $options = array("blues","country","jazz","pop","rap","rock","other");
                    
                    foreach ($options as $option){
                        echo '<option value="' . $option . '"';
                        if (in_array($option, $genres)){
                            echo "selected";
                        }
                        echo ">" . ucfirst($option) . "</option>\n";
                    }
                ?>
               
            </select>
            <br>
            <span class="error"><?php echo $genresErr ?></span>
        </div>
        
        <div>
        	<input type="checkbox" name="newsletter" id="newsletter" value="yes" checked>
            <label for="newsletter">Sign me up for the monthly newsletter</label>
        </div>
        
        <div>
        	<input type="submit" name="submit" value="Sign Up"><input type="reset" value="Start Over">
        </div>
    </form>
<?php
	}
	else {
		 echo "Thank you for registering. Your information:<br>";
		 echo "Name: $name<br>";
		 echo "Email: $email<br>";
		 echo "Format: $format<br>";
		 echo "Genres: ";
		 	foreach ($genres as $genre){
				echo ucfirst($genre) . ", ";
			}
		echo "<br>Sign me up for the monthly newsletter: $newsletter";
	}
?>
</body>
</html>