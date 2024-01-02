<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo constant('APP_NAME')?></title>
    <!--CSS-->
    <link rel="stylesheet" href="<?php echo constant('URL')?>/public/css/default.css">
</head>
<body>
    
    <!--Components-->
    <?php require_once 'views/components/navBar.php';?>

    <div id="main">
        <p><?php echo $this->args['welcome_msg']; ?></p>
        <p>Method hello():</p>
        <p><a href="<?php echo constant('URL') ?>/test/hello">Click</a></p>
        <br>
        <p>Method get_test_data():</p>
        <form action="<?php echo constant('URL');?>/test/get_test_data" method="POST">
            <input type="submit">
        </form>
    </div>
    
</body>
</html>