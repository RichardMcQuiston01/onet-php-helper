<?php

use com\mcqsoft\OnetAPIHelper\OnetAPIHelper;

require_once( 'OnetAPIHelper.php' );

header( 'Content-Type: application/json' );

$params = new stdClass();
$params->filename = 'env.json';

$apiHelper = new OnetAPIHelper( $params );

$output = [
  'success' => 0,
  'data'    => [],
  'errors = []',
];

if ( $_SERVER['REQUEST_METHOD'] === 'GET' ) {
  if ( isset( $_GET['endpoint'] ) && $_GET['endpoint'] !== '' ) {
    $endpoint = filter_input( INPUT_GET, 'endpoint', FILTER_SANITIZE_STRING );

    switch ( $endpoint ) {
      case 'JobZones':
        $output['data'] = $apiHelper->getJobZones();

        break;
      default:
        $output['errors'][] = 'Invalid Endpoint - ' . $endpoint;
        break;
    }

    if ( sizeof( $output['data'] > 0 ) ) {
      $output['success'] = 1;
    }
  } else {
    $output['errors'][] = 'Invalid Endpoint - None Provided';
  }
} else {
  $output['errors'][] = 'Invalid Request Method';
}

echo json_encode( $output );