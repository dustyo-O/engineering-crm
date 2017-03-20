<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subcontractor_other3_label}}".
 *
 * @property integer $id
 * @property string $title
 */
class SubcontractorOther3Label extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subcontractor_other3_label}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }
}
