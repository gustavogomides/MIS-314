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
            <label>First Name:</label>
            <input name="fname" type="text">
         </div>
		 <div class="formGroup">
            <label>Last Name:</label>
            <input name="lname" type="text" autofocus>
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
      $fname = fCleanString($link, $_GET['fname'], 15);
      $lname = fCleanString($link, $_GET['lname'], 15);
	  $actor_id = fCleanNumber($_GET['actor_id']);
      $deleteID = fCleanString($link,$_GET['deleteID'], 15);

      //Insert
      if (!empty($lname) && !empty($fname)){
         $sql = "Insert into DVDactors (lname, fname)
                VALUES ('$lname', '$fname')";
         mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
      }

      //Delete
      if (!empty($deleteID)) {
         $sql = "Delete from DVDactors WHERE ActorID='$deleteID'";
         mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
      }
      //List records
      $sql = 'SELECT ActorID, fname, lname
                FROM DVDactors order by ActorID';

      //$result is an array containing query results
      $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));

      echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
      ?>
      <table class="simpleTable">
         <tr>
            <th>ActorID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Delete</th>
         </tr>
         <?php
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $actor_id = $row['ActorID'];
            echo "<tr>
                     <td>$actor_id</td>
                     <td>$row[fname]</td>
                     <td>$row[lname]</td>
					
                     <td><a href='?deleteID=$actor_id'>delete</a></td>
                 </tr>";
         }
         ?> 
      </table>
   </div>
</body>
</html>