<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%documents}}".
 *
 * @property integer $id
 * @property string $filename
 * @property string $folder
 *
 * @property QuoteDocuments[] $quoteDocuments
 * @property CustomerQuote[] $quotes
 */
class Documents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%documents}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filename', 'folder'], 'required'],
            [['filename', 'folder'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => 'Filename',
            'folder' => 'Folder',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuoteDocuments()
    {
        return $this->hasMany(QuoteDocuments::className(), ['document_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotes()
    {
        return $this->hasMany(CustomerQuote::className(), ['id' => 'quote_id'])->viaTable('{{%quote_documents}}', ['document_id' => 'id']);
    }

    public static function uploadDirectory()
    {
        return Yii::getAlias('@root') . '/uploads/';
    }

    private static function generateRandomString($length = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private static function generateFolder()
    {
        $folder = '';
        while (file_exists(static::uploadDirectory() . $folder))
        {
            $folder = self::generateRandomString();
        }
        return $folder;
    }

    /**
     * загрузка документа в папку
     * @param $document UploadedFile
     * @return boolean результат загрузки
     */
    public function uploadDocument($document)
    {
        if (!$document) return false;
        $folder = static::generateFolder();

        $folder_path = static::uploadDirectory() . $folder;

        mkdir($folder_path);

        if (file_exists($folder_path))
        {
            $file_path = $folder_path . '/' . $document->name;
            if ($document->saveAs($file_path)) {
                $this->folder = $folder;
                $this->filename = $document->name;

                return true;
            }
        }

        return false;
    }

    public function clean()
    {
        @unlink($this->filePath());
        @unlink(static::uploadDirectory() . $this->folder);
    }

    public static function documentModels() {
        return [
            QuoteDocuments::className(),
            SubcontractorDocuments::className(),
            GeneralDocuments::className()
        ];
    }

    public function beforeDelete()
    {
        foreach (static::documentModels() as $model) {
            $model::deleteAll(['document_id' => $this->id]);
        }
        return parent::beforeDelete();
    }

    public function afterDelete()
    {
        $this->clean();
        parent::afterDelete();
    }

    /**
     * Path to file: folder + filename
     */
    public function filePath()
    {
        return static::uploadDirectory() . $this->folder . '/' . $this->filename;
    }

    public function getFileSize()
    {
        return filesize($this->filePath());
    }
}
