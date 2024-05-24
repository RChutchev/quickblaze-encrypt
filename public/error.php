<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark">
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon-100x100.png">
    <meta name="description"
        content="An extremely simple, one-time view encrypted message system. Send anybody passwords, or secret messages on a one-time view basis.">
    <title>Nexshare</title>

    <!-- Site CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Site Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>

    <div class="global-container">
        <div class="main-form">
            <form onsubmit="return false;">
                <div class="page-title-container">
                    <a href="/">
                        <img class="form-icon fa-fade" id="form-icon" draggable="false" alt="Nexshare"
                            aria-label="Nexshare" title="Nexshare" src="/assets/img/favicon-100x100.png">
                    </a>
                    <h2>Nexshare Encrypted Sharing</h2>
                </div>
                <h5 class="text-muted">One-time view encrypted message sharing system</h5>

                <!-- Main Form Content -->
                <div id="form_input" class="form-area">
                    <br>
                    <h3>Error!</h3>
                    <span>{{error_identifier}}</span>
                </div>

                <p class="mt-5 mb-3 text-muted">
                    <a href="https://github.com/arizon-dev/quickblaze-encrypt"
                        class="text-muted no-decoration">GitHub</a>
                    •
                    <a href="https://discord.gg/dP3MuBATGc" class="text-muted no-decoration">Discord</a>
                    •
                    <a href="https://github.com/arizon-dev/quickblaze-encrypt/releases"
                        class="text-muted no-decoration">
                        {{version_label}}
                    </a>
                </p>

            </form>

        </div>
    </div>

    <!-- Darkmode Widget -->
    <div class="darkmode-widget">
        <div class="darkmode-btn-wrapper">
            <button class="darkmode-btn" id="darkSwitch"></button>
        </div>
    </div>

    <!-- Site Javascript -->
    <script src="/assets/js/globalFunctions.js"></script>
    <script src="/assets/js/buttonSnackbar.js"></script>
    <script src="/assets/js/formContentUpdate.js"></script>

    <script src="/assets/js/darkModeWidget.js"></script>
    <script src="/assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="/assets/js/jquery-2.1.1.min.js"></script>
    <script src="/assets/js/momentjs.min.js"></script>
</body>

</html>