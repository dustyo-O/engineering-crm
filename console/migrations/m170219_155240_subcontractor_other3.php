<?php

use yii\db\Migration;

class m170219_155240_subcontractor_other3 extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%subcontractor_other3}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%subcontractor_other3}}');
    }
}
