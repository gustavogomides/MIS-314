<html>
   <head>
      <title>Select Color</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
	  <?php
	  //must arrive from order02.php
		$referrer = $_SERVER['HTTP_REFERER'];
		if (stripos($referrer, 'order01.php') == false) header("location:order01.php");
	  ?>
   </head>
   <body>
      <div class="pageContainer">

         <h2 class="centerText">Select Color</h2>

         
   
   <?php
   include 'validationUtilities.php';
   
   $fname = $_GET['fname'];
   $model = $_GET['model'];
   
   $IsValid = true;
   
   if (!fIsValidLength($fname, 2, 20)){
	   echo "Enter a valid name.";
	   $IsValid = false;
   }
   
   setcookie('fname', $fname, time() + 60*60*24);
   setcookie('model', $model, time() + 60*60*24);
   
   if (!fIsValidLength($model, 2, 20)){
		echo "Enter a valid model.";
		$IsValid = false;
   }
   
   if (!$IsValid){
	   exit();
   } else {
	   
	   echo '
	   
	   <form action="Order03.php" class="formLayout">
            
            <div class="formGroup">
               <label> Car Color:</label>
               <div class="formElements">
				  <select name="color" required>
					<option style="background-color: blue; color:white;" value="blue">Blue</option>
					<option style="background-color: red" value="red">Red</option>
					<option style="background-color: yellow" value="yellow">Yellow</option>
				  </select>
               </div>

            </div>
            <div class="formGroup">
               <label></label>
               <button type="submit"> >> Next >> </button>

            </div>
            <div class="centerText vertGap55">
                              <button type="submit" formnovalidate>Submit without validation</button>
                              <br><br>
            <a href="?">Reload page</a>            
            </div>


      </div>

   </form>
   
   ';
	   
   }
   
   ?>

</div>
</body>
</html>