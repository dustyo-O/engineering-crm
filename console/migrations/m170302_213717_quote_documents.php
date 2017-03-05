<?php

use yii\db\Migration;

class m170302_213717_quote_documents extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%quote_documents}}', [
            'quote_id' => $this->integer()->notNull(),
            'document_id' => $this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex('DOCUMENT_QUOTE_INDEX', '{{%quote_documents}}', 'quote_id');
        $this->addForeignKey('DOCUMENT_QUOTE', '{{%quote_documents}}', 'quote_id', '{{%customer_quote}}', 'id');

        $this->createIndex('QUOTE_DOCUMENT_INDEX', '{{%quote_documents}}', 'document_id');
        $this->addForeignKey('QUOTE_DOCUMENT', '{{%quote_documents}}', 'document_id', '{{%documents}}', 'id');

        $this->addPrimaryKey('QUOTE_DOCUMENTS_PK', '{{%quote_documents}}', ['quote_id', 'document_id']);
    }

    public function safeDown()
    {
        $this->dropForeignKey('DOCUMENT_QUOTE', '{{%quote_documents}}');
        $this->dropForeignKey('QUOTE_DOCUMENT', '{{%quote_documents}}');

        $this->dropTable('{{%quote_documents}}');
    }
}
