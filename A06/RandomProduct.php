<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
   <head>
      <title>PHP Database Insert, Read & Delete</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <div class="pageContainer centerText">
      <h3>Random product</h3>
	  <hr>
	  
      <hr>
      
      <?php
      //include database connection
      include("databaseConnection.php");

      //connect to database
      $link = fConnectToDatabase();

      //Retrieve parameters from querystring and sanitize
     
      

      //List records
     
         $sql = "SELECT * FROM geekproducts order by rand() limit 1;";
              
		 $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));
			  
		
		
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $name = $row['name'];
			$image = $row['Image'];
			$itemPrice = $row['price'];
			$description = $row['LongDesc'];
            echo " <img src='/sandvig/mis314/assignments/a06/images/m_". $image ."' class='geekImageFloat' />

               <h3>$name</h3>

               <b>$itemPrice</b><br><br>
			   <p>$description</p>";
         }
         
         mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
      
	  
      

      

      
      ?>
      
      </table>
   </div>
</body>
</html>