<?php
// public/index.php

define('BASE_PATH', realpath(__DIR__ . '/../')); // basePath

require_once '../config/database.php';  // Database configuration
require_once '../helpers/router.php';  // Router configuration

routeRequest();     // route request 
