<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%general_signalling_type}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property CustomerGeneral[] $customerGenerals
 */
class GeneralSignallingType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%general_signalling_type}}';
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
        return $this->hasMany(CustomerGeneral::className(), ['signalling_type_id' => 'id']);
    }
}
