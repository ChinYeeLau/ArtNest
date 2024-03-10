<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Vendor Account Confirmation</h2>
        </div>
        <div class="content">
            <p>Dear {{$name}},</p>
            <p>Please click on the link below to confirm your Vendor Account:</p>
            <p><a href="{{ url('vendor/confirm/'.$code) }}" class="button">{{ url('vendor/confirm/'.$code) }}</a></p>
            <p>Thanks & Regards,</p>
            <p>ArtNest</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 ArtNest. All rights reserved.</p>
        </div>
    </div>

</body>
</html>                           