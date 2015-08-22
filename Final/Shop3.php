<!DOCTYPE html>
<html>
	<body>
		<?php
			$DBName = 'CosmeticsCatalog';
			
			$link = mysql_connect('localhost', 'root', 'root');
			
			if (!$link) {
			    die('Could not connect: ' . mysql_error());
			} 
			
			$result = mysql_select_db($DBName, $link);
			
			if ($result === false){
			
				$sql = 'CREATE DATABASE ' . $DBName;
				if (mysql_query($sql, $link)) {
				    echo 'Database ' . $DBName . ' created successfully';
				} else {
				    echo 'Error creating database: ' . mysql_error();
				}
				
				mysql_select_db($DBName) or die(mysql_error());
				
				$CreateString = 'CREATE TABLE Cosmetics' .
							'(ProductID Int AUTO_INCREMENT not null primary key,' .
							'ProductName varchar(100) not null,' .
							'ProductDescription varchar(500) not null,' .
							'Price numeric(9,2) not null)' ;
							
							//'Quantity int not null)'.
							//'TotalAmount numeric(9,2) not null,' ;
							
							
							/*
								Quantity, Total Amount, Add to cart option needs to be added later
								I don't know how to do it now, I will probably just build db contents?
							
							*/
							
				$CreateResult = mysql_query($CreateString, $link);
				
				if ($CreateResult === false) {
					echo "<p>Unable to create the Cosmetics table.</p>" .
					"<p>Error code: " . mysql_errno($link) . "</p>" .
					"<p>" . mysql_error($link) . "</p>";
				} else {
					echo "<p>Successfully created the Cosmetics table.</p>";
				}
				
				
							
				$insertQuery = 'insert into Cosmetics ' .
							' (ProductName, ProductDescription, Price)' .
							'VALUES ("Blushing Bride Cheek Stain", "A water-based gel cheek tint that gives you a natural flush—exactly like someone just pinched your cheeks!", "30.00"),' .
							'("Natural Red Lip Gloss", "Flash a fabulous smile and a stunning splash of color with this lip formula that combines the longevity of a lipstick with the breezy application of a gloss.", "16.00"),' .
							'("Layer on the Gems Eyeliner", "This must-have eyeliner will turn your eyes into the sexy, jewel-toned standouts they deserve to be.", "29.00"),' .
							'("Rich Black Mascara", "This mascara delivers perfectly plush, everyday glam lashes with an innovative XXL brush for maximum show-stopping volume.", "25.00"),' .
							'("Flawless Face Foundation", "Invisible long-wearing coverage beautifully covers everything yet feels like nothing.", "29.00"),' .
							'("Irresistible Bronzing Powder", "A true brown-based bronzer with a gold shimmer fusion that is excellent for creating or enhancing the look of healthy, glowing, tanned skin.", "34.00"),' .
							'("Erase Paste Concealer", "A concentrated, creamy, blendable concealer that instantly brightens and camouflages all-in-one. It has an innovative formula which makes sure signs of stress and fatigue are a thing of the past.", "26.00"),' .
							'("Beautiful Brows Filler", "This set comes with all the tools you need for clean, smooth, perfectly-defined brows.", "30.00"),' .
							'("Naked Pallette Eye Shadow", " A variety of textures, including glitter, shimmer, and matte, ensure that you will never get bored. This versatile palette can go from office appropriate to a night on the town.", "50.00"),' .
							'("POREfessional Pore Reducing Primer", "This product quickly minimizes the appearance of pores. Apply this silky, lightweight balm to achieve translucent pore coverage and smoother-than-smooth skin. ", "30.00")' ;
							
				$insertResult = mysql_query($insertQuery, $link);
				if ($insertResult === false){
					echo "<p>Unable to insert data into Cosmetics table.</p>" .
					"<p>Error code: " . mysql_errno($link) . "</p>" .
					"<p>" . mysql_error($link) . "</p>";
				} else {
					echo "<p>Inserted data successfully.</p>";
				}
			}
						
			$selectQuery = "select * from Cosmetics";
			
			$selectResult = mysql_query($selectQuery, $link);
				if ($selectResult !== false){
				echo '<table width="100%" border="1">';
				echo 
				'<tr>
				<th>Product Name</th>
				<th>Product Description</th>
				<th>Price</th>
				</tr>';
				
				while(($row =mysql_fetch_row($selectResult)) !== false){
					echo '<tr><td>' . $row[1] . '</td>';
					echo '<td>' . $row[2] . '</td>';
					echo '<td>' . $row[3] . '</td>';
				
				}
				echo '</table>';
			}
			
			mysql_close($link);
		?>
	</body>
</html>