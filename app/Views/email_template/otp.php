<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGOMPS : OTP Email Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #0084ff;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
        }
        .content {
            padding: 20px;
            font-size: 16px;
            color: #333;
        }
        .otp {
            font-weight: bold;
            font-size: 20px;
            color: #000;
        }
        .footer {
            padding: 15px;
            font-size: 14px;
            color: #666;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">One Time Password</div>
        <div class="content">
            <p>Dear Customer,</p>
            <p>Your one-time password (OTP) is <span class="otp"><?= $otp ?></span></p>
            <p>Please do not share your login details with anyone as sharing it will give them complete access to your ShopClues account.</p>
        </div>
        <div class="footer">
            <p>Warm Regards,<br>AGOMPS INDIA</p>
        </div>
    </div>
</body>
</html>
