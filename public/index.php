<?php
// public/index.php

define('BASE_PATH', realpath(__DIR__ . '/../')); // basePath

require_once '../config/database.php';
require_once '../helpers/router.php';

routeRequest();     // route request 
