<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME?></title>
    <!--CSS-->
    <link rel="stylesheet" href="<?php echo URL?>/public/css/globals/main.css">
    <link rel="stylesheet" href="<?php echo URL?>/public/css/globals/forms.css">
</head>
<body>
    
    <!--Components-->
    <?php require_once 'views/components/navBar.php';?>

    <?php require_once 'views/components/login-form.php';?>
    

    <!--Scripts-->
    <script type="module" src="<?php echo URL?>/public/js/fit.js"></script>
    <script type="module" src="<?php echo URL?>/public/js/navBar.js"></script>
    
</body>
</html>