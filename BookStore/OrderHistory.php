


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
	  $custIDe = $_POST[custIDe];
include_once("encryption.php");
$custID = decrypt($custIDe,$secretPassword);
      //Retrieve parameters from querystring and sanitize
     
      

      //List records
   $catName = $_GET['catName']; 
   $search = $_GET['search']; 
   if (!empty($catName)){
	   $search = $catName;
   }
         $sql = "SELECT DISTINCT bookorderitems.isbn, title, orderdate, bookorders.orderID, bookorderitems.qty
FROM bookorders, bookorderitems, bookdescriptions
WHERE bookorders.custID = $custID AND bookorderitems.orderID = bookorders.orderID AND 
bookdescriptions.isbn = bookorderitems.isbn
ORDER BY bookorderitems.orderID";
              
		 $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));
			  
		
		echo "Results ".mysqli_num_rows($result);
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $title = $row['title'];
			$ISBN = $row['isbn'];
			$orderID = $row['orderID'];
			$orderdate = $row['orderdate'];
			$description = $row['description'];
			$qty = $row['qty'];
            echo ' 
                    
	 <div class="bookHistory">
                    <a href="ProductPage.php?isbn='.$ISBN.'"><img class="History" 
                         src="/sandvig/mis314/assignments/bookstore/bookimages/'.$ISBN.'.01.THUMBZZZ.jpg" alt="'.$title.'" />
                  </a>                 
                 <b>Order ID: '.$orderID.'</b>&nbsp;&nbsp;
                 '.date("M, d, Y", $orderdate).'
                 <br /> 
 		         <a class="booktitle" href="ProductPage.php?isbn=0596005431">'.$title.'</a><br />
                  <span class="authors">by <a href="SearchBrowse.php">'.fListAuthors($link, $ISBN).'</a></span><br />
                  Qty: '.$qty.'
         </div>
				' ;
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


