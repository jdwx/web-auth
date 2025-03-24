<?php


declare( strict_types = 1 );


require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/ExampleHtmlPage.php';
require_once __DIR__ . '/ExampleRouter.php';
require_once __DIR__ . '/ExampleShim.php';
require_once __DIR__ . '/Routes/ExampleAdminRoute.php';
require_once __DIR__ . '/Routes/ExampleApiRoute.php';
require_once __DIR__ . '/Routes/ExampleLoginRoute.php';
require_once __DIR__ . '/Routes/ExamplePublicRoute.php';
require_once __DIR__ . '/Routes/ExampleSignupRoute.php';
require_once __DIR__ . '/Routes/ExampleUserRoute.php';


( new ExampleShim() )->run();
