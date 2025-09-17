<?php

// Bootstrap app
require __DIR__ . '/../bootstrap/app.php';

use System\Application;

$app = new Application();
$app->run();
