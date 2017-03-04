


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
   
	 $isbn=$_GET[isbn];
	 if (!is_numeric($isbn)) {
				echo "Please enter a numeric ISBN!";
			}
			else {
         $sql = "SELECT * FROM bookdescriptions WHERE isbn=$isbn";
              
		 $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));
			  
		
		
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $title = $row['title'];
			$ISBN = $row['ISBN'];
			$description = $row['description'];
		    $price = $row['price'];
			$ourprice = $price*.8;
			$yousave = $price - $ourprice;
			$publisher  = $row['publisher'];
			$pages = $row['pages'];
			$edition = $row['edition'];
			
		
            echo ' 
                     <div class="bookTitle"> Teach Yourself SQL in 10 Minutes</div>

                <div class="authors">by <a href="SearchBrowse.php?search=Forta">'.fListAuthors($link, $isbn).'</a></div>
                <a href="/sandvig/mis314/assignments/bookstore/bookimages/'.$ISBN.'.01.LZZZZZZZ.jpg">
                   <img class="Book" alt="'.$title.'" title="'.$title.'"
                   src="/sandvig/mis314/assignments/bookstore/bookimages/'.$ISBN.'.01.MZZZZZZZ.jpg">
                </a> <br />

                <span class="priceLabel">List Price: </span>
				<span class="bookPriceList">
					$'.$price.'			</span> <br />

                <span class="priceLabel">Our Price:</span>
				<span class="bookPriceB">$'.number_format($ourprice, 2).'  </span> <br />

                <span class="priceLabel">You Save:</span>
				<span class="bookPriceB">
                $'.number_format($yousave, 2).' (20%)</span><br />
                <br />

                <span class="bookDetails">
                <b>ISBN:</b> '.$ISBN.' <br />
                <b>Publisher:</b>'.$publisher.'<br />
                <b>Pages:</b>'.$pages.'<br />
                <b>Edition:</b> '.$edition.'                </span> 

                <a href="ShoppingCart.php?addISBN='.$ISBN.'">
                   <img class="addToCart" src="/sandvig/mis314/assignments/bookstore/images/add-to-cart-small.gif" alt="Add to cart" title="Add to cart" ></a>
                    <br /><br />
                '.$description.'
                   <img class="addToCart"  src="/sandvig/mis314/assignments/bookstore/images/add-to-shopping-cart-blue.gif"  alt="Add to cart" title="Add to cart" >
                </a>
       '      ;
         }
         
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


