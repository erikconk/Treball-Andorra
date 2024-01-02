<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME?></title>
    <!--CSS-->
    <!--CSS-->
    <link rel="stylesheet" href="<?php echo URL?>/public/css/globals/main.css">
    <link rel="stylesheet" href="<?php echo URL?>/public/css/globals/forms.css">
    <link rel="stylesheet" href="<?php echo URL?>/public/css/globals/dash_board.css">

</head>
<body>
    
    <!--Components-->
    <?php require_once 'views/components/navBar.php';?>

    <div class="main-page">
        <?php require_once 'views/components/dash_board/dash-board-index.php';?>
    </div>
    <!--Scripts-->
    <script src="<?php echo URL?>/public/js/fit.js"></script>
    <script src="<?php echo URL?>/public/js/navBar.js"></script>
    <script src="<?php echo URL?>/public/js/dash_board/dialogs.js"></script>
    <script src="<?php echo URL?>/public/js/dash_board/select.js"></script>
    <script src="<?php echo URL?>/public/js/messages.js"></script>
    
</body>
</html>