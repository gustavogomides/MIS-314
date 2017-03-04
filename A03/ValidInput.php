<html>
   <head>
      <title>Valid Input</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">

         <form>
            <p>Iterations:
               <input type="text" name="rows" size="5" autofocus>
               <input type="submit" value="Loop">
            </p>
         </form>
         <?php
		$rows = $_GET['rows'];
            if (!empty($rows)) {
                
                 if(is_numeric($_GET['rows']) && $rows <=10 && $rows >= 1 ){
                    echo "<table class='simpleTable' >";

		  for ($i = 0; $i < $rows ; $i++) {
			echo "<tr><td>Iteration : " . $i . "</td></tr>";
			
		  }
		  echo "</table>";
                 } 
                 else {
                    
                    echo "Please enter a number 1-10";
                 }
            }
           ?>     
      </div>
   </body>
</html>

<?php
 