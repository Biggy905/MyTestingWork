<?php

require(__DIR__ . '/../vendor/autoload.php');

$env = getenv('env');

defined('YII_ENV') or define('YII_ENV', $env);
defined('YII_DEBUG') or define('YII_DEBUG', 'production' !== $env);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/console.php';

$application = new yii\console\Application($config);
$exitCode = $application->run();

exit($exitCode);
