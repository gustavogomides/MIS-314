<html>
   <head>
      <title>Calculator</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">

         <h2>Calculator</h2>
         <hr />

         <form>
            <p>Please enter a number:</p>
            <input type="text" name="num1" autofocus>
            
			<p>Please enter a number:</p>
            <input type="text" name="num2" autofocus>
            <input type="submit" value="Add">
         </form>

         <?php
         //Retrieve name from querystring. Check that parameter
         //is in querystring or may get "Undefined index" error
         if (is_numeric($_GET['num1']) && is_numeric($_GET['num2']))
         {
         $num1 = $_GET['num1'];
         $num2 = $_GET['num2'];
		 
		 echo '<h1> First number :' . ($num1) . ' </h2>';
		 echo '<h1> Second number :' . ($num2 ). ' <h2>';
		 echo '<h1> sum is : '. ($num1 + $num2) . '</h2>'; 
		 }
         ?>
      </div>
   </body>
</html>      