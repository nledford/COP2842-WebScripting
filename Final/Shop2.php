<!DOCTYPE html>
<html>
	<body>
		<?php
			$DBName = 'ClothingCatalog';
			
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
				
				$CreateString = 'CREATE TABLE Clothes' .
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
					echo "<p>Unable to create the Clothes table.</p>" .
					"<p>Error code: " . mysql_errno($link) . "</p>" .
					"<p>" . mysql_error($link) . "</p>";
				} else {
					echo "<p>Successfully created the Clothes table.</p>";
				}
				
				
							
				$insertQuery = 'insert into Clothes ' .
							' (ProductName, ProductDescription, Price)' .
							'VALUES ("Bejeweled Knit Sweater", "A solid sweater featuring a bejeweled front, and a round neckline. Long sleeves. Ribbed trimming. Knit.", "19.80"),' .
							'("Pleated Pocket Blazer", "A textured blazer featuring two pleated flap pockets. Two-button closure. Long sleeves with a three-button closure. Darted front and back. Notched lapels. Fully lined. Lightly padded shoulders. Woven. ", "27.80"),' .
							'("Lace Inset Pencil Dress", "A pencil dress featuring a v-cut bust and velour trimmed waist with a lace inset. Sleeveless. Darted bust and waist. Center seam back with a partial exposed zipper and a hidden hook-eye closure. Knit. Semi-sheer Partially lined.", "24.80"),' .
							'("Sequined Party Dress w/ Belt", "This short strapless party dress features a sequined bodice and a voluminous skirt. Hidden boning in the front. Hidden side zipper placket and hook-eye closure. Banded waistline with belt loops and a glittered bow belt. Finished hemline. Fully lined with tulle trimming along the hem. Woven.", "29.80"),' .
							'("Faux Leather Fringe Skirt", "A mini skirt featuring faux leather fringe. Zippered placket in the back. Fully lined.", "24.80"),' .
							'("Shirred Lace Skirt", "A shirred skirt featuring a lace overlay. Banded waist. Hidden side zipper. Woven.", "19.80"),' .
							'("Pleated Woven Shorts w/ Belt", "A pair of woven shorts featuring a pleated front. Faux leather belt. Cuffed hem. Trouser style pockets in the front. Welt pockets in the back. Zip fly, buttoned waist. Partial lining.", "19.80"),' .
							'("Straight Leg Pants", "A pair of essential straight leg pants featuring high polish hardware. Five pocket construction. Banded waistline with belt loops. Zip fly, button closure. Knit.", "19.80"),' .
							'("Oversized Tab Shirt", "A semi-sheer woven shirt featuring button tabs. Basic collar. Buttoned chest pocket. Dropped shoulders. Long sleeves with two-button cuffs. Box pleated at the back yoke.", "15.80"),' .
							'("Studded Geometric Tee", "An abstract geometric tee featuring studded accents. Shallow neckline. Cap sleeves. Boxy fit. Knit.", "14.80")' ;
							
				$insertResult = mysql_query($insertQuery, $link);
				if ($insertResult === false){
					echo "<p>Unable to insert data into Clothes table.</p>" .
					"<p>Error code: " . mysql_errno($link) . "</p>" .
					"<p>" . mysql_error($link) . "</p>";
				} else {
					echo "<p>Inserted data successfully.</p>";
				}
			}
						
			$selectQuery = "select * from Clothes";
			
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