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
     
      <?php
      //include database connection
      include("databaseConnection.php");

      //connect to database
      $link = fConnectToDatabase();

      //Retrieve parameters from querystring and sanitize
     
     

     
     
      //List records
      $sql = 'SELECT  dvdactorstitles.asin, dvdtitles.price,GROUP_CONCAT( Concat( dvdactors.fname, " ", dvdactors.LName ) SEPARATOR ", " )AS Name , dvdtitles.title
                FROM DVDactorsTitles, dvdtitles, dvdactors
				WHERE dvdactorstitles.asin = DVDtitles.asin AND dvdactorstitles.actorID = dvdactors.actorID
GROUP BY DvdActorsTitles.asin';

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
			<th>Actors</th>
			<th>Image</th>
            
         </tr>
         <?php
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            
            echo "<tr>
                     
                     <td>$row[asin]</td>
					 <td>$row[title]</td>
					 <td>$row[price]</td>
					 <td>$row[Name]</td>
					
                     
					
                     <td><img src= 'http://images.amazon.com/images/P/". $row[asin] . ".01.MZZZZZZZ.jpg'></td>
                 </tr>";
         }
         ?> 
      </table>
   </div>
</body>
</html>