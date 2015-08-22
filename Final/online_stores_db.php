		<?php
			$DBName = 'online_stores';
			
			$link = mysql_connect('localhost', 'root', '');
			
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
			
			$CreateString = 'CREATE TABLE store_info' .
						'(StoreID varchar(10) not null primary key,' .
						'Name varchar(50) not null,' .
						'Description varchar(200) not null,' .
						'Welcome text not null)' . 
						'CSS_File varchar(250) not null)' .
						'Email_Address varchar(100) not null)';
						

						
			$CreateResult = mysql_query($CreateString, $link);
			
			if ($CreateResult === false) {
				echo "<p>Unable to create store_info table.</p>" .
				"<p>Error code: " . mysql_errno($link) . "</p>" .
				"<p>" . mysql_error($link) . "</p>";
			} else {
				echo "<p>Successfully created the store_info table.</p>";
			}
			
			$store_info = mysql_query ("LOAD DATA INFILE '/store_info.txt' INTO TABLE store_info")
			
       
	  $CreateString2 = 'CREATE TABLE inventory' .
						'(StoreID varchar(10) not null,' .
						'ProductID varchar(50) not null primary key,' .
						'Name varchar(100) not null,' .
						'Description varchar(200) not null)' . 
						'Price float not null)';
						
					$CreateResult2 = mysql_query($CreateString2, $link);
			
			if ($CreateResult2 === false) {
				echo "<p>Unable to create inventory table.</p>" .
				"<p>Error code: " . mysql_errno($link) . "</p>" .
				"<p>" . mysql_error($link) . "</p>";
			} else {
				echo "<p>Successfully created the inventory table.</p>";
			}
}
			$inventory_info = mysql_query ("LOAD DATA INFILE '/inventory.txt' INTO TABLE inventory")			

		?>