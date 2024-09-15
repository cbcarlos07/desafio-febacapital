<?php
require __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;


// Ajuste o caminho conforme necessário
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load(); // safeLoad não gera exceção se o arquivo não existir

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';



$config = require __DIR__ . '/../config/web.php';



(new yii\web\Application($config))->run();
