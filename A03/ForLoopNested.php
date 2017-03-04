<html>
   <head>
      <title>For Loop Nested</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">

         <h2>For Loop</h2><hr>

         <form>
            
            Rows:
    <input type="text" name="rows" size="5">
    <br><br>
    Columns:
    <input type="text" name="cols" size="5">
    <br><br>
    <input type="submit" value="Loop">
</form>


         </form>

          <?php 
		  if (is_numeric($_GET['rows']) && is_numeric($_GET['cols'])) 
         {
            $rows = $_GET['rows'];
			 $cols= $_GET['cols'];
			echo "<table class='simpleTable' >";

		  for ($i = 0; $i < $rows ; $i++) {
			  echo "<tr>";
			  for ($x = 0; $x <$cols ; $x++) {
				 
				echo "<td>Columns : " . $x . "<br>Rows : ". $i ."</td>";  
			  }
			
			echo "</tr>";
		  }
		  echo "</table>";
	} 
?>
		  </div>
		  
   </body>
</html>