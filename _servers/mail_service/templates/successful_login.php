<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="https://presets.excceedder.com/xdr_images/favicon.png" />
    <title>Excceedder | Successful Login</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700" rel="stylesheet">
    <style>
        body {
            font-size: 16px;
            font-family: 'Montserrat', Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 24px;
        }

        .main-body {
            height: 100%;
            background-size: cover;
            background-color: #e1e1e1a8;
        }

        a {
            text-decoration: none;
            color: #000000;
        }

        span {
            font-weight: bold;
        }

        .content-header {
            background-color: #fbfbfb;
            text-align: center;
            border-radius: 5px;
            border: 1px dashed #132144;
        }

        .content-body {
            margin: 25px 0;
            background-color: #fbfbfb;
            padding: 25px 50px;
            border-radius: 5px;
            border: 1px dashed #132144;
        }

        .content-footer {
            background-color: #fbfbfb;
            border-radius: 5px;
            padding: 5px 50px;
            border: 1px dashed #132144;
        }

        .button-link {
            background-color: #e1e1e1a8;
            padding: 10px;
            border-radius: 5px;
            color: #000000;
            text-decoration: none;
            border: 1px dashed #132144;
        }

        .message {
            margin: 20px 0;
        }

        .logo {
            margin: 15px 0;
        }

        .favicon {
            margin-right: 5px;
        }

        .hr-style {
            border: none;
            border-bottom: 1px dashed #132144;
        }

        .fw-bold {
            font-weight: bold;
        }

        .text-white {
            color: #ffffff;
        }

        .btn-div {
            margin: 25px 0;
        }

        .text-blue {
            color: #2732db;
        }

        .content {
            padding: 50px;
        }

        .border-bottom {
            border-bottom: 1px dashed #2732db;
        }

        /* Styles for mobile screens */
        @media screen and (max-width: 767px) {
            .content {
                padding: 20px;
            }

            .content-body {
                margin: 25px 0;
                background-color: #fbfbfb;
                padding: 25px 20px;
                border-radius: 5px;
                border: 1px dashed #132144;
            }

            .content-footer {
                background-color: #fbfbfb;
                border-radius: 5px;
                padding: 5px 20px;
                border: 1px dashed #132144;
            }

            .logo {
                width: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="main-body">
        <div class="content">

            <div class="content-header">
                <a href="https://excceedder.com" target="_blank">
                    <img src="https://presets.excceedder.com/xdr_images/logo-dark.png" class="logo" alt="Excceedder" width="250px" title="Excceedder">
                </a>
            </div>

            <div class="content-body">

                <p>Hello <span>{FULL_NAMES}</span>!</p>

                <p class="message">
                    We have detected a login attempt on your account. If this login attempt was initiated by you, please disregard this message. However, if you did not initiate the login, it is crucial that you take immediate action to secure your account. We recommend <a href="https://account.excceedder.com/recovery" class="border-bottom text-blue" title="Recover Account" target="_blank">resetting your password</a> as a precautionary measure to regain control of your account and prevent any unauthorized access.
                </p>

                <p class="message">
                    <span>Device: </span>{DEVICE_NAME}
                    <br>
                    <span>Time: </span>{TIME_OF_AUTHORIZATION}
                </p>

                <p class="message">
                    Best regards,
                    <br>
                    <span>Excceedder's Support Team</span>
                </p>

            </div>

            <div class="content-footer">
                <p class="footer-message">For more detailed information about any of our products or services, please refer to our website, <a href="https://excceedder.com" class="border-bottom text-blue" title="Excceedder">www.excceedder.com</a>. You can also contact us at <a href="mailto:info@excceedder.com" class="border-bottom text-blue" title="Excceedder">info@excceedder.com</a>. Simply reach out to us through the provided contact information, and we'll be delighted to assist you.
                </p>
            </div>

        </div>
    </div>
</body>

</html>