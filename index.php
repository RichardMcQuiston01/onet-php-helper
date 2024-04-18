<?php

use com\mcqsoft\OnetAPIHelper\OnetAPIHelper;

require_once( 'OnetAPIHelper.php' );

$params = new stdClass();
$params->filename = 'env.json';

$apiHelper = new OnetAPIHelper( $params );

$jobZones = $apiHelper->getJobZones();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>O*NET API Helper</title>

    <link href="assets/bootstrap-5.0.2-dist/css/bootstrap.css" rel="stylesheet">

    <style>
        .jobZoneBox {
            background-color: #eeeeee;
            border: solid 2px #888888;
            border-radius: 2rem;
        }
    </style>
</head>
<body>
<main class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">O*NET API Helper</h1>
        </div>
    </div>

  <?php
  if ( isset( $jobZones->data ) ) {
    //print_r( $jobZones->data );
    if ( is_object( $jobZones->data ) && count( get_object_vars( $jobZones->data ) ) > 0 ) {
      if ( isset( $jobZones->data->job_zone ) && sizeof( $jobZones->data->job_zone ) > 0 ) {
        foreach ( $jobZones->data->job_zone as $jobZone ) {
          ?>
            <div class="row my-2">
                <div class="col-md-10 offset-md-1 px-3 py-3 jobZoneBox">
                    <h2><?= $jobZone->title ?></h2>
                    <hr>
                    <h3>Experience</h3>
                    <p><?= $jobZone->experience ?></p>
                    <h3>Education</h3>
                    <p><?= $jobZone->education ?></p>
                    <h3>Job Training</h3>
                    <p><?= $jobZone->job_training ?></p>
                    <h3>Examples</h3>
                    <p><?= $jobZone->examples ?></p>
                    <h3>SVP Range</h3>
                    <p><?= $jobZone->svp_range ?></p>
                </div>
            </div>
          <?php
        }
      }
    }
  }
  ?>

</main>

<script src="assets/jquery/jquery-3.7.1.min.js"></script>
<script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>

</body>
</html>