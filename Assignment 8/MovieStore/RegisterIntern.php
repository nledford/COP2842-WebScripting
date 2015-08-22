<?php

//Nate Ledford and Jen Garcia worked on this together

/* We have modified the script so that it will check if the MovieStore database exists.
 * If it does not exist, the script will create the database, select it, and insert relevant
 * information into the database.  It will then continue the registration process as normal
 */

$Body = "";
$errors = 0;
$email = "";


if (empty($_POST['email'])) {
     ++$errors;
     $Body .= "<p>You need to enter an email address.</p>\n";
}
else {
     $email = stripslashes($_POST['email']);
     if (preg_match("/^[\w-]+(\.[\w-]+)*@" .
               "[\w-]+(\.[\w-]+)*(\.[a-zA-Z]{2,})$/i",
               $email) == 0) {
          ++$errors;
          $Body .= "<p>You need to enter a valid " .
               " email address.</p>\n";
          $email = "";
     }
}
if (empty($_POST['password'])) {
     ++$errors;
     $Body .= "<p>You need to enter a password.</p>\n";
     $password = "";
}
else
     $password = stripslashes($_POST['password']);
if (empty($_POST['password2'])) {
     ++$errors;
     $Body .= "<p>You need to enter a confirmation password.</p>\n";
     $password2 = "";
}
else
     $password2 = stripslashes($_POST['password2']);
if ((!(empty($password))) && (!(empty($password2)))) {
     if (strlen($password) < 6) {
          ++$errors;
          $Body .= "<p>The password is too short.</p>\n";
          $password = "";
          $password2 = "";
     }
     if ($password <> $password2) {
          ++$errors;
          $Body .= "<p>The passwords do not match.</p>\n";
          $password = "";
          $password2 = "";
     }
}
if ($errors == 0) {
     $DBConnect = @mysql_connect("localhost", "root", "root");
     if ($DBConnect === FALSE) {
          $Body .= "<p>Unable to connect to the database server. " .
               "Error code " . mysql_errno() . ": " .
               mysql_error() . "</p>\n";
          ++$errors;
     } 
     else {
          $DBName = "MovieStore";
          
          
          
          $result = @mysql_select_db($DBName, $DBConnect);
          if ($result === FALSE) {
          	mysql_query('create database MovieStore');
          	mysql_select_db('MovieStore');
          	
          	mysql_query('create table customers' .
          				'(customerID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,' .
          				'email VARCHAR(40), password_md5 VARCHAR(32),' . 
          				'first VARCHAR(30), last VARCHAR(30))');
          				
          	mysql_query('CREATE TABLE movies (movieID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(40), genre VARCHAR(25), description VARCHAR(250))');
          	
          	mysql_query('CREATE TABLE assigned_movies (movieID SMALLINT, customerID SMALLINT, date_selected DATE, date_approved DATE)');
          	
          	mysql_query("INSERT INTO movies (name, genre, description) VALUES('Fist of Fury','Action','Chen Zhen returns to the international compound of China only to learn of his beloved teachers death.'),
('The French Connection','Action','A pair of NYC cops in the Narcotics Bureau stumble onto a drug smuggling job with a French connection.'),
('City Lights','Comedy','City Lights is about a penniless man who falls in love with a flower girl.'),
('Berlin Calling','Comedy','A man tours clubs around the globe with his manager and girlfriend.'),
('Moskva Slezam Ne Veri','Foreign','This is a life story of three girlfriends from youth to autumn ages. Their dreams and wishes, love, disillusions.'),
('The Twilight Samurai','Foreign','Seibei Iguchi leads a difficult life as a low ranking samurai at the turn of the nineteenth century.'),
('The Bride of Frankenstein','Horror','Bride of Frankenstein begins where James Whales Frankenstein from 1931 ended. Dr. Frankenstein has not been killed as previously portrayed and now he wants to get away from the mad experiments.'),
('The Texas Chainsaw Massacre','Horror','The only known survivor of a 1973 killing spree, dubbed The Texas Chainsaw Massacre, breaks her silence and comes forward to tell the real story of what happened on that bloody day.'),
('Talk to Her','Romance','Director Pedro Almodovar tells a story of loneliness, intimacy, secrets, infidelity and the difficulty of communication between sexes.'),
('The Dreamers','Romace','A young American studying in Paris in 1968 strikes up a friendship with a French brother and sister.')");
          	
               /*$Body .= "<p>Unable to select the database. " .
                    "Error code " . mysql_errno($DBConnect) . 
                    ": " . mysql_error($DBConnect) . "</p>\n";
               ++$errors;*/
          }
     } 
}
$TableName = "customers";
if ($errors == 0) {
     $SQLstring = "SELECT count(*) FROM $TableName" .
          "where email=$email";
     $QueryResult = @mysql_query($SQLstring, $DBConnect);
     if ($QueryResult !== FALSE) {
          $Row = mysql_fetch_row($QueryResult);
          if ($Row[0]>0) {
               $Body .= "<p>The email address entered (" .
                    htmlentities($email) . 
                    ") is already registered.</p>\n";
               ++$errors;
          }
     }
}
if ($errors > 0) {
     $Body .= "<p>Please use your browser's BACK button to return " .
          " to the form and fix the errors indicated.</p>\n";
}
if ($errors == 0) {
     $first = stripslashes($_POST['first']);
     $last = stripslashes($_POST['last']);
     $SQLstring = "INSERT INTO $TableName " .
               " (first, last, email, password_md5) " .
               " VALUES( '$first', '$last', '$email', " .
               " '" . md5($password) . "')";
     $QueryResult = @mysql_query($SQLstring, $DBConnect);
     if ($QueryResult === FALSE) {
          $Body .= "<p>Unable to save your registration " .
               " information. Error code " .
               mysql_errno($DBConnect) . ": " . 
               mysql_error($DBConnect) . "</p>\n";
          ++$errors;
     }
     else {
          $InternID = mysql_insert_id($DBConnect);
     }
     setcookie("customerID", $InternID);
     mysql_close($DBConnect);
}
if ($errors == 0) {
     $InternName = $first . " " . $last;
     $Body .= "<p>Thank you, $InternName. ";
     $Body .= "Your new Customer ID is <strong>" .
          $InternID . "</strong>.</p>\n";
}
if ($errors == 0) {
     $Body .= "<form method='post' " .
               " action='AvailableOpportunities.php'>\n";
     $Body .= "<input type='hidden' name='customerID' " .
               " value='$InternID'>\n";
     $Body .= "<input type='submit' name='submit' " .
               " value='View Available Opportunities'>\n";
     $Body .= "</form>\n";
}

?>

<html >
<head>
<title>New Customer Registration</title>

</head>
<body>
<h1>Fabulous Hulk Movie Store</h1>
<h2>Customer Registration</h2>
<?php
echo $Body;
?>
</body>
</html>

