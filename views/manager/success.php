<?php
header("Refresh: 4; URL=myapp://paymentresult?status=success");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Redirecting...</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #EBF0F5, #D9E4FF);
      font-family: "Helvetica Neue", -apple-system, BlinkMacSystemFont, sans-serif;
      color: #333;
    }

    .card {
      background: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 400px;
      text-align: center;
      margin: 1rem;
    }

    .checkmark-circle {
      width: 25vw;
      max-width: 120px;
      height: 25vw;
      max-height: 120px;
      background: rgba(0, 97, 255, 0.1);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
      animation: pulse 1.5s ease-in-out infinite;
    }

    .checkmark {
      font-size: 3.5rem;
      color: #0061FF;
      line-height: 1;
    }

    h1 {
      color: #0061FF;
      font-size: 2rem;
      margin: 0 0 0.5rem;
      font-weight: 500;
    }

    p {
      font-size: 1rem;
      color: #555;
      margin: 0;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }

    @media (max-width: 600px) {
      .card {
        padding: 1.5rem;
      }

      h1 {
        font-size: 1.5rem;
      }

      p {
        font-size: 0.9rem;
      }

      .checkmark-circle {
        width: 30vw;
        height: 30vw;
        max-width: 100px;
        max-height: 100px;
      }

      .checkmark {
        font-size: 2.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="checkmark-circle">
      <span class="checkmark">✓</span>
    </div>
    <h1>Payment Successful</h1>
    <p>Redirecting back to the app...</p>
  </div>
</body>
</html>