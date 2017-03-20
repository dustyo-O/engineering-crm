<?php

use yii\db\Migration;

class m170320_114015_subcontractor_photo extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%subcontractor}}', 'photo_id', $this->integer()->notNull());

        $this->createIndex('SUBCONTRACTOR_PHOTO_INDEX', '{{%subcontractor}}', 'photo_id');
        $this->addForeignKey('SUBCONTRACTOR_PHOTO',
            '{{%subcontractor}}', 'photo_id', '{{%documents}}', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('SUBCONTRACTOR_PHOTO', '{{%subcontractor}}');

        $this->dropColumn('{{%subcontractor}}', 'photo_id');
    }
}
