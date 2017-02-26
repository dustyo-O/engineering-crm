<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%general_misc2_label}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property CustomerGeneral[] $customerGenerals
 */
class GeneralMisc2Label extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%general_misc2_label}}';
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerGenerals()
    {
        return $this->hasMany(CustomerGeneral::className(), ['misc2_label_id' => 'id']);
    }
}
