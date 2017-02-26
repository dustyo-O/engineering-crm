<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer_system_type}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Customer[] $customers
 */
class CustomerSystemType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_system_type}}';
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
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['system_type_id' => 'id']);
    }
}
