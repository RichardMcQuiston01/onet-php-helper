<?php

namespace com\mcqsoft\OnetAPIHelper\DTO;

class InterestProfilerParams
{
  public int $start;
  public int $end;

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

  public function getStart(): int
  {
    return $this->start;
  }

  public function setStart( int $start ): void
  {
    $this->start = $start;
  }

  public function getEnd(): int
  {
    return $this->end;
  }

  public function setEnd( int $end ): void
  {
    $this->end = $end;
  }
}