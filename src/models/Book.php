<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    public static function tableName()
    {
        return 'book';
    }

    public function rules()
    {
        return [
            [['isbn', 'title', 'author', 'price'], 'required'],
            [['title', 'author'], 'string', 'max' => 255],
        ];
    }
}
