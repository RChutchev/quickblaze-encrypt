<!DOCTYPE html>
<html lang="en" prefix="og: https://ogp.me/ns#">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon-50x50.png">
    <meta name="description" content="Securely send passwords, secret messages, and files with our one-time view encrypted system. Enjoy ultimate simplicity and privacy, with optional password protection for your sensitive communications.">
    <meta property="og:title" content="Nexshare" />
    <meta property="og:type" content="website" />
    <meta property="og:URL" content="{{http_host}}" />
    <meta property="og:image" content="../assets/img/favicon-50x50.png" />
    <meta property="og:description" content="Securely send passwords, secret messages, and files with our one-time view encrypted system. Enjoy ultimate simplicity and privacy, with optional password protection for your sensitive communications." />
    <title>Nexshare</title>

    <!-- Main CSS Libraries -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/views/index.view.css" rel="stylesheet">

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

    <main class="pageWrapper">
        <div class="text-center mb-4">
            <img class="mb-4" src="../assets/img/favicon-100x100.png" alt="Nexshare" width="72" height="72">
            <h1 class="h4 mb-3 font-weight-medium">Nexshare: Encrypted Sharing</h1>
            <p>Share encrypted messages or files across the internet, anonymously. <a href="https://github.com/axtonprice/nexshare">Open source</a> and free to use. Works in latest
                Chrome, Safari, and Firefox.</p>
        </div>

        <div class="form-label-group">
            <input type="text" id="inputEmail" class="form-control" placeholder="Share Title" autofocus>
            <label for="inputEmail">Share Title</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <label for="inputPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Require password
            </label>
        </div>

        <div class="upload-wrapper">
            <!--begin::Form-->
            <form class="form" action="#" method="post">
                <!--begin::Input group-->
                <div class="fv-row">
                    <!--begin::Dropzone-->
                    <div class="dropzone" id="dropzone">
                        <!--begin::Message-->
                        <div class="dz-message needsclick">
                            <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>

                            <!--begin::Info-->
                            <div class="ms-4">
                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                <span class="fs-7 fw-semibold text-gray-500">Upload up to 10 files</span>
                            </div>
                            <!--end::Info-->
                        </div>
                    </div>
                    <!--end::Dropzone-->
                </div>
                <!--end::Input group-->
            </form>
            <!--end::Form-->

            <!-- <div class="upload-box">
                    <p>Drag files here or <span class="upload_button">Browse</span></p>
                </div> -->

            <!-- <div class="uploaded">
                <i class="fa-regular fa-file"></i>
                <div class="file">
                    <div class="file_name">
                        //u cute
                        <p>lorem_ipsum.pdf</p>
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                            style="width:100%">
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

        <!-- <button class="btn w-100 mt-4 btn-primary btn-block" type="submit">Create Share</button> -->
        <button type="button" class="btn mt-3 btn-primary" id="liveToastBtn">TOAST TEST</button>

        <div class="justify-content-center d-flex flex-row mt-3 mb-1">
            <div class="p-2">
                <a href="https://github.com/axtonprice/nexshare" class="text-decoration-none text-muted">GitHub</a>
            </div>
            <div class="p-2">
                <a href="https://discord.gg/dP3MuBATGc" class="text-decoration-none text-muted">Discord</a>
            </div>
            <div class="p-2">
                <a href="https://github.com/axtonprice/nexshare/releases" class="text-decoration-none text-muted">{{version_label}}</a>
            </div>
        </div>

        <p class="text-muted text-center">&copy; 2022-{{system_year}}</p>
    </main>

    <!-- Snackbar Notifications -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast text-bg-primary align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Darkmode Widget -->
    <div class="darkmode-widget">
        <div class="darkmode-btn-wrapper">
            <button class="darkmode-btn" id="darkSwitch"></button>
        </div>
    </div>

    <!-- Site Javascript -->
    <script>
        // Local storage data - refresh on page load
        window.onload = function() {
            localStorage.setItem("request_id", "{{request_identifier}}");
        };

        // Script variables
        var accepted_upload_types = "{{accepted_upload_types}}";
        var max_upload_count = "{{max_upload_count}}";
        var max_upload_size = "{{max_upload_size}}";
    </script>
    <script src="assets/js/dropzone.js" type="text/javascript"></script>
    <script src="assets/js/toastNotifications.js" type="text/javascript"></script>
    <script src="assets/js/darkModeWidget.js" type="text/javascript"></script>

</body>

</html>