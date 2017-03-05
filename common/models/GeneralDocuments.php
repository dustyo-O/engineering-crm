<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%general_documents}}".
 *
 * @property integer $general_id
 * @property integer $document_id
 *
 * @property CustomerGeneral $general
 * @property Documents $document
 */
class GeneralDocuments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%general_documents}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['general_id', 'document_id'], 'required'],
            [['general_id', 'document_id'], 'integer'],
            [['general_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerGeneral::className(), 'targetAttribute' => ['general_id' => 'id']],
            [['document_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['document_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'general_id' => 'General ID',
            'document_id' => 'Document ID',
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
    public function getDocument()
    {
        return $this->hasOne(Documents::className(), ['id' => 'document_id']);
    }
}
