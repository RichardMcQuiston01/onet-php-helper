<?php

use com\mcqsoft\OnetAPIHelper\OnetAPIHelper;

require_once( 'OnetAPIHelper.php' );

$params = new stdClass();
$params->filename = 'env.json';

$apiHelper = new OnetAPIHelper( $params );
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>O*NET API Helper</title>

    <link href="assets/bootstrap-5.0.2-dist/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<main class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">O*NET API Helper</h1>
        </div>
    </div>
</main>

<script src="assets/jquery/jquery-3.7.1.min.js"></script>
<script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>

</body>
</html>