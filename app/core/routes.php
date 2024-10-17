<?php
// routes.php

return [
    [
        'method' => 'GET',
        'path' => '/school_management/public/',
        'controller' => 'DashboardController',
        'action' => 'homepage',
    ],
    [
        'method' => 'GET', 
        'path' => '/school_management/student/',
        'controller' => 'StudentController',
        'action' => 'studentForm',
    ],
    [
        'method' => 'POST',
        'path' => '/school_management/student/create/',
        'controller' => 'StudentController',
        'action' => 'saveStudent',
    ],
    [
        'method' => 'GET',
        'path' => '/school_management/marks/',
        'controller' => 'MarkController',
        'action' => 'markForm',
    ],
    [
        'method' => 'POST',
        'path' => '/school_management/marks/add',
        'controller' => 'MarkController',
        'action' => 'addMarks',
    ],
    [
        'method' => 'GET',
        'path' => '/school_management/report/',
        'controller' => 'ReportController',
        'action' => 'showReport',
    ],
];
