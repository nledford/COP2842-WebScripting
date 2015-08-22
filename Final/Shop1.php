<!DOCTYPE html>
<html>
	<body>
		<?php
			$DBName = 'NoveltyItemsCatalog';
			
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
				
				$CreateString = 'CREATE TABLE Products' .
							'(ProductID Int AUTO_INCREMENT not null primary key,' .
							'ProductName varchar(100) not null,' .
							'ProductDescription varchar(200) not null,' .
							'Price numeric(9,2) not null)' ;
							
							//'Quantity int not null)'.
							//'TotalAmount numeric(9,2) not null,' ;
							
							
							/*
								Quantity, Total Amount, Add to cart option needs to be added later
								I don't know how to do it now, I will probably just build db contents?
							
							*/
							
				$CreateResult = mysql_query($CreateString, $link);
				
				if ($CreateResult === false) {
					echo "<p>Unable to create the Products table.</p>" .
					"<p>Error code: " . mysql_errno($link) . "</p>" .
					"<p>" . mysql_error($link) . "</p>";
				} else {
					echo "<p>Successfully created the Products table.</p>";
				}
				
				
							
				$insertQuery = 'insert into Products ' .
							' (ProductName, ProductDescription, Price)' .
							'VALUES ("Rilakkuma Mobile Phone Holder", "A very cute and comfy cellphone holder. Your cellphone couldnt be any happier!", "15.00"),' .
							'("Rilakkuma Pill Case", "There is no better place to stor your mints, pills, or vitamins than this cute little bear case.", "10.00"),' .
							'("Fridgeezoo Refrigerator Pet", "Your groceries will never ever be lonely with these talking pets that greets you when you open the fridge.", "15.00"),' .
							'("Ceramic Noodle Cup", "Perfect present for noodle lovers - washable, reusable, and microwavable.", "15.00"),' .
							'("Ice Cube Rocks", "Literally make your drink on the rocks. This item is a set of 9.", "15.00"),' .
							'("Japanese Message Dolls", "A 3-inch doll with a tiny card inside.", "10.00"),' .
							'("Tea-Rex Infuser", "A tea infuser for the dino lover", "10.00"),' .
							'("Lego Mini Storage Boxes", "Somewhere you can store your little treasures. ", "5.00"),' .
							'("Bacon Strips Adhesive Bandages", "The silver lining of having cuts or wounds. Contains 15 bandages.", "5.00"),' .
							'("Star Wars Lightsaber Chopsticks", "The closest thing you will get to being a Jedi", "9.00")' ;
							
				$insertResult = mysql_query($insertQuery, $link);
				if ($insertResult === false){
					echo "<p>Unable to insert data into Products table.</p>" .
					"<p>Error code: " . mysql_errno($link) . "</p>" .
					"<p>" . mysql_error($link) . "</p>";
				} else {
					echo "<p>Inserted data successfully.</p>";
				}
			}
						
			$selectQuery = "select * from Products";
			
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