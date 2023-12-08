<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="https://presets.excceedder.com/xdr_images/favicon.png" />
    <title>Excceedder | Account Welcome</title>
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

                <p>Dear <span>{FULL_NAMES}</span>,</p>

                <p class="message">
                    I'm delighted to extend a warm welcome to you as the newest member of our School Management System community. Thank you for creating an account and entrusting us with the responsibility of managing your school's operations effectively. At our School Management System, we understand the pivotal role technology plays in simplifying administrative tasks and enhancing overall efficiency. As the ICT Director, you are at the forefront of driving positive change in your educational institution, and we are here to support you every step of the way.
                    <br>
                    <br>
                    With our comprehensive platform, you now have access to a suite of powerful tools designed specifically to meet the needs of modern educational institutions. From streamlining admissions and student records to optimizing timetables and facilitating communication, our system empowers you to manage your school more effectively. To begin harnessing the full potential of our School Management System, please take a moment to log in to your account using the button provided below:
                </p>

                <div class="btn-div">
                    <a href="{DASHBOARD_ACCESS_URL}" target="_blank" class="button-link">Access Dashboard</a>
                </div>

                <p class="message">
                    Once logged in, you will discover an intuitive interface that simplifies complex processes, allowing you to focus on what matters most: providing an exceptional learning environment for your students. Our system offers a range of features, including student information management, attendance tracking, gradebook management, and much more.
                    <br>
                    <br>
                    We are here to provide unparalleled support throughout your journey with us. If you have any questions, require assistance, or need guidance on utilizing specific features, our dedicated support team is readily available to help. Feel free to reach out to us through the contact information provided below, and we will be more than happy to assist you.
                    <br>
                    <br>
                    As you embark on this exciting new chapter with our School Management System, we look forward to witnessing the positive impact it will have on your school. Together, let's pave the way for a streamlined and efficient educational experience. Once again, welcome to our School Management System! We are honored to have you on board and are excited to be a part of your educational institution's growth and success.
                </p>

                <p class="message">
                    Best regards,
                    <br>
                    <br>
                    <span>Excel Oghenetejiri Prosper</span>
                    <br>
                    CEO - Excceedder
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