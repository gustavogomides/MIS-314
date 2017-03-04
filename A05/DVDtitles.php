<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
   <head>
      <title>PHP Database Insert, Read & Delete</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <div class="pageContainer centerText">
      <h3>PHP Database Insert, Read, & Delete</h3>
      <hr>
      <form class="formLayout">
         <div class="formGroup">
            <label>ASIN:</label>
            <input name="asin" type="text" autofocus>
         </div>
         <div class="formGroup">
            <label>Title:</label>
            <input name="title" type="text">
         </div>
		 <div class="formGroup">
            <label>Price:</label>
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
      $title = fCleanString($link, $_GET['title'], 15);
      $asin = fCleanString($link, $_GET['asin'], 15);
	  $price = fCleanNumber($_GET['price']);
      $deleteID = fCleanString($link,$_GET['deleteID'], 15);

      //Insert
      if (!empty($title) && !empty($price) && !empty($asin)){
         $sql = "Insert into DVDtitles (title, price, asin)
                VALUES ('$title', '$price', '$asin')";
         mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
      }

      //Delete
      if (!empty($deleteID)) {
         $sql = "Delete from DVDtitles WHERE asin='$deleteID'";
         mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
      }
      //List records
      $sql = 'SELECT asin, title, price
                FROM dvdTitles order by title';

      //$result is an array containing query results
      $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));

      echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
      ?>
      <table class="simpleTable">
         <tr>
            <th>ASIN</th>
            <th>Title</th>
            <th>Price</th>
			<th>Image</th>
            <th>Delete</th>
         </tr>
         <?php
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $asin = $row['asin'];
            echo "<tr>
                     <td>$asin</td>
                     <td>$row[title]</td>
                     <td>$row[price]</td>
					 <td><img src= 'http://images.amazon.com/images/P/". $asin . ".01.MZZZZZZZ.jpg'></td>
                     <td><a href='?deleteID=$asin'>delete</a></td>
                 </tr>";
         }
         ?> 
      </table>
   </div>
</body>
</html>