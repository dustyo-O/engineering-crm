<?php

use yii\db\Migration;

class m170219_152326_service extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'customer' => $this->string()->notNull(),
            'contact' => $this->string()->notNull(),
            'telephone' => $this->string()->notNull(),
            'address' => $this->text()->notNull(),
            'call_type_id' => $this->integer()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'time' => $this->integer()->notNull(),
            'problem_reported' => $this->string()->notNull()
        ], $tableOptions);

        // Call Type
        $this->createIndex('SERVICE_CALL_TYPE_INDEX', '{{%service}}', 'call_type_id');
        $this->addForeignKey('SERVICE_CALL_TYPE', '{{%service}}', 'call_type_id', '{{%service_call_type}}', 'id');

    }

    public function safeDown()
    {
        $this->dropForeignKey('SERVICE_CALL_TYPE', '{{%service}}');
        $this->dropTable('{{%service}}');
    }
}
