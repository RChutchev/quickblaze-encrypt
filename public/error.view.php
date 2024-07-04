<!DOCTYPE html>
<html lang="en" prefix="og: https://ogp.me/ns#">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark">
    <link rel="icon" type="image/x-icon" href="{{http_host}}/assets/img/favicon-50x50.png">
    <meta name="description" content="Securely send passwords, secret messages, and files with our one-time view encrypted system. Enjoy ultimate simplicity and privacy, with optional password protection for your sensitive communications.">
    <meta property="og:title" content="Nexshare" />
    <meta property="og:type" content="website" />
    <meta property="og:URL" content="{{http_host}}" />
    <meta property="og:image" content="{{http_host}}/assets/img/favicon-50x50.png" />
    <meta property="og:description" content="Securely send passwords, secret messages, and files with our one-time view encrypted system. Enjoy ultimate simplicity and privacy, with optional password protection for your sensitive communications." />
    <title>Nexshare</title>

    <!-- Main CSS Libraries -->
    <link href="{{http_host}}/assets/css/style.css" rel="stylesheet">
    <link href="{{http_host}}/assets/css/views/error.view.css" rel="stylesheet">

    <!-- Site Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/fontawesome.min.js" integrity="sha512-1M9vud0lqoXACA9QaA8IY8k1VR2dMJ2Qmqzt9pN2AH7eQHWpNsxBpaayV0kKkUsF7FLVQ2sA2SSc8w5VOm7/mg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Dropzone.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>

    <div class="pageWrapper">
        <div class="errorContainer text-center">
            <!-- <img src="https://media1.tenor.com/m/PPOe9MawAvsAAAAd/404-not-found.gif" class="mb-3"> -->
            <h1>Error {{error_code}}!</h1>
            <p>
                {{error_message}}
            </p>
            <br>
            <a href="{{http_host}}">
                <i class="fa-solid fa-arrow-left"></i> Return home
            </a>
        </div>

        <div class="justify-content-center d-flex flex-row mt-3 mb-1">
            <div class="p-2">
                <a href="https://github.com/axtonprice/nexshare" class="text-decoration-none">GitHub</a>
            </div>
            <div class="p-2">
                <a href="https://discord.gg/dP3MuBATGc" class="text-decoration-none">Discord</a>
            </div>
            <div class="p-2">
                <a href="https://github.com/axtonprice/nexshare/releases" class="text-decoration-none">{{version_label}}</a>
            </div>
        </div>

        <p class="text-muted text-center">&copy; 2022-{{system_year}}</p>
    </div>

    <!-- Darkmode Widget -->
    <div class="darkmode-widget">
        <div class="darkmode-btn-wrapper">
            <button class="darkmode-btn" id="darkSwitch"></button>
        </div>
    </div>

    <!-- Site Javascript -->
    <script src="assets/js/dropzone.js" type="text/javascript"></script>
    <script src="assets/js/toastNotifications.js" type="text/javascript"></script>
    <script src="assets/js/darkModeWidget.js" type="text/javascript"></script>

</body>

</html>