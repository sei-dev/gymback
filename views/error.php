<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  

  <title>Error</title>


  
</head>

<body translate="no">
<pre>Error <?=$data["message"];?><br>

 in <?=$data["file"];?>, on line <?=$data["line"];?><br>
<?=$data["stacktrace"];?></pre>
</body>
</html>