<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use yii\web\Response;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use DateTimeImmutable;

class AuthController extends Controller
{
    public $enableCsrfValidation = false; // Desabilita CSRF para APIs

   

    public function actionLogin()
    {
        Yii::$app->response->format = Response::FORMAT_JSON; // Retorna JSON
        $request = Yii::$app->request;
        
        if ($request->isPost) 
        {
            $username = $request->post('username');
            $password = $request->post('password');
            
            $user = User::findByUsername($username);
            $user->password = $user->password;
           
            if ($user && $user->validatePassword($password)) {
                $config = Configuration::forSymmetricSigner(
                    new Sha256(),
                    InMemory::plainText($_ENV['JWT_TOKEN']) 
                );

                $now = new DateTimeImmutable();
                $token = $config->builder()
                    ->issuedBy('http://localhost') 
                    ->issuedAt($now)
                    ->expiresAt($now->modify('+1 hour'))
                    ->relatedTo($user->id)
                    ->getToken($config->signer(), $config->signingKey());
                $tokenString = $token->toString();  
                
                // Gerar o token de refresh
                $refreshToken = $config->builder()
                    ->issuedBy('http://localhost') 
                    ->issuedAt($now)
                    ->expiresAt($now->modify('+30 days'))
                    ->relatedTo($user->id)
                    ->getToken($config->signer(), $config->signingKey());
                $refreshTokenString = $refreshToken->toString(); 

                return [
                    'access_token' => $tokenString,
                    'refresh_token' => $refreshTokenString,
                    'username' => $user->username, 
                    'id' => $user->id];
            }
            return ['error' => 'Usuário ou senha incorretos'];
        }    

        return ['error' => 'Usuário ou senha incorretos'];
    }
}
