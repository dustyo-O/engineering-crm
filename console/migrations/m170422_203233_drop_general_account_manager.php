<?php

use yii\db\Migration;

class m170422_203233_drop_general_account_manager extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('GENERAL_ACCOUNT_MANAGER', '{{%customer_general}}');
        $this->dropIndex('ACCOUNT_MANAGER_INDEX', '{{%customer_general}}');

        $this->dropColumn('{{%customer_general}}', 'account_manager_id');

        $this->dropTable('{{%general_account_manager}}');
    }

    public function safeDown()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%general_account_manager}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ], $tableOptions);

        $this->addColumn('{{%customer_general}}', 'account_manager_id',
            $this->integer() . ' AFTER other_costs');

        // Account Manager
        $this->createIndex('ACCOUNT_MANAGER_INDEX', '{{%customer_general}}', 'account_manager_id');
        $this->addForeignKey('GENERAL_ACCOUNT_MANAGER',
            '{{%customer_general}}', 'account_manager_id', '{{%general_account_manager}}', 'id');

    }
}
