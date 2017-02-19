<?php

use yii\db\Migration;

class m170219_105712_general_misc1 extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%general_misc1}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%general_misc1}}');
    }
}
