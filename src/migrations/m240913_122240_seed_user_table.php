<?php

use yii\db\Migration;

/**
 * Class m240913_122240_seed_user_table
 */
class m240913_122240_seed_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('user', ['username','name','password_hash'], [
            ['admin','Administrador', Yii::$app->security->generatePasswordHash('admin123')],
            ['user','Usuário', Yii::$app->security->generatePasswordHash('user123')],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user', ['username' => ['admin', 'user']]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240913_122240_seed_user_table cannot be reverted.\n";

        return false;
    }
    */
}
