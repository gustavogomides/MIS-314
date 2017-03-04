<html>
   <head>
      <title>Display Image</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">

         <h2>Display Image</h2>
         <hr />

         <form>
            <p>Please enter a number:</p>
            <input type="text" name="fname" autofocus>
            <input type="submit" value="Submit Name">
         </form>

         <?php
         //Retrieve name from querystring. Check that parameter
         //is in querystring or may get "Undefined index" error
         if (is_numeric($_GET['fname']))
         {
			 $fname = $_GET['fname'];
			 if ($fname < 1 || $fname > 6 ) {
			 echo "<h2>please enter a value between 1 and 6</h2>"; }
			  else {
          echo   "<h3>You entered ". $fname . "</h3><img src='/sandvig/images/dice/".$fname.".gif'>";
			 } 
				}
         ?>
      </div>
   </body>
</html>      