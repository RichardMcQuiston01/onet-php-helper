<?php

namespace com\mcqsoft\OnetAPIHelper\DTO;

class InterestProfilerCareers
{
  public string $answers;
  public string $area;
  public int $Realistic;
  public int $Investigative;
  public int $Artistic;
  public int $Social;
  public int $Enterprising;
  public int $Conventional;
  public int $job_zone;

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

  public function getArea(): string
  {
    return $this->area;
  }

  public function setArea( string $area ): void
  {
    $this->area = $area;
  }

  public function getRealistic(): int
  {
    return $this->Realistic;
  }

  public function setRealistic( int $Realistic ): void
  {
    $this->Realistic = $Realistic;
  }

  public function getInvestigative(): int
  {
    return $this->Investigative;
  }

  public function setInvestigative( int $Investigative ): void
  {
    $this->Investigative = $Investigative;
  }

  public function getArtistic(): int
  {
    return $this->Artistic;
  }

  public function setArtistic( int $Artistic ): void
  {
    $this->Artistic = $Artistic;
  }

  public function getSocial(): int
  {
    return $this->Social;
  }

  public function setSocial( int $Social ): void
  {
    $this->Social = $Social;
  }

  public function getEnterprising(): int
  {
    return $this->Enterprising;
  }

  public function setEnterprising( int $Enterprising ): void
  {
    $this->Enterprising = $Enterprising;
  }

  public function getConventional(): int
  {
    return $this->Conventional;
  }

  public function setConventional( int $Conventional ): void
  {
    $this->Conventional = $Conventional;
  }

  public function getJobZone(): int
  {
    return $this->job_zone;
  }

  public function setJobZone( int $job_zone ): void
  {
    $this->job_zone = $job_zone;
  }

}