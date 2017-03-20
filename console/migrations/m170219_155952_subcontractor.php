<?php

use yii\db\Migration;

class m170219_155952_subcontractor extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%subcontractor}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'company_name' => $this->string()->notNull(),
            'date_of_commencement' => $this->dateTime()->notNull(),
            'address' => $this->text()->notNull(),
            'status_id' => $this->integer()->notNull(),
            'telephone' => $this->string()->notNull(),
            'mobile' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'ni_number' => $this->string()->notNull(),
            'staff_number' => $this->string()->notNull(),
            'position_id' => $this->integer()->notNull(),
            'vehicle_reg' => $this->string()->notNull(),
            'ipaf' => $this->string()->notNull(),
            'cscs' => $this->integer()->notNull(),
            'driving_license' => $this->string()->notNull(),
            'other1_label_id' => $this->integer()->notNull(),
            'other1' => $this->integer()->notNull(),
            'other2_label_id' => $this->integer()->notNull(),
            'other2' => $this->integer()->notNull(),
            'other3_label_id' => $this->integer()->notNull(),
            'other3' => $this->integer()->notNull(),
            'first_aid_id' => $this->integer()->notNull(),
            'subcontractor_pack' => $this->dateTime()->notNull(),
            'training_courses' => $this->text()->notNull(),
            'qualifications' => $this->text()->notNull(),
            'insurance_expire' => $this->dateTime()->notNull(),
            'screening' => $this->dateTime()->notNull(),
            'hs_pack' => $this->dateTime()->notNull(),
            'notes' => $this->text()->notNull()
        ], $tableOptions);


        // Status
        $this->createIndex('SUBCONTRACTOR_STATUS_INDEX', '{{%subcontractor}}', 'status_id');
        $this->addForeignKey('SUBCONTRACTOR_STATUS',
            '{{%subcontractor}}', 'status_id', '{{%subcontractor_status}}', 'id');

        // Position
        $this->createIndex('SUBCONTRACTOR_POSITION_INDEX', '{{%subcontractor}}', 'position_id');
        $this->addForeignKey('SUBCONTRACTOR_POSITION',
            '{{%subcontractor}}', 'position_id', '{{%subcontractor_position}}', 'id');

        // Other1 Label
        $this->createIndex('SUBCONTRACTOR_OTHER1_LABEL_INDEX', '{{%subcontractor}}', 'other1_label_id');
        $this->addForeignKey('SUBCONTRACTOR_OTHER1_LABEL',
            '{{%subcontractor}}', 'other1_label_id', '{{%subcontractor_other1_label}}', 'id');

        // Other2 Label
        $this->createIndex('SUBCONTRACTOR_OTHER2_LABEL_INDEX', '{{%subcontractor}}', 'other2_label_id');
        $this->addForeignKey('SUBCONTRACTOR_OTHER2_LABEL',
            '{{%subcontractor}}', 'other2_label_id', '{{%subcontractor_other1_label}}', 'id');

        // Other3 Label
        $this->createIndex('SUBCONTRACTOR_OTHER3_LABEL_INDEX', '{{%subcontractor}}', 'other3_label_id');
        $this->addForeignKey('SUBCONTRACTOR_OTHER3_LABEL',
            '{{%subcontractor}}', 'other3_label_id', '{{%subcontractor_other1_label}}', 'id');

        // Position
        $this->createIndex('SUBCONTRACTOR_FIRST_AID_INDEX', '{{%subcontractor}}', 'first_aid_id');
        $this->addForeignKey('SUBCONTRACTOR_FIRST_AID',
            '{{%subcontractor}}', 'first_aid_id', '{{%subcontractor_first_aid}}', 'id');

    }

    public function safeDown()
    {
        $this->dropForeignKey('SUBCONTRACTOR_FIRST_AID', '{{%subcontractor}}');
        $this->dropForeignKey('SUBCONTRACTOR_OTHER3_LABEL', '{{%subcontractor}}');
        $this->dropForeignKey('SUBCONTRACTOR_OTHER2_LABEL', '{{%subcontractor}}');
        $this->dropForeignKey('SUBCONTRACTOR_OTHER1_LABEL', '{{%subcontractor}}');
        $this->dropForeignKey('SUBCONTRACTOR_POSITION', '{{%subcontractor}}');
        $this->dropForeignKey('SUBCONTRACTOR_STATUS', '{{%subcontractor}}');

        $this->dropTable('{{%subcontractor}}');
    }
}
