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
            'company_name' => $this->string(),
            'date_of_commencement' => $this->dateTime(),
            'address' => $this->text(),
            'status_id' => $this->integer(),
            'telephone' => $this->string(),
            'mobile' => $this->string(),
            'email' => $this->string(),
            'ni_number' => $this->string(),
            'staff_number' => $this->string(),
            'position_id' => $this->integer(),
            'vehicle_reg' => $this->string(),
            'ipaf' => $this->string(),
            'cscs' => $this->integer(),
            'driving_license' => $this->string(),
            'other1_label_id' => $this->integer(),
            'other1' => $this->integer(),
            'other2_label_id' => $this->integer(),
            'other2' => $this->integer(),
            'other3_label_id' => $this->integer(),
            'other3' => $this->integer(),
            'first_aid_id' => $this->integer(),
            'subcontractor_pack' => $this->dateTime(),
            'training_courses' => $this->text(),
            'qualifications' => $this->text(),
            'insurance_expire' => $this->dateTime(),
            'screening' => $this->dateTime(),
            'hs_pack' => $this->dateTime(),
            'notes' => $this->text()
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
