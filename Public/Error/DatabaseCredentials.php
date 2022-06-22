<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?=getInstallationPath()?>/Public/assets/img/favicon.png">
    <meta name="description" content="<?= translate("An extremely simple, one-time view encryption message system. Send anybody passwords, or secret messages on a one-time view basis.") ?>">
    <title>QuickBlaze</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=getInstallationPath()?>/Public/assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="<?=getInstallationPath()?>/Public/assets/css/style.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-submit">
        <h1><?= translate("Database Error") ?></h1>
        <br>
        <h5 class="text-muted">
            <?= translate("Failed to connect to the database using the connection credentials you have provided.") ?> <br><br>
            <a style="text-decoration:none" href="https://github.com/axtonprice-dev/quickblaze-encrypt/#installation" target="_blank"><?= translate("Please refer to the GitHub repository.") ?></a>
        </h5>

        <p class="mt-5 mb-3 text-muted">
            <a href="https://github.com/axtonprice/quickblaze-encrypt" class="text-muted no-decoration">GitHub</a> •
            <a href="https://discord.gg/dP3MuBATGc" class="text-muted no-decoration">Discord</a> •
            <a href="https://github.com/axtonprice/quickblaze-encrypt/releases" class="text-muted no-decoration"><?= determineSystemVersion(); ?></a>
        </p>
    </main>

    <!-- Dark Mode Widget -->
    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
    <script>
        function addDarkmodeWidget() {
            const options = {
                time: '0.0s', // default: '0.3s'
                saveInCookies: true, // default: true,
                label: '🌓', // default: ''
            }

            const darkmode = new Darkmode(options);
            darkmode.showWidget();
        }
        window.addEventListener('load', addDarkmodeWidget);
    </script>

</body>

</html>