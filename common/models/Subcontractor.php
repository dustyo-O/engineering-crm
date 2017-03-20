<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subcontractor}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $company_name
 * @property string $date_of_commencement
 * @property string $address
 * @property integer $status_id
 * @property string $telephone
 * @property string $mobile
 * @property string $email
 * @property string $ni_number
 * @property string $staff_number
 * @property integer $position_id
 * @property string $vehicle_reg
 * @property string $ipaf
 * @property integer $cscs
 * @property string $driving_license
 * @property integer $other1_label_id
 * @property integer $other1
 * @property integer $other2_label_id
 * @property integer $other2
 * @property integer $other3_label_id
 * @property integer $other3
 * @property integer $first_aid_id
 * @property string $subcontractor_pack
 * @property string $training_courses
 * @property string $qualifications
 * @property string $insurance_expire
 * @property string $screening
 * @property string $hs_pack
 * @property string $notes
 * @property integer $photo_id
 *
 * @property SubcontractorFirstAid $firstAid
 * @property SubcontractorOther1Label $other1Label
 * @property SubcontractorOther1Label $other2Label
 * @property SubcontractorOther1Label $other3Label
 * @property Documents $photo
 * @property SubcontractorPosition $position
 * @property SubcontractorStatus $status
 * @property SubcontractorDocuments[] $subcontractorDocuments
 * @property Documents[] $documents
 */
class Subcontractor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subcontractor}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'company_name', 'date_of_commencement', 'address', 'status_id', 'telephone', 'mobile', 'email', 'ni_number', 'staff_number', 'position_id', 'vehicle_reg', 'ipaf', 'cscs', 'driving_license', 'other1_label_id', 'other1', 'other2_label_id', 'other2', 'other3_label_id', 'other3', 'first_aid_id', 'subcontractor_pack', 'training_courses', 'qualifications', 'insurance_expire', 'screening', 'hs_pack', 'notes', 'photo_id'], 'required'],
            [['address', 'training_courses', 'qualifications', 'notes'], 'string'],
            [['status_id', 'position_id', 'cscs', 'other1_label_id', 'other1', 'other2_label_id', 'other2', 'other3_label_id', 'other3', 'first_aid_id', 'photo_id'], 'integer'],
            [['subcontractor_pack', 'insurance_expire', 'screening', 'hs_pack'], 'safe'],
            [['name', 'company_name', 'date_of_commencement', 'telephone', 'mobile', 'email', 'ni_number', 'staff_number', 'vehicle_reg', 'ipaf', 'driving_license'], 'string', 'max' => 255],
            [['first_aid_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubcontractorFirstAid::className(), 'targetAttribute' => ['first_aid_id' => 'id']],
            [['other1_label_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubcontractorOther1Label::className(), 'targetAttribute' => ['other1_label_id' => 'id']],
            [['other2_label_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubcontractorOther1Label::className(), 'targetAttribute' => ['other2_label_id' => 'id']],
            [['other3_label_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubcontractorOther1Label::className(), 'targetAttribute' => ['other3_label_id' => 'id']],
            [['photo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['photo_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubcontractorPosition::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubcontractorStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'company_name' => 'Company Name',
            'date_of_commencement' => 'Date Of Commencement',
            'address' => 'Address',
            'status_id' => 'Status ID',
            'telephone' => 'Telephone',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'ni_number' => 'Ni Number',
            'staff_number' => 'Staff Number',
            'position_id' => 'Position ID',
            'vehicle_reg' => 'Vehicle Reg',
            'ipaf' => 'Ipaf',
            'cscs' => 'Cscs',
            'driving_license' => 'Driving License',
            'other1_label_id' => 'Other1 Label ID',
            'other1' => 'Other1',
            'other2_label_id' => 'Other2 Label ID',
            'other2' => 'Other2',
            'other3_label_id' => 'Other3 Label ID',
            'other3' => 'Other3',
            'first_aid_id' => 'First Aid ID',
            'subcontractor_pack' => 'Subcontractor Pack',
            'training_courses' => 'Training Courses',
            'qualifications' => 'Qualifications',
            'insurance_expire' => 'Insurance Expire',
            'screening' => 'Screening',
            'hs_pack' => 'Hs Pack',
            'notes' => 'Notes',
            'photo_id' => 'Photo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirstAid()
    {
        return $this->hasOne(SubcontractorFirstAid::className(), ['id' => 'first_aid_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOther1Label()
    {
        return $this->hasOne(SubcontractorOther1Label::className(), ['id' => 'other1_label_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOther2Label()
    {
        return $this->hasOne(SubcontractorOther1Label::className(), ['id' => 'other2_label_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOther3Label()
    {
        return $this->hasOne(SubcontractorOther1Label::className(), ['id' => 'other3_label_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoto()
    {
        return $this->hasOne(Documents::className(), ['id' => 'photo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(SubcontractorPosition::className(), ['id' => 'position_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(SubcontractorStatus::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcontractorDocuments()
    {
        return $this->hasMany(SubcontractorDocuments::className(), ['subcontractor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['id' => 'document_id'])->viaTable('{{%subcontractor_documents}}', ['subcontractor_id' => 'id']);
    }
}
