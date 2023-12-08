<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 2px solid #ccc;
        }

        .image-left img,
        .image-right img {
            max-width: 100px;
            height: auto;
        }

        .center-title {
            text-align: center;
        }

        .content-body {
            padding: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: none;
        }

        @media print {
            body {
                margin: 0;
                padding: 20px;
            }

            .header {
                border-bottom: none;
                display: block;
                text-align: center;
            }

            .image-left,
            .center-title,
            .image-right {
                display: inline-block;
                vertical-align: top;
            }

            .center-title {
                margin: 20px 0;
            }

            .content-body {
                padding: 0;
            }

            .footer {
                text-align: center;
                margin-top: 20px;
                padding-top: 20px;
                border-top: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="image-left">
                <img src="{{ asset('assets/img/hcdc-logo.png') }}" alt="Your Image">
            </div>
            <div class="center-title">
                <p>Holy Cross of Davao College</p>
                <p><strong>COLLEGE OF CRIMINAL JUSTICE EDUCATION</strong></p>
                <p>Sta. Ana Avenue, corner C. de Guzman</p>
                <p>Brgy. 14-B, Davao City, Philippines</p>
            </div>
            <div class="image-right">
                <img src="{{ asset('assets/img/hcdc-crim-logo.png') }}" alt="Your Image">
            </div>
        </div>
        <div class="content-body">
            <p><strong>Student ID:</strong> 123456</p>
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Year Level:</strong> 3rd Year</p>
            <p><strong>Date:</strong> December 7, 2023</p>
            <p><strong>Time:</strong> 10:00 AM</p>
        </div>
    </div>
    <div class="footer">
        <p><strong>MONTHLY FORMATION</strong></p>
        <p>Remarks: Present/Late</p>
        <br>
        <p>Arvin V. Timbang, MSCRIM</p>
        <p>CJE Program Chairperson</p>
    </div>
</body>

</html>
