<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME?></title>
    <!--CSS-->
    <link rel="stylesheet" href="<?php echo URL?>/public/css/globals/main.css">

</head>
<body>
    
    <!--Components-->
    <?php require_once 'views/components/navBar.php';?>
    
    <div class="fof-container">
        <img src="<?php echo URL?>/public/images/404.jpg" alt="404-img">
        <p>
            Sembla que el recurs que està buscant no existeix.
        </p>
    </div>
    <!--Scripts-->
    <script type="module" src="<?php echo URL?>/public/js/fit.js"></script>
    <script type="module" src="<?php echo URL?>/public/js/navBar.js"></script>
    
</body>
</html>