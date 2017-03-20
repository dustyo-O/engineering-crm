<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subcontractor_other1_label}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Subcontractor[] $subcontractors
 * @property Subcontractor[] $subcontractors0
 * @property Subcontractor[] $subcontractors1
 */
class SubcontractorOther1Label extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subcontractor_other1_label}}';
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
    public function getSubcontractors()
    {
        return $this->hasMany(Subcontractor::className(), ['other1_label_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcontractors0()
    {
        return $this->hasMany(Subcontractor::className(), ['other2_label_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcontractors1()
    {
        return $this->hasMany(Subcontractor::className(), ['other3_label_id' => 'id']);
    }
}
