<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
   <head>
      <title>PHP Database Insert, Read & Delete</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
    <?php
      //include database connection
      include("databaseConnection.php");

      //connect to database
      $link = fConnectToDatabase();

      //Retrieve parameters from querystring and sanitize
      $nameF = fCleanString($link, $_GET['strFName'], 15);
      $nameL = fCleanString($link, $_GET['strLName'], 15);
      $deleteID = fCleanNumber($_GET['deleteID']);
	  $update = fCleanNumber($_GET['updateID']);
	  $updateID2 = fCleanNumber($_GET['updateID2']);
	  
      //Insert
      if (!empty($nameF) && !empty($nameL) && empty($updateID2)) {
         $sql = "Insert into tblCustomers (nameL, nameF)
                VALUES ('$nameL', '$nameF')";
         mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
      }

      //Delete
      if (!empty($deleteID)) {
         $sql = "Delete from tblCustomers WHERE CustID=$deleteID";
         mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
      }
	  
	  //update
	  if (!empty($updateID2)) {
		  $sql3 = "UPDATE tblCustomers SET NameF='$nameF', NameL='$nameL' WHERE CustID=$updateID2";
		  mysqli_query($link, $sql3) or die('Delete error: ' . mysqli_error($link));
	  }
	  
      //search for updATE 
      $sql = "SELECT custID, nameF, nameL
                FROM tblCustomers WHERE CustID='$update'";

      //$result is an array containing query results
      $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));
			  
	$row = mysqli_fetch_array($result);
	$strFName2 = $row['nameF'];
	$strLName2 = $row['nameL'];

     
      ?>
   <div class="pageContainer centerText">
      <h3>PHP Database Insert, Read, & Delete</h3>
      <hr>
      <form class="formLayout">
         <div class="formGroup">
            <label>First name:</label>
            <input type="text" name="strFName" value="<? echo $strFName2; ?>">
         </div>
         <div class="formGroup">
            <label>Last name:</label>
            <input type="text" name="strLName" value="<? echo $strLName2; ?>">
         </div>
		 <input type="hidden" name="updateID2" value="<? echo $update; ?>">
         <div class="formGroup">
            <label> </label>
            <button>Submit</button>
         </div>
      </form>
     
      <table class="simpleTable">
         <tr>
            <th>Cust. ID</th>
            <th>F. Name</th>
            <th>L. Name</th>
            <th>Delete</th>
			<th>Update</th>
         </tr>
         <?php
         // iterate through the retrieved records
		 $sql2 = "SELECT CustID, nameL, nameF FROM tblCustomers order by CustID";
		 $result2 = mysqli_query($link, $sql2)
              or die('SQL syntax error: ' . mysqli_error($link));
		 
         while ($row2 = mysqli_fetch_array($result2)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $custID = $row2['CustID'];
            echo "<tr>
                     <td>$custID</td>
                     <td>$row2[nameF]</td>
                     <td>$row2[nameL]</td>
                     <td><a href='?deleteID=$custID'>delete</a></td>
					 <td><a href='?updateID=$custID'>Update</a></td>
                 </tr>";
         }
         ?> 
      </table>
   </div>
</body>
</html>