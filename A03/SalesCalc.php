<html>
<head>  
    <title>Sales Calculation</title>
   <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
<body>
<div class="pageContainer centerText">
<h2>Sales Calculation</h2><hr>
<form>
    <p>Item Price:
    <input type="text" name="price" size="5" autofocus>
    <input type="submit" value="Calculate">
    </p>
</form>
<?php
		
		$price = $_GET['price'];
            if (!empty($price)) {
                
                 if(is_numeric($_GET['price']) ) {
					 $discount = $price*.25;
					 $tax = $price*.084;
					 $discountedprice = $price - $discount;
					 $total = $price + $tax - $discount;
				
                    echo '<table class="simpleTable" >
					<tr>
         <td align="right">Price:</td>
         <td>$' . number_format($price, 2) .'</td>
      
	  </tr>
       <tr>
         <td align="right">25% discount:</td>
       <td>$' . number_format($discount, 2) .'</td>
       </tr>
       <tr>
         <td align="right">Discounted Price:</td>
       <td>$' . number_format($discountedprice, 2) .'</td>
       </tr>
       <tr>
         <td align="right">Tax (8.4%)</td>
         <td>$' . number_format($tax, 2) .'</td>
       </tr>
       <tr>
         <td align="right">Total due:</td>
        <td>$' . number_format($total, 2) .'</td>
       </tr>
       </table>
         <br>&nbsp;
       
      
        
    
     <h3>Thank you for shopping at Discount-O-Rama!</h3>
        </div>

';

                 } 
                 else {
                    
                    echo "Please enter a number";
                 }
            }
           ?>     

</div>
</body>
</html>