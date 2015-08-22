<?php
$Body = "";
$errors = 0;
$InternID = 0;
if (isset($_GET['customerID']))
     $InternID = $_GET['customerID'];
else {
     $Body .= "<p>You have not logged in or registered. " .
               " Please return to the " .
               " <a href='InternLogin.php'>Registration / " .
               " Log In page</a>.</p>";
     ++$errors;
}
if ($errors == 0) {
     if (isset($_GET['movieID']))
          $OpportunityID = $_GET['movieID'];
     else {
          $Body .= "<p>You have not selected a movie. " .
                    " Please return to the " .
                    " <a href='AvailableOpportunities.php?" .
                    "customerID=$InternID'>Available " .
                    " Movies page</a>.</p>";
          ++$errors;
     }
}
if ($errors == 0) {
     $DBConnect = @mysql_connect("localhost", "root", "root");
     if ($DBConnect === FALSE) {
          $Body .= "<p>Unable to connect to the database " .
               " server. Error code " . mysql_errno() . ": " .
               mysql_error() . "</p>\n";
          ++$errors;
     }
     else {
          $DBName = "MovieStore";
          $result = @mysql_select_db($DBName, $DBConnect);
          if ($result === FALSE) {
               $Body .=  "<p>Unable to select the database. " .
                    "Error code " . mysql_errno($DBConnect) .
                    ": " . mysql_error($DBConnect) . "</p>\n";
               ++$errors;
          }
     }
}
$DisplayDate = date("l, F j, Y, g:i A");
$DatabaseDate = date("Y-m-d H:i:s");
if ($errors == 0) {
     $TableName = "assigned_movies";
     $SQLstring = "INSERT INTO $TableName " .
               " (movieID, customerID, " .
               " date_selected) VALUES " .
               " ($OpportunityID, $InternID, " .
               " '$DatabaseDate')";
     $QueryResult = @mysql_query($SQLstring, $DBConnect) ;
     if ($QueryResult === FALSE) {
          $Body .= "<p>Unable to execute the query. " .
               " Error code " . mysql_errno($DBConnect) .
               ": " . mysql_error($DBConnect) . "</p>\n";
          ++$errors;
     }
     else {
          $Body .= "<p>Your request for movie # " .
                    " $OpportunityID has been entered " .
                    " on $DisplayDate.</p>\n";
     }
     mysql_close($DBConnect);
}
if ($InternID > 0)
     $Body .= "<p>Return to the <a href='" .
              "AvailableOpportunities.php?customerID=$InternID'>" .
              "Available Movies</a> page.</p>\n";
else
     $Body .= "<p>Please <a href='InternLogin.php'>Register " .
               " or Log In</a> to use this page.</p>\n";
if ($errors == 0)
     setcookie("LastRequestDate", 
               urlencode($DisplayDate),
               time()+60*60*24*7);
?>

<html >
<head>
<title>Request Movie</title>

</head>
<body>
<h1>Fabulous Hulk Movie Store</h1>
<h2>Movie Requested</h2>
<?php
     echo $Body;
?>

</body>
</html>

