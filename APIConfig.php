<?php

namespace com\mcqsoft\OnetAPIHelper\Config;

use Exception;
use stdClass;

class APIConfig
{
  private string $fileName;
  private string $fileData;

  public function __construct( string $_fileName )
  {
    if ( $_fileName !== '' ) {
      $this->setFileName( $_fileName );
    }

    return $this;
  }

  public function setFileName( string $_fileName ): APIConfig
  {
    $this->fileName = $_fileName;

    return $this;
  }

  public function getFileName(): string
  {
    return $this->fileName;
  }

  public function loadFileData(): APIConfig
  {
    try {
      if ( file_exists( $this->fileName ) ) {
        if ( substr( strtolower( $this->fileName ), -4, 4 ) === 'json' ) {
          $this->fileData = file_get_contents( $this->fileName );
        } else {
          throw new Exception( 'Invalid Config Filename Specified - File Extension Must In in JSON' );
        }
      } else {
        throw new Exception( 'Invalid Config Filename Specified - File Does Not Exist' );
      }
    } catch ( Exception $e ) {
      die( $e->getMessage() );
    }

    return $this;
  }

  public function getFileData(): string
  {
    return $this->fileData;
  }

  public function asJSON(): object
  {
    if ( $this->fileData !== '' ) {
      return json_decode( $this->fileData );
    }

    return new stdClass();
  }

}