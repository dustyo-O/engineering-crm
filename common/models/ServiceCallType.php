<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%service_call_type}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Service[] $services
 */
class ServiceCallType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_call_type}}';
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
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['call_type_id' => 'id']);
    }
}
