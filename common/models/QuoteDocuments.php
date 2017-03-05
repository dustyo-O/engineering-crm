<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%quote_documents}}".
 *
 * @property integer $quote_id
 * @property integer $document_id
 *
 * @property CustomerQuote $quote
 * @property Documents $document
 */
class QuoteDocuments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%quote_documents}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quote_id', 'document_id'], 'required'],
            [['quote_id', 'document_id'], 'integer'],
            [['quote_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerQuote::className(), 'targetAttribute' => ['quote_id' => 'id']],
            [['document_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['document_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'quote_id' => 'Quote ID',
            'document_id' => 'Document ID',
        ];
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
    public function getDocument()
    {
        return $this->hasOne(Documents::className(), ['id' => 'document_id']);
    }
}
