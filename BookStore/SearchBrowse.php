


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>GeekBooks - MIS 314 Sample Bookstore</title>
    <link rel="stylesheet" href="http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/StyleSheet.css" type="text/css" />
    </head>
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
	  include_once("ListAuthors.php");
      //connect to database
      $link = fConnectToDatabase();

      //Retrieve parameters from querystring and sanitize
     
      

      //List records
   $catName = $_GET['catName']; 
   $search = $_GET['search']; 
   if (!empty($catName)){
	   $search = $catName;
   }
         $sql = "SELECT DISTINCT d.isbn, title, description, price
FROM bookauthors a, bookauthorsbooks ba, bookdescriptions d,
bookcategoriesbooks cb, bookcategories c
WHERE a.AuthorID = ba.AuthorID
AND ba.ISBN = d.ISBN
AND d.ISBN = cb.ISBN
AND c.CategoryID = cb.CategoryID
AND (CategoryName = '$search'
OR title LIKE '%$search%'
OR description LIKE '%$search%'
OR publisher LIKE '%$search%' 
OR concat_ws(' ', nameF, nameL, nameF) LIKE '%$search%' )
ORDER BY title";
              
		 $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));
			  
		
		echo "Results ".mysqli_num_rows($result);
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $title = $row['title'];
			$ISBN = $row['isbn'];
			$description = $row['description'];
		
            echo ' 
                     <div class="bookSimple">                
                        <a class="booktitle" href="ProductPage.php?isbn='.$ISBN.'"> '.$title.' </a> <br />
						'.fListAuthors($link, $ISBN).'<br>
                  
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


