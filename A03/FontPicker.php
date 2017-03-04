<html>
<head>
    <title>Funky Font Message</title>
   <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
         <script type="text/javascript">
         //onload reset radiobutton list to selected item  
         function selectRadioButton()
         {
            //retrive selected item from querystring
            var querystring = document.location.search.substring(1);
            var selectedFont = querystring.match(/font=.*&/i);
            selectedFont = selectedFont[0].replace("font=", "").replace("&", "");            
            
            //check the appropriate radio button
            var radio = document.getElementsByName("font");
            for (i=0;i<radio.length;i++){
               if(radio[i].value == selectedFont )
                  {
                     radio[i].checked = true;                  
                  }              
            }
         }
      </script>
   
   
   </head>
<body onload="selectRadioButton()">
<div class="pageContainer centerText" style="width: 800px;">

<form>
  <p>Please select a font and enter a message:</p>
  <div class="inputBlock" >
      <input type="radio" name="font" required value="ChunkRed">Chunk Red
      <input type="radio" name="font" value="DecoBlue">Deco Blue
      <input type="radio" name="font" value="Animals">Animals
      <input type="radio" name="font" value="ElegantRed">Elegant Red
      <input type="radio" name="font" value="Funky">Funky
      <input type="radio" name="font" value="TapePunch">TapePunch
  </div>
  <br>
  <input type="text" name="message" required size="50" value="The Quick Brown Fox Jumps Over the Lazy Dog">
  <input type="submit" Value="Send"><br>
</form>
<?php

$font = $_GET['font'];
$message = $_GET['message'];
function fWriteChar ($letter, $font)
{
	$image_path = "<img src='/sandvig/images/alphabet/";
if ($font == 'ChunkRed') {
	 echo $image_path. "chunk/red/" .$letter."9.jpg'>";
	}
elseif ($font == 'DecoBlue'){
		 echo $image_path. "deco/blue/" .$letter."1.gif'>";
	 }
elseif ($font == 'Animals'){
	 echo $image_path. "animals/" .$letter."4.gif'>";
 }
elseif ($font == 'ElegantRed') {
	 echo $image_path. "elegant/red/4" .$letter.".gif'>";
 }
elseif ($font == 'Funky'){
	 echo $image_path. "funky/" .$letter."3.jpg'>";
	 }
elseif ($font == 'TapePunch'){
	 echo $image_path. "punch/black/" .$letter."7.gif'>";
	 }
else {
	echo "enter words!";
}
}
	for ($i = 0; $i< strlen($message); $i++)
	{
		$letter = substr($message, $i, 1);
		if ($letter == " "){
		echo "<br/>"; }
		else { 
		
	fWriteChar($letter, $font);
		}
	}		
?>
</div>
</html>
