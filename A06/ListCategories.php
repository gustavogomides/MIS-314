

<!DOCTYPE html>
<html>
   <head><title>Product Categories</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer">
         <div class="centerText">
            <h3>Product Categories</h3>
            <hr>
         </div>
            <div class='equalColumnWraper'>
               <div class='leftColumn'>     
                  <div class="centerText">
                     <h3>Categories</h3>
                  </div>
                  <?php
      //include database connection
      include("databaseConnection.php");

      //connect to database
      $link = fConnectToDatabase();

      //Retrieve parameters from querystring and sanitize
     
      

      //List records
     
         $sql = "SELECT * FROM geekcategories order by CatName";
              
		 $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));
			  
		
		
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $CatName = $row['CatName'];
			
            echo " 

              <a class='menuLink' href='?category=$CatName'>". $CatName ."</a>";   
         }
		 $category = $_GET["category"];
		if (empty($category)){
			
			 echo "</div>
			 <div class='centerColumn'>
						  <h3>Please select a product category</h3>
			</div>";
		}
		else 
			echo "</div>
			 <div class='centerColumn'>
						  <h3>You Selected $category</h3>
			</div>";
      
	  
      

      

      
      ?>
      
               
               </div>
               </body>
               </html>
