


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>GeekBooks - MIS 314 Sample Bookstore</title>
    <link rel="stylesheet" href="http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/StyleSheet.css" type="text/css" />
    </head>
<body>
    <!--Begin header include -->
   <!-- non-mobile header -->
 <? include_once("Header.php") ?>

<!--End header include -->



    <div class="pageContainer">
        <div class="leftColumn">

<!--Begin menu include -->




<!--End menu include -->
</div>        <div class="pageContent">
            <?php
      //include database connection
      include_once("databaseConnection.php");
	  include_once("validationUtilities.php");
	  include_once("encryption.php");
	  $newCustomer = $_POST[newCustomer];
	  $custIDe = $_POST[custIDe];
	  $custID = decrypt($custIDe, $secretPassword);
      //connect to databaseConnection
	  $email = $_POST[email];
	  $lname = $_POST[lname];
	  $fname = $_POST[fname];
	  $zip = $_POST[zip];
	  $state = $_POST[state];
	  $city = $_POST[city];
	  $street = $_POST[street];
	  if (!fIsValidStateAbbr($state)){
		  echo "Please provide a valid state!";
		  $isValid = false;
	  }
	  if (!fIsValidLength($fname, 0, 15)){
		  echo "Please provide a valid first name!";
		  $isValid = false;
	  }
	 if (!fIsValidLength($lname, 0, 15)){
		  echo "Please provide a valid last name!";
		  $isValid = false;
	  }
	  if (!fIsValidLength($street, 0, 15)){
		  echo "Please provide a valid last name!";
		  $isValid = false;
	  }
		  if (!fIsValidLength($city, 0, 15)){
		  echo "Please provide a valid last name!";
		  $isValid = false;
		  }
		  if (!fIsValidZip($zip)){
		  echo "Please provide a valid last name!";
		  $isValid = false;
		  }
	  if (!fIsValidEmail($email)){
		  $isValid = false;
	  }
      $link = fConnectToDatabase();
	  if ($newCustomer ){
		  
	  $sql = "INSERT INTO bookcustomers (fname, lname, zip, state, city, street, email)
	  values ('$fname', '$lname', $zip, '$state', '$city', '$street', '$email')";
	  $result = mysqli_query($link, $sql)
              or die('SQL INSERT syntax error: ' . mysqli_error($link));
			  $custID =  mysqli_insert_id($link);
			  
	  }
	  else {
		  $sql = "UPDATE bookcustomers SET fname = '$fname', lname = '$lname', zip = '$zip', 
		  state = '$state', city = '$city',
		  street = '$street', email = '$email'  WHERE custID = $custID";
		  $result = mysqli_query($link, $sql)
              or die('SQL UPDATE syntax error: ' . mysqli_error($link));
			  
	  }
	 
	  $cookieName = "myCart2";
	  $bookArray;
// retrieve cookie and unserialize into $bookArray
	if (isset($_COOKIE[$cookieName])) {
		$bookArray = unserialize($_COOKIE[$cookieName]);
		setcookie($cookieName, null, time()-60000);
}
	$orderdate = time ();


	$sql = "INSERT INTO bookorders (CustID, orderdate) values ('$custID', '$orderdate')";
	$result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));
			  $orderID = mysqli_insert_id($link);
	foreach ($bookArray as $isbn => $qty) {
	$discount = 0.8;
	$sql = "INSERT INTO bookorderitems (orderID, isbn, qty, price) VALUES 
	($orderID, '$isbn', $qty, (select (price * $discount) from bookdescriptions where ISBN = '$isbn'))";
	   $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));
			 
	}
	  
echo "<table id='cart'><tr>
      <td class='boldLabel'>
         Order Number:</td>
      <td>
      ".$orderID."
      </td>
   </tr>

   <tr>
      <td valign='top' class='boldLabel'>
         Shipping Address:</td>
      <td >
        ".$fname." ".$lname."<br>
        ".$street."<br>
        ".$city.", ".$state."  ".$zip."<br>

      </td>
   </tr>

 
   ";

if (count($bookArray)) {
                  echo "<tr><th>Title</th><th>Qty</th><th>Price</th><th>Total</th></tr>";
                  $Subtot = 0;
				  $Shipping = 0;
				  $Bookcount = 0;
				  $body = "<html>Thank you for your order! <br> Here is your order confirmation: <br>".$orderID."
				  :Order ID <br> Shipping Address <br> ".$fname." ".$lname." <br>".$street."<br> ".$city.", ".$state." ".$zip."<br>";
				  foreach ($bookArray as $isbn => $qty) {
					  $sql = "SELECT isbn, title, price
			FROM bookdescriptions
			WHERE isbn='".$isbn."'";
			 $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));
			  $row = mysqli_fetch_array($result); 
			  $title = $row[title];
			  $price = $row[price];
			  $total = $price * $qty;
			  $Subtot = $Subtot + $total;
			 
			 $Bookcount = $qty + $Bookcount;
                     echo "
                     <tr>
                        <td>
                           <a class='booktitle' href='ProductPage.php?isbn=$isbn'>$title</a> </td>
                        <td>$qty</td><td>$price</td><td>$total</td>
                        
					
                           
                     </tr>";
					 $shipping = ($Bookcount -1) *3 +5;
				$body = $body . "Book Title : " . $title ." Price: ". $price ." Quantity: ".$qty. "<br>";				

            }
			echo ' <table class="cartTotal">
          <tr>
            <td> Sub-Total:</td>
            <td align="right">$'.$Subtot.'</td>
          </tr>
              <tr>
            <td> Shipping:*</td>
            <td align="right">$'.$shipping.'</td>
          </tr>
          <tr>
            <td><b>Total:</b></td>
            <td align="right"><b>$'.($shipping + $Subtot).'</b></td>
          </tr>
        </table> 
	  <div class="cartIcons">
             <form method="post" action="orderHistory.php" style="max-width: 300px;">
      <input type="submit" class="button" value="View Your Order History" />
      <input type="hidden" name="custIDe" value='.$custIDe.' />
   </form>

           </div>
	';
	$body .= "SubTotal:$ " .$Subtot. "<br>Shipping:$ ".$shipping."<br>Grand Total:$ ".($shipping + $Subtot). "
	<br>Total books ordered: " .$Bookcount. "</html>";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .="Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .="From: ianbrooks77@comcast.net" . "\r\n";
	mail($email, "Your Recent Order From Ian's Coding Books Emporium!" ,$body, $headers);
               }
              


      //Retrieve parameters from querystring and sanitize
     
      

      //List records
     
        
 
?>
                
        </div> 
        <!-- end content -->
        
    <!--Begin footer include -->
<? include_once("Footer.php") ?>
<!--End footer include -->
    </div>
    
    <!-- Sample site uses a MasterPage-like template for page layout. -->
    <!-- This is not required. It may be used as an enhancement. -->
    <!-- Source: http://spinningtheweb.blogspot.com/2006/07/approximating-master-pages-in-php.html -->
</body>
</html>


