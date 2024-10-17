<?php
// helpers/router.php

require_once '../config/database.php'; 

function routeRequest() {                                                                           // Dynamic router configuration
    global $conn;

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    $routes = require_once '../app/core/routes.php';                                                   // Route list

    foreach ($routes as $route) {
        error_log("Checking route: " . $route['path'] . " against URI: " . $uri);
        if ($route['path'] === $uri && $route['method'] === $method) {
            require_once BASE_PATH . '/app/controllers/' . $route['controller'] . '.php';
            
            // Instantiate the controller with the correct database connection variable
            $controller = new $route['controller']($conn); 
            $action = $route['action'];

            // Render header
            include BASE_PATH . '/views/layout/header.php';
            $controller->$action(); 
            // Render footer
            return;
        }
    }

    // If no route matched, show a 404 error
    http_response_code(404);
    echo "404 Not Found: " . htmlspecialchars($uri)."<br>";
    echo "Method: " . $method . "<br>";
}
