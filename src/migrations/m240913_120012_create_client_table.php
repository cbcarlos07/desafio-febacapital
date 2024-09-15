<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client}}`.
 */
class m240913_120012_create_client_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'cpf' => $this->string(11)->notNull()->unique(),
            'address' => $this->string()->notNull(),
            'home_nr' => $this->string(),
            'neighborhood' => $this->string(),
            'city' => $this->string()->notNull(),
            'state' => $this->string(2)->notNull(),
            'gender' => $this->char(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%client}}');
    }
}
