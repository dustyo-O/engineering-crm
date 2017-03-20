<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subcontractor_documents}}".
 *
 * @property integer $subcontractor_id
 * @property integer $document_id
 *
 * @property Subcontractor $subcontractor
 * @property Documents $document
 */
class SubcontractorDocuments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subcontractor_documents}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subcontractor_id', 'document_id'], 'required'],
            [['subcontractor_id', 'document_id'], 'integer'],
            [['subcontractor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcontractor::className(), 'targetAttribute' => ['subcontractor_id' => 'id']],
            [['document_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['document_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subcontractor_id' => 'Subcontractor ID',
            'document_id' => 'Document ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcontractor()
    {
        return $this->hasOne(Subcontractor::className(), ['id' => 'subcontractor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne(Documents::className(), ['id' => 'document_id']);
    }
}
