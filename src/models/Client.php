<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Client extends ActiveRecord
{
    public static function tableName()
    {
        return 'client';
    }

    public function rules()
    {
        return [
            [['name', 'cpf', 'address', 'city', 'state', 'gender'], 'required'],
            ['cpf', 'string', 'length' => 11],
            ['cpf', 'unique'],
            [['name', 'address'], 'string', 'max' => 255],
            ['gender', 'in', 'range' => ['M', 'F']], 
            [['home_nr', 'neighborhood', 'unit'], 'string', 'max' => 255],
        ];
    }
}
