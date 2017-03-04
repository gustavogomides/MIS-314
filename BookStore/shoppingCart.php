
<?php
include_once("databaseConnection.php");
$link = fConnectToDatabase();

//Shopping cart uses cookies to store cart items.
//PHP script uses an array for adding, removing and displaying the cart items.
//Cookies can contain only string data so array must be serialized.

$cookieName = "myCart2";
// retrieve cookie and unserialize into $bookArray
if (isset($_COOKIE[$cookieName])) {
   $bookArray = unserialize($_COOKIE[$cookieName]);
}
// Add items to cart
$addISBN = fCleanString($link, $_GET['addISBN'], 10);
if (strlen($addISBN) > 0) {
   if (isset($addISBN, $bookArray)) {
      // Increment by +1
      $bookArray[$addISBN] += 1;
   } else {
      // Add new item to cart
      $bookArray[$addISBN] = 1;
   }
}
// Remove items from cart
$deleteISBN = fCleanString($link, $_GET['deleteISBN'], 10);
if (strlen($deleteISBN) > 0) {
   if (isset($bookArray[$deleteISBN])) {
      // Deincrement by 1
      $bookArray[$deleteISBN] -= 1;
      // remove ISBN from array if qty==0
      if ($bookArray[$deleteISBN] == 0) {
         unset($bookArray[$deleteISBN]);
      }
   }
}
if (isset($bookArray)) {
   // Write cookie
   setcookie($cookieName, serialize($bookArray), time() + 60 * 60 * 24 * 180);

   //Count total books in cart
   $totalbooks = 0;
   foreach ($bookArray as $isbn => $qty) {
      $totalbooks += $qty;
   }
   setCookie('BookCount', $totalbooks, time() + 60 * 60 * 24 * 180);
}
//***************************************************
//You do not need to modify any code above this point
//***************************************************
?>

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

<? include_once("Menu.php") ?>


<!--End menu include -->
</div>        <div class="pageContent">
            <?php
      //include database connection
      include_once("databaseConnection.php");

      //connect to database
      $link = fConnectToDatabase();

      //Retrieve parameters from querystring and sanitize
     
      

      //List records
     
         
              
		
			  
		
		
         // iterate through the retrieved records
        
               //To do:
               // 1. Build sql statement containing ISBNs. Use foreach loop.
               // 2. Execute sql and display book titles, prices, qty, etc.
               if (count($bookArray)) {
                  echo "<table id='cart'><tr><th>Title</th><th>Qty</th><th>Price</th><th>Total</th><th>Add/Remove</th></tr>";
                  $Subtot = 0;
				  $Shipping = 0;
				  $Bookcount = 0;
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
                        <td>
                           <a href='?addISBN=$isbn'>Add</a><br>
                           <a href='?deleteISBN=$isbn'>Remove</a>
                        </td>
					
                           
                     </tr>";
					 $shipping = ($Bookcount -1) *3 +5;
					 

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
            <a href="index.php"> <img border="0" src="/sandvig/mis314/assignments/bookstore/images/continue-shopping.gif" width="121" height="19" alt="Continue shopping" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="checkout01.php"> <img border="0" src="/sandvig/mis314/assignments/bookstore/images/proceed-to-checkout.gif" width="183" height="31" alt="Proceed to checkout"  ></a>
           </div>
	';
               }
              
   
      
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


