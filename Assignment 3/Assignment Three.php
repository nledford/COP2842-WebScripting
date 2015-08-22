<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Assignment Three | Nathaniel Ledford</title>

</head>

<body>
	<?php
		$tags 		= strip_tags($_POST['stripTags']);
		$reverse 	= strrev($_POST['stringReverse']);
		$shuffle	= str_shuffle($_POST['stringShuffle']);
		$slashes	= stripslashes($_POST['stripSlashes']);
	?>

    <form method="post" action="<?php $_SERVER['PHP_SELF']?>" novalidate>
        <div>
            <p>This textbox will use the strip_tags() function to remove HTML and PHP tags from a string</p>
            
            <input type="text" name="stripTags" id="stripTags" placeholder="Strip tags"><br>
            <span id="tagsOutput"><?php echo $tags ?></span>
        </div>
        
        <div>
            <p>This textbox will use the strrev() function to reverse a string.</p>
            
            <input type="text" name="stringReverse" id="stringReverse" placeholder="Reverse your string"><br>
            <span id="reverseOutput"><?php echo $reverse ?></span>
        </div>
        
        <div>
            <p>This textbox will use the str_shuffle() function to randomly shuffle a string.</p>
            
            <input type="text" name="stringShuffle" id="stringShuffle" placeholder="Shuffle your sentence"><br>
            <span id="shuffleOutput"><?php echo $shuffle ?></span>
        </div>
        
        <div>
            <p> This textbox will use the stripslashes() function to remove slashes.</p>
            
            <input type="text" name="stripSlashes" id="stripSlashes" placeholder="Remove quotes"><br>
            <span id="quotesOutput"><?php echo $slashes ?></span>
        </div>
            
            <input type="submit" id="submit" value="Run Functions">
    </form>

</body>
</html>