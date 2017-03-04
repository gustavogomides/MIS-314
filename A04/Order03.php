<html>
   <head>
      <title>Order Confirmation</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
	  <?php
	  //must arrive from order02.php
		$referrer = $_SERVER['HTTP_REFERER'];
		if (stripos($referrer, 'order02.php') == false) header("location:order01.php");
	  ?>
   </head>
   <body>
      <div class="pageContainer centerText">

         <h2 class="centerText">Order Confirmation</h2>
		 
		 <?php
		 include 'validationUtilities.php';
		 
		 $color = $_GET['color'];
		 $fname = $_COOKIE['fname'];
		 $model = $_COOKIE['model'];
		 
		 $IsValid = true;
		 
		 if (!fIsValidLength($color, 2, 20)){
			echo "Enter a valid color.";
			$IsValid = false;
		 }
		 
		 if ($IsValid){
			 echo "<h2>Congratulations " . $fname . " you have ordered a " . $color . " " . $model . "!";
			echo "<img src='/sandvig/mis314/assignments/a04/images/{$model}{$color}.jpg'/>";
			echo '<br><a href="Order01.php">Place another order</a>';
		 }
		 
		 ?>


</div>
</body>
</html>