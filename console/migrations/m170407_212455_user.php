<?php

use yii\db\Migration;

class m170407_212455_user extends Migration
{
    public function safeUp()
    {
        // create user admin:admin
        $user = new \common\models\User();

        $user->username = 'admin';
        $user->email = 'admin@localhost';

        $user->setPassword('admin');
        $user->generateAuthKey();

        $user->save();
    }

    public function safeDown()
    {
        \common\models\User::deleteAll(['username' => 'admin']);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
