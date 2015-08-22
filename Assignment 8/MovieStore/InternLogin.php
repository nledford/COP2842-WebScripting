
<html >
<head>
<title>Fabulous Hulk Movie Store</title>

</head>
<body>
<h1>Movie Store</h1>
<h2>Customer Register / Log In</h2>
<p>New fabulous customers, please complete the top form to
register as a user. Returning fabulous customers, please complete 
the second form to log in.</p>
<hr />
<h3>New Customer Registration</h3>
<form method="POST" action="RegisterIntern.php">
<p>Enter your name: First 
     <input type="text" name="first" />
Last: 
     <input type="text" name="last" /></p>
<p>Enter your email address: 
     <input type="text" name="email" /></p>
<p>Enter a password for your account:
     <input type="password" name="password" /></p>
<p>Confirm your password:
     <input type="password" name="password2" /></p>
<p><em>(Passwords are case-sensitive and 
     must be at least 6 characters long)</em></p>
<input type="reset" name="reset" 
     value="Reset Registration Form" />
<input type="submit" name="register" value="Register" />
</form>
<hr />
<h3>Returning Customer Login</h3>
<form method="POST" action="VerifyLogin.php">
<p>Enter your email address: 
     <input type="text" name="email" /></p>
<p>Enter your password:
     <input type="password" name="password" /></p>
<p><em>(Passwords are case-sensitive and 
     must be at least 6 characters long)</em></p>
<input type="reset" name="reset" 
     value="Reset Login Form" />
<input type="submit" name="login" value="Log In" />
</form>
<hr />

</body>
</html>

