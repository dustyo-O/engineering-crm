<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property integer $id
 * @property integer $quote_id
 * @property integer $general_id
 * @property string $customer
 * @property string $contact
 * @property string $telephone
 * @property string $address
 * @property string $job_title
 * @property string $email
 * @property string $mobile
 * @property integer $system_type_id
 * @property integer $customer_status_id
 * @property string $account_number
 *
 * @property CustomerGeneral $general
 * @property CustomerQuote $quote
 * @property CustomerStatus $customerStatus
 * @property CustomerSystemType $systemType
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quote_id', 'general_id', 'customer', 'contact', 'telephone', 'address', 'job_title', 'email', 'mobile', 'system_type_id', 'customer_status_id', 'account_number'], 'required'],
            [['quote_id', 'general_id', 'system_type_id', 'customer_status_id'], 'integer'],
            [['address'], 'string'],
            [['customer', 'contact', 'telephone', 'job_title', 'email', 'mobile', 'account_number'], 'string', 'max' => 255],
            [['general_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerGeneral::className(), 'targetAttribute' => ['general_id' => 'id']],
            [['quote_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerQuote::className(), 'targetAttribute' => ['quote_id' => 'id']],
            [['customer_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerStatus::className(), 'targetAttribute' => ['customer_status_id' => 'id']],
            [['system_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerSystemType::className(), 'targetAttribute' => ['system_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quote_id' => 'Quote ID',
            'general_id' => 'General ID',
            'customer' => 'Customer',
            'contact' => 'Contact',
            'telephone' => 'Telephone',
            'address' => 'Address',
            'job_title' => 'Job Title',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'system_type_id' => 'System Type',
            'customer_status_id' => 'Customer Status',
            'account_number' => 'Account Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneral()
    {
        return $this->hasOne(CustomerGeneral::className(), ['id' => 'general_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuote()
    {
        return $this->hasOne(CustomerQuote::className(), ['id' => 'quote_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerStatus()
    {
        return $this->hasOne(CustomerStatus::className(), ['id' => 'customer_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemType()
    {
        return $this->hasOne(CustomerSystemType::className(), ['id' => 'system_type_id']);
    }

    public function afterDelete()
    {
        $this->quote->delete();
        $this->general->delete();

        return parent::afterDelete();
    }
}
