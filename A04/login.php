<?php
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

session_start();

$password = $_POST['password'];
$username = $_POST['username'];

$postback = $_POST['postback'];

if ($password == 'guest' && strlen($username) > 0) {
	if (!isset($_SESSION['username'])) {
	  $_SESSION['username'] = $username;
	}
	
	header("location: protected.php"); exit(); //stops page execution
}

?>
<html>
   <head>
      <title>Login</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">
         <h2>Login</h2>
         <form method="post" class="formLayout">
            <div class="formGroup">
               <label>First name:</label>

               <input type="text" name="username" value='<?php echo $fname ?>' 
                      class="formElement" 
                      placeholder="first name" 
                      title="first name" required autofocus /><br>
					  
				<?php
				if ($postback && strlen($username) < 1) {
					echo "Please enter your name."; 
				}
				?>
            </div>                     
            
            <div class="formGroup">
               <label>Password:</label>
               <input type="password" name="password" class="formElement" 
                      placeholder="password"
                      title="password" required /><br>
               <label></label>(Password is 'guest')<br>
			   
			   <?php
				if ($postback && strlen($password) < 1) {
					echo "Please enter a password."; 
				}
				?>
			   
			   
            </div>
			
			
            <span class="alert">&nbsp;
                           </span>
            <div class="formGroup">
               <label> </label>
               <input type="hidden" name="postback" value="true">
               <button type="submit">Login</button>
            </div>
            <div class="formGroup">
               <label></label>
               <button type="submit" formnovalidate>Login without HTML5 validation</button>
            </div>

            <div class="vertGap55 centerText">
                 <a href="protected.php">Try going to protected.php without logging on.</a>
            </div>
         </form>     

      </div>
   </body>
</html>