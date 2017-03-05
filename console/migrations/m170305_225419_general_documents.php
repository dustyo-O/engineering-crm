<?php

use yii\db\Migration;

class m170305_225419_general_documents extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%general_documents}}', [
            'general_id' => $this->integer()->notNull(),
            'document_id' => $this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex('DOCUMENT_GENERAL_INDEX', '{{%general_documents}}', 'general_id');
        $this->addForeignKey('DOCUMENT_GENERAL', '{{%general_documents}}', 'general_id', '{{%customer_general}}', 'id');

        $this->createIndex('GENERAL_DOCUMENT_INDEX', '{{%general_documents}}', 'document_id');
        $this->addForeignKey('GENERAL_DOCUMENT', '{{%general_documents}}', 'document_id', '{{%documents}}', 'id');

        $this->addPrimaryKey('GENERAL_DOCUMENTS_PK', '{{%general_documents}}', ['general_id', 'document_id']);
    }

    public function safeDown()
    {
        $this->dropForeignKey('DOCUMENT_GENERAL', '{{%general_documents}}');
        $this->dropForeignKey('GENERAL_DOCUMENT', '{{%general_documents}}');

        $this->dropTable('{{%general_documents}}');
    }
}
