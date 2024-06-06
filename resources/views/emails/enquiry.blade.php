<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to ArtNest</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            table-layout: fixed;

        }
        table td {
            padding: 10px 0;
            word-wrap: break-word;

        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{asset('front/img/ART.NEST.png')}}" alt="ArtNest Logo">
        </div>
        <h2>Dear Admin,</h2>
        <p>User Enquiry from ArtNest. Details are as below:</p>
        <table>
            <tr>
                <td><strong>Name:</strong> {{$name}}</td>
            </tr>
            <tr>
                <td><strong>Email:</strong> {{$email}}</td>
            </tr>
            <tr>
                <td><strong>Subject:</strong> {{$subject}}</td>
            </tr>
            <tr>
                <td><strong>Message:</strong> {{$comment}}</td>
            </tr>
            <tr>
                <td>Thanks and Regards,<br> ArtNest</td>
            </tr>
        </table>
    </div>
</body>
</html>