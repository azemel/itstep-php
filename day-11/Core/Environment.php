<?php

namespace pd\core;

class Environment {

  const DEVELOPMENT = 1;
  const PRODUCTION = 2;  

  public $uriRoot = "";
  public $mode = Environment::PRODUCTION;

  public $clientIp;

  public function __construct(array $options = []) {
    
    $this->clientIp = $_SERVER["REMOTE_ADDR"];

    if (array_key_exists("mode", $options)) {

      $this->mode = $options["mode"];
    
    } else if(getenv("ENV") !== false) {
    
      $this->mode = getenv("ENV") === "DEV" ? self::DEVELOPMENT : self::PRODUCTION;
    
    } else {
     
      $this->mode = $this->isLocalRequest() ? self::DEVELOPMENT : self::PRODUCTION;
    
    }
    
    if (array_key_exists("uriRoot", $options)) {
      $this->uriRoot = $options["uriRoot"];
    }

  }

  public function isLocalRequest() {
    return $this->clientIp === "::1" || $this->clientIp === "127.0.0.1";
  }

}