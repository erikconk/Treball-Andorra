<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME?></title>
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="<?php echo BOOTSTRAP_CSS?>">
    <!--CSS-->
    <!--
        -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL?>/public/css/globals/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL?>/public/css/banner.css">
    <!--SWIPER JS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
</head>
<body>
    
    <!--Components-->
    <?php require_once 'views/components/navBar.php';?>
    
    <?php require_once 'views/components/banner.php';?>
    
    <main class="main-page">
        <?php require_once 'views/components/index.php';?>
    </main>

    <!--Scripts-->
    <script src=<?php echo BOOTSTRAP_JS?>></script>
    <script src="<?php echo URL?>/public/js/fit.js"></script>
    <script src="<?php echo URL?>/public/js/navBar.js"></script>
    
</body>
</html>