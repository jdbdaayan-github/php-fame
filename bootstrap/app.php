<?php
define('BASE_PATH', realpath(__DIR__ . '/..')); 

require __DIR__ . '/../vendor/autoload.php'; 

use System\Support\Env;


require __DIR__ . '/../system/Support/Helpers.php';

// Load environment variables
Env::load(__DIR__ . '/../.env');

