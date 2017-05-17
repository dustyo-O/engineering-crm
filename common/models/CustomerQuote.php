<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer_quote}}".
 *
 * @property integer $id
 * @property string $client
 * @property string $contact
 * @property string $telephone
 * @property string $address
 * @property string $quote_number
 * @property string $quote_amount
 * @property integer $quote_status_id
 * @property string $notes
 *
 * @property Customer[] $customers
 * @property QuoteStatus $quoteStatus
 * @property Documents[] $documents
 */
class CustomerQuote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_quote}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address', 'notes'], 'string'],
            [['quote_status_id'], 'integer'],
            [['client', 'contact', 'telephone', 'quote_number', 'quote_amount'], 'string', 'max' => 255],
            [['quote_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuoteStatus::className(), 'targetAttribute' => ['quote_status_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client' => 'Client',
            'contact' => 'Contact',
            'telephone' => 'Telephone',
            'address' => 'Address',
            'quote_number' => 'Quote Number',
            'quote_amount' => 'Quote Amount',
            'quote_status_id' => 'Quote Status',
            'notes' => 'Notes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['quote_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuoteStatus()
    {
        return $this->hasOne(QuoteStatus::className(), ['id' => 'quote_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['id' => 'document_id'])->viaTable('{{%quote_documents}}', ['quote_id' => 'id']);
    }

    public function beforeDelete()
    {
        QuoteDocuments::deleteAll(['quote_id' => $this->id]);
        return parent::beforeDelete();
    }
}
