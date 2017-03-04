<html>
   <head>
      <title>Guess Game</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">

         <h2>Guess Game</h2>
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
            $intGuess = $_GET['fname'];
            echo "<h1> Your guess of $intGuess is ";
			if ($intGuess < 4) {
		 echo 'very low';}
		 elseif ($intGuess < 7){
		 echo 'low'; }
		 elseif ($intGuess == 7){
		 echo 'correct!';}
		 elseif ($intGuess <= 10) {
		 echo 'High'; }
		 elseif ($intGuess > 10){
		 echo 'Very High';}
		echo '<h1>';
         }
		 
         ?>
      </div>
   </body>
</html>      