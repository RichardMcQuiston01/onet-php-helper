<?php

namespace com\mcqsoft\OnetAPIHelper;

use com\mcqsoft\OnetAPIHelper\Config\APIConfig;
use com\mcqsoft\OnetAPIHelper\DTO\InterestProfilerCareers;
use com\mcqsoft\OnetAPIHelper\DTO\InterestProfilerParams;
use com\mcqsoft\OnetAPIHelper\DTO\InterestProfilerResultsParams;
use stdClass;

require_once( 'APIConfig.php' );
require_once( 'GetResponse.php' );

class OnetAPIHelper
{
  //#region Variables
  private string $userName = '';
  private string $userPassword = '';
  private string $baseUrl = '';
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
    } else {
      die( 'No env.json Provided' );
    }

    return $this;
  }
  //#endregion

  //#region Core Functions
  public function getRequest( string $url, object $params ): GetResponse
  {
    $emptyParams = new stdClass();
    $response = new GetResponse( $emptyParams );
    $paramsString = '';

    if ( $this->baseUrl === '' ) {
      $response->errors[] = 'No Base URL Specified';
    }

    if ( $url === '' ) {
      $response->errors[] = 'No URL Provided';
    }

    if ( $this->userName === '' && $this->userPassword === '' ) {
      $response->errors[] = 'No Credentials';
    }

    if ( sizeof( $response->errors ) === 0 ) {
      if ( count( get_object_vars( $params ) ) > 0 ) {
        $paramsString = '?' . http_build_query( $params );
      }

      $response->url = $this->baseUrl . $url . $paramsString;;

      $ch = curl_init();

      curl_setopt( $ch, CURLOPT_USERPWD, $this->userName . ":" . $this->userPassword );
      curl_setopt( $ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, [ "Accept: application/json" ] );
      curl_setopt( $ch, CURLOPT_HEADER, false );
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      curl_setopt( $ch, CURLOPT_URL, $response->url );

      $result = curl_exec( $ch );

      if ( $result !== false ) {
        $response->success = true;
        $response->result = $result;

        if ( strlen( $response->result ) > 1 ) {
          $response->data = json_decode( $response->result );
        }
      } else {
        $response->errors[] = curl_error( $ch );
      }

      curl_close( $ch );
    }

    return $response;
  }
  //#endregion

  //#region Interest Profiler (MyNextMove)
  /**
   * @param  InterestProfilerParams  $params
   *
   * @return GetResponse
   */
  public function getInterestProfilerQuestionsShort( InterestProfilerParams $params ): GetResponse
  {
    return $this->getRequest( 'mnm/interestprofiler/questions_30', $params );
  }

  /**
   * @param  InterestProfilerParams  $params
   *
   * @return GetResponse
   */
  public function getInterestProfilerQuestionsLong( InterestProfilerParams $params ): GetResponse
  {
    return $this->getRequest( 'mnm/interestprofiler/questions', $params );
  }

  /**
   * @param  InterestProfilerResultsParams  $params
   *
   * @return GetResponse
   */
  public function getResults( InterestProfilerResultsParams $params ): GetResponse
  {
    return $this->getRequest( 'mnm/interestprofiler/results', $params );
  }

  public function getJobZones(): GetResponse
  {
    $params = new stdClass();

    return $this->getRequest( 'mnm/interestprofiler/job_zones', $params );
  }

  /**
   * @param  InterestProfilerCareers  $params
   *
   * @return GetResponse
   */
  public function getMatchingCareers( InterestProfilerCareers $params ): GetResponse
  {
    return $this->getRequest( 'mnm/interestprofiler/careers', $params );
  }
  //#endregion
}