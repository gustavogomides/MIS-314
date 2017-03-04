


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>GeekBooks - MIS 314 Sample Bookstore</title>
    <link rel="stylesheet" href="http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/StyleSheet.css" type="text/css" />
    <script type="text/javascript" src="http://gc.kis.v2.scr.kaspersky-labs.com/28512211-07CA-0846-A944-AE2C115593D2/main.js" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="http://gc.kis.v2.scr.kaspersky-labs.com/2D395511C2EA-449A-6480-AC70-11221582/abn/main.css"/></head>
<body>
    <!--Begin header include -->
   <!-- non-mobile header -->
 <? include_once("Header.php") ?>
<!--End header include -->



    <div class="pageContainer">
        <div class="leftColumn">

<!--Begin menu include -->

<? include_once("Menu.php") ?>


<!--End menu include -->
</div>        <div class="pageContent">
            <?php
      //include database connection
      include_once("databaseConnection.php");

      //connect to database
      $link = fConnectToDatabase();

      //Retrieve parameters from querystring and sanitize
     
      

      //List records
     
         $sql = "SELECT * FROM bookdescriptions order by rand() limit 3;";
              
		 $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));
			  
		
		
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $title = $row['title'];
			$ISBN = $row['ISBN'];
			$description = $row['description'];
		
            echo ' 
                     <div class="bookSimple">                
                        <a class="booktitle" href="ProductPage.php?isbn='.$ISBN.'"> '.$title.' </a> <br />
                  
                        <a href="ProductPage.php?isbn='.$ISBN.'"> 
                           <img class="Book" alt="'.$title.'" 
                              src="/sandvig/mis314/assignments/bookstore/bookimages/'.$ISBN.'.01.THUMBZZZ.jpg"> 
                        </a> 
                     
                      '. substr($description, 0, 300).'
                        <a href="ProductPage.php?isbn='.$ISBN.'">more...</a> 
                     </div>            '      ;
         }
         
   
      
      ?>

                     
        </div> 
        <!-- end content -->
        
    <!--Begin footer include -->
<? include_once("Footer.php") ?>
<!--End footer include -->
    </div>
    
    <!-- Sample site uses a MasterPage-like template for page layout. -->
    <!-- This is not required. It may be used as an enhancement. -->
    <!-- Source: http://spinningtheweb.blogspot.com/2006/07/approximating-master-pages-in-php.html -->
</body>
</html>


