<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?= getInstallationPath() ?>/Public/assets/img/favicon-100x100.png">
    <meta name="description" content="<?= translate("An extremely simple, one-time view encryption message system. Send anybody passwords, or secret messages on a one-time view basis.") ?>">
    <title>QuickBlaze</title>

    <!-- Site CSS -->
    <link href="<?= getInstallationPath() ?>/Public/assets/css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css">
</head>

<body class="text-center">

    <main class="main-form">
        <h1>500</h1>
        <h5 class="text-muted"><?= translate("An internal server error occurred. Please try again later!") ?></h5>
        <br>
        <a class="btn btn-primary submit-button darkmode-ignore" href="./"><?= translate("Return Home") ?></a>
        <p class="mt-5 mb-3 text-muted">
            <a href="https://github.com/axtonprice/quickblaze-encrypt" class="text-muted no-decoration">GitHub</a> •
            <a href="https://discord.gg/dP3MuBATGc" class="text-muted no-decoration">Discord</a> •
            <a href="https://github.com/axtonprice/quickblaze-encrypt/releases" class="text-muted no-decoration"><?= determineSystemVersion(); ?></a>
        </p>
    </main>

    <!-- Site Javascript -->
    <script src="<?= getInstallationPath() ?>/Public/assets/js/globalFunctions.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Darkmode.js/1.5.7/darkmode-js.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>

</body>

</html>