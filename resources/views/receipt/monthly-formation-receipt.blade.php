<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Report By Month</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* Default styles */

        body {
            background-color: #f8f9fa; /* Light shade for bond paper effect */
        }

        .card {
            background-color: #fff; /* White background for the card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            margin-bottom: 20px;
            padding: 20px;
        }

        .card-body {
            padding: 20px;
        }

        div {
            box-sizing: border-box;
        }

        div.table {
            display: table;
            width: 100%;
        }

        div.table-header-group {
            display: table-header-group;
        }

        div.table-row {
            display: table-row;
        }

        div.table-cell {
            display: table-cell;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        div.table-cell p {
            text-align: center;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            div.table-row {
                display: block;
            }

            div.table-cell {
                display: block;
                width: 100%;
                box-sizing: border-box;
                padding: 10px;
                text-align: center;
            }

            div.table-cell img {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="card" style="margin-bottom: -40px">
        <div class="table">
            <div class="table-header-group">
                <div class="table-row">
                    <div class="table-cell">
                        <img src="{{ asset('assets/img/hcdc-logo.png') }}" style="width: 200px; height: 200px" alt="Your Image">
                    </div>
                    <div class="table-cell">
                        <p>Holy Cross of Davao College</p>
                        <p><strong>COLLEGE OF CRIMINAL JUSTICE EDUCATION</strong></p>
                        <p>Sta. Ana Avenue, corner C. de Guzman</p>
                        <p>Brgy. 14-B, Davao City, Philippines</p>
                    </div>
                    <div class="table-cell">
                        <div style="text-align: right;">
                            <img src="{{ asset('assets/img/hcdc-crim-logo.png') }}" alt="Your Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body" style="margin-bottom: -40px">
        <p style="font-size: 10px;"><strong></strong></p>
        <table class="table" style="font-size: 16px;">
            <thead>
                <tr>
                    <th scope="col">Student ID: </th>
                </tr>
                <tr>
                    <th scope="col">Name: </th>
                </tr>
                <tr>
                    <th scope="col">Year Level: </th>
                </tr>
                <tr>
                    <th scope="col">Date: </th>
                </tr>
                <tr>
                    <th scope="col">Time: </th>
                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
