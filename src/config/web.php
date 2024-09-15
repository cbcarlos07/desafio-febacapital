<?php
require __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

// Carregue o .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '7UM6LlhCxpYwNv4uFxZPEvrBxTqRbTLM',
            'enableCsrfValidation' => false,  // Desabilita a proteção CSRF para APIs
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',  // Permite parsing de JSON
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,  // Desabilita auto-login via sessão
            'loginUrl' => null,  // Evita redirecionamento para página de login
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true, 
            'rules' => [
                'POST auth' => 'auth/login',
                'cliente' => 'client/index',    
                'cliente/<id:\d+>' => 'client/view',  
                'cliente/criar' => 'client/create',   
                'cliente/atualizar/<id:\d+>' => 'client/update',  
                'cliente/deletar/<id:\d+>' => 'client/delete',
                'cliente/paginate' => 'client/paginate'
            ],
        ],
         
        'jwt' => [
            'class' => \sizeg\jwt\Jwt::class,
            'key' => $_ENV['JWT_TOKEN']
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
