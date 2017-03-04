<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
   <head>
      <title>PHP Database Insert, Read & Delete</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <div class="pageContainer centerText">
      <h3>Products by Price</h3>
	  <hr>
	  <h2>List Products Under $:</h2>
      <hr>
      <form class="formLayout">
         <div class="formGroup">
            <label>Price</label>
            <input name="price" type="text" autofocus>
         </div>
         
         <div class="formGroup">
            <label> </label>
            <button>Submit</button>
         </div>
      </form>
      <?php
      //include database connection
      include("databaseConnection.php");

      //connect to database
      $link = fConnectToDatabase();

      //Retrieve parameters from querystring and sanitize
     
      $price = fCleanNumber($_GET['price']);

      //List records
      if (!empty($price)) {
         $sql = "SELECT price,image, name, Image FROM geekproducts WHERE price <$price";
              
		 $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));
			  
		echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
		if (mysqli_num_rows($result) > 0){
			   
			  
         echo '<table class="simpleTable">
		 <tr>
            <th>Price</th>
            <th>Item Name</th>
            <th>Thumbnail</th>
            
         </tr>';
         
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $name = $row['name'];
			$image =$row['image'];
			$itemPrice = $row['price'];
            echo "<tr>
                     <td>$itemPrice</td>
                     <td>$row[name]</td>
                     
                     <td><a href='/sandvig/mis314/assignments/a06/images/m_". $image ."'> 
                     <img src='/sandvig/mis314/assignments/a06/images/m_". $image ."' class='geekImageMed'> </a></td>
                 </tr>";
         }
         
         mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
      }
	  }
	  
      

      

      
      ?>
      
      </table>
   </div>
</body>
</html>