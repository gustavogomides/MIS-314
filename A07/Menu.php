<div class="menuContainer">
    <div class="menuSearch" >
        <img src="/sandvig/mis314/assignments/bookstore/images/search_heading.gif" class="menuHeader" alt="search">
        <div class="menuBorder">
            <form action="SearchBrowse.php" >
                  <input type="text" name="search" autofocus />
                  <input type="submit" value="Search" class="button fullWidth" />
            </form>
        </div>
    </div>

    <nav>
        <img  src="/sandvig/mis314/assignments/bookstore/images/browse_heading.gif" class="menuHeader" 
             alt="browse"><div class="menuBorder">
<?php
      //include database connection
      include_once("databaseConnection.php");

      //connect to database
      $link = fConnectToDatabase();

      //Retrieve parameters from querystring and sanitize
     
      

      //List records
     
         $sql = "SELECT * FROM bookcategories order by CategoryName";
              
		 $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));
			  
		
		
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $CategoryName = $row['CategoryName'];
			$CategoryID = $row['CategoryID'];
            echo " 
<a href='SearchBrowse.php?catID=". $CategoryID ."&catName=". $CategoryName ."' class='menuitem'>". $CategoryName ."</a><br />  ";
              
         }
		
		
      
	  
      

      

      
      ?>


         </div>
    </nav>
</div>