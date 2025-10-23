<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\TestController;

$app = new TestController;
$app->run();


use Carbon\Carbon;

echo Carbon::now()->format('Y-m-d H:i:s');
// composerにはCarbon以外にもたくさんのライブラリがある