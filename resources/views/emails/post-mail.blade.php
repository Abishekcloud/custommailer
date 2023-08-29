<!DOCTYPE html>
<html>
<head>
    <style>
        /* Reset some default styles */
        body, div, p {
            margin: 0;
            padding: 0;
        }
        
        /* Your inline CSS styles */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #00e1ff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #888;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Our Website!</h1>
        </div>

        <div class="content">
            <p>Hello {{ $full_name }},</p>
            <p>Thank you for signing up on our website and Share Your idea with us. We're excited to have you as a member of our community!</p>
            <p>If you have any questions or need assistance, feel free to reach out to our support team.</p>
        </div>

        <div class="footer">
            <p>This email was sent to the Current{{ $full_name }}. If you want to make a new post Click Here... <a href="{{route('post.create')}}">To Create new Post</a>.</p>
        </div>
    </div>
</body>
</html>
