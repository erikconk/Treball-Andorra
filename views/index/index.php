<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME?></title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo URL?>/public/css/globals/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL?>/public/css/banner.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL?>/public/css/globals/dash-board.css">
    <!--SWIPER JS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</head>
<body>
    
    <!--Components-->
    <?php require_once 'views/components/navBar.php';?>
    
    <?php require_once 'views/components/banner.php';?>

    <?php require_once 'views/components/dash-board.php';?>
    <!--Scripts-->
    <script type="module" src="<?php echo URL?>/public/js/fit.js"></script>
    <script type="module" src="<?php echo URL?>/public/js/navBar.js"></script>
    
</body>
</html>