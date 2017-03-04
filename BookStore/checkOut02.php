


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
      //connect to databaseConnection
	  $email = $_POST[email];
	  $isValid =  fIsValidEmail($email);
      $link = fConnectToDatabase();
	  $sql = "SELECT * FROM bookCustomers WHERE email = '$email'"; 
	   $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));
			  
	  $row = mysqli_fetch_array($result);
	  $custIDe;
	  $newCustomer;
	  if (mysqli_num_rows($result) == 0 ) {
		  $newCustomer = true;
echo "New Customer - Please provide your shipping address.";
}
else {
	$newCustomer = false;
	$custIDe = encrypt($row[custID], $secretPassword);
echo "Returning Customer - Please confirm your mailing and e-mail addresses."; 


}

      //Retrieve parameters from querystring and sanitize
     
      

      //List records
     
        
 if (!$isValid) {
echo "<p>Please provide a valid e-mail address.<br><br><input class='returnButton' style='width:200px;' type='button' value='<< Go Back <<' onClick='history.back()'><br></p>
";
 } else {
  
	 echo '

     <div class="pageTitle">Shipping Information</div>


   <form method="post" action="checkout03.php" autocomplete="on" class="myForm">

      <div class="formGroup">
         <label for="email">
            Email: </label>

         <input type="email" name="email" value="'.$email.'" required placeholder="Enter Email" maxlength="50" />
      </div>

      <div class="formGroup">
         <label for="fname">
            First name: </label>
         <input type="text" name="fname" value="'.$row[fname].'" autofocus required  
                placeholder="First name" title="first name" maxlength="20" pattern="[A-Za-z\'-]{2,20}" />
      </div>
      <div class="formGroup">
         <label for="lname">
            Last name: </label>
         <input type="text" name="lname" value="'.$row[lname].'" required 
                placeholder="Last name" title="last name" maxlength="20" pattern="[A-Za-z\'-]{2,20}" />
      </div>
      <div class="formGroup">
         <label for="street">
            Street: </label>
         <input type="text" name="street" value="'.$row[street].'" required 
                placeholder="Street address" title="street address" maxlength="25" />
      </div>
      <div class="formGroup">
         <label for="city">
            City:</label>
         <input type="text" name="city" value="'.$row['city'].'" required 
                placeholder="City" title="city" maxlength="30"  pattern="[A-Za-z\'-]{2,30}" />
      </div>
      <div class="formGroup">
         <label for="state">
            State:</label>
         <td>
            <input type="text" name="state" style="width:40px" value="'.$row['state'].'" required 
                   placeholder="ST" title="2-character state abbreviation" max length="2" pattern="[A-Za-z]{2}" />
      </div>
      <div class="formGroup">
         <label for="zip">
            Zip: </label>
         <input type="text" name="zip" style="width:80px;" value="'.$row['zip'].'" required 
                placeholder="Zip" title="zip" maxlength="5" pattern="[0-9]{5}" />
      </div>
      <div class="formGroup">
         <label></label>

         <input type="hidden" name="custIDe" value="'.$custIDe.'">
		 <input type="hidden" name="newCustomer" value="'.$newCustomer.'">
         <input class="inputImage" type="image" src="/sandvig/mis314/assignments/bookstore//images/buy-now.gif">
      </div>
   </form>
   <br>
   
<!-- must use method post to transfer encrypted custID. Cannot transfer in query string due to URL encoding -->';
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


