
<html >
<head>
<title>Verify Customer Login</title>
<
</head>
<body>
<h1>Fabulous Hulk Movie Store</h1>
<h2>Verify Customer Login</h2>
<?php
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
               "Error code " . mysql_errno($DBConnect) . 
               ": " . mysql_error($DBConnect) . "</p>\n";
          ++$errors;
     }
}
$TableName = "customers";
if ($errors == 0) {
     $SQLstring = "SELECT customerID, first, last FROM $TableName "
          . " where email='" . stripslashes($_POST['email']) . 
          "' and password_md5='" . 
          md5(stripslashes($_POST['password'])) . "'";
     $QueryResult = @mysql_query($SQLstring, $DBConnect);
     if (mysql_num_rows($QueryResult)==0) {
          echo "<p>The email address/password " . 
               " combination entered is not valid.</p>\n";
          ++$errors;
     }
     else {
          $Row = mysql_fetch_assoc($QueryResult);
          $InternID = $Row['customerID'];
          $InternName = $Row['first'] . " " . $Row['last'];
          echo "<p>Welcome back, $InternName!</p>\n";     }
}
if ($errors > 0) {
     echo "<p>Please use your browser's BACK button to return " .
          " to the form and fix the errors indicated.</p>\n";
}
echo "<p><a href='AvailableOpportunities.php?" .
          "customerID=$InternID'>Available " .
          " Movies</a></p>\n";

?>
</body>
</html>

