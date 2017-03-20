<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subcontractor_position}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Subcontractor[] $subcontractors
 */
class SubcontractorPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subcontractor_position}}';
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
        return $this->hasMany(Subcontractor::className(), ['position_id' => 'id']);
    }
}
