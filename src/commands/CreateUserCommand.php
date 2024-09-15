<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\base\Exception;
use app\models\User;
use yii\base\Security;

class CreateUserCommand extends Controller
{
    public $username;
    public $password;
    public $name;
    public function options($actionID)
    {
        return ['username', 'password', 'name'];
    }

    // Defina os aliases para as opções
    public function optionAliases()
    {
        return [
            'u' => 'username',
            'p' => 'password',
            'n' => 'name',
        ];
    }

    public function actionIndex()
    {
        
        $security = new Security();
        $passwordHash = $security->generatePasswordHash($this->password);

        $user = new User();
        $user->username = $this->username;
        $user->name = $this->name;
        $user->password_hash = $passwordHash;
        
        
        if ($user->save()) {
            echo "User created successfully.\n";
            return ExitCode::OK;
        } else {
            echo "Failed to create user:\n";
            foreach ($user->errors as $error) {
                echo implode("\n", $error) . "\n";
            }
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }
}
