<?php

spl_autoload_register(function($name) {
  require_once(preg_replace('/^pd\\\\/', "", $name) . ".php");
});