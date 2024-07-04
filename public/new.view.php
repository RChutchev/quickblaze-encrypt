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

    <!-- Site Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css" integrity="sha512-UuQ/zJlbMVAw/UU8vVBhnI4op+/tFOpQZVT+FormmIEhRSCnJWyHiBbEVgM4Uztsht41f3FzVWgLuwzUqOObKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/fontawesome.min.js" integrity="sha512-1M9vud0lqoXACA9QaA8IY8k1VR2dMJ2Qmqzt9pN2AH7eQHWpNsxBpaayV0kKkUsF7FLVQ2sA2SSc8w5VOm7/mg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Dropzone.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <div class="global-container">
        <div class="main-form">
            <form onsubmit="return false;">
                <div class="page-title-container">
                    <a href="/">
                        <img class="form-icon fa-fade" id="form-icon" draggable="false" alt="NexusEncrypt" aria-label="NexusEncrypt" title="NexusEncrypt" src="/assets/img/favicon-100x100.png">
                    </a>
                    <h2>NexusEncrypt</h2>
                </div>
                <h5 class="text-muted">One-time view encrypted message sharing system</h5>

                <!-- Snackbar -->
                <div class="alert snackbar-container" id="snackbar-container">
                    <div id="snackbar"></div>
                </div>

                <!-- Main Form Content -->
                <div id="form_submission" class="form-area">
                    <div class="input-container">
                        <label for="submission_text_box">Share Link</label>
                        <textarea type="text" class="form-control form-input-item size-max" id="submission_text_box" disabled></textarea>
                        <label for="submission_password">Decryption Password</label>
                        <input type="text" class="form-control form-input-item size-single" id="submission_password" disabled></input>
                    </div>
                    <p class="text-muted">
                        Share this link and decryption password anywhere on the internet. The message will be
                        automatically destroyed once viewed.
                    </p>
                    <div class="buttons-inline">
                        <button type="button" class="btn btn-primary submit-button button-50" onclick="copyToClipboard('submission_text_box', 'snackbar_link')">
                            Copy Link
                        </button>
                        <button type="button" class="btn btn-primary submit-button button-50" onclick="copyToClipboard('submission_password', 'snackbar_password')">
                            Copy Password
                        </button>
                    </div>
                    <a class="btn btn-secondary submit-button button-100" href="./">
                        Create New Message
                    </a>
                </div>

                <p class="mt-5 mb-3 text-muted">
                    <a href="https://github.com/axtonprice/nexshare" class="text-muted no-decoration">GitHub</a>
                    •
                    <a href="https://discord.gg/dP3MuBATGc" class="text-muted no-decoration">Discord</a>
                    •
                    <a href="https://github.com/axtonprice/nexshare/releases" class="text-muted no-decoration">
                        {{version_label}}
                    </a>
                </p>

            </form>

        </div>
    </div>

    <!-- Snackbar Notifications -->
    <div class="snackbar-messages">
        <div id="snackbar_link">
            <span class="snackbar-text" id="snackbar-text">
                <i class="fa-solid fa-check mr-5"></i>
                Link has been copied to clipboard!
            </span>
        </div>

        <div id="snackbar_password">
            <span class="snackbar-text" id="snackbar-text">
                <i class="fa-solid fa-check mr-5"></i>
                Password has been copied to clipboard!
            </span>
        </div>

        <div id="snackbar_empty_fields">
            <span class="snackbar-text" id="snackbar-text">
                <i class="fa-solid fa-xmark mr-5"></i>
                Error! One or more fields are empty!
            </span>
        </div>

        <div id="snackbar_error">
            <span class="snackbar-text" id="snackbar-text">
                <i class="fa-solid fa-xmark mr-5"></i>
                Error! An error occurred processing your message!
            </span>
        </div>
    </div>

    <!-- Darkmode Widget -->
    <div class="darkmode-widget">
        <div class="darkmode-btn-wrapper">
            <button class="darkmode-btn" id="darkSwitch"></button>
        </div>
    </div>

    <!-- Site Javascript -->

</body>

</html>