<?php

use yii\db\Migration;

class m170219_110428_customer_general extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%customer_general}}', [
            'id' => $this->primaryKey(),
            'key_holder_1' => $this->string(),
            'key_holder_1_email' => $this->string(),
            'key_holder_1_phone' => $this->string(),
            'key_holder_2' => $this->string(),
            'key_holder_2_email' => $this->string(),
            'key_holder_2_phone' => $this->string(),
            'maintenance_contract_id' => $this->integer(),
            'start_date' => $this->dateTime(),
            'number_of_visits' => $this->smallInteger()->unsigned(),
            'signalling_type_id' => $this->integer(),
            'urn' => $this->string(),
            'nsi_number' => $this->string(),
            'maintenance_cost' => $this->integer(),
            'monitoring_cost' => $this->integer(),
            'other_label_id' => $this->integer(),
            'other_costs' => $this->integer(),
            'account_manager_id' => $this->integer(),
            'misc1_id' => $this->integer(),
            'misc1_label_id' => $this->integer(),
            'misc2_id' => $this->integer(),
            'misc2_label_id' => $this->integer(),
            'notes' => $this->text()
        ], $tableOptions);

        // Maintenace Contract
        $this->createIndex('MAINTENANCE_CONTRACT_INDEX', '{{%customer_general}}', 'maintenance_contract_id');
        $this->addForeignKey('GENERAL_MAINTENANCE_CONTRACT',
            '{{%customer_general}}', 'maintenance_contract_id', '{{%general_maintenance_contract}}', 'id');

        // Signalling Type
        $this->createIndex('SIGNALLING_TYPE_INDEX', '{{%customer_general}}', 'signalling_type_id');
        $this->addForeignKey('GENERAL_SIGNALLING_TYPE',
            '{{%customer_general}}', 'signalling_type_id', '{{%general_signalling_type}}', 'id');

        // Other Costs Label
        $this->createIndex('OTHER_LABEL_INDEX', '{{%customer_general}}', 'other_label_id');
        $this->addForeignKey('GENERAL_OTHER_LABEL',
            '{{%customer_general}}', 'other_label_id', '{{%general_other_label}}', 'id');

        // Account Manager
        $this->createIndex('ACCOUNT_MANAGER_INDEX', '{{%customer_general}}', 'account_manager_id');
        $this->addForeignKey('GENERAL_ACCOUNT_MANAGER',
            '{{%customer_general}}', 'account_manager_id', '{{%general_account_manager}}', 'id');

        // Misc1 Label
        $this->createIndex('MISC1_LABEL_INDEX', '{{%customer_general}}', 'misc1_label_id');
        $this->addForeignKey('GENERAL_MISC1_LABEL',
            '{{%customer_general}}', 'misc1_label_id', '{{%general_misc1_label}}', 'id');

        // Misc1 Value
        $this->createIndex('MISC1_INDEX', '{{%customer_general}}', 'misc1_id');
        $this->addForeignKey('GENERAL_MISC1',
            '{{%customer_general}}', 'misc1_id', '{{%general_misc1}}', 'id');

        // Misc2 Label
        $this->createIndex('MISC2_LABEL_INDEX', '{{%customer_general}}', 'misc2_label_id');
        $this->addForeignKey('GENERAL_MISC2_LABEL',
            '{{%customer_general}}', 'misc2_label_id', '{{%general_misc2_label}}', 'id');

        // Misc2 Value
        $this->createIndex('MISC2_INDEX', '{{%customer_general}}', 'misc2_id');
        $this->addForeignKey('GENERAL_MISC2',
            '{{%customer_general}}', 'misc2_id', '{{%general_misc2}}', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('GENERAL_MISC2', '{{%customer_general}}');
        $this->dropForeignKey('GENERAL_MISC2_LABEL', '{{%customer_general}}');
        $this->dropForeignKey('GENERAL_MISC1', '{{%customer_general}}');
        $this->dropForeignKey('GENERAL_MISC1_LABEL', '{{%customer_general}}');
        $this->dropForeignKey('GENERAL_ACCOUNT_MANAGER', '{{%customer_general}}');
        $this->dropForeignKey('GENERAL_OTHER_LABEL', '{{%customer_general}}');
        $this->dropForeignKey('GENERAL_SIGNALLING_TYPE', '{{%customer_general}}');
        $this->dropForeignKey('GENERAL_MAINTENANCE_CONTRACT', '{{%customer_general}}');

        $this->dropTable('{{%customer_general}}');
    }
}
