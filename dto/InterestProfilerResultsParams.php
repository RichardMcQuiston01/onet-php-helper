<?php

namespace com\mcqsoft\OnetAPIHelper\DTO;

class InterestProfilerResultsParams {
  public string $answers;

  public function __construct( object $params )
  {
    if ( count( get_object_vars( $params ) ) > 0 ) {
      foreach ( $params as $key => $value ) {
        if ( property_exists( $this, $key ) ) {
          $this->$key = $value;
        }
      }
    }
  }

  public function getAnswers(): string
  {
    return $this->answers;
  }

  public function setAnswers( string $answers ): void
  {
    $this->answers = $answers;
  }

}