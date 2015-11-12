<?php
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Task Two</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link href="public/css/style.css" rel="stylesheet" type="text/css" media="screen" />

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="jumbotron">
                    <?php Kalendar::getInstance();?>
                </div>
            </div>
        </div>
        <script src="public/js/jquery.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="public/js/custom.js" type="text/javascript"></script>
    </body>
</html>
