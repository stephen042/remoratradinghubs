<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="https://presets.excceedder.com/xdr_images/favicon.png" />
    <title>Excceedder | Account Recovery</title>
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

                <p>Hi there! <span>{FULL_NAMES}</span></p>

                <p class="message">
                    It appears that you have requested to change the password associated with your account. No worries, we've got you covered! To reset your account password, simply click on the update Password button below to complete the recovery process:
                </p>

                <div class="btn-div">
                    <a href="{ACCOUNT_RECOVERY_URL}" target="_blank" class="button-link">Update Password</a>
                </div>

                <p class="message">
                    After clicking the button, your password will be automatically updated to the one entered in the account recovery form. Additionally, you can continue using our services without any disruptions. If you have any questions or concerns, please don't hesitate to reach out to our support team at <a href="mailto:info@excceedder.com" title="Excceedder" class="text-blue">info@excceedder.com</a>.
                </p>

                <hr class="hr-style">

                <p class="message">
                    <b>P.S.</b> If you did not initiate the account recovery process or if you received this email in error, please ignore this message. However, if you suspect that someone may have attempted to gain access to your account without your permission, we strongly advise that you contact our support team immediately. At Excceedder, we take the security and privacy of our users very seriously, and we want to ensure that your personal information is always protected.
                </p>

                <hr class="hr-style">

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