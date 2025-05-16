<?php
header("Refresh: 4; URL=myapp://paymentresult?status=success");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Redirecting...</title>
</head>
<body style="background: #EBF0F5; text-align:center; padding: 40px;">
  <div class="card">
    <div style="border-radius:200px; height:200px; width:200px; background: #f4f4f47d; margin:0 auto;">
      <i class="checkmark">X</i>
    </div>
    <h1>Error</h1> 
    <p>Redirecting back to the app...</p>
  </div>
</body>
</html>