<?php

use yii\db\Migration;

class m170219_100846_quote_status extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%quote_status}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%quote_status}}');
    }
}
