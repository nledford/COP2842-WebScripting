<!doctype html>
<html>
<head>
<title>Online Order Form</title>
<style type="text/css">
	img {
		max-width: 100px;
		margin: 1em 1em 1em 0;
		padding: 5px;
		background: #f7f7f7;
		border: 1px solid #999;
	}
</style>
</head>
<body>
	<hgroup>
		<h1>Music Store</h1>
		<h2>Online order form</h2>
	</hgroup>
	
<?php

$ShowForm = FALSE;
$ShowLink = FALSE;

$ItemList = array(
   array("name"=>"Miles Davis - Kind of Blue",
   		 "image"=>"kindofblue", 
         "description"=>"Few recordings maintain their power to utterly intoxicate for decades as Kind of Blue does. This 1959 all-time classic is one of the monuments of jazz: So What; Freddie Freeloader; Blue in Green; All Blues , and Flamenco Sketches.",
         "price"=>19.99,
         "quantity"=>0),
   array("name"=>"John Coltrane - Blue Train",
   		 "image"=>"bluetrain",
         "description"=>"John Coltrane's most important and best selling album after 'A Love Supreme', Blue Train gets with Rudy Van Gelder for a 24-bit mastering treatment. This edition features the complete session with alternate takes included.",
         "price"=>20.98,
         "quantity"=>0),
   array("name"=>"Norah Jones - Come Away With Me",
   		 "image"=>"norahjones", 
         "description"=>"2002 debut album from the Grammy-winning singer/songwriter. The album's critical and commercial success was a breakthrough for Jones in 2002, as it reached the top of the Billboard 200 chart and several jazz charts and won 8 Grammy Awards.",
         "price"=>15.98,
         "quantity"=>0),
   array("name"=>"Charlie Parker & Dizzy Gillespie - Diz N Bird at Carnegie Hall ",
   		 "image"=>"diznbird", 
         "description"=>"This historic September 29, 1947, concert reunited Dizzy Gillespie and Charlie Parker for five stunning performances and captures 11 selections by Dizzy's big band at the peak of its powers.",
         "price"=>11.61,
         "quantity"=>0),
   array("name"=>"Katie Melua - Pictures",
   		 "image"=>"katiemelua", 
         "description"=>"Equal parts Pop, Folk and Blues, Pictures builds upon Katie's successes as one of Britain's finest female artists and shows her experimenting and growing as a songwriter extraordinaire.",
         "price"=>6.04,
         "quantity"=>0),
   array("name"=>"Dexter Gordon - Our Man in Paris",
   		 "image"=>"dextergordon",
   		 "description"=>"Recorded in 1963, this record finds tenor saxophonist Dexter Gordon at the top of his game during his Blue Note days. Leading a high-profile quartet comprised of pianist Bud Powell, drummer Kenny Clarke, and bassist Pierre Michelot, Gordon leaps through the complex 'Scrapple from the Apple' with youthful aplomb and then nestles deep inside the bluesy lyricism of 'Willow Weep for Me.'",
   		 "price"=>14.29,
   		 "quantity"=>0),
   array("name"=>"Thelonious Monk - Monk's Dream",
   		 "image"=>"monk",
    	 "description"=>"Originally released in early 1963, Monk's Dream was the first Thelonious Monk album for Columbia. At the time this was recorded (fist sessions on Halloween, 1962), he had become one of the preeminent figures in contemporary jazz.",
    	 "price"=>8.99,
    	 "quantity"=>0),
   array("name"=>"Art Blakey & The Jazz Messengers - Moanin'",
   		 "image"=>"artblakey",
   		 "description"=>"This is truly one of the great classics of hard bop, with drummer Art Blakey leading arguably his greatest Jazz Messengers lineup through a driving program that never lets up.",
   		 "price"=>9.99,
   		 "quantity"=>0),
   array("name"=>"Miles Davis Quintet - Workin' With The Miles Davis Quintet",
   		 "image"=>"davisquintet",
   		 "description"=>" Workin' presents an easygoing program that balances ballads with the blues and includes quintet performances of originals by Davis ('Four,' 'Half Nelson'), Coltrane ('Trane's Blues'), and Dave Brubeck ('In Your Own Sweet Way'); an interpretation of the standard 'It Never Entered My Mind' without saxophone; and a piano-trio version of Ahmad Jamal's 'Ahmad's Blues.' Coltrane's melancholy solo on Brubeck's tune and Garland's spry excursion on Coltrane's are two of this classic's many highlights.",
   		 "price"=>12.98,
   		 "quantity"=>0),
   array("name"=>"The Dave Brubeck Quartet - Time Out",
         "image"=>"davebrubeck",
         "description"=>"Time Out captures the celebrated jazz quartet at the height of both its popularity and its powers. Recorded in 1959, the album combines superb performances by pianist Brubeck, alto saxophonist Desmond, drummer Joe Morrello and bassist Gene Wright.",
         "price"=>9.99,
         "quantity"=>0)
);

if (isset($_POST['quantity'])) {
   if (is_array($_POST['quantity'])) {
      foreach ($_POST['quantity'] as $Index => $Qty) {
         $ItemList[$Index]["quantity"] = $Qty;
      }
   }
}
if (isset($_POST['purchace'])) { 
   $TimeMicro = microtime();
   $TimeArray = explode(" ",$TimeMicro);
   $OutName = "OnlineOrders/" . $TimeArray[1] . "." . $TimeArray[0] . ".txt";
   $OutArray = array();
   $OrderedItemCount = 0;
   foreach ($ItemList as $Index => $Info) {
      if ($Info["quantity"]>0) {
         ++$OrderedItemCount;
         $TempString=$Index . "," . $Info["name"] . "," . 
               $Info["quantity"] . "," . $Info["price"] . "," . 
               ($Info["quantity"] * $Info["price"]) . "\n";
         $OutArray[]=$TempString;
      }
   }
   if ($OrderedItemCount>0) {
      $ShowLink = TRUE;
      $result=file_put_contents($OutName,$OutArray);
      if ($result===FALSE)
         echo "<p>There was a problem saving your order.</p>\n";
      else
         echo "<p>Your order was successfully submitted.</p>\n";
   }
   else {
      echo "<p>You have not ordered anything yet.</p>\n";
      $ShowForm = TRUE;
   }
}
else {
   $ShowForm=TRUE;
   if (isset($_POST['AddItem'])) {
      if (is_array($_POST['AddItem'])) {
         $ItemsToAdd=array_keys($_POST['AddItem']);
         foreach ($ItemsToAdd as $Index) {
            ++$ItemList[$Index]["quantity"];
         }
      }
   }
   if (isset($_POST['SubtractItem'])) {
      if (is_array($_POST['SubtractItem'])) {
         $ItemsToSubtract=array_keys($_POST['SubtractItem']);
         foreach ($ItemsToSubtract as $Index) {
            --$ItemList[$Index]["quantity"];
         }
      }
   }
}

if ($ShowForm) {
   echo "<form action=\"OnlineOrders.php\" method=\"POST\">\n";
}
echo "   <table cellspacing=\"0\">\n";
echo "      <tr><th";
if ($ShowForm) {
   echo "colspan=\"2\"";
}
echo ">&nbsp;&nbsp;Qty.&nbsp;&nbsp;</th>" .
     "<th>&nbsp;&nbsp;Item&nbsp;&nbsp;</th>" .
     "<th>&nbsp;&nbsp;Unit&nbsp;Price&nbsp;&nbsp;</th>" .
     "<th>&nbsp;&nbsp;Item&nbsp;Subtotal&nbsp;&nbsp;</th></tr>\n";
$ItemCount=count($ItemList);
$TotalItems=0;
$TotalAmount=0;
$bgcolor="LightGrey";
for ($i=0;$i<$ItemCount;++$i) {
   $SubtotalAmount=$ItemList[$i]["quantity"] * $ItemList[$i]["price"];
   $UnitPrice = number_format($ItemList[$i]["price"], 2, '.', ',');
   $ItemPrice = number_format($SubtotalAmount, 2, '.', ',');
   $TotalItems+=$ItemList[$i]["quantity"];
   $TotalAmount+=$SubtotalAmount;
   echo "      <tr style=\"background-color:$bgcolor\"><td>&nbsp;&nbsp;" . 
        $ItemList[$i]["quantity"] . "<input type=\"hidden\" name=\"quantity[$i]\" value=\"" . 
        $ItemList[$i]["quantity"] . "\" />&nbsp;&nbsp;</td>";
   if ($ShowForm) {
      echo "<td>";
      if ($ItemList[$i]["quantity"]>0) {
         echo "<input style=\"width:20px;\" type=\"submit\" name=\"SubtractItem[$i]\" value=\"-\" /><br />";
      }
      echo "<input style=\"width:20px;\" type=\"submit\" name=\"AddItem[$i]\" value=\"+\" /></td>";
   }
   
   echo "<td><img src='images/" . $ItemList[$i]["image"] . ".jpg'></td>";
   
   echo "<td>&nbsp;&nbsp;<strong>" .
            $ItemList[$i]["name"] . "</strong>&nbsp;&nbsp;<br />&nbsp;&nbsp;" . $ItemList[$i]["description"] . 
            "&nbsp;&nbsp;</td><td align=\"right\">&nbsp;&nbsp;$UnitPrice&nbsp;&nbsp;</td><td align=\"right\">&nbsp;&nbsp;$ItemPrice&nbsp;&nbsp;</td></tr>\n";
      if ($bgcolor=="Silver")
         $bgcolor="LightGrey";
      else
         $bgcolor="Silver";
   }
   if ($TotalItems>0) {
      $TotalPrice = number_format($TotalAmount, 2, '.', ',');
      echo "      <tr><td colspan=\"2\">&nbsp;&nbsp;<strong>$TotalItems</strong>&nbsp;&nbsp;</td>";
      echo "<td ";
      if ($ShowForm) {
         echo "colspan=\"2\"";
      }
      echo "align=\"right\">&nbsp;&nbsp;<strong>Total =&gt;</strong>&nbsp;&nbsp;" . 
            "</td><td align=\"right\">&nbsp;&nbsp;<strong>\$&nbsp;$TotalPrice</strong>&nbsp;&nbsp;</td></tr>\n";
   }
   echo "   </table>\n";
   echo "   <br />\n";
if ($ShowForm) {
   if ($TotalItems>0) {
      echo "   <input type=\"submit\" name=\"purchace\" value=\"Place Order\" />\n";
   }
   echo "</form>\n";
}
if ($ShowLink) {
   echo "   <a href=\"OnlineOrders.php\">Place another order</a>\n";
}
?>
</body>
</html>

