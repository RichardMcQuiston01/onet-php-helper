<?php

namespace com\mcqsoft\OnetAPIHelper;

use com\mcqsoft\OnetAPIHelper\DTO\InterestProfilerResultsParams;
use stdClass;
use com\mcqsoft\OnetAPIHelper\Config\APIConfig;
use com\mcqsoft\OnetAPIHelper\DTO\InterestProfilerParams;

require_once( 'APIConfig.php' );

class OnetAPIHelper
{
  //#region Variables
  private string $userName;
  private string $userPassword;
  private string $token;
  private string $baseUrl;
  //#endregion

  //#region Magic Functions
  public function __construct( object $args )
  {
    if ( isset( $args->filename ) ) {

      $configClass = new APIConfig( $args->filename );
      $jsonData = $configClass->loadFileData()->asJSON();

      if ( is_object( $jsonData ) && $jsonData !== new stdClass() ) {
        if ( isset( $jsonData->ONET_USERNAME ) ) {
          $this->userName = $jsonData->ONET_USERNAME;
        }

        if ( isset( $jsonData->ONET_PASSWORD ) ) {
          $this->userPassword = $jsonData->ONET_PASSWORD;
        }

        if ( isset( $jsonData->BASE_URL ) ) {
          $this->baseUrl = $jsonData->BASE_URL;
        }
      }
    }

    return $this;
  }
  //#endregion

  //#region Getters and Setters
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
  //#endregion

  //#region Core Functions
  /**
   * @param  string  $url
   * @param  object  $params
   *
   * @return bool|string
   */
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
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

    $result = curl_exec( $ch );

    curl_close( $ch );

    return $result;
  }
  //#endregion

  //#region Interest Profiler (MyNextMove)
  /**
   * @param  InterestProfilerParams  $params
   *
   * @return void
   */
  public function getInterestProfilerQuestionsShort( InterestProfilerParams $params )
  {
    $url = 'mnm/interestprofiler/questions_30';
  }

  /**
   * @param  InterestProfilerParams  $params
   *
   * @return void
   */
  public function getInterestProfilerQuestionsLong( InterestProfilerParams $params )
  {
    $url = 'mnm/interestprofiler/questions';
  }

  /**
   * @param  InterestProfilerResultsParams  $params
   *
   * @return void
   */
  public function getResults( InterestProfilerResultsParams $params )
  {

  }

  public function getJobZones()
  {

  }

  public function getMatchingCareers()
  {

  }
  //#endregion
}