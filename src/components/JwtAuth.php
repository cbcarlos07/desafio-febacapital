<?php

namespace app\components;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Constraint\ValidAt;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Token\Plain;

class JwtAuth extends ActionFilter
{
    public $key = 'desafio';

    /** @var Configuration */
    protected $config;

    public function init()
    {
        $this->key = $_ENV['JWT_TOKEN'];
        parent::init();
        
        $this->config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText($this->key)
        );
    }

    public function beforeAction($action)
    {
        $request = Yii::$app->request;
        $authorizationHeader = $request->headers->get('Authorization');

        if (!$authorizationHeader || !preg_match('/Bearer\s(\S+)/', $authorizationHeader, $matches)) {
            throw new ForbiddenHttpException('Authorization header is missing or invalid.');
        }

        $tokenString = $matches[1];

        try {
            
            $parser = $this->config->parser();
            
            $token = $parser->parse($tokenString);

            
            $constraints = [
                new SignedWith($this->config->signer(), $this->config->verificationKey()),
                new ValidAt(new SystemClock(new \DateTimeZone('UTC'))),
            ];

            
            if (!$this->config->validator()->validate($token, ...$constraints)) {
                throw new ForbiddenHttpException('Token is not valid.');
            }

            
            $userId = $token->claims()->get('sub');

            
            $user = \app\models\User::findIdentity($userId);

            if (!$user) {
                throw new ForbiddenHttpException('User not found.');
            }

            // Logar o usuário no Yii2
            Yii::$app->user->login($user, 0); 
        } catch (\Exception $e) {
            Yii::$app->response->statusCode = 401;
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::$app->response->data = ['error' => $e->getMessage()];
            return false;
        }

        return parent::beforeAction($action);
    }
}
