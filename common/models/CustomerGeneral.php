<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer_general}}".
 *
 * @property integer $id
 * @property string $key_holder_1
 * @property string $key_holder_1_email
 * @property string $key_holder_1_phone
 * @property string $key_holder_2
 * @property string $key_holder_2_email
 * @property string $key_holder_2_phone
 * @property integer $maintenance_contract_id
 * @property string $start_date
 * @property integer $number_of_visits
 * @property integer $signalling_type_id
 * @property string $urn
 * @property string $nsi_number
 * @property integer $maintenance_cost
 * @property integer $monitoring_cost
 * @property integer $other_label_id
 * @property integer $other_costs
 * @property integer $account_manager_id
 * @property integer $misc1_id
 * @property integer $misc1_label_id
 * @property integer $misc2_id
 * @property integer $misc2_label_id
 * @property string $notes
 *
 * @property Customer[] $customers
 * @property GeneralAccountManager $accountManager
 * @property GeneralMaintenanceContract $maintenanceContract
 * @property GeneralMisc1 $misc1
 * @property GeneralMisc1Label $misc1Label
 * @property GeneralMisc2 $misc2
 * @property GeneralMisc2Label $misc2Label
 * @property GeneralOtherLabel $otherLabel
 * @property GeneralSignallingType $signallingType
 */
class CustomerGeneral extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_general}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key_holder_1', 'key_holder_1_email', 'key_holder_1_phone', 'key_holder_2', 'key_holder_2_email', 'key_holder_2_phone', 'maintenance_contract_id', 'start_date', 'number_of_visits', 'signalling_type_id', 'urn', 'nsi_number', 'maintenance_cost', 'monitoring_cost', 'other_label_id', 'other_costs', 'account_manager_id', 'misc1_id', 'misc1_label_id', 'misc2_id', 'misc2_label_id'], 'required'],
            [['maintenance_contract_id', 'number_of_visits', 'signalling_type_id', 'maintenance_cost', 'monitoring_cost', 'other_label_id', 'other_costs', 'account_manager_id', 'misc1_id', 'misc1_label_id', 'misc2_id', 'misc2_label_id'], 'integer'],
            [['start_date'], 'safe'],
            [['notes'], 'string'],
            [['key_holder_1', 'key_holder_1_email', 'key_holder_1_phone', 'key_holder_2', 'key_holder_2_email', 'key_holder_2_phone', 'urn', 'nsi_number'], 'string', 'max' => 255],
            [['account_manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeneralAccountManager::className(), 'targetAttribute' => ['account_manager_id' => 'id']],
            [['maintenance_contract_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeneralMaintenanceContract::className(), 'targetAttribute' => ['maintenance_contract_id' => 'id']],
            [['misc1_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeneralMisc1::className(), 'targetAttribute' => ['misc1_id' => 'id']],
            [['misc1_label_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeneralMisc1Label::className(), 'targetAttribute' => ['misc1_label_id' => 'id']],
            [['misc2_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeneralMisc2::className(), 'targetAttribute' => ['misc2_id' => 'id']],
            [['misc2_label_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeneralMisc2Label::className(), 'targetAttribute' => ['misc2_label_id' => 'id']],
            [['other_label_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeneralOtherLabel::className(), 'targetAttribute' => ['other_label_id' => 'id']],
            [['signalling_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeneralSignallingType::className(), 'targetAttribute' => ['signalling_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key_holder_1' => 'Key Holder 1',
            'key_holder_1_email' => 'Key Holder 1 Email',
            'key_holder_1_phone' => 'Key Holder 1 Phone',
            'key_holder_2' => 'Key Holder 2',
            'key_holder_2_email' => 'Key Holder 2 Email',
            'key_holder_2_phone' => 'Key Holder 2 Phone',
            'maintenance_contract_id' => 'Maintenance Contract ID',
            'start_date' => 'Start Date',
            'number_of_visits' => 'Number Of Visits',
            'signalling_type_id' => 'Signalling Type ID',
            'urn' => 'Urn',
            'nsi_number' => 'Nsi Number',
            'maintenance_cost' => 'Maintenance Cost',
            'monitoring_cost' => 'Monitoring Cost',
            'other_label_id' => 'Other Label ID',
            'other_costs' => 'Other Costs',
            'account_manager_id' => 'Account Manager ID',
            'misc1_id' => 'Misc1 ID',
            'misc1_label_id' => 'Misc1 Label ID',
            'misc2_id' => 'Misc2 ID',
            'misc2_label_id' => 'Misc2 Label ID',
            'notes' => 'Notes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['general_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountManager()
    {
        return $this->hasOne(GeneralAccountManager::className(), ['id' => 'account_manager_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaintenanceContract()
    {
        return $this->hasOne(GeneralMaintenanceContract::className(), ['id' => 'maintenance_contract_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMisc1()
    {
        return $this->hasOne(GeneralMisc1::className(), ['id' => 'misc1_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMisc1Label()
    {
        return $this->hasOne(GeneralMisc1Label::className(), ['id' => 'misc1_label_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMisc2()
    {
        return $this->hasOne(GeneralMisc2::className(), ['id' => 'misc2_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMisc2Label()
    {
        return $this->hasOne(GeneralMisc2Label::className(), ['id' => 'misc2_label_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtherLabel()
    {
        return $this->hasOne(GeneralOtherLabel::className(), ['id' => 'other_label_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSignallingType()
    {
        return $this->hasOne(GeneralSignallingType::className(), ['id' => 'signalling_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['id' => 'document_id'])->viaTable('{{%general_documents}}', ['general_id' => 'id']);
    }

    public function beforeDelete()
    {
        GeneralDocuments::deleteAll(['general_id' => $this->id]);
        return parent::beforeDelete();
    }
}
