<?php
/**
 * App's Entry Point
 * As this is simple PHP showcase no complex setup is needes such as Dependency Injection, Bootstrapping and etc...
 */

// Autoloading
require __DIR__ . '/vendor/autoload.php';

use App\App;

/** @var App $app */
$app = new App();
$app->handleRequest();