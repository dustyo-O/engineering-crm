<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%service}}".
 *
 * @property integer $id
 * @property string $customer
 * @property string $contact
 * @property string $telephone
 * @property string $address
 * @property integer $call_type_id
 * @property string $date
 * @property string $time
 * @property string $problem_reported
 *
 * @property ServiceCallType $callType
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer', 'contact', 'telephone', 'address', 'call_type_id', 'date', 'time', 'problem_reported'], 'required'],
            [['address'], 'string'],
            [['call_type_id'], 'integer'],
            [['date', 'time'], 'safe'],
            [['customer', 'contact', 'telephone', 'problem_reported'], 'string', 'max' => 255],
            [['call_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceCallType::className(), 'targetAttribute' => ['call_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer' => 'Customer',
            'contact' => 'Contact',
            'telephone' => 'Telephone',
            'address' => 'Address',
            'call_type_id' => 'Call Type',
            'date' => 'Date',
            'time' => 'Time',
            'problem_reported' => 'Problem Reported',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCallType()
    {
        return $this->hasOne(ServiceCallType::className(), ['id' => 'call_type_id']);
    }
}
