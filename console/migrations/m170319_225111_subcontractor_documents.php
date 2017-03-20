<?php

use yii\db\Migration;

class m170319_225111_subcontractor_documents extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%subcontractor_documents}}', [
            'subcontractor_id' => $this->integer()->notNull(),
            'document_id' => $this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex('DOCUMENT_SUBCONTRACTOR_INDEX', '{{%subcontractor_documents}}', 'subcontractor_id');
        $this->addForeignKey('DOCUMENT_SUBCONTRACTOR', '{{%subcontractor_documents}}', 'subcontractor_id', '{{%subcontractor}}', 'id');

        $this->createIndex('SUBCONTRACTOR_DOCUMENT_INDEX', '{{%subcontractor_documents}}', 'document_id');
        $this->addForeignKey('SUBCONTRACTOR_DOCUMENT', '{{%subcontractor_documents}}', 'document_id', '{{%documents}}', 'id');

        $this->addPrimaryKey('SUBCONTRACTOR_DOCUMENTS_PK', '{{%subcontractor_documents}}', ['subcontractor_id', 'document_id']);
    }

    public function safeDown()
    {
        $this->dropForeignKey('DOCUMENT_SUBCONTRACTOR', '{{%subcontractor_documents}}');
        $this->dropForeignKey('SUBCONTRACTOR_DOCUMENT', '{{%subcontractor_documents}}');

        $this->dropTable('{{%subcontractor_documents}}');
    }
}
