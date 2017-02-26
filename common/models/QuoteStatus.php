<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%quote_status}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property CustomerQuote[] $customerQuotes
 */
class QuoteStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%quote_status}}';
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
    public function getCustomerQuotes()
    {
        return $this->hasMany(CustomerQuote::className(), ['quote_status_id' => 'id']);
    }
}
