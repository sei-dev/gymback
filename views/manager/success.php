<?php
  header("Refresh: 4; URL=myapp://paymentresult?status=success");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Redirecting...</title>
  <style>
    body {
      background: #EBF0F5;
      text-align: center;
      padding: 40px;
      font-family: "Helvetica Neue", sans-serif;
    }

    .card {
      background: white;
      padding: 60px;
      border-radius: 10px;
      display: inline-block;
      box-shadow: 0 2px 3px #C8D0D8;
    }

    .checkmark-circle {
      height: 200px;
      width: 200px;
      background: #f4f4f47d;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px auto;
    }

    .checkmark {
      font-size: 100px;
      color: #4CAF50;
      line-height: 1;
    }

    h1 {
      color: #4CAF50;
      font-size: 36px;
      margin-bottom: 10px;
    }

    p {
      color: #333;
      font-size: 18px;
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="checkmark-circle">
      <span class="checkmark">✓</span>
    </div>
    <h1>Success</h1> 
    <p>Redirecting back to the app...</p>
  </div>
</body>
</html>