<?php

require_once( 'APIConfig.php' );

class OnetAPIHelper
{
  private string $userName;
  private string $userPassword;
  private string $token;
  private string $baseUrl;

  public function __construct( object $args )
  {
    if ( isset( $args['fileName'] ) ) {

      $configClass = new APIConfig( $args['fileName'] );
      $jsonData = $configClass->loadFileData()->asJSON();

      if ( is_object( $jsonData ) && $jsonData !== new stdClass() ) {
        if ( isset( $jsonData['ONET_USERNAME'] ) ) {
          $this->userName = $jsonData['ONET_USERNAME'];
        }

        if ( isset( $jsonData['ONET_PASSWORD'] ) ) {
          $this->userPassword = $jsonData['ONET_PASSWORD'];
        }

        if ( isset( $jsonData['BASE_URL'] ) ) {
          $this->baseUrl = $jsonData['BASE_URL'];
        }
      }
    }

    return $this;
  }

  public function setToken(): OnetAPIHelper
  {
    if ( $this->userName !== '' && $this->userPassword !== '' ) {
      $this->token = base64_encode( $this->userName . ':' . $this->userPassword );
    }

    return $this;
  }

  public function getToken(): string
  {
    return $this->token;
  }

  public function getRequest( string $url, object $params )
  {
    $paramsString = '';

    if ( count( get_object_vars( $params ) ) > 0 ) {
      $paramsString = '?' . http_build_query( $params );
    }

    $fullUrl = $this->baseUrl . $url . $paramsString;

    $headers = [
      'Authorization: Basic ' . $this->getToken(),
      'Content-Type: application/json',
    ];

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $fullUrl );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec( $ch );

    curl_close($ch);

    return $result;
  }

}