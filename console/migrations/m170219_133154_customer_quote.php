<?php

use yii\db\Migration;

class m170219_133154_customer_quote extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%customer_quote}}', [
            'id' => $this->primaryKey(),
            'client' => $this->string()->notNull(),
            'contact' => $this->string()->notNull(),
            'telephone' => $this->string()->notNull(),
            'address' => $this->text()->notNull(),
            'quote_number' => $this->string()->notNull(),
            'quote_amount' => $this->string()->notNull(),
            'quote_status_id' => $this->integer()->notNull(),
            'notes' => $this->text()
        ], $tableOptions);

        // Quote Status
        $this->createIndex('QUOTE_STATUS_INDEX', '{{%customer_quote}}', 'quote_status_id');
        $this->addForeignKey('QUOTE_STATUS',
            '{{%customer_quote}}', 'quote_status_id', '{{%quote_status}}', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('QUOTE_STATUS', '{{%customer_quote}}');
        $this->dropTable('{{%customer_quote}}');
    }
}
