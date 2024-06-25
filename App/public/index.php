<?php

declare(strict_types=1);

require_once '../../vendor/autoload.php';

use Framework\Router;
use Framework\Session;

require_once '../../helper.php';

$lang = $_GET['langID'] ?? 'nl';
Session::start();
if (isset($_GET['langID'])) {
    Session::set('langId', $lang);
}


$router = new Router();
$routes = require basePath('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


$router->route($uri);
 