<?php
session_start();
require_once("class_OnlineStore.php");
$storeID = "NOVELTY";
$storeInfo = array();
if (class_exists("OnlineStore")) {
     if (isset($_SESSION['currentStore']))
          $Store = unserialize($_SESSION['currentStore']);
     else {
          $Store = new OnlineStore();
     }
     $Store->setStoreID($storeID);
     $storeInfo = $Store->getStoreInformation();
     $Store->processUserInput();
}
else {
     $ErrorMsgs[] = "The OnlineStore class is not available!";
     $Store = NULL;
}
?>
<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $storeInfo['name']; ?></title>
<meta http-equiv="content-type"
content="text/html; charset=iso-8859-1" />
		<style type="text/css">
			body {
				background: #f7f7f7;
				color: #393939;
				line-height: 1.4em;
			}
			
			h1, h2, h3 {
				text-align: center;
			}
			
			table {
				margin: 0 auto;
			}
			
			table tr:nth-child(even){
				background: #fff;
			}
			
			table tr:nth-child(odd) {
				background: #eee;
			}
			
			table td {
				padding: 3px 5px;
			}
			
			footer {
				text-align: center;
				margin: 1em auto;
			}
		</style>
</head>
<body>

<span style="font: 12px;"><a href="../index.html">Return to home</a></span>

<h1><?php echo htmlentities($storeInfo['name']); ?></h1>
<h2><?php echo htmlentities($storeInfo['description']); ?></h2>
<p><?php echo htmlentities($storeInfo['welcome']); ?></p>
<?php
$Store->getProductList();
$SESSION['currentStore'] = serialize($store);
?>
</body>
</html>