<!DOCTYPE html>
<html>
	<head>
		<title>Assignment Seven | Nathaniel Ledford</title>
	</head>

	<body>
		<?php
			$DBName = 'MusicStore';
			
			$link = mysql_connect('localhost', 'root', 'root');
			
			if (!$link) {
			    die('Could not connect: ' . mysql_error());
			} 
			
			$sql = 'CREATE DATABASE ' . $DBName;
			if (mysql_query($sql, $link)) {
			    echo 'Database ' . $DBName . ' created successfully';
			} else {
			    echo 'Error creating database: ' . mysql_error();
			}
			
			mysql_select_db($DBName) or die(mysql_error());
			
			$CreateString = 'CREATE TABLE customers' .
						'(CustomerID Int not null auto_increment primary key,' .
						'CustomerLastName varchar(50) not null,' .
						'CustomerFirstName varchar(30) not null,' .
						'CustomerEmail varchar(30) null,' .
						'CustomerPhone varchar(30) null)';
						
			$CreateResult = mysql_query($CreateString, $link);
			
			if ($CreateResult === false) {
				echo "<p>Unable to create the customers table.</p>" .
				"<p>Error code: " . mysql_errno($link) . "</p>" .
				"<p>" . mysql_error($link) . "</p>";
			} else {
				echo "<p>Successfully created the customers table.</p>";
			}
			
			
						
			$insertQuery = 'insert into customers ' .
						'(CustomerLastName, CustomerFirstName, CustomerEmail, CustomerPhone)' .
						'VALUES ("Peart","Neil","peartn@email.com","555-123-4567"),' .
						'("Lee","Geddy","leeg@email.com","555-234-5678"),' .
						'("Lifeson","Alex","lifesona@gmail.com","555-345-6789"),' .
						'("King","Darren","kingd@gmail.com","555-456-7890"),' .
						'("Meany","Paul","meanyp@gmail.com","555-098-7654"),' .
						'("Hayes","Darren","hayesd@gmail.com","555-123-0987"),' .
						'("Goodnight","Tiffany","goodnightt@gmail.com","555-222-2323"),' .
						'("Hollon","Keisha","hollonk@gmail.com","555-898-0000"),' .
						'("Melua","Katie","meluak@gmail.com","555-343-6578"),' .
						'("Groves","Cady","grovesc@gmail.com","555-213-0515")';
						
			$insertResult = mysql_query($insertQuery, $link);
			if ($insertResult === false){
				echo "<p>Unable to insert data into customers table.</p>" .
				"<p>Error code: " . mysql_errno($link) . "</p>" .
				"<p>" . mysql_error($link) . "</p>";
			} else {
				echo "<p>Inserted data successfully.</p>";
			}
						
			$selectQuery = "select * from customers";
			
			$selectResult = mysql_query($selectQuery, $link);
				if ($selectResult !== false){
				echo '<table width="100%" border="1">';
				echo '<tr><th>Customer ID</th><th>Last Name</th><th>First Name</th><th>Customer Email</th><th>Customer Phone</th></tr>';
				
				while(($row =mysql_fetch_row($selectResult)) !== false){
					echo '<tr><td>' . $row[0] . '</td>';
					echo '<td>' . $row[1] . '</td>';
					echo '<td>' . $row[2] . '</td>';
					echo '<td>' . $row[3] . '</td>';
					echo '<td>' . $row[4] . '</td></tr>';
				}
				echo '</table>';
			}
			
			mysql_close($link);
		?>
	</body>
</html>