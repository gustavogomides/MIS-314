<?php
$totalbooks = 0;
if (isset($bookArray)) {
   // Write cookie
   setcookie($cookieName, serialize($bookArray), time() + 60 * 60 * 24 * 180);

   //Count total books in cart
   
   foreach ($bookArray as $isbn => $qty) {
      $totalbooks += $qty;
   }
   setCookie('BookCount', $totalbooks, time() + 60 * 60 * 24 * 180);
}
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



<!--End menu include -->
</div>      
         


    <div class="pageContainer">
        <div class="checkoutContent">
            
<div class="pageTitle">Your Account</div>
<p class="pageTitle2">Buying online is quick and easy!</p>

<?php
echo '
<p class="pageTitle2">  
   You have '.$totalbooks.' items in your cart.</p>';
   ?>
   <form method="post" action="checkout02.php" autocomplete="on" class="myForm">
      <div class="cartIcons">
      <div class="formGroup">
         <label for="email">Email:</label>
         <input type="email" name="email" id="email" autofocus required placeholder="Email"  />
      </div>
      <div class="formGroup">
           <label> </label>
         <input type="image" src="/sandvig/mis314/assignments/bookstore//images/proceed-to-checkout.gif" alt="Proceed to checkout" class="inputImage" />
      </div>
      </div>
   </form>

                     
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


