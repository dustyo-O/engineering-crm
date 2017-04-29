<?php

use yii\db\Migration;

class m170423_222853_drop_general_misc extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('GENERAL_MISC1', '{{%customer_general}}');
        $this->dropIndex('MISC1_INDEX', '{{%customer_general}}');

        $this->dropColumn('{{%customer_general}}', 'misc1_id');

        $this->dropTable('{{%general_misc1}}');

        $this->addColumn('{{%customer_general}}', 'misc1',
            $this->integer() . ' AFTER misc1_label_id');


        $this->dropForeignKey('GENERAL_MISC2', '{{%customer_general}}');
        $this->dropIndex('MISC2_INDEX', '{{%customer_general}}');

        $this->dropColumn('{{%customer_general}}', 'misc2_id');

        $this->dropTable('{{%general_misc2}}');

        $this->addColumn('{{%customer_general}}', 'misc2',
            $this->integer() . ' AFTER misc2_label_id');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%customer_general}}', 'misc1');

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%general_misc1}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ], $tableOptions);

        $this->addColumn('{{%customer_general}}', 'misc1_id',
            $this->integer() . ' AFTER misc1_label_id');

        // Misc1 Value
        $this->createIndex('MISC1_INDEX', '{{%customer_general}}', 'misc1_id');
        $this->addForeignKey('GENERAL_MISC1',
            '{{%customer_general}}', 'misc1_id', '{{%general_misc1}}', 'id');

        $this->dropColumn('{{%customer_general}}', 'misc2');

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%general_misc2}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ], $tableOptions);

        $this->addColumn('{{%customer_general}}', 'misc2_id',
            $this->integer() . ' AFTER misc2_label_id');

        // Misc2 Value
        $this->createIndex('MISC2_INDEX', '{{%customer_general}}', 'misc2_id');
        $this->addForeignKey('GENERAL_MISC2',
            '{{%customer_general}}', 'misc2_id', '{{%general_misc2}}', 'id');

    }
}
