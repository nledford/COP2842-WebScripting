
<html >
<head>
<title>Available Movies</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<h1>Fabulous Hulk Movie Store</h1>
<h2>Available Movies</h2>
<?php
if (isset($_REQUEST['customerID']))
     $InternID = $_REQUEST['customerID'];
else
     $InternID = -1;
$errors = 0;
$DBConnect = @mysql_connect("localhost", "root", "root");
if ($DBConnect === FALSE) {
     echo "<p>Unable to connect to the database server. " . 
          "Error code " . mysql_errno() . ": " . 
          mysql_error() . "</p>\n";
     ++$errors;
}
else {
     $DBName = "MovieStore";
     $result = @mysql_select_db($DBName, $DBConnect);
     if ($result === FALSE) {
          echo "<p>Unable to select the database. " . 
               "Error code " . mysql_errno($DBConnect) . ": " .
               mysql_error($DBConnect) . "</p>\n";
          ++$errors;
     }
}
$TableName = "customers";
if ($errors == 0) {
     $SQLstring = "SELECT * FROM $TableName WHERE " .
               " customerID='$InternID'";
     $QueryResult = @mysql_query($SQLstring, $DBConnect);
     if ($QueryResult === FALSE) {
          echo "<p>Unable to execute the query. " . 
               "Error code " . mysql_errno($DBConnect) . ": " .
               mysql_error($DBConnect) . "</p>\n";
          ++$errors;
     }
     else {
          if (mysql_num_rows($QueryResult) == 0) {
               echo "<p>Invalid Customer ID!</p>";
               ++$errors;
          }
     }
}
if ($errors == 0) {
     $Row = mysql_fetch_assoc($QueryResult);
     $InternName = $Row['FIRST'] . " " . $Row['last'];
} else
     $InternName = "";
$TableName = "assigned_movies";
$ApprovedOpportunities = 0;
$SQLstring = "SELECT COUNT(movieID) FROM $TableName " .
          " WHERE customerID='$InternID' " .
          " AND date_approved IS NOT NULL";
$QueryResult = @mysql_query($SQLstring, $DBConnect);
if (mysql_num_rows($QueryResult) > 0) {
     $Row = mysql_fetch_row($QueryResult);
     $ApprovedOpportunities = $Row[0];
     mysql_free_result($QueryResult);
}
$SelectedOpportunities = array();
$SQLstring = "SELECT movieID FROM $TableName " .
          " WHERE customerID='$InternID'";
$QueryResult = @mysql_query($SQLstring, $DBConnect);
if (mysql_num_rows($QueryResult) > 0) {
     while (($Row = mysql_fetch_row($QueryResult)) !== FALSE)
          $SelectedOpportunities[] = $Row[0];
     mysql_free_result($QueryResult);
}
$AssignedOpportunities = array();
$SQLstring = "SELECT movieID FROM $TableName " .
          " WHERE date_approved IS NOT NULL";
$QueryResult = @mysql_query($SQLstring, $DBConnect);
if (mysql_num_rows($QueryResult) > 0) {
     while (($Row = mysql_fetch_row($QueryResult)) !== FALSE)
          $AssignedOpportunities[] = $Row[0];
     mysql_free_result($QueryResult);
}
$TableName = "movies";
$Opportunities = array();
$SQLstring = "SELECT movieID, name, genre, description " .
          " FROM $TableName";
$QueryResult = @mysql_query($SQLstring, $DBConnect);
if (mysql_num_rows($QueryResult) > 0) {
     while (($Row = mysql_fetch_assoc($QueryResult)) !== FALSE)
          $Opportunities[] = $Row;
     mysql_free_result($QueryResult);
}
mysql_close($DBConnect);

echo "<table border='1' width='100%'>\n";
echo "<tr>\n";
echo "     <th style='background-color:cyan'>Title</th>\n";
echo "     <th style='background-color:cyan'>Genre</th>\n";
echo "     <th style='background-color:cyan'>Description</th>\n";
echo "     <th style='background-color:cyan'>Status</th>\n";
echo "</tr>\n";
foreach ($Opportunities as $Opportunity) {
     if (!in_array($Opportunity['movieID'],
               $AssignedOpportunities)) {
          echo "<tr>\n";
          echo "     <td>" . 
                    htmlentities($Opportunity['name']) . 
                    "</td>\n";
          echo "     <td>" . 
                    htmlentities($Opportunity['genre']) . 
                    "</td>\n";
          echo "     <td>" . 
                    htmlentities($Opportunity['description']) . 
                    "</td>\n";
          echo "     <td>";
          if (in_array($Opportunity['movieID'],
                    $SelectedOpportunities))
               echo "Selected";
          else {
               if ($ApprovedOpportunities>0)
                    echo "Open";
               else
                    echo "<a href='RequestOpportunity.php?" .
                         "customerID=$InternID&" .
                         "movieID=" . 
                         $Opportunity['movieID'] .
                         "'>Available</a>";
          }
          echo "</td>\n";
          echo "</tr>\n";
     }
}
echo "</table>\n";
echo "<p><a href='InternLogin.php'>Log Out</a></p>\n";

?>
</body>
</html>

