<html>
   <head>
      <title>Random Image</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">

         <h2>Random Image</h2>
         <hr />

        
         <?php
         //Retrieve name from querystring. Check that parameter
         //is in querystring or may get "Undefined index" error
         
            $num1 = rand (1,6);
			$num2 = rand (1,6);
          echo   "<img src='/sandvig/images/dice/".$num1.".gif'>";
         echo   "<img src='/sandvig/images/dice/".$num2.".gif'>"; 
		 echo '<h1>sum is:' . ($num1 + $num2) . ' </h1>';
         ?>
      </div>
   </body>
</html>      