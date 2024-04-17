<?php

namespace com\mcqsoft\OnetAPIHelper;

class GetResponse
{
  public bool $success = false;
  public string $url = '';
  public string $result = '';
  public object $data;
  public array $errors = [];

  public function __construct( ?object $params )
  {
    $this->data = new \stdClass();

    if ( count( get_object_vars( $params ) ) > 0 ) {
      foreach ( $params as $key => $value ) {
        if ( property_exists( $this, $key ) ) {
          $this->$key = $value;
        }
      }
    }
  }

  public function isSuccess(): bool
  {
    return $this->success;
  }

  public function setSuccess( bool $success ): void
  {
    $this->success = $success;
  }

  public function getUrl(): string
  {
    return $this->url;
  }

  public function setUrl( string $url ): void
  {
    $this->url = $url;
  }

  public function getResult(): string
  {
    return $this->result;
  }

  public function setResult( string $result ): void
  {
    $this->result = $result;
  }

  public function getData(): object
  {
    return $this->data;
  }

  public function setData( object $data ): void
  {
    $this->data = $data;
  }

  public function getErrors(): array
  {
    return $this->errors;
  }

  public function setErrors( array $errors ): void
  {
    $this->errors = $errors;
  }

}
