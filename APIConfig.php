<?php

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
    if ( file_exists( $this->fileName ) ) {
      $this->fileData = file_get_contents( $this->fileName );
    }

    return $this;
  }

  public function getFileData(): string
  {
    return $this->fileData;
  }

  public function asJSON(): object {
    if( $this->fileData !== '' ) {
      return json_decode( $this->fileData );
    }

    return new stdClass();
  }

}