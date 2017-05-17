<?php

use yii\db\Migration;

class m170219_134711_customer extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'quote_id' => $this->integer()->notNull(),
            'general_id' => $this->integer()->notNull(),
            'customer' => $this->string()->notNull(),
            'contact' => $this->string(),
            'telephone' => $this->string(),
            'address' => $this->text(),
            'job_title' => $this->string(),
            'email' => $this->string(),
            'mobile' => $this->string(),
            'system_type_id' => $this->integer(),
            'customer_status_id' => $this->integer(),
            'account_number' => $this->string()
        ], $tableOptions);

        // Quote
        $this->createIndex('CUSTOMER_QUOTE_INDEX', '{{%customer}}', 'quote_id');
        $this->addForeignKey('CUSTOMER_QUOTE',
            '{{%customer}}', 'quote_id', '{{%customer_quote}}', 'id');

        // General
        $this->createIndex('CUSTOMER_GENERAL_INDEX', '{{%customer}}', 'general_id');
        $this->addForeignKey('CUSTOMER_GENERAL',
            '{{%customer}}', 'general_id', '{{%customer_general}}', 'id');

        // System Type
        $this->createIndex('CUSTOMER_SYSTEM_TYPE_INDEX', '{{%customer}}', 'system_type_id');
        $this->addForeignKey('CUSTOMER_SYSTEM_TYPE',
            '{{%customer}}', 'system_type_id', '{{%customer_system_type}}', 'id');

        // Customer Status
        $this->createIndex('CUSTOMER_STATUS_INDEX', '{{%customer}}', 'customer_status_id');
        $this->addForeignKey('CUSTOMER_STATUS',
            '{{%customer}}', 'customer_status_id', '{{%customer_status}}', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('CUSTOMER_QUOTE', '{{%customer}}');
        $this->dropForeignKey('CUSTOMER_GENERAL', '{{%customer}}');
        $this->dropForeignKey('CUSTOMER_SYSTEM_TYPE', '{{%customer}}');
        $this->dropForeignKey('CUSTOMER_STATUS', '{{%customer}}');

        $this->dropTable('{{%customer}}');
    }
}
